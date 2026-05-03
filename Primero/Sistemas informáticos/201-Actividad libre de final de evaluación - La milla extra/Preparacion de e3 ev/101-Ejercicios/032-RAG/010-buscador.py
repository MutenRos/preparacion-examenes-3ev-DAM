import requests
import chromadb


CHROMA_DIR = "chroma_db"
COLLECTION_NAME = "documentos"

OLLAMA_URL = "http://127.0.0.1:11434/api/embed"
OLLAMA_MODEL = "nomic-embed-text:v1.5"

TOP_K = 5


def get_embedding(text):
    data = {
        "model": OLLAMA_MODEL,
        "input": text
    }

    response = requests.post(OLLAMA_URL, json=data)
    response.raise_for_status()

    return response.json()["embeddings"][0]


def search(query):
    client = chromadb.PersistentClient(path=CHROMA_DIR)

    collection = client.get_collection(name=COLLECTION_NAME)

    query_embedding = get_embedding(query)

    results = collection.query(
        query_embeddings=[query_embedding],
        n_results=TOP_K
    )

    return results


def main():
    query = input("Introduce tu consulta: ")

    results = search(query)

    print("\n=== RESULTADOS ===\n")

    for i in range(len(results["documents"][0])):
        print(f"--- Resultado {i+1} ---\n")
        print(results["documents"][0][i])
        print("\n")


if __name__ == "__main__":
    main()
