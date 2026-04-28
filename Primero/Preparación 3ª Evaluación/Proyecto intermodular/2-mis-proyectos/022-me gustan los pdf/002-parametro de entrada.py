import os
import sys
from pypdf import PdfReader, PdfWriter

# Validar argumento
if len(sys.argv) < 2:
    print("Uso: python script.py archivo.pdf")
    sys.exit(1)

input_pdf = sys.argv[1]

# Obtener nombre base sin ruta ni extensión
base_name = os.path.splitext(os.path.basename(input_pdf))[0]

output_dir = "paginas"
os.makedirs(output_dir, exist_ok=True)

reader = PdfReader(input_pdf)

for i, page in enumerate(reader.pages):
    writer = PdfWriter()
    writer.add_page(page)
    
    output_filename = os.path.join(output_dir, f"{base_name}_{i+1}.pdf")
    
    with open(output_filename, "wb") as output_file:
        writer.write(output_file)

print(f"PDF dividido correctamente en '{output_dir}' con prefijo '{base_name}_'.")
