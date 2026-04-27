#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
012-json-completo-batch-meaningful.py

Fixes "generic outputs" by:
- extracting richer context from report
- validating the LLM payload has required structure
- saving parsed payload for debugging
- forcing a repair call if payload is missing required blocks

Edit constants only.
"""

from __future__ import annotations

import ast
import datetime as dt
import json
import re
import subprocess
import sys
from pathlib import Path
from typing import Any, Dict, List, Optional, Tuple

import requests
import urllib3

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

# =====================================================
# BATCH CONFIG
# =====================================================
PROJECT_FOLDERS: List[str] = [
    "/var/www/html/jocarsa-darksalmon/",
    "/var/www/html/jocarsa-aliceblue/",
    "/var/www/html/jocarsa-salmon/",
    "/var/www/html/jocarsa-mediumseagreen/",
]

OUTPUT_ROOT: str = "/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/productos"
DEFAULT_PRODUCT_TYPE: str = "softwareEducativo"
MAX_JSON_ATTEMPTS: int = 5

# =====================================================
# REMOTE API
# =====================================================
API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php"
API_KEY = "TEST_API_KEY_JOCARSA_123"
VERIFY_SSL = False
REMOTE_MODEL = "qwen2.5:7b-instruct-q4_0"

# =====================================================
# LIGHTGOLDENRODYELLOW
# =====================================================
LIGHTGOLDENRODYELLOW = "/var/www/html/jocarsa-lightgoldenrodyellow/lightgoldenrodyellow.py"

# =====================================================
# BAN LIST
# =====================================================
BANNED_TERMS = [
    "inyección", "xss", "csrf", "sql injection", "sentencias preparadas", "prepared statement",
    "refactor", "vulnerab", "desarrollador", "developer", "endpoint", "pdo",
    "sesión", "session", "cookie",
]
BANNED_TERMS = [
    
]

# =====================================================
# SANITIZER
# =====================================================
SANITIZE_REPLACEMENTS = [
    (re.compile(r"\bde forma manual\b", re.IGNORECASE), "de forma tradicional"),
    (re.compile(r"\bprocesos? manual(es)?\b", re.IGNORECASE), "procesos tradicionales"),
    (re.compile(r"\bmanual(es)?\b", re.IGNORECASE), lambda m: "tradicional" + (m.group(1) or "")),

    (re.compile(r"\boptimizar\b", re.IGNORECASE), "mejorar"),
    (re.compile(r"\boptimiza\b", re.IGNORECASE), "mejora"),
    (re.compile(r"\boptimizas\b", re.IGNORECASE), "mejoras"),
    (re.compile(r"\boptimizamos\b", re.IGNORECASE), "mejoramos"),
    (re.compile(r"\boptimizando\b", re.IGNORECASE), "mejorando"),
    (re.compile(r"\boptimización\b", re.IGNORECASE), "mejora"),
    (re.compile(r"\boptimizado(s|as)?\b", re.IGNORECASE), "mejorado"),
]

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

def normalize_space(s: str) -> str:
    s = s.replace("\r\n", "\n")
    s = re.sub(r"[ \t]+", " ", s)
    s = re.sub(r"\n{3,}", "\n\n", s)
    return s.strip()

def sanitize_text(s: str) -> str:
    out = s
    for rx, rep in SANITIZE_REPLACEMENTS:
        out = rx.sub(rep, out)
    return out

def sanitize_payload(obj: Any) -> Any:
    if isinstance(obj, dict):
        return {k: sanitize_payload(v) for k, v in obj.items()}
    if isinstance(obj, list):
        return [sanitize_payload(v) for v in obj]
    if isinstance(obj, str):
        return sanitize_text(obj)
    return obj

def read_text(p: Path) -> str:
    return p.read_text(encoding="utf-8", errors="replace")

def write_json(path: Path, obj: Any) -> None:
    path.write_text(json.dumps(obj, ensure_ascii=False, indent=2), encoding="utf-8", errors="replace")

def save_debug(out_dir: Path, slug: str, ts: str, label: str, content: str) -> Path:
    p = out_dir / f"{slug}_{ts}_{label}.txt"
    p.write_text(content, encoding="utf-8", errors="replace")
    return p

def has_banned_terms(text: str) -> Optional[str]:
    low = text.lower()
    for t in BANNED_TERMS:
        if t in low:
            return t
    return None

def ensure_list(x: Any) -> List[Any]:
    if x is None:
        return []
    if isinstance(x, list):
        return x
    return [x]

def safe_str(x: Any, default: str = "") -> str:
    if x is None:
        return default
    if isinstance(x, (int, float)):
        return str(x)
    s = str(x).strip()
    return s if s else default

def clamp_list(lst: List[Any], min_len: int, max_len: int, filler: Any) -> List[Any]:
    lst = lst[:max_len]
    while len(lst) < min_len:
        lst.append(filler)
    return lst

# =====================================================
# TOLERANT PARSER
# =====================================================
def extract_first_json_object(text: str) -> str:
    start = text.find("{")
    if start == -1:
        return ""
    depth = 0
    for i in range(start, len(text)):
        c = text[i]
        if c == "{":
            depth += 1
        elif c == "}":
            depth -= 1
            if depth == 0:
                return text[start:i + 1].strip()
    return ""

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

def parse_model_object(raw_answer: str) -> Dict[str, Any]:
    blob = extract_first_json_object(raw_answer)
    if not blob:
        raise ValueError("No se encontró un objeto { ... } en la respuesta del modelo.")
    blob = strip_code_fences(blob)

    try:
        obj = json.loads(blob)
        if isinstance(obj, dict):
            return obj
    except Exception:
        pass

    blob2 = quote_unquoted_keys(blob)
    blob2 = remove_trailing_commas(blob2)
    blob2 = fix_invalid_backslash_escapes(blob2)

    try:
        obj = json.loads(blob2)
        if isinstance(obj, dict):
            return obj
    except Exception:
        pass

    blob3 = re.sub(r"\btrue\b", "True", blob2, flags=re.IGNORECASE)
    blob3 = re.sub(r"\bfalse\b", "False", blob2, flags=re.IGNORECASE)
    blob3 = re.sub(r"\bnull\b", "None", blob2, flags=re.IGNORECASE)
    obj = ast.literal_eval(blob3)
    if not isinstance(obj, dict):
        raise ValueError("La salida parseada no es un dict.")
    return obj

# =====================================================
# PAYLOAD VALIDATION (prevents generic JSON)
# =====================================================
REQUIRED_TOP_KEYS = ["lang", "type", "version", "meta", "hero", "problem", "solution", "keyFeatures",
                     "targetAudience", "useCases", "benefits", "trust", "finalCTA", "faq", "footer"]

def payload_quality_issues(payload: Dict[str, Any]) -> List[str]:
    issues = []
    for k in REQUIRED_TOP_KEYS:
        if k not in payload:
            issues.append(f"Falta clave raíz: {k}")

    meta = payload.get("meta") or {}
    hero = payload.get("hero") or {}

    if not isinstance(meta, dict) or not meta:
        issues.append("meta vacío o no es dict")
    else:
        if not safe_str(meta.get("slug")):
            issues.append("meta.slug vacío")
        if not safe_str(meta.get("title")):
            issues.append("meta.title vacío")
        if not safe_str(meta.get("category")):
            issues.append("meta.category vacío")
        segs = ensure_list(meta.get("audience_segments"))
        if len([s for s in segs if safe_str(s)]) < 1:
            issues.append("meta.audience_segments vacío")
        if not safe_str(meta.get("ctaPrimary")):
            issues.append("meta.ctaPrimary vacío")
        if not safe_str(meta.get("ctaSecondary")):
            issues.append("meta.ctaSecondary vacío")

    if not isinstance(hero, dict) or not hero:
        issues.append("hero vacío o no es dict")
    else:
        if not safe_str(hero.get("name")):
            issues.append("hero.name vacío")
        if not safe_str(hero.get("valueProposition")):
            issues.append("hero.valueProposition vacío")
        # subtitle can be empty, but usually should exist
        if not safe_str(hero.get("subtitle")):
            issues.append("hero.subtitle vacío")

    # Extra check: detect obvious fallback-like titles
    if safe_str(meta.get("title")).strip().lower() in ("producto", "product"):
        issues.append("meta.title parece genérico ('Producto')")
    if safe_str(meta.get("category")).strip().lower() in ("saas",):
        issues.append("meta.category parece genérico ('SaaS')")

    return issues

# =====================================================
# UNIQUE IMAGES
# =====================================================
def image_src(project_slug: str, ts: str, section: str) -> str:
    section = re.sub(r"[^a-z0-9_-]+", "", section.lower())
    return f"img/{project_slug}_{ts}_{section}.jpg"

def default_images(project_slug: str, ts: str) -> Dict[str, Tuple[str, str]]:
    return {
        "hero": (image_src(project_slug, ts, "hero"), "Producto software"),
        "problem": (image_src(project_slug, ts, "problem"), "Problemas habituales"),
        "solution": (image_src(project_slug, ts, "solution"), "Solución"),
        "features": (image_src(project_slug, ts, "features"), "Funcionalidades"),
        "audience": (image_src(project_slug, ts, "audience"), "Público objetivo"),
        "usecases": (image_src(project_slug, ts, "usecases"), "Casos de uso"),
        "benefits": (image_src(project_slug, ts, "benefits"), "Beneficios"),
        "integrations": (image_src(project_slug, ts, "integrations"), "Integraciones"),
        "trust": (image_src(project_slug, ts, "trust"), "Confianza"),
        "cta": (image_src(project_slug, ts, "cta"), "Solicitar demo"),
        "faq": (image_src(project_slug, ts, "faq"), "Preguntas frecuentes"),
    }

# =====================================================
# REMOTE API
# =====================================================
def call_remote_api(question: str, timeout: int = 900) -> str:
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
# STRONGER CONTEXT EXTRACTION
# =====================================================
def extract_marketing_context(report_md: str, max_chars: int = 14000) -> str:
    chunks: List[str] = []

    # 1) landing.html block if present
    m = re.search(r"\*\*landing\.html\*\*\s*```html\s*(.*?)```", report_md, flags=re.DOTALL | re.IGNORECASE)
    if m:
        chunks.append(m.group(1))

    # 2) any html code blocks (first 3)
    html_blocks = re.findall(r"```html\s*(.*?)```", report_md, flags=re.DOTALL | re.IGNORECASE)
    for b in html_blocks[:3]:
        chunks.append(b)

    # 3) extract headings/bullets from markdown itself
    md_lines = []
    for line in report_md.splitlines():
        line = line.strip()
        if not line:
            continue
        if line.startswith("#") or line.startswith("- ") or line.startswith("* "):
            md_lines.append(line)
    if md_lines:
        chunks.append("\n".join(md_lines[:200]))

    # 4) fallback: first N chars of full report
    chunks.append(report_md[:6000])

    # Clean HTML tags a bit
    ctx_texts: List[str] = []
    for ch in chunks:
        # remove scripts/styles
        ch = re.sub(r"<script\b.*?>.*?</script>", " ", ch, flags=re.DOTALL | re.IGNORECASE)
        ch = re.sub(r"<style\b.*?>.*?</style>", " ", ch, flags=re.DOTALL | re.IGNORECASE)
        # keep content-ish
        ch = re.sub(r"<[^>]+>", " ", ch)
        ch = normalize_space(ch)
        if ch:
            ctx_texts.append(ch)

    # de-dup
    seen = set()
    out = []
    for t in ctx_texts:
        key = t[:400].lower()
        if key in seen:
            continue
        seen.add(key)
        out.append(t)

    ctx = "\n\n".join(out)
    return normalize_space(ctx)[:max_chars]

# =====================================================
# PROMPTS
# =====================================================
def prompt_generate_marketing_json(context: str, slug: str, product_type: str) -> str:
    return f"""
