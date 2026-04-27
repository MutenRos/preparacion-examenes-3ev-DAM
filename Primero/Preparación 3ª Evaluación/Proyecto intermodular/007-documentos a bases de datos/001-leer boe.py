import os
from PyPDF2 import PdfReader

PDF_FOLDER = "pdf"
TXT_FOLDER = "txt"

# Crear carpeta txt si no existe
os.makedirs(TXT_FOLDER, exist_ok=True)

for archivo in os.listdir(PDF_FOLDER):

    if archivo.lower().endswith(".pdf"):

        ruta_pdf = os.path.join(PDF_FOLDER, archivo)
        nombre_txt = os.path.splitext(archivo)[0] + ".txt"
        ruta_txt = os.path.join(TXT_FOLDER, nombre_txt)

        try:
            reader = PdfReader(ruta_pdf)
            texto = ""

            for pagina in reader.pages:
                contenido = pagina.extract_text()
                if contenido:
                    texto += contenido + "\n"

            with open(ruta_txt, "w", encoding="utf-8") as f:
                f.write(texto)

            print(f"OK -> {archivo}")

        except Exception as e:
            print(f"ERROR -> {archivo}: {e}")
