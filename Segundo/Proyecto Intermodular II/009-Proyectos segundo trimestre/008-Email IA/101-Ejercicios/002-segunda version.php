<?php
// Guarda este archivo como, por ejemplo, email_dictado.php

// === CONFIGURACIÓN DE LA API REMOTA (igual que en tu script de Python) ===
$API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php";
$API_KEY = "TEST_API_KEY_JOCARSA_123"; // cambia por tu API key real

$textoOriginal   = '';
$textoFormateado = '';
$errorMsg        = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $textoOriginal = isset($_POST['texto']) ? trim($_POST['texto']) : '';

    if ($textoOriginal === '') {
        $errorMsg = "Por favor, introduce el texto dictado.";
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

        // Igual que en el script de Python: verify=False (desactivar verificación SSL)
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
    <title>Reformatear texto dictado (API personalizada)</title>
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
        button {
            margin-top: 1rem;
            padding: .6rem 1.2rem;
            border-radius: .4rem;
            border: none;
            cursor: pointer;
            font-weight: 600;
            background: #2563eb;
            color: white;
        }
        button:hover {
            background: #1d4ed8;
        }
        .error {
            margin-top: 1rem;
            padding: .75rem 1rem;
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: .4rem;
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
    </style>
</head>
<body>
    <h1>Reformatear texto dictado (API personalizada)</h1>

    <form method="post">
        <label for="texto">Texto dictado (en español)</label>
        <textarea id="texto" name="texto" placeholder="Pega aquí tu dictado..."><?php
            echo htmlspecialchars($textoOriginal, ENT_QUOTES, 'UTF-8');
        ?></textarea>
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
                <h2>Texto corregido</h2>
                <pre><?php echo htmlspecialchars($textoFormateado, ENT_QUOTES, 'UTF-8'); ?></pre>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>

