<?php
// dictado_email.php

// === CONFIGURACIÓN DE LA API REMOTA ===
$API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php";
$API_KEY = "TEST_API_KEY_JOCARSA_123"; // cambia por tu API key real

function ajustarFormatoEmail(string $texto): string
{
    $texto = preg_replace("/\r\n|\r/", "\n", trim($texto));

    if ($texto === '') {
        return '';
    }

    $lineas = explode("\n", $texto);
    $lineas = array_map(static fn($l) => rtrim($l), $lineas);

    // Reducir grupos de líneas vacías (máx. 1 seguida)
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

    // Línea en blanco tras saludo
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

    // Línea en blanco antes del cierre
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

    $question =
        "Eres un asistente de edición de texto en español.\n\n" .
        "TAREA:\n" .
        "Reescribe el texto que te paso a continuación, manteniendo EXACTAMENTE el mismo contenido y significado,\n" .
        "pero corrigiendo solo:\n" .
        "- Ortografía y acentuación.\n" .
        "- Puntuación.\n" .
        "- Mayúsculas y minúsculas.\n" .
        "- Saltos de línea y separación en párrafos para que sea más legible.\n\n" .
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

// === MODO AJAX: petición de IA (no recargar página) ===
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
            --bg-gradient: radial-gradient(circle at top left, #1e293b, #020617);
            --card-bg: rgba(15, 23, 42, 0.9);
            --card-border: rgba(148, 163, 184, 0.3);
            --accent: #38bdf8;
            --accent-soft: rgba(56, 189, 248, 0.15);
            --text-main: #e5e7eb;
            --text-muted: #9ca3af;
            --error: #fca5a5;
            --success: #4ade80;
        }
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg-gradient);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: stretch;
            padding: 2rem;
        }
        .app-shell {
            width: 100%;
            max-width: 1200px;
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
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: .02em;
            display: flex;
            align-items: center;
            gap: .6rem;
        }
        .app-title-badge {
            font-size: .8rem;
            padding: .15rem .5rem;
            border-radius: 999px;
            background: var(--accent-soft);
            color: var(--accent);
            border: 1px solid rgba(56, 189, 248, 0.4);
        }
        .app-subtitle {
            font-size: .9rem;
            color: var(--text-muted);
        }
        .pill {
            font-size: .75rem;
            padding: .3rem .6rem;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.4);
            color: var(--text-muted);
        }
        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
            gap: 1.5rem;
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
            border-radius: 1.25rem;
            border: 1px solid var(--card-border);
            padding: 1.3rem 1.4rem;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.7);
            position: relative;
            overflow: hidden;
        }
        .card::before {
            content: "";
            position: absolute;
            inset: -40%;
            background: radial-gradient(circle at top left, rgba(56, 189, 248, 0.12), transparent 55%);
            opacity: 0.6;
            pointer-events: none;
        }
        .card-inner {
            position: relative;
            z-index: 1;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: .75rem;
            margin-bottom: .75rem;
        }
        .card-title {
            font-size: 1.05rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .card-title span.icon {
            font-size: 1.2rem;
        }
        .card-caption {
            font-size: .8rem;
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
            min-height: 220px;
            resize: vertical;
            border-radius: .9rem;
            border: 1px solid rgba(148, 163, 184, 0.5);
            background: rgba(15, 23, 42, 0.85);
            color: var(--text-main);
            padding: .9rem 1rem;
            font-family: inherit;
            font-size: .95rem;
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        }
        textarea:focus {
            border-color: rgba(56, 189, 248, 0.7);
            box-shadow: 0 0 0 1px rgba(56, 189, 248, 0.4);
            background: rgba(15, 23, 42, 0.95);
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
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .5rem .9rem;
            border-radius: 999px;
            border: 1px solid transparent;
            font-size: .85rem;
            font-weight: 500;
            cursor: pointer;
            background: rgba(15, 23, 42, 0.9);
            color: var(--text-main);
            transition: background 0.15s ease, border-color 0.15s ease, transform 0.08s ease, box-shadow 0.15s ease;
        }
        .btn-icon {
            font-size: 1rem;
        }
        .btn-voice {
            border-color: rgba(148, 163, 184, 0.6);
        }
        .btn-voice:hover {
            background: rgba(15, 23, 42, 0.7);
            border-color: rgba(56, 189, 248, 0.6);
        }
        .btn-voice.active {
            background: rgba(34, 197, 94, 0.16);
            border-color: rgba(34, 197, 94, 0.8);
            box-shadow: 0 0 0 1px rgba(22, 163, 74, 0.4);
        }
        .btn-voice.active .pulse-dot {
            background: var(--success);
            box-shadow: 0 0 0 6px rgba(74, 222, 128, 0.25);
        }
        .pulse-dot {
            width: .55rem;
            height: .55rem;
            border-radius: 999px;
            background: rgba(148, 163, 184, 0.9);
            transition: background 0.15s ease, box-shadow 0.15s ease;
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
            color: #facc15;
        }
        .result-box {
            margin-top: .4rem;
            padding: .75rem .9rem;
            border-radius: .9rem;
            border: 1px dashed rgba(148, 163, 184, 0.5);
            background: rgba(15, 23, 42, 0.7);
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: .9rem;
            white-space: pre-wrap;
            max-height: 380px;
            overflow: auto;
        }
        .result-placeholder {
            color: var(--text-muted);
            font-style: italic;
        }
        .badge-ai {
            font-size: .75rem;
            padding: .2rem .55rem;
            border-radius: 999px;
            background: rgba(56, 189, 248, 0.12);
            color: var(--accent);
            border: 1px solid rgba(56, 189, 248, 0.4);
        }
        .chip {
            font-size: .75rem;
            padding: .2rem .5rem;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(148, 163, 184, 0.45);
            color: var(--text-muted);
        }
        .thin-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .thin-scroll::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.9);
        }
        .thin-scroll::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.65);
            border-radius: 999px;
        }
    </style>
