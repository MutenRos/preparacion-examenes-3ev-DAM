#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
005-generador_xsd_hardcoded_qwen_robusto.py

- 1) Calls lightgoldenrodyellow.py to create a Markdown report of a project
- 2) Summarizes the report via remote api.php (to avoid context overflow)
- 3) Generates a STRICT XML <productPage> that must comply with the XSD
- 4) Forces remote model = qwen2.5:7b-instruct-q4_0 (no changes to api.php)
- 5) Robust: retries + saves raw answers to debug files when extraction fails

Usage:
  python3 005-generador_xsd_hardcoded_qwen_robusto.py /var/www/html/jocarsa-rosybrown/ /home/josevicente/Escritorio/

Requirements:
  pip install requests urllib3
"""

from __future__ import annotations

import argparse
import datetime as dt
import re
import subprocess
import sys
from pathlib import Path
from typing import List, Tuple

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
# SIZE / SUMMARIZATION
# =====================================================
MAX_DIRECT_CHARS = 60_000       # never send the full report directly if bigger
CHUNK_SIZE = 18_000             # chunk size for summarization calls
TARGET_CONTEXT_CHARS = 12_000   # final condensed context for XML generation

# =====================================================
# RETRIES
# =====================================================
MAX_XML_ATTEMPTS = 4

# =====================================================
# FULL XSD HARDCODED (YOUR CONTRACT)
# =====================================================
PRODUCT_PAGE_XSD = r"""<?xml version="1.0" encoding="UTF-8"?>
<xs:schema
  xmlns:xs="http://www.w3.org/2001/XMLSchema"
  elementFormDefault="qualified"
  attributeFormDefault="unqualified">

  <!-- =========================================================
       ROOT
       ========================================================= -->
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

  <!-- =========================================================
       MEDIA
       ========================================================= -->
  <xs:complexType name="MediaType">
    <xs:sequence>
      <xs:element name="image" type="ImageType" minOccurs="0"/>
    </xs:sequence>
  </xs:complexType>

  <xs:complexType name="ImageType">
    <xs:attribute name="src" type="xs:anyURI" use="required"/>
    <xs:attribute name="alt" type="xs:string" use="optional"/>
  </xs:complexType>

  <!-- =========================================================
       META
       ========================================================= -->
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

  <!-- =========================================================
       HERO (con media opcional)
       ========================================================= -->
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

  <!-- =========================================================
       GENERIC: media + <title> + <items><item/></items>
       ========================================================= -->
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

  <!-- =========================================================
       SOLUTION + media
       ========================================================= -->
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

  <!-- =========================================================
       KEY FEATURES + media
       ========================================================= -->
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

  <!-- =========================================================
       TARGET AUDIENCE + media
       ========================================================= -->
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

  <!-- =========================================================
       USE CASES + media
       ========================================================= -->
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

  <!-- =========================================================
       INTEGRATIONS + media
       ========================================================= -->
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

  <!-- =========================================================
       TRUST + media
       ========================================================= -->
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

  <!-- =========================================================
       FINAL CTA + media
       ========================================================= -->
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

  <!-- =========================================================
       FAQ + media
       ========================================================= -->
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

  <!-- =========================================================
       FOOTER
       ========================================================= -->
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
    return [text[i:i+size] for i in range(0, len(text), size)]

def extract_productpage_xml(text: str) -> str:
    start = text.find("<productPage")
    end = text.rfind("</productPage>")
    if start == -1 or end == -1:
        return ""
    return text[start:end + len("</productPage>")].strip()

def slugify(s: str) -> str:
    s = s.lower().strip()
    s = re.sub(r"[^\w\s-]", "", s, flags=re.UNICODE)
    s = re.sub(r"[\s_-]+", "-", s)
    return s.strip("-") or "producto"

def save_debug(out_dir: Path, slug: str, ts: str, label: str, content: str) -> Path:
    p = out_dir / f"{slug}_{ts}_{label}.txt"
    p.write_text(content, encoding="utf-8", errors="replace")
    return p

# =====================================================
# PROMPTS
# =====================================================
def prompt_summarize_chunk(chunk: str, idx: int, total: int) -> str:
    return f"""
Eres un analista técnico. Resume este fragmento de un reporte de código de un software real.

Reglas:
- Responde SOLO texto.
- Español profesional.
- No inventes.
- Extrae: propósito del software, módulos/pantallas, entidades de negocio (ej.: facturas/clientes/IVA/pagos si aparecen),
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

def prompt_generate_xml(context: str) -> str:
    return f"""
