#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
003-posts-fill-fields.py

Estrategia robusta:
- Python construye el JSON final.
- El LLM SOLO rellena campos concretos por post (NO genera JSON completo).

Pipeline por proyecto:
1) lightgoldenrodyellow.py -> reporte .md
2) Extrae FACTS desde TODO el .md (chunks) en formato texto (no JSON)
3) Genera 5 posts:
   - Python elige 6 facts por post
   - LLM devuelve SOLO campos (title/excerpt/categories/tags/content) en formato key=value
   - Verificación grounding (los facts aparecen en content) + reintentos
4) Guarda posts en JSON

Edita SOLO constantes.
"""

from __future__ import annotations

import datetime as dt
import json
import re
import subprocess
import sys
from pathlib import Path
from typing import Any, Dict, List, Tuple

import requests
import urllib3

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

# =====================================================
# EDITA SOLO CONSTANTES
# =====================================================
PROJECT_FOLDERS: List[str] = [
"/var/www/html/jocarsa-teal/",
    "/var/www/html/jocarsa-rosybrown/",
    "/var/www/html/jocarsa-salmon/",
    "/var/www/html/jocarsa-darksalmon/",
    "/var/www/html/jocarsa-aliceblue/",
    "/var/www/html/jocarsa-mediumseagreen/",
]

OUTPUT_ROOT: str = "/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/posts"
POSTS_PER_PROJECT: int = 5

# Reintentos
MAX_FACTS_ATTEMPTS_PER_CHUNK: int = 2
MAX_FIELDS_ATTEMPTS_PER_POST: int = 4

# Chunking / tamaños
FACTS_CHUNK_SIZE_CHARS: int = 12000
MAX_TOTAL_FACTS: int = 90
CONTEXT_PREVIEW_CHARS: int = 15000

# Grounding
FACTS_PER_POST: int = 6
MIN_FACT_HITS_PER_POST: int = 4

# --- LIGHTGOLDENRODYELLOW ---
LIGHTGOLDENRODYELLOW: str = "/var/www/html/jocarsa-lightgoldenrodyellow/lightgoldenrodyellow.py"

# --- LLM MODE ---
USE_REMOTE_API: bool = True

# (A) REMOTO
API_URL: str = "https://covalently-untasked-d****.ngrok-free.dev/api.php"
API_KEY: str = "TEST_API_KEY_JOCARSA_123"
VERIFY_SSL: bool = False
REMOTE_MODEL: str = "qwen2.5:7b-instruct-q4_0"

# (B) LOCAL
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

def save_text(path: Path, content: str) -> None:
    path.write_text(content, encoding="utf-8", errors="replace")

def save_debug(out_dir: Path, slug: str, ts: str, label: str, content: str) -> Path:
    p = out_dir / f"{slug}_{ts}_{label}.txt"
    save_text(p, content)
    return p

def safe_str(x: Any, default: str = "") -> str:
    if x is None:
        return default
    s = str(x).strip()
    return s if s else default

def dedupe_keep_order(items: List[str], max_items: int) -> List[str]:
    seen = set()
    out = []
    for it in items:
        s = normalize_space(it).strip()
        if not s:
            continue
        k = s.lower()
        if k in seen:
            continue
        seen.add(k)
        out.append(s)
        if len(out) >= max_items:
            break
    return out

def chunk_text(s: str, chunk_size: int) -> List[str]:
    s = s.replace("\r\n", "\n")
    return [s[i:i + chunk_size] for i in range(0, len(s), chunk_size)]

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
# LLM CALLS
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
    return (data.get("response") or "").strip()

def call_llm(prompt: str) -> str:
    if USE_REMOTE_API:
        return call_remote_api(prompt, timeout=1200)
    return call_ollama_local(prompt)

# =====================================================
# PROMPTS (NO JSON)
# =====================================================
def base_rules(project_slug: str) -> str:
    brand = brand_from_slug(project_slug)
    return f"""
