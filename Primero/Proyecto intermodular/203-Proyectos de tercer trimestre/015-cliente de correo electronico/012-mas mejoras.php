<?php
session_start();
date_default_timezone_set('Europe/Madrid');

/*
    jocarsa | email
    Cliente de correo en PHP + SQLite + IMAP/SMTP nativo

    Requisitos:
    - extension=pdo_sqlite
    - extension=imap
*/

define('DB_FILE', __DIR__ . '/correo.sqlite');
define('IMAP_PORT', 993);
define('IMAP_FLAGS', '/imap/ssl');
define('SMTP_PORT_TLS', 587);
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
                in_reply_to TEXT,
                references_header TEXT,
                thread_key TEXT,
                created_at TEXT NOT NULL,
                updated_at TEXT NOT NULL,
                UNIQUE(cuenta_email, carpeta, uid)
            )
        ");

        $pdo->exec("CREATE INDEX IF NOT EXISTS idx_mensajes_cuenta_fecha ON mensajes(cuenta_email, fecha_unix DESC)");
        $pdo->exec("CREATE INDEX IF NOT EXISTS idx_mensajes_carpeta ON mensajes(cuenta_email, carpeta, fecha_unix DESC)");
        $pdo->exec("CREATE INDEX IF NOT EXISTS idx_mensajes_thread ON mensajes(cuenta_email, thread_key, fecha_unix DESC)");

        migrarColumnaSiNoExiste($pdo, 'mensajes', 'in_reply_to', 'TEXT');
        migrarColumnaSiNoExiste($pdo, 'mensajes', 'references_header', 'TEXT');
        migrarColumnaSiNoExiste($pdo, 'mensajes', 'thread_key', 'TEXT');
    }

    return $pdo;
}

function migrarColumnaSiNoExiste(PDO $pdo, string $tabla, string $columna, string $tipo): void {
    $stmt = $pdo->query("PRAGMA table_info($tabla)");
    $cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($cols as $col) {
        if (($col['name'] ?? '') === $columna) {
            return;
        }
    }
    $pdo->exec("ALTER TABLE $tabla ADD COLUMN $columna $tipo");
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
            fecha_raw, fecha_unix, cuerpo, resumen, visto, message_id,
            in_reply_to, references_header, thread_key, created_at, updated_at
        ) VALUES(
            :cuenta_email, :carpeta, :uid, :msgno, :asunto, :remitente, :destinatario,
            :fecha_raw, :fecha_unix, :cuerpo, :resumen, :visto, :message_id,
            :in_reply_to, :references_header, :thread_key, :created_at, :updated_at
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
            in_reply_to=excluded.in_reply_to,
            references_header=excluded.references_header,
            thread_key=excluded.thread_key,
            updated_at=excluded.updated_at
    ");

    $stmt->execute([
        ':cuenta_email'      => $m['cuenta_email'],
        ':carpeta'           => $m['carpeta'],
        ':uid'               => $m['uid'],
        ':msgno'             => $m['msgno'],
        ':asunto'            => $m['asunto'],
        ':remitente'         => $m['remitente'],
        ':destinatario'      => $m['destinatario'],
        ':fecha_raw'         => $m['fecha_raw'],
        ':fecha_unix'        => $m['fecha_unix'],
        ':cuerpo'            => $m['cuerpo'],
        ':resumen'           => $m['resumen'],
        ':visto'             => $m['visto'],
        ':message_id'        => $m['message_id'],
        ':in_reply_to'       => $m['in_reply_to'],
        ':references_header' => $m['references_header'],
        ':thread_key'        => $m['thread_key'],
        ':created_at'        => $ahora,
        ':updated_at'        => $ahora,
    ]);
}

