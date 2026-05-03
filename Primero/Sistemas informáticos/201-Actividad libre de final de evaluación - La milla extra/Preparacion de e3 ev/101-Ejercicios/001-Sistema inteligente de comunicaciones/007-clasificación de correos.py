import os
import re
import imaplib
import email
import json
import urllib.request
from email.header import decode_header
from email.utils import parseaddr

# ==========================================================
# CONFIG
# ==========================================================
correo       = os.environ["MI_CORREO_JOCARSA"]
password     = os.environ["MI_CONTRASENA_CORREO_JOCARSA"]
imap_server  = os.environ["MI_SERVIDORIMAP_CORREO_JOCARSA"]

OLLAMA_URL   = os.environ.get("OLLAMA_URL", "http://localhost:11434/api/generate")
OLLAMA_MODEL = os.environ.get("OLLAMA_MODEL", "qwen2.5:3b-instruct")

N_ULTIMOS      = int(os.environ.get("N_ULTIMOS", "5"))
MAX_BODY_CHARS = int(os.environ.get("MAX_BODY_CHARS", "8000"))

OLLAMA_OPTIONS = {"temperature": 0.1}

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
                    content = (
                        content.replace("<br>", "\n")
                               .replace("<br/>", "\n")
                               .replace("<br />", "\n")
                               .replace("</p>", "\n")
                    )
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
                content = re.sub(r"<script.*?>.*?</script>", "", content, flags=re.S|re.I)
                content = re.sub(r"<style.*?>.*?</style>", "", content, flags=re.S|re.I)
                content = re.sub(r"<[^>]+>", " ", content)
                content = re.sub(r"\s+", " ", content).strip()
            texts.append(content)

    text = "\n\n".join(t for t in texts if t and t.strip())
    return text.strip()

def ollama_call(prompt: str) -> str:
    payload = {
        "model": OLLAMA_MODEL,
        "prompt": prompt,
        "stream": False,
        "options": OLLAMA_OPTIONS
    }
    req = urllib.request.Request(
        OLLAMA_URL,
        data=json.dumps(payload).encode("utf-8"),
        headers={"Content-Type": "application/json"},
        method="POST",
    )
    with urllib.request.urlopen(req, timeout=120) as resp:
        data = json.loads(resp.read().decode("utf-8", errors="ignore"))
    return (data.get("response") or "").strip()

def summarize_one_paragraph(subject: str, sender: str, date: str, body: str) -> str:
    body = (body or "").strip()
    if len(body) > MAX_BODY_CHARS:
        body = body[:MAX_BODY_CHARS] + "…"

    prompt = f"""
Eres un asistente que resume correos electrónicos.
Devuelve SOLO un párrafo en español, sin viñetas, sin títulos, sin saltos de línea y sin código.

Contexto:
- De: {sender}
- Fecha: {date}
- Asunto: {subject}

Contenido:
\"\"\"{body}\"\"\"

Reglas:
- Resume propósito y puntos clave.
- Si hay una acción solicitada, indícala.
- No inventes.
""".strip()

    resumen = ollama_call(prompt)
    return " ".join(resumen.split())

# ==========================================================
# CLASIFICACIÓN (HEURÍSTICA + LLM)
# ==========================================================
AUTO_EMAIL_PATTERNS = [
    r"no-?reply", r"noreply", r"do-?not-?reply",
    r"mailer-daemon", r"postmaster",
    r"newsletter", r"notifications?", r"alertas?", r"jobalerts",
    r"billing", r"factura", r"invoice", r"receipt", r"comunicaciones",
]

AUTO_SUBJECT_PATTERNS = [
    r"unsubscribe|darse de baja|baja",
    r"oferta|promoci[oó]n|descuento|saldo|tarifa",
    r"alerta|newsletter|bolet[ií]n|resumen semanal",
]

PERSONAL_SUBJECT_HINTS = [
    r"^re:", r"^fw:", r"^fwd:",
    r"urgente|importante|por favor|cuando puedas|necesito|¿\?|\\?",
]

PERSONAL_BODY_HINTS = [
    r"un saludo", r"gracias", r"por favor", r"cuando puedas",
    r"ll[aá]mame", r"te llamo", r"podemos", r"quedamos",
    r"adjunto", r"te paso", r"necesito que", r"puedes",
]

def heuristic_classification(sender: str, subject: str, body: str) -> str | None:
    """
    Devuelve:
      - "A" si claramente automático/publicidad
      - "B" si claramente personal/acción
      - None si no concluyente
    """
    name, addr = parseaddr(sender or "")
    addr_l = (addr or "").lower()
    subj_l = (subject or "").lower()
    body_l = (body or "").lower()

    # Claramente automático por remitente
    for p in AUTO_EMAIL_PATTERNS:
        if re.search(p, addr_l):
            return "A"

    # Claramente automático por asunto
    for p in AUTO_SUBJECT_PATTERNS:
        if re.search(p, subj_l):
            return "A"

    # Claramente personal por asunto (re:, urgente, pregunta...)
    for p in PERSONAL_SUBJECT_HINTS:
        if re.search(p, subj_l):
            return "B"

    # Claramente personal por contenido (peticiones, saludo, coordinación)
    hits = 0
    for p in PERSONAL_BODY_HINTS:
        if re.search(p, body_l):
            hits += 1
    if hits >= 2:
        return "B"

    return None

