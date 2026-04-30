import requests

URL = "http://127.0.0.1:11434/api/embed"
MODEL = "nomic-embed-text:v1.5"

def obtener_embedding(texto):
    data = {
        "model": MODEL,
        "input": texto
    }
    response = requests.post(URL, json=data)
    result = response.json()
    return result["embeddings"][0]

def comparar_palabras(palabra1, palabra2):
    emb1 = obtener_embedding(palabra1)
    emb2 = obtener_embedding(palabra2)

    similitud = 0
    for i, _ in enumerate(emb1):
        similitud += abs(emb1[i] - emb2[i])

    return similitud

# Ejemplos de uso
print("gato vs perro:", comparar_palabras("gato", "perro"))
print("gato vs gato:", comparar_palabras("gato", "gato"))
print("gato vs camion:", comparar_palabras("gato", "camion"))