function existeMensajePorUid(string $email, string $carpeta, int $uid): bool {
    $stmt = db()->prepare("
        SELECT 1
        FROM mensajes
        WHERE lower(cuenta_email)=lower(?)
          AND carpeta=?
          AND uid=?
        LIMIT 1
    ");
    $stmt->execute([$email, $carpeta, $uid]);
    return (bool)$stmt->fetchColumn();
}

function getConteosCarpetas(string $email): array {
    $stmt = db()->prepare("
        SELECT carpeta, COUNT(*) as total
        FROM mensajes
        WHERE lower(cuenta_email)=lower(?)
        GROUP BY carpeta
    ");
    $stmt->execute([$email]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conteos = [
        'ALL'   => 0,
        'INBOX' => 0,
        'SENT'  => 0,
        'TRASH' => 0,
        'JUNK'  => 0
    ];

    foreach ($rows as $r) {
        $carpeta = $r['carpeta'];
        $total = (int)$r['total'];
        $conteos['ALL'] += $total;
        if (isset($conteos[$carpeta])) {
            $conteos[$carpeta] = $total;
        }
    }

    return $conteos;
}

function getConversacionesDb(string $email, string $folder = 'ALL', int $limit = 100): array {
    $params = [$email];
    $whereFolder = '';

    if ($folder !== 'ALL') {
        $whereFolder = " AND carpeta = ? ";
        $params[] = $folder;
    }

    $sql = "
        SELECT m.*
        FROM mensajes m
        INNER JOIN (
            SELECT
                COALESCE(NULLIF(thread_key,''), 'sin-hilo-' || id) AS th,
                MAX(fecha_unix) AS max_fecha
            FROM mensajes
            WHERE lower(cuenta_email)=lower(?)
            $whereFolder
            GROUP BY COALESCE(NULLIF(thread_key,''), 'sin-hilo-' || id)
        ) t
            ON COALESCE(NULLIF(m.thread_key,''), 'sin-hilo-' || m.id) = t.th
           AND m.fecha_unix = t.max_fecha
        WHERE lower(m.cuenta_email)=lower(?)
        $whereFolder
        ORDER BY m.fecha_unix DESC, m.id DESC
        LIMIT ?
    ";

    $params2 = [$email];
    if ($folder !== 'ALL') {
        $params2[] = $folder;
    }
    $params2[] = $email;
    if ($folder !== 'ALL') {
        $params2[] = $folder;
    }
    $params2[] = $limit;

    $stmt = db()->prepare($sql);
    foreach ($params2 as $i => $v) {
        $stmt->bindValue($i + 1, $v, is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR);
    }
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as &$row) {
        $row['thread_count'] = getThreadCount($email, $row['thread_key'], $folder);
        $row['thread_folders'] = getThreadFolders($email, $row['thread_key']);
    }

    return $rows;
}

function getThreadCount(string $email, ?string $threadKey, string $folder = 'ALL'): int {
    if (!$threadKey) {
        return 1;
    }

    if ($folder === 'ALL') {
        $stmt = db()->prepare("
            SELECT COUNT(*)
            FROM mensajes
            WHERE lower(cuenta_email)=lower(?)
              AND thread_key=?
        ");
        $stmt->execute([$email, $threadKey]);
    } else {
        $stmt = db()->prepare("
            SELECT COUNT(*)
            FROM mensajes
            WHERE lower(cuenta_email)=lower(?)
              AND thread_key=?
              AND carpeta=?
        ");
        $stmt->execute([$email, $threadKey, $folder]);
    }

    return (int)$stmt->fetchColumn();
}

function getThreadFolders(string $email, ?string $threadKey): string {
    if (!$threadKey) {
        return '';
    }

    $stmt = db()->prepare("
        SELECT DISTINCT carpeta
        FROM mensajes
        WHERE lower(cuenta_email)=lower(?)
          AND thread_key=?
        ORDER BY carpeta
    ");
    $stmt->execute([$email, $threadKey]);
    $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $trad = [
        'INBOX' => 'Recibidos',
        'SENT'  => 'Enviados',
        'TRASH' => 'Papelera',
        'JUNK'  => 'No deseado'
    ];

    $out = [];
    foreach ($rows as $r) {
        $out[] = $trad[$r] ?? $r;
    }
    return implode(', ', $out);
}

function getConversacionMensajes(string $email, string $threadKey, string $folder = 'ALL'): array {
    if ($folder === 'ALL') {
        $stmt = db()->prepare("
            SELECT *
            FROM mensajes
            WHERE lower(cuenta_email)=lower(?)
              AND thread_key=?
            ORDER BY fecha_unix ASC, id ASC
        ");
        $stmt->execute([$email, $threadKey]);
    } else {
        $stmt = db()->prepare("
            SELECT *
            FROM mensajes
            WHERE lower(cuenta_email)=lower(?)
              AND thread_key=?
              AND carpeta=?
            ORDER BY fecha_unix ASC, id ASC
        ");
        $stmt->execute([$email, $threadKey, $folder]);
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMensajeDbById(string $email, int $id): ?array {
    $stmt = db()->prepare("
        SELECT *
        FROM mensajes
        WHERE lower(cuenta_email)=lower(?)
          AND id=?
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
    if (!$header) {
        return '';
    }

    $addresses = @imap_rfc822_parse_adrlist($header, '');
    if (!$addresses || !is_array($addresses)) {
        return $header;
    }

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

function limpiarMessageId(?string $value): string {
    $value = trim((string)$value);
    return $value;
}

function extractReferencesIds(?string $refs): array {
    $refs = trim((string)$refs);
    if ($refs === '') {
        return [];
    }
    preg_match_all('/<[^>]+>/', $refs, $m);
    return $m[0] ?? [];
}

function normalizeSubjectForThread(string $subject): string {
    $subject = trim(mb_strtolower($subject));
    $subject = preg_replace('/^((re|rv|aw|fwd|fw)\s*:\s*)+/iu', '', $subject);
    $subject = preg_replace('/\s+/', ' ', $subject);
    return trim($subject);
}

function buildThreadKey(string $subject, string $messageId, string $inReplyTo, string $references): string {
    $refs = extractReferencesIds($references);
    if (!empty($refs)) {
        return 'msg:' . trim($refs[0]);
    }

    if ($inReplyTo !== '') {
        return 'msg:' . trim($inReplyTo);
    }

    if ($messageId !== '') {
        return 'msg:' . trim($messageId);
    }

    return 'sub:' . sha1(normalizeSubjectForThread($subject));
}

function nombreCarpetaUI(string $folder): string {
    $map = [
        'ALL'   => 'Todos los correos',
        'INBOX' => 'Recibidos',
        'SENT'  => 'Enviados',
        'TRASH' => 'Papelera',
        'JUNK'  => 'No deseado'
    ];
    return $map[$folder] ?? $folder;
}

/* =========================================================
   IMAP
========================================================= */
function conectarImapBase(string $email, string $password, string $imapServer, int $port = IMAP_PORT, string $flags = IMAP_FLAGS): array {
    $mailbox = '{' . $imapServer . ':' . $port . $flags . '}';
    $imap = @imap_open($mailbox . 'INBOX', $email, $password);

    if (!$imap) {
        $error = imap_last_error();
        return ['ok' => false, 'error' => $error ?: 'No se pudo conectar al servidor IMAP'];
    }

    return ['ok' => true, 'imap' => $imap, 'mailbox_base' => $mailbox];
}

function discoverImapFolders($imap, string $mailboxBase): array {
    $list = @imap_list($imap, $mailboxBase, '*');
    $result = [
        'INBOX' => 'INBOX',
        'SENT'  => null,
        'TRASH' => null,
        'JUNK'  => null,
    ];

    if (!$list || !is_array($list)) {
        return $result;
    }

    $candidates = [];
    foreach ($list as $full) {
        $name = str_replace($mailboxBase, '', $full);
        $candidates[] = $name;
    }

    foreach ($candidates as $name) {
        $lower = mb_strtolower($name);

        if ($result['SENT'] === null && preg_match('/(^|[\.\/])(?:sent|sent items|enviados|enviado)([\.\/]|$)/iu', $lower)) {
            $result['SENT'] = $name;
        }
        if ($result['TRASH'] === null && preg_match('/(^|[\.\/])(?:trash|papelera|deleted|deleted messages)([\.\/]|$)/iu', $lower)) {
            $result['TRASH'] = $name;
        }
        if ($result['JUNK'] === null && preg_match('/(^|[\.\/])(?:junk|spam|no deseado|bulk mail)([\.\/]|$)/iu', $lower)) {
            $result['JUNK'] = $name;
        }
    }

    return $result;
}

function abrirCarpetaImap($imap, string $mailboxBase, string $remoteFolder): bool {
    return (bool)@imap_reopen($imap, $mailboxBase . $remoteFolder);
}

function getPartBody($imap, int $msgNo, stdClass $structure, string $partNumber = ''): array {
    $result = ['plain' => '', 'html' => ''];

    if (!isset($structure->type)) {
        return $result;
    }

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
        if ($subtype === 'PLAIN') {
            $result['plain'] .= $body;
        } elseif ($subtype === 'HTML') {
            $result['html'] .= $body;
        }

        return $result;
    }

    if (!empty($structure->parts)) {
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
    if (!$structure) {
        return '';
    }

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

function syncRemoteFolder($imap, string $mailboxBase, string $remoteFolder, string $localFolder, string $email, int $limit = 50): array {
    if (!abrirCarpetaImap($imap, $mailboxBase, $remoteFolder)) {
        return ['ok' => false, 'error' => "No se pudo abrir la carpeta IMAP $remoteFolder"];
    }

    $num = @imap_num_msg($imap);
    if (!$num) {
        return ['ok' => true, 'count' => 0, 'skipped' => 0];
    }

    $inicio = max(1, $num - $limit + 1);
    $nuevos = 0;
    $omitidos = 0;

    for ($i = $num; $i >= $inicio; $i--) {
        $uid = (int)@imap_uid($imap, $i);
        if ($uid <= 0) {
            continue;
        }

        if (existeMensajePorUid($email, $localFolder, $uid)) {
            $omitidos++;
            continue;
        }

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
        $visto = !empty($ov->seen) ? 1 : 0;

        $messageId = limpiarMessageId($header->message_id ?? '');
        $inReplyTo = limpiarMessageId($header->in_reply_to ?? '');
        $referencesHeader = trim((string)($header->references ?? ''));
        $threadKey = buildThreadKey($asunto, $messageId, $inReplyTo, $referencesHeader);

        $cuerpo = extractMessageBody($imap, $i);

        saveOrUpdateMensaje([
            'cuenta_email'      => $email,
            'carpeta'           => $localFolder,
            'uid'               => $uid,
            'msgno'             => $i,
            'asunto'            => $asunto !== '' ? $asunto : '(Sin asunto)',
            'remitente'         => $remitente,
            'destinatario'      => $destinatario,
            'fecha_raw'         => $fechaRaw,
            'fecha_unix'        => $fechaUnix ?: time(),
            'cuerpo'            => $cuerpo,
            'resumen'           => resumenTexto($cuerpo),
            'visto'             => $visto,
            'message_id'        => $messageId,
            'in_reply_to'       => $inReplyTo,
            'references_header' => $referencesHeader,
            'thread_key'        => $threadKey,
        ]);

        $nuevos++;
    }

    return [
        'ok'      => true,
        'count'   => $nuevos,
        'skipped' => $omitidos
    ];
}

function syncMensajesDesdeServidor(string $email, string $password, string $imapServer, int $limit = 50): array {
    $conexion = conectarImapBase($email, $password, $imapServer);
    if (!$conexion['ok']) {
        return ['ok' => false, 'error' => $conexion['error']];
    }

    $imap = $conexion['imap'];
    $mailboxBase = $conexion['mailbox_base'];

    $folders = discoverImapFolders($imap, $mailboxBase);

    $plan = [
        ['remote' => $folders['INBOX'], 'local' => 'INBOX'],
    ];

    if (!empty($folders['SENT'])) {
        $plan[] = ['remote' => $folders['SENT'], 'local' => 'SENT'];
    }
    if (!empty($folders['TRASH'])) {
        $plan[] = ['remote' => $folders['TRASH'], 'local' => 'TRASH'];
    }
    if (!empty($folders['JUNK'])) {
        $plan[] = ['remote' => $folders['JUNK'], 'local' => 'JUNK'];
    }

    $totalNew = 0;
    $totalSkipped = 0;

    foreach ($plan as $p) {
        $res = syncRemoteFolder($imap, $mailboxBase, $p['remote'], $p['local'], $email, $limit);
        if ($res['ok']) {
            $totalNew += (int)$res['count'];
            $totalSkipped += (int)$res['skipped'];
        }
    }

    @imap_close($imap);

    return [
        'ok'      => true,
        'count'   => $totalNew,
        'skipped' => $totalSkipped,
        'folders' => $folders
    ];
}

/* =========================================================
   SMTP STARTTLS
========================================================= */
function smtpRead($fp): string {
    $data = '';
    while (!feof($fp)) {
        $line = fgets($fp, 515);
        if ($line === false) {
            break;
        }
        $data .= $line;
        if (preg_match('/^\d{3}\s/', $line)) {
            break;
        }
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

function smtpEnviarTLS(
    string $smtpHost,
    int $smtpPort,
    string $usuario,
    string $password,
    string $from,
    string $to,
    string $subject,
    string $body,
    ?string $inReplyTo = null,
    ?string $references = null
): array {
    $fp = @fsockopen($smtpHost, $smtpPort, $errno, $errstr, SMTP_TIMEOUT);

    if (!$fp) {
        return ['ok' => false, 'error' => "No se pudo conectar a SMTP: $errstr ($errno)"];
    }

    stream_set_timeout($fp, SMTP_TIMEOUT);

    $r = smtpExpect($fp, [220]);
    if (!$r['ok']) {
        fclose($fp);
        return ['ok' => false, 'error' => 'SMTP saludo inválido: ' . $r['response']];
    }

    smtpWrite($fp, "EHLO localhost\r\n");
    $r = smtpExpect($fp, [250]);
    if (!$r['ok']) {
        fclose($fp);
        return ['ok' => false, 'error' => 'EHLO inicial falló: ' . $r['response']];
    }

    smtpWrite($fp, "STARTTLS\r\n");
    $r = smtpExpect($fp, [220]);
    if (!$r['ok']) {
        fclose($fp);
        return ['ok' => false, 'error' => 'STARTTLS falló: ' . $r['response']];
    }

    $cryptoOk = @stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
    if ($cryptoOk !== true) {
        fclose($fp);
        return ['ok' => false, 'error' => 'No se pudo activar TLS sobre la conexión SMTP.'];
    }

    smtpWrite($fp, "EHLO localhost\r\n");
    $r = smtpExpect($fp, [250]);
    if (!$r['ok']) {
        fclose($fp);
        return ['ok' => false, 'error' => 'EHLO tras STARTTLS falló: ' . $r['response']];
    }

    smtpWrite($fp, "AUTH LOGIN\r\n");
    $r = smtpExpect($fp, [334]);
    if (!$r['ok']) {
        fclose($fp);
        return ['ok' => false, 'error' => 'AUTH LOGIN falló: ' . $r['response']];
    }

    smtpWrite($fp, base64_encode($usuario) . "\r\n");
    $r = smtpExpect($fp, [334]);
    if (!$r['ok']) {
        fclose($fp);
        return ['ok' => false, 'error' => 'Usuario SMTP rechazado: ' . $r['response']];
    }

    smtpWrite($fp, base64_encode($password) . "\r\n");
    $r = smtpExpect($fp, [235]);
    if (!$r['ok']) {
        fclose($fp);
        return ['ok' => false, 'error' => 'Contraseña SMTP rechazada: ' . $r['response']];
    }

    smtpWrite($fp, "MAIL FROM:<$from>\r\n");
    $r = smtpExpect($fp, [250]);
    if (!$r['ok']) {
        fclose($fp);
        return ['ok' => false, 'error' => 'MAIL FROM falló: ' . $r['response']];
    }

    smtpWrite($fp, "RCPT TO:<$to>\r\n");
    $r = smtpExpect($fp, [250, 251]);
    if (!$r['ok']) {
        fclose($fp);
        return ['ok' => false, 'error' => 'RCPT TO falló: ' . $r['response']];
    }

    smtpWrite($fp, "DATA\r\n");
    $r = smtpExpect($fp, [354]);
    if (!$r['ok']) {
        fclose($fp);
        return ['ok' => false, 'error' => 'DATA falló: ' . $r['response']];
    }

    $messageId = '<jocarsa-' . uniqid('', true) . '@localhost>';
    $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

    $headers = [];
    $headers[] = "From: <$from>";
    $headers[] = "To: <$to>";
    $headers[] = "Subject: $encodedSubject";
    $headers[] = "Date: " . date(DATE_RFC2822);
    $headers[] = "Message-ID: $messageId";
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-Type: text/plain; charset=UTF-8";
    $headers[] = "Content-Transfer-Encoding: 8bit";
    $headers[] = "X-Mailer: jocarsa-email-php";

    if ($inReplyTo) {
        $headers[] = "In-Reply-To: $inReplyTo";
    }
    if ($references) {
        $headers[] = "References: $references";
    }

    $body = str_replace("\r\n.\r\n", "\r\n..\r\n", normalizarCRLF($body));
    $payload = implode("\r\n", $headers) . "\r\n\r\n" . $body . "\r\n.\r\n";

    smtpWrite($fp, $payload);
    $r = smtpExpect($fp, [250]);
    if (!$r['ok']) {
        fclose($fp);
        return ['ok' => false, 'error' => 'Envío DATA falló: ' . $r['response']];
    }

    smtpWrite($fp, "QUIT\r\n");
    smtpExpect($fp, [221]);
    fclose($fp);

    return ['ok' => true, 'message_id' => $messageId];
}

/* =========================================================
   AUTH / SESSION
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
$folder = strtoupper(trim($_GET['folder'] ?? 'ALL'));
$foldersPermitidas = ['ALL', 'INBOX', 'SENT', 'TRASH', 'JUNK'];
if (!in_array($folder, $foldersPermitidas, true)) {
    $folder = 'ALL';
}

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
            $conexion = conectarImapBase($email, $password, $imapServer);

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
                    $info = 'Inicio de sesión correcto. Nuevos: ' . (int)$sync['count'] . ' · Ya existentes: ' . (int)$sync['skipped'] . '.';
                } else {
                    $info = 'Inicio de sesión correcto, pero la sincronización inicial ha fallado: ' . $sync['error'];
                }
            }
        }
    }
}

/* =========================================================
   AUTH ACTIONS
========================================================= */
if (isset($_SESSION['auth']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = $_SESSION['auth'];

    if (($_POST['action'] ?? '') === 'sync') {
        $sync = syncMensajesDesdeServidor($auth['email'], $auth['password'], $auth['imap_server'], 50);
        if ($sync['ok']) {
            $info = 'Sincronización completada. Nuevos: ' . (int)$sync['count'] . ' · Ya existentes: ' . (int)$sync['skipped'] . '.';
        } else {
            $error = 'No se pudo sincronizar: ' . $sync['error'];
        }
    }

    if (($_POST['action'] ?? '') === 'send') {
        $to = trim($_POST['to'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $body = trim($_POST['body'] ?? '');
        $replyToMessageId = trim($_POST['reply_message_id'] ?? '');
        $replyReferences = trim($_POST['reply_references'] ?? '');

        if ($to === '' || $subject === '' || $body === '') {
            $error = 'Para enviar un correo debes completar destinatario, asunto y mensaje.';
            $vista = isset($_POST['reply_mode']) ? 'responder' : 'nuevo';
        } else {
            $envio = smtpEnviarTLS(
                $auth['smtp_server'],
                SMTP_PORT_TLS,
                $auth['email'],
                $auth['password'],
                $auth['email'],
                emailSoloDireccion($to),
                $subject,
                $body,
                $replyToMessageId !== '' ? $replyToMessageId : null,
                $replyReferences !== '' ? $replyReferences : null
            );

            if ($envio['ok']) {
                $info = 'Correo enviado correctamente.';
                $vista = 'lectura';

                $messageId = $envio['message_id'] ?? '';
                $threadKey = buildThreadKey($subject, $messageId, $replyToMessageId, $replyReferences);

                saveOrUpdateMensaje([
                    'cuenta_email'      => $auth['email'],
                    'carpeta'           => 'SENT',
                    'uid'               => (int)(microtime(true) * 1000000),
                    'msgno'             => 0,
                    'asunto'            => $subject,
                    'remitente'         => $auth['email'],
                    'destinatario'      => $to,
                    'fecha_raw'         => date(DATE_RFC2822),
                    'fecha_unix'        => time(),
                    'cuerpo'            => $body,
                    'resumen'           => resumenTexto($body),
                    'visto'             => 1,
                    'message_id'        => $messageId,
                    'in_reply_to'       => $replyToMessageId,
                    'references_header' => $replyReferences,
                    'thread_key'        => $threadKey,
                ]);
            } else {
                $error = $envio['error'];
                $vista = isset($_POST['reply_mode']) ? 'responder' : 'nuevo';
            }
        }
    }
}

/* =========================================================
   DATA FOR UI
========================================================= */
$conversaciones = [];
$mensajeSeleccionado = null;
$mensajesConversacion = [];
$conteos = [
    'ALL' => 0,
    'INBOX' => 0,
    'SENT' => 0,
    'TRASH' => 0,
    'JUNK' => 0
];

if (isset($_SESSION['auth'])) {
    $auth = $_SESSION['auth'];
    $conteos = getConteosCarpetas($auth['email']);
    $conversaciones = getConversacionesDb($auth['email'], $folder, 100);

    $selectedId = isset($_GET['msg']) ? (int)$_GET['msg'] : 0;
    if ($selectedId > 0) {
        $mensajeSeleccionado = getMensajeDbById($auth['email'], $selectedId);
    }

    if (!$mensajeSeleccionado && !empty($conversaciones)) {
        $mensajeSeleccionado = $conversaciones[0];
    }

    if ($mensajeSeleccionado && !empty($mensajeSeleccionado['thread_key'])) {
        $mensajesConversacion = getConversacionMensajes($auth['email'], $mensajeSeleccionado['thread_key'], $folder);
        if (empty($mensajesConversacion)) {
            $mensajesConversacion = [$mensajeSeleccionado];
        }
    } elseif ($mensajeSeleccionado) {
        $mensajesConversacion = [$mensajeSeleccionado];
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
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap');

        html,body{
            padding:0;
            margin:0;
            width:100%;
            height:100%;
            font-family:'Ubuntu', Arial, sans-serif;
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
            gap:20px;
        }

        #marca{
            display:flex;
            flex-direction:column;
            gap:2px;
            min-width:0;
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
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
            max-width:700px;
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
            font-size:14px;
            font-family:'Ubuntu', Arial, sans-serif;
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
            width:260px;
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

        #bandejas a.activo{
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
        }

        .folder-line{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:10px;
        }

        .folder-count{
            font-size:12px;
            background:rgba(255,255,255,0.14);
            padding:4px 8px;
            border-radius:999px;
            min-width:34px;
            text-align:center;
        }

        #bandejas .cuenta{
            margin-top:auto;
            background:rgba(255,255,255,0.04);
            color:#dbeafe;
            font-size:13px;
            line-height:1.6;
        }

        #mensajes{
            width:420px;
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

        #mensajes .asunto-linea{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap:10px;
            margin-bottom:8px;
        }

        #mensajes h3{
            margin:0;
            font-size:16px;
            color:#111827;
            line-height:1.3;
        }

        .badge-thread{
            background:#dbeafe;
            color:#1d4ed8;
            border-radius:999px;
            padding:4px 8px;
            font-size:11px;
            font-weight:700;
            white-space:nowrap;
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

        .thread-meta{
            margin-top:8px;
            font-size:12px;
            color:#6b7280;
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

        .conversation{
            max-width:980px;
            display:flex;
            flex-direction:column;
            gap:18px;
        }

        .email{
            background:white;
            border:1px solid #dfe4ea;
            border-radius:14px;
            box-shadow:0 4px 12px rgba(0,0,0,0.05);
            overflow:hidden;
        }

        .email.mine{
            margin-left:80px;
            border-color:#bfdbfe;
            background:#f8fbff;
        }

        .email.other{
            margin-right:80px;
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
            font-family:'Ubuntu', Arial, sans-serif;
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
            flex-wrap:wrap;
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
            font-family:'Ubuntu', Arial, sans-serif;
        }

        @media (max-width:1200px){
            #mensajes{width:360px;}
            #bandejas{width:220px;}
        }

        @media (max-width:1100px){
            #topbar{
                height:auto;
                padding:14px 20px;
                align-items:flex-start;
                flex-direction:column;
            }
            .email.mine{margin-left:24px;}
            .email.other{margin-right:24px;}
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
                En el primer acceso se guardan el servidor IMAP y SMTP en SQLite.
                La contraseña no se almacena y se pedirá en cada inicio de sesión.
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

            <a class="toolbtn primario" href="?vista=nuevo&folder=<?= h($folder) ?>">✉ Nuevo correo</a>
            <a class="toolbtn-link" href="?folder=<?= h($folder) ?>">📥 Conversaciones</a>
            <a class="toolbtn-link" href="?logout=1">⎋ Cerrar sesión</a>
        </div>
    </div>

    <div id="app">
        <div id="bandejas">
            <a class="<?= $folder === 'ALL' ? 'activo' : '' ?>" href="?folder=ALL">
                <div class="folder-line">
                    <span>Todos los correos</span>
                    <span class="folder-count"><?= (int)$conteos['ALL'] ?></span>
                </div>
            </a>

            <a class="<?= $folder === 'INBOX' ? 'activo' : '' ?>" href="?folder=INBOX">
                <div class="folder-line">
                    <span>Recibidos</span>
                    <span class="folder-count"><?= (int)$conteos['INBOX'] ?></span>
                </div>
            </a>

            <a class="<?= $folder === 'SENT' ? 'activo' : '' ?>" href="?folder=SENT">
                <div class="folder-line">
                    <span>Enviados</span>
                    <span class="folder-count"><?= (int)$conteos['SENT'] ?></span>
                </div>
            </a>

            <a class="<?= $folder === 'TRASH' ? 'activo' : '' ?>" href="?folder=TRASH">
                <div class="folder-line">
                    <span>Papelera</span>
                    <span class="folder-count"><?= (int)$conteos['TRASH'] ?></span>
                </div>
            </a>

            <a class="<?= $folder === 'JUNK' ? 'activo' : '' ?>" href="?folder=JUNK">
                <div class="folder-line">
                    <span>No deseado</span>
                    <span class="folder-count"><?= (int)$conteos['JUNK'] ?></span>
                </div>
            </a>

            <div class="item cuenta">
                <strong><?= h($auth['email']) ?></strong><br>
                Vista actual: <?= h(nombreCarpetaUI($folder)) ?><br>
                La sincronización descarga carpetas conocidas y agrupa los mensajes por conversación.
            </div>
        </div>

        <div id="mensajes">
            <?php if (empty($conversaciones)): ?>
                <div class="vacio">No hay conversaciones guardadas en la base de datos local para esta carpeta.</div>
            <?php else: ?>
                <?php foreach ($conversaciones as $m): ?>
                    <article class="<?= ($mensajeSeleccionado && (int)$mensajeSeleccionado['id'] === (int)$m['id'] && $vista === 'lectura') ? 'activo' : '' ?>">
                        <a href="?folder=<?= h($folder) ?>&msg=<?= (int)$m['id'] ?>">
                            <div class="asunto-linea">
                                <h3><?= h($m['asunto']) ?></h3>
                                <?php if ((int)$m['thread_count'] > 1): ?>
                                    <span class="badge-thread"><?= (int)$m['thread_count'] ?></span>
                                <?php endif; ?>
                            </div>
                            <time><?= h(date('Y-m-d H:i', (int)$m['fecha_unix'])) ?></time>
                            <p>
                                <strong><?= h($m['remitente']) ?></strong><br>
                                <?= h($m['resumen']) ?>
                            </p>
                            <?php if (($m['thread_folders'] ?? '') !== ''): ?>
                                <div class="thread-meta"><?= h($m['thread_folders']) ?></div>
                            <?php endif; ?>
                        </a>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div id="contenido">
            <?php if ($vista === 'nuevo'): ?>

                <div id="cabecera-contenido">
                    <h2>Nuevo correo</h2>
                    <p>Composición y envío mediante SMTP con STARTTLS</p>
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
                                <textarea class="jocarsa-wysiwyg" name="body" placeholder="Escribe aquí tu mensaje"><?= h($_POST['body'] ?? '') ?></textarea>
                            </div>

                            <div class="acciones-compose">
                                <a class="toolbtn-link" href="?folder=<?= h($folder) ?>">Cancelar</a>
                                <button class="toolbtn primario" type="submit">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>

            <?php elseif ($vista === 'responder' && $mensajeSeleccionado): ?>

                <?php
                $replyTo = emailSoloDireccion($mensajeSeleccionado['remitente'] ?? '');
                $replySubject = $mensajeSeleccionado['asunto'] ?? '';
                if (stripos($replySubject, 'Re:') !== 0) {
                    $replySubject = 'Re: ' . $replySubject;
                }

                $replyDate = !empty($mensajeSeleccionado['fecha_unix'])
                    ? date('Y-m-d H:i', (int)$mensajeSeleccionado['fecha_unix'])
                    : '';

                $quoted = "\n\n----- Mensaje original -----\n";
                $quoted .= "De: " . ($mensajeSeleccionado['remitente'] ?? '') . "\n";
                $quoted .= "Para: " . ($mensajeSeleccionado['destinatario'] ?? '') . "\n";
                $quoted .= "Fecha: " . $replyDate . "\n";
                $quoted .= "Asunto: " . ($mensajeSeleccionado['asunto'] ?? '') . "\n\n";
                $quoted .= trim((string)($mensajeSeleccionado['cuerpo'] ?? ''));

                $replyReferences = trim((string)($mensajeSeleccionado['references_header'] ?? ''));
                if ($replyReferences !== '') {
                    $replyReferences .= ' ';
                }
                if (!empty($mensajeSeleccionado['message_id'])) {
                    $replyReferences .= trim($mensajeSeleccionado['message_id']);
                }
                $replyReferences = trim($replyReferences);
                ?>

                <div id="cabecera-contenido">
                    <h2>Responder correo</h2>
                    <p>Respuesta basada en el mensaje seleccionado y cargada desde SQLite</p>
                </div>

                <div id="panel">
                    <form class="compose" method="post">
                        <input type="hidden" name="action" value="send">
                        <input type="hidden" name="reply_mode" value="1">
                        <input type="hidden" name="reply_original_id" value="<?= (int)$mensajeSeleccionado['id'] ?>">
                        <input type="hidden" name="reply_message_id" value="<?= h($mensajeSeleccionado['message_id'] ?? '') ?>">
                        <input type="hidden" name="reply_references" value="<?= h($replyReferences) ?>">

                        <div class="compose-head">
                            <h3>Responder mensaje</h3>
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
                                <input type="text" name="to" value="<?= h($_POST['to'] ?? $replyTo) ?>">
                            </div>

                            <div class="grupo">
                                <label>Asunto</label>
                                <input type="text" name="subject" value="<?= h($_POST['subject'] ?? $replySubject) ?>">
                            </div>

                            <div class="grupo">
                                <label>Mensaje</label>
                                <textarea class="jocarsa-wysiwyg" name="body"><?= h($_POST['body'] ?? $quoted) ?></textarea>
                            </div>

                            <div class="acciones-compose">
                                <a class="toolbtn-link" href="?folder=<?= h($folder) ?>&msg=<?= (int)$mensajeSeleccionado['id'] ?>">Cancelar</a>
                                <button class="toolbtn primario" type="submit">Enviar respuesta</button>
                            </div>
                        </div>
                    </form>
                </div>

            <?php else: ?>

                <div id="cabecera-contenido">
                    <h2><?= $mensajeSeleccionado ? h($mensajeSeleccionado['asunto']) : 'Sin conversación seleccionada' ?></h2>
                    <p>
                        <?= $mensajeSeleccionado
                            ? 'Vista de conversación en ' . h(nombreCarpetaUI($folder))
                            : 'Selecciona una conversación de la columna central' ?>
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
                        <div style="margin-bottom:16px;display:flex;gap:10px;flex-wrap:wrap;">
                            <a class="toolbtn primario" href="?vista=responder&folder=<?= h($folder) ?>&msg=<?= (int)$mensajeSeleccionado['id'] ?>">↩ Responder</a>
                            <a class="toolbtn-link" href="?vista=nuevo&folder=<?= h($folder) ?>">✉ Nuevo correo</a>
                        </div>

                        <div class="conversation">
                            <?php foreach ($mensajesConversacion as $cm): ?>
                                <?php $esMio = strtolower(emailSoloDireccion($cm['remitente'] ?? '')) === strtolower($auth['email']); ?>
                                <div class="email <?= $esMio ? 'mine' : 'other' ?>">
                                    <div class="email-header">
                                        <div class="linea1">
                                            <strong><?= h($cm['asunto']) ?></strong>
                                            <time><?= h(date('Y-m-d H:i', (int)$cm['fecha_unix'])) ?></time>
                                        </div>
                                        <div class="meta">
                                            <strong>De:</strong> <?= h($cm['remitente']) ?><br>
                                            <strong>Para:</strong> <?= h($cm['destinatario']) ?><br>
                                            <strong>Carpeta:</strong> <?= h(nombreCarpetaUI($cm['carpeta'])) ?>
                                        </div>
                                    </div>
                                    <div class="email-cuerpo"><?= h($cm['cuerpo']) ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="vacio">No hay contenido para mostrar.</div>
                    <?php endif; ?>
                </div>

            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>

<script src="https://jocarsa.github.io/jocarsa-wysiwyg/jocarsa-wysiwyg.js"></script>
<link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-wysiwyg/jocarsa-wysiwyg.css">
</body>
</html>
