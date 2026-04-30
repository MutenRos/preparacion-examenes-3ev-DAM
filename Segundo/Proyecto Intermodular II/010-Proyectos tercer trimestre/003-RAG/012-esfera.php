<?php
declare(strict_types=1);

const OLLAMA_EMBED_URL = 'http://127.0.0.1:11434/api/embed';
const OLLAMA_GENERATE_URL = 'http://127.0.0.1:11434/api/generate';

const OLLAMA_EMBED_MODEL = 'nomic-embed-text:v1.5';
const OLLAMA_TEXT_MODEL = 'phi4-mini:latest';

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
        'model' => OLLAMA_EMBED_MODEL,
        'input' => $input
    ];

    $ch = curl_init(OLLAMA_EMBED_URL);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
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
        throw new RuntimeException("Error HTTP Ollama embed: $status - $response");
    }

    $json = json_decode($response, true);

    if (!is_array($json)) {
        throw new RuntimeException('Respuesta JSON inválida de Ollama embed');
    }

    return $json;
}

function call_ollama_generate(string $prompt): string
{
    $data = [
        'model' => OLLAMA_TEXT_MODEL,
        'prompt' => $prompt,
        'stream' => false,
        'options' => [
            'temperature' => 0.2,
            'num_ctx' => 8192
        ]
    ];

    $ch = curl_init(OLLAMA_GENERATE_URL);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
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
        throw new RuntimeException("Error HTTP Ollama generate: $status - $response");
    }

    $json = json_decode($response, true);

    if (!is_array($json)) {
        throw new RuntimeException('Respuesta JSON inválida de Ollama generate');
    }

    return trim((string)($json['response'] ?? ''));
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

    if (isset($json['results']) && is_array($json['results'])) {
        $json['results'] = array_slice($json['results'], 0, 5);
    }

    return $json;
}

function build_rag_prompt(string $question, array $search): string
{
    $results = $search['results'] ?? [];
    $context = "";

    foreach ($results as $i => $item) {
        $n = $i + 1;
        $text = trim((string)($item['text'] ?? ''));
        $meta = $item['metadata'] ?? [];
        $source = $meta['filename'] ?? $meta['source'] ?? 'desconocido';
        $section = $meta['section'] ?? '';

        $context .= "\n[FRAGMENTO $n]\n";
        $context .= "Fuente: $source\n";
        if ($section !== '') {
            $context .= "Sección: $section\n";
        }
        $context .= "Texto:\n$text\n";
    }

    return <<<PROMPT
Eres un asistente educativo.

Responde en español, de forma clara, natural y humana.

Usa exclusivamente la información de los fragmentos proporcionados.
No inventes información.
Si los fragmentos no contienen suficiente información, dilo claramente.

Pregunta del usuario:
$question

Fragmentos recuperados:
$context

Redacta una respuesta final bien estructurada, útil y comprensible.
PROMPT;
}

if (isset($_GET['api'])) {
    $api = $_GET['api'];
    $input = trim((string)($_POST['input'] ?? $_GET['input'] ?? ''));

    if ($input === '') {
        $input = 'gato';
    }

    try {
        if ($api === 'embed') {
            json_response([
                'status' => 'ok',
                'input' => $input,
                'embedding' => call_ollama_embed($input)
            ]);
        }

        if ($api === 'rag') {
            $search = call_chroma_search($input);
            $prompt = build_rag_prompt($input, $search);
            $answer = call_ollama_generate($prompt);

            json_response([
                'status' => 'ok',
                'input' => $input,
                'search' => $search,
                'answer' => $answer
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
<title>Embedding + RAG + Ollama</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    overflow: hidden;
    background: #ffffff;
    font-family: Arial, sans-serif;
    color: #222;
}

#layout {
    width: 100vw;
    height: 100vh;
    display: grid;
    grid-template-columns: 50% 50%;
}

#left {
    position: relative;
    border-right: 1px solid #e0e0e0;
    overflow: hidden;
    background:
        radial-gradient(circle at center, rgba(0,0,0,0.06), transparent 45%),
        #ffffff;
    perspective: 900px;
    perspective-origin: center center;
}

#right {
    position: relative;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
}

#brain-title {
    position: absolute;
    left: 30px;
    top: 25px;
    z-index: 5;
    font-size: 22px;
    font-weight: bold;
    color: #333;
}

