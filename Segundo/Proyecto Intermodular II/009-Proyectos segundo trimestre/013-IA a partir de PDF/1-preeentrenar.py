#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
Generador de pares Q/A (JSONL) a partir de PDFs.

Qué hace esta versión:
- Recorre recursivamente TODOS los PDFs dentro de la carpeta: pdf/
- Para cada PDF:
  1) Extrae texto y lo guarda como .txt “cacheado” en outputs/txt_cache/ (misma estructura)
  2) Trocea el texto en bloques con solape
  3) Lanza varias rondas (fáciles + avanzadas) a Ollama
  4) Va guardando sobre la marcha (bloque a bloque) en un JSONL por PDF en outputs/jsonl/
- Mantiene outputs/log.json para no reprocesar PDFs ya procesados.
  * Además, guarda mtime+size para reprocesar si el PDF cambia.
- Genera al final un informe Markdown con trazabilidad y listado de Q/A (solo de esta ejecución).

Requisitos:
  pip install requests beautifulsoup4 PyPDF2

Uso:
  1) Pon tus PDFs en ./pdf (puede haber subcarpetas)
  2) Arranca Ollama: ollama serve
  3) Ajusta MODEL_NAME si quieres
  4) Ejecuta: python3 pretrain_pdfs_to_qa.py
