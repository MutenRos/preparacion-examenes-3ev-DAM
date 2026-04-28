#!/usr/bin/env python3

import sys
import csv
import json
from pathlib import Path


def ensure_dir(path: Path):
    path.mkdir(parents=True, exist_ok=True)


def collect_csv(inputs):
    files = []
    for item in inputs:
        p = Path(item)
        if p.is_file() and p.suffix.lower() == ".csv":
            files.append(p.resolve())
        elif p.is_dir():
            for child in sorted(p.iterdir()):
                if child.is_file() and child.suffix.lower() == ".csv":
                    files.append(child.resolve())
    return files


def detect_dialect(sample):
    try:
        return csv.Sniffer().sniff(sample)
    except Exception:
        return csv.excel


def csv_to_json(input_path: Path, output_path: Path):
    with open(input_path, "r", encoding="utf-8", errors="ignore") as f:
        sample = f.read(2048)
        f.seek(0)

        dialect = detect_dialect(sample)
        reader = csv.DictReader(f, dialect=dialect)

        data = []
        for row in reader:
            clean_row = {k.strip(): (v.strip() if isinstance(v, str) else v) for k, v in row.items()}
            data.append(clean_row)

    with open(output_path, "w", encoding="utf-8") as out:
        json.dump(data, out, indent=2, ensure_ascii=False)


def main():
    """
    Usage:
        python3 csv_to_json.py <output_dir> <file_or_folder> [more...]

    Example:
        python3 csv_to_json.py ./out data.csv
        python3 csv_to_json.py ./out ./csvs
    """

    if len(sys.argv) < 3:
        print("Usage:")
        print("  python3 csv_to_json.py <output_dir> <file_or_folder> [more...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    inputs = sys.argv[2:]

    ensure_dir(output_dir)

    files = collect_csv(inputs)

    if not files:
        print("ERROR: No CSV files found.")
        sys.exit(1)

    processed = 0
    errors = []

    for idx, f in enumerate(files, start=1):
        try:
            out_file = output_dir / f"{idx:03d}_{f.stem}.json"
            csv_to_json(f, out_file)
            processed += 1
        except Exception as e:
            errors.append(f"{f}: {e}")

    report = output_dir / "report.txt"
    with open(report, "w", encoding="utf-8") as r:
        r.write("CSV TO JSON REPORT\n")
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
