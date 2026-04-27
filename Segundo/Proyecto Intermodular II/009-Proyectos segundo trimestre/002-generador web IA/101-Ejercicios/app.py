from flask import Flask, render_template, request, jsonify
import requests
import urllib3

app = Flask(__name__)

# =========================================================
# AI BACKEND CONFIG (NO ENV VARS)
# =========================================================

# --- Remote API (PHP + Ollama/LLM behind it) ---
API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php"
API_KEY = "TEST_API_KEY_JOCARSA_123"
REMOTE_VERIFY_SSL = False  # ngrok often needs verify=False
REMOTE_TIMEOUT_SECONDS = 300

# Disable SSL warnings because we may use verify=False against ngrok
urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

# --- Local Ollama fallback (optional) ---
OLLAMA_URL = "http://localhost:11434/api/generate"
MODEL_NAME = "qwen2.5-coder:7b"
LOCAL_TIMEOUT_SECONDS = 120

# Choose main backend
USE_REMOTE_AI = True  # set False to use local Ollama as primary


def build_system_instruction() -> str:
    return """
You are an AI that generates HTML and CSS only.

Requirements:
- Return a complete HTML document.
- Include CSS either inline or inside a <style> tag in the <head>.
- Do NOT include any <script> tags or JavaScript code.
- Do NOT include explanations or comments in natural language.
- Just respond with the pure HTML (and embedded CSS).
""".strip()


def html_error_page(msg: str) -> str:
    safe_msg = (msg or "Unknown error").replace("<", "&lt;").replace(">", "&gt;")
    return f"""<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Error</title>
  <style>
    body {{ font-family: system-ui, sans-serif; background:#2b2b2b; color:#f5f5f5; padding:2rem; }}
    .error {{ color:#ff6b6b; font-weight:700; }}
    pre {{ white-space: pre-wrap; background:#1f1f1f; padding:1rem; border-radius:10px; }}
  </style>
</head>
<body>
  <h1>Ooops…</h1>
  <p class="error">No se ha podido generar la página con la IA.</p>
  <pre>{safe_msg}</pre>
</body>
</html>"""


def call_remote_ai(question: str) -> str:
    """
    Calls remote PHP endpoint:
      POST API_URL
      headers: X-API-Key
      form-data: question=...
    Expects JSON: {"answer": "..."}
    """
    resp = requests.post(
        API_URL,
        headers={"X-API-Key": API_KEY},
        data={"question": question},
        timeout=REMOTE_TIMEOUT_SECONDS,
        verify=REMOTE_VERIFY_SSL,
    )

    if resp.status_code != 200:
        raise RuntimeError(f"Remote API HTTP {resp.status_code}: {resp.text}")

    try:
        data = resp.json()
    except Exception:
        raise RuntimeError(f"Remote API returned non-JSON: {resp.text}")

    answer = data.get("answer")
    if not answer:
        raise RuntimeError(f"Remote API JSON has no 'answer': {data}")

    return str(answer).strip()


def call_local_ollama(full_prompt: str) -> str:
    """
    Calls local Ollama /api/generate and returns 'response'
    """
    payload = {
        "model": MODEL_NAME,
        "prompt": full_prompt,
        "stream": False
    }

    resp = requests.post(OLLAMA_URL, json=payload, timeout=LOCAL_TIMEOUT_SECONDS)
    resp.raise_for_status()
    data = resp.json()
    return (data.get("response") or "").strip()


def call_ai(prompt: str) -> str:
    """
    Generates HTML+CSS using:
      - Remote API (primary if USE_REMOTE_AI)
      - Local Ollama fallback (optional)
    """
    system_instruction = build_system_instruction()

    # Keep the structure simple and deterministic
    full_prompt = f"""{system_instruction}

User requirement:
{prompt}
""".strip()

    # For the remote endpoint we send "question" (same semantics as your sample script).
    question = full_prompt

    if USE_REMOTE_AI:
        try:
            return call_remote_ai(question)
        except Exception as e:
            # Fallback to local (if available). If you don't want fallback, re-raise instead.
            try:
                return call_local_ollama(full_prompt)
            except Exception as e2:
                raise RuntimeError(f"Remote failed: {e} | Local fallback failed: {e2}")
    else:
        # Local first, remote fallback
        try:
            return call_local_ollama(full_prompt)
        except Exception as e:
            try:
                return call_remote_ai(question)
            except Exception as e2:
                raise RuntimeError(f"Local failed: {e} | Remote fallback failed: {e2}")


@app.route("/")
def index():
    return render_template("index.html")


@app.route("/generate", methods=["POST"])
def generate():
    data = request.get_json(force=True)
    prompt = (data.get("prompt") or "").strip()
    if not prompt:
        return jsonify({"error": "Empty prompt"}), 400

    try:
        html = call_ai(prompt)
        if not html:
            return jsonify({"html": html_error_page("La IA devolvió una respuesta vacía.")})
        return jsonify({"html": html})
    except Exception as e:
        # Return an HTML error page so the iframe shows something useful
        return jsonify({"html": html_error_page(str(e))})


if __name__ == "__main__":
    # Run Flask dev server
    app.run(host="0.0.0.0", port=5000, debug=True)

