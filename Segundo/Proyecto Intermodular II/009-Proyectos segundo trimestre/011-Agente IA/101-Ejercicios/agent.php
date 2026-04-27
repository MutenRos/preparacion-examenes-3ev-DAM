<?php
declare(strict_types=1);

/*
  agent.php
  - Endpoint “proxy” seguro: el navegador NO ve API_URL ni API_KEY
  - handshake -> devuelve CSRF (de sesión)
  - ask -> valida origen + CSRF + rate limit + filtro “solo técnico”
*/

header("Content-Type: application/json; charset=utf-8");

// -------------------- CONFIG --------------------
const API_URL = "https://covalently-untasked-d****.ngrok-free.dev/api.php";
const API_KEY = "TEST_API_KEY_JOCARSA_123";

// Token público para identificar el “site” (NO secreto).
// En producción: cambia y/o usa uno por sitio, pero no lo trates como una clave.
const AGENT_SITE_TOKEN = "SITE_TOKEN_CAMBIAME_123";

// Seguridad básica (misma-origin recomendada)
const ALLOW_SAME_ORIGIN_ONLY = true;

// Rate limit simple
const RATE_LIMIT_MAX_PER_MIN = 30;

// Timeout a la API remota
const REMOTE_TIMEOUT_SEC = 120;

// ------------------------------------------------

session_start();

function json_ok(array $extra = []): void {
  echo json_encode(array_merge(["ok" => true], $extra), JSON_UNESCAPED_UNICODE);
  exit;
}
function json_err(string $msg, int $code = 400): void {
  http_response_code($code);
  echo json_encode(["ok" => false, "error" => $msg], JSON_UNESCAPED_UNICODE);
  exit;
}

function post(string $k): string {
  return isset($_POST[$k]) ? trim((string)$_POST[$k]) : "";
}

function same_origin_guard(): void {
  if (!ALLOW_SAME_ORIGIN_ONLY) return;

  $host = $_SERVER["HTTP_HOST"] ?? "";
  if ($host === "") return;

  $origin = $_SERVER["HTTP_ORIGIN"] ?? "";
  $referer = $_SERVER["HTTP_REFERER"] ?? "";

  // Permite sin Origin/Referer (algunos casos), pero si existe debe coincidir.
  if ($origin !== "") {
    $o = parse_url($origin);
    $ohost = $o["host"] ?? "";
    if (strcasecmp($ohost, $host) !== 0) json_err("Origen no permitido.", 403);
  }
  if ($referer !== "") {
    $r = parse_url($referer);
    $rhost = $r["host"] ?? "";
    if ($rhost !== "" && strcasecmp($rhost, $host) !== 0) json_err("Referer no permitido.", 403);
  }
}

function rate_limit_guard(): void {
  $ip = $_SERVER["REMOTE_ADDR"] ?? "unknown";
  $bucket = (int)floor(time() / 60);
  $key = "rl_" . md5($ip . ":" . $bucket);

  $count = isset($_SESSION[$key]) ? (int)$_SESSION[$key] : 0;
  $count++;
  $_SESSION[$key] = $count;

  if ($count > RATE_LIMIT_MAX_PER_MIN) {
    json_err("Demasiadas peticiones. Inténtalo de nuevo en un minuto.", 429);
  }
}

function csrf_get(): string {
  if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(16));
  }
  return (string)$_SESSION["csrf_token"];
}

function csrf_guard(string $csrf): void {
  $expected = (string)($_SESSION["csrf_token"] ?? "");
  if ($expected === "" || $csrf === "" || !hash_equals($expected, $csrf)) {
    json_err("CSRF inválido. Recarga la página.", 403);
  }
}

