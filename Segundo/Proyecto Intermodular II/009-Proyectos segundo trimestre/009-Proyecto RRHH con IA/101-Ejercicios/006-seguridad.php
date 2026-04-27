<?php
// cv_lavender_all.php
// 1) Pide a Lavender todas las entradas del formulario (form_hash).
// 2) Muestra tabla con nombre + URL CV.
// 3) JS va pidiendo análisis CV por CV (accion=analizar_cv) cada X segundos.
// 4) IA devuelve JSON con las 5 respuestas, con reintentos y manejo de CV en blanco.

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
//  cURL POST JSON a Lavender
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

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
//  Obtener TODAS las entradas usando el payload que ya has probado con curl
// -----------------------------------------------------------------------------
function fetch_lavender_all_entries(): ?array
{
    $payloadArr = [
        "username"  => LAVENDER_USER,
        "password"  => LAVENDER_PASS,
        "form_hash" => LAVENDER_FORM_HASH,
        "key"       => "Indica la URL de tu CV",
        "value"     => "",
        "mode"      => "icontains",
        "single"    => false,
    ];

    $payload = json_encode($payloadArr, JSON_UNESCAPED_UNICODE);
    $resp    = lavender_curl_json($payload);
    if ($resp === "") {
        return null;
    }

    $decoded = json_decode($resp, true);
    if (!is_array($decoded)) {
        return null;
    }
    return $decoded;
}

