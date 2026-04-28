#!/usr/bin/env python3

import sys
from pathlib import Path

try:
    import html2text
except ImportError:
    print("ERROR: html2text is not installed. Install it with: pip install html2text")
    sys.exit(1)


def ensure_dir(path: Path):
    path.mkdir(parents=True, exist_ok=True)


def collect_html(inputs):
    files = []
    for item in inputs:
        p = Path(item)
        if p.is_file() and p.suffix.lower() in {".html", ".htm"}:
            files.append(p.resolve())
        elif p.is_dir():
            for child in sorted(p.iterdir()):
                if child.is_file() and child.suffix.lower() in {".html", ".htm"}:
                    files.append(child.resolve())
    return files


def html_to_md(input_path: Path, output_path: Path):
    with open(input_path, "r", encoding="utf-8", errors="ignore") as f:
        html = f.read()

    converter = html2text.HTML2Text()
    converter.ignore_links = False
    converter.ignore_images = False

    markdown = converter.handle(html)

    with open(output_path, "w", encoding="utf-8") as out:
        out.write(markdown)


def main():
    """
    Usage:
        python3 html_to_md.py <output_dir> <file_or_folder> [more...]

    Requires:
        pip install html2text
    """

    if len(sys.argv) < 3:
        print("Usage:")
        print("  python3 html_to_md.py <output_dir> <file_or_folder> [more...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    inputs = sys.argv[2:]

    ensure_dir(output_dir)

    files = collect_html(inputs)

    if not files:
        print("ERROR: No HTML files found.")
        sys.exit(1)

    processed = 0
    errors = []

    for idx, f in enumerate(files, start=1):
        try:
            out_file = output_dir / f"{idx:03d}_{f.stem}.md"
            html_to_md(f, out_file)
            processed += 1
        except Exception as e:
            errors.append(f"{f}: {e}")

    report = output_dir / "report.txt"
    with open(report, "w", encoding="utf-8") as r:
        r.write("HTML TO MD REPORT\n")
        r.write("=================\n\n")
        r.write(f"Processed: {processed}\n")
        r.write(f"Errors: {len(errors)}\n\n")

        if errors:
            r.write("ERRORS\n------\n")
            for e in errors:
                r.write(e + "\n")

    if processed == 0:
        print("ERROR: No files converted.")
        print(f"REPORT: {report}")
        sys.exit(1)

    print("OK")
    print(f"Processed: {processed}")
    print(f"Errors: {len(errors)}")
    print(f"OUTPUT_DIR: {output_dir}")
    print(f"REPORT: {report}")


if __name__ == "__main__":
    main()