Devuelve ÚNICAMENTE un XML válido (sin explicaciones) que CUMPLA EXACTAMENTE el XSD de abajo.
El XML debe estar COMPLETO (todas las secciones obligatorias) y coherente con el CONTEXTO.

IMPORTANTE:
- Prohibido HTML, Markdown, <text>, <link>, <a>, href.
- No inventes el dominio: si es facturación, habla de facturas/clientes/presupuestos/IVA/pagos/cobros.
- Debes incluir TODOS los elementos requeridos por el XSD.

XSD (CONTRATO OBLIGATORIO):
\"\"\"
{PRODUCT_PAGE_XSD}
\"\"\"

Devuelve este tipo de documento (solo como orientación estructural, NO copies textos):
- raíz <productPage lang="es" type="..." version="1.1">
- meta, hero, problem, solution, keyFeatures, targetAudience, useCases, benefits, (integrations opcional), trust, finalCTA, faq, footer

CONTEXTO REAL:
\"\"\"
{context}
\"\"\"

SALIDA: SOLO XML.
""".strip()

def prompt_repair_xml(context: str, raw_answer: str) -> str:
    return f"""
Tu salida anterior NO es válida o está incompleta (falta <productPage> o faltan secciones).
Debes devolver SOLO el XML FINAL corregido cumpliendo el XSD.

Reglas:
- SOLO XML (sin texto fuera del XML).
- Prohibido HTML/Markdown y etiquetas inventadas.
- Debe incluir TODAS las secciones obligatorias del XSD.

XSD:
\"\"\"
{PRODUCT_PAGE_XSD}
\"\"\"

CONTEXTO REAL:
\"\"\"
{context}
\"\"\"

SALIDA ANTERIOR (para corregir):
\"\"\"
{raw_answer[:8000]}
\"\"\"

Devuelve SOLO el XML corregido.
""".strip()

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

    # 1) Report
    report_path = run_lightgoldenrodyellow(project_path, out_dir, args.light)
    report_text = read_text(report_path)
    eprint(f">> Reporte: {report_path} ({len(report_text)} chars)")

    # 2) Build small context (summary if needed)
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
        # even if small, still keep it compact to leave room for XSD
        context = report_text[:TARGET_CONTEXT_CHARS]

    ctx_path = out_dir / f"{slug}_{ts}_context.txt"
    ctx_path.write_text(context, encoding="utf-8", errors="replace")
    eprint(f">> Contexto guardado: {ctx_path} ({len(context)} chars)")

    # 3) Generate XML with retries
    last_raw = ""
    for attempt in range(1, MAX_XML_ATTEMPTS + 1):
        eprint(f">> Generando XML (intento {attempt}/{MAX_XML_ATTEMPTS})...")
        q = prompt_generate_xml(context) if attempt == 1 else prompt_repair_xml(context, last_raw)
        raw = call_remote_api(q, timeout=1800)
        last_raw = raw

        raw_path = save_debug(out_dir, slug, ts, f"xml_raw_attempt{attempt}", raw)
        xml = extract_productpage_xml(raw)

        if xml:
            # OK: write final
            xml_path = out_dir / f"{slug}_{ts}.xml"
            if not xml.lstrip().startswith('<?xml'):
                xml_out = '<?xml version="1.0" encoding="UTF-8"?>\n' + xml + "\n"
            else:
                xml_out = xml + "\n"
            xml_path.write_text(xml_out, encoding="utf-8", errors="replace")

            print(f"[OK] XML generado: {xml_path}")
            print(f"[OK] Modelo: {REMOTE_MODEL}")
            print(f"[OK] Reporte: {report_path}")
            print(f"[OK] Contexto: {ctx_path}")
            print(f"[OK] Última respuesta cruda: {raw_path}")
            return

        eprint(f"   !! No se encontró <productPage>...</productPage>. RAW guardado en: {raw_path}")

    # If we got here, fail with debug pointer
    raise RuntimeError(
        "No se pudo generar un XML con <productPage> tras varios intentos.\n"
        f"Revisa los archivos: {out_dir}/{slug}_{ts}_xml_raw_attempt*.txt"
    )

if __name__ == "__main__":
    try:
        main()
    except Exception as ex:
        eprint(f"\n[ERROR] {ex}")
        sys.exit(1)

