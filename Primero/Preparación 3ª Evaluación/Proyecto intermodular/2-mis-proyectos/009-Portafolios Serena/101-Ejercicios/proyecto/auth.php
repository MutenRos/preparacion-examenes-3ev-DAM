<?php
require_once 'db.php';

function current_user() {
	if (!isset($_SESSION['user_id'])) {
		return null;
	}

	$stmt = db()->prepare("SELECT * FROM users WHERE id = ?");
	$stmt->execute([$_SESSION['user_id']]);
	return $stmt->fetch();
}

function require_login() {
	if (!isset($_SESSION['user_id'])) {
		header("Location: login.php");
		exit;
	}
}
?>
