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
<title>jocarsa | cerebroRAG</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    overflow: hidden;
    background: #ffffff;
    font-family: 'Ubuntu', Arial, sans-serif;
    color: #111;
}

#main-title {
    position: fixed;
    top: 28px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 100;
    font-size: 38px;
    font-weight: 700;
    letter-spacing: -1px;
    color: #000;
    pointer-events: none;
}

#main-title span {
    font-weight: 300;
}

#layout {
    width: 100vw;
    height: 100vh;
    display: grid;
    grid-template-columns: 50% 50%;
}

#left {
    position: relative;
    border-right: 1px solid #e5e5e5;
    overflow: hidden;
    background:
        radial-gradient(circle at center, rgba(0,0,0,0.09), transparent 58%),
        #ffffff;
}

#canvas {
    position: absolute;
    inset: 0;
    transform-style: preserve-3d;
    perspective: 900px;
}

#right {
    position: relative;
    padding: 110px 40px 40px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
    background: #ffffff;
}

.cell {
    position: absolute;
    width: 34px;
    height: 34px;
    transform: translate(-50%, -50%);
    display: flex;
    align-items: center;
    justify-content: center;
    transition:
        left 0.75s cubic-bezier(.16,1,.3,1),
        top 0.75s cubic-bezier(.16,1,.3,1);
    will-change: transform, left, top, filter, opacity;
}

.circle {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #000;
    transform: scale(0);
    transition:
        transform 0.6s cubic-bezier(.34,1.56,.64,1),
        box-shadow 0.6s ease,
        filter 0.6s ease,
        opacity 0.6s ease;
    box-shadow:
        0 0 12px rgba(255,255,255,0.95),
        0 0 34px rgba(255,255,255,0.55);
}

#panel {
    position: fixed;
    left: 30px;
    bottom: 25px;
    width: calc(50vw - 60px);
    background: rgba(255,255,255,0.95);
    padding: 15px;
    border-radius: 18px;
    box-shadow: 0 14px 35px rgba(0,0,0,0.20);
    z-index: 20;
    backdrop-filter: blur(10px);
}

.controls {
    display: flex;
    gap: 10px;
}

input {
    padding: 13px 15px;
    border-radius: 10px;
    border: 1px solid #d0d0d0;
    flex: 1;
    font-family: 'Ubuntu', Arial, sans-serif;
    font-size: 15px;
    outline: none;
}

input:focus {
    border-color: #000;
}

button {
    padding: 13px 20px;
    border-radius: 10px;
    border: none;
    background: #111;
    color: #fff;
    cursor: pointer;
    font-family: 'Ubuntu', Arial, sans-serif;
    font-size: 15px;
    font-weight: 700;
}

button:hover {
    background: #000;
}

button:disabled {
    opacity: 0.55;
    cursor: not-allowed;
}

#info {
    margin-top: 12px;
    font-size: 14px;
    color: #444;
}

#result-title-main {
    font-size: 34px;
    font-weight: 700;
    margin-bottom: 22px;
    text-align: center;
}

#results {
    width: 100%;
    max-height: calc(100vh - 180px);
    overflow-y: auto;
    font-size: 18px;
    line-height: 1.65;
}

.result {
    padding: 28px;
    border-radius: 18px;
    background: #ffffff;
    border: 1px solid #e2e2e2;
    box-shadow: 0 14px 35px rgba(0,0,0,0.10);
    white-space: pre-wrap;
}

.cursor {
    display: inline-block;
    width: 9px;
    height: 1.1em;
    background: #111;
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
    #main-title {
        font-size: 28px;
        top: 18px;
    }

    #layout {
        grid-template-columns: 1fr;
        grid-template-rows: 50% 50%;
    }

    #left {
        border-right: none;
        border-bottom: 1px solid #e0e0e0;
    }

    #right {
        padding: 80px 25px 25px 25px;
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

<div id="main-title">
    jocarsa <span>|</span> cerebroRAG
</div>

