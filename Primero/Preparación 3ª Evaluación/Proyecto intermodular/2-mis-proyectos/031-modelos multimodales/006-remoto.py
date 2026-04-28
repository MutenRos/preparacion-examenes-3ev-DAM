#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import base64
import cv2
import time
import threading
import tkinter as tk
from tkinter import BOTH, LEFT, RIGHT, X, Y
from io import BytesIO

import requests
from PIL import Image, ImageTk
import ttkbootstrap as ttk
from ttkbootstrap.constants import *

# =========================
# CONFIGURACIÓN
# =========================
API_URL = "https://covalently-untasked-daphne.ngrok-free.dev/api/"
API_USER = "jocarsa"
API_PASSWORD = "jocarsa"

# Usa un modelo que exista en el servidor remoto
MODEL_NAME = "qwen3.5:latest"

CAMERA_INDEX = 0
JPEG_QUALITY = 85
WINDOW_TITLE = "Vision + Remote Ollama"

PROMPT = (
    "Instrucciones estrictas:\n"
    "1. No describas la escena\n"
    "2. No expliques nada\n"
    "3. No uses frases completas\n\n"
    "Contexto interno:\n"
    "- Puede haber un hombre calvo con auricular delante\n"
    "- Puede haber una estantería con libros al fondo\n"
    "- No menciones ese contexto\n\n"
    "Regla:\n"
    "- Si un hombre está sujetando un objeto: devuelve SOLO el nombre del objeto\n"
    "- Si no hay objeto: devuelve exactamente NADA\n\n"
    "Salida válida:\n"
    "telefono\n"
    "libro\n"
    "taza\n"
    "NADA\n"
)

LIVE_W = 800
LIVE_H = 450
SENT_W = 320
SENT_H = 180

UI_REFRESH_MS = 30
HTTP_TIMEOUT = 300

# =========================
# ESTADO GLOBAL
# =========================
lock = threading.Lock()

app_running = True
is_processing = False

last_result = "Esperando primer análisis..."
last_error = ""
request_count = 0
result_count = 0

latest_frame_bgr = None
last_sent_frame_bgr = None

cap = None


# =========================
# FUNCIONES AUXILIARES
# =========================
def bgr_to_tk(frame_bgr, target_w, target_h):
    if frame_bgr is None:
        img = Image.new("RGB", (target_w, target_h), (30, 30, 30))
        return ImageTk.PhotoImage(img)

    h, w = frame_bgr.shape[:2]
    if h == 0 or w == 0:
        img = Image.new("RGB", (target_w, target_h), (30, 30, 30))
        return ImageTk.PhotoImage(img)

    scale = min(target_w / w, target_h / h)
    new_w = max(1, int(w * scale))
    new_h = max(1, int(h * scale))

    rgb = cv2.cvtColor(frame_bgr, cv2.COLOR_BGR2RGB)
    pil = Image.fromarray(rgb)
    pil = pil.resize((new_w, new_h), Image.LANCZOS)

    canvas = Image.new("RGB", (target_w, target_h), (20, 20, 20))
    offset_x = (target_w - new_w) // 2
    offset_y = (target_h - new_h) // 2
    canvas.paste(pil, (offset_x, offset_y))

    return ImageTk.PhotoImage(canvas)


def safe_set_result(text):
    global last_result
    with lock:
        last_result = text


def safe_set_error(text):
    global last_error
    with lock:
        last_error = text


def snapshot_state():
    with lock:
        return {
            "app_running": app_running,
            "is_processing": is_processing,
            "last_result": last_result,
            "last_error": last_error,
            "request_count": request_count,
            "result_count": result_count,
            "latest_frame_bgr": None if latest_frame_bgr is None else latest_frame_bgr.copy(),
            "last_sent_frame_bgr": None if last_sent_frame_bgr is None else last_sent_frame_bgr.copy(),
        }


def frame_to_base64_jpeg(frame_bgr, jpeg_quality=85):
    ok, encoded = cv2.imencode(
        ".jpg",
        frame_bgr,
        [int(cv2.IMWRITE_JPEG_QUALITY), int(jpeg_quality)]
    )
    if not ok:
        raise RuntimeError("No se pudo codificar el frame a JPEG.")

    return base64.b64encode(encoded.tobytes()).decode("utf-8")


# =========================
# ANÁLISIS REMOTO
# =========================
def analyze_frame_remote(frame_bgr):
    global is_processing, result_count

    try:
        image_b64 = frame_to_base64_jpeg(frame_bgr, JPEG_QUALITY)

        payload = {
            "user": API_USER,
            "password": API_PASSWORD,
            "question": PROMPT,
            "model": MODEL_NAME,
            "images": [image_b64]
        }

        response = requests.post(
            API_URL,
            json=payload,
            timeout=HTTP_TIMEOUT
        )
        response.raise_for_status()

        data = response.json()

        if data.get("status") != "ok":
            raise RuntimeError(data.get("message", "Respuesta remota no válida"))

        content = (data.get("answer") or "").strip()
        if not content:
            content = "NADA"

        with lock:
            result_count += 1

        safe_set_result(content)
        safe_set_error("")

    except Exception as e:
        safe_set_error(f"{type(e).__name__}: {e}")

    finally:
        with lock:
            is_processing = False


