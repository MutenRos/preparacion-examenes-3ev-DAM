<?php
declare(strict_types=1);

$dbFile = __DIR__ . '/locations.sqlite';

try {
    $db = new SQLite3($dbFile);
    $db->busyTimeout(5000);

    $db->exec('
        CREATE TABLE IF NOT EXISTS locations (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL UNIQUE,
            latitude REAL NOT NULL,
            longitude REAL NOT NULL,
            updated_at TEXT NOT NULL
        )
    ');
} catch (Exception $e) {
    http_response_code(500);
    die('Database error: ' . $e->getMessage());
}
?>
