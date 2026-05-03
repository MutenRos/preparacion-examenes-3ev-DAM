import re
import requests
import chromadb
import hashlib


TXT_INPUT = "manual mysql.txt"
CHROMA_DIR = "chroma_db"
COLLECTION_NAME = "documentos"

OLLAMA_URL = "http://127.0.0.1:11434/api/embed"
OLLAMA_MODEL = "nomic-embed-text:v1.5"

MIN_WORDS = 20
MAX_CHARS = 4000


def clean_text(text):
    text = text.replace("\x00", " ")
    text = re.sub(r"\s+", " ", text)
    return text.strip()


def split_paragraphs(text):
    raw_paragraphs = re.split(r"\n\s*\n", text)
    paragraphs = []

    for paragraph in raw_paragraphs:
        paragraph = clean_text(paragraph)

        if len(paragraph.split()) >= MIN_WORDS:
            if len(paragraph) > MAX_CHARS:
                paragraph = paragraph[:MAX_CHARS]

            paragraphs.append(paragraph)

    return paragraphs


def get_embedding(text):
    data = {
        "model": OLLAMA_MODEL,
        "input": text
    }

    response = requests.post(
        OLLAMA_URL,
        json=data,
        timeout=120
    )

    if response.status_code != 200:
        print("ERROR OLLAMA")
        print("Status:", response.status_code)
        print("Respuesta:", response.text[:1000])
        print("Texto problemático:", text[:1000])
        return None

    result = response.json()
    return result["embeddings"][0]


def make_id(text, index):
    h = hashlib.md5(text.encode("utf-8")).hexdigest()
    return f"paragraph_{index}_{h}"


def main():
    with open(TXT_INPUT, "r", encoding="utf-8", errors="ignore") as f:
        text = f.read()

    paragraphs = split_paragraphs(text)

    print(f"Párrafos encontrados: {len(paragraphs)}")

    client = chromadb.PersistentClient(path=CHROMA_DIR)

    collection = client.get_or_create_collection(
        name=COLLECTION_NAME
    )

    for index, paragraph in enumerate(paragraphs):
        print(f"Procesando párrafo {index + 1}/{len(paragraphs)}")

        embedding = get_embedding(paragraph)

        if embedding is None:
            print(f"Saltando párrafo {index}")
            continue

        collection.add(
            ids=[make_id(paragraph, index)],
            embeddings=[embedding],
            documents=[paragraph],
            metadatas=[
                {
                    "source": TXT_INPUT,
                    "paragraph_index": index,
                    "word_count": len(paragraph.split()),
                    "char_count": len(paragraph)
                }
            ]
        )

    print("Indexación terminada correctamente.")


if __name__ == "__main__":
    main()
