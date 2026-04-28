#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import cv2
import os
import time
import tempfile
import threading
from ollama import chat

# =========================
# CONFIGURACIÓN
# =========================
MODEL_NAME = "qwen3.5:4b"
CAMERA_INDEX = 0

# Cada cuántos segundos intentamos lanzar un nuevo análisis
# pero SOLO si el modelo no está ocupado
ANALYSIS_INTERVAL = 2.0

# Prompt para describir la escena
PROMPT = (
    "Instrucciones estrictas:\n"
    "1. No describas la escena\n"
    "2. No expliques nada\n"
    "3. No uses frases completas\n\n"
    "Regla:\n"
    "- Si un hombre está sujetando un objeto: devuelve SOLO el nombre del objeto\n"
    "- Si no hay objeto: devuelve exactamente NADA\n\n"
    "Salida válida:\n"
    "telefono\n"
    "libro\n"
    "taza\n"
    "NADA\n"
)

WINDOW_NAME = "Vision + Ollama"
JPEG_QUALITY = 85

# =========================
# ESTADO GLOBAL
# =========================
last_description = "Esperando primer análisis..."
last_error = ""
is_processing = False
last_request_time = 0.0

lock = threading.Lock()


# =========================
# FUNCIONES AUXILIARES
# =========================
def draw_multiline_text(
    image,
    text,
    origin=(10, 30),
    line_height=28,
    max_width_chars=60,
    color=(255, 255, 255),
    bg_color=(0, 0, 0),
    font_scale=0.7,
    thickness=2,
):
    """
    Dibuja texto multilínea sencillo sobre la imagen.
    """
    x, y = origin

    # Wrap manual básico por número de caracteres
    words = text.split()
    lines = []
    current = ""

    for word in words:
        candidate = word if not current else current + " " + word
        if len(candidate) <= max_width_chars:
            current = candidate
        else:
            if current:
                lines.append(current)
            current = word
    if current:
        lines.append(current)

    if not lines:
        lines = [""]

    font = cv2.FONT_HERSHEY_SIMPLEX

    # Medir caja total
    widths = []
    heights = []
    baselines = []
    for line in lines:
        (w, h), b = cv2.getTextSize(line, font, font_scale, thickness)
        widths.append(w)
        heights.append(h)
        baselines.append(b)

    box_w = max(widths) + 20
    box_h = len(lines) * line_height + 20

    # Fondo
    cv2.rectangle(
        image,
        (x - 8, y - 24),
        (x - 8 + box_w, y - 24 + box_h),
        bg_color,
        -1,
    )

    # Texto
    yy = y
    for line in lines:
        cv2.putText(
            image,
            line,
            (x, yy),
            font,
            font_scale,
            color,
            thickness,
            cv2.LINE_AA,
        )
        yy += line_height


def analyze_frame_with_ollama(frame):
    """
    Guarda temporalmente el frame y lo envía a Ollama.
    No lanza nuevos análisis; eso lo controla el bucle principal.
    """
    global last_description, last_error, is_processing

    temp_path = None

    try:
        # Guardar frame temporal en JPG
        with tempfile.NamedTemporaryFile(suffix=".jpg", delete=False) as tmp:
            temp_path = tmp.name

        cv2.imwrite(
            temp_path,
            frame,
            [int(cv2.IMWRITE_JPEG_QUALITY), JPEG_QUALITY]
        )

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

        with lock:
            last_description = content if content else "(Sin contenido)"
            last_error = ""

    except Exception as e:
        with lock:
            last_error = f"Error: {e}"

    finally:
        if temp_path and os.path.exists(temp_path):
            try:
                os.remove(temp_path)
            except Exception:
                pass

        with lock:
            is_processing = False


# =========================
# APP PRINCIPAL
# =========================
def main():
    global is_processing, last_request_time

    cap = cv2.VideoCapture(CAMERA_INDEX)

    if not cap.isOpened():
        print("No se pudo abrir la cámara.")
        return

    cv2.namedWindow(WINDOW_NAME, cv2.WINDOW_NORMAL)

    while True:
        ok, frame = cap.read()
        if not ok:
            print("No se pudo leer un frame de la cámara.")
            break

        # Copia para pintar overlays
        display = frame.copy()

        now = time.time()

        with lock:
            processing_now = is_processing
            description_now = last_description
            error_now = last_error

        # Lanzar análisis SOLO si:
        # 1) no hay uno en curso
        # 2) ha pasado el intervalo mínimo
        if (not processing_now) and (now - last_request_time >= ANALYSIS_INTERVAL):
            with lock:
                is_processing = True
                last_request_time = now

            # Congelar el frame actual para análisis
            frame_for_analysis = frame.copy()

            worker = threading.Thread(
                target=analyze_frame_with_ollama,
                args=(frame_for_analysis,),
                daemon=True,
            )
            worker.start()

        # Dibujar estado
        status_text = "Analizando..." if processing_now else "Libre"
        status_color = (0, 255, 255) if processing_now else (0, 255, 0)

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

        draw_multiline_text(
            display,
            f"Descripcion: {description_now}",
            origin=(10, 70),
            max_width_chars=70,
            color=(255, 255, 255),
            bg_color=(0, 0, 0),
            font_scale=0.65,
            thickness=2,
        )

        if error_now:
            draw_multiline_text(
                display,
                error_now,
                origin=(10, display.shape[0] - 40),
                max_width_chars=80,
                color=(255, 255, 255),
                bg_color=(0, 0, 180),
                font_scale=0.6,
                thickness=2,
            )

        cv2.imshow(WINDOW_NAME, display)

        key = cv2.waitKey(1) & 0xFF
        if key == 27 or key == ord("q"):
            break

    cap.release()
    cv2.destroyAllWindows()


if __name__ == "__main__":
    main()
