#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
006-mejora_comercial_full.py

UPDATED:
- Image filenames are now UNIQUE per project and per run:
  img/<project-slug>_<timestamp>_<section>.jpg

Example for project "/var/www/html/jocarsa-rosybrown":
  img/jocarsa-rosybrown_20251215225448_hero.jpg
  img/jocarsa-rosybrown_20251215225448_problem.jpg
  ...

Everything else:
- Calls lightgoldenrodyellow.py
- Calls remote api.php (model forced)
- Produces commercial JSON then builds STRICT XSD-compliant XML
- Pretty prints + optional XSD validation (lxml)

Usage:
  python3 006-mejora_comercial_full.py /var/www/html/jocarsa-rosybrown/ /home/josevicente/Escritorio/

Requirements:
  pip install requests urllib3
  (recommended) pip install lxml
"""

from __future__ import annotations

import argparse
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
# XSD HARDCODED (CONTRACT)
# =====================================================
PRODUCT_PAGE_XSD = r"""<?xml version="1.0" encoding="UTF-8"?>
<xs:schema
  xmlns:xs="http://www.w3.org/2001/XMLSchema"
  elementFormDefault="qualified"
  attributeFormDefault="unqualified">

  <xs:element name="productPage" type="ProductPageType"/>

  <xs:complexType name="ProductPageType">
    <xs:sequence>
      <xs:element name="meta" type="MetaType"/>
      <xs:element name="hero" type="HeroType"/>
      <xs:element name="problem" type="TitledItemsWithMediaType"/>
      <xs:element name="solution" type="SolutionWithMediaType"/>
      <xs:element name="keyFeatures" type="KeyFeaturesWithMediaType"/>
      <xs:element name="targetAudience" type="TargetAudienceWithMediaType"/>
      <xs:element name="useCases" type="UseCasesWithMediaType"/>
      <xs:element name="benefits" type="TitledItemsWithMediaType"/>
      <xs:element name="integrations" type="IntegrationsWithMediaType" minOccurs="0"/>
      <xs:element name="trust" type="TrustWithMediaType"/>
      <xs:element name="finalCTA" type="FinalCTAWithMediaType"/>
      <xs:element name="faq" type="FAQWithMediaType"/>
      <xs:element name="footer" type="FooterType"/>
    </xs:sequence>

    <xs:attribute name="lang" type="xs:language" use="required"/>
    <xs:attribute name="type" type="xs:string" use="required"/>
    <xs:attribute name="version" type="xs:string" use="required"/>
  </xs:complexType>

  <xs:complexType name="MediaType">
    <xs:sequence>
      <xs:element name="image" type="ImageType" minOccurs="0"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="ImageType">
    <xs:attribute name="src" type="xs:anyURI" use="required"/>
    <xs:attribute name="alt" type="xs:string" use="optional"/>
  </xs:complexType>

  <xs:complexType name="MetaType">
    <xs:sequence>
      <xs:element name="slug" type="xs:string"/>
      <xs:element name="title" type="xs:string"/>
      <xs:element name="category" type="xs:string"/>
      <xs:element name="audience" type="AudienceType" minOccurs="0"/>
      <xs:element name="ctaPrimary" type="xs:string" minOccurs="0"/>
      <xs:element name="ctaSecondary" type="xs:string" minOccurs="0"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="AudienceType">
    <xs:sequence>
      <xs:element name="segment" type="xs:string" minOccurs="1" maxOccurs="unbounded"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="HeroType">
    <xs:sequence>
      <xs:element name="media" type="MediaType" minOccurs="0"/>
      <xs:element name="name" type="xs:string"/>
      <xs:element name="valueProposition" type="xs:string"/>
      <xs:element name="subtitle" type="xs:string" minOccurs="0"/>
      <xs:element name="badges" type="BadgesType" minOccurs="0"/>
      <xs:element name="actions" type="ActionsType" minOccurs="0"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="BadgesType">
    <xs:sequence>
      <xs:element name="badge" type="xs:string" minOccurs="1" maxOccurs="unbounded"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="ActionsType">
    <xs:sequence>
      <xs:element name="action" type="ActionType" minOccurs="1" maxOccurs="unbounded"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="ActionType">
    <xs:simpleContent>
      <xs:extension base="xs:string">
        <xs:attribute name="type" use="optional">
          <xs:simpleType>
            <xs:restriction base="xs:string">
              <xs:enumeration value="primary"/>
              <xs:enumeration value="secondary"/>
              <xs:enumeration value="tertiary"/>
            </xs:restriction>
          </xs:simpleType>
        </xs:attribute>
      </xs:extension>
    </xs:simpleContent>
  </xs:complexType>

  <xs:complexType name="TitledItemsWithMediaType">
    <xs:sequence>
      <xs:element name="media" type="MediaType" minOccurs="0"/>
      <xs:element name="title" type="xs:string"/>
      <xs:element name="items" type="ItemsType"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="ItemsType">
    <xs:sequence>
      <xs:element name="item" type="xs:string" minOccurs="1" maxOccurs="unbounded"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="SolutionWithMediaType">
    <xs:sequence>
      <xs:element name="media" type="MediaType" minOccurs="0"/>
      <xs:element name="title" type="xs:string"/>
      <xs:element name="overview" type="xs:string"/>
      <xs:element name="whatChanges" type="WhatChangesType" minOccurs="0"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="WhatChangesType">
    <xs:sequence>
      <xs:element name="change" type="xs:string" minOccurs="1" maxOccurs="unbounded"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="KeyFeaturesWithMediaType">
    <xs:sequence>
      <xs:element name="media" type="MediaType" minOccurs="0"/>
      <xs:element name="title" type="xs:string"/>
      <xs:element name="feature" type="FeatureType" minOccurs="1" maxOccurs="unbounded"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="FeatureType">
    <xs:sequence>
      <xs:element name="name" type="xs:string"/>
      <xs:element name="benefit" type="xs:string"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="TargetAudienceWithMediaType">
    <xs:sequence>
      <xs:element name="media" type="MediaType" minOccurs="0"/>
      <xs:element name="title" type="xs:string"/>
      <xs:element name="profiles" type="ProfilesType"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="ProfilesType">
    <xs:sequence>
      <xs:element name="profile" type="ProfileType" minOccurs="1" maxOccurs="unbounded"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="ProfileType">
    <xs:sequence>
      <xs:element name="name" type="xs:string"/>
      <xs:element name="fit" type="xs:string"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="UseCasesWithMediaType">
    <xs:sequence>
      <xs:element name="media" type="MediaType" minOccurs="0"/>
      <xs:element name="title" type="xs:string"/>
      <xs:element name="case" type="UseCaseType" minOccurs="1" maxOccurs="unbounded"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="UseCaseType">
    <xs:sequence>
      <xs:element name="name" type="xs:string"/>
      <xs:element name="description" type="xs:string"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="IntegrationsWithMediaType">
    <xs:sequence>
      <xs:element name="media" type="MediaType" minOccurs="0"/>
      <xs:element name="title" type="xs:string"/>
      <xs:element name="notes" type="xs:string" minOccurs="0"/>
      <xs:element name="items" type="ItemsType"/>
    </xs:sequence>

    <xs:attribute name="optional" use="optional">
      <xs:simpleType>
        <xs:restriction base="xs:string">
          <xs:enumeration value="true"/>
          <xs:enumeration value="false"/>
        </xs:restriction>
      </xs:simpleType>
    </xs:attribute>
  </xs:complexType>

  <xs:complexType name="TrustWithMediaType">
    <xs:sequence>
      <xs:element name="media" type="MediaType" minOccurs="0"/>
      <xs:element name="title" type="xs:string"/>
      <xs:element name="points" type="PointsType"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="PointsType">
    <xs:sequence>
      <xs:element name="point" type="xs:string" minOccurs="1" maxOccurs="unbounded"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="FinalCTAWithMediaType">
    <xs:sequence>
      <xs:element name="media" type="MediaType" minOccurs="0"/>
      <xs:element name="title" type="xs:string"/>
      <xs:element name="description" type="xs:string" minOccurs="0"/>
      <xs:element name="actions" type="ActionsType" minOccurs="0"/>
      <xs:element name="contact" type="ContactType" minOccurs="0"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="ContactType">
    <xs:sequence>
      <xs:element name="email" type="xs:string" minOccurs="0"/>
      <xs:element name="form" type="FormType" minOccurs="0"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="FormType">
    <xs:sequence>
      <xs:element name="field" type="FieldType" minOccurs="1" maxOccurs="unbounded"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="FieldType">
    <xs:attribute name="name" type="xs:string" use="required"/>
    <xs:attribute name="type" use="required">
      <xs:simpleType>
        <xs:restriction base="xs:string">
          <xs:enumeration value="text"/>
          <xs:enumeration value="email"/>
          <xs:enumeration value="tel"/>
          <xs:enumeration value="textarea"/>
          <xs:enumeration value="number"/>
          <xs:enumeration value="select"/>
          <xs:enumeration value="checkbox"/>
        </xs:restriction>
      </xs:simpleType>
    </xs:attribute>
    <xs:attribute name="required" use="required">
      <xs:simpleType>
        <xs:restriction base="xs:string">
          <xs:enumeration value="true"/>
          <xs:enumeration value="false"/>
        </xs:restriction>
      </xs:simpleType>
    </xs:attribute>
  </xs:complexType>

  <xs:complexType name="FAQWithMediaType">
    <xs:sequence>
      <xs:element name="media" type="MediaType" minOccurs="0"/>
      <xs:element name="title" type="xs:string"/>
      <xs:element name="qa" type="QAType" minOccurs="1" maxOccurs="unbounded"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="QAType">
    <xs:sequence>
      <xs:element name="q" type="xs:string"/>
      <xs:element name="a" type="xs:string"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="FooterType">
    <xs:sequence>
      <xs:element name="summary" type="xs:string"/>
    </xs:sequence>
  </xs:complexType>

