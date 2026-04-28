<?php

$folderUrl = "https://drive.google.com/drive/folders/138MaEADdrCQsVwAnEfihxvXwQs86rGyM?usp=sharing";

function extraerFolderId($url) {
    if (preg_match('/\/folders\/([a-zA-Z0-9_-]+)/', $url, $m)) {
        return $m[1];
    }
    return trim($url);
}

function descargar($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $respuesta = curl_exec($ch);
    $error = curl_error($ch);
    $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($respuesta === false) {
        return [false, $error];
    }

    if ($http < 200 || $http >= 300) {
        return [false, "HTTP $http"];
    }

    return [$respuesta, null];
}

$folderId = extraerFolderId($folderUrl);
$imagenes = [];
$error = "";

if (!$folderId) {
    $error = "No se pudo extraer el ID de la carpeta.";
} else {
    $embeddedUrl = "https://drive.google.com/embeddedfolderview?id=" . $folderId . "#grid";

    // IMPORTANTE: aquí va la URL completa, con http:// delante
    $proxyUrl = "https://r.jina.ai/http://" . ltrim($embeddedUrl, '/');
    $proxyUrl = str_replace("http://https://", "https://", $proxyUrl);

    list($contenido, $fallo) = descargar($proxyUrl);

    if ($contenido === false) {
        $error = "No se pudo leer la carpeta: " . $fallo;
    } else {
        preg_match_all(
            '/https:\/\/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)\/view/',
            $contenido,
            $matches
        );

        if (!empty($matches[1])) {
            $ids = array_unique($matches[1]);

            foreach ($ids as $id) {
                $imagenes[] = [
                    "id" => $id,
                    "preview" => "https://drive.google.com/file/d/$id/preview",
                    "view" => "https://drive.google.com/file/d/$id/view"
                ];
            }
        } else {
            $error = "No se encontraron imágenes en la respuesta.";
        }
    }
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Galería Drive</title>
<style>
*{box-sizing:border-box}
body{font-family:Arial,sans-serif;background:#f5f5f5;margin:0;padding:24px}
h1{margin:0 0 10px 0}
.estado{margin:0 0 20px 0;color:#666}
.galeria{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:16px}
.tarjeta{background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.08)}
iframe{width:100%;height:260px;border:0;display:block;background:#ddd}
.acciones{padding:10px}
.acciones a{display:inline-block;text-decoration:none;color:#fff;background:#333;padding:8px 10px;border-radius:6px;font-size:13px}
</style>
</head>
<body>

<h1>Imágenes de carpeta pública de Drive</h1>

<p class="estado">
<?php
if ($error) {
    echo htmlspecialchars($error);
} else {
    echo count($imagenes) . " archivo(s) cargado(s).";
}
?>
</p>

<div class="galeria">
<?php foreach ($imagenes as $imagen): ?>
    <div class="tarjeta">
        <iframe src="<?= htmlspecialchars($imagen["preview"]) ?>" loading="lazy"></iframe>
        <div class="acciones">
            <a href="<?= htmlspecialchars($imagen["view"]) ?>" target="_blank">Abrir</a>
        </div>
    </div>
<?php endforeach; ?>
</div>

</body>
</html>
