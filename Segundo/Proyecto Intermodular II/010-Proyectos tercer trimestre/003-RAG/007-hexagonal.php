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
        CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
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
<title>Embedding Circular Hex</title>

<style>
body {
    margin: 0;
    overflow: hidden;
    background: #ffffff;
    font-family: Arial, sans-serif;
}

#canvas {
    position: fixed;
    inset: 0;
}

.cell {
    position: absolute;
    width: 24px;
    height: 24px;
    transform: translate(-50%, -50%);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: left 0.6s ease, top 0.6s ease;
}

.circle {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #333333;
    transform: scale(0);
    transition: transform 0.5s cubic-bezier(.34,1.56,.64,1);
}

#panel {
    position: fixed;
    left: 50%;
    bottom: 20px;
    transform: translateX(-50%);
    background: rgba(255,255,255,0.9);
    padding: 15px 20px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
}

.controls {
    display: flex;
    gap: 10px;
}

input {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    width: 300px;
}

button {
    padding: 10px 15px;
    border-radius: 8px;
    border: none;
    background: #333333;
    color: #ffffff;
    cursor: pointer;
}

#info {
    font-size: 14px;
    color: #555555;
}
</style>
</head>

<body>

<div id="canvas"></div>

<div id="panel">
    <div class="controls">
        <input id="texto" value="gato">
        <button onclick="generarEmbedding()">Generar</button>
    </div>
    <div id="info">Esperando...</div>
</div>

<script>
const canvas = document.getElementById("canvas");

const HEX_SIZE = 15;
const SQRT3 = Math.sqrt(3);
const INTENSITY = 8;

function axialToPixel(q, r) {
    return {
        x: HEX_SIZE * SQRT3 * (q + r / 2),
        y: HEX_SIZE * 1.5 * r
    };
}

function hexCircle(count) {
    const candidates = [];

    /*
        Importante:
        antes el límite era demasiado pequeño y generaba un rombo.
        Ahora generamos un área axial mucho más grande y luego ordenamos
        por distancia real en píxeles al centro.
    */
    const limit = Math.ceil(Math.sqrt(count) * 3);

    for (let q = -limit; q <= limit; q++) {
        for (let r = -limit; r <= limit; r++) {
            const p = axialToPixel(q, r);
            const dist = Math.sqrt(p.x * p.x + p.y * p.y);

            candidates.push({
                q,
                r,
                dist
            });
        }
    }

    candidates.sort((a, b) => a.dist - b.dist);

    return candidates.slice(0, count);
}

function recolocar(total) {
    const positions = hexCircle(total);
    const cx = window.innerWidth / 2;
    const cy = window.innerHeight / 2;

    positions.forEach((pos, i) => {
        const circle = document.querySelector(`.circle[data-index="${i}"]`);
        if (!circle) return;

        const cell = circle.parentElement;
        const p = axialToPixel(pos.q, pos.r);

        cell.style.left = `${cx + p.x}px`;
        cell.style.top = `${cy + p.y}px`;
    });
}

async function generarEmbedding() {
    const texto = document.getElementById("texto").value;
    const info = document.getElementById("info");

    info.textContent = "Cargando...";

    const formData = new FormData();
    formData.append("input", texto);

    try {
        const res = await fetch("?api=embed", {
            method: "POST",
            body: formData
        });

        const json = await res.json();
        const values = json.embeddings?.[0];

        if (!Array.isArray(values)) {
            info.textContent = "Error en embeddings";
            return;
        }

        info.textContent = `"${texto}" · ${values.length} dimensiones`;

        const positions = hexCircle(values.length);
        const cx = window.innerWidth / 2;
        const cy = window.innerHeight / 2;

        values.forEach((value, i) => {
            let circle = document.querySelector(`.circle[data-index="${i}"]`);

            if (!circle) {
                const cell = document.createElement("div");
                cell.className = "cell";

                circle = document.createElement("div");
                circle.className = "circle";
                circle.dataset.index = i;

                cell.appendChild(circle);
                canvas.appendChild(cell);
            }

            const pos = positions[i];
            const p = axialToPixel(pos.q, pos.r);

            const cell = circle.parentElement;
            cell.style.left = `${cx + p.x}px`;
            cell.style.top = `${cy + p.y}px`;

            const amplified = Math.max(-1, Math.min(1, value * INTENSITY));
            const scale = 0.15 + ((amplified + 1) / 2) * 1.35;

            circle.style.transitionDelay = `${i * 3}ms`;
            circle.style.transform = `scale(${scale})`;
            circle.title = `#${i}: ${value}`;
        });

    } catch (e) {
        info.textContent = "Error: " + e.message;
    }
}

window.addEventListener("resize", () => {
    const circles = document.querySelectorAll(".circle");
    recolocar(circles.length);
});

document.getElementById("texto").addEventListener("keydown", e => {
    if (e.key === "Enter") {
        generarEmbedding();
    }
});

generarEmbedding();
</script>

</body>
</html>