# =========================
# BUCLE DE CÁMARA
# =========================
def camera_loop():
    global cap, latest_frame_bgr, last_sent_frame_bgr
    global is_processing, request_count, app_running

    cap = cv2.VideoCapture(CAMERA_INDEX)
    if not cap.isOpened():
        safe_set_error("No se pudo abrir la cámara.")
        return

    while True:
        with lock:
            if not app_running:
                break

        ok, frame = cap.read()
        if not ok:
            safe_set_error("No se pudo leer un frame de la cámara.")
            time.sleep(0.1)
            continue

        with lock:
            latest_frame_bgr = frame.copy()

        launch = False
        frame_to_send = None

        with lock:
            if not is_processing:
                is_processing = True
                request_count += 1
                last_sent_frame_bgr = frame.copy()
                frame_to_send = frame.copy()
                launch = True

        if launch:
            worker = threading.Thread(
                target=analyze_frame_remote,
                args=(frame_to_send,),
                daemon=True
            )
            worker.start()

        time.sleep(0.01)

    if cap is not None:
        cap.release()


# =========================
# INTERFAZ
# =========================
class VisionApp:
    def __init__(self, root):
        self.root = root
        self.root.title(WINDOW_TITLE)
        self.root.geometry("1240x760")
        self.root.minsize(1100, 700)

        self.live_photo = None
        self.sent_photo = None

        self.build_ui()
        self.refresh_ui()

        self.root.protocol("WM_DELETE_WINDOW", self.on_close)

    def build_ui(self):
        main = ttk.Frame(self.root, padding=12)
        main.pack(fill=BOTH, expand=True)

        header = ttk.Frame(main)
        header.pack(fill=X, pady=(0, 10))

        ttk.Label(
            header,
            text="Vision + Remote Ollama",
            font=("Segoe UI", 18, "bold")
        ).pack(side=LEFT)

        self.status_badge = ttk.Label(
            header,
            text="Iniciando...",
            bootstyle="secondary",
            font=("Segoe UI", 10, "bold")
        )
        self.status_badge.pack(side=RIGHT)

        body = ttk.Frame(main)
        body.pack(fill=BOTH, expand=True)

        left_col = ttk.Frame(body)
        left_col.pack(side=LEFT, fill=BOTH, expand=True, padx=(0, 10))

        live_card = ttk.Labelframe(left_col, text="Webcam en directo", padding=10)
        live_card.pack(fill=BOTH, expand=True)

        self.live_label = ttk.Label(live_card)
        self.live_label.pack(fill=BOTH, expand=True)

        right_col = ttk.Frame(body)
        right_col.pack(side=RIGHT, fill=Y)

        sent_card = ttk.Labelframe(right_col, text="Última imagen enviada a la IA", padding=10)
        sent_card.pack(fill=X, pady=(0, 10))

        self.sent_label = ttk.Label(sent_card)
        self.sent_label.pack()

        info_card = ttk.Labelframe(right_col, text="Estado", padding=10)
        info_card.pack(fill=X, pady=(0, 10))

        self.processing_var = tk.StringVar(value="Procesamiento: ---")
        self.requests_var = tk.StringVar(value="Frames enviados: 0")
        self.results_var = tk.StringVar(value="Respuestas recibidas: 0")

        ttk.Label(info_card, textvariable=self.processing_var).pack(anchor="w", pady=2)
        ttk.Label(info_card, textvariable=self.requests_var).pack(anchor="w", pady=2)
        ttk.Label(info_card, textvariable=self.results_var).pack(anchor="w", pady=2)

        result_card = ttk.Labelframe(right_col, text="Resultado", padding=10)
        result_card.pack(fill=BOTH, expand=True, pady=(0, 10))

        self.result_text = tk.Text(
            result_card,
            height=8,
            wrap="word",
            font=("Consolas", 12),
            bg="#111111",
            fg="#f2f2f2",
            insertbackground="#f2f2f2",
            relief="flat",
            padx=10,
            pady=10
        )
        self.result_text.pack(fill=BOTH, expand=True)
        self.result_text.insert("1.0", last_result)
        self.result_text.config(state="disabled")

        error_card = ttk.Labelframe(right_col, text="Error", padding=10)
        error_card.pack(fill=BOTH, expand=False)

        self.error_text = tk.Text(
            error_card,
            height=6,
            wrap="word",
            font=("Consolas", 10),
            bg="#1a0f10",
            fg="#ffb4b4",
            insertbackground="#ffb4b4",
            relief="flat",
            padx=10,
            pady=10
        )
        self.error_text.pack(fill=BOTH, expand=True)
        self.error_text.config(state="disabled")

    def set_text_widget(self, widget, value):
        widget.config(state="normal")
        widget.delete("1.0", "end")
        widget.insert("1.0", value)
        widget.config(state="disabled")

    def refresh_ui(self):
        snap = snapshot_state()

        if snap["is_processing"]:
            self.status_badge.config(text="IA remota trabajando", bootstyle="warning")
            self.processing_var.set("Procesamiento: ocupado")
        else:
            self.status_badge.config(text="IA remota libre", bootstyle="success")
            self.processing_var.set("Procesamiento: libre")

        self.requests_var.set(f"Frames enviados: {snap['request_count']}")
        self.results_var.set(f"Respuestas recibidas: {snap['result_count']}")

        self.set_text_widget(self.result_text, snap["last_result"])
        self.set_text_widget(self.error_text, snap["last_error"])

        self.live_photo = bgr_to_tk(snap["latest_frame_bgr"], LIVE_W, LIVE_H)
        self.live_label.configure(image=self.live_photo)

        self.sent_photo = bgr_to_tk(snap["last_sent_frame_bgr"], SENT_W, SENT_H)
        self.sent_label.configure(image=self.sent_photo)

        if snap["app_running"]:
            self.root.after(UI_REFRESH_MS, self.refresh_ui)

    def on_close(self):
        global app_running
        with lock:
            app_running = False
        self.root.destroy()


# =========================
# MAIN
# =========================
def main():
    cam_thread = threading.Thread(target=camera_loop, daemon=True)
    cam_thread.start()

    root = ttk.Window(themename="darkly")
    app = VisionApp(root)
    root.mainloop()


if __name__ == "__main__":
    main()