Eres redactor técnico-comercial (SaaS). Español.
Producto: "{brand}" (slug: "{project_slug}").

Estilo:
- Didáctico e informativo, con beneficios reales.
- Comercial muy suave (sin exageraciones).
- Evita jerga de desarrolladores salvo lo imprescindible.
- Evita “optimizar/optimización”.

IMPORTANTE:
- NO devuelvas JSON.
- Devuelve SOLO el bloque de campos key=value exactamente como se pide.
""".strip()

def prompt_extract_facts(chunk: str, project_slug: str) -> str:
    return f"""
{base_rules(project_slug)}

Extrae hechos concretos (12–20) del texto. Devuelve SOLO líneas, una por hecho.
Cada línea debe empezar por "- " (guion + espacio).
Máx 160 caracteres por línea.
No inventes.

TEXTO:
\"\"\"
{chunk}
\"\"\"
""".strip()

def prompt_fill_post_fields(
    project_slug: str,
    topic_hint: str,
    date_iso: str,
    facts_used: List[str],
    context_preview: str,
) -> str:
    brand = brand_from_slug(project_slug)
    facts_block = "\n".join([f"- {f}" for f in facts_used])

    return f"""
{base_rules(project_slug)}

Vas a escribir UN post. Debe estar ligado a estos FACTS (inclúyelos en el texto literal o casi literal):
{facts_block}

Tema guía (no literal): {topic_hint}

Devuelve EXACTAMENTE este formato (sin texto extra):

title=...
date={date_iso}
categories=cat1, cat2
tags=tag1, tag2, tag3
excerpt=...
content=
<<<
(Markdown 700–1300 palabras con H2/H3 y listas; incluye los FACTS; cierre con CTA suave de 1 línea)
>>>

VISTA PREVIA DEL REPORTE (solo para tono):
\"\"\"
{context_preview}
\"\"\"
""".strip()

def prompt_repair_post_fields(
    project_slug: str,
    date_iso: str,
    facts_used: List[str],
    context_preview: str,
    bad_answer: str,
    reason: str,
) -> str:
    facts_block = "\n".join([f"- {f}" for f in facts_used])
    return f"""
{base_rules(project_slug)}

Tu salida anterior no cumple ({reason}). Corrige.

FACTS obligatorios a incluir (literal o casi literal):
{facts_block}

Devuelve EXACTAMENTE:

title=...
date={date_iso}
categories=cat1, cat2
tags=tag1, tag2, tag3
excerpt=...
content=
<<<
(Markdown 700–1300 palabras con H2/H3 y listas; incluye los FACTS; cierre CTA suave 1 línea)
>>>

SALIDA FALLIDA (no repetir):
\"\"\"
{bad_answer[:1200]}
\"\"\"

