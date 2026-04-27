import requests
from bs4 import BeautifulSoup
import os
import re
from urllib.parse import urljoin, urlparse

# ----------------------------
# CONFIG
# ----------------------------
URL = "https://www.google.com/search?client=ubuntu-chr&hs=zc5&sca_esv=6405bf69fd380f07&sxsrf=AE3TifNt_yEjQ4Met0O46fu4_IZCFjp1ow:1763391692306&udm=2&fbs=AIIjpHx4nJjfGojPVHhEACUHPiMQht6_BFq6vBIoFFRK7qchKEWEvuc0Hbw31oEI7c8o3y4MyqtV5m4rLCGDMco7dQbsn3LCPjOfwb34Pr7sZ7pnaif_wxkbmQ1RDXUJKmgZFKA0yxjAW_dJQshoFr_Eza33GZmyYOVuvA5oknEnCdniqMIxxsRvdOoVFuW0LrZXtURuPEoR&q=ardilla&sa=X&ved=2ahUKEwiFwa37ufmQAxXlhf0HHdPdAIQQtKgLegQIERAB&biw=1920&bih=884&dpr=1"
OUTPUT_DIR = "imagenes"

# Crear carpeta si no existe
os.makedirs(OUTPUT_DIR, exist_ok=True)

# ----------------------------
# Descargar HTML
# ----------------------------
print(f"Descargando HTML desde {URL}...")
response = requests.get(URL)
html = response.text

soup = BeautifulSoup(html, "html.parser")

image_urls = set()

# ----------------------------
# 1. Extraer <img src="...">
# ----------------------------
for img in soup.find_all("img"):
    src = img.get("src")
    if src:
        full_url = urljoin(URL, src)
        image_urls.add(full_url)

# ----------------------------
# 2. Extraer CSS background-image dentro de style=""
#    Ejemplo: style="background-image:url('img/bg.jpg');"
# ----------------------------
pattern = re.compile(r"background-image\s*:\s*url\(['\"]?(.*?)['\"]?\)", re.IGNORECASE)

for elem in soup.find_all(style=True):
    styles = elem["style"]
    matches = pattern.findall(styles)
    for m in matches:
        full_url = urljoin(URL, m)
        image_urls.add(full_url)

# ----------------------------
# Descargar todas las imágenes encontradas
# ----------------------------
print(f"\nEncontradas {len(image_urls)} imágenes:")
for img_url in image_urls:
    print(" -", img_url)

print("\nDescargando imágenes...\n")

for img_url in image_urls:
    try:
        filename = os.path.basename(urlparse(img_url).path)
        if not filename:  # fallback
            filename = "image_" + str(abs(hash(img_url))) + ".jpg"

        filepath = os.path.join(OUTPUT_DIR, filename)

        img_data = requests.get(img_url).content

        with open(filepath, "wb") as f:
            f.write(img_data)

        print(f"✔ Guardada: {filepath}")

    except Exception as e:
        print(f"✘ Error con {img_url}: {e}")

print("\nTerminado.")

