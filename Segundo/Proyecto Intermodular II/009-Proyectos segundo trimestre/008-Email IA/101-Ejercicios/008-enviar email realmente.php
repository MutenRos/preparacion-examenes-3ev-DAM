<?php
// cliente_correo_envia.php

// === CONFIGURACIÓN SMTP (usar TLS como en el script de Python) ===
const SMTP_HOST = 'smtp.ionos.es';
const SMTP_PORT = 587; // TLS explícito (STARTTLS)
const SMTP_USER = 'python@jocarsa.com';
const SMTP_PASS = 'TAME123$';
const SMTP_FROM = 'python@jocarsa.com';
const SMTP_FROM_NAME = 'Dictado IA';




// === CONFIGURACIÓN DE LA API REMOTA (MISMA QUE EN TU SERVIDOR) ===
$API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php";
$API_KEY = "TEST_API_KEY_JOCARSA_123";

// --- Formateo del cuerpo como correo elegante ---
function ajustarFormatoEmail(string $texto): string
{
    $texto = preg_replace("/\r\n|\r/", "\n", trim($texto));
    if ($texto === '') {
        return '';
    }

    // Separar saludo "Hola X," en primera línea + línea en blanco + resto
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

    // Asegurar línea en blanco tras saludo
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

    // Asegurar línea en blanco antes de cierre
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

// --- Procesar asunto con IA ---
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
    $textoFormateado = preg_replace("/\r\n|\r|\n/", ' ', $textoFormateado);
    $textoFormateado = preg_replace('/\s+/', ' ', $textoFormateado);

    return ['ok' => true, 'error' => '', 'texto' => $textoFormateado];
}

// --- Envío SMTP puro con sockets ---
function smtp_read_line($conn): string
{
    $data = '';
    while ($str = fgets($conn, 515)) {
        $data .= $str;
        // Línea final de la respuesta (código + espacio)
        if (strlen($str) >= 4 && $str[3] === ' ') {
            break;
        }
    }
    return $data;
}

function smtp_expect($conn, string $expectedCode, string $context): string
{
    $data = smtp_read_line($conn);
    if (substr($data, 0, 3) !== $expectedCode) {
        throw new RuntimeException("Error SMTP en $context. Esperado $expectedCode, recibido: $data");
    }
    return $data;
}


function smtp_send_email(string $to, string $subject, string $body): array
{
    $to = trim($to);
    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        return ['ok' => false, 'error' => 'Dirección de correo no válida.'];
    }

    // Conexión TCP sin cifrar (como hace Python antes de starttls())
    $errno = 0;
    $errstr = '';
    $conn = @fsockopen(SMTP_HOST, SMTP_PORT, $errno, $errstr, 20);
    if (!$conn) {
        return ['ok' => false, 'error' => "No se pudo conectar al servidor SMTP: $errstr ($errno)"];
    }

    try {
        // 1) Saludo inicial del servidor
        smtp_expect($conn, '220', 'greeting');

        // 2) EHLO inicial
        $hostname = 'localhost'; // puedes usar 'jocarsa.com' si quieres
        fwrite($conn, "EHLO $hostname\r\n");
        smtp_expect($conn, '250', 'EHLO (inicial)');

        // 3) Solicitar STARTTLS (igual que server.starttls() en Python)
        fwrite($conn, "STARTTLS\r\n");
        smtp_expect($conn, '220', 'STARTTLS');

        // 4) Activar cifrado TLS sobre el socket existente
        $cryptoOk = @stream_socket_enable_crypto(
            $conn,
            true,
            STREAM_CRYPTO_METHOD_TLS_CLIENT
        );
        if (!$cryptoOk) {
            throw new RuntimeException("No se pudo establecer TLS (stream_socket_enable_crypto).");
        }

        // 5) EHLO de nuevo ya bajo TLS
        fwrite($conn, "EHLO $hostname\r\n");
        smtp_expect($conn, '250', 'EHLO (tras STARTTLS)');

        // 6) Autenticación AUTH LOGIN (como en tu código original)
        fwrite($conn, "AUTH LOGIN\r\n");
        smtp_expect($conn, '334', 'AUTH LOGIN');

        fwrite($conn, base64_encode(SMTP_USER) . "\r\n");
        smtp_expect($conn, '334', 'AUTH LOGIN usuario');

        fwrite($conn, base64_encode(SMTP_PASS) . "\r\n");
        smtp_expect($conn, '235', 'AUTH LOGIN contraseña');

        // 7) MAIL FROM / RCPT TO
        fwrite($conn, "MAIL FROM:<" . SMTP_FROM . ">\r\n");
        smtp_expect($conn, '250', 'MAIL FROM');

        fwrite($conn, "RCPT TO:<" . $to . ">\r\n");
        smtp_expect($conn, '250', 'RCPT TO');

        // 8) DATA
        fwrite($conn, "DATA\r\n");
        smtp_expect($conn, '354', 'DATA');

        // Encabezados
        $headers = [];
        $headers[] = "From: \"" . addslashes(SMTP_FROM_NAME) . "\" <" . SMTP_FROM . ">";
        $headers[] = "To: <$to>";
        $headers[] = "Subject: " . $subject;
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-Type: text/plain; charset=UTF-8";
        $headers[] = "Content-Transfer-Encoding: 8bit";

        // Cuerpo + fin de DATA (punto en línea sola)
        $data = implode("\r\n", $headers) . "\r\n\r\n" . $body . "\r\n.\r\n";

        fwrite($conn, $data);
        smtp_expect($conn, '250', 'final DATA');

        // 9) QUIT
        fwrite($conn, "QUIT\r\n");
        fclose($conn);

        return ['ok' => true, 'error' => ''];
    } catch (Throwable $e) {
        fclose($conn);
        return ['ok' => false, 'error' => $e->getMessage()];
    }
}


