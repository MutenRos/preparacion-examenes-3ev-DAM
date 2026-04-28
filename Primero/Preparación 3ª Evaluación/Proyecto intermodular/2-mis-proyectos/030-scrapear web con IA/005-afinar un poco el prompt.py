import requests
import subprocess

# 1. Descargar contenido web
url = "https://jocarsa.com"
response = requests.get(url)

html = response.text

# 2. Crear prompt para resumen
prompt = f"Te voy a pasar el codigo fuente de una página web. Resume en un párrafo cual es la actividad de esa empresa. Solo párrafo, no pongas nada de código.:\n\n{html}"

# 3. Llamar a Ollama
result = subprocess.run(
    ["ollama", "run", "qwen2.5-coder:7b", prompt],
    capture_output=True,
    text=True
)

# 4. Mostrar resultado
print("RESUMEN:\n")
print(result.stdout)
