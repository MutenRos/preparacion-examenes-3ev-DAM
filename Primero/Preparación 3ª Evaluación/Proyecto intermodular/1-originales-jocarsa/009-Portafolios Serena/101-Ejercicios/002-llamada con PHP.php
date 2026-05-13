<?php
$prompt = 'Hazme una web sencilla. Solo quiero el código, nada de explicación. Importante: Sólo código fuente. Nada de explicación. Solo código sin fences.';

$url = 'http://localhost:11434/api/generate';

$data = [
    'model' => 'qwen2.5-coder:7b',
    'prompt' => $prompt,
    'stream' => false
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    die('Error cURL: ' . curl_error($ch));
}

curl_close($ch);

$resultado = json_decode($response, true);

if (isset($resultado['response'])) {
    echo $resultado['response'];
} else {
    echo "Respuesta no válida:\n";
    print_r($resultado);
}
?>
