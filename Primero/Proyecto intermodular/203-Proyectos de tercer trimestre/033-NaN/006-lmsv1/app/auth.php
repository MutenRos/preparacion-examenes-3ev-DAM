<?php
require_once __DIR__ . '/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function current_user(): ?array {
    if (empty($_SESSION['user_id'])) return null;
    return one("SELECT u.*, p.nombre AS perfil FROM usuarios u JOIN perfiles p ON p.id = u.perfil_id WHERE u.id = ? AND u.activo = 1", [$_SESSION['user_id']]);
}

function require_login(): array {
    $user = current_user();
    if (!$user) {
        header('Location: index.php?page=login');
        exit;
    }
    return $user;
}

function is_manager(array $user): bool {
    return in_array($user['perfil'], ['gestor', 'administrador'], true);
}

function is_teacher_or_more(array $user): bool {
    return in_array($user['perfil'], ['profesor', 'gestor', 'administrador'], true);
}

function login_attempt(string $email, string $password): bool {
    $user = one("SELECT * FROM usuarios WHERE email = ? AND activo = 1", [$email]);
    if (!$user) return false;
    if (!password_verify($password, $user['password_hash'])) return false;
    $_SESSION['user_id'] = (int)$user['id'];
    return true;
}

function logout(): void {
    $_SESSION = [];
    session_destroy();
}
