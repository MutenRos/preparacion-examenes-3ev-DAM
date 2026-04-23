<?php
declare(strict_types=1);

$dbFile = __DIR__ . '/data/app.sqlite';

if (!is_dir(__DIR__ . '/data')) {
    mkdir(__DIR__ . '/data', 0777, true);
}

$db = new PDO('sqlite:' . $dbFile);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role TEXT NOT NULL CHECK(role IN ('superadmin','user')),
    created_at TEXT NOT NULL
);
");

$db->exec("
CREATE TABLE IF NOT EXISTS forms (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    title TEXT NOT NULL,
    hash TEXT NOT NULL UNIQUE,
    markup TEXT NOT NULL,
    is_active INTEGER NOT NULL DEFAULT 1,
    created_at TEXT NOT NULL,
    updated_at TEXT,
    FOREIGN KEY(user_id) REFERENCES users(id)
);
");

$db->exec("
CREATE TABLE IF NOT EXISTS responses (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    form_id INTEGER NOT NULL,
    submitted_at TEXT NOT NULL,
    ip_address TEXT,
    user_agent TEXT,
    FOREIGN KEY(form_id) REFERENCES forms(id)
);
");

$db->exec("
CREATE TABLE IF NOT EXISTS response_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    response_id INTEGER NOT NULL,
    field_name TEXT NOT NULL,
    field_label TEXT NOT NULL,
    field_value TEXT,
    FOREIGN KEY(response_id) REFERENCES responses(id)
);
");

$check = $db->query("SELECT COUNT(*) FROM users WHERE role='superadmin'")->fetchColumn();

if ((int)$check === 0) {
    $username = 'admin';
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users(username,password,role,created_at) VALUES(?,?,?,?)");
    $stmt->execute([$username, $password, 'superadmin', date('c')]);
    echo "<pre>Base de datos creada\nUsuario: admin\nClave: admin123</pre>";
} else {
    echo "<pre>La base ya estaba inicializada</pre>";
}
