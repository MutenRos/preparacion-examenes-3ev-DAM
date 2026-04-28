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

// Output result
echo "<pre>";
print_r($data);
echo "</pre>";
