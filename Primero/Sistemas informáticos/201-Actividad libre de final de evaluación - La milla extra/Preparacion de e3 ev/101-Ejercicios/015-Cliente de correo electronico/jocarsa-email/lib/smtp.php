<?php

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