// -----------------------------------------------------------------------------
//  Extraer lista de estudiantes (nombre completo + URL CV) del JSON de Lavender
// -----------------------------------------------------------------------------
function extract_students_from_lavender(array $data): array
{
    $students = [];

    if (empty($data['columns']) || empty($data['rows']) || !is_array($data['columns']) || !is_array($data['rows'])) {
        return $students;
    }

    $columns = $data['columns'];
    $rows    = $data['rows'];

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

    foreach ($rows as $row) {
        $nombre = '';
        $cvUrl  = '';

        // array indexado
        if (is_array($row) && array_keys($row) === range(0, count($row) - 1)) {
            if ($idxNombre !== null && isset($row[$idxNombre])) {
                $nombre = trim((string)$row[$idxNombre]);
            }
            if ($idxCV !== null && isset($row[$idxCV])) {
                $cvUrl = trim((string)$row[$idxCV]);
            }
        } elseif (is_array($row)) {
            // asociativo
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
//  Descarga contenido de una URL (CV)
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

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
//  Llamar a la IA y devolver SOLO el string "answer" (crudo)
// -----------------------------------------------------------------------------
function llamar_ia_cv(string $cvText, string $API_URL, string $API_KEY): array
{
    if ($cvText === '') {
        return ['ok' => false, 'error' => 'El CV aparece vacío tras la descarga/limpieza.', 'answer' => ''];
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
        return ['ok' => false, 'error' => $err, 'answer' => ''];
    }

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status !== 200) {
        return ['ok' => false, 'error' => "La API remota devolvió HTTP $status. Respuesta: $response", 'answer' => ''];
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['ok' => false, 'error' => "Error al decodificar JSON externo: " . json_last_error_msg() . ". Respuesta: $response", 'answer' => ''];
    }

    if (!isset($data['answer']) || !is_string($data['answer'])) {
        return ['ok' => false, 'error' => "La respuesta de la API no contiene el campo 'answer'. Respuesta: $response", 'answer' => ''];
    }

    return ['ok' => true, 'error' => '', 'answer' => trim($data['answer'])];
}

// -----------------------------------------------------------------------------
//  Intentar extraer el JSON interno de un string de la IA
// -----------------------------------------------------------------------------
function extraer_json_desde_respuesta(string $rawAnswer): ?array
{
    $jsonString = $rawAnswer;

    $start = strpos($jsonString, '{');
    $end   = strrpos($jsonString, '}');
    if ($start === false || $end === false || $end <= $start) {
        return null;
    }
    $jsonString = substr($jsonString, $start, $end - $start + 1);
    $jsonString = trim($jsonString);

    $parsed = json_decode($jsonString, true);
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($parsed)) {
        return null;
    }

    return $parsed;
}

// -----------------------------------------------------------------------------
//  Analizar CV con reintentos seguros de parseo JSON
// -----------------------------------------------------------------------------
function analizar_cv_con_reintentos(string $cvText, string $API_URL, string $API_KEY, int $maxIntentos = 3): array
{
    $ultimoError = null;
    $ultimaRespuestaCruda = '';

    for ($i = 1; $i <= $maxIntentos; $i++) {
        $ia = llamar_ia_cv($cvText, $API_URL, $API_KEY);
        if (!$ia['ok']) {
            $ultimoError = $ia['error'];
            $ultimaRespuestaCruda = $ia['answer'] ?? '';
            continue; // reintentar
        }

        $raw = $ia['answer'];
        $parsed = extraer_json_desde_respuesta($raw);
        if ($parsed !== null) {
            return [
                'ok'     => true,
                'error'  => '',
                'parsed' => $parsed,
                'raw'    => $raw,
            ];
        } else {
            $ultimoError = 'Error al decodificar el JSON interno devuelto por la IA: '
                . json_last_error_msg();
            $ultimaRespuestaCruda = $raw;
        }
    }

    return [
        'ok'     => false,
        'error'  => $ultimoError ?: 'Error desconocido al analizar el CV.',
        'parsed' => null,
        'raw'    => $ultimaRespuestaCruda,
    ];
}

// -----------------------------------------------------------------------------
//  Renderizar badges de estado (servidas desde PHP para AJAX)
// -----------------------------------------------------------------------------
function render_status_badge(string $valor): string
{
    $trim = trim($valor);
    $norm = mb_strtolower($trim, 'UTF-8');

    if ($norm === 'no indicado' || $norm === '') {
        return '<span class="badge-status badge-ni">no indicado</span>';
    }
    if ($norm === 'no') {
        return '<span class="badge-status badge-no">no</span>';
    }

    return '<span class="badge-status badge-ok">' . htmlspecialchars($trim, ENT_QUOTES, 'UTF-8') . '</span>';
}

// -----------------------------------------------------------------------------
//  MODO AJAX: analizar un solo CV (llamado por fetch desde JS)
// -----------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'analizar_cv') {
    header('Content-Type: application/json; charset=utf-8');

    $cvUrl  = isset($_POST['cv_url']) ? trim($_POST['cv_url']) : '';
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';

    if ($cvUrl === '') {
        echo json_encode([
            'ok'    => false,
            'blank' => false,
            'error' => 'No se ha indicado URL de CV.',
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $fetchCV = fetch_url_content($cvUrl);
    if (!$fetchCV['ok']) {
        echo json_encode([
            'ok'    => false,
            'blank' => false,
            'error' => $fetchCV['error'],
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $cvText = html_to_plain_text($fetchCV['content']);

    // Detectar CV "en blanco" (página existe pero el texto plano es casi nulo)
    if (mb_strlen($cvText, 'UTF-8') < 80) {
        echo json_encode([
            'ok'    => true,
            'blank' => true,
            'error' => '',
            'respuestas' => [
                'donde_vive'                  => 'no indicado',
                'tiene_carnet_conducir'       => 'no indicado',
                'tiene_vehiculo_propio'       => 'no indicado',
                'esta_trabajando_actualmente' => 'no indicado',
                'puesto_trabajo_actual'       => 'no indicado',
            ],
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $ai = analizar_cv_con_reintentos($cvText, $API_URL, $API_KEY, 3);
    if (!$ai['ok'] || !is_array($ai['parsed'])) {
        echo json_encode([
            'ok'    => false,
            'blank' => false,
            'error' => $ai['error'] ?: 'Error desconocido analizando el CV.',
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $p = $ai['parsed'];

    $respuestas = [
        'donde_vive'                  => $p['donde_vive'] ?? 'no indicado',
        'tiene_carnet_conducir'       => $p['tiene_carnet_conducir'] ?? 'no indicado',
        'tiene_vehiculo_propio'       => $p['tiene_vehiculo_propio'] ?? 'no indicado',
        'esta_trabajando_actualmente' => $p['esta_trabajando_actualmente'] ?? 'no indicado',
        'puesto_trabajo_actual'       => $p['puesto_trabajo_actual'] ?? 'no indicado',
    ];

    // Devolvemos también HTML de badges ya preparado
    $respuestas_html = [
        'donde_vive'                  => render_status_badge($respuestas['donde_vive']),
        'tiene_carnet_conducir'       => render_status_badge($respuestas['tiene_carnet_conducir']),
        'tiene_vehiculo_propio'       => render_status_badge($respuestas['tiene_vehiculo_propio']),
        'esta_trabajando_actualmente' => render_status_badge($respuestas['esta_trabajando_actualmente']),
        'puesto_trabajo_actual'       => render_status_badge($respuestas['puesto_trabajo_actual']),
    ];

    echo json_encode([
        'ok'              => true,
        'blank'           => false,
        'error'           => '',
        'respuestas'      => $respuestas,
        'respuestas_html' => $respuestas_html,
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// -----------------------------------------------------------------------------
//  MODO NORMAL: cargar lista desde Lavender y mostrar tabla
// -----------------------------------------------------------------------------
$resultMessage = null;
$resultOk      = null;
$students      = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cargar']) && $_POST['cargar'] === '1') {
    $lavenderData = fetch_lavender_all_entries();
    if ($lavenderData === null) {
        $resultOk = false;
        $resultMessage = 'No se pudo obtener datos de Lavender (revisa payload o credenciales).';
    } elseif (empty($lavenderData['rows'])) {
        $resultOk = false;
        $resultMessage = 'Lavender ha devuelto 0 filas para ese formulario.';
    } else {
        $students = extract_students_from_lavender($lavenderData);
        if (empty($students)) {
            $resultOk = false;
            $resultMessage = 'Se encontraron filas en Lavender, pero no campos de nombre / URL de CV.';
        } else {
            $resultOk = true;
            $resultMessage = 'Entradas obtenidas de Lavender. Pulsa "Iniciar análisis" para procesar los CV.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Análisis masivo de CV desde Lavender</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin: 0;
            padding: 2rem;
            background: #f3f4f6;
            color: #111827;
        }
        .container {
            max-width: 1200px;
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
        h2 {
            font-size: 1.2rem;
            margin-bottom: .75rem;
        }
        p {
            margin-top: 0;
            color: #4b5563;
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
        .btn-secondary {
            border-color: #6b7280;
            background: #6b7280;
        }
        .btn-secondary:hover {
            background: #4b5563;
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
        .legend {
            font-size: .8rem;
            color: #6b7280;
            margin-bottom: .75rem;
        }
        .badge-status {
            display: inline-flex;
            align-items: center;
            padding: 0.15rem 0.55rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 500;
            border: 1px solid transparent;
        }
        .badge-status.badge-no {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fecaca;
        }
        .badge-status.badge-ni {
            background: #fef9c3;
            color: #854d0e;
            border-color: #facc15;
        }
        .badge-status.badge-ok {
            background: #ecfdf3;
            color: #166534;
            border-color: #bbf7d0;
        }
        .legend-pill {
            display: inline-flex;
            align-items: center;
            gap: .25rem;
            margin-right: 1rem;
        }
        .small {
            font-size: .8rem;
        }
        .row-processing {
            background: #fefce8;
        }
        .row-done {
            background: #f9fafb;
        }
        .row-error {
            background: #fef2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Análisis masivo de CV desde Lavender</h1>
        <p class="subtitle">
            1) Se obtienen todas las entradas del formulario con hash
            <code><?php echo htmlspecialchars(LAVENDER_FORM_HASH, ENT_QUOTES, 'UTF-8'); ?></code> desde Lavender.<br>
            2) Se muestra una tabla con nombre y URL del CV.<br>
            3) El análisis de cada CV se realiza <strong>de uno en uno</strong> desde el navegador, llamando a la IA cada pocos segundos.
        </p>

        <form method="post" style="margin-bottom: .75rem;">
            <input type="hidden" name="cargar" value="1">
            <button type="submit">Cargar lista desde Lavender</button>
            <span class="badge">Paso 1: cargar</span>
        </form>

        <?php if ($resultMessage !== null): ?>
            <div class="status <?php echo $resultOk ? 'ok' : 'error'; ?>">
                <?php echo htmlspecialchars($resultMessage, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($students)): ?>
            <button type="button" id="btnIniciarAnalisis" class="btn-secondary">
                Iniciar análisis secuencial de CV
            </button>
            <span class="small" id="estadoGlobal">Pendiente de iniciar.</span>
        <?php endif; ?>
    </div>

    <?php if (!empty($students)): ?>
        <div class="card">
            <h2>Resultado del análisis</h2>
            <div class="legend">
                <span class="legend-pill">
                    <span class="badge-status badge-ok">valor</span> = dato aportado en el CV
                </span>
                <span class="legend-pill">
                    <span class="badge-status badge-no">no</span> = respuesta negativa explícita
                </span>
                <span class="legend-pill">
                    <span class="badge-status badge-ni">no indicado</span> = no consta en el CV o CV en blanco
                </span>
            </div>
            <table id="tablaCV">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre del estudiante</th>
                    <th>URL CV</th>
                    <th>1. ¿Dónde vive esa persona?</th>
                    <th>2. ¿Tiene carnet de conducir vehículos?</th>
                    <th>3. ¿Tiene vehículo propio?</th>
                    <th>4. ¿Está trabajando actualmente?</th>
                    <th>5. Puesto de trabajo actual</th>
                    <th>Estado</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($students as $i => $st): ?>
                    <?php
                        $rowId = 'row_' . $i;
                        $cvUrl = $st['cv_url'] ?? '';
                        $nombre = $st['nombre'] ?? '';
                    ?>
                    <tr id="<?php echo $rowId; ?>"
                        data-index="<?php echo (int)$i; ?>"
                        data-nombre="<?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?>"
                        data-cv-url="<?php echo htmlspecialchars($cvUrl, ENT_QUOTES, 'UTF-8'); ?>"
                        class="row-pending">
                        <td><?php echo $i + 1; ?></td>
                        <td><?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <?php if ($cvUrl): ?>
                                <a href="<?php echo htmlspecialchars($cvUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">
                                    <?php echo htmlspecialchars($cvUrl, ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            <?php else: ?>
                                <span class="badge-status badge-ni">no indicado</span>
                            <?php endif; ?>
                        </td>
                        <td class="col-donde_vive">
                            <span class="badge-status badge-ni">Pendiente…</span>
                        </td>
                        <td class="col-tiene_carnet_conducir">
                            <span class="badge-status badge-ni">Pendiente…</span>
                        </td>
                        <td class="col-tiene_vehiculo_propio">
                            <span class="badge-status badge-ni">Pendiente…</span>
                        </td>
                        <td class="col-esta_trabajando_actualmente">
                            <span class="badge-status badge-ni">Pendiente…</span>
                        </td>
                        <td class="col-puesto_trabajo_actual">
                            <span class="badge-status badge-ni">Pendiente…</span>
                        </td>
                        <td class="col-estado small">
                            Pendiente de análisis.
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php if (!empty($students)): ?>
<script>
(function(){
    const delayMs = 3000; // tiempo entre análisis de cada CV
    const btn = document.getElementById('btnIniciarAnalisis');
    const estadoGlobal = document.getElementById('estadoGlobal');
    const filas = Array.from(document.querySelectorAll('#tablaCV tbody tr'));

    function marcarFilaProcesando(tr) {
        tr.classList.add('row-processing');
        tr.classList.remove('row-done', 'row-error');
        const tdEstado = tr.querySelector('.col-estado');
        if (tdEstado) tdEstado.textContent = 'Analizando CV…';
    }

    function marcarFilaHecha(tr, mensaje) {
        tr.classList.remove('row-processing', 'row-error');
        tr.classList.add('row-done');
        const tdEstado = tr.querySelector('.col-estado');
        if (tdEstado) tdEstado.textContent = mensaje || 'Análisis completado.';
    }

    function marcarFilaError(tr, mensaje) {
        tr.classList.remove('row-processing');
        tr.classList.add('row-error');
        const tdEstado = tr.querySelector('.col-estado');
        if (tdEstado) tdEstado.textContent = mensaje || 'Error al analizar el CV.';
    }

    async function analizarFila(i) {
        if (i >= filas.length) {
            estadoGlobal.textContent = 'Análisis completado para todos los CV procesados.';
            return;
        }

        const tr = filas[i];
        const cvUrl = tr.getAttribute('data-cv-url') || '';
        const nombre = tr.getAttribute('data-nombre') || '';

        if (!cvUrl) {
            marcarFilaHecha(tr, 'Sin URL de CV (no se analiza).');
            setTimeout(() => analizarFila(i + 1), delayMs);
            return;
        }

        marcarFilaProcesando(tr);
        estadoGlobal.textContent = `Analizando CV ${i+1}/${filas.length}…`;

        try {
            const params = new URLSearchParams();
            params.append('accion', 'analizar_cv');
            params.append('cv_url', cvUrl);
            params.append('nombre', nombre);

            const resp = await fetch(window.location.href, {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: params.toString()
            });

            const data = await resp.json();

            if (!data.ok) {
                marcarFilaError(tr, data.error || 'Error al analizar el CV.');
            } else {
                const blank = !!data.blank;

                const mapCols = {
                    'donde_vive':                  '.col-donde_vive',
                    'tiene_carnet_conducir':       '.col-tiene_carnet_conducir',
                    'tiene_vehiculo_propio':       '.col-tiene_vehiculo_propio',
                    'esta_trabajando_actualmente': '.col-esta_trabajando_actualmente',
                    'puesto_trabajo_actual':       '.col-puesto_trabajo_actual'
                };

                if (data.respuestas_html) {
                    for (const key in mapCols) {
                        const sel = mapCols[key];
                        const td = tr.querySelector(sel);
                        if (!td) continue;
                        const html = data.respuestas_html[key] || '<span class="badge-status badge-ni">no indicado</span>';
                        td.innerHTML = html;
                    }
                }

                if (blank) {
                    marcarFilaHecha(tr, 'CV detectado como página en blanco (no indicado).');
                } else {
                    marcarFilaHecha(tr, 'Análisis completado correctamente.');
                }
            }

        } catch (e) {
            console.error(e);
            marcarFilaError(tr, 'Error de red o de parseo JSON en la respuesta de la IA.');
        }

        setTimeout(() => analizarFila(i + 1), delayMs);
    }

    if (btn) {
        btn.addEventListener('click', function() {
            btn.disabled = true;
            estadoGlobal.textContent = 'Iniciando análisis secuencial…';
            analizarFila(0);
        });
    }
})();
</script>
<?php endif; ?>
</body>
</html>

