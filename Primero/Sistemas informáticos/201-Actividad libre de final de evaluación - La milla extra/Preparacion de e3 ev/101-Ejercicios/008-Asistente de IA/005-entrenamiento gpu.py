#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import os
import glob
import torch
from dataclasses import dataclass
from datetime import datetime
from typing import Any, Dict, List

from datasets import load_dataset
from transformers import (
    AutoTokenizer,
    AutoModelForCausalLM,
    Trainer,
    TrainingArguments,
)
from peft import LoraConfig, get_peft_model


# ------------------------------------------------------------
# CONFIG
# ------------------------------------------------------------
DATA_FOLDER = "entrenamiento"          # folder with *.jsonl
PRIMARY_MODEL = "Qwen/Qwen2.5-0.5B-Instruct"
OUTPUT_DIR = "./lora-gpu"

SYSTEM_PROMPT = (
    "Eres un asistente educativo en español que responde de forma clara, precisa y concisa."
)

MAX_LENGTH = 512                      # 256 is often too short for BOE-style answers
NUM_EPOCHS = 5                        # start lower to avoid degeneration
LR = 1e-4                             # safer than 2e-4 for small models
BATCH_SIZE = 2
GRAD_ACCUM = 4


# ------------------------------------------------------------
# Custom collator: pads input_ids/attention_mask + pads labels with -100
# ------------------------------------------------------------
@dataclass
class DataCollatorForCausalLMWithLabels:
    tokenizer: Any

    def __call__(self, features: List[Dict[str, Any]]) -> Dict[str, torch.Tensor]:
        # Separate labels because tokenizer.pad doesn't pad them the way we want
        labels = [f["labels"] for f in features]
        for f in features:
            f.pop("labels")

        batch = self.tokenizer.pad(
            features,
            padding=True,
            return_tensors="pt",
        )

        # Pad labels to match input length
        max_len = batch["input_ids"].shape[1]
        padded_labels = []
        for lab in labels:
            if len(lab) < max_len:
                lab = lab + [-100] * (max_len - len(lab))
            else:
                lab = lab[:max_len]
            padded_labels.append(lab)

        batch["labels"] = torch.tensor(padded_labels, dtype=torch.long)
        return batch


