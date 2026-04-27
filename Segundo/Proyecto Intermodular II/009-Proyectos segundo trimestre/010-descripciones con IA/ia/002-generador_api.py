#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
generar_xml_descripcion_remoto.py

Versión que NO usa Ollama local directamente.
En su lugar, llama a una API remota (PHP + Ollama) como en tu ejemplo.

Qué hace:
1) Ejecuta lightgoldenrodyellow.py para generar un reporte Markdown del proyecto.
2) (Opcional) Si el reporte es grande, lo resume por trozos llamando a la API remota.
3) Pide a la API remota que genere un XML comercial (<productPage ...>) basado en el reporte/resumen.
4) Guarda el XML en la carpeta de salida.

Uso:
  python3 generar_xml_descripcion_remoto.py /ruta/proyecto /ruta/salida

Ejemplo:
  python3 generar_xml_descripcion_remoto.py /var/www/html/jocarsa-rosybrown/ /home/josevicente/Escritorio/
"""

from __future__ import annotations

import argparse
import datetime as dt
import json
import re
import subprocess
import sys
from pathlib import Path
from typing import Optional

import requests  # pip install requests
import urllib3   # para silenciar warnings si verify=False

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

# -------------------------------------------------------
# CONFIG API REMOTA (hardcode como tu ejemplo)
# -------------------------------------------------------
API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php"
API_KEY = "TEST_API_KEY_JOCARSA_123"
VERIFY_SSL = False  # ngrok suele requerir verify=False

# -------------------------------------------------------
# CONFIG LIGHTGOLDENRODYELLOW
# -------------------------------------------------------
DEFAULT_LIGHTGOLDENRODYELLOW = "/var/www/html/jocarsa-lightgoldenrodyellow/lightgoldenrodyellow.py"

# -------------------------------------------------------
# CONTROL DE TAMAÑO
# -------------------------------------------------------
MAX_REPORT_CHARS_DIRECT = 120_000   # si supera, hacemos resumen previo por trozos
CHUNK_SIZE = 45_000                 # tamaño de cada trozo para resumir


def eprint(*args, **kwargs):
    print(*args, file=sys.stderr, **kwargs)


def run_lightgoldenrodyellow(light_path: str, project_path: Path, out_dir: Path) -> Path:
    """
    Ejecuta: python3 lightgoldenrodyellow.py <project_path> <out_dir>
    y extrae la ruta del reporte desde la salida:
      [OK] Reporte generado: /ruta/al/reporte.md
    """
    lp = Path(light_path)
    if not lp.exists():
        raise FileNotFoundError(f"No existe lightgoldenrodyellow.py en: {lp}")

    if not project_path.exists():
        raise FileNotFoundError(f"No existe el proyecto: {project_path}")

    out_dir.mkdir(parents=True, exist_ok=True)

    cmd = ["python3", str(lp), str(project_path), str(out_dir)]
    proc = subprocess.run(cmd, capture_output=True, text=True)

    stdout = proc.stdout or ""
    stderr = proc.stderr or ""

    if proc.returncode != 0:
        raise RuntimeError(
            "lightgoldenrodyellow falló.\n"
            f"CMD: {' '.join(cmd)}\n"
            f"STDOUT:\n{stdout}\n"
            f"STDERR:\n{stderr}\n"
        )

    m = re.search(r"\[OK\]\s+Reporte generado:\s+(.*\.md)\s*$", stdout, flags=re.MULTILINE)
    if not m:
        m2 = re.search(r"(/[^ \n\r\t]+\.md)", stdout)
        if not m2:
            raise RuntimeError(
                "No pude detectar la ruta del reporte Markdown en la salida de lightgoldenrodyellow.\n"
                f"STDOUT:\n{stdout}\n"
                f"STDERR:\n{stderr}\n"
            )
        report_path = Path(m2.group(1)).expanduser()
    else:
        report_path = Path(m.group(1).strip()).expanduser()

    if not report_path.exists():
        raise FileNotFoundError(f"El reporte indicado no existe: {report_path}")

    return report_path


def read_text(path: Path) -> str:
    return path.read_text(encoding="utf-8", errors="replace")


def call_remote_api(question: str, timeout: int = 600) -> str:
    """
    Llama a la API remota (PHP + Ollama) exactamente con el estilo de tu ejemplo:
    - Header: X-API-Key
    - Body: question=<...>
    - verify=False (ngrok)
    Espera JSON {"answer": "..."}.
    """
    try:
        resp = requests.post(
            API_URL,
            headers={"X-API-Key": API_KEY},
            data={"question": question},
            timeout=timeout,
            verify=VERIFY_SSL,
        )
    except Exception as e:
        raise RuntimeError(f"Error al contactar con la API remota: {e}")

    if resp.status_code != 200:
        raise RuntimeError(f"API remota devolvió HTTP {resp.status_code}: {resp.text}")

    try:
        data = resp.json()
    except Exception:
        raise RuntimeError(f"No se pudo parsear JSON desde la API remota: {resp.text}")

    answer = data.get("answer")
    if not answer:
        raise RuntimeError(f"La respuesta de la API no contiene 'answer': {data}")

    return answer.strip()


def chunk_text(text: str, size: int) -> list[str]:
    return [text[i:i + size] for i in range(0, len(text), size)]


def extract_productpage_xml(text: str) -> str:
    """
    Extrae el bloque XML completo desde <productPage ...> hasta </productPage>.
    """
    start = text.find("<productPage")
    end = text.rfind("</productPage>")
    if start == -1 or end == -1:
        return ""
    end += len("</productPage>")
    return text[start:end].strip()


def slugify(name: str) -> str:
    s = name.strip().lower()
    s = re.sub(r"[^\w\s-]", "", s, flags=re.UNICODE)
    s = re.sub(r"[\s_-]+", "-", s)
    return s.strip("-") or "producto"


# -----------------------------
# Prompts
# -----------------------------
def system_rules() -> str:
    return (
        "Eres un redactor comercial de software B2B. "
        "Responde SIEMPRE en español neutro y tono profesional. "
        "No inventes características: si algo no está claro, formula de forma prudente."
    )


def build_summary_prompt(chunk: str, idx: int, total: int) -> str:
    return f"""
{system_rules()}

