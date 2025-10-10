"""Recreate 'entregas/' as a mirror of the repository root (professor materials).

This script will:
- backup the current 'entregas/' to 'entregas_backup_<timestamp>'
- create a fresh 'entregas/' and copy all files and folders from the repository root
  into it, excluding '.git' and the existing 'entregas/' folder to avoid recursion.

After running, 'entregas/' will contain a copy of the repo content (the professor's
materials) so the student can add their submissions there.
"""
import shutil
from pathlib import Path
import time

ROOT = Path(__file__).resolve().parent.parent
ENTREGAS = ROOT / 'entregas'


def main():
    timestamp = int(time.time())
    if ENTREGAS.exists():
        backup = ROOT / f'entregas_backup_{timestamp}'
        shutil.move(str(ENTREGAS), str(backup))
        print(f"Backed up existing 'entregas' to {backup}")

    ENTREGAS.mkdir()

    for p in ROOT.iterdir():
        # skip .git, tools, the new entregas directory itself
        if p.name in {'.git', 'entregas'}:
            continue
        dest = ENTREGAS / p.name
        if p.is_dir():
            shutil.copytree(str(p), str(dest))
        else:
            shutil.copy2(str(p), str(dest))

    print(f"Created new 'entregas/' mirror of repo root at {ENTREGAS}")


if __name__ == '__main__':
    main()
