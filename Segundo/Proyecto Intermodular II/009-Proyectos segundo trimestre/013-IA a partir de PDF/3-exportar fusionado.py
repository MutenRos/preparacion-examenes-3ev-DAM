#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import os
import sys
import glob
import torch
from transformers import AutoTokenizer, AutoModelForCausalLM
from peft import PeftModel

# -----------------------------
# CONFIG
# -----------------------------
BASE_MODEL = "Qwen/Qwen2.5-0.5B-Instruct"

PROJECT_DIR = "/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/013-IA a partir de PDF"

# MUST match training OUTPUT_DIR
ADAPTER_PATH = os.path.join(PROJECT_DIR, "qwen25-05b-jvc-lora")

# Output merged model
OUT_PATH = os.path.join(PROJECT_DIR, "qwen25-05b-jvc-merged")

# HF cache in writable place
os.environ.setdefault("HF_HOME", "/tmp/hf-cache")
os.makedirs(os.environ["HF_HOME"], exist_ok=True)


# -----------------------------
# Helpers
# -----------------------------
def die(msg: str, code: int = 1):
    print(msg, file=sys.stderr)
    sys.exit(code)

def must_exist_dir(path: str):
    if not os.path.isdir(path):
        die(f"[ERROR] No existe la carpeta: {path}")

def list_dir(path: str):
    try:
        return sorted(os.listdir(path))
    except Exception:
        return []

def find_any(patterns):
    for p in patterns:
        hits = glob.glob(p)
        if hits:
            return hits[0]
    return None


# -----------------------------
# Main
# -----------------------------
def main():
    must_exist_dir(ADAPTER_PATH)

    adapter_cfg = os.path.join(ADAPTER_PATH, "adapter_config.json")
    adapter_weights = find_any([
        os.path.join(ADAPTER_PATH, "adapter_model.safetensors"),
        os.path.join(ADAPTER_PATH, "adapter_model.bin"),
        os.path.join(ADAPTER_PATH, "*.safetensors"),
        os.path.join(ADAPTER_PATH, "*.bin"),
    ])

    if not os.path.isfile(adapter_cfg):
        die(
            "[ERROR] No se encuentra 'adapter_config.json' en la carpeta de adaptadores.\n"
            f"Carpeta revisada: {ADAPTER_PATH}\n"
            f"Contenido: {list_dir(ADAPTER_PATH)}\n\n"
            "Esto indica que el entrenamiento no guardó adaptadores en ese OUTPUT_DIR "
            "o estás mirando en otra ruta."
        )

    if adapter_weights is None:
        die(
            "[ERROR] No se encuentra archivo de pesos del adaptador (adapter_model.*) en la carpeta.\n"
            f"Carpeta revisada: {ADAPTER_PATH}\n"
            f"Contenido: {list_dir(ADAPTER_PATH)}"
        )

    os.makedirs(OUT_PATH, exist_ok=True)

    device = "cuda" if torch.cuda.is_available() else "cpu"
    dtype = torch.float16 if device == "cuda" else torch.float32

    print("[INFO] Cargando modelo base:", BASE_MODEL)
    base_model = AutoModelForCausalLM.from_pretrained(
        BASE_MODEL,
        dtype=dtype,
        device_map="auto" if device == "cuda" else None,
    )
    if device == "cpu":
        base_model.to("cpu")

    print("[INFO] Cargando adaptadores LoRA desde:", ADAPTER_PATH)
    model = PeftModel.from_pretrained(
        base_model,
        ADAPTER_PATH,
        local_files_only=True,
    )

    print("[INFO] Fusionando (merge_and_unload)...")
    model = model.merge_and_unload()

    print("[INFO] Guardando modelo fusionado en:", OUT_PATH)
    model.save_pretrained(OUT_PATH, safe_serialization=True)

    print("[INFO] Guardando tokenizer en:", OUT_PATH)
    tokenizer = AutoTokenizer.from_pretrained(BASE_MODEL, use_fast=True)
    if tokenizer.pad_token is None:
        tokenizer.pad_token = tokenizer.eos_token
    tokenizer.save_pretrained(OUT_PATH)

    print("✅ OK. Modelo fusionado listo en:", OUT_PATH)


if __name__ == "__main__":
    main()

