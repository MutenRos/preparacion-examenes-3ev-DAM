#!/usr/bin/env python3
from pathlib import Path
import hashlib
import re
import requests
import chromadb
import numpy as np

DOCUMENTOS_DIR = Path("documentos")
CHROMA_DIR = Path("chroma_db_ollama")
COLLECTION_NAME = "documentos_ollama"

OLLAMA_URL = "http://127.0.0.1:11434/api/embed"
OLLAMA_MODEL = "nomic-embed-text:v1.5"

BATCH_SIZE = 16


# ============================================================
# UTILIDADES
# ============================================================

def clean_text(text: str) -> str:
    text = text.replace("\r\n", "\n").replace("\r", "\n")
    text = re.sub(r"[ \t]+", " ", text)
    text = re.sub(r"\n{3,}", "\n\n", text)
    return text.strip()


def normalize_vector(v):
    arr = np.array(v, dtype=np.float32)
    norm = np.linalg.norm(arr)
    return (arr / norm).tolist() if norm != 0 else arr.tolist()


def make_id(path, index, text):
    return hashlib.sha256(
        f"{path}:{index}:{text[:200]}".encode()
    ).hexdigest()


# ============================================================
# ESTRUCTURA (CLAVE)
# ============================================================

def split_articles(text):
    """
    Divide el documento en artículos reales.
    """
    pattern = r"(Artículo\s+\d+\.?.*?)(?=\nArtículo\s+\d+\.|\Z)"
    matches = re.findall(pattern, text, flags=re.DOTALL | re.IGNORECASE)

    if not matches:
        return [{"title": "general", "text": text}]

    blocks = []

    for m in matches:
        lines = m.strip().split("\n", 1)
        title = lines[0]
        body = lines[1] if len(lines) > 1 else ""

        blocks.append({
            "title": title.strip(),
            "text": body.strip()
        })

    return blocks


def split_list_items(text):
    """
    Divide listas tipo:
    1.
    a)
    etc.
    """
    pattern = r"(?:^|\n)\s*(?:\d+\.|[a-zñ]\))\s+(.+?)(?=\n\s*(?:\d+\.|[a-zñ]\))|\Z)"
    items = re.findall(pattern, text, flags=re.DOTALL | re.IGNORECASE)

    return [i.strip() for i in items if len(i.strip()) > 30]


def detect_section(title, text):
    t = (title + " " + text[:500]).lower()

    if "competencia general" in t:
        return "competencia_general"

    if "competencias profesionales" in t:
        return "competencias"

    if "modulos profesionales" in t or "módulos profesionales" in t:
        return "modulos"

    if "objetivos generales" in t:
        return "objetivos"

    if "entorno profesional" in t:
        return "entorno"

    return "general"


def detect_cycle(path, text):
    t = (path.name + text[:2000]).lower()

    if "asir" in t:
        return "ASIR"
    if "dam" in t:
        return "DAM"
    if "daw" in t:
        return "DAW"
    if "smr" in t:
        return "SMR"

    return "DESCONOCIDO"


# ============================================================
# EMBEDDINGS
# ============================================================

def ollama_embed(texts):
    r = requests.post(
        OLLAMA_URL,
        json={"model": OLLAMA_MODEL, "input": texts},
        timeout=300
    )
    r.raise_for_status()
    data = r.json()

    return [normalize_vector(e) for e in data["embeddings"]]


# ============================================================
# INDEXADO
# ============================================================

def main():
    client = chromadb.PersistentClient(path=str(CHROMA_DIR))

    collection = client.get_or_create_collection(
        name=COLLECTION_NAME
    )

    files = list(DOCUMENTOS_DIR.glob("*.txt"))

    print(f"{len(files)} archivos encontrados")

    ids, docs, metas = [], [], []

    global_index = 0

    for path in files:
        print(f"\nProcesando {path.name}")

        text = clean_text(path.read_text())
        cycle = detect_cycle(path, text)

        articles = split_articles(text)

        print(f"  Artículos detectados: {len(articles)}")

        for art_index, art in enumerate(articles):
            section = detect_section(art["title"], art["text"])

            # CASO LISTAS (MUY IMPORTANTE)
            items = split_list_items(art["text"])

            if items:
                chunks = items
            else:
                chunks = [art["text"]]

            for i, chunk in enumerate(chunks):
                if len(chunk) < 40:
                    continue

                full_text = f"{art['title']}\n\n{chunk}"

                ids.append(make_id(path, global_index, full_text))
                docs.append(full_text)
                metas.append({
                    "filename": path.name,
                    "cycle": cycle,
                    "section": section,
                    "article": art["title"],
                    "chunk": i
                })

                global_index += 1

                if len(docs) >= BATCH_SIZE:
                    emb = ollama_embed(docs)
                    collection.upsert(
                        ids=ids,
                        documents=docs,
                        embeddings=emb,
                        metadatas=metas
                    )
                    print(f"  Insertados {len(docs)}")
                    ids, docs, metas = [], [], []

    if docs:
        emb = ollama_embed(docs)
        collection.upsert(
            ids=ids,
            documents=docs,
            embeddings=emb,
            metadatas=metas
        )

    print("\n✔ Indexación terminada")


if __name__ == "__main__":
    main()
