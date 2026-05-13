import requests

url = "http://127.0.0.1:11434/api/embed"

data_gato = {
    "model": "nomic-embed-text:v1.5",
    "input": "gato"
}

response = requests.post(url, json=data_gato)
result = response.json()

# Extraer embedding (lista de floats)
embedding_gato = result["embeddings"][0]

data_perro = {
    "model": "nomic-embed-text:v1.5",
    "input": "perro"
}

response = requests.post(url, json=data_perro)
result = response.json()

# Extraer embedding (lista de floats)
embedding_perro = result["embeddings"][0]

# Mostrar como lista Python
similitud = 0
for index, elemento in enumerate(embedding_gato):
    similitud += abs(embedding_gato[index] - embedding_perro[index])

print(similitud)
	
	
	
	
	
