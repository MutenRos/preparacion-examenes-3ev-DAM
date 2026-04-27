<?php
// cv_lavender_qa.php
// 1) Busca estudiantes en Lavender por DNI.
// 2) De cada resultado obtiene:
//      - "Indica tu nombre completo"
//      - "Indica la URL de tu CV"
// 3) Para cada CV, llama a la IA para analizar 5 preguntas.
// 4) Muestra una tabla con una fila por estudiante.

// =======================
// CONFIG: Lavender
// =======================
const LAVENDER_URL       = 'https://lavender.jocarsa.com/api_lavender.php';
const LAVENDER_USER      = 'jocarsa';
const LAVENDER_PASS      = 'jocarsa';
const LAVENDER_FORM_HASH = '3a31ecc0cec268839ff95a1924409b67';

// =======================
// CONFIG: API IA CV
// =======================
$API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php";
$API_KEY = "TEST_API_KEY_JOCARSA_123";

// -----------------------------------------------------------------------------
//  Función helper: cURL POST JSON a Lavender (similar al _curl_json en Python)
// -----------------------------------------------------------------------------
function lavender_curl_json(string $payload): string
{
    $ch = curl_init(LAVENDER_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $response = curl_exec($ch);
    if ($response === false) {
        error_log("[ERROR] Lavender curl failed: " . curl_error($ch));
        curl_close($ch);
        return "";
    }
    curl_close($ch);
    return trim($response);
}

// -----------------------------------------------------------------------------
//  Construir payload JSON para Lavender (similar a _payload en Python)
// -----------------------------------------------------------------------------
function lavender_payload(string $dni, string $key, bool $strict): string
{
    $payload = [
        "username"         => LAVENDER_USER,
        "password"         => LAVENDER_PASS,
        "form_hash"        => LAVENDER_FORM_HASH,
        "key"              => $key,
        "value"            => $dni,
        "case_insensitive" => true,
        "strict"           => $strict
    ];
    return json_encode($payload, JSON_UNESCAPED_UNICODE);
}

// -----------------------------------------------------------------------------
//  Implementación PHP de fetch_student_json(dni)
//  Devuelve el JSON decodificado (array) de la primera búsqueda con count>0
//  o el último JSON decodificado (para diagnóstico) o null si error grave.
// -----------------------------------------------------------------------------
function fetch_lavender_students_raw(string $dni): ?array
{
    $tries = [
        ["Indica tu DNI", true],
        ["Indica tu DNI", false],
        ["DNI", false],
        ["dni", false],
    ];

    $lastDecoded = null;

    foreach ($tries as [$key, $strict]) {
        $payload = lavender_payload($dni, $key, $strict);
        $resp = lavender_curl_json($payload);
        if ($resp === "") {
            // Error de red; seguimos probando pero recordamos que puede fallar todo
            $lastDecoded = null;
            continue;
        }

        $decoded = json_decode($resp, true);
        if (!is_array($decoded)) {
            // Podría haber HTML en error u otro formato; seguimos.
            $lastDecoded = null;
            continue;
        }
        $lastDecoded = $decoded;

        if (isset($decoded['count']) && (int)$decoded['count'] > 0) {
            return $decoded; // primera con count>0
        }
    }

    // Ninguna con count>0: devolvemos la última respuesta decodificada (puede contener info vacía)
    return $lastDecoded;
}

// -----------------------------------------------------------------------------
//  Extraer lista de estudiantes (nombre completo + URL CV) a partir del JSON Lavender
//  Estructura esperada: ['columns' => [...], 'rows' => [...]]
// -----------------------------------------------------------------------------
function extract_students_from_lavender(array $data): array
{
    $students = [];

    if (empty($data['columns']) || empty($data['rows']) || !is_array($data['columns']) || !is_array($data['rows'])) {
        return $students;
    }

    $columns = $data['columns'];
    $rows    = $data['rows'];

    // Buscar índices de las columnas
    $idxNombre = null;
    $idxCV     = null;

    foreach ($columns as $i => $col) {
        $label = '';
        if (is_array($col)) {
            $label = $col['label'] ?? ($col['name'] ?? ($col['title'] ?? ''));
        } else {
            $label = (string)$col;
        }
        $normalized = mb_strtolower(trim($label), 'UTF-8');

        if ($normalized === mb_strtolower('Indica tu nombre completo', 'UTF-8')) {
            $idxNombre = $i;
        }
        if ($normalized === mb_strtolower('Indica la URL de tu CV', 'UTF-8')) {
            $idxCV = $i;
        }
    }

    if ($idxNombre === null && $idxCV === null) {
        return $students; // no se encontraron columnas relevantes
    }

    foreach ($rows as $row) {
        $nombre = '';
        $cvUrl  = '';

        // Caso 1: fila como array indexado por posición
        if (is_array($row) && array_keys($row) === range(0, count($row) - 1)) {
            if ($idxNombre !== null && isset($row[$idxNombre])) {
                $nombre = trim((string)$row[$idxNombre]);
            }
            if ($idxCV !== null && isset($row[$idxCV])) {
                $cvUrl = trim((string)$row[$idxCV]);
            }
        } elseif (is_array($row)) {
            // Caso 2 (fallback): fila asociativa, intentamos buscar claves por nombre de columna
            foreach ($row as $k => $v) {
                $kNorm = mb_strtolower(trim((string)$k), 'UTF-8');
                if ($kNorm === mb_strtolower('Indica tu nombre completo', 'UTF-8')) {
                    $nombre = trim((string)$v);
                }
                if ($kNorm === mb_strtolower('Indica la URL de tu CV', 'UTF-8')) {
                    $cvUrl = trim((string)$v);
                }
            }
        }

        if ($nombre !== '' || $cvUrl !== '') {
            $students[] = [
                'nombre' => $nombre,
                'cv_url' => $cvUrl,
            ];
        }
    }

    return $students;
}

// -----------------------------------------------------------------------------
//  Descarga contenido de una URL (CV) con cURL
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
        return ['ok' => false, 'error' => "Error al descargar la URL del CV: $err", 'content' => ''];
    }

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status < 200 || $status >= 300) {
        return ['ok' => false, 'error' => "La URL del CV devolvió HTTP $status.", 'content' => ''];
    }

    return ['ok' => true, 'error' => '', 'content' => $html];
}

