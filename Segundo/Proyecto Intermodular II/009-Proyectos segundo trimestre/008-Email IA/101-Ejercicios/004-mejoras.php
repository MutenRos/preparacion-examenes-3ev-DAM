<?php
// Guarda este archivo como, por ejemplo, email_dictado_voz.php

// === CONFIGURACIÓN DE LA API REMOTA (igual que en tu script de Python) ===
$API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php";
$API_KEY = "TEST_API_KEY_JOCARSA_123"; // cambia por tu API key real

$textoOriginal   = '';
$textoFormateado = '';
$errorMsg        = '';

function ajustarFormatoEmail(string $texto): string
{
    // Normalizar saltos de línea
    $texto = preg_replace("/\r\n|\r/", "\n", trim($texto));

    if ($texto === '') {
        return '';
    }

    $lineas = explode("\n", $texto);
    // Quitar espacios a la derecha
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

    // 2) Asegurar línea en blanco tras el saludo (si existe)
    //    Solo se considera el primer contenido no vacío.
    $greetingRegex = '/^(hola|buenos dias|buenos días|buenas tardes|buenas noches|estimad[oa]s?|querid[oa]s?)/iu';
    $n = count($lineas);
    for ($i = 0; $i < $n; $i++) {
        $ltrim = ltrim($lineas[$i]);
        if ($ltrim === '') {
            continue;
        }
        if (preg_match($greetingRegex, $ltrim)) {
            // Insertar una línea en blanco si no existe ya
            if ($i + 1 >= $n || trim($lineas[$i + 1]) !== '') {
                array_splice($lineas, $i + 1, 0, ['']);
            }
        }
        break; // solo miramos la primera línea no vacía
    }

    // 3) Asegurar línea en blanco antes del cierre (si existe)
    $closingRegex = '/^(un saludo|saludos|atentamente|cordialmente|muchas gracias|gracias de antemano)/iu';
    $n = count($lineas);
    for ($i = $n - 1; $i >= 0; $i--) {
        $ltrim = ltrim($lineas[$i]);
        if ($ltrim === '') {
            continue;
        }
        if (preg_match($closingRegex, $ltrim)) {
            // Insertar una línea en blanco antes si no existe ya
            if ($i - 1 < 0 || trim($lineas[$i - 1]) !== '') {
                array_splice($lineas, $i, 0, ['']);
            }
            break;
        }
    }

    return implode("\n", $lineas);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $textoOriginal = isset($_POST['texto']) ? trim($_POST['texto']) : '';

    if ($textoOriginal === '') {
        $errorMsg = "Por favor, introduce o dicta el texto.";
    } else {
        // Prompt: reescribir EXACTAMENTE el mismo contenido, sin inventar ni añadir texto nuevo.
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

        // Petición cURL a tu API PHP
        $ch = curl_init($API_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        // Enviamos la pregunta como application/x-www-form-urlencoded, campo "question"
        $postFields = http_build_query([
            'question' => $question
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

        // Cabeceras: tu API espera X-API-Key
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-API-Key: ' . $API_KEY,
            'Content-Type: application/x-www-form-urlencoded'
        ]);

        // verify=False (desactivar verificación SSL, como en tu script Python)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);

        if ($response === false) {
            $errorMsg = "Error al contactar con la API remota: " . curl_error($ch);
        } else {
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($status !== 200) {
                $errorMsg = "La API remota devolvió HTTP $status. Respuesta: " . $response;
            } else {
                $data = json_decode($response, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $errorMsg = "Error al decodificar JSON: " . json_last_error_msg() . ". Respuesta: " . $response;
                } else {
                    if (isset($data['answer']) && is_string($data['answer'])) {
                        $textoFormateado = trim($data['answer']);
                        // Ajuste final de formato tipo email (solo saltos de línea)
                        $textoFormateado = ajustarFormatoEmail($textoFormateado);
                    } else {
                        $errorMsg = "La respuesta de la API no contiene el campo 'answer'. Respuesta: " . $response;
                    }
                }
            }
        }

        curl_close($ch);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dictado y reformateo de texto (API personalizada)</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin: 2rem;
            background: #f5f5f5;
        }
        h1 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: .5rem;
        }
        textarea {
            width: 100%;
            min-height: 180px;
            padding: .75rem;
            border-radius: .4rem;
            border: 1px solid #ccc;
            font-family: inherit;
            resize: vertical;
        }
        button, .secondary-button {
            margin-top: 1rem;
            padding: .6rem 1.2rem;
            border-radius: .4rem;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }
        button {
            background: #2563eb;
            color: white;
        }
        button:hover {
            background: #1d4ed8;
        }
        .secondary-button {
            background: #e5e7eb;
            color: #111827;
            margin-right: .5rem;
        }
        .secondary-button.active {
            background: #16a34a;
            color: #ffffff;
        }
        .error {
            margin-top: 1rem;
            padding: .75rem 1rem;
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: .4rem;
        }
        .info {
            margin-top: .5rem;
            font-size: .85rem;
            color: #4b5563;
        }
        .columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-top: 2rem;
        }
        @media (max-width: 900px) {
            .columns {
                grid-template-columns: 1fr;
            }
        }
        .box {
            background: #ffffff;
            border-radius: .5rem;
            border: 1px solid #ddd;
            padding: 1rem;
        }
        .box h2 {
            font-size: 1.1rem;
            margin-bottom: .75rem;
        }
        pre {
            margin: 0;
            white-space: pre-wrap;
        }
        .status {
            margin-left: .5rem;
            font-size: .85rem;
        }
    </style>