VISTA PREVIA:
\"\"\"
{context_preview}
\"\"\"
""".strip()

# =====================================================
# FACTS: parse line list
# =====================================================
def parse_bulleted_facts(raw: str) -> List[str]:
    lines = [l.strip() for l in (raw or "").splitlines() if l.strip()]
    facts = []
    for l in lines:
        if l.startswith(("- ", "* ")):
            facts.append(l[2:].strip())
    # fallback: si no hay bullets, intenta líneas sueltas
    if len(facts) < 6:
        facts = [l[:160] for l in lines[:30]]
    facts = [normalize_space(f)[:160] for f in facts if f]
    return facts

def extract_facts_from_full_md(report_md: str, out_dir: Path, slug: str, ts: str) -> List[str]:
    chunks = chunk_text(report_md, FACTS_CHUNK_SIZE_CHARS)
    all_facts: List[str] = []

    for idx, ch in enumerate(chunks, start=1):
        for attempt in range(1, MAX_FACTS_ATTEMPTS_PER_CHUNK + 1):
            raw = call_llm(prompt_extract_facts(ch, slug))
            save_debug(out_dir, slug, ts, f"facts_chunk{idx:02d}_attempt{attempt}", raw)
            facts = parse_bulleted_facts(raw)
            if len(facts) >= 6:
                all_facts.extend(facts)
                break
            else:
                eprint(f"   !! facts chunk {idx}: pocos hechos ({len(facts)})")

    merged = dedupe_keep_order(all_facts, MAX_TOTAL_FACTS)
    return merged

# =====================================================
# Parse key=value block (NO JSON)
# =====================================================
FIELD_RX = re.compile(
    r"^title=(?P<title>.*)\n"
    r"date=(?P<date>.*)\n"
    r"categories=(?P<categories>.*)\n"
    r"tags=(?P<tags>.*)\n"
    r"excerpt=(?P<excerpt>.*)\n"
    r"content=\n<<<\n(?P<content>[\s\S]*?)\n>>>\s*$",
    re.MULTILINE
)

def parse_fields_block(raw: str) -> Dict[str, Any]:
    raw = (raw or "").strip()
    m = FIELD_RX.search(raw)
    if not m:
        raise ValueError("No coincide el formato key=value esperado.")

    title = normalize_space(m.group("title"))
    date = normalize_space(m.group("date"))
    cats = [normalize_space(x) for x in m.group("categories").split(",") if normalize_space(x)]
    tags = [normalize_space(x) for x in m.group("tags").split(",") if normalize_space(x)]
    excerpt = normalize_space(m.group("excerpt"))
    content = m.group("content").strip()

    # normalizaciones mínimas
    cats = cats[:6] if cats else ["Producto", "Gestión"]
    tags = tags[:10] if tags else ["software", "gestión", "productividad"]

    return {
        "title": title[:140] if title else "Artículo",
        "date": date,
        "categories": cats,
        "tags": tags,
        "excerpt": excerpt[:220],
        "content": content
    }

def fact_hits(facts_used: List[str], content: str) -> int:
    c = (content or "").lower()
    hit = 0
    for f in facts_used:
        fs = normalize_space(f).lower()
        snip = fs[:80] if len(fs) > 80 else fs
        if snip and snip in c:
            hit += 1
    return hit

# =====================================================
# Posts generation (Python schema + LLM fills)
# =====================================================
TOPIC_HINTS = [
    "Qué problema real resuelve y cuándo se nota en el día a día",
    "Cómo mejorar la visibilidad y el seguimiento sin fricción",
    "Buenas prácticas para implantar la herramienta con el equipo",
    "Errores comunes que evita (información dispersa, duplicidades, etc.)",
    "Cómo convertir datos/estado en decisiones más tranquilas",
]

def pick_facts_for_post(all_facts: List[str], post_index: int) -> List[str]:
    if not all_facts:
        return []
    start = (post_index * FACTS_PER_POST) % max(1, len(all_facts))
    picked = []
    i = 0
    while len(picked) < FACTS_PER_POST and i < len(all_facts) * 2:
        picked.append(all_facts[(start + i) % len(all_facts)])
        i += 1
    return picked[:FACTS_PER_POST]

def build_post_schema(project_slug: str, date_iso: str, facts_used: List[str]) -> Dict[str, Any]:
    return {
        "slug": project_slug,
        "brand": brand_from_slug(project_slug),
        "date": date_iso,
        "title": "",
        "categories": [],
        "tags": [],
        "excerpt": "",
        "facts_used": facts_used,
        "content": ""
    }

def fill_one_post(
    out_dir: Path,
    slug: str,
    ts: str,
    post_index: int,
    date_iso: str,
    facts_used: List[str],
    context_preview: str
) -> Dict[str, Any]:
    topic_hint = TOPIC_HINTS[(post_index - 1) % len(TOPIC_HINTS)]
    last_raw = ""

    for attempt in range(1, MAX_FIELDS_ATTEMPTS_PER_POST + 1):
        if attempt == 1:
            prompt = prompt_fill_post_fields(slug, topic_hint, date_iso, facts_used, context_preview)
        else:
            prompt = prompt_repair_post_fields(slug, date_iso, facts_used, context_preview, last_raw, "formato inválido o grounding insuficiente")

        raw = call_llm(prompt)
        last_raw = raw
        save_debug(out_dir, slug, ts, f"post{post_index:02d}_fields_attempt{attempt}", raw)

        try:
            fields = parse_fields_block(raw)

            # grounding check
            hits = fact_hits(facts_used, fields["content"])
            if hits < MIN_FACT_HITS_PER_POST:
                raise ValueError(f"grounding insuficiente: hits={hits}")

            post = build_post_schema(slug, date_iso, facts_used)
            post.update(fields)
            return post
        except Exception as ex:
            eprint(f"   !! post {post_index:02d}: {ex}")
            continue

    # fallback minimal si un post falla
    post = build_post_schema(slug, date_iso, facts_used)
    post.update({
        "title": f"Notas prácticas sobre {brand_from_slug(slug)}",
        "categories": ["Producto", "Gestión"],
        "tags": ["software", "gestión", "equipo"],
        "excerpt": "Guía práctica y didáctica basada en el propio proyecto.",
        "content": "## Contenido no disponible\n\nNo se pudo generar el contenido en este intento.\n"
    })
    return post

# =====================================================
# PROCESS
# =====================================================
def process_one_project(project_path: Path, output_root: Path) -> None:
    ts = dt.datetime.now().strftime("%Y%m%d%H%M%S")
    slug = slugify(project_path.name)

    out_dir = output_root / slug
    out_dir.mkdir(parents=True, exist_ok=True)

    eprint(f"\n=== {slug} ===")
    eprint(f">> Proyecto: {project_path}")
    eprint(f">> Output: {out_dir}")
    eprint(f">> LLM: {'REMOTE_API ' + REMOTE_MODEL if USE_REMOTE_API else 'OLLAMA ' + OLLAMA_MODEL}")

    report_path = run_lightgoldenrodyellow(project_path, out_dir, LIGHTGOLDENRODYELLOW)
    report_text = read_text(report_path)
    eprint(f">> Reporte: {report_path} ({len(report_text)} chars)")

    context_preview = normalize_space(report_text)[:CONTEXT_PREVIEW_CHARS]
    save_text(out_dir / f"{slug}_{ts}_context_preview.txt", context_preview)

    eprint(">> Extrayendo FACTS (texto) desde TODO el .md (chunks)...")
    facts = extract_facts_from_full_md(report_text, out_dir, slug, ts)
    write_json(out_dir / f"{slug}_{ts}_facts.json", facts)
    eprint(f">> FACTS: {len(facts)}")

    # Generar posts
    posts: List[Dict[str, Any]] = []
    base_date = dt.date.today()

    posts_dir = out_dir / "posts" / ts
    posts_dir.mkdir(parents=True, exist_ok=True)

    eprint(f">> Generando {POSTS_PER_PROJECT} posts (relleno de campos, no JSON)...")
    for i in range(1, POSTS_PER_PROJECT + 1):
        date_iso = (base_date - dt.timedelta(days=i - 1)).isoformat()
        facts_used = pick_facts_for_post(facts, i)
        if len(facts_used) < FACTS_PER_POST:
            # si hay pocos facts, repetimos lo que haya
            facts_used = (facts_used * FACTS_PER_POST)[:FACTS_PER_POST] if facts_used else []

        post = fill_one_post(out_dir, slug, ts, i, date_iso, facts_used, context_preview)
        posts.append(post)
        write_json(posts_dir / f"post_{i:02d}.json", post)

    write_json(posts_dir / f"posts_{ts}.json", posts)
    print(f"[OK] {slug} POSTS: {posts_dir}")

# =====================================================
# MAIN
# =====================================================
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

