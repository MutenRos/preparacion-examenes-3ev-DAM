import re
import html
import requests
import chromadb
from flask import Flask, request, render_template_string


CHROMA_DIR = "chroma_db"
COLLECTION_NAME = "documentos"

OLLAMA_EMBED_URL = "http://127.0.0.1:11434/api/embed"
OLLAMA_GENERATE_URL = "http://127.0.0.1:11434/api/generate"

OLLAMA_EMBED_MODEL = "nomic-embed-text:v1.5"
OLLAMA_TEXT_MODEL = "qwen2.5:3b-instruct"

TOP_K_SEMANTIC = 8
TOP_K_FINAL = 8

CONTEXT_BEFORE = 1
CONTEXT_AFTER = 1

MIN_CONTEXT_LENGTH = 200


app = Flask(__name__)


HTML = """
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RAG MySQL</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f4f7fb;
            color: #1f2937;
            min-height: 100vh;
        }

        .page {
            width: min(1200px, 94%);
            margin: 0 auto;
            padding: 42px 0;
        }

        .header {
            margin-bottom: 28px;
        }

        h1 {
            margin: 0;
            font-size: 2.2rem;
            letter-spacing: -0.04em;
            color: #0f172a;
        }

        .subtitle {
            margin-top: 8px;
            color: #64748b;
            font-size: 1rem;
            line-height: 1.6;
        }

        .search-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 22px;
            padding: 22px;
            box-shadow: 0 14px 45px rgba(15, 23, 42, 0.08);
            margin-bottom: 24px;
        }

        form {
            display: flex;
            gap: 12px;
        }

        input[type="text"] {
            flex: 1;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 15px 16px;
            font-size: 1rem;
            outline: none;
            background: #f8fafc;
            color: #0f172a;
        }

        input[type="text"]:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        button {
            border: 0;
            border-radius: 14px;
            padding: 15px 24px;
            background: #2563eb;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1.35fr) minmax(320px, 0.85fr);
            gap: 24px;
            align-items: start;
        }

        .panel {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 22px;
            box-shadow: 0 14px 45px rgba(15, 23, 42, 0.07);
            overflow: hidden;
        }

        .panel-header {
            padding: 18px 22px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .panel-header h2 {
            margin: 0;
            font-size: 1.05rem;
            color: #0f172a;
        }

        .panel-body {
            padding: 24px;
        }

        .question {
            color: #2563eb;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .answer {
            line-height: 1.75;
            white-space: pre-wrap;
            font-size: 1.02rem;
        }

        .empty {
            color: #64748b;
            line-height: 1.7;
        }

        details {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            margin-bottom: 12px;
            overflow: hidden;
        }

        summary {
            cursor: pointer;
            padding: 15px 16px;
            font-weight: 700;
            color: #0f172a;
            background: #f8fafc;
        }

        summary:hover {
            background: #eef2ff;
        }

        .fragment {
            padding: 16px;
            color: #334155;
            line-height: 1.65;
            white-space: pre-wrap;
            font-size: 0.94rem;
            border-top: 1px solid #e2e8f0;
        }

        .meta {
            padding: 0 16px 16px;
            color: #64748b;
            font-size: 0.86rem;
        }

        .badge {
            display: inline-block;
            background: #dbeafe;
            color: #1e40af;
            border-radius: 999px;
            padding: 4px 9px;
            font-size: 0.78rem;
            font-weight: 700;
            margin-left: 6px;
        }

        .footer {
            margin-top: 20px;
            color: #94a3b8;
            font-size: 0.88rem;
        }

        @media (max-width: 900px) {
            .layout {
                grid-template-columns: 1fr;
            }

            form {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <header class="header">
            <h1>RAG MySQL</h1>
            <div class="subtitle">
                Consulta el manual indexado. El sistema prioriza el contexto recuperado y puede apoyarse en el conocimiento general del modelo cuando sea necesario.
            </div>
        </header>

        <section class="search-card">
            <form method="POST">
                <input
                    type="text"
                    name="query"
                    placeholder="Ejemplo: ¿Cómo se crea una tabla en MySQL?"
                    value="{{ query }}"
                    autofocus
                    required
                >
                <button type="submit">Preguntar</button>
            </form>
        </section>

        <section class="layout">
            <article class="panel">
                <div class="panel-header">
                    <h2>Respuesta final</h2>
                </div>

                <div class="panel-body">
                    {% if answer %}
                        <div class="question">Pregunta: {{ query }}</div>
                        <div class="answer">{{ answer }}</div>
                    {% else %}
                        <div class="empty">
                            Escribe una consulta para generar una respuesta basada en el documento y, cuando haga falta, en el conocimiento general del modelo.
                        </div>
                    {% endif %}
                </div>
            </article>

            <aside class="panel">
                <div class="panel-header">
                    <h2>Referencias recuperadas</h2>
                </div>

                <div class="panel-body">
                    {% if fragments %}
                        {% for fragment in fragments %}
                            <details>
                                <summary>
                                    Referencia {{ loop.index }}
                                    <span class="badge">pág. {{ fragment.page_start }}-{{ fragment.page_end }}</span>
                                </summary>

                                <div class="fragment">{{ fragment.text }}</div>

                                <div class="meta">
                                    Chunk {{ fragment.chunk_index }} ·
                                    distancia {{ "%.4f"|format(fragment.distance) }} ·
                                    keywords {{ fragment.keyword_score }} ·
                                    puntuación {{ "%.4f"|format(fragment.score) }}
                                </div>
                            </details>
                        {% endfor %}
                    {% else %}
                        <div class="empty">
                            Las referencias aparecerán aquí después de realizar una consulta.
                        </div>
                    {% endif %}
                </div>
            </aside>
        </section>

        <div class="footer">
            Embeddings: {{ embed_model }} · Generación: {{ text_model }}
        </div>
    </main>
</body>
</html>
"""


