#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
003-generador_sin_bias_xsd.py

- Generates a Markdown report with lightgoldenrodyellow.py
- Calls remote api.php
- Explicitly selects Qwen instruct: qwen2.5:7b-instruct-q4_0
- Forces the exact XML structure (productPage) in the prompt so the model complies

NO changes to api.php
"""

from __future__ import annotations

import argparse
import datetime as dt
import re
import subprocess
import sys
from pathlib import Path
from typing import List

import requests
import urllib3
urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

# =====================================================
# REMOTE API CONFIG (server unchanged)
# =====================================================
API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php"
API_KEY = "TEST_API_KEY_JOCARSA_123"
VERIFY_SSL = False

# ✅ Model forced from client side
REMOTE_MODEL = "qwen2.5:7b-instruct-q4_0"

# =====================================================
# LIGHTGOLDENRODYELLOW
# =====================================================
LIGHTGOLDENRODYELLOW = "/var/www/html/jocarsa-lightgoldenrodyellow/lightgoldenrodyellow.py"

# =====================================================
# SIZE CONTROL
# =====================================================
MAX_REPORT_CHARS = 90_000
CHUNK_SIZE = 35_000


def eprint(*args, **kwargs):
    print(*args, file=sys.stderr, **kwargs)


def call_remote_api(question: str, timeout: int = 900) -> str:
    """
    Calls api.php and forces the model via POST 'model' parameter.
    """
    resp = requests.post(
        API_URL,
        headers={"X-API-Key": API_KEY},
        data={
            "question": question,
            "model": REMOTE_MODEL,   # ✅ THIS ensures qwen instruct is used
        },
        timeout=timeout,
        verify=VERIFY_SSL,
    )

    if resp.status_code != 200:
        raise RuntimeError(f"API error {resp.status_code}: {resp.text}")

    data = resp.json()
    answer = data.get("answer")
    if not answer:
        raise RuntimeError(f"No 'answer' in API response: {data}")

    return answer.strip()


def run_lightgoldenrodyellow(project: Path, out_dir: Path) -> Path:
    cmd = ["python3", LIGHTGOLDENRODYELLOW, str(project), str(out_dir)]
    proc = subprocess.run(cmd, capture_output=True, text=True)

    if proc.returncode != 0:
        raise RuntimeError(
            "lightgoldenrodyellow failed\n"
            f"STDOUT:\n{proc.stdout}\n"
            f"STDERR:\n{proc.stderr}\n"
        )

    m = re.search(r"\[OK\]\s+Reporte generado:\s+(.*\.md)", proc.stdout)
    if not m:
        raise RuntimeError("No se encontró la ruta del reporte generado en la salida.")

    report = Path(m.group(1)).expanduser()
    if not report.exists():
        raise RuntimeError(f"Reporte no encontrado: {report}")

    return report


def read_text(p: Path) -> str:
    return p.read_text(encoding="utf-8", errors="replace")


def chunk_text(text: str, size: int) -> List[str]:
    return [text[i:i + size] for i in range(0, len(text), size)]


def extract_xml(text: str) -> str:
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


# =====================================================
# PROMPTS
# =====================================================
def summarize_prompt(chunk: str, i: int, total: int) -> str:
    return f"""
Eres un analista técnico. Resume este fragmento de un proyecto software real.

Reglas:
- Devuelve SOLO texto (sin XML, sin JSON).
- No inventes funcionalidades.
- Extrae términos del dominio (ej.: facturas, clientes, IVA, pagos... solo si aparecen).

Fragmento {i}/{total}:
\"\"\"
{chunk}
\"\"\"
""".strip()


def merge_prompt(parts: str) -> str:
    return f"""
Fusiona estos resúmenes parciales en un solo resumen final coherente.

Reglas:
- Devuelve SOLO texto.
- Incluye una sección final: "Keywords del dominio:" con 10-15 términos.

Resúmenes:
\"\"\"
{parts}
\"\"\"
""".strip()


def xml_prompt(context: str, forced_type: str = "other", version: str = "1.1") -> str:
    """
    This is the key: we force the exact element tree and constraints,
    so the model knows the structure even without giving the full XSD.
    """
    return f"""
Eres un redactor comercial B2B.

OBJETIVO:
Genera ÚNICAMENTE un XML válido, en español, siguiendo EXACTAMENTE esta estructura.

PROHIBIDO:
- HTML
- Etiquetas no listadas
- <text>, <link>, <a>, href
- Markdown
- Explicaciones fuera del XML

REGLAS XML:
- Devuelve SOLO el XML completo, incluyendo: <?xml version="1.0" encoding="UTF-8"?>
- Raíz obligatoria:
  <productPage lang="es" type="{forced_type}" version="{version}">
- Escapa caracteres XML: & < > y comillas en atributos.

