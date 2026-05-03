#!/usr/bin/env python3

import sys
from pathlib import Path

try:
    from PIL import Image
except ImportError:
    print("ERROR: Pillow is not installed. Install it with: sudo apt install python3-pil")
    sys.exit(1)

VALID_EXTENSIONS = {".jpg", ".jpeg"}


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


def convert_jpg_to_png(input_path: Path, output_path: Path) -> None:
    with Image.open(input_path) as img:
        # Preserve transparency only if source somehow exposes alpha after conversion path.
        # Standard JPEG does not have alpha, but this keeps the function robust.
        if img.mode not in ("RGB", "RGBA", "L", "LA"):
            img = img.convert("RGB")

        if img.mode in ("L", "LA"):
            img = img.convert("RGBA" if "A" in img.mode else "RGB")
        elif img.mode == "RGB":
            pass
        elif img.mode == "RGBA":
            pass
        else:
            img = img.convert("RGB")

        img.save(output_path, format="PNG", optimize=True)


def main():
    """
    Usage:
        python3 jpg_to_png.py <output_dir> <file_or_folder> [more_files_or_folders...]

    Example:
        python3 jpg_to_png.py ./salida ./uploads
        python3 jpg_to_png.py ./salida foto1.jpg foto2.jpeg
    """

    if len(sys.argv) < 3:
        print("Usage:")
        print("  python3 jpg_to_png.py <output_dir> <file_or_folder> [more_files_or_folders...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    input_items = sys.argv[2:]

    ensure_dir(output_dir)

    images = collect_input_images(input_items)

    if not images:
        print("ERROR: No valid JPG/JPEG input images found.")
        sys.exit(1)

    processed = 0
    errors = []

    for index, image_path in enumerate(images, start=1):
        try:
            output_name = f"{index:03d}_{image_path.stem}.png"
            output_path = output_dir / output_name
            convert_jpg_to_png(image_path, output_path)
            processed += 1
        except Exception as e:
            errors.append(f"{image_path}: {e}")

    report_path = output_dir / "report.txt"
    with open(report_path, "w", encoding="utf-8") as f:
        f.write("JPG TO PNG REPORT\n")
        f.write("=================\n\n")
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