def normalize_text(text):
    text = text.lower()
    text = re.sub(r"[^\wáéíóúüñ]+", " ", text, flags=re.UNICODE)
    text = re.sub(r"\s+", " ", text)
    return text.strip()


def tokenize(text):
    stopwords = {
        "el", "la", "los", "las", "un", "una", "unos", "unas",
        "de", "del", "a", "en", "y", "o", "que", "como", "cómo",
        "para", "por", "con", "sin", "se", "es", "son", "al",
        "lo", "me", "mi", "tu", "su", "sus", "qué", "cual", "cuál"
    }

    words = normalize_text(text).split()
    return [w for w in words if len(w) > 2 and w not in stopwords]


def get_embedding(text):
    response = requests.post(
        OLLAMA_EMBED_URL,
        json={
            "model": OLLAMA_EMBED_MODEL,
            "input": text.strip()
        },
        timeout=120
    )

    response.raise_for_status()
    result = response.json()

    if "embeddings" in result:
        return result["embeddings"][0]

    if "embedding" in result:
        return result["embedding"]

    raise RuntimeError("Respuesta inesperada de Ollama al generar embeddings.")


def get_collection():
    client = chromadb.PersistentClient(path=CHROMA_DIR)
    return client.get_collection(COLLECTION_NAME)


def get_all_chunks(collection):
    data = collection.get(include=["documents", "metadatas"])
    chunks = {}

    for document, metadata in zip(data["documents"], data["metadatas"]):
        chunk_index = int(metadata["chunk_index"])

        chunks[chunk_index] = {
            "text": document,
            "metadata": metadata
        }

    return chunks


def keyword_score(query, document):
    query_terms = tokenize(query)
    document_text = normalize_text(document)

    if not query_terms:
        return 0

    score = 0

    for term in query_terms:
        if term in document_text:
            score += 1

    return score


def semantic_search(collection, query):
    query_embedding = get_embedding(query)

    results = collection.query(
        query_embeddings=[query_embedding],
        n_results=TOP_K_SEMANTIC,
        include=["documents", "metadatas", "distances"]
    )

    candidates = []

    if not results["documents"] or not results["documents"][0]:
        return candidates

    for document, metadata, distance in zip(
        results["documents"][0],
        results["metadatas"][0],
        results["distances"][0]
    ):
        candidates.append({
            "text": document,
            "metadata": metadata,
            "distance": float(distance),
            "semantic_score": 1.0 - float(distance),
            "keyword_score": keyword_score(query, document)
        })

    return candidates


def keyword_search(chunks, query):
    candidates = []

    for chunk_index, item in chunks.items():
        text = item["text"]
        metadata = item["metadata"]
        score = keyword_score(query, text)

        if score > 0:
            candidates.append({
                "text": text,
                "metadata": metadata,
                "distance": 1.0,
                "semantic_score": 0.0,
                "keyword_score": score
            })

    candidates.sort(key=lambda x: x["keyword_score"], reverse=True)
    return candidates[:TOP_K_SEMANTIC]


