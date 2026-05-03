import os
import json
import time
import requests

# ---------------- CONFIG ----------------
TXT_FOLDER = "txt"
OUT_FOLDER = "summaries"
OUT_JSONL = os.path.join(OUT_FOLDER, "summaries.jsonl")

OLLAMA_URL = "http://localhost:11434/api/generate"
MODEL = "qwen2.5:3b-instruct"   # cambia a: ministral-3:3b / llama3.1:8b / deepseek-r1:1.5b / etc.

MAX_CHARS = 12000   # recorte de seguridad (evita prompts enormes)
SLEEP_SEC = 0.2     # pequeña pausa entre archivos
TIMEOUT = 300       # segundos
# ----------------------------------------


def summarize(text: str) -> str:
    text = (text or "").strip()
    if not text:
        return ""

    prompt = (
        "Resume en UN SOLO PÁRRAFO en español el siguiente texto. "
        "Sé fiel al contenido, sin inventar, y menciona el tema principal y puntos clave.\n\n"
        f"{text[:MAX_CHARS]}"
    )

    payload = {
        "model": MODEL,
        "prompt": prompt,
        "stream": False,
        "options": {
            "temperature": 0.2
        }
    }

    r = requests.post(OLLAMA_URL, json=payload, timeout=TIMEOUT)
    r.raise_for_status()
    return r.json().get("response", "").strip()


def main():
    if not os.path.isdir(TXT_FOLDER):
        raise SystemExit(f"No existe la carpeta '{TXT_FOLDER}'")

    os.makedirs(OUT_FOLDER, exist_ok=True)

    # Reinicia el jsonl para esta ejecución (si prefieres acumular, comenta estas 2 líneas)
    if os.path.exists(OUT_JSONL):
        os.remove(OUT_JSONL)

    archivos = sorted([f for f in os.listdir(TXT_FOLDER) if f.lower().endswith(".txt")])

    if not archivos:
        print(f"No hay .txt en '{TXT_FOLDER}'")
        return

    for i, archivo in enumerate(archivos, 1):
        ruta = os.path.join(TXT_FOLDER, archivo)

        try:
            with open(ruta, "r", encoding="utf-8", errors="ignore") as f:
                contenido = f.read()

            resumen = summarize(contenido)

            # Guardar resumen individual
            base = os.path.splitext(archivo)[0]
            out_file = os.path.join(OUT_FOLDER, base + ".summary.txt")
            with open(out_file, "w", encoding="utf-8") as f:
                f.write(resumen + "\n")

            # Guardar en JSONL (útil para dataset)
            record = {
                "file": archivo,
                "model": MODEL,
                "summary": resumen
            }
            with open(OUT_JSONL, "a", encoding="utf-8") as f:
                f.write(json.dumps(record, ensure_ascii=False) + "\n")

            print(f"[{i}/{len(archivos)}] OK -> {archivo}")

        except Exception as e:
            print(f"[{i}/{len(archivos)}] ERROR -> {archivo}: {e}")

        time.sleep(SLEEP_SEC)


if __name__ == "__main__":
    main()