Eres un copywriter senior de SaaS. Devuelve SOLO un JSON (sin texto fuera del JSON).

OBLIGATORIO:
- El JSON DEBE contener todas estas claves raíz:
  lang,type,version,meta,hero,problem,solution,keyFeatures,targetAudience,useCases,benefits,integrations,trust,finalCTA,faq,footer
- meta.title y hero.valueProposition NO pueden ser genéricos ("Producto", "SaaS", etc.). Deben reflejar el CONTEXTO REAL.
- Evita "optimizar/optimización" literalmente.
- Nada de lenguaje para desarrolladores (SQL injection, XSS, CSRF, sesiones, refactor, etc.).

FORMATO (claves exactas):
{{
  "lang": "es",
  "type": "{product_type}",
  "version": "1.1",
  "meta": {{
    "slug": "{slug}",
    "title": "...",
    "category": "...",
    "audience_segments": ["...", "..."],
    "ctaPrimary": "...",
    "ctaSecondary": "..."
  }},
  "hero": {{
    "name": "...",
    "valueProposition": "...",
    "subtitle": "...",
    "badges": ["...", "..."],
    "actions": [
      {{"type":"primary","text":"..."}},
      {{"type":"secondary","text":"..."}},
      {{"type":"tertiary","text":"..."}}
    ]
  }},
  "problem": {{"title": "...","items": ["...","...","..."]}},
  "solution": {{"title": "...","overview": "...","whatChanges": ["...","...","..."]}},
  "keyFeatures": {{"title": "...","features": [{{"name":"...","benefit":"..."}},{{"name":"...","benefit":"..."}},{{"name":"...","benefit":"..."}}]}},
  "targetAudience": {{"title": "...","profiles": [{{"name":"...","fit":"..."}},{{"name":"...","fit":"..."}},{{"name":"...","fit":"..."}}]}},
  "useCases": {{"title": "...","cases": [{{"name":"...","description":"..."}},{{"name":"...","description":"..."}},{{"name":"...","description":"..."}}]}},
  "benefits": {{"title": "...","items": ["...","...","..."]}},
  "integrations": {{"include": true,"optional": "true","title": "...","notes": "...","items": ["...","...","..."]}},
  "trust": {{"title": "...","points": ["...","...","..."]}},
  "finalCTA": {{
    "title": "...",
    "description": "...",
    "actions": [{{"type":"primary","text":"..."}},{{"type":"secondary","text":"..."}}],
    "contact": {{
      "email": "info@jocarsa.com",
      "fields": [
        {{"name":"nombre","type":"text","required":"true"}},
        {{"name":"email","type":"email","required":"true"}},
        {{"name":"mensaje","type":"textarea","required":"true"}}
      ]
    }}
  }},
  "faq": {{"title": "...","qas": [{{"q":"...","a":"..."}},{{"q":"...","a":"..."}},{{"q":"...","a":"..."}}]}},
  "footer": {{"summary": "..."}}
}}