"""

import os
import re
import json
import time
import shutil
import requests
import platform
from datetime import datetime
from typing import List, Dict, Optional, Tuple

from PyPDF2 import PdfReader

# =========================
# CONFIGURACIÓN GENERAL
# =========================

PDF_DIR = "pdf"

OUTPUT_DIR = "outputs"
JSONL_DIR = os.path.join(OUTPUT_DIR, "jsonl")
TXT_CACHE_DIR = os.path.join(OUTPUT_DIR, "txt_cache")
REPORTS_DIR = os.path.join(OUTPUT_DIR, "reports")

LOG_FILE = os.path.join(OUTPUT_DIR, "log.json")

# Ollama
OLLAMA_BASE_URL = "http://localhost:11434"
MODEL_NAME = "llama3:latest"

OLLAMA_MODE: Optional[str] = None   # "chat" o "generate"
OLLAMA_URL: Optional[str] = None

# Troceado del texto
MAX_CHARS_PER_BLOCK = 2800
BLOCK_OVERLAP = 700

# Generación de Q/A
TEMPERATURE = 0.45
MAX_TOKENS = 1536

ROUNDS_EASY = 2
ROUNDS_ADVANCED = 3

VALID_EXTS = (".pdf",)


# =========================
# UTILIDADES
# =========================

def ensure_dirs():
    os.makedirs(PDF_DIR, exist_ok=True)
    os.makedirs(OUTPUT_DIR, exist_ok=True)
    os.makedirs(JSONL_DIR, exist_ok=True)
    os.makedirs(TXT_CACHE_DIR, exist_ok=True)
    os.makedirs(REPORTS_DIR, exist_ok=True)


def normalize_whitespace(text: str) -> str:
    return " ".join(text.split())


def split_into_blocks(text: str,
                      max_chars: int = MAX_CHARS_PER_BLOCK,
                      overlap: int = BLOCK_OVERLAP) -> List[str]:
    text = text.strip()
    if len(text) <= max_chars:
        return [text] if text else []

    blocks = []
    start = 0
    n = len(text)

    while start < n:
        end = min(start + max_chars, n)

        split_pos = end
        for sep in [".", "?", "!", "¿", "¡"]:
            pos = text.rfind(sep, start + int(max_chars * 0.6), end)
            if pos != -1 and pos > start:
                split_pos = max(split_pos, pos + 1)

        if split_pos == end:
            split_pos = end

        block = text[start:split_pos].strip()
        if block:
            blocks.append(block)

        if split_pos >= n:
            break

        start = max(0, split_pos - overlap)

    return blocks


def safe_relpath(path: str, base_dir: str) -> str:
    """
    Devuelve un path relativo normalizado (con /) para guardarlo en log y para mapear outputs.
    """
    rel = os.path.relpath(path, base_dir)
    rel = rel.replace("\\", "/")
    return rel


def rel_to_output_stem(rel_pdf: str) -> str:
    """
    Convierte un relpath tipo 'a/b/c.pdf' en un "stem" seguro para archivos de salida:
      'a__b__c'
    Evita colisiones entre PDFs con el mismo basename en carpetas distintas.
    """
    no_ext = os.path.splitext(rel_pdf)[0]
    stem = no_ext.replace("\\", "/").strip("/").replace("/", "__")
    if not stem:
        stem = "pdf"
    return stem


def file_signature(path: str) -> Dict[str, int]:
    """
    Firma barata para detectar cambios: mtime + size.
    """
    st = os.stat(path)
    return {"mtime": int(st.st_mtime), "size": int(st.st_size)}


# =========================
# EXTRACCIÓN PDF -> TXT
# =========================

def extract_text_from_pdf(path: str) -> str:
    try:
        reader = PdfReader(path)
    except Exception as e:
        print(f"[WARN] No se pudo abrir PDF {path}: {e}")
        return ""

    pages_text = []
    for i, page in enumerate(reader.pages):
        try:
            t = page.extract_text()
        except Exception as e:
            print(f"[WARN] Error extrayendo texto de la página {i} en {path}: {e}")
            t = None
        if t:
            pages_text.append(t)

    return "\n".join(pages_text)


def pdf_to_txt_cache(pdf_path: str, rel_pdf: str) -> str:
    """
    Convierte (extrae) PDF a TXT y lo guarda en outputs/txt_cache/<rel>.txt.
    Devuelve el path del .txt cacheado.
    """
    txt_rel = os.path.splitext(rel_pdf)[0] + ".txt"
    txt_path = os.path.join(TXT_CACHE_DIR, txt_rel.replace("/", os.sep))
    os.makedirs(os.path.dirname(txt_path), exist_ok=True)

    text = extract_text_from_pdf(pdf_path)
    text = text.strip()
    if text:
        with open(txt_path, "w", encoding="utf-8", errors="ignore") as f:
            f.write(text)
    else:
        # Aun si no hay texto, escribimos vacío para dejar trazabilidad
        with open(txt_path, "w", encoding="utf-8") as f:
            pass

    return txt_path


def prepare_blocks_for_pdf(pdf_path: str, rel_pdf: str) -> Tuple[List[str], str]:
    """
    Extrae PDF -> TXT cacheado, normaliza, y trocea en bloques.
    Devuelve (bloques, txt_cache_path).
    """
    print(f"\n[INFO] Preparando PDF: {pdf_path}")
    txt_cache_path = pdf_to_txt_cache(pdf_path, rel_pdf)

    try:
        with open(txt_cache_path, "r", encoding="utf-8", errors="ignore") as f:
            raw_text = f.read()
    except Exception as e:
        print(f"[WARN] No se pudo leer TXT cacheado {txt_cache_path}: {e}")
        raw_text = ""

    if not raw_text or not raw_text.strip():
        print("[WARN] PDF sin texto útil tras extracción (0 bloques).")
        return [], txt_cache_path

    text = normalize_whitespace(raw_text)
    if not text.strip():
        print("[WARN] Tras normalizar espacios el texto quedó vacío (0 bloques).")
        return [], txt_cache_path

    blocks = split_into_blocks(text)
    print(f"[INFO]   -> {len(blocks)} bloques detectados.")
    return blocks, txt_cache_path


# =========================
# LOG
# =========================

def load_log() -> Dict:
    """
    Estructura:
    {
      "processed": {
        "a/b/c.pdf": {"mtime": 123, "size": 456, "jsonl": "outputs/jsonl/...", "txt": "outputs/txt_cache/..."}
      }
    }
    """
    if not os.path.exists(LOG_FILE):
        return {"processed": {}}

    try:
        with open(LOG_FILE, "r", encoding="utf-8") as f:
            data = json.load(f)
        if "processed" not in data or not isinstance(data["processed"], dict):
            return {"processed": {}}
        return data
    except Exception:
        return {"processed": {}}


def save_log(log: Dict):
    with open(LOG_FILE, "w", encoding="utf-8") as f:
        json.dump(log, f, ensure_ascii=False, indent=2)


# =========================
# PROGRESO
# =========================

class ProgressTracker:
    def __init__(self, total_units: int):
        self.total = max(1, total_units)
        self.current = 0
        self.start_time = time.time()

    @staticmethod
    def _format_seconds(secs: float) -> str:
        secs = int(secs)
        h = secs // 3600
        m = (secs % 3600) // 60
        s = secs % 60
        if h > 0:
            return f"{h:02d}:{m:02d}:{s:02d}"
        return f"{m:02d}:{s:02d}"

    def update(self, step: int = 1, prefix: str = ""):
        self.current += step
        if self.current > self.total:
            self.current = self.total

        elapsed = time.time() - self.start_time
        percent = (self.current / self.total) * 100.0

        rate = (elapsed / self.current) if self.current > 0 else 0.0
        remaining = rate * (self.total - self.current) if self.current > 0 else 0.0

        try:
            term_width = shutil.get_terminal_size((80, 20)).columns
        except Exception:
            term_width = 80

        bar_len = max(10, term_width - 55)
        filled = int(bar_len * self.current / self.total)
        bar = "█" * filled + "░" * (bar_len - filled)

        msg = (
            f"{prefix} [{bar}] {percent:6.2f}% "
            f"| t+{self._format_seconds(elapsed)} "
            f"| ETA {self._format_seconds(remaining)}"
        )

        msg = msg[:term_width - 1]
        print("\r" + msg, end="", flush=True)

    def finish(self, prefix: str = ""):
        self.update(step=0, prefix=prefix)
        print()


# =========================
# OLLAMA
# =========================

def detect_ollama_mode() -> bool:
    global OLLAMA_MODE, OLLAMA_URL

    chat_url = f"{OLLAMA_BASE_URL}/api/chat"
    print(f"[INFO] Probando endpoint: {chat_url}")
    try:
        payload_chat = {
            "model": MODEL_NAME,
            "messages": [
                {"role": "system", "content": "Responde con una sola palabra: OK"},
                {"role": "user", "content": "OK"}
            ],
            "stream": False
        }
        resp = requests.post(chat_url, json=payload_chat, timeout=10)

        if resp.status_code != 404:
            resp.raise_for_status()
            data = resp.json()
            if "message" in data and "content" in data["message"]:
                print("[INFO] Endpoint /api/chat detectado correctamente.")
                OLLAMA_MODE = "chat"
                OLLAMA_URL = chat_url
                return True
            else:
                print("[WARN] /api/chat respondió pero no con el formato esperado.")
        else:
            print("[INFO] /api/chat devuelve 404, se probará /api/generate.")
    except requests.exceptions.ConnectionError:
        print(f"[ERROR] No se puede conectar a Ollama en {OLLAMA_BASE_URL}")
        print("       ¿Está arrancado? Ejecuta:  ollama serve")
        return False
    except Exception as e:
        print(f"[WARN] Error al probar /api/chat: {e}")

    gen_url = f"{OLLAMA_BASE_URL}/api/generate"
    print(f"[INFO] Probando endpoint: {gen_url}")
    try:
        payload_gen = {
            "model": MODEL_NAME,
            "prompt": "Responde con una sola palabra: OK",
            "stream": False
        }
        resp = requests.post(gen_url, json=payload_gen, timeout=10)

        if resp.status_code == 404:
            print("[ERROR] /api/generate también devuelve 404.")
            print("[ERROR] Ninguno de los endpoints estándar de Ollama está disponible.")
            print("       Modelo actual:", MODEL_NAME)
            return False

        resp.raise_for_status()
        data = resp.json()
        if "response" in data:
            print("[INFO] Endpoint /api/generate detectado correctamente.")
            OLLAMA_MODE = "generate"
            OLLAMA_URL = gen_url
            return True
        else:
            print("[WARN] /api/generate respondió pero no con el formato esperado.")
            return False
    except requests.exceptions.ConnectionError:
        print(f"[ERROR] No se puede conectar a Ollama en {OLLAMA_BASE_URL}")
        print("       ¿Está arrancado? Ejecuta:  ollama serve")
        return False
    except Exception as e:
        print(f"[ERROR] Error al probar /api/generate: {e}")
        return False


def call_ollama(system_prompt: str, user_prompt: str) -> str:
    if OLLAMA_MODE is None or OLLAMA_URL is None:
        raise RuntimeError("OLLAMA_MODE no está configurado. Llama antes a detect_ollama_mode().")

    if OLLAMA_MODE == "chat":
        payload = {
            "model": MODEL_NAME,
            "messages": [
                {"role": "system", "content": system_prompt},
                {"role": "user", "content": user_prompt},
            ],
            "stream": False,
            "options": {
                "temperature": TEMPERATURE,
                "num_predict": MAX_TOKENS
            }
        }
    elif OLLAMA_MODE == "generate":
        full_prompt = f"""{system_prompt.strip()}

