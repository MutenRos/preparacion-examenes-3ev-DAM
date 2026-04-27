#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
006-json2xml_xsd_robusto.py

Estrategia:
- El modelo NO devuelve XML.
- El modelo devuelve JSON con campos (texto/listas).
- El script genera el XML EXACTO según XSD y valida localmente.
- Si el JSON es inválido, reintenta con "repair" (y guarda debug).

Uso:
  python3 006-json2xml_xsd_robusto.py /var/www/html/jocarsa-rosybrown/ /home/josevicente/Escritorio/

Requisitos:
  pip install requests urllib3 lxml
"""

from __future__ import annotations

import argparse
import datetime as dt
import json
import re
import subprocess
import sys
from pathlib import Path
from typing import Any, Dict, List, Tuple, Optional

import requests
import urllib3
urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

from lxml import etree


# =====================================================
# REMOTE API CONFIG (NO SERVER CHANGES)
# =====================================================
API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php"
API_KEY = "TEST_API_KEY_JOCARSA_123"
VERIFY_SSL = False

# Puedes cambiar a:
# REMOTE_MODEL = "llama3.1:8b-instruct-q4_0"
# REMOTE_MODEL = "gemma2:9b-instruct-q4_0"
REMOTE_MODEL = "qwen2.5:7b-instruct-q4_0"


# =====================================================
# LIGHTGOLDENRODYELLOW
# =====================================================
LIGHTGOLDENRODYELLOW = "/var/www/html/jocarsa-lightgoldenrodyellow/lightgoldenrodyellow.py"


# =====================================================
# SIZE / SUMMARIZATION
# =====================================================
MAX_DIRECT_CHARS = 60_000
CHUNK_SIZE = 18_000
TARGET_CONTEXT_CHARS = 12_000


# =====================================================
# RETRIES
# =====================================================
MAX_JSON_ATTEMPTS = 5


# =====================================================
# XSD HARDCODED
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
# UTIL
# =====================================================
def eprint(*args, **kwargs):
    print(*args, file=sys.stderr, **kwargs)


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


def read_text(p: Path) -> str:
    return p.read_text(encoding="utf-8", errors="replace")


def chunk_text(text: str, size: int) -> List[str]:
    return [text[i:i + size] for i in range(0, len(text), size)]


def save_debug(out_dir: Path, slug: str, ts: str, label: str, content: str) -> Path:
    p = out_dir / f"{slug}_{ts}_{label}.txt"
    p.write_text(content, encoding="utf-8", errors="replace")
    return p


def slugify(s: str) -> str:
    s = s.lower().strip()
    s = re.sub(r"[^\w\s-]", "", s, flags=re.UNICODE)
    s = re.sub(r"[\s_-]+", "-", s)
    return s.strip("-") or "producto"


def compile_xsd_schema(xsd_text: str) -> etree.XMLSchema:
    xsd_doc = etree.XML(xsd_text.encode("utf-8"))
    return etree.XMLSchema(xsd_doc)


def validate_against_xsd(schema: etree.XMLSchema, xml_bytes: bytes) -> Tuple[bool, str]:
    try:
        doc = etree.fromstring(xml_bytes)
    except Exception as ex:
        return False, f"XML no parseable: {ex}"

    ok = schema.validate(doc)
    if ok:
        return True, ""

    errors = []
    for e in list(schema.error_log)[:50]:
        errors.append(f"L{e.line}:C{e.column} - {e.message}")
    return False, "\n".join(errors)


def infer_type_from_context(context: str) -> str:
    c = context.lower()
    if any(k in c for k in ["factura", "presupuesto", "cliente", "iva", "cobro", "pago", "albar", "contab"]):
        return "softwareFacturacion"
    if any(k in c for k in ["alumno", "centro", "docente", "moodle", "actas", "matr", "educ"]):
        return "softwareEducativo"
    return "softwareSaaS"


# =====================================================
# PROMPTS (JSON, NO XML)
# =====================================================
def prompt_summarize_chunk(chunk: str, idx: int, total: int) -> str:
    return f"""
Eres un analista técnico. Resume este fragmento de un reporte de código de un software real.

