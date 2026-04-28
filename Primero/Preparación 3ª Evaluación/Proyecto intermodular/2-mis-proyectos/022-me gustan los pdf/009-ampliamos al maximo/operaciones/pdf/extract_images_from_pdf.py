#!/usr/bin/env python3

import sys
import os
from pathlib import Path

try:
    from pypdf import PdfReader
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


def save_image(data, output_path: Path):
    with open(output_path, "wb") as f:
        f.write(data)


def extract_images(pdf_path: Path, output_dir: Path):
    reader = PdfReader(str(pdf_path))
    count = 0

    for page_index, page in enumerate(reader.pages):
        if "/XObject" in page["/Resources"]:
            x_objects = page["/Resources"]["/XObject"].get_object()

            for obj_name in x_objects:
                obj = x_objects[obj_name]

                if obj["/Subtype"] == "/Image":
                    data = obj.get_data()

                    # detect format
                    if obj["/Filter"] == "/DCTDecode":
                        ext = ".jpg"
                    elif obj["/Filter"] == "/JPXDecode":
                        ext = ".jp2"
                    elif obj["/Filter"] == "/FlateDecode":
                        ext = ".png"
                    else:
                        ext = ".bin"

                    count += 1
                    filename = f"{pdf_path.stem}_p{page_index+1}_{count:03d}{ext}"
                    output_path = output_dir / filename

                    save_image(data, output_path)

    return count


def main():
    """
    Usage:
        python3 extract_images_from_pdf.py <output_dir> <file_or_folder> [more...]

    Requires:
        pypdf
    """

    if len(sys.argv) < 3:
        print("Usage:")
        print("  python3 extract_images_from_pdf.py <output_dir> <file_or_folder> [more...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    inputs = sys.argv[2:]

    ensure_dir(output_dir)

    pdfs = collect_pdfs(inputs)

    if not pdfs:
        print("ERROR: No PDF files found.")
        sys.exit(1)

    total_images = 0
    errors = []

    for pdf in pdfs:
        try:
            count = extract_images(pdf, output_dir)
            total_images += count
        except Exception as e:
            errors.append(f"{pdf}: {e}")

    report = output_dir / "report.txt"
    with open(report, "w", encoding="utf-8") as r:
        r.write("EXTRACT IMAGES FROM PDF REPORT\n")
        r.write("==============================\n\n")
        r.write(f"Total images extracted: {total_images}\n")
        r.write(f"Errors: {len(errors)}\n\n")

        if errors:
            r.write("ERRORS\n------\n")
            for e in errors:
                r.write(e + "\n")

    if total_images == 0:
        print("WARNING: No images extracted.")
    else:
        print("OK")
        print(f"Images extracted: {total_images}")

    print(f"OUTPUT_DIR: {output_dir}")
    print(f"REPORT: {report}")


if __name__ == "__main__":
    main()
