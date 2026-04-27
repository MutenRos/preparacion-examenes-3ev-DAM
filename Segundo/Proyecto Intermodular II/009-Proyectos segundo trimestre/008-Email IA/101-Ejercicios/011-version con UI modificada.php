<?php
// =====================================================
//  CLIENTE DE CORREO (IMAP + SMTP + IA) — UI paleturquoise
//  - 3 columnas: Nav / Lista / Contenido
//  - Lectura a la derecha siempre visible
//  - Redacción tipo Gmail en panel inferior (altura media)
//  - Dictado por voz + corrección IA por “heartbeat”
// =====================================================

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
    if ($texto === '') return '';

    $texto = preg_replace_callback(
        '/^((hola|buenos dias|buenos días|buenas tardes|buenas noches|estimad[oa]s?|querid[oa]s?)\s+[^\n,]+,)\s*(.*)$/iu',
        function ($m) {
            $greeting = trim($m[1]);
            $rest     = trim($m[3]);
            if ($rest === '') return $greeting;
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
            if ($vaciasSeguidas > 1) continue;
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
        if ($ltrim === '') continue;
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
        if ($ltrim === '') continue;
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
    "Eres un asistente de edición de correos en español.\n\n" .
    "OBJETIVO:\n" .
    "Devuelve el MISMO correo, con el MISMO contenido y significado, pero con formato profesional y muy legible.\n\n" .

    "REGLAS ESTRICTAS (NO NEGOCIABLES):\n" .
    "- No añadas información nueva.\n" .
    "- No inventes nombres, fechas, cifras ni detalles.\n" .
    "- No elimines información relevante.\n" .
    "- No cambies el orden global de las ideas (solo puedes partir en frases y párrafos).\n" .
    "- No añadas saludos, despedidas ni asuntos que no aparezcan en el texto original.\n" .
    "- No expliques lo que haces.\n" .
    "- Devuelve ÚNICAMENTE el texto final del correo, sin comentarios, sin comillas, sin títulos, sin viñetas.\n\n" .

    "FORMATO OBLIGATORIO (ESTRUCTURA EN 3 BLOQUES):\n" .
    "1) SALUDO (si existe en el original):\n" .
    "   - Debe ser el primer párrafo.\n" .
    "   - Tras el saludo, SIEMPRE inserta una línea en blanco.\n\n" .

    "2) CUERPO:\n" .
    "   - Debe ir entre saludo y despedida.\n" .
    "   - Corrige ortografía, acentuación, puntuación y mayúsculas.\n" .
    "   - Divide en frases correctas.\n" .
    "   - Crea párrafos (separados por UNA línea en blanco) según temas:\n" .
    "     * Si detectas cambio de tema/acción/petición, empieza un nuevo párrafo.\n" .
    "     * Si hay una solicitud (\"Por lo tanto\", \"Dime\", \"Necesito\", \"Te pido\"...), colócala en el último párrafo del CUERPO, justo antes de la despedida.\n\n" .

    "3) DESPEDIDA + FIRMA (si existe en el original):\n" .
    "   - Debe ser el último párrafo.\n" .
    "   - Si aparecen \"Un saludo\", \"Saludos\", \"Atentamente\", \"Cordialmente\", etc., deben ir separados del cuerpo por UNA línea en blanco.\n" .
    "   - Si la despedida incluye coma y nombre (ej. \"Un saludo, José Vicente.\"), mantén esa línea intacta salvo correcciones mínimas de puntuación.\n\n" .

    "REGLA DE LÍNEAS EN BLANCO:\n" .
    "- Usa exactamente UNA línea en blanco entre párrafos (nunca dos).\n" .
    "- No añadas líneas en blanco al principio ni al final.\n\n" .

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

    return ['ok' => true, 'error' => '', 'texto' => trim($data['answer'])];
}

// ============================================
// SMTP PURO CON SOCKETS
// ============================================
function smtp_read_line($conn): string
{
    $data = '';
    while ($str = fgets($conn, 515)) {
        $data .= $str;
        if (strlen($str) >= 4 && $str[3] === ' ') break;
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

        $cryptoOk = @stream_socket_enable_crypto($conn, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
        if (!$cryptoOk) throw new RuntimeException("No se pudo establecer TLS (stream_socket_enable_crypto).");

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
// IMAP helpers
// ============================================
function decode_imap_text(string $text, int $encoding): string
{
    switch ($encoding) {
        case 3: return base64_decode($text) ?: $text;
        case 4: return quoted_printable_decode($text);
        default: return $text;
    }
}

function get_plain_text_body($imap, int $msgNo): string
{
    $structure = @imap_fetchstructure($imap, $msgNo);
    if (!$structure) return (string)@imap_body($imap, $msgNo);

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

    $resultado = ($kind === 'subject')
        ? procesar_texto_asunto($textoOriginal, $API_URL, $API_KEY)
        : procesar_texto_cuerpo($textoOriginal, $API_URL, $API_KEY);

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
    'INBOX'  => 'Recibidos',
    'Sent'   => 'Enviados',
    'Drafts' => 'Borradores',
    'Trash'  => 'Papelera'
];

$folder = $_GET['folder'] ?? 'INBOX';
if (!isset($allowedFolders[$folder])) $folder = 'INBOX';

$composeMode = isset($_GET['compose']) && $_GET['compose'] === '1';
$selectedMsgNo = isset($_GET['msg']) ? (int)$_GET['msg'] : null;
if ($composeMode) $selectedMsgNo = null;

$imapError = '';
$emails = [];
$selectedEmail = null;
$selectedBody = '';
$selectedSummary = '';
$folderCounts = array_fill_keys(array_keys($allowedFolders), 0);

if (function_exists('imap_open')) {
    $mailboxString = sprintf('{%s:%d%s}%s', IMAP_HOST, IMAP_PORT, IMAP_FLAGS, $folder);
    $imap = @imap_open($mailboxString, SMTP_USER, SMTP_PASS);
    if (!$imap) {
        $imapError = imap_last_error();
    } else {
        // Contadores (rápidos) por carpeta (solo si el servidor lo permite sin penalizar demasiado)
        foreach ($allowedFolders as $fKey => $_label) {
            $mb = sprintf('{%s:%d%s}%s', IMAP_HOST, IMAP_PORT, IMAP_FLAGS, $fKey);
            $tmp = @imap_open($mb, SMTP_USER, SMTP_PASS);
            if ($tmp) {
                $chk = @imap_check($tmp);
                if ($chk && isset($chk->Nmsgs)) $folderCounts[$fKey] = (int)$chk->Nmsgs;
                @imap_close($tmp);
            }
        }

        $ids = @imap_search($imap, 'ALL');
        if ($ids !== false) {
            rsort($ids);
            $ids = array_slice($ids, 0, 80); // un poco más, la UI lista mejor con scroll
            foreach ($ids as $num) {
                $overviewArr = @imap_fetch_overview($imap, $num, 0);
                if (!$overviewArr || !isset($overviewArr[0])) continue;
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
                $selectedSummary = $resumen['ok']
                    ? $resumen['texto']
                    : ("No se pudo generar el resumen: " . $resumen['error']);
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
$replyMode = ($selectedEmail !== null) && isset($_GET['reply']) && $_GET['reply'] === '1';

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
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jocarsa | email</title>
    <style>
        @import url('https://static.jocarsa.com/fuentes/ubuntu-font-family-0.83/ubuntu.css');

        :root{
            --bg: #AFEEEE;     /* paleturquoise */
            --nav: #354747;    /* oscuro */
            --list: #698f8f;   /* medio */
            --content: #F0FFFF;/* azure */
            --ink: #073b3b;
            --muted: #2b5a5a;
            --card: rgba(255,255,255,0.75);
            --accent: #20B2AA;
            --danger: #f44336;
            --ok: #15803d;
            --warn: #92400e;
            --shadow: 0 12px 30px rgba(0,0,0,0.18);
        }

        *{ box-sizing:border-box; }
        html,body{ height:100%; }
        body{
            margin:0;
            font-family: Ubuntu, system-ui, -apple-system, "Segoe UI", sans-serif;
            background: var(--bg);
            color: var(--ink);
        }

        #container{
            display:flex;
            height:100vh;
            width:100vw;
        }

        /* ===== NAV ===== */
        #nav{
            flex: 0 0 15%;
            overflow-y:auto;
            padding: 20px;
            padding-right: 0px;
            background: var(--nav);
        }
        #nav h3{
            margin: 0 0 15px;
            background: var(--content);
            color: #000;
            width: calc(100% - 60px);
            border-radius: 50px;
            padding: 10px;
            text-align: center;
            box-shadow: -30px 0px 30px rgba(0,0,0,0.3);
            font-weight: 500;
        }
        #nav a{
            display:block;
            padding: 10px 10px;
            margin: 10px 0;
            color:#fff;
            border-radius: 34px 0 0 34px;
            text-decoration:none;
            transition: background-color .2s ease;
            position:relative;
        }
        #nav a:hover,
        #nav a.active{ background: var(--list); }
        .contador{
            background: white;
            color: black;
            width: 33px;
            display: inline-block;
            text-align: center;
            height: 29px;
            border-radius: 30px;
            line-height: 29px;
            margin-right: 8px;
            font-size: .9rem;
        }
        #nav a.active .contador{ box-shadow:0px 0px 5px rgba(0,0,0,0.6) inset; }

        .nav-note{
            margin-top:14px;
            width: calc(100% - 20px);
            padding:10px 12px;
            border-radius: 14px;
            background: rgba(240,255,255,0.12);
            color: rgba(255,255,255,0.9);
            font-size: .85rem;
            line-height: 1.25rem;
        }
        .nav-error{
            margin-top:10px;
            width: calc(100% - 20px);
            padding:10px 12px;
            border-radius: 14px;
            background: rgba(255,255,255,0.14);
            color: #ffd6d6;
            font-size:.85rem;
        }

        /* ===== LISTA ===== */
        #emailList{
            flex: 0 0 15%;
            overflow-y:auto;
            padding: 20px;
            padding-right: 0px;
            background: var(--list);
        }
        #emailList h3{
            margin: 0 0 15px;
            color: #fff;
            font-weight: 500;
        }
        #emailList ul{
            list-style:none;
            padding:0;
            margin:0;
        }
        #emailList li{
            padding: 12px 12px;
            border-radius: 34px 0 0 34px;
            cursor:pointer;
            transition: background-color .15s ease;
        }
        #emailList li:hover{ background: rgba(240,255,255,0.35); }
        #emailList li.selected{
            background: var(--content);
            box-shadow: -10px 0px 10px rgba(0,0,0,0.3);
        }
        #emailList li a{
            color: #004C4C;
            text-decoration:none;
            display:block;
        }
        .mail-subject{
            font-weight: 600;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
            margin-bottom: 4px;
        }
        .mail-from{
            font-size: .86rem;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
            opacity: .9;
        }
        .mail-date{
            font-size: .78rem;
            opacity: .85;
            margin-top: 6px;
        }
        .mail-unseen .mail-subject{ font-weight: 800; }

        /* ===== CONTENT ===== */
        #content{
            flex: 0 0 70%;
            overflow:hidden; /* importante: dentro hay scrolls */
            padding: 20px;
            background: var(--content);
            display:flex;
            flex-direction:column;
            min-width:0;
        }

        .content-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:12px;
            margin-bottom: 12px;
        }
        .content-header h3{
            margin:0;
            color: #458B74;
            font-weight: 500;
        }
        .toolbar{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            align-items:center;
        }

        .btn{
            border:none;
            cursor:pointer;
            padding: 8px 12px;
            border-radius: 10px;
            background: #698f8f;
            color:#fff;
            transition: background-color .2s ease, transform .05s ease;
            font-family: inherit;
        }
        .btn:hover{ background: var(--accent); }
        .btn:active{ transform: translateY(1px); }

        .btn-danger{
            background: var(--danger);
        }
        .btn-danger:hover{ background:#c62828; }

        .btn-light{
            background: rgba(105,143,143,0.18);
            color: var(--ink);
            border: 1px solid rgba(105,143,143,0.35);
        }
        .btn-light:hover{
            background: rgba(32,178,170,0.22);
            border-color: rgba(32,178,170,0.55);
        }

        /* Área superior lectura (scroll) + panel inferior redacción */
        .content-body{
            flex:1;
            min-height:0;
            display:flex;
            flex-direction:column;
            gap: 14px;
        }
        .reader{
            flex:1;
            min-height:0;
            overflow:auto;
            border-radius: 16px;
            background: rgba(255,255,255,0.55);
            box-shadow: var(--shadow);
            padding: 14px 16px;
        }

        .reader-meta{
            margin-bottom: 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(105,143,143,0.25);
        }
        .reader-meta .subject{
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: #073b3b;
        }
        .reader-meta .line{
            font-size:.9rem;
            color: var(--muted);
        }

        .summary{
            margin: 10px 0 12px 0;
            padding: 10px 12px;
            border-radius: 12px;
            background: rgba(175,238,238,0.35);
            border: 1px solid rgba(105,143,143,0.25);
            color: #0c3f3f;
            line-height: 1.3rem;
        }
        .bodytext{
            white-space: pre-wrap;
            background: rgba(255,255,255,0.75);
            border: 1px solid rgba(105,143,143,0.25);
            border-radius: 12px;
            padding: 12px;
            line-height: 1.35rem;
            color: #073b3b;
        }

        /* Panel inferior “Gmail medio” */
        .composer{
            height: 290px;
            border-radius: 16px;
            background: rgba(255,255,255,0.72);
            box-shadow: var(--shadow);
            padding: 12px 14px;
            display:flex;
            flex-direction:column;
            min-height: 230px;
        }
        .composer-top{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:10px;
            margin-bottom: 10px;
        }
        .composer-top .title{
            font-weight:700;
            color:#073b3b;
        }
        .composer-top .pill{
            font-size:.85rem;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(175,238,238,0.35);
            border: 1px solid rgba(105,143,143,0.25);
            color:#0c3f3f;
        }

        .row{
            display:flex;
            gap:10px;
            align-items:center;
            margin-bottom: 10px;
        }
        .row label{
            width: 56px;
            text-align:right;
            font-size:.9rem;
            color: var(--muted);
        }
        .field{
            flex:1;
            min-width:0;
        }
        input[type="text"], input[type="email"]{
            width:100%;
            padding: 9px 10px;
            border-radius: 10px;
            border: 1px solid rgba(105,143,143,0.35);
            background: rgba(240,255,255,0.65);
            font-family: inherit;
            outline: none;
        }
        input[type="text"]:focus, input[type="email"]:focus{
            border-color: rgba(32,178,170,0.75);
            background: rgba(255,255,255,0.9);
        }

        .voiceBtn{
            display:flex;
            align-items:center;
            gap:8px;
            border-radius: 999px;
            padding: 8px 12px;
            border: 1px solid rgba(105,143,143,0.35);
            background: rgba(240,255,255,0.65);
            cursor:pointer;
            color: #0c3f3f;
        }
        .voiceBtn:hover{ border-color: rgba(32,178,170,0.65); }
        .voiceBtn.active{
            background: rgba(175,238,238,0.55);
            border-color: rgba(32,178,170,0.75);
        }
        .dot{
            width:10px; height:10px; border-radius:999px;
            background: rgba(105,143,143,0.8);
            box-shadow: 0 0 0 rgba(32,178,170,0.0);
        }
        .voiceBtn.active .dot{
            background: rgba(21,128,61,0.9);
            box-shadow: 0 0 12px rgba(21,128,61,0.35);
        }

        .resultBox{
            flex:1;
            min-height:0;
            border-radius: 12px;
            border: 1px solid rgba(105,143,143,0.25);
            background: rgba(240,255,255,0.65);
            padding: 10px 12px;
            overflow:auto;
            white-space: pre-wrap;
        }
        .placeholder{
            color: rgba(7,59,59,0.55);
            font-style: italic;
        }

        .statusbar{
            display:flex;
            justify-content:space-between;
            gap:10px;
            margin-top: 8px;
            flex-wrap:wrap;
            align-items:center;
            font-size:.86rem;
            color: var(--muted);
        }
        .status-ok{ color: var(--ok); font-weight: 600; }
        .status-warn{ color: var(--warn); font-weight: 600; }
        .status-error{ color: #b91c1c; font-weight: 700; }

        .send-status{
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            font-size: .9rem;
        }
        .send-status.ok{
            background: rgba(21,128,61,0.12);
            border: 1px solid rgba(21,128,61,0.25);
            color: var(--ok);
        }
        .send-status.error{
            background: rgba(185,28,28,0.10);
            border: 1px solid rgba(185,28,28,0.25);
            color: #b91c1c;
        }

        .vh{
            position:absolute; left:-9999px; width:1px; height:1px; overflow:hidden;
        }

        /* Responsive */
        @media (max-width: 1100px){
            #nav{ flex-basis: 18%; }
            #emailList{ flex-basis: 22%; }
            #content{ flex-basis: 60%; }
        }
        @media (max-width: 900px){
            #container{ flex-direction:column; height:auto; min-height:100vh; }
            #nav, #emailList, #content{ flex: 0 0 auto; }
            #nav{ padding-right:20px; }
            #emailList{ padding-right:20px; }
            #content{ height: calc(100vh - 420px); min-height: 520px; }
        }
    </style>
</head>
<body>
<div id="container">

    <!-- NAV -->
    <div id="nav">
        <h3>jocarsa | email</h3>

        <?php foreach ($allowedFolders as $key => $label): ?>
            <?php
                $isActive = ($key === $folder);
                $count = isset($folderCounts[$key]) ? (int)$folderCounts[$key] : 0;
                $icon = '📁';
                if ($key === 'INBOX') $icon = '📥';
                elseif ($key === 'Sent') $icon = '📤';
                elseif ($key === 'Drafts') $icon = '✏️';
                elseif ($key === 'Trash') $icon = '🗑️';
            ?>
            <a href="?folder=<?php echo urlencode($key); ?>"
               class="<?php echo $isActive ? 'active' : ''; ?>">
                <span class="contador"><?php echo $count; ?></span> <?php echo $icon . ' ' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?>
            </a>
        <?php endforeach; ?>

        <a href="?folder=<?php echo urlencode($folder); ?>&compose=1" class="<?php echo $composeMode ? 'active' : ''; ?>">
            <span class="contador">+</span> ✉️ Nuevo
        </a>

        <div class="nav-note">
            <strong>IA:</strong> corrección suave + resumen automático.<br>
            <strong>Dictado:</strong> es-ES (Chrome recomendado).
        </div>

        <?php if ($imapError): ?>
            <div class="nav-error">
                <strong>IMAP:</strong> <?php echo htmlspecialchars($imapError, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- LISTA -->
    <div id="emailList">
        <h3 id="listTitle"><?php echo htmlspecialchars($allowedFolders[$folder], ENT_QUOTES, 'UTF-8'); ?></h3>
        <ul id="listItems">
            <?php if (!$emails): ?>
                <li style="background:rgba(240,255,255,0.25); border-radius:14px; color:#fff;">
                    No hay mensajes o no se han podido recuperar.
                </li>
            <?php else: ?>
                <?php foreach ($emails as $msg): ?>
                    <?php $isSelected = ($selectedMsgNo && $msg['num'] === $selectedMsgNo); ?>
                    <li class="<?php echo $isSelected ? 'selected ' : ''; ?><?php echo !$msg['seen'] ? 'mail-unseen' : ''; ?>"
                        onclick="window.location.href='?folder=<?php echo urlencode($folder); ?>&msg=<?php echo (int)$msg['num']; ?>'">
                        <a href="?folder=<?php echo urlencode($folder); ?>&msg=<?php echo (int)$msg['num']; ?>" onclick="event.preventDefault();">
                            <div class="mail-subject"><?php echo htmlspecialchars($msg['subject'], ENT_QUOTES, 'UTF-8'); ?></div>
                            <div class="mail-from"><?php echo htmlspecialchars($msg['from'], ENT_QUOTES, 'UTF-8'); ?></div>
                            <div class="mail-date"><?php echo htmlspecialchars($msg['date'], ENT_QUOTES, 'UTF-8'); ?></div>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>

    <!-- CONTENT -->
    <div id="content">
        <div class="content-header">
            <h3 id="contentTitle">
                <?php
                    if ($selectedEmail) echo 'Contenido';
                    else echo ($composeMode ? 'Redacción' : 'Contenido');
                ?>
            </h3>
            <div class="toolbar">
                <?php if ($selectedEmail): ?>
                    <a class="btn btn-light" href="?folder=<?php echo urlencode($folder); ?>&msg=<?php echo (int)$selectedEmail['num']; ?>&reply=1">↩️ Responder</a>
                <?php endif; ?>
                <a class="btn btn-light" href="?folder=<?php echo urlencode($folder); ?>&compose=1">✉️ Nuevo</a>
            </div>
        </div>

        <div class="content-body">
            <!-- READER -->
            <div class="reader" id="reader">
                <?php if ($selectedEmail): ?>
                    <div class="reader-meta">
                        <div class="subject"><?php echo htmlspecialchars($selectedEmail['subject'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="line"><strong>De:</strong> <?php echo htmlspecialchars($selectedEmail['from'], ENT_QUOTES, 'UTF-8'); ?></div>
                        <div class="line"><strong>Fecha:</strong> <?php echo htmlspecialchars($selectedEmail['date'], ENT_QUOTES, 'UTF-8'); ?></div>
                    </div>

                    <div class="summary">
                        <strong>Resumen automático</strong><br>
                        <?php echo nl2br(htmlspecialchars($selectedSummary, ENT_QUOTES, 'UTF-8')); ?>
                    </div>

                    <div class="bodytext">
                        <?php echo nl2br(htmlspecialchars($selectedBody, ENT_QUOTES, 'UTF-8')); ?>
                    </div>
                <?php else: ?>
                    <div class="bodytext" style="border-style:dashed;">
                        <?php if ($composeMode): ?>
                            Panel de redacción activo. La lectura se mostrará aquí al seleccionar un correo.
                        <?php else: ?>
                            Selecciona un mensaje en la lista para verlo aquí.
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- COMPOSER (siempre visible) -->
            <div class="composer" id="composer">
                <form method="post" id="mailForm" style="display:flex; flex-direction:column; height:100%;">
                    <div class="composer-top">
                        <div class="title"><?php echo $replyMode ? 'Responder mensaje' : 'Nuevo mensaje'; ?></div>
                        <div class="pill">IA + dictado · estilo Gmail (medio)</div>
                    </div>

                    <div class="row">
                        <label>Para</label>
                        <div class="field">
                            <input type="email" name="to" required placeholder="destinatario@ejemplo.com"
                                   value="<?php echo htmlspecialchars($prefillTo, ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                    </div>

                    <div class="row">
                        <label>Asunto</label>
                        <div class="field">
                            <input type="text" id="subjectFinal" placeholder="Asunto corregido (IA)"
                                   readonly value="<?php echo htmlspecialchars($prefillSubjectFinal, ENT_QUOTES, 'UTF-8'); ?>">
                        </div>
                        <button type="button" class="voiceBtn" id="btnDictarSubject" title="Dictar asunto">
                            <span class="dot"></span> 🎙️ Asunto
                        </button>
                    </div>

                    <textarea id="subjectRaw" class="vh"><?php echo htmlspecialchars($prefillSubjectRaw, ENT_QUOTES, 'UTF-8'); ?></textarea>
                    <input type="hidden" name="final_subject" id="final_subject"
                           value="<?php echo htmlspecialchars($prefillSubjectFinal, ENT_QUOTES, 'UTF-8'); ?>">

                    <textarea id="texto" class="vh"></textarea>
                    <textarea name="final_body" id="final_body" class="vh"></textarea>

                    <div class="resultBox" id="bodyResultBox">
                        <span class="placeholder">Dicta el cuerpo (🎙️ Cuerpo). La IA lo corregirá automáticamente cada pocos segundos.</span>
                    </div>

                    <div class="statusbar">
                        <div>
                            <span id="estadoDictado" class="status-warn">Dictado en espera.</span>
                            &nbsp;·&nbsp;
                            <span>Asunto IA: <span id="estadoIA_subject" class="status-warn"><?php echo $prefillSubjectFinal ? 'Preparado.' : 'A la espera…'; ?></span></span>
                            &nbsp;·&nbsp;
                            <span>Cuerpo IA: <span id="estadoIA_body" class="status-warn">A la espera…</span></span>
                        </div>

                        <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                            <button type="button" class="voiceBtn" id="btnDictarBody" title="Dictar cuerpo">
                                <span class="dot"></span> 🎙️ Cuerpo
                            </button>
                            <button type="submit" class="btn" name="send_email" value="1">Enviar</button>
                        </div>
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

<script>
(function(){
    const subjectRaw        = document.getElementById('subjectRaw');
    const bodyRaw           = document.getElementById('texto');
    const subjectFinal      = document.getElementById('subjectFinal');
    const bodyResultBox     = document.getElementById('bodyResultBox');

    const finalSubjectField = document.getElementById('final_subject');
    const finalBodyField    = document.getElementById('final_body');

    const btnDictarSubject  = document.getElementById('btnDictarSubject');
    const btnDictarBody     = document.getElementById('btnDictarBody');

    const estadoIA_subject  = document.getElementById('estadoIA_subject');
    const estadoIA_body     = document.getElementById('estadoIA_body');
    const estadoDictado     = document.getElementById('estadoDictado');

    const form              = document.getElementById('mailForm');

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

    function setBodyBox(text, isError=false, isPlaceholder=false){
        bodyResultBox.innerHTML = '';
        const pre = document.createElement('pre');
        pre.style.margin = '0';
        pre.style.whiteSpace = 'pre-wrap';
        pre.textContent = text;
        if (isPlaceholder) pre.classList.add('placeholder');
        if (isError) pre.style.color = '#b91c1c';
        bodyResultBox.appendChild(pre);
        finalBodyField.value = text;
    }

    function setIAStatus(kind, text, cls){
        const el = (kind === 'subject') ? estadoIA_subject : estadoIA_body;
        el.textContent = text;
        el.className = cls || '';
    }

    function markChanged(kind){
        if (kind === 'subject') setIAStatus('subject','Detectados cambios…','status-warn');
        else setIAStatus('body','Detectados cambios…','status-warn');
    }

    function sendToAI(kind){
        const rawEl = (kind === 'subject') ? subjectRaw : bodyRaw;
        const current = rawEl.value.trim();
        if (!current){
            setIAStatus(kind, 'Sin texto.', 'status-warn');
            return;
        }

        if (kind === 'subject'){
            if (isSendingSubject || current === lastSentSubject) return;
            isSendingSubject = true;
            setIAStatus('subject','Enviando…','status-warn');
        } else {
            if (isSendingBody || current === lastSentBody) return;
            isSendingBody = true;
            setIAStatus('body','Enviando…','status-warn');
        }

        const params = new URLSearchParams();
        params.append('ajax','1');
        params.append('kind', kind === 'subject' ? 'subject' : 'body');
        params.append('texto', current);

        fetch(window.location.pathname + window.location.search, {
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body: params.toString()
        })
        .then(r => r.json())
        .then(data => {
            if (!data || typeof data.ok === 'undefined'){
                if (kind === 'body') setBodyBox('Respuesta inesperada del servidor.', true);
                setIAStatus(kind,'Respuesta inválida.','status-error');
                return;
            }
            if (!data.ok){
                if (kind === 'body') setBodyBox(data.error || 'Error al procesar.', true);
                setIAStatus(kind,'Error IA.','status-error');
                return;
            }

            if (kind === 'subject'){
                lastSentSubject = current;
                const text = data.texto || '';
                subjectFinal.value = text;
                finalSubjectField.value = text;
                setIAStatus('subject','Actualizado.','status-ok');
            } else {
                lastSentBody = current;
                setBodyBox(data.texto || '');
                setIAStatus('body','Actualizado.','status-ok');
            }
        })
        .catch(err => {
            console.error(err);
            if (kind === 'body') setBodyBox('Error de red al contactar con la IA.', true);
            setIAStatus(kind,'Error de red.','status-error');
        })
        .finally(() => {
            if (kind === 'subject') isSendingSubject = false;
            else isSendingBody = false;
        });
    }

    setInterval(() => {
        sendToAI('subject');
        sendToAI('body');
    }, HEARTBEAT_MS);

    function startDictationFor(kind){
        if (!recognition) return;

        const targetRaw = (kind === 'subject') ? subjectRaw : bodyRaw;

        if (escuchando && currentTargetType === kind){
            recognition.stop();
            return;
        }
        if (escuchando && currentTargetType !== kind){
            recognition.stop();
            return;
        }

        currentTarget = targetRaw;
        currentTargetType = kind;

        try { recognition.start(); } catch(e){ console.error(e); }
    }

    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window){
        const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SR();
        recognition.lang = 'es-ES';
        recognition.continuous = true;
        recognition.interimResults = true;

        recognition.onstart = function(){
            escuchando = true;
            recognizedFinal = '';
            bufferBeforeRecognition = currentTarget ? currentTarget.value.trimEnd() : '';

            btnDictarSubject.classList.remove('active');
            btnDictarBody.classList.remove('active');

            if (currentTargetType === 'subject'){
                btnDictarSubject.classList.add('active');
                estadoDictado.textContent = 'Dictando asunto…';
            } else {
                btnDictarBody.classList.add('active');
                estadoDictado.textContent = 'Dictando cuerpo…';
            }
            estadoDictado.className = 'status-ok';
        };

        recognition.onerror = function(ev){
            escuchando = false;
            btnDictarSubject.classList.remove('active');
            btnDictarBody.classList.remove('active');
            estadoDictado.textContent = 'Error en reconocimiento de voz.';
            estadoDictado.className = 'status-error';
            console.error('Speech error:', ev);
        };

        recognition.onend = function(){
            escuchando = false;
            btnDictarSubject.classList.remove('active');
            btnDictarBody.classList.remove('active');

            if (subjectRaw.value.trim() || bodyRaw.value.trim()){
                estadoDictado.textContent = 'Dictado detenido. Texto listo para corregir.';
                estadoDictado.className = 'status-ok';
            } else {
                estadoDictado.textContent = 'Dictado detenido.';
                estadoDictado.className = 'status-warn';
            }
        };

        recognition.onresult = function(event){
            if (!currentTarget) return;
            let interimText = '';

            for (let i = event.resultIndex; i < event.results.length; i++){
                const transcript = event.results[i][0].transcript;
                if (event.results[i].isFinal) recognizedFinal += transcript + ' ';
                else interimText += transcript + ' ';
            }

            const fullText = (bufferBeforeRecognition + ' ' + recognizedFinal + interimText).trim();
            currentTarget.value = fullText;
            markChanged(currentTargetType);
        };

        btnDictarSubject.addEventListener('click', () => startDictationFor('subject'));
        btnDictarBody.addEventListener('click', () => startDictationFor('body'));

        estadoDictado.textContent = 'Dictado disponible. Pulsa 🎙️ Asunto o 🎙️ Cuerpo.';
        estadoDictado.className = 'status-ok';
    } else {
        btnDictarSubject.disabled = true;
        btnDictarBody.disabled = true;
        estadoDictado.textContent = 'Dictado no compatible con este navegador.';
        estadoDictado.className = 'status-error';
    }

    form.addEventListener('submit', function(){
        finalSubjectField.value = subjectFinal.value || '';
        finalBodyField.value = bodyResultBox.textContent || '';
    });

    // Placeholder inicial para cuerpo
    if (!bodyRaw.value.trim()){
        setBodyBox('Dicta el cuerpo (🎙️ Cuerpo). La IA lo corregirá automáticamente cada pocos segundos.', false, true);
    }
})();
</script>
</body>
</html>

