"""Move existing submission files from source-style folders into the numbered mirror folders.

The script reads tools/rubrica_checklists/primero_index.json to get the list of expected
units. For each unit it looks for files in 'entregas/Primero/<source_rel>/' (the original
layout) and moves them into the mirrored numbered folder created previously under
'entregas/Primero/'. Conflicting files are preserved by adding a .bak timestamp.

Generates 'entregas/Primero/replica_report.json' with actions taken.
"""
import json
import shutil
from pathlib import Path
import re
import unicodedata
import time

ROOT = Path(__file__).resolve().parent.parent
INDEX = ROOT / 'tools' / 'rubrica_checklists' / 'primero_index.json'
OUT_ROOT = ROOT / 'entregas' / 'Primero'


def normalize(name: str) -> str:
    # lowercase, remove accents, replace non-alnum with underscore, collapse underscores
    s = name.lower()
    s = ''.join(c for c in unicodedata.normalize('NFKD', s) if not unicodedata.combining(c))
    s = re.sub(r'[^a-z0-9]+', '_', s)
    s = re.sub(r'_+', '_', s).strip('_')
    return s


def find_target_for_last_segment(last_seg: str) -> Path:
    # try to find a directory under OUT_ROOT whose normalized name contains normalized last_seg
    target_norm = normalize(last_seg)
    for d in OUT_ROOT.iterdir():
        if d.is_dir():
            name_norm = normalize(d.name)
            if target_norm in name_norm or name_norm in target_norm:
                return d
    return None


def main():
    data = json.loads(INDEX.read_text())
    report = {}
    timestamp = int(time.time())
    for key in data.keys():
        # key: 'Primero/Bases de datos/001-Almacenamiento de la información'
        parts = key.split('/', 1)
        if len(parts) != 2:
            continue
        source_rel = parts[1]
        src_dir = OUT_ROOT / Path(source_rel)
        last_seg = Path(source_rel).name
        target_dir = find_target_for_last_segment(last_seg)
        if target_dir is None:
            # no matching mirror directory found; skip
            report[source_rel] = {'status': 'no_target_found'}
            continue

        moved = []
        if src_dir.exists() and src_dir.is_dir():
            for p in src_dir.iterdir():
                if p.is_file():
                    dest = target_dir / p.name
                    if dest.exists():
                        bak = target_dir / f"{p.name}.bak.{timestamp}"
                        shutil.move(str(p), str(bak))
                        moved.append({'from': str(p), 'to': str(bak), 'note': 'conflict_renamed'})
                    else:
                        shutil.move(str(p), str(dest))
                        moved.append({'from': str(p), 'to': str(dest)})
            # remove src_dir if empty
            try:
                if not any(src_dir.iterdir()):
                    src_dir.rmdir()
            except Exception:
                pass
        else:
            report[source_rel] = {'status': 'source_missing'}
            continue

        report[source_rel] = {'status': 'moved', 'target': str(target_dir), 'files': moved}

    out_file = OUT_ROOT / 'replica_report.json'
    out_file.write_text(json.dumps(report, indent=2, ensure_ascii=False))
    print(f"Wrote report to {out_file}")


if __name__ == '__main__':
    main()
