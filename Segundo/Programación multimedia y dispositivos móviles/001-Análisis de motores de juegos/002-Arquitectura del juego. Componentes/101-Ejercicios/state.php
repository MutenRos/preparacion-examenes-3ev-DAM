<?php
// state.php — simple file-backed realtime state relay + lightweight simulation
// POST JSON: { clientId, now, ship:{...}, bullets:[...], input:{thrust,giro}, viewport:{w,h} }
// RESP JSON: { serverNow, you, players, rocks, bullets, level, rocksPerLevel }

header("Content-Type: application/json; charset=utf-8");

$STATE_FILE = __DIR__ . "/state.json";
$MAX_CLIENT_AGE = 6;  // seconds
$BULLET_TTL     = 2.5; // seconds on server
$FPS_SIM        = 60.0;

// ---------- helpers ----------
function read_json_body() {
  $raw = file_get_contents("php://input");
  if (!$raw) return null;
  $data = json_decode($raw, true);
  return is_array($data) ? $data : null;
}
function now_sec() {
  return microtime(true);
}
function clamp($v,$a,$b){ return max($a, min($b, $v)); }

// ---------- load state with lock ----------
$fp = fopen($STATE_FILE, "c+");
if (!$fp) {
  http_response_code(500);
  echo json_encode(["error" => "Cannot open state file"]);
  exit;
}
flock($fp, LOCK_EX);

// read file
$contents = stream_get_contents($fp);
$state = $contents ? json_decode($contents, true) : null;
if (!is_array($state)) {
  $state = [
    "serverNow" => now_sec(),
    "lastSim" => now_sec(),
    "level" => 1,
    "rocksPerLevel" => 10,
    "players" => [],   // clientId => [lastSeen, ship, input]
    "rocks" => [],     // array
    "bullets" => [],   // array of {id, owner, x,y,vx,vy, born}
    "nextRockId" => 1,
    "nextBulletId" => 1
  ];
}

// ---------- initialize rocks if needed ----------
function spawn_rocks(&$state, $n, $w=1920, $h=1080) {
  for ($i=0;$i<$n;$i++){
    $r = 10 + (mt_rand()/mt_getrandmax())*20;
    $dir = (mt_rand()/mt_getrandmax()) * M_PI * 2;
    $v = 0.4 + (mt_rand()/mt_getrandmax())*1.6;
    $x = (mt_rand()/mt_getrandmax()) * $w;
    $y = (mt_rand()/mt_getrandmax()) * $h;
    $state["rocks"][] = [
      "id" => $state["nextRockId"]++,
      "x" => $x, "y" => $y,
      "vx" => cos($dir)*$v, "vy" => sin($dir)*$v,
      "radius" => $r,
      "ang" => (mt_rand()/mt_getrandmax())*M_PI*2,
      "rot" => ((mt_rand()/mt_getrandmax())-0.5)*0.04,
      "lados" => (int)round(5 + (mt_rand()/mt_getrandmax())*20),
      // keep "puntas" deterministic-ish by seeding with id on client; here just store a small random list
      "puntas" => array_map(function(){ return 1 + (((mt_rand()/mt_getrandmax())*2)-1)*0.4; }, range(1, 20))
    ];
  }
}

if (count($state["rocks"]) === 0) {
  // default viewport; clients can override via POST viewport
  spawn_rocks($state, $state["rocksPerLevel"], 1920, 1080);
}

// ---------- simulate world forward (rocks + bullets) ----------
$serverNow = now_sec();
$dt = $serverNow - (float)$state["lastSim"];
$dt = clamp($dt, 0.0, 0.25); // avoid huge jumps
$steps = max(1, (int)ceil($dt * $FPS_SIM));
$subdt = $dt / $steps;

