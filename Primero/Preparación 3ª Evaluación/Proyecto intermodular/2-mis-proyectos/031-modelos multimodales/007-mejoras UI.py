#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import base64
import cv2
import time
import threading
import tkinter as tk
from tkinter import BOTH, LEFT, RIGHT, X, Y
from PIL import Image, ImageTk, ImageDraw
import requests
import ttkbootstrap as ttk
from ttkbootstrap.constants import *

# =========================
# CONFIGURACIÓN
# =========================
API_URL = "https://covalently-untasked-daphne.ngrok-free.dev/api/"
API_USER = "jocarsa"
API_PASSWORD = "jocarsa"

MODEL_NAME = "qwen3.5:latest"
CAMERA_INDEX = 0
JPEG_QUALITY = 85
WINDOW_TITLE = "Neural Vision Console"

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

LIVE_W = 960
LIVE_H = 540
SENT_W = 360
SENT_H = 202

UI_REFRESH_MS = 33
HTTP_TIMEOUT = 300

# =========================
# ESTADO GLOBAL
# =========================
lock = threading.Lock()

app_running = True
is_processing = False

last_result = "BOOT OK\nEsperando primer análisis..."
last_error = ""
request_count = 0
result_count = 0

latest_frame_bgr = None
last_sent_frame_bgr = None

last_request_started_at = None
last_response_time = 0.0

cap = None


# =========================
# HELPERS
# =========================
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
            "last_request_started_at": last_request_started_at,
            "last_response_time": last_response_time,
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


def add_hud_overlay(frame_bgr, label_top="LIVE FEED", label_bottom=None, accent=(0, 255, 255)):
    """
    Añade una capa visual tipo HUD sobre el frame.
    """
    if frame_bgr is None:
        return None

    frame = frame_bgr.copy()
    h, w = frame.shape[:2]

    cv2.rectangle(frame, (10, 10), (w - 10, h - 10), accent, 1)
    cv2.line(frame, (10, 40), (140, 40), accent, 1)
    cv2.line(frame, (10, h - 40), (220, h - 40), accent, 1)
    cv2.line(frame, (w - 140, 40), (w - 10, 40), accent, 1)
    cv2.line(frame, (w - 220, h - 40), (w - 10, h - 40), accent, 1)

    cv2.putText(frame, label_top, (24, 34), cv2.FONT_HERSHEY_SIMPLEX, 0.65, accent, 1, cv2.LINE_AA)

    if label_bottom:
        cv2.putText(frame, label_bottom, (24, h - 18), cv2.FONT_HERSHEY_SIMPLEX, 0.55, accent, 1, cv2.LINE_AA)

    # esquinas tech
    s = 24
    # top-left
    cv2.line(frame, (10, 10), (10 + s, 10), accent, 2)
    cv2.line(frame, (10, 10), (10, 10 + s), accent, 2)
    # top-right
    cv2.line(frame, (w - 10, 10), (w - 10 - s, 10), accent, 2)
    cv2.line(frame, (w - 10, 10), (w - 10, 10 + s), accent, 2)
    # bottom-left
    cv2.line(frame, (10, h - 10), (10 + s, h - 10), accent, 2)
    cv2.line(frame, (10, h - 10), (10, h - 10 - s), accent, 2)
    # bottom-right
    cv2.line(frame, (w - 10, h - 10), (w - 10 - s, h - 10), accent, 2)
    cv2.line(frame, (w - 10, h - 10), (w - 10, h - 10 - s), accent, 2)

    return frame


def bgr_to_tk(frame_bgr, target_w, target_h):
    if frame_bgr is None:
        img = Image.new("RGB", (target_w, target_h), (8, 12, 18))
        draw = ImageDraw.Draw(img)
        draw.rectangle((12, 12, target_w - 12, target_h - 12), outline=(0, 255, 255), width=1)
        draw.text((24, 24), "NO SIGNAL", fill=(0, 255, 255))
        return ImageTk.PhotoImage(img)

    h, w = frame_bgr.shape[:2]
    if h == 0 or w == 0:
        img = Image.new("RGB", (target_w, target_h), (8, 12, 18))
        return ImageTk.PhotoImage(img)

    scale = min(target_w / w, target_h / h)
    new_w = max(1, int(w * scale))
    new_h = max(1, int(h * scale))

    rgb = cv2.cvtColor(frame_bgr, cv2.COLOR_BGR2RGB)
    pil = Image.fromarray(rgb)
    pil = pil.resize((new_w, new_h), Image.LANCZOS)

    canvas = Image.new("RGB", (target_w, target_h), (6, 10, 16))
    offset_x = (target_w - new_w) // 2
    offset_y = (target_h - new_h) // 2
    canvas.paste(pil, (offset_x, offset_y))

    return ImageTk.PhotoImage(canvas)


