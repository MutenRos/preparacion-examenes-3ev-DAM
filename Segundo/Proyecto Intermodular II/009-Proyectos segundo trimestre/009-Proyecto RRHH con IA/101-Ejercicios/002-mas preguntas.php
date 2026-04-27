<?php
// cv_qa_tabla.php
// Dado un URL de curriculum, pregunta a la IA por 5 cuestiones
// y muestra las respuestas en una tabla (una sola fila).

// === CONFIGURACIÓN DE LA API REMOTA ===
$API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php";
$API_KEY = "TEST_API_KEY_JOCARSA_123";

// -----------------------------------------------------------------------------
// Descargar contenido de una URL
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
// Limpiar HTML → texto plano
// -----------------------------------------------------------------------------
function html_to_plain_text(string $html): string
{
    $html = preg_replace('#<(script|style)[^>]*>.*?</\1>#si', ' ', $html);
    $text = strip_tags($html);
    $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $text = preg_replace("/\r\n|\r/", "\n", $text);
    $text = preg_replace('/[ \t]+/', ' ', $text);
    $text = preg_replace('/\n{3,}/', "\n\n", $text);
    $text = trim($text);

    $maxLen = 20000;
    if (mb_strlen($text, 'UTF-8') > $maxLen) {
        $text = mb_substr($text, 0, $maxLen, 'UTF-8') . "\n\n[Texto truncado por longitud máxima]";
    }

    return $text;
}

// -----------------------------------------------------------------------------
// Llamar a la IA para que devuelva un JSON con las 5 respuestas
// -----------------------------------------------------------------------------
function analizar_cv(string $cvText, string $API_URL, string $API_KEY): array
{
    if ($cvText === '') {
        return ['ok' => false, 'error' => 'El CV aparece vacío tras la descarga/limpieza.', 'parsed' => null, 'raw' => ''];
    }

    // Prompt en español, pidiendo JSON estricto
    $question =
        "Eres un asistente que analiza un curriculum vitae escrito en español.\n\n" .
        "Recibirás el texto del CV entre las marcas <CV> y </CV>.\n" .
        "Debes responder a estas 5 preguntas:\n\n" .
        "1) ¿Dónde vive esa persona?\n" .
        "2) ¿Tiene carnet de conducir vehículos?\n" .
        "3) ¿Tiene vehículo propio?\n" .
        "4) ¿Está trabajando actualmente?\n" .
        "5) ¿Cuál es su puesto de trabajo actual?\n\n" .
        "INSTRUCCIONES DE CONTENIDO:\n" .
        "- Usa SOLO la información que aparece en el CV.\n" .
        "- Si una información NO aparece claramente en el CV, marca ese campo como \"no indicado\".\n" .
        "- Si es claramente NO (por ejemplo, se indica que no tiene carnet o no está trabajando), marca ese campo como \"no\".\n" .
        "- No inventes datos.\n\n" .
        "FORMATO DE RESPUESTA (MUY IMPORTANTE):\n" .
        "- Devuelve ÚNICAMENTE un JSON válido, sin texto antes ni después.\n" .
        "- El JSON debe tener exactamente estas claves:\n" .
        "{\n" .
        "  \"donde_vive\": \"...\",                  // texto con la localidad / país o \"no indicado\"\n" .
        "  \"tiene_carnet_conducir\": \"si/no/no indicado\",\n" .
        "  \"tiene_vehiculo_propio\": \"si/no/no indicado\",\n" .
        "  \"esta_trabajando_actualmente\": \"si/no/no indicado\",\n" .
        "  \"puesto_trabajo_actual\": \"...\"        // texto con el puesto o \"no indicado\"\n" .
        "}\n\n" .
        "<CV>\n" .
        $cvText .
        "\n</CV>";

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
        return ['ok' => false, 'error' => $err, 'parsed' => null, 'raw' => ''];
    }

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status !== 200) {
        return ['ok' => false, 'error' => "La API remota devolvió HTTP $status. Respuesta: $response", 'parsed' => null, 'raw' => ''];
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['ok' => false, 'error' => "Error al decodificar JSON externo: " . json_last_error_msg() . ". Respuesta: $response", 'parsed' => null, 'raw' => ''];
    }

    if (!isset($data['answer']) || !is_string($data['answer'])) {
        return ['ok' => false, 'error' => "La respuesta de la API no contiene el campo 'answer'. Respuesta: $response", 'parsed' => null, 'raw' => ''];
    }

    $rawAnswer = trim($data['answer']);

    // Intentar extraer solo el JSON (por si el modelo añade algo)
    $jsonString = $rawAnswer;
    $start = strpos($jsonString, '{');
    $end   = strrpos($jsonString, '}');
    if ($start !== false && $end !== false && $end > $start) {
        $jsonString = substr($jsonString, $start, $end - $start + 1);
    }
    $jsonString = trim($jsonString);

    $parsed = json_decode($jsonString, true);
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($parsed)) {
        return [
            'ok'     => false,
            'error'  => "Error al decodificar el JSON interno devuelto por la IA: " . json_last_error_msg(),
            'parsed' => null,
            'raw'    => $rawAnswer
        ];
    }

    return ['ok' => true, 'error' => '', 'parsed' => $parsed, 'raw' => $rawAnswer];
}

