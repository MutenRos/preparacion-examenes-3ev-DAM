<?php
declare(strict_types=1);

const OLLAMA_EMBED_URL = 'http://127.0.0.1:11434/api/embed';
const OLLAMA_EMBED_MODEL = 'nomic-embed-text:v1.5';

const REMOTE_GENERATE_URL = 'https://covalently-untasked-daphne.ngrok-free.dev/api/';
const REMOTE_API_USER = 'jocarsa';
const REMOTE_API_PASSWORD = 'jocarsa';
const REMOTE_TEXT_MODEL = 'qwen2.5:3b-instruct';

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

function call_remote_generate(string $prompt): string
{
    $data = [
        'user' => REMOTE_API_USER,
        'password' => REMOTE_API_PASSWORD,
        'action' => 'generate',
        'model' => REMOTE_TEXT_MODEL,
        'system' => 'Eres un asistente educativo. Responde en español, de forma clara, natural y humana.',
        'question' => $prompt
    ];

    $ch = curl_init(REMOTE_GENERATE_URL);

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
        throw new RuntimeException("Error HTTP API remota: $status - $response");
    }

    $json = json_decode($response, true);

    if (!is_array($json)) {
        return trim($response);
    }

    foreach (['answer', 'response', 'message', 'content'] as $key) {
        if (isset($json[$key])) {
            return trim((string)$json[$key]);
        }
    }

    return trim(json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
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
Responde en un unico parrafo.

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
            $answer = call_remote_generate($prompt);

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
<title>Brain RAG Experience</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    overflow: hidden;
    background: #ffffff;
    font-family: Ubuntu, Arial, sans-serif;
    color: #222;
    display: flex;
}

#stage {
    position: fixed;
    inset: 0;
    overflow: hidden;
    background:
        radial-gradient(circle at center, rgba(0,0,0,0.08), transparent 42%),
        #ffffff;
    perspective: 950px;
    perspective-origin: center center;
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
        opacity 0.18s linear,
        filter 0.18s linear;
    opacity: 0.95;
    will-change: transform, opacity, filter;
}

#result-window {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    width: min(780px, calc(100vw - 44px));
    max-height: 42vh;
    padding: 22px 26px;
    border-radius: 24px;
    background: rgba(255,255,255,0.72);
    backdrop-filter: blur(18px);
    box-shadow: 0 18px 55px rgba(0,0,0,0.18);
    z-index: 30;
    opacity: 0;
    pointer-events: none;
    overflow-y: auto;
    transition:
        opacity 0.35s ease,
        max-height 0.55s ease,
        min-height 0.55s ease,
        padding 0.55s ease,
        transform 0.35s ease;
}

#result-window.visible {
    opacity: 1;
    pointer-events: auto;
}

#result-window.loading {
    width: auto;
    min-width: 210px;
    padding: 16px 22px;
    overflow: hidden;
}

#result-window.expanded {
    min-height: 120px;
    max-height: 52vh;
    padding: 26px 32px;
}

#result-content {
    font-size: 18px;
    line-height: 1.65;
    white-space: pre-wrap;
}

.loading-row {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 15px;
    color: #333;
    white-space: nowrap;
}

.spinner {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    border: 3px solid rgba(0,0,0,0.16);
    border-top-color: #111;
    animation: spin 0.75s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
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

#input-panel {
    position: fixed;
    left: 50%;
    bottom: 34px;
    transform: translateX(-50%);
    width: min(760px, calc(100vw - 44px));
    z-index: 40;
}

#input-box {
    display: flex;
    gap: 12px;
    padding: 14px;
    border-radius: 22px;
    background: rgba(255,255,255,0.86);
    backdrop-filter: blur(18px);
    box-shadow: 0 18px 55px rgba(0,0,0,0.22);
}

#texto {
    flex: 1;
    border: 1px solid #ddd;
    outline: none;
    border-radius: 15px;
    padding: 15px 18px;
    font-size: 16px;
    background: #ffffff;
}

#boton {
    border: none;
    border-radius: 15px;
    padding: 0 24px;
    font-size: 16px;
    background: #222;
    color: #fff;
    cursor: pointer;
}

#boton:hover {
    background: #000;
}

#boton:disabled,
#texto:disabled {
    opacity: 0.55;
    cursor: not-allowed;
}

#info {
    margin-top: 10px;
    text-align: center;
    font-size: 13px;
    color: #666;
}

