import requests
import chromadb
from flask import Flask, request, render_template_string


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


app = Flask(__name__)


HTML = """
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RAG con IA local</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: radial-gradient(circle at top, #1e293b, #020617);
            color: #e5e7eb;
            min-height: 100vh;
        }

        .container {
            width: min(900px, 92%);
            margin: 0 auto;
            padding: 60px 0;
        }

        .card {
            background: rgba(15, 23, 42, 0.88);
            border: 1px solid rgba(148, 163, 184, 0.25);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(12px);
        }

        h1 {
            margin-top: 0;
            font-size: 2.2rem;
            letter-spacing: -0.04em;
        }

        .subtitle {
            color: #94a3b8;
            margin-bottom: 28px;
            line-height: 1.6;
        }

        form {
            display: flex;
            gap: 12px;
            margin-bottom: 28px;
        }

        input[type="text"] {
            flex: 1;
            padding: 16px 18px;
            border-radius: 16px;
            border: 1px solid rgba(148, 163, 184, 0.35);
            background: #020617;
            color: #f8fafc;
            font-size: 1rem;
            outline: none;
        }

        input[type="text"]:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.18);
        }

        button {
            padding: 16px 24px;
            border: none;
            border-radius: 16px;
            background: linear-gradient(135deg, #38bdf8, #2563eb);
            color: white;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            filter: brightness(1.08);
        }

        .answer {
            background: rgba(2, 6, 23, 0.75);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 20px;
            padding: 24px;
            line-height: 1.7;
            white-space: pre-wrap;
        }

        .question {
            margin-bottom: 14px;
            color: #93c5fd;
            font-weight: 700;
        }

        .empty {
            color: #94a3b8;
            font-style: italic;
        }

        .footer {
            margin-top: 22px;
            color: #64748b;
            font-size: 0.9rem;
        }

        @media (max-width: 700px) {
            form {
                flex-direction: column;
            }

            button {
                width: 100%;
            }

            .card {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <section class="card">
            <h1>RAG con IA local</h1>

            <p class="subtitle">
                Haz una pregunta sobre los documentos indexados. El sistema recupera contexto desde ChromaDB
                y usa Ollama solo para redactar una respuesta más clara.
            </p>

            <form method="POST">
                <input 
                    type="text" 
                    name="query" 
                    placeholder="Ejemplo: ¿Qué es una vista en MySQL?"
                    value="{{ query }}"
                    autofocus
                    required
                >
                <button type="submit">Preguntar</button>
            </form>

            {% if answer %}
                <div class="question">Pregunta: {{ query }}</div>
                <div class="answer">{{ answer }}</div>
            {% else %}
                <div class="answer empty">
                    Escribe una consulta para comenzar.
                </div>
            {% endif %}

            <div class="footer">
                Modelo de embeddings: {{ embed_model }} · Modelo de redacción: {{ text_model }}
            </div>
        </section>
    </main>
</body>
</html>
"""


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


@app.route("/", methods=["GET", "POST"])
def index():
    query = ""
    answer = ""

    if request.method == "POST":
        query = request.form.get("query", "").strip()

        if query:
            try:
                results, paragraphs = search(query)
                context = build_context(results, paragraphs)
                answer = ask_ai(query, context)

            except Exception as e:
                answer = f"Error al procesar la consulta: {e}"

    return render_template_string(
        HTML,
        query=query,
        answer=answer,
        embed_model=OLLAMA_EMBED_MODEL,
        text_model=OLLAMA_TEXT_MODEL
    )


if __name__ == "__main__":
    app.run(
        host="127.0.0.1",
        port=5000,
        debug=True
    )
