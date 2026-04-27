#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
003-posts-md-per-product.py

Objetivo:
- Evitar parsing frágil tipo JSON / key=value.
- El LLM genera SOLO Markdown (un post por archivo).
- Python construye metadatos YAML front matter (título/fecha/categorías/tags/excerpt)
  de forma tolerante, sin depender de que el LLM respete un esquema rígido.

Pipeline por proyecto:
1) lightgoldenrodyellow.py -> reporte .md
2) Extrae FACTS desde TODO el .md (chunks) en formato texto (no JSON)
3) Genera N posts:
   - Python elige FACTS por post
   - LLM devuelve SOLO Markdown
   - Grounding: los facts aparecen en el Markdown (hits)
4) Guarda posts como .md

Edita SOLO constantes.
"""

from __future__ import annotations

import datetime as dt
import json
import re
import subprocess
import sys
from pathlib import Path
from typing import Any, Dict, List

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

OUTPUT_ROOT: str = "/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/posts-md"
POSTS_PER_PROJECT: int = 5

# Reintentos
MAX_FACTS_ATTEMPTS_PER_CHUNK: int = 2
MAX_MD_ATTEMPTS_PER_POST: int = 4

# Chunking / tamaños
FACTS_CHUNK_SIZE_CHARS: int = 12000
MAX_TOTAL_FACTS: int = 90
CONTEXT_PREVIEW_CHARS: int = 15000

# Grounding
FACTS_PER_POST: int = 6
MIN_FACT_HITS_PER_POST: int = 4

# Metadatos por defecto (si quieres, edita aquí)
DEFAULT_CATEGORIES: List[str] = ["Producto", "Gestión"]
DEFAULT_TAGS: List[str] = ["software", "gestión", "productividad", "equipo", "procesos"]

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
    s = (s or "").replace("\r\n", "\n")
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
    s = (s or "").replace("\r\n", "\n")
    return [s[i:i + chunk_size] for i in range(0, len(s), chunk_size)]

def word_count(s: str) -> int:
    return len(re.findall(r"\b\w+\b", s or ""))

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
# PROMPTS (SOLO MARKDOWN)
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
- NO devuelvas key=value.
- Devuelve SOLO Markdown (sin texto antes/después).
- NO uses bloques de código tipo ``` (no fences).
- Empieza el post con un H1: "# Título".
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

def prompt_write_markdown_post(
    project_slug: str,
    topic_hint: str,
    date_iso: str,
    facts_used: List[str],
    context_preview: str,
) -> str:
    facts_block = "\n".join([f"- {f}" for f in facts_used])

    return f"""
{base_rules(project_slug)}

Vas a escribir UN post en Markdown (700–1300 palabras aprox.).
Debe estar ligado a estos FACTS (inclúyelos en el texto literal o casi literal):
{facts_block}

Tema guía (no literal): {topic_hint}
Fecha de referencia: {date_iso}

Estructura requerida:
- Empieza con: # (título)
- Luego 1 párrafo de introducción.
- Luego H2/H3 y listas cuando toque.
- Incluye los FACTS dentro del cuerpo (literal o casi literal).
- Cierre con CTA suave de 1 línea.

VISTA PREVIA DEL REPORTE (solo para tono):
\"\"\"
{context_preview}
\"\"\"
""".strip()

def prompt_repair_markdown_post(
    project_slug: str,
    topic_hint: str,
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

Requisitos:
- SOLO Markdown (sin texto extra).
- Sin fences ``` (prohibido).
- Empieza con "# Título".
- 700–1300 palabras aprox.
- H2/H3 y listas.
- Cierre con CTA suave 1 línea.

Tema guía: {topic_hint}
Fecha: {date_iso}

SALIDA FALLIDA (no repetir):
\"\"\"
{(bad_answer or "")[:1200]}
\"\"\"

VISTA PREVIA:
\"\"\"
{context_preview}
\"\"\"
""".strip()

# =====================================================
# FACTS
# =====================================================
def parse_bulleted_facts(raw: str) -> List[str]:
    lines = [l.strip() for l in (raw or "").splitlines() if l.strip()]
    facts: List[str] = []
    for l in lines:
        if l.startswith(("- ", "* ")):
            facts.append(l[2:].strip())

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

    return dedupe_keep_order(all_facts, MAX_TOTAL_FACTS)

# =====================================================
# Markdown helpers (tolerantes)
# =====================================================
def strip_code_fences_if_any(md: str) -> str:
    md = (md or "").strip()
    if md.startswith("```"):
        md = re.sub(r"^```[a-zA-Z0-9_-]*\n?", "", md)
        md = re.sub(r"\n?```$", "", md)
    return md.strip()

def extract_title_from_markdown(md: str, fallback: str) -> str:
    for ln in (md or "").splitlines():
        s = ln.strip()
        if s.startswith("# "):
            t = normalize_space(s[2:])
            return (t[:140] if t else fallback)
    return fallback[:140]

def extract_excerpt_from_markdown(md: str, max_len: int = 220) -> str:
    # quita primer H1 y títulos; toma el primer párrafo “normal”
    lines = [l.strip() for l in (md or "").splitlines()]
    buf: List[str] = []
    for l in lines:
        if not l:
            if buf:
                break
            continue
        if l.startswith("#"):
            continue
        if l.startswith(("-", "*")):
            # si lo primero es lista, también vale como excerpt
            buf.append(l.lstrip("-* ").strip())
            if len(" ".join(buf)) > max_len:
                break
            continue
        buf.append(l)
        if len(" ".join(buf)) > max_len:
            break
    ex = normalize_space(" ".join(buf))
    return ex[:max_len]

