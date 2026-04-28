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

