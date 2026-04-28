#!/usr/bin/env python3
import json
import os
import sys

try:
    from pypdf import PdfWriter, PdfReader
except Exception as e:
    print(json.dumps({"ok": False, "error": f"No se pudo importar pypdf: {e}"}))
    sys.exit(1)


def main():
    if len(sys.argv) < 2:
        print(json.dumps({"ok": False, "error": "Uso: join_pdf.py manifest.json"}))
        return

    manifest_path = sys.argv[1]

    try:
        with open(manifest_path, "r", encoding="utf-8") as f:
            manifest = json.load(f)
    except Exception as e:
        print(json.dumps({"ok": False, "error": f"No se pudo leer el manifiesto: {e}"}))
        return

    files = manifest.get("files", [])
    output_dir = manifest.get("output_dir", "")

    if len(files) < 1:
        print(json.dumps({"ok": False, "error": "No hay PDFs para unir"}))
        return

    os.makedirs(output_dir, exist_ok=True)

    try:
        writer = PdfWriter()

        for pdf_path in files:
            reader = PdfReader(pdf_path)
            for page in reader.pages:
                writer.add_page(page)

        result_path = os.path.join(output_dir, "pdf_unido.pdf")
        with open(result_path, "wb") as f:
            writer.write(f)

        print(json.dumps({
            "ok": True,
            "result": result_path,
            "result_type": "file"
        }))
    except Exception as e:
        print(json.dumps({"ok": False, "error": str(e)}))


if __name__ == "__main__":
    main()
