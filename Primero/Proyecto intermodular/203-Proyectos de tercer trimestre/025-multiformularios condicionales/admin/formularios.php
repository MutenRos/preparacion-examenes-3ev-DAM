<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/layout.php';
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';

require_login();
$user = current_user();

if (isset($_GET['toggle'])) {
    $formId = (int)$_GET['toggle'];
    $stmt = $db->prepare("SELECT * FROM forms WHERE id = ? AND user_id = ?");
    $stmt->execute([$formId, $user['id']]);
    $form = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($form) {
        $newValue = (int)!((int)$form['is_active']);
        $up = $db->prepare("UPDATE forms SET is_active = ?, updated_at = ? WHERE id = ?");
        $up->execute([$newValue, now_iso(), $formId]);
        flash_set('Estado del formulario actualizado');
    }
    redirect('formularios.php');
}

admin_header('Formularios');

echo '<div class="card">';
echo '<h1>Mis formularios</h1>';
echo '<p><a class="btn" href="formulario_editar.php">Crear formulario</a></p>';
echo '</div>';

$stmt = $db->prepare("
SELECT f.*,
       (SELECT COUNT(*) FROM responses r WHERE r.form_id = f.id) AS total_respuestas
FROM forms f
WHERE f.user_id = ?
ORDER BY f.id DESC
");
$stmt->execute([$user['id']]);

echo '<div class="card"><table>';
echo '<tr><th>ID</th><th>Título</th><th>Hash</th><th>Estado</th><th>Respuestas</th><th>Acciones</th></tr>';
foreach ($stmt as $f) {
    $publicUrl = '../public/form.php?h=' . urlencode($f['hash']);
    echo '<tr>';
    echo '<td>' . h((string)$f['id']) . '</td>';
    echo '<td>' . h($f['title']) . '</td>';
    echo '<td><code>' . h($f['hash']) . '</code></td>';
    echo '<td>' . (((int)$f['is_active']) ? 'Activo' : 'Inactivo') . '</td>';
    echo '<td>' . h((string)$f['total_respuestas']) . '</td>';
    echo '<td class="actions">';
    echo '<a href="formulario_editar.php?id=' . h((string)$f['id']) . '">Editar</a> ';
    echo '<a href="' . h($publicUrl) . '" target="_blank">Abrir</a> ';
    echo '<a href="respuestas.php?id=' . h((string)$f['id']) . '">Respuestas</a> ';
    echo '<a href="formularios.php?toggle=' . h((string)$f['id']) . '">' . (((int)$f['is_active']) ? 'Desactivar' : 'Activar') . '</a>';
    echo '</td>';
    echo '</tr>';
}
echo '</table></div>';

admin_footer();
