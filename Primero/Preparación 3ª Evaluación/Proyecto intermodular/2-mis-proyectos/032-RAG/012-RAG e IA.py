import requests
import chromadb


CHROMA_DIR = "chroma_db"
COLLECTION_NAME = "documentos"

OLLAMA_EMBED_URL = "http://127.0.0.1:11434/api/embed"
OLLAMA_GENERATE_URL = "http://127.0.0.1:11434/api/generate"

OLLAMA_EMBED_MODEL = "nomic-embed-text:v1.5"
OLLAMA_TEXT_MODEL = "qwen2.5:3b-instruct"

TOP_K = 8
CONTEXT_BEFORE = 2
CONTEXT_AFTER = 3

MIN_CONTEXT_LENGTH = 150
DEBUG = False


def get_embedding(text):
    text = text.strip().lower()

    data = {
        "model": OLLAMA_EMBED_MODEL,
        "input": text
    }

    response = requests.post(OLLAMA_EMBED_URL, json=data, timeout=120)
    response.raise_for_status()

    return response.json()["embeddings"][0]


def get_all_paragraphs(collection):
    data = collection.get(include=["documents", "metadatas"])

    paragraphs = {}

    for doc, meta in zip(data["documents"], data["metadatas"]):
        index = int(meta["paragraph_index"])
        paragraphs[index] = doc.strip()

    return paragraphs


def search(query):
    client = chromadb.PersistentClient(path=CHROMA_DIR)
    collection = client.get_collection(name=COLLECTION_NAME)

    paragraphs = get_all_paragraphs(collection)

    enriched_query = f"""
    {query}
    bases de datos mysql sql explicación técnica ejemplo definición crear tabla vista create database create table view
    """

    query_embedding = get_embedding(enriched_query)

    results = collection.query(
        query_embeddings=[query_embedding],
        n_results=TOP_K,
        include=["documents", "metadatas", "distances"]
    )

    return results, paragraphs


def build_context(results, paragraphs):
    context_blocks = []
    used_indices = set()

    if not results["documents"] or not results["documents"][0]:
        return ""

    for i in range(len(results["documents"][0])):
        metadata = results["metadatas"][0][i]
        distance = results["distances"][0][i]

        paragraph_index = int(metadata["paragraph_index"])

        start = paragraph_index - CONTEXT_BEFORE
        end = paragraph_index + CONTEXT_AFTER

        block = []
        block.append(f"Fragmento recuperado {i + 1}")
        block.append(f"Distancia semántica: {distance}")
        block.append("")

        for idx in range(start, end + 1):
            if idx not in paragraphs:
                continue

            if idx in used_indices:
                continue

            used_indices.add(idx)

            if idx == paragraph_index:
                block.append(f"[Párrafo principal {idx}]")
            elif idx < paragraph_index:
                block.append(f"[Párrafo anterior {idx}]")
            else:
                block.append(f"[Párrafo posterior {idx}]")

            block.append(paragraphs[idx])
            block.append("")

        context_blocks.append("\n".join(block))

    return "\n\n" + ("-" * 80) + "\n\n".join(context_blocks)


def ask_ai(query, context):
    if len(context.strip()) < MIN_CONTEXT_LENGTH:
        return "No hay información suficiente en el contexto recuperado para responder a esa pregunta."

    prompt = f"""
Eres un asistente que redacta respuestas a partir de un contexto recuperado.

REGLAS IMPORTANTES:
- Responde únicamente a partir del CONTEXTO RAG.
- No uses conocimiento externo.
- No añadas datos que no estén en el contexto.
- Puedes ordenar, resumir, reformular y explicar mejor la información del contexto.
- Puedes unir ideas si aparecen en diferentes fragmentos del contexto.
- No menciones ChromaDB, embeddings, RAG, Ollama, distancias ni metadatos.
- No muestres referencias ni listados de párrafos.
- Responde siempre en Español
- Si el contexto no permite responder de forma razonable, responde exactamente:
  "No hay información suficiente en el contexto recuperado para responder a esa pregunta."

PREGUNTA DEL USUARIO:
{query}

CONTEXTO RAG:
{context}

RESPUESTA FINAL:
"""

    data = {
        "model": OLLAMA_TEXT_MODEL,
        "prompt": prompt,
        "stream": False,
        "options": {
            "temperature": 0.1,
            "top_p": 0.9
        }
    }

    response = requests.post(OLLAMA_GENERATE_URL, json=data, timeout=300)
    response.raise_for_status()

    return response.json()["response"].strip()


def main():
    query = input("Introduce tu consulta: ").strip()

    if not query:
        print("No has introducido ninguna consulta.")
        return

    results, paragraphs = search(query)

    context = build_context(results, paragraphs)

    if DEBUG:
        print("\n=== CONTEXTO RECUPERADO ===\n")
        print(context[:3000])
        print("\n=== FIN DEL CONTEXTO ===\n")

    answer = ask_ai(query, context)

    print("\n=== RESPUESTA ===\n")
    print(answer)


if __name__ == "__main__":
    main()