ESTRUCTURA OBLIGATORIA (misma jerarquía, mismas etiquetas):
<productPage lang="es" type="..." version="{version}">
  <meta>
    <slug>...</slug>
    <title>...</title>
    <category>...</category>
    <audience>
      <segment>...</segment>
      ...
    </audience>
    <ctaPrimary>...</ctaPrimary>
    <ctaSecondary>...</ctaSecondary>
  </meta>

  <hero>
    <media>
      <image src="img/hero.jpg" alt="..."/>
    </media>
    <name>...</name>
    <valueProposition>...</valueProposition>
    <subtitle>...</subtitle>
    <badges>
      <badge>...</badge>
      ...
    </badges>
    <actions>
      <action type="primary">...</action>
      <action type="secondary">...</action>
      <action type="tertiary">...</action>
    </actions>
  </hero>

  <problem>
    <media><image src="img/problem.jpg" alt="..."/></media>
    <title>...</title>
    <items>
      <item>...</item>
      ...
    </items>
  </problem>

  <solution>
    <media><image src="img/solution.jpg" alt="..."/></media>
    <title>...</title>
    <overview>...</overview>
    <whatChanges>
      <change>...</change>
      ...
    </whatChanges>
  </solution>

  <keyFeatures>
    <media><image src="img/features.jpg" alt="..."/></media>
    <title>...</title>
    <feature><name>...</name><benefit>...</benefit></feature>
    ...
  </keyFeatures>

  <targetAudience>
    <media><image src="img/audience.jpg" alt="..."/></media>
    <title>...</title>
    <profiles>
      <profile><name>...</name><fit>...</fit></profile>
      ...
    </profiles>
  </targetAudience>

  <useCases>
    <media><image src="img/usecases.jpg" alt="..."/></media>
    <title>...</title>
    <case><name>...</name><description>...</description></case>
    ...
  </useCases>

  <benefits>
    <media><image src="img/benefits.jpg" alt="..."/></media>
    <title>...</title>
    <items>
      <item>...</item>
      ...
    </items>
  </benefits>

  <integrations optional="true">
    <media><image src="img/integrations.jpg" alt="..."/></media>
    <title>...</title>
    <notes>...</notes>
    <items>
      <item>...</item>
      ...
    </items>
  </integrations>

  <trust>
    <media><image src="img/trust.jpg" alt="..."/></media>
    <title>...</title>
    <points>
      <point>...</point>
      ...
    </points>
  </trust>

  <finalCTA>
    <media><image src="img/cta.jpg" alt="..."/></media>
    <title>...</title>
    <description>...</description>
    <actions>
      <action type="primary">...</action>
      <action type="secondary">...</action>
    </actions>
    <contact>
      <email>contacto@tudominio.com</email>
      <form>
        <field name="nombre" type="text" required="true"/>
        <field name="centro" type="text" required="true"/>
        <field name="email" type="email" required="true"/>
        <field name="telefono" type="tel" required="false"/>
        <field name="mensaje" type="textarea" required="true"/>
      </form>
    </contact>
  </finalCTA>

  <faq>
    <media><image src="img/faq.jpg" alt="..."/></media>
    <title>...</title>
    <qa><q>...</q><a>...</a></qa>
    ...
  </faq>

  <footer>
    <summary>...</summary>
  </footer>
</productPage>

CUANTIDADES RECOMENDADAS:
- features: 5–8
- cases: 4–6
- benefits items: 5–8
- trust points: 5–8
- faq qa: 5–8

CONTEXTO REAL DEL PROYECTO (debe determinar el dominio del software):
\"\"\"
{context}
\"\"\"
""".strip()


# =====================================================
# MAIN
# =====================================================
def main():
    ap = argparse.ArgumentParser()
    ap.add_argument("project_path")
    ap.add_argument("output_dir")
    ap.add_argument("--version", default="1.1")
    ap.add_argument("--forced_type", default="other", help="Optional: force productPage@type, default other")
    args = ap.parse_args()

    project = Path(args.project_path).resolve()
    out_dir = Path(args.output_dir).resolve()
    out_dir.mkdir(parents=True, exist_ok=True)

    eprint(f">> Using remote model: {REMOTE_MODEL}")

    # 1) Markdown report
    eprint(">> Generando reporte Markdown…")
    report = run_lightgoldenrodyellow(project, out_dir)
    report_text = read_text(report)

    # 2) Context (summarize if huge)
    if len(report_text) > MAX_REPORT_CHARS:
        eprint(f">> Reporte grande ({len(report_text)} chars), resumiendo…")
        chunks = chunk_text(report_text, CHUNK_SIZE)
        summaries = []
        for i, ch in enumerate(chunks, 1):
            eprint(f"   - Resumen {i}/{len(chunks)}")
            summaries.append(call_remote_api(summarize_prompt(ch, i, len(chunks)), timeout=1200))
        context = call_remote_api(merge_prompt("\n\n---\n\n".join(summaries)), timeout=1200)
    else:
        context = report_text

    # Save context for debugging
    ts = dt.datetime.now().strftime("%Y%m%d%H%M%S")
    slug = slugify(project.name)
    ctx_path = out_dir / f"{slug}_context_{ts}.txt"
    ctx_path.write_text(context, encoding="utf-8", errors="replace")

    # 3) XML generation (forced structure)
    eprint(">> Generando XML con estructura obligatoria…")
    raw = call_remote_api(xml_prompt(context, forced_type=args.forced_type, version=args.version), timeout=1500)
    xml = extract_xml(raw)

    if not xml:
        debug = out_dir / f"api_raw_{ts}.txt"
        debug.write_text(raw, encoding="utf-8", errors="replace")
        raise RuntimeError(f"XML inválido (no se encontró <productPage>). Ver: {debug}")

    xml_path = out_dir / f"{slug}_{ts}.xml"
    if not xml.lstrip().startswith('<?xml'):
        xml_out = '<?xml version="1.0" encoding="UTF-8"?>\n' + xml + "\n"
    else:
        xml_out = xml + "\n"
    xml_path.write_text(xml_out, encoding="utf-8")

    print(f"[OK] XML generado: {xml_path}")
    print(f"[OK] Reporte: {report}")
    print(f"[OK] Contexto: {ctx_path}")
    print(f"[OK] Modelo remoto: {REMOTE_MODEL}")


if __name__ == "__main__":
    try:
        main()
    except Exception as ex:
        eprint(f"\n[ERROR] {ex}")
        sys.exit(1)

