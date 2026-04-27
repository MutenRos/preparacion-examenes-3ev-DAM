#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
014-posts-comerciales-por-proyecto.py

Por cada carpeta de PROJECT_FOLDERS:
1) Ejecuta lightgoldenrodyellow.py -> reporte .md
2) Extrae contexto desde ese .md
3) Pide a Ollama (o tu api.php) 5 posts tipo blog (JSON)
4) Guarda:
   - posts_<ts>.json (array con 5 posts)
   - post_01.json ... post_05.json (uno por archivo)
   - debug_raw_attempt*.txt (respuestas crudas del modelo)
"""

from __future__ import annotations

import ast
import datetime as dt
import json
import re
import subprocess
import sys
from pathlib import Path
from typing import Any, Dict, List, Optional

import requests
import urllib3

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

# =====================================================
# EDITA SOLO CONSTANTES
# =====================================================
PROJECT_FOLDERS: List[str] = [
    "/var/www/html/jocarsa-darksalmon/",
    "/var/www/html/jocarsa-aliceblue/",
    "/var/www/html/jocarsa-salmon/",
    "/var/www/html/jocarsa-mediumseagreen/",
]

OUTPUT_ROOT: str = "/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/posts"
POSTS_PER_PROJECT: int = 5
MAX_ATTEMPTS: int = 4

# --- LIGHTGOLDENRODYELLOW ---
LIGHTGOLDENRODYELLOW: str = "/var/www/html/jocarsa-lightgoldenrodyellow/lightgoldenrodyellow.py"

# --- OLLAMA / API MODE ---
# Elige UNA:
USE_REMOTE_API: bool = True

# (A) REMOTO (tu api.php que llama a Ollama)
API_URL: str = "https://covalently-untasked-d****.ngrok-free.dev/api.php"
API_KEY: str = "TEST_API_KEY_JOCARSA_123"
VERIFY_SSL: bool = False
REMOTE_MODEL: str = "qwen2.5:7b-instruct-q4_0"

# (B) LOCAL (Ollama directo)
OLLAMA_URL: str = "http://127.0.0.1:11434/api/generate"
OLLAMA_MODEL: str = "llama3:latest"
OLLAMA_TIMEOUT: int = 900

# =====================================================
# UTIL
# =====================================================
def eprint(*args, **kwargs):
    print(*args, file=sys.stderr, **kwargs)

def slugify(s: str) -> str:
    s = s.lower().strip()
    s = re.sub(r"[^\w\s-]", "", s, flags=re.UNICODE)
    s = re.sub(r"[\s_-]+", "-", s)
    return s.strip("-") or "producto"

def brand_from_slug(project_slug: str) -> str:
    tail = project_slug.replace("jocarsa-", "").strip()
    return f"jocarsa | {tail}" if tail else "jocarsa"

def normalize_space(s: str) -> str:
    s = s.replace("\r\n", "\n")
    s = re.sub(r"[ \t]+", " ", s)
    s = re.sub(r"\n{3,}", "\n\n", s)
    return s.strip()

def read_text(p: Path) -> str:
    return p.read_text(encoding="utf-8", errors="replace")

def write_json(path: Path, obj: Any) -> None:
    path.write_text(json.dumps(obj, ensure_ascii=False, indent=2), encoding="utf-8", errors="replace")

def save_debug(out_dir: Path, slug: str, ts: str, label: str, content: str) -> Path:
    p = out_dir / f"{slug}_{ts}_{label}.txt"
    p.write_text(content, encoding="utf-8", errors="replace")
    return p

def safe_str(x: Any, default: str = "") -> str:
    if x is None:
        return default
    if isinstance(x, (int, float)):
        return str(x)
    s = str(x).strip()
    return s if s else default

def ensure_list(x: Any) -> List[Any]:
    if x is None:
        return []
    if isinstance(x, list):
        return x
    return [x]

# =====================================================
# TOLERANT PARSER (obj {...} o array [...])
# =====================================================
def strip_code_fences(s: str) -> str:
    s = s.strip()
    s = re.sub(r"^\s*```(?:json)?\s*", "", s, flags=re.IGNORECASE)
    s = re.sub(r"\s*```\s*$", "", s)
    return s.strip()

def quote_unquoted_keys(js_like: str) -> str:
    return re.sub(r'(?<=\{|,)\s*([A-Za-z_][A-Za-z0-9_-]*)\s*:', r'"\1":', js_like)

def remove_trailing_commas(js_like: str) -> str:
    return re.sub(r",\s*([}\]])", r"\1", js_like)

def fix_invalid_backslash_escapes(s: str) -> str:
    return re.sub(r'\\(?!["\\/bfnrtu]|u[0-9a-fA-F]{4})', r"\\\\", s)

def extract_first_json_blob(text: str) -> str:
    start = text.find("{")
    if start != -1:
        depth = 0
        for i in range(start, len(text)):
            c = text[i]
            if c == "{":
                depth += 1
            elif c == "}":
                depth -= 1
                if depth == 0:
                    return text[start:i + 1].strip()

    start = text.find("[")
    if start != -1:
        depth = 0
        for i in range(start, len(text)):
            c = text[i]
            if c == "[":
                depth += 1
            elif c == "]":
                depth -= 1
                if depth == 0:
                    return text[start:i + 1].strip()

    return ""

def parse_model_json(raw_answer: str) -> Any:
    blob = extract_first_json_blob(raw_answer)
    if not blob:
        raise ValueError("No se encontró un objeto/array JSON en la respuesta del modelo.")
    blob = strip_code_fences(blob)

    # 1) JSON directo
    try:
        return json.loads(blob)
    except Exception:
        pass

    # 2) reparaciones suaves
    blob2 = quote_unquoted_keys(blob)
    blob2 = remove_trailing_commas(blob2)
    blob2 = fix_invalid_backslash_escapes(blob2)

    try:
        return json.loads(blob2)
    except Exception:
        pass

    # 3) último recurso: literal_eval
    blob3 = re.sub(r"\btrue\b", "True", blob2, flags=re.IGNORECASE)
    blob3 = re.sub(r"\bfalse\b", "False", blob2, flags=re.IGNORECASE)
    blob3 = re.sub(r"\bnull\b", "None", blob2, flags=re.IGNORECASE)
    return ast.literal_eval(blob3)

# =====================================================
# CONTEXT EXTRACTION (desde el .md)
# =====================================================
def extract_html_signals(report_md: str) -> str:
    html_blocks = re.findall(r"```html\s*(.*?)```", report_md, flags=re.DOTALL | re.IGNORECASE)
    if not html_blocks:
        return ""
    html_joined = "\n".join(html_blocks[:4])

    def grab(rx: str) -> List[str]:
        return [normalize_space(x) for x in re.findall(rx, html_joined, flags=re.IGNORECASE | re.DOTALL)]

    titles = grab(r"<title[^>]*>(.*?)</title>")
    h1s = grab(r"<h1[^>]*>(.*?)</h1>")
    metas = grab(r'<meta[^>]*name=["\']description["\'][^>]*content=["\'](.*?)["\']')

    parts = []
    if titles:
        parts.append("TITLE: " + titles[0])
    if h1s:
        parts.append("H1: " + h1s[0])
    if metas:
        parts.append("META_DESCRIPTION: " + metas[0])

    return "\n".join(parts).strip()

def extract_marketing_context(report_md: str, max_chars: int = 9000) -> str:
    chunks: List[str] = []
    sig = extract_html_signals(report_md)
    if sig:
        chunks.append(sig)

    md_lines = []
    for line in report_md.splitlines():
        line = line.strip()
        if not line:
            continue
        if line.startswith("#") or line.startswith("- ") or line.startswith("* "):
            md_lines.append(line)
    if md_lines:
        chunks.append("\n".join(md_lines[:320]))

    chunks.append(report_md[:5200])
    return normalize_space("\n\n".join(chunks))[:max_chars]

# =====================================================
# LIGHTGOLDENRODYELLOW
# =====================================================
def run_lightgoldenrodyellow(project_path: Path, out_dir: Path, light_path: str) -> Path:
    lp = Path(light_path)
    if not lp.exists():
        raise FileNotFoundError(f"No existe lightgoldenrodyellow.py en: {lp}")
    out_dir.mkdir(parents=True, exist_ok=True)

    cmd = ["python3", str(lp), str(project_path), str(out_dir)]
    proc = subprocess.run(cmd, capture_output=True, text=True)

    if proc.returncode != 0:
        raise RuntimeError(f"lightgoldenrodyellow falló.\nSTDOUT:\n{proc.stdout}\nSTDERR:\n{proc.stderr}")

    m = re.search(r"^\[OK\]\s+Reporte generado:\s+(.*\.md)\s*$", proc.stdout, flags=re.MULTILINE)
    if m:
        rp = Path(m.group(1).strip()).expanduser()
        if rp.exists():
            return rp

    mm = re.search(r"(/[^ \n\r\t]+\.md)\b", proc.stdout)
    if mm:
        rp = Path(mm.group(1).strip()).expanduser()
        if rp.exists():
            return rp

    raise RuntimeError(f"No pude detectar la ruta del reporte en STDOUT:\n{proc.stdout}")

# =====================================================
# OLLAMA / REMOTE API CALL
# =====================================================
def call_remote_api(question: str, timeout: int = 1200) -> str:
    resp = requests.post(
        API_URL,
        headers={"X-API-Key": API_KEY},
        data={"question": question, "model": REMOTE_MODEL},
        timeout=timeout,
        verify=VERIFY_SSL,
    )
    if resp.status_code != 200:
        raise RuntimeError(f"API HTTP {resp.status_code}: {resp.text}")
    data = resp.json()
    ans = data.get("answer")
    if not ans:
        raise RuntimeError(f"API JSON sin 'answer': {data}")
    return ans.strip()

def call_ollama_local(prompt: str) -> str:
    payload = {"model": OLLAMA_MODEL, "prompt": prompt, "stream": False}
    r = requests.post(OLLAMA_URL, json=payload, timeout=OLLAMA_TIMEOUT)
    r.raise_for_status()
    data = r.json()
    ans = data.get("response") or ""
    return ans.strip()

def call_llm(prompt: str) -> str:
    if USE_REMOTE_API:
        return call_remote_api(prompt, timeout=1200)
    return call_ollama_local(prompt)

# =====================================================
# PROMPT: 5 POSTS JSON
# =====================================================
def base_rules(project_slug: str) -> str:
    brand = brand_from_slug(project_slug)
    return f"""
