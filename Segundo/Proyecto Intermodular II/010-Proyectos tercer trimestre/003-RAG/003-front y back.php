<?php
declare(strict_types=1);

if (isset($_GET['api']) && $_GET['api'] === 'embed') {
    $url = "http://127.0.0.1:11434/api/embed";

    $input = $_POST['input'] ?? $_GET['input'] ?? 'gato';

    $data = [
        "model" => "nomic-embed-text:v1.5",
        "input" => $input
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
        http_response_code(500);
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode([
            "status" => "error",
            "message" => curl_error($ch)
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    header("Content-Type: application/json; charset=utf-8");
    echo $response;
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ollama Embed Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #111827;
            color: #e5e7eb;
            padding: 40px;
        }

        input, button, textarea {
            font-size: 16px;
        }

        input {
            width: 300px;
            padding: 10px;
        }

        button {
            padding: 10px 18px;
            cursor: pointer;
        }

        pre {
            background: #020617;
            padding: 20px;
            border-radius: 8px;
            overflow: auto;
            max-height: 500px;
        }
    </style>
</head>
<body>

<h1>Ollama Embeddings</h1>

<input id="texto" value="gato">
<button onclick="generarEmbedding()">Generar embedding</button>

<h2>Respuesta</h2>
<pre id="salida">Esperando...</pre>

<script>
async function generarEmbedding() {
    const texto = document.getElementById("texto").value;
    const salida = document.getElementById("salida");

    salida.textContent = "Cargando...";

    const formData = new FormData();
    formData.append("input", texto);

    try {
        const respuesta = await fetch("?api=embed", {
            method: "POST",
            body: formData
        });

        const json = await respuesta.json();

        salida.textContent = JSON.stringify(json, null, 2);

    } catch (error) {
        salida.textContent = "Error: " + error.message;
    }
}
</script>

</body>
</html>
