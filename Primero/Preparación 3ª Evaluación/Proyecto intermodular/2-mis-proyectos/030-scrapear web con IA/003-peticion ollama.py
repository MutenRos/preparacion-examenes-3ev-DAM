import subprocess

result = subprocess.run(
    ["ollama", "run", "phi4-mini:latest", "Di hola en una frase"],
    capture_output=True,
    text=True
)

print(result.stdout)
