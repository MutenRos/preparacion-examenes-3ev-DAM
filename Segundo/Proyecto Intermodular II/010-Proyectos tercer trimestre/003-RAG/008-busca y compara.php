<?php
declare(strict_types=1);

const OLLAMA_EMBED_URL = 'http://127.0.0.1:11434/api/embed';
const OLLAMA_MODEL = 'nomic-embed-text:v1.5';

/*
    IMPORTANT:
    Adjust this path if needed.
    If the PHP file and buscar_chroma.py are in the same folder, this is OK.
*/
const PYTHON_BIN = __DIR__ . '/venv/bin/python';
const CHROMA_SEARCH_SCRIPT = __DIR__ . '/buscar_chroma.py';


function json_response(array $data, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}


function call_ollama_embed(string $input): array
{
    $data = [
        'model' => OLLAMA_MODEL,
        'input' => $input
    ];

    $ch = curl_init(OLLAMA_EMBED_URL);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ],
        CURLOPT_POSTFIELDS => json_encode($data, JSON_UNESCAPED_UNICODE),
        CURLOPT_TIMEOUT => 300
    ]);

    $response = curl_exec($ch);

    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);

        throw new RuntimeException($error);
    }

    $status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);

    if ($status < 200 || $status >= 300) {
        throw new RuntimeException("Error HTTP Ollama: $status - $response");
    }

    $json = json_decode($response, true);

    if (!is_array($json)) {
        throw new RuntimeException('Respuesta JSON inválida de Ollama');
    }

    return $json;
}


function call_chroma_search(string $query): array
{
    if (!file_exists(CHROMA_SEARCH_SCRIPT)) {
        throw new RuntimeException('No existe el script Python: ' . CHROMA_SEARCH_SCRIPT);
    }

    $cmd =
        escapeshellarg(PYTHON_BIN) . ' ' .
        escapeshellarg(CHROMA_SEARCH_SCRIPT) . ' ' .
        escapeshellarg($query) .
        ' 2>&1';

    $output = shell_exec($cmd);

    if ($output === null || trim($output) === '') {
        throw new RuntimeException('Python no devolvió respuesta');
    }

    $json = json_decode($output, true);

    if (!is_array($json)) {
        throw new RuntimeException("Respuesta no JSON desde Python:\n" . $output);
    }

    return $json;
}


if (isset($_GET['api'])) {
    $api = $_GET['api'];
    $input = trim((string)($_POST['input'] ?? $_GET['input'] ?? ''));

    if ($input === '') {
        $input = 'gato';
    }

    try {
        if ($api === 'embed') {
            $json = call_ollama_embed($input);
            json_response($json);
        }

        if ($api === 'search') {
            $json = call_chroma_search($input);
            json_response($json);
        }

        if ($api === 'ask') {
            $embedding = call_ollama_embed($input);
            $search = call_chroma_search($input);

            json_response([
                'status' => 'ok',
                'input' => $input,
                'embedding' => $embedding,
                'search' => $search
            ]);
        }

        json_response([
            'status' => 'error',
            'message' => 'API no reconocida'
        ], 404);

    } catch (Throwable $e) {
        json_response([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Embedding + ChromaDB</title>

<style>
body {
    margin: 0;
    overflow: hidden;
    background: #ffffff;
    font-family: Arial, sans-serif;
}

#canvas {
    position: fixed;
    inset: 0;
}

.cell {
    position: absolute;
    width: 24px;
    height: 24px;
    transform: translate(-50%, -50%);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: left 0.6s ease, top 0.6s ease;
}

.circle {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #333333;
    transform: scale(0);
    transition: transform 0.5s cubic-bezier(.34,1.56,.64,1);
}

#panel {
    position: fixed;
    left: 50%;
    bottom: 20px;
    transform: translateX(-50%);
    background: rgba(255,255,255,0.94);
    padding: 15px 20px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
    width: min(900px, calc(100vw - 40px));
    z-index: 10;
}

.controls {
    display: flex;
    gap: 10px;
    width: 100%;
}

input {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    flex: 1;
}

button {
    padding: 10px 15px;
    border-radius: 8px;
    border: none;
    background: #333333;
    color: #ffffff;
    cursor: pointer;
}

button:hover {
    background: #111111;
}

#info {
    font-size: 14px;
    color: #555555;
}

#results {
    width: 100%;
    max-height: 260px;
    overflow-y: auto;
    border-top: 1px solid #dddddd;
    padding-top: 10px;
    font-size: 14px;
    line-height: 1.45;
}

.result {
    margin-bottom: 12px;
    padding: 10px;
    border-radius: 10px;
    background: #f3f3f3;
}

.result-title {
    font-weight: bold;
    margin-bottom: 5px;
}

.result-meta {
    font-size: 12px;
    color: #666666;
    margin-bottom: 8px;
}

.result-text {
    white-space: pre-wrap;
}
</style>
</head>

<body>

<div id="canvas"></div>

