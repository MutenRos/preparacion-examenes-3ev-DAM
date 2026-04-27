<?php
// cliente_correo.php

// === CONFIGURACIÓN DE LA API REMOTA ===
$API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php";
$API_KEY = "TEST_API_KEY_JOCARSA_123"; // cambia por tu API key real

// --- Formateo especial del cuerpo como correo elegante ---
function ajustarFormatoEmail(string $texto): string
{
    $texto = preg_replace("/\r\n|\r/", "\n", trim($texto));
    if ($texto === '') {
        return '';
    }

    // 0) Separar saludo en primera línea y cuerpo en otra, si procede.
    // Ej: "Hola Francisco, este es un correo..." ->
    // Hola Francisco,
    //
    // Este es un correo...
    $texto = preg_replace_callback(
        '/^((hola|buenos dias|buenos días|buenas tardes|buenas noches|estimad[oa]s?|querid[oa]s?)\s+[^\n,]+,)\s*(.*)$/iu',
        function ($m) {
            $greeting = trim($m[1]);
            $rest     = trim($m[3]);
            if ($rest === '') {
                return $greeting;
            }
            return $greeting . "\n\n" . $rest;
        },
        $texto
    );

    $lineas = explode("\n", $texto);
    $lineas = array_map(static fn($l) => rtrim($l), $lineas);

    // 1) Reducir grupos de líneas vacías (máx. 1 consecutiva)
    $limpias = [];
    $vaciasSeguidas = 0;
    foreach ($lineas as $l) {
        if (trim($l) === '') {
            $vaciasSeguidas++;
            if ($vaciasSeguidas > 1) {
                continue;
            }
        } else {
            $vaciasSeguidas = 0;
        }
        $limpias[] = $l;
    }
    $lineas = $limpias;

    // 2) Asegurar línea en blanco tras el saludo (por si ya venía en varias líneas)
    $greetingRegex = '/^(hola|buenos dias|buenos días|buenas tardes|buenas noches|estimad[oa]s?|querid[oa]s?)/iu';
    $n = count($lineas);
    for ($i = 0; $i < $n; $i++) {
        $ltrim = ltrim($lineas[$i]);
        if ($ltrim === '') {
            continue;
        }
        if (preg_match($greetingRegex, $ltrim)) {
            if ($i + 1 >= $n || trim($lineas[$i + 1]) !== '') {
                array_splice($lineas, $i + 1, 0, ['']);
            }
        }
        break;
    }

    // 3) Asegurar línea en blanco antes del cierre (Un saludo, Saludos, etc.)
    $closingRegex = '/^(un saludo|saludos|atentamente|cordialmente|muchas gracias|gracias de antemano)/iu';
    $n = count($lineas);
    for ($i = $n - 1; $i >= 0; $i--) {
        $ltrim = ltrim($lineas[$i]);
        if ($ltrim === '') {
            continue;
        }
        if (preg_match($closingRegex, $ltrim)) {
            if ($i - 1 < 0 || trim($lineas[$i - 1]) !== '') {
                array_splice($lineas, $i, 0, ['']);
            }
            break;
        }
    }

    return implode("\n", $lineas);
}

