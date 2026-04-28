#!/usr/bin/env python3

import sys
import json
import csv
from pathlib import Path


def ensure_dir(path: Path):
    path.mkdir(parents=True, exist_ok=True)


def collect_json(inputs):
    files = []
    for item in inputs:
        p = Path(item)
        if p.is_file() and p.suffix.lower() == ".json":
            files.append(p.resolve())
        elif p.is_dir():
            for child in sorted(p.iterdir()):
                if child.is_file() and child.suffix.lower() == ".json":
                    files.append(child.resolve())
    return files


def json_to_csv(input_path: Path, output_path: Path):
    with open(input_path, "r", encoding="utf-8") as f:
        data = json.load(f)

    if not isinstance(data, list):
        raise Exception("JSON must be an array of objects")

    if not data:
        raise Exception("JSON array is empty")

    # Collect all keys
    keys = set()
    for item in data:
        if isinstance(item, dict):
            keys.update(item.keys())

    keys = sorted(keys)

    with open(output_path, "w", encoding="utf-8", newline="") as f:
        writer = csv.DictWriter(f, fieldnames=keys)
        writer.writeheader()

        for row in data:
            if isinstance(row, dict):
                writer.writerow(row)


def main():
    """
    Usage:
        python3 json_to_csv.py <output_dir> <file_or_folder> [more...]

    Example:
        python3 json_to_csv.py ./out data.json
        python3 json_to_csv.py ./out ./jsons
    """

    if len(sys.argv) < 3:
        print("Usage:")
        print("  python3 json_to_csv.py <output_dir> <file_or_folder> [more...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    inputs = sys.argv[2:]

    ensure_dir(output_dir)

    files = collect_json(inputs)

    if not files:
        print("ERROR: No JSON files found.")
        sys.exit(1)

    processed = 0
    errors = []

    for idx, f in enumerate(files, start=1):
        try:
            out_file = output_dir / f"{idx:03d}_{f.stem}.csv"
            json_to_csv(f, out_file)
            processed += 1
        except Exception as e:
            errors.append(f"{f}: {e}")

    report = output_dir / "report.txt"
    with open(report, "w", encoding="utf-8") as r:
        r.write("JSON TO CSV REPORT\n")
        r.write("==================\n\n")
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
