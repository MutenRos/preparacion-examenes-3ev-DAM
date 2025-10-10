"""Utility: create mirror folders for Primero index under entregas/Primero

This script reads tools/rubrica_checklists/primero_index.json and creates
matching directories under entregas/Primero/. It does not move files; it only
creates the folder structure and a small README in each folder.
"""
import json
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
INDEX = ROOT / 'tools' / 'rubrica_checklists' / 'primero_index.json'
OUT_ROOT = ROOT / 'entregas' / 'Primero'


def slug_from_key(key: str) -> Path:
    # key example: "Primero/Bases de datos/001-Almacenamiento de la información"
    parts = key.split('/')
    # drop the leading 'Primero'
    return Path('/'.join(parts[1:]))


def main():
    OUT_ROOT.mkdir(parents=True, exist_ok=True)
    data = json.loads(INDEX.read_text())
    for k in data.keys():
        rel = slug_from_key(k)
        target = OUT_ROOT / rel
        target.mkdir(parents=True, exist_ok=True)
        readme = target / 'README.md'
        if not readme.exists():
            readme.write_text(f"# {rel.name}\n\nCarpeta espejo generada automáticamente para la unidad {rel.as_posix()}\n")


if __name__ == '__main__':
    main()