Necesito que resumas este fragmento de documentación técnica en español para poder redactar una ficha comercial.
Devuelve SOLO texto (sin XML).

Prioriza:
- Qué hace el software
- Para quién es
- Funcionalidades observables
- Entradas/salidas, pantallas, módulos
- Integraciones mencionadas
- Beneficios deducibles (sin inventar)

Fragmento {idx}/{total}:
\"\"\"
{chunk}
\"\"\"
""".strip()


def build_merge_summary_prompt(summaries: str) -> str:
    return f"""
{system_rules()}

Fusiona estos resúmenes parciales en un único resumen coherente y sin redundancias.
Devuelve SOLO texto, con secciones y viñetas claras:
- Descripción general
- Público objetivo
- Funcionalidades clave
- Casos de uso
- Integraciones/compatibilidad
- Puntos de confianza/seguridad
- Diferenciadores

Resúmenes:
\"\"\"
{summaries}
\"\"\"
""".strip()


def build_xml_prompt(context: str, lang: str, ptype: str, version: str) -> str:
    return f"""
{system_rules()}

Genera un XML con este formato EXACTO (estructura y etiquetas), sin texto adicional:

<?xml version="1.0" encoding="UTF-8"?>
<productPage lang="{lang}" type="{ptype}" version="{version}">
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
    <feature>
      <name>...</name>
      <benefit>...</benefit>
    </feature>
    ...
  </keyFeatures>

  <targetAudience>
    <media><image src="img/audience.jpg" alt="..."/></media>
    <title>...</title>
    <profiles>
      <profile>
        <name>...</name>
        <fit>...</fit>
      </profile>
      ...
    </profiles>
  </targetAudience>

  <useCases>
    <media><image src="img/usecases.jpg" alt="..."/></media>
    <title>...</title>
    <case>
      <name>...</name>
      <description>...</description>
    </case>
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

