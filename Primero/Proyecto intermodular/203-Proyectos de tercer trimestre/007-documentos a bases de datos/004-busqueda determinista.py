import os
import re
import json
from collections import defaultdict

TXT_FOLDER = "txt"
OUT_FOLDER = "subjects_out"

# Acepta "Modulo profesional:" y "Módulo profesional:" (con tilde)
PATTERN = re.compile(r"^\s*M[oó]dulo\s+profesional\s*:\s*(.+?)\s*$", re.IGNORECASE)

def clean_subject(s: str) -> str:
    s = (s or "").strip()
    # quita espacios dobles y guiones raros finales
    s = re.sub(r"\s+", " ", s)
    s = s.strip(" -–—\t")
    return s

def main():
    if not os.path.isdir(TXT_FOLDER):
        raise SystemExit(f"No existe la carpeta '{TXT_FOLDER}'")

    os.makedirs(OUT_FOLDER, exist_ok=True)

    archivos = sorted([f for f in os.listdir(TXT_FOLDER) if f.lower().endswith(".txt")])
    if not archivos:
        raise SystemExit(f"No hay .txt en '{TXT_FOLDER}'")

    asignaturas = defaultdict(list)  # subject -> list of sources

    total_hits = 0
    for archivo in archivos:
        ruta = os.path.join(TXT_FOLDER, archivo)
        with open(ruta, "r", encoding="utf-8", errors="ignore") as f:
            for line_no, line in enumerate(f, start=1):
                m = PATTERN.match(line)
                if not m:
                    continue
                subject = clean_subject(m.group(1))
                if not subject:
                    continue

                asignaturas[subject].append({
                    "file": archivo,
                    "line": line_no,
                    "raw": line.rstrip("\n")
                })
                total_hits += 1

    subjects_sorted = sorted(asignaturas.keys(), key=lambda s: s.lower())

    # TXT output
    out_txt = os.path.join(OUT_FOLDER, "asignaturas.txt")
    with open(out_txt, "w", encoding="utf-8") as f:
        for s in subjects_sorted:
            f.write(s + "\n")

    # JSON output (con fuentes)
    out_json = os.path.join(OUT_FOLDER, "asignaturas.json")
    with open(out_json, "w", encoding="utf-8") as f:
        json.dump(
            [{"asignatura": s, "sources": asignaturas[s]} for s in subjects_sorted],
            f,
            ensure_ascii=False,
            indent=2
        )

    print(f"Archivos procesados: {len(archivos)}")
    print(f"Coincidencias encontradas: {total_hits}")
    print(f"Asignaturas únicas: {len(subjects_sorted)}")
    print(f"OK -> {out_txt}")
    print(f"OK -> {out_json}")

if __name__ == "__main__":
    main()
