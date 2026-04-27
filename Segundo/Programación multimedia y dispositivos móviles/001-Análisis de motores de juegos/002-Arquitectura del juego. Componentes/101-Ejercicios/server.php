<?php
// server.php — ultra-simple heartbeat state relay (file-based)
// POST JSON: { room, playerId, payload: { ship, bullets, rocks? } }
// Response JSON: { ok, serverTime, hostId, players, rocks }

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
  http_response_code(204);
  exit;
}

$raw = file_get_contents("php://input");
$req = json_decode($raw, true);
if (!is_array($req)) {
  http_response_code(400);
  echo json_encode(["ok"=>false, "error"=>"Invalid JSON"]);
  exit;
}

$room = preg_replace('/[^a-zA-Z0-9_\-]/', '', $req["room"] ?? "default");
$playerId = preg_replace('/[^a-zA-Z0-9_\-]/', '', $req["playerId"] ?? "");
$payload = $req["payload"] ?? null;

if ($playerId === "" || !is_array($payload)) {
  http_response_code(400);
  echo json_encode(["ok"=>false, "error"=>"Missing playerId or payload"]);
  exit;
}

$stateFile = sys_get_temp_dir() . "/asteroids_state_" . $room . ".json";
$lockFile  = $stateFile . ".lock";

$nowMs = (int) floor(microtime(true) * 1000);
$ttlMs = 12000; // players inactive >12s removed

// Lock
$lfh = fopen($lockFile, "c+");
if (!$lfh) {
  http_response_code(500);
  echo json_encode(["ok"=>false, "error"=>"Lock open failed"]);
  exit;
}
flock($lfh, LOCK_EX);

// Load state
$state = [
  "hostId" => null,
  "players" => [],
  "rocks" => [],
  "updatedAt" => $nowMs
];

if (file_exists($stateFile)) {
  $txt = file_get_contents($stateFile);
  $decoded = json_decode($txt, true);
  if (is_array($decoded)) $state = array_merge($state, $decoded);
}

// Prune inactive players
foreach (($state["players"] ?? []) as $pid => $p) {
  $last = (int)($p["lastSeen"] ?? 0);
  if ($nowMs - $last > $ttlMs) {
    unset($state["players"][$pid]);
  }
}

// Host election (first active player becomes host)
$hostId = $state["hostId"] ?? null;
if (!$hostId || !isset($state["players"][$hostId])) {
  $keys = array_keys($state["players"]);
  $hostId = $keys[0] ?? $playerId; // may become host immediately
  $state["hostId"] = $hostId;
}

// Update this player's data
$state["players"][$playerId] = [
  "lastSeen" => $nowMs,
  "ship" => $payload["ship"] ?? null,
  "bullets" => $payload["bullets"] ?? [],
];

// If sender is host, accept rocks snapshot
if ($playerId === $hostId && isset($payload["rocks"])) {
  $state["rocks"] = $payload["rocks"];
}

$state["updatedAt"] = $nowMs;

// Save
file_put_contents($stateFile, json_encode($state, JSON_UNESCAPED_SLASHES));

// Unlock
flock($lfh, LOCK_UN);
fclose($lfh);

echo json_encode([
  "ok" => true,
  "serverTime" => $nowMs,
  "hostId" => $state["hostId"],
  "players" => $state["players"],
  "rocks" => $state["rocks"],
], JSON_UNESCAPED_SLASHES);