Usuario:
{user_prompt.strip()}
"""
        payload = {
            "model": MODEL_NAME,
            "prompt": full_prompt,
            "stream": False,
            "options": {
                "temperature": TEMPERATURE,
                "num_predict": MAX_TOKENS
            }
        }
    else:
        raise RuntimeError(f"Modo de Ollama desconocido: {OLLAMA_MODE}")

    resp = requests.post(OLLAMA_URL, json=payload, timeout=300)
    resp.raise_for_status()
    data = resp.json()

    if OLLAMA_MODE == "chat":
        return data["message"]["content"]
    return data.get("response", "")


# =========================
# PROMPTS Q/A
# =========================

SYSTEM_PROMPT_QA = """
Eres un generador de preguntas y respuestas de alta calidad en español
para entrenar un modelo de lenguaje educativo.

Tu tarea:
- Leer con mucha atención un bloque de texto técnico o formativo en español.
- Identificar TODOS los conceptos importantes posibles.
- Generar el máximo número posible de preguntas y respuestas útiles para entrenamiento.

Reglas:
- No inventes conceptos.
- Respuestas completas pero concisas.
- Español neutro.
- Formato JSON Lines: cada línea un objeto JSON:
  {"question": "...", "answer": "..."}
- No añadas texto fuera de ese formato.
""".strip()


def build_user_prompt_easy(block: str, round_index: int = 1) -> str:
    return f"""