CONTEXTO REAL (usa esto para que NO sea genérico):
\"\"\"
{context}
\"\"\"
""".strip()

def prompt_repair_json(context: str, bad_answer: str, reason: str, slug: str, product_type: str) -> str:
    return f"""
La salida anterior no sirve: {reason}
Devuelve SOLO JSON con las CLAVES exactas del formato. No añadas otras claves.

OBLIGATORIO:
- Incluir TODAS las claves raíz del formato.
- meta.title y hero.valueProposition deben reflejar el CONTEXTO REAL (no "Producto"/"SaaS").
- Evitar "optimizar/optimización".
- Nada de lenguaje para desarrolladores (SQL injection, XSS, CSRF, sesiones, refactor, etc.).

FORMATO (claves exactas):
{{
  "lang": "es",
  "type": "{product_type}",
  "version": "1.1",
  "meta": {{
    "slug": "{slug}",
    "title": "...",
    "category": "...",
    "audience_segments": ["...", "..."],
    "ctaPrimary": "...",
    "ctaSecondary": "..."
  }},
  "hero": {{
    "name": "...",
    "valueProposition": "...",
    "subtitle": "...",
    "badges": ["...", "..."],
    "actions": [
      {{"type":"primary","text":"..."}},
      {{"type":"secondary","text":"..."}},
      {{"type":"tertiary","text":"..."}}
    ]
  }},
  "problem": {{"title": "...","items": ["...","...","..."]}},
  "solution": {{"title": "...","overview": "...","whatChanges": ["...","...","..."]}},
  "keyFeatures": {{"title": "...","features": [{{"name":"...","benefit":"..."}},{{"name":"...","benefit":"..."}},{{"name":"...","benefit":"..."}}]}},
  "targetAudience": {{"title": "...","profiles": [{{"name":"...","fit":"..."}},{{"name":"...","fit":"..."}},{{"name":"...","fit":"..."}}]}},
  "useCases": {{"title": "...","cases": [{{"name":"...","description":"..."}},{{"name":"...","description":"..."}},{{"name":"...","description":"..."}}]}},
  "benefits": {{"title": "...","items": ["...","...","..."]}},
  "integrations": {{"include": true,"optional": "true","title": "...","notes": "...","items": ["...","...","..."]}},
  "trust": {{"title": "...","points": ["...","...","..."]}},
  "finalCTA": {{
    "title": "...",
    "description": "...",
    "actions": [{{"type":"primary","text":"..."}},{{"type":"secondary","text":"..."}}],
    "contact": {{
      "email": "info@jocarsa.com",
      "fields": [
        {{"name":"nombre","type":"text","required":"true"}},
        {{"name":"email","type":"email","required":"true"}},
        {{"name":"mensaje","type":"textarea","required":"true"}}
      ]
    }}
  }},
  "faq": {{"title": "...","qas": [{{"q":"...","a":"..."}},{{"q":"...","a":"..."}},{{"q":"...","a":"..."}}]}},
  "footer": {{"summary": "..."}}
}}

