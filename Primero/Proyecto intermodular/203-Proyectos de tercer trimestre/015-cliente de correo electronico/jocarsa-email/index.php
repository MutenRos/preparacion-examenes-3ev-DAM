<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/lib/db.php';
require_once __DIR__ . '/lib/helpers.php';
require_once __DIR__ . '/lib/imap.php';
require_once __DIR__ . '/lib/smtp.php';
require_once __DIR__ . '/lib/actions.php';
require_once __DIR__ . '/lib/ui.php';

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

/* LOGIN */
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

/* ACCIONES AUTENTICADAS */
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

    if (($_POST['action'] ?? '') === 'move_to_trash') {
        $msgId = (int)($_POST['msg_id'] ?? 0);

        if ($msgId > 0) {
            $res = moverMensajeServidor($auth['email'], $auth['password'], $auth['imap_server'], $msgId, 'TRASH');
            if ($res['ok']) {
                redirectTo(buildBaseUrl('TRASH'));
            } else {
                $error = $res['error'];
            }
        }
    }

    if (($_POST['action'] ?? '') === 'move_to_spam') {
        $msgId = (int)($_POST['msg_id'] ?? 0);

        if ($msgId > 0) {
            $res = moverMensajeServidor($auth['email'], $auth['password'], $auth['imap_server'], $msgId, 'JUNK');
            if ($res['ok']) {
                redirectTo(buildBaseUrl('JUNK'));
            } else {
                $error = $res['error'];
            }
        }
    }
}

