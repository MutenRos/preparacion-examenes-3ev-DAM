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

// Mostrar resultado
echo "<pre>";
print_r($datos);
echo "</pre>";

?>

