# Reporte de proyecto

## Estructura del proyecto

```
/var/www/html/jocarsa-darkorange
├── README.md
├── app.py
├── campanas.db
├── config.json
├── csv_lists
│   ├── base de datos de prueba.csv
│   └── empresas_alumnos_informatica.csv
├── logs.jsonl
├── runs
│   ├── camp_1_1766232699_6671.json
│   ├── camp_2_1766243049_5310.json
│   ├── camp_2_1766243557_5730.json
│   ├── camp_2_1766255510_5163.json
│   ├── camp_3_1766259317_9756.json
│   └── camp_4_1766259511_2038.json
├── templates
│   ├── campaign_new.html
│   ├── campaign_send.html
│   ├── campaign_view.html
│   ├── config.html
│   ├── index.html
│   ├── layout.html
│   └── logs.html
└── uploads
    ├── 1
    ├── 2
    ├── 3
    └── 4
```

## Código (intercalado)

# jocarsa-darkorange
**README.md**
```markdown
# jocarsa-darkorange
```
**app.py**
```python
import os
import csv
import json
import time
import random
import sqlite3
import smtplib
import ssl
import threading
import re
from datetime import datetime, timezone
from email.message import EmailMessage
from pathlib import Path

from flask import (
    Flask, render_template, request, redirect, url_for,
    flash, send_from_directory, abort, jsonify
)

# =========================
# PATHS
# =========================
APP_DIR = os.path.dirname(os.path.abspath(__file__))

CSV_DIR = os.path.join(APP_DIR, "csv_lists")
TEMPLATES_DIR = os.path.join(APP_DIR, "templates")
UPLOADS_DIR = os.path.join(APP_DIR, "uploads")
RUNS_DIR = os.path.join(APP_DIR, "runs")

CONFIG_PATH = os.path.join(APP_DIR, "config.json")
LOGS_PATH = os.path.join(APP_DIR, "logs.jsonl")
DB_PATH = os.path.join(APP_DIR, "campanas.db")

os.makedirs(CSV_DIR, exist_ok=True)
os.makedirs(TEMPLATES_DIR, exist_ok=True)
os.makedirs(UPLOADS_DIR, exist_ok=True)
os.makedirs(RUNS_DIR, exist_ok=True)

app = Flask(__name__, template_folder=TEMPLATES_DIR)
app.secret_key = os.environ.get("FLASK_SECRET_KEY", "cambia-esto-en-produccion")


# =========================
# CONFIG
# =========================
DEFAULT_CONFIG = {
    "smtp": {
        "host": "smtp.example.com",
        "port": 587,
        "usuario": "user@example.com",
        "password": "",
        "use_starttls": True,
        "use_ssl": False,
        "from_email": "user@example.com",
        "from_name": "jocarsa"
    },
    "delay_seconds": {"min": 2, "max": 6},
    "seguridad": {"max_receptores_por_campana": 2000, "max_tamano_adjuntos_mb": 20}
}


def guardar_config(cfg: dict) -> None:
    with open(CONFIG_PATH, "w", encoding="utf-8") as f:
        json.dump(cfg, f, indent=2, ensure_ascii=False)


def cargar_config() -> dict:
    if not os.path.exists(CONFIG_PATH):
        guardar_config(DEFAULT_CONFIG)
        return DEFAULT_CONFIG.copy()
    try:
        with open(CONFIG_PATH, "r", encoding="utf-8") as f:
            data = json.load(f)
        merged = DEFAULT_CONFIG.copy()
        merged["smtp"] = {**DEFAULT_CONFIG["smtp"], **data.get("smtp", {})}
        merged["delay_seconds"] = {**DEFAULT_CONFIG["delay_seconds"], **data.get("delay_seconds", {})}
        merged["seguridad"] = {**DEFAULT_CONFIG["seguridad"], **data.get("seguridad", {})}
        return merged
    except Exception:
        return DEFAULT_CONFIG.copy()


# =========================
# LOGS JSONL (se mantienen tal cual internamente)
# =========================
def log_evento(evento: dict) -> None:
    evento = dict(evento)
    evento.setdefault("ts", datetime.now(timezone.utc).isoformat())
    with open(LOGS_PATH, "a", encoding="utf-8") as f:
        f.write(json.dumps(evento, ensure_ascii=False) + "\n")


def leer_logs(limit: int = 5000):
    if not os.path.exists(LOGS_PATH):
        return []
    rows = []
    with open(LOGS_PATH, "r", encoding="utf-8") as f:
        for line in f:
            line = line.strip()
            if not line:
                continue
            try:
                rows.append(json.loads(line))
            except Exception:
                continue
    if limit and len(rows) > limit:
        rows = rows[-limit:]
    rows.reverse()
    return rows


def log_match(log: dict, q: str) -> bool:
    if not q:
        return True
    ql = q.lower()
    blob = json.dumps(log, ensure_ascii=False).lower()
    return ql in blob


# =========================
# SQLITE
# =========================
def db():
    conn = sqlite3.connect(DB_PATH)
    conn.row_factory = sqlite3.Row
    return conn


def table_columns(conn: sqlite3.Connection, table: str) -> set[str]:
    cols = set()
    try:
        cur = conn.execute(f"PRAGMA table_info({table})")
        for r in cur.fetchall():
            cols.add(str(r["name"]))
    except Exception:
        return set()
    return cols


def ensure_column(conn: sqlite3.Connection, table: str, column: str, col_def_sql: str):
    cols = table_columns(conn, table)
    if column in cols:
        return
    try:
        conn.execute(f"ALTER TABLE {table} ADD COLUMN {col_def_sql}")
        conn.commit()
    except Exception:
        log_evento({"type": "db_migrate_warn", "table": table, "column": column})


def init_db():
    conn = db()

    conn.execute("""
        CREATE TABLE IF NOT EXISTS campanas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL,
            csv_file TEXT NOT NULL,
            asunto TEXT NOT NULL,
            cuerpo_html TEXT NOT NULL,
            creado_en TEXT NOT NULL DEFAULT (datetime('now')),
            estado TEXT NOT NULL DEFAULT 'borrador'
        )
    """)

    conn.execute("""
        CREATE TABLE IF NOT EXISTS envios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            campana_id INTEGER NOT NULL,
            email TEXT NOT NULL,
            estado TEXT NOT NULL,
            error TEXT,
            enviado_en TEXT NOT NULL DEFAULT (datetime('now')),
            UNIQUE(campana_id, email),
            FOREIGN KEY(campana_id) REFERENCES campanas(id)
        )
    """)

    conn.execute("""
        CREATE TABLE IF NOT EXISTS adjuntos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            campana_id INTEGER NOT NULL,
            filename TEXT NOT NULL,
            stored_path TEXT NOT NULL,
            subido_en TEXT NOT NULL DEFAULT (datetime('now')),
            FOREIGN KEY(campana_id) REFERENCES campanas(id)
        )
    """)

    conn.commit()

    # migraciones suaves
    ensure_column(conn, "campanas", "cuerpo_html", "cuerpo_html TEXT NOT NULL DEFAULT ''")
    ensure_column(conn, "campanas", "estado", "estado TEXT NOT NULL DEFAULT 'borrador'")
    ensure_column(conn, "campanas", "creado_en", "creado_en TEXT NOT NULL DEFAULT (datetime('now'))")
    ensure_column(conn, "envios", "error", "error TEXT")
    ensure_column(conn, "envios", "enviado_en", "enviado_en TEXT NOT NULL DEFAULT (datetime('now'))")
    ensure_column(conn, "adjuntos", "subido_en", "subido_en TEXT NOT NULL DEFAULT (datetime('now'))")

    conn.close()


init_db()


@app.before_request
def _ensure_db_each_request():
    init_db()


# =========================
# CSV
# =========================
def listar_csv():
    return sorted([f for f in os.listdir(CSV_DIR) if f.lower().endswith(".csv")])


def cargar_contactos_csv(filename: str):
    path = os.path.join(CSV_DIR, filename)
    if not os.path.exists(path):
        raise FileNotFoundError("CSV no encontrado")

    contactos = []
    with open(path, "r", encoding="utf-8", newline="") as f:
        sample = f.read(4096)
        f.seek(0)
        try:
            dialect = csv.Sniffer().sniff(sample, delimiters=",;\t|")
        except Exception:
            dialect = csv.get_dialect("excel")

        reader = csv.DictReader(f, dialect=dialect)
        if not reader.fieldnames:
            raise ValueError("CSV sin cabeceras")

        field_map = {h.lower().strip(): h for h in reader.fieldnames}
        if "email" not in field_map:
            raise ValueError("El CSV debe contener una columna llamada 'email'")

        email_col = field_map["email"]

        for row in reader:
            email = (row.get(email_col) or "").strip()
            if not email:
                continue
            contactos.append({"email": email, "fields": row})

    return contactos


# =========================
# TEMPLATE {{columna}}
# =========================
TPL_RE = re.compile(r"\{\{\s*([a-zA-Z0-9_\-\.]+)\s*\}\}")


def render_tpl(text: str, fields: dict) -> str:
    def repl(m):
        key = m.group(1)
        if key in fields and fields[key] is not None:
            return str(fields[key])
        # case-insensitive fallback
        for k, v in fields.items():
            if str(k).lower() == key.lower():
                return "" if v is None else str(v)
        return ""
    return TPL_RE.sub(repl, text or "")


# =========================
# EMAIL HTML NORMALIZATION (evita “doble interlineado” por <p>)
# =========================
def wrap_email_html(html: str) -> str:
    # Reset estable para clientes de correo (Gmail/Outlook/Apple Mail)
    # Objetivo: controlar line-height y márgenes por defecto de <p>.
    return f"""<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body {{
      margin:0 !important;
      padding:0 !important;
      line-height:1.35 !important;
      font-family: Arial, Helvetica, sans-serif !important;
      color:#0f172a;
    }}
    p {{
      margin: 0 0 10px 0 !important;
      line-height:1.35 !important;
    }}
    div, span, td, th {{
      line-height:1.35 !important;
    }}
    ul, ol {{
      margin: 0 0 10px 18px !important;
      padding: 0 !important;
      line-height:1.35 !important;
    }}
    li {{
      margin: 0 0 6px 0 !important;
      line-height:1.35 !important;
    }}
    img {{
      max-width:100% !important;
      height:auto !important;
    }}
  </style>
</head>
<body>
{html or ""}
</body>
</html>"""


# =========================
# SMTP: SOLO HTML + adjuntos
# =========================
def enviar_email_html(cfg: dict, to_email: str, asunto: str, body_html: str, adjuntos_paths: list[str]):
    smtp_cfg = cfg["smtp"]

    msg = EmailMessage()
    msg["Subject"] = asunto

    from_name = (smtp_cfg.get("from_name") or "").strip()
    from_email = (smtp_cfg.get("from_email") or smtp_cfg.get("usuario") or "").strip()
    msg["From"] = f"{from_name} <{from_email}>" if from_name else from_email
    msg["To"] = to_email

    # SOLO HTML (normalizado para evitar márgenes/line-height excesivos)
    msg.add_alternative(wrap_email_html(body_html), subtype="html")

    # Adjuntos
    for p in adjuntos_paths:
        pth = Path(p)
        if not pth.exists() or not pth.is_file():
            continue
        data = pth.read_bytes()
        msg.add_attachment(data, maintype="application", subtype="octet-stream", filename=pth.name)

    host = smtp_cfg["host"]
    port = int(smtp_cfg["port"])
    usuario = smtp_cfg["usuario"]
    password = smtp_cfg["password"]
    use_ssl = bool(smtp_cfg.get("use_ssl"))
    use_starttls = bool(smtp_cfg.get("use_starttls"))

    if use_ssl:
        context = ssl.create_default_context()
        with smtplib.SMTP_SSL(host, port, context=context, timeout=30) as server:
            server.login(usuario, password)
            server.send_message(msg)
    else:
        with smtplib.SMTP(host, port, timeout=30) as server:
            server.ehlo()
            if use_starttls:
                context = ssl.create_default_context()
                server.starttls(context=context)
                server.ehlo()
            server.login(usuario, password)
            server.send_message(msg)


# =========================
# HELPERS CAMPANAS
# =========================
def campana_por_id(campana_id: int):
    conn = db()
    row = conn.execute("SELECT * FROM campanas WHERE id = ?", (campana_id,)).fetchone()
    conn.close()
    return row


def adjuntos_de_campana(campana_id: int):
    conn = db()
    rows = conn.execute("SELECT * FROM adjuntos WHERE campana_id = ? ORDER BY id DESC", (campana_id,)).fetchall()
    conn.close()
    return rows


def email_ya_enviado(campana_id: int, email: str) -> bool:
    conn = db()
    row = conn.execute(
        "SELECT 1 FROM envios WHERE campana_id = ? AND email = ? AND estado = 'enviado' LIMIT 1",
        (campana_id, email)
    ).fetchone()
    conn.close()
    return row is not None


def registrar_envio(campana_id: int, email: str, estado: str, error: str | None = None):
    conn = db()
    try:
        conn.execute("""
            INSERT INTO envios (campana_id, email, estado, error)
            VALUES (?, ?, ?, ?)
            ON CONFLICT(campana_id, email) DO UPDATE SET
              estado=excluded.estado,
              error=excluded.error,
              enviado_en=datetime('now')
        """, (campana_id, email, estado, error))
        conn.commit()
    finally:
        conn.close()


def resumen_envios(campana_id: int):
    conn = db()
    total = conn.execute("SELECT COUNT(*) c FROM envios WHERE campana_id = ?", (campana_id,)).fetchone()["c"]
    enviados = conn.execute("SELECT COUNT(*) c FROM envios WHERE campana_id = ? AND estado='enviado'", (campana_id,)).fetchone()["c"]
    fallidos = conn.execute("SELECT COUNT(*) c FROM envios WHERE campana_id = ? AND estado='fallido'", (campana_id,)).fetchone()["c"]
    saltados = conn.execute("SELECT COUNT(*) c FROM envios WHERE campana_id = ? AND estado='saltado'", (campana_id,)).fetchone()["c"]
    conn.close()
    return {"total": total, "enviados": enviados, "fallidos": fallidos, "saltados": saltados}


# =========================
# RUNS (progreso en vivo)
# =========================
RUN_LOCK = threading.Lock()
ACTIVE_RUNS: dict[str, threading.Thread] = {}


def run_path(run_id: str) -> str:
    return os.path.join(RUNS_DIR, f"{run_id}.json")


def run_load(run_id: str) -> dict:
    p = run_path(run_id)
    if not os.path.exists(p):
        return {}
    try:
        with open(p, "r", encoding="utf-8") as f:
            return json.load(f)
    except Exception:
        return {}


def run_save(run_id: str, data: dict) -> None:
    p = run_path(run_id)
    tmp = p + ".tmp"
    with open(tmp, "w", encoding="utf-8") as f:
        json.dump(data, f, ensure_ascii=False, indent=2)
    os.replace(tmp, p)


def run_append_line(state: dict, line: str, max_lines: int = 250):
    lines = state.get("log_lines") or []
    lines.append(line)
    if len(lines) > max_lines:
        lines = lines[-max_lines:]
    state["log_lines"] = lines


def seconds_to_hhmmss(s: float) -> str:
    s = max(0, int(s))
    h = s // 3600
    m = (s % 3600) // 60
    sec = s % 60
    if h > 0:
        return f"{h:02d}:{m:02d}:{sec:02d}"
    return f"{m:02d}:{sec:02d}"


def start_run_thread(campana_id: int, modo: str) -> str:
    run_id = f"camp_{campana_id}_{int(time.time())}_{random.randint(1000,9999)}"

    state = {
        "run_id": run_id,
        "campana_id": campana_id,
        "modo": modo,
        "status": "running",            # running|done|error
        "started_at": time.time(),
        "finished_at": None,
        "total": 0,
        "processed": 0,
        "enviados": 0,
        "fallidos": 0,
        "saltados": 0,
        "current_email": None,
        "current_index": 0,
        "last_error": None,
        "eta_seconds": None,
        "elapsed_seconds": 0,
        "avg_per_email": None,
        "log_lines": []
    }
    run_append_line(state, "Inicio de campaña. Preparando lista de contactos...")
    run_save(run_id, state)

    t = threading.Thread(target=_run_worker, args=(run_id, campana_id, modo), daemon=True)
    with RUN_LOCK:
        ACTIVE_RUNS[run_id] = t
    t.start()
    return run_id


def _run_worker(run_id: str, campana_id: int, modo: str):
    try:
        cfg = cargar_config()
        delay_min = max(0, int(cfg["delay_seconds"]["min"]))
        delay_max = max(delay_min, int(cfg["delay_seconds"]["max"]))
        forzar = (modo == "forzar")

        camp = campana_por_id(campana_id)
        if not camp:
            state = run_load(run_id)
            state["status"] = "error"
            state["last_error"] = "Campaña no encontrada."
            run_append_line(state, "ERROR: Campaña no encontrada.")
            state["finished_at"] = time.time()
            run_save(run_id, state)
            return

        try:
            contactos = cargar_contactos_csv(camp["csv_file"])
        except Exception as e:
            state = run_load(run_id)
            state["status"] = "error"
            state["last_error"] = f"Error cargando CSV: {e}"
            run_append_line(state, f"ERROR CSV: {e}")
            state["finished_at"] = time.time()
            run_save(run_id, state)
            return

        max_r = int(cfg["seguridad"]["max_receptores_por_campana"])
        if len(contactos) > max_r:
            state = run_load(run_id)
            state["status"] = "error"
            state["last_error"] = f"Seguridad: receptores ({len(contactos)}) supera max ({max_r})."
            run_append_line(state, "ERROR: excede límite de seguridad de receptores.")
            state["finished_at"] = time.time()
            run_save(run_id, state)
            return

        atts = adjuntos_de_campana(campana_id)
        adjuntos_paths = [a["stored_path"] for a in atts]

        conn = db()
        conn.execute("UPDATE campanas SET estado='enviando' WHERE id=?", (campana_id,))
        conn.commit()
        conn.close()

        state = run_load(run_id)
        state["total"] = len(contactos)
        run_append_line(state, f"Contactos cargados: {len(contactos)}. Modo: {'FORZAR' if forzar else 'REANUDAR'}.")
        if adjuntos_paths:
            run_append_line(state, f"Adjuntos: {len(adjuntos_paths)} archivo(s).")
        run_save(run_id, state)

        log_evento({
            "type": "campana_envio_inicio",
            "campana_id": campana_id,
            "run_id": run_id,
            "csv_file": camp["csv_file"],
            "receptores": len(contactos),
            "modo": "forzar" if forzar else "reanudar",
            "delay_min": delay_min,
            "delay_max": delay_max
        })

        last_tick = time.time()
        started = state["started_at"]

        for idx, c in enumerate(contactos, start=1):
            email = c["email"]
            fields = c["fields"]

            state = run_load(run_id)
            state["current_email"] = email
            state["current_index"] = idx
            run_save(run_id, state)

            if (not forzar) and email_ya_enviado(campana_id, email):
                registrar_envio(campana_id, email, "saltado", None)
                state = run_load(run_id)
                state["saltados"] += 1
                state["processed"] = idx
                run_append_line(state, f"[{idx}/{len(contactos)}] Saltado (ya enviado): {email}")
                _update_eta(state, started)
                run_save(run_id, state)

                log_evento({
                    "type": "email_saltado",
                    "campana_id": campana_id,
                    "run_id": run_id,
                    "index": idx,
                    "to": email,
                    "razon": "ya_enviado"
                })
                continue

            asunto = render_tpl(camp["asunto"], fields)
            cuerpo_html = render_tpl(camp["cuerpo_html"], fields)

            t0 = time.time()
            try:
                enviar_email_html(cfg, email, asunto, cuerpo_html, adjuntos_paths)
                dt_ms = int((time.time() - t0) * 1000)

                registrar_envio(campana_id, email, "enviado", None)
                state = run_load(run_id)
                state["enviados"] += 1
                state["processed"] = idx
                run_append_line(state, f"[{idx}/{len(contactos)}] Enviado: {email} ({dt_ms} ms)")
                _update_eta(state, started)
                run_save(run_id, state)

                log_evento({
                    "type": "email_enviado",
                    "campana_id": campana_id,
                    "run_id": run_id,
                    "index": idx,
                    "to": email,
                    "duracion_ms": dt_ms
                })
            except Exception as e:
                dt_ms = int((time.time() - t0) * 1000)

                registrar_envio(campana_id, email, "fallido", str(e))
                state = run_load(run_id)
                state["fallidos"] += 1
                state["processed"] = idx
                state["last_error"] = str(e)
                run_append_line(state, f"[{idx}/{len(contactos)}] FALLÓ: {email} ({dt_ms} ms) -> {e}")
                _update_eta(state, started)
                run_save(run_id, state)

                log_evento({
                    "type": "email_fallido",
                    "campana_id": campana_id,
                    "run_id": run_id,
                    "index": idx,
                    "to": email,
                    "duracion_ms": dt_ms,
                    "error": str(e)
                })

            if idx < len(contactos):
                delay = random.randint(delay_min, delay_max) if delay_max > 0 else 0
                state = run_load(run_id)
                run_append_line(state, f"Esperando {delay}s...")
                run_save(run_id, state)
                log_evento({"type": "delay", "campana_id": campana_id, "run_id": run_id, "index": idx, "segundos": delay})
                time.sleep(delay)

            if time.time() - last_tick > 1.0:
                state = run_load(run_id)
                _update_eta(state, started)
                run_save(run_id, state)
                last_tick = time.time()

        conn = db()
        conn.execute("UPDATE campanas SET estado='finalizada' WHERE id=?", (campana_id,))
        conn.commit()
        conn.close()

        state = run_load(run_id)
        state["status"] = "done"
        state["finished_at"] = time.time()
        state["current_email"] = None
        run_append_line(state, "Finalizado.")
        _update_eta(state, started, force_done=True)
        run_save(run_id, state)

        log_evento({
            "type": "campana_envio_fin",
            "campana_id": campana_id,
            "run_id": run_id,
            "enviados": state.get("enviados", 0),
            "fallidos": state.get("fallidos", 0),
            "saltados": state.get("saltados", 0)
        })
    finally:
        with RUN_LOCK:
            ACTIVE_RUNS.pop(run_id, None)


def _update_eta(state: dict, started_at: float, force_done: bool = False):
    total = int(state.get("total") or 0)
    processed = int(state.get("processed") or 0)

    elapsed = time.time() - started_at
    state["elapsed_seconds"] = int(elapsed)

    if force_done:
        state["eta_seconds"] = 0
        state["avg_per_email"] = (elapsed / processed) if processed > 0 else None
        return

    if processed <= 0:
        state["eta_seconds"] = None
        state["avg_per_email"] = None
        return

    avg = elapsed / processed
    remaining = max(0, total - processed)
    eta = int(avg * remaining)

    state["avg_per_email"] = avg
    state["eta_seconds"] = eta


# =========================
# ROUTES
# =========================
@app.route("/", methods=["GET"])
def index():
    conn = db()
    campanas = conn.execute("SELECT * FROM campanas ORDER BY id DESC").fetchall()
    conn.close()
    return render_template("index.html", campañas=campanas, csv_files=listar_csv(), cfg=cargar_config())


@app.route("/config", methods=["GET", "POST"])
def config():
    cfg = cargar_config()
    if request.method == "POST":
        cfg["smtp"]["host"] = (request.form.get("host") or "").strip()
        cfg["smtp"]["port"] = int(request.form.get("port") or 587)
        cfg["smtp"]["usuario"] = (request.form.get("usuario") or "").strip()
        cfg["smtp"]["password"] = (request.form.get("password") or "")
        cfg["smtp"]["from_email"] = (request.form.get("from_email") or cfg["smtp"]["usuario"]).strip()
        cfg["smtp"]["from_name"] = (request.form.get("from_name") or "").strip()
        cfg["smtp"]["use_starttls"] = bool(request.form.get("use_starttls"))
        cfg["smtp"]["use_ssl"] = bool(request.form.get("use_ssl"))

        cfg["delay_seconds"]["min"] = int(request.form.get("delay_min") or 0)
        cfg["delay_seconds"]["max"] = int(request.form.get("delay_max") or 0)

        cfg["seguridad"]["max_receptores_por_campana"] = int(request.form.get("max_receptores_por_campana") or 2000)
        cfg["seguridad"]["max_tamano_adjuntos_mb"] = int(request.form.get("max_tamano_adjuntos_mb") or 20)

        errores = []
        if not cfg["smtp"]["host"]:
            errores.append("El host SMTP es obligatorio.")
        if not cfg["smtp"]["usuario"]:
            errores.append("El usuario SMTP es obligatorio.")
        if cfg["smtp"]["port"] <= 0:
            errores.append("El puerto SMTP debe ser > 0.")
        if cfg["delay_seconds"]["max"] < cfg["delay_seconds"]["min"]:
            errores.append("El delay máximo debe ser >= al mínimo.")
        if cfg["seguridad"]["max_tamano_adjuntos_mb"] <= 0:
            errores.append("El máximo de adjuntos (MB) debe ser > 0.")

        if errores:
            for e in errores:
                flash(e, "error")
            return redirect(url_for("config"))

        guardar_config(cfg)
        log_evento({"type": "config_actualizada"})
        flash("Configuración guardada.", "success")
        return redirect(url_for("config"))

    return render_template("config.html", cfg=cfg)


@app.route("/logs", methods=["GET"])
def logs():
    q = (request.args.get("q") or "").strip()
    tipo = (request.args.get("type") or "").strip()

    rows = leer_logs(limit=5000)
    if q:
        rows = [r for r in rows if log_match(r, q)]
    if tipo:
        rows = [r for r in rows if str(r.get("type", "")) == tipo]

    all_rows = leer_logs(limit=5000)
    tipos = sorted({str(r.get("type", "")) for r in all_rows if r.get("type")})
    return render_template("logs.html", rows=rows, q=q, type_filter=tipo, tipos=tipos)


@app.route("/campanas/nueva", methods=["GET", "POST"])
def campana_nueva():
    csv_files = listar_csv()
    if request.method == "POST":
        nombre = (request.form.get("nombre") or "").strip()
        csv_file = (request.form.get("csv_file") or "").strip()
        asunto = (request.form.get("asunto") or "").strip()
        cuerpo_html = (request.form.get("cuerpo_html") or "").strip()

        if not nombre:
            flash("El nombre de la campaña es obligatorio.", "error")
            return redirect(url_for("campana_nueva"))
        if not csv_file or csv_file not in csv_files:
            flash("Selecciona un CSV válido.", "error")
            return redirect(url_for("campana_nueva"))
        if not asunto:
            flash("El asunto es obligatorio.", "error")
            return redirect(url_for("campana_nueva"))
        if not cuerpo_html:
            flash("El cuerpo HTML es obligatorio.", "error")
            return redirect(url_for("campana_nueva"))

        cfg = cargar_config()
        try:
            contactos = cargar_contactos_csv(csv_file)
        except Exception as e:
            flash(f"Error en CSV: {e}", "error")
            return redirect(url_for("campana_nueva"))

        max_r = int(cfg["seguridad"]["max_receptores_por_campana"])
        if len(contactos) > max_r:
            flash(f"Límite de seguridad: {len(contactos)} receptores supera el máximo ({max_r}).", "error")
            log_evento({"type": "campana_bloqueada", "csv_file": csv_file, "receptores": len(contactos), "max": max_r})
            return redirect(url_for("campana_nueva"))

        conn = db()
        cur = conn.execute("""
            INSERT INTO campanas (nombre, csv_file, asunto, cuerpo_html, estado)
            VALUES (?, ?, ?, ?, 'borrador')
        """, (nombre, csv_file, asunto, cuerpo_html))
        campana_id = cur.lastrowid
        conn.commit()
        conn.close()

        os.makedirs(os.path.join(UPLOADS_DIR, str(campana_id)), exist_ok=True)
        log_evento({"type": "campana_creada", "campana_id": campana_id, "nombre": nombre, "csv_file": csv_file})
        flash("Campaña creada.", "success")
        return redirect(url_for("campana_ver", campana_id=campana_id))

    return render_template("campaign_new.html", csv_files=csv_files)


@app.route("/campanas/<int:campana_id>", methods=["GET"])
def campana_ver(campana_id: int):
    camp = campana_por_id(campana_id)
    if not camp:
        abort(404)

    cfg = cargar_config()
    try:
        total_contactos = len(cargar_contactos_csv(camp["csv_file"]))
    except Exception:
        total_contactos = 0

    resumen = resumen_envios(campana_id)
    atts = adjuntos_de_campana(campana_id)

    return render_template(
        "campaign_view.html",
        camp=camp,
        cfg=cfg,
        total_contactos=total_contactos,
        resumen=resumen,
        adjuntos=atts
    )


@app.route("/campanas/<int:campana_id>/subir-adjuntos", methods=["POST"])
def campana_subir_adjuntos(campana_id: int):
    camp = campana_por_id(campana_id)
    if not camp:
        abort(404)

    cfg = cargar_config()
    max_mb = int(cfg["seguridad"]["max_tamano_adjuntos_mb"])
    max_bytes = max_mb * 1024 * 1024

    files = request.files.getlist("adjuntos")
    if not files or (len(files) == 1 and not files[0].filename):
        flash("No se seleccionaron archivos.", "error")
        return redirect(url_for("campana_ver", campana_id=campana_id))

    carpeta = os.path.join(UPLOADS_DIR, str(campana_id))
    os.makedirs(carpeta, exist_ok=True)

    subidos = 0
    for f in files:
        if not f.filename:
            continue
        data = f.read()
        if len(data) > max_bytes:
            flash(f"Adjunto '{f.filename}' supera el máximo permitido ({max_mb} MB).", "error")
            continue

        safe_name = os.path.basename(f.filename)
        stored_path = os.path.join(carpeta, safe_name)
        if os.path.exists(stored_path):
            base, ext = os.path.splitext(safe_name)
            stored_path = os.path.join(carpeta, f"{base}_{int(time.time())}{ext}")

        with open(stored_path, "wb") as out:
            out.write(data)

        conn = db()
        conn.execute(
            "INSERT INTO adjuntos (campana_id, filename, stored_path) VALUES (?, ?, ?)",
            (campana_id, os.path.basename(stored_path), stored_path)
        )
        conn.commit()
        conn.close()

        subidos += 1

    if subidos:
        log_evento({"type": "adjuntos_subidos", "campana_id": campana_id, "cantidad": subidos})
        flash(f"Adjuntos subidos: {subidos}.", "success")
    return redirect(url_for("campana_ver", campana_id=campana_id))


@app.route("/campanas/<int:campana_id>/descargar-adjunto/<int:adjunto_id>", methods=["GET"])
def campana_descargar_adjunto(campana_id: int, adjunto_id: int):
    camp = campana_por_id(campana_id)
    if not camp:
        abort(404)

    conn = db()
    a = conn.execute("SELECT * FROM adjuntos WHERE id=? AND campana_id=?", (adjunto_id, campana_id)).fetchone()
    conn.close()
    if not a:
        abort(404)

    p = Path(a["stored_path"])
    if not p.exists():
        abort(404)
    return send_from_directory(p.parent, p.name, as_attachment=True)


@app.route("/campanas/<int:campana_id>/enviar-ui", methods=["POST"])
def campana_enviar_ui(campana_id: int):
    camp = campana_por_id(campana_id)
    if not camp:
        abort(404)

    modo = (request.form.get("modo") or "reanudar").strip()
    if modo not in ("reanudar", "forzar"):
        modo = "reanudar"

    run_id = start_run_thread(campana_id, modo)
    return redirect(url_for("campana_reporte", campana_id=campana_id, run_id=run_id))


@app.route("/campanas/<int:campana_id>/reporte/<run_id>", methods=["GET"])
def campana_reporte(campana_id: int, run_id: str):
    camp = campana_por_id(campana_id)
    if not camp:
        abort(404)
    cfg = cargar_config()
    return render_template("campaign_send.html", camp=camp, cfg=cfg, run_id=run_id)


@app.route("/api/progreso/<run_id>", methods=["GET"])
def api_progreso(run_id: str):
    state = run_load(run_id)
    if not state:
        return jsonify({"ok": False, "error": "run_id no encontrado"}), 404

    total = int(state.get("total") or 0)
    processed = int(state.get("processed") or 0)
    pct = int((processed / total) * 100) if total > 0 else 0

    elapsed = int(state.get("elapsed_seconds") or 0)
    eta = state.get("eta_seconds", None)
    eta_int = int(eta) if isinstance(eta, int) else None

    ui = {
        "ok": True,
        "run_id": run_id,
        "campana_id": state.get("campana_id"),
        "status": state.get("status"),
        "modo": state.get("modo"),
        "total": total,
        "processed": processed,
        "pct": pct,
        "enviados": int(state.get("enviados") or 0),
        "fallidos": int(state.get("fallidos") or 0),
        "saltados": int(state.get("saltados") or 0),
        "current_email": state.get("current_email"),
        "current_index": int(state.get("current_index") or 0),
        "elapsed_hhmmss": seconds_to_hhmmss(elapsed),
        "eta_hhmmss": (seconds_to_hhmmss(eta_int) if eta_int is not None else None),
        "last_error": state.get("last_error"),
        "log_lines": state.get("log_lines") or []
    }
    return jsonify(ui)


if __name__ == "__main__":
    app.run(host="127.0.0.1", port=5000, debug=True)


```
**config.json**
```json
{
  "smtp": {
    "host": "smtp.ionos.es",
    "port": 587,
    "usuario": "info@jocarsa.com",
    "password": "******",
    "use_starttls": true,
    "use_ssl": false,
    "from_email": "python@jocarsa.com",
    "from_name": "Jose Vicente Carratala"
  },
  "delay_seconds": {
    "min": 2,
    "max": 6
  },
  "seguridad": {
    "max_receptores_por_campana": 2000,
    "max_tamano_adjuntos_mb": 20,
    "max_receptores_por_campaña": 2000,
    "max_tamaño_adjuntos_mb": 20
  }
}
```
## csv_lists
## runs
**camp_1_1766232699_6671.json**
```json
{
  "run_id": "camp_1_1766232699_6671",
  "campana_id": 1,
  "modo": "forzar",
  "status": "done",
  "started_at": 1766232699.9949048,
  "finished_at": 1766232701.2038126,
  "total": 1,
  "processed": 1,
  "enviados": 1,
  "fallidos": 0,
  "saltados": 0,
  "current_email": null,
  "current_index": 1,
  "last_error": null,
  "eta_seconds": 0,
  "elapsed_seconds": 1,
  "avg_per_email": 1.2089135646820068,
  "log_lines": [
    "Inicio de campaña. Preparando lista de contactos...",
    "Contactos cargados: 1. Modo: FORZAR.",
    "[1/1] Enviado: jocarsa2@gmail.com (1189 ms)",
    "Finalizado."
  ]
}
```
**camp_2_1766243049_5310.json**
```json
{
  "run_id": "camp_2_1766243049_5310",
  "campana_id": 2,
  "modo": "reanudar",
  "status": "done",
  "started_at": 1766243049.7100394,
  "finished_at": 1766243050.6019855,
  "total": 1,
  "processed": 1,
  "enviados": 1,
  "fallidos": 0,
  "saltados": 0,
  "current_email": null,
  "current_index": 1,
  "last_error": null,
  "eta_seconds": 0,
  "elapsed_seconds": 0,
  "avg_per_email": 0.8919486999511719,
  "log_lines": [
    "Inicio de campaña. Preparando lista de contactos...",
    "Contactos cargados: 1. Modo: REANUDAR.",
    "[1/1] Enviado: jocarsa2@gmail.com (875 ms)",
    "Finalizado."
  ]
}
```
**camp_2_1766243557_5730.json**
```json
{
  "run_id": "camp_2_1766243557_5730",
  "campana_id": 2,
  "modo": "forzar",
  "status": "done",
  "started_at": 1766243557.7903104,
  "finished_at": 1766243558.7466073,
  "total": 1,
  "processed": 1,
  "enviados": 1,
  "fallidos": 0,
  "saltados": 0,
  "current_email": null,
  "current_index": 1,
  "last_error": null,
  "eta_seconds": 0,
  "elapsed_seconds": 0,
  "avg_per_email": 0.9563038349151611,
  "log_lines": [
    "Inicio de campaña. Preparando lista de contactos...",
    "Contactos cargados: 1. Modo: FORZAR.",
    "[1/1] Enviado: jocarsa2@gmail.com (942 ms)",
    "Finalizado."
  ]
}
```
**camp_2_1766255510_5163.json**
```json
{
  "run_id": "camp_2_1766255510_5163",
  "campana_id": 2,
  "modo": "forzar",
  "status": "done",
  "started_at": 1766255510.7716606,
  "finished_at": 1766255511.7645836,
  "total": 1,
  "processed": 1,
  "enviados": 1,
  "fallidos": 0,
  "saltados": 0,
  "current_email": null,
  "current_index": 1,
  "last_error": null,
  "eta_seconds": 0,
  "elapsed_seconds": 0,
  "avg_per_email": 0.9929251670837402,
  "log_lines": [
    "Inicio de campaña. Preparando lista de contactos...",
    "Contactos cargados: 1. Modo: FORZAR.",
    "[1/1] Enviado: jocarsa2@gmail.com (979 ms)",
    "Finalizado."
  ]
}
```
**camp_3_1766259317_9756.json**
```json
{
  "run_id": "camp_3_1766259317_9756",
  "campana_id": 3,
  "modo": "reanudar",
  "status": "done",
  "started_at": 1766259317.0329964,
  "finished_at": 1766259317.9406776,
  "total": 1,
  "processed": 1,
  "enviados": 1,
  "fallidos": 0,
  "saltados": 0,
  "current_email": null,
  "current_index": 1,
  "last_error": null,
  "eta_seconds": 0,
  "elapsed_seconds": 0,
  "avg_per_email": 0.9076938629150391,
  "log_lines": [
    "Inicio de campaña. Preparando lista de contactos...",
    "Contactos cargados: 1. Modo: REANUDAR.",
    "[1/1] Enviado: jocarsa2@gmail.com (891 ms)",
    "Finalizado."
  ]
}
```
**camp_4_1766259511_2038.json**
```json
{
  "run_id": "camp_4_1766259511_2038",
  "campana_id": 4,
  "modo": "reanudar",
  "status": "running",
  "started_at": 1766259511.070496,
  "finished_at": null,
  "total": 1307,
  "processed": 321,
  "enviados": 314,
  "fallidos": 7,
  "saltados": 0,
  "current_email": "diego@passporterapp.com",
  "current_index": 321,
  "last_error": "{'comercial@matagonzalez.net': (550, b'Requested action not taken: mailbox unavailable\\ninvalid DNS MX or A/AAAA resource record 1MLR5f-1vEhIY2B8t-00UDpy')}",
  "eta_seconds": 5291,
  "elapsed_seconds": 1722,
  "avg_per_email": 5.366490528219585,
  "log_lines": [
    "[197/1307] Enviado: carlos@galopebravo.com (997 ms)",
    "Esperando 2s...",
    "[198/1307] Enviado: carlos@siroppe.com (840 ms)",
    "Esperando 6s...",
    "[199/1307] Enviado: carlos@thebasementxxx.com (899 ms)",
    "Esperando 4s...",
    "[200/1307] Enviado: carlosvirosque@virosque.com (898 ms)",
    "Esperando 2s...",
    "[201/1307] Enviado: carolina.soriano@dormitienda.es (1013 ms)",
    "Esperando 3s...",
    "[202/1307] Enviado: carolinabernald@gmail.com (943 ms)",
    "Esperando 6s...",
    "[203/1307] Enviado: casabanvalero@gmail.com (935 ms)",
    "Esperando 4s...",
    "[204/1307] Enviado: cayme@cayme.com (1131 ms)",
    "Esperando 2s...",
    "[205/1307] Enviado: cbotella@syrtrans.es (1344 ms)",
    "Esperando 3s...",
    "[206/1307] FALLÓ: cdzafranar@ono.com (900 ms) -> {'cdzafranar@ono.com': (550, b'Requested action not taken: mailbox unavailable\\ninvalid DNS MX or A/AAAA resource record 1N17gw-1vyqT63HiM-00ryJg')}",
    "Esperando 5s...",
    "[207/1307] Enviado: cei@carpaval.com (1012 ms)",
    "Esperando 4s...",
    "[208/1307] Enviado: cei@laescoleta.com (845 ms)",
    "Esperando 2s...",
    "[209/1307] Enviado: ceibaloo@ceibaloo.es (939 ms)",
    "Esperando 5s...",
    "[210/1307] Enviado: ceidudua@gmail.com (794 ms)",
    "Esperando 2s...",
    "[211/1307] Enviado: ceiexplora@gmail.com (963 ms)",
    "Esperando 3s...",
    "[212/1307] Enviado: ceilamilotxa@gmail.com (994 ms)",
    "Esperando 5s...",
    "[213/1307] Enviado: ceipasset@gmail.com (844 ms)",
    "Esperando 4s...",
    "[214/1307] Enviado: ceipiratasvlc@gmail.com (808 ms)",
    "Esperando 2s...",
    "[215/1307] Enviado: ceiyat@ucv.es (817 ms)",
    "Esperando 5s...",
    "[216/1307] Enviado: centroformacion@fegreppa.com (1298 ms)",
    "Esperando 6s...",
    "[217/1307] Enviado: centrogodayla@yahoo.es (964 ms)",
    "Esperando 6s...",
    "[218/1307] Enviado: centroinfantilgarabatos@hotmail.com (971 ms)",
    "Esperando 6s...",
    "[219/1307] Enviado: centromusicalpaternense@gmail.com (797 ms)",
    "Esperando 2s...",
    "[220/1307] Enviado: cesar@euroval-ento.com (1029 ms)",
    "Esperando 5s...",
    "[221/1307] Enviado: cgoni@gruposorolla.es (1224 ms)",
    "Esperando 3s...",
    "[222/1307] Enviado: chiquitos@telefonica.net (959 ms)",
    "Esperando 6s...",
    "[223/1307] Enviado: ciclos.formativos@mascamarena.es (918 ms)",
    "Esperando 4s...",
    "[224/1307] Enviado: cissval@gmail.com (786 ms)",
    "Esperando 4s...",
    "[225/1307] Enviado: cjjerez@mailnotarnet.es (1044 ms)",
    "Esperando 2s...",
    "[226/1307] Enviado: clientes@beep.es (1203 ms)",
    "Esperando 6s...",
    "[227/1307] Enviado: clientes@kraken.es (1169 ms)",
    "Esperando 2s...",
    "[228/1307] Enviado: clientes@opa.agency (1513 ms)",
    "Esperando 2s...",
    "[229/1307] Enviado: clienteweb@computer.es (1165 ms)",
    "Esperando 5s...",
    "[230/1307] Enviado: cnemo@cnemo.com (926 ms)",
    "Esperando 4s...",
    "[231/1307] Enviado: cobertrans@cobertrans.com (967 ms)",
    "Esperando 5s...",
    "[232/1307] Enviado: colegio-argos@colegio-argos.es (888 ms)",
    "Esperando 6s...",
    "[233/1307] Enviado: colegio@esclavasalcoy.com (775 ms)",
    "Esperando 6s...",
    "[234/1307] Enviado: colegio@patronatofranciscoesteve.org (842 ms)",
    "Esperando 5s...",
    "[235/1307] Enviado: colegioelsalvador_@hotmail.com (944 ms)",
    "Esperando 5s...",
    "[236/1307] Enviado: colorins1@hotmail.com (930 ms)",
    "Esperando 5s...",
    "[237/1307] Enviado: comenius@comenius.es (1106 ms)",
    "Esperando 6s...",
    "[238/1307] Enviado: comercial@activexsoft.es (843 ms)",
    "Esperando 5s...",
    "[239/1307] Enviado: comercial@adap.es (915 ms)",
    "Esperando 2s...",
    "[240/1307] Enviado: comercial@castisoft.com (5111 ms)",
    "Esperando 6s...",
    "[241/1307] Enviado: comercial@delphistudio.es (1362 ms)",
    "Esperando 2s...",
    "[242/1307] Enviado: comercial@dynos.es (826 ms)",
    "Esperando 3s...",
    "[243/1307] Enviado: comercial@flipflopcomputers.com (1096 ms)",
    "Esperando 2s...",
    "[244/1307] Enviado: comercial@gsoft.es (948 ms)",
    "Esperando 6s...",
    "[245/1307] Enviado: comercial@gtec.es (1155 ms)",
    "Esperando 3s...",
    "[246/1307] Enviado: comercial@inforsat.com (856 ms)",
    "Esperando 4s...",
    "[247/1307] Enviado: comercial@keytosl.com (800 ms)",
    "Esperando 5s...",
    "[248/1307] Enviado: comercial@master-informatica.com (987 ms)",
    "Esperando 4s...",
    "[249/1307] FALLÓ: comercial@matagonzalez.net (836 ms) -> {'comercial@matagonzalez.net': (550, b'Requested action not taken: mailbox unavailable\\ninvalid DNS MX or A/AAAA resource record 1MLR5f-1vEhIY2B8t-00UDpy')}",
    "Esperando 5s...",
    "[250/1307] Enviado: comercial@microblanc.es (1405 ms)",
    "Esperando 2s...",
    "[251/1307] Enviado: comercial@microcoste.com (846 ms)",
    "Esperando 6s...",
    "[252/1307] Enviado: comercial@polip.es (801 ms)",
    "Esperando 2s...",
    "[253/1307] Enviado: comercial@sarcorem.com (893 ms)",
    "Esperando 2s...",
    "[254/1307] Enviado: comercial@seisinformatica.com (925 ms)",
    "Esperando 5s...",
    "[255/1307] Enviado: comercial@syamotor.es (1329 ms)",
    "Esperando 4s...",
    "[256/1307] Enviado: comercial@tancomed.es (1211 ms)",
    "Esperando 6s...",
    "[257/1307] Enviado: comercial@wifival.es (1178 ms)",
    "Esperando 4s...",
    "[258/1307] Enviado: comercial@xone.es (1078 ms)",
    "Esperando 6s...",
    "[259/1307] Enviado: comunicacion@eines.com (880 ms)",
    "Esperando 5s...",
    "[260/1307] Enviado: comunicacion@mediterjuridico.es (824 ms)",
    "Esperando 2s...",
    "[261/1307] Enviado: conchi@asesoriacontrueces.com (889 ms)",
    "Esperando 6s...",
    "[262/1307] Enviado: conservatoridansa@alcoi.org (891 ms)",
    "Esperando 5s...",
    "[263/1307] Enviado: conservatorimusica@alcoi.org (1057 ms)",
    "Esperando 5s...",
    "[264/1307] Enviado: consultas@importacionesjgarcia.com (1200 ms)",
    "Esperando 3s...",
    "[265/1307] Enviado: consultoria@sipadvance.com (1068 ms)",
    "Esperando 4s...",
    "[266/1307] Enviado: contact@casual-nine.com (906 ms)",
    "Esperando 5s...",
    "[267/1307] Enviado: contact@marianmarton.com (1193 ms)",
    "Esperando 5s...",
    "[268/1307] Enviado: contact@mollitiamindustries.com (1033 ms)",
    "Esperando 4s...",
    "[269/1307] Enviado: contact@synergybridges.com (913 ms)",
    "Esperando 6s...",
    "[270/1307] Enviado: contacta@laminadigital.com (1071 ms)",
    "Esperando 6s...",
    "[271/1307] Enviado: contacta@laminadigital.es (1182 ms)",
    "Esperando 6s...",
    "[272/1307] Enviado: contacta@tejedorpublicitario.com (800 ms)",
    "Esperando 6s...",
    "[273/1307] Enviado: contacto@4glsp.com (902 ms)",
    "Esperando 4s...",
    "[274/1307] Enviado: contacto@byedinosaurio.com (931 ms)",
    "Esperando 2s...",
    "[275/1307] Enviado: contacto@cedesa.es (1033 ms)",
    "Esperando 6s...",
    "[276/1307] Enviado: contacto@cyberinsa.com (1328 ms)",
    "Esperando 5s...",
    "[277/1307] Enviado: contacto@elixdigitalservices.com (1070 ms)",
    "Esperando 4s...",
    "[278/1307] Enviado: contacto@estatiko.com (894 ms)",
    "Esperando 6s...",
    "[279/1307] Enviado: contacto@ferrerdevelopment.com (850 ms)",
    "Esperando 6s...",
    "[280/1307] Enviado: contacto@franciscojavierfalcon.es (874 ms)",
    "Esperando 2s...",
    "[281/1307] Enviado: contacto@grupotecnico.com (917 ms)",
    "Esperando 5s...",
    "[282/1307] Enviado: contacto@heltica.es (1170 ms)",
    "Esperando 4s...",
    "[283/1307] Enviado: contacto@hrsoftdev.es (833 ms)",
    "Esperando 6s...",
    "[284/1307] Enviado: contacto@idital.com (986 ms)",
    "Esperando 2s...",
    "[285/1307] Enviado: contacto@infoasistencia.com (849 ms)",
    "Esperando 3s...",
    "[286/1307] Enviado: contacto@innobing.com (1053 ms)",
    "Esperando 5s...",
    "[287/1307] Enviado: contacto@neuratum.com (858 ms)",
    "Esperando 6s...",
    "[288/1307] Enviado: contacto@nubysoft.es (982 ms)",
    "Esperando 5s...",
    "[289/1307] Enviado: contacto@valenhaus.es (1180 ms)",
    "Esperando 4s...",
    "[290/1307] Enviado: contacto@vgst.net (1110 ms)",
    "Esperando 6s...",
    "[291/1307] Enviado: contacto@websitestory.com.es (1056 ms)",
    "Esperando 6s...",
    "[292/1307] Enviado: contacto@wembleystudios.com (979 ms)",
    "Esperando 5s...",
    "[293/1307] Enviado: contacto@yo-reparo.com (840 ms)",
    "Esperando 6s...",
    "[294/1307] Enviado: correo@bandacampanar.com (1114 ms)",
    "Esperando 3s...",
    "[295/1307] Enviado: correo@jaepinformatica.com (938 ms)",
    "Esperando 5s...",
    "[296/1307] Enviado: correo@microtechinformatics.com (955 ms)",
    "Esperando 6s...",
    "[297/1307] Enviado: cortes@sorsiemorsi.com (864 ms)",
    "Esperando 3s...",
    "[298/1307] Enviado: cosanmar@gmail.com (802 ms)",
    "Esperando 2s...",
    "[299/1307] Enviado: cportoles@stocklogistic.com (1021 ms)",
    "Esperando 4s...",
    "[300/1307] Enviado: crausellbueno@gmail.com (984 ms)",
    "Esperando 6s...",
    "[301/1307] Enviado: crc@avanzainnovaciones.com (943 ms)",
    "Esperando 2s...",
    "[302/1307] Enviado: cristinamasso@lapobladevallbona.es (841 ms)",
    "Esperando 6s...",
    "[303/1307] Enviado: csc.multicliente@samalogistica.es (954 ms)",
    "Esperando 5s...",
    "[304/1307] Enviado: ctarin@iembs.com (813 ms)",
    "Esperando 6s...",
    "[305/1307] Enviado: cuentas@modernadigital.es (887 ms)",
    "Esperando 4s...",
    "[306/1307] Enviado: daman@daman.es (2894 ms)",
    "Esperando 3s...",
    "[307/1307] Enviado: daniel@cervezatyris.com (906 ms)",
    "Esperando 6s...",
    "[308/1307] Enviado: danielruizfort@gmail.com (830 ms)",
    "Esperando 6s...",
    "[309/1307] Enviado: dariomolina@ayto-xativa.es (851 ms)",
    "Esperando 2s...",
    "[310/1307] Enviado: dartex@dartex.es (866 ms)",
    "Esperando 5s...",
    "[311/1307] Enviado: david.chuan@divadexternal.com (930 ms)",
    "Esperando 3s...",
    "[312/1307] Enviado: david@dekalabs.com (1096 ms)",
    "Esperando 3s...",
    "[313/1307] Enviado: david@gobeeping.com (1019 ms)",
    "Esperando 4s...",
    "[314/1307] Enviado: david@valenciaocasion.es (1093 ms)",
    "Esperando 3s...",
    "[315/1307] Enviado: davidcarrion@tameformacion.com (1001 ms)",
    "Esperando 4s...",
    "[316/1307] Enviado: design@madridnyc.com (1001 ms)",
    "Esperando 3s...",
    "[317/1307] Enviado: desiree@aguaysalcomunicacion.com (1187 ms)",
    "Esperando 4s...",
    "[318/1307] Enviado: deyco@deyco.net (1062 ms)",
    "Esperando 3s...",
    "[319/1307] Enviado: dga68esport@gmail.com (1760 ms)",
    "Esperando 6s...",
    "[320/1307] Enviado: dginesta@mat.upv.es (1098 ms)",
    "Esperando 2s...",
    "[321/1307] Enviado: diego@passporterapp.com (1216 ms)",
    "Esperando 4s..."
  ]
}
```
## templates
**campaign_new.html**
```html
{% extends "layout.html" %}
{% set title = "Nueva campaña" %}

{% block head_extra %}
  <!-- Quill (WYSIWYG) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css">
{% endblock %}

{% block styles %}
<style>
  .tools{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-top:12px;
  }
  .editor-wrap{
    border:1px solid var(--stroke);
    border-radius: 14px;
    overflow:hidden;
    background: rgba(255,255,255,.85);
    box-shadow: 0 10px 22px rgba(15,23,42,.04);
  }
  #editor{
    min-height: 260px;
  }
  .ql-toolbar.ql-snow{
    border:0;
    border-bottom:1px solid var(--stroke);
    background: rgba(255,140,0,.04);
  }
  .ql-container.ql-snow{
    border:0;
    font-family: var(--sans);
    font-size: 14px;
  }
  .pillrow{
    display:flex;
    justify-content:space-between;
    gap:10px;
    flex-wrap:wrap;
    align-items:center;
  }
  .note{
    margin-top:10px;
    font-size:13px;
    color: var(--muted);
  }
</style>
{% endblock %}

{% block content %}
<div class="grid">
  <div class="card">
    <h1>Nueva campaña</h1>
    <p class="muted">
      Define CSV, asunto y cuerpo HTML. Se admiten placeholders <code>{{'{{columna}}'}}</code>. El editor HTML es visual (WYSIWYG).
    </p>

    <form method="post" action="{{ url_for('campana_nueva') }}" id="formCampana">
      <label>Nombre</label>
      <input name="nombre" placeholder="Ej: Bienvenida alumnos — Enero" required>

      <label>CSV (lista de contactos)</label>
      <select name="csv_file" required>
        <option value="">Selecciona...</option>
        {% for f in csv_files %}
          <option value="{{ f }}">{{ f }}</option>
        {% endfor %}
      </select>

      <label>Asunto</label>
      <input name="asunto" placeholder="Ej: Hola {{'{{nombre}}'}}" required>

      <div class="pillrow" style="margin-top:12px;">
        <div>
          <label style="margin:0;">Cuerpo HTML (editor visual)</label>
          <div class="note">Se enviará SOLO HTML. El contenido se sincroniza automáticamente al guardar.</div>
        </div>
        <div class="tools">
          <button class="btn ghost" type="button" id="btnPlantilla">Insertar plantilla</button>
          <button class="btn ghost" type="button" id="btnLimpiar">Limpiar</button>
        </div>
      </div>

      <div class="editor-wrap" style="margin-top:10px;">
        <div id="editor"></div>
      </div>

      <!-- Campo real que se envía al backend -->
      <textarea name="cuerpo_html" id="cuerpo_html" style="display:none;"></textarea>

      <div class="hint">
        Placeholders: <code>{{'{{nombre}}'}}</code>, <code>{{'{{empresa}}'}}</code>, etc.
      </div>

      <div style="margin-top:14px; display:flex; gap:10px; flex-wrap:wrap;">
        <button class="btn" type="submit">Crear campaña</button>
        <a class="btn ghost" href="{{ url_for('index') }}">Cancelar</a>
      </div>
    </form>
  </div>

  <div class="card">
    <h2>Herramientas</h2>
    <p class="muted">Inserta una plantilla corporativa base o limpia el contenido.</p>

    <div class="tools">
      <button class="btn ghost" type="button" id="btnPlantilla2">Insertar plantilla</button>
      <button class="btn ghost" type="button" id="btnLimpiar2">Limpiar</button>
    </div>

    <div class="hint">
      Recomendación: usa siempre una estructura HTML simple y estilos inline si el email debe verse igual en todos los clientes.
    </div>

    <h2 style="margin-top:14px;">Vista previa rápida</h2>
    <p class="muted">Preview del HTML generado (aproximado).</p>
    <div class="editor-wrap" style="margin-top:10px;">
      <div id="preview" style="padding:12px; min-height:180px;"></div>
    </div>
  </div>
</div>
{% endblock %}

{% block scripts %}
  <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>

  <script>
  (function(){
    const editorEl = document.getElementById("editor");
    const previewEl = document.getElementById("preview");
    const hiddenTa = document.getElementById("cuerpo_html");
    const form = document.getElementById("formCampana");

    function plantillaHTML(){
      return `
