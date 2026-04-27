import os
import re
import json
import urllib.request
from typing import List
from pypdf import PdfReader

# ==========================
# CONFIG
# ==========================
PDF_DIR = "pdf"
OLLAMA_URL = os.environ.get("OLLAMA_URL", "http://localhost:11434/api/generate")
OLLAMA_MODEL = os.environ.get("OLLAMA_MODEL", "qwen2.5:3b-instruct")

MAX_CHARS_PER_CHUNK = int(os.environ.get("MAX_CHARS_PER_CHUNK", "12000"))
MIN_TEXT_LEN = 30

# Etiquetas permitidas (1 sola palabra)
ALLOWED_TYPES = [
    "factura",
    "contrato",
    "presupuesto",
    "albarán",
    "currículum",
    "certificado",
    "normativa",
    "manual",
    "informe",
    "presentación",
    "acta",
    "circular",
    "carta",
    "formulario",
    "recibo",
    "extracto",
    "justificante",
    "procedimiento",
    "catálogo",
    "oferta",
    "otro",
]

# ==========================
# HELPERS
# ==========================
def extract_pdf_text(path: str) -> str:
    reader = PdfReader(path)
    parts: List[str] = []
    for page in reader.pages:
        t = page.extract_text() or ""
        if t.strip():
            parts.append(t)
    text = "\n".join(parts)
    text = re.sub(r"[ \t]+", " ", text)
    text = re.sub(r"\n{3,}", "\n\n", text)
    return text.strip()


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
        chunks.append(text[start:cut].strip())
        start = cut
    return [c for c in chunks if c]


def ollama_generate(prompt: str) -> str:
    payload = {
        "model": OLLAMA_MODEL,
        "prompt": prompt,
        "stream": False,
        "options": {"temperature": 0.0, "top_p": 1.0},
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


def normalize_one_word(s: str) -> str:
    s = s.strip().lower()
    # deja solo letras (incluye acentos) para evitar puntuación
    s = re.sub(r"[^a-záéíóúüñ]", "", s)
    return s


def classify_pdf_text(text: str) -> str:
    chunks = chunk_text(text, MAX_CHARS_PER_CHUNK)

    # Si hay varios fragmentos: clasificamos cada uno y luego votamos
    labels = []
    for ch in chunks:
        prompt = (
            "Clasifica el siguiente texto como el TIPO de documento.\n"
            "Responde SOLO con UNA palabra en minúsculas.\n"
            "Debes elegir estrictamente una de estas etiquetas:\n"
            f"{', '.join(ALLOWED_TYPES)}\n\n"
            "Texto:\n"
            f"{ch}\n\n"
            "Respuesta (una sola palabra):"
        )
        lab = normalize_one_word(ollama_generate(prompt))
        if lab in ALLOWED_TYPES:
            labels.append(lab)
        else:
            labels.append("otro")

    # Votación mayoritaria
    counts = {}
    for lab in labels:
        counts[lab] = counts.get(lab, 0) + 1
    best = sorted(counts.items(), key=lambda x: (-x[1], x[0]))[0][0]
    return best


# ==========================
# MAIN
# ==========================
def main():
    if not os.path.isdir(PDF_DIR):
        raise SystemExit(f"No existe la carpeta: {PDF_DIR}")

    pdfs = sorted([a for a in os.listdir(PDF_DIR) if a.lower().endswith(".pdf")])
    if not pdfs:
        print("No hay PDFs en la carpeta ./pdf")
        return

    for archivo in pdfs:
        ruta = os.path.join(PDF_DIR, archivo)
        try:
            text = extract_pdf_text(ruta)

            if len(text) < MIN_TEXT_LEN:
                print(f"{archivo} -> otro")
                continue

            tipo = classify_pdf_text(text)
            print(f"{archivo} -> {tipo}")

        except Exception as e:
            print(f"{archivo} -> ERROR: {e}")


if __name__ == "__main__":
    main()
