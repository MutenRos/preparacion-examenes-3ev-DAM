#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
generar_xml_descripcion.py

1) Ejecuta lightgoldenrodyellow.py para generar un reporte Markdown del proyecto.
2) Alimenta ese reporte a Ollama (modelo llama3:latest) para generar un XML comercial
   siguiendo la estructura de <productPage> (según tu XSD).
3) Guarda el XML resultante en la carpeta de salida.

Uso:
  python3 generar_xml_descripcion.py /ruta/proyecto /ruta/salida

Ejemplo:
  python3 generar_xml_descripcion.py /var/www/html/jocarsa-rosybrown/ /home/josevicente/Escritorio/

Opcionales:
  --model llama3:latest
  --lang es
  --type softwareEducativo
  --version 1.1
  --ollama http://127.0.0.1:11434
  --light /var/www/html/jocarsa-lightgoldenrodyellow/lightgoldenrodyellow.py
"""

from __future__ import annotations

import argparse
import datetime as dt
import json
import os
import re
import subprocess
import sys
from pathlib import Path
from typing import Optional

import urllib.request
import urllib.error


# -----------------------------
# Defaults (ajusta si lo necesitas)
# -----------------------------
DEFAULT_LIGHTGOLDENRODYELLOW = "/var/www/html/jocarsa-lightgoldenrodyellow/lightgoldenrodyellow.py"
DEFAULT_OLLAMA_BASE = "http://127.0.0.1:11434"
DEFAULT_MODEL = "llama3:latest"

# Límite práctico de caracteres para meter el reporte “tal cual”.
# Si se supera, hacemos un paso previo de resumen con Ollama.
MAX_REPORT_CHARS_DIRECT = 120_000

# Si el reporte es enorme, resumen en trozos para no reventar contexto.
CHUNK_SIZE = 45_000


# -----------------------------
# Helpers
# -----------------------------
def eprint(*args, **kwargs):
    print(*args, file=sys.stderr, **kwargs)


def run_lightgoldenrodyellow(light_path: str, project_path: Path, out_dir: Path) -> Path:
    """
    Ejecuta: python3 lightgoldenrodyellow.py <project_path> <out_dir>
    y extrae la ruta del reporte desde la salida:
      [OK] Reporte generado: /ruta/al/reporte.md
    """
    if not Path(light_path).exists():
        raise FileNotFoundError(f"No existe lightgoldenrodyellow.py en: {light_path}")

    if not project_path.exists():
        raise FileNotFoundError(f"No existe el proyecto: {project_path}")

    out_dir.mkdir(parents=True, exist_ok=True)

    cmd = ["python3", light_path, str(project_path), str(out_dir)]
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

    # Busca: [OK] Reporte generado: /path/file.md
    m = re.search(r"\[OK\]\s+Reporte generado:\s+(.*\.md)\s*$", stdout, flags=re.MULTILINE)
    if not m:
        # por si imprime con otro formato, intentamos buscar cualquier .md absoluto
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


def ollama_generate(ollama_base: str, model: str, prompt: str, system: Optional[str] = None) -> str:
    """
    Llama a Ollama local: POST /api/generate
    """
    url = ollama_base.rstrip("/") + "/api/generate"
    payload = {
        "model": model,
        "prompt": prompt,
        "stream": False,
        "options": {
            "temperature": 0.4,
            "top_p": 0.9,
        }
    }
    if system:
        payload["system"] = system

    data = json.dumps(payload).encode("utf-8")
    req = urllib.request.Request(
        url=url,
        data=data,
        headers={"Content-Type": "application/json; charset=utf-8"},
        method="POST",
    )

    try:
        with urllib.request.urlopen(req, timeout=600) as resp:
            raw = resp.read().decode("utf-8", errors="replace")
    except urllib.error.HTTPError as ex:
        body = ex.read().decode("utf-8", errors="replace") if ex.fp else ""
        raise RuntimeError(f"HTTPError llamando a Ollama: {ex.code} {ex.reason}\n{body}")
    except Exception as ex:
        raise RuntimeError(f"Error llamando a Ollama en {url}: {ex}")

    try:
        obj = json.loads(raw)
    except json.JSONDecodeError:
        raise RuntimeError(f"Respuesta no-JSON de Ollama:\n{raw[:2000]}")

    return obj.get("response", "")


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
# Prompting
# -----------------------------
def build_system_prompt() -> str:
    return (
        "Eres un redactor comercial de software B2B. "
        "Tu salida DEBE ser XML válido (UTF-8) y únicamente el XML, sin explicaciones. "
        "No inventes características que no estén respaldadas por el reporte; "
        "si algo no está claro, formula la característica de forma genérica y prudente. "
        "Escribe en español neutro, tono profesional."
    )


def build_xml_prompt(report_or_summary: str, lang: str, ptype: str, version: str) -> str:
    # Nota: no pegamos el XSD completo (sería gigante), pero sí imponemos estructura y campos.
    return f"""
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
- Mantén un enfoque comercial (beneficios, claridad), pero basado en el reporte.
- Slug: minúsculas con guiones, sin espacios.
- Incluye 5–8 features, 4–6 casos de uso, 5–8 beneficios, 5–8 puntos de confianza, 5–8 preguntas FAQ.
- En integraciones, si no se deduce nada concreto, usa frases prudentes (p.ej. "Importación/exportación CSV", "API / Webhooks (bajo demanda)").

