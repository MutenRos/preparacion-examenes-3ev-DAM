import os

# Pedir el nombre del usuario
nombre = input("Introduce tu nombre: ")

# Crear el contenido SVG
svg_content = f"""<svg width="200" height="100">
  <text x="10" y="40" font-family="Arial" font-size="30" fill="black">{nombre}</text>
</svg>"""

# Guardar el archivo en el escritorio
desktop = os.path.join(os.path.expanduser("~"), "Desktop")
svg_file = os.path.join(desktop, "medalla.svg")

with open(svg_file, "w") as f:
    f.write(svg_content)

print(f"Archivo SVG guardado en: {svg_file}")