</xs:schema>
"""

# =====================================================
# BAN LIST (do NOT ban "manual"; we sanitize it)
# =====================================================
BANNED_TERMS = [
    "inyección", "xss", "csrf", "sql injection", "sentencias preparadas", "prepared statement",
    "refactor", "optimizar", "vulnerab", "desarrollador", "developer", "endpoint", "pdo",
]

# =====================================================
# SANITIZER (replace "manual" without failing)
# =====================================================
SANITIZE_REPLACEMENTS = [
    (re.compile(r"\bde forma manual\b", re.IGNORECASE), "de forma tradicional"),
    (re.compile(r"\bprocesos? manual(es)?\b", re.IGNORECASE), "procesos tradicionales"),
    (re.compile(r"\bmanual(es)?\b", re.IGNORECASE), lambda m: "tradicional" + (m.group(1) or "")),
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
                return text[start:i+1].strip()
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
    """
    Unique deterministic filename per run:
      img/<project_slug>_<ts>_<section>.jpg
    """
    section = re.sub(r"[^a-z0-9_-]+", "", section.lower())
    return f"img/{project_slug}_{ts}_{section}.jpg"

def default_images(project_slug: str, ts: str) -> Dict[str, Tuple[str, str]]:
    """
    Creates a unique image map for this run.
    Keys are used by builder to select each section.
    """
    return {
        "hero": (image_src(project_slug, ts, "hero"), "Software de facturación y administración"),
        "problem": (image_src(project_slug, ts, "problem"), "Problemas habituales en facturación"),
        "solution": (image_src(project_slug, ts, "solution"), "Solución centralizada"),
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
# PROMPTS
# =====================================================
def prompt_generate_marketing_json(context: str, slug: str, product_type: str) -> str:
    return f"""