#hint {
    position: fixed;
    top: 24px;
    right: 28px;
    z-index: 20;
    font-size: 33px;
    color: rgba(0,0,0,0.45);
    font-weight: bold;
}

@media (max-width: 700px) {
    #input-box {
        flex-direction: column;
    }

    #boton {
        padding: 14px;
    }

    #result-content {
        font-size: 16px;
    }
}
</style>
</head>

<body>

<div id="stage">
    <div id="world"></div>
</div>

<div id="hint">jocarsa | cerebroRAG</div>

<div id="result-window">
    <div id="result-content"></div>
</div>

<div id="input-panel">
    <div id="input-box">
        <input id="texto" value="competencias profesionales del ciclo DAM" autocomplete="off">
        <button id="boton" onclick="consultar()">Enviar</button>
    </div>
    <div id="info">Escribe y pulsa espacio para previsualizar neuronas. Enter para enviar.</div>
</div>

<script>
const stage = document.getElementById("stage");
const world = document.getElementById("world");
const resultWindow = document.getElementById("result-window");
const resultContent = document.getElementById("result-content");
const boton = document.getElementById("boton");
const inputTexto = document.getElementById("texto");
const info = document.getElementById("info");

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

let previewTimer = null;
let lastPreviewText = "";
let previewBusy = false;
let pendingPreview = false;

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

        points.push({
            x: Math.cos(theta) * radial * radius,
            y: y * radius,
            z: Math.sin(theta) * radial * radius
        });
    }

    return points;
}

function getSphereRadius() {
    return Math.min(window.innerWidth, window.innerHeight) * 0.32;
}

function applyCamera() {
    world.style.transform = `
        translateZ(${cameraZ}px)
        rotateX(${rotationX}deg)
        rotateY(${rotationY}deg)
    `;
}

function getRotatedZ(x, y, z) {
    const rx = rotationX * Math.PI / 180;
    const ry = rotationY * Math.PI / 180;

    // Misma rotación que aplica CSS al mundo: rotateY -> rotateX
    const cosY = Math.cos(ry);
    const sinY = Math.sin(ry);

    const x1 = x * cosY + z * sinY;
    const y1 = y;
    const z1 = -x * sinY + z * cosY;

    const cosX = Math.cos(rx);
    const sinX = Math.sin(rx);

    const y2 = y1 * cosX - z1 * sinX;
    const z2 = y1 * sinX + z1 * cosX;

    return z2;
}

function updateBillboards() {
    const radius = getSphereRadius();
    const cells = document.querySelectorAll(".cell");

    cells.forEach(cell => {
        const x = parseFloat(cell.dataset.x || "0");
        const y = parseFloat(cell.dataset.y || "0");
        const z = parseFloat(cell.dataset.z || "0");

        cell.style.transform = `
            translate3d(${x}px, ${y}px, ${z}px)
            rotateX(${-rotationX}deg)
            rotateY(${-rotationY}deg)
        `;

        const rotatedZ = getRotatedZ(x, y, z);

        // En CSS 3D, mayor Z visual = más cerca de la cámara
        let depth = (rotatedZ + radius) / (radius * 2);
        depth = Math.max(0, Math.min(1, depth));

        const circle = cell.querySelector(".circle");

        if (circle) {
            const opacity = 0.25 + Math.pow(depth, 2.2) * 0.75;
            const blur = (1 - depth) * 1.5;

            circle.style.opacity = String(opacity);
            circle.style.filter = `blur(${blur}px)`;
        }

        cell.style.zIndex = String(Math.round(depth * 10000));
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
        const scale = Math.pow(((amplified + 1) / 2) * 2.2, 2);

        circle.style.transitionDelay = `${Math.min(i * 2, 600)}ms`;
        circle.style.transform = `scale(${scale})`;
        circle.title = `#${i}: ${value}`;
    });

    updateBillboards();
}

function ocultarResultado() {
    if (writingTimer) {
        clearInterval(writingTimer);
        writingTimer = null;
    }

    resultWindow.classList.remove("visible", "loading", "expanded");
    resultContent.innerHTML = "";
}

function mostrarCargando() {
    if (writingTimer) {
        clearInterval(writingTimer);
        writingTimer = null;
    }

    resultWindow.classList.remove("expanded");
    resultWindow.classList.add("visible", "loading");

    resultContent.innerHTML = `
        <div class="loading-row">
            <div class="spinner"></div>
            <div>Generando respuesta...</div>
        </div>
    `;
}

