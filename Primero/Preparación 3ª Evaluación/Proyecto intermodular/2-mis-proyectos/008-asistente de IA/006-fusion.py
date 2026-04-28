#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import os
import torch
from transformers import AutoTokenizer, AutoModelForCausalLM
from peft import PeftModel

# Must match training config
BASE_MODEL   = "Qwen/Qwen2.5-0.5B-Instruct"
OUTPUT_DIR  = "./lora-gpu"          # where Trainer saved the adapter
ADAPTER_PATH = OUTPUT_DIR           # adapter is saved directly here
OUT_PATH    = OUTPUT_DIR + "-merged"  # merged output folder


def main():
    if not os.path.isdir(ADAPTER_PATH):
        raise FileNotFoundError(f"Adapter folder not found: {ADAPTER_PATH}")

    # Quick sanity check: PEFT adapter config should exist in the adapter folder
    adapter_cfg = os.path.join(ADAPTER_PATH, "adapter_config.json")
    if not os.path.isfile(adapter_cfg):
        raise FileNotFoundError(
            f"adapter_config.json not found in {ADAPTER_PATH}\n"
            f"That usually means this folder is not a PEFT/LoRA adapter output."
        )

    os.makedirs(OUT_PATH, exist_ok=True)

    use_cuda = torch.cuda.is_available()
    if use_cuda:
        if torch.cuda.is_bf16_supported():
            dtype = torch.bfloat16
        else:
            dtype = torch.float16
        device_map = "auto"
    else:
        dtype = torch.float32
        device_map = {"": "cpu"}

    print("BASE_MODEL   :", BASE_MODEL)
    print("ADAPTER_PATH :", ADAPTER_PATH)
    print("OUT_PATH     :", OUT_PATH)
    print("CUDA         :", use_cuda, "| dtype:", dtype)

    print("Loading base model...")
    base = AutoModelForCausalLM.from_pretrained(
        BASE_MODEL,
        torch_dtype=dtype,
        device_map=device_map,
    )

    print("Loading tokenizer...")
    tok = AutoTokenizer.from_pretrained(BASE_MODEL, use_fast=True)
    if tok.pad_token is None:
        tok.pad_token = tok.eos_token

    print("Loading LoRA adapter into base...")
    model = PeftModel.from_pretrained(base, ADAPTER_PATH)

    print("Merging (merge_and_unload)...")
    merged = model.merge_and_unload()

    # Optional: re-enable cache for inference
    try:
        merged.config.use_cache = True
    except Exception:
        pass

    print("Saving merged model...")
    merged.save_pretrained(OUT_PATH, safe_serialization=True)

    print("Saving tokenizer...")
    tok.save_pretrained(OUT_PATH)

    print("✅ Merged model saved at:", OUT_PATH)


if __name__ == "__main__":
    main()
