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
    <title>Ollama Embedding Grid</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #ffffff;
            color: #222222;
            padding: 30px;
        }

        h1 {
            margin-top: 0;
        }

        .controls {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        input {
            width: 320px;
            padding: 12px;
            border: 1px solid #cccccc;
            border-radius: 8px;
            background: #ffffff;
            color: #222222;
            font-size: 16px;
        }

        button {
            padding: 12px 18px;
            border: 0;
            border-radius: 8px;
            background: #333333;
            color: #ffffff;
            font-weight: bold;
            cursor: pointer;
        }

        #info {
            margin-bottom: 20px;
            color: #555555;
        }

        #grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(22px, 1fr));
            gap: 8px;
            align-items: center;
        }

        .cell {
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .circle {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #333333;
            transform: scale(0);
            transition: transform 0.45s ease;
        }
    </style>
</head>
<body>

<h1>Visualizador de Embeddings</h1>

<div class="controls">
    <input id="texto" value="gato">
    <button onclick="generarEmbedding()">Generar</button>
</div>

<div id="info">Esperando...</div>
<div id="grid"></div>

<script>
async function generarEmbedding() {
    const texto = document.getElementById("texto").value;
    const info = document.getElementById("info");
    const grid = document.getElementById("grid");

    info.textContent = "Cargando embedding...";

    const formData = new FormData();
    formData.append("input", texto);

    try {
        const respuesta = await fetch("?api=embed", {
            method: "POST",
            body: formData
        });

        const json = await respuesta.json();
        const values = json.embeddings?.[0];

        if (!Array.isArray(values)) {
            info.textContent = "No se encontró embeddings[0] en la respuesta.";
            return;
        }

        info.textContent = `Palabra: "${texto}" · Dimensiones: ${values.length}`;

        values.forEach((value, index) => {
            let circle = document.querySelector(`[data-index="${index}"]`);

            if (!circle) {
                const cell = document.createElement("div");
                cell.className = "cell";

                circle = document.createElement("div");
                circle.className = "circle";
                circle.dataset.index = index;

                cell.appendChild(circle);
                grid.appendChild(cell);
            }

            const clamped = Math.max(-1, Math.min(1, value));
            const scale = (clamped + 1)*8-7;

            circle.style.transform = `scale(${scale})`;
            circle.title = `#${index}: ${value}`;
        });

    } catch (error) {
        info.textContent = "Error: " + error.message;
    }
}

generarEmbedding();
</script>

</body>
</html>
