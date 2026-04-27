#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
014-posts-comerciales-por-proyecto-grounded.py

Por cada carpeta de PROJECT_FOLDERS:
1) Ejecuta lightgoldenrodyellow.py -> reporte .md
2) Usa TODO el .md (en chunks) para extraer FACTS con LLM (map -> merge)
3) Genera 5 posts (JSON) obligando a usar hechos concretos (facts_used)
4) Verifica grounding; si no cumple, reintenta; si falla, fallback determinista
5) Guarda:
   - posts_<ts>.json (array con 5 posts)
   - post_01.json ... post_05.json
   - facts_<ts>.json (facts extraídos)
   - context_preview_<ts>.txt (primer chunk)
   - debug_raw_*.txt

Edita SOLO constantes.
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

# Reintentos:
MAX_FACTS_ATTEMPTS_PER_CHUNK: int = 2
MAX_POSTS_ATTEMPTS: int = 4

# Chunking / tamaños:
FACTS_CHUNK_SIZE_CHARS: int = 12000   # tamaño de chunk para extraer hechos
CONTEXT_PREVIEW_CHARS: int = 20000    # pequeño “preview” del MD (primeros chars) para tono
MAX_TOTAL_FACTS: int = 70             # cap total facts para el prompt de posts

# Grounding:
FACTS_USED_PER_POST: int = 6
MIN_FACT_SNIPPET_HITS_PER_POST: int = 4  # permite algo de variación

# --- LIGHTGOLDENRODYELLOW ---
LIGHTGOLDENRODYELLOW: str = "/var/www/html/jocarsa-lightgoldenrodyellow/lightgoldenrodyellow.py"

# --- LLM MODE: elige UNA ---
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

def save_text(path: Path, content: str) -> None:
    path.write_text(content, encoding="utf-8", errors="replace")

def save_debug(out_dir: Path, slug: str, ts: str, label: str, content: str) -> Path:
    p = out_dir / f"{slug}_{ts}_{label}.txt"
    save_text(p, content)
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
    ans = data.get("response") or ""
    return ans.strip()

def call_llm(prompt: str) -> str:
    if USE_REMOTE_API:
        return call_remote_api(prompt, timeout=1200)
    return call_ollama_local(prompt)

# =====================================================
# CHUNKING
# =====================================================
def chunk_text(s: str, chunk_size: int) -> List[str]:
    s = s.replace("\r\n", "\n")
    return [s[i:i + chunk_size] for i in range(0, len(s), chunk_size)]

# =====================================================
# PROMPTS
# =====================================================
def base_rules(project_slug: str) -> str:
    brand = brand_from_slug(project_slug)
    return f"""
Eres redactor técnico-comercial. Devuelve SOLO JSON válido (sin markdown, sin comentarios).
Idioma: español.
Producto: "{brand}" (slug: "{project_slug}").

Estilo:
- Informativo y didáctico, con orientación a beneficios.
- Comercial suave (sin exageraciones).
- Evita jerga de desarrolladores salvo lo imprescindible.
- Evita “optimizar/optimización”.
""".strip()

def prompt_extract_facts(chunk: str, project_slug: str) -> str:
    return f"""
{base_rules(project_slug)}

Tarea:
Extrae hechos concretos y verificables del texto (funcionalidades, pantallas, módulos, flujos, entidades,
rutas de archivos, endpoints, tablas, comandos, nombres propios del proyecto).
No inventes.

Devuelve SOLO un ARRAY JSON con 12 a 20 strings.
Cada string:
- máximo 160 caracteres
- debe ser “copiable” y específico

TEXTO:
\"\"\"
{chunk}
\"\"\"
""".strip()

def prompt_generate_posts(context_preview: str, facts: List[str], project_slug: str) -> str:
    today = dt.date.today().isoformat()
    facts_block = "\n".join([f"- {f}" for f in facts]) if facts else "- (no facts extracted)"

    return f"""
{base_rules(project_slug)}

OBLIGATORIO (grounding):
- Cada post DEBE usar exactamente {FACTS_USED_PER_POST} hechos del bloque FACTS.
- Incluye "facts_used" con EXACTAMENTE {FACTS_USED_PER_POST} strings (copiados desde FACTS).
- En "content", cada uno de esos {FACTS_USED_PER_POST} hechos debe aparecer (literal o casi literal).
- Si un hecho no encaja, elige otro.

Devuelve SOLO un ARRAY JSON de {POSTS_PER_PROJECT} objetos.
Cada objeto debe tener EXACTAMENTE estas claves:
{{
  "title": "título atractivo (no clickbait)",
  "date": "YYYY-MM-DD",
  "categories": ["...", "..."],
  "tags": ["...", "...", "..."],
  "excerpt": "resumen 1-2 frases",
  "facts_used": ["...", "...", "...", "...", "...", "..."],
  "content": "Markdown con H2/H3, listas y un cierre CTA suave (1 línea)."
}}

Restricciones:
- Fechas: usa "{today}" y días anteriores (no futuro).
- Content: 700–1300 palabras aprox.
- CTA: 1 línea, suave y práctica.

FACTS (extraídos del reporte):
{facts_block}

VISTA PREVIA DEL REPORTE (para tono, no para inventar):
\"\"\"
{context_preview}
\"\"\"
""".strip()