<div id="layout">
    <section id="left">
        <div id="canvas"></div>
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
const leftPanel = document.getElementById("left");
const resultsDiv = document.getElementById("results");
const boton = document.getElementById("boton");

const HEX_SIZE = 15;
const SQRT3 = Math.sqrt(3);
const INTENSITY = 8;

const MIN_SCALE = 0.55;
const MAX_SCALE = 3.15;

const BLUR_AMOUNT = 0.0;

let writingTimer = null;
let neurons = [];

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
            candidates.push({ q, r, dist });
        }
    }

    candidates.sort((a, b) => a.dist - b.dist);
    return candidates.slice(0, count);
}

function getBrainCenter() {
    const rect = leftPanel.getBoundingClientRect();

    return {
        x: rect.width / 2,
        y: rect.height / 2
    };
}

function createNeuron(i) {
    const cell = document.createElement("div");
    cell.className = "cell";

    const circle = document.createElement("div");
    circle.className = "circle";
    circle.dataset.index = i;

    cell.appendChild(circle);
    canvas.appendChild(cell);

    return {
        index: i,
        cell,
        circle,
        x: 0,
        y: 0,
        targetX: 0,
        targetY: 0,
        normalized: 0,
        scale: 0,
        targetScale: 0
    };
}

function recolocar(total) {
    const positions = hexCircle(total);
    const center = getBrainCenter();

    positions.forEach((pos, i) => {
        const neuron = neurons[i];
        if (!neuron) return;

        const p = axialToPixel(pos.q, pos.r);

        neuron.targetX = center.x + p.x;
        neuron.targetY = center.y + p.y;
        neuron.x = neuron.targetX;
        neuron.y = neuron.targetY;

        neuron.cell.style.left = `${neuron.x}px`;
        neuron.cell.style.top = `${neuron.y}px`;
    });
}

function pintarEmbedding(values) {
    const positions = hexCircle(values.length);
    const center = getBrainCenter();

    values.forEach((value, i) => {
        if (!neurons[i]) {
            neurons[i] = createNeuron(i);
        }

        const neuron = neurons[i];

        const pos = positions[i];
        const p = axialToPixel(pos.q, pos.r);

        const amplified = Math.max(-1, Math.min(1, value * INTENSITY));
        const normalized = (amplified + 1) / 2;

        neuron.targetX = center.x + p.x;
        neuron.targetY = center.y + p.y;
        neuron.x = neuron.targetX;
        neuron.y = neuron.targetY;

        neuron.normalized = normalized;
        neuron.targetScale = MIN_SCALE + normalized * (MAX_SCALE - MIN_SCALE);
        neuron.scale = neuron.targetScale;

        const distanceFromCenter = Math.sqrt(
            Math.pow((neuron.x - center.x) / center.x, 2) +
            Math.pow((neuron.y - center.y) / center.y, 2)
        );

        const opacity = Math.max(0.45, 1 - distanceFromCenter * 0.55);
        const glow = 12 + normalized * 38;

        neuron.cell.style.left = `${neuron.x}px`;
        neuron.cell.style.top = `${neuron.y}px`;
        neuron.cell.style.transform = `translate(-50%, -50%)`;

        neuron.circle.style.transform = `scale(${neuron.scale})`;
        neuron.circle.style.opacity = opacity.toString();
        neuron.circle.style.filter = `blur(${BLUR_AMOUNT}px)`;
        neuron.circle.style.backgroundColor = "#000";
        neuron.circle.style.boxShadow = `
            0 0 ${glow}px rgba(255,255,255,0.95),
            0 0 ${glow * 2}px rgba(255,255,255,0.38),
            inset 0 0 ${Math.max(4, glow * 0.25)}px rgba(255,255,255,0.18)
        `;
        neuron.circle.title = `#${i}: ${value}`;
    });

    while (neurons.length > values.length) {
        const neuron = neurons.pop();
        neuron.cell.remove();
    }
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

window.addEventListener("resize", () => {
    recolocar(neurons.length);
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
