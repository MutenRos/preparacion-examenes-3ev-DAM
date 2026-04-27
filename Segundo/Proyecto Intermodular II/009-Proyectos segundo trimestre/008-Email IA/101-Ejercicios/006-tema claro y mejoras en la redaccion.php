<?php
// dictado_email.php

// === CONFIGURACIÓN DE LA API REMOTA ===
$API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php";
$API_KEY = "TEST_API_KEY_JOCARSA_123"; // cambia por tu API key real

function ajustarFormatoEmail(string $texto): string
{
    // Normalizar saltos de línea
    $texto = preg_replace("/\r\n|\r/", "\n", trim($texto));

    if ($texto === '') {
        return '';
    }

    // 0) Si el texto empieza con saludo tipo "Hola Francisco," u "Estimado Juan,"
    //    separamos saludo y cuerpo en líneas distintas:
    //    Hola Francisco,
    //
    //    Este es un correo...
    $texto = preg_replace_callback(
        '/^((hola|buenos dias|buenos días|buenas tardes|buenas noches|estimad[oa]s?|querid[oa]s?)\s+[^\n,]+,)\s*(.*)$/iu',
        function ($m) {
            $greeting = trim($m[1]);
            $rest     = trim($m[3]);
            if ($rest === '') {
                return $greeting;
            }
            // Saludo en una línea, línea en blanco, luego el resto
            return $greeting . "\n\n" . $rest;
        },
        $texto
    );

    // Dividir en líneas para seguir ajustando
    $lineas = explode("\n", $texto);
    // Eliminar espacios de la derecha en cada línea
    $lineas = array_map(static fn($l) => rtrim($l), $lineas);

    // 1) Reducir grupos largos de líneas en blanco (máximo 1 consecutiva)
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

    // 2) Asegurar línea en blanco tras el saludo (por si venía ya en líneas)
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
        break; // solo analizamos la primera línea no vacía
    }

    // 3) Asegurar línea en blanco antes del cierre
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

