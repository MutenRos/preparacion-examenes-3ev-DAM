import requests
import math

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

def similitud_coseno(vec1, vec2):
    # Producto punto
    dot_product = sum(a * b for a, b in zip(vec1, vec2))
    
    # Magnitudes
    norm1 = math.sqrt(sum(a * a for a in vec1))
    norm2 = math.sqrt(sum(b * b for b in vec2))
    
    # Evitar división por cero
    if norm1 == 0 or norm2 == 0:
        return 0
    
    return dot_product / (norm1 * norm2)

def comparar_palabras(palabra1, palabra2):
    emb1 = obtener_embedding(palabra1)
    emb2 = obtener_embedding(palabra2)

    return similitud_coseno(emb1, emb2)

# Ejemplos
print("gato vs perro:", comparar_palabras("gato", "perro"))
print("gato vs gato:", comparar_palabras("gato", "gato"))
print("gato vs camion:", comparar_palabras("gato", "camion"))
print("gato vs amor:", comparar_palabras("gato", "amor"))
print("gato vs lunes:", comparar_palabras("gato", "lunes"))
print("gato vs siglo:", comparar_palabras("gato", "siglo"))