def combine_candidates(semantic_candidates, keyword_candidates):
    merged = {}

    for candidate in semantic_candidates + keyword_candidates:
        chunk_index = int(candidate["metadata"]["chunk_index"])

        if chunk_index not in merged:
            merged[chunk_index] = candidate
        else:
            merged[chunk_index]["semantic_score"] = max(
                merged[chunk_index]["semantic_score"],
                candidate["semantic_score"]
            )
            merged[chunk_index]["keyword_score"] = max(
                merged[chunk_index]["keyword_score"],
                candidate["keyword_score"]
            )
            merged[chunk_index]["distance"] = min(
                merged[chunk_index]["distance"],
                candidate["distance"]
            )

    final = []

    for candidate in merged.values():
        semantic_score = candidate["semantic_score"]
        keyword_value = candidate["keyword_score"]

        candidate["score"] = semantic_score + (keyword_value * 0.08)
        final.append(candidate)

    final.sort(key=lambda x: x["score"], reverse=True)
    return final[:TOP_K_FINAL]


def expand_with_neighbors(candidates, chunks):
    selected = {}

    for candidate in candidates:
        center = int(candidate["metadata"]["chunk_index"])

        for idx in range(center - CONTEXT_BEFORE, center + CONTEXT_AFTER + 1):
            if idx not in chunks:
                continue

            if idx not in selected:
                item = chunks[idx]
                metadata = item["metadata"]

                selected[idx] = {
                    "chunk_index": idx,
                    "text": item["text"],
                    "page_start": int(metadata.get("page_start", 0)),
                    "page_end": int(metadata.get("page_end", 0)),
                    "distance": candidate["distance"],
                    "keyword_score": candidate["keyword_score"],
                    "score": candidate["score"]
                }

    return sorted(selected.values(), key=lambda x: x["chunk_index"])


def build_context(fragments):
    blocks = []

    for fragment in fragments:
        blocks.append(f"""
[Referencia]
Páginas: {fragment["page_start"]}-{fragment["page_end"]}
Texto:
{fragment["text"]}
""".strip())

    return "\n\n" + ("-" * 80 + "\n\n").join(blocks)


def ask_ai(query, context):
    prompt = f"""
Eres un profesor de bases de datos y programación.

Debes responder a la pregunta del usuario siguiendo estas reglas:

1. Da prioridad absoluta al CONTEXTO RAG recuperado del documento.
2. Si el contexto RAG contiene la respuesta, úsalo como fuente principal.
3. Si el contexto RAG es incompleto, puedes completar la explicación con tu conocimiento general.
4. Si usas conocimiento general no presente explícitamente en el contexto, indícalo de forma natural, por ejemplo:
   "Además, de forma general..."
5. No inventes citas ni páginas.
6. Responde en español.
7. Sé claro, didáctico y útil para alumnado.
8. Si procede, incluye ejemplos SQL sencillos.

PREGUNTA DEL USUARIO:
{query}

CONTEXTO RAG:
{context if len(context.strip()) >= MIN_CONTEXT_LENGTH else "No se ha recuperado contexto suficiente."}

RESPUESTA:
"""

    response = requests.post(
        OLLAMA_GENERATE_URL,
        json={
            "model": OLLAMA_TEXT_MODEL,
            "prompt": prompt,
            "stream": False,
            "options": {
                "temperature": 0.2,
                "top_p": 0.9
            }
        },
        timeout=300
    )

    response.raise_for_status()
    return response.json()["response"].strip()


def run_rag(query):
    collection = get_collection()
    chunks = get_all_chunks(collection)

    semantic_candidates = semantic_search(collection, query)
    keyword_candidates = keyword_search(chunks, query)

    candidates = combine_candidates(semantic_candidates, keyword_candidates)
    fragments = expand_with_neighbors(candidates, chunks)

    context = build_context(fragments)
    answer = ask_ai(query, context)

    return answer, fragments


@app.route("/", methods=["GET", "POST"])
def index():
    query = ""
    answer = ""
    fragments = []

    if request.method == "POST":
        query = request.form.get("query", "").strip()

        if query:
            try:
                answer, fragments = run_rag(query)
            except Exception as e:
                answer = f"Error ejecutando el sistema RAG: {html.escape(str(e))}"

    return render_template_string(
        HTML,
        query=query,
        answer=answer,
        fragments=fragments,
        embed_model=OLLAMA_EMBED_MODEL,
        text_model=OLLAMA_TEXT_MODEL
    )


if __name__ == "__main__":
    app.run(debug=True, host="127.0.0.1", port=5000)
