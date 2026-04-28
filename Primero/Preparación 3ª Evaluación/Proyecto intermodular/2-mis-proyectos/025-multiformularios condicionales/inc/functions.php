<?php
declare(strict_types=1);

function h(?string $value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function now_iso(): string {
    return date('c');
}

function generate_hash(): string {
    return bin2hex(random_bytes(16));
}

function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

function flash_set(string $message): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['flash'] = $message;
}

function flash_get(): ?string {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $msg = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $msg;
}
