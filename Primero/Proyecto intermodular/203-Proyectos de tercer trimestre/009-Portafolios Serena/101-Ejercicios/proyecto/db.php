<?php
session_start();

function db() {
	static $pdo = null;

	if ($pdo === null) {
		$pdo = new PDO('sqlite:' . __DIR__ . '/app.sqlite');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}

	return $pdo;
}
?>
