<?php
require_once 'auth.php';
require_login();

$user = current_user();
$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$title = trim($_POST['title'] ?? '');
	$description = trim($_POST['description'] ?? '');

	if ($title !== '') {
		$stmt = $pdo->prepare("
			INSERT INTO projects (user_id, title, description, last_prompt, last_code, created_at, updated_at)
			VALUES (?, ?, ?, '', '', datetime('now'), datetime('now'))
		");
		$stmt->execute([$user['id'], $title, $description]);
		header("Location: dashboard.php");
		exit;
	}
}

$stmt = $pdo->prepare("SELECT * FROM projects WHERE user_id = ? ORDER BY updated_at DESC, id DESC");
$stmt->execute([$user['id']]);
$projects = $stmt->fetchAll();
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<style>
		*{box-sizing:border-box;}
		body{
			margin:0;
			font-family:Arial,sans-serif;
			background:#0f172a;
			color:white;
			padding:30px;
		}
		.top{
			display:flex;
			justify-content:space-between;
			align-items:center;
			gap:20px;
			margin-bottom:30px;
			flex-wrap:wrap;
		}
		.top a{
			text-decoration:none;
			color:white;
			background:rgba(255,255,255,0.08);
			padding:10px 14px;
			border-radius:10px;
		}
		.grid{
			display:grid;
			grid-template-columns:360px 1fr;
			gap:20px;
		}
		.card{
			background:rgba(255,255,255,0.08);
			border:1px solid rgba(255,255,255,0.12);
			border-radius:18px;
			padding:20px;
		}
		input,textarea,button{
			width:100%;
			padding:12px;
			border-radius:10px;
			border:1px solid #334155;
			background:#1e293b;
			color:white;
			margin-bottom:12px;
		}
		button{
			background:#2563eb;
			cursor:pointer;
		}
		.project{
			padding:16px;
			border-radius:14px;
			background:rgba(255,255,255,0.05);
			margin-bottom:12px;
		}
		.project a{
			display:inline-block;
			margin-top:10px;
			text-decoration:none;
			color:white;
			background:#2563eb;
			padding:10px 14px;
			border-radius:10px;
		}
		.small{
			color:rgba(255,255,255,0.75);
			font-size:13px;
		}
		@media (max-width: 900px){
			.grid{
				grid-template-columns:1fr;
			}
		}
	</style>
</head>
<body>
	<div class="top">
		<div>
			<h1>Dashboard</h1>
			<div class="small">Usuario: <?= htmlspecialchars($user['name']) ?> (<?= htmlspecialchars($user['email']) ?>)</div>
		</div>
		<div>
			<a href="index.php">Home</a>
			<a href="logout.php">Cerrar sesión</a>
		</div>
	</div>

	<div class="grid">
		<div class="card">
			<h2>Nuevo proyecto</h2>
			<form method="post">
				<input type="text" name="title" placeholder="Título del proyecto" required>
				<textarea name="description" placeholder="Descripción breve"></textarea>
				<button type="submit">Crear proyecto</button>
			</form>
		</div>

		<div class="card">
			<h2>Mis proyectos</h2>
			<?php if (!$projects): ?>
				<p>No hay proyectos todavía.</p>
			<?php endif; ?>

			<?php foreach ($projects as $project): ?>
				<div class="project">
					<h3><?= htmlspecialchars($project['title']) ?></h3>
					<p><?= nl2br(htmlspecialchars($project['description'])) ?></p>
					<div class="small">
						Creado: <?= htmlspecialchars($project['created_at']) ?><br>
						Actualizado: <?= htmlspecialchars($project['updated_at']) ?>
					</div>
					<a href="project.php?id=<?= (int)$project['id'] ?>">Abrir proyecto</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</body>
</html>
