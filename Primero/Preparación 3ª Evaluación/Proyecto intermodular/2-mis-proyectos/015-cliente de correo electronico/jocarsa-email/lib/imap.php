<?php

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

function moverMensajeServidor(string $email, string $password, string $imapServer, int $msgIdLocal, string $destinoLocal): array {
    $mensaje = getMensajeDbById($email, $msgIdLocal);
    if (!$mensaje) {
        return ['ok' => false, 'error' => 'No se encontró el mensaje en la base de datos local.'];
    }

    $conexion = conectarImapBase($email, $password, $imapServer);
    if (!$conexion['ok']) {
        return ['ok' => false, 'error' => $conexion['error']];
    }

    $imap = $conexion['imap'];
    $mailboxBase = $conexion['mailbox_base'];
    $folders = discoverImapFolders($imap, $mailboxBase);

    $mapLocalRemote = [
        'INBOX' => $folders['INBOX'],
        'SENT'  => $folders['SENT'],
        'TRASH' => $folders['TRASH'],
        'JUNK'  => $folders['JUNK']
    ];

    $origenLocal = $mensaje['carpeta'];
    $remoteOrigen = $mapLocalRemote[$origenLocal] ?? null;
    $remoteDestino = $mapLocalRemote[$destinoLocal] ?? null;

    if (!$remoteOrigen) {
        @imap_close($imap);
        return ['ok' => false, 'error' => 'No se ha podido resolver la carpeta de origen en el servidor IMAP.'];
    }

    if (!$remoteDestino) {
        @imap_close($imap);
        return ['ok' => false, 'error' => 'No se ha podido resolver la carpeta de destino en el servidor IMAP.'];
    }

    if (!abrirCarpetaImap($imap, $mailboxBase, $remoteOrigen)) {
        @imap_close($imap);
        return ['ok' => false, 'error' => 'No se pudo abrir la carpeta de origen en IMAP.'];
    }

    $uid = (int)$mensaje['uid'];
    if ($uid <= 0) {
        @imap_close($imap);
        return ['ok' => false, 'error' => 'El UID del mensaje no es válido.'];
    }

    $copied = @imap_mail_move($imap, (string)$uid, $remoteDestino, CP_UID);
    if (!$copied) {
        $err = imap_last_error();
        @imap_close($imap);
        return ['ok' => false, 'error' => 'No se pudo mover el mensaje en IMAP: ' . ($err ?: 'error desconocido')];
    }

    @imap_expunge($imap);
    @imap_close($imap);

    updateMensajeCarpetaPorId($email, $msgIdLocal, $destinoLocal);

    return ['ok' => true];
}
