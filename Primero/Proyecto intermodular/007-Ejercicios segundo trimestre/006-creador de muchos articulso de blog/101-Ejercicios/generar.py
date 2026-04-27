#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
generar_articulos_blog.py

Genera artículos para el blog a partir de archivos Markdown en ./documentos,
usando Ollama local (modelo: qwen2.5:7b-instruct-q4_0) y guardándolos en SQLite.

CAMBIO SOLICITADO (categorías):
Para cada heading nivel 3 (### ...), la categoría del post será:

  "<nombre_del_archivo_sin_extension>, <heading_nivel_1_actual>, <heading_nivel_2_actual>"

Ejemplo:
"Backpropagation explicado visualmente, El problema que resuelve backpropagation, Ajustar miles o millones de parámetros"

Reglas:
- Por cada .md en ./documentos:
  - Usar TODO el documento como contexto.
  - Por cada ### (nivel 3):
    - title = heading nivel 3 sin numeración ("Lección 1.1.1 — ..." -> "...")
    - category = "Archivo, H1, H2" (según contexto donde aparece ese ###)
    - content = artículo en Markdown generado por Ollama.

- Inserta solo si no existe ya un post con el mismo (title, category).
- Guarda Markdown en posts.content (blog.php lo renderiza a HTML).

Requisitos:
- Ollama corriendo en localhost:11434
- requests: pip install requests
"""

from __future__ import annotations

import json
import re
import time
import sqlite3
from dataclasses import dataclass
from datetime import datetime
from pathlib import Path
from typing import Dict, List, Optional, Tuple

import requests


# =========================
# CONFIG
# =========================
MODEL = "qwen2.5:7b-instruct-q4_0"
OLLAMA_URL = "http://127.0.0.1:11434/api/generate"

SCRIPT_DIR = Path(__file__).resolve().parent
DOCS_DIR = SCRIPT_DIR / "documentos"
DB_PATH = SCRIPT_DIR / "blog.sqlite"

REQUEST_TIMEOUT = 240
RETRIES = 3
SLEEP_BETWEEN_CALLS = 0.6

CACHE_DIR = SCRIPT_DIR / ".cache_articulos"
CACHE_DIR.mkdir(exist_ok=True)


# =========================
# DATA STRUCTURES
# =========================
@dataclass
class H3Item:
    file_stem: str
    h1: str
    h2: str
    h3_raw: str
    h3_title: str
    category: str


# =========================
# HELPERS
# =========================
def now_iso() -> str:
    return datetime.now().strftime("%Y-%m-%d %H:%M:%S")


def normalize_newlines(s: str) -> str:
    return s.replace("\r\n", "\n").replace("\r", "\n")


def read_text(path: Path) -> str:
    return path.read_text(encoding="utf-8", errors="replace")


def ensure_db(db_path: Path) -> None:
    conn = sqlite3.connect(str(db_path))
    try:
        conn.execute(
            """
            CREATE TABLE IF NOT EXISTS posts (
              id INTEGER PRIMARY KEY AUTOINCREMENT,
              date TEXT NOT NULL,
              title TEXT NOT NULL,
              content TEXT NOT NULL,
              category TEXT NOT NULL
            );
            """
        )
        conn.execute("CREATE INDEX IF NOT EXISTS idx_posts_date ON posts(date DESC);")
        conn.execute("CREATE INDEX IF NOT EXISTS idx_posts_category ON posts(category);")
        conn.commit()
    finally:
        conn.close()


def post_exists(conn: sqlite3.Connection, title: str, category: str) -> bool:
    cur = conn.execute(
        "SELECT 1 FROM posts WHERE title = ? AND category = ? LIMIT 1",
        (title, category),
    )
    return cur.fetchone() is not None


def insert_post(conn: sqlite3.Connection, title: str, content_md: str, category: str) -> None:
    conn.execute(
        "INSERT INTO posts(date, title, content, category) VALUES(?, ?, ?, ?)",
        (now_iso(), title, content_md, category),
    )
    conn.commit()


def cache_key(file_path: Path, title: str, category: str) -> Path:
    base = f"{file_path.name}__{title}__{category}"
    safe = re.sub(r"[^a-zA-Z0-9._-]+", "_", base)[:180]
    return CACHE_DIR / f"{safe}.json"


def strip_numbering_from_h3(title: str) -> str:
    """
    "Lección 1.1.1 — Por qué ajustar pesos es difícil" -> "Por qué ajustar pesos es difícil"
    """
    t = title.strip()

    # Quitar prefijos tipo "Lección", "Leccion", "Lesson", "Tema", etc.
    t = re.sub(r"^(lecci[oó]n|lesson|tema|cap[ií]tulo|unidad)\s*", "", t, flags=re.IGNORECASE)

    # Quitar numeración inicial "1.2.3", "1)", "1.2 —", etc.
    t = re.sub(r"^\s*\d+(?:[\.\-]\d+){0,6}\s*[\)\.\-–—:]*\s*", "", t)

    # Quitar separadores iniciales
    t = re.sub(r"^\s*[–—-]\s*", "", t)

    # Normalizar espacios
    t = re.sub(r"\s{2,}", " ", t).strip()
    return t if t else title.strip()


def extract_front_matter(md: str) -> Tuple[Dict[str, str], str]:
    md = normalize_newlines(md)
    if not md.startswith("---\n"):
        return {}, md

    parts = md.split("\n---\n", 1)
    if len(parts) != 2:
        return {}, md

    fm_block = parts[0].splitlines()[1:]
    body = parts[1]

    fm: Dict[str, str] = {}
    for line in fm_block:
        line = line.strip()
        if not line or line.startswith("#"):
            continue
        m = re.match(r"^([A-Za-z0-9_-]+)\s*:\s*(.*)\s*$", line)
        if m:
            k = m.group(1).strip()
            v = m.group(2).strip().strip('"').strip("'")
            fm[k] = v

    return fm, body


def extract_hierarchy_items(md_body: str, file_stem: str) -> List[H3Item]:
    """
    Recorre el documento en orden y para cada ### captura el H1 y H2 más recientes.
    """
    h1_current = ""
    h2_current = ""
    items: List[H3Item] = []

    for line in normalize_newlines(md_body).splitlines():
        m1 = re.match(r"^\s*#\s+(.+?)\s*$", line)
        if m1:
            h1_current = m1.group(1).strip()
            h2_current = ""  # al cambiar H1, reinicia H2
            continue

        m2 = re.match(r"^\s*##\s+(.+?)\s*$", line)
        if m2:
            h2_current = m2.group(1).strip()
            continue

        m3 = re.match(r"^\s*###\s+(.+?)\s*$", line)
        if m3:
            raw_h3 = m3.group(1).strip()
            title = strip_numbering_from_h3(raw_h3)

            # Si no hay H1/H2 en ese punto, pon placeholders (evita categoría vacía)
            h1 = h1_current.strip() if h1_current.strip() else "Sin sección principal"
            h2 = h2_current.strip() if h2_current.strip() else "Sin subsección"

            category = f"{file_stem}, {h1}, {h2}"

            items.append(
                H3Item(
                    file_stem=file_stem,
                    h1=h1,
                    h2=h2,
                    h3_raw=raw_h3,
                    h3_title=title,
                    category=category,
                )
            )

    return items


def ollama_generate(prompt: str) -> str:
    payload = {
        "model": MODEL,
        "prompt": prompt,
        "stream": False,
        "options": {
            "temperature": 0.7,
            "top_p": 0.9,
            "num_ctx": 8192,
        },
    }

    last_err = None
    for attempt in range(1, RETRIES + 1):
        try:
            r = requests.post(OLLAMA_URL, json=payload, timeout=REQUEST_TIMEOUT)
            r.raise_for_status()
            data = r.json()
            text = data.get("response", "")
            if not isinstance(text, str) or not text.strip():
                raise RuntimeError("Respuesta vacía de Ollama.")
            return text.strip()
        except Exception as e:
            last_err = e
            time.sleep(1.0 * attempt)

    raise RuntimeError(f"Fallo llamando a Ollama tras {RETRIES} intentos: {last_err}")


def build_prompt(full_doc: str, category: str, article_title: str) -> str:
    return f"""Eres un redactor técnico experto en IA aplicada a programación.
Escribe en español, con un tono claro y práctico para programadores.

CONTEXTO (documento completo, úsalo para alinear terminología y enfoque):
\"\"\"{full_doc}\"\"\"

METADATOS:
- Categoría del artículo (contexto): {category}
- Título del artículo: "{article_title}"

TAREA:
Escribe un artículo de blog en formato Markdown sobre el título indicado.
Longitud objetivo: 900 a 1400 palabras.

Estructura mínima:
1) Introducción (por qué importa)
2) Explicación principal con ejemplos (incluye 1 bloque de código corto si ayuda)
3) Errores típicos / trampas (al menos 3)
4) Checklist accionable (5-10 puntos)
5) Cierre con "Siguientes pasos" (2-4 bullets)