/* DATOS UI */
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

        html,body{padding:0;margin:0;width:100%;height:100%;font-family:'Ubuntu',Arial,sans-serif;background:#f3f4f6;color:#1f2937;}
        *{box-sizing:border-box;}
        body{display:flex;flex-direction:column;overflow:hidden;}
        #topbar{height:68px;background:linear-gradient(90deg,#1e293b,#334155);color:white;display:flex;align-items:center;justify-content:space-between;padding:0 20px;border-bottom:1px solid rgba(255,255,255,0.08);flex:0 0 auto;gap:20px;}
        #marca{display:flex;flex-direction:column;gap:2px;min-width:0;}
        #marca h1{margin:0;font-size:20px;font-weight:700;letter-spacing:0.3px;}
        #marca p{margin:0;font-size:12px;color:rgba(255,255,255,0.72);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:700px;}
        #herramientas{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
        .toolbtn,.toolbtn-link{border:none;background:rgba(255,255,255,0.10);color:white;padding:10px 14px;border-radius:10px;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all 0.2s;font-size:14px;font-family:'Ubuntu',Arial,sans-serif;}
        .toolbtn:hover,.toolbtn-link:hover{background:rgba(255,255,255,0.18);}
        .toolbtn.primario,.toolbtn-link.primario{background:linear-gradient(135deg,#2563eb,#1d4ed8);}
        #app{flex:1;display:flex;min-height:0;min-width:0;overflow:hidden;}
        #bandejas{width:260px;background:linear-gradient(180deg,#2f3640,#3a4250);display:flex;flex-direction:column;gap:12px;overflow:auto;padding:20px;border-right:1px solid #d9dde3;}
        #bandejas a,#bandejas .item{color:white;text-decoration:none;background:rgba(255,255,255,0.08);padding:14px 16px;display:block;border-radius:10px;transition:all 0.3s;font-weight:bold;}
        #bandejas a:hover{background:rgba(255,255,255,0.18);transform:translateX(4px);}
        #bandejas a.activo{background:linear-gradient(135deg,#2563eb,#1d4ed8);}
        .folder-line{display:flex;align-items:center;justify-content:space-between;gap:10px;}
        .folder-count{font-size:12px;background:rgba(255,255,255,0.14);padding:4px 8px;border-radius:999px;min-width:34px;text-align:center;}
        #bandejas .cuenta{margin-top:auto;background:rgba(255,255,255,0.04);color:#dbeafe;font-size:13px;line-height:1.6;}
        #mensajes{width:420px;background:#eceff3;display:flex;flex-direction:column;gap:14px;overflow-y:auto;min-width:0;min-height:0;padding:20px;border-right:1px solid #d9dde3;}
        #mensajes article{background:white;padding:16px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.06);transition:all 0.3s;cursor:pointer;border:1px solid #e5e7eb;flex:0 0 auto;}
        #mensajes article.activo{border-color:#60a5fa;box-shadow:0 0 0 4px rgba(96,165,250,0.12);}
        #mensajes a{color:inherit;text-decoration:none;display:block;}
        .asunto-linea{display:flex;align-items:flex-start;justify-content:space-between;gap:10px;margin-bottom:8px;}
        #mensajes h3{margin:0;font-size:16px;color:#111827;line-height:1.3;}
        .badge-thread{background:#dbeafe;color:#1d4ed8;border-radius:999px;padding:4px 8px;font-size:11px;font-weight:700;white-space:nowrap;}
        #mensajes time{font-size:12px;color:#6b7280;display:block;margin-bottom:8px;}
        #mensajes p{margin:0;color:#4b5563;font-size:14px;line-height:1.45;}
        .thread-meta{margin-top:8px;font-size:12px;color:#6b7280;}
        #contenido{flex:1;background:#f8fafc;display:flex;flex-direction:column;overflow:hidden;min-width:0;min-height:0;}
        #cabecera-contenido{padding:20px 24px;border-bottom:1px solid #d9dde3;background:white;flex:0 0 auto;}
        #cabecera-contenido h2{margin:0 0 6px 0;font-size:22px;font-weight:600;color:#111827;}
        #cabecera-contenido p{margin:0;font-size:13px;color:#6b7280;}
        #panel{flex:1;overflow-y:auto;padding:24px;min-height:0;}
        .conversation{max-width:980px;display:flex;flex-direction:column;gap:18px;}
        .email{background:white;border:1px solid #dfe4ea;border-radius:14px;box-shadow:0 4px 12px rgba(0,0,0,0.05);overflow:hidden;}
        .email.mine{margin-left:80px;border-color:#bfdbfe;background:#f8fbff;}
        .email.other{margin-right:80px;}
        .email-header{padding:14px 18px;background:#f8fafc;border-bottom:1px solid #e5e7eb;}
        .email-header .linea1{display:flex;justify-content:space-between;align-items:flex-start;gap:20px;margin-bottom:6px;}
        .email-header strong{font-size:14px;color:#111827;word-break:break-word;}
        .email-header time{font-size:12px;color:#6b7280;white-space:nowrap;margin:0;}
        .email-header .meta{font-size:12px;color:#6b7280;line-height:1.5;word-break:break-word;}
        .email-cuerpo{padding:18px;font-size:14px;line-height:1.7;color:#374151;word-break:break-word;white-space:pre-wrap;}
        .compose{max-width:920px;background:white;border:1px solid #dfe4ea;border-radius:14px;box-shadow:0 4px 12px rgba(0,0,0,0.05);overflow:hidden;}
        .compose-head{padding:18px 20px;border-bottom:1px solid #e5e7eb;background:#f8fafc;}
        .compose-head h3{margin:0;font-size:18px;color:#111827;}
        .compose-body{padding:20px;}
        .grupo{margin-bottom:16px;}
        .grupo label{display:block;font-size:13px;font-weight:bold;color:#374151;margin-bottom:8px;}
        .grupo input,.grupo textarea{width:100%;padding:13px 14px;border:1px solid #d1d5db;border-radius:10px;background:#f9fafb;font-size:14px;outline:none;transition:all 0.2s;font-family:'Ubuntu',Arial,sans-serif;}
        .grupo textarea{min-height:320px;resize:vertical;line-height:1.6;}
        .acciones-compose{display:flex;gap:10px;justify-content:flex-end;flex-wrap:wrap;}
        .msg{margin:0 0 16px 0;padding:12px 14px;border-radius:10px;font-size:14px;}
        .msg.error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
        .msg.ok{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
        .vacio{color:#6b7280;font-size:14px;padding:20px;}
        #login-wrap{width:100%;height:100%;display:flex;align-items:center;justify-content:center;padding:24px;background:linear-gradient(135deg,rgba(59,130,246,0.06),rgba(16,185,129,0.05)),#f8fafc;}
        .tarjeta-login{width:100%;max-width:520px;background:white;border:1px solid #e5e7eb;border-radius:18px;box-shadow:0 16px 40px rgba(0,0,0,0.08);padding:28px;}
        .tarjeta-login h3{margin:0 0 8px 0;font-size:24px;color:#111827;}
        .tarjeta-login .subtitulo{margin:0 0 24px 0;font-size:14px;color:#6b7280;line-height:1.5;}
        .doble{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
        .acciones{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-top:24px;}
        .estado{font-size:12px;color:#6b7280;}
        .boton{border:none;background:linear-gradient(135deg,#2563eb,#1d4ed8);color:white;padding:13px 18px;border-radius:10px;font-weight:bold;cursor:pointer;box-shadow:0 8px 20px rgba(37,99,235,0.25);font-family:'Ubuntu',Arial,sans-serif;}
        .inline-actions{margin-bottom:16px;display:flex;gap:10px;flex-wrap:wrap;}
        .inline-form{display:inline-block;margin:0;}
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

            <?php if ($error !== ''): ?><div class="msg error"><?= h($error) ?></div><?php endif; ?>
            <?php if ($info !== ''): ?><div class="msg ok"><?= h($info) ?></div><?php endif; ?>

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
            <a class="<?= carpetaActiva($folder, 'ALL') ?>" href="?folder=ALL"><div class="folder-line"><span>Todos los correos</span><span class="folder-count"><?= (int)$conteos['ALL'] ?></span></div></a>
            <a class="<?= carpetaActiva($folder, 'INBOX') ?>" href="?folder=INBOX"><div class="folder-line"><span>Recibidos</span><span class="folder-count"><?= (int)$conteos['INBOX'] ?></span></div></a>
            <a class="<?= carpetaActiva($folder, 'SENT') ?>" href="?folder=SENT"><div class="folder-line"><span>Enviados</span><span class="folder-count"><?= (int)$conteos['SENT'] ?></span></div></a>
            <a class="<?= carpetaActiva($folder, 'TRASH') ?>" href="?folder=TRASH"><div class="folder-line"><span>Papelera</span><span class="folder-count"><?= (int)$conteos['TRASH'] ?></span></div></a>
            <a class="<?= carpetaActiva($folder, 'JUNK') ?>" href="?folder=JUNK"><div class="folder-line"><span>No deseado</span><span class="folder-count"><?= (int)$conteos['JUNK'] ?></span></div></a>

            <div class="item cuenta">
                <strong><?= h($auth['email']) ?></strong><br>
                Vista actual: <?= h(nombreCarpetaUI($folder)) ?><br>
                Puedes mover mensajes a Papelera o Spam.
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
                            <p><strong><?= h($m['remitente']) ?></strong><br><?= h($m['resumen']) ?></p>
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
                            <?php if ($error !== ''): ?><div class="msg error"><?= h($error) ?></div><?php endif; ?>
                            <?php if ($info !== ''): ?><div class="msg ok"><?= h($info) ?></div><?php endif; ?>

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

                $replyDate = !empty($mensajeSeleccionado['fecha_unix']) ? date('Y-m-d H:i', (int)$mensajeSeleccionado['fecha_unix']) : '';

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
                            <?php if ($error !== ''): ?><div class="msg error"><?= h($error) ?></div><?php endif; ?>
                            <?php if ($info !== ''): ?><div class="msg ok"><?= h($info) ?></div><?php endif; ?>

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
                    <p><?= $mensajeSeleccionado ? 'Vista de conversación en ' . h(nombreCarpetaUI($folder)) : 'Selecciona una conversación de la columna central' ?></p>
                </div>

                <div id="panel">
                    <?php if ($error !== ''): ?><div class="msg error"><?= h($error) ?></div><?php endif; ?>
                    <?php if ($info !== ''): ?><div class="msg ok"><?= h($info) ?></div><?php endif; ?>

                    <?php if ($mensajeSeleccionado): ?>
                        <div class="inline-actions">
                            <a class="toolbtn primario" href="?vista=responder&folder=<?= h($folder) ?>&msg=<?= (int)$mensajeSeleccionado['id'] ?>">↩ Responder</a>
                            <a class="toolbtn-link" href="?vista=nuevo&folder=<?= h($folder) ?>">✉ Nuevo correo</a>

                            <?php if ($mensajeSeleccionado['carpeta'] !== 'TRASH'): ?>
                                <form class="inline-form" method="post">
                                    <input type="hidden" name="action" value="move_to_trash">
                                    <input type="hidden" name="msg_id" value="<?= (int)$mensajeSeleccionado['id'] ?>">
                                    <button class="toolbtn-link" type="submit">🗑 Enviar a papelera</button>
                                </form>
                            <?php endif; ?>

                            <?php if ($mensajeSeleccionado['carpeta'] !== 'JUNK'): ?>
                                <form class="inline-form" method="post">
                                    <input type="hidden" name="action" value="move_to_spam">
                                    <input type="hidden" name="msg_id" value="<?= (int)$mensajeSeleccionado['id'] ?>">
                                    <button class="toolbtn-link" type="submit">🚫 Marcar como spam</button>
                                </form>
                            <?php endif; ?>
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
