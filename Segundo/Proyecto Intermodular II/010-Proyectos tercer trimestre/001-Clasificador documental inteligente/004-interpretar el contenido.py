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

# Elige modelo (recomendación: qwen2.5:3b-instruct o llama3.1:8b)
OLLAMA_MODEL = os.environ.get("OLLAMA_MODEL", "qwen2.5:3b-instruct")

# Chunking: si el texto es enorme, lo troceamos.
# Aproximación: 1 token ~ 4 caracteres (depende del idioma/modelo).
MAX_CHARS_PER_CHUNK = int(os.environ.get("MAX_CHARS_PER_CHUNK", "12000"))

# Si el PDF no tiene texto (escaneado), saldrá vacío (no hacemos OCR aquí).
MIN_TEXT_LEN = 30


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
    # Normaliza espacios
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
        # intenta cortar en salto de línea cerca del final para no romper frases
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
        # opcional: un poco más determinista
        "options": {
            "temperature": 0.2,
            "top_p": 0.9,
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


def one_line(s: str) -> str:
    s = s.replace("\n", " ").replace("\r", " ")
    s = re.sub(r"\s+", " ", s).strip()
    return s


def summarize_pdf_text(text: str) -> str:
    chunks = chunk_text(text, MAX_CHARS_PER_CHUNK)

    # 1) Si hay muchos chunks, primero resumimos cada chunk a 1 línea
    partial_summaries = []
    if len(chunks) > 1:
        for i, ch in enumerate(chunks, 1):
            prompt = (
                "Eres un asistente que resume documentos.\n"
                "Devuelve SOLO una única línea (sin viñetas), en español, "
                "indicando de qué trata el texto.\n\n"
                f"FRAGMENTO {i}/{len(chunks)}:\n"
                f"{ch}\n\n"
                "Salida (una línea):"
            )
            partial = one_line(ollama_generate(prompt))
            partial_summaries.append(partial)

        # 2) Resumen final a partir de resúmenes parciales
        joined = " | ".join(partial_summaries)
        final_prompt = (
            "A partir de estos resúmenes parciales de un mismo PDF, "
            "genera un ÚNICO resumen final en UNA sola línea (sin viñetas), en español, "
            "explicando de qué trata el documento.\n\n"
            f"Resúmenes parciales:\n{joined}\n\n"
            "Salida (una línea):"
        )
        return one_line(ollama_generate(final_prompt))

    # Caso simple: un chunk
    prompt = (
        "Eres un asistente que resume documentos.\n"
        "Devuelve SOLO una única línea (sin viñetas), en español, "
        "indicando de qué trata el texto.\n\n"
        f"TEXTO:\n{text}\n\n"
        "Salida (una línea):"
    )
    return one_line(ollama_generate(prompt))


# ==========================
# MAIN
# ==========================
def main():
    if not os.path.isdir(PDF_DIR):
        raise SystemExit(f"No existe la carpeta: {PDF_DIR}")

    archivos = sorted(os.listdir(PDF_DIR))
    pdfs = [a for a in archivos if a.lower().endswith(".pdf")]

    if not pdfs:
        print("No hay PDFs en la carpeta ./pdf")
        return

    for archivo in pdfs:
        ruta = os.path.join(PDF_DIR, archivo)

        try:
            text = extract_pdf_text(ruta)

            if len(text) < MIN_TEXT_LEN:
                print(f"{archivo} -> (sin texto extraíble; probablemente escaneado o vacío)")
                continue

            resumen = summarize_pdf_text(text)
            print(f"{archivo} -> {resumen}")

        except Exception as e:
            print(f"{archivo} -> ERROR: {e}")


if __name__ == "__main__":
    main()