def yaml_list(items: List[str]) -> str:
    # YAML inline list: ["a", "b"]
    esc = []
    for it in items:
        it = normalize_space(it)
        it = it.replace('"', '\\"')
        esc.append(f'"{it}"')
    return "[" + ", ".join(esc) + "]"

def build_front_matter(
    title: str,
    date_iso: str,
    categories: List[str],
    tags: List[str],
    excerpt: str,
) -> str:
    title = normalize_space(title).replace('"', '\\"')
    excerpt = normalize_space(excerpt).replace('"', '\\"')
    return (
        "---\n"
        f'title: "{title}"\n'
        f'date: "{date_iso}"\n'
        f"categories: {yaml_list(categories)}\n"
        f"tags: {yaml_list(tags)}\n"
        f'excerpt: "{excerpt}"\n'
        "---\n\n"
    )

def fact_hits(facts_used: List[str], md: str) -> int:
    c = (md or "").lower()
    hit = 0
    for f in facts_used:
        fs = normalize_space(f).lower()
        snip = fs[:80] if len(fs) > 80 else fs
        if snip and snip in c:
            hit += 1
    return hit

# =====================================================
# Posts generation
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
    picked: List[str] = []
    i = 0
    while len(picked) < FACTS_PER_POST and i < len(all_facts) * 2:
        picked.append(all_facts[(start + i) % len(all_facts)])
        i += 1
    return picked[:FACTS_PER_POST]

def generate_one_markdown_post(
    out_dir: Path,
    slug: str,
    ts: str,
    post_index: int,
    date_iso: str,
    facts_used: List[str],
    context_preview: str,
) -> str:
    topic_hint = TOPIC_HINTS[(post_index - 1) % len(TOPIC_HINTS)]
    last_raw = ""

    for attempt in range(1, MAX_MD_ATTEMPTS_PER_POST + 1):
        if attempt == 1:
            prompt = prompt_write_markdown_post(slug, topic_hint, date_iso, facts_used, context_preview)
        else:
            prompt = prompt_repair_markdown_post(
                slug, topic_hint, date_iso, facts_used, context_preview, last_raw, "grounding insuficiente o formato no válido"
            )

        raw = call_llm(prompt)
        last_raw = raw
        save_debug(out_dir, slug, ts, f"post{post_index:02d}_md_attempt{attempt}", raw)

        md = strip_code_fences_if_any(raw)

        # Validaciones suaves:
        # 1) Debe tener algo de cuerpo
        if word_count(md) < 350:
            eprint(f"   !! post {post_index:02d}: muy corto ({word_count(md)} palabras)")
            continue

        # 2) Grounding
        hits = fact_hits(facts_used, md)
        if hits < MIN_FACT_HITS_PER_POST:
            eprint(f"   !! post {post_index:02d}: grounding insuficiente (hits={hits})")
            continue

        # 3) Debe empezar con H1 (lo intentamos, si no, lo forzamos)
        if not md.lstrip().startswith("# "):
            forced_title = f"# {brand_from_slug(slug)}: guía práctica\n\n"
            md = forced_title + md

        return md

    # fallback
    return (
        f"# {brand_from_slug(slug)}: notas prácticas\n\n"
        "## Contenido no disponible\n\n"
        "No se pudo generar el contenido en este intento.\n"
    )

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

    posts_dir = out_dir / "posts" / ts
    posts_dir.mkdir(parents=True, exist_ok=True)

    eprint(f">> Generando {POSTS_PER_PROJECT} posts como .md (sin JSON)...")
    base_date = dt.date.today()

    manifest: List[Dict[str, Any]] = []

    for i in range(1, POSTS_PER_PROJECT + 1):
        date_iso = (base_date - dt.timedelta(days=i - 1)).isoformat()

        facts_used = pick_facts_for_post(facts, i)
        if len(facts_used) < FACTS_PER_POST:
            facts_used = (facts_used * FACTS_PER_POST)[:FACTS_PER_POST] if facts_used else []

        md_body = generate_one_markdown_post(out_dir, slug, ts, i, date_iso, facts_used, context_preview)

        title = extract_title_from_markdown(md_body, fallback=f"{brand_from_slug(slug)}: guía práctica")
        excerpt = extract_excerpt_from_markdown(md_body, max_len=220) or "Guía práctica y didáctica basada en el propio proyecto."

        front = build_front_matter(
            title=title,
            date_iso=date_iso,
            categories=DEFAULT_CATEGORIES,
            tags=DEFAULT_TAGS,
            excerpt=excerpt,
        )

        final_md = front + md_body.strip() + "\n"

        post_path = posts_dir / f"post_{i:02d}.md"
        save_text(post_path, final_md)

        manifest.append(
            {
                "slug": slug,
                "brand": brand_from_slug(slug),
                "date": date_iso,
                "file": str(post_path),
                "title": title,
                "facts_used": facts_used,
                "fact_hits": fact_hits(facts_used, md_body),
                "word_count": word_count(md_body),
            }
        )

    write_json(posts_dir / f"manifest_{ts}.json", manifest)
    print(f"[OK] {slug} POSTS MD: {posts_dir}")

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

