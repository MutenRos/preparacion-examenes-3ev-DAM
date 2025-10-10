#!/usr/bin/env python3
"""
Ingesta de entregas del alumno.

Uso:
  python3 tools/ingest_submissions.py /ruta/a/carpeta_con_entregas [--dry-run]

El script intentará emparejar cada archivo de la carpeta de origen con una carpeta
de `entregas/Primero/` basándose en coincidencias con el nombre de la unidad o el
slug. Si no encuentra coincidencia, lo colocará en `entregas/Primero/unmatched/`.

Para cada archivo movido ejecutará el evaluador básico (`evaluate_submission.py`) y
guardará un `report.json` en la carpeta de entrega con el resultado.

Requisitos: ejecutar desde la raíz del repositorio.
"""
import argparse
from pathlib import Path
import shutil
import json
import re
import subprocess

ROOT = Path(__file__).resolve().parent.parent
ENTREGAS = ROOT / 'entregas' / 'Primero'
INDEX = ROOT / 'tools' / 'rubrica_checklists' / 'primero_index.json'
EVALUATOR = ROOT / 'tools' / 'rubrica_checklists' / 'evaluate_submission.py'


def load_index():
    if not INDEX.exists():
        return {}
    return json.loads(INDEX.read_text(encoding='utf-8'))


def candidates():
    # Map slug/unit name to entrega dir path
    res = {}
    for d in ENTREGAS.iterdir():
        if not d.is_dir():
            continue
        # e.g. '10-001-Almacenamiento_de_la_informacin'
        res[d.name.lower()] = d
        # also add just the trailing name
        tail = '-'.join(d.name.split('-')[1:])
        res[tail.lower()] = d
        # and a version with underscores replaced by spaces
        res[tail.replace('_', ' ').lower()] = d
    return res


def match_target(fname: str, text: str, cand_map):
    key = fname.lower()
    # try direct match with dir names
    for k, d in cand_map.items():
        if k in key:
            return d

    # try matching by content: unit name presence
    for k, d in cand_map.items():
        if k in text.lower():
            return d

    return None


def run_evaluator(target_file: Path):
    if not EVALUATOR.exists():
        return {'error': 'Evaluator not found'}
    try:
        out = subprocess.check_output(['python3', str(EVALUATOR), str(target_file)], cwd=str(ROOT), stderr=subprocess.STDOUT, timeout=30)
        return json.loads(out.decode('utf-8'))
    except subprocess.CalledProcessError as e:
        return {'error': 'Evaluator failed', 'output': e.output.decode('utf-8', errors='ignore')}
    except Exception as e:
        return {'error': str(e)}


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument('src', help='Carpeta con archivos de entrega')
    parser.add_argument('--dry-run', action='store_true')
    args = parser.parse_args()

    src = Path(args.src)
    if not src.exists() or not src.is_dir():
        print('Carpeta de origen no encontrada:', src)
        return

    idx = load_index()
    cand = candidates()
    unmatched_dir = ENTREGAS / 'unmatched'
    unmatched_dir.mkdir(parents=True, exist_ok=True)

    summary = []
    files = [p for p in src.iterdir() if p.is_file()]
    for f in files:
        text = ''
        try:
            text = f.read_text(encoding='utf-8')
        except Exception:
            try:
                text = f.read_text(encoding='latin-1')
            except Exception:
                text = ''

        target = match_target(f.name, text, cand)
        if target is None:
            target = unmatched_dir

        dest = target / f.name
        action = f'MOVE -> {dest}'
        if args.dry_run:
            print('[dry-run]', f.name, '->', target)
        else:
            # if destination exists, append suffix
            if dest.exists():
                dest = target / (f.stem + '_from_user' + f.suffix)
            shutil.copy2(str(f), str(dest))
            # if the moved file isn't named submission.md, also create/overwrite submission.md with its content
            # (so evaluator knows where to look)
            sub = target / 'submission.md'
            sub.write_text(dest.read_text(encoding='utf-8'), encoding='utf-8')

            # run evaluator
            eval_res = run_evaluator(sub)
            report = {
                'source': str(f),
                'dest': str(dest),
                'evaluator': eval_res
            }
            rpt_file = target / (f.stem + '.report.json')
            rpt_file.write_text(json.dumps(report, ensure_ascii=False, indent=2), encoding='utf-8')
            summary.append(report)
            print('Ingestado:', f.name, '->', target.name)

    # summary file
    if not args.dry_run:
        out_summary = src / 'ingest_summary.json'
        out_summary.write_text(json.dumps(summary, ensure_ascii=False, indent=2), encoding='utf-8')
        print('Resumen en', out_summary)


if __name__ == '__main__':
    main()