function is_technical_question(string $q): bool {
  $q = mb_strtolower($q);

  // Señales técnicas típicas
  $techHints = [
    "php","javascript","js","typescript","python","java","c#","c++","sql","html","css",
    "api","rest","json","xml","xsd","regex","docker","linux","ubuntu","nginx","apache",
    "mysql","postgres","sqlite","mongodb","git","github","oauth","jwt","csrf","cors",
    "bug","error","exception","stack","trace","framework","flask","django","react","node",
    "composer","pip","npm","yarn","maven","gradle","curl","http","https","ssl","tls",
    "endpoint","backend","frontend","server","cliente","librería","paquete","dependencia",
    "código","programa","función","clase","objeto","variable","loop","bucle","array"
  ];

  // Temas a excluir explícitamente (no técnicos)
  $nonTechHints = [
    "política","presidente","elecciones","religión","dios","salud","síntoma","diagnóstico",
    "medicina","abogado","legal","demanda","romance","pareja","sexo","apuesta","casino",
    "inversión","trading","cripto","pronóstico","horóscopo"
  ];

  foreach ($nonTechHints as $w) {
    if (mb_strpos($q, $w) !== false) return false;
  }

  foreach ($techHints as $w) {
    if (mb_strpos($q, $w) !== false) return true;
  }

  // Si no hay pistas: intentar heurística por formato (código / errores)
  if (preg_match("/\b(error|exception|traceback|undefined|syntax|stack)\b/i", $q)) return true;
  if (preg_match("/[{}();<>]|```|\$[a-z_]/i", $q)) return true;

  return false;
}

function build_strict_prompt(string $userQuestion): string {
  $policy = <<<TXT
Eres un asistente EXCLUSIVAMENTE técnico de programación y desarrollo de software.
REGLAS OBLIGATORIAS:
- Responde SOLO si la pregunta es de programación, desarrollo web, sistemas, redes, bases de datos, DevOps o depuración.
- Si la pregunta NO es técnica, responde EXACTAMENTE:
  "Solo puedo responder preguntas técnicas de programación y desarrollo."
- No hables de política, salud, finanzas personales, religión, relaciones, ni temas generales.
- Responde en español, claro y conciso.
TXT;

  return $policy . "\n\nPregunta del usuario:\n" . $userQuestion;
}

function call_remote_ai(string $question): string {
  $ch = curl_init(API_URL);
  if ($ch === false) {
    throw new RuntimeException("No se pudo iniciar cURL.");
  }

  $postFields = http_build_query(["question" => $question]);

  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postFields,
    CURLOPT_HTTPHEADER => [
      "X-API-Key: " . API_KEY,
      "Content-Type: application/x-www-form-urlencoded"
    ],
    CURLOPT_TIMEOUT => REMOTE_TIMEOUT_SEC,
    CURLOPT_CONNECTTIMEOUT => 20,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 0
  ]);

  $raw = curl_exec($ch);
  if ($raw === false) {
    $err = curl_error($ch);
    curl_close($ch);
    throw new RuntimeException("Error contactando API remota: " . $err);
  }

  $http = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);

  if ($http !== 200) {
    throw new RuntimeException("API remota devolvió HTTP " . $http);
  }

  $data = json_decode($raw, true);
  if (!is_array($data)) {
    throw new RuntimeException("Respuesta remota no JSON.");
  }

  $answer = $data["answer"] ?? "";
  $answer = is_string($answer) ? trim($answer) : "";
  if ($answer === "") {
    throw new RuntimeException("Respuesta remota vacía.");
  }

  return $answer;
}

// -------------------- ROUTER --------------------
same_origin_guard();
rate_limit_guard();

$siteToken = post("siteToken");
if ($siteToken !== AGENT_SITE_TOKEN) {
  json_err("Site token inválido.", 403);
}

$action = post("action");
if ($action === "handshake") {
  $csrf = csrf_get();
  json_ok(["csrf" => $csrf]);
}

if ($action === "ask") {
  $csrf = post("csrf");
  csrf_guard($csrf);

  $q = post("question");
  if ($q === "" || mb_strlen($q) < 2) json_err("Pregunta vacía.");

  // “Lock hard”: si no es técnica, NO llamamos a la IA remota
  if (!is_technical_question($q)) {
    json_ok(["answer" => "Solo puedo responder preguntas técnicas de programación y desarrollo."]);
  }

  $prompt = build_strict_prompt($q);

  try {
    $ans = call_remote_ai($prompt);
  } catch (Throwable $e) {
    json_err("Error al generar respuesta: " . $e->getMessage(), 502);
  }

  // Segundo “cinturón”: si la IA se sale, forzamos rechazo.
  // (Heurística simple: si menciona temas prohibidos, recortamos)
  $low = mb_strtolower($ans);
  $banned = ["política","presidente","elecciones","diagnóstico","medicina","religión","dios","apuesta","trading"];
  foreach ($banned as $w) {
    if (mb_strpos($low, $w) !== false) {
      $ans = "Solo puedo responder preguntas técnicas de programación y desarrollo.";
      break;
    }
  }

  json_ok(["answer" => $ans]);
}

json_err("Acción no válida.", 400);

