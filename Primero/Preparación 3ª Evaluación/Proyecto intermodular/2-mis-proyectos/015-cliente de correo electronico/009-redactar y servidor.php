<?php
session_start();
date_default_timezone_set('Europe/Madrid');

/*
    jocarsa | email
    Cliente de correo básico en PHP + SQLite + IMAP/SMTP nativo
    Sin librerías externas

    Requisitos:
    - extension=pdo_sqlite
    - extension=imap
    - allow_url_fopen no es necesario
*/

/* =========================================================
   CONFIG
========================================================= */
define('DB_FILE', __DIR__ . '/correo.sqlite');
define('IMAP_PORT', 993);
define('IMAP_FLAGS', '/imap/ssl');
define('SMTP_PORT_SSL', 465);   // envío simple por SSL
define('SMTP_TIMEOUT', 20);

/* =========================================================
   DB
========================================================= */
function db(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $pdo = new PDO('sqlite:' . DB_FILE);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS cuentas (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT NOT NULL UNIQUE,
                imap_server TEXT NOT NULL,
                smtp_server TEXT NOT NULL,
                created_at TEXT NOT NULL,
                updated_at TEXT NOT NULL
            )
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS mensajes (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                cuenta_email TEXT NOT NULL,
                carpeta TEXT NOT NULL DEFAULT 'INBOX',
                uid INTEGER NOT NULL,
                msgno INTEGER,
                asunto TEXT,
                remitente TEXT,
                destinatario TEXT,
                fecha_raw TEXT,
                fecha_unix INTEGER,
                cuerpo TEXT,
                resumen TEXT,
                visto INTEGER NOT NULL DEFAULT 0,
                message_id TEXT,
                created_at TEXT NOT NULL,
                updated_at TEXT NOT NULL,
                UNIQUE(cuenta_email, carpeta, uid)
            )
        ");

        $pdo->exec("
            CREATE INDEX IF NOT EXISTS idx_mensajes_cuenta_fecha
            ON mensajes(cuenta_email, fecha_unix DESC)
        ");
    }

    return $pdo;
}

function getCuentaByEmail(string $email): ?array {
    $stmt = db()->prepare("SELECT * FROM cuentas WHERE lower(email)=lower(?) LIMIT 1");
    $stmt->execute([$email]);
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);
    return $fila ?: null;
}