Eres un copywriter senior de SaaS (orientado a venta). Devuelve SOLO JSON válido (sin texto fuera del JSON).

REGLAS:
- Nada de lenguaje para desarrolladores: no menciones SQL injection, XSS, CSRF, sesiones, refactor, optimización de código, etc.
- Enfoque cliente final.
- Dominio: software de facturación y administración (facturas, presupuestos, clientes, productos, proveedores, gastos, IVA, informes).
- Evita texto tipo "manual de usuario" o "manual técnico". Habla de valor, claridad y resultados.

FORMATO JSON (claves exactas):
{{
  "lang": "es",
  "type": "{product_type}",
  "version": "1.1",
  "meta": {{
    "slug": "{slug}",
    "title": "...",
    "category": "...",
    "audience_segments": ["...", "...", "..."],
    "ctaPrimary": "...",
    "ctaSecondary": "..."
  }},
  "hero": {{
    "name": "...",
    "valueProposition": "...",
    "subtitle": "...",
    "badges": ["...", "...", "..."],
    "actions": [
      {{"type":"primary","text":"..."}},
      {{"type":"secondary","text":"..."}},
      {{"type":"tertiary","text":"..."}}
    ]
  }},
  "problem": {{
    "title": "...",
    "items": ["...", "...", "...", "...", "..."]
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
    "items": ["...", "...", "...", "...", "..."]
  }},
  "integrations": {{
    "include": true,
    "optional": "true",
    "title": "...",
    "notes": "...",
    "items": ["...", "...", "...", "..."]
  }},
  "trust": {{
    "title": "...",
    "points": ["...", "...", "...", "..."]
  }},
  "finalCTA": {{
    "title": "...",
    "description": "...",
    "actions": [
      {{"type":"primary","text":"..."}},
      {{"type":"secondary","text":"..."}}
    ],
    "contact": {{
      "email": "contacto@tudominio.com",
      "fields": [
        {{"name":"nombre","type":"text","required":"true"}},
        {{"name":"empresa","type":"text","required":"false"}},
        {{"name":"email","type":"email","required":"true"}},
        {{"name":"telefono","type":"tel","required":"false"}},
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
- SQL injection, XSS, CSRF, sesiones, refactor, optimización, vulnerabilidades, etc.
- No escribas "manual de usuario" ni "manual técnico".

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
# XML BUILD + PRETTY PRINT
# =====================================================
def build_xml_from_payload(payload: Dict[str, Any], images: Dict[str, Tuple[str, str]], pretty: bool = True) -> str:
    import xml.etree.ElementTree as ET

    def add_media(parent: ET.Element, key: str):
        src, alt = images[key]
        media = ET.SubElement(parent, "media")
        ET.SubElement(media, "image", {"src": src, "alt": alt})

    def add_actions(parent: ET.Element, actions: List[Dict[str, Any]]):
        a = ET.SubElement(parent, "actions")
        for act in actions:
            atype = safe_str(act.get("type"), "")
            text = safe_str(act.get("text"), "Acción")
            attrs = {}
            if atype in ("primary", "secondary", "tertiary"):
                attrs["type"] = atype
            ET.SubElement(a, "action", attrs).text = text

    lang = safe_str(payload.get("lang"), "es")
    ptype = safe_str(payload.get("type"), "softwareFacturacion")
    ver = safe_str(payload.get("version"), "1.1")

    root = ET.Element("productPage", {"lang": lang, "type": ptype, "version": ver})

    # meta
    meta = ET.SubElement(root, "meta")
    m = payload.get("meta", {}) or {}
    ET.SubElement(meta, "slug").text = safe_str(m.get("slug"), "producto")
    ET.SubElement(meta, "title").text = safe_str(m.get("title"), "Software de facturación")
    ET.SubElement(meta, "category").text = safe_str(m.get("category"), "SaaS de facturación")

    segs = clamp_list(ensure_list(m.get("audience_segments")), 2, 10, "Autónomos")
    aud = ET.SubElement(meta, "audience")
    for s in segs:
        ET.SubElement(aud, "segment").text = safe_str(s, "Autónomos")

    cta1 = safe_str(m.get("ctaPrimary"), "Solicitar demo")
    cta2 = safe_str(m.get("ctaSecondary"), "Ver funcionalidades")
    ET.SubElement(meta, "ctaPrimary").text = cta1
    ET.SubElement(meta, "ctaSecondary").text = cta2

    # hero
    hero = ET.SubElement(root, "hero")
    add_media(hero, "hero")
    h = payload.get("hero", {}) or {}
    ET.SubElement(hero, "name").text = safe_str(h.get("name"), "Facturación clara, control total")
    ET.SubElement(hero, "valueProposition").text = safe_str(
        h.get("valueProposition"),
        "Emite facturas, controla cobros y ordena tu negocio desde un solo panel."
    )
    subtitle = safe_str(h.get("subtitle"), "")
    if subtitle:
        ET.SubElement(hero, "subtitle").text = subtitle

    badges = clamp_list(ensure_list(h.get("badges")), 3, 8, "Acceso web")
    b = ET.SubElement(hero, "badges")
    for x in badges:
        ET.SubElement(b, "badge").text = safe_str(x, "Acceso web")

    hero_actions = ensure_list(h.get("actions"))
    if not hero_actions:
        hero_actions = [
            {"type": "primary", "text": cta1},
            {"type": "secondary", "text": cta2},
            {"type": "tertiary", "text": "Contactar"},
        ]
    add_actions(hero, clamp_list(hero_actions, 2, 6, {"type": "secondary", "text": "Ver más"}))

    # problem
    problem = ET.SubElement(root, "problem")
    add_media(problem, "problem")
    p = payload.get("problem", {}) or {}
    ET.SubElement(problem, "title").text = safe_str(p.get("title"), "Problemas habituales en facturación")
    items = ET.SubElement(problem, "items")
    pitems = clamp_list(ensure_list(p.get("items")), 5, 12, "Falta de control sobre cobros y pagos.")
    for it in pitems:
        ET.SubElement(items, "item").text = safe_str(it, "Falta de control sobre cobros y pagos.")

    # solution
    solution = ET.SubElement(root, "solution")
    add_media(solution, "solution")
    s = payload.get("solution", {}) or {}
    ET.SubElement(solution, "title").text = safe_str(s.get("title"), "La solución")
    ET.SubElement(solution, "overview").text = safe_str(
        s.get("overview"),
        "Centraliza facturas, presupuestos, clientes, productos, gastos e informes en una herramienta clara y rápida."
    )
    wc_list = clamp_list(ensure_list(s.get("whatChanges")), 3, 10, "Más claridad y menos tiempo administrativo.")
    wc = ET.SubElement(solution, "whatChanges")
    for ch in wc_list:
        ET.SubElement(wc, "change").text = safe_str(ch, "Más claridad y menos tiempo administrativo.")

    # keyFeatures
    keyf = ET.SubElement(root, "keyFeatures")
    add_media(keyf, "features")
    kf = payload.get("keyFeatures", {}) or {}
    ET.SubElement(keyf, "title").text = safe_str(kf.get("title"), "Funcionalidades clave")
    feats = ensure_list(kf.get("features"))
    if not feats:
        feats = [
            {"name": "Facturas y presupuestos", "benefit": "Emite documentos profesionales con historial por cliente."},
            {"name": "Clientes y productos", "benefit": "Centraliza datos para facturar más rápido y con menos errores."},
            {"name": "Gastos e impuestos", "benefit": "Control fiscal con visión clara de IVA y márgenes."},
            {"name": "Informes", "benefit": "Reportes de ingresos y evolución para decidir mejor."},
        ]
    feats = clamp_list(feats, 4, 12, {"name": "Gestión", "benefit": "Control centralizado."})
    for f in feats:
        fe = ET.SubElement(keyf, "feature")
        ET.SubElement(fe, "name").text = safe_str((f or {}).get("name"), "Funcionalidad")
        ET.SubElement(fe, "benefit").text = safe_str((f or {}).get("benefit"), "Beneficio")

    # targetAudience
    targ = ET.SubElement(root, "targetAudience")
    add_media(targ, "audience")
    ta = payload.get("targetAudience", {}) or {}
    ET.SubElement(targ, "title").text = safe_str(ta.get("title"), "¿Para quién es?")
    profs = ET.SubElement(targ, "profiles")
    plist = ensure_list(ta.get("profiles"))
    if not plist:
        plist = [
            {"name": "Autónomos", "fit": "Para emitir facturas y controlar el negocio con claridad."},
            {"name": "Pymes", "fit": "Para ordenar facturación, gastos e informes sin herramientas dispersas."},
            {"name": "Despachos", "fit": "Para trabajar con procesos claros y trazables con clientes."},
        ]
    plist = clamp_list(plist, 3, 10, {"name": "Autónomos", "fit": "Para facturar y controlar el negocio."})
    for pr in plist:
        pnode = ET.SubElement(profs, "profile")
        ET.SubElement(pnode, "name").text = safe_str((pr or {}).get("name"), "Perfil")
        ET.SubElement(pnode, "fit").text = safe_str((pr or {}).get("fit"), "Encaje")

    # useCases
    uc = ET.SubElement(root, "useCases")
    add_media(uc, "usecases")
    ucp = payload.get("useCases", {}) or {}
    ET.SubElement(uc, "title").text = safe_str(ucp.get("title"), "Casos de uso reales")
    clist = ensure_list(ucp.get("cases"))
    if not clist:
        clist = [
            {"name": "Emisión de facturas", "description": "Crea facturas en minutos con historial por cliente."},
            {"name": "Control de cobros", "description": "Identifica rápidamente facturas pendientes y cobradas."},
            {"name": "Cierre de trimestre", "description": "Resumen por periodos con datos listos para revisión."},
        ]
    clist = clamp_list(clist, 3, 12, {"name": "Facturar", "description": "Emitir documentos y controlar estados."})
    for c in clist:
        ce = ET.SubElement(uc, "case")
        ET.SubElement(ce, "name").text = safe_str((c or {}).get("name"), "Caso")
        ET.SubElement(ce, "description").text = safe_str((c or {}).get("description"), "Descripción")

    # benefits
    benefits = ET.SubElement(root, "benefits")
    add_media(benefits, "benefits")
    be = payload.get("benefits", {}) or {}
    ET.SubElement(benefits, "title").text = safe_str(be.get("title"), "Beneficios")
    bitems = ET.SubElement(benefits, "items")
    blist = ensure_list(be.get("items"))
    if not blist:
        blist = [
            "Ahorro de tiempo administrativo en el día a día.",
            "Menos errores en facturación y cálculos.",
            "Información centralizada y fácil de consultar.",
            "Mayor control sobre ingresos, gastos y márgenes.",
            "Base sólida para crecer con orden y trazabilidad.",
        ]
    blist = clamp_list(blist, 5, 12, "Ahorro de tiempo administrativo.")
    for it in blist:
        ET.SubElement(bitems, "item").text = safe_str(it, "Ahorro de tiempo administrativo.")

    # integrations (optional)
    integ = payload.get("integrations", {}) or {}
    include_integrations = bool(integ.get("include", True))
    if include_integrations:
        integrations = ET.SubElement(root, "integrations")
        opt = safe_str(integ.get("optional"), "true")
        if opt in ("true", "false"):
            integrations.set("optional", opt)
        add_media(integrations, "integrations")
        ET.SubElement(integrations, "title").text = safe_str(integ.get("title"), "Integración y compatibilidad")
        notes = safe_str(integ.get("notes"), "Compatible con flujos habituales de trabajo y exportación de datos.")
        ET.SubElement(integrations, "notes").text = notes
        ii = ET.SubElement(integrations, "items")
        ilist = ensure_list(integ.get("items"))
        if not ilist:
            ilist = ["Exportación de datos", "Acceso web multiplataforma", "Importación desde CSV/Excel", "Integración bajo demanda"]
        ilist = clamp_list(ilist, 4, 12, "Exportación de datos")
        for it in ilist:
            ET.SubElement(ii, "item").text = safe_str(it, "Exportación de datos")

    # trust
    trust = ET.SubElement(root, "trust")
    add_media(trust, "trust")
    tr = payload.get("trust", {}) or {}
    ET.SubElement(trust, "title").text = safe_str(tr.get("title"), "Confianza")
    pts = ET.SubElement(trust, "points")
    tlist = ensure_list(tr.get("points"))
    if not tlist:
        tlist = [
            "Diseñado para necesidades reales de facturación.",
            "Interfaz clara y fácil de usar.",
            "Enfoque en consistencia y trazabilidad.",
            "Buenas prácticas y cumplimiento RGPD.",
        ]
    tlist = clamp_list(tlist, 4, 12, "Pensado para uso real.")
    for pnt in tlist:
        ET.SubElement(pts, "point").text = safe_str(pnt, "Pensado para uso real.")

    # finalCTA
    fcta = ET.SubElement(root, "finalCTA")
    add_media(fcta, "cta")
    fc = payload.get("finalCTA", {}) or {}
    ET.SubElement(fcta, "title").text = safe_str(fc.get("title"), "¿Quieres verlo en acción?")
    desc = safe_str(fc.get("description"), "Cuéntanos tu caso y te mostramos una demo enfocada en tu día a día.")
    if desc:
        ET.SubElement(fcta, "description").text = desc

    def add_actions(parent: Any, actions: List[Dict[str, Any]]):
        a = parent.find("actions")
        if a is None:
            a = __import__("xml.etree.ElementTree").ElementTree  # type: ignore
        # overridden below, so no-op

    f_actions = ensure_list(fc.get("actions"))
    if not f_actions:
        f_actions = [
            {"type": "primary", "text": safe_str(payload.get("meta", {}).get("ctaPrimary"), "Solicitar demo")},
            {"type": "secondary", "text": "Contactar"},
        ]

    # add actions properly (reuse earlier local helper)
    actions_el = __import__("xml.etree.ElementTree").ElementTree  # type: ignore  # placeholder to satisfy linter
    # re-create real helper in this scope:
    import xml.etree.ElementTree as ET2
    actions_el = ET2.SubElement(fcta, "actions")
    for act in clamp_list(f_actions, 2, 6, {"type": "secondary", "text": "Contactar"}):
        atype = safe_str(act.get("type"), "")
        text = safe_str(act.get("text"), "Acción")
        attrs = {}
        if atype in ("primary", "secondary", "tertiary"):
            attrs["type"] = atype
        ET2.SubElement(actions_el, "action", attrs).text = text

    contact = fc.get("contact", {}) or {}
    c = ET.SubElement(fcta, "contact")
    ET.SubElement(c, "email").text = safe_str(contact.get("email"), "contacto@tudominio.com")
    form = ET.SubElement(c, "form")
    fields = ensure_list(contact.get("fields"))
    if not fields:
        fields = [
            {"name": "nombre", "type": "text", "required": "true"},
            {"name": "empresa", "type": "text", "required": "false"},
            {"name": "email", "type": "email", "required": "true"},
            {"name": "telefono", "type": "tel", "required": "false"},
            {"name": "mensaje", "type": "textarea", "required": "true"},
        ]
    for fld in clamp_list(fields, 3, 12, {"name": "nombre", "type": "text", "required": "true"}):
        name = safe_str((fld or {}).get("name"), "campo")
        ftype = safe_str((fld or {}).get("type"), "text")
        required = safe_str((fld or {}).get("required"), "true")
        if ftype not in ("text", "email", "tel", "textarea", "number", "select", "checkbox"):
            ftype = "text"
        if required not in ("true", "false"):
            required = "true"
        ET.SubElement(form, "field", {"name": name, "type": ftype, "required": required})

    # faq
    faq = ET.SubElement(root, "faq")
    add_media(faq, "faq")
    fq = payload.get("faq", {}) or {}
    ET.SubElement(faq, "title").text = safe_str(fq.get("title"), "Preguntas frecuentes")
    qas = ensure_list(fq.get("qas"))
    if not qas:
        qas = [
            {"q": "¿Necesita instalación?", "a": "No. Se accede desde navegador."},
            {"q": "¿Está pensado para autónomos?", "a": "Sí. Para facturar y controlar el negocio con rapidez."},
            {"q": "¿Puedo gestionar gastos e IVA?", "a": "Sí. Incluye gestión de gastos y visión por periodos."},
        ]
    qas = clamp_list(qas, 3, 12, {"q": "¿Funciona en web?", "a": "Sí."})
    for qa in qas:
        qa_el = ET.SubElement(faq, "qa")
        ET.SubElement(qa_el, "q").text = safe_str((qa or {}).get("q"), "Pregunta")
        ET.SubElement(qa_el, "a").text = safe_str((qa or {}).get("a"), "Respuesta")

    # footer
    footer = ET.SubElement(root, "footer")
    fo = payload.get("footer", {}) or {}
    ET.SubElement(footer, "summary").text = safe_str(
        fo.get("summary"),
        "Esta página resume qué es el producto, qué problema resuelve, para quién es y cuál es el siguiente paso."
    )

    xml_bytes = ET.tostring(root, encoding="utf-8")

    if pretty:
        try:
            from lxml import etree
            parser = etree.XMLParser(remove_blank_text=True)
            doc = etree.fromstring(xml_bytes, parser=parser)
            pretty_xml = etree.tostring(doc, encoding="utf-8", xml_declaration=True, pretty_print=True).decode("utf-8")
            return pretty_xml + "\n"
        except Exception:
            pass

        try:
            from xml.dom import minidom
            dom = minidom.parseString(xml_bytes)
            pretty_xml = dom.toprettyxml(indent="  ", encoding="utf-8").decode("utf-8")
            pretty_xml = "\n".join([ln for ln in pretty_xml.splitlines() if ln.strip() != ""])
            return pretty_xml + "\n"
        except Exception:
            pass

    return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" + xml_bytes.decode("utf-8") + "\n"

def validate_xsd(xml_text: str, xsd_text: str) -> Tuple[bool, str]:
    try:
        from lxml import etree
    except Exception:
        return True, "lxml no instalado: validación XSD omitida (recomendado: pip install lxml)"
    try:
        xml_doc = etree.fromstring(xml_text.encode("utf-8"))
        xsd_doc = etree.fromstring(xsd_text.encode("utf-8"))
        schema = etree.XMLSchema(xsd_doc)
        schema.assertValid(xml_doc)
        return True, "OK"
    except Exception as ex:
        return False, str(ex)

# =====================================================
# MAIN
# =====================================================
def main():
    ap = argparse.ArgumentParser()
    ap.add_argument("project_path")
    ap.add_argument("output_dir")
    ap.add_argument("--light", default=LIGHTGOLDENRODYELLOW)
    ap.add_argument("--type", default="softwareFacturacion")
    ap.add_argument("--max-json-attempts", type=int, default=5)
    args = ap.parse_args()

    project_path = Path(args.project_path).expanduser().resolve()
    out_dir = Path(args.output_dir).expanduser().resolve()
    out_dir.mkdir(parents=True, exist_ok=True)

    ts = dt.datetime.now().strftime("%Y%m%d%H%M%S")
    project_slug = slugify(project_path.name)
    product_type = (args.type or "softwareFacturacion").strip() or "softwareFacturacion"

    # build unique images map for this run
    images = default_images(project_slug, ts)

    eprint(f">> Modelo remoto: {REMOTE_MODEL}")
    eprint(f">> Proyecto: {project_path}")

    # 1) Report
    report_path = run_lightgoldenrodyellow(project_path, out_dir, args.light)
    report_text = read_text(report_path)
    eprint(f">> Reporte: {report_path} ({len(report_text)} chars)")

    # 2) Marketing context
    context = extract_marketing_context(report_text, max_chars=12000)
    ctx_path = out_dir / f"{project_slug}_{ts}_context_comercial.txt"
    ctx_path.write_text(context, encoding="utf-8", errors="replace")
    eprint(f">> Contexto comercial guardado: {ctx_path} ({len(context)} chars)")

    # 3) Generate JSON payload
    last_raw = ""
    payload: Optional[Dict[str, Any]] = None

    for attempt in range(1, args.max_json_attempts + 1):
        eprint(f">> Generando JSON comercial (intento {attempt}/{args.max_json_attempts})...")
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
        raise RuntimeError("No se pudo obtener un JSON comercial válido tras varios intentos.")

    # 4) Build XML (pretty) with unique images
    xml_text = build_xml_from_payload(payload, images=images, pretty=True)
    xml_text = sanitize_text(xml_text)

    bad2 = has_banned_terms(xml_text)
    if bad2:
        raise RuntimeError(f"El XML construido contiene un término prohibido ('{bad2}'). Revisa payload/contexto.")

    # 5) XSD validation (if lxml exists)
    ok, msg = validate_xsd(xml_text, PRODUCT_PAGE_XSD)
    if not ok:
        err_path = out_dir / f"{project_slug}_{ts}_xsd_error.txt"
        err_path.write_text(msg, encoding="utf-8", errors="replace")
        raise RuntimeError(f"XML NO válido contra XSD. Error guardado en: {err_path}")

    # 6) Save final XML
    xml_path = out_dir / f"{project_slug}_{ts}.xml"
    xml_path.write_text(xml_text, encoding="utf-8", errors="replace")

    # also save image map (so you can generate those images later)
    imgmap_path = out_dir / f"{project_slug}_{ts}_images.json"
    imgmap_path.write_text(json.dumps(images, ensure_ascii=False, indent=2), encoding="utf-8")

    print(f"[OK] XML generado: {xml_path}")
    print(f"[OK] Modelo: {REMOTE_MODEL}")
    print(f"[OK] Reporte: {report_path}")
    print(f"[OK] Contexto comercial: {ctx_path}")
    print(f"[OK] Validación XSD: {msg}")
    print(f"[OK] Mapa de imágenes: {imgmap_path}")

if __name__ == "__main__":
    try:
        main()
    except Exception as ex:
        eprint(f"\n[ERROR] {ex}")
        sys.exit(1)

