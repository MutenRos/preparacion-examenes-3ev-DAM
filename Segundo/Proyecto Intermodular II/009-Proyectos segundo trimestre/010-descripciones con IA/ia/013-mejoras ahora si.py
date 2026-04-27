#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
013-mejoras-ahora-si-bloques-robusto.py (hardened, resilient)

Cambios principales:
- Reintentos ILIMITADOS por bloque (hasta éxito). Se puede parar con Ctrl+C.
- call_remote_api con reintentos ilimitados + backoff (red/HTTP/JSON).
- Parser más tolerante (objetos/arrays, fences, reparaciones suaves).
- Wrappers robustos para:
  - keyFeatures (ya existía, reforzado)
  - faq (NUEVO): acepta varias formas (objeto, array de qas, qas en raíz, etc.)
- Fallbacks deterministas para que el batch NO se rompa:
  - keyFeatures (ya existía)
  - trust (ya existía)
  - faq (NUEVO) -> pero sigue siendo “exists” siempre.
- Prompts de “repair” más estrictos cuando falla (sin markdown, JSON estricto).
"""

from __future__ import annotations

import ast
import datetime as dt
import json
import random
import re
import subprocess
import sys
import time
from pathlib import Path
from typing import Any, Dict, List, Optional, Tuple

import requests
import urllib3

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

# =====================================================
# BATCH CONFIG
# =====================================================
PROJECT_FOLDERS: List[str] = [
    "/var/www/html/jocarsa-aqua/",
    "/var/www/html/jocarsa-lightgoldenrodyellow/",
    "/var/www/html/jocarsa-firebrick/",
    "/var/www/html/jocarsa-khaki/",
    "/var/www/html/jocarsa-mediumseagreen/",
    "/var/www/html/jocarsa-orange/",
]

OUTPUT_ROOT: str = "/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/productos"
DEFAULT_PRODUCT_TYPE: str = "softwareEducativo"

# Reintentos ILIMITADOS:
# - si quieres “pausas” más agresivas o menos, ajusta BACKOFF_*.
BACKOFF_BASE_SECONDS: float = 1.2
BACKOFF_MAX_SECONDS: float = 45.0
JITTER_SECONDS: float = 0.6

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
# BAN LIST (opcional)
# =====================================================
BANNED_TERMS: List[str] = []

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

def brand_from_slug(project_slug: str) -> str:
    tail = project_slug.replace("jocarsa-", "").strip()
    return f"jocarsa | {tail}" if tail else "jocarsa"

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
        if t and t.lower() in low:
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

def backoff_sleep(attempt: int) -> None:
    # exponential-ish + cap + jitter
    base = BACKOFF_BASE_SECONDS * (1.6 ** max(0, attempt - 1))
    wait = min(BACKOFF_MAX_SECONDS, base) + random.random() * JITTER_SECONDS
    time.sleep(wait)

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
    # Busca primer {...} balanceado o [...] balanceado
    # 1) objeto
    start = text.find("{")
    if start != -1:
        depth = 0
        in_str = False
        esc = False
        for i in range(start, len(text)):
            c = text[i]
            if in_str:
                if esc:
                    esc = False
                elif c == "\\":
                    esc = True
                elif c == '"':
                    in_str = False
                continue
            else:
                if c == '"':
                    in_str = True
                    continue
                if c == "{":
                    depth += 1
                elif c == "}":
                    depth -= 1
                    if depth == 0:
                        return text[start:i + 1].strip()

    # 2) array
    start = text.find("[")
    if start != -1:
        depth = 0
        in_str = False
        esc = False
        for i in range(start, len(text)):
            c = text[i]
            if in_str:
                if esc:
                    esc = False
                elif c == "\\":
                    esc = True
                elif c == '"':
                    in_str = False
                continue
            else:
                if c == '"':
                    in_str = True
                    continue
                if c == "[":
                    depth += 1
                elif c == "]":
                    depth -= 1
                    if depth == 0:
                        return text[start:i + 1].strip()
    return ""

def parse_model_object(raw_answer: str) -> Dict[str, Any]:
    blob = extract_first_json_blob(raw_answer)
    if not blob:
        raise ValueError("No se encontró un objeto/array JSON en la respuesta del modelo.")
    blob = strip_code_fences(blob)

    # si es array, lo envolvemos en dict
    if blob.lstrip().startswith("["):
        blob = f'{{"__array__": {blob}}}'

    # 1) JSON directo
    try:
        obj = json.loads(blob)
        if isinstance(obj, dict):
            return obj
    except Exception:
        pass

    # 2) reparaciones suaves
    blob2 = quote_unquoted_keys(blob)
    blob2 = remove_trailing_commas(blob2)
    blob2 = fix_invalid_backslash_escapes(blob2)

    try:
        obj = json.loads(blob2)
        if isinstance(obj, dict):
            return obj
    except Exception:
        pass

    # 3) literal_eval (último recurso)
    blob3 = re.sub(r"\btrue\b", "True", blob2, flags=re.IGNORECASE)
    blob3 = re.sub(r"\bfalse\b", "False", blob2, flags=re.IGNORECASE)
    blob3 = re.sub(r"\bnull\b", "None", blob2, flags=re.IGNORECASE)

    obj = ast.literal_eval(blob3)
    if not isinstance(obj, dict):
        raise ValueError("La salida parseada no es un dict.")
    return obj

# =====================================================
# CONTEXT EXTRACTION
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
# REMOTE API (robusto, reintentos ilimitados)
# =====================================================
def call_remote_api(question: str, timeout: int = 900) -> str:
    attempt = 0
    while True:
        attempt += 1
        try:
            resp = requests.post(
                API_URL,
                headers={"X-API-Key": API_KEY},
                data={"question": question, "model": REMOTE_MODEL},
                timeout=timeout,
                verify=VERIFY_SSL,
            )
            if resp.status_code != 200:
                raise RuntimeError(f"API HTTP {resp.status_code}: {resp.text[:800]}")

            try:
                data = resp.json()
            except Exception:
                raise RuntimeError(f"API respuesta no-JSON (primeros 800 chars): {resp.text[:800]}")

            ans = data.get("answer")
            if not ans or not isinstance(ans, str):
                raise RuntimeError(f"API JSON sin 'answer' string: {str(data)[:800]}")

            return ans.strip()

        except KeyboardInterrupt:
            raise
        except Exception as ex:
            eprint(f"   !! call_remote_api: error (attempt {attempt}): {ex}")
            backoff_sleep(attempt)

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
# PROMPTS
# =====================================================
def base_rules(slug: str, product_type: str) -> str:
    brand = brand_from_slug(slug)
    return f"""