// -----------------------------------------------------------------------------
// Decorar valores según reglas de globos
// -----------------------------------------------------------------------------
function decorar_valor(string $valor): string
{
    $trim = trim($valor);
    $norm = mb_strtolower($trim, 'UTF-8');

    if ($norm === 'no indicado' || $norm === '') {
        // globo amarillo (aprox.)
        return 'no indicado 🟡';
    }
    if ($norm === 'no') {
        // globo rojo
        return 'no 🎈';
    }
    return $trim; // positivo o texto con información
}

// -----------------------------------------------------------------------------
// Lógica principal
// -----------------------------------------------------------------------------
$defaultUrl = "https://kebouriman6-glitch.github.io/Curriculum/";

$resultMessage = null;
$resultOk = null;
$parsedAnswers = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = isset($_POST['cv_url']) ? trim($_POST['cv_url']) : '';

    if ($url === '') {
        $resultOk = false;
        $resultMessage = 'La URL del curriculum es obligatoria.';
    } else {
        // 1) Descargar CV
        $fetch = fetch_url_content($url);
        if (!$fetch['ok']) {
            $resultOk = false;
            $resultMessage = $fetch['error'];
        } else {
            // 2) Limpiar a texto
            $cvText = html_to_plain_text($fetch['content']);

            // 3) Analizar con IA
            $ai = analizar_cv($cvText, $API_URL, $API_KEY);
            $resultOk = $ai['ok'];
            if ($ai['ok']) {
                $parsedAnswers = $ai['parsed'];
                $resultMessage = 'Análisis realizado correctamente por la IA.';
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
    <title>Análisis de Curriculum con IA</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin: 0;
            padding: 2rem;
            background: #f3f4f6;
            color: #111827;
        }
        .container {
            max-width: 1000px;
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
        input[type="text"] {
            width: 100%;
            border-radius: .5rem;
            border: 1px solid #d1d5db;
            padding: .5rem .7rem;
            font-size: .9rem;
            font-family: inherit;
            box-sizing: border-box;
        }
        input[type="text"]:focus {
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
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: .9rem;
        }
        th, td {
            border: 1px solid #e5e7eb;
            padding: .6rem .5rem;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #f9fafb;
            font-weight: 600;
        }
        .subtitle {
            font-size: .85rem;
            color: #6b7280;
            margin-bottom: 1rem;
        }
        .badge {
            display: inline-block;
            padding: .2rem .6rem;
            border-radius: 999px;
            font-size: .75rem;
            background: #eef2ff;
            color: #3730a3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Análisis de un Curriculum con IA</h1>
        <p class="subtitle">
            El sistema revisa el curriculum y responde automáticamente a estas preguntas, mostrando una sola fila:
            <br>1) ¿Dónde vive esa persona?
            <br>2) ¿Tiene carnet de conducir vehículos?
            <br>3) ¿Tiene vehículo propio?
            <br>4) ¿Está trabajando actualmente?
            <br>5) Puesto de trabajo actual.
        </p>

        <form method="post">
            <label for="cv_url">URL del curriculum</label>
            <input type="text" id="cv_url" name="cv_url"
                   value="<?php echo htmlspecialchars($_POST['cv_url'] ?? $defaultUrl, ENT_QUOTES, 'UTF-8'); ?>"
                   placeholder="https://...">

            <div style="margin-top:1rem;">
                <button type="submit">Analizar CV con IA</button>
                <span class="badge">Versión 1 · 1 solo curriculum</span>
            </div>

            <?php if ($resultMessage !== null): ?>
                <div class="status <?php echo $resultOk ? 'ok' : 'error'; ?>">
                    <?php echo htmlspecialchars($resultMessage, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>
        </form>
    </div>

    <?php if ($parsedAnswers !== null): ?>
        <div class="card">
            <h2>Resultado del análisis</h2>
            <table>
                <thead>
                    <tr>
                        <th>1. ¿Dónde vive esa persona?</th>
                        <th>2. ¿Tiene carnet de conducir vehículos?</th>
                        <th>3. ¿Tiene vehículo propio?</th>
                        <th>4. ¿Está trabajando actualmente?</th>
                        <th>5. Puesto de trabajo actual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php
                                echo htmlspecialchars(
                                    decorar_valor($parsedAnswers['donde_vive'] ?? 'no indicado'),
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                            ?>
                        </td>
                        <td>
                            <?php
                                echo htmlspecialchars(
                                    decorar_valor($parsedAnswers['tiene_carnet_conducir'] ?? 'no indicado'),
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                            ?>
                        </td>
                        <td>
                            <?php
                                echo htmlspecialchars(
                                    decorar_valor($parsedAnswers['tiene_vehiculo_propio'] ?? 'no indicado'),
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                            ?>
                        </td>
                        <td>
                            <?php
                                echo htmlspecialchars(
                                    decorar_valor($parsedAnswers['esta_trabajando_actualmente'] ?? 'no indicado'),
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                            ?>
                        </td>
                        <td>
                            <?php
                                echo htmlspecialchars(
                                    decorar_valor($parsedAnswers['puesto_trabajo_actual'] ?? 'no indicado'),
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>

