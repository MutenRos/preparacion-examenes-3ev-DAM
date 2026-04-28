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


def parse_angle(value):
    try:
        angle = int(value)
        if angle not in {90, 180, 270, -90, -180, -270}:
            raise ValueError
        return angle
    except Exception:
        print("ERROR: angle must be one of 90, 180, 270 (or negative equivalents)")
        sys.exit(1)


def rotate_pdf(input_pdf: Path, output_pdf: Path, angle: int):
    reader = PdfReader(str(input_pdf))
    writer = PdfWriter()

    for page in reader.pages:
        page.rotate(angle)
        writer.add_page(page)

    with open(output_pdf, "wb") as f:
        writer.write(f)


def main():
    """
    Usage:
        python3 rotate_pdf.py <output_dir> <angle> <file_or_folder> [more...]

    Examples:
        python3 rotate_pdf.py ./out 90 file.pdf
        python3 rotate_pdf.py ./out 180 ./pdfs
    """

    if len(sys.argv) < 4:
        print("Usage:")
        print("  python3 rotate_pdf.py <output_dir> <angle> <file_or_folder> [more...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    angle = parse_angle(sys.argv[2])
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
            output_file = output_dir / f"{idx:03d}_{pdf.stem}_rotated.pdf"
            rotate_pdf(pdf, output_file, angle)
            processed += 1
        except Exception as e:
            errors.append(f"{pdf}: {e}")

    report = output_dir / "report.txt"
    with open(report, "w", encoding="utf-8") as r:
        r.write("ROTATE PDF REPORT\n")
        r.write("=================\n\n")
        r.write(f"Angle: {angle}\n")
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
