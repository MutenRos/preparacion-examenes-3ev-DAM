#!/usr/bin/env python3
import os
import glob

# ✅ Force CPU only
os.environ["CUDA_VISIBLE_DEVICES"] = ""
os.environ["ACCELERATE_USE_CPU"] = "true"

import torch
from datetime import datetime
from datasets import load_dataset
from transformers import (
    AutoTokenizer,
    AutoModelForCausalLM,
    Trainer,
    TrainingArguments,
    DataCollatorForLanguageModeling,
)

from peft import LoraConfig, get_peft_model


# ------------------------------------------------------------
# CONFIG
# ------------------------------------------------------------
DATA_FOLDER = "entrenamiento"

# Primary
PRIMARY_MODEL = "microsoft/Qwen2.5-0.5B-Instruct"

# Fallback
FALLBACK_MODEL = "Qwen/Qwen2.5-0.5B-Instruct"

OUTPUT_DIR = "./lora-cpu-lowram"

MAX_LENGTH = 256
NUM_EPOCHS = 15
LR = 2e-4
BATCH_SIZE = 1
GRAD_ACCUM = 8


def try_load_int8_cpu(model_name: str):
    try:
        from transformers import BitsAndBytesConfig
    except Exception as e:
        raise RuntimeError(f"BitsAndBytesConfig not available. Details: {e}")

    quant_config = BitsAndBytesConfig(load_in_8bit=True)

    model = AutoModelForCausalLM.from_pretrained(
        model_name,
        device_map={"": "cpu"},
        quantization_config=quant_config,
    )
    return model


def load_cpu_fp32(model_name: str):
    model = AutoModelForCausalLM.from_pretrained(
        model_name,
        device_map={"": "cpu"},
        torch_dtype=torch.float32,
    )
    return model


def main():
    start_dt = datetime.now()

    print("🚀 Starting training (multiple JSONL files) with LoRA on CPU")
    print(f"📁 Dataset folder: {DATA_FOLDER}")
    print(f"🧠 Primary model: {PRIMARY_MODEL}")
    print(f"🧠 Fallback model: {FALLBACK_MODEL}")
    print("-" * 60)

    if torch.cuda.is_available():
        raise RuntimeError("CUDA is still visible. Run with CUDA_VISIBLE_DEVICES=''.")

    # ------------------------------------------------------------
    # Load all jsonl files
    # ------------------------------------------------------------
    jsonl_files = sorted(glob.glob(os.path.join(DATA_FOLDER, "*.jsonl")))

    if not jsonl_files:
        raise FileNotFoundError(f"No JSONL files found inside: {DATA_FOLDER}")

    print("📄 Files found:")
    for f in jsonl_files:
        print("   ", f)

    raw_dataset = load_dataset("json", data_files=jsonl_files, split="train")
    print(f"✅ Dataset loaded with {len(raw_dataset)} Q/A examples.")

    # ------------------------------------------------------------
    # Load tokenizer + model
    # ------------------------------------------------------------
    model_name_used = PRIMARY_MODEL
    model = None

    try:
        print("🔧 Trying PRIMARY model in CPU INT8...")
        tokenizer = AutoTokenizer.from_pretrained(PRIMARY_MODEL, use_fast=True)

        if tokenizer.pad_token is None:
            tokenizer.pad_token = tokenizer.eos_token

        model = try_load_int8_cpu(PRIMARY_MODEL)
        print("✅ Loaded PRIMARY model in CPU INT8.")

    except Exception as e:
        print("⚠️ Could not load PRIMARY in CPU INT8.")
        print(f"Reason: {e}")
        print("➡️ Falling back to smaller model on CPU fp32...")

        model_name_used = FALLBACK_MODEL

        tokenizer = AutoTokenizer.from_pretrained(FALLBACK_MODEL, use_fast=True)

        if tokenizer.pad_token is None:
            tokenizer.pad_token = tokenizer.eos_token

        model = load_cpu_fp32(FALLBACK_MODEL)
        print("✅ Loaded FALLBACK model on CPU fp32.")

    # ------------------------------------------------------------
    # Memory saving
    # ------------------------------------------------------------
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
    # Q/A -> text
    # ------------------------------------------------------------
    SYSTEM_PROMPT = (
        "Eres un asistente educativo en español que responde de forma clara, "
        "precisa y concisa a preguntas técnicas."
    )

    def qa_to_text(example):
        q = example.get("question", "")
        a = example.get("answer", "")

        if not isinstance(q, str):
            q = str(q)

        if not isinstance(a, str):
            a = str(a)

        conv = [
            {"role": "system", "content": SYSTEM_PROMPT},
            {"role": "user", "content": q},
            {"role": "assistant", "content": a},
        ]

        try:
            text = tokenizer.apply_chat_template(
                conv,
                tokenize=False,
                add_generation_prompt=False
            )
        except Exception:
            text = f"SYSTEM: {SYSTEM_PROMPT}\nUSER: {q}\nASSISTANT: {a}\n"

        return {"text": text}

    text_dataset = raw_dataset.map(qa_to_text)

    def tokenize_fn(batch):
        return tokenizer(
            batch["text"],
            truncation=True,
            max_length=MAX_LENGTH,
            padding=False,
        )

    tokenized_dataset = text_dataset.map(
        tokenize_fn,
        batched=True,
        remove_columns=text_dataset.column_names,
    )

    data_collator = DataCollatorForLanguageModeling(
        tokenizer=tokenizer,
        mlm=False
    )

    # ------------------------------------------------------------
    # TrainingArguments
    # ------------------------------------------------------------
    training_args = TrainingArguments(
        output_dir=os.path.join(
            OUTPUT_DIR,
            model_name_used.replace("/", "_")
        ),
        num_train_epochs=NUM_EPOCHS,
        per_device_train_batch_size=BATCH_SIZE,
        gradient_accumulation_steps=GRAD_ACCUM,
        learning_rate=LR,
        weight_decay=0.01,
        warmup_steps=25,
        logging_steps=5,
        save_steps=200,
        save_total_limit=1,
        report_to="none",
        gradient_checkpointing=True,
        dataloader_pin_memory=False,
        optim="adamw_torch",
    )

    trainer = Trainer(
        model=model,
        args=training_args,
        train_dataset=tokenized_dataset,
        data_collator=data_collator,
    )

    print("🚂 Starting training on CPU...")
    train_output = trainer.train()

    print("🏁 Training finished.")

    out_dir = training_args.output_dir
    print("💾 Saving model/adapters and tokenizer to", out_dir)

    os.makedirs(out_dir, exist_ok=True)
    trainer.save_model(out_dir)
    tokenizer.save_pretrained(out_dir)

    end_dt = datetime.now()
    print(f"⏱️ Duration: {end_dt - start_dt}")

    metrics = getattr(train_output, "metrics", None)
    if metrics:
        print("📊 Metrics:", metrics)


if __name__ == "__main__":
    main()
