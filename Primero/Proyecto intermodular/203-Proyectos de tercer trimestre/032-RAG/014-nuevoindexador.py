import os
import re
import json
import hashlib
import requests
import chromadb


TXT_INPUT = "manual mysql.txt"
CHROMA_DIR = "chroma_db"
COLLECTION_NAME = "documentos"

OLLAMA_EMBED_URL = "http://127.0.0.1:11434/api/embed"
OLLAMA_EMBED_MODEL = "nomic-embed-text:v1.5"

CHUNK_WORDS = 350
CHUNK_OVERLAP = 70
BATCH_SIZE = 25

MIN_CHUNK_WORDS = 60
MAX_EMBED_CHARS = 2500


def clean_text(text):
    text = text.replace("\x00", " ")
    text = re.sub(r"[ \t]+", " ", text)
    text = re.sub(r"\n{3,}", "\n\n", text)
    return text.strip()


def extract_pages(text):
    pattern = r"=== PAGE (\d+) ==="
    parts = re.split(pattern, text)

    pages = []

    if len(parts) < 3:
        pages.append((1, clean_text(text)))
        return pages

    for i in range(1, len(parts), 2):
        page_number = int(parts[i])
        page_text = clean_text(parts[i + 1])

        if page_text:
            pages.append((page_number, page_text))

    return pages


def split_into_sentences(text):
    text = clean_text(text)
    sentences = re.split(r"(?<=[.!?;:])\s+", text)
    return [s.strip() for s in sentences if s.strip()]


def make_chunks_from_pages(pages):
    all_units = []

    for page_number, page_text in pages:
        paragraphs = re.split(r"\n\s*\n", page_text)

        for paragraph in paragraphs:
            paragraph = clean_text(paragraph)

            if not paragraph:
                continue

            words = paragraph.split()

            if len(words) <= CHUNK_WORDS:
                all_units.append({
                    "text": paragraph,
                    "page_start": page_number,
                    "page_end": page_number
                })
            else:
                sentences = split_into_sentences(paragraph)
                current = []
                current_words = 0

                for sentence in sentences:
                    sentence_words = sentence.split()

                    if current_words + len(sentence_words) > CHUNK_WORDS and current:
                        all_units.append({
                            "text": " ".join(current),
                            "page_start": page_number,
                            "page_end": page_number
                        })

                        current = []
                        current_words = 0

                    current.append(sentence)
                    current_words += len(sentence_words)

                if current:
                    all_units.append({
                        "text": " ".join(current),
                        "page_start": page_number,
                        "page_end": page_number
                    })

    chunks = []
    buffer_words = []
    buffer_page_start = None
    buffer_page_end = None
    chunk_index = 0

    for unit in all_units:
        words = unit["text"].split()

        if buffer_page_start is None:
            buffer_page_start = unit["page_start"]

        buffer_page_end = unit["page_end"]
        buffer_words.extend(words)

        while len(buffer_words) >= CHUNK_WORDS:
            chunk_words = buffer_words[:CHUNK_WORDS]
            chunk_text = " ".join(chunk_words)

            chunks.append({
                "index": chunk_index,
                "text": chunk_text,
                "page_start": buffer_page_start,
                "page_end": buffer_page_end,
                "word_count": len(chunk_words),
                "char_count": len(chunk_text)
            })

            chunk_index += 1

            buffer_words = buffer_words[CHUNK_WORDS - CHUNK_OVERLAP:]

            if len(buffer_words) < MIN_CHUNK_WORDS:
                break

    if len(buffer_words) >= MIN_CHUNK_WORDS:
        chunk_text = " ".join(buffer_words)

        chunks.append({
            "index": chunk_index,
            "text": chunk_text,
            "page_start": buffer_page_start or 1,
            "page_end": buffer_page_end or 1,
            "word_count": len(buffer_words),
            "char_count": len(chunk_text)
        })

    return chunks