Reglas:
- Responde SOLO texto.
- Español profesional.
- No inventes.
- Extrae: propósito del software, módulos/pantallas, entidades de negocio (facturas/clientes/IVA/pagos si aparecen),
  y cualquier integración (PDF/CSV/email/API) si se menciona.

Fragmento {idx}/{total}:
\"\"\"
{chunk}
\"\"\"
""".strip()


def prompt_merge_summaries(summaries: str) -> str:
    return f"""
Fusiona estos resúmenes en un único contexto final MUY CONDENSADO.

Reglas:
- Responde SOLO texto.
- Máximo ~{TARGET_CONTEXT_CHARS} caracteres.
- Debe incluir:
  1) Qué es el software (1-2 frases)
  2) 8-15 funcionalidades/módulos reales
  3) Público objetivo (3-6 perfiles)
  4) 8-15 palabras clave del dominio

Resúmenes:
\"\"\"
{summaries}
\"\"\"
""".strip()


def prompt_generate_json(context: str, product_type: str, slug: str) -> str:
    return f"""
Devuelve ÚNICAMENTE un JSON válido (sin Markdown, sin ```), siguiendo ESTE ESQUEMA EXACTO.
No incluyas claves extra. No incluyas comentarios.

REGLAS:
- SOLO JSON.
- Todo texto en español.
- No inventes integraciones/módulos que no estén en el contexto.
- Si no sabes un campo, pon una cadena corta y genérica coherente (pero NO vacía).
- Listas con mínimo 1 elemento cuando corresponda.

ESQUEMA:
{{
  "meta": {{
    "slug": "{slug}",
    "title": "...",
    "category": "...",
    "audience": ["...","..."],
    "ctaPrimary": "...",
    "ctaSecondary": "..."
  }},
  "hero": {{
    "image": {{"src":"img/hero.jpg","alt":"..."}},
    "name": "...",
    "valueProposition": "...",
    "subtitle": "...",
    "badges": ["...","..."],
    "actions": [
      {{"type":"primary","text":"..."}},
      {{"type":"secondary","text":"..."}},
      {{"type":"tertiary","text":"..."}}
    ]
  }},
  "problem": {{
    "image": {{"src":"img/problem.jpg","alt":"..."}},
    "title": "...",
    "items": ["...","..."]
  }},
  "solution": {{
    "image": {{"src":"img/solution.jpg","alt":"..."}},
    "title": "...",
    "overview": "...",
    "whatChanges": ["...","..."]
  }},
  "keyFeatures": {{
    "image": {{"src":"img/features.jpg","alt":"..."}},
    "title": "...",
    "features": [
      {{"name":"...","benefit":"..."}}
    ]
  }},
  "targetAudience": {{
    "image": {{"src":"img/audience.jpg","alt":"..."}},
    "title": "...",
    "profiles": [
      {{"name":"...","fit":"..."}}
    ]
  }},
  "useCases": {{
    "image": {{"src":"img/usecases.jpg","alt":"..."}},
    "title": "...",
    "cases": [
      {{"name":"...","description":"..."}}
    ]
  }},
  "benefits": {{
    "image": {{"src":"img/benefits.jpg","alt":"..."}},
    "title": "...",
    "items": ["...","..."]
  }},
  "integrations": {{
    "include": true,
    "image": {{"src":"img/integrations.jpg","alt":"..."}},
    "title": "...",
    "notes": "...",
    "items": ["...","..."]
  }},
  "trust": {{
    "image": {{"src":"img/trust.jpg","alt":"..."}},
    "title": "...",
    "points": ["...","..."]
  }},
  "finalCTA": {{
    "image": {{"src":"img/cta.jpg","alt":"..."}},
    "title": "...",
    "description": "...",
    "actions": [
      {{"type":"primary","text":"..."}},
      {{"type":"secondary","text":"..."}}
    ],
    "contact": {{
      "email": "contacto@tudominio.com",
      "fields": [
        {{"name":"nombre","type":"text","required":true}},
        {{"name":"email","type":"email","required":true}},
        {{"name":"mensaje","type":"textarea","required":true}}
      ]
    }}
  }},
  "faq": {{
    "image": {{"src":"img/faq.jpg","alt":"..."}},
    "title": "...",
    "qa": [
      {{"q":"...","a":"..."}}
    ]
  }},
  "footer": {{
    "summary": "..."
  }}
}}

NOTA:
- productPage root se construye en código con lang="es", type="{product_type}", version="1.1".

CONTEXTO REAL:
\"\"\"
{context}
\"\"\"

SALIDA: SOLO JSON.
""".strip()


def prompt_repair_json(context: str, product_type: str, slug: str, raw: str, error: str) -> str:
    return f"""
Tu JSON anterior es inválido o no cumple el esquema.

Devuelve ÚNICAMENTE un JSON válido (sin Markdown), con EXACTAMENTE las claves del esquema.
No añadas claves extra.

ERROR DE PARSEO/ESQUEMA:
\"\"\"
{error}
\"\"\"

JSON ANTERIOR (para corregir):
\"\"\"
{raw[:9000]}
\"\"\"

CONTEXTO REAL:
\"\"\"
{context}
\"\"\"

SALIDA: SOLO JSON.
""".strip()


# =====================================================
# JSON -> XML (estructura garantizada)
# =====================================================
def clamp_list(xs: Any, min_n: int = 1, max_n: int = 50) -> List[Any]:
    if not isinstance(xs, list):
        return []
    xs = xs[:max_n]
    if len(xs) < min_n:
        return []
    return xs


def safe_text(x: Any, fallback: str = "—") -> str:
    s = (x if isinstance(x, str) else "")
    s = s.strip()
    return s if s else fallback


def build_media(parent: etree._Element, image_obj: Dict[str, Any]) -> None:
    # <media><image src="..." alt="..."/></media> (media opcional)
    if not isinstance(image_obj, dict):
        return
    src = safe_text(image_obj.get("src", ""), "")
    if not src:
        return
    media = etree.SubElement(parent, "media")
    img = etree.SubElement(media, "image")
    img.set("src", src)
    alt = safe_text(image_obj.get("alt", ""), "")
    if alt:
        img.set("alt", alt)


def json_to_productpage_xml(data: Dict[str, Any], product_type: str) -> bytes:
    root = etree.Element("productPage")
    root.set("lang", "es")
    root.set("type", product_type)
    root.set("version", "1.1")

    # meta
    meta = etree.SubElement(root, "meta")
    etree.SubElement(meta, "slug").text = safe_text(data["meta"].get("slug"))
    etree.SubElement(meta, "title").text = safe_text(data["meta"].get("title"))
    etree.SubElement(meta, "category").text = safe_text(data["meta"].get("category"))

    aud = clamp_list(data["meta"].get("audience"), 1, 20)
    if aud:
        a = etree.SubElement(meta, "audience")
        for seg in aud:
            etree.SubElement(a, "segment").text = safe_text(seg)

    cta1 = safe_text(data["meta"].get("ctaPrimary"), "")
    if cta1:
        etree.SubElement(meta, "ctaPrimary").text = cta1
    cta2 = safe_text(data["meta"].get("ctaSecondary"), "")
    if cta2:
        etree.SubElement(meta, "ctaSecondary").text = cta2

    # hero
    hero = etree.SubElement(root, "hero")
    build_media(hero, data["hero"].get("image", {}))
    etree.SubElement(hero, "name").text = safe_text(data["hero"].get("name"))
    etree.SubElement(hero, "valueProposition").text = safe_text(data["hero"].get("valueProposition"))
    subtitle = safe_text(data["hero"].get("subtitle"), "")
    if subtitle:
        etree.SubElement(hero, "subtitle").text = subtitle

    badges = clamp_list(data["hero"].get("badges"), 1, 10)
    if badges:
        b = etree.SubElement(hero, "badges")
        for bd in badges:
            etree.SubElement(b, "badge").text = safe_text(bd)

    actions = clamp_list(data["hero"].get("actions"), 1, 6)
    if actions:
        act = etree.SubElement(hero, "actions")
        for aobj in actions:
            if not isinstance(aobj, dict):
                continue
            txt = safe_text(aobj.get("text"), "")
            if not txt:
                continue
            node = etree.SubElement(act, "action")
            t = safe_text(aobj.get("type"), "primary")
            if t not in ("primary", "secondary", "tertiary"):
                t = "primary"
            node.set("type", t)
            node.text = txt

    # problem (TitledItemsWithMediaType)
    def titled_items(section_key: str, tag: str) -> None:
        sec = data[section_key]
        el = etree.SubElement(root, tag)
        build_media(el, sec.get("image", {}))
        etree.SubElement(el, "title").text = safe_text(sec.get("title"))
        items = etree.SubElement(el, "items")
        it = clamp_list(sec.get("items"), 1, 30)
        if not it:
            it = ["—"]
        for s in it:
            etree.SubElement(items, "item").text = safe_text(s)

    titled_items("problem", "problem")

    # solution
    sol = etree.SubElement(root, "solution")
    build_media(sol, data["solution"].get("image", {}))
    etree.SubElement(sol, "title").text = safe_text(data["solution"].get("title"))
    etree.SubElement(sol, "overview").text = safe_text(data["solution"].get("overview"))
    wc = clamp_list(data["solution"].get("whatChanges"), 1, 15)
    if wc:
        w = etree.SubElement(sol, "whatChanges")
        for c in wc:
            etree.SubElement(w, "change").text = safe_text(c)

    # keyFeatures
    kf = etree.SubElement(root, "keyFeatures")
    build_media(kf, data["keyFeatures"].get("image", {}))
    etree.SubElement(kf, "title").text = safe_text(data["keyFeatures"].get("title"))
    feats = clamp_list(data["keyFeatures"].get("features"), 1, 20)
    if not feats:
        feats = [{"name": "—", "benefit": "—"}]
    for fobj in feats:
        if not isinstance(fobj, dict):
            continue
        f = etree.SubElement(kf, "feature")
        etree.SubElement(f, "name").text = safe_text(fobj.get("name"))
        etree.SubElement(f, "benefit").text = safe_text(fobj.get("benefit"))

    # targetAudience
    ta = etree.SubElement(root, "targetAudience")
    build_media(ta, data["targetAudience"].get("image", {}))
    etree.SubElement(ta, "title").text = safe_text(data["targetAudience"].get("title"))
    profiles = etree.SubElement(ta, "profiles")
    profs = clamp_list(data["targetAudience"].get("profiles"), 1, 20)
    if not profs:
        profs = [{"name": "—", "fit": "—"}]
    for pobj in profs:
        if not isinstance(pobj, dict):
            continue
        p = etree.SubElement(profiles, "profile")
        etree.SubElement(p, "name").text = safe_text(pobj.get("name"))
        etree.SubElement(p, "fit").text = safe_text(pobj.get("fit"))

    # useCases
    uc = etree.SubElement(root, "useCases")
    build_media(uc, data["useCases"].get("image", {}))
    etree.SubElement(uc, "title").text = safe_text(data["useCases"].get("title"))
    cases = clamp_list(data["useCases"].get("cases"), 1, 20)
    if not cases:
        cases = [{"name": "—", "description": "—"}]
    for cobj in cases:
        if not isinstance(cobj, dict):
            continue
        c = etree.SubElement(uc, "case")
        etree.SubElement(c, "name").text = safe_text(cobj.get("name"))
        etree.SubElement(c, "description").text = safe_text(cobj.get("description"))

    # benefits
    titled_items("benefits", "benefits")

    # integrations (optional)
    integ = data.get("integrations", {})
    include = bool(integ.get("include", False))
    if include:
        ig = etree.SubElement(root, "integrations")
        ig.set("optional", "true")
        build_media(ig, integ.get("image", {}))
        etree.SubElement(ig, "title").text = safe_text(integ.get("title"))
        notes = safe_text(integ.get("notes"), "")
        if notes:
            etree.SubElement(ig, "notes").text = notes
        items = etree.SubElement(ig, "items")
        it = clamp_list(integ.get("items"), 1, 30)
        if not it:
            it = ["—"]
        for s in it:
            etree.SubElement(items, "item").text = safe_text(s)

    # trust
    tr = etree.SubElement(root, "trust")
    build_media(tr, data["trust"].get("image", {}))
    etree.SubElement(tr, "title").text = safe_text(data["trust"].get("title"))
    pts = etree.SubElement(tr, "points")
    pl = clamp_list(data["trust"].get("points"), 1, 20)
    if not pl:
        pl = ["—"]
    for p in pl:
        etree.SubElement(pts, "point").text = safe_text(p)

    # finalCTA
    fc = etree.SubElement(root, "finalCTA")
    build_media(fc, data["finalCTA"].get("image", {}))
    etree.SubElement(fc, "title").text = safe_text(data["finalCTA"].get("title"))
    desc = safe_text(data["finalCTA"].get("description"), "")
    if desc:
        etree.SubElement(fc, "description").text = desc

    actions = clamp_list(data["finalCTA"].get("actions"), 1, 6)
    if actions:
        act = etree.SubElement(fc, "actions")
        for aobj in actions:
            if not isinstance(aobj, dict):
                continue
            txt = safe_text(aobj.get("text"), "")
            if not txt:
                continue
            node = etree.SubElement(act, "action")
            t = safe_text(aobj.get("type"), "primary")
            if t not in ("primary", "secondary", "tertiary"):
                t = "primary"
            node.set("type", t)
            node.text = txt

    contact = data["finalCTA"].get("contact", {})
    if isinstance(contact, dict) and (contact.get("email") or contact.get("fields")):
        c = etree.SubElement(fc, "contact")
        em = safe_text(contact.get("email"), "")
        if em:
            etree.SubElement(c, "email").text = em
        fields = clamp_list(contact.get("fields"), 1, 20)
        if fields:
            form = etree.SubElement(c, "form")
            for fobj in fields:
                if not isinstance(fobj, dict):
                    continue
                fld = etree.SubElement(form, "field")
                fld.set("name", safe_text(fobj.get("name"), "campo"))
                t = safe_text(fobj.get("type"), "text")
                if t not in ("text", "email", "tel", "textarea", "number", "select", "checkbox"):
                    t = "text"
                fld.set("type", t)
                req = bool(fobj.get("required", False))
                fld.set("required", "true" if req else "false")

    # faq
    faq = etree.SubElement(root, "faq")
    build_media(faq, data["faq"].get("image", {}))
    etree.SubElement(faq, "title").text = safe_text(data["faq"].get("title"))
    qa_list = clamp_list(data["faq"].get("qa"), 1, 20)
    if not qa_list:
        qa_list = [{"q": "—", "a": "—"}]
    for qa in qa_list:
        if not isinstance(qa, dict):
            continue
        node = etree.SubElement(faq, "qa")
        etree.SubElement(node, "q").text = safe_text(qa.get("q"))
        etree.SubElement(node, "a").text = safe_text(qa.get("a"))

    # footer
    ft = etree.SubElement(root, "footer")
    etree.SubElement(ft, "summary").text = safe_text(data["footer"].get("summary"))

    return etree.tostring(root, pretty_print=True, xml_declaration=True, encoding="UTF-8")


def extract_json_object(text: str) -> str:
    """
    Extrae el primer objeto JSON {...} aunque venga texto alrededor.
    """
    t = text.strip()
    t = re.sub(r"^```(?:json)?\s*", "", t, flags=re.IGNORECASE)
    t = re.sub(r"\s*```$", "", t)
    m = re.search(r"(\{[\s\S]*\})", t)
    return m.group(1).strip() if m else ""


def require_keys(d: Dict[str, Any], keys: List[str]) -> None:
    for k in keys:
        if k not in d:
            raise ValueError(f"Falta clave obligatoria en JSON: {k}")


# =====================================================
# MAIN
# =====================================================
def main():
    ap = argparse.ArgumentParser()
    ap.add_argument("project_path")
    ap.add_argument("output_dir")
    ap.add_argument("--light", default=LIGHTGOLDENRODYELLOW)
    args = ap.parse_args()

    project_path = Path(args.project_path).expanduser().resolve()
    out_dir = Path(args.output_dir).expanduser().resolve()
    out_dir.mkdir(parents=True, exist_ok=True)

    ts = dt.datetime.now().strftime("%Y%m%d%H%M%S")
    slug = slugify(project_path.name)

    eprint(f">> Modelo remoto: {REMOTE_MODEL}")
    eprint(f">> Proyecto: {project_path}")

    schema = compile_xsd_schema(PRODUCT_PAGE_XSD)

    # 1) Report
    report_path = run_lightgoldenrodyellow(project_path, out_dir, args.light)
    report_text = read_text(report_path)
    eprint(f">> Reporte: {report_path} ({len(report_text)} chars)")

    # 2) Contexto compacto
    if len(report_text) > MAX_DIRECT_CHARS:
        eprint(">> Reporte grande. Resumiendo por trozos vía API remota...")
        chunks = chunk_text(report_text, CHUNK_SIZE)
        partials = []
        for i, ch in enumerate(chunks, start=1):
            eprint(f"   - Resumen {i}/{len(chunks)}")
            partials.append(call_remote_api(prompt_summarize_chunk(ch, i, len(chunks)), timeout=1200))
        eprint(">> Fusionando resúmenes...")
        context = call_remote_api(prompt_merge_summaries("\n\n---\n\n".join(partials)), timeout=1200)
    else:
        context = report_text[:TARGET_CONTEXT_CHARS]

    ctx_path = out_dir / f"{slug}_{ts}_context.txt"
    ctx_path.write_text(context, encoding="utf-8", errors="replace")
    eprint(f">> Contexto guardado: {ctx_path} ({len(context)} chars)")

    product_type = infer_type_from_context(context)
    eprint(f">> type inferido: {product_type}")

    # 3) Generar JSON con retries
    last_raw = ""
    last_err = ""

    for attempt in range(1, MAX_JSON_ATTEMPTS + 1):
        eprint(f">> Generando JSON (intento {attempt}/{MAX_JSON_ATTEMPTS})...")
        if attempt == 1:
            q = prompt_generate_json(context, product_type, slug)
        else:
            q = prompt_repair_json(context, product_type, slug, last_raw, last_err)

        raw = call_remote_api(q, timeout=1800)
        last_raw = raw
        save_debug(out_dir, slug, ts, f"json_raw_attempt{attempt}", raw)

        extracted = extract_json_object(raw)
        if not extracted:
            last_err = "No se pudo extraer un objeto JSON {...} de la respuesta."
            save_debug(out_dir, slug, ts, f"json_error_attempt{attempt}", last_err)
            eprint(f"   !! {last_err}")
            continue

        try:
            data = json.loads(extracted)
            if not isinstance(data, dict):
                raise ValueError("El JSON raíz no es un objeto.")
            require_keys(data, [
                "meta","hero","problem","solution","keyFeatures","targetAudience",
                "useCases","benefits","integrations","trust","finalCTA","faq","footer"
            ])
        except Exception as ex:
            last_err = f"JSON inválido o incompleto: {ex}"
            save_debug(out_dir, slug, ts, f"json_error_attempt{attempt}", last_err)
            eprint(f"   !! {last_err}")
            continue

        # 4) Construir XML determinista y validar XSD
        xml_bytes = json_to_productpage_xml(data, product_type)
        ok, err = validate_against_xsd(schema, xml_bytes)
        if ok:
            xml_path = out_dir / f"{slug}_{ts}.xml"
            xml_path.write_bytes(xml_bytes)

            print(f"[OK] XML generado (válido XSD): {xml_path}")
            print(f"[OK] Modelo: {REMOTE_MODEL}")
            print(f"[OK] Reporte: {report_path}")
            print(f"[OK] Contexto: {ctx_path}")
            return

        save_debug(out_dir, slug, ts, f"xml_xsd_errors_attempt{attempt}", err)
        save_debug(out_dir, slug, ts, f"xml_candidate_attempt{attempt}", xml_bytes.decode("utf-8", errors="replace"))
        last_err = f"XML generado por código no valida contra XSD:\n{err}"
        eprint("   !! El XML generado no pasó XSD (esto debería ser raro). Errores:")
        for line in err.splitlines()[:10]:
            eprint("      - " + line)

    raise RuntimeError(
        "No se pudo obtener JSON válido o generar XML válido tras varios intentos.\n"
        f"Revisa debug en: {out_dir}/{slug}_{ts}_json_* y {out_dir}/{slug}_{ts}_xml_*"
    )


if __name__ == "__main__":
    try:
        main()
    except Exception as ex:
        eprint(f"\n[ERROR] {ex}")
        sys.exit(1)

