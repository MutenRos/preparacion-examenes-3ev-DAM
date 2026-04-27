#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
007-imagenes_batch.py  (JSON FINAL + batch folders, no CLI args)

- Processes multiple input project folders (PROJECT_FOLDERS)
- Uses ONE output folder for all results (OUTPUT_ROOT)
- For each project:
  - Calls lightgoldenrodyellow.py to create a Markdown report
  - Builds a COMMERCIAL JSON via remote api.php (forced model)  [payload interno]
  - Maps payload -> FINAL JSON format (productPage with @attrs + nested blocks)
  - Generates UNIQUE image names:
      img/<project-slug>_<timestamp>_<section>.jpg

Requirements:
  pip install requests urllib3
"""

from __future__ import annotations

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
# BATCH CONFIG (EDIT HERE)
# =====================================================

# List of project folders to process
PROJECT_FOLDERS: List[str] = [
    "/var/www/html/jocarsa-darksalmon/",
     "/var/www/html/jocarsa-aliceblue/",
     "/var/www/html/jocarsa-salmon/",
     "/var/www/html/jocarsa-mediumseagreen/",
     "/var/www/html/jocarsa-gainsboro/",
    # "/var/www/html/jocarsa-lightgoldenrodyellow/",
    # "/var/www/html/jocarsa-xxxxxx/",
]

# One output folder for all projects
OUTPUT_ROOT: str = "/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/productos"

# Product type used in generated content
DEFAULT_PRODUCT_TYPE: str = "softwareEducativo"

# Max attempts to get valid JSON payload from model
MAX_JSON_ATTEMPTS: int = 5

# =====================================================
# REMOTE API CONFIG (NO SERVER CHANGES)
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
# BAN LIST (NO 'optimizar' here)
# =====================================================
BANNED_TERMS = [
    "inyección", "xss", "csrf", "sql injection", "sentencias preparadas", "prepared statement",
    "refactor", "vulnerab", "desarrollador", "developer", "endpoint", "pdo",
    "sesión", "session", "cookie", "csrf", "xss",
]

# =====================================================
# SANITIZER (includes optimizar*)
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

def run_lightgoldenrodyellow(project_path: Path, out_dir: Path, light_path: str) -> Path:
    lp = Path(light_path)
    if not lp.exists():
        raise FileNotFoundError(f"No existe lightgoldenrodyellow.py en: {lp}")
    out_dir.mkdir(parents=True, exist_ok=True)

    cmd = ["python3", str(lp), str(project_path), str(out_dir)]
    proc = subprocess.run(cmd, capture_output=True, text=True)
    if proc.returncode != 0:
        raise RuntimeError(f"lightgoldenrodyellow falló.\nSTDOUT:\n{proc.stdout}\nSTDERR:\n{proc.stderr}")

    m = re.search(r"\[OK\]\s+Reporte generado:\s+(.*\.md)\s*$", proc.stdout, flags=re.MULTILINE)
    if not m:
        raise RuntimeError(f"No pude detectar la ruta del reporte en STDOUT:\n{proc.stdout}")

    report_path = Path(m.group(1).strip()).expanduser()
    if not report_path.exists():
        raise FileNotFoundError(f"El reporte no existe: {report_path}")
    return report_path

def extract_marketing_context(report_md: str, max_chars: int = 12000) -> str:
    m = re.search(r"\*\*landing\.html\*\*\s*```html\s*(.*?)```", report_md, flags=re.DOTALL | re.IGNORECASE)
    if m:
        landing = m.group(1)
        texts: List[str] = []
        for pat in (r"<h[1-3][^>]*>(.*?)</h[1-3]>", r"<p[^>]*>(.*?)</p>", r"<li[^>]*>(.*?)</li>"):
            for mm in re.finditer(pat, landing, flags=re.DOTALL | re.IGNORECASE):
                t = re.sub(r"<[^>]+>", " ", mm.group(1))
                t = normalize_space(t)
                if t:
                    texts.append(t)

        seen = set()
        out = []
        for t in texts:
            k = t.lower()
            if k not in seen:
                seen.add(k)
                out.append(t)

        ctx = "\n".join(f"- {t}" for t in out)
        return normalize_space(ctx)[:max_chars]

    return normalize_space(report_md)[:max_chars]

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
# PROMPTS (payload interno)
# =====================================================
def prompt_generate_marketing_json(context: str, slug: str, product_type: str) -> str:
    return f"""
Eres un copywriter senior de SaaS (orientado a venta). Devuelve SOLO JSON válido (sin texto fuera del JSON).

REGLAS:
- Nada de lenguaje para desarrolladores: no menciones SQL injection, XSS, CSRF, sesiones, refactor, vulnerabilidades, etc.
- Enfoque cliente final.
- Evita texto tipo "manual de usuario" o "manual técnico".
- Evita literalmente la palabra "optimizar/optimización". Usa sinónimos (mejorar, agilizar, simplificar).

