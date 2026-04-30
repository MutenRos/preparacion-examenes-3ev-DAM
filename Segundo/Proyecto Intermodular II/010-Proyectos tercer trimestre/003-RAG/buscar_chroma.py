#!/usr/bin/env python3
import sys
import json
import requests
import chromadb
import numpy as np

CHROMA_DIR = "/var/www/html/dam2526/Segundo/Proyecto Intermodular II/010-Proyectos tercer trimestre/003-RAG/chroma_db_ollama"
COLLECTION_NAME = "documentos_ollama"

OLLAMA_URL = "http://127.0.0.1:11434/api/embed"
OLLAMA_MODEL = "nomic-embed-text:v1.5"


def normalize_vector(vector):
    arr = np.array(vector, dtype=np.float32)
    norm = np.linalg.norm(arr)

    if norm == 0:
        return arr.tolist()

    return (arr / norm).tolist()


def ollama_embed(text):
    response = requests.post(
        OLLAMA_URL,
        json={
            "model": OLLAMA_MODEL,
            "input": text
        },
        timeout=300
    )

    response.raise_for_status()
    data = response.json()

    return normalize_vector(data["embeddings"][0])


def main():
    if len(sys.argv) < 2:
        print(json.dumps({
            "status": "error",
            "message": "Falta la consulta"
        }, ensure_ascii=False))
        return

    query = sys.argv[1]

    client = chromadb.PersistentClient(path=CHROMA_DIR)
    collection = client.get_collection(COLLECTION_NAME)

    embedding = ollama_embed(query)

    results = collection.query(
        query_embeddings=[embedding],
        n_results=3
    )

    output = []

    documents = results["documents"][0]
    metadatas = results["metadatas"][0]
    distances = results["distances"][0]

    for doc, meta, dist in zip(documents, metadatas, distances):
        output.append({
            "text": doc,
            "metadata": meta,
            "distance": dist
        })

    print(json.dumps({
        "status": "ok",
        "query": query,
        "results": output
    }, ensure_ascii=False, indent=2))


if __name__ == "__main__":
    main()
