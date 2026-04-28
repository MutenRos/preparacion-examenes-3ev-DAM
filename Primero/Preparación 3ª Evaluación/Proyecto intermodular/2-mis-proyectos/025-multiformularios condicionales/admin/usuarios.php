<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/layout.php';
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';

require_superadmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = (string)($_POST['password'] ?? '');

    if ($username !== '' && $password !== '') {
        $stmt = $db->prepare("INSERT INTO users(username,password,role,created_at) VALUES(?,?,?,?)");
        try {
            $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), 'user', now_iso()]);
            flash_set('Usuario creado correctamente');
            redirect('usuarios.php');
        } catch (Throwable $e) {
            flash_set('No se pudo crear el usuario. Es posible que el nombre ya exista.');
            redirect('usuarios.php');
        }
    }
}

admin_header('Usuarios');

echo '<div class="card">';
echo '<h1>Crear usuario</h1>';
echo '<form method="post">';
echo '<div class="row">';
echo '<div><label>Usuario</label><input type="text" name="username" required></div>';
echo '<div><label>Clave</label><input type="password" name="password" required></div>';
echo '</div>';
echo '<p><button type="submit">Crear</button></p>';
echo '</form>';
echo '</div>';

echo '<div class="card">';
echo '<h2>Usuarios existentes</h2>';
echo '<table><tr><th>ID</th><th>Usuario</th><th>Rol</th><th>Creado</th></tr>';
foreach ($db->query("SELECT id,username,role,created_at FROM users ORDER BY id DESC") as $u) {
    echo '<tr>';
    echo '<td>' . h((string)$u['id']) . '</td>';
    echo '<td>' . h($u['username']) . '</td>';
    echo '<td>' . h($u['role']) . '</td>';
    echo '<td>' . h($u['created_at']) . '</td>';
    echo '</tr>';
}
echo '</table>';
echo '</div>';

admin_footer();
