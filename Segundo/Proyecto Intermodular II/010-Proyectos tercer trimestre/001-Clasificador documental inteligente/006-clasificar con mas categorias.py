#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
Clasificación de PDFs usando una taxonomía en Markdown (padre-hijo) + Ollama.

Hace:
1) Lee categorias_documentales.md (o el que indiques)
2) Extrae todas las categorías hoja (líneas "- ...") y su ruta completa "A > B > C"
3) Para cada PDF en ./pdf:
   - extrae texto con pypdf
   - lo trocea si es muy largo
   - pide a Ollama que clasifique en UNA de las rutas hoja
4) Imprime: archivo -> ruta_clasificada

Requisitos:
  pip install pypdf

Uso:
  python3 clasificar_pdfs_taxonomia.py

Opcional por variables:
  TAXONOMY_MD="categorias_documentales.md"
  PDF_DIR="pdf"
  OLLAMA_MODEL="qwen2.5:3b-instruct"
  OLLAMA_URL="http://localhost:11434/api/generate"
  MAX_CHARS_PER_CHUNK=12000
  MIN_TEXT_LEN=30
"""

import os
import re
import json
import urllib.request
from dataclasses import dataclass
from typing import List, Tuple, Optional, Dict

from pypdf import PdfReader


# ==========================
# CONFIG
# ==========================
TAXONOMY_MD = os.environ.get("TAXONOMY_MD", "categorias_documentales.md")
PDF_DIR     = os.environ.get("PDF_DIR", "pdf")

OLLAMA_URL   = os.environ.get("OLLAMA_URL", "http://localhost:11434/api/generate")
OLLAMA_MODEL = os.environ.get("OLLAMA_MODEL", "qwen2.5:3b-instruct")

MAX_CHARS_PER_CHUNK = int(os.environ.get("MAX_CHARS_PER_CHUNK", "12000"))
MIN_TEXT_LEN        = int(os.environ.get("MIN_TEXT_LEN", "30"))

# Para evitar prompts gigantes, podemos limitar cuántas rutas hoja incluimos por llamada.
# Si tu taxonomía es enorme, el script hará "preselección" por embeddings NO; aquí hace
# una aproximación por keywords + fallback. Si quieres embeddings, te lo adapto.
MAX_LABELS_IN_PROMPT = int(os.environ.get("MAX_LABELS_IN_PROMPT", "350"))

# Si hay demasiadas rutas, haremos un filtrado simple por coincidencia de palabras.
KEYWORD_PREFILTER_MAX = int(os.environ.get("KEYWORD_PREFILTER_MAX", "120"))


# ==========================
# DATA STRUCTURES
# ==========================
@dataclass
class LeafCategory:
    path: str                 # "Área > Subárea > Tipo"
    leaf: str                 # "Tipo"
    ancestors: List[str]      # ["Área", "Subárea"]


# ==========================
# MARKDOWN TAXONOMY PARSER
# ==========================
def parse_taxonomy_markdown(md_path: str) -> List[LeafCategory]:
    """
    Interpreta:
      ## Nivel 1
      ### Nivel 2
      #### Nivel 3
      - Hoja

    Las hojas son líneas con "- " (bullet). La ruta completa se compone con los headers.
    """
    if not os.path.isfile(md_path):
        raise FileNotFoundError(f"No existe el archivo de taxonomía: {md_path}")

    headers_stack: List[Tuple[int, str]] = []  # (level, title)
    leaves: List[LeafCategory] = []

    header_re = re.compile(r"^(#{2,6})\s+(.+?)\s*$")  # desde ## hasta ######
    bullet_re = re.compile(r"^\s*-\s+(.+?)\s*$")

    with open(md_path, "r", encoding="utf-8") as f:
        for raw in f:
            line = raw.rstrip("\n")

            # Header
            m = header_re.match(line.strip())
            if m:
                level = len(m.group(1))  # ## => 2
                title = m.group(2).strip()
                # ajusta stack: quita headers de nivel >= actual
                while headers_stack and headers_stack[-1][0] >= level:
                    headers_stack.pop()
                headers_stack.append((level, title))
                continue

            # Bullet leaf
            b = bullet_re.match(line)
            if b:
                leaf = b.group(1).strip()
                ancestors = [t for _, t in headers_stack]  # incluye todos los headers en stack
                # Si no hay headers, aun así admitimos la hoja como "leaf" sin ruta
                if ancestors:
                    path = " > ".join(ancestors + [leaf])
                else:
                    path = leaf
                leaves.append(LeafCategory(path=path, leaf=leaf, ancestors=ancestors))
                continue

    # Deduplicar manteniendo orden
    seen = set()
    out: List[LeafCategory] = []
    for c in leaves:
        key = c.path.lower()
        if key not in seen:
            seen.add(key)
            out.append(c)
    return out


# ==========================
# PDF TEXT EXTRACTION
# ==========================
def extract_pdf_text(path: str) -> str:
    reader = PdfReader(path)
    parts: List[str] = []
    for page in reader.pages:
        t = page.extract_text() or ""
        if t.strip():
            parts.append(t)
    text = "\n".join(parts).strip()
    text = re.sub(r"[ \t]+", " ", text)
    text = re.sub(r"\n{3,}", "\n\n", text)
    return text


def chunk_text(text: str, max_chars: int) -> List[str]:
    if len(text) <= max_chars:
        return [text]
    chunks = []
    start = 0
    while start < len(text):
        end = min(start + max_chars, len(text))
        cut = text.rfind("\n", start, end)
        if cut == -1 or cut <= start + int(max_chars * 0.6):
            cut = end
        chunk = text[start:cut].strip()
        if chunk:
            chunks.append(chunk)
        start = cut
    return chunks


# ==========================
# OLLAMA CLIENT
# ==========================
def ollama_generate(prompt: str) -> str:
    payload = {
        "model": OLLAMA_MODEL,
        "prompt": prompt,
        "stream": False,
        "options": {
            "temperature": 0.0,
            "top_p": 1.0,
        }
    }
    req = urllib.request.Request(
        OLLAMA_URL,
        data=json.dumps(payload).encode("utf-8"),
        headers={"Content-Type": "application/json"},
        method="POST",
    )
    with urllib.request.urlopen(req, timeout=600) as resp:
        data = json.loads(resp.read().decode("utf-8"))
    return (data.get("response") or "").strip()


# ==========================
# LABEL UTILITIES
# ==========================
def normalize_label(s: str) -> str:
    s = s.strip()
    s = s.replace("\n", " ").replace("\r", " ")
    s = re.sub(r"\s+", " ", s).strip()
    return s


def build_label_list(leaves: List[LeafCategory]) -> List[str]:
    return [c.path for c in leaves]


def keyword_prefilter(text: str, labels: List[str], max_keep: int) -> List[str]:
    """
    Filtrado simple por keywords:
    - tokeniza el texto
    - puntúa cada label por coincidencias de tokens
    """
    # Tokens básicos del texto
    t = text.lower()
    t = re.sub(r"[^a-záéíóúüñ0-9\s]", " ", t)
    tokens = [w for w in t.split() if len(w) >= 4]
    if not tokens:
        return labels[:max_keep]

    token_set = set(tokens)

    scored: List[Tuple[int, str]] = []
    for lab in labels:
        l = lab.lower()
        l = re.sub(r"[^a-záéíóúüñ0-9\s>]", " ", l)
        words = [w for w in l.split() if len(w) >= 4]
        score = sum(1 for w in words if w in token_set)
        scored.append((score, lab))

    scored.sort(key=lambda x: (-x[0], x[1]))
    top = [lab for score, lab in scored[:max_keep]]
    # Si todas puntúan 0, devuelve subset simple
    if scored and scored[0][0] == 0:
        return labels[:max_keep]
    return top


def choose_label_with_ollama(text: str, labels: List[str]) -> str:
    """
    Pide a Ollama que devuelva EXACTAMENTE una de las rutas.
    """
    # Para minimizar longitud: lista numerada
    label_lines = "\n".join([f"{i+1}. {lab}" for i, lab in enumerate(labels)])

    prompt = (
        "Eres un clasificador documental.\n"
        "Debes elegir EXACTAMENTE UNA categoría de la lista (sin añadir texto extra).\n"
        "Responde con la categoría tal cual aparece (misma escritura), o si no encaja, responde: Otro\n\n"
        "CATEGORÍAS:\n"
        f"{label_lines}\n\n"
        "TEXTO DEL DOCUMENTO:\n"
        f"{text}\n\n"
        "RESPUESTA (una sola línea):"
    )
    raw = normalize_label(ollama_generate(prompt))
    return raw


def map_response_to_known_label(resp: str, labels: List[str]) -> str:
    """
    Acepta:
      - coincidencia exacta con alguna etiqueta
      - "Otro" (case-insensitive)
      - si devuelve un número, lo mapea
      - si devuelve algo similar, intenta match por contains (fallback)
    """
    if not resp:
        return "Otro"

    if resp.strip().lower() == "otro":
        return "Otro"

    # Si devuelve un número
    if re.fullmatch(r"\d+", resp.strip()):
        idx = int(resp.strip()) - 1
        if 0 <= idx < len(labels):
            return labels[idx]
        return "Otro"

    # Exact
    for lab in labels:
        if resp == lab:
            return lab

    # Case-insensitive exact
    resp_low = resp.lower()
    for lab in labels:
        if resp_low == lab.lower():
            return lab

    # Fallback: contiene / similar básico
    for lab in labels:
        if resp_low in lab.lower() or lab.lower() in resp_low:
            return lab

    return "Otro"


# ==========================
# CLASSIFICATION PIPELINE
# ==========================
def classify_document(text: str, all_labels: List[str]) -> str:
    """
    Estrategia:
    - Si hay demasiadas labels para el prompt, prefiltra por keywords
    - Si el texto es muy largo, trocea y clasifica por fragmentos y vota
    """
    # Si hay muchísimas etiquetas, reduce con prefilter para no reventar el prompt
    labels = all_labels
    if len(labels) > MAX_LABELS_IN_PROMPT:
        labels = keyword_prefilter(text, labels, KEYWORD_PREFILTER_MAX)

    # Chunking del texto
    chunks = chunk_text(text, MAX_CHARS_PER_CHUNK)

    # Clasifica cada chunk y vota
    votes: Dict[str, int] = {}
    for ch in chunks:
        resp = choose_label_with_ollama(ch, labels)
        lab = map_response_to_known_label(resp, labels)
        votes[lab] = votes.get(lab, 0) + 1

    # Mayoría
    best = sorted(votes.items(), key=lambda x: (-x[1], x[0]))[0][0]
    return best


# ==========================
# MAIN
# ==========================
def main():
    leaves = parse_taxonomy_markdown(TAXONOMY_MD)
    if not leaves:
        raise SystemExit("No se han encontrado categorías hoja ('- item') en el Markdown.")

    labels = build_label_list(leaves)

    if not os.path.isdir(PDF_DIR):
        raise SystemExit(f"No existe la carpeta: {PDF_DIR}")

    pdfs = sorted([f for f in os.listdir(PDF_DIR) if f.lower().endswith(".pdf")])
    if not pdfs:
        print(f"No hay PDFs en la carpeta ./{PDF_DIR}")
        return

    # Info breve (sin exceso)
    print(f"Taxonomía: {TAXONOMY_MD} | Hojas: {len(labels)} | Modelo: {OLLAMA_MODEL}")
    print("-" * 80)

    for pdf in pdfs:
        path = os.path.join(PDF_DIR, pdf)
        try:
            text = extract_pdf_text(path)
            if len(text) < MIN_TEXT_LEN:
                print(f"{pdf} -> Otro")
                continue

            label = classify_document(text, labels)
            print(f"{pdf} -> {label}")

        except Exception as e:
            print(f"{pdf} -> ERROR: {e}")


if __name__ == "__main__":
    main()
