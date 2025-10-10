#!/usr/bin/env python3
"""
Crea la estructura de carpetas `entregas/Primero/` a partir del índice de rúbricas
generado en `tools/rubrica_checklists/primero_index.json`.

Para cada unidad crea:
  entregas/Primero/NN-<slug>/README.md  (explica la unidad y enlaza rúbrica)
  entregas/Primero/NN-<slug>/submission.md  (plantilla para entregar)

Uso:
  python3 tools/create_entregas_primero.py
"""
import json
from pathlib import Path
import re

ROOT = Path(__file__).resolve().parent.parent
OUT_BASE = ROOT / 'entregas' / 'Primero'
OUT_BASE.mkdir(parents=True, exist_ok=True)

IDX = Path(ROOT / 'tools' / 'rubrica_checklists' / 'primero_index.json')
TEMPLATE = Path(ROOT / 'tools' / 'rubrica_checklists' / 'submission_template.md')


def slug(name: str) -> str:
    s = name.replace(' ', '_').replace('/', '_')
    s = re.sub(r'[^0-9A-Za-z_\-\.]', '', s)
    return s


def main():
    data = json.loads(IDX.read_text(encoding='utf-8'))
    # Orden: usar el orden natural de las claves (ya corresponden al árbol)
    items = list(data.items())
    for i, (unidad, meta) in enumerate(items, start=1):
        prefix = f'{i:02d}'
        name = unidad.split('/')[-1]
        dir_name = f'{prefix}-{slug(name)}'
        out_dir = OUT_BASE / dir_name
        out_dir.mkdir(parents=True, exist_ok=True)

        # README.md con referencia a la rúbrica
        readme = out_dir / 'README.md'
        if not readme.exists():
            readme.write_text(f'# Entrega {prefix} - {name}\n\nUnidad: {unidad}\n\nRúbrica: {meta.get("archivo_origen")}', encoding='utf-8')

        # Copiar plantilla de submission
        submission = out_dir / 'submission.md'
        if not submission.exists() and TEMPLATE.exists():
            submission.write_text(TEMPLATE.read_text(encoding='utf-8'), encoding='utf-8')

    print(f'Creada estructura en {OUT_BASE} con {len(items)} unidades.')


if __name__ == '__main__':
    main()