Reglas:
- No uses CDATA.
- Escapa caracteres XML cuando sea necesario (&, <, >, comillas en atributos).
- Mantén un enfoque comercial (beneficios, claridad), pero basado en el contexto.
- Slug: minúsculas con guiones, sin espacios.
- Incluye 5–8 features, 4–6 casos de uso, 5–8 beneficios, 5–8 puntos de confianza, 5–8 preguntas FAQ.
- En integraciones, si no se deduce nada concreto, usa frases prudentes (p.ej. "Importación/exportación CSV", "API / Webhooks (bajo demanda)").

CONTEXTO DEL PROYECTO (reporte o resumen):
\"\"\"
{context}
\"\"\"
""".strip()


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument("project_path", help="Ruta del proyecto a documentar (carpeta).")
    ap.add_argument("output_dir", help="Carpeta donde se guardará el .md y el .xml.")
    ap.add_argument("--light", default=DEFAULT_LIGHTGOLDENRODYELLOW, help="Ruta a lightgoldenrodyellow.py")
    ap.add_argument("--lang", default="es", help="Atributo lang del XML (default: es)")
    ap.add_argument("--type", default="softwareEducativo", help="Atributo type del XML (default: softwareEducativo)")
    ap.add_argument("--version", default="1.1", help="Atributo version del XML (default: 1.1)")
    args = ap.parse_args()

    project_path = Path(args.project_path).expanduser().resolve()
    output_dir = Path(args.output_dir).expanduser().resolve()
    output_dir.mkdir(parents=True, exist_ok=True)

    # 1) Generar reporte Markdown
    eprint(f">> Generando reporte con lightgoldenrodyellow: {project_path}")
    report_path = run_lightgoldenrodyellow(args.light, project_path, output_dir)
    eprint(f">> Reporte detectado: {report_path}")

    report_text = read_text(report_path)

    # 2) Si el reporte es enorme, resumir por trozos usando la API remota
    if len(report_text) > MAX_REPORT_CHARS_DIRECT:
        eprint(f">> Reporte grande ({len(report_text)} chars). Resumiendo por trozos vía API remota...")
        chunks = chunk_text(report_text, CHUNK_SIZE)
        partials: list[str] = []

        for i, ch in enumerate(chunks, start=1):
            eprint(f"   - Resumen {i}/{len(chunks)}")
            q = build_summary_prompt(ch, i, len(chunks))
            partial = call_remote_api(q, timeout=600).strip()
            partials.append(partial)

        eprint(">> Fusionando resúmenes vía API remota...")
        merged = call_remote_api(build_merge_summary_prompt("\n\n---\n\n".join(partials)), timeout=600).strip()
        context_for_xml = merged
    else:
        context_for_xml = report_text

    # 3) Generar XML final vía API remota
    eprint(">> Generando XML comercial vía API remota...")
    xml_raw = call_remote_api(build_xml_prompt(context_for_xml, args.lang, args.type, args.version), timeout=900)

    xml = extract_productpage_xml(xml_raw)
    if not xml:
        debug_path = output_dir / ("api_raw_" + dt.datetime.now().strftime("%Y%m%d%H%M%S") + ".txt")
        debug_path.write_text(xml_raw, encoding="utf-8", errors="replace")
        raise RuntimeError(
            "No pude extraer un bloque <productPage>...</productPage> de la respuesta de la API.\n"
            f"Guardé la salida completa en: {debug_path}"
        )

    # 4) Guardar XML
    ts = dt.datetime.now().strftime("%Y%m%d%H%M%S")
    slug_base = slugify(project_path.name)
    xml_path = output_dir / f"{slug_base}_{ts}.xml"

    # Asegura cabecera XML una sola vez
    if not xml.lstrip().startswith('<?xml'):
        xml_out = '<?xml version="1.0" encoding="UTF-8"?>\n' + xml + "\n"
    else:
        xml_out = xml + "\n"

    xml_path.write_text(xml_out, encoding="utf-8")
    print(f"[OK] XML generado: {xml_path}")
    print(f"[OK] Reporte usado: {report_path}")


if __name__ == "__main__":
    main()