FORMATO JSON (claves exactas):
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
  "problem": {{
    "title": "...",
    "items": ["...", "...", "..."]
  }},
  "solution": {{
    "title": "...",
    "overview": "...",
    "whatChanges": ["...", "...", "..."]
  }},
  "keyFeatures": {{
    "title": "...",
    "features": [
      {{"name":"...","benefit":"..."}},
      {{"name":"...","benefit":"..."}},
      {{"name":"...","benefit":"..."}}
    ]
  }},
  "targetAudience": {{
    "title": "...",
    "profiles": [
      {{"name":"...","fit":"..."}},
      {{"name":"...","fit":"..."}},
      {{"name":"...","fit":"..."}}
    ]
  }},
  "useCases": {{
    "title": "...",
    "cases": [
      {{"name":"...","description":"..."}},
      {{"name":"...","description":"..."}},
      {{"name":"...","description":"..."}}
    ]
  }},
  "benefits": {{
    "title": "...",
    "items": ["...", "...", "..."]
  }},
  "integrations": {{
    "include": true,
    "optional": "true",
    "title": "...",
    "notes": "...",
    "items": ["...", "...", "..."]
  }},
  "trust": {{
    "title": "...",
    "points": ["...", "...", "..."]
  }},
  "finalCTA": {{
    "title": "...",
    "description": "...",
    "actions": [
      {{"type":"primary","text":"..."}},
      {{"type":"secondary","text":"..."}}
    ],
    "contact": {{
      "email": "info@jocarsa.com",
      "fields": [
        {{"name":"nombre","type":"text","required":"true"}},
        {{"name":"email","type":"email","required":"true"}},
        {{"name":"mensaje","type":"textarea","required":"true"}}
      ]
    }}
  }},
  "faq": {{
    "title": "...",
    "qas": [
      {{"q":"...","a":"..."}},
      {{"q":"...","a":"..."}},
      {{"q":"...","a":"..."}}
    ]
  }},
  "footer": {{
    "summary": "..."
  }}
}}
CONTEXTO REAL:
\"\"\"
{context}
\"\"\"
""".strip()

def prompt_repair_json(context: str, bad_answer: str, reason: str) -> str:
    return f"""
La salida anterior no sirve: {reason}
Devuelve SOLO JSON válido con el MISMO formato y claves exactas. Sin texto fuera del JSON.

PROHIBIDO:
- SQL injection, XSS, CSRF, sesiones, refactor, vulnerabilidades, etc.
- No escribas "manual de usuario" ni "manual técnico".
- Evita literalmente "optimizar/optimización". Usa "mejorar/agilizar/simplificar".

CONTEXTO:
\"\"\"
{context}
\"\"\"

