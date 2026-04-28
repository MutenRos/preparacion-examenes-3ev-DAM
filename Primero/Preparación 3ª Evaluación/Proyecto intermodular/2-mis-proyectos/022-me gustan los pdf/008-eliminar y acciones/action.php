<?php
declare(strict_types=1);

$operations = [
    'split_pdf' => [
        'title' => 'Separar PDF',
        'description' => 'Selecciona un archivo PDF para dividirlo en páginas individuales.',
        'accept' => 'application/pdf,.pdf',
        'multiple' => false,
        'input_name' => 'files[]',
        'button' => 'Separar PDF',
        'from' => ['PDF'],
        'to' => 'PDF'
    ],
    'join_pdf' => [
        'title' => 'Unir PDF',
        'description' => 'Selecciona varios archivos PDF para unirlos en un único documento.',
        'accept' => 'application/pdf,.pdf',
        'multiple' => true,
        'input_name' => 'files[]',
        'button' => 'Unir PDFs',
        'from' => ['PDF', 'PDF'],
        'to' => 'PDF'
    ],
    'pdf_to_jpg' => [
        'title' => 'PDF a JPG',
        'description' => 'Selecciona un archivo PDF para convertir sus páginas a JPG.',
        'accept' => 'application/pdf,.pdf',
        'multiple' => false,
        'input_name' => 'files[]',
        'button' => 'Convertir a JPG',
        'from' => ['PDF'],
        'to' => 'JPG'
    ],
    'pdf_to_png' => [
        'title' => 'PDF a PNG',
        'description' => 'Selecciona un archivo PDF para convertir sus páginas a PNG.',
        'accept' => 'application/pdf,.pdf',
        'multiple' => false,
        'input_name' => 'files[]',
        'button' => 'Convertir a PNG',
        'from' => ['PDF'],
        'to' => 'PNG'
    ],
    'images_to_pdf' => [
        'title' => 'Imágenes a PDF',
        'description' => 'Selecciona una o varias imágenes para crear un PDF.',
        'accept' => 'image/jpeg,image/png,.jpg,.jpeg,.png',
        'multiple' => true,
        'input_name' => 'files[]',
        'button' => 'Crear PDF',
        'from' => ['JPG', 'PNG'],
        'to' => 'PDF'
    ],
];

$op = $_GET['op'] ?? '';

if (!isset($operations[$op])) {
    http_response_code(404);
    echo 'Operación no válida';
    exit;
}

$config = $operations[$op];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>jocarsa-conversion - <?php echo htmlspecialchars($config['title']); ?></title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header class="topbar">
    <div class="brand">
      <div class="brand-mark">jc</div>
      <div class="brand-text">
        <h1>jocarsa-conversion</h1>
        <p><?php echo htmlspecialchars($config['title']); ?></p>
      </div>
    </div>
  </header>

  <main class="container">
    <section class="hero-card">
      <div class="section-kicker">Operación</div>

      <div class="operation-hero-icon conversion-icon conversion-icon-large">
        <div class="pill-group">
          <?php foreach ($config['from'] as $fromFormat): ?>
            <span class="pill pill-origin"><?php echo htmlspecialchars($fromFormat); ?></span>
          <?php endforeach; ?>
        </div>
        <span class="arrow" aria-hidden="true"></span>
        <span class="pill pill-destination"><?php echo htmlspecialchars($config['to']); ?></span>
      </div>

      <h2><?php echo htmlspecialchars($config['title']); ?></h2>
      <p><?php echo htmlspecialchars($config['description']); ?></p>
    </section>

    <section class="form-panel">
      <form action="back.php" method="post" enctype="multipart/form-data" class="upload-form">
        <input type="hidden" name="operation" value="<?php echo htmlspecialchars($op); ?>">

        <div class="form-group">
          <label for="files">Archivos</label>
          <input
            type="file"
            id="files"
            name="<?php echo htmlspecialchars($config['input_name']); ?>"
            accept="<?php echo htmlspecialchars($config['accept']); ?>"
            <?php echo $config['multiple'] ? 'multiple' : ''; ?>
            required
          >
          <small class="field-help">
            <?php echo $config['multiple']
              ? 'Puedes seleccionar varios archivos.'
              : 'Debes seleccionar un único archivo.'; ?>
          </small>
        </div>

        <div class="form-actions">
          <button type="submit" class="button-primary"><?php echo htmlspecialchars($config['button']); ?></button>
          <a href="index.html" class="button-secondary">Volver</a>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
