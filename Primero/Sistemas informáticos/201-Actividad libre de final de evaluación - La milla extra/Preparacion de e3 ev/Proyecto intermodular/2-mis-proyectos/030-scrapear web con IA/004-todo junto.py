import requests
import subprocess

# 1. Descargar contenido web
url = "https://jocarsa.com"
response = requests.get(url)

html = response.text

# 2. Crear prompt para resumen
prompt = f"Resume el siguiente contenido web en español de forma clara:\n\n{html}"

# 3. Llamar a Ollama
result = subprocess.run(
    ["ollama", "run", "phi4-mini:latest", prompt],
    capture_output=True,
    text=True
)

# 4. Mostrar resultado
print("RESUMEN:\n")
print(result.stdout)