def main():
    start_dt = datetime.now()

    print("🚀 Starting GPU LoRA SFT (assistant-only loss masking)")
    print(f"📁 Dataset folder: {DATA_FOLDER}")
    print(f"🧠 Model: {PRIMARY_MODEL}")
    print("-" * 60)

    if not torch.cuda.is_available():
        raise RuntimeError("CUDA GPU not detected.")

    print("✅ CUDA available")
    print("GPU:", torch.cuda.get_device_name(0))

    # ------------------------------------------------------------
    # Load all JSONL files
    # ------------------------------------------------------------
    jsonl_files = sorted(glob.glob(os.path.join(DATA_FOLDER, "*.jsonl")))
    if not jsonl_files:
        raise FileNotFoundError(f"No JSONL files found in {DATA_FOLDER}")

    print("📄 Files found:")
    for f in jsonl_files:
        print("   ", f)

    raw_dataset = load_dataset("json", data_files=jsonl_files, split="train")
    print(f"✅ Loaded {len(raw_dataset)} examples")

    # Filter obvious empties early
    def non_empty(ex):
        q = str(ex.get("question", "")).strip()
        a = str(ex.get("answer", "")).strip()
        return len(q) > 0 and len(a) > 0

    raw_dataset = raw_dataset.filter(non_empty)
    print(f"✅ After empty-filter: {len(raw_dataset)} examples")

    # ------------------------------------------------------------
    # Tokenizer
    # ------------------------------------------------------------
    tokenizer = AutoTokenizer.from_pretrained(PRIMARY_MODEL, use_fast=True)
    tokenizer.padding_side = "right"
    if tokenizer.pad_token is None:
        tokenizer.pad_token = tokenizer.eos_token

    # ------------------------------------------------------------
    # Model GPU
    # ------------------------------------------------------------
    model = AutoModelForCausalLM.from_pretrained(
        PRIMARY_MODEL,
        torch_dtype=torch.float16,
        device_map="auto",
    )

    model.config.use_cache = False
    model.gradient_checkpointing_enable()

    try:
        model.enable_input_require_grads()
    except Exception:
        pass

    # ------------------------------------------------------------
    # LoRA
    # ------------------------------------------------------------
    lora_config = LoraConfig(
        r=8,
        lora_alpha=16,
        target_modules=[
            "q_proj", "k_proj", "v_proj", "o_proj",
            "gate_proj", "up_proj", "down_proj"
        ],
        lora_dropout=0.05,
        bias="none",
        task_type="CAUSAL_LM",
    )
    model = get_peft_model(model, lora_config)
    model.print_trainable_parameters()

    # ------------------------------------------------------------
    # Build assistant-only labels (mask prompt tokens with -100)
    #
    # Key idea:
    #  - Build PROMPT using chat template with add_generation_prompt=True
    #    (ends right where assistant should start)
    #  - Build FULL = prompt + answer + eos
    #  - labels = -100 for prompt tokens, real labels only for answer tokens
    # ------------------------------------------------------------
    def build_prompt_and_full(q: str, a: str) -> (str, str):
        messages_prompt = [
            {"role": "system", "content": SYSTEM_PROMPT},
            {"role": "user", "content": q},
        ]
        # Prompt that ends with the assistant header/prefix
        prompt = tokenizer.apply_chat_template(
            messages_prompt,
            tokenize=False,
            add_generation_prompt=True,
        )

        # Full text includes the answer and an EOS at the end
        eos = tokenizer.eos_token or ""
        full = prompt + a + eos
        return prompt, full

    def tokenize_with_labels(example):
        q = str(example.get("question", "")).strip()
        a = str(example.get("answer", "")).strip()

        prompt, full = build_prompt_and_full(q, a)

        prompt_ids = tokenizer(prompt, add_special_tokens=False)["input_ids"]
        full_enc = tokenizer(
            full,
            add_special_tokens=False,
            truncation=True,
            max_length=MAX_LENGTH,
        )
        input_ids = full_enc["input_ids"]
        attention_mask = full_enc["attention_mask"]

        # If truncation cut inside the prompt so there is no answer left, drop sample
        if len(prompt_ids) >= len(input_ids):
            return {"input_ids": [], "attention_mask": [], "labels": []}

        # Assistant-only labels
        labels = [-100] * len(prompt_ids) + input_ids[len(prompt_ids):]

        # Ensure same length
        labels = labels[: len(input_ids)]

        # Also drop if there is no supervised token
        if all(x == -100 for x in labels):
            return {"input_ids": [], "attention_mask": [], "labels": []}

        return {
            "input_ids": input_ids,
            "attention_mask": attention_mask,
            "labels": labels,
        }

    tokenized_dataset = raw_dataset.map(
        tokenize_with_labels,
        remove_columns=raw_dataset.column_names,
    )

    # Remove failed/empty rows
    def has_tokens(ex):
        return isinstance(ex["input_ids"], list) and len(ex["input_ids"]) > 0

    tokenized_dataset = tokenized_dataset.filter(has_tokens)
    print(f"✅ After tokenization+filter: {len(tokenized_dataset)} examples")

    data_collator = DataCollatorForCausalLMWithLabels(tokenizer=tokenizer)

    # ------------------------------------------------------------
    # TrainingArguments GPU
    # ------------------------------------------------------------
    training_args = TrainingArguments(
        output_dir=OUTPUT_DIR,
        num_train_epochs=NUM_EPOCHS,
        per_device_train_batch_size=BATCH_SIZE,
        gradient_accumulation_steps=GRAD_ACCUM,
        learning_rate=LR,
        weight_decay=0.01,
        warmup_ratio=0.03,
        lr_scheduler_type="cosine",
        logging_steps=10,
        save_steps=200,
        save_total_limit=1,
        report_to="none",
        fp16=True,
        gradient_checkpointing=True,
        optim="adamw_torch",
        dataloader_num_workers=2,
    )

    trainer = Trainer(
        model=model,
        args=training_args,
        train_dataset=tokenized_dataset,
        data_collator=data_collator,
    )

    # ------------------------------------------------------------
    # Train
    # ------------------------------------------------------------
    print("🚂 Training on GPU...")
    train_output = trainer.train()
    print("🏁 Finished")

    trainer.save_model(OUTPUT_DIR)
    tokenizer.save_pretrained(OUTPUT_DIR)

    end_dt = datetime.now()
    print("⏱️ Duration:", end_dt - start_dt)

    metrics = getattr(train_output, "metrics", None)
    if metrics:
        print("📊 Metrics:", metrics)


if __name__ == "__main__":
    main()
