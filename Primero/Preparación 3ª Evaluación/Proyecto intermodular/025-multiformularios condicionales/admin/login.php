<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['user'])) {
    redirect('index.php');
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = (string)($_POST['password'] ?? '');

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        redirect('index.php');
    } else {
        $error = 'Credenciales incorrectas';
    }
}
?><!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login</title>
<style>
body{font-family:Arial,sans-serif;background:#f4f5f7;margin:0;padding:24px}
.card{max-width:420px;margin:60px auto;background:#fff;padding:24px;border-radius:14px;box-shadow:0 2px 12px rgba(0,0,0,.08)}
label{display:block;font-weight:bold;margin-bottom:8px}
input{width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;box-sizing:border-box;margin-bottom:16px}
button{padding:12px 18px;border:0;border-radius:8px;background:#111;color:#fff;cursor:pointer}
.err{background:#fdeaea;border:1px solid #f1b5b5;padding:12px;border-radius:8px;margin-bottom:16px}
</style>
</head>
<body>
<div class="card">
<h1>Acceso</h1>
<?php if ($error): ?><div class="err"><?php echo h($error); ?></div><?php endif; ?>
<form method="post">
    <label>Usuario</label>
    <input type="text" name="username" required>
    <label>Clave</label>
    <input type="password" name="password" required>
    <button type="submit">Entrar</button>
</form>
<p><strong>Demo inicial:</strong> admin / admin123</p>
</div>
</body>
</html>
