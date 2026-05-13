<?php
$url = "http://127.0.0.1:11434/api/embed";

$data = [
    "model" => "nomic-embed-text:v1.5",
    "input" => "gato"
];

$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ],
    CURLOPT_POSTFIELDS => json_encode($data, JSON_UNESCAPED_UNICODE)
]);

$response = curl_exec($ch);

if ($response === false) {
    die("Error cURL: " . curl_error($ch));
}

curl_close($ch);

header("Content-Type: application/json; charset=utf-8");
echo $response;
