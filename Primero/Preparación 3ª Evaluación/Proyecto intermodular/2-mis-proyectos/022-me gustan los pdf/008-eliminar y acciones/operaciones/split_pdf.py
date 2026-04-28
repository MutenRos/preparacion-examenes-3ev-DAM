#!/usr/bin/env python3
import json
import os
import sys
import zipfile

try:
    from pypdf import PdfReader, PdfWriter
except Exception as e:
    print(json.dumps({
        "ok": False,
        "error": f"No se pudo importar pypdf: {e}"
    }))
    sys.exit(1)


def main():
    if len(sys.argv) < 2:
        print(json.dumps({
            "ok": False,
            "error": "Uso: split_pdf.py manifest.json"
        }))
        return

    manifest_path = sys.argv[1]

    try:
        with open(manifest_path, "r", encoding="utf-8") as f:
            manifest = json.load(f)
    except Exception as e:
        print(json.dumps({
            "ok": False,
            "error": f"No se pudo leer el manifiesto: {e}"
        }))
        return

    files = manifest.get("files", [])
    output_dir = manifest.get("output_dir", "")

    if len(files) != 1:
        print(json.dumps({
            "ok": False,
            "error": "Debe recibirse exactamente un PDF"
        }))
        return

    input_pdf = files[0]

    if not os.path.isfile(input_pdf):
        print(json.dumps({
            "ok": False,
            "error": "El archivo PDF de entrada no existe"
        }))
        return

    os.makedirs(output_dir, exist_ok=True)
    pages_dir = os.path.join(output_dir, "pages")
    os.makedirs(pages_dir, exist_ok=True)

    try:
        reader = PdfReader(input_pdf)
        total_pages = len(reader.pages)

        if total_pages == 0:
            print(json.dumps({
                "ok": False,
                "error": "El PDF no contiene páginas"
            }))
            return

        created_files = []
        base_name = os.path.splitext(os.path.basename(input_pdf))[0]

        for i, page in enumerate(reader.pages, start=1):
            writer = PdfWriter()
            writer.add_page(page)

            out_name = f"{base_name}_pagina_{i:03d}.pdf"
            out_path = os.path.join(pages_dir, out_name)

            with open(out_path, "wb") as f:
                writer.write(f)

            created_files.append(out_path)

        zip_path = os.path.join(output_dir, f"{base_name}_paginas.zip")

        with zipfile.ZipFile(zip_path, "w", zipfile.ZIP_DEFLATED) as zf:
            for file_path in created_files:
                zf.write(file_path, arcname=os.path.basename(file_path))

        print(json.dumps({
            "ok": True,
            "result": zip_path,
            "result_type": "zip"
        }))

    except Exception as e:
        print(json.dumps({
            "ok": False,
            "error": str(e)
        }))


if __name__ == "__main__":
    main()