function saveCuenta(string $email, string $imap, string $smtp): void {
    $existente = getCuentaByEmail($email);
    $ahora = date('Y-m-d H:i:s');

    if ($existente) {
        $stmt = db()->prepare("
            UPDATE cuentas
            SET imap_server=?, smtp_server=?, updated_at=?
            WHERE lower(email)=lower(?)
        ");
        $stmt->execute([$imap, $smtp, $ahora, $email]);
    } else {
        $stmt = db()->prepare("
            INSERT INTO cuentas(email,imap_server,smtp_server,created_at,updated_at)
            VALUES(?,?,?,?,?)
        ");
        $stmt->execute([$email, $imap, $smtp, $ahora, $ahora]);
    }
}

function saveOrUpdateMensaje(array $m): void {
    $pdo = db();
    $ahora = date('Y-m-d H:i:s');

    $stmt = $pdo->prepare("
        INSERT INTO mensajes(
            cuenta_email, carpeta, uid, msgno, asunto, remitente, destinatario,
            fecha_raw, fecha_unix, cuerpo, resumen, visto, message_id, created_at, updated_at
        ) VALUES(
            :cuenta_email, :carpeta, :uid, :msgno, :asunto, :remitente, :destinatario,
            :fecha_raw, :fecha_unix, :cuerpo, :resumen, :visto, :message_id, :created_at, :updated_at
        )
        ON CONFLICT(cuenta_email, carpeta, uid) DO UPDATE SET
            msgno=excluded.msgno,
            asunto=excluded.asunto,
            remitente=excluded.remitente,
            destinatario=excluded.destinatario,
            fecha_raw=excluded.fecha_raw,
            fecha_unix=excluded.fecha_unix,
            cuerpo=excluded.cuerpo,
            resumen=excluded.resumen,
            visto=excluded.visto,
            message_id=excluded.message_id,
            updated_at=excluded.updated_at
    ");

    $stmt->execute([
        ':cuenta_email' => $m['cuenta_email'],
        ':carpeta'      => $m['carpeta'],
        ':uid'          => $m['uid'],
        ':msgno'        => $m['msgno'],
        ':asunto'       => $m['asunto'],
        ':remitente'    => $m['remitente'],
        ':destinatario' => $m['destinatario'],
        ':fecha_raw'    => $m['fecha_raw'],
        ':fecha_unix'   => $m['fecha_unix'],
        ':cuerpo'       => $m['cuerpo'],
        ':resumen'      => $m['resumen'],
        ':visto'        => $m['visto'],
        ':message_id'   => $m['message_id'],
        ':created_at'   => $ahora,
        ':updated_at'   => $ahora,
    ]);
}

function getMensajesDb(string $email, int $limit = 50): array {
    $stmt = db()->prepare("
        SELECT *
        FROM mensajes
        WHERE lower(cuenta_email)=lower(?)
        ORDER BY fecha_unix DESC, id DESC
        LIMIT ?
    ");
    $stmt->bindValue(1, $email, PDO::PARAM_STR);
    $stmt->bindValue(2, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMensajeDbById(string $email, int $id): ?array {
    $stmt = db()->prepare("
        SELECT *
        FROM mensajes
        WHERE lower(cuenta_email)=lower(?) AND id=?
        LIMIT 1
    ");
    $stmt->execute([$email, $id]);
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);
    return $fila ?: null;
}

/* =========================================================
   HELPERS
========================================================= */
function h(?string $txt): string {
    return htmlspecialchars((string)$txt, ENT_QUOTES, 'UTF-8');
}

function decodeMimeStr(string $string, string $charset = 'UTF-8'): string {
    $elements = @imap_mime_header_decode($string);
    if (!$elements || !is_array($elements)) {
        return $string;
    }

    $out = '';
    foreach ($elements as $el) {
        $fromCharset = $el->charset ?? 'default';
        $text = $el->text ?? '';

        if ($fromCharset !== 'default' && strtoupper($fromCharset) !== strtoupper($charset)) {
            $converted = @iconv($fromCharset, $charset . '//IGNORE', $text);
            $out .= $converted !== false ? $converted : $text;
        } else {
            $out .= $text;
        }
    }
    return $out;
}

function parseAddressHeader(?string $header): string {
    if (!$header) return '';
    $addresses = @imap_rfc822_parse_adrlist($header, '');
    if (!$addresses || !is_array($addresses)) return $header;

    $salida = [];
    foreach ($addresses as $addr) {
        $mailbox = $addr->mailbox ?? '';
        $host = $addr->host ?? '';
        $email = ($mailbox && $host && $host !== '.SYNTAX-ERROR.') ? ($mailbox . '@' . $host) : '';
        $nombre = '';

        if (isset($addr->personal) && $addr->personal !== '') {
            $nombre = decodeMimeStr($addr->personal);
        }

        if ($nombre && $email) $salida[] = $nombre . ' <' . $email . '>';
        elseif ($email) $salida[] = $email;
        elseif ($nombre) $salida[] = $nombre;
    }

    return implode(', ', $salida);
}

function resumenTexto(string $texto, int $len = 180): string {
    $texto = preg_replace('/\s+/', ' ', trim($texto));
    return mb_substr($texto, 0, $len);
}

function limpiarTextoPlano(string $texto): string {
    $texto = quoted_printable_decode($texto);
    $texto = html_entity_decode($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return trim($texto);
}

function emailSoloDireccion(string $valor): string {
    if (preg_match('/<([^>]+)>/', $valor, $m)) {
        return trim($m[1]);
    }
    return trim($valor);
}

function normalizarCRLF(string $txt): string {
    $txt = str_replace(["\r\n", "\r"], "\n", $txt);
    return str_replace("\n", "\r\n", $txt);
}

/* =========================================================
   IMAP
========================================================= */
function conectarImap(string $email, string $password, string $imapServer, int $port = IMAP_PORT, string $flags = IMAP_FLAGS): array {
    $mailbox = '{' . $imapServer . ':' . $port . $flags . '}INBOX';
    $imap = @imap_open($mailbox, $email, $password);

    if (!$imap) {
        $error = imap_last_error();
        return ['ok' => false, 'error' => $error ?: 'No se pudo conectar al servidor IMAP'];
    }

    return ['ok' => true, 'imap' => $imap, 'mailbox' => $mailbox];
}

function getPartBody($imap, int $msgNo, stdClass $structure, string $partNumber = ''): array {
    $result = ['plain' => '', 'html' => ''];

    if (!isset($structure->type)) return $result;

    if ($structure->type == 0) {
        $body = $partNumber === ''
            ? @imap_body($imap, $msgNo, FT_PEEK)
            : @imap_fetchbody($imap, $msgNo, $partNumber, FT_PEEK);

        if (isset($structure->encoding)) {
            switch ($structure->encoding) {
                case 3: $body = base64_decode($body); break;
                case 4: $body = quoted_printable_decode($body); break;
            }
        }

        $subtype = strtoupper($structure->subtype ?? 'PLAIN');
        if ($subtype === 'PLAIN') $result['plain'] .= $body;
        elseif ($subtype === 'HTML') $result['html'] .= $body;

        return $result;
    }

    if ($structure->type == 1 && !empty($structure->parts)) {
        foreach ($structure->parts as $index => $subpart) {
            $pn = $partNumber === '' ? (string)($index + 1) : $partNumber . '.' . ($index + 1);
            $sub = getPartBody($imap, $msgNo, $subpart, $pn);
            $result['plain'] .= $sub['plain'];
            $result['html'] .= $sub['html'];
        }
    }

    return $result;
}

function extractMessageBody($imap, int $msgNo): string {
    $structure = @imap_fetchstructure($imap, $msgNo);
    if (!$structure) return '';

    $bodies = getPartBody($imap, $msgNo, $structure);

    if (trim($bodies['plain']) !== '') {
        return limpiarTextoPlano($bodies['plain']);
    }

    if (trim($bodies['html']) !== '') {
        $html = quoted_printable_decode($bodies['html']);
        $text = strip_tags($html);
        return trim(html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }

    return '';
}

function syncMensajesDesdeServidor(string $email, string $password, string $imapServer, int $limit = 50): array {
    $conexion = conectarImap($email, $password, $imapServer);
    if (!$conexion['ok']) {
        return ['ok' => false, 'error' => $conexion['error']];
    }

    $imap = $conexion['imap'];
    $num = @imap_num_msg($imap);
    if (!$num) {
        @imap_close($imap);
        return ['ok' => true, 'count' => 0];
    }

    $inicio = max(1, $num - $limit + 1);
    $guardados = 0;

    for ($i = $num; $i >= $inicio; $i--) {
        $overviewArr = @imap_fetch_overview($imap, (string)$i, 0);
        if (!$overviewArr || !isset($overviewArr[0])) {
            continue;
        }

        $ov = $overviewArr[0];
        $header = @imap_headerinfo($imap, $i);

        $asunto = isset($ov->subject) ? decodeMimeStr($ov->subject) : '(Sin asunto)';
        $remitente = isset($header->fromaddress) ? parseAddressHeader($header->fromaddress) : '';
        $destinatario = isset($header->toaddress) ? parseAddressHeader($header->toaddress) : '';
        $fechaRaw = $ov->date ?? '';
        $fechaUnix = $fechaRaw ? strtotime($fechaRaw) : time();
        $uid = (int)@imap_uid($imap, $i);
        $visto = !empty($ov->seen) ? 1 : 0;
        $messageId = $header->message_id ?? '';
        $cuerpo = extractMessageBody($imap, $i);

        saveOrUpdateMensaje([
            'cuenta_email' => $email,
            'carpeta'      => 'INBOX',
            'uid'          => $uid,
            'msgno'        => $i,
            'asunto'       => $asunto !== '' ? $asunto : '(Sin asunto)',
            'remitente'    => $remitente,
            'destinatario' => $destinatario,
            'fecha_raw'    => $fechaRaw,
            'fecha_unix'   => $fechaUnix ?: time(),
            'cuerpo'       => $cuerpo,
            'resumen'      => resumenTexto($cuerpo),
            'visto'        => $visto,
            'message_id'   => $messageId,
        ]);

        $guardados++;
    }

    @imap_close($imap);
    return ['ok' => true, 'count' => $guardados];
}

/* =========================================================
   SMTP
========================================================= */
function smtpRead($fp): string {
    $data = '';
    while (!feof($fp)) {
        $line = fgets($fp, 515);
        if ($line === false) break;
        $data .= $line;
        if (preg_match('/^\d{3}\s/', $line)) break;
    }
    return $data;
}

function smtpExpect($fp, array $codes): array {
    $resp = smtpRead($fp);
    $ok = false;

    foreach ($codes as $code) {
        if (strpos($resp, (string)$code) === 0) {
            $ok = true;
            break;
        }
    }

    return ['ok' => $ok, 'response' => $resp];
}

function smtpWrite($fp, string $cmd): void {
    fwrite($fp, $cmd);
}

function smtpEnviarSSL(
    string $smtpHost,
    int $smtpPort,
    string $usuario,
    string $password,
    string $from,
    string $to,
    string $subject,
    string $body
): array {
    $remote = 'ssl://' . $smtpHost;
    $fp = @fsockopen($remote, $smtpPort, $errno, $errstr, SMTP_TIMEOUT);

    if (!$fp) {
        return ['ok' => false, 'error' => "No se pudo conectar a SMTP: $errstr ($errno)"];
    }

    stream_set_timeout($fp, SMTP_TIMEOUT);

    $r = smtpExpect($fp, [220]);
    if (!$r['ok']) return ['ok' => false, 'error' => 'SMTP saludo inválido: ' . $r['response']];

    smtpWrite($fp, "EHLO localhost\r\n");
    $r = smtpExpect($fp, [250]);
    if (!$r['ok']) return ['ok' => false, 'error' => 'EHLO falló: ' . $r['response']];

    smtpWrite($fp, "AUTH LOGIN\r\n");
    $r = smtpExpect($fp, [334]);
    if (!$r['ok']) return ['ok' => false, 'error' => 'AUTH LOGIN falló: ' . $r['response']];

    smtpWrite($fp, base64_encode($usuario) . "\r\n");
    $r = smtpExpect($fp, [334]);
    if (!$r['ok']) return ['ok' => false, 'error' => 'Usuario SMTP rechazado: ' . $r['response']];

    smtpWrite($fp, base64_encode($password) . "\r\n");
    $r = smtpExpect($fp, [235]);
    if (!$r['ok']) return ['ok' => false, 'error' => 'Password SMTP rechazada: ' . $r['response']];

    smtpWrite($fp, "MAIL FROM:<$from>\r\n");
    $r = smtpExpect($fp, [250]);
    if (!$r['ok']) return ['ok' => false, 'error' => 'MAIL FROM falló: ' . $r['response']];

    smtpWrite($fp, "RCPT TO:<$to>\r\n");
    $r = smtpExpect($fp, [250, 251]);
    if (!$r['ok']) return ['ok' => false, 'error' => 'RCPT TO falló: ' . $r['response']];

    smtpWrite($fp, "DATA\r\n");
    $r = smtpExpect($fp, [354]);
    if (!$r['ok']) return ['ok' => false, 'error' => 'DATA falló: ' . $r['response']];

    $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
    $headers = [];
    $headers[] = "From: <$from>";
    $headers[] = "To: <$to>";
    $headers[] = "Subject: $encodedSubject";
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-Type: text/plain; charset=UTF-8";
    $headers[] = "Content-Transfer-Encoding: 8bit";
    $headers[] = "Date: " . date(DATE_RFC2822);
    $headers[] = "X-Mailer: jocarsa-email-php";

    $body = str_replace("\r\n.\r\n", "\r\n..\r\n", normalizarCRLF($body));
    $payload = implode("\r\n", $headers) . "\r\n\r\n" . $body . "\r\n.\r\n";

    smtpWrite($fp, $payload);
    $r = smtpExpect($fp, [250]);
    if (!$r['ok']) return ['ok' => false, 'error' => 'Envío DATA falló: ' . $r['response']];

    smtpWrite($fp, "QUIT\r\n");
    smtpExpect($fp, [221]);
    fclose($fp);

    return ['ok' => true];
}

/* =========================================================
   SESSION / AUTH
========================================================= */
function logout(): void {
    unset($_SESSION['auth']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_GET['logout'])) {
    logout();
}

$error = '';
$info = '';
$loginEmail = '';
$vista = $_GET['vista'] ?? 'lectura';

/* =========================================================
   LOGIN
========================================================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'login') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $imapServerInput = trim($_POST['imap_server'] ?? '');
    $smtpServerInput = trim($_POST['smtp_server'] ?? '');

    $loginEmail = $email;

    if ($email === '' || $password === '') {
        $error = 'Debes introducir usuario y contraseña.';
    } else {
        $cuenta = getCuentaByEmail($email);

        if ($cuenta) {
            $imapServer = $cuenta['imap_server'];
            $smtpServer = $cuenta['smtp_server'];
        } else {
            if ($imapServerInput === '' || $smtpServerInput === '') {
                $error = 'Es el primer acceso de esta cuenta. Debes indicar servidor IMAP y SMTP.';
            } else {
                $imapServer = $imapServerInput;
                $smtpServer = $smtpServerInput;
            }
        }

        if ($error === '') {
            $conexion = conectarImap($email, $password, $imapServer);

            if (!$conexion['ok']) {
                $error = 'Login incorrecto o error de conexión IMAP: ' . $conexion['error'];
            } else {
                @imap_close($conexion['imap']);

                if (!$cuenta) {
                    saveCuenta($email, $imapServer, $smtpServer);
                }

                $_SESSION['auth'] = [
                    'email'       => $email,
                    'password'    => $password,
                    'imap_server' => $imapServer,
                    'smtp_server' => $smtpServer
                ];

                $sync = syncMensajesDesdeServidor($email, $password, $imapServer, 50);
                if ($sync['ok']) {
                    $info = 'Inicio de sesión correcto. Sincronizados ' . (int)$sync['count'] . ' mensajes.';
                } else {
                    $info = 'Inicio de sesión correcto, pero la sincronización inicial ha fallado: ' . $sync['error'];
                }
            }
        }
    }
}

/* =========================================================
   AUTH REQUIRED ACTIONS
========================================================= */
if (isset($_SESSION['auth']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = $_SESSION['auth'];

    if (($_POST['action'] ?? '') === 'sync') {
        $sync = syncMensajesDesdeServidor($auth['email'], $auth['password'], $auth['imap_server'], 50);
        if ($sync['ok']) {
            $info = 'Sincronización completada. Mensajes procesados: ' . (int)$sync['count'] . '.';
        } else {
            $error = 'No se pudo sincronizar: ' . $sync['error'];
        }
    }

    if (($_POST['action'] ?? '') === 'send') {
        $to = trim($_POST['to'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $body = trim($_POST['body'] ?? '');

        if ($to === '' || $subject === '' || $body === '') {
            $error = 'Para enviar un correo debes completar destinatario, asunto y mensaje.';
            $vista = 'nuevo';
        } else {
            $envio = smtpEnviarSSL(
                $auth['smtp_server'],
                SMTP_PORT_SSL,
                $auth['email'],
                $auth['password'],
                $auth['email'],
                emailSoloDireccion($to),
                $subject,
                $body
            );

            if ($envio['ok']) {
                $info = 'Correo enviado correctamente.';
                $vista = 'lectura';

                saveOrUpdateMensaje([
                    'cuenta_email' => $auth['email'],
                    'carpeta'      => 'SENT',
                    'uid'          => time(),
                    'msgno'        => 0,
                    'asunto'       => $subject,
                    'remitente'    => $auth['email'],
                    'destinatario' => $to,
                    'fecha_raw'    => date(DATE_RFC2822),
                    'fecha_unix'   => time(),
                    'cuerpo'       => $body,
                    'resumen'      => resumenTexto($body),
                    'visto'        => 1,
                    'message_id'   => '',
                ]);
            } else {
                $error = $envio['error'];
                $vista = 'nuevo';
            }
        }
    }
}

/* =========================================================
   DATA FOR UI
========================================================= */
$mensajes = [];
$mensajeSeleccionado = null;

if (isset($_SESSION['auth'])) {
    $auth = $_SESSION['auth'];
    $mensajes = getMensajesDb($auth['email'], 100);

    $selectedId = isset($_GET['msg']) ? (int)$_GET['msg'] : 0;
    if ($selectedId > 0) {
        $mensajeSeleccionado = getMensajeDbById($auth['email'], $selectedId);
    }

    if (!$mensajeSeleccionado && !empty($mensajes)) {
        $mensajeSeleccionado = $mensajes[0];
    }
}

$cuentaExistente = $loginEmail !== '' ? getCuentaByEmail($loginEmail) : null;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>jocarsa | email</title>
    <style>
        html,body{
            padding:0;
            margin:0;
            width:100%;
            height:100%;
            font-family:Arial,sans-serif;
            background:#f3f4f6;
            color:#1f2937;
        }
        *{box-sizing:border-box;}

        body{
            display:flex;
            flex-direction:column;
            overflow:hidden;
        }

        #topbar{
            height:68px;
            background:linear-gradient(90deg,#1e293b,#334155);
            color:white;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:0 20px;
            border-bottom:1px solid rgba(255,255,255,0.08);
            flex:0 0 auto;
        }

        #marca{
            display:flex;
            flex-direction:column;
            gap:2px;
        }

        #marca h1{
            margin:0;
            font-size:20px;
            font-weight:700;
            letter-spacing:0.3px;
        }

        #marca p{
            margin:0;
            font-size:12px;
            color:rgba(255,255,255,0.72);
        }

        #herramientas{
            display:flex;
            align-items:center;
            gap:10px;
            flex-wrap:wrap;
        }

        .toolbtn, .toolbtn-link{
            border:none;
            background:rgba(255,255,255,0.10);
            color:white;
            padding:10px 14px;
            border-radius:10px;
            font-weight:600;
            cursor:pointer;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            gap:8px;
            transition:all 0.2s;
        }

        .toolbtn:hover, .toolbtn-link:hover{
            background:rgba(255,255,255,0.18);
        }

        .toolbtn.primario, .toolbtn-link.primario{
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
        }

        .toolbtn.primario:hover, .toolbtn-link.primario:hover{
            filter:brightness(1.05);
        }

        #app{
            flex:1;
            display:flex;
            min-height:0;
            min-width:0;
            overflow:hidden;
        }

        #bandejas{
            width:240px;
            background:linear-gradient(180deg,#2f3640,#3a4250);
            display:flex;
            flex-direction:column;
            gap:12px;
            overflow:auto;
            padding:20px;
            border-right:1px solid #d9dde3;
        }

        #bandejas a, #bandejas .item{
            color:white;
            text-decoration:none;
            background:rgba(255,255,255,0.08);
            padding:14px 16px;
            display:block;
            border-radius:10px;
            transition:all 0.3s;
            font-weight:bold;
        }

        #bandejas a:hover{
            background:rgba(255,255,255,0.18);
            transform:translateX(4px);
        }

        #bandejas .cuenta{
            margin-top:auto;
            background:rgba(255,255,255,0.04);
            color:#dbeafe;
            font-size:13px;
            line-height:1.6;
        }

        #mensajes{
            width:380px;
            background:#eceff3;
            display:flex;
            flex-direction:column;
            gap:14px;
            overflow-y:auto;
            min-width:0;
            min-height:0;
            padding:20px;
            border-right:1px solid #d9dde3;
        }

        #mensajes article{
            background:white;
            padding:16px;
            border-radius:12px;
            box-shadow:0 2px 8px rgba(0,0,0,0.06);
            transition:all 0.3s;
            cursor:pointer;
            border:1px solid #e5e7eb;
            flex:0 0 auto;
        }

        #mensajes article:hover{
            transform:translateY(-2px);
            box-shadow:0 8px 20px rgba(0,0,0,0.08);
        }

        #mensajes article.activo{
            border-color:#60a5fa;
            box-shadow:0 0 0 4px rgba(96,165,250,0.12);
        }

        #mensajes a{
            color:inherit;
            text-decoration:none;
            display:block;
        }

        #mensajes h3{
            margin:0 0 8px 0;
            font-size:16px;
            color:#111827;
        }

        #mensajes time{
            font-size:12px;
            color:#6b7280;
            display:block;
            margin-bottom:8px;
        }

        #mensajes p{
            margin:0;
            color:#4b5563;
            font-size:14px;
            line-height:1.45;
        }

        #contenido{
            flex:1;
            background:#f8fafc;
            display:flex;
            flex-direction:column;
            overflow:hidden;
            min-width:0;
            min-height:0;
        }

        #cabecera-contenido{
            padding:20px 24px;
            border-bottom:1px solid #d9dde3;
            background:white;
            flex:0 0 auto;
        }

        #cabecera-contenido h2{
            margin:0 0 6px 0;
            font-size:22px;
            font-weight:600;
            color:#111827;
        }

        #cabecera-contenido p{
            margin:0;
            font-size:13px;
            color:#6b7280;
        }

        #panel{
            flex:1;
            overflow-y:auto;
            padding:24px;
            min-height:0;
        }

        .email{
            max-width:920px;
            background:white;
            border:1px solid #dfe4ea;
            border-radius:14px;
            box-shadow:0 4px 12px rgba(0,0,0,0.05);
            overflow:hidden;
        }

        .email-header{
            padding:14px 18px;
            background:#f8fafc;
            border-bottom:1px solid #e5e7eb;
        }

        .email-header .linea1{
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            gap:20px;
            margin-bottom:6px;
        }

        .email-header strong{
            font-size:14px;
            color:#111827;
            word-break:break-word;
        }

        .email-header time{
            font-size:12px;
            color:#6b7280;
            white-space:nowrap;
            margin:0;
        }

        .email-header .meta{
            font-size:12px;
            color:#6b7280;
            line-height:1.5;
            word-break:break-word;
        }

        .email-cuerpo{
            padding:18px;
            font-size:14px;
            line-height:1.7;
            color:#374151;
            word-break:break-word;
            white-space:pre-wrap;
        }

        .compose{
            max-width:920px;
            background:white;
            border:1px solid #dfe4ea;
            border-radius:14px;
            box-shadow:0 4px 12px rgba(0,0,0,0.05);
            overflow:hidden;
        }

        .compose-head{
            padding:18px 20px;
            border-bottom:1px solid #e5e7eb;
            background:#f8fafc;
        }

        .compose-head h3{
            margin:0;
            font-size:18px;
            color:#111827;
        }

        .compose-body{
            padding:20px;
        }

        .grupo{
            margin-bottom:16px;
        }

        .grupo label{
            display:block;
            font-size:13px;
            font-weight:bold;
            color:#374151;
            margin-bottom:8px;
        }

        .grupo input, .grupo textarea{
            width:100%;
            padding:13px 14px;
            border:1px solid #d1d5db;
            border-radius:10px;
            background:#f9fafb;
            font-size:14px;
            outline:none;
            transition:all 0.2s;
            font-family:Arial,sans-serif;
        }

        .grupo input:focus, .grupo textarea:focus{
            border-color:#60a5fa;
            background:white;
            box-shadow:0 0 0 4px rgba(96,165,250,0.12);
        }

        .grupo textarea{
            min-height:320px;
            resize:vertical;
            line-height:1.6;
        }

        .acciones-compose{
            display:flex;
            gap:10px;
            justify-content:flex-end;
        }

        .msg{
            margin:0 0 16px 0;
            padding:12px 14px;
            border-radius:10px;
            font-size:14px;
        }

        .msg.error{
            background:#fef2f2;
            color:#991b1b;
            border:1px solid #fecaca;
        }

        .msg.ok{
            background:#f0fdf4;
            color:#166534;
            border:1px solid #bbf7d0;
        }

        .vacio{
            color:#6b7280;
            font-size:14px;
            padding:20px;
        }

        #login-wrap{
            width:100%;
            height:100%;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:24px;
            background:
                linear-gradient(135deg,rgba(59,130,246,0.06),rgba(16,185,129,0.05)),
                #f8fafc;
        }

        .tarjeta-login{
            width:100%;
            max-width:520px;
            background:white;
            border:1px solid #e5e7eb;
            border-radius:18px;
            box-shadow:0 16px 40px rgba(0,0,0,0.08);
            padding:28px;
        }

        .tarjeta-login h3{
            margin:0 0 8px 0;
            font-size:24px;
            color:#111827;
        }

        .tarjeta-login .subtitulo{
            margin:0 0 24px 0;
            font-size:14px;
            color:#6b7280;
            line-height:1.5;
        }

        .doble{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:16px;
        }

        .acciones{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:12px;
            margin-top:24px;
        }

        .estado{
            font-size:12px;
            color:#6b7280;
        }

        .boton{
            border:none;
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
            color:white;
            padding:13px 18px;
            border-radius:10px;
            font-weight:bold;
            cursor:pointer;
            box-shadow:0 8px 20px rgba(37,99,235,0.25);
        }

        @media (max-width:1100px){
            #mensajes{width:320px;}
            #bandejas{width:210px;}
        }
    </style>
