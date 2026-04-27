<?php
// cv_qa.php
// Script sencillo: dado un URL de curriculum y una pregunta,
// envía el contenido del CV + la pregunta a tu API de IA y muestra la respuesta.

// === CONFIGURACIÓN DE LA API REMOTA (MISMA QUE EN TU SERVIDOR) ===
$API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php";
$API_KEY = "TEST_API_KEY_JOCARSA_123";

// -----------------------------------------------------------------------------
//  Función: descargar el contenido de una URL con cURL
// -----------------------------------------------------------------------------
function fetch_url_content(string $url): array
{
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return ['ok' => false, 'error' => 'URL no válida.', 'content' => ''];
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'JOCARSA-CV-Client/1.0');
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    $html = curl_exec($ch);

    if ($html === false) {
        $err = curl_error($ch);
        curl_close($ch);
        return ['ok' => false, 'error' => "Error al descargar la URL: $err", 'content' => ''];
    }

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status < 200 || $status >= 300) {
        return ['ok' => false, 'error' => "La URL devolvió HTTP $status.", 'content' => ''];
    }

    return ['ok' => true, 'error' => '', 'content' => $html];
}

// -----------------------------------------------------------------------------
//  Función: limpiar HTML → texto plano razonable
// -----------------------------------------------------------------------------
function html_to_plain_text(string $html): string
{
    // Quitar scripts y estilos
    $html = preg_replace('#<(script|style)[^>]*>.*?</\1>#si', ' ', $html);
    // Quitar tags, mantener saltos básicos
    $text = strip_tags($html);
    // Decodificar entidades HTML
    $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    // Normalizar espacios
    $text = preg_replace("/\r\n|\r/", "\n", $text);
    $text = preg_replace('/[ \t]+/', ' ', $text);
    $text = preg_replace('/\n{3,}/', "\n\n", $text);
    $text = trim($text);

    // (Opcional) cortar si el CV es enorme
    $maxLen = 20000;
    if (mb_strlen($text, 'UTF-8') > $maxLen) {
        $text = mb_substr($text, 0, $maxLen, 'UTF-8') . "\n\n[Texto truncado por longitud máxima]";
    }

    return $text;
}

