#!/usr/bin/env python3

import os
import sys
import zipfile
import shutil
from pathlib import Path

try:
    from PIL import Image
except ImportError:
    print("ERROR: Pillow is not installed. Install it with: sudo apt install python3-pil")
    sys.exit(1)


VALID_EXTENSIONS = {".jpg", ".jpeg", ".png", ".webp", ".bmp", ".tiff", ".tif"}


def safe_int(value, default=None):
    try:
        return int(value)
    except (TypeError, ValueError):
        return default


def parse_bool(value, default=False):
    if value is None:
        return default
    return str(value).strip().lower() in {"1", "true", "yes", "on", "si", "sí"}


def ensure_dir(path):
    Path(path).mkdir(parents=True, exist_ok=True)


def clean_dir(path):
    if os.path.isdir(path):
        shutil.rmtree(path)
    os.makedirs(path, exist_ok=True)


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


def calculate_new_size(original_width, original_height, target_width, target_height, keep_ratio, no_enlarge):
    ow = original_width
    oh = original_height

    if target_width is None and target_height is None:
        return ow, oh

    if keep_ratio:
        if target_width is not None and target_height is not None:
            scale_w = target_width / ow
            scale_h = target_height / oh
            scale = min(scale_w, scale_h)
        elif target_width is not None:
            scale = target_width / ow
        else:
            scale = target_height / oh

        if no_enlarge:
            scale = min(scale, 1.0)

        nw = max(1, int(round(ow * scale)))
        nh = max(1, int(round(oh * scale)))
        return nw, nh

    nw = target_width if target_width is not None else ow
    nh = target_height if target_height is not None else oh

    if no_enlarge:
        nw = min(nw, ow)
        nh = min(nh, oh)

    return max(1, int(nw)), max(1, int(nh))


def resize_image(input_path, output_path, target_width, target_height, keep_ratio=True, no_enlarge=False, quality=95):
    with Image.open(input_path) as img:
        original_mode = img.mode
        original_format = img.format

        ow, oh = img.size
        nw, nh = calculate_new_size(
            ow, oh,
            target_width,
            target_height,
            keep_ratio,
            no_enlarge
        )

        if (nw, nh) != (ow, oh):
            resized = img.resize((nw, nh), Image.LANCZOS)
        else:
            resized = img.copy()

        output_ext = Path(output_path).suffix.lower()

        save_kwargs = {}

        if output_ext in {".jpg", ".jpeg"}:
            if resized.mode in ("RGBA", "LA", "P"):
                background = Image.new("RGB", resized.size, (255, 255, 255))
                if resized.mode == "P":
                    resized = resized.convert("RGBA")
                background.paste(resized, mask=resized.split()[-1] if resized.mode in ("RGBA", "LA") else None)
                resized = background
            else:
                resized = resized.convert("RGB")

            save_kwargs["quality"] = quality
            save_kwargs["optimize"] = True

        elif output_ext == ".png":
            if resized.mode == "P":
                resized = resized.convert("RGBA")
            save_kwargs["optimize"] = True

        elif output_ext == ".webp":
            if resized.mode == "P":
                resized = resized.convert("RGBA")
            save_kwargs["quality"] = quality

        resized.save(output_path, **save_kwargs)

        return {
            "input": input_path,
            "output": output_path,
            "original_width": ow,
            "original_height": oh,
            "new_width": nw,
            "new_height": nh,
            "original_mode": original_mode,
            "original_format": original_format,
        }


def make_zip(folder_path, zip_path):
    with zipfile.ZipFile(zip_path, "w", zipfile.ZIP_DEFLATED) as zf:
        for root, _, files in os.walk(folder_path):
            for file in files:
                full_path = os.path.join(root, file)
                rel_path = os.path.relpath(full_path, folder_path)
                zf.write(full_path, rel_path)


def main():
    """
    Usage examples:

    python3 images_resize.py output_dir 800 600 1 0 image1.jpg image2.png
    python3 images_resize.py output_dir 1200 null 1 1 ./uploads
    python3 images_resize.py output_dir null 500 1 0 ./uploads/image.jpg

    Parameters:
    1. output_dir
    2. target_width      (integer or "null")
    3. target_height     (integer or "null")
    4. keep_ratio        (1/0)
    5. no_enlarge        (1/0)
    6+. input files or folders
    """

    if len(sys.argv) < 7:
        print("Usage:")
        print("  python3 images_resize.py <output_dir> <width|null> <height|null> <keep_ratio:1|0> <no_enlarge:1|0> <file_or_folder> [more_files_or_folders...]")
        sys.exit(1)

    output_dir = sys.argv[1]
    target_width = safe_int(None if sys.argv[2].lower() == "null" else sys.argv[2])
    target_height = safe_int(None if sys.argv[3].lower() == "null" else sys.argv[3])
    keep_ratio = parse_bool(sys.argv[4], default=True)
    no_enlarge = parse_bool(sys.argv[5], default=False)
    input_items = sys.argv[6:]

    if target_width is None and target_height is None:
        print("ERROR: You must specify at least width or height.")
        sys.exit(1)

    images = collect_input_images(input_items)

    if not images:
        print("ERROR: No valid input images found.")
        sys.exit(1)

    clean_dir(output_dir)

    results_dir = os.path.join(output_dir, "resized")
    ensure_dir(results_dir)

    results = []
    errors = []

    for idx, image_path in enumerate(images, start=1):
        try:
            src = Path(image_path)
            base_name = src.stem
            ext = src.suffix.lower()

            if ext not in VALID_EXTENSIONS:
                continue

            output_name = f"{idx:03d}_{base_name}{ext}"
            output_path = os.path.join(results_dir, output_name)

            info = resize_image(
                input_path=image_path,
                output_path=output_path,
                target_width=target_width,
                target_height=target_height,
                keep_ratio=keep_ratio,
                no_enlarge=no_enlarge,
                quality=95
            )
            results.append(info)

        except Exception as e:
            errors.append(f"{image_path}: {e}")

    report_path = os.path.join(output_dir, "report.txt")
    with open(report_path, "w", encoding="utf-8") as f:
        f.write("IMAGE RESIZE REPORT\n")
        f.write("===================\n\n")
        f.write(f"Width: {target_width}\n")
        f.write(f"Height: {target_height}\n")
        f.write(f"Keep ratio: {keep_ratio}\n")
        f.write(f"No enlarge: {no_enlarge}\n")
        f.write(f"Processed: {len(results)}\n")
        f.write(f"Errors: {len(errors)}\n\n")

        if results:
            f.write("SUCCESSFUL FILES\n")
            f.write("----------------\n")
            for item in results:
                f.write(
                    f"{os.path.basename(item['input'])} -> "
                    f"{os.path.basename(item['output'])} | "
                    f"{item['original_width']}x{item['original_height']} -> "
                    f"{item['new_width']}x{item['new_height']}\n"
                )
            f.write("\n")

        if errors:
            f.write("ERRORS\n")
            f.write("------\n")
            for err in errors:
                f.write(err + "\n")

    zip_path = os.path.join(output_dir, "images_resized.zip")
    make_zip(results_dir, zip_path)

    print("OK")
    print(f"Processed images: {len(results)}")
    print(f"Errors: {len(errors)}")
    print(f"ZIP: {zip_path}")
    print(f"REPORT: {report_path}")


if __name__ == "__main__":
    main()
