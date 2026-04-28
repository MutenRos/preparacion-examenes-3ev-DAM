#!/usr/bin/env python3

import sys
import os
from pathlib import Path

try:
    from pypdf import PdfMerger, PdfReader
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


def parse_ranges(range_str, total_pages):
    """
    Examples:
        "all"
        "1-3"
        "1-3,5"
        "2,4,6"
    """
    if range_str.lower() == "all":
        return [(0, total_pages)]

    ranges = []
    parts = range_str.split(",")

    for part in parts:
        part = part.strip()

        if "-" in part:
            start, end = part.split("-")
            start = int(start) - 1
            end = int(end)
            ranges.append((start, end))
        else:
            i = int(part)
            ranges.append((i - 1, i))

    return ranges


def merge_pdfs(input_files, output_file, range_str="all"):
    merger = PdfMerger()

    for pdf_path in input_files:
        reader = PdfReader(str(pdf_path))
        total_pages = len(reader.pages)

        ranges = parse_ranges(range_str, total_pages)

        for r in ranges:
            merger.append(str(pdf_path), pages=r)

    with open(output_file, "wb") as f:
        merger.write(f)

    merger.close()


def main():
    """
    Usage:
        python3 join_pdf.py <output_pdf> <range|all> <file_or_folder> [more...]

    Examples:
        python3 join_pdf.py salida.pdf all file1.pdf file2.pdf
        python3 join_pdf.py salida.pdf "1-3,5" file1.pdf file2.pdf
        python3 join_pdf.py salida.pdf all ./pdfs
    """

    if len(sys.argv) < 4:
        print("Usage:")
        print("  python3 join_pdf.py <output_pdf> <range|all> <file_or_folder> [more...]")
        sys.exit(1)

    output_pdf = Path(sys.argv[1]).resolve()
    range_str = sys.argv[2]
    inputs = sys.argv[3:]

    ensure_dir(output_pdf.parent)

    pdfs = collect_pdfs(inputs)

    if not pdfs:
        print("ERROR: No PDF files found.")
        sys.exit(1)

    try:
        merge_pdfs(pdfs, output_pdf, range_str)

    except Exception as e:
        print(f"ERROR: {e}")
        sys.exit(1)

    print("OK")
    print(f"Joined PDFs: {len(pdfs)}")
    print(f"OUTPUT: {output_pdf}")


if __name__ == "__main__":
    main()
