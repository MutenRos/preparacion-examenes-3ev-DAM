<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function require_login(): void {
    if (empty($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }
}

function current_user(): ?array {
    return $_SESSION['user'] ?? null;
}

function is_superadmin(): bool {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'superadmin';
}

function require_superadmin(): void {
    require_login();
    if (!is_superadmin()) {
        http_response_code(403);
        die('Acceso denegado');
    }
}
