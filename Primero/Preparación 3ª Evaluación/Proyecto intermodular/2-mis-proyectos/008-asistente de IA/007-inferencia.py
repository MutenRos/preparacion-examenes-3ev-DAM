#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import os
import sys
import torch
from transformers import AutoTokenizer, AutoModelForCausalLM

# ------------------------------------------------------------
# Paths relative to THIS script
# ------------------------------------------------------------
SCRIPT_DIR = os.path.dirname(os.path.abspath(__file__))

# Folder produced by the merge script:
#   ./lora-gpu-merged
MODEL_PATH = os.path.join(SCRIPT_DIR, "lora-gpu-merged")

# Optional: keep HF cache in a writable local folder
HF_CACHE = os.path.join(SCRIPT_DIR, ".hf-cache")
os.environ["HF_HOME"] = HF_CACHE
os.makedirs(HF_CACHE, exist_ok=True)


def build_chat_text(tokenizer, user_prompt: str) -> str:
    conv = [
        {
            "role": "system",
            "content": (
                "Eres un asistente educativo en español que responde de forma clara, precisa y concisa."
            ),
        },
        {"role": "user", "content": user_prompt},
    ]

    # Prefer Qwen chat template (saved with tokenizer)
    try:
        return tokenizer.apply_chat_template(
            conv,
            tokenize=False,
            add_generation_prompt=True,
        )
    except Exception:
        return (
            f"SYSTEM: {conv[0]['content']}\n"
            f"USER: {user_prompt}\n"
            f"ASSISTANT:"
        )


def main():
    if len(sys.argv) < 2:
        print("No prompt provided", file=sys.stderr)
        sys.exit(1)

    prompt = sys.argv[1]

    use_cuda = torch.cuda.is_available()
    if use_cuda:
        dtype = torch.bfloat16 if torch.cuda.is_bf16_supported() else torch.float16
        device_map = "auto"
    else:
        dtype = torch.float32
        device_map = {"": "cpu"}

    # --------------------------------------------------------
    # Load tokenizer + model (merged model)
    # --------------------------------------------------------
    tokenizer = AutoTokenizer.from_pretrained(
        MODEL_PATH,
        local_files_only=True,
        use_fast=True,
    )
    if tokenizer.pad_token is None:
        tokenizer.pad_token = tokenizer.eos_token

    model = AutoModelForCausalLM.from_pretrained(
        MODEL_PATH,
        local_files_only=True,
        torch_dtype=dtype,
        device_map=device_map,
    )

    # (Good practice for inference)
    model.eval()

    # --------------------------------------------------------
    # Build chat input
    # --------------------------------------------------------
    chat_text = build_chat_text(tokenizer, prompt)

    inputs = tokenizer(chat_text, return_tensors="pt")
    inputs = {k: v.to(model.device) for k, v in inputs.items()}
    input_len = inputs["input_ids"].shape[-1]

    # --------------------------------------------------------
    # Generate
    # --------------------------------------------------------
    with torch.no_grad():
        output_ids = model.generate(
            **inputs,
            max_new_tokens=256,
            temperature=0.2,     # slightly higher than 0.1 to avoid overly rigid output
            do_sample=True,
            top_p=0.9,
            pad_token_id=tokenizer.eos_token_id,
            eos_token_id=tokenizer.eos_token_id,
        )

    generated_ids = output_ids[0, input_len:]
    answer = tokenizer.decode(generated_ids, skip_special_tokens=True).strip()

    print(answer)


if __name__ == "__main__":
    main()
