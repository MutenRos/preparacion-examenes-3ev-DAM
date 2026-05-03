import os
import re
import json
from PyPDF2 import PdfReader

# ------------------ Folders ------------------
PDF_FOLDER = "pdf"
TXT_FOLDER = "txt"
OUT_FOLDER = "out"
OUT_JSON = os.path.join(OUT_FOLDER, "modules.json")

# ------------------ Regex base ------------------
RE_MODULO = re.compile(r"^\s*M[oó]dulo\s+Profesional\s*:\s*(.*)\s*$", re.IGNORECASE)
RE_ECTS = re.compile(r"^\s*Equivalencia\s+en\s+cr[eé]ditos\s+ECTS\s*:\s*(\d+)\s*\.\s*$", re.IGNORECASE)
RE_CODIGO = re.compile(r"^\s*C[oó]digo\s*:\s*([0-9]{3,5})\s*\.\s*$", re.IGNORECASE)

RE_RA_HEADER = re.compile(r"^\s*Resultados\s+de\s+aprendizaje\s+y\s+criterios\s+de\s+evaluaci[oó]n\s*\.\s*$", re.IGNORECASE)
RE_RA_ITEM = re.compile(r"^\s*(\d+)\.\s*(.+?)\s*$")         # "1. Reconoce..."
RE_CRITERIOS = re.compile(r"^\s*Criterios\s+de\s+evaluaci[oó]n\s*:\s*$", re.IGNORECASE)
RE_CRIT_ITEM = re.compile(r"^\s*([a-z])\)\s*(.+?)\s*$", re.IGNORECASE)

RE_DURACION = re.compile(r"^\s*Duraci[oó]n\s*:\s*(.+?)\s*$", re.IGNORECASE)
RE_CONTENIDOS = re.compile(r"^\s*Contenidos\s+b[aá]sicos\s*:\s*$", re.IGNORECASE)

# En BOE los bullets suelen ser "−" (U+2212) pero a veces "-" o "–"
RE_BULLET = re.compile(r"^\s*[−–-]\s*(.+?)\s*$")

# Encabezados dentro de Contenidos básicos suelen terminar en ":" (p.ej. "Instalación de sistemas operativos:")
RE_UNIT_HEADER = re.compile(r"^\s*([A-Za-zÁÉÍÓÚÜÑáéíóúüñ0-9 ,./()]+)\s*:\s*$")


# ------------------ Step 1: PDF -> TXT ------------------
def pdfs_to_txt(pdf_folder: str, txt_folder: str) -> None:
    os.makedirs(txt_folder, exist_ok=True)

    if not os.path.isdir(pdf_folder):
        raise SystemExit(f"No existe la carpeta '{pdf_folder}'")

    for archivo in sorted(os.listdir(pdf_folder)):
        if not archivo.lower().endswith(".pdf"):
            continue

        ruta_pdf = os.path.join(pdf_folder, archivo)
        nombre_txt = os.path.splitext(archivo)[0] + ".txt"
        ruta_txt = os.path.join(txt_folder, nombre_txt)

        try:
            reader = PdfReader(ruta_pdf)
            texto = ""

            for pagina in reader.pages:
                contenido = pagina.extract_text()
                if contenido:
                    texto += contenido + "\n"

            with open(ruta_txt, "w", encoding="utf-8") as f:
                f.write(texto)

            print(f"PDF->TXT OK -> {archivo}")

        except Exception as e:
            print(f"PDF->TXT ERROR -> {archivo}: {e}")


# ------------------ Step 2: Parse TXT -> JSON ------------------
def read_all_txt(folder: str) -> str:
    """Concatena todos los .txt en un único texto grande, preservando líneas."""
    parts = []
    for fn in sorted(os.listdir(folder)):
        if fn.lower().endswith(".txt"):
            path = os.path.join(folder, fn)
            with open(path, "r", encoding="utf-8", errors="ignore") as f:
                parts.append(f"\n\n##### FILE: {fn} #####\n")
                parts.append(f.read())
    return "".join(parts)


def join_wrapped_field(lines, start_idx, first_line_rest):
    """
    Une un campo que puede estar partido en varias líneas:
    - Empieza con el resto de la línea actual (first_line_rest)
    - Continúa con líneas siguientes mientras NO empiecen con etiquetas típicas.
    """
    stop_prefixes = (
        "Equivalencia en créditos", "Equivalencia en cr", "Código:", "Códig",
        "Resultados de aprendizaje", "Duración:", "Contenidos básicos:",
        "Orientaciones pedagógicas", "BOLETÍN OFICIAL", "cve:", "Verificable en",
        "El módulo profesional", "El módulo profesional", "El m\xF3dulo profesional"
    )

    buf = [first_line_rest.strip()]
    i = start_idx + 1
    while i < len(lines):
        s = lines[i].strip()
        if not s:
            i += 1
            continue

        if any(s.startswith(p) for p in stop_prefixes):
            break
        if RE_ECTS.match(s) or RE_CODIGO.match(s) or RE_RA_HEADER.match(s) or RE_DURACION.match(s) or RE_CONTENIDOS.match(s):
            break
        if RE_RA_ITEM.match(s) or RE_CRIT_ITEM.match(s) or RE_CRITERIOS.match(s):
            break

        buf.append(s)
        i += 1

        if " ".join(buf).strip().endswith("."):
            break

    return " ".join(buf).strip(), i


def clean_noise_line(s: str) -> bool:
    """Filtra líneas de cabecera/pie frecuentes del BOE."""
    s = (s or "").strip()
    if not s:
        return True
    if s.startswith("BOLETÍN OFICIAL DEL ESTADO"):
        return True
    if s.startswith("Núm.") or s.startswith("Num."):
        return True
    if s.startswith("cve:"):
        return True
    if s.startswith("Verificable en"):
        return True
    return False


