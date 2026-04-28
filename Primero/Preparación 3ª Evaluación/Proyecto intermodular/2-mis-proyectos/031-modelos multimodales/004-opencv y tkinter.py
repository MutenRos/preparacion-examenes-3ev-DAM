#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import cv2
import os
import time
import tempfile
import threading
import queue
import tkinter as tk
from tkinter import ttk
from ollama import chat

# =========================
# CONFIGURACIÓN
# =========================
MODEL_NAME = "qwen3.5:4b"
CAMERA_INDEX = 0
ANALYSIS_INTERVAL = 2.0
JPEG_QUALITY = 85
WINDOW_NAME = "Webcam"

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

# =========================
# ESTADO COMPARTIDO
# =========================
state_lock = threading.Lock()

last_result = "Esperando análisis..."
last_error = ""
is_processing = False
last_request_time = 0.0
current_interval = ANALYSIS_INTERVAL
app_running = True
camera_ok = False
current_frame = None

# Cola opcional para eventos futuros
ui_queue = queue.Queue()


# =========================
# FUNCIONES DE ESTADO
# =========================
def set_result(text):
    global last_result
    with state_lock:
        last_result = text


def set_error(text):
    global last_error
    with state_lock:
        last_error = text


def set_processing(value):
    global is_processing
    with state_lock:
        is_processing = value


def get_state_snapshot():
    with state_lock:
        return {
            "last_result": last_result,
            "last_error": last_error,
            "is_processing": is_processing,
            "last_request_time": last_request_time,
            "current_interval": current_interval,
            "camera_ok": camera_ok,
            "app_running": app_running,
        }


# =========================
# ANÁLISIS OLLAMA
# =========================
def analyze_frame_with_ollama(frame):
    global is_processing

    temp_path = None

    try:
        with tempfile.NamedTemporaryFile(suffix=".jpg", delete=False) as tmp:
            temp_path = tmp.name

        ok = cv2.imwrite(
            temp_path,
            frame,
            [int(cv2.IMWRITE_JPEG_QUALITY), JPEG_QUALITY]
        )

        if not ok:
            raise RuntimeError("No se pudo guardar la imagen temporal.")

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

        set_result(content)
        set_error("")

    except Exception as e:
        set_error(f"{type(e).__name__}: {e}")

    finally:
        if temp_path and os.path.exists(temp_path):
            try:
                os.remove(temp_path)
            except Exception:
                pass

        set_processing(False)


# =========================
# HILO DE CÁMARA
# =========================
def camera_loop():
    global current_frame
    global last_request_time
    global camera_ok
    global app_running
    global is_processing

    cap = cv2.VideoCapture(CAMERA_INDEX)

    if not cap.isOpened():
        camera_ok = False
        set_error("No se pudo abrir la cámara.")
        return

    camera_ok = True
    cv2.namedWindow(WINDOW_NAME, cv2.WINDOW_NORMAL)

    while app_running:
        ok, frame = cap.read()
        if not ok:
            set_error("No se pudo leer un frame de la cámara.")
            time.sleep(0.2)
            continue

        current_frame = frame.copy()

        # Feed limpio, solo con una pequeña línea de estado
        snap = get_state_snapshot()
        status_text = "Analizando..." if snap["is_processing"] else "Libre"
        status_color = (0, 255, 255) if snap["is_processing"] else (0, 255, 0)

        display = frame.copy()
        cv2.putText(
            display,
            f"Estado: {status_text}",
            (10, 30),
            cv2.FONT_HERSHEY_SIMPLEX,
            0.8,
            status_color,
            2,
            cv2.LINE_AA,
        )

        cv2.imshow(WINDOW_NAME, display)

        # Lanzar análisis si toca y no hay otro en curso
        now = time.time()
        with state_lock:
            can_launch = (not is_processing) and (now - last_request_time >= current_interval)
            if can_launch:
                is_processing = True
                last_request_time = now

        if can_launch:
            frame_for_analysis = frame.copy()
            worker = threading.Thread(
                target=analyze_frame_with_ollama,
                args=(frame_for_analysis,),
                daemon=True
            )
            worker.start()

        key = cv2.waitKey(1) & 0xFF
        if key == 27 or key == ord("q"):
            app_running = False
            break

    cap.release()
    cv2.destroyAllWindows()