for ($s=0; $s<$steps; $s++) {
  // rocks: bounce inside last known viewport (store in state)
  $w = isset($state["viewportW"]) ? (float)$state["viewportW"] : 1920.0;
  $h = isset($state["viewportH"]) ? (float)$state["viewportH"] : 1080.0;

  foreach ($state["rocks"] as &$rk) {
    $rk["ang"] += $rk["rot"];
    $rk["x"] += $rk["vx"] * ($subdt * $FPS_SIM); // scale to roughly match client feel
    $rk["y"] += $rk["vy"] * ($subdt * $FPS_SIM);

    $rad = (float)$rk["radius"];
    if ($rk["x"] - $rad < 0) { $rk["x"] = $rad; $rk["vx"] = -$rk["vx"]; }
    else if ($rk["x"] + $rad > $w) { $rk["x"] = $w - $rad; $rk["vx"] = -$rk["vx"]; }
    if ($rk["y"] - $rad < 0) { $rk["y"] = $rad; $rk["vy"] = -$rk["vy"]; }
    else if ($rk["y"] + $rad > $h) { $rk["y"] = $h - $rad; $rk["vy"] = -$rk["vy"]; }
  }
  unset($rk);

  // bullets: linear move
  foreach ($state["bullets"] as &$b) {
    $b["x"] += $b["vx"] * ($subdt * $FPS_SIM);
    $b["y"] += $b["vy"] * ($subdt * $FPS_SIM);
  }
  unset($b);
}
$state["lastSim"] = $serverNow;
$state["serverNow"] = $serverNow;

// prune bullets by ttl
$state["bullets"] = array_values(array_filter($state["bullets"], function($b) use ($serverNow, $BULLET_TTL){
  return ($serverNow - (float)$b["born"]) <= $BULLET_TTL;
}));

// prune old clients
foreach ($state["players"] as $cid => $p) {
  if (($serverNow - (float)$p["lastSeen"]) > $MAX_CLIENT_AGE) {
    unset($state["players"][$cid]);
  }
}

// ---------- handle request ----------
$req = read_json_body();
if (!$req || !isset($req["clientId"])) {
  // write back state and exit
  ftruncate($fp, 0);
  rewind($fp);
  fwrite($fp, json_encode($state));
  fflush($fp);
  flock($fp, LOCK_UN);
  fclose($fp);

  echo json_encode(["error"=>"Missing clientId"]);
  exit;
}

$clientId = preg_replace('/[^a-zA-Z0-9_\-]/', '', (string)$req["clientId"]);
$viewportW = isset($req["viewport"]["w"]) ? (float)$req["viewport"]["w"] : 1920.0;
$viewportH = isset($req["viewport"]["h"]) ? (float)$req["viewport"]["h"] : 1080.0;
$state["viewportW"] = $viewportW;
$state["viewportH"] = $viewportH;

// store/update player
$ship = isset($req["ship"]) && is_array($req["ship"]) ? $req["ship"] : [];
$input = isset($req["input"]) && is_array($req["input"]) ? $req["input"] : [];

$state["players"][$clientId] = [
  "lastSeen" => $serverNow,
  "ship" => [
    "x" => (float)($ship["x"] ?? 0),
    "y" => (float)($ship["y"] ?? 0),
    "ang" => (float)($ship["ang"] ?? 0),
    "vx" => (float)($ship["vx"] ?? 0),
    "vy" => (float)($ship["vy"] ?? 0),
  ],
  "input" => [
    "thrust" => !empty($input["thrust"]),
    "giro" => (float)($input["giro"] ?? 0),
  ],
];

// accept bullets from client (only newly fired bullets)
if (isset($req["bulletsNew"]) && is_array($req["bulletsNew"])) {
  foreach ($req["bulletsNew"] as $bn) {
    if (!is_array($bn)) continue;
    // {x,y,vx,vy}
    $state["bullets"][] = [
      "id" => $state["nextBulletId"]++,
      "owner" => $clientId,
      "x" => (float)($bn["x"] ?? 0),
      "y" => (float)($bn["y"] ?? 0),
      "vx" => (float)($bn["vx"] ?? 0),
      "vy" => (float)($bn["vy"] ?? 0),
      "born" => $serverNow
    ];
  }
}

// response objects
$playersOut = [];
foreach ($state["players"] as $cid => $p) {
  $playersOut[] = [
    "id" => $cid,
    "ship" => $p["ship"],
    "input" => $p["input"]
  ];
}

// write state
ftruncate($fp, 0);
rewind($fp);
fwrite($fp, json_encode($state));
fflush($fp);
flock($fp, LOCK_UN);
fclose($fp);

// send response
echo json_encode([
  "serverNow" => $serverNow,
  "you" => $clientId,
  "players" => $playersOut,
  "rocks" => $state["rocks"],
  "bullets" => $state["bullets"],
  "level" => $state["level"],
  "rocksPerLevel" => $state["rocksPerLevel"]
]);