# =====================================================
# GROUNDING VALIDATION
# =====================================================
def fact_hit_count_in_content(facts_used: List[str], content: str) -> int:
    c = (content or "").lower()
    hit = 0
    for f in facts_used:
        fs = normalize_space(safe_str(f)).strip().lower()
        if not fs:
            continue
        # “literal o casi literal”: buscamos un fragmento significativo
        snippet = fs[:80] if len(fs) > 80 else fs
        if snippet and snippet in c:
            hit += 1
    return hit

def grounded_enough(post: Dict[str, Any]) -> bool:
    facts_used = ensure_list(post.get("facts_used"))
    if len(facts_used) != FACTS_USED_PER_POST:
        return False
    content = safe_str(post.get("content"), "")
    if len(content) < 400:
        return False
    hits = fact_hit_count_in_content([safe_str(x) for x in facts_used], content)
    return hits >= MIN_FACT_SNIPPET_HITS_PER_POST

# =====================================================
# FALLBACKS
# =====================================================
def deterministic_posts_fallback(project_slug: str) -> List[Dict[str, Any]]:
    brand = brand_from_slug(project_slug)
    base_date = dt.date.today()
    topics = [
        ("Qué señales indican que tu equipo necesita más visibilidad operativa", ["Organización", "Operaciones"], ["visibilidad", "equipo", "seguimiento"]),
        ("Cómo estandarizar tareas sin volver rígida la operativa", ["Procesos", "Productividad"], ["procesos", "hábitos", "claridad"]),
        ("Errores comunes al gestionar información repartida (y cómo reducirlos)", ["Información", "Gestión"], ["documentos", "control", "riesgos"]),
        ("Implantar una herramienta sin fricción: pasos realistas", ["Adopción", "Gestión del cambio"], ["adopción", "equipo", "rutinas"]),
        ("Indicadores prácticos para decidir con menos incertidumbre", ["Dirección", "Indicadores"], ["métricas", "informes", "prioridades"]),
    ]
    out: List[Dict[str, Any]] = []
    for i, (t, cats, tags) in enumerate(topics[:POSTS_PER_PROJECT], start=1):
        d = (base_date - dt.timedelta(days=i - 1)).isoformat()
        content = (
            f"## {t}\n\n"
            f"Cuando el trabajo crece, el problema suele ser la **claridad**: qué está en marcha, qué falta y quién lo está gestionando.\n\n"
            f"### Qué suele pasar\n"
            f"- Se pierde tiempo buscando el estado real.\n"
            f"- Se duplican tareas o se quedan a medias.\n"
            f"- La información se dispersa en varios sitios.\n\n"
            f"### Una mejora práctica\n"
            f"Centralizar la información y dar seguimiento reduce fricción, sin necesidad de cambiar todo de golpe.\n\n"
            f"### Dónde encaja {brand}\n"
            f"{brand} está pensado para aportar una base de organización y seguimiento con uso sencillo.\n\n"
            f"—\n"
            f"Si quieres ver cómo se aplicaría en tu caso, solicita una demo.\n"
        )
        out.append({
            "title": t,
            "date": d,
            "categories": cats,
            "tags": tags,
            "excerpt": "Ideas prácticas para ganar claridad y continuidad sin complicar la operativa.",
            "facts_used": [f"{brand} (slug: {project_slug})"] * FACTS_USED_PER_POST,
            "content": content
        })
    return out

