<?php
// =====================================================
// index.php - Login simple contra tabla `usuarios`
// Dump: horariostame
// =====================================================

session_start();

// ---------- DB CONFIG (EDIT THIS) ----------
$db_host = "localhost";
$db_user = "horariostame";
$db_pass = "Horariostame123$";
$db_name = "horariostame";
// ------------------------------------------

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

if(isset($_SESSION["usuario_id"])){
	header("Location: dashboard.php");
	exit;
}

$error = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){
	$usuario = trim($_POST["usuario"] ?? "");
	$contrasena = (string)($_POST["contrasena"] ?? "");

	if($usuario === "" || $contrasena === ""){
		$error = "Introduce usuario y contraseña.";
	}else{
		$mysqli = @new mysqli($db_host, $db_user, $db_pass, $db_name);
		if($mysqli->connect_errno){
			$error = "Error de conexión a BD.";
		}else{
			$mysqli->set_charset("utf8mb4");

			$stmt = $mysqli->prepare("SELECT id, usuario, contrasena, nombre_completo FROM usuarios WHERE usuario = ? LIMIT 1");
			$stmt->bind_param("s", $usuario);
			$stmt->execute();
			$res = $stmt->get_result();
			$row = $res ? $res->fetch_assoc() : null;

			if(!$row){
				$error = "Usuario o contraseña incorrectos.";
			}else{
				$stored = (string)$row["contrasena"];
				$ok = false;

				// Soporta: texto plano (como en tu dump) y hashes tipo password_hash
				if(preg_match('/^\$2y\$|\$2a\$|\$2b\$|\$argon2/i', $stored)){
					$ok = password_verify($contrasena, $stored);
				}else{
					$ok = hash_equals($stored, $contrasena);
				}

				if($ok){
					$_SESSION["usuario_id"] = (int)$row["id"];
					$_SESSION["usuario"] = (string)$row["usuario"];
					$_SESSION["nombre_completo"] = (string)$row["nombre_completo"];
					header("Location: dashboard.php");
					exit;
				}else{
					$error = "Usuario o contraseña incorrectos.";
				}
			}

			if($stmt){ $stmt->close(); }
			$mysqli->close();
		}
	}
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="estilo.css">
		<title>Login</title>
	</head>
	<body id="bodylogin">
		<form id="login" method="post" action="index.php">
			<h1>Acceso</h1>

			<?php if($error !== ""): ?>
				<div class="msg error"><?php echo h($error); ?></div>
			<?php endif; ?>

			<input type="text" name="usuario" placeholder="Usuario" value="<?php echo h($_POST["usuario"] ?? ""); ?>" autocomplete="username">
			<input type="password" name="contrasena" placeholder="Contraseña" autocomplete="current-password">
			<input type="submit" value="Entrar">
			<p class="hint">Base de datos: <b><?php echo h($db_name); ?></b></p>
		</form>
	</body>
</html>
