<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Generador web con Ollama</title>
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
		body{
			position:relative;
		}
		#fondo{
			position:absolute;
			inset:0;
			background:#0f172a;
		}
		#preview{
			width:100%;
			height:100%;
			border:0;
			display:block;
			background:white;
		}
		#panel{
			position:fixed;
			top:30px;
			left:30px;
			width:420px;
			max-width:calc(100vw - 40px);
			background:rgba(255,255,255,0.16);
			backdrop-filter:blur(14px);
			-webkit-backdrop-filter:blur(14px);
			border:1px solid rgba(255,255,255,0.20);
			border-radius:16px;
			box-shadow:0 10px 30px rgba(0,0,0,0.35);
			z-index:1000;
			overflow:hidden;
		}
		#barra{
			padding:12px 16px;
			cursor:move;
			background:rgba(255,255,255,0.10);
			border-bottom:1px solid rgba(255,255,255,0.12);
			color:white;
			font-weight:bold;
			user-select:none;
		}
		#contenidoPanel{
			padding:16px;
		}
		#contenidoPanel p{
			margin:0 0 10px 0;
			color:white;
		}
		#peticion{
			width:100%;
			min-height:120px;
			resize:vertical;
			padding:12px;
			border-radius:10px;
			border:1px solid rgba(255,255,255,0.2);
			background:rgba(255,255,255,0.18);
			color:white;
			outline:none;
			font-size:14px;
		}
		#peticion::placeholder{
			color:rgba(255,255,255,0.75);
		}
		#estado{
			margin-top:10px;
			font-size:12px;
			color:rgba(255,255,255,0.95);
			min-height:18px;
		}
	</style>
</head>
<body>
<?php
	function generar_html($peticion) {
		$system = '
Hazme una web sencilla.
Solo quiero el código, nada de explicación.
Importante: Sólo código fuente.
Nada de explicación.
Solo código sin fences.
Devuelve HTML completo, con sus etiquetas html, head y body.
';

		$peticion = trim($peticion);

		if ($peticion === '') {
			return '<!doctype html>
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
main{
	max-width:700px;
}
h1{
	margin-top:0;
}
</style>
</head>
<body>
	<main>
		<h1>Escribe una petición</h1>
		<p>La web generada aparecerá aquí automáticamente.</p>
	</main>
</body>
</html>';
		}

		$url = 'http://localhost:11434/api/generate';

		$data = [
			'model' => 'qwen2.5-coder:7b',
			'prompt' => $system . "\n" . $peticion,
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
			$error = curl_error($ch);
			curl_close($ch);

			return '<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Error</title>
<style>
body{font-family:Arial,sans-serif;background:#1f2937;color:white;padding:40px;}
pre{white-space:pre-wrap;background:#111827;padding:15px;border-radius:8px;}
</style>
</head>
<body>
<h1>Error cURL</h1>
<pre>' . htmlspecialchars($error) . '</pre>
</body>
</html>';
		}

		curl_close($ch);

		$resultado = json_decode($response, true);

		if (!isset($resultado['response'])) {
			return '<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Respuesta no válida</title>
<style>
body{font-family:Arial,sans-serif;background:#1f2937;color:white;padding:40px;}
pre{white-space:pre-wrap;background:#111827;padding:15px;border-radius:8px;}
</style>
</head>
<body>
<h1>Respuesta no válida</h1>
<pre>' . htmlspecialchars(print_r($resultado, true)) . '</pre>
</body>
</html>';
		}

		$html = trim($resultado['response']);

		$html = preg_replace('/^```html\s*/i', '', $html);
		$html = preg_replace('/^```\s*/', '', $html);
		$html = preg_replace('/\s*```$/', '', $html);
		$html = trim($html);

		if ($html === '') {
			return '<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Vacío</title>
</head>
<body>
<p>El modelo no devolvió contenido.</p>
</body>
</html>';
		}

		return $html;
	}

	$peticion = $_GET['peticion'] ?? '';

	if (
		isset($_GET['ajax']) &&
		$_GET['ajax'] == '1'
	) {
		header('Content-Type: text/plain; charset=utf-8');
		echo generar_html($peticion);
		exit;
	}

	$html_inicial = generar_html($peticion);
?>
	<div id="fondo">
		<iframe id="preview"></iframe>
	</div>

	<div id="panel">
		<div id="barra">Generador web</div>
		<div id="contenidoPanel">
			<form onsubmit="return false;">
				<p>Indica cómo quieres tu web</p>
				<textarea id="peticion" name="peticion" placeholder="Por ejemplo: una landing sencilla con botón de contacto"><?= htmlspecialchars($peticion) ?></textarea>
				<div id="estado"></div>
			</form>
		</div>
	</div>

	<script>
		const preview = document.getElementById("preview");
		const peticion = document.getElementById("peticion");
		const estado = document.getElementById("estado");
		const panel = document.getElementById("panel");
		const barra = document.getElementById("barra");

		function actualizarPreview(html){
			const doc = preview.contentDocument || preview.contentWindow.document;
			doc.open();
			doc.write(html);
			doc.close();
		}

		actualizarPreview(<?= json_encode($html_inicial, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>);

		let temporizador = null;
		let controlador = null;

		async function pedirActualizacion(){
			const texto = peticion.value.trim();

			if(controlador){
				controlador.abort();
			}
			controlador = new AbortController();

			estado.textContent = texto === "" ? "" : "Generando...";

			try{
				const respuesta = await fetch("?" + new URLSearchParams({
					ajax: "1",
					peticion: texto
				}).toString(), {
					method: "GET",
					signal: controlador.signal
				});

				const html = await respuesta.text();
				actualizarPreview(html);
				estado.textContent = texto === "" ? "" : "Actualizado";
			}catch(error){
				if(error.name !== "AbortError"){
					estado.textContent = "Error al generar";
				}
			}
		}

		peticion.addEventListener("input", function(){
			clearTimeout(temporizador);
			temporizador = setTimeout(pedirActualizacion, 700);
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
