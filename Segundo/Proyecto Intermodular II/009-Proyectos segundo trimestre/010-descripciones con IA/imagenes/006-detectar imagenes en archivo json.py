#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import json
from pathlib import Path
from typing import Any, List

# -------------------------------------------------
# CONFIGURACIÓN
# -------------------------------------------------

# Carpeta donde están los JSON
INPUT_JSON_FOLDER = Path("//var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/productos/jocarsa-rosybrown")

# Extensiones consideradas como imagen
IMAGE_EXTENSIONS = {".jpg", ".jpeg", ".png", ".webp", ".gif"}

# -------------------------------------------------
# FUNCIONES
# -------------------------------------------------

def extract_image_paths(data: Any, results: List[str]) -> None:
    """
    Recorre recursivamente un JSON y extrae valores de '@src'
    """
    if isinstance(data, dict):
        for key, value in data.items():
            if key == "@src" and isinstance(value, str):
                results.append(value)
            else:
                extract_image_paths(value, results)

    elif isinstance(data, list):
        for item in data:
            extract_image_paths(item, results)


def process_json_file(json_path: Path) -> None:
    print(f"\n📄 Archivo JSON: {json_path.name}")

    try:
        with json_path.open("r", encoding="utf-8") as f:
            data = json.load(f)
    except Exception as e:
        print(f"  ❌ Error leyendo JSON: {e}")
        return

    image_paths: List[str] = []
    extract_image_paths(data, image_paths)

    if not image_paths:
        print("  ⚠️  No se encontraron imágenes")
        return

    base_dir = json_path.parent

    for img in image_paths:
        img_path = (base_dir / img).resolve()
        exists = img_path.exists()
        status = "✅ OK" if exists else "❌ NO EXISTE"

        print(f"  {status}  {img}")


# -------------------------------------------------
# MAIN
# -------------------------------------------------

def main():
    if not INPUT_JSON_FOLDER.exists():
        print(f"❌ La carpeta no existe: {INPUT_JSON_FOLDER}")
        return

    json_files = sorted(INPUT_JSON_FOLDER.glob("*.json"))

    if not json_files:
        print("⚠️  No se encontraron archivos JSON")
        return

    print(f"📂 Carpeta JSON: {INPUT_JSON_FOLDER}")
    print(f"📦 Archivos encontrados: {len(json_files)}")

    for json_file in json_files:
        process_json_file(json_file)


if __name__ == "__main__":
    main()