# =====================================================
# FACTS EXTRACTION (map -> merge)
# =====================================================
def extract_facts_via_llm(report_md: str, out_dir: Path, project_slug: str, ts: str) -> List[str]:
    chunks = chunk_text(report_md, FACTS_CHUNK_SIZE_CHARS)
    all_facts: List[str] = []

    for idx, ch in enumerate(chunks, start=1):
        last_raw = ""
        for attempt in range(1, MAX_FACTS_ATTEMPTS_PER_CHUNK + 1):
            prompt = prompt_extract_facts(ch, project_slug)
            raw = call_llm(prompt)
            last_raw = raw
            save_debug(out_dir, project_slug, ts, f"facts_chunk{idx:02d}_raw_attempt{attempt}", raw)

            try:
                parsed = parse_model_json(raw)
                if not isinstance(parsed, list):
                    raise ValueError("facts: la salida no es un array")
                facts = [safe_str(x) for x in parsed if safe_str(x)]
                # limpieza ligera
                facts = [f[:160].strip() for f in facts if f.strip()]
                if len(facts) < 6:
                    raise ValueError(f"facts: demasiado pocos hechos ({len(facts)})")
                all_facts.extend(facts)
                break
            except Exception as ex:
                eprint(f"   !! facts chunk {idx}: parse/validate error: {ex}")
                if attempt == MAX_FACTS_ATTEMPTS_PER_CHUNK:
                    # no abortar: seguimos con siguientes chunks
                    pass

    # merge + de-dup + cap
    merged = dedupe_keep_order(all_facts, MAX_TOTAL_FACTS)
    return merged

# =====================================================
# POSTS GENERATION
# =====================================================
def normalize_posts(parsed: Any) -> List[Dict[str, Any]]:
    if not isinstance(parsed, list):
        raise ValueError("posts: el JSON no es un array")
    if len(parsed) < POSTS_PER_PROJECT:
        raise ValueError(f"posts: array trae {len(parsed)} posts, esperado {POSTS_PER_PROJECT}")

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
            "facts_used": [safe_str(x) for x in ensure_list(p.get("facts_used")) if safe_str(x)],
            "content": safe_str(p.get("content"), ""),
        })
    if len(posts) < POSTS_PER_PROJECT:
        raise ValueError("posts: no se pudieron normalizar suficientes posts")
    return posts

def generate_posts(out_dir: Path, project_slug: str, ts: str, context_preview: str, facts: List[str]) -> List[Dict[str, Any]]:
    last_raw = ""
    for attempt in range(1, MAX_POSTS_ATTEMPTS + 1):
        prompt = prompt_generate_posts(context_preview=context_preview, facts=facts, project_slug=project_slug)
        raw = call_llm(prompt)
        last_raw = raw
        save_debug(out_dir, project_slug, ts, f"posts_raw_attempt{attempt}", raw)

        try:
            parsed = parse_model_json(raw)
            posts = normalize_posts(parsed)

            # Validación de grounding
            for i, p in enumerate(posts, start=1):
                if not grounded_enough(p):
                    hits = fact_hit_count_in_content(p.get("facts_used", []), p.get("content", ""))
                    raise ValueError(f"post #{i} no grounded (hits={hits}, facts_used={len(p.get('facts_used', []))})")

            return posts
        except Exception as ex:
            eprint(f"   !! posts: parse/grounding error: {ex}")
            continue

    eprint("   !! posts: activando fallback determinista (sin LLM).")
    return deterministic_posts_fallback(project_slug)

# =====================================================
# PROCESS
# =====================================================
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

    # Preview de contexto (para tono), pero no para inventar
    context_preview = normalize_space(report_text)[:CONTEXT_PREVIEW_CHARS]
    save_text(out_dir / f"{project_slug}_{ts}_context_preview.txt", context_preview)

    # FACTS: usando TODO el md en chunks
    eprint(">> Extrayendo FACTS desde TODO el .md (chunks)...")
    facts = extract_facts_via_llm(report_text, out_dir, project_slug, ts)
    if not facts:
        eprint("   !! facts: vacío; el grounding será más débil (se usará fallback si falla).")
    write_json(out_dir / f"{project_slug}_{ts}_facts.json", facts)
    eprint(f">> FACTS: {len(facts)}")

    # Generar posts grounded
    eprint(f">> Generando {POSTS_PER_PROJECT} posts (grounded)...")
    posts = generate_posts(out_dir, project_slug, ts, context_preview, facts)

    # Guardado
    posts_dir = out_dir / "posts" / ts
    posts_dir.mkdir(parents=True, exist_ok=True)

    write_json(posts_dir / f"posts_{ts}.json", posts)
    for i, p in enumerate(posts, start=1):
        write_json(posts_dir / f"post_{i:02d}.json", p)

    print(f"[OK] {project_slug} POSTS: {posts_dir}")

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

