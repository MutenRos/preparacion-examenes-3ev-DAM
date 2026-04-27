#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
infer_qwen_local.py

Inferencia para un modelo local (Qwen2.5) fine-tuned/merged.
Enfoque: QA "factual" (minimiza alucinación):
- Decoding determinista (do_sample=False)
- Sin min_new_tokens (no obliga a inventar)
- Post-proceso: si la salida está vacía o no cumple, devuelve UNKNOWN_SENTENCE
- Opcional: "guardrail" simple para forzar exactitud (muy conservador)

Uso:
  python3 infer_qwen_local.py "¿Cuál es el precio de la matrícula?"

Requisitos:
  pip install torch transformers
"""

import os
import sys
import re
import warnings

warnings.filterwarnings("ignore")
os.environ["TRANSFORMERS_VERBOSITY"] = "error"

import torch
from transformers import AutoTokenizer, AutoModelForCausalLM


# -----------------------------
# CONFIG
# -----------------------------

# Ajusta esto a tu ruta real (tu ejemplo la tenía fija)
PROJECT_DIR = "/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/013-IA a partir de PDF"
MODEL_PATH = os.path.join(PROJECT_DIR, "qwen25-05b-jvc-merged")

# Cache HF en sitio escribible
os.environ.setdefault("HF_HOME", "/tmp/hf-cache")
os.makedirs(os.environ["HF_HOME"], exist_ok=True)

SYSTEM_PROMPT = (
    "Eres un asistente de un centro de formación en España que ofrece cursos de inglés.\n"
    "Responde solo con información del material con el que fuiste entrenado.\n"
    "Si no está en el material, responde exactamente:\n"
    "\"No dispongo de esa información en el material de formación con el que fui entrenado.\".\n"
    "Responde en español, claro y conciso."
)

UNKNOWN_SENTENCE = "No dispongo de esa información en el material de formación con el que fui entrenado."

# Respuestas excesivamente largas suelen correlacionar con divagación/alucinación
MAX_NEW_TOKENS = 160

# Guardrail opcional: si la respuesta contiene demasiadas frases "inventadas" típicas, fuerza UNKNOWN.
# Está deliberadamente conservador; si te molesta, pon ENABLE_GUARDRAIL = False
ENABLE_GUARDRAIL = True
RISKY_PATTERNS = [
    r"\bte recomiendo\b",
    r"\bes importante\b.*\b(recuerda|tener en cuenta)\b",
    r"\bpor ejemplo\b.*\b(google|wikipedia|internet)\b",
    r"\bno estoy seguro\b",
    r"\bpuede variar\b",
    r"\b(normalmente|generalmente)\b",
]


def looks_risky(answer: str) -> bool:
    """Heurística conservadora: detecta 'relleno' o generalidades."""
    a = answer.strip().lower()
    if not a:
        return True
    # si mete URLs o emails (no deberían venir del material, normalmente)
    if "http://" in a or "https://" in a or "@" in a:
        return True
    for pat in RISKY_PATTERNS:
        if re.search(pat, a):
            return True
    return False


def load_tokenizer_and_model(model_path: str):
    tokenizer = AutoTokenizer.from_pretrained(
        model_path,
        local_files_only=True,
        use_fast=True,
    )
    # Asegurar pad_token
    if tokenizer.pad_token is None:
        tokenizer.pad_token = tokenizer.eos_token

    # dtype
    use_cuda = torch.cuda.is_available()
    torch_dtype = torch.float16 if use_cuda else torch.float32

    model = AutoModelForCausalLM.from_pretrained(
        model_path,
        local_files_only=True,
        device_map="auto" if use_cuda else None,
        torch_dtype=torch_dtype,
    )
    if not use_cuda:
        model.to("cpu")

    model.eval()
    return tokenizer, model


def build_chat_input(tokenizer, user_prompt: str) -> str:
    conv = [
        {"role": "system", "content": SYSTEM_PROMPT},
        {"role": "user", "content": user_prompt.strip()},
    ]
    try:
        return tokenizer.apply_chat_template(
            conv,
            tokenize=False,
            add_generation_prompt=True,
        )
    except Exception:
        return f"Sistema: {SYSTEM_PROMPT}\nUsuario: {user_prompt.strip()}\nAsistente:"


def generate_answer(tokenizer, model, chat_text: str) -> str:
    inputs = tokenizer(chat_text, return_tensors="pt")
    inputs = {k: v.to(model.device) for k, v in inputs.items()}
    input_len = inputs["input_ids"].shape[-1]

    # Decoding determinista => reduce alucinación
    gen_kwargs = dict(
        max_new_tokens=MAX_NEW_TOKENS,
        do_sample=False,
        num_beams=1,
        repetition_penalty=1.05,
        eos_token_id=tokenizer.eos_token_id,
        pad_token_id=tokenizer.pad_token_id,
    )

    with torch.no_grad():
        output_ids = model.generate(**inputs, **gen_kwargs)

    generated_ids = output_ids[0, input_len:]
    answer = tokenizer.decode(generated_ids, skip_special_tokens=True).strip()

    # Limpieza mínima
    answer = re.sub(r"\s+\n", "\n", answer).strip()
    answer = re.sub(r"\n{3,}", "\n\n", answer).strip()

    return answer


def main():
    if len(sys.argv) < 2:
        print("No prompt provided", file=sys.stderr)
        sys.exit(1)

    prompt = sys.argv[1].strip()
    if not prompt:
        print(UNKNOWN_SENTENCE)
        return

    try:
        tokenizer, model = load_tokenizer_and_model(MODEL_PATH)
    except Exception as e:
        print(f"Error loading model/tokenizer: {e}", file=sys.stderr)
        sys.exit(2)

    chat_text = build_chat_input(tokenizer, prompt)
    answer = generate_answer(tokenizer, model, chat_text)

    # Si el modelo devuelve vacío, devolvemos unknown
    if not answer:
        print(UNKNOWN_SENTENCE)
        return

    # Si el modelo ya devolvió la frase exacta, respetar
    if answer.strip() == UNKNOWN_SENTENCE:
        print(UNKNOWN_SENTENCE)
        return

    # Guardrail opcional
    if ENABLE_GUARDRAIL and looks_risky(answer):
        print(UNKNOWN_SENTENCE)
        return

    print(answer)


if __name__ == "__main__":
    main()