CONTEXTO REAL:
\"\"\"
{context}
\"\"\"

MUESTRA FALLIDA (no la repitas):
\"\"\"
{bad_answer[:2500]}
\"\"\"
""".strip()

# =====================================================
# FINAL JSON BUILD (same mapper as before)
# =====================================================
def build_productpage_json(payload: Dict[str, Any], images: Dict[str, Tuple[str, str]]) -> Dict[str, Any]:
    def media_block(key: str) -> Dict[str, Any]:
        src, alt = images[key]
        return {"media": {"image": {"@src": src, "@alt": alt}}}

    def actions_block(actions: List[Dict[str, Any]], fallback: List[Dict[str, str]]) -> Dict[str, Any]:
        acts = actions if actions else fallback
        out = []
        for a in acts:
            out.append({"@type": safe_str((a or {}).get("type"), ""), "#text": safe_str((a or {}).get("text"), "Acción")})
        for a in out:
            if a.get("@type") not in ("primary", "secondary", "tertiary"):
                a.pop("@type", None)
        return {"actions": {"action": out}}

    lang = safe_str(payload.get("lang"), "es")
    ptype = safe_str(payload.get("type"), DEFAULT_PRODUCT_TYPE)
    ver = safe_str(payload.get("version"), "1.1")

    meta = payload.get("meta", {}) or {}
    hero = payload.get("hero", {}) or {}
    problem = payload.get("problem", {}) or {}
    solution = payload.get("solution", {}) or {}
    keyf = payload.get("keyFeatures", {}) or {}
    targ = payload.get("targetAudience", {}) or {}
    usec = payload.get("useCases", {}) or {}
    bene = payload.get("benefits", {}) or {}
    integ = payload.get("integrations", {}) or {}
    trust = payload.get("trust", {}) or {}
    fcta = payload.get("finalCTA", {}) or {}
    faq = payload.get("faq", {}) or {}
    foot = payload.get("footer", {}) or {}

    audience_segments = clamp_list(ensure_list(meta.get("audience_segments")), 1, 50, "Dirección")
    meta_out = {
        "slug": safe_str(meta.get("slug"), "producto"),
        "title": safe_str(meta.get("title"), "Producto"),
        "category": safe_str(meta.get("category"), "SaaS"),
        "audience": {"segment": [safe_str(x, "Dirección") for x in audience_segments]},
        "ctaPrimary": safe_str(meta.get("ctaPrimary"), "Solicitar demo"),
        "ctaSecondary": safe_str(meta.get("ctaSecondary"), "Ver cómo funciona"),
    }

    badges = [safe_str(x) for x in ensure_list(hero.get("badges")) if safe_str(x)]
    hero_actions_in = ensure_list(hero.get("actions"))
    hero_actions_fb = [
        {"type": "primary", "text": meta_out["ctaPrimary"]},
        {"type": "secondary", "text": meta_out["ctaSecondary"]},
        {"type": "tertiary", "text": "Contactar"},
    ]

    hero_out: Dict[str, Any] = {}
    hero_out.update(media_block("hero"))
    hero_out.update({
        "name": safe_str(hero.get("name"), meta_out["title"]),
        "valueProposition": safe_str(hero.get("valueProposition"), "Propuesta de valor clara para tu negocio."),
    })
    subtitle = safe_str(hero.get("subtitle"), "")
    if subtitle:
        hero_out["subtitle"] = subtitle
    if badges:
        hero_out["badges"] = {"badge": badges}
    hero_out.update(actions_block(hero_actions_in, hero_actions_fb))

    p_items = clamp_list(ensure_list(problem.get("items")), 3, 30, "Falta de visibilidad del estado real.")
    problem_out: Dict[str, Any] = {}
    problem_out.update(media_block("problem"))
    problem_out.update({
        "title": safe_str(problem.get("title"), "Problemas habituales"),
        "items": {"item": [safe_str(x, "Falta de visibilidad del estado real.") for x in p_items]},
    })

    wc = [safe_str(x) for x in ensure_list(solution.get("whatChanges")) if safe_str(x)]
    solution_out: Dict[str, Any] = {}
    solution_out.update(media_block("solution"))
    solution_out.update({
        "title": safe_str(solution.get("title"), "La solución"),
        "overview": safe_str(solution.get("overview"), "Resumen claro de la solución."),
    })
    if wc:
        solution_out["whatChanges"] = {"change": wc}

    feats = ensure_list(keyf.get("features"))
    feats = clamp_list(feats, 3, 30, {"name": "Funcionalidad", "benefit": "Beneficio"}) if feats else []
    if not feats:
        feats = [
            {"name": "Gestión centralizada", "benefit": "Ten todo en un solo lugar con visión clara."},
            {"name": "Flujos de trabajo", "benefit": "Menos fricción en tareas habituales."},
            {"name": "Informes", "benefit": "Decide con datos y contexto."},
        ]
    feat_out = [{"name": safe_str((f or {}).get("name"), "Funcionalidad"),
                 "benefit": safe_str((f or {}).get("benefit"), "Beneficio")} for f in feats]

    keyf_out: Dict[str, Any] = {}
    keyf_out.update(media_block("features"))
    keyf_out.update({"title": safe_str(keyf.get("title"), "Funciones clave"), "feature": feat_out})

    plist = ensure_list(targ.get("profiles"))
    if not plist:
        plist = [
            {"name": "Dirección", "fit": "Control y visibilidad del estado general."},
            {"name": "Administración", "fit": "Procesos claros y coherentes."},
            {"name": "Equipo", "fit": "Trabajo diario con menos fricción."},
        ]
    plist = clamp_list(plist, 3, 30, {"name": "Perfil", "fit": "Encaje"})
    prof_out = [{"name": safe_str((p or {}).get("name"), "Perfil"),
                 "fit": safe_str((p or {}).get("fit"), "Encaje")} for p in plist]

    targ_out: Dict[str, Any] = {}
    targ_out.update(media_block("audience"))
    targ_out.update({"title": safe_str(targ.get("title"), "¿Para quién es?"), "profiles": {"profile": prof_out}})

    clist = ensure_list(usec.get("cases"))
    if not clist:
        clist = [
            {"name": "Inicio", "description": "Organiza la puesta en marcha con claridad."},
            {"name": "Seguimiento", "description": "Mantén control y visibilidad del progreso."},
            {"name": "Cierres", "description": "Cierra periodos con menos pasos y más coherencia."},
        ]
    clist = clamp_list(clist, 3, 30, {"name": "Caso", "description": "Descripción"})
    case_out = [{"name": safe_str((c or {}).get("name"), "Caso"),
                 "description": safe_str((c or {}).get("description"), "Descripción")} for c in clist]

    usec_out: Dict[str, Any] = {}
    usec_out.update(media_block("usecases"))
    usec_out.update({"title": safe_str(usec.get("title"), "Casos de uso"), "case": case_out})

    b_items = clamp_list(ensure_list(bene.get("items")), 3, 30, "Más claridad en el día a día.")
    bene_out: Dict[str, Any] = {}
    bene_out.update(media_block("benefits"))
    bene_out.update({"title": safe_str(bene.get("title"), "Beneficios"),
                     "items": {"item": [safe_str(x, "Más claridad en el día a día.") for x in b_items]}})

    integrations_out: Optional[Dict[str, Any]] = None
    if bool(integ.get("include", True)):
        i_items = [safe_str(x) for x in ensure_list(integ.get("items")) if safe_str(x)]
        integrations_out = {"@optional": safe_str(integ.get("optional"), "true") if safe_str(integ.get("optional"), "true") in ("true", "false") else "true"}
        integrations_out.update(media_block("integrations"))
        integrations_out["title"] = safe_str(integ.get("title"), "Integraciones")
        notes = safe_str(integ.get("notes"), "")
        if notes:
            integrations_out["notes"] = notes
        integrations_out["items"] = {"item": i_items if i_items else ["Exportación a CSV/Excel", "API bajo demanda"]}

    t_points = clamp_list(ensure_list(trust.get("points")), 3, 30, "Diseñado para necesidades reales.")
    trust_out: Dict[str, Any] = {}
    trust_out.update(media_block("trust"))
    trust_out.update({"title": safe_str(trust.get("title"), "Confianza"),
                      "points": {"point": [safe_str(x, "Diseñado para necesidades reales.") for x in t_points]}})

    f_actions_in = ensure_list(fcta.get("actions"))
    f_actions_fb = [
        {"type": "primary", "text": meta_out["ctaPrimary"]},
        {"type": "secondary", "text": "Hablar con un asesor"},
    ]

    contact = fcta.get("contact", {}) or {}
    fields = ensure_list(contact.get("fields"))
    if not fields:
        fields = [
            {"name": "nombre", "type": "text", "required": "true"},
            {"name": "email", "type": "email", "required": "true"},
            {"name": "mensaje", "type": "textarea", "required": "true"},
        ]
    field_out = []
    for fld in clamp_list(fields, 3, 30, {"name": "nombre", "type": "text", "required": "true"}):
        name = safe_str((fld or {}).get("name"), "campo")
        ftype = safe_str((fld or {}).get("type"), "text")
        required = safe_str((fld or {}).get("required"), "true")
        if ftype not in ("text", "email", "tel", "textarea", "number", "select", "checkbox"):
            ftype = "text"
        if required not in ("true", "false"):
            required = "true"
        field_out.append({"@name": name, "@type": ftype, "@required": required})

    finalcta_out: Dict[str, Any] = {}
    finalcta_out.update(media_block("cta"))
    finalcta_out["title"] = safe_str(fcta.get("title"), "¿Quieres verlo en acción?")
    fdesc = safe_str(fcta.get("description"), "")
    if fdesc:
        finalcta_out["description"] = fdesc
    finalcta_out.update(actions_block(f_actions_in, f_actions_fb))
    finalcta_out["contact"] = {"email": safe_str(contact.get("email"), "info@jocarsa.com"),
                               "form": {"field": field_out}}

    qas = ensure_list(faq.get("qas"))
    if not qas:
        qas = [
            {"q": "¿Se puede adaptar a mi caso?", "a": "Sí. Se configura según necesidades."},
            {"q": "¿Es obligatorio integrar con otros sistemas?", "a": "No. Es opcional."},
            {"q": "¿Hay exportación de datos?", "a": "Sí, según configuración."},
        ]
    qas = clamp_list(qas, 3, 30, {"q": "Pregunta", "a": "Respuesta"})
    qa_out = [{"q": safe_str((qa or {}).get("q"), "Pregunta"),
               "a": safe_str((qa or {}).get("a"), "Respuesta")} for qa in qas]

    faq_out: Dict[str, Any] = {}
    faq_out.update(media_block("faq"))
    faq_out.update({"title": safe_str(faq.get("title"), "Preguntas frecuentes"), "qa": qa_out})

    footer_out = {"summary": safe_str(foot.get("summary"), "Resumen del producto y siguiente paso.")}

    product_page: Dict[str, Any] = {
        "@lang": lang,
        "@type": ptype,
        "@version": ver,
        "meta": meta_out,
        "hero": hero_out,
        "problem": problem_out,
        "solution": solution_out,
        "keyFeatures": keyf_out,
        "targetAudience": targ_out,
        "useCases": usec_out,
        "benefits": bene_out,
        "trust": trust_out,
        "finalCTA": finalcta_out,
        "faq": faq_out,
        "footer": footer_out,
    }
    if integrations_out is not None:
        product_page["integrations"] = integrations_out

    return {"productPage": product_page}

# =====================================================
# PROCESS
# =====================================================
def process_one_project(project_path: Path, output_root: Path) -> None:
    ts = dt.datetime.now().strftime("%Y%m%d%H%M%S")
    project_slug = slugify(project_path.name)
    product_type = DEFAULT_PRODUCT_TYPE
    out_dir = output_root / project_slug
    out_dir.mkdir(parents=True, exist_ok=True)
    images = default_images(project_slug, ts)

    eprint(f"\n=== {project_slug} ===")
    eprint(f">> Modelo remoto: {REMOTE_MODEL}")
    eprint(f">> Proyecto: {project_path}")
    eprint(f">> Output: {out_dir}")

    report_path = run_lightgoldenrodyellow(project_path, out_dir, LIGHTGOLDENRODYELLOW)
    report_text = read_text(report_path)
    eprint(f">> Reporte: {report_path} ({len(report_text)} chars)")

    context = extract_marketing_context(report_text, max_chars=14000)
    (out_dir / f"{project_slug}_{ts}_context_comercial.txt").write_text(context, encoding="utf-8", errors="replace")

    last_raw = ""
    payload: Optional[Dict[str, Any]] = None

    for attempt in range(1, MAX_JSON_ATTEMPTS + 1):
        eprint(f">> Generando PAYLOAD (intento {attempt}/{MAX_JSON_ATTEMPTS})...")

        if attempt == 1:
            q = prompt_generate_marketing_json(context, project_slug, product_type)
        else:
            q = prompt_repair_json(
                context=context,
                bad_answer=last_raw,
                reason="payload incompleto / genérico / inválido",
                slug=project_slug,
                product_type=product_type
            )

        raw = call_remote_api(q, timeout=1800)
        last_raw = raw
        save_debug(out_dir, project_slug, ts, f"payload_raw_attempt{attempt}", raw)

        try:
            obj = parse_model_object(raw)
        except Exception as ex:
            eprint(f"   !! Parse error: {ex}")
            continue

        obj = sanitize_payload(obj)

        # Save parsed payload always (for debugging)
        write_json(out_dir / f"{project_slug}_{ts}_payload_parsed_attempt{attempt}.json", obj)

        bad = has_banned_terms(json.dumps(obj, ensure_ascii=False))
        if bad:
            eprint(f"   !! Prohibido: '{bad}'")
            continue

        issues = payload_quality_issues(obj)
        if issues:
            eprint("   !! Payload con problemas:")
            for it in issues[:8]:
                eprint(f"      - {it}")
            continue

        payload = obj
        write_json(out_dir / f"{project_slug}_{ts}_payload.json", payload)
        eprint(f">> Payload OK: {out_dir / f'{project_slug}_{ts}_payload.json'}")
        break

    if payload is None:
        raise RuntimeError(f"No se pudo obtener un payload válido/no genérico para {project_slug}. Revisa *_payload_parsed_attempt*.json")

    final_obj = sanitize_payload(build_productpage_json(payload, images=images))
    write_json(out_dir / f"{project_slug}.json", final_obj)
    write_json(out_dir / f"{project_slug}_{ts}_images.json", images)

    print(f"[OK] {project_slug} JSON FINAL: {out_dir / (project_slug + '.json')}")

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