// --- Procesar cuerpo del correo con IA ---
function procesar_texto_cuerpo(string $textoOriginal, string $API_URL, string $API_KEY): array
{
    if ($textoOriginal === '') {
        return ['ok' => false, 'error' => 'Texto vacío', 'texto' => ''];
    }

    $question =
        "Eres un asistente de edición de texto en español.\n\n" .
        "TAREA:\n" .
        "Reescribe el texto que te paso a continuación, manteniendo EXACTAMENTE el mismo contenido y significado,\n" .
        "pero corrigiendo solo:\n" .
        "- Ortografía y acentuación.\n" .
        "- Puntuación.\n" .
        "- Mayúsculas y minúsculas.\n" .
        "- División en frases para que sea legible y profesional.\n\n" .
        "REGLAS ESTRICTAS:\n" .
        "- No añadas información nueva.\n" .
        "- No inventes nombres, fechas, cifras ni detalles.\n" .
        "- No elimines información relevante.\n" .
        "- No añadas saludos, despedidas ni asuntos que no aparezcan en el texto original.\n" .
        "- Mantén el mismo orden de ideas.\n" .
        "- No expliques lo que haces.\n" .
        "- Devuelve únicamente el texto corregido, sin comentarios, sin comillas, sin formato extra.\n\n" .
        "Texto original:\n" .
        $textoOriginal;

    $ch = curl_init($API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);

    $postFields = http_build_query(['question' => $question]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-API-Key: ' . $API_KEY,
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);

    if ($response === false) {
        $err = "Error al contactar con la API remota: " . curl_error($ch);
        curl_close($ch);
        return ['ok' => false, 'error' => $err, 'texto' => ''];
    }

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status !== 200) {
        return ['ok' => false, 'error' => "La API remota devolvió HTTP $status. Respuesta: $response", 'texto' => ''];
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['ok' => false, 'error' => "Error al decodificar JSON: " . json_last_error_msg() . ". Respuesta: $response", 'texto' => ''];
    }

    if (!isset($data['answer']) || !is_string($data['answer'])) {
        return ['ok' => false, 'error' => "La respuesta de la API no contiene el campo 'answer'. Respuesta: $response", 'texto' => ''];
    }

    $textoFormateado = trim($data['answer']);
    $textoFormateado = ajustarFormatoEmail($textoFormateado);

    return ['ok' => true, 'error' => '', 'texto' => $textoFormateado];
}

// --- Procesar ASUNTO con IA ---
function procesar_texto_asunto(string $textoOriginal, string $API_URL, string $API_KEY): array
{
    if ($textoOriginal === '') {
        return ['ok' => false, 'error' => 'Texto vacío', 'texto' => ''];
    }

    $question =
        "Eres un asistente experto redactando asuntos de correo electrónico en español profesional.\n\n" .
        "TAREA:\n" .
        "A partir del texto que te paso, genera únicamente un asunto de correo breve, claro y profesional.\n\n" .
        "REGLAS ESTRICTAS:\n" .
        "- Mantén el mismo significado general, sin añadir información nueva.\n" .
        "- No añadas datos que no estén en el texto original.\n" .
        "- El resultado debe ser una sola línea.\n" .
        "- No incluyas la palabra 'Asunto:' ni comillas ni explicaciones.\n" .
        "- Evita el punto final, salvo que sea imprescindible.\n\n" .
        "Texto original del asunto (dictado):\n" .
        $textoOriginal;

    $ch = curl_init($API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);

    $postFields = http_build_query(['question' => $question]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-API-Key: ' . $API_KEY,
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);

    if ($response === false) {
        $err = "Error al contactar con la API remota: " . curl_error($ch);
        curl_close($ch);
        return ['ok' => false, 'error' => $err, 'texto' => ''];
    }

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status !== 200) {
        return ['ok' => false, 'error' => "La API remota devolvió HTTP $status. Respuesta: $response", 'texto' => ''];
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['ok' => false, 'error' => "Error al decodificar JSON: " . json_last_error_msg() . ". Respuesta: $response", 'texto' => ''];
    }

    if (!isset($data['answer']) || !is_string($data['answer'])) {
        return ['ok' => false, 'error' => "La respuesta de la API no contiene el campo 'answer'. Respuesta: $response", 'texto' => ''];
    }

    $textoFormateado = trim($data['answer']);
    // Una línea, sin saltos extra
    $textoFormateado = preg_replace("/\r\n|\r|\n/", ' ', $textoFormateado);
    $textoFormateado = preg_replace('/\s+/', ' ', $textoFormateado);

    return ['ok' => true, 'error' => '', 'texto' => $textoFormateado];
}

