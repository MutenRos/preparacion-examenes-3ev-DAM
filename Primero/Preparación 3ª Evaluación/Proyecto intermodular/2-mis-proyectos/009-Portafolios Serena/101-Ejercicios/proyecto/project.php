<?php
require_once 'auth.php';
require_login();

$user = current_user();
$pdo = db();

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user['id']]);
$project = $stmt->fetch();

if (!$project) {
	http_response_code(404);
	echo "Proyecto no encontrado";
	exit;
}

$html_inicial = $project['last_code'];

if (trim($html_inicial) === '') {
	$html_inicial = '<!doctype html>
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
main{max-width:700px;}
</style>
</head>
<body>
	<main>
		<h1>' . htmlspecialchars($project['title']) . '</h1>
		<p>Escribe un prompt para generar la web de este proyecto.</p>
	</main>
</body>
</html>';
}
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= htmlspecialchars($project['title']) ?></title>
	<style>
		*{box-sizing:border-box;}
		html,body{
			margin:0;
			padding:0;
			width:100%;
			height:100%;
			font-family:Arial,sans-serif;
			overflow:hidden;
			background:#0f172a;
		}
		#preview{
			position:fixed;
			inset:0;
			width:100%;
			height:100%;
			border:0;
			background:white;
		}
		#panel{
			position:fixed;
			top:30px;
			left:30px;
			width:460px;
			max-width:calc(100vw - 40px);
			background:rgba(255,255,255,0.16);
			backdrop-filter:blur(14px);
			-webkit-backdrop-filter:blur(14px);
			border:1px solid rgba(255,255,255,0.20);
			border-radius:16px;
			box-shadow:0 10px 30px rgba(0,0,0,0.35);
			z-index:1000;
			overflow:hidden;
			color:white;
		}
		#barra{
			padding:12px 16px;
			cursor:move;
			background:rgba(255,255,255,0.10);
			border-bottom:1px solid rgba(255,255,255,0.12);
			font-weight:bold;
			user-select:none;
		}
		#contenido{
			padding:16px;
		}
		textarea{
			width:100%;
			min-height:130px;
			resize:vertical;
			padding:12px;
			border-radius:10px;
			border:1px solid rgba(255,255,255,0.2);
			background:rgba(255,255,255,0.18);
			color:white;
			outline:none;
			font-size:14px;
		}
		textarea::placeholder{
			color:rgba(255,255,255,0.75);
		}
		.actions{
			display:flex;
			gap:10px;
			margin-top:10px;
			flex-wrap:wrap;
		}
		button,a{
			padding:10px 14px;
			border:none;
			border-radius:10px;
			text-decoration:none;
			cursor:pointer;
			background:#2563eb;
			color:white;
		}
		a.secondary{
			background:rgba(255,255,255,0.10);
			border:1px solid rgba(255,255,255,0.15);
		}
		#estado{
			margin-top:10px;
			font-size:12px;
			min-height:18px;
		}
	</style>
</head>
<body>
	<iframe id="preview"></iframe>

	<div id="panel">
		<div id="barra">Proyecto: <?= htmlspecialchars($project['title']) ?></div>
		<div id="contenido">
			<textarea id="peticion" placeholder="Describe cómo quieres la web"><?= htmlspecialchars($project['last_prompt']) ?></textarea>
			<div class="actions">
				<button id="generar">Generar</button>
				<a class="secondary" href="dashboard.php">Volver al dashboard</a>
			</div>
			<div id="estado"></div>
		</div>
	</div>

	<script>
		const preview = document.getElementById("preview");
		const peticion = document.getElementById("peticion");
		const estado = document.getElementById("estado");
		const generar = document.getElementById("generar");
		const panel = document.getElementById("panel");
		const barra = document.getElementById("barra");

		function actualizarPreview(html){
			const doc = preview.contentDocument || preview.contentWindow.document;
			doc.open();
			doc.write(html);
			doc.close();
		}

		actualizarPreview(<?= json_encode($html_inicial, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>);

		async function lanzarProyecto(){
			const prompt = peticion.value.trim();

			estado.textContent = "Generando...";

			try{
				const formData = new FormData();
				formData.append("project_id", "<?= (int)$project['id'] ?>");
				formData.append("prompt", prompt);

				const response = await fetch("run_project.php", {
					method: "POST",
					body: formData
				});

				const data = await response.json();

				if(data.ok){
					actualizarPreview(data.code);
					estado.textContent = "Guardado y actualizado";
				}else{
					estado.textContent = data.error || "Error";
				}
			}catch(e){
				estado.textContent = "Error de conexión";
			}
		}

		generar.addEventListener("click", lanzarProyecto);

		let temporizador = null;
		peticion.addEventListener("input", function(){
			clearTimeout(temporizador);
			temporizador = setTimeout(lanzarProyecto, 700);
		});

		let arrastrando = false;
		let offsetX = 0;
		let offsetY = 0;

		barra.addEventListener("mousedown", function(e){
			arrastrando = true;
			offsetX = e.clientX - panel.offsetLeft;
			offsetY = e.clientY - panel.offsetTop;
		});

		document.addEventListener("mousemove", function(e){
			if(!arrastrando) return;

			let x = e.clientX - offsetX;
			let y = e.clientY - offsetY;

			const maxX = window.innerWidth - panel.offsetWidth;
			const maxY = window.innerHeight - panel.offsetHeight;

			if(x < 0) x = 0;
			if(y < 0) y = 0;
			if(x > maxX) x = maxX;
			if(y > maxY) y = maxY;

			panel.style.left = x + "px";
			panel.style.top = y + "px";
		});

		document.addEventListener("mouseup", function(){
			arrastrando = false;
		});
	</script>
</body>
</html>
