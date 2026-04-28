<?php
require_once 'auth.php';
require_login();

header('Content-Type: application/json; charset=utf-8');

$user = current_user();
$pdo = db();

$project_id = (int)($_POST['project_id'] ?? 0);
$prompt = trim($_POST['prompt'] ?? '');

$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ? AND user_id = ?");
$stmt->execute([$project_id, $user['id']]);
$project = $stmt->fetch();

if (!$project) {
	echo json_encode([
		'ok' => false,
		'error' => 'Proyecto no encontrado'
	]);
	exit;
}

if ($prompt === '') {
	$empty = '<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vista previa</title>
<style>
body{
	margin:0;
	font-family:Arial,sans-serif;
	background:#111827;
	color:white;
	display:flex;
	align-items:center;
	justify-content:center;
	min-height:100vh;
	padding:40px;
	text-align:center;
}
</style>
</head>
<body>
	<div>
		<h1>' . htmlspecialchars($project['title']) . '</h1>
		<p>Escribe un prompt para generar la web de este proyecto.</p>
	</div>
</body>
</html>';

	$upd = $pdo->prepare("UPDATE projects SET last_prompt = ?, last_code = ?, updated_at = datetime('now') WHERE id = ?");
	$upd->execute([$prompt, $empty, $project_id]);

	echo json_encode([
		'ok' => true,
		'code' => $empty
	]);
	exit;
}

$system = '
Hazme una web sencilla.
Solo quiero el código, nada de explicación.
Importante: Sólo código fuente.
Nada de explicación.
Solo código sin fences.
Devuelve HTML completo, con sus etiquetas html, head y body.
';

$url = 'http://localhost:11434/api/generate';

$data = [
	'model' => 'qwen2.5-coder:7b',
	'prompt' => $system . "\n" . $prompt,
	'stream' => false
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_TIMEOUT, 120);

$response = curl_exec($ch);

if (curl_errno($ch)) {
	echo json_encode([
		'ok' => false,
		'error' => 'Error cURL: ' . curl_error($ch)
	]);
	curl_close($ch);
	exit;
}

curl_close($ch);

$resultado = json_decode($response, true);

if (!isset($resultado['response'])) {
	echo json_encode([
		'ok' => false,
		'error' => 'Respuesta no válida'
	]);
	exit;
}

$code = trim($resultado['response']);
$code = preg_replace('/^```html\s*/i', '', $code);
$code = preg_replace('/^```\s*/', '', $code);
$code = preg_replace('/\s*```$/', '', $code);
$code = trim($code);

if ($code === '') {
	$code = '<!doctype html><html><head><meta charset="utf-8"><title>Vacío</title></head><body><p>El modelo no devolvió contenido.</p></body></html>';
}

$upd = $pdo->prepare("UPDATE projects SET last_prompt = ?, last_code = ?, updated_at = datetime('now') WHERE id = ?");
$upd->execute([$prompt, $code, $project_id]);

echo json_encode([
	'ok' => true,
	'code' => $code
]);
?>
