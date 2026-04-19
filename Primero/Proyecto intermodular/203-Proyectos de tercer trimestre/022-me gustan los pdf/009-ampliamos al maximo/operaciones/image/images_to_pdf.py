#!/usr/bin/env python3

import os
import sys
from pathlib import Path

try:
    from PIL import Image
except ImportError:
    print("ERROR: Pillow is not installed. Install it with: sudo apt install python3-pil")
    sys.exit(1)


VALID_EXTENSIONS = {".jpg", ".jpeg", ".png", ".webp", ".bmp", ".tiff", ".tif"}
A4_PORTRAIT = (2480, 3508)   # A4 at 300 dpi
A4_LANDSCAPE = (3508, 2480)


def ensure_dir(path):
    Path(path).mkdir(parents=True, exist_ok=True)


def collect_input_images(paths):
    images = []

    for item in paths:
        p = Path(item)

        if p.is_file() and p.suffix.lower() in VALID_EXTENSIONS:
            images.append(str(p.resolve()))

        elif p.is_dir():
            for child in sorted(p.iterdir()):
                if child.is_file() and child.suffix.lower() in VALID_EXTENSIONS:
                    images.append(str(child.resolve()))

    return images


def parse_bool(value, default=False):
    if value is None:
        return default
    return str(value).strip().lower() in {"1", "true", "yes", "on", "si", "sí"}


def normalize_for_pdf(img):
    """
    PDF via Pillow works best with RGB or L images.
    Any alpha channel is flattened over white.
    """
    if img.mode == "RGB":
        return img

    if img.mode == "L":
        return img.convert("RGB")

    if img.mode in ("RGBA", "LA"):
        background = Image.new("RGB", img.size, (255, 255, 255))
        alpha = img.split()[-1]
        background.paste(img.convert("RGBA"), mask=alpha)
        return background

    if img.mode == "P":
        return normalize_for_pdf(img.convert("RGBA"))

    return img.convert("RGB")


def fit_image_to_box(img, box_size):
    """
    Resize image proportionally so it fits inside box_size.
    Adds white margins if needed.
    """
    box_w, box_h = box_size
    img_w, img_h = img.size

    scale = min(box_w / img_w, box_h / img_h)
    new_w = max(1, int(round(img_w * scale)))
    new_h = max(1, int(round(img_h * scale)))

    resized = img.resize((new_w, new_h), Image.LANCZOS)

    canvas = Image.new("RGB", (box_w, box_h), (255, 255, 255))
    offset_x = (box_w - new_w) // 2
    offset_y = (box_h - new_h) // 2
    canvas.paste(resized, (offset_x, offset_y))

    return canvas


def prepare_page(img, page_mode="original", auto_rotate=False):
    """
    page_mode:
    - original   -> keep each image page at its own size
    - a4         -> fit into A4 portrait
    - a4_auto    -> fit into A4 portrait/landscape depending on image orientation
    """
    img = normalize_for_pdf(img)

    if page_mode == "original":
        return img

    if page_mode == "a4":
        page = A4_PORTRAIT
        return fit_image_to_box(img, page)

    if page_mode == "a4_auto":
        w, h = img.size
        if auto_rotate:
            if w > h:
                page = A4_LANDSCAPE
            else:
                page = A4_PORTRAIT
        else:
            page = A4_PORTRAIT
        return fit_image_to_box(img, page)

    return img


def main():
    """
    Usage examples:

    python3 images_to_pdf.py output.pdf original 0 image1.jpg image2.png
    python3 images_to_pdf.py output.pdf a4 0 ./uploads
    python3 images_to_pdf.py output.pdf a4_auto 1 ./uploads

    Parameters:
    1. output_pdf
    2. page_mode     -> original | a4 | a4_auto
    3. auto_rotate   -> 1 | 0
    4+. input files or folders
    """

    if len(sys.argv) < 5:
        print("Usage:")
        print("  python3 images_to_pdf.py <output_pdf> <page_mode:original|a4|a4_auto> <auto_rotate:1|0> <file_or_folder> [more_files_or_folders...]")
        sys.exit(1)

    output_pdf = sys.argv[1]
    page_mode = sys.argv[2].strip().lower()
    auto_rotate = parse_bool(sys.argv[3], default=False)
    input_items = sys.argv[4:]

    if page_mode not in {"original", "a4", "a4_auto"}:
        print("ERROR: page_mode must be one of: original, a4, a4_auto")
        sys.exit(1)

    images = collect_input_images(input_items)

    if not images:
        print("ERROR: No valid input images found.")
        sys.exit(1)

    ensure_dir(Path(output_pdf).parent)

    prepared_pages = []
    opened_images = []

    try:
        for image_path in images:
            img = Image.open(image_path)
            opened_images.append(img)

            page = prepare_page(img, page_mode=page_mode, auto_rotate=auto_rotate)
            prepared_pages.append(page)

        if not prepared_pages:
            print("ERROR: No pages could be prepared.")
            sys.exit(1)

        first_page = prepared_pages[0]
        remaining_pages = prepared_pages[1:]

        first_page.save(
            output_pdf,
            "PDF",
            resolution=300.0,
            save_all=True,
            append_images=remaining_pages
        )

        print("OK")
        print(f"Images processed: {len(prepared_pages)}")
        print(f"PDF: {output_pdf}")

    except Exception as e:
        print(f"ERROR: {e}")
        sys.exit(1)

    finally:
        for img in opened_images:
            try:
                img.close()
            except Exception:
                pass


if __name__ == "__main__":
    main()
