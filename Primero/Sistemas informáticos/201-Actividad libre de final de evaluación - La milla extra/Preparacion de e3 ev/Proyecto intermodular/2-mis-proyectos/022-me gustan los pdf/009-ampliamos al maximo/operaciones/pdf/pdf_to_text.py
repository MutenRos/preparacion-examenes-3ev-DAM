#!/usr/bin/env python3

import sys
from pathlib import Path

# Try multiple backends
USE_PYPDF = False
USE_FITZ = False

try:
    from pypdf import PdfReader
    USE_PYPDF = True
except Exception:
    pass

try:
    import fitz  # PyMuPDF
    USE_FITZ = True
except Exception:
    pass


def ensure_dir(path: Path):
    path.mkdir(parents=True, exist_ok=True)


def collect_pdfs(inputs):
    files = []
    for item in inputs:
        p = Path(item)
        if p.is_file() and p.suffix.lower() == ".pdf":
            files.append(p.resolve())
        elif p.is_dir():
            for child in sorted(p.iterdir()):
                if child.is_file() and child.suffix.lower() == ".pdf":
                    files.append(child.resolve())
    return files


def extract_with_pypdf(pdf_path: Path):
    reader = PdfReader(str(pdf_path))
    text_parts = []

    for i, page in enumerate(reader.pages, start=1):
        try:
            txt = page.extract_text() or ""
            text_parts.append(f"\n=== PAGE {i} ===\n")
            text_parts.append(txt)
        except Exception:
            text_parts.append(f"\n=== PAGE {i} (ERROR) ===\n")

    return "\n".join(text_parts)


def extract_with_fitz(pdf_path: Path):
    doc = fitz.open(str(pdf_path))
    text_parts = []

    for i, page in enumerate(doc, start=1):
        try:
            txt = page.get_text()
            text_parts.append(f"\n=== PAGE {i} ===\n")
            text_parts.append(txt)
        except Exception:
            text_parts.append(f"\n=== PAGE {i} (ERROR) ===\n")

    doc.close()
    return "\n".join(text_parts)


def main():
    """
    Usage:
        python3 pdf_to_text.py <output_dir> <file_or_folder> [more...]

    Notes:
        - Uses pypdf if available
        - Falls back to PyMuPDF (fitz)
    """

    if len(sys.argv) < 3:
        print("Usage:")
        print("  python3 pdf_to_text.py <output_dir> <file_or_folder> [more...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    inputs = sys.argv[2:]

    ensure_dir(output_dir)

    pdfs = collect_pdfs(inputs)

    if not pdfs:
        print("ERROR: No PDF files found.")
        sys.exit(1)

    if not USE_PYPDF and not USE_FITZ:
        print("ERROR: No backend available.")
        print("Install one of:")
        print("  sudo apt install python3-pypdf")
        print("  sudo apt install python3-pymupdf")
        sys.exit(1)

    processed = 0
    errors = []

    for idx, pdf in enumerate(pdfs, start=1):
        try:
            if USE_PYPDF:
                text = extract_with_pypdf(pdf)
            else:
                text = extract_with_fitz(pdf)

            out_file = output_dir / f"{idx:03d}_{pdf.stem}.txt"

            with open(out_file, "w", encoding="utf-8") as f:
                f.write(text)

            processed += 1

        except Exception as e:
            errors.append(f"{pdf}: {e}")

    report = output_dir / "report.txt"
    with open(report, "w", encoding="utf-8") as r:
        r.write("PDF TO TEXT REPORT\n")
        r.write("==================\n\n")
        r.write(f"Processed: {processed}\n")
        r.write(f"Errors: {len(errors)}\n\n")

        if errors:
            r.write("ERRORS\n------\n")
            for e in errors:
                r.write(e + "\n")

    if processed == 0:
        print("ERROR: No PDFs processed.")
        print(f"REPORT: {report}")
        sys.exit(1)

    print("OK")
    print(f"Processed PDFs: {processed}")
    print(f"Errors: {len(errors)}")
    print(f"OUTPUT_DIR: {output_dir}")
    print(f"REPORT: {report}")


if __name__ == "__main__":
    main()
