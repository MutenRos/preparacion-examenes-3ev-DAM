<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Formulario</title>

<style>
:root{
    --fondo:#f5f7fb;
    --card:#ffffff;
    --borde:#d1d9e6;
    --texto:#1e293b;
    --muted:#64748b;
    --primary:#4f46e5;
    --primary-hover:#4338ca;
}

*{
    box-sizing:border-box;
    font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto;
}

body{
    margin:0;
    background:var(--fondo);
    color:var(--texto);
}

.container{
    max-width:800px;
    margin:40px auto;
    padding:20px;
}

.card{
    background:var(--card);
    border:1px solid var(--borde);
    border-radius:12px;
    padding:25px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

h1{
    margin-top:0;
    font-size:22px;
}

.form-group{
    margin-bottom:20px;
}

label{
    display:block;
    font-weight:600;
    margin-bottom:6px;
}

input[type="text"]{
    width:100%;
    padding:10px 12px;
    border-radius:8px;
    border:1px solid var(--borde);
    transition:0.2s;
}

input[type="text"]:focus{
    outline:none;
    border-color:var(--primary);
    box-shadow:0 0 0 3px rgba(79,70,229,0.15);
}

fieldset{
    border:1px solid var(--borde);
    border-radius:10px;
    padding:15px;
    margin-bottom:20px;
}

legend{
    padding:0 8px;
    font-weight:600;
    color:var(--primary);
}

.radio-option{
    margin-bottom:8px;
}

.radio-option label{
    font-weight:normal;
    cursor:pointer;
}

.radio-option input{
    margin-right:8px;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:var(--primary);
    color:white;
    font-weight:600;
    font-size:16px;
    cursor:pointer;
    transition:0.2s;
}

button:hover{
    background:var(--primary-hover);
}
</style>

</head>
<body>

<div class="container">
<div class="card">

<h1>Formulario de nivel</h1>

<form method="POST" action="?">

<div class="form-group">
    <label>Correo</label>
    <input type="text" name="correo" placeholder="Indica tu correo electrónico">
</div>

<div class="form-group">
    <label>Nombre y Apellidos</label>
    <input type="text" name="nombre" placeholder="Indica tu nombre y tus apellidos">
</div>

<div class="form-group">
    <label>Teléfono</label>
    <input type="text" name="telefono" placeholder="Indica tu teléfono">
</div>

<div class="form-group">
    <label>Curso en el que estás interesado/a</label>
    <input type="text" name="curso" placeholder="Curso en el que estás interesado/a">
</div>

<?php

$url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQeVmlAFCtirR1M95fvI7bPn7n5IjVtpAQaWkajA-JQ9-JnXSxBec1XyIyYPOiO2PIWlnAUB3SW0e9E/pub?output=csv";

$csv = file_get_contents($url);

if ($csv === false) {
    die("Error fetching CSV");
}

$lines = array_map('str_getcsv', explode("\n", trim($csv)));
$headers = array_map('trim', array_shift($lines));

$data = [];

foreach ($lines as $row) {
    if (count($row) === count($headers)) {
        $data[] = array_combine($headers, $row);
    }
}

foreach ($data as $index => $pregunta) {

    $name = "pregunta_" . $index;

    echo '<fieldset>';
    echo '<legend>' . htmlspecialchars($pregunta['Pregunta']) . '</legend>';

    for ($i = 1; $i <= 4; $i++) {
        $respuesta = htmlspecialchars($pregunta["Respuesta $i"]);
        echo '
        <div class="radio-option">
            <label>
                <input type="radio" name="'.$name.'" value="'.$respuesta.'">
                '.$respuesta.'
            </label>
        </div>';
    }

    echo '</fieldset>';
}

?>

<button type="submit">Enviar</button>

</form>

</div>
</div>

</body>
</html>
