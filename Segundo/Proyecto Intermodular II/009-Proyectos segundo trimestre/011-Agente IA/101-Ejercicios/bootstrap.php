<?php
declare(strict_types=1);

session_start();

header('Content-Type: application/json; charset=utf-8');

// ---- Config visible (NO secret) ----
$title = "Asistente";
$placeholder = "Escribe tu pregunta…";
$endpoint = "./agent.php";

// ---- Token efímero por sesión (rotando) ----
if (empty($_SESSION['jv_agent_boot_secret'])) {
  $_SESSION['jv_agent_boot_secret'] = bin2hex(random_bytes(32));
}

$ttl = 300; // 5 min
$ts  = time();
$nonce = bin2hex(random_bytes(16));

// Token firmado: HMAC(secret_sesion, ts|nonce)
$payload = $ts . "|" . $nonce;
$sig = hash_hmac('sha256', $payload, $_SESSION['jv_agent_boot_secret']);
$sessionToken = $payload . "|" . $sig;

echo json_encode([
  "endpoint" => $endpoint,
  "title" => $title,
  "placeholder" => $placeholder,
  "sessionToken" => $sessionToken,
  "ttlSeconds" => $ttl,
], JSON_UNESCAPED_UNICODE);

