import requests

url = "http://127.0.0.1:11434/api/embed"

data = {
    "model": "nomic-embed-text:v1.5",
    "input": "gato"
}

response = requests.post(url, json=data)
result = response.json()

# Extraer embedding (lista de floats)
embedding = result["embeddings"][0]

# Mostrar como lista Python
print(embedding)
