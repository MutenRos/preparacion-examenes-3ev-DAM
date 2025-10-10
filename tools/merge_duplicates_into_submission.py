"""Consolidate files in each mirror folder so there's a single submission.md.

Behavior:
- For each folder under entregas/Primero, gather README.md, any submission.md, any .md/.txt scripts, and .py files.
- Create or update a single 'submission.md' that contains in order:
  1) README content (if exists) under a 'Contexto' section
  2) Existing submission.md content (if exists)
  3) Any other text files appended under subsections with filenames
  4) Any scripts (.py) embedded as fenced code blocks labeled with the filename
- Move original files to a backup folder 'merged_backups/<timestamp>/' inside the mirror folder
- Produce a top-level report 'entregas/Primero/replica_merge_report.json'
"""
import json
from pathlib import Path
import time
import shutil


ROOT = Path(__file__).resolve().parent.parent
PRIMERO = ROOT / 'entregas' / 'Primero'
REPORT = PRIMERO / 'replica_merge_report.json'


def gather_files(folder: Path):
    files = {'readme': None, 'submission': None, 'text': [], 'scripts': []}
    for p in folder.iterdir():
        if p.is_file():
            ln = p.name.lower()
            if ln == 'readme.md' or ln == 'readme.txt':
                files['readme'] = p
            elif ln == 'submission.md':
                files['submission'] = p
            elif ln.endswith('.md') or ln.endswith('.txt'):
                if p.name not in ('readme.md', 'submission.md'):
                    files['text'].append(p)
            elif ln.endswith('.py'):
                files['scripts'].append(p)
    return files


def merge_folder(folder: Path, timestamp: int):
    files = gather_files(folder)
    if not any(files.values()):
        return {'status': 'skipped', 'reason': 'no_files'}

    merged = []
    merged.append(f"# Entrega: {folder.name}\n")

    if files['readme']:
        merged.append("## Contexto (README)\n")
        merged.append(files['readme'].read_text())
        merged.append('\n')

    if files['submission']:
        merged.append("## Entrega original (submission.md)\n")
        merged.append(files['submission'].read_text())
        merged.append('\n')

    for t in files['text']:
        merged.append(f"## Archivo: {t.name}\n")
        merged.append(t.read_text())
        merged.append('\n')

    for s in files['scripts']:
        merged.append(f"## Script: {s.name}\n")
        merged.append(f"```python\n{s.read_text()}\n```\n")

    submission_path = folder / 'submission.md'
    # write merged content
    submission_path.write_text('\n'.join(merged))

    # backup originals into merged_backups/<timestamp>/
    backup_dir = folder / 'merged_backups' / str(timestamp)
    backup_dir.mkdir(parents=True, exist_ok=True)
    moved = []
    for cat in ('readme', 'submission'):
        p = files.get(cat)
        if p and p.exists():
            dest = backup_dir / p.name
            shutil.move(str(p), str(dest))
            moved.append(str(dest))
    for p in files['text'] + files['scripts']:
        if p.exists():
            dest = backup_dir / p.name
            shutil.move(str(p), str(dest))
            moved.append(str(dest))

    return {'status': 'merged', 'merged_to': str(submission_path), 'backed_up': moved}


def main():
    report = {}
    ts = int(time.time())
    for folder in sorted(PRIMERO.iterdir()):
        if folder.is_dir():
            res = merge_folder(folder, ts)
            report[str(folder.relative_to(PRIMERO))] = res

    REPORT.write_text(json.dumps(report, indent=2, ensure_ascii=False))
    print(f"Wrote merge report to {REPORT}")


if __name__ == '__main__':
    main()