Eres un copywriter senior de SaaS. Devuelve SOLO JSON.

REGLAS ESTRICTAS:
- Nada de texto fuera del JSON.
- NO uses markdown, NO uses ``` fences.
- Usa SIEMPRE comillas dobles.
- NO uses comillas simples.
- NO uses trailing commas.
- Evita lenguaje para desarrolladores.
- Evita "optimizar/optimización" (y variantes).
- Marca: "{brand}" y slug EXACTO "{slug}".
- type: "{product_type}", lang: "es", version: "1.1".
""".strip()

def prompt_block_meta_hero(context: str, slug: str, product_type: str) -> str:
    brand = brand_from_slug(slug)
    return f"""
{base_rules(slug, product_type)}

Devuelve SOLO este JSON con dos claves: meta y hero.

FORMATO EXACTO:
{{
  "meta": {{
    "slug": "{slug}",
    "title": "DEBE incluir '{brand}' + propuesta concreta",
    "category": "categoría específica (no 'SaaS')",
    "audience_segments": ["...", "..."],
    "ctaPrimary": "...",
    "ctaSecondary": "..."
  }},
  "hero": {{
    "name": "{brand}",
    "valueProposition": "propuesta concreta según contexto",
    "subtitle": "subtítulo concreto",
    "badges": ["...", "..."],
    "actions": [
      {{"type":"primary","text":"..."}},
      {{"type":"secondary","text":"..."}},
      {{"type":"tertiary","text":"..."}}
    ]
  }}
}}

CONTEXTO:
\"\"\"
{context}
\"\"\"
""".strip()

def prompt_block_generic(context: str, slug: str, product_type: str, block_name: str, format_json: str) -> str:
    return f"""
{base_rules(slug, product_type)}

Devuelve SOLO el bloque "{block_name}" en JSON con este FORMATO EXACTO:
{format_json}

CONTEXTO:
\"\"\"
{context}
\"\"\"
""".strip()

def prompt_block_repair(context: str, slug: str, product_type: str, block_name: str, format_json: str, bad_answer: str, reason: str) -> str:
    return f"""
{base_rules(slug, product_type)}

La salida anterior del bloque "{block_name}" NO es válida: {reason}

OBJETIVO:
- Devuelve SOLO JSON válido.
- Debe coincidir con el FORMATO EXACTO.

FORMATO EXACTO:
{format_json}

SALIDA FALLIDA (NO repetir):
\"\"\"
{bad_answer[:2500]}
\"\"\"

CONTEXTO:
\"\"\"
{context}
\"\"\"
""".strip()

# =====================================================
# VALIDACIÓN
# =====================================================
def require_keys(obj: Dict[str, Any], keys: List[str]) -> List[str]:
    return [k for k in keys if k not in obj]

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
# FINAL JSON BUILD (mapper)
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
    plist = clamp_list(plist, 3, 30, {"name": "Perfil", "fit": "Encaje"})
    prof_out = [{"name": safe_str((p or {}).get("name"), "Perfil"),
                 "fit": safe_str((p or {}).get("fit"), "Encaje")} for p in plist]

    targ_out: Dict[str, Any] = {}
    targ_out.update(media_block("audience"))
    targ_out.update({"title": safe_str(targ.get("title"), "¿Para quién es?"), "profiles": {"profile": prof_out}})

    clist = ensure_list(usec.get("cases"))
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
    finalcta_out["contact"] = {
        "email": safe_str(contact.get("email"), "info@jocarsa.com"),
        "form": {"field": field_out}
    }

    qas = ensure_list(faq.get("qas"))
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
# WRAPPERS + FALLBACKS
# =====================================================
def normalize_features_list(raw_list: Any) -> List[Dict[str, str]]:
    feats: List[Dict[str, str]] = []
    for it in ensure_list(raw_list):
        if isinstance(it, dict):
            feats.append({
                "name": safe_str(it.get("name"), "Funcionalidad"),
                "benefit": safe_str(it.get("benefit"), "Beneficio"),
            })
    return feats

def wrap_keyFeatures(obj: Dict[str, Any], slug: str) -> Dict[str, Any]:
    """
    Acepta varias formas y construye:
      {"keyFeatures": {"title": "...", "features": [ {name,benefit}, ... ]}}
    """
    # 1) array puro (envuelto)
    if "__array__" in obj and isinstance(obj["__array__"], list):
        feats = normalize_features_list(obj["__array__"])
        if len(feats) >= 3:
            return {"keyFeatures": {"title": "Características destacadas", "features": feats[:10]}}

    # 2) features en raíz
    if isinstance(obj.get("features"), list):
        feats = normalize_features_list(obj["features"])
        if len(feats) >= 3:
            return {"keyFeatures": {"title": "Características destacadas", "features": feats[:10]}}

    if isinstance(obj.get("feature"), list):
        feats = normalize_features_list(obj["feature"])
        if len(feats) >= 3:
            return {"keyFeatures": {"title": "Características destacadas", "features": feats[:10]}}

    # 3) keyFeatures completo
    kf = obj.get("keyFeatures")
    if isinstance(kf, dict):
        title = safe_str(kf.get("title"), "Características destacadas")
        if isinstance(kf.get("features"), list):
            feats = normalize_features_list(kf["features"])
            if len(feats) >= 3:
                return {"keyFeatures": {"title": title, "features": feats[:10]}}
        if isinstance(kf.get("feature"), list):
            feats = normalize_features_list(kf["feature"])
            if len(feats) >= 3:
                return {"keyFeatures": {"title": title, "features": feats[:10]}}

    raise ValueError("keyFeatures: no pude extraer una lista de features válida (>=3).")

def normalize_qas_list(raw_list: Any) -> List[Dict[str, str]]:
    out: List[Dict[str, str]] = []
    for it in ensure_list(raw_list):
        if isinstance(it, dict):
            q = safe_str(it.get("q") or it.get("question") or it.get("pregunta"), "")
            a = safe_str(it.get("a") or it.get("answer") or it.get("respuesta"), "")
            if q and a:
                out.append({"q": q, "a": a})
        elif isinstance(it, (list, tuple)) and len(it) >= 2:
            q = safe_str(it[0], "")
            a = safe_str(it[1], "")
            if q and a:
                out.append({"q": q, "a": a})
    return out

def wrap_faq(obj: Dict[str, Any], slug: str) -> Dict[str, Any]:
    """
    Construye SIEMPRE:
      {"faq": {"title":"...","qas":[{"q":"...","a":"..."}, ...]}}
    Acepta:
    - {"faq": {"title": "...", "qas":[...]}}  (ideal)
    - {"faq": {"qas":[...]}} (sin title)
    - {"qas":[...]} (en raíz)
    - {"__array__":[...]} (array de Q/A)
    - {"qa":[...]} / {"questions":[...]} etc.
    - array en raíz -> llega como __array__
    """
    # 1) faq completo
    if isinstance(obj.get("faq"), dict):
        f = obj["faq"]
        title = safe_str(f.get("title"), "Preguntas frecuentes")
        qas_raw = f.get("qas") or f.get("qa") or f.get("questions")
        qas = normalize_qas_list(qas_raw)
        if len(qas) >= 3:
            return {"faq": {"title": title, "qas": qas[:12]}}

    # 2) qas en raíz
    for k in ("qas", "qa", "questions"):
        if isinstance(obj.get(k), list):
            qas = normalize_qas_list(obj.get(k))
            if len(qas) >= 3:
                return {"faq": {"title": "Preguntas frecuentes", "qas": qas[:12]}}

    # 3) array puro (envuelto)
    if "__array__" in obj and isinstance(obj["__array__"], list):
        qas = normalize_qas_list(obj["__array__"])
        if len(qas) >= 3:
            return {"faq": {"title": "Preguntas frecuentes", "qas": qas[:12]}}

    # 4) algunos modelos devuelven {"items":[{q,a},...]}
    if isinstance(obj.get("items"), list):
        qas = normalize_qas_list(obj["items"])
        if len(qas) >= 3:
            return {"faq": {"title": "Preguntas frecuentes", "qas": qas[:12]}}

    raise ValueError("faq: no pude extraer una lista de Q/A válida (>=3).")

def deterministic_keyFeatures_fallback(context: str) -> Dict[str, Any]:
    words = [w for w in re.findall(r"[A-Za-zÁÉÍÓÚÜÑáéíóúüñ0-9]{4,}", context)][:30]
    hint = " / ".join(words[:6]) if words else "tu organización"
    return {
        "keyFeatures": {
            "title": "Características destacadas",
            "features": [
                {"name": "Panel central", "benefit": f"Control en un solo lugar orientado a {hint}."},
                {"name": "Gestión diaria", "benefit": "Reduce pasos repetidos y mejora la continuidad del trabajo."},
                {"name": "Información clara", "benefit": "Consulta estados y avances de forma sencilla."},
            ]
        }
    }

def deterministic_trust_fallback(slug: str) -> Dict[str, Any]:
    brand = brand_from_slug(slug)
    return {
        "trust": {
            "title": "Confianza y acompañamiento",
            "points": [
                f"{brand} se enfoca en claridad y uso práctico.",
                "Soporte y seguimiento según necesidades.",
                "Evolución del producto guiada por casos reales.",
            ]
        }
    }

def deterministic_faq_fallback(context: str, slug: str) -> Dict[str, Any]:
    brand = brand_from_slug(slug)
    # Pequeña “señal” para personalizar sin depender del LLM
    keywords = [w for w in re.findall(r"[A-Za-zÁÉÍÓÚÜÑáéíóúüñ0-9]{5,}", context)]
    hint = keywords[0] if keywords else "el producto"
    return {
        "faq": {
            "title": "Preguntas frecuentes",
            "qas": [
                {"q": f"¿Para qué sirve {brand}?", "a": f"Sirve para dar una visión clara y práctica de {hint}, con foco en el trabajo diario."},
                {"q": "¿Cuánto tiempo lleva empezar a usarlo?", "a": "Normalmente se puede empezar en el mismo día, con una configuración inicial simple."},
                {"q": "¿Ofrece soporte?", "a": "Sí. Incluye acompañamiento y soporte para resolver dudas y adaptar el uso a cada caso."},
            ]
        }
    }

WRAPPERS = {
    "wrap_keyFeatures": wrap_keyFeatures,
    "wrap_faq": wrap_faq,
}

# =====================================================
# BLOCK DEFINITIONS
# =====================================================
BLOCK_SPECS = [
    ("problem", """{
  "problem": {"title":"...","items":["...","...","..."]}
}""", ["problem"], None),

    ("solution", """{
  "solution": {"title":"...","overview":"...","whatChanges":["...","...","..."]}
}""", ["solution"], None),

    # keyFeatures: pedimos array, wrapper acepta otras formas
    ("keyFeatures", """[
  {"name":"...","benefit":"..."},
  {"name":"...","benefit":"..."},
  {"name":"...","benefit":"..."}
]""", ["keyFeatures"], "wrap_keyFeatures"),

    ("targetAudience", """{
  "targetAudience": {"title":"...","profiles":[{"name":"...","fit":"..."},{"name":"...","fit":"..."},{"name":"...","fit":"..."}]}
}""", ["targetAudience"], None),

    ("useCases", """{
  "useCases": {"title":"...","cases":[{"name":"...","description":"..."},{"name":"...","description":"..."},{"name":"...","description":"..."}]}
}""", ["useCases"], None),

    ("benefits", """{
  "benefits": {"title":"...","items":["...","...","..."]}
}""", ["benefits"], None),

    ("integrations", """{
  "integrations": {"include": true, "optional":"true", "title":"...", "notes":"...", "items":["...","...","..."]}
}""", ["integrations"], None),

    ("trust", """{
  "trust": {"title":"...","points":["...","...","..."]}
}""", ["trust"], None),

    ("finalCTA", """{
  "finalCTA": {
    "title":"...",
    "description":"...",
    "actions":[{"type":"primary","text":"..."},{"type":"secondary","text":"..."}],
    "contact":{"email":"info@jocarsa.com","fields":[{"name":"nombre","type":"text","required":"true"},{"name":"email","type":"email","required":"true"},{"name":"mensaje","type":"textarea","required":"true"}]}
  }
}""", ["finalCTA"], None),

    # FAQ: wrapper nuevo para aceptar múltiples formas
    ("faq", """{
  "faq": {"title":"...","qas":[{"q":"...","a":"..."},{"q":"...","a":"..."},{"q":"...","a":"..."}]}
}""", ["faq"], "wrap_faq"),

    ("footer", """{
  "footer": {"summary":"..."}
}""", ["footer"], None),
]

# =====================================================
# GENERATE BLOCKS (reintentos ILIMITADOS)
# =====================================================
def generate_meta_hero(out_dir: Path, slug: str, ts: str, context: str, product_type: str) -> Dict[str, Any]:
    last_raw = ""
    attempt = 0

    while True:
        attempt += 1
        q = prompt_block_meta_hero(context, slug, product_type) if attempt == 1 else prompt_block_repair(
            context, slug, product_type, "meta+hero",
            """{"meta":{"slug":"...","title":"...","category":"...","audience_segments":["..."],"ctaPrimary":"...","ctaSecondary":"..."},
"hero":{"name":"...","valueProposition":"...","subtitle":"...","badges":["..."],"actions":[{"type":"primary","text":"..."},{"type":"secondary","text":"..."},{"type":"tertiary","text":"..."}]}}""",
            last_raw, "meta/hero inválido o incompleto"
        )

        raw = call_remote_api(q, timeout=1200)
        last_raw = raw
        save_debug(out_dir, slug, ts, f"meta_hero_raw_attempt{attempt}", raw)

        try:
            obj = parse_model_object(raw)
        except Exception as ex:
            eprint(f"   !! meta+hero: parse error (attempt {attempt}): {ex}")
            backoff_sleep(attempt)
            continue

        obj = sanitize_payload(obj)
        write_json(out_dir / f"{slug}_{ts}_meta_hero_parsed_attempt{attempt}.json", obj)

        miss = require_keys(obj, ["meta", "hero"])
        if miss:
            eprint(f"   !! meta+hero: faltan claves (attempt {attempt}): {miss}")
            backoff_sleep(attempt)
            continue

        mslug = safe_str((obj.get("meta") or {}).get("slug"))
        if slugify(mslug) != slugify(slug):
            eprint(f"   !! meta+hero: meta.slug no coincide (attempt {attempt}): ({mslug} != {slug})")
            backoff_sleep(attempt)
            continue

        return obj

def generate_block(
    out_dir: Path,
    slug: str,
    ts: str,
    context: str,
    product_type: str,
    block_name: str,
    fmt: str,
    required_top: List[str],
    wrapper_name: Optional[str],
) -> Dict[str, Any]:
    last_raw = ""
    attempt = 0

    while True:
        attempt += 1
        q = prompt_block_generic(context, slug, product_type, block_name, fmt) if attempt == 1 else prompt_block_repair(
            context, slug, product_type, block_name, fmt, last_raw, "json inválido / incompleto"
        )

        raw = call_remote_api(q, timeout=1200)
        last_raw = raw
        save_debug(out_dir, slug, ts, f"{block_name}_raw_attempt{attempt}", raw)

        try:
            obj = parse_model_object(raw)
        except Exception as ex:
            eprint(f"   !! {block_name}: parse error (attempt {attempt}): {ex}")
            # fallback inmediato para faq si el modelo insiste en romper JSON
            if block_name == "faq" and attempt >= 3:
                eprint("   !! faq: activando fallback determinista por parse repetido.")
                return deterministic_faq_fallback(context, slug)
            backoff_sleep(attempt)
            continue

        obj = sanitize_payload(obj)
        write_json(out_dir / f"{slug}_{ts}_{block_name}_parsed_attempt{attempt}.json", obj)

        bad = has_banned_terms(json.dumps(obj, ensure_ascii=False))
        if bad:
            eprint(f"   !! {block_name}: prohibido '{bad}' (attempt {attempt})")
            backoff_sleep(attempt)
            continue

        # Wrapper (si aplica)
        if wrapper_name:
            try:
                obj = WRAPPERS[wrapper_name](obj, slug)
            except Exception as ex:
                eprint(f"   !! {block_name}: wrapper error (attempt {attempt}): {ex}")
                # fallbacks deterministas para no bloquear el batch
                if block_name == "keyFeatures" and attempt >= 2:
                    eprint("   !! keyFeatures: activando fallback determinista (sin LLM).")
                    return deterministic_keyFeatures_fallback(context)
                if block_name == "trust" and attempt >= 2:
                    eprint("   !! trust: activando fallback determinista (sin LLM).")
                    return deterministic_trust_fallback(slug)
                if block_name == "faq" and attempt >= 2:
                    eprint("   !! faq: activando fallback determinista (sin LLM).")
                    return deterministic_faq_fallback(context, slug)

                backoff_sleep(attempt)
                continue

        miss = require_keys(obj, required_top)
        if miss:
            eprint(f"   !! {block_name}: faltan claves (attempt {attempt}): {miss}")
            # faq debe existir sí o sí: fallback si insiste
            if block_name == "faq" and attempt >= 3:
                eprint("   !! faq: activando fallback determinista por faltas repetidas.")
                return deterministic_faq_fallback(context, slug)
            backoff_sleep(attempt)
            continue

        return obj

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

    context = extract_marketing_context(report_text, max_chars=9000)
    (out_dir / f"{project_slug}_{ts}_context_comercial.txt").write_text(context, encoding="utf-8", errors="replace")

    eprint(">> Generando bloque meta+hero (reintentos ilimitados)...")
    mh = generate_meta_hero(out_dir, project_slug, ts, context, product_type)

    payload: Dict[str, Any] = {"lang": "es", "type": product_type, "version": "1.1"}
    payload.update(mh)

    for block_name, fmt, required, wrapper in BLOCK_SPECS:
        eprint(f">> Generando bloque {block_name} (reintentos ilimitados)...")
        blk = generate_block(out_dir, project_slug, ts, context, product_type, block_name, fmt, required, wrapper)
        payload.update(blk)

    write_json(out_dir / f"{project_slug}_{ts}_payload.json", payload)

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
        except KeyboardInterrupt:
            eprint("\n[STOP] Interrumpido por el usuario (Ctrl+C).")
            # mantenemos el resumen coherente
            break
        except Exception as ex:
            err += 1
            eprint(f"[ERROR] {project_path.name}: {ex}")

    eprint("\n=== RESUMEN ===")
    eprint(f"OK={ok}  SKIP={skip}  ERR={err}")
    if err > 0:
        sys.exit(1)

if __name__ == "__main__":
    main()

