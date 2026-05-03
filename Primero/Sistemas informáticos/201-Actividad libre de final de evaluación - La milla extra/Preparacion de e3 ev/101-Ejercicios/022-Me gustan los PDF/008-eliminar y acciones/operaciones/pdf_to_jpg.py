#!/usr/bin/env python3
import json
import os
import sys
import zipfile
import subprocess

def main():
    if len(sys.argv) < 2:
        print(json.dumps({"ok": False, "error": "Uso: pdf_to_jpg.py manifest.json"}))
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

    if len(files) != 1:
        print(json.dumps({"ok": False, "error": "Debe recibirse exactamente un PDF"}))
        return

    input_pdf = files[0]
    images_dir = os.path.join(output_dir, "jpg")
    os.makedirs(images_dir, exist_ok=True)

    base_name = os.path.splitext(os.path.basename(input_pdf))[0]
    prefix = os.path.join(images_dir, base_name)

    try:
        subprocess.run(
            ["pdftoppm", "-jpeg", input_pdf, prefix],
            check=True,
            stdout=subprocess.PIPE,
            stderr=subprocess.PIPE
        )

        created_files = []
        for name in sorted(os.listdir(images_dir)):
            if name.lower().endswith(".jpg"):
                created_files.append(os.path.join(images_dir, name))

        if not created_files:
            print(json.dumps({"ok": False, "error": "No se generaron imágenes JPG"}))
            return

        zip_path = os.path.join(output_dir, f"{base_name}_jpg.zip")
        with zipfile.ZipFile(zip_path, "w", zipfile.ZIP_DEFLATED) as zf:
            for file_path in created_files:
                zf.write(file_path, arcname=os.path.basename(file_path))

        print(json.dumps({
            "ok": True,
            "result": zip_path,
            "result_type": "zip"
        }))
    except subprocess.CalledProcessError as e:
        stderr = e.stderr.decode("utf-8", errors="replace") if e.stderr else str(e)
        print(json.dumps({"ok": False, "error": stderr}))
    except Exception as e:
        print(json.dumps({"ok": False, "error": str(e)}))


if __name__ == "__main__":
    main()
