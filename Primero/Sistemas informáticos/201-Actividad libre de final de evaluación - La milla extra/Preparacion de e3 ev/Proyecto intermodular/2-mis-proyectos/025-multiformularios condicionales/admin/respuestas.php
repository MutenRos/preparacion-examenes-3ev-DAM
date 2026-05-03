<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/layout.php';
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';

require_login();
$user = current_user();
$formId = (int)($_GET['id'] ?? 0);

$stmt = $db->prepare("SELECT * FROM forms WHERE id = ? AND user_id = ?");
$stmt->execute([$formId, $user['id']]);
$form = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$form) {
    die('Formulario no encontrado');
}

admin_header('Respuestas');

echo '<div class="card">';
echo '<h1>Respuestas de: ' . h($form['title']) . '</h1>';
echo '<p>URL pública: <code>../public/form.php?h=' . h($form['hash']) . '</code></p>';
echo '</div>';

$stmt = $db->prepare("SELECT * FROM responses WHERE form_id = ? ORDER BY id DESC");
$stmt->execute([$formId]);
$responses = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$responses) {
    echo '<div class="card"><p>No hay respuestas todavía.</p></div>';
    admin_footer();
    exit;
}

foreach ($responses as $response) {
    echo '<div class="card">';
    echo '<h3>Respuesta #' . h((string)$response['id']) . '</h3>';
    echo '<p class="muted">Enviada: ' . h($response['submitted_at']) . '</p>';
    echo '<p class="muted">IP: ' . h((string)$response['ip_address']) . '</p>';

    $items = $db->prepare("SELECT * FROM response_items WHERE response_id = ? ORDER BY id ASC");
    $items->execute([$response['id']]);
    echo '<table><tr><th>Campo</th><th>Valor</th></tr>';
    foreach ($items as $item) {
        echo '<tr>';
        echo '<td>' . h($item['field_label']) . '</td>';
        echo '<td>' . nl2br(h((string)$item['field_value'])) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
}

admin_footer();