</head>
<body>
<div class="app-shell">
    <header class="app-header">
        <div>
            <div class="app-title">
                <span>📧 Dictado de correo</span>
                <span class="app-title-badge">Auto-corrección IA</span>
            </div>
            <div class="app-subtitle">
                Habla y observa cómo el texto se corrige en segundo plano para usarlo como email.
            </div>
        </div>
        <div class="pill">
            🎙️ Dictado por voz · es-ES
        </div>
    </header>

    <main class="layout">
        <!-- Panel de dictado -->
        <section class="card">
            <div class="card-inner">
                <div class="card-header">
                    <div class="card-title">
                        <span class="icon">🗣️</span>
                        <span>Dictado / texto de entrada</span>
                    </div>
                    <div class="card-caption">
                        Puedes dictar o escribir/pegar el contenido manualmente.
                    </div>
                </div>

                <label for="texto">Contenido del correo (dictado o escrito)</label>
                <textarea id="texto" placeholder="Pulsa &quot;Empezar dictado&quot; o escribe aquí tu texto..."></textarea>

                <div class="controls-row">
                    <div class="left-controls">
                        <button type="button" id="btnDictar" class="btn btn-voice">
                            <span class="pulse-dot"></span>
                            <span class="btn-icon">🎙️</span>
                            <span id="labelDictado">Empezar dictado</span>
                        </button>
                        <span class="chip">Autoenvío a IA cada pocos segundos</span>
                    </div>
                    <div class="right-controls">
                        <span id="estadoDictado" class="status-text status-warn">
                            Dictado en espera.
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Panel de salida IA -->
        <section class="card">
            <div class="card-inner">
                <div class="card-header">
                    <div class="card-title">
                        <span class="icon">✨</span>
                        <span>Texto corregido (formato correo)</span>
                    </div>
                    <div class="card-caption">
                        Corrección suave, sin inventar contenido, con saltos de línea tipo email.
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
                        El texto corregido aparecerá aquí automáticamente unos segundos después de que dejes de hablar o dejes de escribir.
                    </span>
                </div>
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
    const HEARTBEAT_MS = 3000; // "few seconds"

    function setResultText(text, isError = false, isPlaceholder = false) {
        resultBox.innerHTML = '';
        const pre = document.createElement('pre');
        pre.style.margin = '0';
        pre.style.whiteSpace = 'pre-wrap';
        if (isPlaceholder) {
            pre.classList.add('result-placeholder');
        }
        if (isError) {
            pre.style.color = '#fca5a5';
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
        if (isSending) {
            return;
        }
        if (current === lastSentText) {
            return;
        }

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

    // Heartbeat: comprueba cada pocos segundos si el texto ha cambiado
    setInterval(sendToAIIfNeeded, HEARTBEAT_MS);

    // Soporte de dictado
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
            estadoDictado.textContent = 'Escuchando… habla cerca del micrófono.';
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

    // Si el usuario escribe/pega manualmente, actualizamos estado IA
    textarea.addEventListener('input', function() {
        updateIAStatus('Detectados cambios. Se corregirá en unos segundos…', 'status-warn');
    });
})();
</script>
</body>
</html>