REGLAS:
- NO incluyas front-matter YAML.
- NO incluyas enlaces inventados.
- Devuelve SOLO el Markdown del artículo.
"""


# =========================
# MAIN
# =========================
def main() -> None:
    if not DOCS_DIR.is_dir():
        raise SystemExit(f"ERROR: No existe la carpeta: {DOCS_DIR}")

    ensure_db(DB_PATH)

    md_files = sorted([p for p in DOCS_DIR.glob("*.md") if p.is_file()])
    if not md_files:
        print(f"No se encontraron .md en {DOCS_DIR}")
        return

    print(f"Encontrados {len(md_files)} archivos en {DOCS_DIR}")
    print(f"DB: {DB_PATH}")
    print(f"Modelo: {MODEL}")
    print("-" * 70)

    conn = sqlite3.connect(str(DB_PATH))
    try:
        inserted = 0
        skipped = 0

        for md_path in md_files:
            raw = read_text(md_path)
            _fm, body = extract_front_matter(raw)

            # Categoría base: nombre del archivo sin extensión (tal como pides)
            file_stem = md_path.stem.strip()
            if not file_stem:
                file_stem = md_path.name

            items = extract_hierarchy_items(body, file_stem=file_stem)
            if not items:
                print(f"[SKIP] {md_path.name}: no hay headings ###")
                continue

            print(f"\n[{md_path.name}] H3 encontrados: {len(items)}")

            full_doc_for_context = raw.strip()

            for it in items:
                title = it.h3_title
                category = it.category

                if post_exists(conn, title, category):
                    skipped += 1
                    print(f"  - (skip) Ya existe: [{category}] {title}")
                    continue

                ck = cache_key(md_path, title, category)
                if ck.is_file():
                    try:
                        cached = json.loads(ck.read_text(encoding="utf-8"))
                        content_md = (cached.get("content") or "").strip()
                        if content_md:
                            insert_post(conn, title, content_md, category)
                            inserted += 1
                            print(f"  - (cache→db) [{category}] {title}")
                            continue
                    except Exception:
                        pass

                print(f"  - (gen) [{category}] {title}")
                prompt = build_prompt(full_doc_for_context, category, title)
                content_md = ollama_generate(prompt)

                if len(content_md.strip()) < 200:
                    raise RuntimeError(f"Contenido demasiado corto generado para: {title}")

                ck.write_text(
                    json.dumps(
                        {
                            "source_file": md_path.name,
                            "category": category,
                            "title": title,
                            "generated_at": now_iso(),
                            "model": MODEL,
                            "content": content_md,
                            "hierarchy": {"h1": it.h1, "h2": it.h2, "h3_raw": it.h3_raw},
                        },
                        ensure_ascii=False,
                        indent=2,
                    ),
                    encoding="utf-8",
                )

                insert_post(conn, title, content_md, category)
                inserted += 1
                time.sleep(SLEEP_BETWEEN_CALLS)

        print("\n" + "=" * 70)
        print(f"Insertados: {inserted}")
        print(f"Saltados (ya existían): {skipped}")
        print(f"Cache: {CACHE_DIR}")
        print("=" * 70)

    finally:
        conn.close()


if __name__ == "__main__":
    main()