// -----------------------------------------------------------------------------
//  Limpiar HTML → texto plano
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
//  Llamar a la IA para que devuelva un JSON con las 5 respuestas
// -----------------------------------------------------------------------------
function analizar_cv(string $cvText, string $API_URL, string $API_KEY): array
{
    if ($cvText === '') {
        return ['ok' => false, 'error' => 'El CV aparece vacío tras la descarga/limpieza.', 'parsed' => null, 'raw' => ''];
    }

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

    // Extraer solo el JSON si hubiera texto alrededor
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
//  Decorar valores con globos según reglas
// -----------------------------------------------------------------------------
function decorar_valor(string $valor): string
{
    $trim = trim($valor);
    $norm = mb_strtolower($trim, 'UTF-8');

    if ($norm === 'no indicado' || $norm === '') {
        return 'no indicado 🟡';
    }
    if ($norm === 'no') {
        return 'no 🎈';
    }
    return $trim;
}

// -----------------------------------------------------------------------------
//  Lógica principal: formulario DNI → Lavender → CV → IA → tabla
// -----------------------------------------------------------------------------
$resultMessage  = null;
$resultOk       = null;
$rowsForTable   = []; // cada elemento: [nombre, cv_url, respuestas_array]
$lastLavenderRaw = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = isset($_POST['dni']) ? trim($_POST['dni']) : '';

    if ($dni === '') {
        $resultOk = false;
        $resultMessage = 'El DNI es obligatorio.';
    } else {
        // 1) Buscar en Lavender
        $lavenderData = fetch_lavender_students_raw($dni);
        if ($lavenderData === null) {
            $resultOk = false;
            $resultMessage = 'No se recibió una respuesta válida de Lavender.';
        } else {
            $lastLavenderRaw = $lavenderData;

            if (empty($lavenderData['count']) || (int)$lavenderData['count'] === 0) {
                $resultOk = false;
                $resultMessage = 'Lavender no devolvió estudiantes para ese DNI.';
            } else {
                // 2) Extraer estudiantes
                $students = extract_students_from_lavender($lavenderData);
                if (empty($students)) {
                    $resultOk = false;
                    $resultMessage = 'Se encontraron registros en Lavender, pero no las columnas de nombre/URL CV.';
                } else {
                    $resultOk = true;
                    $resultMessage = 'Estudiantes encontrados en Lavender y análisis en proceso.';

                    // 3) Para cada estudiante, descargar CV y analizarlo con IA
                    foreach ($students as $st) {
                        $nombre = $st['nombre'] ?: '(sin nombre)';
                        $cvUrl  = $st['cv_url'] ?: '';

                        $respuestas = [
                            'donde_vive'                => 'no indicado',
                            'tiene_carnet_conducir'     => 'no indicado',
                            'tiene_vehiculo_propio'     => 'no indicado',
                            'esta_trabajando_actualmente'=> 'no indicado',
                            'puesto_trabajo_actual'     => 'no indicado',
                            '_error'                    => null,
                        ];

                        if ($cvUrl !== '') {
                            $fetchCV = fetch_url_content($cvUrl);
                            if ($fetchCV['ok']) {
                                $cvText = html_to_plain_text($fetchCV['content']);
                                $ai     = analizar_cv($cvText, $API_URL, $API_KEY);
                                if ($ai['ok'] && is_array($ai['parsed'])) {
                                    $p = $ai['parsed'];
                                    $respuestas['donde_vive']                 = $p['donde_vive'] ?? 'no indicado';
                                    $respuestas['tiene_carnet_conducir']      = $p['tiene_carnet_conducir'] ?? 'no indicado';
                                    $respuestas['tiene_vehiculo_propio']      = $p['tiene_vehiculo_propio'] ?? 'no indicado';
                                    $respuestas['esta_trabajando_actualmente']= $p['esta_trabajando_actualmente'] ?? 'no indicado';
                                    $respuestas['puesto_trabajo_actual']      = $p['puesto_trabajo_actual'] ?? 'no indicado';
                                } else {
                                    $respuestas['_error'] = $ai['error'] ?? 'Error en análisis IA.';
                                }
                            } else {
                                $respuestas['_error'] = $fetchCV['error'];
                            }
                        } else {
                            $respuestas['_error'] = 'No se ha indicado URL de CV en Lavender.';
                        }

                        $rowsForTable[] = [
                            'nombre'     => $nombre,
                            'cv_url'     => $cvUrl,
                            'respuestas' => $respuestas,
                        ];
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Análisis de CV desde Lavender</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin: 0;
            padding: 2rem;
            background: #f3f4f6;
            color: #111827;
        }
        .container {
            max-width: 1100px;
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
            font-size: .87rem;
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
        .error-cell {
            color: #b91c1c;
            font-size: .8rem;
            margin-top: .25rem;
        }
        a {
            color: #2563eb;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Análisis de CV desde Lavender</h1>
        <p class="subtitle">
            Introduce un DNI. Se consultará Lavender, se obtendrán los alumnos con su nombre y URL de CV,
            y se analizarán los CV con IA para responder a 5 preguntas:
            <br>1) ¿Dónde vive esa persona?
            <br>2) ¿Tiene carnet de conducir vehículos?
            <br>3) ¿Tiene vehículo propio?
            <br>4) ¿Está trabajando actualmente?
            <br>5) Puesto de trabajo actual.
        </p>

        <form method="post">
            <label for="dni">DNI del estudiante</label>
            <input type="text" id="dni" name="dni"
                   value="<?php echo htmlspecialchars($_POST['dni'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                   placeholder="Z3493109N">

            <div style="margin-top:1rem;">
                <button type="submit">Buscar en Lavender y analizar CV</button>
                <span class="badge">Lavender + IA · múltiple por DNI</span>
            </div>

            <?php if ($resultMessage !== null): ?>
                <div class="status <?php echo $resultOk ? 'ok' : 'error'; ?>">
                    <?php echo htmlspecialchars($resultMessage, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>
        </form>
    </div>

    <?php if (!empty($rowsForTable)): ?>
        <div class="card">
            <h2>Resultado del análisis</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre del estudiante</th>
                        <th>URL CV</th>
                        <th>1. ¿Dónde vive esa persona?</th>
                        <th>2. ¿Tiene carnet de conducir vehículos?</th>
                        <th>3. ¿Tiene vehículo propio?</th>
                        <th>4. ¿Está trabajando actualmente?</th>
                        <th>5. Puesto de trabajo actual</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($rowsForTable as $row): ?>
                    <?php $r = $row['respuestas']; ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <?php if ($row['cv_url']): ?>
                                <a href="<?php echo htmlspecialchars($row['cv_url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                                    <?php echo htmlspecialchars($row['cv_url'], ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            <?php else: ?>
                                <span>no indicado 🟡</span>
                            <?php endif; ?>
                            <?php if (!empty($r['_error'])): ?>
                                <div class="error-cell">
                                    <?php echo htmlspecialchars($r['_error'], ENT_QUOTES, 'UTF-8'); ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars(decorar_valor($r['donde_vive'] ?? 'no indicado'), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars(decorar_valor($r['tiene_carnet_conducir'] ?? 'no indicado'), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars(decorar_valor($r['tiene_vehiculo_propio'] ?? 'no indicado'), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars(decorar_valor($r['esta_trabajando_actualmente'] ?? 'no indicado'), ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars(decorar_valor($r['puesto_trabajo_actual'] ?? 'no indicado'), ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>

