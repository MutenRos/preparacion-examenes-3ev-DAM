import os
from PyPDF2 import PdfReader

for archivo in os.listdir("pdf"):
    ruta = os.path.join("pdf", archivo)
    
    if archivo.lower().endswith(".pdf"):
        reader = PdfReader(ruta)
        
        texto = ""
        for pagina in reader.pages:
            texto += pagina.extract_text() or ""
        
        print(archivo, "->", texto[:10])