</head>
<body>

<?php if (!isset($_SESSION['auth'])): ?>

    <div id="topbar">
        <div id="marca">
            <h1>jocarsa | email</h1>
            <p>Cliente de correo en PHP + SQLite</p>
        </div>
        <div id="herramientas"></div>
    </div>

    <div id="login-wrap">
        <form class="tarjeta-login" method="post" action="">
            <input type="hidden" name="action" value="login">

            <h3>Iniciar sesión</h3>
            <p class="subtitulo">
                En el primer acceso se guardan el servidor IMAP y SMTP en SQLite. La contraseña no se almacena y se pedirá en cada inicio de sesión.
            </p>

            <?php if ($error !== ''): ?>
                <div class="msg error"><?= h($error) ?></div>
            <?php endif; ?>

            <?php if ($info !== ''): ?>
                <div class="msg ok"><?= h($info) ?></div>
            <?php endif; ?>

            <div class="grupo">
                <label>Usuario</label>
                <input type="email" name="email" value="<?= h($loginEmail) ?>" placeholder="usuario@midominio.com" required>
            </div>

            <div class="grupo">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Tu contraseña" required>
            </div>

            <?php if ($cuentaExistente): ?>
                <div class="msg ok">
                    Cuenta reconocida.<br>
                    IMAP: <strong><?= h($cuentaExistente['imap_server']) ?></strong><br>
                    SMTP: <strong><?= h($cuentaExistente['smtp_server']) ?></strong>
                </div>
            <?php endif; ?>

            <div class="doble">
                <div class="grupo">
                    <label>Servidor IMAP</label>
                    <input type="text" name="imap_server" placeholder="imap.midominio.com" <?= $cuentaExistente ? 'disabled' : '' ?>>
                </div>
                <div class="grupo">
                    <label>Servidor SMTP</label>
                    <input type="text" name="smtp_server" placeholder="smtp.midominio.com" <?= $cuentaExistente ? 'disabled' : '' ?>>
                </div>
            </div>

            <div class="acciones">
                <div class="estado">jocarsa | email</div>
                <button class="boton" type="submit">Conectar</button>
            </div>
        </form>
    </div>

