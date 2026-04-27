<?php
header("Content-Type: text/plain; charset=utf-8");

// Leer el cuerpo JSON
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Comprobar que existe el dato
if (!isset($data["mensaje"])) {
    http_response_code(400);
    exit("No se recibió 'mensaje'");
}

$pregunta = $data["mensaje"];
$url = "https://covalently-untasked-daphne.ngrok-free.dev/chat/?q=" . urlencode($pregunta);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10000);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "Error cURL: " . curl_error($ch);
    curl_close($ch);
    exit;
}

curl_close($ch);

// Si la API devuelve texto plano:
echo $response;
?>