# =========================
# REMOTE AI
# =========================
def analyze_frame_remote(frame_bgr):
    global is_processing, result_count, last_response_time

    t0 = time.time()

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

        elapsed = time.time() - t0

        with lock:
            result_count += 1
            last_response_time = elapsed

        safe_set_result(content)
        safe_set_error("")

    except Exception as e:
        safe_set_error(f"{type(e).__name__}: {e}")

    finally:
        with lock:
            is_processing = False


# =========================
# BUCLE CÁMARA
# =========================
def camera_loop():
    global cap, latest_frame_bgr, last_sent_frame_bgr
    global is_processing, request_count, app_running, last_request_started_at

    cap = cv2.VideoCapture(CAMERA_INDEX)
    if not cap.isOpened():
        safe_set_error("No se pudo abrir la cámara.")
        return

    # Intento de fijar resolución
    cap.set(cv2.CAP_PROP_FRAME_WIDTH, 1280)
    cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 720)

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
                last_request_started_at = time.time()
                last_sent_frame_bgr = frame.copy()
                frame_to_send = frame.copy()
                launch = True

        if launch:
            threading.Thread(
                target=analyze_frame_remote,
                args=(frame_to_send,),
                daemon=True
            ).start()

        time.sleep(0.01)

    if cap is not None:
        cap.release()


# =========================
# UI
# =========================
class TechCard(ttk.Frame):
    def __init__(self, parent, title, bootstyle="info", *args, **kwargs):
        super().__init__(parent, *args, **kwargs)
        self.configure(padding=0)

        outer = ttk.Frame(self, bootstyle=bootstyle)
        outer.pack(fill=BOTH, expand=True)

        head = ttk.Frame(outer, bootstyle=bootstyle)
        head.pack(fill=X)

        ttk.Label(
            head,
            text=f"  {title}",
            font=("Consolas", 10, "bold"),
            bootstyle=bootstyle
        ).pack(side=LEFT, pady=(0, 0))

        body = ttk.Frame(outer, padding=10)
        body.pack(fill=BOTH, expand=True)

        self.body = body