#camera-info {
    position: absolute;
    right: 30px;
    top: 28px;
    z-index: 5;
    font-size: 13px;
    color: #777;
}

#canvas {
    position: absolute;
    inset: 0;
    transform-style: preserve-3d;
}

#world {
    position: absolute;
    left: 50%;
    top: 50%;
    width: 0;
    height: 0;
    transform-style: preserve-3d;
    will-change: transform;
}

.cell {
    position: absolute;
    width: 24px;
    height: 24px;
    margin-left: -12px;
    margin-top: -12px;
    transform-style: preserve-3d;
    transition: transform 0.8s ease;
    will-change: transform;
}

.circle {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #000000;
    box-shadow:
        0 0 8px rgba(255,255,255,0.95),
        0 0 18px rgba(255,255,255,0.75),
        0 0 28px rgba(0,0,0,0.28);
    transform: scale(0);
    transition:
        transform 0.55s cubic-bezier(.34,1.56,.64,1),
        opacity 0.35s ease,
        filter 0.35s ease;
    opacity: 0.95;
    will-change: transform;
}

#panel {
    position: fixed;
    left: 30px;
    bottom: 25px;
    width: calc(50vw - 60px);
    background: rgba(255,255,255,0.95);
    padding: 15px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.18);
    z-index: 20;
}

.controls {
    display: flex;
    gap: 10px;
}

input {
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    flex: 1;
    font-size: 15px;
}

button {
    padding: 12px 18px;
    border-radius: 8px;
    border: none;
    background: #333333;
    color: #ffffff;
    cursor: pointer;
    font-size: 15px;
}

button:hover {
    background: #111111;
}

button:disabled {
    opacity: 0.55;
    cursor: not-allowed;
}

#info {
    margin-top: 10px;
    font-size: 14px;
    color: #555;
}

#result-title-main {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
}

#results {
    width: 100%;
    max-height: calc(100vh - 180px);
    overflow-y: auto;
    font-size: 18px;
    line-height: 1.65;
}

.result {
    padding: 25px;
    border-radius: 18px;
    background: #f3f3f3;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    white-space: pre-wrap;
}

.cursor {
    display: inline-block;
    width: 9px;
    height: 1.1em;
    background: #333;
    vertical-align: middle;
    animation: blink 0.8s infinite;
}

@keyframes blink {
    0%, 45% { opacity: 1; }
    46%, 100% { opacity: 0; }
}

.loader {
    display: inline-block;
}

.loader::after {
    content: "";
    animation: dots 1.2s infinite;
}

@keyframes dots {
    0% { content: ""; }
    25% { content: "."; }
    50% { content: ".."; }
    75% { content: "..."; }
    100% { content: ""; }
}

@media (max-width: 900px) {
    #layout {
        grid-template-columns: 1fr;
        grid-template-rows: 50% 50%;
    }

    #left {
        border-right: none;
        border-bottom: 1px solid #e0e0e0;
    }

    #right {
        padding: 25px;
    }

    #panel {
        left: 20px;
        bottom: 20px;
        width: calc(100vw - 40px);
    }
}
</style>
</head>

<body>

<div id="layout">
    <section id="left">
        <div id="brain-title">Brain 3D</div>
        <div id="camera-info">Rueda: dolly · Arrastrar: rotar</div>

        <div id="canvas">
            <div id="world"></div>
        </div>
    </section>

    <section id="right">
        <div id="result-title-main">Respuesta</div>
        <div id="results">
            <div class="result">Esperando consulta...</div>
        </div>
    </section>
</div>

<div id="panel">
    <div class="controls">
        <input id="texto" value="competencias profesionales del ciclo DAM">
        <button id="boton" onclick="consultar()">Consultar</button>
    </div>
    <div id="info">Esperando...</div>
</div>

