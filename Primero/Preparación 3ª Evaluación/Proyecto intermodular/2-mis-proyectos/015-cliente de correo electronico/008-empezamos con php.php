<?php
session_start();

/*
    Cliente de correo mockup/simple en PHP + SQLite + IMAP nativo
    Requisitos:
    - PHP con extensiones pdo_sqlite y imap habilitadas
    - No usa librerías externas
*/

date_default_timezone_set('Europe/Madrid');

/* =========================================================
   CONFIG
========================================================= */
define('DB_FILE', __DIR__ . '/correo.sqlite');

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
    }
    return $pdo;
}

function getCuentaByEmail(string $email): ?array {
    $stmt = db()->prepare("SELECT * FROM cuentas WHERE lower(email) = lower(?) LIMIT 1");
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
            SET imap_server = ?, smtp_server = ?, updated_at = ?
            WHERE lower(email) = lower(?)
        ");
        $stmt->execute([$imap, $smtp, $ahora, $email]);
    } else {
        $stmt = db()->prepare("
            INSERT INTO cuentas (email, imap_server, smtp_server, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$email, $imap, $smtp, $ahora, $ahora]);
    }
}

/* =========================================================
   HELPERS
========================================================= */
function h(?string $txt): string {
    return htmlspecialchars((string)$txt, ENT_QUOTES, 'UTF-8');
}

