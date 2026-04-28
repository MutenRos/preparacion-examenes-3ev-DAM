import os
from pypdf import PdfReader, PdfWriter

input_dir = "paginas"
output_pdf = "resultado.pdf"

writer = PdfWriter()

# Obtener PDFs ordenados
pdf_files = sorted([
    f for f in os.listdir(input_dir)
    if f.lower().endswith(".pdf")
])

for pdf in pdf_files:
    path = os.path.join(input_dir, pdf)
    reader = PdfReader(path)
    
    for page in reader.pages:
        writer.add_page(page)

# Guardar resultado final
with open(output_pdf, "wb") as f:
    writer.write(f)

print(f"PDF unido correctamente en '{output_pdf}'")
