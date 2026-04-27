<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/auth.php';
require_once __DIR__ . '/../inc/layout.php';
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/functions.php';
require_once __DIR__ . '/../inc/form_engine.php';

require_login();
$user = current_user();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$form = null;
$title = '';
$markup = "[text][required] Indica tu nombre\n[number] Indica tu edad\n[radio] Selecciona tu ciclo\n\t[case] DAM\n\t\t[text] Has elegido DAM\n\t[case] SMR\n\t\t[text] Has elegido SMR";

if ($id > 0) {
    $stmt = $db->prepare("SELECT * FROM forms WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $user['id']]);
    $form = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$form) {
        die('Formulario no encontrado');
    }
    $title = $form['title'];
    $markup = $form['markup'];
}

$error = null;
$previewHtml = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $markup = (string)($_POST['markup'] ?? '');

    try {
        $parsed = fe_parse_markup($markup);
        $previewHtml = fe_render_fields($parsed);

        if ($title === '') {
            throw new RuntimeException('El título es obligatorio');
        }

        if ($id > 0) {
            $stmt = $db->prepare("UPDATE forms SET title = ?, markup = ?, updated_at = ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$title, $markup, now_iso(), $id, $user['id']]);
            flash_set('Formulario actualizado correctamente');
            redirect('formularios.php');
        } else {
            $stmt = $db->prepare("INSERT INTO forms(user_id,title,hash,markup,is_active,created_at) VALUES(?,?,?,?,1,?)");
            $stmt->execute([$user['id'], $title, generate_hash(), $markup, now_iso()]);
            flash_set('Formulario creado correctamente');
            redirect('formularios.php');
        }
    } catch (Throwable $e) {
        $error = $e->getMessage();
    }
}

admin_header($id > 0 ? 'Editar formulario' : 'Crear formulario');

echo '<div class="card">';
echo '<h1>' . ($id > 0 ? 'Editar formulario' : 'Crear formulario') . '</h1>';
if ($error) {
    echo '<div style="background:#fdeaea;border:1px solid #f1b5b5;padding:12px;border-radius:8px;margin-bottom:16px;">' . h($error) . '</div>';
}
echo '<form method="post">';
echo '<div class="row">';
echo '<div><label>Título</label><input type="text" name="title" value="' . h($title) . '" required></div>';
echo '<div><label>Ayuda</label><div class="muted">Usa tabulaciones reales para los niveles anidados.</div></div>';
echo '</div>';
echo '<label>Marcaje</label>';
echo '<textarea name="markup" required>' . h($markup) . '</textarea>';
echo '<p><button type="submit">Guardar formulario</button> <a class="btn secondary" href="formularios.php">Volver</a></p>';
echo '</form>';
echo '</div>';

try {
    $parsed = fe_parse_markup($markup);
    $previewHtml = fe_render_fields($parsed);
    echo '<div class="card"><h2>Vista previa</h2>';
    echo fe_public_styles();
    echo $previewHtml;
    echo fe_public_script();
    echo '</div>';
} catch (Throwable $e) {
    echo '<div class="card"><h2>Vista previa</h2><p>No se pudo generar la vista previa.</p></div>';
}

admin_footer();
