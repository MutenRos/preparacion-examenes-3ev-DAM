<?php
declare(strict_types=1);

$uploadDir = __DIR__ . '/uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0775, true);
}

function h(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $message = 'Acceso no válido.';
} elseif (!isset($_FILES['pdf_file'])) {
    $message = 'No se recibió ningún archivo.';
} else {
    $file = $_FILES['pdf_file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $message = 'Hubo un error al subir el archivo.';
    } else {
        $originalName = $file['name'] ?? 'archivo.pdf';
        $tmpName = $file['tmp_name'] ?? '';
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = $finfo ? finfo_file($finfo, $tmpName) : '';
        if ($finfo) {
            finfo_close($finfo);
        }

        if ($extension !== 'pdf') {
            $message = 'El archivo debe tener extensión .pdf.';
        } elseif ($mimeType !== 'application/pdf') {
            $message = 'El archivo subido no parece ser un PDF válido.';
        } else {
            $safeBaseName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
            $finalName = $safeBaseName . '_' . time() . '.pdf';
            $destination = $uploadDir . $finalName;

            if (move_uploaded_file($tmpName, $destination)) {
                $success = true;
                $message = 'Archivo subido correctamente.';
            } else {
                $message = 'No se pudo guardar el archivo en el servidor.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>jocarsa-conversion - Resultado</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header class="topbar">
    <div class="brand">
      <div class="brand-mark">jc</div>
      <div class="brand-text">
        <h1>jocarsa-conversion</h1>
        <p>Resultado de la subida</p>
      </div>
    </div>
  </header>

  <main class="container">
    <section class="intro">
      <h2>Resultado</h2>
      <p>Estado del envío del PDF al backend.</p>
    </section>

    <section class="result-panel">
      <div class="result-box <?php echo $success ? 'result-success' : 'result-error'; ?>">
        <p><?php echo h($message); ?></p>
      </div>

      <div class="form-actions">
        <a href="action.html" class="button-primary">Subir otro PDF</a>
        <a href="index.html" class="button-secondary">Volver al inicio</a>
      </div>
    </section>
  </main>
</body>
</html>