Eres redactor técnico y de producto (SaaS). Devuelve SOLO JSON válido (sin markdown, sin comentarios).
Idioma: español.

Objetivo:
- Crear posts tipo blog que promocionen BENEFICIOS de "{brand}" de forma sutil.
- Deben ser didácticos e informativos, no agresivamente comerciales.
- Evita jerga de desarrolladores (frameworks, patrones, etc.) salvo lo mínimo imprescindible.
- Evita palabras tipo "optimizar/optimización".

Formato requerido: un ARRAY JSON de {POSTS_PER_PROJECT} objetos.
""".strip()

def prompt_generate_posts(context: str, project_slug: str) -> str:
    brand = brand_from_slug(project_slug)
    today = dt.date.today().isoformat()
    return f"""
{base_rules(project_slug)}

Cada objeto del array debe tener EXACTAMENTE estas claves:
{{
  "title": "título atractivo (no clickbait)",
  "date": "YYYY-MM-DD",
  "categories": ["...", "..."],
  "tags": ["...", "...", "..."],
  "excerpt": "resumen 1-2 frases",
  "content": "Markdown con H2/H3, listas y un cierre suave con CTA (1 línea)."
}}

Reglas extra:
- Genera {POSTS_PER_PROJECT} posts DIFERENTES (temas distintos).
- Fechas: usa "{today}" y días anteriores (no futuro).
- Content: 600–1200 palabras aprox.
- Cierre CTA: muy suave (ej: “Si quieres ver cómo se aplica en tu caso, solicita una demo.”)