<script>
const canvas = document.getElementById("canvas");
const world = document.getElementById("world");
const leftPanel = document.getElementById("left");
const resultsDiv = document.getElementById("results");
const boton = document.getElementById("boton");

const INTENSITY = 8;

let writingTimer = null;

let cameraZ = 0;
let rotationX = -12;
let rotationY = 0;

let targetRotationX = rotationX;
let targetRotationY = rotationY;

let dragging = false;
let lastMouseX = 0;
let lastMouseY = 0;

function fibonacciSphere(count, radius) {
    const points = [];
    const goldenAngle = Math.PI * (3 - Math.sqrt(5));

    if (count <= 1) {
        return [{ x: 0, y: 0, z: 0 }];
    }

    for (let i = 0; i < count; i++) {
        const y = 1 - (i / (count - 1)) * 2;
        const radial = Math.sqrt(1 - y * y);
        const theta = goldenAngle * i;

        const x = Math.cos(theta) * radial;
        const z = Math.sin(theta) * radial;

        points.push({
            x: x * radius,
            y: y * radius,
            z: z * radius
        });
    }

    return points;
}

function getSphereRadius() {
    const rect = leftPanel.getBoundingClientRect();
    return Math.min(rect.width, rect.height) * 0.34;
}

function applyCamera() {
    world.style.transform = `
        translateZ(${cameraZ}px)
        rotateX(${rotationX}deg)
        rotateY(${rotationY}deg)
    `;
}

function updateBillboards() {
    const cells = document.querySelectorAll(".cell");

    cells.forEach(cell => {
        const x = cell.dataset.x || "0";
        const y = cell.dataset.y || "0";
        const z = cell.dataset.z || "0";

        cell.style.transform = `
            translate3d(${x}px, ${y}px, ${z}px)
            rotateY(${-rotationY}deg)
            rotateX(${-rotationX}deg)
        `;
    });
}

function animateCamera() {
    rotationX += (targetRotationX - rotationX) * 0.08;
    rotationY += (targetRotationY - rotationY) * 0.08;

    if (!dragging) {
        targetRotationY += 0.08;
    }

    applyCamera();
    updateBillboards();

    requestAnimationFrame(animateCamera);
}

function recolocar(total) {
    const radius = getSphereRadius();
    const positions = fibonacciSphere(total, radius);

    positions.forEach((pos, i) => {
        const circle = document.querySelector(`.circle[data-index="${i}"]`);
        if (!circle) return;

        const cell = circle.parentElement;

        cell.dataset.x = String(pos.x);
        cell.dataset.y = String(pos.y);
        cell.dataset.z = String(pos.z);

        const depth = (pos.z + radius) / (radius * 2);
        circle.style.opacity = String(0.45 + depth * 0.55);
        circle.style.filter = `blur(${(1 - depth) * 0.6}px)`;
    });

    updateBillboards();
}

function pintarEmbedding(values) {
    const radius = getSphereRadius();
    const positions = fibonacciSphere(values.length, radius);

    values.forEach((value, i) => {
        let circle = document.querySelector(`.circle[data-index="${i}"]`);

        if (!circle) {
            const cell = document.createElement("div");
            cell.className = "cell";

            circle = document.createElement("div");
            circle.className = "circle";
            circle.dataset.index = i;

            cell.appendChild(circle);
            world.appendChild(cell);
        }

        const pos = positions[i];
        const cell = circle.parentElement;

        cell.dataset.x = String(pos.x);
        cell.dataset.y = String(pos.y);
        cell.dataset.z = String(pos.z);

        const amplified = Math.max(-1, Math.min(1, value * INTENSITY));
        const scale = 0 + ((amplified + 1) / 2) * 2.9;

        const depth = (pos.z + radius) / (radius * 2);

        circle.style.transitionDelay = `${i * 2}ms`;
        circle.style.transform = `scale(${scale})`;
        circle.style.opacity = String(0.45 + depth * 0.55);
        circle.style.filter = `blur(${(1 - depth) * 0.6}px)`;
        circle.title = `#${i}: ${value}`;
    });

    updateBillboards();
}

