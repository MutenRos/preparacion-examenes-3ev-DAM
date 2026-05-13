#!/usr/bin/env python3

import sys
from pathlib import Path

# Try multiple backends
USE_PDF2IMAGE = False
USE_FITZ = False

try:
    from pdf2image import convert_from_path
    USE_PDF2IMAGE = True
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


def parse_int(v, default):
    try:
        return int(v)
    except Exception:
        return default


def convert_with_pdf2image(pdf_path: Path, output_dir: Path, dpi=200):
    images = convert_from_path(str(pdf_path), dpi=dpi)
    count = 0
    for i, img in enumerate(images, start=1):
        out = output_dir / f"{pdf_path.stem}_p{i:03d}.png"
        img.save(out, "PNG", optimize=True)
        count += 1
    return count


def convert_with_fitz(pdf_path: Path, output_dir: Path, zoom=2.0):
    doc = fitz.open(str(pdf_path))
    count = 0

    mat = fitz.Matrix(zoom, zoom)

    for i, page in enumerate(doc, start=1):
        pix = page.get_pixmap(matrix=mat)
        out = output_dir / f"{pdf_path.stem}_p{i:03d}.png"
        pix.save(str(out))
        count += 1

    doc.close()
    return count


def main():
    """
    Usage:
        python3 pdf_to_png.py <output_dir> <dpi> <file_or_folder> [more...]

    Examples:
        python3 pdf_to_png.py ./out 200 file.pdf
        python3 pdf_to_png.py ./out 300 ./pdfs
    """

    if len(sys.argv) < 4:
        print("Usage:")
        print("  python3 pdf_to_png.py <output_dir> <dpi> <file_or_folder> [more...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    dpi = parse_int(sys.argv[2], 200)
    inputs = sys.argv[3:]

    ensure_dir(output_dir)

    pdfs = collect_pdfs(inputs)

    if not pdfs:
        print("ERROR: No PDF files found.")
        sys.exit(1)

    if not USE_PDF2IMAGE and not USE_FITZ:
        print("ERROR: No backend available.")
        print("Install one of:")
        print("  sudo apt install poppler-utils python3-pdf2image")
        print("  sudo apt install python3-pymupdf")
        sys.exit(1)

    total = 0
    errors = []

    for pdf in pdfs:
        try:
            if USE_PDF2IMAGE:
                total += convert_with_pdf2image(pdf, output_dir, dpi=dpi)
            else:
                total += convert_with_fitz(pdf, output_dir, zoom=dpi/100.0)
        except Exception as e:
            errors.append(f"{pdf}: {e}")

    report = output_dir / "report.txt"
    with open(report, "w", encoding="utf-8") as r:
        r.write("PDF TO PNG REPORT\n")
        r.write("=================\n\n")
        r.write(f"DPI: {dpi}\n")
        r.write(f"Total images: {total}\n")
        r.write(f"Errors: {len(errors)}\n\n")

        if errors:
            r.write("ERRORS\n------\n")
            for e in errors:
                r.write(e + "\n")

    if total == 0:
        print("ERROR: No pages converted.")
        print(f"REPORT: {report}")
        sys.exit(1)

    print("OK")
    print(f"Images generated: {total}")
    print(f"Errors: {len(errors)}")
    print(f"OUTPUT_DIR: {output_dir}")
    print(f"REPORT: {report}")


if __name__ == "__main__":
    main()