# =========================
# INTERFAZ TKINTER
# =========================
class App:
    def __init__(self, root):
        self.root = root
        self.root.title("Detector de objeto con Ollama")
        self.root.geometry("560x420")
        self.root.minsize(520, 360)

        self.build_ui()
        self.refresh_ui()

        self.root.protocol("WM_DELETE_WINDOW", self.on_close)

    def build_ui(self):
        container = ttk.Frame(self.root, padding=14)
        container.pack(fill="both", expand=True)

        title = ttk.Label(
            container,
            text="Visión + Ollama",
            font=("Arial", 16, "bold")
        )
        title.pack(anchor="w", pady=(0, 10))

        desc = ttk.Label(
            container,
            text="OpenCV muestra la cámara. Esta ventana controla el análisis y muestra el resultado.",
            wraplength=520,
            justify="left"
        )
        desc.pack(anchor="w", pady=(0, 12))

        # Estado general
        status_frame = ttk.LabelFrame(container, text="Estado", padding=10)
        status_frame.pack(fill="x", pady=(0, 10))

        self.camera_var = tk.StringVar(value="Cámara: ---")
        self.processing_var = tk.StringVar(value="Procesamiento: ---")
        self.interval_var = tk.StringVar(value=f"Intervalo: {ANALYSIS_INTERVAL:.1f} s")

        ttk.Label(status_frame, textvariable=self.camera_var).pack(anchor="w")
        ttk.Label(status_frame, textvariable=self.processing_var).pack(anchor="w", pady=(4, 0))
        ttk.Label(status_frame, textvariable=self.interval_var).pack(anchor="w", pady=(4, 0))

        # Resultado
        result_frame = ttk.LabelFrame(container, text="Último resultado", padding=10)
        result_frame.pack(fill="both", expand=True, pady=(0, 10))

        self.result_text = tk.Text(result_frame, height=7, wrap="word")
        self.result_text.pack(fill="both", expand=True)
        self.result_text.insert("1.0", "Esperando análisis...")
        self.result_text.configure(state="disabled")

        # Error
        error_frame = ttk.LabelFrame(container, text="Error", padding=10)
        error_frame.pack(fill="both", expand=False, pady=(0, 10))

        self.error_text = tk.Text(error_frame, height=4, wrap="word")
        self.error_text.pack(fill="x", expand=False)
        self.error_text.configure(state="disabled")

        # Controles
        controls = ttk.LabelFrame(container, text="Controles", padding=10)
        controls.pack(fill="x")

        row1 = ttk.Frame(controls)
        row1.pack(fill="x")

        ttk.Label(row1, text="Intervalo entre análisis (s):").pack(side="left")

        self.interval_entry = ttk.Entry(row1, width=10)
        self.interval_entry.pack(side="left", padx=(8, 8))
        self.interval_entry.insert(0, str(ANALYSIS_INTERVAL))

        ttk.Button(row1, text="Aplicar", command=self.apply_interval).pack(side="left")
        ttk.Button(row1, text="Forzar análisis", command=self.force_analysis).pack(side="left", padx=(8, 0))
        ttk.Button(row1, text="Limpiar error", command=self.clear_error).pack(side="left", padx=(8, 0))

        row2 = ttk.Frame(controls)
        row2.pack(fill="x", pady=(10, 0))

        ttk.Button(row2, text="Salir", command=self.on_close).pack(side="right")

    def set_text(self, widget, value):
        widget.configure(state="normal")
        widget.delete("1.0", "end")
        widget.insert("1.0", value)
        widget.configure(state="disabled")

    def apply_interval(self):
        global current_interval
        try:
            value = float(self.interval_entry.get().strip())
            if value <= 0:
                raise ValueError
            with state_lock:
                current_interval = value
            self.interval_var.set(f"Intervalo: {value:.1f} s")
            set_error("")
        except ValueError:
            set_error("El intervalo debe ser un número mayor que 0.")

    def force_analysis(self):
        global last_request_time, is_processing

        frame = current_frame
        if frame is None:
            set_error("Aún no hay frame disponible para analizar.")
            return

        with state_lock:
            if is_processing:
                set_error("Ya hay un análisis en curso.")
                return
            is_processing = True
            last_request_time = time.time()

        worker = threading.Thread(
            target=analyze_frame_with_ollama,
            args=(frame.copy(),),
            daemon=True
        )
        worker.start()
        set_error("")

    def clear_error(self):
        set_error("")

    def refresh_ui(self):
        snap = get_state_snapshot()

        self.camera_var.set("Cámara: OK" if snap["camera_ok"] else "Cámara: no disponible")
        self.processing_var.set(
            "Procesamiento: analizando" if snap["is_processing"] else "Procesamiento: libre"
        )
        self.interval_var.set(f"Intervalo: {snap['current_interval']:.1f} s")

        self.set_text(self.result_text, snap["last_result"])
        self.set_text(self.error_text, snap["last_error"])

        if snap["app_running"]:
            self.root.after(200, self.refresh_ui)

    def on_close(self):
        global app_running
        app_running = False
        try:
            self.root.destroy()
        except Exception:
            pass


# =========================
# MAIN
# =========================
def main():
    camera_thread = threading.Thread(target=camera_loop, daemon=True)
    camera_thread.start()

    root = tk.Tk()
    app = App(root)
    root.mainloop()


if __name__ == "__main__":
    main()