MUESTRA FALLIDA (no la repitas):
\"\"\"
{bad_answer[:4000]}
\"\"\"
""".strip()

# =====================================================
# FINAL JSON BUILD (payload -> productPage format)
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
            if a["@type"] not in ("primary", "secondary", "tertiary"):
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
    if not feats:
        feats = [
            {"name": "Gestión centralizada", "benefit": "Ten todo en un solo lugar con visión clara."},
            {"name": "Flujos de trabajo", "benefit": "Menos fricción en tareas habituales."},
            {"name": "Informes", "benefit": "Decide con datos y contexto."},
        ]
    feats = clamp_list(feats, 3, 30, {"name": "Funcionalidad", "benefit": "Beneficio"})
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
    bene_out.update({"title": safe_str(bene.get("title"), "Beneficios"), "items": {"item": [safe_str(x, "Más claridad.") for x in b_items]}})

    integrations_out: Optional[Dict[str, Any]] = None
    if bool(integ.get("include", True)):
        i_items = [safe_str(x) for x in ensure_list(integ.get("items")) if safe_str(x)]
        integrations_out = {
            "@optional": safe_str(integ.get("optional"), "true") if safe_str(integ.get("optional"), "true") in ("true", "false") else "true",
        }
        integrations_out.update(media_block("integrations"))
        integrations_out["title"] = safe_str(integ.get("title"), "Integraciones")
        notes = safe_str(integ.get("notes"), "")
        if notes:
            integrations_out["notes"] = notes
        integrations_out["items"] = {"item": i_items if i_items else ["Exportación a CSV/Excel", "API bajo demanda"]}

    t_points = clamp_list(ensure_list(trust.get("points")), 3, 30, "Diseñado para necesidades reales.")
    trust_out: Dict[str, Any] = {}
    trust_out.update(media_block("trust"))
    trust_out.update({"title": safe_str(trust.get("title"), "Confianza"), "points": {"point": [safe_str(x, "Diseñado para necesidades reales.") for x in t_points]}})

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
    finalcta_out["contact"] = {
        "email": safe_str(contact.get("email"), "info@jocarsa.com"),
        "form": {"field": field_out},
    }

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
# PER-PROJECT PROCESS
# =====================================================
def process_one_project(project_path: Path, output_root: Path) -> None:
    if not project_path.exists():
        eprint(f"[SKIP] No existe: {project_path}")
        return
    if not project_path.is_dir():
        eprint(f"[SKIP] No es carpeta: {project_path}")
        return

    ts = dt.datetime.now().strftime("%Y%m%d%H%M%S")
    project_slug = slugify(project_path.name)
    product_type = DEFAULT_PRODUCT_TYPE

    # Per-project folder inside output_root (keeps things tidy)
    out_dir = output_root / project_slug
    out_dir.mkdir(parents=True, exist_ok=True)

    images = default_images(project_slug, ts)

    eprint(f"\n=== {project_slug} ===")
    eprint(f">> Modelo remoto: {REMOTE_MODEL}")
    eprint(f">> Proyecto: {project_path}")
    eprint(f">> Output: {out_dir}")

    # 1) Report
    report_path = run_lightgoldenrodyellow(project_path, out_dir, LIGHTGOLDENRODYELLOW)
    report_text = read_text(report_path)
    eprint(f">> Reporte: {report_path} ({len(report_text)} chars)")

    # 2) Marketing context
    context = extract_marketing_context(report_text, max_chars=12000)
    ctx_path = out_dir / f"{project_slug}_{ts}_context_comercial.txt"
    ctx_path.write_text(context, encoding="utf-8", errors="replace")
    eprint(f">> Contexto comercial: {ctx_path} ({len(context)} chars)")

    # 3) Generate payload
    last_raw = ""
    payload: Optional[Dict[str, Any]] = None

    for attempt in range(1, MAX_JSON_ATTEMPTS + 1):
        eprint(f">> Generando JSON comercial (intento {attempt}/{MAX_JSON_ATTEMPTS})...")
        q = prompt_generate_marketing_json(context, project_slug, product_type) if attempt == 1 else \
            prompt_repair_json(context, last_raw, "JSON inválido o contiene términos prohibidos")

        raw = call_remote_api(q, timeout=1800)
        last_raw = raw
        raw_path = save_debug(out_dir, project_slug, ts, f"payload_raw_attempt{attempt}", raw)

        js = extract_first_json_object(raw)
        if not js:
            eprint(f"   !! No pude extraer JSON. RAW: {raw_path}")
            continue

        try:
            obj = json.loads(js)
        except Exception as ex:
            eprint(f"   !! JSON parse error: {ex}. RAW: {raw_path}")
            continue

        obj = sanitize_payload(obj)

        bad = has_banned_terms(json.dumps(obj, ensure_ascii=False))
        if bad:
            eprint(f"   !! Contiene término prohibido: '{bad}' incluso tras sanitizar. RAW: {raw_path}")
            continue

        payload = obj
        payload_path = out_dir / f"{project_slug}_{ts}_payload.json"
        payload_path.write_text(json.dumps(payload, ensure_ascii=False, indent=2), encoding="utf-8")
        eprint(f">> Payload OK: {payload_path}")
        break

    if payload is None:
        raise RuntimeError(f"No se pudo obtener JSON comercial válido para {project_slug}.")

    # 4) Build final JSON + sanitize
    final_obj = build_productpage_json(payload, images=images)
    final_obj = sanitize_payload(final_obj)

    bad2 = has_banned_terms(json.dumps(final_obj, ensure_ascii=False))
    if bad2:
        raise RuntimeError(f"El JSON FINAL contiene un término prohibido ('{bad2}') en {project_slug}.")

    # 5) Save final + image map
    json_path = out_dir / f"{project_slug}.json"
    json_path.write_text(json.dumps(final_obj, ensure_ascii=False, indent=2), encoding="utf-8")

    imgmap_path = out_dir / f"{project_slug}_{ts}_images.json"
    imgmap_path.write_text(json.dumps(images, ensure_ascii=False, indent=2), encoding="utf-8")

    print(f"[OK] {project_slug} JSON generado: {json_path}")
    print(f"[OK] {project_slug} Reporte: {report_path}")
    print(f"[OK] {project_slug} Contexto: {ctx_path}")
    print(f"[OK] {project_slug} Mapa de imágenes: {imgmap_path}")

# =====================================================
# MAIN (batch)
# =====================================================
def main():
    output_root = Path(OUTPUT_ROOT).expanduser().resolve()
    output_root.mkdir(parents=True, exist_ok=True)

    if not PROJECT_FOLDERS:
        raise RuntimeError("PROJECT_FOLDERS está vacío. Añade rutas de proyectos.")

    ok = 0
    skip = 0
    err = 0

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

