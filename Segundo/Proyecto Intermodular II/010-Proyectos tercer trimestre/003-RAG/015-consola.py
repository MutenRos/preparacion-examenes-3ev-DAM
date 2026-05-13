#!/usr/bin/env python3
import os
import sys
import json
import math
import time
import shutil
import subprocess
from pathlib import Path

import requests


OLLAMA_EMBED_URL = "http://127.0.0.1:11434/api/embed"
OLLAMA_MODEL = "nomic-embed-text:v1.5"

PYTHON_BIN = str(Path(__file__).parent / "venv" / "bin" / "python")
CHROMA_SEARCH_SCRIPT = str(Path(__file__).parent / "buscar_chroma.py")

INTENSITY = 8.0
MAX_TEXT_LINES = 8


def clear():
    print("\033[2J\033[H", end="")


def move(row, col):
    print(f"\033[{row};{col}H", end="")


def hide_cursor():
    print("\033[?25l", end="")


def show_cursor():
    print("\033[?25h", end="")


def terminal_size():
    size = shutil.get_terminal_size((100, 35))
    return size.columns, size.lines


def center(text, width):
    text = str(text)
    if len(text) >= width:
        return text[:width]
    return " " * ((width - len(text)) // 2) + text


def call_ollama_embed(text):
    payload = {
        "model": OLLAMA_MODEL,
        "input": text
    }

    response = requests.post(
        OLLAMA_EMBED_URL,
        json=payload,
        timeout=300
    )

    response.raise_for_status()
    return response.json()


def call_chroma_search(query):
    script = Path(CHROMA_SEARCH_SCRIPT)

    if not script.exists():
        raise FileNotFoundError(f"No existe el script Python: {CHROMA_SEARCH_SCRIPT}")

    cmd = [
        PYTHON_BIN,
        CHROMA_SEARCH_SCRIPT,
        query
    ]

    result = subprocess.run(
        cmd,
        stdout=subprocess.PIPE,
        stderr=subprocess.STDOUT,
        text=True
    )

    output = result.stdout.strip()

    if not output:
        raise RuntimeError("Python no devolvió respuesta")

    try:
        data = json.loads(output)
    except json.JSONDecodeError:
        raise RuntimeError("Respuesta no JSON desde Python:\n" + output)

    if isinstance(data.get("results"), list):
        data["results"] = data["results"][:1]

    return data


def extract_embedding(data):
    values = data.get("embeddings", [[]])

    if not values or not isinstance(values[0], list):
        raise RuntimeError("Embedding no válido")

    return values[0]


def normalize_value(value):
    amplified = max(-1.0, min(1.0, value * INTENSITY))
    return (amplified + 1.0) / 2.0


def symbol_for_value(value):
    n = normalize_value(value)

    if n < 0.12:
        return "·"
    if n < 0.25:
        return "○"
    if n < 0.40:
        return "◌"
    if n < 0.55:
        return "●"
    if n < 0.70:
        return "◉"
    if n < 0.85:
        return "⬤"

    return "⭐"


def wrap_text(text, width, max_lines):
    words = str(text).replace("\n", " ").split()
    lines = []
    current = ""

    for word in words:
        if len(current) + len(word) + 1 > width:
            lines.append(current)
            current = word
        else:
            current = word if not current else current + " " + word

        if len(lines) >= max_lines:
            break

    if current and len(lines) < max_lines:
        lines.append(current)

    return lines


def draw_result(search, width):
    print(center("TEXTO RECUPERADO", width))
    print(center("=" * 60, width))
    print()

    if not search or search.get("status") != "ok":
        print(center("No se encontró ningún candidato.", width))
        return

    results = search.get("results", [])

    if not results:
        print(center("No se encontró ningún candidato.", width))
        return

    item = results[0]
    metadata = item.get("metadata", {})
    text = item.get("text", "")
    distance = item.get("distance", 0)

    filename = metadata.get("filename") or metadata.get("source") or ""
    section = metadata.get("section") or ""
    cycle = metadata.get("cycle") or ""

    meta = f"Archivo: {filename} | Ciclo: {cycle} | Sección: {section} | Distancia: {distance:.4f}"
    print(center(meta[:width - 4], width))
    print()

    for line in wrap_text(text, width - 8, MAX_TEXT_LINES):
        print(center(line, width))


def draw_brain(values, width, height, start_row):
    if not values:
        return

    brain_height = max(10, height - start_row - 5)
    center_x = width // 2
    center_y = start_row + brain_height // 2

    radius_x = min(width * 0.32, brain_height * 1.7)
    radius_y = brain_height * 0.42

    positions = []

    count = len(values)
    rings = math.ceil(math.sqrt(count))

    index = 0

    for ring in range(rings + 1):
        if index >= count:
            break

        if ring == 0:
            positions.append((center_x, center_y, values[index]))
            index += 1
            continue

        points = max(8, ring * 8)

        for i in range(points):
            if index >= count:
                break

            angle = (math.pi * 2 * i) / points
            r = ring / rings

            x = int(center_x + math.cos(angle) * radius_x * r)
            y = int(center_y + math.sin(angle) * radius_y * r)

            positions.append((x, y, values[index]))
            index += 1

    grid = {}

    for x, y, value in positions:
        if 1 <= x < width and start_row <= y < height - 3:
            grid[(x, y)] = symbol_for_value(value)

    for (x, y), char in grid.items():
        move(y, x)
        print(char, end="")


def render(values=None, search=None, status="Esperando consulta...", query=""):
    width, height = terminal_size()

    clear()
    hide_cursor()

    draw_result(search, width)

    brain_start = 13
    move(brain_start - 1, 1)
    print(center("BRAIN EMBEDDING", width))

    if values:
        draw_brain(values, width, height, brain_start)
    else:
        move(height // 2, 1)
        print(center("Sin embedding todavía", width))

    move(height - 3, 1)
    print(center("-" * min(width - 4, 80), width))

    move(height - 2, 1)
    print(center(status, width))

    move(height, 1)
    show_cursor()
    prompt = "Consulta > "
    print(prompt, end="", flush=True)


def main():
    query = "competencias profesionales del ciclo DAM"
    values = None
    search = None
    status = "Pulsa Enter para consultar. Escribe /salir para terminar."

    try:
        while True:
            render(values, search, status, query)

            user_input = input().strip()

            if user_input.lower() in {"/salir", "salir", "exit", "quit", "q"}:
                break

            if user_input:
                query = user_input

            status = "Generando embedding..."
            render(values, search, status, query)

            embed_json = call_ollama_embed(query)
            values = extract_embedding(embed_json)

            status = "Buscando mejor candidato en ChromaDB..."
            render(values, search, status, query)

            search = call_chroma_search(query)

            status = f'"{query}" · {len(values)} dimensiones · mejor candidato recuperado'
            render(values, search, status, query)

            time.sleep(0.2)

    except KeyboardInterrupt:
        pass

    except Exception as e:
        clear()
        show_cursor()
        print("Error:", e)

    finally:
        show_cursor()
        print()


if __name__ == "__main__":
    main()