function procesar_texto_con_ia(string $textoOriginal, string $API_URL, string $API_KEY): array
{
    if ($textoOriginal === '') {
        return ['ok' => false, 'error' => 'Texto vacío', 'texto' => ''];
    }

    // Prompt: corrección suave, sin añadir contenido nuevo, orientado a correo profesional
    $question =
        "Eres un asistente de edición de texto en español.\n\n" .
        "TAREA:\n" .
        "Reescribe el texto que te paso a continuación, manteniendo EXACTAMENTE el mismo contenido y significado,\n" .
        "pero corrigiendo solo:\n" .
        "- Ortografía y acentuación.\n" .
        "- Puntuación.\n" .
        "- Mayúsculas y minúsculas.\n" .
        "- Saltos de línea y separación en frases para que sea más legible y profesional.\n\n" .
        "REGLAS ESTRICTAS:\n" .
        "- No añadas información nueva.\n" .
        "- No inventes nombres, fechas, cifras ni detalles.\n" .
        "- No elimines información relevante.\n" .
        "- No añadas saludos, despedidas, asuntos ni secciones que no aparezcan en el texto original.\n" .
        "- Mantén el mismo orden de ideas y el mismo contenido, solo mejor presentado.\n" .
        "- No expliques lo que haces.\n" .
        "- Devuelve únicamente el texto corregido, sin comentarios adicionales, sin comillas y sin formato extra.\n\n" .
        "Texto original:\n" .
        $textoOriginal;

    $ch = curl_init($API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);

    $postFields = http_build_query([
        'question' => $question
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-API-Key: ' . $API_KEY,
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    // verify=False como en tu script Python
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

// === MODO AJAX: petición de IA (no recarga la página) ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax']) && $_POST['ajax'] === '1') {
    header('Content-Type: application/json; charset=utf-8');

    $textoOriginal = isset($_POST['texto']) ? trim($_POST['texto']) : '';

    if ($textoOriginal === '') {
        echo json_encode(['ok' => false, 'error' => 'Texto vacío', 'texto' => ''], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $resultado = procesar_texto_con_ia($textoOriginal, $API_URL, $API_KEY);
    echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
    exit;
}

// === Si no es AJAX, servimos la página HTML ===
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dictado de correo y corrección automática</title>
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
        * {
            box-sizing: border-box;
        }
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
            max-width: 1100px;
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
        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(0, 1fr);
            gap: 1.25rem;
        }
        @media (max-width: 900px) {
            body {
                padding: 1rem;
            }
            .layout {
                grid-template-columns: minmax(0, 1fr);
            }
        }
        .card {
            background: var(--card-bg);
            border-radius: 1rem;
            border: 1px solid var(--card-border);
            padding: 1.2rem 1.3rem;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: .75rem;
            margin-bottom: .75rem;
        }
        .card-title {
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: .45rem;
        }
        .card-title span.icon {
            font-size: 1.2rem;
        }
        .card-caption {
            font-size: .82rem;
            color: var(--text-muted);
        }
        label {
            font-size: .85rem;
            font-weight: 500;
            color: var(--text-muted);
            display: block;
            margin-bottom: .4rem;
        }
        textarea {
            width: 100%;
            min-height: 200px;
            resize: vertical;
            border-radius: .75rem;
            border: 1px solid #d4d4d8;
            background: #f9fafb;
            color: var(--text-main);
            padding: .8rem .9rem;
            font-family: inherit;
            font-size: .95rem;
            outline: none;
            transition: border-color 0.15s ease, background-color 0.15s ease;
        }
        textarea:focus {
            border-color: var(--accent);
            background-color: #ffffff;
        }
        .controls-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
            margin-top: .7rem;
        }
        .left-controls {
            display: flex;
            align-items: center;
            gap: .5rem;
            flex-wrap: wrap;
        }
        .right-controls {
            font-size: .8rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .5rem .9rem;
            border-radius: 999px;
            border: 1px solid #d4d4d8;
            font-size: .85rem;
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
            width: .55rem;
            height: .55rem;
            border-radius: 999px;
            background: #9ca3af;
        }
        .btn-voice.active .pulse-dot {
            background: #22c55e;
        }
        .chip {
            font-size: .78rem;
            padding: .25rem .6rem;
            border-radius: 999px;
            background: #eef2ff;
            color: #4b5563;
        }
        .badge-ai {
            font-size: .78rem;
            padding: .2rem .55rem;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
        }
        .result-box {
            margin-top: .5rem;
            padding: .75rem .9rem;
            border-radius: .75rem;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: .9rem;
            white-space: pre-wrap;
            max-height: 340px;
            overflow: auto;
            color: var(--text-main);
        }
        .result-placeholder {
            color: var(--text-muted);
            font-style: italic;
        }
        .status-text {
            font-size: .8rem;
        }
        .status-ok {
            color: var(--success);
        }
        .status-error {
            color: var(--error);
        }
        .status-warn {
            color: var(--warn);
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
    </style>
</head>
<body>
<div class="app-shell">
    <header class="app-header">
        <div>
            <div class="app-title">
                <span>📧 Dictado de correo</span>
                <span class="app-title-badge">Corrección automática</span>
            </div>
            <div class="app-subtitle">
                Dicta o escribe el texto y obtén un correo corregido y formateado de forma profesional.
            </div>
        </div>
        <div class="pill">
            🎙️ Dictado por voz · es-ES
        </div>
    </header>

    <main class="layout">
        <!-- Panel de dictado -->
        <section class="card">
            <div class="card-header">
                <div class="card-title">
                    <span class="icon">🗣️</span>
                    <span>Texto de entrada</span>
                </div>
                <div class="card-caption">
                    Puedes dictar o escribir/pegar el contenido del correo.
                </div>
            </div>

            <label for="texto">Contenido del correo (dictado o escrito)</label>
            <textarea id="texto" placeholder="Pulsa &quot;Empezar dictado&quot; o escribe aquí tu texto..."></textarea>

            <div class="controls-row">
                <div class="left-controls">
                    <button type="button" id="btnDictar" class="btn btn-voice">
                        <span class="pulse-dot"></span>
                        <span>🎙️</span>
                        <span id="labelDictado">Empezar dictado</span>
                    </button>
                    <span class="chip">La IA se ejecuta automáticamente cada pocos segundos</span>
                </div>
                <div class="right-controls">
                    <span id="estadoDictado" class="status-text status-warn">
                        Dictado en espera.
                    </span>
                </div>
            </div>
        </section>

        <!-- Panel de salida IA -->
        <section class="card">
            <div class="card-header">
                <div class="card-title">
                    <span class="icon">✨</span>
                    <span>Texto corregido (formato correo)</span>
                </div>
                <div class="card-caption">
                    Corrección ortográfica y de formato, manteniendo el contenido original.
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: .35rem;">
                <span class="badge-ai">IA personalizada (JOCARSA)</span>
                <span id="estadoIA" class="status-text status-warn">
                    A la espera de cambios…
                </span>
            </div>

            <div id="resultBox" class="result-box thin-scroll">
                <span class="result-placeholder">
                    El texto corregido aparecerá aquí automáticamente unos segundos después de que dejes de hablar o escribir.
                </span>
            </div>
        </section>
    </main>
</div>

<script>
(function() {
    const textarea = document.getElementById('texto');
    const btnDictar = document.getElementById('btnDictar');
    const labelDictado = document.getElementById('labelDictado');
    const estadoDictado = document.getElementById('estadoDictado');
    const estadoIA = document.getElementById('estadoIA');
    const resultBox = document.getElementById('resultBox');

    let recognition = null;
    let escuchando = false;

    let bufferBeforeRecognition = '';
    let recognizedFinal = '';

    let lastSentText = '';
    let isSending = false;
    const HEARTBEAT_MS = 3000; // cada pocos segundos

    function setResultText(text, isError = false, isPlaceholder = false) {
        resultBox.innerHTML = '';
        const pre = document.createElement('pre');
        pre.style.margin = '0';
        pre.style.whiteSpace = 'pre-wrap';
        if (isPlaceholder) {
            pre.classList.add('result-placeholder');
        }
        if (isError) {
            pre.style.color = '#b91c1c';
        }
        pre.textContent = text;
        resultBox.appendChild(pre);
    }

    function updateIAStatus(text, cls) {
        estadoIA.textContent = text;
        estadoIA.className = 'status-text ' + (cls || '');
    }

    function sendToAIIfNeeded() {
        const current = textarea.value.trim();
        if (!current) {
            updateIAStatus('Sin texto para corregir.', 'status-warn');
            return;
        }
        if (isSending) return;
        if (current === lastSentText) return;

        isSending = true;
        updateIAStatus('Enviando a la IA…', 'status-warn');

        const params = new URLSearchParams();
        params.append('ajax', '1');
        params.append('texto', current);

        fetch(window.location.href, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: params.toString()
        })
        .then(resp => resp.json())
        .then(data => {
            if (!data || typeof data.ok === 'undefined') {
                setResultText('Respuesta inesperada del servidor.', true);
                updateIAStatus('Error en la respuesta.', 'status-error');
                return;
            }
            if (!data.ok) {
                setResultText(data.error || 'Error al procesar el texto.', true);
                updateIAStatus('Error al procesar el texto.', 'status-error');
                return;
            }
            lastSentText = current;
            setResultText(data.texto || '');
            updateIAStatus('Texto corregido actualizado.', 'status-ok');
        })
        .catch(err => {
            console.error(err);
            setResultText('Error de red al contactar con la IA.', true);
            updateIAStatus('Error de red.', 'status-error');
        })
        .finally(() => {
            isSending = false;
        });
    }

    // Heartbeat: se ejecuta cada pocos segundos
    setInterval(sendToAIIfNeeded, HEARTBEAT_MS);

    // Soporte de dictado por voz
    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SR();
        recognition.lang = 'es-ES';
        recognition.continuous = true;
        recognition.interimResults = true;

        recognition.onstart = function() {
            escuchando = true;
            btnDictar.classList.add('active');
            labelDictado.textContent = 'Detener dictado';
            estadoDictado.textContent = 'Escuchando…';
            estadoDictado.className = 'status-text status-ok';

            bufferBeforeRecognition = textarea.value.trimEnd();
            recognizedFinal = '';
        };

        recognition.onerror = function(event) {
            escuchando = false;
            btnDictar.classList.remove('active');
            labelDictado.textContent = 'Empezar dictado';
            estadoDictado.textContent = 'Error en el reconocimiento de voz.';
            estadoDictado.className = 'status-text status-error';
            console.error('Speech recognition error:', event);
        };

        recognition.onend = function() {
            escuchando = false;
            btnDictar.classList.remove('active');
            labelDictado.textContent = 'Empezar dictado';
            if (textarea.value.trim()) {
                estadoDictado.textContent = 'Dictado detenido. Texto listo para corregir.';
                estadoDictado.className = 'status-text status-ok';
            } else {
                estadoDictado.textContent = 'Dictado detenido.';
                estadoDictado.className = 'status-text status-warn';
            }
        };

        recognition.onresult = function(event) {
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
            textarea.value = fullText;
        };

        btnDictar.addEventListener('click', function() {
            if (!recognition) return;
            if (!escuchando) {
                try {
                    recognition.start();
                } catch (e) {
                    console.error(e);
                }
            } else {
                recognition.stop();
            }
        });

        estadoDictado.textContent = 'Dictado disponible. Pulsa "Empezar dictado".';
        estadoDictado.className = 'status-text status-ok';
    } else {
        btnDictar.disabled = true;
        estadoDictado.textContent = 'El dictado por voz no es compatible con este navegador.';
        estadoDictado.className = 'status-text status-error';
    }

    // Al escribir o pegar manualmente, avisamos al heartbeat de que hay cambios
    textarea.addEventListener('input', function() {
        updateIAStatus('Detectados cambios. Se corregirá en unos segundos…', 'status-warn');
    });
})();
</script>
</body>
</html>

