#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import os
import cv2
import time
import tempfile
import threading
import tkinter as tk
from tkinter import BOTH, LEFT, RIGHT, X, Y
from PIL import Image, ImageTk
import ttkbootstrap as ttk
from ttkbootstrap.constants import *
from ollama import chat

# =========================
# CONFIGURACIÓN
# =========================
MODEL_NAME = "qwen3.5:4b"
CAMERA_INDEX = 0
JPEG_QUALITY = 85
WINDOW_TITLE = "Vision + Ollama"

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

# Tamaños de panel
LIVE_W = 800
LIVE_H = 450
SENT_W = 320
SENT_H = 180

UI_REFRESH_MS = 30

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

latest_frame_bgr = None          # último frame vivo de cámara
last_sent_frame_bgr = None       # último frame enviado a Ollama

cap = None


# =========================
# FUNCIONES AUXILIARES
# =========================
def bgr_to_tk(frame_bgr, target_w, target_h):
    """
    Convierte un frame OpenCV BGR a PhotoImage redimensionado manteniendo proporción.
    """
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


# =========================
# ANÁLISIS OLLAMA
# =========================
def analyze_frame_with_ollama(frame_bgr):
    global is_processing, result_count

    temp_path = None

    try:
        with tempfile.NamedTemporaryFile(suffix=".jpg", delete=False) as tmp:
            temp_path = tmp.name

        ok = cv2.imwrite(
            temp_path,
            frame_bgr,
            [int(cv2.IMWRITE_JPEG_QUALITY), JPEG_QUALITY]
        )
        if not ok:
            raise RuntimeError("No se pudo guardar la captura temporal.")

        response = chat(
            model=MODEL_NAME,
            messages=[
                {
                    "role": "user",
                    "content": PROMPT,
                    "images": [temp_path],
                }
            ],
        )

        content = response["message"]["content"].strip()
        if not content:
            content = "NADA"

        with lock:
            result_count += 1

        safe_set_result(content)
        safe_set_error("")

    except Exception as e:
        safe_set_error(f"{type(e).__name__}: {e}")

    finally:
        if temp_path and os.path.exists(temp_path):
            try:
                os.remove(temp_path)
            except Exception:
                pass

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

        # Guardamos el frame vivo para la previsualización
        with lock:
            latest_frame_bgr = frame.copy()

        # Regla: si Ollama está libre, enviar inmediatamente el frame actual
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
                target=analyze_frame_with_ollama,
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

        # Encabezado
        header = ttk.Frame(main)
        header.pack(fill=X, pady=(0, 10))

        ttk.Label(
            header,
            text="Vision + Ollama",
            font=("Segoe UI", 18, "bold")
        ).pack(side=LEFT)

        self.status_badge = ttk.Label(
            header,
            text="Iniciando...",
            bootstyle="secondary",
            font=("Segoe UI", 10, "bold")
        )
        self.status_badge.pack(side=RIGHT)

        # Cuerpo principal
        body = ttk.Frame(main)
        body.pack(fill=BOTH, expand=True)

        # Columna izquierda: cámara
        left_col = ttk.Frame(body)
        left_col.pack(side=LEFT, fill=BOTH, expand=True, padx=(0, 10))

        live_card = ttk.Labelframe(left_col, text="Webcam en directo", padding=10)
        live_card.pack(fill=BOTH, expand=True)

        self.live_label = ttk.Label(live_card)
        self.live_label.pack(fill=BOTH, expand=True)

        # Columna derecha: paneles
        right_col = ttk.Frame(body)
        right_col.pack(side=RIGHT, fill=Y)

        sent_card = ttk.Labelframe(right_col, text="Última imagen enviada a Ollama", padding=10)
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

        # Estado textual
        if snap["is_processing"]:
            self.status_badge.config(text="Ollama trabajando", bootstyle="warning")
            self.processing_var.set("Procesamiento: ocupado")
        else:
            self.status_badge.config(text="Ollama libre", bootstyle="success")
            self.processing_var.set("Procesamiento: libre")

        self.requests_var.set(f"Frames enviados: {snap['request_count']}")
        self.results_var.set(f"Respuestas recibidas: {snap['result_count']}")

        # Resultado y error
        self.set_text_widget(self.result_text, snap["last_result"])
        self.set_text_widget(self.error_text, snap["last_error"])

        # Imagen en directo
        self.live_photo = bgr_to_tk(snap["latest_frame_bgr"], LIVE_W, LIVE_H)
        self.live_label.configure(image=self.live_photo)

        # Imagen enviada
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
