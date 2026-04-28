#!/usr/bin/env python3

import sys
from pathlib import Path

try:
    from PIL import Image
except ImportError:
    print("ERROR: Pillow is not installed. Install it with: sudo apt install python3-pil")
    sys.exit(1)

VALID_EXTENSIONS = {".png"}


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


def convert_png_to_jpg(input_path: Path, output_path: Path, quality: int = 95, background=(255, 255, 255)) -> None:
    with Image.open(input_path) as img:
        # PNG may contain alpha. Flatten it over a solid background for JPG.
        if img.mode in ("RGBA", "LA"):
            base = Image.new("RGB", img.size, background)
            alpha = img.getchannel("A") if "A" in img.getbands() else None
            base.paste(img.convert("RGBA"), mask=alpha)
            img = base
        elif img.mode == "P":
            img = img.convert("RGBA")
            base = Image.new("RGB", img.size, background)
            alpha = img.getchannel("A") if "A" in img.getbands() else None
            base.paste(img, mask=alpha)
            img = base
        elif img.mode != "RGB":
            img = img.convert("RGB")

        img.save(output_path, format="JPEG", quality=quality, optimize=True)


def main():
    """
    Usage:
        python3 png_to_jpg.py <output_dir> <quality> <file_or_folder> [more_files_or_folders...]

    Example:
        python3 png_to_jpg.py ./salida 95 ./uploads
        python3 png_to_jpg.py ./salida 90 imagen1.png imagen2.png
    """

    if len(sys.argv) < 4:
        print("Usage:")
        print("  python3 png_to_jpg.py <output_dir> <quality> <file_or_folder> [more_files_or_folders...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()

    try:
        quality = int(sys.argv[2])
    except ValueError:
        print("ERROR: quality must be an integer.")
        sys.exit(1)

    if quality < 1 or quality > 100:
        print("ERROR: quality must be between 1 and 100.")
        sys.exit(1)

    input_items = sys.argv[3:]

    ensure_dir(output_dir)

    images = collect_input_images(input_items)

    if not images:
        print("ERROR: No valid PNG input images found.")
        sys.exit(1)

    processed = 0
    errors = []

    for index, image_path in enumerate(images, start=1):
        try:
            output_name = f"{index:03d}_{image_path.stem}.jpg"
            output_path = output_dir / output_name
            convert_png_to_jpg(image_path, output_path, quality=quality)
            processed += 1
        except Exception as e:
            errors.append(f"{image_path}: {e}")

    report_path = output_dir / "report.txt"
    with open(report_path, "w", encoding="utf-8") as f:
        f.write("PNG TO JPG REPORT\n")
        f.write("=================\n\n")
        f.write(f"Quality: {quality}\n")
        f.write(f"Processed: {processed}\n")
        f.write(f"Errors: {len(errors)}\n\n")

        if processed:
            f.write("Generated JPG files in output directory.\n\n")

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
