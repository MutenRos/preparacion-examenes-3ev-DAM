<?php
require_once 'auth.php';

if (current_user()) {
	header("Location: dashboard.php");
	exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = trim($_POST['email'] ?? '');
	$password = $_POST['password'] ?? '';

	$stmt = db()->prepare("SELECT * FROM users WHERE email = ?");
	$stmt->execute([$email]);
	$user = $stmt->fetch();

	if (!$user || !password_verify($password, $user['password'])) {
		$error = 'Credenciales incorrectas';
	} else {
		$_SESSION['user_id'] = $user['id'];
		header("Location: dashboard.php");
		exit;
	}
}
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Iniciar sesión</title>
	<style>
		body{
			margin:0;
			font-family:Arial,sans-serif;
			background:#0f172a;
			color:white;
			display:flex;
			align-items:center;
			justify-content:center;
			min-height:100vh;
			padding:20px;
		}
		.box{
			width:100%;
			max-width:420px;
			background:rgba(255,255,255,0.08);
			border:1px solid rgba(255,255,255,0.12);
			border-radius:18px;
			padding:30px;
		}
		input{
			width:100%;
			padding:12px;
			margin-bottom:12px;
			border-radius:10px;
			border:1px solid #334155;
			background:#1e293b;
			color:white;
		}
		button,a{
			display:inline-block;
			padding:12px 16px;
			border:none;
			border-radius:10px;
			text-decoration:none;
			cursor:pointer;
		}
		button{
			background:#2563eb;
			color:white;
		}
		a{
			color:white;
			background:rgba(255,255,255,0.08);
			margin-left:8px;
		}
		.error{
			background:#7f1d1d;
			padding:10px;
			border-radius:10px;
			margin-bottom:12px;
		}
	</style>
</head>
<body>
	<div class="box">
		<h1>Iniciar sesión</h1>
		<?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
		<form method="post">
			<input type="email" name="email" placeholder="Email" required>
			<input type="password" name="password" placeholder="Contraseña" required>
			<button type="submit">Entrar</button>
			<a href="index.php">Volver</a>
		</form>
	</div>
</body>
</html>
