import os
import imaplib
import email
import json
import urllib.request
from email.header import decode_header

# ==========================================================
# CONFIG
# ==========================================================
# IMAP env vars
correo       = os.environ["MI_CORREO_JOCARSA"]
password     = os.environ["MI_CONTRASENA_CORREO_JOCARSA"]
imap_server  = os.environ["MI_SERVIDORIMAP_CORREO_JOCARSA"]

# Ollama local
OLLAMA_URL   = os.environ.get("OLLAMA_URL", "http://localhost:11434/api/generate")
OLLAMA_MODEL = os.environ.get("OLLAMA_MODEL", "qwen2.5:3b-instruct")  # puedes cambiarlo

# Cuántos emails resumir
N_ULTIMOS    = int(os.environ.get("N_ULTIMOS", "5"))

# Límite de caracteres del cuerpo que se envían al modelo (para ir rápido y evitar prompts enormes)
MAX_BODY_CHARS = int(os.environ.get("MAX_BODY_CHARS", "8000"))


# ==========================================================
# HELPERS
# ==========================================================
def decode_mime_header(value: str) -> str:
    if not value:
        return ""
    parts = decode_header(value)
    out = []
    for part, enc in parts:
        if isinstance(part, bytes):
            out.append(part.decode(enc or "utf-8", errors="ignore"))
        else:
            out.append(part)
    return "".join(out)

def extract_text_from_message(msg: email.message.Message) -> str:
    """
    Devuelve texto plano del email.
    - Si hay text/plain, lo usa.
    - Si no, intenta sacar texto de text/html de forma simple.
    """
    texts = []

    if msg.is_multipart():
        for part in msg.walk():
            ctype = part.get_content_type()
            disp = str(part.get("Content-Disposition") or "")
            if "attachment" in disp.lower():
                continue

            if ctype in ("text/plain", "text/html"):
                payload = part.get_payload(decode=True)
                if payload is None:
                    continue
                charset = part.get_content_charset() or "utf-8"
                try:
                    content = payload.decode(charset, errors="ignore")
                except Exception:
                    content = payload.decode("utf-8", errors="ignore")

                if ctype == "text/html":
                    # HTML -> texto (muy simple, sin dependencias externas)
                    content = (
                        content.replace("<br>", "\n")
                               .replace("<br/>", "\n")
                               .replace("<br />", "\n")
                               .replace("</p>", "\n")
                    )
                    import re
                    content = re.sub(r"<script.*?>.*?</script>", "", content, flags=re.S|re.I)
                    content = re.sub(r"<style.*?>.*?</style>", "", content, flags=re.S|re.I)
                    content = re.sub(r"<[^>]+>", " ", content)
                    content = re.sub(r"\s+", " ", content).strip()

                texts.append(content)
    else:
        ctype = msg.get_content_type()
        payload = msg.get_payload(decode=True)
        if payload is not None and ctype in ("text/plain", "text/html"):
            charset = msg.get_content_charset() or "utf-8"
            try:
                content = payload.decode(charset, errors="ignore")
            except Exception:
                content = payload.decode("utf-8", errors="ignore")

            if ctype == "text/html":
                import re
                content = re.sub(r"<script.*?>.*?</script>", "", content, flags=re.S|re.I)
                content = re.sub(r"<style.*?>.*?</style>", "", content, flags=re.S|re.I)
                content = re.sub(r"<[^>]+>", " ", content)
                content = re.sub(r"\s+", " ", content).strip()

            texts.append(content)

    # Preferir el más “text/plain” (normalmente el primero que llega de walk),
    # pero si está vacío, concatenar.
    text = "\n\n".join(t for t in texts if t and t.strip())
    return text.strip()

def ollama_summarize_one_paragraph(subject: str, sender: str, date: str, body: str) -> str:
    """
    Llama a Ollama (local) para devolver un resumen en español (1 párrafo).
    """
    body = (body or "").strip()
    if len(body) > MAX_BODY_CHARS:
        body = body[:MAX_BODY_CHARS] + "…"

    prompt = f"""
Eres un asistente que resume correos electrónicos.
Devuelve SOLO un párrafo en español, sin viñetas, sin títulos, sin saltos de línea y sin código.

Contexto del correo:
- De: {sender}
- Fecha: {date}
- Asunto: {subject}

Contenido:
\"\"\"{body}\"\"\"

Instrucciones:
- Resume el propósito del correo y los puntos clave.
- Si hay petición/acción requerida, indícalo claramente en el mismo párrafo.
- Si faltan datos, no inventes.
""".strip()

    payload = {
        "model": OLLAMA_MODEL,
        "prompt": prompt,
        "stream": False,
        # Puedes ajustar temperatura si quieres:
        # "options": {"temperature": 0.2}
    }

    req = urllib.request.Request(
        OLLAMA_URL,
        data=json.dumps(payload).encode("utf-8"),
        headers={"Content-Type": "application/json"},
        method="POST",
    )

    with urllib.request.urlopen(req, timeout=120) as resp:
        data = json.loads(resp.read().decode("utf-8", errors="ignore"))

    # Ollama /api/generate devuelve "response"
    resumen = (data.get("response") or "").strip()
    # Asegurar 1 párrafo (sin saltos)
    resumen = " ".join(resumen.split())
    return resumen


# ==========================================================
# IMAP: CONECTAR Y LEER ÚLTIMOS N
# ==========================================================
mail = imaplib.IMAP4_SSL(imap_server)
mail.login(correo, password)
mail.select("INBOX")

status, mensajes = mail.search(None, "ALL")
ids = mensajes[0].split()

ultimos_ids = ids[-N_ULTIMOS:]

print(f"\nÚltimos {N_ULTIMOS} correos (con resumen por Ollama: {OLLAMA_MODEL}):\n")

for i in reversed(ultimos_ids):
    status, data = mail.fetch(i, "(RFC822)")
    raw_email = data[0][1]
    msg = email.message_from_bytes(raw_email)

    subject = decode_mime_header(msg.get("Subject", ""))
    sender  = decode_mime_header(msg.get("From", ""))
    date    = decode_mime_header(msg.get("Date", ""))

    body_text = extract_text_from_message(msg)
    if not body_text:
        body_text = "(Sin cuerpo de texto legible o solo adjuntos)"

    # Resumen con Ollama
    try:
        resumen = ollama_summarize_one_paragraph(subject, sender, date, body_text)
    except Exception as e:
        resumen = f"(Error al resumir con Ollama: {e})"

    print("================================")
    print("De:", sender)
    print("Asunto:", subject)
    print("Fecha:", date)
    print("Resumen:", resumen)

mail.close()
mail.logout()