</head>
<body>
    <h1>Dictado y reformateo de texto (API personalizada)</h1>

    <form method="post">
        <label for="texto">Texto dictado (en español)</label>
        <textarea id="texto" name="texto" placeholder="Pulsa &quot;Dictar&quot; o pega aquí tu texto..."><?php
            echo htmlspecialchars($textoOriginal, ENT_QUOTES, 'UTF-8');
        ?></textarea>
        <div>
            <button type="button" id="btnDictar" class="secondary-button">🎙️ Dictar</button>
            <span id="estadoDictado" class="status"></span>
        </div>
        <div class="info">
            El dictado usa la API de reconocimiento de voz del navegador (Web Speech API).  
            Funciona mejor en Chrome/Edge de escritorio. Configurado para <strong>es-ES</strong>.
        </div>
        <button type="submit">Reformatear texto</button>
    </form>

    <?php if ($errorMsg): ?>
        <div class="error">
            <?php echo htmlspecialchars($errorMsg, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <?php if ($textoOriginal !== '' && ($textoFormateado !== '' || $errorMsg)): ?>
        <div class="columns">
            <div class="box">
                <h2>Texto original</h2>
                <pre><?php echo htmlspecialchars($textoOriginal, ENT_QUOTES, 'UTF-8'); ?></pre>
            </div>
            <div class="box">
                <h2>Texto corregido (formato email)</h2>
                <pre><?php echo htmlspecialchars($textoFormateado, ENT_QUOTES, 'UTF-8'); ?></pre>
            </div>
        </div>
    <?php endif; ?>

    <script>
    (function() {
        const textarea = document.getElementById('texto');
        const btnDictar = document.getElementById('btnDictar');
        const estado = document.getElementById('estadoDictado');

        let recognition = null;
        let escuchando = false;

        if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
            const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
            recognition = new SR();
            recognition.lang = 'es-ES';
            recognition.continuous = true;
            recognition.interimResults = true;

            recognition.onstart = function() {
                escuchando = true;
                btnDictar.classList.add('active');
                estado.textContent = 'Escuchando... habla cerca del micrófono.';
            };

            recognition.onerror = function(event) {
                escuchando = false;
                btnDictar.classList.remove('active');
                estado.textContent = 'Error en el reconocimiento de voz.';
                console.error('Speech recognition error:', event);
            };

            recognition.onend = function() {
                escuchando = false;
                btnDictar.classList.remove('active');
                estado.textContent = 'Dictado detenido.';
            };

            recognition.onresult = function(event) {
                let finalText = '';
                let interimText = '';

                for (let i = event.resultIndex; i < event.results.length; i++) {
                    const transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                        finalText += transcript + ' ';
                    } else {
                        interimText += transcript;
                    }
                }

                if (finalText) {
                    // Añadir lo reconocido definitivamente al textarea
                    textarea.value = textarea.value.replace(/\s+$/, '') + (textarea.value ? ' ' : '') + finalText.trim() + ' ';
                }
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
        } else {
            // No hay soporte de Web Speech API
            btnDictar.disabled = true;
            estado.textContent = 'El dictado por voz no es compatible con este navegador.';
        }
    })();
    </script>
</body>
</html>