<?php else: ?>

    <?php $auth = $_SESSION['auth']; ?>

    <div id="topbar">
        <div id="marca">
            <h1>jocarsa | email</h1>
            <p><?= h($auth['email']) ?> · IMAP <?= h($auth['imap_server']) ?> · SMTP <?= h($auth['smtp_server']) ?></p>
        </div>

        <div id="herramientas">
            <form method="post" style="margin:0;">
                <input type="hidden" name="action" value="sync">
                <button class="toolbtn" type="submit">⟳ Sincronizar</button>
            </form>

            <a class="toolbtn primario" href="?vista=nuevo">✉ Nuevo correo</a>
            <a class="toolbtn-link" href="?">📥 Bandeja</a>
            <a class="toolbtn-link" href="?logout=1">⎋ Cerrar sesión</a>
        </div>
    </div>

    <div id="app">
        <div id="bandejas">
            <a href="?">Recibidos</a>
            <a href="#">Enviados</a>
            <a href="#">Papelera</a>
            <a href="#">No deseado</a>

            <div class="item cuenta">
                <strong><?= h($auth['email']) ?></strong><br>
                Los mensajes visibles en la columna central se leen desde SQLite.<br>
                El botón de sincronización actualiza la base de datos local.
            </div>
        </div>

        <div id="mensajes">
            <?php if (empty($mensajes)): ?>
                <div class="vacio">No hay mensajes guardados en la base de datos local.</div>
            <?php else: ?>
                <?php foreach ($mensajes as $m): ?>
                    <article class="<?= ($mensajeSeleccionado && (int)$mensajeSeleccionado['id'] === (int)$m['id'] && $vista !== 'nuevo') ? 'activo' : '' ?>">
                        <a href="?msg=<?= (int)$m['id'] ?>">
                            <h3><?= h($m['asunto']) ?></h3>
                            <time><?= h(date('Y-m-d H:i', (int)$m['fecha_unix'])) ?></time>
                            <p>
                                <strong><?= h($m['remitente']) ?></strong><br>
                                <?= h($m['resumen']) ?>
                            </p>
                        </a>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div id="contenido">
            <?php if ($vista === 'nuevo'): ?>
                <div id="cabecera-contenido">
                    <h2>Nuevo correo</h2>
                    <p>Composición y envío mediante SMTP usando PHP nativo</p>
                </div>

                <div id="panel">
                    <form class="compose" method="post">
                        <input type="hidden" name="action" value="send">

                        <div class="compose-head">
                            <h3>Redactar mensaje</h3>
                        </div>

                        <div class="compose-body">
                            <?php if ($error !== ''): ?>
                                <div class="msg error"><?= h($error) ?></div>
                            <?php endif; ?>

                            <?php if ($info !== ''): ?>
                                <div class="msg ok"><?= h($info) ?></div>
                            <?php endif; ?>

                            <div class="grupo">
                                <label>Para</label>
                                <input type="text" name="to" placeholder="destinatario@dominio.com" value="<?= h($_POST['to'] ?? '') ?>">
                            </div>

                            <div class="grupo">
                                <label>Asunto</label>
                                <input type="text" name="subject" placeholder="Asunto del mensaje" value="<?= h($_POST['subject'] ?? '') ?>">
                            </div>

                            <div class="grupo">
                                <label>Mensaje</label>
                                <textarea name="body" placeholder="Escribe aquí tu mensaje"><?= h($_POST['body'] ?? '') ?></textarea>
                            </div>

                            <div class="acciones-compose">
                                <a class="toolbtn-link" href="?">Cancelar</a>
                                <button class="toolbtn primario" type="submit">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>

            <?php else: ?>
                <div id="cabecera-contenido">
                    <h2><?= $mensajeSeleccionado ? h($mensajeSeleccionado['asunto']) : 'Sin mensaje seleccionado' ?></h2>
                    <p>
                        <?= $mensajeSeleccionado
                            ? 'Contenido cargado desde SQLite'
                            : 'Selecciona un mensaje de la columna central' ?>
                    </p>
                </div>

                <div id="panel">
                    <?php if ($error !== ''): ?>
                        <div class="msg error"><?= h($error) ?></div>
                    <?php endif; ?>

                    <?php if ($info !== ''): ?>
                        <div class="msg ok"><?= h($info) ?></div>
                    <?php endif; ?>

                    <?php if ($mensajeSeleccionado): ?>
                        <div class="email">
                            <div class="email-header">
                                <div class="linea1">
                                    <strong><?= h($mensajeSeleccionado['asunto']) ?></strong>
                                    <time><?= h(date('Y-m-d H:i', (int)$mensajeSeleccionado['fecha_unix'])) ?></time>
                                </div>
                                <div class="meta">
                                    <strong>De:</strong> <?= h($mensajeSeleccionado['remitente']) ?><br>
                                    <strong>Para:</strong> <?= h($mensajeSeleccionado['destinatario']) ?><br>
                                    <strong>Carpeta:</strong> <?= h($mensajeSeleccionado['carpeta']) ?>
                                </div>
                            </div>
                            <div class="email-cuerpo"><?= h($mensajeSeleccionado['cuerpo']) ?></div>
                        </div>
                    <?php else: ?>
                        <div class="vacio">No hay contenido para mostrar.</div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>

</body>
</html>
