<?php
// Ejecutar desde consola: php install.php
// Recrea storage/database.sqlite usando schema.sql y seed.sql.

$dbPath = __DIR__ . '/storage/database.sqlite';
$schema = __DIR__ . '/storage/schema.sql';
$seed = __DIR__ . '/storage/seed.sql';

if (!extension_loaded('pdo_sqlite')) {
    fwrite(STDERR, "Error: falta la extensión pdo_sqlite. En Ubuntu/Debian: sudo apt install php-sqlite3\n");
    exit(1);
}

if (file_exists($dbPath)) {
    unlink($dbPath);
}

$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec(file_get_contents($schema));
$pdo->exec(file_get_contents($seed));

echo "Base de datos creada correctamente en: {$dbPath}\n";
