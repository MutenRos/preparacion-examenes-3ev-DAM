#!/usr/bin/env python3

import sys
from pathlib import Path

try:
    from PIL import Image
except ImportError:
    print("ERROR: Pillow is not installed. Install it with: sudo apt install python3-pil")
    sys.exit(1)

VALID_EXTENSIONS = {".webp"}


def ensure_dir(path: Path) -> None:
    path.mkdir(parents=True, exist_ok=True)


def collect_input_images(items):
    images = []

    for item in items:
        p = Path(item)

        if p.is_file() and p.suffix.lower() in VALID_EXTENSIONS:
            images.append(p.resolve())

        elif p.is_dir():
            for child in sorted(p.iterdir()):
                if child.is_file() and child.suffix.lower() in VALID_EXTENSIONS:
                    images.append(child.resolve())

    return images


def convert_webp_to_png(input_path: Path, output_path: Path) -> None:
    with Image.open(input_path) as img:
        # Preserve alpha if present
        if img.mode not in ("RGB", "RGBA", "L", "LA", "P"):
            img = img.convert("RGBA")

        if img.mode == "P":
            img = img.convert("RGBA")

        # PNG supports transparency, so we keep RGBA if exists
        if img.mode in ("LA",):
            img = img.convert("RGBA")

        img.save(output_path, format="PNG", optimize=True)


def main():
    """
    Usage:
        python3 webp_to_png.py <output_dir> <file_or_folder> [more_files_or_folders...]

    Example:
        python3 webp_to_png.py ./salida ./uploads
        python3 webp_to_png.py ./salida imagen1.webp imagen2.webp
    """

    if len(sys.argv) < 3:
        print("Usage:")
        print("  python3 webp_to_png.py <output_dir> <file_or_folder> [more_files_or_folders...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    input_items = sys.argv[2:]

    ensure_dir(output_dir)

    images = collect_input_images(input_items)

    if not images:
        print("ERROR: No valid WEBP input images found.")
        sys.exit(1)

    processed = 0
    errors = []

    for index, image_path in enumerate(images, start=1):
        try:
            output_name = f"{index:03d}_{image_path.stem}.png"
            output_path = output_dir / output_name
            convert_webp_to_png(image_path, output_path)
            processed += 1
        except Exception as e:
            errors.append(f"{image_path}: {e}")

    report_path = output_dir / "report.txt"
    with open(report_path, "w", encoding="utf-8") as f:
        f.write("WEBP TO PNG REPORT\n")
        f.write("==================\n\n")
        f.write(f"Processed: {processed}\n")
        f.write(f"Errors: {len(errors)}\n\n")

        if processed:
            f.write("Generated PNG files in output directory.\n\n")

        if errors:
            f.write("ERRORS\n")
            f.write("------\n")
            for err in errors:
                f.write(err + "\n")

    if errors and processed == 0:
        print("ERROR: Conversion failed for all files.")
        print(f"REPORT: {report_path}")
        sys.exit(1)

    print("OK")
    print(f"Processed images: {processed}")
    print(f"Errors: {len(errors)}")
    print(f"OUTPUT_DIR: {output_dir}")
    print(f"REPORT: {report_path}")


if __name__ == "__main__":
    main()
