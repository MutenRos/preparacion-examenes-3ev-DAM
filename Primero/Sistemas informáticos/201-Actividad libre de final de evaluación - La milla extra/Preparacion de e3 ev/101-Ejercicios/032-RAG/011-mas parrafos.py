import requests
import chromadb


CHROMA_DIR = "chroma_db"
COLLECTION_NAME = "documentos"

OLLAMA_URL = "http://127.0.0.1:11434/api/embed"
OLLAMA_MODEL = "nomic-embed-text:v1.5"

TOP_K = 5
CONTEXT_BEFORE = 1
CONTEXT_AFTER = 3


def get_embedding(text):
    data = {
        "model": OLLAMA_MODEL,
        "input": text
    }

    response = requests.post(OLLAMA_URL, json=data)
    response.raise_for_status()

    return response.json()["embeddings"][0]


def get_all_paragraphs(collection):
    data = collection.get(
        include=["documents", "metadatas"]
    )

    paragraphs = {}

    for doc, meta in zip(data["documents"], data["metadatas"]):
        index = meta["paragraph_index"]
        paragraphs[index] = doc

    return paragraphs


def search(query):
    client = chromadb.PersistentClient(path=CHROMA_DIR)
    collection = client.get_collection(name=COLLECTION_NAME)

    paragraphs = get_all_paragraphs(collection)

    query_embedding = get_embedding(query)

    results = collection.query(
        query_embeddings=[query_embedding],
        n_results=TOP_K,
        include=["documents", "metadatas", "distances"]
    )

    return results, paragraphs


def main():
    query = input("Introduce tu consulta: ")

    results, paragraphs = search(query)

    print("\n=== RESULTADOS CON CONTEXTO ===\n")

    for i in range(len(results["documents"][0])):
        document = results["documents"][0][i]
        metadata = results["metadatas"][0][i]
        distance = results["distances"][0][i]

        paragraph_index = metadata["paragraph_index"]

        print(f"\n{'=' * 80}")
        print(f"RESULTADO {i + 1}")
        print(f"Distancia: {distance}")
        print(f"Párrafo encontrado: {paragraph_index}")
        print(f"{'=' * 80}\n")

        start = paragraph_index - CONTEXT_BEFORE
        end = paragraph_index + CONTEXT_AFTER

        for idx in range(start, end + 1):
            if idx not in paragraphs:
                continue

            if idx == paragraph_index:
                print(f"\n--- PÁRRAFO PRINCIPAL {idx} ---\n")
            elif idx < paragraph_index:
                print(f"\n--- PÁRRAFO ANTERIOR {idx} ---\n")
            else:
                print(f"\n--- PÁRRAFO POSTERIOR {idx} ---\n")

            print(paragraphs[idx])
            print()

    print("\nBúsqueda terminada.")


if __name__ == "__main__":
    main()
