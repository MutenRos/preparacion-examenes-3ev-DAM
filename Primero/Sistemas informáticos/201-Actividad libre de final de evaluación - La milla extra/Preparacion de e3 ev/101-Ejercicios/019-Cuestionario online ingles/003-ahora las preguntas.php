<?php

$url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQeVmlAFCtirR1M95fvI7bPn7n5IjVtpAQaWkajA-JQ9-JnXSxBec1XyIyYPOiO2PIWlnAUB3SW0e9E/pub?output=csv";

// Fetch CSV content
$csv = file_get_contents($url);

if ($csv === false) {
    die("Error fetching CSV");
}

// Convert CSV string into array of rows
$lines = array_map('str_getcsv', explode("\n", trim($csv)));

// Extract header row
$headers = array_map('trim', array_shift($lines));

// Build final associative array
$data = [];

foreach ($lines as $row) {
    if (count($row) === count($headers)) {
        $data[] = array_combine($headers, $row);
    }
}

for($i = 0;$i<count($data);$i++){
	echo '<p>'.$data[$i]['Pregunta'].'</p>';
	echo '<input type="radio" name="'.$data[$i]['Pregunta'].'" value="'.$data[$i]['Respuesta 1'].'">'.$data[$i]['Respuesta 1'].'<br>';
	echo '<input type="radio" name="'.$data[$i]['Pregunta'].'" value="'.$data[$i]['Respuesta 2'].'">'.$data[$i]['Respuesta 2'].'<br>';
	echo '<input type="radio" name="'.$data[$i]['Pregunta'].'" value="'.$data[$i]['Respuesta 3'].'">'.$data[$i]['Respuesta 3'].'<br>';
	echo '<input type="radio" name="'.$data[$i]['Pregunta'].'" value="'.$data[$i]['Respuesta 4'].'">'.$data[$i]['Respuesta 4'].'<br>';
}
