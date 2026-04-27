# Reporte de proyecto

## Estructura del proyecto

```
/var/www/html/jocarsa-lightsalmon
├── README.md
├── calendar_api.php
├── index.html
└── v1
    ├── calendar.js
    ├── calendario.webp
    ├── endpoint.php
    ├── index.html
    └── styles.css
```

## Código (intercalado)

# jocarsa-lightsalmon
**README.md**
```markdown
# jocarsa-lightsalmon
```
**calendar_api.php**
```php
<?php
/**
 * calendar_api.php  (single-file PHP + SQLite)
 *
 * Endpoints (all JSON):
 *   POST   ?action=register        {username,password}
 *   POST   ?action=login           {username,password}
 *   POST   ?action=logout          {}
 *   GET    ?action=me              (session info)
 *   GET    ?action=load            (requires login) -> {data:{version,categories,holidays,events}}
 *   POST   ?action=save            (requires login) {data:{version,categories,holidays,events}}
 *
 * Notes:
 * - This file is only the backend API. Your HTML will call it via fetch().
 * - If user is not logged in: load/save return 401. Frontend should fall back to localStorage.
 */

declare(strict_types=1);
session_start();

/* =========================
   CONFIG
   ========================= */
const DB_PATH = __DIR__ . '/calendar.sqlite';
const USERNAME_MIN = 3;
const USERNAME_MAX = 48;
const PASSWORD_MIN = 6;
const MAX_PAYLOAD_BYTES = 2_000_000; // 2MB safety limit

/* =========================
   HELPERS
   ========================= */
function json_out(array $payload, int $status = 200): void {
  http_response_code($status);
  header('Content-Type: application/json; charset=utf-8');
  header('Cache-Control: no-store');
  echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  exit;
}

function method(): string {
  return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
}

function action(): string {
  return (string)($_GET['action'] ?? '');
}

function pdo(): PDO {
  static $pdo = null;
  if ($pdo instanceof PDO) return $pdo;

  $pdo = new PDO('sqlite:' . DB_PATH, null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ]);

  // Pragmas
  $pdo->exec("PRAGMA journal_mode = WAL;");
  $pdo->exec("PRAGMA foreign_keys = ON;");

  // Schema
  $pdo->exec("
    CREATE TABLE IF NOT EXISTS users (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      username TEXT NOT NULL UNIQUE,
      pass_hash TEXT NOT NULL,
      created_at TEXT NOT NULL DEFAULT (datetime('now'))
    );
  ");

  $pdo->exec("
    CREATE TABLE IF NOT EXISTS user_data (
      user_id INTEGER PRIMARY KEY,
      data_json TEXT NOT NULL,
      updated_at TEXT NOT NULL DEFAULT (datetime('now')),
      FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
    );
  ");

  return $pdo;
}

function read_body_json(): array {
  $raw = file_get_contents('php://input') ?: '';
  if (strlen($raw) > MAX_PAYLOAD_BYTES) {
    json_out(['ok' => false, 'error' => 'Payload demasiado grande'], 413);
  }
  if ($raw === '') return [];
  $data = json_decode($raw, true);
  if (!is_array($data)) {
    json_out(['ok' => false, 'error' => 'JSON inválido'], 400);
  }
  return $data;
}

function is_logged_in(): bool {
  return isset($_SESSION['uid']) && is_int($_SESSION['uid']) && $_SESSION['uid'] > 0;
}

function require_login(): int {
  if (!is_logged_in()) {
    json_out(['ok' => false, 'error' => 'No autenticado'], 401);
  }
  return (int)$_SESSION['uid'];
}

function normalize_username(string $u): string {
  $u = trim($u);
  // Keep simple: letters, digits, underscore, dash, dot
  $u = preg_replace('/\s+/', '', $u) ?? $u;
  return $u;
}

function valid_username(string $u): bool {
  if ($u === '') return false;
  $len = mb_strlen($u, 'UTF-8');
  if ($len < USERNAME_MIN || $len > USERNAME_MAX) return false;
  return (bool)preg_match('/^[a-zA-Z0-9_.-]+$/', $u);
}

function valid_password(string $p): bool {
  if ($p === '') return false;
  return mb_strlen($p, 'UTF-8') >= PASSWORD_MIN;
}

/**
 * Validate/normalize calendar payload:
 * Expected shape:
 *   { version: 2, categories: [...], holidays: [...], events: [...] }
 *
 * Returns normalized array with those keys.
 */
function normalize_calendar_data($data): array {
  if (!is_array($data)) {
    json_out(['ok' => false, 'error' => 'Campo "data" inválido'], 400);
  }

  $version = isset($data['version']) ? (int)$data['version'] : 2;

  $categories = $data['categories'] ?? [];
  $holidays   = $data['holidays'] ?? [];
  $events     = $data['events'] ?? [];

  if (!is_array($categories) || !is_array($holidays) || !is_array($events)) {
    json_out(['ok' => false, 'error' => 'Estructura de calendario inválida'], 400);
  }

  // Normalize categories
  $catOut = [];
  foreach ($categories as $c) {
    if (!is_array($c)) continue;
    $id = trim((string)($c['id'] ?? ''));
    $name = trim((string)($c['name'] ?? $id));
    $color = trim((string)($c['color'] ?? '#94a3b8'));
    $trabajo = !empty($c['trabajo']);

    if ($id === '') continue;
    if ($name === '') $name = $id;

    // very light color validation (accept #RRGGBB)
    if (!preg_match('/^#[0-9a-fA-F]{6}$/', $color)) $color = '#94a3b8';

    $catOut[] = [
      'id' => $id,
      'name' => $name,
      'color' => $color,
      'trabajo' => $trabajo,
    ];
  }
  // Ensure at least defaults exist
  if (!$catOut) {
    $catOut = [
      ['id'=>'personal','name'=>'personal','color'=>'#ef4444','trabajo'=>false],
      ['id'=>'laboral','name'=>'laboral','color'=>'#22c55e','trabajo'=>true],
      ['id'=>'vacaciones','name'=>'vacaciones','color'=>'#3b82f6','trabajo'=>false],
    ];
  }

  // Normalize holidays (YYYY-MM-DD)
  $holSet = [];
  foreach ($holidays as $h) {
    $h = (string)$h;
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $h)) $holSet[$h] = true;
  }
  $holOut = array_keys($holSet);
  sort($holOut);

  // Normalize events (minimal)
  $evOut = [];
  foreach ($events as $ev) {
    if (!is_array($ev)) continue;
    $anio  = (int)($ev['anio'] ?? 0);
    $mes   = (int)($ev['mes'] ?? 0);
    $dia   = (int)($ev['dia'] ?? 0);
    $start = (int)($ev['start'] ?? 0);
    $end   = (int)($ev['end'] ?? 0);
    $catId = trim((string)($ev['catId'] ?? 'personal'));
    $texto = (string)($ev['texto'] ?? '');

    if ($anio < 1970 || $mes < 1 || $mes > 12 || $dia < 1 || $dia > 31) continue;
    if ($start < 0 || $end < 0 || $end <= $start) continue;

    $repeat = $ev['repeat'] ?? ['freq'=>'none','interval'=>1,'until'=>'','byWeekdays'=>null];
    if (!is_array($repeat)) $repeat = ['freq'=>'none','interval'=>1,'until'=>'','byWeekdays'=>null];
    $freq = (string)($repeat['freq'] ?? 'none');
    $interval = (int)($repeat['interval'] ?? 1);
    if ($interval < 1) $interval = 1;
    $until = (string)($repeat['until'] ?? '');
    if ($until !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $until)) $until = '';
    $byWeekdays = $repeat['byWeekdays'] ?? null;
    if (is_array($byWeekdays)) {
      $tmp = [];
      foreach ($byWeekdays as $wd) {
        $wd = (int)$wd;
        if ($wd >= 1 && $wd <= 7) $tmp[] = $wd;
      }
      $byWeekdays = $tmp ?: null;
    } else {
      $byWeekdays = null;
    }

    // Limit text size per event
    if (mb_strlen($texto, 'UTF-8') > 2000) $texto = mb_substr($texto, 0, 2000, 'UTF-8');

    $evOut[] = [
      'anio' => $anio,
      'mes' => $mes,
      'dia' => $dia,
      'start' => $start,
      'end' => $end,
      'catId' => $catId,
      'texto' => $texto,
      'repeat' => [
        'freq' => in_array($freq, ['none','daily','weekly','monthly','yearly'], true) ? $freq : 'none',
        'interval' => $interval,
        'until' => $until,
        'byWeekdays' => $byWeekdays,
      ],
    ];
  }

  return [
    'version' => $version ?: 2,
    'categories' => $catOut,
    'holidays' => $holOut,
    'events' => $evOut,
  ];
}

/* =========================
   ROUTER
   ========================= */
try {
  $a = action();

  // Quick health check
  if ($a === 'ping') {
    json_out(['ok' => true, 'time' => gmdate('c')]);
  }

  if ($a === 'me') {
    if (!is_logged_in()) json_out(['ok'=>true, 'logged_in'=>false]);
    json_out([
      'ok' => true,
      'logged_in' => true,
      'user' => [
        'id' => (int)$_SESSION['uid'],
        'username' => (string)($_SESSION['username'] ?? ''),
      ],
    ]);
  }

  if ($a === 'register') {
    if (method() !== 'POST') json_out(['ok'=>false,'error'=>'Método no permitido'], 405);

    $in = read_body_json();
    $username = normalize_username((string)($in['username'] ?? ''));
    $password = (string)($in['password'] ?? '');

    if (!valid_username($username)) {
      json_out(['ok'=>false,'error'=>'Usuario inválido (usa letras, números, _ . -)'], 400);
    }
    if (!valid_password($password)) {
      json_out(['ok'=>false,'error'=>'Contraseña demasiado corta'], 400);
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $db = pdo();

    $st = $db->prepare("INSERT INTO users(username, pass_hash) VALUES(:u, :h)");
    try {
      $st->execute([':u'=>$username, ':h'=>$hash]);
    } catch (PDOException $e) {
      // unique constraint
      json_out(['ok'=>false,'error'=>'Ese usuario ya existe'], 409);
    }

    $uid = (int)$db->lastInsertId();

    // Initialize empty data (optional)
    $empty = normalize_calendar_data([
      'version' => 2,
      'categories' => [],
      'holidays' => [],
      'events' => [],
    ]);
    $db->prepare("INSERT INTO user_data(user_id, data_json) VALUES(:uid, :json)")
       ->execute([':uid'=>$uid, ':json'=>json_encode($empty, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)]);

    // Auto-login after register
    $_SESSION['uid'] = $uid;
    $_SESSION['username'] = $username;

    json_out(['ok'=>true, 'registered'=>true, 'user'=>['id'=>$uid,'username'=>$username]]);
  }

  if ($a === 'login') {
    if (method() !== 'POST') json_out(['ok'=>false,'error'=>'Método no permitido'], 405);

    $in = read_body_json();
    $username = normalize_username((string)($in['username'] ?? ''));
    $password = (string)($in['password'] ?? '');

    if ($username === '' || $password === '') {
      json_out(['ok'=>false,'error'=>'Faltan credenciales'], 400);
    }

    $db = pdo();
    $st = $db->prepare("SELECT id, username, pass_hash FROM users WHERE username = :u LIMIT 1");
    $st->execute([':u'=>$username]);
    $row = $st->fetch();

    if (!$row || !password_verify($password, (string)$row['pass_hash'])) {
      json_out(['ok'=>false,'error'=>'Credenciales incorrectas'], 401);
    }

    $_SESSION['uid'] = (int)$row['id'];
    $_SESSION['username'] = (string)$row['username'];

    json_out(['ok'=>true, 'logged_in'=>true, 'user'=>['id'=>(int)$row['id'],'username'=>(string)$row['username']]]);
  }

  if ($a === 'logout') {
    if (method() !== 'POST') json_out(['ok'=>false,'error'=>'Método no permitido'], 405);
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time()-42000,
        $params['path'], $params['domain'], (bool)$params['secure'], (bool)$params['httponly']
      );
    }
    session_destroy();
    json_out(['ok'=>true, 'logged_out'=>true]);
  }

  if ($a === 'load') {
    $uid = require_login();
    $db = pdo();

    $st = $db->prepare("SELECT data_json, updated_at FROM user_data WHERE user_id = :uid LIMIT 1");
    $st->execute([':uid'=>$uid]);
    $row = $st->fetch();

    if (!$row) {
      // create row lazily
      $empty = normalize_calendar_data(['version'=>2,'categories'=>[],'holidays'=>[],'events'=>[]]);
      $db->prepare("INSERT INTO user_data(user_id, data_json) VALUES(:uid, :json)")
         ->execute([':uid'=>$uid, ':json'=>json_encode($empty, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)]);
      json_out(['ok'=>true, 'data'=>$empty, 'updated_at'=>gmdate('c')]);
    }

    $data = json_decode((string)$row['data_json'], true);
    if (!is_array($data)) $data = ['version'=>2,'categories'=>[],'holidays'=>[],'events'=>[]];

    // Normalize before returning (keeps things consistent)
    $norm = normalize_calendar_data($data);

    json_out(['ok'=>true, 'data'=>$norm, 'updated_at'=>(string)$row['updated_at']]);
  }

  if ($a === 'save') {
    $uid = require_login();
    if (method() !== 'POST') json_out(['ok'=>false,'error'=>'Método no permitido'], 405);

    $in = read_body_json();
    if (!array_key_exists('data', $in)) {
      json_out(['ok'=>false,'error'=>'Falta campo "data"'], 400);
    }

    $norm = normalize_calendar_data($in['data']);
    $json = json_encode($norm, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

    $db = pdo();
    $st = $db->prepare("
      INSERT INTO user_data(user_id, data_json, updated_at)
      VALUES(:uid, :json, datetime('now'))
      ON CONFLICT(user_id) DO UPDATE SET
        data_json = excluded.data_json,
        updated_at = datetime('now')
    ");
    $st->execute([':uid'=>$uid, ':json'=>$json]);

    json_out(['ok'=>true, 'saved'=>true, 'updated_at'=>gmdate('c')]);
  }

  json_out(['ok'=>false,'error'=>'Acción no encontrada'], 404);

} catch (Throwable $e) {
  // Avoid leaking details in production; keep it simple
  json_out(['ok'=>false,'error'=>'Error interno'], 500);
}


```
**index.html**
```html
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Calendario</title>

    <style>
      :root{
        --bg:#f6f7fb;
        --card:#ffffff;
        --stroke:#e7e9f2;
        --text:#0f172a;
        --muted:#64748b;
        --shadow: 0 10px 30px rgba(15,23,42,.08);
        --r: 16px;

        --hour-h-month: 14px;  /* mes (compacto) */
        --hour-h-panel: 42px;  /* semana/día (legible) */

        --day-start: 8;  /* 08:00 */
        --day-end: 22;   /* 22:00 */
      }

      *{ box-sizing:border-box; }
      html, body{ height:100%; }
      body{
        margin:0;
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, "Noto Sans", Arial;
        background: var(--bg);
        color: var(--text);
        overflow:hidden; /* experiencia full-height */
      }

      .app{
        height: 100vh;
        width: 100%;
    
        margin: 0 auto;
        padding: 18px 16px 18px;
        display:flex;
        flex-direction:column;
        gap: 14px;
        overflow:hidden;
      }

      /* topbar */
      .topbar{
        position: sticky;
        top: 0;
        z-index: 50;
        background: rgba(246,247,251,.85);
        backdrop-filter: blur(10px);
        border:1px solid var(--stroke);
        border-radius: var(--r);
        box-shadow: var(--shadow);
        padding: 14px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap: 12px;
        flex-wrap:wrap;
      }

      .brand{
        display:flex;
        flex-direction:column;
        gap: 2px;
        min-width: 220px;
      }
      .brand .t{ font-weight:800; letter-spacing:.2px; }
      .brand .s{ color: var(--muted); font-size: 12px; }

      .grupo{
        display:flex;
        gap:10px;
        align-items:center;
        flex-wrap:wrap;
      }

      .btn{
        border:1px solid var(--stroke);
        background: #fff;
        color: var(--text);
        border-radius: 999px;
        padding: 10px 14px;
        font-size: 13px;
        cursor:pointer;
        transition: transform .12s ease, box-shadow .12s ease, background .12s ease;
        user-select:none;
        white-space:nowrap;
      }
      .btn:hover{ transform: translateY(-1px); box-shadow: 0 8px 18px rgba(15,23,42,.08); }
      .btn:active{ transform: translateY(0px); }

      .btn.primary{
        background: #0ea5e9;
        color: #fff;
        border-color: rgba(14,165,233,.25);
      }
      .btn.danger{
        background:#ef4444;
        color:#fff;
        border-color: rgba(239,68,68,.25);
      }
      .btn.ghost{
        background: transparent;
      }

      .pill{
        border:1px solid var(--stroke);
        background: #fff;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        color: var(--muted);
        display:flex;
        align-items:center;
        gap:8px;
        max-width: 520px;
      }
      .pill b{ color: var(--text); }
      .dot{
        width:10px;height:10px;border-radius:999px;
        background:#94a3b8;
        box-shadow: 0 0 0 3px rgba(148,163,184,.15);
      }

      .acciones{
        border:1px solid var(--stroke);
        background: #fff;
        border-radius: 999px;
        padding: 10px 14px;
        font-size: 13px;
        cursor:pointer;
        user-select:none;
      }
      .acciones.activa{
        background:#0f172a;
        color:#fff;
        border-color:#0f172a;
      }

      /* contenedores */
      .main{
        flex: 1;
        min-height: 0;
        overflow:hidden;
        display:flex;
        flex-direction:column;
        gap: 14px;
      }

      #jvcalendario{
        flex: 1;
        min-height:0;
        overflow:auto;
        padding-bottom: 12px;
      }
      #panel_vista{
        flex:1;
        min-height:0;
        overflow:hidden;
      }
      #panel_vista .panel_body{
        height: calc(100% - 56px);
        overflow:auto;
      }

      .oculto{ display:none !important; }

      /* -------- VISTA AÑO -------- */
      .vista_anual{
        display:grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
      }
      @media (max-width: 1200px){
        .vista_anual{ grid-template-columns: 1fr; }
      }

      .mes{
        border:1px solid var(--stroke);
        background: var(--card);
        border-radius: var(--r);
        box-shadow: var(--shadow);
        overflow:hidden;
      }
      .cabecera_mes{
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding: 12px 14px;
        border-bottom:1px solid var(--stroke);
      }
      .cabecera_mes .nombre{ font-weight:800; }
      .cabecera_mes .info{ color: var(--muted); font-size: 12px; }

      /* -------- VISTA MES (grid 7 col) -------- */
      .mes.grid{
        display:grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
      }

      .dia{
        border-right:1px solid var(--stroke);
        border-bottom:1px solid var(--stroke);
        padding: 10px;
        position:relative;
        background:#fff;
      }
      .dia:hover{ background:#fbfcff; }

      .desactivado{
        background: #fafafa;
        color: rgba(15,23,42,.45);
      }

      .dia .numdia{
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap: 10px;
        font-weight:800;
        cursor:pointer;
        user-select:none;
      }
      .dia .numdia .mini{
        font-weight:600;
        font-size: 11px;
        color: var(--muted);
        border:1px solid var(--stroke);
        padding: 3px 8px;
        border-radius: 999px;
        background:#fff;
        display:flex;
        align-items:center;
        gap:6px;
      }
      .badge{
        font-size: 10px;
        padding: 2px 8px;
        border-radius: 999px;
        border:1px solid var(--stroke);
        color: var(--muted);
        background:#fff;
      }
      .badge.holiday{
        color:#b91c1c;
        border-color: rgba(185,28,28,.25);
        background: rgba(239,68,68,.08);
      }

      /* timeline dentro del día */
      .timeline{
        margin-top: 8px;
        position:relative;
        height: calc((var(--day-end) - var(--day-start)) * var(--hour-h-month));
        border:1px solid var(--stroke);
        border-radius: 12px;
        overflow: hidden;
        background:
          linear-gradient(#fff,#fff),
          repeating-linear-gradient(
            to bottom,
            transparent,
            transparent calc(var(--hour-h-month) - 1px),
            rgba(15,23,42,.06) calc(var(--hour-h-month) - 1px),
            rgba(15,23,42,.06) var(--hour-h-month)
          );
      }

      .tick{
        position:absolute;
        left:0; right:0;
        height: var(--hour-h-month);
        cursor:pointer;
      }
      .tick:hover{ background: rgba(14,165,233,.05); }

      /* evento absoluto */
      .evento{
        position:absolute;
        left: 6px;
        right: 6px;
        border-radius: 12px;
        padding: 6px 8px;
        background: color-mix(in srgb, var(--cat) 92%, white 8%);
        color:#fff;
        border:1px solid color-mix(in srgb, var(--cat) 78%, white 22%);
        box-shadow: 0 8px 18px rgba(15,23,42,.10);
        font-size: 12px;
        overflow:hidden;
      }
      .evento .t{
        font-weight:700;
        line-height: 1.2;
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
      }
      .evento .h{
        margin-top: 2px;
        font-size: 11px;
        opacity:.92;
      }
      .evento .rpt{
        margin-top: 3px;
        font-size: 10px;
        opacity:.9;
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
      }
      .evento:focus{
        outline:none;
        box-shadow: 0 10px 22px rgba(15,23,42,.16);
      }

      /* -------- PANEL SEMANA/DÍA -------- */
      #panel_vista{
        border:1px solid var(--stroke);
        background: var(--card);
        border-radius: var(--r);
        box-shadow: var(--shadow);
        overflow:hidden;
      }
      #panel_vista .panel_head{
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding: 12px 14px;
        border-bottom:1px solid var(--stroke);
        gap:10px;
        flex-wrap:wrap;
      }
      #panel_vista .panel_head .ttl{
        font-weight:800;
      }
      #panel_vista .panel_body{
        padding: 12px;
      }

      .grid_semana2{
        display:grid;
        grid-template-columns: 72px repeat(7, minmax(0, 1fr));
        gap: 10px;
        align-items:start;
      }
      .celda_lbl{
        font-size: 12px;
        color: var(--muted);
        display:flex;
        align-items:center;
        justify-content:center;
      }
      .dia_lbl{
        border:1px solid var(--stroke);
        border-radius: 12px;
        background: #fbfcff;
        padding: 10px 8px;
        font-weight:800;
        font-size: 12px;
        text-align:center;
        display:flex;
        justify-content:center;
        gap:8px;
        align-items:center;
        flex-wrap:wrap;
      }

      .col_dia{
        border:1px solid var(--stroke);
        border-radius: 14px;
        overflow:hidden;
        background:#fff;
      }
      .col_dia .timeline{
        height: calc((var(--day-end) - var(--day-start)) * var(--hour-h-panel));
        border:0;
        border-radius:0;
        background:
          linear-gradient(#fff,#fff),
          repeating-linear-gradient(
            to bottom,
            transparent,
            transparent calc(var(--hour-h-panel) - 1px),
            rgba(15,23,42,.06) calc(var(--hour-h-panel) - 1px),
            rgba(15,23,42,.06) var(--hour-h-panel)
          );
      }
      .col_dia .tick{ height: var(--hour-h-panel); }

      .lista_dia{
        display:flex;
        gap: 14px;
        align-items:stretch;
      }
      .lista_dia .col_horas{
        width: 72px;
        color: var(--muted);
        font-size: 12px;
        display:flex;
        flex-direction:column;
        gap: 0;
      }
      .lista_dia .col_horas .hitem{
        height: var(--hour-h-panel);
        display:flex;
        align-items:center;
        justify-content:center;
      }
      .lista_dia .col_main{
        flex:1;
        border:1px solid var(--stroke);
        border-radius: 14px;
        overflow:hidden;
        background:#fff;
      }
      .lista_dia .col_main .timeline{
        height: calc((var(--day-end) - var(--day-start)) * var(--hour-h-panel));
        border:0;
        border-radius:0;
      }
      .lista_dia .col_main .tick{ height: var(--hour-h-panel); }

      /* -------- MODALES -------- */
      .modal_back{
        position:fixed;
        inset:0;
        background: rgba(15,23,42,.40);
        display:flex;
        align-items:center;
        justify-content:center;
        padding: 18px;
        z-index: 200;
      }
      .modal{
        width: min(720px, 100%);
        border:1px solid var(--stroke);
        background: #fff;
        border-radius: var(--r);
        box-shadow: 0 20px 60px rgba(15,23,42,.22);
        overflow:hidden;
      }
      .modal.sm{ width: min(560px, 100%); }
      .modal .mh{
        padding: 14px 16px;
        border-bottom:1px solid var(--stroke);
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:10px;
      }
      .modal .mh .ttl{ font-weight:800; }
      .modal .mb{
        padding: 16px;
        display:flex;
        flex-direction:column;
        gap: 12px;
      }
      .row{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
      }
      .field label{
        display:block;
        font-size: 12px;
        color: var(--muted);
        margin-bottom: 6px;
      }
      .field input, .field select, .field textarea{
        width: 100%;
        border:1px solid var(--stroke);
        border-radius: 12px;
        padding: 10px 12px;
        font-size: 13px;
        outline:none;
        background:#fff;
      }
      .field textarea{ min-height: 90px; resize: vertical; }
      .modal .mf{
        padding: 14px 16px;
        border-top:1px solid var(--stroke);
        display:flex;
        justify-content:flex-end;
        gap: 10px;
        flex-wrap:wrap;
      }

      /* tabs modal gestión */
      .tabs{
        display:flex;
        gap:8px;
        flex-wrap:wrap;
      }
      .tab{
        border:1px solid var(--stroke);
        background:#fff;
        border-radius:999px;
        padding:8px 12px;
        font-size:12px;
        cursor:pointer;
      }
      .tab.activa{
        background:#0f172a;
        color:#fff;
        border-color:#0f172a;
      }
      .list{
        border:1px solid var(--stroke);
        border-radius: 14px;
        overflow:hidden;
        background:#fff;
      }
      .item{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:10px;
        padding: 10px 12px;
        border-bottom:1px solid var(--stroke);
      }
      .item:last-child{ border-bottom:0; }
      .item .l{
        display:flex;
        align-items:center;
        gap:10px;
        min-width:0;
      }
      .item .name{
        font-weight:800;
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
      }
      .item .meta{
        font-size: 12px;
        color: var(--muted);
      }
      .miniBtns{
        display:flex;
        gap:8px;
        align-items:center;
        flex-wrap:wrap;
      }
      .btn.xs{
        padding: 8px 10px;
        font-size: 12px;
      }

      .weekdays{
        display:flex;
        gap:8px;
        flex-wrap:wrap;
      }
      .wd{
        display:flex;
        align-items:center;
        gap:6px;
        border:1px solid var(--stroke);
        border-radius:999px;
        padding:6px 10px;
        font-size:12px;
        background:#fff;
      }

      /* -------- MODAL AUTH -------- */
      .help{
        font-size:12px;
        color: var(--muted);
        line-height:1.4;
      }
      .split2{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
      }
      @media (max-width: 760px){
        .split2{ grid-template-columns: 1fr; }
      }

      .toast{
        position: fixed;
        right: 16px;
        bottom: 16px;
        z-index: 999;
        background: rgba(15,23,42,.92);
        color:#fff;
        border-radius: 14px;
        padding: 10px 12px;
        font-size: 13px;
        box-shadow: 0 14px 40px rgba(15,23,42,.25);
        opacity:0;
        transform: translateY(8px);
        transition: opacity .18s ease, transform .18s ease;
        pointer-events:none;
        max-width: 520px;
      }
      .toast.show{
        opacity:1;
        transform: translateY(0);
      }
      code.k{
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-size: 12px;
        background:#f1f5f9;
        border:1px solid var(--stroke);
        padding: 2px 6px;
        border-radius: 8px;
        color:#0f172a;
      }
    </style>
  </head>

  <body>
    <div class="app">
      <div class="topbar">
        <div class="brand">
          <div class="t">Calendario</div>
          <div class="s" id="estado"></div>
        </div>

        <div class="grupo">
          <button id="guardar" class="btn">Guardar</button>

          <button id="descargar" class="btn primary">Descargar JSON</button>
          <button id="cargar" class="btn">Cargar JSON</button>
          <input id="file" type="file" accept="application/json" class="oculto"/>

          <button id="btn_gestion" class="btn">Categorías / Festivos</button>

          <span class="pill" title="Si inicias sesión, se sincroniza con SQLite. Si no, se usa localStorage.">
            <span class="dot" id="activo_dot"></span>
            Activo: <b id="activo_lbl">—</b>
            <span style="width:1px;height:14px;background:var(--stroke);display:inline-block;margin:0 6px;"></span>
            Cuenta: <b id="auth_lbl">local</b>
          </span>

          <div class="grupo" id="cats_bar"></div>
        </div>

        <div class="grupo">
          <button id="btn_auth" class="btn">Iniciar sesión</button>
          <button id="btn_logout" class="btn oculto">Salir</button>
          <button id="btn_sync" class="btn primary">Sincronizar</button>
          <button class="acciones anio">Año</button>
          <button class="acciones mes activa">Mes</button>
          <button class="acciones semana">Semana</button>
          <button class="acciones dia">Dia</button>
        </div>
      </div>

      <div class="main">
        <div id="panel_vista" class="oculto">
          <div class="panel_head">
            <div class="ttl" id="panel_titulo">Vista</div>
            <div class="grupo">
              <button id="prev" class="btn">◀</button>
              <button id="hoy" class="btn">Hoy</button>
              <button id="next" class="btn">▶</button>
            </div>
          </div>
          <div class="panel_body" id="panel_body"></div>
        </div>

        <div id="jvcalendario"></div>
      </div>
    </div>

    <!-- MODAL EVENTO -->
    <div id="modal_back" class="modal_back oculto">
      <div class="modal sm">
        <div class="mh">
          <div class="ttl" id="modal_titulo">Nuevo evento</div>
          <button id="modal_close" class="btn">Cerrar</button>
        </div>

        <div class="mb">
          <div class="row">
            <div class="field">
              <label>Inicio</label>
              <input id="m_ini" type="time" step="300" value="08:00">
            </div>
            <div class="field">
              <label>Fin</label>
              <input id="m_fin" type="time" step="300" value="09:00">
            </div>
          </div>

          <div class="field">
            <label>Texto</label>
            <textarea id="m_txt" placeholder="Escribe el evento..."></textarea>
          </div>

          <div class="field">
            <label>Categoría</label>
            <select id="m_cat"></select>
          </div>

          <div class="row">
            <div class="field">
              <label>Repetir</label>
              <select id="m_rep_tipo">
                <option value="none">No repetir</option>
                <option value="daily">Diario</option>
                <option value="weekly">Semanal</option>
                <option value="monthly">Mensual</option>
                <option value="yearly">Anual</option>
              </select>
            </div>
            <div class="field">
              <label>Intervalo</label>
              <input id="m_rep_int" type="number" min="1" value="1">
            </div>
          </div>

          <div class="field" id="m_rep_weekdays_wrap" class="oculto">
            <label>Días (solo semanal)</label>
            <div class="weekdays" id="m_rep_weekdays"></div>
          </div>

          <div class="field">
            <label>Repetir hasta (inclusive)</label>
            <input id="m_rep_until" type="date">
          </div>

          <div class="pill" id="m_hint">—</div>
        </div>

        <div class="mf">
          <button id="modal_delete" class="btn danger oculto">Eliminar</button>
          <button id="modal_ok" class="btn primary">Guardar</button>
        </div>
      </div>
    </div>

    <!-- MODAL GESTIÓN -->
    <div id="mg_back" class="modal_back oculto">
      <div class="modal">
        <div class="mh">
          <div class="ttl">Gestión</div>
          <button id="mg_close" class="btn">Cerrar</button>
        </div>

        <div class="mb">
          <div class="tabs">
            <button class="tab activa" data-tab="cats">Categorías</button>
            <button class="tab" data-tab="hol">Festivos</button>
          </div>

          <!-- CATEGORÍAS -->
          <div id="tab_cats">
            <div class="row">
              <div class="field">
                <label>Nombre</label>
                <input id="cat_name" placeholder="p. ej. personal">
              </div>
              <div class="field">
                <label>Color</label>
                <input id="cat_color" type="color" value="#ef4444">
              </div>
            </div>

            <div class="row">
              <div class="field">
                <label>¿Trabajo?</label>
                <select id="cat_work">
                  <option value="false">No</option>
                  <option value="true">Sí</option>
                </select>
              </div>
              <div class="field">
                <label>&nbsp;</label>
                <button id="cat_add" class="btn primary">Crear categoría</button>
              </div>
            </div>

            <div class="pill">
              Si una categoría es “trabajo”, sus eventos <b>no se mostrarán</b> en días marcados como festivos.
            </div>

            <div class="list" id="cat_list"></div>
          </div>

          <!-- FESTIVOS -->
          <div id="tab_hol" class="oculto">
            <div class="row">
              <div class="field">
                <label>Fecha festivo</label>
                <input id="hol_date" type="date">
              </div>
              <div class="field">
                <label>&nbsp;</label>
                <button id="hol_add" class="btn primary">Añadir festivo</button>
              </div>
            </div>

            <div class="pill">
              Los festivos se guardan como fechas (YYYY-MM-DD). Se aplican a cualquier año cargado.
            </div>

            <div class="list" id="hol_list"></div>
          </div>
        </div>

        <div class="mf">
          <button id="mg_export" class="btn">Copiar JSON (debug)</button>
          <button id="mg_ok" class="btn primary">Cerrar</button>
        </div>
      </div>
    </div>

    <!-- MODAL AUTH (login/registro) -->
    <div id="auth_back" class="modal_back oculto">
      <div class="modal">
        <div class="mh">
          <div class="ttl">Cuenta</div>
          <button id="auth_close" class="btn">Cerrar</button>
        </div>

        <div class="mb">
          <div class="pill" id="auth_status">Estado: —</div>

          <div class="split2">
            <div>
              <div class="pill"><b>Iniciar sesión</b></div>
              <div class="field" style="margin-top:10px;">
                <label>Email</label>
                <input id="login_email" type="email" placeholder="email@dominio.com" autocomplete="username">
              </div>
              <div class="field">
                <label>Contraseña</label>
                <input id="login_pass" type="password" placeholder="••••••••" autocomplete="current-password">
              </div>
              <div class="grupo" style="margin-top:10px;">
                <button id="login_btn" class="btn primary">Entrar</button>
              </div>
              <div class="help" style="margin-top:10px;">
                Si inicias sesión, <b>Guardar/Sincronizar</b> se guardará en SQLite mediante el endpoint PHP.
              </div>
            </div>

            <div>
              <div class="pill"><b>Registro</b></div>
              <div class="field" style="margin-top:10px;">
                <label>Email</label>
                <input id="reg_email" type="email" placeholder="email@dominio.com" autocomplete="email">
              </div>
              <div class="field">
                <label>Contraseña</label>
                <input id="reg_pass" type="password" placeholder="mínimo 8 caracteres" autocomplete="new-password">
              </div>
              <div class="field">
                <label>Repite contraseña</label>
                <input id="reg_pass2" type="password" placeholder="••••••••" autocomplete="new-password">
              </div>
              <div class="grupo" style="margin-top:10px;">
                <button id="reg_btn" class="btn">Crear cuenta</button>
              </div>
              <div class="help" style="margin-top:10px;">
                Tras registrarte, el servidor iniciará sesión y podrás sincronizar.
              </div>
            </div>
          </div>

          <div class="pill">
            Nota: sin sesión, todo queda en <code class="k">localStorage</code>. Con sesión, el servidor es la “fuente principal”.
          </div>
        </div>

        <div class="mf">
          <button id="auth_logout2" class="btn danger oculto">Cerrar sesión</button>
          <button id="auth_ok" class="btn primary">Cerrar</button>
        </div>
      </div>
    </div>

    <div id="toast" class="toast"></div>

    <script>
      // ============================================================
      // CONFIG: endpoint PHP (mismo directorio)
      // Ajusta el nombre si tu PHP se llama distinto:
      // ============================================================
      const API_URL = "calendar.php"; // <-- debe ser el PHP single-file que ya creaste

      // -------------------------------
      // utilidades base
      // -------------------------------
      function pad2(n){ return String(n).padStart(2,"0"); }
      function fechaKey(a,m,d){ return a+"-"+pad2(m)+"-"+pad2(d); }
      function hhmmToMin(hhmm){
        let p = (hhmm||"").split(":");
        let h = Number(p[0]||0);
        let m = Number(p[1]||0);
        return (h*60+m);
      }
      function minToHHMM(min){
        let h = Math.floor(min/60);
        let m = min%60;
        return pad2(h)+":"+pad2(m);
      }
      function clamp(v, a, b){ return Math.max(a, Math.min(b, v)); }
      function toDateObj(a,m,d){ return new Date(a, m-1, d); }
      function isoFromDate(d){
        return d.getFullYear()+"-"+pad2(d.getMonth()+1)+"-"+pad2(d.getDate());
      }
      function dateFromISO(iso){
        let p = String(iso||"").split("-");
        if(p.length!==3) return null;
        let y=Number(p[0]), m=Number(p[1]), d=Number(p[2]);
        if(!y||!m||!d) return null;
        return new Date(y,m-1,d);
      }

      function toast(msg, ms=2200){
        const t = document.querySelector("#toast");
        t.textContent = msg;
        t.classList.add("show");
        clearTimeout(toast._tm);
        toast._tm = setTimeout(()=>t.classList.remove("show"), ms);
      }

      // -------------------------------
      // storage keys (local)
      // -------------------------------
      const K_EVENTS   = "jvcalendario";
      const K_CATS     = "jvcal_categories";
      const K_HOLIDAYS = "jvcal_holidays";

      // -------------------------------
      // defaults y migración
      // -------------------------------
      function defaultCats(){
        return [
          { id:"personal",   name:"personal",   color:"#ef4444", trabajo:false },
          { id:"laboral",    name:"laboral",    color:"#22c55e", trabajo:true  },
          { id:"vacaciones", name:"vacaciones", color:"#3b82f6", trabajo:false }
        ];
      }

      function readJSON(key, fallback){
        let raw = localStorage.getItem(key);
        if(!raw) return fallback;
        try{ return JSON.parse(raw); }catch(e){ return fallback; }
      }
      function writeJSON(key, val){
        localStorage.setItem(key, JSON.stringify(val));
      }

      function loadCats(){
        let cats = readJSON(K_CATS, null);
        if(!Array.isArray(cats) || cats.length===0){
          cats = defaultCats();
          writeJSON(K_CATS, cats);
        }
        cats = cats.map(c => ({
          id: String(c.id||"").trim() || ("cat_"+Math.random().toString(16).slice(2)),
          name: String(c.name||c.id||"").trim() || "categoria",
          color: String(c.color||"#94a3b8"),
          trabajo: !!c.trabajo
        }));
        writeJSON(K_CATS, cats);
        return cats;
      }

      function loadHolidays(){
        let hol = readJSON(K_HOLIDAYS, []);
        if(!Array.isArray(hol)) hol = [];
        hol = hol.map(x => String(x)).filter(x => /^\d{4}-\d{2}-\d{2}$/.test(x));
        hol = Array.from(new Set(hol)).sort();
        writeJSON(K_HOLIDAYS, hol);
        return hol;
      }

      function migrateEvents(events, cats){
        if(!Array.isArray(events)) return [];
        let catIds = new Set(cats.map(c=>c.id));
        return events.map(ev=>{
          let out = Object.assign({}, ev);

          if(out.tipo && !out.catId) out.catId = String(out.tipo);
          if(!out.catId) out.catId = "personal";
          if(!catIds.has(out.catId)){
            if(String(out.catId).toLowerCase()==="laboral") out.catId="laboral";
            else if(String(out.catId).toLowerCase()==="vacaciones") out.catId="vacaciones";
            else out.catId="personal";
          }

          out.anio  = Number(out.anio);
          out.mes   = Number(out.mes);
          out.dia   = Number(out.dia);
          out.start = Number(out.start);
          out.end   = Number(out.end);
          out.texto = String(out.texto||"");

          if(out.repeat && typeof out.repeat==="object"){
            out.repeat = {
              freq: String(out.repeat.freq||"none"),
              interval: Math.max(1, Number(out.repeat.interval||1)),
              until: out.repeat.until ? String(out.repeat.until) : "",
              byWeekdays: Array.isArray(out.repeat.byWeekdays) ? out.repeat.byWeekdays.map(Number).filter(n=>n>=1 && n<=7) : null
            };
            if(!out.repeat.until) out.repeat.until = "";
          }else{
            out.repeat = { freq:"none", interval:1, until:"", byWeekdays:null };
          }
          return out;
        });
      }

      function loadEvents(cats){
        let events = readJSON(K_EVENTS, []);
        events = migrateEvents(events, cats);
        writeJSON(K_EVENTS, events);
        return events;
      }

      // -------------------------------
      // API helpers (PHP)
      // -------------------------------
      let AUTH = { loggedIn:false, email:null };

      async function apiPost(action, payload){
        const res = await fetch(API_URL + "?action=" + encodeURIComponent(action), {
          method: "POST",
          headers: {"Content-Type":"application/json"},
          credentials: "same-origin",
          body: JSON.stringify(payload || {})
        });
        const txt = await res.text();
        let data = null;
        try{ data = JSON.parse(txt); }catch(e){
          throw new Error("Respuesta no JSON del servidor: " + txt.slice(0,200));
        }
        if(!res.ok || data?.ok===false){
          throw new Error(data?.error || ("HTTP " + res.status));
        }
        return data;
      }

      async function apiGet(action){
        const res = await fetch(API_URL + "?action=" + encodeURIComponent(action), {
          method: "GET",
          credentials: "same-origin"
        });
        const txt = await res.text();
        let data = null;
        try{ data = JSON.parse(txt); }catch(e){
          throw new Error("Respuesta no JSON del servidor: " + txt.slice(0,200));
        }
        if(!res.ok || data?.ok===false){
          throw new Error(data?.error || ("HTTP " + res.status));
        }
        return data;
      }

      async function refreshAuth(){
        try{
          const s = await apiGet("status");
          AUTH.loggedIn = !!s.loggedIn;
          AUTH.email = s.email || null;
        }catch(e){
          // si el endpoint no está disponible, queda en modo local
          AUTH.loggedIn = false;
          AUTH.email = null;
        }
        renderAuthBadge();
      }

      function renderAuthBadge(){
        const lbl = document.querySelector("#auth_lbl");
        const btnAuth = document.querySelector("#btn_auth");
        const btnLogout = document.querySelector("#btn_logout");
        const authLogout2 = document.querySelector("#auth_logout2");

        if(AUTH.loggedIn){
          lbl.textContent = AUTH.email || "sesión";
          btnAuth.textContent = "Cuenta";
          btnLogout.classList.remove("oculto");
          authLogout2.classList.remove("oculto");
        }else{
          lbl.textContent = "local";
          btnAuth.textContent = "Iniciar sesión";
          btnLogout.classList.add("oculto");
          authLogout2.classList.add("oculto");
        }
      }

      async function serverLoadAll(){
        const data = await apiGet("load");
        return {
          categories: Array.isArray(data.categories) ? data.categories : null,
          holidays: Array.isArray(data.holidays) ? data.holidays : null,
          events: Array.isArray(data.events) ? data.events : null
        };
      }

      async function serverSaveAll(payload){
        // payload: {categories, holidays, events}
        return await apiPost("save", payload);
      }

      // -------------------------------
      // lógica de calendario (UI)
      // -------------------------------
      function diasEnMes(year, month) { return new Date(year, month, 0).getDate(); }
      function primerDiaDelMes(year, month) { return new Date(year, month - 1, 1).getDay(); }
      function startOfWeekMonday(dateObj){
        let d = new Date(dateObj);
        d.setHours(0,0,0,0);
        let day = d.getDay();
        let diff = (day===0 ? -6 : 1-day);
        d.setDate(d.getDate()+diff);
        return d;
      }
      function calcTopHeight(startMin, endMin, hourH){
        let dayStart = 8*60;
        let top = ((startMin - dayStart)/60) * hourH;
        let height = ((endMin - startMin)/60) * hourH;
        return { top: top, height: height };
      }
      function makeCatVarStyle(cat){
        return "--cat:" + (cat?.color || "#94a3b8");
      }

      // repetición
      function weekdayMon1(dateObj){
        let g = dateObj.getDay();
        if(g===0) return 7;
        return g;
      }
      function occursOnDate(ev, dateObj){
        let startDate = toDateObj(ev.anio, ev.mes, ev.dia);
        startDate.setHours(0,0,0,0);

        let target = new Date(dateObj);
        target.setHours(0,0,0,0);

        if(target < startDate) return false;

        let r = ev.repeat || {freq:"none", interval:1, until:"", byWeekdays:null};
        let freq = String(r.freq||"none");
        let interval = Math.max(1, Number(r.interval||1));
        let until = r.until ? dateFromISO(r.until) : null;
        if(until){ until.setHours(0,0,0,0); }
        if(until && target > until) return false;

        if(freq === "none"){
          return (target.getTime() === startDate.getTime());
        }
        if(freq === "daily"){
          let diffDays = Math.floor((target - startDate) / 86400000);
          return diffDays % interval === 0;
        }
        if(freq === "weekly"){
          let sMon = startOfWeekMonday(startDate);
          let tMon = startOfWeekMonday(target);
          let diffWeeks = Math.floor((tMon - sMon) / (86400000*7));
          if(diffWeeks % interval !== 0) return false;

          let wd = weekdayMon1(target);
          let by = Array.isArray(r.byWeekdays) && r.byWeekdays.length ? r.byWeekdays : [weekdayMon1(startDate)];
          return by.includes(wd);
        }
        if(freq === "monthly"){
          let months = (target.getFullYear() - startDate.getFullYear())*12 + (target.getMonth() - startDate.getMonth());
          if(months < 0) return false;
          if(months % interval !== 0) return false;
          let day = startDate.getDate();
          if(target.getDate() !== day) return false;
          return true;
        }
        if(freq === "yearly"){
          let diffYears = target.getFullYear() - startDate.getFullYear();
          if(diffYears < 0) return false;
          if(diffYears % interval !== 0) return false;
          return (target.getMonth()===startDate.getMonth() && target.getDate()===startDate.getDate());
        }
        return false;
      }

      function listEventsForDate(dateObj, events, catsById, holidaysSet){
        let iso = isoFromDate(dateObj);
        let out = [];
        for(let ev of events){
          let cat = catsById.get(ev.catId);
          let isWork = !!cat?.trabajo;
          if(isWork && holidaysSet.has(iso)) continue;
          if(occursOnDate(ev, dateObj)) out.push(ev);
        }
        return out;
      }

      function repeatLabel(ev){
        let r = ev.repeat || {freq:"none"};
        if(!r || r.freq==="none") return "";
        let freq = r.freq;
        let interval = Math.max(1, Number(r.interval||1));
        let until = r.until ? (" hasta " + r.until) : "";
        if(freq==="daily") return "Repite: diario" + (interval>1 ? " (cada "+interval+" días)" : "") + until;
        if(freq==="weekly") return "Repite: semanal" + (interval>1 ? " (cada "+interval+" semanas)" : "") + until;
        if(freq==="monthly") return "Repite: mensual" + (interval>1 ? " (cada "+interval+" meses)" : "") + until;
        if(freq==="yearly") return "Repite: anual" + (interval>1 ? " (cada "+interval+" años)" : "") + until;
        return "Repite";
      }

      // -------------------------------
      // estado general
      // -------------------------------
      let contenedor   = document.querySelector("#jvcalendario");
      let panel        = document.querySelector("#panel_vista");
      let panelBody    = document.querySelector("#panel_body");
      let panelTitulo  = document.querySelector("#panel_titulo");
      let estado       = document.querySelector("#estado");

      let anio = 2026;
      let meses = 12;
      let nombres_meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

      let vista = "Mes"; // Año | Mes | Semana | Dia
      let seleccion = { anio: anio, mes: 1, dia: 1 };
      let semanaOffset = 0;
      let diaOffset = 0;

      // datos persistentes (local baseline)
      let CATS = loadCats();
      let HOLIDAYS = loadHolidays();
      let HOLSET = new Set(HOLIDAYS);
      let CATS_BY_ID = new Map(CATS.map(c=>[c.id,c]));
      let EVENTOS = loadEvents(CATS);

      // categoría activa (para crear)
      let calendario_activo = CATS[0]?.id || "personal";
      let activo_lbl = document.querySelector("#activo_lbl");
      let activo_dot = document.querySelector("#activo_dot");

      function setActiveCat(catId){
        if(!CATS_BY_ID.has(catId)) catId = CATS[0]?.id || "personal";
        calendario_activo = catId;
        let c = CATS_BY_ID.get(catId);
        activo_lbl.textContent = c ? c.name : catId;
        activo_dot.style.background = (c?.color || "#94a3b8");
        activo_dot.style.boxShadow = "0 0 0 3px " + (c?.color ? "color-mix(in srgb, "+c.color+" 20%, transparent 80%)" : "rgba(148,163,184,.15)");
      }

      function saveAllLocal(){
        writeJSON(K_CATS, CATS);
        writeJSON(K_HOLIDAYS, HOLIDAYS);
        writeJSON(K_EVENTS, EVENTOS);
      }

      // si hay sesión: Guardar -> servidor (y opcionalmente también local)
      async function saveAllSmart(){
        if(AUTH.loggedIn){
          await serverSaveAll({categories:CATS, holidays:HOLIDAYS, events:EVENTOS});
          toast("Guardado en servidor (SQLite).");
        }else{
          saveAllLocal();
          toast("Guardado en localStorage.");
        }
      }

      // -------------------------------
      // UI: barra de categorías (rápida)
      // -------------------------------
      let catsBar = document.querySelector("#cats_bar");

      function renderCatsBar(){
        catsBar.innerHTML = "";
        CATS.forEach(cat=>{
          let b = document.createElement("button");
          b.className = "btn xs";
          b.textContent = cat.name;
          b.style.cssText = makeCatVarStyle(cat) + ";";
          b.onclick = function(){ setActiveCat(cat.id); };
          catsBar.appendChild(b);
        });
        setActiveCat(calendario_activo);
      }

      // -------------------------------
      // MODAL EVENTO
      // -------------------------------
      let modalBack   = document.querySelector("#modal_back");
      let modalTitulo = document.querySelector("#modal_titulo");
      let m_ini  = document.querySelector("#m_ini");
      let m_fin  = document.querySelector("#m_fin");
      let m_txt  = document.querySelector("#m_txt");
      let m_cat  = document.querySelector("#m_cat");
      let m_hint = document.querySelector("#m_hint");
      let modal_ok    = document.querySelector("#modal_ok");
      let modal_close = document.querySelector("#modal_close");
      let modal_delete= document.querySelector("#modal_delete");

      let m_rep_tipo = document.querySelector("#m_rep_tipo");
      let m_rep_int  = document.querySelector("#m_rep_int");
      let m_rep_until= document.querySelector("#m_rep_until");
      let m_rep_weekdays_wrap = document.querySelector("#m_rep_weekdays_wrap");
      let m_rep_weekdays = document.querySelector("#m_rep_weekdays");

      function fillCatSelect(){
        m_cat.innerHTML = "";
        CATS.forEach(cat=>{
          let opt = document.createElement("option");
          opt.value = cat.id;
          opt.textContent = cat.name + (cat.trabajo ? " (trabajo)" : "");
          m_cat.appendChild(opt);
        });
      }

      function buildWeekdayChips(selected){
        m_rep_weekdays.innerHTML = "";
        let names = [
          {id:1, t:"Lun"},
          {id:2, t:"Mar"},
          {id:3, t:"Mié"},
          {id:4, t:"Jue"},
          {id:5, t:"Vie"},
          {id:6, t:"Sáb"},
          {id:7, t:"Dom"}
        ];
        names.forEach(n=>{
          let w = document.createElement("label");
          w.className = "wd";
          let cb = document.createElement("input");
          cb.type = "checkbox";
          cb.value = n.id;
          cb.checked = selected.includes(n.id);
          w.appendChild(cb);
          let sp = document.createElement("span");
          sp.textContent = n.t;
          w.appendChild(sp);
          m_rep_weekdays.appendChild(w);
        });
      }

      function getSelectedWeekdays(){
        let arr = [];
        m_rep_weekdays.querySelectorAll("input[type=checkbox]").forEach(cb=>{
          if(cb.checked) arr.push(Number(cb.value));
        });
        arr = arr.filter(n=>n>=1 && n<=7);
        return arr;
      }

      let modalCtx = null; // { anio, mes, dia, startMin, editId? }

      function abrirModal(ctx){
        modalCtx = ctx;
        fillCatSelect();

        let start = ctx.startMin || (8*60);
        let end = Math.min(start+60, 22*60);

        m_ini.value = minToHHMM(start);
        m_fin.value = minToHHMM(end);
        m_txt.value = ctx.texto || "";
        m_cat.value = ctx.catId || ctx.tipo || calendario_activo;

        let rep = ctx.repeat || {freq:"none", interval:1, until:"", byWeekdays:null};
        m_rep_tipo.value = rep.freq || "none";
        m_rep_int.value = Math.max(1, Number(rep.interval||1));
        m_rep_until.value = rep.until || "";
        let baseDate = toDateObj(ctx.anio, ctx.mes, ctx.dia);
        let baseWd = weekdayMon1(baseDate);
        let selectedWds = Array.isArray(rep.byWeekdays) && rep.byWeekdays.length ? rep.byWeekdays : [baseWd];
        buildWeekdayChips(selectedWds);

        if(ctx.edit){
          modal_delete.classList.remove("oculto");
          modalTitulo.textContent = "Editar evento";
        }else{
          modal_delete.classList.add("oculto");
          modalTitulo.textContent = "Nuevo evento";
        }

        updateRepeatUI();
        actualizarHintModal();
        modalBack.classList.remove("oculto");
      }

      function cerrarModal(){
        modalBack.classList.add("oculto");
        modalCtx = null;
      }

      function updateRepeatUI(){
        if(m_rep_tipo.value === "weekly"){
          m_rep_weekdays_wrap.classList.remove("oculto");
        }else{
          m_rep_weekdays_wrap.classList.add("oculto");
        }
        actualizarHintModal();
      }

      function actualizarHintModal(){
        if(!modalCtx) return;

        let s = hhmmToMin(m_ini.value);
        let e = hhmmToMin(m_fin.value);
        let dur = Math.max(0, e - s);

        let rep = m_rep_tipo.value;
        let until = m_rep_until.value ? (" · Hasta: " + m_rep_until.value) : "";
        let repTxt = (rep && rep!=="none") ? (" · Repite: " + rep + " (int " + Math.max(1, Number(m_rep_int.value||1)) + ")" + until) : "";

        let cat = CATS_BY_ID.get(m_cat.value);
        let iso = fechaKey(modalCtx.anio, modalCtx.mes, modalCtx.dia);
        let warn = "";
        if(cat?.trabajo && HOLSET.has(iso)){
          warn = " · Aviso: categoría trabajo en festivo (no se mostrará ese día)";
        }
        m_hint.textContent = "Fecha: " + iso + " · Duración: " + dur + " min" + repTxt + warn;
      }

      m_ini.oninput = actualizarHintModal;
      m_fin.oninput = actualizarHintModal;
      m_cat.onchange = actualizarHintModal;
      m_rep_tipo.onchange = updateRepeatUI;
      m_rep_int.oninput = actualizarHintModal;
      m_rep_until.onchange = actualizarHintModal;

      modal_close.onclick = cerrarModal;
      modalBack.addEventListener("click", function(e){
        if(e.target === modalBack) cerrarModal();
      });

      function eventoId(ev){
        let r = ev.repeat || {freq:"none", interval:1, until:"", byWeekdays:null};
        return [
          ev.anio, ev.mes, ev.dia,
          ev.start, ev.end,
          (ev.catId||""),
          (ev.texto||"").trim(),
          (r.freq||"none"),
          (r.interval||1),
          (r.until||""),
          Array.isArray(r.byWeekdays)?r.byWeekdays.join(","):""
        ].join("|");
      }

      modal_ok.onclick = async function(){
        if(!modalCtx) return;

        let dayStart = 8*60;
        let dayEnd = 22*60;

        let s = clamp(hhmmToMin(m_ini.value), dayStart, dayEnd);
        let e = clamp(hhmmToMin(m_fin.value), dayStart, dayEnd);

        if(e <= s){ alert("El fin debe ser posterior al inicio."); return; }

        let rep = {
          freq: m_rep_tipo.value || "none",
          interval: Math.max(1, Number(m_rep_int.value||1)),
          until: m_rep_until.value || "",
          byWeekdays: null
        };
        if(rep.freq === "weekly"){
          let wds = getSelectedWeekdays();
          rep.byWeekdays = wds.length ? wds : null;
        }

        let ev = {
          anio: modalCtx.anio,
          mes: modalCtx.mes,
          dia: modalCtx.dia,
          start: s,
          end: e,
          catId: m_cat.value,
          texto: m_txt.value || "",
          repeat: rep
        };

        if(modalCtx.editId){
          EVENTOS = EVENTOS.map(x => (eventoId(x)===modalCtx.editId) ? ev : x);
        }else{
          EVENTOS.push(ev);
        }

        // guarda local y (si logueado) no forzamos aquí a servidor: se hará con Guardar/Sincronizar
        writeJSON(K_EVENTS, EVENTOS);
        renderAll();
        cerrarModal();
      };

      modal_delete.onclick = function(){
        if(!modalCtx || !modalCtx.editId) return;
        if(!confirm("¿Eliminar este evento?")) return;

        EVENTOS = EVENTOS.filter(x => eventoId(x)!==modalCtx.editId);
        writeJSON(K_EVENTS, EVENTOS);
        renderAll();
        cerrarModal();
      };

      // -------------------------------
      // descargar/cargar JSON (local)
      // -------------------------------
      document.querySelector("#guardar").onclick = async function(){
        try{
          await saveAllSmart();
        }catch(e){
          alert("Error al guardar: " + e.message);
        }
      };

      document.querySelector("#descargar").onclick = function(){
        let payload = {
          version: 2,
          exportedAt: new Date().toISOString(),
          categories: CATS,
          holidays: HOLIDAYS,
          events: EVENTOS
        };

        let data = JSON.stringify(payload, null, 2);
        let blob = new Blob([data], {type:"application/json"});
        let url = URL.createObjectURL(blob);

        let a = document.createElement("a");
        a.href = url;
        a.download = "jvcalendario_"+Date.now()+".json";
        document.body.appendChild(a);
        a.click();
        a.remove();

        URL.revokeObjectURL(url);
      };

      let fileInput = document.querySelector("#file");
      document.querySelector("#cargar").onclick = function(){
        fileInput.value = "";
        fileInput.click();
      };

      fileInput.onchange = function(){
        let f = fileInput.files && fileInput.files[0];
        if(!f) return;

        let reader = new FileReader();
        reader.onload = function(){
          let raw = String(reader.result||"");
          let incoming = null;
          try { incoming = JSON.parse(raw); } catch(e){ alert("JSON inválido."); return; }

          let incCats = null, incHol = null, incEvents = null;

          if(Array.isArray(incoming)){
            incEvents = incoming;
          }else if(incoming && typeof incoming==="object"){
            if(Array.isArray(incoming.categories)) incCats = incoming.categories;
            if(Array.isArray(incoming.holidays)) incHol = incoming.holidays;
            if(Array.isArray(incoming.events)) incEvents = incoming.events;
          }

          if(!incEvents && !incCats && !incHol){
            alert("No se han encontrado datos válidos.");
            return;
          }

          let replace = confirm("OK = REEMPLAZAR todo, Cancelar = AÑADIR (merge)");

          if(replace){
            if(incCats){ CATS = incCats; }
            if(incHol){ HOLIDAYS = incHol; }
            if(incEvents){ EVENTOS = incEvents; }
          }else{
            if(incCats){
              let map = new Map(CATS.map(c=>[String(c.id), c]));
              incCats.forEach(c=>{ map.set(String(c.id), c); });
              CATS = Array.from(map.values());
            }
            if(incHol){
              let set = new Set(HOLIDAYS);
              incHol.forEach(d=>set.add(String(d)));
              HOLIDAYS = Array.from(set);
            }
            if(incEvents){
              let mapE = new Map();
              migrateEvents(EVENTOS, loadCats()).forEach(ev=>mapE.set(eventoId(ev), ev));
              migrateEvents(incEvents, loadCats()).forEach(ev=>mapE.set(eventoId(ev), ev));
              EVENTOS = Array.from(mapE.values());
            }
          }

          CATS = loadCats();
          if(incCats){ writeJSON(K_CATS, CATS = loadCats()); }

          HOLIDAYS = loadHolidays();
          HOLSET = new Set(HOLIDAYS);

          CATS_BY_ID = new Map(CATS.map(c=>[c.id,c]));
          EVENTOS = migrateEvents(EVENTOS, CATS);
          saveAllLocal();

          renderCatsBar();
          setActiveCat(calendario_activo);
          renderAll();
          toast("JSON cargado (local).");
        };
        reader.readAsText(f);
      };

      // -------------------------------
      // crear DOM de evento
      // -------------------------------
      function crearEventoDom(ev, hourH){
        let cat = CATS_BY_ID.get(ev.catId);
        let el = document.createElement("div");
        el.classList.add("evento");
        el.style.cssText = makeCatVarStyle(cat) + ";";

        let p = calcTopHeight(Number(ev.start), Number(ev.end), hourH);
        el.style.top = p.top + "px";
        el.style.height = p.height + "px";

        el.tabIndex = 0;
        el.innerHTML = `
          <div class="t"></div>
          <div class="h"></div>
          <div class="rpt"></div>
        `;

        el.querySelector(".t").textContent = (ev.texto||"").trim() || "(sin texto)";
        el.querySelector(".h").textContent = minToHHMM(Number(ev.start)) + " - " + minToHHMM(Number(ev.end));
        el.querySelector(".rpt").textContent = repeatLabel(ev);

        el.onclick = function(e){
          e.stopPropagation();
          abrirModal({
            anio: Number(ev.anio),
            mes: Number(ev.mes),
            dia: Number(ev.dia),
            startMin: Number(ev.start),
            texto: ev.texto,
            catId: ev.catId,
            repeat: ev.repeat,
            edit: true,
            editId: eventoId(ev)
          });
        };

        el.onkeydown = function(e){
          if(e.key === "Delete" || e.code === "Delete"){
            if(confirm("¿Eliminar este evento?")){
              EVENTOS = EVENTOS.filter(x => eventoId(x)!==eventoId(ev));
              writeJSON(K_EVENTS, EVENTOS);
              renderAll();
            }
          }
        };

        return el;
      }

      function crearTimelineTicks(timeline, hourH, onClickHour){
        let dayStart = 8;
        let dayEnd = 22;
        let hours = (dayEnd - dayStart);

        for(let i=0;i<hours;i++){
          let tick = document.createElement("div");
          tick.classList.add("tick");
          tick.style.top = (i*hourH) + "px";
          tick.style.height = hourH + "px";
          tick.setAttribute("hora", dayStart+i);
          tick.onclick = function(){ onClickHour(dayStart+i); };
          timeline.appendChild(tick);
        }
      }

      // -------------------------------
      // VISTAS
      // -------------------------------
      function renderYearAndMonths(){
        contenedor.innerHTML = "";

        for(let i=1;i<=meses;i++){
          let dias_en_mes = diasEnMes(anio,i);

          let mes = document.createElement("div");
          mes.classList.add("mes","grid");
          mes.setAttribute("mes", nombres_meses[i-1]);
          mes.setAttribute("mesnum", i);

          let cab = document.createElement("div");
          cab.classList.add("cabecera_mes");
          cab.style.gridColumn = "1 / -1";
          cab.innerHTML = `
            <div class="nombre">${nombres_meses[i-1]}</div>
            <div class="info">${anio}</div>
          `;
          mes.appendChild(cab);

          let inicio_mes = primerDiaDelMes(anio, i) + 6;
          for(let j=1;j<=inicio_mes;j++){
            let dia = document.createElement("div");
            dia.classList.add("dia","desactivado");
            mes.appendChild(dia);
          }

          for(let j=1;j<=dias_en_mes;j++){
            let dia = document.createElement("div");
            dia.classList.add("dia");

            let iso = fechaKey(anio, i, j);
            let isHol = HOLSET.has(iso);

            let num = document.createElement("div");
            num.classList.add("numdia");
            num.innerHTML = `
              <span>${j}</span>
              <span class="mini">
                ${nombres_meses[i-1].slice(0,3)}
                ${isHol ? '<span class="badge holiday">Festivo</span>' : ''}
              </span>
            `;
            dia.appendChild(num);

            num.onclick = function(e){
              e.stopPropagation();
              seleccion = { anio: anio, mes: i, dia: j };
              semanaOffset = 0;
              diaOffset = 0;
              estado.textContent = "Selección: " + fechaKey(seleccion.anio, seleccion.mes, seleccion.dia);
              if(vista==="Semana") mostrarSemana();
              if(vista==="Dia") mostrarDia();
              if(vista==="Año"){
                cambiarVista("Mes");
                mostrarSoloMes(i);
              }
            };

            let timeline = document.createElement("div");
            timeline.classList.add("timeline");
            dia.appendChild(timeline);

            let hourH = parseFloat(getComputedStyle(document.documentElement).getPropertyValue("--hour-h-month"));
            crearTimelineTicks(timeline, hourH, function(h){
              abrirModal({
                anio: anio,
                mes: i,
                dia: j,
                startMin: h*60,
                catId: calendario_activo
              });
            });

            let list = listEventsForDate(toDateObj(anio,i,j), EVENTOS, CATS_BY_ID, HOLSET);
            list.forEach(function(ev){
              let el = crearEventoDom(ev, hourH);
              timeline.appendChild(el);
            });

            mes.appendChild(dia);
          }

          contenedor.appendChild(mes);
        }
      }

      function mostrarSoloMes(mesNum){
        let mesesDom = contenedor.querySelectorAll(".mes");
        mesesDom.forEach(function(m){
          if(Number(m.getAttribute("mesnum"))===Number(mesNum)){
            m.classList.remove("oculto");
          }else{
            m.classList.add("oculto");
          }
        });
        contenedor.classList.remove("vista_anual");
      }

      function mostrarTodosLosMeses(){
        contenedor.querySelectorAll(".mes").forEach(function(m){ m.classList.remove("oculto"); });
      }

      function mostrarSemana(){
        panel.classList.remove("oculto");
        contenedor.classList.add("oculto");

        let base = toDateObj(seleccion.anio, seleccion.mes, seleccion.dia);
        base.setDate(base.getDate() + (semanaOffset*7));
        let lunes = startOfWeekMonday(base);

        panelTitulo.textContent = "Semana · " + lunes.toLocaleDateString("es-ES",{year:"numeric",month:"2-digit",day:"2-digit"});
        panelBody.innerHTML = "";

        let grid = document.createElement("div");
        grid.classList.add("grid_semana2");

        let corner = document.createElement("div");
        corner.classList.add("celda_lbl");
        corner.textContent = "";
        grid.appendChild(corner);

        let dayCols = [];
        for(let i=0;i<7;i++){
          let dd = new Date(lunes);
          dd.setDate(lunes.getDate()+i);

          let iso = isoFromDate(dd);
          let isHol = HOLSET.has(iso);

          let hdr = document.createElement("div");
          hdr.classList.add("dia_lbl");
          hdr.innerHTML = `
            <span>${dd.toLocaleDateString("es-ES",{weekday:"short",day:"2-digit",month:"2-digit"})}</span>
            ${isHol ? '<span class="badge holiday">Festivo</span>' : ''}
          `;
          grid.appendChild(hdr);

          dayCols.push(dd);
        }

        let hourH = parseFloat(getComputedStyle(document.documentElement).getPropertyValue("--hour-h-panel"));
        let hoursWrap = document.createElement("div");
        hoursWrap.classList.add("celda_lbl");
        hoursWrap.style.display="flex";
        hoursWrap.style.flexDirection="column";
        hoursWrap.style.gap="0";
        hoursWrap.style.alignItems="stretch";
        hoursWrap.style.justifyContent="flex-start";
        hoursWrap.style.paddingTop="10px";
        hoursWrap.style.height = "calc((var(--day-end) - var(--day-start)) * var(--hour-h-panel))";
        hoursWrap.style.border = "1px solid var(--stroke)";
        hoursWrap.style.borderRadius = "14px";
        hoursWrap.style.background = "#fff";
        hoursWrap.style.overflow="hidden";

        for(let h=8; h<22; h++){
          let row = document.createElement("div");
          row.classList.add("celda_lbl");
          row.style.height = "var(--hour-h-panel)";
          row.textContent = h+":00";
          hoursWrap.appendChild(row);
        }
        grid.appendChild(hoursWrap);

        for(let i=0;i<7;i++){
          let dd = dayCols[i];
          let a = dd.getFullYear();
          let m = dd.getMonth()+1;
          let d = dd.getDate();

          let col = document.createElement("div");
          col.classList.add("col_dia");

          let timeline = document.createElement("div");
          timeline.classList.add("timeline");
          col.appendChild(timeline);

          crearTimelineTicks(timeline, hourH, function(hh){
            abrirModal({ anio:a, mes:m, dia:d, startMin: hh*60, catId: calendario_activo });
          });

          let list = listEventsForDate(dd, EVENTOS, CATS_BY_ID, HOLSET);
          list.forEach(function(ev){
            let el = crearEventoDom(ev, hourH);
            timeline.appendChild(el);
          });

          grid.appendChild(col);
        }

        panelBody.appendChild(grid);
      }

      function mostrarDia(){
        panel.classList.remove("oculto");
        contenedor.classList.add("oculto");

        let base = toDateObj(seleccion.anio, seleccion.mes, seleccion.dia);
        base.setDate(base.getDate() + diaOffset);

        let a = base.getFullYear();
        let m = base.getMonth()+1;
        let d = base.getDate();

        let iso = isoFromDate(base);
        let isHol = HOLSET.has(iso);

        panelTitulo.textContent = "Día · " + base.toLocaleDateString("es-ES",{weekday:"long", year:"numeric", month:"long", day:"2-digit"}) + (isHol ? " · Festivo" : "");

        panelBody.innerHTML = "";
        let wrap = document.createElement("div");
        wrap.classList.add("lista_dia");

        let colH = document.createElement("div");
        colH.classList.add("col_horas");
        wrap.appendChild(colH);

        let colM = document.createElement("div");
        colM.classList.add("col_main");
        wrap.appendChild(colM);

        let timeline = document.createElement("div");
        timeline.classList.add("timeline");
        colM.appendChild(timeline);

        let hourH = parseFloat(getComputedStyle(document.documentElement).getPropertyValue("--hour-h-panel"));

        for(let h=8;h<22;h++){
          let hi = document.createElement("div");
          hi.classList.add("hitem");
          hi.textContent = h+":00";
          colH.appendChild(hi);
        }

        crearTimelineTicks(timeline, hourH, function(hh){
          abrirModal({ anio:a, mes:m, dia:d, startMin: hh*60, catId: calendario_activo });
        });

        let list = listEventsForDate(base, EVENTOS, CATS_BY_ID, HOLSET);
        list.forEach(function(ev){
          let el = crearEventoDom(ev, hourH);
          timeline.appendChild(el);
        });

        panelBody.appendChild(wrap);
      }

      // -------------------------------
      // cambiar vista
      // -------------------------------
      function marcarAccionActiva(txt){
        document.querySelectorAll(".acciones").forEach(function(b){
          if(b.textContent.trim()===txt){ b.classList.add("activa"); }
          else{ b.classList.remove("activa"); }
        });
      }

      function cambiarVista(nueva){
        vista = nueva;
        marcarAccionActiva(nueva);

        if(vista==="Año"){
          panel.classList.add("oculto");
          contenedor.classList.remove("oculto");
          mostrarTodosLosMeses();
          contenedor.classList.add("vista_anual");
          estado.textContent = "Vista: Año · " + anio;
        }

        if(vista==="Mes"){
          panel.classList.add("oculto");
          contenedor.classList.remove("oculto");
          contenedor.classList.remove("vista_anual");
          mostrarTodosLosMeses();
          estado.textContent = "Vista: Mes · click en una franja para crear evento";
        }

        if(vista==="Semana"){
          contenedor.classList.remove("vista_anual");
          mostrarSemana();
          estado.textContent = "Vista: Semana · selección " + fechaKey(seleccion.anio, seleccion.mes, seleccion.dia);
        }

        if(vista==="Dia"){
          contenedor.classList.remove("vista_anual");
          mostrarDia();
          estado.textContent = "Vista: Día · selección " + fechaKey(seleccion.anio, seleccion.mes, seleccion.dia);
        }
      }

      document.querySelectorAll(".acciones").forEach(function(accion){
        accion.onclick = function(){
          cambiarVista(this.textContent.trim());
        };
      });

      document.querySelector("#prev").onclick = function(){
        if(vista==="Semana"){ semanaOffset--; mostrarSemana(); }
        if(vista==="Dia"){ diaOffset--; mostrarDia(); }
      };
      document.querySelector("#next").onclick = function(){
        if(vista==="Semana"){ semanaOffset++; mostrarSemana(); }
        if(vista==="Dia"){ diaOffset++; mostrarDia(); }
      };
      document.querySelector("#hoy").onclick = function(){
        let now = new Date();
        seleccion = { anio: now.getFullYear(), mes: now.getMonth()+1, dia: now.getDate() };
        semanaOffset = 0;
        diaOffset = 0;
        if(vista==="Semana") mostrarSemana();
        if(vista==="Dia") mostrarDia();
        estado.textContent = "Selección: " + fechaKey(seleccion.anio, seleccion.mes, seleccion.dia);
      };

      // -------------------------------
      // MODAL GESTIÓN (categorías + festivos)
      // -------------------------------
      let mgBack = document.querySelector("#mg_back");
      let mgClose = document.querySelector("#mg_close");
      let mgOk = document.querySelector("#mg_ok");
      let mgExport = document.querySelector("#mg_export");
      let btnGestion = document.querySelector("#btn_gestion");

      let tabBtns = mgBack.querySelectorAll(".tab");
      let tabCats = document.querySelector("#tab_cats");
      let tabHol  = document.querySelector("#tab_hol");

      function openGestion(){ renderGestion(); mgBack.classList.remove("oculto"); }
      function closeGestion(){ mgBack.classList.add("oculto"); }

      btnGestion.onclick = openGestion;
      mgClose.onclick = closeGestion;
      mgOk.onclick = closeGestion;
      mgBack.addEventListener("click", function(e){
        if(e.target===mgBack) closeGestion();
      });

      tabBtns.forEach(b=>{
        b.onclick = function(){
          tabBtns.forEach(x=>x.classList.remove("activa"));
          this.classList.add("activa");
          let t = this.dataset.tab;
          if(t==="cats"){ tabCats.classList.remove("oculto"); tabHol.classList.add("oculto"); }
          if(t==="hol"){ tabHol.classList.remove("oculto"); tabCats.classList.add("oculto"); }
        };
      });

      mgExport.onclick = function(){
        let payload = {categories:CATS, holidays:HOLIDAYS, events:EVENTOS};
        navigator.clipboard?.writeText(JSON.stringify(payload, null, 2));
        alert("JSON copiado al portapapeles (si el navegador lo permite).");
      };

      // categorías UI
      let catName = document.querySelector("#cat_name");
      let catColor= document.querySelector("#cat_color");
      let catWork = document.querySelector("#cat_work");
      let catAdd  = document.querySelector("#cat_add");
      let catList = document.querySelector("#cat_list");

      function slugId(s){
        s = String(s||"").trim().toLowerCase();
        s = s.normalize("NFD").replace(/[\u0300-\u036f]/g,"");
        s = s.replace(/[^a-z0-9]+/g,"-").replace(/^-+|-+$/g,"");
        if(!s) s = "cat";
        return s;
      }

      catAdd.onclick = function(){
        let name = String(catName.value||"").trim();
        if(!name){ alert("Nombre requerido."); return; }
        let idBase = slugId(name);
        let id = idBase;
        let n = 2;
        while(CATS_BY_ID.has(id)){
          id = idBase + "-" + (n++);
        }
        let color = String(catColor.value||"#94a3b8");
        let trabajo = (catWork.value==="true");

        CATS.push({id, name, color, trabajo});
        CATS_BY_ID = new Map(CATS.map(c=>[c.id,c]));

        saveAllLocal();
        renderCatsBar();
        renderGestion();
        renderAll();

        catName.value = "";
      };

      function editCategory(catId){
        let cat = CATS_BY_ID.get(catId);
        if(!cat) return;

        let name = prompt("Nuevo nombre de categoría:", cat.name);
        if(name===null) return;
        name = String(name).trim();
        if(!name){ alert("Nombre inválido."); return; }

        let color = prompt("Nuevo color HEX (p. ej. #22c55e):", cat.color);
        if(color===null) return;
        color = String(color).trim();
        if(!/^#([0-9a-fA-F]{6})$/.test(color)){
          alert("Color inválido. Use #RRGGBB.");
          return;
        }

        let trabajo = confirm("¿Marcar esta categoría como trabajo?\n(OK = Sí, Cancelar = No)");

        CATS = CATS.map(c=>{
          if(c.id!==catId) return c;
          return { id:c.id, name, color, trabajo };
        });
        CATS_BY_ID = new Map(CATS.map(c=>[c.id,c]));

        saveAllLocal();
        renderCatsBar();
        renderGestion();
        renderAll();
        setActiveCat(calendario_activo);
      }

      function deleteCategory(catId){
        if(catId==="personal" || catId==="laboral" || catId==="vacaciones"){
          if(!confirm("Es una categoría por defecto.\n¿Eliminar igualmente? (se reasignarán eventos a 'personal')")) return;
        }else{
          if(!confirm("¿Eliminar esta categoría? (se reasignarán eventos a 'personal')")) return;
        }

        EVENTOS = EVENTOS.map(ev=>{
          if(ev.catId===catId) return Object.assign({}, ev, {catId:"personal"});
          return ev;
        });

        CATS = CATS.filter(c=>c.id!==catId);
        if(CATS.length===0) CATS = defaultCats();

        CATS_BY_ID = new Map(CATS.map(c=>[c.id,c]));

        if(!CATS_BY_ID.has(calendario_activo)) calendario_activo = "personal";

        saveAllLocal();
        renderCatsBar();
        renderGestion();
        renderAll();
        setActiveCat(calendario_activo);
      }

      // festivos UI
      let holDate = document.querySelector("#hol_date");
      let holAdd  = document.querySelector("#hol_add");
      let holList = document.querySelector("#hol_list");

      holAdd.onclick = function(){
        let d = String(holDate.value||"");
        if(!/^\d{4}-\d{2}-\d{2}$/.test(d)){ alert("Fecha inválida."); return; }
        HOLIDAYS = Array.from(new Set([...HOLIDAYS, d])).sort();
        HOLSET = new Set(HOLIDAYS);
        saveAllLocal();
        renderGestion();
        renderAll();
      };

      function removeHoliday(iso){
        if(!confirm("¿Eliminar festivo " + iso + "?")) return;
        HOLIDAYS = HOLIDAYS.filter(x=>x!==iso);
        HOLSET = new Set(HOLIDAYS);
        saveAllLocal();
        renderGestion();
        renderAll();
      }

      function renderGestion(){
        catList.innerHTML = "";
        CATS.forEach(cat=>{
          let row = document.createElement("div");
          row.className = "item";
          row.innerHTML = `
            <div class="l">
              <span class="dot" style="background:${cat.color}; box-shadow:0 0 0 3px color-mix(in srgb, ${cat.color} 20%, transparent 80%);"></span>
              <div style="min-width:0">
                <div class="name">${cat.name}</div>
                <div class="meta">id: ${cat.id} · trabajo: ${cat.trabajo ? "sí" : "no"}</div>
              </div>
            </div>
            <div class="miniBtns">
              <button class="btn xs" data-act="edit">Editar</button>
              <button class="btn xs danger" data-act="del">Eliminar</button>
            </div>
          `;
          row.querySelector('[data-act="edit"]').onclick = ()=>editCategory(cat.id);
          row.querySelector('[data-act="del"]').onclick  = ()=>deleteCategory(cat.id);
          catList.appendChild(row);
        });

        holList.innerHTML = "";
        HOLIDAYS.forEach(iso=>{
          let row = document.createElement("div");
          row.className = "item";
          row.innerHTML = `
            <div class="l">
              <span class="badge holiday">Festivo</span>
              <div style="min-width:0">
                <div class="name">${iso}</div>
                <div class="meta">${new Date(iso).toLocaleDateString("es-ES",{weekday:"long", year:"numeric", month:"long", day:"2-digit"})}</div>
              </div>
            </div>
            <div class="miniBtns">
              <button class="btn xs danger">Eliminar</button>
            </div>
          `;
          row.querySelector("button").onclick = ()=>removeHoliday(iso);
          holList.appendChild(row);
        });
      }

      // -------------------------------
      // renderAll
      // -------------------------------
      function renderAll(){
        // recarga coherente desde localStorage
        CATS = loadCats();
        HOLIDAYS = loadHolidays();
        HOLSET = new Set(HOLIDAYS);
        CATS_BY_ID = new Map(CATS.map(c=>[c.id,c]));
        EVENTOS = loadEvents(CATS);

        renderCatsBar();
        fillCatSelect();

        if(vista==="Semana"){ mostrarSemana(); return; }
        if(vista==="Dia"){ mostrarDia(); return; }
        renderYearAndMonths();
      }

      // -------------------------------
      // AUTH modal
      // -------------------------------
      const authBack = document.querySelector("#auth_back");
      const authClose = document.querySelector("#auth_close");
      const authOk = document.querySelector("#auth_ok");
      const authLbl = document.querySelector("#auth_status");

      const btnAuth = document.querySelector("#btn_auth");
      const btnLogout = document.querySelector("#btn_logout");
      const authLogout2 = document.querySelector("#auth_logout2");

      const loginEmail = document.querySelector("#login_email");
      const loginPass  = document.querySelector("#login_pass");
      const loginBtn   = document.querySelector("#login_btn");

      const regEmail = document.querySelector("#reg_email");
      const regPass  = document.querySelector("#reg_pass");
      const regPass2 = document.querySelector("#reg_pass2");
      const regBtn   = document.querySelector("#reg_btn");

      function openAuth(){
        renderAuthBadge();
        authLbl.textContent = AUTH.loggedIn
          ? ("Sesión activa: " + (AUTH.email || "usuario"))
          : "Sin sesión: usando localStorage.";
        authBack.classList.remove("oculto");
      }
      function closeAuth(){ authBack.classList.add("oculto"); }

      btnAuth.onclick = openAuth;
      authClose.onclick = closeAuth;
      authOk.onclick = closeAuth;
      authBack.addEventListener("click", (e)=>{ if(e.target===authBack) closeAuth(); });

      loginBtn.onclick = async function(){
        const email = String(loginEmail.value||"").trim();
        const pass = String(loginPass.value||"");
        if(!email || !pass){ alert("Email y contraseña requeridos."); return; }
        try{
          await apiPost("login", {email, password:pass});
          await refreshAuth();
          authLbl.textContent = "Sesión activa: " + (AUTH.email || email);
          toast("Sesión iniciada.");
        }catch(e){
          alert("Login: " + e.message);
        }
      };

      regBtn.onclick = async function(){
        const email = String(regEmail.value||"").trim();
        const p1 = String(regPass.value||"");
        const p2 = String(regPass2.value||"");
        if(!email || !p1){ alert("Email y contraseña requeridos."); return; }
        if(p1.length < 8){ alert("La contraseña debe tener al menos 8 caracteres."); return; }
        if(p1 !== p2){ alert("Las contraseñas no coinciden."); return; }
        try{
          await apiPost("register", {email, password:p1});
          await refreshAuth();
          authLbl.textContent = "Sesión activa: " + (AUTH.email || email);
          toast("Cuenta creada e iniciada.");
        }catch(e){
          alert("Registro: " + e.message);
        }
      };

      async function logout(){
        try{
          await apiPost("logout", {});
        }catch(e){
          // aunque falle, pasamos a local
        }
        AUTH.loggedIn = false;
        AUTH.email = null;
        renderAuthBadge();
        toast("Sesión cerrada.");
      }

      btnLogout.onclick = logout;
      authLogout2.onclick = logout;

      // -------------------------------
      // Sincronización (botón)
      // - Si hay sesión: descarga servidor -> reemplaza local (fuente servidor)
      // - Si no hay sesión: solo guarda local
      // -------------------------------
      const btnSync = document.querySelector("#btn_sync");
      btnSync.onclick = async function(){
        try{
          await refreshAuth();
          if(AUTH.loggedIn){
            // 1) carga del servidor
            const srv = await serverLoadAll();

            // si servidor tiene datos válidos: reemplaza local
            if(srv.categories && srv.holidays && srv.events){
              writeJSON(K_CATS, srv.categories);
              writeJSON(K_HOLIDAYS, srv.holidays);
              writeJSON(K_EVENTS, srv.events);

              // re-render desde localStorage (ya actualizado)
              renderAll();
              toast("Sincronizado: servidor → navegador.");
            }else{
              // si está vacío, sube lo local (primer uso)
              await serverSaveAll({categories:CATS, holidays:HOLIDAYS, events:EVENTOS});
              toast("Servidor vacío: se subió lo local.");
            }
          }else{
            saveAllLocal();
            toast("Sin sesión: guardado local.");
          }
        }catch(e){
          alert("Sincronizar: " + e.message);
        }
      };

      // -------------------------------
      // latido (auto-save local)
      // (para servidor, usa Guardar o Sincronizar)
      // -------------------------------
      let temporizador = setTimeout(latido,1000);
      function latido(){
        // auto-save local siempre (es barato y permite fallback)
        saveAllLocal();
        clearTimeout(temporizador);
        temporizador = setTimeout(latido,1000);
      }

      // -------------------------------
      // init: si hay sesión, intenta cargar servidor al inicio
      // -------------------------------
      async function init(){
        renderCatsBar();
        setActiveCat(calendario_activo);
        fillCatSelect();
        estado.textContent = "Vista: Mes · click en una franja para crear evento";

        await refreshAuth();

        if(AUTH.loggedIn){
          try{
            const srv = await serverLoadAll();
            if(srv.categories && srv.holidays && srv.events){
              writeJSON(K_CATS, srv.categories);
              writeJSON(K_HOLIDAYS, srv.holidays);
              writeJSON(K_EVENTS, srv.events);
              toast("Datos cargados desde servidor.");
            }else{
              toast("Servidor sin datos. Usa Guardar/Sincronizar para subir.");
            }
          }catch(e){
            toast("Modo local (no se pudo cargar servidor).");
          }
        }

        renderAll();
      }

      init();
    </script>
  </body>
</html>


```
## v1
**calendar.js**
```js
document.addEventListener("DOMContentLoaded", () => {
  const API_BASE = "endpoint.php";

  // ------------- DOM ELEMENTS ------------------
  // Authentication
  const authSection       = document.getElementById("auth-section");
  const calendarSection   = document.getElementById("calendar-section");
  const loginForm         = document.getElementById("login-form");
  const signupForm        = document.getElementById("signup-form");
  const logoutButton      = document.getElementById("logout-button");

  // Password toggles
  const toggleLoginPwBtn  = document.getElementById("toggle-login-password");
  const loginPwInput      = document.getElementById("login-password");
  const toggleSignupPwBtn = document.getElementById("toggle-signup-password");
  const signupPwInput     = document.getElementById("signup-password");

  // Calendar UI
  const calendarTitle     = document.getElementById("calendar-title");
  const calendarGrid      = document.getElementById("calendar-grid");
  const prevButton        = document.getElementById("prev");
  const nextButton        = document.getElementById("next");
  const viewWeekButton    = document.getElementById("view-week");
  const viewMonthButton   = document.getElementById("view-month");
  const viewYearButton    = document.getElementById("view-year");

  // Event modal
  const modal             = document.getElementById("event-modal");
  const modalCloseX       = document.getElementById("modal-close-btn");
  const closeModal        = document.getElementById("close-modal");
  const eventForm         = document.getElementById("event-form");
  const eventTitleInput   = document.getElementById("event-title");
  const eventDescriptionInput = document.getElementById("event-description");
  const eventStartTimeInput   = document.getElementById("event-start-time");
  const eventEndTimeInput     = document.getElementById("event-end-time");
  const eventCalendarSelect   = document.getElementById("event-calendar");

  const repeatCheckbox           = document.getElementById("repeat-checkbox");
  const recurrenceSection        = document.getElementById("recurrence-section");
  const recurrenceFrequency      = document.getElementById("recurrence-frequency");
  const recurrenceDays           = document.querySelectorAll("#recurrence-days input[type='checkbox']");
  const recurrenceEndType        = document.getElementById("recurrence-end-type");
  const recurrenceEndDateContainer = document.getElementById("recurrence-end-date-container");
  const recurrenceEndDate        = document.getElementById("recurrence-end-date");
  const recurrenceOccurrencesContainer = document.getElementById("recurrence-occurrences-container");
  const recurrenceOccurrences    = document.getElementById("recurrence-occurrences");
  let eventIdInput              = document.getElementById("event-id-hidden");
  let deleteEventButton         = document.getElementById("delete-event-button");

  // Calendar modal
  const calendarModal       = document.getElementById("calendar-modal");
  const closeCalendarModal  = document.getElementById("close-calendar-modal");
  const calendarForm        = document.getElementById("calendar-form");
  const calendarNameInput   = document.getElementById("calendar-name");
  const calendarColorInput  = document.getElementById("calendar-color");
  let calendarIdHidden      = document.getElementById("calendar-id-hidden");

  // Sidebar
  const calendarsList       = document.getElementById("calendars-list");
  const addCalendarBtn      = document.getElementById("add-calendar-btn");

  // Config (User Settings)
  const configButton        = document.getElementById("config-button");
  const configSection       = document.getElementById("config-section");
  const closeConfigModal    = document.getElementById("close-config-modal");
  const configForm          = document.getElementById("config-form");
  const newPasswordInput    = document.getElementById("new-password");
  const toggleNewPasswordBtn= document.getElementById("toggle-new-password");
  const weekStartSelect     = document.getElementById("week-start-select");

  // ------------- GLOBAL STATE ------------------
  let currentDate  = new Date();
  let currentView  = "month"; // "week", "month", or "year"
  let events       = {};       // { "2025-01-09": [ ...eventObjects... ], ... }
  let calendars    = [];
  let hiddenCalendars = new Set();
  let weekStartPreference = "monday"; // default; can be "monday" or "sunday"

  // Day & month names
  const daysOfWeek = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
  // For month view headers if Monday is start => we often reorder or offset
  const weekDays   = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
  const months     = [
    "Enero","Febrero","Marzo","Abril","Mayo","Junio",
    "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"
  ];

  // ------------- API HELPER --------------------
  async function apiCall(endpoint, method = "GET", body = null) {
    const options = {
      method,
      headers: { "Content-Type": "application/json" },
    };
    if (body) {
      options.body = JSON.stringify(body);
    }
    const response = await fetch(`${API_BASE}?path=${endpoint}`, options);
    return response.json();
  }

  // ------------- AUTH HANDLERS -----------------
  function toggleView(isLoggedIn) {
    if (isLoggedIn) {
      authSection.classList.add("hidden");
      calendarSection.classList.remove("hidden");
    } else {
      authSection.classList.remove("hidden");
      calendarSection.classList.add("hidden");
    }
  }

  async function loadData() {
    // Check if logged in by trying to get calendars
    const sessionCheck = await apiCall("get_calendars", "GET");
    if (sessionCheck.status === "success") {
      // We have a session
      await loadCalendars();
      await loadEvents();
      // Also load user preference if you want:
      // (We can create an endpoint 'get_user' to get user info, see below)
      const userData = await fetchUserData();
      if (userData && userData.week_start_day) {
        weekStartPreference = userData.week_start_day;
      }
      toggleView(true);
    } else {
      // Not logged in
      toggleView(false);
    }
  }

  async function login(e) {
    e.preventDefault();
    const username = document.getElementById("login-username").value.trim();
    const password = loginPwInput.value.trim();

    const data = await apiCall("login", "POST", { username, password });
    if (data.status === "success") {
      await loadCalendars();
      await loadEvents();
      // Also load user preferences
      const userData = await fetchUserData();
      if (userData && userData.week_start_day) {
        weekStartPreference = userData.week_start_day;
      }
      toggleView(true);
    } else {
      alert("Login failed: " + data.message);
    }
  }

  async function signup(e) {
    e.preventDefault();
    const username = document.getElementById("signup-username").value.trim();
    const password = signupPwInput.value.trim();

    const data = await apiCall("signup", "POST", { username, password });
    if (data.status === "success") {
      alert("Signup successful! Please log in.");
    } else {
      alert("Signup failed: " + data.message);
    }
  }

  async function logout() {
    const data = await apiCall("logout", "POST");
    if (data.status === "success") {
      toggleView(false);
    } else {
      alert("Logout error: " + data.message);
    }
  }

  // ------------- USER / CONFIG -----------------
  // Optional endpoint to retrieve current user data
  async function fetchUserData() {
    const res = await apiCall("get_user", "GET");
    if (res.status === "success") {
      return res.user;
    }
    return null;
  }

  // Open/Close config
  configButton.addEventListener("click", () => {
    configSection.classList.remove("hidden");
  });
  closeConfigModal.addEventListener("click", () => {
    configSection.classList.add("hidden");
  });
  
  // Toggle new-password visibility
  toggleNewPasswordBtn.addEventListener("click", () => {
    if (newPasswordInput.type === "password") {
      newPasswordInput.type = "text";
    } else {
      newPasswordInput.type = "password";
    }
  });

  // Save config
  configForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const newPassword = newPasswordInput.value.trim();
    const weekStart   = weekStartSelect.value; // "monday" or "sunday"

    const res = await fetch(`${API_BASE}?path=update_user`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        new_password: newPassword,
        week_start_day: weekStart
      })
    });
    const data = await res.json();
    if (data.status === 'success') {
      alert("Configuración actualizada");
      if (weekStart) {
        weekStartPreference = weekStart;
      }
      configSection.classList.add("hidden");
      configForm.reset();
      renderCalendar(); // re-render with new preference if needed
    } else {
      alert("Error: " + data.message);
    }
  });

  // ------------- CALENDARS ---------------------
  async function loadCalendars() {
    const data = await apiCall("get_calendars", "GET");
    if (data.status === "success") {
      calendars = data.calendars;
      renderCalendarsList();
      renderCalendarSelect();
    }
  }

  function renderCalendarsList() {
    calendarsList.innerHTML = "";
    calendars.forEach((cal) => {
      const div = document.createElement("div");
      div.className = "calendar-item";

      // Eye/hide button
      const eyeBtn = document.createElement("button");
      eyeBtn.textContent = hiddenCalendars.has(cal.id.toString()) ? "Mostrar" : "Ocultar";
      eyeBtn.style.marginRight = "5px";
      eyeBtn.addEventListener("click", () => {
        toggleCalendarVisibility(cal.id);
        eyeBtn.textContent = hiddenCalendars.has(cal.id.toString()) ? "Mostrar" : "Ocultar";
        renderCalendar();
      });

      // Edit button
      const editBtn = document.createElement("button");
      editBtn.textContent = "✏️";
      editBtn.style.marginRight = "5px";
      editBtn.addEventListener("click", () => openCalendarModal(cal));

      // Delete button
      const deleteBtn = document.createElement("button");
      deleteBtn.textContent = "🗑️";
      deleteBtn.addEventListener("click", () => deleteCalendar(cal.id));

      const colorDiv = document.createElement("div");
      colorDiv.className = "color";
      colorDiv.style.background = cal.color;

      const nameSpan = document.createElement("span");
      nameSpan.textContent = cal.name;

      div.appendChild(eyeBtn);
      div.appendChild(editBtn);
      div.appendChild(deleteBtn);
      div.appendChild(colorDiv);
      div.appendChild(nameSpan);

      calendarsList.appendChild(div);
    });
  }

  function renderCalendarSelect() {
    eventCalendarSelect.innerHTML = '<option value="" disabled selected>Select Calendar</option>';
    calendars.forEach((cal) => {
      const option = document.createElement("option");
      option.value = cal.id;
      option.textContent = cal.name;
      eventCalendarSelect.appendChild(option);
    });
  }

  async function saveCalendar(e) {
    e.preventDefault();
    const calId = calendarIdHidden.value;
    const name  = calendarNameInput.value;
    const color = calendarColorInput.value;

    if (calId) {
      // update existing
      const data = await apiCall("update_calendar", "POST", {
        id: calId,
        name,
        color
      });
      if (data.status === "success") {
        await loadCalendars();
        closeCalendarModalHandler();
      } else {
        alert("Error updating calendar: " + data.message);
      }
    } else {
      // create new
      const data = await apiCall("create_calendar", "POST", { name, color });
      if (data.status === "success") {
        await loadCalendars();
        closeCalendarModalHandler();
      } else {
        alert("Error creating calendar: " + data.message);
      }
    }
  }

  async function deleteCalendar(calendarId) {
    if (!confirm("¿Seguro que quieres eliminar este calendario y todos sus eventos?")) return;
    const data = await apiCall("delete_calendar", "POST", { calendar_id: calendarId });
    if (data.status === "success") {
      await loadCalendars();
      await loadEvents();
      alert("Calendario eliminado");
    } else {
      alert("Error al eliminar el calendario: " + data.message);
    }
  }

  function toggleCalendarVisibility(calendarId) {
    calendarId = calendarId.toString();
    if (hiddenCalendars.has(calendarId)) {
      hiddenCalendars.delete(calendarId);
    } else {
      hiddenCalendars.add(calendarId);
    }
    renderCalendar();
  }

  // ------------- EVENTS ------------------------
  async function loadEvents() {
    const data = await apiCall("get_events", "GET");
    if (data.status === "success") {
      // Group by start_date (the expanded occurrences)
      events = data.events.reduce((acc, ev) => {
        const key = ev.start_date;
        if (!acc[key]) acc[key] = [];
        acc[key].push(ev);
        return acc;
      }, {});
      renderCalendar();
    }
  }

  async function saveEvent(e) {
    e.preventDefault();
    const startObj = new Date(eventStartTimeInput.value);
    const endObj   = new Date(eventEndTimeInput.value);

    if (endObj <= startObj) {
      alert("La hora de fin debe ser posterior a la hora de inicio.");
      return;
    }

    let recurrenceFrequencyVal   = 1;
    let selectedRecurrenceDays   = [];
    let recurrenceEndTypeVal     = 'never';
    let recurrenceEndDateVal     = null;
    let recurrenceOccurrencesVal = null;

    if (repeatCheckbox.checked) {
      recurrenceFrequencyVal = parseInt(recurrenceFrequency.value) || 1;
      selectedRecurrenceDays = Array.from(recurrenceDays)
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.value);
      recurrenceEndTypeVal = recurrenceEndType.value;
      if (recurrenceEndTypeVal === "by_date") {
        recurrenceEndDateVal = recurrenceEndDate.value;
      } else if (recurrenceEndTypeVal === "after_occurrences") {
        recurrenceOccurrencesVal = parseInt(recurrenceOccurrences.value);
      }
      if (selectedRecurrenceDays.length === 0) {
        alert("Seleccione al menos un día de la semana para la repetición.");
        return;
      }
    }

    const eventData = {
      calendar_id: eventCalendarSelect.value,
      title: eventTitleInput.value.trim(),
      description: eventDescriptionInput.value.trim(),
      start_date: startObj.toISOString().split("T")[0],
      start_time: startObj.toTimeString().substring(0, 5),
      end_date:   endObj.toISOString().split("T")[0],
      end_time:   endObj.toTimeString().substring(0, 5),
      recurrence_frequency: recurrenceFrequencyVal,
      recurrence_days: selectedRecurrenceDays,
      recurrence_end_type: recurrenceEndTypeVal,
      recurrence_end_date: recurrenceEndDateVal,
      recurrence_occurrences: recurrenceOccurrencesVal
    };

    const existingEventId = eventIdInput.value;
    let endpoint = "create_event";
    if (existingEventId) {
      endpoint = "update_event";
      eventData.id = existingEventId;
    }

    const res = await apiCall(endpoint, "POST", eventData);
    if (res.status === "success") {
      await loadEvents();
      closeModalHandler();
    } else {
      alert("Error saving event: " + res.message);
    }
  }

  async function removeEvent() {
    const eId = eventIdInput.value;
    if (!eId) return;
    if (!confirm("¿Seguro que quieres eliminar este evento?")) return;
    const res = await apiCall("delete_event", "POST", { id: eId });
    if (res.status === "success") {
      await loadEvents();
      closeModalHandler();
    } else {
      alert("Error al eliminar el evento: " + res.message);
    }
  }

  // ------------- CALENDAR RENDERING ------------
  function renderCalendar() {
    calendarGrid.innerHTML = "";
    calendarGrid.classList.remove("week","month","year");

    if (currentView === "week") {
      calendarGrid.classList.add("week");
      renderWeekView();
    } else if (currentView === "month") {
      calendarGrid.classList.add("month");
      renderMonthView();
    } else {
      calendarGrid.classList.add("year");
      renderYearView();
    }
  }

  // --- WEEK VIEW ---
  function renderWeekView() {
    // Figure out start of this week based on user preference
    // Sunday-based or Monday-based
    const dayIndex = currentDate.getDay(); // 0=Sunday
    const isoWeekDay = dayIndex === 0 ? 7 : dayIndex; // 1..7 for Mon..Sun
    let startOfWeek;
    if (weekStartPreference === "monday") {
      // Then Monday=1 in ISO. We want to go back isoWeekDay-1 days from current
      startOfWeek = new Date(currentDate);
      const offset = isoWeekDay - 1; // Monday=1
      startOfWeek.setDate(startOfWeek.getDate() - offset);
    } else {
      // Sunday start => dayIndex=0
      startOfWeek = new Date(currentDate);
      startOfWeek.setDate(startOfWeek.getDate() - dayIndex);
    }
    calendarTitle.textContent = `Semana de ${formatDateISO(startOfWeek)}`;

    calendarGrid.innerHTML = "";
    const table = document.createElement("table");
    table.classList.add("week-table");

    // Thead
    const thead = document.createElement("thead");
    const headerRow = document.createElement("tr");
    const cornerTh = document.createElement("th");
    headerRow.appendChild(cornerTh);

    for (let i = 0; i < 7; i++) {
      const dayDate = new Date(startOfWeek);
      dayDate.setDate(dayDate.getDate() + i);

      const dayName = daysOfWeek[dayDate.getDay()];
      const dateNum = dayDate.getDate();
      const monthNum= dayDate.getMonth() + 1;
      const th = document.createElement("th");
      th.textContent = `${dayName} ${dateNum}/${monthNum}`;
      headerRow.appendChild(th);
    }
    thead.appendChild(headerRow);
    table.appendChild(thead);

    // Tbody (48 rows for 30-min increments)
    const tbody = document.createElement("tbody");
    const occupied = Array(7).fill(null).map(() => Array(48).fill(false));

    for (let slot = 0; slot < 48; slot++) {
      const row = document.createElement("tr");

      // time label
      const hour = Math.floor(slot / 2);
      const minutes = slot % 2 === 0 ? '00' : '30';
      const timeLabel = `${String(hour).padStart(2,'0')}:${minutes}`;
      const timeCell = document.createElement("td");
      timeCell.classList.add("hour-cell");
      timeCell.textContent = timeLabel;
      row.appendChild(timeCell);

      for (let d = 0; d < 7; d++) {
        if (occupied[d][slot]) continue;

        const dayDate = new Date(startOfWeek);
        dayDate.setDate(dayDate.getDate() + d);
        const dateString = dayDate.toISOString().split("T")[0];

        const cell = document.createElement("td");
        cell.dataset.date = dateString;
        cell.dataset.slot = slot;

        const dayEvents = events[dateString] || [];
        const currentEvents = dayEvents.filter(ev => {
          const evStart = new Date(`${ev.start_date}T${ev.start_time}`);
          const evSlot  = evStart.getHours() * 2 + (evStart.getMinutes() >= 30 ? 1 : 0);
          return evSlot === slot;
        });

        if (currentEvents.length > 0) {
          const ev = currentEvents[0];

          const start = new Date(`${ev.start_date}T${ev.start_time}`);
          const end   = new Date(`${ev.end_date}T${ev.end_time}`);
          let duration = (end - start) / (1000*60*30);
          duration = Math.max(1, Math.ceil(duration));

          for (let s = slot; s < slot + duration && s < 48; s++) {
            occupied[d][s] = true;
          }

          const evDiv = document.createElement("div");
          evDiv.classList.add("event");
          evDiv.style.background = ev.calendar_color;
          evDiv.title = ev.description;
          evDiv.textContent = `${ev.title} (${ev.start_time} - ${ev.end_time})`;
          evDiv.draggable = true;
          evDiv.dataset.eventId  = ev.id;
          evDiv.dataset.startDate= ev.start_date;
          evDiv.addEventListener("dragstart", handleDragStart);

          evDiv.addEventListener("click", (e) => {
            e.stopPropagation();
            openModal(start, ev);
          });

          cell.rowSpan = duration;
          cell.appendChild(evDiv);
          row.appendChild(cell);
        } else {
          cell.addEventListener("click", () => openModal(dayDate, null));
          // DnD
          cell.addEventListener("dragover", (e) => e.preventDefault());
          cell.addEventListener("drop", (e) => {
            e.preventDefault();
            const dropDate = new Date(dayDate);
            const dropHour = Math.floor(slot/2);
            const dropMin  = (slot % 2) * 30;
            dropDate.setHours(dropHour, dropMin, 0, 0);
            handleDrop(e, dropDate);
          });

          row.appendChild(cell);
        }
      }
      tbody.appendChild(row);
    }

    table.appendChild(tbody);
    calendarGrid.appendChild(table);
  }

  // --- MONTH VIEW ---
  function renderMonthView() {
    const year  = currentDate.getFullYear();
    const month = currentDate.getMonth();
    calendarTitle.textContent = `${months[month]} ${year}`;
    calendarGrid.innerHTML = "";

    // Monday-start or Sunday-start logic
    // We'll fill the weekDays header accordingly:
    let headers;
    if (weekStartPreference === "monday") {
      headers = ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"];
    } else {
      headers = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"];
    }
    // Render headers
    headers.forEach(day => {
      const header = document.createElement("div");
      header.className = "month-header-cell";
      header.textContent = day;
      calendarGrid.appendChild(header);
    });

    // figure out startOfMonth, endOfMonth
    const startOfMonth = new Date(year, month, 1, 12);
    const endOfMonth   = new Date(year, month+1, 0, 12);

    // figure out offset based on preference
    let dayOfWeek = startOfMonth.getDay(); // 0=Sun
    if (weekStartPreference === "monday") {
      // shift so Monday=0, Sunday=6
      dayOfWeek = (dayOfWeek + 6) % 7;
    }

    const startDate = new Date(startOfMonth);
    startDate.setDate(startOfMonth.getDate() - dayOfWeek);

    // do the same for the last row
    let endDayOfWeek = endOfMonth.getDay();
    if (weekStartPreference === "monday") {
      endDayOfWeek = (endDayOfWeek + 6) % 7;
    }
    const endDate = new Date(endOfMonth);
    endDate.setDate(endOfMonth.getDate() + (6 - endDayOfWeek));

    let d = new Date(startDate);
    while (d <= endDate) {
      createMonthCell(new Date(d));
      d.setDate(d.getDate() + 1);
    }
  }
  function createMonthCell(date) {
    const temp = new Date(date);
    temp.setHours(12, 0, 0, 0);
    const formattedDate = temp.toISOString().split("T")[0];

    const cell = document.createElement("div");
    cell.className = "calendar-cell";

    const today = new Date();
    today.setHours(12,0,0,0);
    if (temp.getTime() === today.getTime()) {
      cell.classList.add("today");
    }

    cell.innerHTML = `
      <div class="calendar-cell-header">${temp.getDate()}</div>
      <div class="event-list"></div>
    `;

    // DnD
    cell.addEventListener("dragover", (e) => e.preventDefault());
    cell.addEventListener("drop", (e) => {
      e.preventDefault();
      handleDrop(e, temp);
    });

    const dayEvents = events[formattedDate] || [];
    const eventListDiv = cell.querySelector(".event-list");
    dayEvents.forEach((ev) => {
      if (hiddenCalendars.has(ev.calendar_id.toString())) return;
      const evDiv = document.createElement("div");
      evDiv.className = "event";
      evDiv.style.background = ev.calendar_color;
      evDiv.title = ev.description;
      evDiv.textContent = `${ev.title} (${ev.start_time} - ${ev.end_time})`;
      evDiv.draggable = true;
      evDiv.dataset.eventId   = ev.id;
      evDiv.dataset.startDate = ev.start_date;
      evDiv.addEventListener("dragstart", handleDragStart);

      evDiv.addEventListener("click", (e) => {
        e.stopPropagation();
        openModal(temp, ev);
      });
      eventListDiv.appendChild(evDiv);
    });

    cell.addEventListener("click", () => openModal(temp, null));
    calendarGrid.appendChild(cell);
  }

  // --- YEAR VIEW ---
  function renderYearView() {
    const year = currentDate.getFullYear();
    calendarTitle.textContent = `${year}`;
    calendarGrid.innerHTML = "";

    for (let monthIndex = 0; monthIndex < 12; monthIndex++) {
      const cell = document.createElement("div");
      cell.className = "calendar-cell";
      const monthDiv = document.createElement("div");
      monthDiv.className = "year-month";

      const headerDiv = document.createElement("div");
      headerDiv.className = "year-month-header";
      headerDiv.textContent = months[monthIndex];
      monthDiv.appendChild(headerDiv);

      const daysContainer = document.createElement("div");
      daysContainer.className = "year-month-grid";

      // similar logic to month view offset
      const startOfMonth = new Date(year, monthIndex, 1, 12);
      const endOfMonth   = new Date(year, monthIndex+1, 0, 12);

      let dayOfWeek = startOfMonth.getDay();
      if (weekStartPreference === "monday") {
        dayOfWeek = (dayOfWeek + 6) % 7;
      }
      const startDate = new Date(startOfMonth);
      startDate.setDate(startOfMonth.getDate() - dayOfWeek);

      let endDayOfWeek = endOfMonth.getDay();
      if (weekStartPreference === "monday") {
        endDayOfWeek = (endDayOfWeek + 6) % 7;
      }
      const endDate = new Date(endOfMonth);
      endDate.setDate(endOfMonth.getDate() + (6 - endDayOfWeek));

      let d = new Date(startDate);
      while (d <= endDate) {
        createYearDayCell(new Date(d), monthIndex, daysContainer);
        d.setDate(d.getDate() + 1);
      }

      monthDiv.appendChild(daysContainer);
      cell.appendChild(monthDiv);
      calendarGrid.appendChild(cell);
    }
  }
  function createYearDayCell(date, monthIndex, container) {
    const temp = new Date(date);
    temp.setHours(12,0,0,0);
    const formattedDate = temp.toISOString().split("T")[0];

    const dayCell = document.createElement("div");
    dayCell.className = "year-day";

    if (temp.getMonth() === monthIndex) {
      dayCell.textContent = temp.getDate();
      if (events[formattedDate] && !hiddenCalendarsAll(formattedDate)) {
        dayCell.classList.add("has-event");
      }

      dayCell.addEventListener("click", (e) => {
        e.stopPropagation();
        openModal(temp, null);
      });
      dayCell.addEventListener("dragover", (e) => e.preventDefault());
      dayCell.addEventListener("drop", (e) => {
        e.preventDefault();
        handleDrop(e, temp);
      });
    } else {
      dayCell.style.opacity = "0.3";
    }
    container.appendChild(dayCell);
  }
  function hiddenCalendarsAll(dateString) {
    const dayEvents = events[dateString] || [];
    return dayEvents.every(ev => hiddenCalendars.has(ev.calendar_id.toString()));
  }

  // ------------- DRAG & DROP -------------------
  function handleDragStart(e) {
    const eventId   = e.target.dataset.eventId;
    const startDate = e.target.dataset.startDate;
    e.dataTransfer.setData("text/eventId", eventId);
    e.dataTransfer.setData("text/startDate", startDate);
  }
  async function handleDrop(e, newDate) {
    const eventId = e.dataTransfer.getData("text/eventId");
    const oldDate = e.dataTransfer.getData("text/startDate");
    if (!eventId) return;

    let foundEvent = null;
    if (events[oldDate]) {
      foundEvent = events[oldDate].find(ev => ev.id.toString() === eventId);
    }
    if (!foundEvent) {
      for (const dateKey in events) {
        const candidate = events[dateKey].find(ev => ev.id.toString() === eventId);
        if (candidate) {
          foundEvent = candidate;
          break;
        }
      }
    }
    if (!foundEvent) return;

    // Shift date but keep times
    const updatedEvent = {
      id: foundEvent.id,
      calendar_id: foundEvent.calendar_id,
      title: foundEvent.title,
      description: foundEvent.description,
      start_date: newDate.toISOString().split("T")[0],
      start_time: newDate.toTimeString().substring(0,5),
      end_date: newDate.toISOString().split("T")[0],
      end_time: foundEvent.end_time,
      recurrence_frequency: foundEvent.recurrence_frequency || 1,
      recurrence_days: foundEvent.recurrence_days ? foundEvent.recurrence_days.split(',') : [],
      recurrence_end_type: foundEvent.recurrence_end_type || 'never',
      recurrence_end_date: foundEvent.recurrence_end_date || null,
      recurrence_occurrences: foundEvent.recurrence_occurrences || null
    };

    const response = await apiCall("update_event", "POST", updatedEvent);
    if (response.status === "success") {
      await loadEvents();
    } else {
      alert("Error moving event: " + response.message);
    }
  }

  // ------------- MODALS ------------------------
  function openModal(date, eventData = null) {
    modal.classList.remove("hidden");
    deleteEventButton.style.display = "none";

    const defaultStartISO = date.toISOString().slice(0,16);
    const oneHourLater = new Date(date.getTime() + 60*60*1000);
    const defaultEndISO = oneHourLater.toISOString().slice(0,16);

    if (eventData) {
      eventIdInput.value = eventData.id;
      eventTitleInput.value = eventData.title;
      eventDescriptionInput.value = eventData.description;
      eventCalendarSelect.value = eventData.calendar_id;
      eventStartTimeInput.value = `${eventData.start_date}T${eventData.start_time}`;
      eventEndTimeInput.value   = `${eventData.end_date}T${eventData.end_time}`;

      if (eventData.recurrence_frequency > 1 || eventData.recurrence_days) {
        repeatCheckbox.checked = true;
        recurrenceSection.classList.remove("hidden");
        recurrenceFrequency.value = eventData.recurrence_frequency;
        const recurrenceDaysArr = eventData.recurrence_days ? eventData.recurrence_days.split(',') : [];
        recurrenceDays.forEach(cb => {
          cb.checked = recurrenceDaysArr.includes(cb.value);
        });
        recurrenceEndType.value = eventData.recurrence_end_type || 'never';
        if (eventData.recurrence_end_type === "by_date") {
          recurrenceEndDateContainer.classList.remove("hidden");
          recurrenceEndDate.value = eventData.recurrence_end_date || '';
        } else if (eventData.recurrence_end_type === "after_occurrences") {
          recurrenceOccurrencesContainer.classList.remove("hidden");
          recurrenceOccurrences.value = eventData.recurrence_occurrences || '';
        } else {
          recurrenceEndDateContainer.classList.add("hidden");
          recurrenceOccurrencesContainer.classList.add("hidden");
        }
      } else {
        repeatCheckbox.checked = false;
        recurrenceSection.classList.add("hidden");
      }
      deleteEventButton.style.display = "inline-block";

    } else {
      eventForm.reset();
      eventIdInput.value = "";
      eventStartTimeInput.value = defaultStartISO;
      eventEndTimeInput.value   = defaultEndISO;
      eventCalendarSelect.value = "";
      repeatCheckbox.checked = false;
      recurrenceSection.classList.add("hidden");
      recurrenceEndDateContainer.classList.add("hidden");
      recurrenceOccurrencesContainer.classList.add("hidden");
    }
  }
  function closeModalHandler() {
    modal.classList.add("hidden");
    eventForm.reset();
    eventIdInput.value = "";
    repeatCheckbox.checked = false;
    recurrenceSection.classList.add("hidden");
    recurrenceEndDateContainer.classList.add("hidden");
    recurrenceOccurrencesContainer.classList.add("hidden");
  }

  function openCalendarModal(calData = null) {
    calendarModal.classList.remove("hidden");
    if (calData) {
      calendarIdHidden.value   = calData.id;
      calendarNameInput.value  = calData.name;
      calendarColorInput.value = calData.color;
    } else {
      calendarForm.reset();
      calendarIdHidden.value = "";
    }
  }
  function closeCalendarModalHandler() {
    calendarModal.classList.add("hidden");
    calendarForm.reset();
    calendarIdHidden.value = "";
  }

  // ------------- NAVIGATION --------------------
  function navigate(direction) {
    if (currentView === "week") {
      currentDate.setDate(currentDate.getDate() + direction*7);
    } else if (currentView === "month") {
      currentDate.setMonth(currentDate.getMonth() + direction);
    } else {
      currentDate.setFullYear(currentDate.getFullYear() + direction);
    }
    renderCalendar();
  }

  function formatDateISO(date) {
    const y = date.getFullYear();
    const m = String(date.getMonth()+1).padStart(2,'0');
    const d = String(date.getDate()).padStart(2,'0');
    return `${y}-${m}-${d}`;
  }

  // ------------- EVENT LISTENERS --------------
  // Auth
  loginForm.addEventListener("submit", login);
  signupForm.addEventListener("submit", signup);
  logoutButton.addEventListener("click", logout);

  // Password toggles
  toggleLoginPwBtn.addEventListener("click", () => {
    if (loginPwInput.type === "password") {
      loginPwInput.type = "text";
    } else {
      loginPwInput.type = "password";
    }
  });
  toggleSignupPwBtn.addEventListener("click", () => {
    if (signupPwInput.type === "password") {
      signupPwInput.type = "text";
    } else {
      signupPwInput.type = "password";
    }
  });

  // Calendar navigation
  prevButton.addEventListener("click", () => navigate(-1));
  nextButton.addEventListener("click", () => navigate(1));
  viewWeekButton.addEventListener("click", () => {
    currentView = "week";
    renderCalendar();
  });
  viewMonthButton.addEventListener("click", () => {
    currentView = "month";
    renderCalendar();
  });
  viewYearButton.addEventListener("click", () => {
    currentView = "year";
    renderCalendar();
  });

  // Event modal
  modalCloseX.addEventListener("click", closeModalHandler);
  closeModal.addEventListener("click", closeModalHandler);
  eventForm.addEventListener("submit", saveEvent);
  deleteEventButton.addEventListener("click", removeEvent);

  // Calendar modal
  addCalendarBtn.addEventListener("click", () => openCalendarModal());
  closeCalendarModal.addEventListener("click", closeCalendarModalHandler);
  calendarForm.addEventListener("submit", saveCalendar);

  // Repeat checkbox
  repeatCheckbox.addEventListener("change", () => {
    if (repeatCheckbox.checked) {
      recurrenceSection.classList.remove("hidden");
    } else {
      recurrenceSection.classList.add("hidden");
      recurrenceFrequency.value = 1;
      recurrenceDays.forEach(cb => cb.checked = false);
      recurrenceEndType.value = 'never';
      recurrenceEndDate.value = '';
      recurrenceOccurrences.value = '';
      recurrenceEndDateContainer.classList.add("hidden");
      recurrenceOccurrencesContainer.classList.add("hidden");
    }
  });
  // Recurrence end type
  recurrenceEndType.addEventListener("change", () => {
    const val = recurrenceEndType.value;
    if (val === 'by_date') {
      recurrenceEndDateContainer.classList.remove("hidden");
      recurrenceOccurrencesContainer.classList.add("hidden");
    } else if (val === 'after_occurrences') {
      recurrenceEndDateContainer.classList.add("hidden");
      recurrenceOccurrencesContainer.classList.remove("hidden");
    } else {
      recurrenceEndDateContainer.classList.add("hidden");
      recurrenceOccurrencesContainer.classList.add("hidden");
    }
  });

  // ------------- INITIAL LOAD -----------------
  loadData();
});


```
**endpoint.php**
```php
<?php
// Initialize or connect to SQLite Database (adjust path as needed)
$db = new PDO('sqlite:../databases/lightsalmon.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create 'users' table if not exists
$db->exec("
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password_hash TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    -- If you want, you can add week_start_day right here if not already done:
    -- week_start_day TEXT DEFAULT 'monday'
)");

// Create 'calendars' table
$db->exec("
CREATE TABLE IF NOT EXISTS calendars (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    name TEXT NOT NULL,
    color TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)");

// Create 'events' table with recurrence columns
$db->exec("
CREATE TABLE IF NOT EXISTS events (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    calendar_id INTEGER NOT NULL,
    title TEXT NOT NULL,
    description TEXT,
    start_date TEXT NOT NULL,
    start_time TEXT NOT NULL,
    end_date TEXT NOT NULL,
    end_time TEXT NOT NULL,
    recurrence_frequency INTEGER DEFAULT 1,
    recurrence_days TEXT DEFAULT '',
    recurrence_end_type TEXT DEFAULT 'never',
    recurrence_end_date TEXT DEFAULT NULL,
    recurrence_occurrences INTEGER DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (calendar_id) REFERENCES calendars(id) ON DELETE CASCADE
);
");

// OPTIONAL: If you haven’t added `week_start_day` column in `users` table, do:
/// try {
///   $db->exec("ALTER TABLE users ADD COLUMN week_start_day TEXT DEFAULT 'monday' ");
/// } catch (Exception $e) {
///   // ignore if column already exists
/// }

session_start();

// Identify path
$path = isset($_GET['path']) ? trim($_GET['path'], '/') : '';
$method = $_SERVER['REQUEST_METHOD'];

switch ($path) {
    case 'signup':
        if ($method === 'POST') signup($db);
        break;
    case 'login':
        if ($method === 'POST') login($db);
        break;
    case 'logout':
        if ($method === 'POST') logout();
        break;

    case 'create_calendar':
        if ($method === 'POST') create_calendar($db);
        break;
    case 'get_calendars':
        if ($method === 'GET') get_calendars($db);
        break;

    case 'create_event':
        if ($method === 'POST') create_event($db);
        break;
    case 'get_events':
        if ($method === 'GET') get_events($db);
        break;

    // New or updated endpoints
    case 'delete_calendar':
        if ($method === 'POST') delete_calendar($db);
        break;
    case 'update_calendar':
        if ($method === 'POST') update_calendar($db);
        break;
    case 'update_event':
        if ($method === 'POST') update_event($db);
        break;
    case 'delete_event':
        if ($method === 'POST') delete_event($db);
        break;
    
    case 'update_user':
        if ($method === 'POST') update_user($db);
        break;
    case 'get_user':
        if ($method === 'GET') get_user($db);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Endpoint not found']);
        break;
}

// ----------------------------------------------------------------------------
// AUTH HELPERS
function signup($db) {
    $input = json_decode(file_get_contents('php://input'), true);
    $username = trim($input['username'] ?? '');
    $password = $input['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Username and password are required']);
        return;
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    try {
        $stmt = $db->prepare("INSERT INTO users (username, password_hash, week_start_day) VALUES (:username, :password_hash, 'monday')");
        $stmt->execute([
            ':username' => $username,
            ':password_hash' => $passwordHash
        ]);
        // get new user ID
        $newUserId = $db->lastInsertId();

        // create a default calendar with the user's name
        $calStmt = $db->prepare("
            INSERT INTO calendars (user_id, name, color)
            VALUES (:uid, :uname, :color)
        ");
        $calStmt->execute([
            ':uid' => $newUserId,
            ':uname' => $username,  // calendar name = username
            ':color' => '#f4846f'
        ]);

        echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Username already exists']);
    }
}

function login($db) {
    $input = json_decode(file_get_contents('php://input'), true);
    $username = trim($input['username'] ?? '');
    $password = $input['password'] ?? '';

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        echo json_encode(['status' => 'success', 'message' => 'Login successful']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
    }
}

function logout() {
    session_destroy();
    echo json_encode(['status' => 'success', 'message' => 'Logged out successfully']);
}

// ----------------------------------------------------------------------------
// GET / UPDATE USER
function get_user($db) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    $userId = $_SESSION['user_id'];
    $stmt = $db->prepare("SELECT id, username, week_start_day FROM users WHERE id = :uid");
    $stmt->execute([':uid' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        echo json_encode(['status' => 'success', 'user' => $user]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
    }
}

function update_user($db) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    $userId = $_SESSION['user_id'];
    $input = json_decode(file_get_contents('php://input'), true);

    $newPassword = $input['new_password'] ?? '';
    $weekStart   = $input['week_start_day'] ?? '';

    // If user wants to change password
    if (!empty($newPassword)) {
        $hash = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $db->prepare("UPDATE users SET password_hash = :hash WHERE id = :uid");
        $stmt->execute([':hash' => $hash, ':uid' => $userId]);
    }

    // If user wants to set 'monday' or 'sunday'
    if ($weekStart === 'monday' || $weekStart === 'sunday') {
        $stmt = $db->prepare("UPDATE users SET week_start_day = :ws WHERE id = :uid");
        $stmt->execute([':ws' => $weekStart, ':uid' => $userId]);
    }

    echo json_encode(['status' => 'success', 'message' => 'User updated']);
}

// ----------------------------------------------------------------------------
// CALENDARS
function create_calendar($db) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    $userId = $_SESSION['user_id'];

    $input = json_decode(file_get_contents('php://input'), true);
    $name  = trim($input['name'] ?? '');
    $color = trim($input['color'] ?? '');

    if (empty($name) || empty($color)) {
        echo json_encode(['status' => 'error', 'message' => 'Name and color are required']);
        return;
    }

    $stmt = $db->prepare("
        INSERT INTO calendars (user_id, name, color)
        VALUES (:user_id, :name, :color)
    ");
    $stmt->execute([
        ':user_id' => $userId,
        ':name'    => $name,
        ':color'   => $color
    ]);

    echo json_encode(['status' => 'success', 'message' => 'Calendar created successfully']);
}

function get_calendars($db) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    $userId = $_SESSION['user_id'];
    $stmt = $db->prepare("SELECT * FROM calendars WHERE user_id = :uid");
    $stmt->execute([':uid' => $userId]);
    $calendars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'calendars' => $calendars]);
}

function update_calendar($db) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    $userId = $_SESSION['user_id'];

    $input = json_decode(file_get_contents('php://input'), true);
    $calendarId = $input['id'] ?? null;
    $name  = trim($input['name'] ?? '');
    $color = trim($input['color'] ?? '');

    if (!$calendarId || empty($name) || empty($color)) {
        echo json_encode(['status' => 'error', 'message' => 'Calendar ID, name, and color are required']);
        return;
    }

    $stmt = $db->prepare("
        UPDATE calendars
        SET name = :name, color = :color
        WHERE id = :cid AND user_id = :uid
    ");
    $stmt->execute([
        ':name' => $name,
        ':color'=> $color,
        ':cid'  => $calendarId,
        ':uid'  => $userId
    ]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Calendar updated']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Calendar not found or not yours']);
    }
}

function delete_calendar($db) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    $userId = $_SESSION['user_id'];

    $input = json_decode(file_get_contents('php://input'), true);
    $calendarId = $input['calendar_id'] ?? null;
    if (!$calendarId) {
        echo json_encode(['status' => 'error', 'message' => 'Calendar ID required']);
        return;
    }

    $stmt = $db->prepare("DELETE FROM calendars WHERE id = :cid AND user_id = :uid");
    $stmt->execute([':cid' => $calendarId, ':uid' => $userId]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Calendar deleted']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Could not delete calendar (not found or not yours)']);
    }
}

// ----------------------------------------------------------------------------
// EVENTS
function create_event($db) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    $userId = $_SESSION['user_id'];

    $input = json_decode(file_get_contents('php://input'), true);
    $calendarId  = $input['calendar_id'] ?? null;
    $title       = trim($input['title'] ?? '');
    $description = trim($input['description'] ?? '');
    $start_date  = $input['start_date'] ?? '';
    $start_time  = $input['start_time'] ?? '';
    $end_date    = $input['end_date'] ?? '';
    $end_time    = $input['end_time'] ?? '';

    $rfreq  = isset($input['recurrence_frequency']) ? intval($input['recurrence_frequency']) : 1;
    $rdays  = isset($input['recurrence_days']) && is_array($input['recurrence_days']) ? implode(',', $input['recurrence_days']) : '';
    $rendtype = $input['recurrence_end_type'] ?? 'never';
    $renddate = $input['recurrence_end_date'] ?? null;
    $rocc     = isset($input['recurrence_occurrences']) ? intval($input['recurrence_occurrences']) : null;

    if (!$calendarId || empty($title) || empty($start_date) || empty($start_time) || empty($end_date) || empty($end_time)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields (title, start/end, etc.) are required']);
        return;
    }

    $stmt = $db->prepare("
        INSERT INTO events (
            user_id, calendar_id, title, description,
            start_date, start_time, end_date, end_time,
            recurrence_frequency, recurrence_days,
            recurrence_end_type, recurrence_end_date, recurrence_occurrences
        )
        VALUES (
            :uid, :calid, :title, :desc,
            :sdate, :stime, :edate, :etime,
            :rfreq, :rdays,
            :rendtype, :renddate, :rocc
        )
    ");
    $stmt->execute([
        ':uid'     => $userId,
        ':calid'   => $calendarId,
        ':title'   => $title,
        ':desc'    => $description,
        ':sdate'   => $start_date,
        ':stime'   => $start_time,
        ':edate'   => $end_date,
        ':etime'   => $end_time,
        ':rfreq'   => $rfreq,
        ':rdays'   => $rdays,
        ':rendtype'=> $rendtype,
        ':renddate'=> $renddate,
        ':rocc'    => $rocc
    ]);
    echo json_encode(['status' => 'success', 'message' => 'Event created']);
}

function get_events($db) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    $userId = $_SESSION['user_id'];

    // fetch events
    $stmt = $db->prepare("
        SELECT e.*, c.name AS calendar_name, c.color AS calendar_color
        FROM events e
        JOIN calendars c ON e.calendar_id = c.id
        WHERE e.user_id = :uid
        ORDER BY e.start_date, e.start_time
    ");
    $stmt->execute([':uid' => $userId]);
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $expanded_events = [];
    foreach ($events as $event) {
        if ($event['recurrence_frequency'] > 0 && !empty($event['recurrence_days'])) {
            $frequency = $event['recurrence_frequency'];
            $days      = explode(',', $event['recurrence_days']);
            $end_type  = $event['recurrence_end_type'];
            $end_date  = $event['recurrence_end_date'];
            $occ       = $event['recurrence_occurrences'];

            $start_datetime = new DateTime($event['start_date'].' '.$event['start_time']);
            $end_datetime   = new DateTime($event['end_date'].' '.$event['end_time']);
            $period_end     = new DateTime($event['start_date']);
            $period_end->modify('+10 years');

            if ($end_type === 'by_date' && !empty($end_date)) {
                $period_end = new DateTime($end_date);
            }
            $count = 0;
            $current_date = clone $start_datetime;
            while ($current_date <= $period_end) {
                foreach ($days as $day) {
                    $day_of_week = intval($day);
                    $occ_start = clone $current_date;
                    // setISODate(year, weekNumber, dayOfWeek) => but need to ensure correct approach
                    $isoWeek = $occ_start->format('W');
                    $occ_start->setISODate($occ_start->format('o'), $isoWeek, $day_of_week);
                    $occ_start->setTime(
                        intval(substr($event['start_time'],0,2)),
                        intval(substr($event['start_time'],3,2))
                    );
                    $duration_seconds = $end_datetime->getTimestamp() - $start_datetime->getTimestamp();
                    $occ_end = clone $occ_start;
                    $occ_end->modify("+{$duration_seconds} seconds");

                    if ($occ_start > $period_end) continue;
                    if ($end_type === 'by_date' && !empty($end_date) && $occ_start > new DateTime($end_date)) {
                        continue;
                    }
                    $expanded_events[] = [
                        'id' => $event['id'],
                        'user_id' => $event['user_id'],
                        'calendar_id' => $event['calendar_id'],
                        'title' => $event['title'],
                        'description' => $event['description'],
                        'start_date' => $occ_start->format('Y-m-d'),
                        'start_time' => $occ_start->format('H:i'),
                        'end_date'   => $occ_end->format('Y-m-d'),
                        'end_time'   => $occ_end->format('H:i'),
                        'calendar_name' => $event['calendar_name'],
                        'calendar_color'=> $event['calendar_color'],
                    ];
                    $count++;
                    if ($end_type === 'after_occurrences' && $count >= $occ) {
                        break 2;
                    }
                }
                $current_date->modify("+{$frequency} weeks");
            }
        } else {
            $expanded_events[] = [
                'id' => $event['id'],
                'user_id' => $event['user_id'],
                'calendar_id' => $event['calendar_id'],
                'title' => $event['title'],
                'description' => $event['description'],
                'start_date' => $event['start_date'],
                'start_time' => $event['start_time'],
                'end_date'   => $event['end_date'],
                'end_time'   => $event['end_time'],
                'calendar_name' => $event['calendar_name'],
                'calendar_color'=> $event['calendar_color']
            ];
        }
    }

    echo json_encode(['status' => 'success', 'events' => $expanded_events]);
}

function update_event($db) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    $userId = $_SESSION['user_id'];
    $input = json_decode(file_get_contents('php://input'), true);

    $eventId    = $input['id'] ?? null;
    $calendarId = $input['calendar_id'] ?? null;
    $title      = trim($input['title'] ?? '');
    $description= trim($input['description'] ?? '');
    $start_date = $input['start_date'] ?? '';
    $start_time = $input['start_time'] ?? '';
    $end_date   = $input['end_date'] ?? '';
    $end_time   = $input['end_time'] ?? '';

    $rfreq  = isset($input['recurrence_frequency']) ? intval($input['recurrence_frequency']) : 1;
    $rdays  = isset($input['recurrence_days']) && is_array($input['recurrence_days']) ? implode(',', $input['recurrence_days']) : '';
    $rendtype = $input['recurrence_end_type'] ?? 'never';
    $renddate = $input['recurrence_end_date'] ?? null;
    $rocc     = isset($input['recurrence_occurrences']) ? intval($input['recurrence_occurrences']) : null;

    if (!$eventId || !$calendarId || empty($title) || empty($start_date) || empty($start_time) || empty($end_date) || empty($end_time)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields (and Event ID) are required']);
        return;
    }

    $stmt = $db->prepare("
        UPDATE events
        SET calendar_id = :calid, title = :title, description = :desc,
            start_date = :sdate, start_time = :stime,
            end_date = :edate, end_time = :etime,
            recurrence_frequency = :rfreq, recurrence_days = :rdays,
            recurrence_end_type = :rendtype, recurrence_end_date = :renddate,
            recurrence_occurrences = :rocc
        WHERE id = :eid AND user_id = :uid
    ");
    $stmt->execute([
        ':calid' => $calendarId,
        ':title' => $title,
        ':desc'  => $description,
        ':sdate' => $start_date,
        ':stime' => $start_time,
        ':edate' => $end_date,
        ':etime' => $end_time,
        ':rfreq' => $rfreq,
        ':rdays' => $rdays,
        ':rendtype'=> $rendtype,
        ':renddate'=> $renddate,
        ':rocc'     => $rocc,
        ':eid'   => $eventId,
        ':uid'   => $userId
    ]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Event updated']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Event not found or not yours']);
    }
}

function delete_event($db) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        return;
    }
    $userId = $_SESSION['user_id'];

    $input = json_decode(file_get_contents('php://input'), true);
    $eventId = $input['id'] ?? null;

    if (!$eventId) {
        echo json_encode(['status' => 'error', 'message' => 'Event ID is required']);
        return;
    }

    $stmt = $db->prepare("DELETE FROM events WHERE id = :eid AND user_id = :uid");
    $stmt->execute([':eid' => $eventId, ':uid' => $userId]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Event deleted']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Event not found or not yours']);
    }
}
?>


```
**index.html**
```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>jocarsa | lightSalmon</title>
  
  <!-- Link to your stylesheet -->
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-silver/jocarsa-silver.css" />
  
  <!-- Favicon (optional) -->
  <link rel="icon" type="image/svg+xml" href="https://jocarsa.com/static/logo/lightsalmon.png" />
</head>
<body>

  <!-- Authentication Section -->
  <div id="auth-section">
    <img src="https://jocarsa.com/static/logo/lightsalmon.png" alt="logo" id="logo"/>
    <h1>jocarsa | lightSalmon</h1>
    
    <div id="contieneformularios">
      <!-- LOGIN FORM -->
      <div class="formulario">
        <h2>Iniciar sesión</h2>
        <form id="login-form">
          <input type="email" id="login-username" placeholder="Username" required />
          <div class="password-container">
            <input type="password" id="login-password" placeholder="Password" required />
            <span class="password-toggle" id="toggle-login-password">👁️</span>
          </div>
          <button type="submit">Login</button>
        </form>
      </div>
      
      <!-- SIGNUP FORM -->
      <div class="formulario">
        <h2>Crear una cuenta</h2>
        <form id="signup-form">
          <input type="email" id="signup-username" placeholder="Username" required />
          <div class="password-container">
            <input type="password" id="signup-password" placeholder="Password" required />
            <span class="password-toggle" id="toggle-signup-password">👁️</span>
          </div>
          <button type="submit">Signup</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Calendar Section -->
  <div id="calendar-section" class="hidden">
    <div class="calendar-header">
      <h1>
        <img src="https://jocarsa.com/static/logo/lightsalmon.png" id="logo" alt="logo" />
        jocarsa | lightSalmon
      </h1>
      <h1 id="calendar-title">Mi calendario</h1>
      <div id="siguienteanterior">
        <button id="prev">Anterior</button>
        <button id="next">Siguiente</button>
      </div>
      <div id="tipocalendario">
        <button id="view-week">Semana</button>
        <button id="view-month">Mes</button>
        <button id="view-year">Año</button>
      </div>
      <button id="logout-button">Cerrar sesión</button>
      <button id="config-button">Configuración</button>
    </div>

    <div class="calendar-container">
      <div id="sidebar">
        <h3>Calendarios</h3>
        <div id="calendars-list"></div>
        <button id="add-calendar-btn">+ Añadir Calendario</button>
      </div>
      <div id="contienecalendario">
        <div id="calendar-grid" class="calendar-grid month">
          <!-- The calendar cells/tables are dynamically generated by JS -->
        </div>
      </div>
    </div>

    <!-- Event Modal -->
    <div id="event-modal" class="modal hidden">
      <form id="event-form">
        <!-- "X" corner to close -->
        <span class="close-modal" id="modal-close-btn">&times;</span>
        <h3>Crear/Editar evento</h3>
        
        <input type="hidden" id="event-id-hidden" />
        
        <input type="text" id="event-title" placeholder="Event Title" required />
        <textarea id="event-description" placeholder="Event Description"></textarea>
        
        <!-- Start and End inputs (duration) -->
        <label for="event-start-time">Inicio:</label>
        <input type="datetime-local" id="event-start-time" required />
        
        <label for="event-end-time">Fin:</label>
        <input type="datetime-local" id="event-end-time" required />

        <label for="event-calendar">Calendario:</label>
        <select id="event-calendar" required></select>

        <!-- Repeat Checkbox -->
        <div id="repeat-section">
          <label>
          Repetir este evento
            <input type="checkbox" id="repeat-checkbox" />
            
          </label>
        </div>

        <!-- Recurrence Options -->
        <div id="recurrence-section" class="hidden">
          <h4>Repetición</h4>
          
          <label for="recurrence-frequency">Repetir cada:</label>
          <select id="recurrence-frequency">
            <option value="1">Semana</option>
            <option value="2">Cada 2 semanas</option>
            <option value="3">Cada 3 semanas</option>
            <option value="4">Cada 4 semanas</option>
          </select>
          
          <fieldset id="recurrence-days">
            <legend>Días de la semana:</legend>
            <div class="days-container">
               <label class="day-label"><input type="checkbox" value="1" /> L</label>
               <label class="day-label"><input type="checkbox" value="2" /> M</label>
               <label class="day-label"><input type="checkbox" value="3" /> X</label>
               <label class="day-label"><input type="checkbox" value="4" /> J</label>
               <label class="day-label"><input type="checkbox" value="5" /> V</label>
               <label class="day-label"><input type="checkbox" value="6" /> S</label>
               <label class="day-label"><input type="checkbox" value="7" /> D</label>
            </div>
          </fieldset>
          
          <label for="recurrence-end-type">Terminar:</label>
          <select id="recurrence-end-type">
            <option value="never">Nunca</option>
            <option value="by_date">En una fecha específica</option>
            <option value="after_occurrences">Después de X repeticiones</option>
          </select>
          
          <div id="recurrence-end-date-container" class="hidden">
            <label for="recurrence-end-date">Fecha de finalización:</label>
            <input type="date" id="recurrence-end-date" />
          </div>
          
          <div id="recurrence-occurrences-container" class="hidden">
            <label for="recurrence-occurrences">Número de repeticiones:</label>
            <input type="number" id="recurrence-occurrences" min="1" />
          </div>
        </div>

        <button type="submit">Guardar evento</button>
        <button type="button" id="delete-event-button" style="display:none;">Borrar Evento</button>
        <button type="button" id="close-modal">Cancelar</button>
      </form>
    </div>

    <!-- Calendar Modal -->
    <div id="calendar-modal" class="modal hidden">
      <form id="calendar-form">
        <h3>Crear/Editar Calendario</h3>
        <input type="hidden" id="calendar-id-hidden" />
        <input type="text" id="calendar-name" placeholder="Calendar Name" required />
        <input type="color" id="calendar-color" />
        <button type="submit">Guardar</button>
        <button type="button" id="close-calendar-modal">Cancelar</button>
      </form>
    </div>
  </div>

  <!-- Config (User Settings) Modal -->
  <div id="config-section" class="modal hidden">
    <form id="config-form">
      <span class="close-modal" id="close-config-modal">&times;</span>
      <h3>Configuración de la cuenta</h3>
      
      <label for="new-password">Cambiar contraseña:</label>
      <div class="password-container">
        <input type="password" id="new-password" placeholder="New Password" />
        <span class="password-toggle" id="toggle-new-password">👁️</span>
      </div>
      <br />

      <label for="week-start-select">Semana inicia el:</label>
      <select id="week-start-select">
        <option value="monday">Lunes</option>
        <option value="sunday">Domingo</option>
      </select>
      <br /><br />

      <button type="submit">Guardar</button>
    </form>
  </div>

  <!-- Main JS -->
  <script src="calendar.js"></script>
  <script src="https://jocarsa.github.io/jocarsa-silver/jocarsa-silver.js"></script>
</body>
</html>


```
**styles.css**
```css
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');

/* Root variables */
:root {
  --primary-color: lightsalmon;
  --light-bg: #fdf5e6;
  --dark-text: #343a40;
  --gray-border: #e9ecef;
  --white: white;
}

/* Utility: Hide elements with .hidden */
.hidden {
  display: none !important;
}

/* Global resets/typography */
body {
  font-family: Ubuntu, 'Roboto', sans-serif;
  margin: 0;
  padding: 0;
  background-color: var(--light-bg);
  color: var(--dark-text);
  background: url(calendario.webp);
  background-size: cover;
}
h1 {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: center;
  align-items: center;
  color:white;
  font-weight:bold;
}
#logo {
  width: 50px;
}

/* Authentication Section */
#auth-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  transition: opacity 0.3s ease;
  background-color: var(--light-bg);
  width: 400px;
}
#auth-section h2 {
  margin-bottom: 10px;
  color: var(--dark-text);
}
#auth-section form {
  margin-bottom: 20px;
  background: var(--white);
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 300px;
}
#auth-section input {
  width: 200px;
  margin-bottom: 10px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}
#auth-section button {
  width: 220px;
  padding: 10px;
  background: var(--primary-color);
  color: var(--dark-text);
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1rem;
  transition: background 0.2s;
}
#auth-section button:hover {
  background: #e89c7a;
}
#contieneformularios {
  text-align: center;
  display: flex;
  flex-direction: column;
  flex-wrap: nowrap;
  justify-content: space-between;
  align-items: stretch;
  gap: 20px;
}
#contieneformularios input,
#contieneformularios button {
  width: 100%;
  box-sizing:border-box;
}

/* Calendar Section */
#calendar-section {
  display: flex; 
  flex-direction: column;
  height: 100vh;
  width: 100vw;
  
  background: var(--white);
}
.calendar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: linear-gradient(90deg, var(--primary-color) 0%, #e89c7a 100%);
  color: var(--dark-text);
  padding: 20px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
}
.calendar-header h1 {
  margin: 0;
  font-size: 1.5rem;
  font-weight: bold;
}
.week .event{
	height:100%;
}
thead{

}
.calendar-header button {
  background: var(--white);
  color: var(--dark-text);
  border: none;
  padding: 10px 20px;
  min-width: 100px;
  cursor: pointer;
  font-size: 1rem;
  transition: background 0.2s, transform 0.2s;
}
.calendar-header button:hover {
  background: rgba(255, 255, 255, 0.9);
  transform: scale(1.05);
}
.calendar-container {
  display: flex;
  flex: 1;
  
}
#contienecalendario {
  width: 75%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

/* Month View */
.calendar-grid {
  padding: 20px;
  display: grid;
  gap: 1px;
  background: #fffaf0;
  width: 100%;
  height: 100%;
  overflow-y: auto;
  transition: background 0.3s;
}
.calendar-grid.month {
  grid-template-columns: repeat(7, 1fr);
}
.calendar-grid.month .month-header-cell {
  background: var(--primary-color);
  color: var(--dark-text);
  font-weight: bold;
  text-align: center;
  padding: 10px 0;
  border: 1px solid var(--gray-border);
}
.calendar-grid.month .calendar-cell {
  background: var(--white);
  border: 1px solid var(--gray-border);
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 10px;
  min-height: 80px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  transition: background 0.2s, border-color 0.2s, transform 0.2s;
}
.calendar-grid.month .calendar-cell:hover {
  background: #fde2d2;
  border-color: var(--primary-color);
  cursor: pointer;
  transform: translateY(-2px);
}
/* Highlight current day */
.calendar-grid.month .calendar-cell.today {
    border: 2px solid var(--primary-color);
    background: rgba(255, 160, 122, 0.2);
    position: relative;
}
.calendar-grid.month .calendar-cell.today::after {
    content: 'Hoy';
    position: absolute;
    bottom: 5px;
    left: 50%;
    transform: translateX(-50%);
    background-color: var(--primary-color);
    color: var(--dark-text);
    padding: 2px 4px;
    border-radius: 4px;
    font-size: 0.6rem;
}

/* Week View */
.calendar-grid.week {
  display: block; 
  overflow-x: auto;
}
.calendar-grid.week table {
  width: 100%;
  border-collapse: collapse;
}
.calendar-grid.week .week-table th,
.calendar-grid.week .week-table td {
  border: 1px solid var(--gray-border);
  padding: 5px;
}
.calendar-grid.week .week-table th {
  background: #f8d5c2;
  text-align: center;
}
.calendar-grid.week .week-table .hour-cell {
  background-color: var(--white);
  border-right: 1px solid var(--gray-border);
  padding-right: 10px;
  text-align: right;
  font-weight: bold;
  width: 60px; 
}
.week-table tbody td {
  border: 1px solid var(--gray-border);
  vertical-align: top;
  height: 30px;
  position: relative;
  padding: 3px;
}
.week-table {
  width: 100%;
  border-collapse: collapse;
  table-layout: fixed;
}
.week-table .event{
	height:100%;
}

/* Year View */
.calendar-grid.year {
  grid-template-columns: repeat(4, 1fr);
  gap:50px;
}
.year-month {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
}
.year-month-header {
  font-weight: bold;
  margin-bottom: 5px;
  color: var(--dark-text);
  text-align: center;
}
.year-month-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 1px;
  width: 100%; 
}
.year-day {
  min-height: 24px;
  font-size: 0.75rem;
  text-align: center;
  padding: 3px;
  cursor: pointer;
  border: 1px solid var(--gray-border);
  background: var(--white);
  transition: background 0.2s;
}
.year-day:hover {
  background: #fde2d2;
}
.year-day.has-event {
  background-color: lightsalmon;
  color: #fff;
  border-radius: 50%;
}

/* Sidebar */
#sidebar {
  width: 20%;
  background: var(--light-bg);
  padding: 20px;
  border-left: 1px solid #e0e0e0;
  overflow-y: auto;
}
#sidebar h3 {
  margin-top: 0;
  color: var(--dark-text);
}
#calendars-list {
  margin-bottom: 20px;
}
.calendar-item {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
  font-size: 0.9rem;
}
.calendar-item .color {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  margin-right: 10px;
}
.calendar-item button {
  background: var(--white);
  color: var(--dark-text);
  border: 1px solid var(--primary-color);
  padding: 4px 8px;
  border-radius: 4px;
  margin-right: 5px;
  font-size: 0.8rem;
  cursor: pointer;
  transition: background 0.2s, color 0.2s;
}
.calendar-item button:hover {
  background: var(--primary-color);
  color: var(--dark-text);
}
#add-calendar-btn {
  background: var(--primary-color);
  color: var(--dark-text);
  border: none;
  padding: 8px 16px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 0.9rem;
  transition: background 0.2s;
}
#add-calendar-btn:hover {
  background: #e89c7a;
}

/* Event pills */
.event-list {
  width: 100%;
}
.event {
  padding: 5px 8px;
  border-radius: 5px;
  color: white;
  font-size: 0.8rem;
  text-align: center;
  margin-bottom: 5px;
  transition: opacity 0.2s;
  width: 100%;
  box-sizing: border-box;
  text-shadow: 0px 0px 2px #000000, 0px 0px 2px #000000;
}
.event:hover {
  opacity: 0.85;
}

/* Modals */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}
.modal.hidden {
  display: none;
}
.modal form {
  background: var(--white);
  padding: 20px;
  border-radius: 8px;
  width: 340px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  position: relative;
}
.modal h3 {
  margin-top: 0;
  color: var(--primary-color);
}
#event-form input,
#event-form textarea,
#event-form select,
#calendar-form input,
#calendar-form select {
  width: 100%;
  margin-bottom: 12px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing:border-box;
}
#event-form button,
#calendar-form button,
#config-form button {
  width: 100%;
  padding: 10px;
  background: var(--primary-color);
  color: var(--dark-text);
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.2s;
  margin-bottom: 10px;
}
#event-form button:hover,
#calendar-form button:hover,
#config-form button:hover {
  background: #e89c7a;
}
#close-modal,
#close-calendar-modal {
  background: #ccc;
  color: #333;
}
#close-modal:hover,
#close-calendar-modal:hover {
  background: #bbb;
}

/* Recurrence Section */
#recurrence-section {
  margin-top: 15px;
  padding: 10px;
  border: 1px solid var(--gray-border);
  border-radius: 5px;
  background-color: #f9f9f9;
}
#recurrence-section h4 {
  margin-top: 0;
  color: var(--primary-color);
}
#recurrence-days {
  margin-top: 15px;
}
#recurrence-days legend {
  font-weight: bold;
  color: var(--primary-color);
  margin-bottom: 10px;
  display: block;
  font-size: 1rem;
}
.days-container {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 0px;
}
.day-label {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: var(--white);
  border: 1px solid var(--gray-border);
  border-radius: 5px;
  padding: 8px;
  cursor: pointer;
  transition: background-color 0.3s, border-color 0.3s, transform 0.2s;
  font-size: 0.9rem;
  color: var(--dark-text);
  text-align: center;
}
.day-label input[type="checkbox"] {
  margin-right: 6px;
  cursor: pointer;
}
.day-label:hover {
  background-color: var(--primary-color);
  color: var(--dark-text);
  border-color: var(--primary-color);
  transform: translateY(-2px);
}

/* Password visibility toggles */
.password-container {
  position: relative;
  display: inline-block;
  width: 100%;
}
.password-toggle {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  user-select: none;
}

/* Close "X" in the corner */
.close-modal {
  position: absolute;
  top: 8px;
  right: 12px;
  font-size: 1.2rem;
  cursor: pointer;
  color: #999;
}
.close-modal:hover {
  color: #444;
}

/* Responsive */
@media (max-width: 768px) {
  .calendar-container {
    flex-direction: column;
  }
  .calendar-grid.month,
  .calendar-grid.year {
    grid-template-columns: repeat(2, 1fr);
  }
  .calendar-grid.week {
    display: block;
    overflow-x: auto;
  }
  .calendar-cell {
    min-height: 60px;
  }
  .calendar-header h1 {
    font-size: 1.2rem;
  }
  #sidebar {
    width: 100%;
    border-left: none;
    border-top: 1px solid #e0e0e0;
  }
  #calendar-title{
  	display:none;
  	}
  	button{
  		width:20px;
  		content: "a";
  	}
}

/* Smaller screens for day-label */
@media (max-width: 500px) {
  .days-container {
    grid-template-columns: repeat(3, 1fr);
  }
  .day-label {
    padding: 6px;
    font-size: 0.8rem;
  }
}
#repeat-checkbox{
	width:auto !important;
}
#repeat-section{
	text-align:center;
}
#auth-section #logo{
	width:50%;
}
.calendar-header #logo{
	width:80px;
	margin-right:30px;
}


```