<?php
// ============================================
// CONFIGURACIÓN SMTP (usar TLS como en el script de Python)
// ============================================
const SMTP_HOST = 'smtp.ionos.es';
const SMTP_PORT = 587; // TLS explícito (STARTTLS)
const SMTP_USER = 'python@jocarsa.com';
const SMTP_PASS = 'TAME123$';
const SMTP_FROM = 'python@jocarsa.com';
const SMTP_FROM_NAME = 'Dictado IA';

// ============================================
// CONFIGURACIÓN IMAP (recepción de correo)
// ============================================
const IMAP_HOST = 'imap.ionos.es';
const IMAP_PORT = 993; // IMAPS
const IMAP_FLAGS = '/imap/ssl'; // Ajustable si tu servidor requiere otro flag

// ============================================
// CONFIGURACIÓN DE LA API REMOTA (IA)
// ============================================
$API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php";
$API_KEY = "TEST_API_KEY_JOCARSA_123";

// ============================================
// FORMATEO DEL CUERPO COMO CORREO ELEGANTE
// ============================================
function ajustarFormatoEmail(string $texto): string
{
    $texto = preg_replace("/\r\n|\r/", "\n", trim($texto));
    if ($texto === '') {
        return '';
    }

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

// ============================================
// PROCESAR CUERPO DEL CORREO CON IA
// ============================================
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

// ============================================
// PROCESAR ASUNTO CON IA
// ============================================
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

// ============================================
// RESUMEN AUTOMÁTICO DE CORREO CON IA
// ============================================
function procesar_resumen_email(string $textoOriginal, string $API_URL, string $API_KEY): array
{
    if (trim($textoOriginal) === '') {
        return ['ok' => false, 'error' => 'Correo sin contenido textual para resumir.', 'texto' => ''];
    }

    $question =
        "Eres un asistente que resume correos electrónicos en español.\n\n" .
        "TAREA:\n" .
        "Resume el siguiente correo en un máximo de 5 frases claras, indicando:\n" .
        "- Quién escribe (si aparece).\n" .
        "- Tema principal.\n" .
        "- Petición o acción requerida (si la hay).\n" .
        "- Tono general.\n\n" .
        "REGLAS ESTRICTAS:\n" .
        "- No inventes información que no esté en el texto.\n" .
        "- No añadas links ni datos externos.\n" .
        "- Devuelve solo el resumen, sin título ni explicaciones adicionales.\n\n" .
        "Correo original:\n" .
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
    return ['ok' => true, 'error' => '', 'texto' => $textoFormateado];
}

// ============================================
// SMTP PURO CON SOCKETS
// ============================================
function smtp_read_line($conn): string
{
    $data = '';
    while ($str = fgets($conn, 515)) {
        $data .= $str;
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

    $errno = 0;
    $errstr = '';
    $conn = @fsockopen(SMTP_HOST, SMTP_PORT, $errno, $errstr, 20);
    if (!$conn) {
        return ['ok' => false, 'error' => "No se pudo conectar al servidor SMTP: $errstr ($errno)"];
    }

    try {
        smtp_expect($conn, '220', 'greeting');

        $hostname = 'localhost';
        fwrite($conn, "EHLO $hostname\r\n");
        smtp_expect($conn, '250', 'EHLO (inicial)');

        fwrite($conn, "STARTTLS\r\n");
        smtp_expect($conn, '220', 'STARTTLS');

        $cryptoOk = @stream_socket_enable_crypto(
            $conn,
            true,
            STREAM_CRYPTO_METHOD_TLS_CLIENT
        );
        if (!$cryptoOk) {
            throw new RuntimeException("No se pudo establecer TLS (stream_socket_enable_crypto).");
        }

        fwrite($conn, "EHLO $hostname\r\n");
        smtp_expect($conn, '250', 'EHLO (tras STARTTLS)');

        fwrite($conn, "AUTH LOGIN\r\n");
        smtp_expect($conn, '334', 'AUTH LOGIN');

        fwrite($conn, base64_encode(SMTP_USER) . "\r\n");
        smtp_expect($conn, '334', 'AUTH LOGIN usuario');

        fwrite($conn, base64_encode(SMTP_PASS) . "\r\n");
        smtp_expect($conn, '235', 'AUTH LOGIN contraseña');

        fwrite($conn, "MAIL FROM:<" . SMTP_FROM . ">\r\n");
        smtp_expect($conn, '250', 'MAIL FROM');

        fwrite($conn, "RCPT TO:<" . $to . ">\r\n");
        smtp_expect($conn, '250', 'RCPT TO');

        fwrite($conn, "DATA\r\n");
        smtp_expect($conn, '354', 'DATA');

        $headers = [];
        $headers[] = "From: \"" . addslashes(SMTP_FROM_NAME) . "\" <" . SMTP_FROM . ">";
        $headers[] = "To: <$to>";
        $headers[] = "Subject: " . $subject;
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-Type: text/plain; charset=UTF-8";
        $headers[] = "Content-Transfer-Encoding: 8bit";

        $data = implode("\r\n", $headers) . "\r\n\r\n" . $body . "\r\n.\r\n";

        fwrite($conn, $data);
        smtp_expect($conn, '250', 'final DATA');

        fwrite($conn, "QUIT\r\n");
        fclose($conn);

        return ['ok' => true, 'error' => ''];
    } catch (Throwable $e) {
        fclose($conn);
        return ['ok' => false, 'error' => $e->getMessage()];
    }
}

// ============================================
// FUNCIONES AUXILIARES IMAP
// ============================================
function decode_imap_text(string $text, int $encoding): string
{
    switch ($encoding) {
        case 3:
            return base64_decode($text) ?: $text;
        case 4:
            return quoted_printable_decode($text);
        default:
            return $text;
    }
}

function get_plain_text_body($imap, int $msgNo): string
{
    $structure = @imap_fetchstructure($imap, $msgNo);
    if (!$structure) {
        return (string)@imap_body($imap, $msgNo);
    }

    if (!isset($structure->parts) || !is_array($structure->parts) || count($structure->parts) === 0) {
        $body = @imap_body($imap, $msgNo);
        return decode_imap_text($body, $structure->encoding ?? 0);
    }

    $partNumber = null;
    foreach ($structure->parts as $index => $part) {
        if ($part->type == 0) {
            $subtype = isset($part->subtype) ? strtoupper($part->subtype) : '';
            if ($subtype === 'PLAIN' || $subtype === '') {
                $partNumber = $index + 1;
                break;
            }
        }
    }

    if ($partNumber === null) {
        $body = @imap_body($imap, $msgNo);
        return decode_imap_text($body, $structure->encoding ?? 0);
    }

    $partBody = @imap_fetchbody($imap, $msgNo, (string)$partNumber);
    $encoding = $structure->parts[$partNumber - 1]->encoding ?? 0;

    return decode_imap_text($partBody, $encoding);
}

// ============================================
// MODO AJAX (IA asunto/cuerpo)
// ============================================
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

// ============================================
// ENVÍO REAL DE CORREO
// ============================================
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

// ============================================
// LECTURA DE CORREO VÍA IMAP
// ============================================
$allowedFolders = [
    'INBOX'  => 'Bandeja de entrada',
    'Sent'   => 'Enviados',
    'Drafts' => 'Borradores',
    'Trash'  => 'Papelera'
];

$folder   = isset($_GET['folder']) ? $_GET['folder'] : 'INBOX';
if (!isset($allowedFolders[$folder])) {
    $folder = 'INBOX';
}

$composeMode = isset($_GET['compose']);
$selectedMsgNo = isset($_GET['msg']) ? (int)$_GET['msg'] : null;
if ($composeMode) {
    $selectedMsgNo = null;
}

$imapError = '';
$emails = [];
$selectedEmail = null;
$selectedBody = '';
$selectedSummary = '';

if (function_exists('imap_open')) {
    $mailboxString = sprintf('{%s:%d%s}%s', IMAP_HOST, IMAP_PORT, IMAP_FLAGS, $folder);
    $imap = @imap_open($mailboxString, SMTP_USER, SMTP_PASS);
    if (!$imap) {
        $imapError = imap_last_error();
    } else {
        $ids = @imap_search($imap, 'ALL');
        if ($ids !== false) {
            rsort($ids);
            $ids = array_slice($ids, 0, 50);
            foreach ($ids as $num) {
                $overviewArr = @imap_fetch_overview($imap, $num, 0);
                if (!$overviewArr || !isset($overviewArr[0])) {
                    continue;
                }
                $ov = $overviewArr[0];
                $subject = isset($ov->subject) ? imap_utf8($ov->subject) : '(sin asunto)';
                $from    = isset($ov->from) ? imap_utf8($ov->from) : '(desconocido)';
                $date    = isset($ov->date) ? $ov->date : '';
                $seen    = !empty($ov->seen);

                $emails[] = [
                    'num'      => $num,
                    'subject'  => $subject,
                    'from'     => $from,
                    'date'     => $date,
                    'seen'     => $seen,
                    'from_raw' => $ov->from ?? '',
                    'subject_raw' => $ov->subject ?? ''
                ];
            }
        }

        if ($selectedMsgNo) {
            $overviewArr = @imap_fetch_overview($imap, $selectedMsgNo, 0);
            if ($overviewArr && isset($overviewArr[0])) {
                $ov = $overviewArr[0];
                $selectedEmail = [
                    'num'      => $selectedMsgNo,
                    'subject'  => isset($ov->subject) ? imap_utf8($ov->subject) : '(sin asunto)',
                    'from'     => isset($ov->from) ? imap_utf8($ov->from) : '(desconocido)',
                    'date'     => isset($ov->date) ? $ov->date : '',
                    'from_raw' => $ov->from ?? '',
                    'subject_raw' => $ov->subject ?? ''
                ];

                $selectedBody = get_plain_text_body($imap, $selectedMsgNo);

                $resumen = procesar_resumen_email($selectedBody, $API_URL, $API_KEY);
                if ($resumen['ok']) {
                    $selectedSummary = $resumen['texto'];
                } else {
                    $selectedSummary = "No se pudo generar el resumen: " . $resumen['error'];
                }
            }
        }

        @imap_close($imap);
    }
} else {
    $imapError = 'La extensión IMAP de PHP no está disponible en este servidor.';
}

// ============================================
// PREFILL PARA RESPUESTA
// ============================================
$replyMode = $selectedEmail !== null && isset($_GET['reply']);

$prefillTo = '';
$prefillSubjectRaw = '';
$prefillSubjectFinal = '';

if ($replyMode && $selectedEmail) {
    $fromRaw = $selectedEmail['from_raw'];
    $addrList = @imap_rfc822_parse_adrlist($fromRaw, '');
    if ($addrList && isset($addrList[0]->mailbox, $addrList[0]->host)) {
        $prefillTo = $addrList[0]->mailbox . '@' . $addrList[0]->host;
    } else {
        $prefillTo = $selectedEmail['from'];
    }

    $prefillSubjectRaw = 'Re: ' . $selectedEmail['subject'];
    $prefillSubjectFinal = $prefillSubjectRaw;
} else {
    $prefillTo = '';
    $prefillSubjectRaw = '';
    $prefillSubjectFinal = '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cliente de correo (IMAP + SMTP + IA)</title>
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
        html, body {
            height: 100%;
        }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--bg);
            color: var(--text-main);
        }
        .app-shell {
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 0.75rem 0.75rem 0.5rem 0.75rem;
            gap: 0.75rem;
        }
        .app-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }
        .app-title {
            font-size: 1.3rem;
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
            margin-top: .15rem;
        }
        .pill {
            font-size: .8rem;
            padding: .35rem .7rem;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            color: var(--text-muted);
        }

        .main-layout {
            flex: 1;
            display: flex;
            gap: 0.5rem;
            min-height: 0;
        }

        /* Sidebar izquierda (carpetas) */
        .sidebar {
            width: 220px;
            background: var(--card-bg);
            border-radius: 0.9rem;
            border: 1px solid var(--card-border);
            padding: 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .sidebar-title {
            font-size: .9rem;
            font-weight: 600;
        }
        .folder-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: .2rem;
        }
        .folder-item a {
            display: flex;
            align-items: center;
            gap: .45rem;
            text-decoration: none;
            color: var(--text-main);
            font-size: .9rem;
            padding: .35rem .5rem;
            border-radius: .6rem;
            transition: background 0.15s ease, color 0.15s ease;
        }
        .folder-item a:hover {
            background: #eff6ff;
        }
        .folder-item.active a {
            background: var(--accent);
            color: #ffffff;
        }
        .folder-label {
            display: flex;
            align-items: center;
            gap: .35rem;
        }
        .sidebar-actions {
            margin-top: 0.5rem;
        }

        /* Botones */
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
        .btn-primary {
            background: var(--accent);
            color: #ffffff;
            border-color: var(--accent);
        }
        .btn-primary:hover {
            background: #1d4ed8;
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

        /* Columnas principales: lista + detalle/redactor */
        .main-columns {
            flex: 1;
            display: flex;
            gap: 0.5rem;
            min-height: 0;
        }

        /* Columna central: lista de mensajes */
        .message-list-column {
            width: 340px;
            background: var(--card-bg);
            border-radius: 0.9rem;
            border: 1px solid var(--card-border);
            display: flex;
            flex-direction: column;
            padding: 0.65rem 0.7rem;
            min-height: 0;
        }
        .card-header {
            margin-bottom: .4rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: .5rem;
        }
        .card-header-text {
            display: flex;
            flex-direction: column;
        }
        .card-title {
            font-size: .95rem;
            font-weight: 600;
        }
        .card-caption {
            font-size: .8rem;
            color: var(--text-muted);
            margin-top: .1rem;
        }
        .chip {
            font-size: .78rem;
            padding: .2rem .55rem;
            border-radius: 999px;
            background: #eef2ff;
            color: #4b5563;
        }

        .message-list-wrapper {
            flex: 1;
            min-height: 0;
            overflow: auto;
        }
        .message-list-table {
            width: 100%;
            border-collapse: collapse;
            font-size: .82rem;
        }
        .message-list-table thead {
            background: #f3f4f6;
            position: sticky;
            top: 0;
            z-index: 1;
        }
        .message-list-table th,
        .message-list-table td {
            padding: .25rem .35rem;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }
        .message-list-table th {
            font-weight: 500;
            color: var(--text-muted);
        }
        .message-list-table tbody tr {
            cursor: pointer;
        }
        .message-list-table tbody tr:hover {
            background: #eff6ff;
        }
        .message-list-table tbody tr.unseen td {
            font-weight: 600;
        }
        .message-list-table tbody tr.selected {
            background: #dbeafe;
        }
        .message-subject,
        .message-from {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .message-date {
            white-space: nowrap;
            font-size: .75rem;
            color: var(--text-muted);
        }

        /* Columna derecha: detalle + redactor inferior */
        .right-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            min-height: 0;
        }

        .detail-card {
            flex: 1;
            min-height: 0;
            background: var(--card-bg);
            border-radius: 0.9rem;
            border: 1px solid var(--card-border);
            padding: 0.75rem 0.9rem;
            display: flex;
            flex-direction: column;
        }
        .message-detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: .5rem;
            margin-bottom: .45rem;
        }
        .message-detail-info {
            display: flex;
            flex-direction: column;
        }
        .detail-subject {
            font-size: .95rem;
            font-weight: 600;
            margin-bottom: .1rem;
        }
        .detail-meta {
            font-size: .8rem;
            color: var(--text-muted);
        }
        .detail-body-wrapper {
            flex: 1;
            min-height: 0;
            overflow: auto;
            margin-top: .35rem;
        }
        .detail-summary {
            margin-bottom: .5rem;
            padding: .55rem .6rem;
            border-radius: .55rem;
            background: #f3f4ff;
            font-size: .85rem;
        }
        .detail-body {
            padding: .55rem .6rem;
            border-radius: .55rem;
            background: #f9fafb;
            font-size: .85rem;
            white-space: pre-wrap;
        }

        /* Redactor inferior mediano (tipo Gmail "maximizado") */
        .compose-wrapper {
            height: 280px;
            background: var(--card-bg);
            border-radius: 0.9rem;
            border: 1px solid var(--card-border);
            padding: 0.6rem 0.8rem 0.5rem 0.8rem;
            display: flex;
            flex-direction: column;
        }
        .compose-card {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-row {
            display: flex;
            align-items: center;
            gap: .6rem;
            margin-bottom: .45rem;
        }
        .form-label {
            width: 3.5rem;
            font-size: .85rem;
            color: var(--text-muted);
            text-align: right;
        }
        .form-field {
            flex: 1;
        }
        .input-text {
            width: 100%;
            border-radius: .5rem;
            border: 1px solid #d4d4d8;
            padding: .45rem .6rem;
            font-size: .85rem;
            font-family: inherit;
            color: var(--text-main);
            background: #f9fafb;
        }
        .input-text:focus {
            outline: none;
            border-color: var(--accent);
            background: #ffffff;
        }
        .body-label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: .3rem;
            margin-bottom: .25rem;
        }
        .body-label-row span {
            font-size: .85rem;
        }
        .badge-ai {
            font-size: .78rem;
            padding: .2rem .55rem;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
        }
        .result-box {
            flex: 1;
            padding: .5rem .6rem;
            border-radius: .6rem;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: .85rem;
            white-space: pre-wrap;
            overflow: auto;
            color: var(--text-main);
        }
        .result-placeholder {
            color: var(--text-muted);
            font-style: italic;
        }
        .status-text {
            font-size: .78rem;
        }
        .status-ok   { color: var(--success); }
        .status-warn { color: var(--warn); }
        .status-error{ color: var(--error); }
        .status-row {
            display: flex;
            justify-content: flex-end;
            font-size: .78rem;
            color: var(--text-muted);
            margin-top: .15rem;
            gap: 1.2rem;
            flex-wrap: wrap;
        }
        .status-label {
            font-weight: 500;
        }
        .send-status {
            margin-top: .4rem;
            padding: .45rem .6rem;
            border-radius: .6rem;
            font-size: .8rem;
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
        .visually-hidden {
            position: absolute;
            left: -9999px;
            width: 1px;
            height: 1px;
            overflow: hidden;
        }

        @media (max-width: 1024px) {
            .main-layout {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
            .folder-list {
                flex-direction: row;
                flex-wrap: wrap;
            }
            .main-columns {
                flex-direction: column;
            }
            .message-list-column {
                width: 100%;
                height: 40%;
            }
            .right-column {
                height: 60%;
            }
        }
        @media (max-width: 720px) {
            .sidebar {
                flex-direction: column;
                align-items: flex-start;
            }
            .form-label {
                width: 3rem;
            }
        }
    </style>
</head>
<body>
<div class="app-shell">
    <header class="app-header">
        <div>
            <div class="app-title">
                <span>📧 Cliente de correo</span>
                <span class="app-title-badge">Estilo Gmail · IMAP + SMTP + IA</span>
            </div>
            <div class="app-subtitle">
                Bandeja completa, lectura a la derecha y redacción con dictado en la parte inferior.
            </div>
        </div>
        <div class="pill">
            🎙️ Dictado por voz · es-ES
        </div>
    </header>

    <div class="main-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div>
                <div class="sidebar-title">Carpetas</div>
                <ul class="folder-list">
                    <?php foreach ($allowedFolders as $key => $label): ?>
                        <li class="folder-item <?php echo $key === $folder ? 'active' : ''; ?>">
                            <a href="?folder=<?php echo urlencode($key); ?>">
                                <span class="folder-label">
                                    <?php if ($key === 'INBOX'): ?>
                                        📥
                                    <?php elseif ($key === 'Sent'): ?>
                                        📤
                                    <?php elseif ($key === 'Drafts'): ?>
                                        ✏️
                                    <?php elseif ($key === 'Trash'): ?>
                                        🗑️
                                    <?php else: ?>
                                        📁
                                    <?php endif; ?>
                                    <span><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></span>
                                </span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="sidebar-actions">
                <a class="btn btn-primary" href="?folder=<?php echo urlencode($folder); ?>&compose=1">
                    ➕ Nuevo mensaje
                </a>
            </div>
            <?php if ($imapError): ?>
                <div style="margin-top: .6rem; font-size:.78rem; color: var(--error);">
                    IMAP: <?php echo htmlspecialchars($imapError, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>
        </aside>

        <!-- Columnas centrales -->
        <div class="main-columns">
            <!-- Lista de mensajes (columna central) -->
            <section class="message-list-column">
                <div class="card-header">
                    <div class="card-header-text">
                        <div class="card-title">Mensajes</div>
                        <div class="card-caption">
                            Carpeta: <?php echo htmlspecialchars($allowedFolders[$folder], ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    </div>
                    <span class="chip">50 últimos</span>
                </div>
                <div class="message-list-wrapper">
                    <table class="message-list-table">
                        <thead>
                            <tr>
                                <th>De</th>
                                <th>Asunto</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!$emails): ?>
                            <tr>
                                <td colspan="3" style="font-size:.82rem; color:var(--text-muted);">
                                    No hay mensajes en esta carpeta o no se han podido recuperar.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($emails as $msg): ?>
                                <?php $isSelected = ($selectedMsgNo && $msg['num'] === $selectedMsgNo); ?>
                                <tr class="<?php echo !$msg['seen'] ? 'unseen ' : ''; ?><?php echo $isSelected ? 'selected' : ''; ?>"
                                    onclick="window.location.href='?folder=<?php echo urlencode($folder); ?>&msg=<?php echo (int)$msg['num']; ?>'">
                                    <td class="message-from">
                                        <?php echo htmlspecialchars($msg['from'], ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                    <td class="message-subject">
                                        <?php echo htmlspecialchars($msg['subject'], ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                    <td class="message-date">
                                        <?php echo htmlspecialchars($msg['date'], ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Columna derecha: detalle + redactor -->
            <div class="right-column">
                <!-- Detalle mensaje -->
                <section class="detail-card">
                    <div class="message-detail-header">
                        <div class="message-detail-info">
                            <div class="card-title">Detalle del mensaje</div>
                            <div class="card-caption">
                                <?php if ($selectedEmail): ?>
                                    Resumen automático arriba y cuerpo completo debajo.
                                <?php else: ?>
                                    Selecciona un mensaje de la lista o pulsa “Nuevo mensaje”.
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($selectedEmail): ?>
                            <a class="btn" href="?folder=<?php echo urlencode($folder); ?>&msg=<?php echo (int)$selectedEmail['num']; ?>&reply=1">
                                ↩️ Responder
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php if ($selectedEmail): ?>
                        <div class="detail-body-wrapper">
                            <div class="detail-subject">
                                <?php echo htmlspecialchars($selectedEmail['subject'], ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                            <div class="detail-meta">
                                De:
                                <?php echo htmlspecialchars($selectedEmail['from'], ENT_QUOTES, 'UTF-8'); ?>
                                ·
                                Fecha:
                                <?php echo htmlspecialchars($selectedEmail['date'], ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                            <div class="detail-summary">
                                <strong>Resumen automático:</strong><br>
                                <?php echo nl2br(htmlspecialchars($selectedSummary, ENT_QUOTES, 'UTF-8')); ?>
                            </div>
                            <div class="detail-body">
                                <?php echo nl2br(htmlspecialchars($selectedBody, ENT_QUOTES, 'UTF-8')); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div style="font-size:.9rem; color:var(--text-muted); margin-top:.4rem;">
                            No hay ningún mensaje seleccionado.
                        </div>
                    <?php endif; ?>
                </section>

                <!-- Redactor inferior tipo Gmail (altura media) -->
                <div class="compose-wrapper">
                    <form method="post" class="compose-card" id="mailForm">
                        <div class="card-header" style="margin-bottom:.3rem;">
                            <div class="card-header-text">
                                <div class="card-title" style="font-size:.9rem;">
                                    <?php echo $replyMode ? 'Responder mensaje' : 'Nuevo mensaje'; ?>
                                </div>
                                <div class="card-caption">
                                    Asunto y cuerpo con dictado y corrección IA.
                                </div>
                            </div>
                            <span class="chip">
                                <?php echo $replyMode ? 'Modo respuesta' : 'Redacción'; ?>
                            </span>
                        </div>

                        <!-- Destinatario -->
                        <div class="form-row">
                            <div class="form-label">Para</div>
                            <div class="form-field">
                                <input type="email" name="to" class="input-text"
                                       placeholder="destinatario@ejemplo.com"
                                       required
                                       value="<?php echo htmlspecialchars($prefillTo, ENT_QUOTES, 'UTF-8'); ?>">
                            </div>
                        </div>

                        <!-- Asunto -->
                        <div class="form-row">
                            <div class="form-label">Asunto</div>
                            <div class="form-field">
                                <input type="text" id="subjectFinal" class="input-text"
                                       placeholder="El asunto corregido aparecerá aquí"
                                       readonly
                                       value="<?php echo htmlspecialchars($prefillSubjectFinal, ENT_QUOTES, 'UTF-8'); ?>">
                            </div>
                            <button type="button" id="btnDictarSubject" class="btn btn-voice">
                                <span class="pulse-dot"></span>
                                <span>🎙️ Asunto</span>
                            </button>
                        </div>

                        <div class="status-row">
                            <div>
                                <span class="status-label">Asunto IA:</span>
                                <span id="estadoIA_subject" class="status-text status-warn">
                                    <?php echo $prefillSubjectFinal ? 'Asunto preparado. Puedes dictar para modificarlo.' : 'A la espera de dictado…'; ?>
                                </span>
                            </div>
                        </div>

                        <textarea id="subjectRaw" class="visually-hidden"><?php
                            echo htmlspecialchars($prefillSubjectRaw, ENT_QUOTES, 'UTF-8');
                        ?></textarea>
                        <input type="hidden" name="final_subject" id="final_subject"
                               value="<?php echo htmlspecialchars($prefillSubjectFinal, ENT_QUOTES, 'UTF-8'); ?>">

                        <!-- Cuerpo -->
                        <div class="body-label-row">
                            <span>Cuerpo del mensaje</span>
                            <span class="badge-ai">Corrección suave (sin inventar contenido)</span>
                        </div>

                        <textarea id="texto" class="visually-hidden"></textarea>
                        <textarea name="final_body" id="final_body" class="visually-hidden"></textarea>

                        <div id="bodyResultBox" class="result-box">
                            <span class="result-placeholder">
                                Dicta el cuerpo del mensaje (botón 🎙️ Cuerpo) y aparecerá aquí corregido y formateado.
                            </span>
                        </div>

                        <div style="display:flex; justify-content:space-between; align-items:center; margin-top:.35rem; flex-wrap:wrap; gap:.4rem;">
                            <div style="display:flex; align-items:center; gap:.45rem; flex-wrap:wrap;">
                                <button type="button" id="btnDictarBody" class="btn btn-voice">
                                    <span class="pulse-dot"></span>
                                    <span>🎙️ Cuerpo</span>
                                </button>
                                <span class="status-text" style="color:var(--text-muted); font-size:.78rem;">
                                    La IA se ejecuta automáticamente cada pocos segundos.
                                </span>
                            </div>
                            <div>
                                <span class="status-label" style="font-size:.78rem;">Cuerpo IA:</span>
                                <span id="estadoIA_body" class="status-text status-warn">A la espera de dictado…</span>
                            </div>
                        </div>

                        <div style="margin-top:.3rem; display:flex; justify-content:space-between; align-items:center; gap:.6rem; flex-wrap:wrap;">
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
            </div>
        </div>
    </div>
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
    let currentTarget = null;
    let currentTargetType = null;
    let bufferBeforeRecognition = '';
    let recognizedFinal = '';

    let lastSentSubject = '';
    let lastSentBody    = '';
    let isSendingSubject = false;
    let isSendingBody    = false;
    const HEARTBEAT_MS = 3000;

    function setResultBody(text, isError = false, isPlaceholder = false) {
        bodyResultBox.innerHTML = '';
        const pre = document.createElement('pre');
        pre.style.margin = '0';
        pre.style.whiteSpace = 'pre-wrap';
        if (isPlaceholder) pre.classList.add('result-placeholder');
        if (isError) pre.style.color = '#b91c1c';
        pre.textContent = text;
        bodyResultBox.appendChild(pre);

        finalBodyField.value = text;
    }

    function updateIAStatus(kind, text, cls) {
        if (kind === 'subject') {
            estadoIA_subject.textContent = text;
            estadoIA_subject.className = 'status-text ' + (cls || '');
        } else {
            estadoIA_body.textContent = text;
            estadoIA_body.className = 'status-text ' + (cls || '');
        }
    }

    function markChanged(kind) {
        if (kind === 'subject') {
            updateIAStatus('subject', 'Detectados cambios. Se corregirá en unos segundos…', 'status-warn');
        } else {
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

        fetch(window.location.pathname + window.location.search, {
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

    setInterval(function() {
        sendToAI('subject');
        sendToAI('body');
    }, HEARTBEAT_MS);

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

    form.addEventListener('submit', function() {
        finalSubjectField.value = subjectFinal.value || '';
        const bodyText = bodyResultBox.textContent || '';
        finalBodyField.value = bodyText;
    });
})();
</script>
</body>
</html>