def llm_classify(sender: str, subject: str, date: str, summary: str, body: str) -> dict:
    body = (body or "").strip()
    if len(body) > 2500:
        body = body[:2500] + "…"

    prompt = f"""
Clasifica el correo en una de estas dos etiquetas EXACTAS:
- "automatico_o_publicidad"
- "persona_con_motivacion"

Devuelve SOLO JSON válido (sin texto extra):
{{"label":"automatico_o_publicidad|persona_con_motivacion","reason":"..."}}

Datos:
De: {sender}
Fecha: {date}
Asunto: {subject}
Resumen: {summary}
Contenido: \"\"\"{body}\"\"\"

Criterios:
- "automatico_o_publicidad": no-reply, newsletters, marketing, alertas, recibos genéricos.
- "persona_con_motivacion": alguien escribe personalmente con una petición concreta, coordinación, respuesta humana, urgencia real.
Si dudas, elige "automatico_o_publicidad".
""".strip()

    raw = ollama_call(prompt).strip()
    try:
        obj = json.loads(raw)
    except Exception:
        m = re.search(r"\{.*\}", raw, flags=re.S)
        if m:
            try:
                obj = json.loads(m.group(0))
            except Exception:
                obj = {"label": "automatico_o_publicidad", "reason": "No se pudo parsear JSON; fallback."}
        else:
            obj = {"label": "automatico_o_publicidad", "reason": "No se pudo parsear JSON; fallback."}

    label = (obj.get("label") or "").strip()
    reason = (obj.get("reason") or "").strip()

    # Normalización robusta
    if label not in ("automatico_o_publicidad", "persona_con_motivacion"):
        # intentar mapear si el modelo devolvió otra cosa
        l = label.lower()
        if "persona" in l or "motiv" in l or l == "b":
            label = "persona_con_motivacion"
        else:
            label = "automatico_o_publicidad"

    # Guardarraíl: si el motivo dice claramente "tono personal" / "requiere atención" => B
    reason_l = reason.lower()
    if label == "automatico_o_publicidad" and (
        "tono personal" in reason_l
        or "requiere atención" in reason_l
        or "solicita" in reason_l
        or "coordin" in reason_l
        or "petición" in reason_l
    ):
        label = "persona_con_motivacion"
        reason = reason + " (Corrección: el motivo indica comunicación personal.)"

    return {"label": label, "reason": reason}

# ==========================================================
# MAIN
# ==========================================================
mail = imaplib.IMAP4_SSL(imap_server)
mail.login(correo, password)
mail.select("INBOX")

status, mensajes = mail.search(None, "ALL")
ids = mensajes[0].split()
ultimos_ids = ids[-N_ULTIMOS:]

categoria_A = []
categoria_B = []

print(f"\nClasificando últimos {N_ULTIMOS} correos (Ollama: {OLLAMA_MODEL})...\n")

for i in reversed(ultimos_ids):
    status, data = mail.fetch(i, "(RFC822)")
    raw_email = data[0][1]
    msg = email.message_from_bytes(raw_email)

    subject = decode_mime_header(msg.get("Subject", ""))
    sender  = decode_mime_header(msg.get("From", ""))
    date    = decode_mime_header(msg.get("Date", ""))

    body_text = extract_text_from_message(msg) or "(Sin cuerpo de texto legible o solo adjuntos)"

    # Resumen
    try:
        summary = summarize_one_paragraph(subject, sender, date, body_text)
    except Exception as e:
        summary = f"(Error al resumir con Ollama: {e})"

    # Clasificación heurística -> si no concluye, LLM
    h = heuristic_classification(sender, subject, body_text)
    if h == "A":
        label = "automatico_o_publicidad"
        reason = "Heurística: remitente/asunto indica correo automático o comercial."
    elif h == "B":
        label = "persona_con_motivacion"
        reason = "Heurística: señales claras de correo personal con acción/coord."
    else:
        cls = llm_classify(sender, subject, date, summary, body_text)
        label = cls["label"]
        reason = cls["reason"]

    item = {
        "from": sender,
        "subject": subject,
        "date": date,
        "summary": summary,
        "reason": reason,
    }

    if label == "persona_con_motivacion":
        categoria_B.append(item)
    else:
        categoria_A.append(item)

# Mostrar resultados
print("============================================================")
print("CATEGORÍA A: Automáticos / info general / publicidad")
print("============================================================\n")
for e in categoria_A:
    print("—" * 60)
    print("De:", e["from"])
    print("Asunto:", e["subject"])
    print("Fecha:", e["date"])
    print("Resumen:", e["summary"])
    print("Motivo:", e["reason"])

print("\n============================================================")
print("CATEGORÍA B: Persona con motivación específica (importantes)")
print("============================================================\n")
for e in categoria_B:
    print("—" * 60)
    print("De:", e["from"])
    print("Asunto:", e["subject"])
    print("Fecha:", e["date"])
    print("Resumen:", e["summary"])
    print("Motivo:", e["reason"])

mail.close()
mail.logout()
