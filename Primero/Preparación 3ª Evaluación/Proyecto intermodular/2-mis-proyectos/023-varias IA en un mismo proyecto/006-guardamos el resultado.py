import requests

archivo = open("resultado.md",'w')
archivo.write(" ")
archivo.close()
archivo = open("resultado.md",'a')

iarazonamiento = "qwen2.5:3b-instruct"
iacodigo = "qwen2.5-coder:7b"

pregunta = "variables"
sistema = " en C++"

url = "http://localhost:11434/api/generate"

# Primera petición
data = {
    "model": iarazonamiento,
    "prompt": "Explica (solo explicación sin código): "+pregunta+sistema,
    "stream": False
}
response = requests.post(url, json=data)
archivo.write(response.json()["response"])

# Segunda petición
data = {
    "model": iacodigo,
    "prompt": "Pon un ejemplo de código (solo código sin explicacion): "+pregunta+sistema,
    "stream": False
}
response = requests.post(url, json=data)
archivo.write(response.json()["response"])
print("ok")
archivo.close()
