<?php

$url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vSnPzzPFyDT1mMvKU9XWdUZdI68tw65egXqAAABRsESkZ5nu7pZUorkf-NLq9y-Yx3A6XVUF0hcw-fW/pub?output=csv";

$datos = [];

if (($handle = fopen($url, "r")) !== false) {

    // Leer primera fila como nombres de columnas
    $cabeceras = fgetcsv($handle, 1000, ",");

    // Leer resto de filas
    while (($fila = fgetcsv($handle, 1000, ",")) !== false) {
        $datos[] = array_combine($cabeceras, $fila);
    }

    fclose($handle);
}


?>
<!doctype html>
<html>
	<head>
		<style>
			*{
	margin:0;
	padding:0;
	box-sizing:border-box;
}

:root{
	--fondo:#f5f7fa;
	--superficie:#ffffff;
	--borde:#d9e1e8;
	--texto:#1f2933;
	--texto-secundario:#52606d;
	--primario:#2d6cdf;
	--primario-hover:#1f5ac7;
	--sombra:0 8px 24px rgba(15, 23, 42, 0.08);
	--radio:12px;
	--ancho:1200px;
}

body{
	font-family:Arial, Helvetica, sans-serif;
	background:var(--fondo);
	color:var(--texto);
	line-height:1.5;
}

header{
	background:var(--superficie);
	border-bottom:1px solid var(--borde);
	box-shadow:0 2px 10px rgba(0,0,0,0.03);
}

header h1{
	max-width:var(--ancho);
	margin:auto;
	padding:30px 20px;
	font-size:32px;
	font-weight:700;
	color:var(--texto);
}

main{
	max-width:var(--ancho);
	margin:40px auto;
	padding:0 20px;
	display:grid;
	grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
	gap:24px;
}

article{
	background:var(--superficie);
	border:1px solid var(--borde);
	border-radius:var(--radio);
	padding:24px;
	box-shadow:var(--sombra);
	transition:transform 0.2s ease, box-shadow 0.2s ease;
}

article:hover{
	transform:translateY(-4px);
	box-shadow:0 12px 30px rgba(15, 23, 42, 0.12);
}

article h3{
	font-size:22px;
	margin-bottom:12px;
	color:var(--texto);
}

article p{
	font-size:15px;
	color:var(--texto-secundario);
	margin-bottom:10px;
}

article p strong{
	display:inline-block;
	margin-top:8px;
	font-size:22px;
	color:var(--primario);
}

footer{
	margin-top:40px;
	padding:30px 20px;
	text-align:center;
	color:var(--texto-secundario);
	font-size:14px;
	border-top:1px solid var(--borde);
	background:var(--superficie);
}

@media (max-width:768px){
	header h1{
		font-size:26px;
		padding:24px 16px;
	}

	main{
		margin:24px auto;
		padding:0 16px;
		gap:16px;
	}

	article{
		padding:18px;
	}
}
		</style>
	</head>
	<body>
		<header>
			<h1>Tienda de artículos deportivos</h1>
		</header>
		<main>
			<?php
				foreach($datos as $articulo){
					echo '
						<article>
							<h3>'.$articulo['nombre'].'</h3>
							<p>'.$articulo['descripcion'].'</p>
							<p><strong>'.$articulo['precio'].' €</strong></p>
						</article>
					';
				}
			?>
		</main>
		<footer>
			(c) 2026 Jose Vicente Carratala
		</footer>
	</body>
</html>

