"""Clean all student submission files from entregas/Primero, keeping only professor's originals."""
import os
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
OUT_ROOT = ROOT / 'entregas' / 'Primero'

def is_student_file(p: Path) -> bool:
    # Remove submission.md, solution.py, .txt, .bak, merged_backups, submission.report.json
    if p.name in {'submission.md', 'solution.py', 'submission.report.json'}:
        return True
    if p.suffix in {'.txt', '.bak'}:
        return True
    if p.name == 'merged_backups':
        return True
    if p.name.startswith('replica_merge_report') or p.name.startswith('replica_report'):
        return True
    return False

def clean_dir(d: Path):
    for p in d.iterdir():
        if p.is_dir():
            if p.name == 'merged_backups':
                # Remove entire backup dir
                for root, dirs, files in os.walk(p, topdown=False):
                    for name in files:
                        Path(root, name).unlink()
                    for name in dirs:
                        Path(root, name).rmdir()
                p.rmdir()
            else:
                clean_dir(p)
        elif is_student_file(p):
            p.unlink()

def main():
    clean_dir(OUT_ROOT)
    print(f"Cleaned student submissions from {OUT_ROOT}")

if __name__ == '__main__':
    main()