function mostrarPensando() {
    if (writingTimer) {
        clearInterval(writingTimer);
        writingTimer = null;
    }

    resultsDiv.innerHTML = `
        <div class="result">
            Generando respuesta con RAG y Ollama<span class="loader"></span>
        </div>
    `;
}

function escribirRespuesta(texto) {
    if (writingTimer) {
        clearInterval(writingTimer);
        writingTimer = null;
    }

    const result = document.createElement("div");
    result.className = "result";

    const content = document.createElement("span");
    const cursor = document.createElement("span");
    cursor.className = "cursor";

    result.appendChild(content);
    result.appendChild(cursor);

    resultsDiv.innerHTML = "";
    resultsDiv.appendChild(result);

    let i = 0;
    const speed = 12;

    writingTimer = setInterval(() => {
        if (i >= texto.length) {
            clearInterval(writingTimer);
            writingTimer = null;
            cursor.remove();
            return;
        }

        const chunk = texto.slice(i, i + 2);
        content.textContent += chunk;
        i += 2;

        resultsDiv.scrollTop = resultsDiv.scrollHeight;
    }, speed);
}

async function consultar() {
    const texto = document.getElementById("texto").value.trim();
    const info = document.getElementById("info");

    if (!texto) return;

    boton.disabled = true;
    info.textContent = "Generando embedding...";
    mostrarPensando();

    const formData = new FormData();
    formData.append("input", texto);

    try {
        const embedRes = await fetch("?api=embed", {
            method: "POST",
            body: formData
        });

        const embedJson = await embedRes.json();

        if (embedJson.status !== "ok") {
            info.textContent = "Error: " + (embedJson.message || "embedding inválido");
            boton.disabled = false;
            return;
        }

        const values = embedJson.embedding?.embeddings?.[0];

        if (!Array.isArray(values)) {
            info.textContent = "Error: embedding no válido";
            boton.disabled = false;
            return;
        }

        pintarEmbedding(values);

        info.textContent = `"${texto}" · ${values.length} dimensiones · consultando documentos y redactando respuesta...`;

        const ragRes = await fetch("?api=rag", {
            method: "POST",
            body: formData
        });

        const ragJson = await ragRes.json();

        if (ragJson.status !== "ok") {
            info.textContent = "Error: " + (ragJson.message || "RAG inválido");
            boton.disabled = false;
            return;
        }

        escribirRespuesta(ragJson.answer || "No se obtuvo respuesta.");

        const total = ragJson.search?.results?.length || 0;
        info.textContent = `"${texto}" · ${total} candidatos usados · respuesta generada con ${<?php echo json_encode(OLLAMA_TEXT_MODEL); ?>}`;

    } catch (e) {
        info.textContent = "Error: " + e.message;
    } finally {
        boton.disabled = false;
    }
}

leftPanel.addEventListener("wheel", e => {
    e.preventDefault();

    cameraZ += e.deltaY * -0.6;
    cameraZ = Math.max(-650, Math.min(850, cameraZ));

    applyCamera();
    updateBillboards();
}, { passive: false });

leftPanel.addEventListener("mousedown", e => {
    dragging = true;
    lastMouseX = e.clientX;
    lastMouseY = e.clientY;
});

window.addEventListener("mouseup", () => {
    dragging = false;
});

window.addEventListener("mousemove", e => {
    if (!dragging) return;

    const dx = e.clientX - lastMouseX;
    const dy = e.clientY - lastMouseY;

    targetRotationY += dx * 0.35;
    targetRotationX -= dy * 0.35;

    targetRotationX = Math.max(-80, Math.min(80, targetRotationX));

    lastMouseX = e.clientX;
    lastMouseY = e.clientY;
});

window.addEventListener("resize", () => {
    const circles = document.querySelectorAll(".circle");
    recolocar(circles.length);
});

document.getElementById("texto").addEventListener("keydown", e => {
    if (e.key === "Enter") {
        consultar();
    }
});

applyCamera();
animateCamera();
consultar();
</script>

</body>
</html>
