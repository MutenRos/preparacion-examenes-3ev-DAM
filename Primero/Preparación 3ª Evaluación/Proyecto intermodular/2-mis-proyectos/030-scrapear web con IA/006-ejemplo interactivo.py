import requests
import subprocess

# 1. Descargar contenido web
url = input("Introduce una url:")
response = requests.get(url)

html = response.text

# 2. Crear prompt para resumen
prompt = f"Te voy a pasar el codigo fuente de una página web. Resume en un párrafo cual es la actividad de esa empresa. Solo párrafo, no pongas nada de código.Responde solo en español. Responde con un párrafo. No comentes el código, solo lee el HTML que puedas, y extrae el tema de la web con respecto al contenido estático HTML. Solo quiero saber cual es el tema de la web. No quiero saber nada del código fuente:\n\n{html}"

# 3. Llamar a Ollama
result = subprocess.run(
    ["ollama", "run", "qwen3.5:9b", prompt],
    capture_output=True,
    text=True
)

# 4. Mostrar resultado
print("RESUMEN:\n")
print(result.stdout)
