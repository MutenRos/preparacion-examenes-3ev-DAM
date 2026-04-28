#!/usr/bin/env python3

import sys
import subprocess
from pathlib import Path

def ensure_dir(path: Path):
    path.mkdir(parents=True, exist_ok=True)


def collect_docx(inputs):
    files = []
    for item in inputs:
        p = Path(item)
        if p.is_file() and p.suffix.lower() == ".docx":
            files.append(p.resolve())
        elif p.is_dir():
            for child in sorted(p.iterdir()):
                if child.is_file() and child.suffix.lower() == ".docx":
                    files.append(child.resolve())
    return files


def convert_docx_to_pdf(input_path: Path, output_dir: Path):
    """
    Uses LibreOffice in headless mode
    """
    cmd = [
        "libreoffice",
        "--headless",
        "--convert-to", "pdf",
        "--outdir", str(output_dir),
        str(input_path)
    ]

    result = subprocess.run(cmd, stdout=subprocess.PIPE, stderr=subprocess.PIPE)

    return result.returncode, result.stdout.decode(), result.stderr.decode()


def main():
    """
    Usage:
        python3 docx_to_pdf.py <output_dir> <file_or_folder> [more...]

    Requires:
        sudo apt install libreoffice
    """

    if len(sys.argv) < 3:
        print("Usage:")
        print("  python3 docx_to_pdf.py <output_dir> <file_or_folder> [more_files_or_folders...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    inputs = sys.argv[2:]

    ensure_dir(output_dir)

    files = collect_docx(inputs)

    if not files:
        print("ERROR: No DOCX files found.")
        sys.exit(1)

    processed = 0
    errors = []

    for f in files:
        code, out, err = convert_docx_to_pdf(f, output_dir)

        if code == 0:
            processed += 1
        else:
            errors.append(f"{f}: {err.strip()}")

    report = output_dir / "report.txt"
    with open(report, "w", encoding="utf-8") as r:
        r.write("DOCX TO PDF REPORT\n")
        r.write("==================\n\n")
        r.write(f"Processed: {processed}\n")
        r.write(f"Errors: {len(errors)}\n\n")

        if errors:
            r.write("ERRORS\n------\n")
            for e in errors:
                r.write(e + "\n")

    if processed == 0:
        print("ERROR: No files converted.")
        print(f"REPORT: {report}")
        sys.exit(1)

    print("OK")
    print(f"Processed: {processed}")
    print(f"Errors: {len(errors)}")
    print(f"OUTPUT_DIR: {output_dir}")
    print(f"REPORT: {report}")


if __name__ == "__main__":
    main()
