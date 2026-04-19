<?php

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
    return trim((string)$value);
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
