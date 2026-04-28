<?php

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
    $whereFolder = '';
    $params = [$email];

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

    $binds = [$email];
    if ($folder !== 'ALL') {
        $binds[] = $folder;
    }
    $binds[] = $email;
    if ($folder !== 'ALL') {
        $binds[] = $folder;
    }
    $binds[] = $limit;

    $stmt = db()->prepare($sql);
    foreach ($binds as $i => $v) {
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

function updateMensajeCarpetaPorId(string $email, int $id, string $nuevaCarpeta): void {
    $stmt = db()->prepare("
        UPDATE mensajes
        SET carpeta=?, updated_at=?
        WHERE lower(cuenta_email)=lower(?)
          AND id=?
    ");
    $stmt->execute([$nuevaCarpeta, date('Y-m-d H:i:s'), $email, $id]);
}