def get_embedding(text):
    text = clean_text(text)

    if not text:
        return None

    if len(text) > MAX_EMBED_CHARS:
        text = text[:MAX_EMBED_CHARS]

    data = {
        "model": OLLAMA_EMBED_MODEL,
        "input": text
    }

    response = requests.post(
        OLLAMA_EMBED_URL,
        json=data,
        timeout=120
    )

    if response.status_code != 200:
        print("\nERROR AL GENERAR EMBEDDING")
        print("Status:", response.status_code)
        print("Respuesta de Ollama:")
        print(response.text[:2000])
        print("\nTexto enviado a Ollama:")
        print(text[:1000])
        print("\nLongitud:", len(text), "caracteres")
        return None

    result = response.json()

    if "embeddings" in result:
        return result["embeddings"][0]

    if "embedding" in result:
        return result["embedding"]

    print("Respuesta inesperada de Ollama:")
    print(result)
    return None


def make_id(source, chunk_index, text):
    raw = f"{source}:{chunk_index}:{text}"
    digest = hashlib.md5(raw.encode("utf-8")).hexdigest()
    return f"chunk_{chunk_index}_{digest}"


def batched(items, batch_size):
    for i in range(0, len(items), batch_size):
        yield items[i:i + batch_size]


def main():
    if not os.path.exists(TXT_INPUT):
        raise FileNotFoundError(f"No existe el archivo: {TXT_INPUT}")

    with open(TXT_INPUT, "r", encoding="utf-8", errors="ignore") as f:
        raw_text = f.read()

    raw_text = clean_text(raw_text)
    pages = extract_pages(raw_text)
    chunks = make_chunks_from_pages(pages)

    print(f"Páginas detectadas: {len(pages)}")
    print(f"Chunks generados: {len(chunks)}")

    client = chromadb.PersistentClient(path=CHROMA_DIR)

    try:
        client.delete_collection(COLLECTION_NAME)
        print("Colección anterior eliminada.")
    except Exception:
        print("No había colección anterior o no se pudo eliminar.")

    collection = client.get_or_create_collection(
        name=COLLECTION_NAME,
        metadata={"hnsw:space": "cosine"}
    )

    total_insertados = 0
    total_saltados = 0

    for batch_number, batch in enumerate(batched(chunks, BATCH_SIZE), start=1):
        ids = []
        documents = []
        metadatas = []
        embeddings = []

        print(f"Procesando lote {batch_number}...")

        for chunk in batch:
            text = chunk["text"]
            embedding = get_embedding(text)

            if embedding is None:
                print(f"Saltando chunk {chunk['index']} por error de embedding.")
                total_saltados += 1
                continue

            ids.append(make_id(TXT_INPUT, chunk["index"], text))
            documents.append(text)
            embeddings.append(embedding)
            metadatas.append({
                "source": TXT_INPUT,
                "chunk_index": chunk["index"],
                "page_start": chunk["page_start"],
                "page_end": chunk["page_end"],
                "word_count": chunk["word_count"],
                "char_count": chunk["char_count"]
            })

        if ids:
            collection.add(
                ids=ids,
                documents=documents,
                embeddings=embeddings,
                metadatas=metadatas
            )

            total_insertados += len(ids)

    manifest = {
        "source": TXT_INPUT,
        "collection": COLLECTION_NAME,
        "embedding_model": OLLAMA_EMBED_MODEL,
        "chunk_words": CHUNK_WORDS,
        "chunk_overlap": CHUNK_OVERLAP,
        "max_embed_chars": MAX_EMBED_CHARS,
        "chunks_generados": len(chunks),
        "chunks_insertados": total_insertados,
        "chunks_saltados": total_saltados
    }

    with open("rag_manifest.json", "w", encoding="utf-8") as f:
        json.dump(manifest, f, ensure_ascii=False, indent=4)

    print()
    print("Indexación terminada.")
    print(f"Chunks insertados: {total_insertados}")
    print(f"Chunks saltados: {total_saltados}")
    print("Manifest guardado en rag_manifest.json")


if __name__ == "__main__":
    main()