<div style="font-family:Arial,Helvetica,sans-serif; line-height:1.5; color:#0f172a;">
  <div style="max-width:680px; margin:0 auto; padding:16px; border:1px solid #e7e9f2; border-radius:12px;">
    <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px;">
      <div style="width:10px;height:10px;border-radius:999px;background:#ff8c00;box-shadow:0 0 0 6px rgba(255,140,0,.12)"></div>
      <div style="font-weight:800;">jocarsa | darkorange</div>
    </div>
    <h2 style="margin:0 0 10px 0;">Hola {{'{{nombre}}'}}</h2>
    <p style="margin:0 0 10px 0;">
      Este es un mensaje de ejemplo. Puedes personalizarlo con placeholders como {{'{{empresa}}'}}.
    </p>
    <div style="margin-top:14px; padding:12px; background:rgba(255,140,0,.08); border:1px solid rgba(255,140,0,.25); border-radius:12px;">
      <strong>Nota:</strong> recuerda revisar el contenido antes de enviar.
    </div>
    <p style="margin:14px 0 0 0; color:#64748b; font-size:12px;">
      © jocarsa | darkorange
    </p>
  </div>
</div>`;
    }

    function sync(quill){
      // HTML que se enviará
      const html = editorEl.querySelector(".ql-editor").innerHTML || "";
      hiddenTa.value = html;
      previewEl.innerHTML = html;
    }

    function initQuill(){
      if(!window.Quill){
        console.error("Quill no está disponible.");
        editorEl.innerHTML = '<div style="padding:12px;color:#b91c1c;">No se pudo cargar el editor visual (Quill). Revisa conexión o bloqueadores.</div>';
        hiddenTa.style.display = "block";
        hiddenTa.placeholder = "Pega aquí tu HTML si el editor visual no carga.";
        return;
      }

      const quill = new Quill("#editor", {
        theme: "snow",
        modules: {
          toolbar: [
            [{ header: [1, 2, 3, false] }],
            ["bold","italic","underline","strike"],
            [{ "list": "ordered" }, { "list": "bullet" }],
            [{ "align": [] }],
            ["link","image"],
            ["clean"]
          ]
        }
      });

      // contenido inicial
      quill.clipboard.dangerouslyPasteHTML(plantillaHTML());
      sync(quill);

      quill.on("text-change", function(){ sync(quill); });

      // botones
      function setPlantilla(){
        quill.setContents([]);
        quill.clipboard.dangerouslyPasteHTML(plantillaHTML());
        sync(quill);
      }
      function limpiar(){
        quill.setContents([]);
        sync(quill);
      }

      const btnPlantilla = document.getElementById("btnPlantilla");
      const btnLimpiar = document.getElementById("btnLimpiar");
      const btnPlantilla2 = document.getElementById("btnPlantilla2");
      const btnLimpiar2 = document.getElementById("btnLimpiar2");

      [btnPlantilla, btnPlantilla2].forEach(b => b && b.addEventListener("click", setPlantilla));
      [btnLimpiar, btnLimpiar2].forEach(b => b && b.addEventListener("click", limpiar));

      // Antes de enviar, aseguramos que textarea tenga el HTML
      form.addEventListener("submit", function(){
        sync(quill);
      });
    }

    // Seguridad extra: si el script del CDN tarda, esperamos un tick
    if(window.Quill){
      initQuill();
    }else{
      // Intento de carga dinámica (por si el script no cargó por orden/latencia)
      const s = document.createElement("script");
      s.src = "https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js";
      s.onload = initQuill;
      s.onerror = initQuill;
      document.head.appendChild(s);
    }
  })();
  </script>
{% endblock %}


```
**campaign_send.html**
```html
{% extends "layout.html" %}
{% set title = "Envío en curso" %}

{% block content %}
<div class="grid">
  <div class="card">
    <h1>Envío en curso — Campaña #{{ camp.id }}</h1>
    <p class="muted">
      <strong>{{ camp.nombre }}</strong><br>
      Run: <code>{{ run_id }}</code>
    </p>

    <div style="margin-top:14px;">
      <div style="display:flex; justify-content:space-between; align-items:center; gap:12px;">
        <div style="font-weight:800;">Progreso</div>
        <div class="muted"><span id="pct">0</span>%</div>
      </div>

      <div style="margin-top:8px; border:1px solid var(--stroke); border-radius:999px; background:rgba(255,255,255,.65); overflow:hidden; height:12px;">
        <div id="bar" style="height:12px; width:0%; background:linear-gradient(90deg, rgba(255,140,0,.55), rgba(255,140,0,.85));"></div>
      </div>

      <div class="kpi" style="margin-top:12px;">
        <div class="box">
          <div class="big"><span id="processed">0</span>/<span id="total">0</span></div>
          <div class="small">Procesados</div>
        </div>
        <div class="box">
          <div class="big"><span id="elapsed">00:00</span></div>
          <div class="small">Tiempo transcurrido</div>
        </div>
        <div class="box">
          <div class="big"><span id="eta">--:--</span></div>
          <div class="small">Tiempo restante (estimado)</div>
        </div>
        <div class="box">
          <div class="big"><span id="status">running</span></div>
          <div class="small">Estado</div>
        </div>
      </div>

      <div class="kpi" style="margin-top:10px;">
        <div class="box">
          <div class="big"><span id="ok">0</span></div>
          <div class="small">Enviados</div>
        </div>
        <div class="box">
          <div class="big"><span id="fail">0</span></div>
          <div class="small">Fallidos</div>
        </div>
        <div class="box">
          <div class="big"><span id="skip">0</span></div>
          <div class="small">Saltados</div>
        </div>
        <div class="box">
          <div class="big" style="font-family:var(--mono); font-size:12px;">
            <span id="current">—</span>
          </div>
          <div class="small">Email actual</div>
        </div>
      </div>

      <div class="hint" id="finalHint" style="display:none;">
        Envío finalizado. Puedes volver a la campaña o revisar los logs.
        <div style="margin-top:10px; display:flex; gap:10px; flex-wrap:wrap;">
          <a class="btn ghost" href="{{ url_for('campana_ver', campana_id=camp.id) }}">Volver a campaña</a>
          <a class="btn" href="{{ url_for('logs', q='run_id=' ~ run_id) }}">Ver logs</a>
        </div>
      </div>

      <div style="margin-top:14px;">
        <h2>Log en vivo</h2>
        <p class="muted">Últimas líneas del proceso. Se actualiza automáticamente.</p>
        <pre id="logbox" style="min-height:240px; max-height:420px; overflow:auto;"></pre>
      </div>

      <div id="errBox" class="hint" style="display:none; border-color: rgba(225,29,72,.25); background: rgba(225,29,72,.06);">
        <strong>Error:</strong> <span id="errText"></span>
      </div>
    </div>
  </div>

  <div class="card">
    <h2>Resumen campaña</h2>
    <table class="table">
      <tr><th>CSV</th><td><code>{{ camp.csv_file }}</code></td></tr>
      <tr><th>Asunto</th><td><code>{{ camp.asunto }}</code></td></tr>
      <tr><th>Delay</th><td><code>{{ cfg.delay_seconds.min }}–{{ cfg.delay_seconds.max }}s</code></td></tr>
      <tr><th>SMTP</th><td><code>{{ cfg.smtp.host }}:{{ cfg.smtp.port }}</code></td></tr>
    </table>

    <div class="hint">
      Si cierras esta pestaña, el envío continúa. Puedes volver a ver el reporte con el mismo <code>run_id</code> mientras exista el archivo en <code>runs/</code>.
    </div>
  </div>
</div>
{% endblock %}

{% block scripts %}
<script>
(function(){
  const runId = "{{ run_id }}";
  const bar = document.getElementById("bar");

  const elPct = document.getElementById("pct");
  const elProcessed = document.getElementById("processed");
  const elTotal = document.getElementById("total");
  const elElapsed = document.getElementById("elapsed");
  const elEta = document.getElementById("eta");
  const elStatus = document.getElementById("status");

  const elOk = document.getElementById("ok");
  const elFail = document.getElementById("fail");
  const elSkip = document.getElementById("skip");
  const elCurrent = document.getElementById("current");

  const logbox = document.getElementById("logbox");
  const finalHint = document.getElementById("finalHint");

  const errBox = document.getElementById("errBox");
  const errText = document.getElementById("errText");

  let done = false;

  function render(data){
    elPct.textContent = data.pct ?? 0;
    bar.style.width = (data.pct ?? 0) + "%";

    elProcessed.textContent = data.processed ?? 0;
    elTotal.textContent = data.total ?? 0;

    elElapsed.textContent = data.elapsed_hhmmss ?? "00:00";
    elEta.textContent = data.eta_hhmmss ?? "--:--";

    elStatus.textContent = data.status ?? "—";
    elOk.textContent = data.enviados ?? 0;
    elFail.textContent = data.fallidos ?? 0;
    elSkip.textContent = data.saltados ?? 0;

    elCurrent.textContent = data.current_email ? data.current_email : "—";

    // log
    const lines = data.log_lines || [];
    logbox.textContent = lines.join("\n");

    // autoscroll suave (si el usuario no ha subido manualmente)
    const nearBottom = (logbox.scrollHeight - (logbox.scrollTop + logbox.clientHeight)) < 80;
    if(nearBottom) logbox.scrollTop = logbox.scrollHeight;

    if(data.status === "done"){
      done = true;
      finalHint.style.display = "block";
    }

    if(data.status === "error"){
      errBox.style.display = "block";
      errText.textContent = data.last_error || "Error desconocido";
      done = true;
      finalHint.style.display = "block";
    }
  }

  async function tick(){
    try{
      const res = await fetch(`/api/progreso/${encodeURIComponent(runId)}`, { cache: "no-store" });
      if(!res.ok){
        throw new Error("No se pudo leer el progreso");
      }
      const data = await res.json();
      if(!data.ok){
        throw new Error(data.error || "Respuesta inválida");
      }
      render(data);
    }catch(e){
      errBox.style.display = "block";
      errText.textContent = String(e.message || e);
    }finally{
      if(!done){
        setTimeout(tick, 1000);
      }
    }
  }

  tick();
})();
</script>
{% endblock %}


```
**campaign_view.html**
```html
{% extends "layout.html" %}
{% set title = "Campaña " ~ camp.id %}

{% block content %}
<div class="grid">
  <div class="card">
    <h1>Campaña #{{ camp.id }} — {{ camp.nombre }}</h1>
    <p class="muted">
      CSV: <code>{{ camp.csv_file }}</code> · Estado: <strong>{{ camp.estado }}</strong> · Creada: {{ camp.creado_en }}
    </p>

    <div class="kpi">
      <div class="box">
        <div class="big">{{ total_contactos }}</div>
        <div class="small">Contactos en CSV</div>
      </div>
      <div class="box">
        <div class="big">{{ resumen.enviados }}</div>
        <div class="small">Enviados (registrados)</div>
      </div>
      <div class="box">
        <div class="big">{{ resumen.fallidos }}</div>
        <div class="small">Fallidos (registrados)</div>
      </div>
      <div class="box">
        <div class="big">{{ resumen.saltados }}</div>
        <div class="small">Saltados (registrados)</div>
      </div>
    </div>

    <div class="hint">
      “Reanudar” omite emails con estado <code>enviado</code> en esta campaña. “Forzar” reintenta todo.
    </div>

    <!-- Envío con reporte en vivo -->
    <form method="post" action="{{ url_for('campana_enviar_ui', campana_id=camp.id) }}" style="margin-top:12px;">
      <label>Modo de envío</label>
      <select name="modo">
        <option value="reanudar">Reanudar (saltar ya enviados)</option>
        <option value="forzar">Forzar (reintentar todos)</option>
      </select>

      <div style="margin-top:12px; display:flex; gap:10px; flex-wrap:wrap;">
        <button class="btn" type="submit">Iniciar envío (con reporte)</button>
        <a class="btn ghost" href="{{ url_for('logs', q='campana_id=' ~ camp.id) }}">Ver logs</a>
      </div>
    </form>

    <h2 style="margin-top:16px;">Contenido</h2>
    <table class="table">
      <tr><th>Asunto</th><td><code>{{ camp.asunto }}</code></td></tr>
    </table>

    <h2 style="margin-top:16px;">Vista previa HTML</h2>
    <p class="muted">Render del HTML (lo verá el destinatario). Los placeholders se sustituyen al enviar.</p>
    <div class="html-preview">
      {{ camp.cuerpo_html | safe }}
    </div>

    <div style="margin-top:12px; display:flex; gap:10px; flex-wrap:wrap;">
      <button class="btn ghost" type="button" id="btnCopiarHTML">Copiar HTML</button>
    </div>

    <h2 style="margin-top:16px;">HTML (crudo)</h2>
    <pre id="rawHtml">{{ camp.cuerpo_html }}</pre>
  </div>

  <div class="card">
    <h2>Adjuntos</h2>
    <p class="muted">Máximo por archivo: {{ cfg.seguridad.max_tamano_adjuntos_mb }} MB. Se adjuntan en todos los envíos.</p>

    <form method="post" action="{{ url_for('campana_subir_adjuntos', campana_id=camp.id) }}" enctype="multipart/form-data">
      <label>Subir adjuntos</label>
      <input type="file" name="adjuntos" multiple />
      <div style="margin-top:12px;">
        <button class="btn" type="submit">Subir</button>
      </div>
    </form>

    {% if adjuntos %}
      <table class="table" style="margin-top:12px;">
        <thead>
          <tr><th>Archivo</th><th>Subido</th><th></th></tr>
        </thead>
        <tbody>
          {% for a in adjuntos %}
            <tr>
              <td><code>{{ a.filename }}</code></td>
              <td>{{ a.subido_en }}</td>
              <td style="white-space:nowrap;">
                <a class="btn ghost" href="{{ url_for('campana_descargar_adjunto', campana_id=camp.id, adjunto_id=a.id) }}">Descargar</a>
              </td>
            </tr>
          {% endfor %}
        </tbody>
      </table>
    {% else %}
      <div class="hint">No hay adjuntos.</div>
    {% endif %}
  </div>
</div>
{% endblock %}

{% block scripts %}
<script>
(function(){
  var btn = document.getElementById('btnCopiarHTML');
  var raw = document.getElementById('rawHtml');

  if(btn && raw){
    btn.addEventListener('click', async function(){
      try{
        await navigator.clipboard.writeText(raw.textContent || '');
        btn.textContent = 'HTML copiado';
        setTimeout(function(){ btn.textContent = 'Copiar HTML'; }, 1200);
      }catch(e){
        alert('No se pudo copiar al portapapeles.');
      }
    });
  }
})();
</script>
{% endblock %}


```
**config.html**
```html
{% extends "layout.html" %}
{% set title = "Configuración" %}
{% block content %}
<div class="grid">
  <div class="card">
    <h1>Configuración</h1>
    <p class="muted">SMTP, delays y límites de seguridad.</p>

    <form method="post" autocomplete="off">
      <h2>SMTP</h2>

      <label>Host</label>
      <input name="host" value="{{ cfg.smtp.host }}" required />

      <div class="row">
        <div>
          <label>Puerto</label>
          <input name="port" type="number" value="{{ cfg.smtp.port }}" required />
        </div>
        <div>
          <label>Usuario</label>
          <input name="usuario" value="{{ cfg.smtp.usuario }}" required />
        </div>
      </div>

      <label>Password</label>
      <input name="password" type="password" value="{{ cfg.smtp.password }}" placeholder="Se guarda en config.json" />

      <div class="row">
        <div>
          <label>From email</label>
          <input name="from_email" value="{{ cfg.smtp.from_email }}" />
        </div>
        <div>
          <label>From name</label>
          <input name="from_name" value="{{ cfg.smtp.from_name }}" />
        </div>
      </div>

      <label>
        <input type="checkbox" name="use_starttls" {% if cfg.smtp.use_starttls %}checked{% endif %}/>
        Usar STARTTLS (típico 587)
      </label>

      <label>
        <input type="checkbox" name="use_ssl" {% if cfg.smtp.use_ssl %}checked{% endif %}/>
        Usar SSL (SMTP_SSL, típico 465)
      </label>

      <h2 style="margin-top:14px;">Delay entre emails</h2>
      <div class="row">
        <div>
          <label>Mínimo (segundos)</label>
          <input name="delay_min" type="number" value="{{ cfg.delay_seconds.min }}" min="0" required />
        </div>
        <div>
          <label>Máximo (segundos)</label>
          <input name="delay_max" type="number" value="{{ cfg.delay_seconds.max }}" min="0" required />
        </div>
      </div>

      <h2 style="margin-top:14px;">Seguridad</h2>
      <div class="row">
        <div>
          <label>Máx. receptores por campaña</label>
          <input name="max_receptores_por_campana" type="number" value="{{ cfg.seguridad.max_receptores_por_campana }}" min="1" required />
        </div>
        <div>
          <label>Máx. tamaño adjuntos (MB)</label>
          <input name="max_tamano_adjuntos_mb" type="number" value="{{ cfg.seguridad.max_tamano_adjuntos_mb }}" min="1" required />
        </div>
      </div>

      <div style="margin-top:12px; display:flex; gap:10px; flex-wrap:wrap;">
        <button class="btn" type="submit">Guardar</button>
        <a class="btn ghost" href="{{ url_for('index') }}">Volver</a>
      </div>

      <div class="hint">
        Placeholders: <code>{{'{{columna}}'}}</code> en asunto y cuerpos (texto/HTML).
      </div>
    </form>
  </div>

  <div class="card">
    <h2>Notas</h2>
    <p class="muted">
      - Se envía <strong>texto + HTML</strong> (si el cliente soporta HTML, lo mostrará).<br/>
      - Los adjuntos se asocian a la campaña y se adjuntan en todos los envíos.<br/>
      - “Reanudar” salta emails ya enviados en esa campaña.
    </p>
  </div>
</div>
{% endblock %}


```
**index.html**
```html
{% extends "layout.html" %}
{% set title = "Campañas" %}
{% block content %}
<div class="grid">
  <div class="card">
    <h1>Campañas</h1>
    <p class="muted">Crea campañas, adjunta archivos, envía y reanuda sin duplicar envíos.</p>

    {% if campañas %}
      <table class="table" style="margin-top:12px;">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>CSV</th>
            <th>Estado</th>
            <th>Creada</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          {% for c in campañas %}
            <tr>
              <td><code>{{ c.id }}</code></td>
              <td>{{ c.nombre }}</td>
              <td><code>{{ c.csv_file }}</code></td>
              <td>{{ c.estado }}</td>
              <td>{{ c.creado_en }}</td>
              <td style="white-space:nowrap;">
                <a class="btn ghost" href="{{ url_for('campana_ver', campana_id=c.id) }}">Abrir</a>
              </td>
            </tr>
          {% endfor %}
        </tbody>
      </table>
    {% else %}
      <div class="hint">No hay campañas aún. Crea una desde “Nueva campaña”.</div>
    {% endif %}
  </div>

  <div class="card">
    <h2>Estado del sistema</h2>
    <div class="kpi">
      <div class="box">
        <div class="big">{{ cfg.smtp.host }}:{{ cfg.smtp.port }}</div>
        <div class="small">SMTP</div>
      </div>
      <div class="box">
        <div class="big">{{ "SSL" if cfg.smtp.use_ssl else ("STARTTLS" if cfg.smtp.use_starttls else "Plano") }}</div>
        <div class="small">Modo conexión</div>
      </div>
      <div class="box">
        <div class="big">{{ cfg.delay_seconds.min }}–{{ cfg.delay_seconds.max }}s</div>
        <div class="small">Delay aleatorio</div>
      </div>
      <div class="box">
        <div class="big">{{ cfg.seguridad.max_receptores_por_campana }}</div>
        <div class="small">Máximo receptores/campaña</div>
      </div>
    </div>

    <div class="hint">
      CSVs disponibles en <code>csv_lists/</code>: {{ csv_files|length }} archivo(s).
    </div>
  </div>
</div>
{% endblock %}


```
**layout.html**
```html
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>{{ title or "jocarsa | darkorange" }}</title>

  <!-- Favicon inline (evita 404 /favicon.ico) -->
  <link rel="icon" type="image/svg+xml"
        href='data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"><rect width="64" height="64" rx="16" fill="%23ffffff"/><circle cx="32" cy="32" r="14" fill="%23ff8c00"/><circle cx="32" cy="32" r="22" fill="none" stroke="%23ff8c00" stroke-width="6" opacity="0.22"/></svg>'>

  <style>
    :root{
      --bg:#f6f7fb;
      --card:#ffffff;
      --stroke:#e7e9f2;
      --text:#0f172a;
      --muted:#64748b;

      --accent:#ff8c00;
      --shadow: 0 12px 30px rgba(15,23,42,.08);
      --r: 18px;

      --mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
      --sans: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";

      --topbar-h: 74px;
    }

    *{ box-sizing:border-box; }
    html, body { height:100%; }
    body{
      margin:0;
      font-family: var(--sans);
      background: radial-gradient(1200px 700px at 70% -10%, rgba(255,140,0,.10), transparent 55%),
                  radial-gradient(900px 550px at 10% 0%, rgba(15,23,42,.05), transparent 60%),
                  var(--bg);
      color: var(--text);
    }

    .app{
      min-height:100vh;
      display:flex;
      flex-direction:column;
    }
    .main{
      flex:1;
      min-height:0;
    }

    .container{
      width:100%;
      max-width:none;
      margin:0;
      padding: 18px 22px;
      min-height: calc(100vh - var(--topbar-h));
    }

    .topbar{
      position: sticky;
      top: 0;
      z-index: 50;
      height: var(--topbar-h);
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding: 10px 22px;
      backdrop-filter: blur(10px);
      background: rgba(246,247,251,.76);
      border-bottom: 1px solid var(--stroke);
    }

    .brand{
      display:flex;
      align-items:center;
      gap:10px;
      font-weight:900;
      letter-spacing:.2px;
      white-space:nowrap;
    }
    .dot{
      width:12px; height:12px; border-radius:999px;
      background: var(--accent);
      box-shadow: 0 0 0 6px rgba(255,140,0,.12);
      display:inline-block;
    }
    .brand small{
      font-weight:700;
      color: var(--muted);
    }

    .nav{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      align-items:center;
      justify-content:flex-end;
    }

    .pill{
      display:inline-flex;
      align-items:center;
      gap:8px;
      padding: 10px 14px;
      border-radius: 999px;
      border: 1px solid var(--stroke);
      background: rgba(255,255,255,.70);
      color: var(--text);
      text-decoration:none;
      font-weight:800;
      box-shadow: 0 10px 22px rgba(15,23,42,.05);
      transition: transform .12s ease, border-color .12s ease, background .12s ease;
    }
    .pill:hover{
      transform: translateY(-1px);
      border-color: rgba(255,140,0,.40);
      background: rgba(255,255,255,.92);
    }

    .card{
      background: rgba(255,255,255,.82);
      border: 1px solid var(--stroke);
      border-radius: var(--r);
      box-shadow: var(--shadow);
      padding: 16px;
      min-height: 0;
    }
    .card.scroll{
      max-height: calc(100vh - var(--topbar-h) - 38px);
      overflow:auto;
    }

    h1{ margin:0 0 6px 0; font-size:22px; letter-spacing:-.2px; }
    h2{ margin:0 0 10px 0; font-size:16px; }
    p{ margin:8px 0; }
    .muted{ color: var(--muted); font-size: 13px; }
    .mono{ font-family: var(--mono); }
    .small{ font-size: 12px; }

    .hint{
      margin-top:12px;
      padding: 12px 12px;
      border-radius: 14px;
      border: 1px solid rgba(255,140,0,.25);
      background: rgba(255,140,0,.06);
      color: var(--text);
      font-size: 13px;
    }

    .grid{
      display:grid;
      grid-template-columns: 1.75fr 1fr;
      gap:18px;
      align-items:start;
      min-height:0;
    }
    @media (max-width: 1100px){
      .grid{ grid-template-columns: 1fr; }
      .topbar{ height:auto; padding: 12px 16px; }
      .container{ padding: 14px 16px; min-height: calc(100vh - var(--topbar-h)); }
    }

    label{
      display:block;
      font-weight:800;
      font-size:12px;
      color: var(--muted);
      margin: 12px 0 6px 0;
    }
    input, select, textarea{
      width:100%;
      padding: 12px 12px;
      border-radius: 14px;
      border:1px solid var(--stroke);
      background: rgba(255,255,255,.90);
      color: var(--text);
      outline: none;
      box-shadow: 0 10px 22px rgba(15,23,42,.04);
    }
    textarea{ min-height: 140px; resize: vertical; }
    input:focus, select:focus, textarea:focus{
      border-color: rgba(255,140,0,.45);
      box-shadow: 0 0 0 4px rgba(255,140,0,.12);
    }

    .row{
      display:grid;
      grid-template-columns: 2fr 1fr;
      gap:12px;
    }
    @media (max-width: 900px){
      .row{ grid-template-columns: 1fr; }
    }

    .btn{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      gap:8px;
      padding: 10px 14px;
      border-radius: 14px;
      border: 1px solid rgba(255,140,0,.35);
      background: rgba(255,140,0,.10);
      color: var(--text);
      font-weight:900;
      text-decoration:none;
      cursor:pointer;
      box-shadow: 0 12px 24px rgba(15,23,42,.06);
      transition: transform .12s ease, background .12s ease, border-color .12s ease;
    }
    .btn:hover{
      transform: translateY(-1px);
      border-color: rgba(255,140,0,.55);
      background: rgba(255,140,0,.14);
    }
    .btn.ghost{
      border-color: var(--stroke);
      background: rgba(255,255,255,.75);
    }

    .flashwrap{ display:flex; flex-direction:column; gap:10px; margin-bottom: 14px; }
    .flash{
      padding: 12px;
      border-radius: 14px;
      border: 1px solid var(--stroke);
      background: rgba(255,255,255,.8);
      box-shadow: 0 10px 22px rgba(15,23,42,.04);
      font-size: 13px;
    }
    .flash.success{ border-color: rgba(22,163,74,.25); background: rgba(22,163,74,.06); }
    .flash.error{ border-color: rgba(225,29,72,.25); background: rgba(225,29,72,.06); }
    .flash.info{ border-color: rgba(255,140,0,.25); background: rgba(255,140,0,.06); }
  </style>

  {% block head_extra %}{% endblock %}
  {% block styles %}{% endblock %}
</head>

<body>
  <div class="app">
    <header class="topbar">
      <div class="brand">
        <span class="dot"></span>
        <span>jocarsa <small> | darkorange</small></span>
      </div>

      <nav class="nav">
        <a class="pill" href="{{ url_for('index') }}">Campañas</a>
        <a class="pill" href="{{ url_for('campana_nueva') }}">Nueva campaña</a>
        <a class="pill" href="{{ url_for('config') }}">Configuración</a>
        <a class="pill" href="{{ url_for('logs') }}">Logs</a>
      </nav>
    </header>

    <main class="main">
      <div class="container">
        {% with messages = get_flashed_messages(with_categories=true) %}
          {% if messages %}
            <div class="flashwrap">
              {% for category, message in messages %}
                <div class="flash {{ category }}">{{ message }}</div>
              {% endfor %}
            </div>
          {% endif %}
        {% endwith %}

        {% block content %}{% endblock %}
      </div>
    </main>
  </div>

  {% block scripts %}{% endblock %}
</body>
</html>


```
**logs.html**
```html
{% extends "layout.html" %}
{% set title = "Logs" %}

{% block styles %}
<style>
  /* En logs queremos flujo vertical (no dos columnas) */
  .logs-stack{
    display:flex;
    flex-direction:column;
    gap:18px;
    min-height:0;
  }
  /* fila clicable */
  tr.rowclick{ cursor:pointer; }
  tr.rowclick:hover td{ background: rgba(255,140,0,.04); }
  .jsonrow td{ background: rgba(255,140,0,.03); }
  .logs code{ font-family: var(--mono); font-size:12px; }
  .dotstatus{
    width:10px; height:10px; border-radius:999px; display:inline-block;
    box-shadow: 0 0 0 5px rgba(255,140,0,.08);
  }
  .dotstatus.ok{ background: rgba(22,163,74,.9); box-shadow: 0 0 0 5px rgba(22,163,74,.12); }
  .dotstatus.warn{ background: rgba(217,119,6,.9); box-shadow: 0 0 0 5px rgba(217,119,6,.12); }
  .dotstatus.err{ background: rgba(225,29,72,.9); box-shadow: 0 0 0 5px rgba(225,29,72,.12); }
  .dotstatus.info{ background: rgba(255,140,0,.95); box-shadow: 0 0 0 5px rgba(255,140,0,.12); }
</style>
{% endblock %}

{% block content %}
<div class="logs-stack">
  <div class="card">
    <h1>Logs</h1>
    <p class="muted">Vista legible del archivo <code>logs.jsonl</code>. El log interno se mantiene igual; aquí solo mejoramos la presentación.</p>

    <form method="get" action="{{ url_for('logs') }}" style="margin-top:12px;">
      <div class="row">
        <div>
          <label>Buscar</label>
          <input name="q" value="{{ q }}" placeholder="Ej: run_id=..., campana_id=3, correo@dominio.com, error..." />
        </div>
        <div>
          <label>Tipo</label>
          <select name="type">
            <option value="">(Todos)</option>
            {% for t in tipos %}
              <option value="{{ t }}" {% if type_filter==t %}selected{% endif %}>{{ t }}</option>
            {% endfor %}
          </select>
        </div>
      </div>

      <div style="margin-top:12px; display:flex; gap:10px; flex-wrap:wrap;">
        <button class="btn" type="submit">Aplicar filtros</button>
        <a class="btn ghost" href="{{ url_for('logs') }}">Limpiar</a>
      </div>
    </form>

    <div class="hint" style="margin-top:12px;">
      Tip: filtra por <code>run_id=</code> para ver un envío completo (inicio → emails → fin).
    </div>
  </div>

  <div class="card scroll logs">
    <div style="display:flex; justify-content:space-between; align-items:flex-end; gap:12px;">
      <div>
        <h2>Actividad</h2>
        <p class="muted">Mostrando {{ rows|length }} evento(s).</p>
      </div>
      <div class="muted" style="font-size:12px;">
        <span class="badge ok">OK</span>
        <span class="badge warn">WARN</span>
        <span class="badge err">ERROR</span>
        <span class="badge info">INFO</span>
      </div>
    </div>

    {% if not rows %}
      <div class="hint">No hay resultados con los filtros actuales.</div>
    {% else %}

    <div class="tablewrap" style="margin-top:12px;">
      <table class="table logs">
        <thead>
          <tr>
            <th style="width:165px;">Fecha</th>
            <th style="width:200px;">Tipo</th>
            <th style="width:90px;">Campaña</th>
            <th style="width:240px;">Run</th>
            <th style="width:260px;">Email</th>
            <th>Detalle</th>
            <th style="width:90px; text-align:right;">Estado</th>
          </tr>
        </thead>
        <tbody>
          {% for e in rows %}
            {% set type = (e.type or '') %}
            {% set status = 'info' %}
            {% if type in ['email_enviado','campana_creada','config_actualizada','campana_envio_fin','adjuntos_subidos'] %}
              {% set status = 'ok' %}
            {% elif type in ['email_fallido','campana_bloqueada'] %}
              {% set status = 'err' %}
            {% elif type in ['email_saltado'] %}
              {% set status = 'warn' %}
            {% endif %}

            {% set ts = (e.ts or '') %}
            {% set campana_id = e.campana_id %}
            {% set run_id = e.run_id %}
            {% set to = e.to %}
            {% set idx = e.index %}
            {% set ms = e.duracion_ms %}
            {% set err = e.error %}
            {% set razon = e.razon %}
            {% set segundos = e.segundos %}
            {% set receptores = e.receptores %}
            {% set csv_file = e.csv_file %}
            {% set modo = e.modo %}

            {% set human = '' %}
            {% if type == 'campana_envio_inicio' %}
              {% set human = 'Inicio: ' ~ (receptores or '?') ~ ' receptor(es) · modo ' ~ (modo or '-') ~ ' · CSV ' ~ (csv_file or '-') %}
            {% elif type == 'email_enviado' %}
              {% set human = 'Enviado' ~ ((' · #' ~ idx) if idx is not none else '') ~ ((' · ' ~ ms ~ ' ms') if ms is not none else '') %}
            {% elif type == 'email_fallido' %}
              {% set human = 'Fallo' ~ ((' · #' ~ idx) if idx is not none else '') ~ ((' · ' ~ ms ~ ' ms') if ms is not none else '') ~ ((' · ' ~ err) if err else '') %}
            {% elif type == 'email_saltado' %}
              {% set human = 'Saltado' ~ ((' · #' ~ idx) if idx is not none else '') ~ ((' · ' ~ razon) if razon else '') %}
            {% elif type == 'delay' %}
              {% set human = 'Pausa: ' ~ (segundos or 0) ~ ' s' ~ ((' · #' ~ idx) if idx is not none else '') %}
            {% elif type == 'campana_envio_fin' %}
              {% set human = 'Fin: enviados ' ~ (e.enviados or 0) ~ ', fallidos ' ~ (e.fallidos or 0) ~ ', saltados ' ~ (e.saltados or 0) %}
            {% elif type == 'campana_creada' %}
              {% set human = 'Campaña creada · CSV ' ~ (csv_file or '-') %}
            {% elif type == 'adjuntos_subidos' %}
              {% set human = 'Adjuntos subidos: ' ~ (e.cantidad or 0) %}
            {% elif type == 'config_actualizada' %}
              {% set human = 'Configuración guardada' %}
            {% else %}
              {% set human = 'Evento registrado' %}
            {% endif %}

            <tr class="rowclick" data-toggle="json{{ loop.index }}">
              <td class="mono small">{{ ts }}</td>
              <td>
                <div style="display:flex; gap:8px; align-items:center;">
                  <span class="dotstatus {{ status }}"></span>
                  <code>{{ type }}</code>
                </div>
              </td>
              <td class="mono">{{ campana_id if campana_id is not none else '—' }}</td>
              <td class="mono small" title="{{ run_id or '' }}">{{ run_id if run_id else '—' }}</td>
              <td class="mono" title="{{ to or '' }}">{{ to if to else '—' }}</td>
              <td>{{ human }}</td>
              <td style="text-align:right;">
                <span class="badge {{ status }}">{{ status|upper }}</span>
              </td>
            </tr>

            <tr id="json{{ loop.index }}" class="jsonrow" style="display:none;">
              <td colspan="7" style="padding:0;">
                <div style="padding:12px; border-top:1px dashed var(--stroke);">
                  <div class="muted" style="margin-bottom:8px;">JSON original (click en la fila para ocultar)</div>
                  <pre>{{ e | tojson(indent=2) }}</pre>
                </div>
              </td>
            </tr>

          {% endfor %}
        </tbody>
      </table>
    </div>

    <div class="hint" style="margin-top:12px;">
      Click en una fila para ver el JSON completo del evento.
    </div>

    {% endif %}
  </div>
</div>
{% endblock %}

{% block scripts %}
<script>
(function(){
  function toggleRow(id){
    var el = document.getElementById(id);
    if(!el) return;
    el.style.display = (el.style.display === "none" || el.style.display === "") ? "table-row" : "none";
  }
  document.querySelectorAll("tr.rowclick[data-toggle]").forEach(function(tr){
    tr.addEventListener("click", function(){
      toggleRow(tr.getAttribute("data-toggle"));
    });
  });
})();
</script>
{% endblock %}


```
## uploads
### 1
### 2
### 3
### 4