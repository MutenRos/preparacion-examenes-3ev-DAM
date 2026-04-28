<?php
declare(strict_types=1);

/*
Flujo:
1. Recibe un PDF por POST
2. Lo guarda en /uploads
3. Llama a split_pdf.py mediante shell_exec
4. El script Python divide el PDF en páginas sueltas
5. Python crea un ZIP con todas las páginas
6. PHP lanza la descarga del ZIP
*/

$uploadDir = __DIR__ . '/uploads';
$workBaseDir = __DIR__ . '/work';
$pythonScript = __DIR__ . '/operaciones/split_pdf.py';
$pythonBin = __DIR__ . '/venv/bin/python';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0775, true);
}
if (!is_dir($workBaseDir)) {
    mkdir($workBaseDir, 0775, true);
}

function h(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function fail(string $message): void {
    http_response_code(400);
    echo '<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header class="topbar">
    <div class="brand">
      <div class="brand-mark">jc</div>
      <div class="brand-text">
        <h1>jocarsa-conversion</h1>
        <p>Error de procesamiento</p>
      </div>
    </div>
  </header>
  <main class="container">
    <section class="result-panel">
      <div class="result-box result-error">
        <p>' . h($message) . '</p>
      </div>
      <div class="form-actions">
        <a href="action.html" class="button-primary">Volver</a>
      </div>
    </section>
  </main>
</body>
</html>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail('Acceso no válido.');
}

if (!isset($_FILES['pdf_file'])) {
    fail('No se recibió ningún archivo.');
}

$file = $_FILES['pdf_file'];

if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
    fail('Hubo un error al subir el archivo.');
}

$originalName = $file['name'] ?? 'archivo.pdf';
$tmpName = $file['tmp_name'] ?? '';
$extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = $finfo ? finfo_file($finfo, $tmpName) : '';
if ($finfo) {
    finfo_close($finfo);
}

if ($extension !== 'pdf') {
    fail('El archivo debe tener extensión .pdf.');
}

if ($mimeType !== 'application/pdf') {
    fail('El archivo subido no parece ser un PDF válido.');
}

$safeBaseName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
if ($safeBaseName === '' || $safeBaseName === null) {
    $safeBaseName = 'documento';
}

$token = date('Ymd_His') . '_' . bin2hex(random_bytes(4));
$storedPdfName = $safeBaseName . '_' . $token . '.pdf';
$storedPdfPath = $uploadDir . '/' . $storedPdfName;

if (!move_uploaded_file($tmpName, $storedPdfPath)) {
    fail('No se pudo guardar el archivo en el servidor.');
}

$jobDir = $workBaseDir . '/' . $safeBaseName . '_' . $token;
if (!mkdir($jobDir, 0775, true) && !is_dir($jobDir)) {
    fail('No se pudo crear el directorio de trabajo.');
}

$cmd = escapeshellarg($pythonBin) . ' '
    . escapeshellarg($pythonScript) . ' '
    . escapeshellarg($storedPdfPath) . ' '
    . escapeshellarg($jobDir) . ' 2>&1';

$output = shell_exec($cmd);

if ($output === null) {
    fail('No se pudo ejecutar el script Python.');
}

$data = json_decode($output, true);

if (!is_array($data)) {
    fail("La salida de Python no es válida:\n" . $output);
}

if (($data['ok'] ?? false) !== true) {
    $errorMessage = (string)($data['error'] ?? 'Error desconocido en Python.');
    fail("Python devolvió un error: " . $errorMessage);
}

$zipPath = (string)($data['zip'] ?? '');

if ($zipPath === '' || !is_file($zipPath)) {
    fail('No se encontró el ZIP generado.');
}

$downloadName = basename($zipPath);
$filesize = filesize($zipPath);
if ($filesize === false) {
    $filesize = 0;
}

while (ob_get_level() > 0) {
    ob_end_clean();
}

header('Content-Description: File Transfer');
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . basename($downloadName) . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . $filesize);
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: public');
header('Expires: 0');

readfile($zipPath);
exit;
