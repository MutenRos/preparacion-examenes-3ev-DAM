<?php
declare(strict_types=1);

$dbFile = __DIR__ . '/../data/app.sqlite';
if (!file_exists($dbFile)) {
    die('La base de datos no existe. Ejecuta init.php primero.');
}

$db = new PDO('sqlite:' . $dbFile);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