// -----------------------------------------------------------------------------
//  Función: llamar a la IA con CV + pregunta
// -----------------------------------------------------------------------------
function preguntar_sobre_cv(string $cvText, string $userQuestion, string $API_URL, string $API_KEY): array
{
    if ($cvText === '') {
        return ['ok' => false, 'error' => 'El CV aparece vacío tras la descarga/limpieza.', 'answer' => ''];
    }
    if (trim($userQuestion) === '') {
        return ['ok' => false, 'error' => 'La pregunta está vacía.', 'answer' => ''];
    }

    // Prompt en español para tu servidor de IA
    $question =
        "Eres un asistente que responde preguntas sobre un curriculum vitae en español.\n\n" .
        "A continuación tienes el contenido del CV entre las marcas <CV> y </CV>.\n" .
        "Después te indicaré una pregunta.\n\n" .
        "REGLAS:\n" .
        "- Responde usando solo la información que aparezca en el CV.\n" .
        "- Si la respuesta no aparece explícitamente en el CV, responde exactamente: \"No se indica en el CV.\"\n" .
        "- Responde de forma breve y directa.\n\n" .
        "<CV>\n" .
        $cvText .
        "\n</CV>\n\n" .
        "Pregunta: " . $userQuestion . "\n\n" .
        "Respuesta:";

    $ch = curl_init($API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    $postFields = http_build_query(['question' => $question]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-API-Key: ' . $API_KEY,
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    // Ajusta esto según tu entorno SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);

    if ($response === false) {
        $err = "Error al contactar con la API remota: " . curl_error($ch);
        curl_close($ch);
        return ['ok' => false, 'error' => $err, 'answer' => ''];
    }

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status !== 200) {
        return ['ok' => false, 'error' => "La API remota devolvió HTTP $status. Respuesta: $response", 'answer' => ''];
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['ok' => false, 'error' => "Error al decodificar JSON: " . json_last_error_msg() . ". Respuesta: $response", 'answer' => ''];
    }

    if (!isset($data['answer']) || !is_string($data['answer'])) {
        return ['ok' => false, 'error' => "La respuesta de la API no contiene el campo 'answer'. Respuesta: $response", 'answer' => ''];
    }

    return ['ok' => true, 'error' => '', 'answer' => trim($data['answer'])];
}

// -----------------------------------------------------------------------------
//  Lógica principal: formulario + procesamiento
// -----------------------------------------------------------------------------
$defaultUrl       = "https://kebouriman6-glitch.github.io/Curriculum/";
$defaultQuestion  = "¿Dónde vive esta persona?";

$resultMessage = null;
$resultOk = null;
$answerFromAI = null;
$cvPreview = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = isset($_POST['cv_url']) ? trim($_POST['cv_url']) : '';
    $questionUser = isset($_POST['question']) ? trim($_POST['question']) : '';

    if ($url === '' || $questionUser === '') {
        $resultOk = false;
        $resultMessage = 'URL del curriculum y pregunta son obligatorias.';
    } else {
        // 1) Descargar CV
        $fetch = fetch_url_content($url);
        if (!$fetch['ok']) {
            $resultOk = false;
            $resultMessage = $fetch['error'];
        } else {
            // 2) Limpiar HTML a texto
            $cvText = html_to_plain_text($fetch['content']);
            $cvPreview = $cvText;

            // 3) Preguntar a la IA
            $ai = preguntar_sobre_cv($cvText, $questionUser, $API_URL, $API_KEY);
            $resultOk = $ai['ok'];
            if ($ai['ok']) {
                $answerFromAI = $ai['answer'];
                $resultMessage = 'Respuesta obtenida correctamente desde la IA.';
            } else {
                $resultMessage = $ai['error'];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Preguntar a la IA sobre un Curriculum</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin: 0;
            padding: 2rem;
            background: #f3f4f6;
            color: #111827;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        .card {
            background: #ffffff;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        h1 {
            font-size: 1.4rem;
            margin-bottom: .5rem;
        }
        p {
            margin-top: 0;
            color: #4b5563;
        }
        label {
            display: block;
            font-size: .9rem;
            margin-bottom: .25rem;
            color: #374151;
        }
        input[type="text"],
        textarea {
            width: 100%;
            border-radius: .5rem;
            border: 1px solid #d1d5db;
            padding: .5rem .7rem;
            font-size: .9rem;
            font-family: inherit;
            box-sizing: border-box;
        }
        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
        }
        button {
            padding: .5rem 1rem;
            border-radius: 999px;
            border: 1px solid #2563eb;
            background: #2563eb;
            color: #ffffff;
            font-size: .9rem;
            font-weight: 500;
            cursor: pointer;
        }
        button:hover {
            background: #1d4ed8;
        }
        .status {
            margin-top: .75rem;
            padding: .6rem .9rem;
            border-radius: .6rem;
            font-size: .85rem;
        }
        .status.ok {
            background: #ecfdf3;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }
        .status.error {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        pre {
            white-space: pre-wrap;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: .85rem;
            background: #f9fafb;
            padding: .75rem;
            border-radius: .5rem;
            border: 1px solid #e5e7eb;
            max-height: 300px;
            overflow: auto;
        }
        .subtitle {
            font-size: .85rem;
            color: #6b7280;
            margin-bottom: 1rem;
        }
        .field-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Preguntar a la IA sobre un Curriculum</h1>
        <p class="subtitle">
            Introduce la URL del CV y una pregunta. El script descargará el CV, lo enviará a la IA junto con la pregunta
            (por ejemplo: <strong>¿Dónde vive esta persona?</strong>) y mostrará la respuesta.
        </p>

        <form method="post">
            <div class="field-group">
                <label for="cv_url">URL del curriculum</label>
                <input type="text" id="cv_url" name="cv_url"
                       value="<?php echo htmlspecialchars($_POST['cv_url'] ?? $defaultUrl, ENT_QUOTES, 'UTF-8'); ?>"
                       placeholder="https://...">
            </div>

            <div class="field-group">
                <label for="question">Pregunta para la IA</label>
                <input type="text" id="question" name="question"
                       value="<?php echo htmlspecialchars($_POST['question'] ?? $defaultQuestion, ENT_QUOTES, 'UTF-8'); ?>"
                       placeholder="¿Dónde vive esta persona?">
            </div>

            <button type="submit">Enviar a la IA</button>

            <?php if ($resultMessage !== null): ?>
                <div class="status <?php echo $resultOk ? 'ok' : 'error'; ?>">
                    <?php echo htmlspecialchars($resultMessage, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>
        </form>
    </div>

    <?php if ($answerFromAI !== null): ?>
        <div class="card">
            <h2>Respuesta de la IA</h2>
            <pre><?php echo htmlspecialchars($answerFromAI, ENT_QUOTES, 'UTF-8'); ?></pre>
        </div>
    <?php endif; ?>

    <?php if ($cvPreview !== null): ?>
        <div class="card">
            <h2>Texto del CV (previa)</h2>
            <p class="subtitle">Texto plano extraído del HTML enviado a la IA (puede estar truncado).</p>
            <pre><?php echo htmlspecialchars($cvPreview, ENT_QUOTES, 'UTF-8'); ?></pre>
        </div>
    <?php endif; ?>
</div>
</body>
</html>

