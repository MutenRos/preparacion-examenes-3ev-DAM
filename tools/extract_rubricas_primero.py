#!/usr/bin/env python3
"""
Extrae los archivos "Criterios de evaluacion.md" bajo la carpeta `Primero/` y genera
un JSON por unidad en `tools/rubrica_checklists/` además de un índice consolidado.

Uso:
  python3 tools/extract_rubricas_primero.py

Salida:
  - tools/rubrica_checklists/Primero_<slug>.json
  - tools/rubrica_checklists/primero_index.json

Este script es conservador: no modifica archivos originales.
"""
import re
import json
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
PRIMERO = ROOT / 'Primero'
OUT_DIR = ROOT / 'tools' / 'rubrica_checklists'
OUT_DIR.mkdir(parents=True, exist_ok=True)

CRITERIA_RE = re.compile(r'^\s*([a-zA-Z0-9]+)\)\s*(.+)$')


def slugify(path: Path) -> str:
    # crea un slug seguro para el nombre de archivo
    s = str(path.relative_to(PRIMERO)).replace('/', '_').replace(' ', '_')
    s = re.sub(r'[^0-9A-Za-z_\-]', '', s)
    return s


def extract_criteria(text: str):
    lines = text.splitlines()
    criteria = []
    started = False
    for ln in lines:
        if not started:
            if 'Criterios' in ln and 'evaluaci' in ln.lower():
                started = True
            continue
        if not ln.strip():
            continue
        m = CRITERIA_RE.match(ln)
        if m:
            cid = m.group(1).strip()
            txt = m.group(2).strip()
            criteria.append({'id': cid, 'texto': txt})
        else:
            # si no casa con patrón, pero ya hay criterios, intentar anexar como continuación
            if criteria:
                criteria[-1]['texto'] += ' ' + ln.strip()
    return criteria


def main():
    index = {}
    count = 0
    if not PRIMERO.exists():
        print('No se encontró la carpeta Primero/.')
        return

    for md in PRIMERO.rglob('Criterios de evaluacion.md'):
        try:
            text = md.read_text(encoding='utf-8')
        except Exception as e:
            print(f'No se pudo leer {md}: {e}')
            continue

        criteria = extract_criteria(text)
        rel = md.relative_to(ROOT)
        slug = slugify(md.parent)
        out_file = OUT_DIR / f'Primero_{slug}.json'

        payload = {
            'unidad': str(md.parent.relative_to(ROOT)),
            'archivo_origen': str(rel),
            'criterios': criteria,
        }

        out_file.write_text(json.dumps(payload, ensure_ascii=False, indent=2), encoding='utf-8')
        index[str(md.parent.relative_to(ROOT))] = {
            'archivo_origen': str(rel),
            'out_file': str(out_file.relative_to(ROOT)),
            'num_criterios': len(criteria)
        }
        count += 1

    # escribir índice
    idx_file = OUT_DIR / 'primero_index.json'
    idx_file.write_text(json.dumps(index, ensure_ascii=False, indent=2), encoding='utf-8')

    print(f'Procesadas {count} rúbricas. Salida en {OUT_DIR}')


if __name__ == '__main__':
    main()