def derive_units_from_contenidos(raw_lines):
    """
    Determinístico:
    - Cada línea con formato 'Texto:' dentro de Contenidos básicos => nueva unidad didáctica
    - Cada bullet '− ...' => subunidad (va dentro de la unidad actual; si no hay unidad aún, crea una genérica)
    """
    units = []
    current_unit = None

    def ensure_unit():
        nonlocal current_unit
        if current_unit is None:
            current_unit = {"unidad": "Contenidos básicos", "subunidades": []}
            units.append(current_unit)

    for s in raw_lines:
        s = (s or "").strip()
        if clean_noise_line(s):
            continue

        mh = RE_UNIT_HEADER.match(s)
        if mh:
            title = mh.group(1).strip()
            if title and len(title) <= 120:
                current_unit = {"unidad": title, "subunidades": []}
                units.append(current_unit)
            continue

        mb = RE_BULLET.match(s)
        if mb:
            ensure_unit()
            current_unit["subunidades"].append(mb.group(1).strip().rstrip("."))
            continue

    return units


def parse_modules(text: str):
    lines = [ln.rstrip("\n") for ln in text.replace("\r\n", "\n").replace("\r", "\n").split("\n")]

    modules = []
    i = 0

    current = None
    in_ra = False
    in_criterios = False
    current_ra = None
    in_contenidos = False

    def flush_current():
        nonlocal current, current_ra
        if current:
            if current_ra is not None:
                current["learning_outcomes"].append(current_ra)
                current_ra = None
            current["unidades_didacticas"] = derive_units_from_contenidos(current.get("contenidos_minimos_raw", []))
            modules.append(current)
            current = None

    while i < len(lines):
        raw = lines[i]
        s = raw.strip()

        if clean_noise_line(s):
            i += 1
            continue

        m = RE_MODULO.match(s)
        if m:
            flush_current()

            name_first = m.group(1).strip()
            name, next_i = join_wrapped_field(lines, i, name_first)

            current = {
                "name": name.rstrip("."),
                "ects": None,
                "code": None,
                "duration": None,
                "learning_outcomes": [],
                "contenidos_minimos_raw": [],
                "contenidos_minimos": [],
                "unidades_didacticas": []
            }

            in_ra = False
            in_criterios = False
            current_ra = None
            in_contenidos = False

            i = next_i
            continue

        if current is None:
            i += 1
            continue

        m = RE_ECTS.match(s)
        if m:
            current["ects"] = int(m.group(1))
            i += 1
            continue

        m = RE_CODIGO.match(s)
        if m:
            current["code"] = m.group(1)
            i += 1
            continue

        m = RE_DURACION.match(s)
        if m:
            current["duration"] = m.group(1).strip().rstrip(".")
            i += 1
            continue

        if RE_RA_HEADER.match(s):
            in_ra = True
            in_criterios = False
            if current_ra is not None:
                current["learning_outcomes"].append(current_ra)
                current_ra = None
            i += 1
            continue

        if RE_CONTENIDOS.match(s):
            in_contenidos = True
            in_ra = False
            in_criterios = False
            if current_ra is not None:
                current["learning_outcomes"].append(current_ra)
                current_ra = None
            i += 1
            continue

        if s.lower().startswith("orientaciones pedagógicas"):
            in_contenidos = False
            in_ra = False
            in_criterios = False
            if current_ra is not None:
                current["learning_outcomes"].append(current_ra)
                current_ra = None
            i += 1
            continue

        if in_ra and not in_contenidos:
            if RE_CRITERIOS.match(s):
                in_criterios = True
                i += 1
                continue

            m_ra = RE_RA_ITEM.match(s)
            if m_ra:
                if current_ra is not None:
                    current["learning_outcomes"].append(current_ra)

                num = int(m_ra.group(1))
                text_ra = m_ra.group(2).strip()
                current_ra = {
                    "number": num,
                    "text": text_ra.rstrip("."),
                    "criteria": []
                }
                in_criterios = False
                i += 1
                continue

            if in_criterios:
                m_c = RE_CRIT_ITEM.match(s)
                if m_c and current_ra is not None:
                    item = m_c.group(2).strip()
                    current_ra["criteria"].append(item.rstrip("."))
                    i += 1
                    continue

            i += 1
            continue

        if in_contenidos:
            current["contenidos_minimos_raw"].append(s)
            mb = RE_BULLET.match(s)
            if mb:
                current["contenidos_minimos"].append(mb.group(1).strip().rstrip("."))
            i += 1
            continue

        i += 1

    flush_current()
    return modules


def txt_to_json(txt_folder: str, out_json: str) -> None:
    if not os.path.isdir(txt_folder):
        raise SystemExit(f"No existe la carpeta '{txt_folder}'")

    os.makedirs(os.path.dirname(out_json), exist_ok=True)

    text = read_all_txt(txt_folder)
    modules = parse_modules(text)

    payload = {
        "source": f"{txt_folder}/",
        "num_modules": len(modules),
        "modules": modules
    }

    with open(out_json, "w", encoding="utf-8") as f:
        json.dump(payload, f, ensure_ascii=False, indent=2)

    print(f"TXT->JSON OK -> {out_json}")
    print(f"Módulos detectados: {len(modules)}")


def main():
    # 1) Convert PDFs to TXTs
    pdfs_to_txt(PDF_FOLDER, TXT_FOLDER)

    # 2) Parse TXTs to JSON
    txt_to_json(TXT_FOLDER, OUT_JSON)


if __name__ == "__main__":
    main()