function limpiarTextoPlano(string $texto): string {
    $texto = quoted_printable_decode($texto);
    $texto = html_entity_decode($texto, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return trim($texto);
}

function decodeMimeStr(string $string, string $charset = 'UTF-8'): string {
    $elements = imap_mime_header_decode($string);
    $out = '';
    foreach ($elements as $el) {
        $fromCharset = $el->charset;
        $text = $el->text;

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
    $addresses = imap_rfc822_parse_adrlist($header, '');
    $salida = [];

    foreach ($addresses as $addr) {
        $mailbox = $addr->mailbox ?? '';
        $host = $addr->host ?? '';
        $email = ($mailbox && $host && $host !== '.SYNTAX-ERROR.') ? ($mailbox . '@' . $host) : '';
        $nombre = '';

        if (isset($addr->personal) && $addr->personal !== '') {
            $nombre = decodeMimeStr($addr->personal);
        }

        if ($nombre && $email) {
            $salida[] = $nombre . ' <' . $email . '>';
        } elseif ($email) {
            $salida[] = $email;
        } elseif ($nombre) {
            $salida[] = $nombre;
        }
    }

    return implode(', ', $salida);
}

function getPartBody($imap, int $msgNo, stdClass $structure, string $partNumber = ''): array {
    $result = [
        'plain' => '',
        'html' => ''
    ];

    if (!isset($structure->type)) {
        return $result;
    }

    if ($structure->type == 0) {
        $body = $partNumber === ''
            ? imap_body($imap, $msgNo, FT_PEEK)
            : imap_fetchbody($imap, $msgNo, $partNumber, FT_PEEK);

        if (isset($structure->encoding)) {
            switch ($structure->encoding) {
                case 3: $body = base64_decode($body); break;
                case 4: $body = quoted_printable_decode($body); break;
            }
        }

        $subtype = strtoupper($structure->subtype ?? 'PLAIN');
        if ($subtype === 'PLAIN') {
            $result['plain'] .= $body;
        } elseif ($subtype === 'HTML') {
            $result['html'] .= $body;
        }

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
    $structure = imap_fetchstructure($imap, $msgNo);
    if (!$structure) {
        return '';
    }

    $bodies = getPartBody($imap, $msgNo, $structure);

    if (trim($bodies['plain']) !== '') {
        return limpiarTextoPlano($bodies['plain']);
    }

    if (trim($bodies['html']) !== '') {
        $html = $bodies['html'];
        $html = quoted_printable_decode($html);
        $text = strip_tags($html);
        return trim(html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }

    return '';
}

function conectarImap(string $email, string $password, string $imapServer, int $port = 993, string $flags = '/imap/ssl'): array {
    $mailbox = '{' . $imapServer . ':' . $port . $flags . '}INBOX';

    $imap = @imap_open($mailbox, $email, $password);
    if (!$imap) {
        $error = imap_last_error();
        return ['ok' => false, 'error' => $error ?: 'No se pudo conectar al servidor IMAP'];
    }

    return ['ok' => true, 'imap' => $imap, 'mailbox' => $mailbox];
}

function cargarMensajes($imap, int $limit = 20): array {
    $mensajes = [];
    $num = imap_num_msg($imap);

    if ($num < 1) {
        return $mensajes;
    }

    $inicio = max(1, $num - $limit + 1);

    for ($i = $num; $i >= $inicio; $i--) {
        $overviewArr = imap_fetch_overview($imap, (string)$i, 0);
        if (!$overviewArr || !isset($overviewArr[0])) {
            continue;
        }

        $ov = $overviewArr[0];
        $header = imap_headerinfo($imap, $i);

        $subject = isset($ov->subject) ? decodeMimeStr($ov->subject) : '(Sin asunto)';
        $from = isset($header->fromaddress) ? parseAddressHeader($header->fromaddress) : '';
        $to = isset($header->toaddress) ? parseAddressHeader($header->toaddress) : '';
        $dateRaw = $ov->date ?? '';
        $timestamp = $dateRaw ? strtotime($dateRaw) : time();

        $body = extractMessageBody($imap, $i);
        $snippet = mb_substr(preg_replace('/\s+/', ' ', $body), 0, 160);

        $mensajes[] = [
            'msgno' => $i,
            'uid' => imap_uid($imap, $i),
            'subject' => $subject !== '' ? $subject : '(Sin asunto)',
            'from' => $from,
            'to' => $to,
            'date' => $timestamp ? date('Y-m-d H:i', $timestamp) : '',
            'body' => $body,
            'snippet' => $snippet,
            'seen' => !empty($ov->seen),
        ];
    }

    return $mensajes;
}

function logout(): void {
    unset($_SESSION['auth']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

/* =========================================================
   LOGOUT
========================================================= */
if (isset($_GET['logout'])) {
    logout();
}

/* =========================================================
   LOGIN
========================================================= */
$error = '';
$loginEmail = '';
$mensajes = [];
$mensajeSeleccionado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
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
                if (!$cuenta) {
                    saveCuenta($email, $imapServer, $smtpServer);
                }

                $_SESSION['auth'] = [
                    'email' => $email,
                    'imap_server' => $imapServer,
                    'smtp_server' => $smtpServer,
                    'password' => $password
                ];

                imap_close($conexion['imap']);
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            }
        }
    }
}

/* =========================================================
   APP AUTHENTICATED
========================================================= */
if (isset($_SESSION['auth'])) {
    $auth = $_SESSION['auth'];

    $conexion = conectarImap(
        $auth['email'],
        $auth['password'],
        $auth['imap_server']
    );

    if (!$conexion['ok']) {
        $error = 'La sesión ha expirado o no se ha podido reconectar al buzón: ' . $conexion['error'];
        unset($_SESSION['auth']);
    } else {
        $imap = $conexion['imap'];
        $mensajes = cargarMensajes($imap, 25);

        $msgnoSeleccionado = isset($_GET['msg']) ? (int)$_GET['msg'] : 0;

        if ($msgnoSeleccionado > 0) {
            foreach ($mensajes as $m) {
                if ((int)$m['msgno'] === $msgnoSeleccionado) {
                    $mensajeSeleccionado = $m;
                    break;
                }
            }
        }

        if (!$mensajeSeleccionado && !empty($mensajes)) {
            $mensajeSeleccionado = $mensajes[0];
        }

        imap_close($imap);
    }
}

/* =========================================================
   UI
========================================================= */
$cuentaExistente = $loginEmail !== '' ? getCuentaByEmail($loginEmail) : null;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Cliente de correo PHP</title>
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
        body{display:flex;overflow:hidden;}
        body>div{
            border-right:1px solid #d9dde3;
            padding:20px;
            min-width:0;
            min-height:0;
        }

        #bandejas{
            width:240px;
            background:linear-gradient(180deg,#2f3640,#3a4250);
            display:flex;
            flex-direction:column;
            gap:12px;
            overflow:auto;
        }
        #bandejas a,#bandejas .item{
            color:white;
            text-decoration:none;
            background:rgba(255,255,255,0.08);
            padding:14px 16px;
            display:block;
            border-radius:10px;
            transition:all 0.3s;
            font-weight:bold;
        }
        #bandejas a:hover{background:rgba(255,255,255,0.18);transform:translateX(4px);}
        #bandejas .cuenta{
            margin-top:auto;
            background:rgba(255,255,255,0.04);
            color:#dbeafe;
            font-size:13px;
            line-height:1.5;
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
            line-height:1.4;
        }

        #conversacion{
            flex:1;
            background:#f8fafc;
            padding:0;
            display:flex;
            flex-direction:column;
            overflow:hidden;
            min-width:0;
            min-height:0;
            border-right:none;
        }
        #cabecera-conversacion{
            padding:20px 24px;
            border-bottom:1px solid #d9dde3;
            background:white;
            flex:0 0 auto;
        }
        #cabecera-conversacion h2{
            margin:0 0 6px 0;
            font-size:22px;
            font-weight:600;
            color:#111827;
        }
        #cabecera-conversacion p{
            margin:0;
            font-size:13px;
            color:#6b7280;
        }
        #hilo{
            flex:1;
            overflow-y:auto;
            padding:24px;
            display:flex;
            flex-direction:column;
            gap:18px;
            min-height:0;
        }
        .email{
            max-width:900px;
            background:white;
            border:1px solid #dfe4ea;
            border-radius:14px;
            box-shadow:0 4px 12px rgba(0,0,0,0.05);
            overflow:hidden;
            flex:0 0 auto;
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
        .grupo{margin-bottom:18px;}
        .grupo label{
            display:block;
            font-size:13px;
            font-weight:bold;
            color:#374151;
            margin-bottom:8px;
        }
        .grupo input{
            width:100%;
            padding:13px 14px;
            border:1px solid #d1d5db;
            border-radius:10px;
            background:#f9fafb;
            font-size:14px;
            outline:none;
            transition:all 0.2s;
        }
        .grupo input:focus{
            border-color:#60a5fa;
            background:white;
            box-shadow:0 0 0 4px rgba(96,165,250,0.12);
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
        .estado{font-size:12px;color:#6b7280;}
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
        .error{
            margin:0 0 18px 0;
            padding:12px 14px;
            background:#fef2f2;
            color:#991b1b;
            border:1px solid #fecaca;
            border-radius:10px;
            font-size:14px;
        }
        .ok{
            margin:0 0 18px 0;
            padding:12px 14px;
            background:#f0fdf4;
            color:#166534;
            border:1px solid #bbf7d0;
            border-radius:10px;
            font-size:14px;
        }
        .vacio{
            color:#6b7280;
            font-size:14px;
            padding:20px;
        }
        .logout{
            color:white;
            text-decoration:none;
            display:inline-block;
            margin-top:10px;
            font-size:13px;
            opacity:0.85;
        }
        .logout:hover{opacity:1;}
    </style>
</head>
<body>

<?php if (!isset($_SESSION['auth'])): ?>
    <div id="login-wrap">
        <form class="tarjeta-login" method="post" action="">
            <input type="hidden" name="action" value="login">

            <h3>Iniciar sesión</h3>
            <p class="subtitulo">
                Si es la primera vez que accedes con esta cuenta, indica también los servidores IMAP y SMTP.
                En accesos posteriores, se recuperarán desde SQLite y solo se pedirá la contraseña.
            </p>

            <?php if ($error !== ''): ?>
                <div class="error"><?= h($error) ?></div>
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
                <div class="ok">
                    Cuenta reconocida. Se usarán estos servidores guardados:
                    <br>IMAP: <strong><?= h($cuentaExistente['imap_server']) ?></strong>
                    <br>SMTP: <strong><?= h($cuentaExistente['smtp_server']) ?></strong>
                </div>
            <?php endif; ?>

            <div class="doble">
                <div class="grupo">
                    <label>Servidor IMAP</label>
                    <input
                        type="text"
                        name="imap_server"
                        placeholder="imap.midominio.com"
                        <?= $cuentaExistente ? 'disabled' : '' ?>
                    >
                </div>
                <div class="grupo">
                    <label>Servidor SMTP</label>
                    <input
                        type="text"
                        name="smtp_server"
                        placeholder="smtp.midominio.com"
                        <?= $cuentaExistente ? 'disabled' : '' ?>
                    >
                </div>
            </div>

            <div class="acciones">
                <div class="estado">SQLite + IMAP nativo</div>
                <button class="boton" type="submit">Conectar</button>
            </div>
        </form>
    </div>

<?php else: ?>
    <?php $auth = $_SESSION['auth']; ?>

    <div id="bandejas">
        <a href="#">Recibidos</a>
        <a href="#">Enviados</a>
        <a href="#">Papelera</a>
        <a href="#">No deseado</a>

        <div class="item cuenta">
            <strong><?= h($auth['email']) ?></strong><br>
            IMAP: <?= h($auth['imap_server']) ?><br>
            SMTP: <?= h($auth['smtp_server']) ?><br>
            <a class="logout" href="?logout=1">Cerrar sesión</a>
        </div>
    </div>

    <div id="mensajes">
        <?php if (empty($mensajes)): ?>
            <div class="vacio">No se han encontrado mensajes en la bandeja de entrada.</div>
        <?php else: ?>
            <?php foreach ($mensajes as $m): ?>
                <article class="<?= ($mensajeSeleccionado && $mensajeSeleccionado['msgno'] == $m['msgno']) ? 'activo' : '' ?>">
                    <a href="?msg=<?= (int)$m['msgno'] ?>">
                        <h3><?= h($m['subject']) ?></h3>
                        <time><?= h($m['date']) ?></time>
                        <p>
                            <strong><?= h($m['from']) ?></strong><br>
                            <?= h($m['snippet']) ?>
                        </p>
                    </a>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div id="conversacion">
        <div id="cabecera-conversacion">
            <h2><?= $mensajeSeleccionado ? h($mensajeSeleccionado['subject']) : 'Sin mensaje seleccionado' ?></h2>
            <p>
                <?= $mensajeSeleccionado ? 'Visualización del mensaje seleccionado desde la columna central' : 'Selecciona un mensaje en la columna central' ?>
            </p>
        </div>

        <div id="hilo">
            <?php if ($mensajeSeleccionado): ?>
                <div class="email">
                    <div class="email-header">
                        <div class="linea1">
                            <strong><?= h($mensajeSeleccionado['subject']) ?></strong>
                            <time><?= h($mensajeSeleccionado['date']) ?></time>
                        </div>
                        <div class="meta">
                            <strong>De:</strong> <?= h($mensajeSeleccionado['from']) ?><br>
                            <strong>Para:</strong> <?= h($mensajeSeleccionado['to']) ?>
                        </div>
                    </div>
                    <div class="email-cuerpo"><?= h($mensajeSeleccionado['body']) ?></div>
                </div>
            <?php else: ?>
                <div class="vacio">No hay contenido para mostrar.</div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

</body>
</html>
