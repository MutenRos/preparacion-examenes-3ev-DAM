<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/layout.php';
require_once __DIR__ . '/../inc/db.php';

require_login();
$user = current_user();

admin_header('Panel');

if ($user['role'] === 'superadmin') {
    $numUsers = (int)$db->query("SELECT COUNT(*) FROM users WHERE role='user'")->fetchColumn();
} else {
    $numUsers = 0;
}

$stmt = $db->prepare("SELECT COUNT(*) FROM forms WHERE user_id = ?");
$stmt->execute([$user['id']]);
$numForms = (int)$stmt->fetchColumn();

$stmt = $db->prepare("
SELECT COUNT(*)
FROM responses r
INNER JOIN forms f ON f.id = r.form_id
WHERE f.user_id = ?
");
$stmt->execute([$user['id']]);
$numResponses = (int)$stmt->fetchColumn();

echo '<div class="card"><h1>Panel principal</h1>';
echo '<div class="row">';
echo '<div><h3>Formularios</h3><p>' . h((string)$numForms) . '</p></div>';
echo '<div><h3>Respuestas</h3><p>' . h((string)$numResponses) . '</p></div>';
echo '</div>';
if ($user['role'] === 'superadmin') {
    echo '<p>Usuarios creados: <strong>' . h((string)$numUsers) . '</strong></p>';
}
echo '</div>';

echo '<div class="card">';
echo '<h2>Accesos rápidos</h2>';
echo '<p><a class="btn" href="formularios.php">Gestionar formularios</a></p>';
if ($user['role'] === 'superadmin') {
    echo '<p><a class="btn secondary" href="usuarios.php">Gestionar usuarios</a></p>';
}
echo '</div>';

admin_footer();
