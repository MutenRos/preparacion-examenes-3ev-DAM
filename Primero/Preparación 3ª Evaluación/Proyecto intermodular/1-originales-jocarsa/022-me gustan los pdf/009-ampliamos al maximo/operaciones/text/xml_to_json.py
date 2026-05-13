#!/usr/bin/env python3

import sys
import json
from pathlib import Path
import xml.etree.ElementTree as ET


def ensure_dir(path: Path):
    path.mkdir(parents=True, exist_ok=True)


def collect_xml(inputs):
    files = []
    for item in inputs:
        p = Path(item)
        if p.is_file() and p.suffix.lower() == ".xml":
            files.append(p.resolve())
        elif p.is_dir():
            for child in sorted(p.iterdir()):
                if child.is_file() and child.suffix.lower() == ".xml":
                    files.append(child.resolve())
    return files


def element_to_dict(elem):
    children = list(elem)

    if not children:
        text = elem.text.strip() if elem.text else ""
        if elem.attrib:
            data = {"@attributes": dict(elem.attrib)}
            if text:
                data["#text"] = text
            return data
        return text

    data = {}

    if elem.attrib:
        data["@attributes"] = dict(elem.attrib)

    grouped = {}
    for child in children:
        child_value = element_to_dict(child)
        if child.tag in grouped:
            if not isinstance(grouped[child.tag], list):
                grouped[child.tag] = [grouped[child.tag]]
            grouped[child.tag].append(child_value)
        else:
            grouped[child.tag] = child_value

    data.update(grouped)

    text = elem.text.strip() if elem.text else ""
    if text:
        data["#text"] = text

    return data


def xml_to_json(input_path: Path, output_path: Path):
    tree = ET.parse(input_path)
    root = tree.getroot()

    data = {
        root.tag: element_to_dict(root)
    }

    with open(output_path, "w", encoding="utf-8") as out:
        json.dump(data, out, indent=2, ensure_ascii=False)


def main():
    """
    Usage:
        python3 xml_to_json.py <output_dir> <file_or_folder> [more...]

    Example:
        python3 xml_to_json.py ./out data.xml
        python3 xml_to_json.py ./out ./xmls
    """

    if len(sys.argv) < 3:
        print("Usage:")
        print("  python3 xml_to_json.py <output_dir> <file_or_folder> [more...]")
        sys.exit(1)

    output_dir = Path(sys.argv[1]).resolve()
    inputs = sys.argv[2:]

    ensure_dir(output_dir)

    files = collect_xml(inputs)

    if not files:
        print("ERROR: No XML files found.")
        sys.exit(1)

    processed = 0
    errors = []

    for idx, f in enumerate(files, start=1):
        try:
            out_file = output_dir / f"{idx:03d}_{f.stem}.json"
            xml_to_json(f, out_file)
            processed += 1
        except Exception as e:
            errors.append(f"{f}: {e}")

    report = output_dir / "report.txt"
    with open(report, "w", encoding="utf-8") as r:
        r.write("XML TO JSON REPORT\n")
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
