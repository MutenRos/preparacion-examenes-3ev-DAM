<?php
declare(strict_types=1);

$uploadDir = __DIR__ . '/uploads';
$workBaseDir = __DIR__ . '/work';
$pythonBin = __DIR__ . '/venv/bin/python';

$operations = [
    'split_pdf' => [
        'script' => __DIR__ . '/operaciones/split_pdf.py',
        'allowed_ext' => ['pdf'],
        'allowed_mime' => ['application/pdf'],
        'multiple' => false
    ],
    'join_pdf' => [
        'script' => __DIR__ . '/operaciones/join_pdf.py',
        'allowed_ext' => ['pdf'],
        'allowed_mime' => ['application/pdf'],
        'multiple' => true
    ],
    'pdf_to_jpg' => [
        'script' => __DIR__ . '/operaciones/pdf_to_jpg.py',
        'allowed_ext' => ['pdf'],
        'allowed_mime' => ['application/pdf'],
        'multiple' => false
    ],
    'pdf_to_png' => [
        'script' => __DIR__ . '/operaciones/pdf_to_png.py',
        'allowed_ext' => ['pdf'],
        'allowed_mime' => ['application/pdf'],
        'multiple' => false
    ],
    'images_to_pdf' => [
        'script' => __DIR__ . '/operaciones/images_to_pdf.py',
        'allowed_ext' => ['jpg', 'jpeg', 'png'],
        'allowed_mime' => ['image/jpeg', 'image/png'],
        'multiple' => true
    ],
];

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
        <a href="index.html" class="button-primary">Volver</a>
      </div>
    </section>
  </main>
</body>
</html>';
    exit;
}

function rrmdir(string $dir): void {
    if (!is_dir($dir)) {
        return;
    }

    $items = scandir($dir);
    if ($items === false) {
        return;
    }

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $path = $dir . DIRECTORY_SEPARATOR . $item;

        if (is_dir($path) && !is_link($path)) {
            rrmdir($path);
        } elseif (file_exists($path)) {
            @unlink($path);
        }
    }

    @rmdir($dir);
}

function normalizeUploadedFiles(array $files): array {
    $normalized = [];

    if (!isset($files['name']) || !is_array($files['name'])) {
        return $normalized;
    }

    $count = count($files['name']);
    for ($i = 0; $i < $count; $i++) {
        $normalized[] = [
            'name' => $files['name'][$i] ?? '',
            'type' => $files['type'][$i] ?? '',
            'tmp_name' => $files['tmp_name'][$i] ?? '',
            'error' => $files['error'][$i] ?? UPLOAD_ERR_NO_FILE,
            'size' => $files['size'][$i] ?? 0,
        ];
    }

    return $normalized;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail('Acceso no válido.');
}

$operation = $_POST['operation'] ?? '';
if (!isset($operations[$operation])) {
    fail('Operación no válida.');
}

$config = $operations[$operation];
$pythonScript = $config['script'];

if (!isset($_FILES['files'])) {
    fail('No se recibieron archivos.');
}

$files = normalizeUploadedFiles($_FILES['files']);

if (!$config['multiple'] && count($files) !== 1) {
    fail('Esta operación requiere exactamente un archivo.');
}

if ($config['multiple'] && count($files) < 1) {
    fail('Debes subir al menos un archivo.');
}

$token = date('Ymd_His') . '_' . bin2hex(random_bytes(4));
$jobDir = $workBaseDir . '/job_' . $token;
$inputDir = $jobDir . '/input';

if (!mkdir($inputDir, 0775, true) && !is_dir($inputDir)) {
    fail('No se pudo crear el directorio de trabajo.');
}

$savedFiles = [];

foreach ($files as $file) {
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        rrmdir($jobDir);
        fail('Uno de los archivos subidos contiene errores.');
    }

    $originalName = $file['name'] ?? 'archivo';
    $tmpName = $file['tmp_name'] ?? '';
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($extension, $config['allowed_ext'], true)) {
        rrmdir($jobDir);
        fail('Uno de los archivos tiene una extensión no permitida.');
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = $finfo ? finfo_file($finfo, $tmpName) : '';
    if ($finfo) {
        finfo_close($finfo);
    }

    if (!in_array($mimeType, $config['allowed_mime'], true)) {
        rrmdir($jobDir);
        fail('Uno de los archivos no tiene un tipo MIME permitido.');
    }

    $safeBaseName = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
    if ($safeBaseName === '' || $safeBaseName === null) {
        $safeBaseName = 'archivo';
    }

    $storedName = $safeBaseName . '_' . bin2hex(random_bytes(3)) . '.' . $extension;
    $storedPath = $inputDir . '/' . $storedName;

    if (!move_uploaded_file($tmpName, $storedPath)) {
        rrmdir($jobDir);
        fail('No se pudo guardar uno de los archivos en el servidor.');
    }

    $savedFiles[] = $storedPath;
}

register_shutdown_function(function () use ($jobDir): void {
    if (is_dir($jobDir)) {
        rrmdir($jobDir);
    }
});

$manifestPath = $jobDir . '/manifest.json';
file_put_contents($manifestPath, json_encode([
    'operation' => $operation,
    'files' => $savedFiles,
    'output_dir' => $jobDir
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

$cmd = escapeshellarg($pythonBin) . ' '
    . escapeshellarg($pythonScript) . ' '
    . escapeshellarg($manifestPath) . ' 2>&1';

$output = shell_exec($cmd);

if ($output === null) {
    fail('No se pudo ejecutar el script Python.');
}

$data = json_decode($output, true);
if (!is_array($data)) {
    fail("La salida de Python no es válida:\n" . $output);
}

if (($data['ok'] ?? false) !== true) {
    fail('Python devolvió un error: ' . (string)($data['error'] ?? 'Error desconocido.'));
}

$resultPath = (string)($data['result'] ?? '');
$resultType = (string)($data['result_type'] ?? 'file');

if ($resultPath === '' || !is_file($resultPath)) {
    fail('No se encontró el archivo de salida.');
}

$downloadName = basename($resultPath);
$filesize = filesize($resultPath);
if ($filesize === false) {
    $filesize = 0;
}

$mime = 'application/octet-stream';
if ($resultType === 'zip') {
    $mime = 'application/zip';
} elseif (str_ends_with(strtolower($downloadName), '.pdf')) {
    $mime = 'application/pdf';
}

while (ob_get_level() > 0) {
    ob_end_clean();
}

header('Content-Description: File Transfer');
header('Content-Type: ' . $mime);
header('Content-Disposition: attachment; filename="' . basename($downloadName) . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . $filesize);
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

$fp = fopen($resultPath, 'rb');
if ($fp === false) {
    fail('No se pudo abrir el archivo para descarga.');
}

while (!feof($fp)) {
    echo fread($fp, 8192);
    flush();
}

fclose($fp);
exit;