Producto/marca:
- slug: "{project_slug}"
- marca: "{brand}"

CONTEXTO (del análisis del proyecto):
\"\"\"
{context}
\"\"\"
""".strip()

# =====================================================
# FALLBACK DETERMINISTA (si el modelo rompe JSON)
# =====================================================
def deterministic_posts_fallback(project_slug: str) -> List[Dict[str, Any]]:
    brand = brand_from_slug(project_slug)
    base_date = dt.date.today()
    topics = [
        ("Cómo reducir fricción en el día a día sin cambiar tu forma de trabajar", ["Productividad", "Gestión"], ["procesos", "equipo", "claridad"]),
        ("De la desorganización a la visibilidad: señales que indican que necesitas un sistema", ["Organización", "Operaciones"], ["visibilidad", "tareas", "seguimiento"]),
        ("Buenas prácticas para implantar una herramienta sin resistencia interna", ["Adopción", "Gestión del cambio"], ["adopción", "hábitos", "equipo"]),
        ("Errores comunes al gestionar información ‘en mil sitios’ y cómo evitarlos", ["Información", "Procesos"], ["documentos", "control", "riesgos"]),
        ("Qué medir para tomar decisiones con calma (y no a ciegas)", ["Indicadores", "Dirección"], ["informes", "decisiones", "métricas"]),
    ]
    out: List[Dict[str, Any]] = []
    for i, (t, cats, tags) in enumerate(topics[:POSTS_PER_PROJECT], start=1):
        d = (base_date - dt.timedelta(days=i-1)).isoformat()
        content = (
            f"## {t}\n\n"
            f"En muchas organizaciones, el problema no es la falta de trabajo, sino la falta de **claridad**. "
            f"Cuando la información se reparte entre mensajes, hojas sueltas y recordatorios, lo normal es que aparezcan duplicidades, "
            f"retrasos y ‘apagafuegos’.\n\n"
            f"### Qué suele estar pasando\n"
            f"- Nadie tiene una visión completa del estado real.\n"
            f"- Las prioridades cambian según quién pregunte.\n"
            f"- Las tareas se hacen, pero no quedan registradas.\n\n"
            f"### Una forma práctica de mejorar\n"
            f"Un buen sistema ayuda a centralizar, ordenar y dar seguimiento sin obligarte a reinventar todo. "
            f"Lo importante es que el equipo pueda **ver**, **entender** y **actuar** con menos fricción.\n\n"
            f"### Dónde encaja {brand}\n"
            f"{brand} está pensado para aportar una capa de organización y visibilidad, manteniendo un uso sencillo y directo.\n\n"
            f"—\n"
            f"Si quieres ver cómo se aplicaría en tu caso, solicita una demo.\n"
        )
        out.append({
            "title": t,
            "date": d,
            "categories": cats,
            "tags": tags,
            "excerpt": "Ideas prácticas para ganar claridad y continuidad en el trabajo diario, sin complicar la operativa.",
            "content": content
        })
    return out

# =====================================================
# GENERACIÓN PRINCIPAL
# =====================================================
def generate_posts(out_dir: Path, project_slug: str, ts: str, context: str) -> List[Dict[str, Any]]:
    last_raw = ""
    for attempt in range(1, MAX_ATTEMPTS + 1):
        prompt = prompt_generate_posts(context, project_slug)
        raw = call_llm(prompt)
        last_raw = raw
        save_debug(out_dir, project_slug, ts, f"posts_raw_attempt{attempt}", raw)

        try:
            parsed = parse_model_json(raw)
            if not isinstance(parsed, list):
                raise ValueError("El JSON no es un array.")
            if len(parsed) < POSTS_PER_PROJECT:
                raise ValueError(f"El array trae {len(parsed)} posts, esperado {POSTS_PER_PROJECT}.")
            posts: List[Dict[str, Any]] = []
            for p in parsed[:POSTS_PER_PROJECT]:
                if not isinstance(p, dict):
                    continue
                posts.append({
                    "title": safe_str(p.get("title"), f"Post {len(posts)+1}"),
                    "date": safe_str(p.get("date"), dt.date.today().isoformat()),
                    "categories": [safe_str(x) for x in ensure_list(p.get("categories")) if safe_str(x)],
                    "tags": [safe_str(x) for x in ensure_list(p.get("tags")) if safe_str(x)],
                    "excerpt": safe_str(p.get("excerpt"), ""),
                    "content": safe_str(p.get("content"), ""),
                })
            if len(posts) < POSTS_PER_PROJECT:
                raise ValueError("No se pudieron normalizar suficientes posts.")
            return posts
        except Exception as ex:
            eprint(f"   !! posts: parse/validate error: {ex}")
            continue

    eprint("   !! posts: activando fallback determinista (sin LLM).")
    return deterministic_posts_fallback(project_slug)

def process_one_project(project_path: Path, output_root: Path) -> None:
    ts = dt.datetime.now().strftime("%Y%m%d%H%M%S")
    project_slug = slugify(project_path.name)

    out_dir = output_root / project_slug
    out_dir.mkdir(parents=True, exist_ok=True)

    eprint(f"\n=== {project_slug} ===")
    eprint(f">> Proyecto: {project_path}")
    eprint(f">> Output: {out_dir}")
    eprint(f">> LLM: {'REMOTE_API ' + REMOTE_MODEL if USE_REMOTE_API else 'OLLAMA ' + OLLAMA_MODEL}")

    report_path = run_lightgoldenrodyellow(project_path, out_dir, LIGHTGOLDENRODYELLOW)
    report_text = read_text(report_path)
    eprint(f">> Reporte: {report_path} ({len(report_text)} chars)")

    context = extract_marketing_context(report_text, max_chars=9000)
    (out_dir / f"{project_slug}_{ts}_context.txt").write_text(context, encoding="utf-8", errors="replace")

    eprint(f">> Generando {POSTS_PER_PROJECT} posts (JSON)...")
    posts = generate_posts(out_dir, project_slug, ts, context)

    # Carpeta de posts por timestamp (para no pisar)
    posts_dir = out_dir / "posts" / ts
    posts_dir.mkdir(parents=True, exist_ok=True)

    # Guardar array
    write_json(posts_dir / f"posts_{ts}.json", posts)

    # Guardar uno por uno
    for i, p in enumerate(posts, start=1):
        write_json(posts_dir / f"post_{i:02d}.json", p)

    print(f"[OK] {project_slug} POSTS: {posts_dir}")

def main():
    output_root = Path(OUTPUT_ROOT).expanduser().resolve()
    output_root.mkdir(parents=True, exist_ok=True)

    ok = skip = err = 0
    for p in PROJECT_FOLDERS:
        project_path = Path(p).expanduser().resolve()
        try:
            if not project_path.exists() or not project_path.is_dir():
                eprint(f"[SKIP] {project_path}")
                skip += 1
                continue
            process_one_project(project_path, output_root)
            ok += 1
        except Exception as ex:
            err += 1
            eprint(f"[ERROR] {project_path.name}: {ex}")

    eprint("\n=== RESUMEN ===")
    eprint(f"OK={ok}  SKIP={skip}  ERR={err}")
    if err > 0:
        sys.exit(1)

if __name__ == "__main__":
    main()

