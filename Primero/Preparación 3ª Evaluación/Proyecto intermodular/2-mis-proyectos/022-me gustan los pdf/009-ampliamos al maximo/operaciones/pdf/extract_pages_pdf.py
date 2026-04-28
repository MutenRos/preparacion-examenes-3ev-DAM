#!/usr/bin/env python3

import sys
from pathlib import Path

try:
    from pypdf import PdfReader, PdfWriter
except ImportError:
    print("ERROR: pypdf is not installed. Install it with: sudo apt install python3-pypdf or pip install pypdf")
    sys.exit(1)


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


def parse_pages(pages_str, total_pages):
    """
    Examples:
    "1,3,5"
    "1-3"
    "1-3,5,7-9"
    """
    pages = set()

    parts = pages_str.split(",")

    for part in parts:
        part = part.strip()
        if "-" in part:
            start, end = part.split("-")
            start = int(start)
            end = int(end)
            for i in range(start, end + 1):
                if 1 <= i <= total_pages:
                    pages.add(i - 1)  # zero-based
        else:
            i = int(part)
            if 1 <= i <= total_pages:
                pages.add(i - 1)

    return sorted(pages)


def extract_pages(input_pdf: Path, output_pdf: Path, pages):
    reader = PdfReader(str(input_pdf))
    writer = PdfWriter()

    for p in pages:
        writer.add_page(reader.pages[p])

    with open(output_pdf, "wb") as f:
        writer.write(f)


def main():
    """
    Usage:
        python3 extract_pages_pdf.py <output_dir> <pages> <file_or_folder> [more...]

    Example:
        python3 extract_pages_pdf.py ./out "1-3,5" file.pdf
    """

    if len(sys.argv) < 4:
        print("Usage:")
        print("  python3 extract_pages_pdf.py <output_dir> <pages> <file_or_folder> [more...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    pages_str = sys.argv[2]
    inputs = sys.argv[3:]

    ensure_dir(output_dir)

    pdfs = collect_pdfs(inputs)

    if not pdfs:
        print("ERROR: No PDF files found.")
        sys.exit(1)

    processed = 0
    errors = []

    for idx, pdf in enumerate(pdfs, start=1):
        try:
            reader = PdfReader(str(pdf))
            total_pages = len(reader.pages)

            pages = parse_pages(pages_str, total_pages)

            if not pages:
                raise Exception("No valid pages selected")

            output_file = output_dir / f"{idx:03d}_{pdf.stem}_extract.pdf"

            extract_pages(pdf, output_file, pages)

            processed += 1

        except Exception as e:
            errors.append(f"{pdf}: {e}")

    report = output_dir / "report.txt"
    with open(report, "w", encoding="utf-8") as r:
        r.write("EXTRACT PAGES PDF REPORT\n")
        r.write("========================\n\n")
        r.write(f"Pages: {pages_str}\n")
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