<div id="panel">
    <div class="controls">
        <input id="texto" value="competencias profesionales del ciclo DAM">
        <button onclick="consultar()">Consultar</button>
    </div>

    <div id="info">Esperando...</div>
    <div id="results"></div>
</div>

<script>
const canvas = document.getElementById("canvas");

const HEX_SIZE = 15;
const SQRT3 = Math.sqrt(3);
const INTENSITY = 8;

function axialToPixel(q, r) {
    return {
        x: HEX_SIZE * SQRT3 * (q + r / 2),
        y: HEX_SIZE * 1.5 * r
    };
}

function hexCircle(count) {
    const candidates = [];
    const limit = Math.ceil(Math.sqrt(count) * 3);

    for (let q = -limit; q <= limit; q++) {
        for (let r = -limit; r <= limit; r++) {
            const p = axialToPixel(q, r);
            const dist = Math.sqrt(p.x * p.x + p.y * p.y);

            candidates.push({
                q,
                r,
                dist
            });
        }
    }

    candidates.sort((a, b) => a.dist - b.dist);

    return candidates.slice(0, count);
}

function recolocar(total) {
    const positions = hexCircle(total);
    const cx = window.innerWidth / 2;
    const cy = window.innerHeight / 2;

    positions.forEach((pos, i) => {
        const circle = document.querySelector(`.circle[data-index="${i}"]`);
        if (!circle) return;

        const cell = circle.parentElement;
        const p = axialToPixel(pos.q, pos.r);

        cell.style.left = `${cx + p.x}px`;
        cell.style.top = `${cy + p.y}px`;
    });
}

function pintarEmbedding(values) {
    const positions = hexCircle(values.length);
    const cx = window.innerWidth / 2;
    const cy = window.innerHeight / 2;

    values.forEach((value, i) => {
        let circle = document.querySelector(`.circle[data-index="${i}"]`);

        if (!circle) {
            const cell = document.createElement("div");
            cell.className = "cell";

            circle = document.createElement("div");
            circle.className = "circle";
            circle.dataset.index = i;

            cell.appendChild(circle);
            canvas.appendChild(cell);
        }

        const pos = positions[i];
        const p = axialToPixel(pos.q, pos.r);

        const cell = circle.parentElement;
        cell.style.left = `${cx + p.x}px`;
        cell.style.top = `${cy + p.y}px`;

        const amplified = Math.max(-1, Math.min(1, value * INTENSITY));
        const scale = 0.15 + ((amplified + 1) / 2) * 1.35;

        circle.style.transitionDelay = `${i * 3}ms`;
        circle.style.transform = `scale(${scale})`;
        circle.title = `#${i}: ${value}`;
    });
}

function escapeHtml(text) {
    return String(text)
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#039;");
}

function pintarResultados(search) {
    const resultsDiv = document.getElementById("results");

    if (!search || search.status !== "ok") {
        resultsDiv.innerHTML = "<div class='result'>No se encontraron resultados.</div>";
        return;
    }

    const results = search.results || [];

    if (results.length === 0) {
        resultsDiv.innerHTML = "<div class='result'>No se encontraron resultados.</div>";
        return;
    }

    resultsDiv.innerHTML = results.map((item, index) => {
        const meta = item.metadata || {};
        const text = item.text || "";

        return `
            <div class="result">
                <div class="result-title">Resultado ${index + 1}</div>
                <div class="result-meta">
                    Archivo: ${escapeHtml(meta.filename || meta.source || "")}
                    · Ciclo: ${escapeHtml(meta.cycle || "")}
                    · Sección: ${escapeHtml(meta.section || "")}
                    · Distancia: ${Number(item.distance).toFixed(4)}
                </div>
                <div class="result-text">${escapeHtml(text)}</div>
            </div>
        `;
    }).join("");
}

async function consultar() {
    const texto = document.getElementById("texto").value;
    const info = document.getElementById("info");

    info.textContent = "Generando embedding y consultando ChromaDB...";

    const formData = new FormData();
    formData.append("input", texto);

    try {
        const res = await fetch("?api=ask", {
            method: "POST",
            body: formData
        });

        const json = await res.json();

        if (json.status !== "ok") {
            info.textContent = "Error: " + (json.message || "respuesta inválida");
            return;
        }

        const values = json.embedding?.embeddings?.[0];

        if (!Array.isArray(values)) {
            info.textContent = "Error: embedding no válido";
            return;
        }

        pintarEmbedding(values);
        pintarResultados(json.search);

        info.textContent = `"${texto}" · ${values.length} dimensiones · resultados recuperados`;

    } catch (e) {
        info.textContent = "Error: " + e.message;
    }
}

window.addEventListener("resize", () => {
    const circles = document.querySelectorAll(".circle");
    recolocar(circles.length);
});

document.getElementById("texto").addEventListener("keydown", e => {
    if (e.key === "Enter") {
        consultar();
    }
});

consultar();
</script>

</body>
</html>
