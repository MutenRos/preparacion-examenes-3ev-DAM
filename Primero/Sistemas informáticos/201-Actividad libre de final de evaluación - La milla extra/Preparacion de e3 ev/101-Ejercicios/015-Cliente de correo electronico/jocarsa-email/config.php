<?php
session_start();
date_default_timezone_set('Europe/Madrid');

define('DB_FILE', __DIR__ . '/correo.sqlite');
define('IMAP_PORT', 993);
define('IMAP_FLAGS', '/imap/ssl');
define('SMTP_PORT_TLS', 587);
define('SMTP_TIMEOUT', 20);
