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
            background: #020617;
            color: #e5e7eb;
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
            border: 1px solid #334155;
            border-radius: 8px;
            background: #0f172a;
            color: #e5e7eb;
            font-size: 16px;
        }

        button {
            padding: 12px 18px;
            border: 0;
            border-radius: 8px;
            background: #38bdf8;
            color: #020617;
            font-weight: bold;
            cursor: pointer;
        }

        #info {
            margin-bottom: 20px;
            color: #94a3b8;
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
            background: #38bdf8;
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.8);
            transition: transform 0.25s ease;
        }

        .circle.negative {
            background: #f97316;
            box-shadow: 0 0 10px rgba(249, 115, 22, 0.8);
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
    grid.innerHTML = "";

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

        info.textContent = `Dimensiones: ${values.length}`;

        values.forEach((value, index) => {
            const cell = document.createElement("div");
            cell.className = "cell";

            const circle = document.createElement("div");
            circle.className = "circle";

            if (value < 0) {
                circle.classList.add("negative");
            }

            const scale = 0.4 + Math.abs(value) * 8;

            circle.style.transform = `scale(${scale})`;
            circle.title = `#${index}: ${value}`;

            cell.appendChild(circle);
            grid.appendChild(cell);
        });

    } catch (error) {
        info.textContent = "Error: " + error.message;
    }
}

generarEmbedding();
</script>

</body>
</html>