REPORTE / CONTEXTO DEL PROYECTO:
\"\"\"
{report_or_summary}
\"\"\"
""".strip()


def build_summary_prompt(chunk: str, idx: int, total: int) -> str:
    return f"""
Resume este fragmento de documentación técnica en español, de forma útil para redactar una ficha comercial.
Devuelve SOLO texto (sin XML). Prioriza:
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


# -----------------------------
# Main
# -----------------------------
def main():
    ap = argparse.ArgumentParser()
    ap.add_argument("project_path", help="Ruta del proyecto a documentar (carpeta).")
    ap.add_argument("output_dir", help="Carpeta donde se guardará el .md y el .xml.")
    ap.add_argument("--light", default=DEFAULT_LIGHTGOLDENRODYELLOW, help="Ruta a lightgoldenrodyellow.py")
    ap.add_argument("--ollama", default=DEFAULT_OLLAMA_BASE, help="Base URL de Ollama (ej: http://127.0.0.1:11434)")
    ap.add_argument("--model", default=DEFAULT_MODEL, help="Modelo de Ollama (ej: llama3:latest)")
    ap.add_argument("--lang", default="es", help="Atributo lang del XML (default: es)")
    ap.add_argument("--type", default="softwareEducativo", help="Atributo type del XML (default: softwareEducativo)")
    ap.add_argument("--version", default="1.1", help="Atributo version del XML (default: 1.1)")
    args = ap.parse_args()

    project_path = Path(args.project_path).expanduser().resolve()
    output_dir = Path(args.output_dir).expanduser().resolve()

    # 1) Generar reporte Markdown con tu programa
    eprint(f">> Generando reporte con lightgoldenrodyellow: {project_path}")
    report_path = run_lightgoldenrodyellow(args.light, project_path, output_dir)
    eprint(f">> Reporte detectado: {report_path}")

    report_text = read_text(report_path)

    # 2) Si es demasiado grande, lo resumimos antes
    system_prompt = build_system_prompt()

    if len(report_text) > MAX_REPORT_CHARS_DIRECT:
        eprint(f">> Reporte grande ({len(report_text)} chars). Resumiendo por trozos...")
        chunks = chunk_text(report_text, CHUNK_SIZE)
        partials = []
        for i, ch in enumerate(chunks, start=1):
            eprint(f"   - Resumen {i}/{len(chunks)}")
            partial = ollama_generate(
                ollama_base=args.ollama,
                model=args.model,
                prompt=build_summary_prompt(ch, i, len(chunks)),
                system=system_prompt,
            ).strip()
            partials.append(partial)

        eprint(">> Fusionando resúmenes...")
        merged = ollama_generate(
            ollama_base=args.ollama,
            model=args.model,
            prompt=build_merge_summary_prompt("\n\n---\n\n".join(partials)),
            system=system_prompt,
        ).strip()

        context_for_xml = merged
    else:
        context_for_xml = report_text

    # 3) Generar XML final
    eprint(">> Generando XML comercial con Ollama...")
    xml_raw = ollama_generate(
        ollama_base=args.ollama,
        model=args.model,
        prompt=build_xml_prompt(context_for_xml, args.lang, args.type, args.version),
        system=system_prompt,
    )

    xml = extract_productpage_xml(xml_raw)
    if not xml:
        # Si el modelo devolvió “algo” con texto adicional, guardamos todo para depurar
        debug_path = output_dir / ("ollama_raw_" + dt.datetime.now().strftime("%Y%m%d%H%M%S") + ".txt")
        debug_path.write_text(xml_raw, encoding="utf-8", errors="replace")
        raise RuntimeError(
            "No pude extraer un bloque <productPage>...</productPage> de la respuesta de Ollama.\n"
            f"Guardé la salida completa en: {debug_path}"
        )

    # 4) Guardar XML en salida
    ts = dt.datetime.now().strftime("%Y%m%d%H%M%S")
    slug_base = slugify(project_path.name)
    xml_path = output_dir / f"{slug_base}_{ts}.xml"
    xml_path.write_text('<?xml version="1.0" encoding="UTF-8"?>\n' + xml + "\n", encoding="utf-8")

    print(f"[OK] XML generado: {xml_path}")
    print(f"[OK] Reporte usado: {report_path}")


if __name__ == "__main__":
    main()

