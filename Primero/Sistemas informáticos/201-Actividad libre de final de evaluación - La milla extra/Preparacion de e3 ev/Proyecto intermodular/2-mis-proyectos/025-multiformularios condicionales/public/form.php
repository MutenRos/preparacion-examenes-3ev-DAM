<?php
declare(strict_types=1);
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/form_engine.php';

$hash = trim($_GET['h'] ?? '');
$stmt = $db->prepare("SELECT * FROM forms WHERE hash = ? AND is_active = 1");
$stmt->execute([$hash]);
$form = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$form) {
    http_response_code(404);
    echo '<!doctype html><html lang="es"><meta charset="utf-8"><body><p>Formulario no encontrado o inactivo.</p></body></html>';
    exit;
}

$parsed = fe_parse_markup($form['markup']);
$labels = fe_collect_labels($parsed);
$ok = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("INSERT INTO responses(form_id,submitted_at,ip_address,user_agent) VALUES(?,?,?,?)");
    $stmt->execute([
        $form['id'],
        date('c'),
        $_SERVER['REMOTE_ADDR'] ?? '',
        substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 1000)
    ]);
    $responseId = (int)$db->lastInsertId();

    foreach ($_POST as $fieldName => $value) {
        if (is_array($value)) {
            $value = implode(', ', array_map('strval', $value));
        } else {
            $value = (string)$value;
        }

        $fieldLabel = $labels[$fieldName] ?? $fieldName;

        $stmt = $db->prepare("INSERT INTO response_items(response_id,field_name,field_label,field_value) VALUES(?,?,?,?)");
        $stmt->execute([$responseId, (string)$fieldName, (string)$fieldLabel, $value]);
    }

    $ok = true;
}
?><!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php echo htmlspecialchars($form['title'], ENT_QUOTES, 'UTF-8'); ?></title>
<?php echo fe_public_styles(); ?>
</head>
<body>
<div class="wrap">
    <div class="card">
        <h1><?php echo htmlspecialchars($form['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <?php if ($ok): ?>
            <div class="ok">Tu respuesta se ha enviado correctamente.</div>
        <?php else: ?>
            <form method="post">
                <?php echo fe_render_fields($parsed); ?>
                <button type="submit">Enviar</button>
            </form>
        <?php endif; ?>
    </div>
</div>
<?php echo fe_public_script(); ?>
</body>
</html>