// === MODO AJAX: peticiones de IA (cuerpo o asunto) ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax']) && $_POST['ajax'] === '1') {
    header('Content-Type: application/json; charset=utf-8');

    $kind = $_POST['kind'] ?? 'body';
    $textoOriginal = isset($_POST['texto']) ? trim($_POST['texto']) : '';

    if ($textoOriginal === '') {
        echo json_encode(['ok' => false, 'error' => 'Texto vacío', 'texto' => ''], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($kind === 'subject') {
        $resultado = procesar_texto_asunto($textoOriginal, $API_URL, $API_KEY);
    } else {
        $resultado = procesar_texto_cuerpo($textoOriginal, $API_URL, $API_KEY);
    }

    echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
    exit;
}

// === Si no es AJAX, servimos la página HTML ===
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cliente de correo (simulado) con dictado e IA</title>
    <style>
        :root {
            --bg: #f5f7fb;
            --card-bg: #ffffff;
            --card-border: #d4d4d8;
            --accent: #2563eb;
            --accent-soft: #e0ebff;
            --text-main: #111827;
            --text-muted: #6b7280;
            --error: #b91c1c;
            --success: #15803d;
            --warn: #92400e;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            padding: 2rem;
        }
        .app-shell {
            width: 100%;
            max-width: 900px;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .app-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }
        .app-title {
            font-size: 1.4rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .app-title-badge {
            font-size: .8rem;
            padding: .2rem .6rem;
            border-radius: 999px;
            background: var(--accent-soft);
            color: var(--accent);
        }
        .app-subtitle {
            font-size: .9rem;
            color: var(--text-muted);
            margin-top: .25rem;
        }
        .pill {
            font-size: .8rem;
            padding: .35rem .7rem;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            color: var(--text-muted);
        }
        .card {
            background: var(--card-bg);
            border-radius: 1rem;
            border: 1px solid var(--card-border);
            padding: 1.2rem 1.3rem;
        }
        .card-header {
            margin-bottom: .9rem;
        }
        .card-title {
            font-size: 1rem;
            font-weight: 600;
        }
        .card-caption {
            font-size: .82rem;
            color: var(--text-muted);
            margin-top: .2rem;
        }
        .form-row {
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: .7rem;
        }
        .form-label {
            width: 4rem;
            font-size: .9rem;
            color: var(--text-muted);
            text-align: right;
        }
        .form-field {
            flex: 1;
        }
        .input-text {
            width: 100%;
            border-radius: .6rem;
            border: 1px solid #d4d4d8;
            padding: .5rem .7rem;
            font-size: .9rem;
            font-family: inherit;
            color: var(--text-main);
            background: #f9fafb;
        }
        .input-text:focus {
            outline: none;
            border-color: var(--accent);
            background: #ffffff;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .35rem .75rem;
            border-radius: 999px;
            border: 1px solid #d4d4d8;
            font-size: .8rem;
            font-weight: 500;
            cursor: pointer;
            background: #ffffff;
            color: var(--text-main);
            transition: background 0.15s ease, border-color 0.15s ease;
        }
        .btn:hover {
            background: #eff6ff;
            border-color: var(--accent);
        }
        .btn-voice.active {
            background: #dbeafe;
            border-color: #1d4ed8;
        }
        .pulse-dot {
            width: .5rem;
            height: .5rem;
            border-radius: 999px;
            background: #9ca3af;
        }
        .btn-voice.active .pulse-dot {
            background: #22c55e;
        }
        .status-text {
            font-size: .8rem;
        }
        .status-ok   { color: var(--success); }
        .status-warn { color: var(--warn); }
        .status-error{ color: var(--error); }
        .status-row {
            display: flex;
            justify-content: flex-end;
            font-size: .8rem;
            color: var(--text-muted);
            margin-top: .25rem;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        .status-label {
            font-weight: 500;
        }
        .body-label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: .6rem;
            margin-bottom: .3rem;
        }
        .body-label-row span {
            font-size: .9rem;
        }
        .badge-ai {
            font-size: .78rem;
            padding: .2rem .55rem;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
        }
        .result-box {
            padding: .75rem .9rem;
            border-radius: .75rem;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: .9rem;
            white-space: pre-wrap;
            min-height: 150px;
            max-height: 340px;
            overflow: auto;
            color: var(--text-main);
        }
        .result-placeholder {
            color: var(--text-muted);
            font-style: italic;
        }
        .chip {
            font-size: .78rem;
            padding: .2rem .55rem;
            border-radius: 999px;
            background: #eef2ff;
            color: #4b5563;
        }
        .visually-hidden {
            position: absolute;
            left: -9999px;
            width: 1px;
            height: 1px;
            overflow: hidden;
        }
        .thin-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .thin-scroll::-webkit-scrollbar-thumb {
            background: #d4d4d8;
            border-radius: 999px;
        }
        .thin-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        @media (max-width: 720px) {
            body { padding: 1rem; }
            .form-label { width: 3.5rem; }
        }
    </style>
</head>
<body>
<div class="app-shell">
    <header class="app-header">
        <div>
            <div class="app-title">
                <span>📧 Cliente de correo (simulado)</span>
                <span class="app-title-badge">Dictado + IA</span>
            </div>
            <div class="app-subtitle">
                Dicta asunto y cuerpo, y obtén un correo elegante y profesional listo para enviar.
            </div>
        </div>
        <div class="pill">
            🎙️ Dictado por voz · es-ES
        </div>
    </header>

    <main class="card">
        <div class="card-header">
            <div class="card-title">Nuevo mensaje</div>
            <div class="card-caption">Simulación de cliente de correo: destinatario, asunto y cuerpo con corrección automática.</div>
        </div>

        <!-- Fila destinatario (solo interfaz) -->
        <div class="form-row">
            <div class="form-label">Para</div>
            <div class="form-field">
                <input type="email" class="input-text" placeholder="destinatario@ejemplo.com (simulado, no se envía)">
            </div>
        </div>

        <!-- Fila asunto -->
        <div class="form-row">
            <div class="form-label">Asunto</div>
            <div class="form-field">
                <input type="text" id="subjectFinal" class="input-text" placeholder="El asunto corregido aparecerá aquí" readonly>
            </div>
            <button type="button" id="btnDictarSubject" class="btn btn-voice">
                <span class="pulse-dot"></span>
                <span>🎙️ Asunto</span>
            </button>
        </div>

        <!-- Estado IA asunto -->
        <div class="status-row">
            <div>
                <span class="status-label">Asunto IA:</span>
                <span id="estadoIA_subject" class="status-text status-warn">A la espera de dictado…</span>
            </div>
        </div>

        <!-- Texto de asunto original oculto -->
        <textarea id="subjectRaw" class="visually-hidden"></textarea>

        <!-- Cuerpo -->
        <div class="body-label-row">
            <span>Cuerpo del mensaje</span>
            <span class="badge-ai">Corrección suave (sin inventar contenido)</span>
        </div>

        <!-- Texto de cuerpo original oculto -->
        <textarea id="texto" class="visually-hidden"></textarea>

        <!-- Cuerpo corregido -->
        <div id="bodyResultBox" class="result-box thin-scroll">
            <span class="result-placeholder">
                Dicta el cuerpo del mensaje (botón 🎙️ Cuerpo) y aparecerá aquí corregido y formateado como un correo profesional.
            </span>
        </div>

        <!-- Controles y estados cuerpo -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-top:.6rem; flex-wrap:wrap; gap:.6rem;">
            <div style="display:flex; align-items:center; gap:.5rem; flex-wrap:wrap;">
                <button type="button" id="btnDictarBody" class="btn btn-voice">
                    <span class="pulse-dot"></span>
                    <span>🎙️ Cuerpo</span>
                </button>
                <span class="chip">La IA se ejecuta automáticamente cada pocos segundos</span>
            </div>
            <div>
                <span class="status-label">Cuerpo IA:</span>
                <span id="estadoIA_body" class="status-text status-warn">A la espera de dictado…</span>
            </div>
        </div>

        <!-- Estado general de dictado -->
        <div style="margin-top:.4rem; text-align:right;">
            <span id="estadoDictado" class="status-text status-warn">Dictado en espera.</span>
        </div>
    </main>
</div>

<script>
(function() {
    const subjectRaw      = document.getElementById('subjectRaw');
    const bodyRaw         = document.getElementById('texto');
    const subjectFinal    = document.getElementById('subjectFinal');
    const bodyResultBox   = document.getElementById('bodyResultBox');

    const btnDictarSubject = document.getElementById('btnDictarSubject');
    const btnDictarBody    = document.getElementById('btnDictarBody');

    const estadoIA_subject = document.getElementById('estadoIA_subject');
    const estadoIA_body    = document.getElementById('estadoIA_body');
    const estadoDictado    = document.getElementById('estadoDictado');

    let recognition = null;
    let escuchando = false;
    let currentTarget = null;         // subjectRaw o bodyRaw
    let currentTargetType = null;     // 'subject' | 'body'
    let bufferBeforeRecognition = '';
    let recognizedFinal = '';

    let lastSentSubject = '';
    let lastSentBody    = '';
    let isSendingSubject = false;
    let isSendingBody    = false;
    const HEARTBEAT_MS = 3000; // cada pocos segundos

    function setResultBody(text, isError = false, isPlaceholder = false) {
        bodyResultBox.innerHTML = '';
        const pre = document.createElement('pre');
        pre.style.margin = '0';
        pre.style.whiteSpace = 'pre-wrap';
        if (isPlaceholder) pre.classList.add('result-placeholder');
        if (isError) pre.style.color = '#b91c1c';
        pre.textContent = text;
        bodyResultBox.appendChild(pre);
    }

    function updateIAStatus(kind, text, cls) {
        if (kind === 'subject') {
            estadoIA_subject.textContent = text;
            estadoIA_subject.className = 'status-text ' + (cls || '');
        } else if (kind === 'body') {
            estadoIA_body.textContent = text;
            estadoIA_body.className = 'status-text ' + (cls || '');
        }
    }

    function markChanged(kind) {
        if (kind === 'subject') {
            updateIAStatus('subject', 'Detectados cambios. Se corregirá en unos segundos…', 'status-warn');
        } else if (kind === 'body') {
            updateIAStatus('body', 'Detectados cambios. Se corregirá en unos segundos…', 'status-warn');
        }
    }

    function sendToAI(kind) {
        const rawEl   = (kind === 'subject') ? subjectRaw : bodyRaw;
        const current = rawEl.value.trim();
        if (!current) {
            updateIAStatus(kind, 'Sin texto para corregir.', 'status-warn');
            return;
        }

        if (kind === 'subject') {
            if (isSendingSubject || current === lastSentSubject) return;
            isSendingSubject = true;
            updateIAStatus('subject', 'Enviando asunto a la IA…', 'status-warn');
        } else {
            if (isSendingBody || current === lastSentBody) return;
            isSendingBody = true;
            updateIAStatus('body', 'Enviando cuerpo a la IA…', 'status-warn');
        }

        const params = new URLSearchParams();
        params.append('ajax', '1');
        params.append('kind', kind === 'subject' ? 'subject' : 'body');
        params.append('texto', current);

        fetch(window.location.href, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: params.toString()
        })
        .then(resp => resp.json())
        .then(data => {
            if (!data || typeof data.ok === 'undefined') {
                if (kind === 'body') setResultBody('Respuesta inesperada del servidor.', true);
                updateIAStatus(kind, 'Error en la respuesta.', 'status-error');
                return;
            }
            if (!data.ok) {
                if (kind === 'body') setResultBody(data.error || 'Error al procesar el texto.', true);
                updateIAStatus(kind, 'Error al procesar el texto.', 'status-error');
                return;
            }

            if (kind === 'subject') {
                lastSentSubject = current;
                subjectFinal.value = data.texto || '';
                updateIAStatus('subject', 'Asunto actualizado.', 'status-ok');
            } else {
                lastSentBody = current;
                setResultBody(data.texto || '');
                updateIAStatus('body', 'Cuerpo actualizado.', 'status-ok');
            }
        })
        .catch(err => {
            console.error(err);
            if (kind === 'body') setResultBody('Error de red al contactar con la IA.', true);
            updateIAStatus(kind, 'Error de red.', 'status-error');
        })
        .finally(() => {
            if (kind === 'subject') isSendingSubject = false;
            else isSendingBody = false;
        });
    }

    // Heartbeat: lanza las peticiones si hay cambios
    setInterval(function() {
        sendToAI('subject');
        sendToAI('body');
    }, HEARTBEAT_MS);

    // Dictado por voz
    function startDictationFor(kind) {
        if (!recognition) return;

        const targetRaw  = (kind === 'subject') ? subjectRaw : bodyRaw;
        const otherBtn   = (kind === 'subject') ? btnDictarBody : btnDictarSubject;
        const thisBtn    = (kind === 'subject') ? btnDictarSubject : btnDictarBody;

        if (escuchando && currentTargetType === kind) {
            recognition.stop();
            return;
        }

        if (escuchando && currentTargetType !== kind) {
            recognition.stop();
            // El usuario deberá pulsar de nuevo el botón deseado
            return;
        }

        currentTarget = targetRaw;
        currentTargetType = kind;
        try {
            recognition.start();
        } catch (e) {
            console.error(e);
        }
    }

    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SR();
        recognition.lang = 'es-ES';
        recognition.continuous = true;
        recognition.interimResults = true;

        recognition.onstart = function() {
            escuchando = true;
            recognizedFinal = '';
            bufferBeforeRecognition = currentTarget ? currentTarget.value.trimEnd() : '';

            btnDictarSubject.classList.remove('active');
            btnDictarBody.classList.remove('active');

            if (currentTargetType === 'subject') {
                btnDictarSubject.classList.add('active');
                estadoDictado.textContent = 'Dictando asunto…';
            } else if (currentTargetType === 'body') {
                btnDictarBody.classList.add('active');
                estadoDictado.textContent = 'Dictando cuerpo del mensaje…';
            } else {
                estadoDictado.textContent = 'Dictando…';
            }
            estadoDictado.className = 'status-text status-ok';
        };

        recognition.onerror = function(event) {
            escuchando = false;
            btnDictarSubject.classList.remove('active');
            btnDictarBody.classList.remove('active');
            estadoDictado.textContent = 'Error en el reconocimiento de voz.';
            estadoDictado.className = 'status-text status-error';
            console.error('Speech recognition error:', event);
        };

        recognition.onend = function() {
            escuchando = false;
            btnDictarSubject.classList.remove('active');
            btnDictarBody.classList.remove('active');
            if (subjectRaw.value.trim() || bodyRaw.value.trim()) {
                estadoDictado.textContent = 'Dictado detenido. Texto listo para corregir.';
                estadoDictado.className = 'status-text status-ok';
            } else {
                estadoDictado.textContent = 'Dictado detenido.';
                estadoDictado.className = 'status-text status-warn';
            }
        };

        recognition.onresult = function(event) {
            if (!currentTarget) return;

            let interimText = '';
            for (let i = event.resultIndex; i < event.results.length; i++) {
                const transcript = event.results[i][0].transcript;
                if (event.results[i].isFinal) {
                    recognizedFinal += transcript + ' ';
                } else {
                    interimText += transcript + ' ';
                }
            }

            const fullText = (bufferBeforeRecognition + ' ' + recognizedFinal + interimText).trim();
            currentTarget.value = fullText;
            if (currentTargetType) {
                markChanged(currentTargetType);
            }
        };

        btnDictarSubject.addEventListener('click', function() {
            startDictationFor('subject');
        });
        btnDictarBody.addEventListener('click', function() {
            startDictationFor('body');
        });

        estadoDictado.textContent = 'Dictado disponible. Pulsa un botón de 🎙️ para empezar.';
        estadoDictado.className = 'status-text status-ok';
    } else {
        btnDictarSubject.disabled = true;
        btnDictarBody.disabled = true;
        estadoDictado.textContent = 'El dictado por voz no es compatible con este navegador.';
        estadoDictado.className = 'status-text status-error';
    }
})();
</script>
</body>
</html>

