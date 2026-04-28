import os
from pypdf import PdfReader, PdfWriter

input_pdf = "BOE-A-2023-13221.pdf"
output_dir = "paginas"

# Crear carpeta si no existe
os.makedirs(output_dir, exist_ok=True)

reader = PdfReader(input_pdf)

for i, page in enumerate(reader.pages):
    writer = PdfWriter()
    writer.add_page(page)
    
    output_filename = os.path.join(output_dir, f"page_{i+1}.pdf")
    with open(output_filename, "wb") as output_file:
        writer.write(output_file)

print("PDF dividido correctamente en la carpeta 'paginas'.")