Genera PREGUNTAS FÁCILES (nivel introductorio) con sus respuestas a partir del siguiente texto.

Requisitos:
- Definición, propósito, pasos básicos, identificación, ventajas/desventajas claras.
- Genera AL MENOS 30 pares si el texto lo permite.
- Ronda {round_index}: no repitas literalmente preguntas de rondas anteriores; busca nuevos enfoques.

Formato OBLIGATORIO: JSON Lines, cada línea:
{{"question":"...","answer":"..."}}

Texto:
\"\"\"{block}\"\"\"
""".strip()


def build_user_prompt_advanced(block: str, round_index: int = 1) -> str:
    return f"""
Genera PREGUNTAS INTERMEDIAS y AVANZADAS con sus respuestas a partir del siguiente texto.

Requisitos:
- Razonamiento, comparación, casos prácticos, consecuencias, buenas prácticas, advertencias.
- Genera AL MENOS 30 pares si el texto lo permite.
- Ronda {round_index}: no repitas literalmente preguntas de rondas anteriores; busca nuevos ángulos.

Formato OBLIGATORIO: JSON Lines, cada línea:
{{"question":"...","answer":"..."}}

Texto:
\"\"\"{block}\"\"\"
""".strip()


# =========================
# PARSEO JSONL SEGURO
# =========================

def parse_jsonl_from_llm(text: str) -> List[Dict[str, str]]:
    pairs: List[Dict[str, str]] = []
    for raw_line in text.splitlines():
        line = raw_line.strip()
        if not line:
            continue
        if line.startswith("- "):
            line = line[2:].strip()
        if line.startswith("* "):
            line = line[2:].strip()

        if not (line.startswith("{") and line.endswith("}")):
            if "{" in line and "}" in line:
                line = line[line.find("{"):line.rfind("}") + 1]
            else:
                continue

        try:
            obj = json.loads(line)
        except json.JSONDecodeError:
            continue

        q = obj.get("question")
        a = obj.get("answer")
        if isinstance(q, str) and isinstance(a, str):
            q = q.strip()
            a = a.strip()
            if q and a:
                pairs.append({"question": q, "answer": a})

    return pairs


# =========================
# GENERACIÓN POR BLOQUE
# =========================

def generate_qa_for_block(block: str) -> List[Dict[str, str]]:
    all_pairs: List[Dict[str, str]] = []
    seen: set[Tuple[str, str]] = set()

    for r in range(1, ROUNDS_EASY + 1):
        try:
            easy_text = call_ollama(
                SYSTEM_PROMPT_QA,
                build_user_prompt_easy(block, round_index=r)
            )
            easy_pairs = parse_jsonl_from_llm(easy_text)

            for p in easy_pairs:
                key = (p["question"].strip().lower(), p["answer"].strip().lower())
                if key not in seen:
                    seen.add(key)
                    all_pairs.append(p)

        except Exception as e:
            print(f"\n[WARN] Error generando Q/A fáciles (ronda {r}): {e}")

    for r in range(1, ROUNDS_ADVANCED + 1):
        try:
            adv_text = call_ollama(
                SYSTEM_PROMPT_QA,
                build_user_prompt_advanced(block, round_index=r)
            )
            adv_pairs = parse_jsonl_from_llm(adv_text)

            for p in adv_pairs:
                key = (p["question"].strip().lower(), p["answer"].strip().lower())
                if key not in seen:
                    seen.add(key)
                    all_pairs.append(p)

        except Exception as e:
            print(f"\n[WARN] Error generando Q/A avanzadas (ronda {r}): {e}")

    return all_pairs


# =========================
# PROCESAR UN PDF
# =========================

def process_single_pdf(pdf_path: str,
                       rel_pdf: str,
                       jsonl_path: str,
                       blocks: List[str],
                       tracker: Optional[ProgressTracker],
                       file_index: int,
                       total_files: int) -> int:
    print(f"\n[INFO] Procesando PDF {file_index}/{total_files}: {pdf_path}")

    os.makedirs(os.path.dirname(jsonl_path), exist_ok=True)

    # Crear/limpiar salida
    with open(jsonl_path, "w", encoding="utf-8"):
        pass

    total_pairs_for_file = 0

    for block in blocks:
        block_pairs = generate_qa_for_block(block)

        if block_pairs:
            with open(jsonl_path, "a", encoding="utf-8") as f:
                for p in block_pairs:
                    f.write(json.dumps(p, ensure_ascii=False) + "\n")

        total_pairs_for_file += len(block_pairs)

        if tracker is not None:
            tracker.update(
                step=1,
                prefix=f"[PROGRESO] PDF {file_index}/{total_files}"
            )

    print(f"\n[INFO] Total pares Q/A para {os.path.basename(pdf_path)}: {total_pairs_for_file}")
    print(f"[INFO] JSONL generado: {jsonl_path}")
    return total_pairs_for_file


# =========================
# INFORME MARKDOWN
# =========================

def generate_markdown_report(
    processed_this_run: List[Dict],
    total_pairs_this_run: int,
    start_dt: datetime,
    end_dt: datetime,
) -> Optional[str]:
    if not processed_this_run:
        print("[INFO] No hay PDFs procesados en esta ejecución; no se generará informe Markdown.")
        return None

    duration = end_dt - start_dt
    epoch = int(end_dt.timestamp())
    timestamp_str = end_dt.strftime("%Y%m%d_%H%M%S")
    report_name = f"reporte_QA_pdfs_{timestamp_str}_{epoch}.md"
    report_path = os.path.join(REPORTS_DIR, report_name)

    system_info = {
        "Sistema operativo": platform.system(),
        "Versión del sistema": platform.version(),
        "Plataforma": platform.platform(),
        "Máquina": platform.machine(),
        "Procesador": platform.processor(),
        "Python": platform.python_version(),
        "Directorio de trabajo": os.getcwd(),
    }

    lines: List[str] = []
    lines.append("# Informe de generación de preguntas y respuestas (PDF)\n")
    lines.append("## Resumen de la ejecución\n")
    lines.append(f"- **Fecha/hora de inicio:** {start_dt.strftime('%Y-%m-%d %H:%M:%S')}")
    lines.append(f"- **Fecha/hora de finalización:** {end_dt.strftime('%Y-%m-%d %H:%M:%S')}")
    lines.append(f"- **Duración total:** {duration}")
    lines.append(f"- **Modelo de Ollama utilizado:** `{MODEL_NAME}`")
    lines.append(f"- **Modo del endpoint de Ollama:** `{OLLAMA_MODE}`")
    lines.append(f"- **URL base de Ollama:** `{OLLAMA_BASE_URL}`")
    lines.append(f"- **Endpoint efectivo:** `{OLLAMA_URL}`")
    lines.append(f"- **Total de PDFs procesados en esta ejecución:** {len(processed_this_run)}")
    lines.append(f"- **Total de pares Q/A generados en esta ejecución:** {total_pairs_this_run}")
    lines.append(f"- **Log global:** `{LOG_FILE}`")
    lines.append(f"- **Salida JSONL:** `{JSONL_DIR}`")
    lines.append(f"- **Cache TXT:** `{TXT_CACHE_DIR}`\n")

    lines.append("## Parámetros de configuración\n")
    lines.append(f"- **MAX_CHARS_PER_BLOCK:** {MAX_CHARS_PER_BLOCK}")
    lines.append(f"- **BLOCK_OVERLAP:** {BLOCK_OVERLAP}")
    lines.append(f"- **TEMPERATURE:** {TEMPERATURE}")
    lines.append(f"- **MAX_TOKENS (num_predict):** {MAX_TOKENS}")
    lines.append(f"- **ROUNDS_EASY:** {ROUNDS_EASY}")
    lines.append(f"- **ROUNDS_ADVANCED:** {ROUNDS_ADVANCED}\n")

    lines.append("## Información del sistema\n")
    for k, v in system_info.items():
        lines.append(f"- **{k}:** {v}")
    lines.append("")

    lines.append("## Índice de PDFs procesados\n")
    for idx, item in enumerate(processed_this_run, start=1):
        lines.append(f"- [PDF {idx}: `{item['rel_pdf']}`](#pdf-{idx})")
    lines.append("")

    for idx, item in enumerate(processed_this_run, start=1):
        rel_pdf = item["rel_pdf"]
        pdf_path = item["pdf_path"]
        jsonl_path = item["jsonl_path"]
        txt_path = item["txt_path"]

        lines.append(f"<a name=\"pdf-{idx}\"></a>")
        lines.append(f"## PDF {idx}: `{rel_pdf}`\n")
        lines.append(f"- **Entrada:** `{pdf_path}`")
        lines.append(f"- **TXT cacheado:** `{txt_path}`")
        lines.append(f"- **JSONL:** `{jsonl_path}`")

        pairs: List[Dict[str, str]] = []
        if os.path.exists(jsonl_path):
            try:
                with open(jsonl_path, "r", encoding="utf-8") as f:
                    for line in f:
                        line = line.strip()
                        if not line:
                            continue
                        try:
                            obj = json.loads(line)
                        except json.JSONDecodeError:
                            continue
                        q = obj.get("question")
                        a = obj.get("answer")
                        if isinstance(q, str) and isinstance(a, str):
                            pairs.append({"question": q, "answer": a})
            except Exception as e:
                lines.append(f"- **Aviso:** no se pudo leer el JSONL (`{e}`)")

        lines.append(f"- **Total de pares Q/A en este PDF:** {len(pairs)}\n")

        if pairs:
            lines.append("### Detalle de preguntas y respuestas\n")
            for i, p in enumerate(pairs, start=1):
                lines.append(f"**{i}. Pregunta:** {p['question']}")
                lines.append(f"   - **Respuesta:** {p['answer']}\n")
        else:
            lines.append("_Este PDF no contiene pares Q/A (JSONL vacío o ilegible)._")
            lines.append("")

    with open(report_path, "w", encoding="utf-8") as f:
        f.write("\n".join(lines))

    print(f"\n[INFO] Informe Markdown generado: {report_path}")
    return report_path


# =========================
# MAIN
# =========================

def main():
    ensure_dirs()

    start_dt = datetime.now()

    print("[INFO] Comprobando servicio de Ollama y detectando endpoint...")
    if not detect_ollama_mode():
        print("[FATAL] No se ha podido detectar un endpoint válido de Ollama. Abortando.")
        return

    # Recolectar PDFs
    pdf_files: List[str] = []
    for root, _, files in os.walk(PDF_DIR):
        for fn in files:
            if fn.lower().endswith(VALID_EXTS):
                pdf_files.append(os.path.join(root, fn))

    if not pdf_files:
        print(f"[INFO] No se han encontrado PDFs en {PDF_DIR}.")
        return

    pdf_files = sorted(pdf_files)

    log = load_log()
    processed_map: Dict[str, Dict] = log.get("processed", {})

    # Determinar pendientes (nuevo o cambiado)
    pending: List[Tuple[str, str]] = []
    skipped = 0

    for pdf_path in pdf_files:
        rel_pdf = safe_relpath(pdf_path, PDF_DIR)
        sig = file_signature(pdf_path)
        old = processed_map.get(rel_pdf)
        if old and old.get("mtime") == sig["mtime"] and old.get("size") == sig["size"]:
            skipped += 1
            continue
        pending.append((pdf_path, rel_pdf))

    if not pending:
        print("[INFO] Todos los PDFs ya estaban procesados y no han cambiado según log.json.")
        print(f"[INFO] Log: {LOG_FILE}")
        return

    # Primera pasada: preparar bloques y contar total global
    print("\n[INFO] Calculando número total de bloques para la barra de progreso global...")
    file_blocks_map: Dict[str, List[str]] = {}
    file_txt_map: Dict[str, str] = {}
    total_blocks = 0

    for pdf_path, rel_pdf in pending:
        blocks, txt_cache_path = prepare_blocks_for_pdf(pdf_path, rel_pdf)
        file_blocks_map[rel_pdf] = blocks
        file_txt_map[rel_pdf] = txt_cache_path
        total_blocks += len(blocks)

    if total_blocks == 0:
        print("[WARN] No se han encontrado bloques de texto útiles en los PDFs pendientes.")
        # Aun así actualizamos log con firma y rutas (JSONL vacío)
        processed_this_run: List[Dict] = []
        for pdf_path, rel_pdf in pending:
            stem = rel_to_output_stem(rel_pdf)
            jsonl_path = os.path.join(JSONL_DIR, f"{stem}.jsonl")
            os.makedirs(os.path.dirname(jsonl_path), exist_ok=True)
            with open(jsonl_path, "w", encoding="utf-8"):
                pass

            sig = file_signature(pdf_path)
            processed_map[rel_pdf] = {
                **sig,
                "jsonl": jsonl_path,
                "txt": file_txt_map.get(rel_pdf, ""),
            }
            processed_this_run.append({
                "pdf_path": pdf_path,
                "rel_pdf": rel_pdf,
                "jsonl_path": jsonl_path,
                "txt_path": file_txt_map.get(rel_pdf, ""),
            })

        log["processed"] = processed_map
        save_log(log)

        end_dt = datetime.now()
        generate_markdown_report(
            processed_this_run=processed_this_run,
            total_pairs_this_run=0,
            start_dt=start_dt,
            end_dt=end_dt,
        )
        return

    tracker = ProgressTracker(total_blocks)

    total_pairs = 0
    processed_this_run: List[Dict] = []

    print(f"[INFO] Total de bloques a procesar: {total_blocks}")
    print("[INFO] Iniciando generación de Q/A con barra de progreso global...\n")

    for idx, (pdf_path, rel_pdf) in enumerate(pending, start=1):
        stem = rel_to_output_stem(rel_pdf)
        jsonl_path = os.path.join(JSONL_DIR, f"{stem}.jsonl")

        blocks = file_blocks_map.get(rel_pdf, [])
        pairs_count = process_single_pdf(
            pdf_path=pdf_path,
            rel_pdf=rel_pdf,
            jsonl_path=jsonl_path,
            blocks=blocks,
            tracker=tracker,
            file_index=idx,
            total_files=len(pending)
        )
        total_pairs += pairs_count

        sig = file_signature(pdf_path)
        processed_map[rel_pdf] = {
            **sig,
            "jsonl": jsonl_path,
            "txt": file_txt_map.get(rel_pdf, ""),
        }
        log["processed"] = processed_map
        save_log(log)

        processed_this_run.append({
            "pdf_path": pdf_path,
            "rel_pdf": rel_pdf,
            "jsonl_path": jsonl_path,
            "txt_path": file_txt_map.get(rel_pdf, ""),
        })

    tracker.finish(prefix="[PROGRESO]")

    end_dt = datetime.now()

    print("\n[RESUMEN]")
    print(f"PDFs encontrados                 : {len(pdf_files)}")
    print(f"PDFs ya procesados (skip)        : {skipped}")
    print(f"PDFs procesados en esta run      : {len(pending)}")
    print(f"Pares Q/A generados en esta run  : {total_pairs}")
    print(f"Log                              : {LOG_FILE}")
    print(f"JSONL en                         : {JSONL_DIR}")
    print(f"TXT cache en                     : {TXT_CACHE_DIR}")

    generate_markdown_report(
        processed_this_run=processed_this_run,
        total_pairs_this_run=total_pairs,
        start_dt=start_dt,
        end_dt=end_dt,
    )


if __name__ == "__main__":
    main()