// === MODO AJAX (IA asunto/cuerpo) ===
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

// === ENVÍO REAL DE CORREO ===
$sendMessage = null;
$sendOk = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_email']) && $_POST['send_email'] === '1') {
    $to      = $_POST['to'] ?? '';
    $subject = $_POST['final_subject'] ?? '';
    $body    = $_POST['final_body'] ?? '';

    $subject = trim($subject);
    $body    = trim($body);

    if ($to === '' || $subject === '' || $body === '') {
        $sendOk = false;
        $sendMessage = 'Para, asunto y cuerpo corregidos son obligatorios para enviar el correo.';
    } else {
        $result = smtp_send_email($to, $subject, $body);
        $sendOk = $result['ok'];
        $sendMessage = $result['ok']
            ? 'Correo enviado correctamente a ' . htmlspecialchars($to, ENT_QUOTES, 'UTF-8') . '.'
            : 'Error al enviar el correo: ' . $result['error'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cliente de correo (envío real) con dictado e IA</title>
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
        .btn-primary {
            background: var(--accent);
            color: #ffffff;
            border-color: var(--accent);
        }
        .btn-primary:hover {
            background: #1d4ed8;
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
        .send-status {
            margin-top: .75rem;
            padding: .6rem .9rem;
            border-radius: .6rem;
            font-size: .85rem;
        }
        .send-status.ok {
            background: #ecfdf3;
            color: var(--success);
            border: 1px solid #bbf7d0;
        }
        .send-status.error {
            background: #fef2f2;
            color: var(--error);
            border: 1px solid #fecaca;
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
                <span>📧 Cliente de correo (envío real)</span>
                <span class="app-title-badge">Dictado + IA + SMTP</span>
            </div>
            <div class="app-subtitle">
                Dicta asunto y cuerpo, la IA los corrige y el mensaje se envía realmente por SMTP.
            </div>
        </div>
        <div class="pill">
            🎙️ Dictado por voz · es-ES
        </div>
    </header>

    <form method="post" class="card" id="mailForm">
        <div class="card-header">
            <div class="card-title">Nuevo mensaje</div>
            <div class="card-caption">Introduce el destinatario, dicta asunto y cuerpo, revisa y envía.</div>
        </div>

        <!-- Fila destinatario -->
        <div class="form-row">
            <div class="form-label">Para</div>
            <div class="form-field">
                <input type="email" name="to" class="input-text"
                       placeholder="destinatario@ejemplo.com" required>
            </div>
        </div>

        <!-- Fila asunto (dictado + asunto corregido) -->
        <div class="form-row">
            <div class="form-label">Asunto</div>
            <div class="form-field">
                <input type="text" id="subjectFinal" class="input-text"
                       placeholder="El asunto corregido aparecerá aquí" readonly>
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
        <input type="hidden" name="final_subject" id="final_subject">

        <!-- Cuerpo -->
        <div class="body-label-row">
            <span>Cuerpo del mensaje</span>
            <span class="badge-ai">Corrección suave (sin inventar contenido)</span>
        </div>

        <!-- Texto de cuerpo original oculto -->
        <textarea id="texto" class="visually-hidden"></textarea>
        <textarea name="final_body" id="final_body" class="visually-hidden"></textarea>

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
        <div style="margin-top:.4rem; display:flex; justify-content:space-between; align-items:center; gap:.75rem; flex-wrap:wrap;">
            <span id="estadoDictado" class="status-text status-warn">Dictado en espera.</span>
            <button type="submit" name="send_email" value="1" class="btn btn-primary">
                Enviar correo
            </button>
        </div>

        <?php if ($sendMessage !== null): ?>
            <div class="send-status <?php echo $sendOk ? 'ok' : 'error'; ?>">
                <?php echo htmlspecialchars($sendMessage, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </form>
</div>

<script>
(function() {
    const subjectRaw      = document.getElementById('subjectRaw');
    const bodyRaw         = document.getElementById('texto');
    const subjectFinal    = document.getElementById('subjectFinal');
    const bodyResultBox   = document.getElementById('bodyResultBox');

    const finalSubjectField = document.getElementById('final_subject');
    const finalBodyField    = document.getElementById('final_body');

    const btnDictarSubject = document.getElementById('btnDictarSubject');
    const btnDictarBody    = document.getElementById('btnDictarBody');

    const estadoIA_subject = document.getElementById('estadoIA_subject');
    const estadoIA_body    = document.getElementById('estadoIA_body');
    const estadoDictado    = document.getElementById('estadoDictado');

    const form = document.getElementById('mailForm');

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

        // Actualizar campo oculto para envío real
        finalBodyField.value = text;
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
                const text = data.texto || '';
                subjectFinal.value = text;
                finalSubjectField.value = text;
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

    // Heartbeat: IA asunto y cuerpo
    setInterval(function() {
        sendToAI('subject');
        sendToAI('body');
    }, HEARTBEAT_MS);

    // Dictado por voz
    function startDictationFor(kind) {
        if (!recognition) return;

        const targetRaw  = (kind === 'subject') ? subjectRaw : bodyRaw;

        if (escuchando && currentTargetType === kind) {
            recognition.stop();
            return;
        }

        if (escuchando && currentTargetType !== kind) {
            recognition.stop();
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

    // Antes de enviar, asegurarse de que asunto/cuerpo corregidos se copian a campos ocultos
    form.addEventListener('submit', function() {
        finalSubjectField.value = subjectFinal.value || '';
        const bodyText = bodyResultBox.textContent || '';
        finalBodyField.value = bodyText;
    });
})();
</script>
</body>
</html>