function escribirRespuesta(texto) {
    if (writingTimer) {
        clearInterval(writingTimer);
        writingTimer = null;
    }

    resultWindow.classList.remove("loading");
    resultWindow.classList.add("visible", "expanded");

    resultContent.innerHTML = "";

    const content = document.createElement("span");
    const cursor = document.createElement("span");
    cursor.className = "cursor";

    resultContent.appendChild(content);
    resultContent.appendChild(cursor);

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

        resultWindow.scrollTop = resultWindow.scrollHeight;
    }, speed);
}

async function obtenerEmbedding(texto) {
    const formData = new FormData();
    formData.append("input", texto);

    const embedRes = await fetch("?api=embed", {
        method: "POST",
        body: formData
    });

    const embedJson = await embedRes.json();

    if (embedJson.status !== "ok") {
        throw new Error(embedJson.message || "embedding inválido");
    }

    const values = embedJson.embedding?.embeddings?.[0];

    if (!Array.isArray(values)) {
        throw new Error("embedding no válido");
    }

    return values;
}

async function previsualizarEmbedding() {
    const texto = inputTexto.value.trim();

    if (!texto) return;
    if (texto === lastPreviewText) return;

    if (previewBusy) {
        pendingPreview = true;
        return;
    }

    previewBusy = true;
    pendingPreview = false;
    lastPreviewText = texto;

    info.textContent = `Actualizando neuronas para: "${texto}"...`;

    try {
        const values = await obtenerEmbedding(texto);
        pintarEmbedding(values);

        info.textContent = `"${texto}" · ${values.length} dimensiones · neuronas actualizadas`;
    } catch (e) {
        info.textContent = "Error preview embedding: " + e.message;
    } finally {
        previewBusy = false;

        if (pendingPreview && inputTexto.value.trim() !== lastPreviewText) {
            previsualizarEmbedding();
        }
    }
}

function programarPreviewEmbedding() {
    clearTimeout(previewTimer);

    previewTimer = setTimeout(() => {
        previsualizarEmbedding();
    }, 120);
}

async function consultar() {
    const texto = inputTexto.value.trim();

    if (!texto) return;

    clearTimeout(previewTimer);

    boton.disabled = true;
    inputTexto.disabled = true;

    info.textContent = "Generando embedding local...";
    mostrarCargando();

    const formData = new FormData();
    formData.append("input", texto);

    try {
        const values = await obtenerEmbedding(texto);
        pintarEmbedding(values);
        lastPreviewText = texto;

        info.textContent = `"${texto}" · ${values.length} dimensiones · consultando Chroma y API remota...`;

        const ragRes = await fetch("?api=rag", {
            method: "POST",
            body: formData
        });

        const ragJson = await ragRes.json();

        if (ragJson.status !== "ok") {
            info.textContent = "Error: " + (ragJson.message || "RAG inválido");
            escribirRespuesta("No se pudo generar la respuesta.");
            return;
        }

        const total = ragJson.search?.results?.length || 0;
        info.textContent = `"${texto}" · ${total} candidatos usados`;

        escribirRespuesta(ragJson.answer || "No se obtuvo respuesta.");

    } catch (e) {
        info.textContent = "Error: " + e.message;
        escribirRespuesta("Error: " + e.message);
    } finally {
        boton.disabled = false;
        inputTexto.disabled = false;
        inputTexto.focus();
    }
}

stage.addEventListener("wheel", e => {
    e.preventDefault();

    cameraZ += e.deltaY * -0.6;
    cameraZ = Math.max(-650, Math.min(850, cameraZ));

    applyCamera();
    updateBillboards();
}, { passive: false });

stage.addEventListener("mousedown", e => {
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

inputTexto.addEventListener("keydown", e => {
    if (e.key === "Enter") {
        e.preventDefault();
        consultar();
        return;
    }

    if (e.key === " ") {
        programarPreviewEmbedding();
    }
});

inputTexto.addEventListener("input", () => {
    ocultarResultado();

    clearTimeout(previewTimer);

    if (inputTexto.value.endsWith(" ")) {
        programarPreviewEmbedding();
    }
});

applyCamera();
animateCamera();
consultar();
</script>

</body>
</html>
