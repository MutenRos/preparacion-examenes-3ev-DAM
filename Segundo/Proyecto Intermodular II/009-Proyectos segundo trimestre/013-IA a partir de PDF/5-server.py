#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
server.py

Servidor Flask que NO carga el modelo.
En su lugar, delega cada consulta en el script externo: 4-inferir.py

- Llama a 4-inferir.py pasando el prompt como argumento.
- Captura stdout como respuesta.
- Aplica throttle básico por IP.
- Sirve / (index.html) desde ./web

Requisitos:
  pip install flask

Uso:
  python3 server.py
"""

import os
import sys
import time
import subprocess
from flask import Flask, request, jsonify, send_from_directory


# -----------------------------
# CONFIG
# -----------------------------
WEB_DIR = os.path.join(os.path.dirname(__file__), "web")

# Ruta absoluta al script de inferencia
INFER_SCRIPT = os.path.join(os.path.dirname(__file__), "4-inferir.py")

# Timeout por petición (segundos)
INFER_TIMEOUT = 120

# Throttle por IP
THROTTLE_SECONDS = 1.0


# -----------------------------
# Validaciones
# -----------------------------
def ensure_infer_script(path: str):
    if not os.path.isfile(path):
        raise FileNotFoundError(f"No existe el script de inferencia: {path}")
    if not os.access(path, os.R_OK):
        raise PermissionError(f"No se puede leer el script de inferencia: {path}")


ensure_infer_script(INFER_SCRIPT)


# -----------------------------
# Flask app
# -----------------------------
app = Flask(__name__, static_folder=WEB_DIR, static_url_path="")


class ChatState:
    last_call = {}  # ip -> timestamp


def run_infer(prompt: str) -> str:
    """
    Ejecuta 4-inferir.py con el prompt como argumento y devuelve stdout.
    """
    # Importante: usar sys.executable para asegurar mismo python/venv
    cmd = [sys.executable, INFER_SCRIPT, prompt]

    try:
        p = subprocess.run(
            cmd,
            stdout=subprocess.PIPE,
            stderr=subprocess.PIPE,
            text=True,
            timeout=INFER_TIMEOUT,
            check=False,
        )
    except subprocess.TimeoutExpired:
        return "Error: timeout ejecutando inferencia."

    # Si el script escribió algo útil en stdout, eso es la respuesta
    out = (p.stdout or "").strip()

    # Si stdout está vacío, intentamos informar algo de stderr
    if not out:
        err = (p.stderr or "").strip()
        if err:
            return f"Error: {err}"
        return "Error: inferencia sin salida."

    # Si hubo stderr pero stdout existe, normalmente lo ignoramos (warnings).
    # Aun así, si quieres depurar, podrías loguearlo aquí.
    return out


@app.get("/")
def home():
    return send_from_directory(WEB_DIR, "index.html")


@app.post("/api/chat")
def api_chat():
    data = request.get_json(silent=True) or {}
    prompt = str(data.get("prompt", "")).strip()

    if not prompt:
        return jsonify({"error": "Prompt vacío"}), 400
    if len(prompt) > 800:
        return jsonify({"error": "Prompt demasiado largo (máx. 800 caracteres)"}), 400

    # throttle mínimo por IP
    ip = request.headers.get("X-Forwarded-For", request.remote_addr) or "unknown"
    now = time.time()
    last = ChatState.last_call.get(ip, 0.0)
    if now - last < THROTTLE_SECONDS:
        return jsonify({"error": "Demasiadas peticiones. Espera un momento."}), 429
    ChatState.last_call[ip] = now

    try:
        answer = run_infer(prompt)
        return jsonify({"answer": answer})
    except Exception as e:
        return jsonify({"error": "Error ejecutando 4-inferir.py", "details": str(e)}), 500


if __name__ == "__main__":
    # host="0.0.0.0" si quieres acceder desde otra máquina
    app.run(host="127.0.0.1", port=8000, debug=False)