class VisionApp:
    def __init__(self, root):
        self.root = root
        self.root.title(WINDOW_TITLE)
        self.root.geometry("1680x980")
        self.root.minsize(1400, 860)

        self.live_photo = None
        self.sent_photo = None

        self.spinner_frames = ["◐", "◓", "◑", "◒"]
        self.spinner_index = 0
        self.dot_phase = 0

        self.build_styles()
        self.build_ui()
        self.refresh_ui()

        self.root.protocol("WM_DELETE_WINDOW", self.on_close)

    def build_styles(self):
        style = ttk.Style()

        style.configure("Tech.TFrame", background="#071018")
        style.configure("TechTitle.TLabel", background="#071018", foreground="#73f7ff")
        style.configure("HUD.TLabel", background="#071018", foreground="#a8f8ff")
        style.configure("BigValue.TLabel", background="#071018", foreground="#72ffe6")
        style.configure("Subtle.TLabel", background="#071018", foreground="#7da8b3")
        style.configure("Warn.TLabel", background="#071018", foreground="#ffd166")
        style.configure("Danger.TLabel", background="#071018", foreground="#ff8fa3")
        style.configure("Accent.TLabel", background="#071018", foreground="#00e5ff")
        style.configure("Green.TLabel", background="#071018", foreground="#63ffa8")

        style.configure(
            "Tech.Horizontal.TProgressbar",
            troughcolor="#0a1621",
            background="#00e5ff",
            bordercolor="#1a2a35",
            lightcolor="#00e5ff",
            darkcolor="#00e5ff"
        )

    def build_ui(self):
        self.root.configure(bg="#071018")

        main = ttk.Frame(self.root, style="Tech.TFrame", padding=12)
        main.pack(fill=BOTH, expand=True)

        # =========================
        # TOP BAR
        # =========================
        top = ttk.Frame(main, style="Tech.TFrame")
        top.pack(fill=X, pady=(0, 10))

        left_top = ttk.Frame(top, style="Tech.TFrame")
        left_top.pack(side=LEFT, fill=X, expand=True)

        ttk.Label(
            left_top,
            text="NEURAL VISION CONSOLE",
            font=("Consolas", 24, "bold"),
            style="TechTitle.TLabel"
        ).pack(anchor="w")

        ttk.Label(
            left_top,
            text="REMOTE VISION INFERENCE / LIVE CAMERA / AI OBJECT DETECTION",
            font=("Consolas", 10),
            style="Subtle.TLabel"
        ).pack(anchor="w", pady=(2, 0))

        right_top = ttk.Frame(top, style="Tech.TFrame")
        right_top.pack(side=RIGHT)

        self.clock_label = ttk.Label(
            right_top,
            text="--:--:--",
            font=("Consolas", 18, "bold"),
            style="Accent.TLabel"
        )
        self.clock_label.pack(anchor="e")

        self.status_badge = ttk.Label(
            right_top,
            text="BOOTING",
            font=("Consolas", 11, "bold"),
            style="Warn.TLabel"
        )
        self.status_badge.pack(anchor="e", pady=(4, 0))

        # =========================
        # MID BAR
        # =========================
        midbar = ttk.Frame(main, style="Tech.TFrame")
        midbar.pack(fill=X, pady=(0, 10))

        self.loading_label = ttk.Label(
            midbar,
            text="SYSTEM IDLE",
            font=("Consolas", 11, "bold"),
            style="Green.TLabel"
        )
        self.loading_label.pack(side=LEFT)

        self.progress = ttk.Progressbar(
            midbar,
            mode="indeterminate",
            style="Tech.Horizontal.TProgressbar",
            length=380
        )
        self.progress.pack(side=LEFT, padx=20, fill=X, expand=False)

        self.latency_label = ttk.Label(
            midbar,
            text="LATENCY 0.000 s",
            font=("Consolas", 11),
            style="HUD.TLabel"
        )
        self.latency_label.pack(side=RIGHT)

        # =========================
        # BODY
        # =========================
        body = ttk.Frame(main, style="Tech.TFrame")
        body.pack(fill=BOTH, expand=True)

        # LEFT SIDE
        left = ttk.Frame(body, style="Tech.TFrame")
        left.pack(side=LEFT, fill=BOTH, expand=True, padx=(0, 10))

        live_card = TechCard(left, "LIVE CAMERA FEED", bootstyle="info")
        live_card.pack(fill=BOTH, expand=True)

        self.live_label = ttk.Label(live_card.body)
        self.live_label.pack(fill=BOTH, expand=True)

        # BOTTOM STATS
        stats_row = ttk.Frame(left, style="Tech.TFrame")
        stats_row.pack(fill=X, pady=(10, 0))

        self.card_requests = self.create_metric_card(stats_row, "FRAMES SENT", "0")
        self.card_requests.pack(side=LEFT, fill=X, expand=True, padx=(0, 8))

        self.card_results = self.create_metric_card(stats_row, "RESPONSES", "0")
        self.card_results.pack(side=LEFT, fill=X, expand=True, padx=4)

        self.card_state = self.create_metric_card(stats_row, "ENGINE", "IDLE")
        self.card_state.pack(side=LEFT, fill=X, expand=True, padx=(8, 0))

        # RIGHT SIDE
        right = ttk.Frame(body, style="Tech.TFrame")
        right.pack(side=RIGHT, fill=Y)

        sent_card = TechCard(right, "LAST FRAME SENT TO AI", bootstyle="warning")
        sent_card.pack(fill=X, pady=(0, 10))

        self.sent_label = ttk.Label(sent_card.body)
        self.sent_label.pack()

        result_card = TechCard(right, "INFERENCE RESULT", bootstyle="success")
        result_card.pack(fill=BOTH, expand=True, pady=(0, 10))

        self.result_text = tk.Text(
            result_card.body,
            height=10,
            wrap="word",
            font=("Consolas", 16, "bold"),
            bg="#03131a",
            fg="#72ffe6",
            insertbackground="#72ffe6",
            relief="flat",
            bd=0,
            padx=14,
            pady=14
        )
        self.result_text.pack(fill=BOTH, expand=True)
        self.result_text.insert("1.0", last_result)
        self.result_text.config(state="disabled")

        error_card = TechCard(right, "ERROR / DIAGNOSTICS", bootstyle="danger")
        error_card.pack(fill=BOTH, expand=False, pady=(0, 10))

        self.error_text = tk.Text(
            error_card.body,
            height=7,
            wrap="word",
            font=("Consolas", 10),
            bg="#18070b",
            fg="#ff95aa",
            insertbackground="#ff95aa",
            relief="flat",
            bd=0,
            padx=14,
            pady=14
        )
        self.error_text.pack(fill=BOTH, expand=True)
        self.error_text.config(state="disabled")

        footer = ttk.Frame(right, style="Tech.TFrame")
        footer.pack(fill=X)

        self.footer_label = ttk.Label(
            footer,
            text=f"MODEL {MODEL_NAME}   |   REMOTE API ACTIVE",
            font=("Consolas", 10),
            style="Subtle.TLabel"
        )
        self.footer_label.pack(anchor="w")

    def create_metric_card(self, parent, title, value):
        card = ttk.Frame(parent, style="Tech.TFrame", padding=10)
        card.configure(borderwidth=1)

        ttk.Label(
            card,
            text=title,
            font=("Consolas", 10),
            style="Subtle.TLabel"
        ).pack(anchor="w")

        value_label = ttk.Label(
            card,
            text=value,
            font=("Consolas", 20, "bold"),
            style="BigValue.TLabel"
        )
        value_label.pack(anchor="w", pady=(4, 0))

        card.value_label = value_label
        return card

    def set_text_widget(self, widget, value):
        widget.config(state="normal")
        widget.delete("1.0", "end")
        widget.insert("1.0", value)
        widget.config(state="disabled")

    def update_loading_visuals(self, processing):
        if processing:
            spin = self.spinner_frames[self.spinner_index % len(self.spinner_frames)]
            self.spinner_index += 1

            dots = "." * ((self.dot_phase % 3) + 1)
            self.dot_phase += 1

            self.loading_label.config(
                text=f"{spin} AI ANALYZING FRAME{dots}",
                style="Warn.TLabel"
            )
            self.status_badge.config(text="PROCESSING", style="Warn.TLabel")

            try:
                if str(self.progress.cget("mode")) == "indeterminate":
                    self.progress.start(10)
            except Exception:
                pass
        else:
            self.loading_label.config(
                text="● SYSTEM IDLE / WAITING NEXT FRAME",
                style="Green.TLabel"
            )
            self.status_badge.config(text="READY", style="Green.TLabel")
            self.progress.stop()

    def refresh_ui(self):
        snap = snapshot_state()

        now_str = time.strftime("%H:%M:%S")
        self.clock_label.config(text=now_str)

        self.update_loading_visuals(snap["is_processing"])

        self.card_requests.value_label.config(text=str(snap["request_count"]))
        self.card_results.value_label.config(text=str(snap["result_count"]))
        self.card_state.value_label.config(text="BUSY" if snap["is_processing"] else "IDLE")

        self.latency_label.config(text=f"LATENCY {snap['last_response_time']:.3f} s")

        # Resultado / error
        self.set_text_widget(self.result_text, snap["last_result"])
        self.set_text_widget(self.error_text, snap["last_error"] if snap["last_error"] else "No errors.")

        # Live frame con HUD
        live_overlay = None
        if snap["latest_frame_bgr"] is not None:
            live_overlay = add_hud_overlay(
                snap["latest_frame_bgr"],
                label_top="LIVE FEED",
                label_bottom=time.strftime("CAM %H:%M:%S"),
                accent=(255, 255, 0)
            )
        self.live_photo = bgr_to_tk(live_overlay, LIVE_W, LIVE_H)
        self.live_label.configure(image=self.live_photo)

        # Sent frame con HUD
        sent_overlay = None
        if snap["last_sent_frame_bgr"] is not None:
            sent_overlay = add_hud_overlay(
                snap["last_sent_frame_bgr"],
                label_top="FRAME UNDER ANALYSIS",
                label_bottom="REMOTE INFERENCE",
                accent=(0, 255, 255)
            )
        self.sent_photo = bgr_to_tk(sent_overlay, SENT_W, SENT_H)
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

    root = ttk.Window(themename="cyborg")
    app = VisionApp(root)
    root.mainloop()


if __name__ == "__main__":
    main()
