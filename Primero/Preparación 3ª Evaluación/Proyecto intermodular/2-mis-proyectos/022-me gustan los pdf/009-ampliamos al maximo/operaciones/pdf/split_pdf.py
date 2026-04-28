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


def split_by_page(input_pdf: Path, output_dir: Path):
    reader = PdfReader(str(input_pdf))
    total = len(reader.pages)
    outputs = []

    for i in range(total):
        writer = PdfWriter()
        writer.add_page(reader.pages[i])

        out_file = output_dir / f"{input_pdf.stem}_p{i+1:03d}.pdf"
        with open(out_file, "wb") as f:
            writer.write(f)

        outputs.append(out_file)

    return outputs


def split_by_ranges(input_pdf: Path, output_dir: Path, ranges_str: str):
    """
    ranges_str examples:
        "1-3,4-6"
        "1-2,5,7-9"
    """
    reader = PdfReader(str(input_pdf))
    total_pages = len(reader.pages)

    outputs = []
    parts = ranges_str.split(",")

    for idx, part in enumerate(parts, start=1):
        part = part.strip()

        if "-" in part:
            start, end = part.split("-")
            start = int(start)
            end = int(end)
        else:
            start = int(part)
            end = int(part)

        writer = PdfWriter()

        for p in range(start, end + 1):
            if 1 <= p <= total_pages:
                writer.add_page(reader.pages[p - 1])

        out_file = output_dir / f"{input_pdf.stem}_part{idx:03d}.pdf"
        with open(out_file, "wb") as f:
            writer.write(f)

        outputs.append(out_file)

    return outputs


def main():
    """
    Usage:
        python3 split_pdf.py <output_dir> <mode> <file_or_folder> [ranges]

    Modes:
        pages   -> split into single pages
        ranges  -> split using ranges string

    Examples:
        python3 split_pdf.py ./out pages file.pdf
        python3 split_pdf.py ./out ranges file.pdf "1-3,5"
    """

    if len(sys.argv) < 4:
        print("Usage:")
        print("  python3 split_pdf.py <output_dir> <mode> <file_or_folder> [ranges]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    mode = sys.argv[2].lower()
    inputs = sys.argv[3:-1] if mode == "ranges" else sys.argv[3:]
    ranges_str = sys.argv[-1] if mode == "ranges" else None

    ensure_dir(output_dir)

    pdfs = collect_pdfs(inputs)

    if not pdfs:
        print("ERROR: No PDF files found.")
        sys.exit(1)

    if mode not in {"pages", "ranges"}:
        print("ERROR: mode must be 'pages' or 'ranges'")
        sys.exit(1)

    processed = 0
    total_outputs = 0
    errors = []

    for pdf in pdfs:
        try:
            if mode == "pages":
                outs = split_by_page(pdf, output_dir)
            else:
                outs = split_by_ranges(pdf, output_dir, ranges_str)

            processed += 1
            total_outputs += len(outs)

        except Exception as e:
            errors.append(f"{pdf}: {e}")

    report = output_dir / "report.txt"
    with open(report, "w", encoding="utf-8") as r:
        r.write("SPLIT PDF REPORT\n")
        r.write("================\n\n")
        r.write(f"Mode: {mode}\n")
        if mode == "ranges":
            r.write(f"Ranges: {ranges_str}\n")
        r.write(f"Processed PDFs: {processed}\n")
        r.write(f"Generated files: {total_outputs}\n")
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
    print(f"Generated files: {total_outputs}")
    print(f"Errors: {len(errors)}")
    print(f"OUTPUT_DIR: {output_dir}")
    print(f"REPORT: {report}")


if __name__ == "__main__":
    main()
