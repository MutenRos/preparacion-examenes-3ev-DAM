<?php
/* =========================================================
   admin.php — Jocarsa analytics panel (NO schema changes)
   - Keeps original SQLite structure (no CREATE/ALTER)
   - Auto-detects existing columns in access_logs
   - Internal SVG charts (no Chart.js, no external deps)
   - Session ini_set BEFORE session_start (fix warnings)
   - Adds: gauges + bot vs human + derived metrics + time series
   ========================================================= */

// ---- Session settings (MUST be before session_start) ----
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_httponly', '1');
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    ini_set('session.cookie_secure', '1');
}
ini_set('session.cookie_samesite', 'Lax');

session_start();

// =========================
// CONFIG
// =========================
const ADMIN_USER = 'jocarsa';
const ADMIN_PASS = 'jocarsa';

const DB_FILE  = __DIR__ . '/jocarsa.db';
const DB_TABLE = 'access_logs';

// =========================
// Helpers
// =========================
function h($s): string { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function fmt_num($n): string {
    $n = (int)$n;
    return number_format($n, 0, ',', '.');
}

function clamp_int($value, $min, $max, $default) {
    $v = (int)$value;
    if ($v < $min || $v > $max) return (int)$default;
    return $v;
}

function safe_str_limit($s, $max = 80) {
    $s = trim(preg_replace('/\s+/', ' ', (string)$s));
    if ($s === '') return '';
    if (function_exists('mb_strlen') && mb_strlen($s, 'UTF-8') > $max) {
        return mb_substr($s, 0, $max, 'UTF-8') . '…';
    }
    if (strlen($s) > $max) return substr($s, 0, $max) . '…';
    return $s;
}

function pdo(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO('sqlite:' . DB_FILE, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }
    return $pdo;
}

function table_columns(PDO $pdo, string $table): array {
    $cols = [];
    $stmt = $pdo->query("PRAGMA table_info(" . $table . ")");
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $r) {
        $name = (string)($r['name'] ?? '');
        if ($name !== '') $cols[strtolower($name)] = true;
    }
    return $cols;
}

function has_col(array $cols, string $name): bool {
    return !empty($cols[strtolower($name)]);
}

function first_existing(array $cols, array $candidates): ?string {
    foreach ($candidates as $c) {
        if (has_col($cols, $c)) return $c;
    }
    return null;
}

function pct($a, $b): float {
    $a = (float)$a; $b = (float)$b;
    $t = $a + $b;
    if ($t <= 0) return 0.0;
    return ($a / $t) * 100.0;
}

// =========================
// SVG mini charting (no deps)
// =========================
function svg_barline(array $values, int $w = 520, int $h = 64): string {
    $n = count($values);
    if ($n <= 0) return '';
    $max = max(1, max(array_map('intval', $values)));

    $pad = 4;
    $barW = max(1, (int)floor(($w - $pad*2) / $n));
    $innerH = $h - $pad*2;

    $rects = '';
    for ($i=0; $i<$n; $i++) {
        $v = (int)$values[$i];
        $bh = (int)round(($v / $max) * $innerH);
        $x = $pad + $i*$barW;
        $y = $pad + ($innerH - $bh);
        $rw = max(1, $barW - 1);
        $rects .= "<rect x='{$x}' y='{$y}' width='{$rw}' height='{$bh}' rx='2' ry='2' fill='currentColor' opacity='0.35' />";
    }

    return "<svg viewBox='0 0 {$w} {$h}' width='100%' height='{$h}' role='img' aria-label='chart'>
        <rect x='0' y='0' width='{$w}' height='{$h}' fill='none'/>
        {$rects}
    </svg>";
}

function svg_donut(int $a, int $b, int $size = 120, int $stroke = 16): string {
    $total = max(1, $a + $b);
    $pctA = $a / $total;

    $r = (int)(($size - $stroke) / 2);
    $cx = (int)($size / 2);
    $cy = (int)($size / 2);

    $circ = 2 * M_PI * $r;
    $dashA = $circ * $pctA;
    $dashB = $circ - $dashA;

    $bg = "#e5e7eb";
    return "<svg viewBox='0 0 {$size} {$size}' width='{$size}' height='{$size}' role='img' aria-label='donut'>
        <circle cx='{$cx}' cy='{$cy}' r='{$r}' fill='none' stroke='{$bg}' stroke-width='{$stroke}' />
        <circle cx='{$cx}' cy='{$cy}' r='{$r}' fill='none'
            stroke='currentColor' stroke-width='{$stroke}'
            stroke-linecap='round'
            stroke-dasharray='{$dashA} {$dashB}'
            transform='rotate(-90 {$cx} {$cy})'
            opacity='0.85'
        />
        <text x='{$cx}' y='{$cy}' text-anchor='middle' dominant-baseline='central'
            font-family='ui-sans-serif, system-ui, -apple-system, Segoe UI'
            font-size='16' font-weight='800' fill='#0f172a'>".(int)round($pctA*100)."%</text>
    </svg>";
}

function svg_gauge(float $percent, int $w=520, int $h=90): string {
    $p = max(0.0, min(100.0, (float)$percent));
    // Semi circle: 180deg
    $cx = (int)($w/2);
    $cy = (int)($h);
    $r  = (int)min($cx-10, $h-10);
    $stroke = 14;

    // progress: use stroke-dasharray on a half-circle path length approx pi*r
    $len = M_PI * $r;
    $dash = ($p/100.0) * $len;
    $gap  = $len - $dash;

    // Path for semicircle from left to right
    $x1 = $cx - $r;
    $y1 = $cy;
    $x2 = $cx + $r;
    $y2 = $cy;

    $path = "M {$x1} {$y1} A {$r} {$r} 0 0 1 {$x2} {$y2}";

    return "<svg viewBox='0 0 {$w} ".($h+10)."' width='100%' height='".($h+10)."' role='img' aria-label='gauge'>
        <path d='{$path}' fill='none' stroke='#e5e7eb' stroke-width='{$stroke}' stroke-linecap='round'/>
        <path d='{$path}' fill='none' stroke='currentColor' stroke-width='{$stroke}' stroke-linecap='round'
              stroke-dasharray='{$dash} {$gap}'/>
        <text x='{$cx}' y='".($h-10)."' text-anchor='middle'
              font-family='ui-sans-serif, system-ui, -apple-system, Segoe UI'
              font-size='18' font-weight='950' fill='#0f172a'>".(int)round($p)."%</text>
    </svg>";
}

function svg_lines(array $series, int $w=520, int $h=120): string {
    // $series: [ ['values'=>[...], 'opacity'=>0.85], ... ]
    $n = 0;
    foreach ($series as $s) $n = max($n, count($s['values'] ?? []));
    if ($n <= 1) return '';

    $max = 1;
    foreach ($series as $s) {
        foreach (($s['values'] ?? []) as $v) $max = max($max, (int)$v);
    }

    $pad = 6;
    $innerW = $w - $pad*2;
    $innerH = $h - $pad*2;
    $stepX = $innerW / ($n - 1);

    $paths = '';
    foreach ($series as $idx => $s) {
        $vals = $s['values'] ?? [];
        if (count($vals) < 2) continue;
        $d = '';
        for ($i=0; $i<$n; $i++) {
            $v = (int)($vals[$i] ?? 0);
            $x = $pad + $i*$stepX;
            $y = $pad + ($innerH - ($v/$max)*$innerH);
            $d .= ($i===0 ? 'M' : 'L') . " {$x} {$y} ";
        }
        $op = isset($s['opacity']) ? (float)$s['opacity'] : 0.85;
        $width = isset($s['width']) ? (int)$s['width'] : 3;
        // Use currentColor for first series and a neutral for next ones (still no external deps)
        $stroke = ($idx === 0) ? 'currentColor' : '#0f172a';
        $paths .= "<path d='{$d}' fill='none' stroke='{$stroke}' stroke-width='{$width}' opacity='{$op}'/>";
    }

    $grid = "<rect x='0' y='0' width='{$w}' height='{$h}' fill='none'/>
             <line x1='{$pad}' y1='".($h-$pad)."' x2='".($w-$pad)."' y2='".($h-$pad)."' stroke='rgba(15,23,42,.10)'/>
             <line x1='{$pad}' y1='{$pad}' x2='{$pad}' y2='".($h-$pad)."' stroke='rgba(15,23,42,.10)'/>";

    return "<svg viewBox='0 0 {$w} {$h}' width='100%' height='{$h}' role='img' aria-label='lines'>
        {$grid}
        {$paths}
    </svg>";
}

// =========================
// Auth (login/logout)
// =========================
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'login') {
    $u = (string)($_POST['username'] ?? '');
    $p = (string)($_POST['password'] ?? '');
    if ($u === ADMIN_USER && $p === ADMIN_PASS) {
        $_SESSION['logged_in'] = true;
        header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
        exit;
    } else {
        $login_error = 'Usuario o contraseña incorrectos';
    }
}

$logged_in = !empty($_SESSION['logged_in']);

if (!$logged_in):
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Acceder · Jocarsa Admin</title>
  <style>
    :root{--bg0:#fff;--bg1:#f0f0f1;--bg2:#e2e4e7;--card:#fff;--border:#d4d7dd;--text:#1d2327;--muted:#6b7280;--accent:#2563eb;--danger:#b02a37;--radius:12px;--shadow:0 18px 45px rgba(0,0,0,.08);}
    *{box-sizing:border-box}
    body{margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;color:var(--text);
      background:radial-gradient(circle at top,var(--bg0) 0,var(--bg1) 55%,var(--bg2) 100%);}
    .box{width:360px;margin:80px auto;padding:26px 24px 30px;background:var(--card);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow)}
    h1{margin:0 0 18px;text-align:center;font-size:22px}
    .err{background:#f8d7da;border-left:4px solid var(--danger);padding:10px 12px;margin-bottom:14px;border-radius:10px;color:#842029;font-size:13px}
    label{display:block;font-size:13px;font-weight:700;margin:0 0 6px}
    input{width:100%;padding:10px 12px;border:1px solid #b0b4bb;border-radius:10px;font-size:14px}
    input:focus{outline:none;border-color:var(--accent);box-shadow:0 0 0 3px rgba(37,99,235,.18)}
    .field{margin-bottom:14px}
    button{width:100%;border:1px solid #1d4ed8;background:linear-gradient(135deg,#2563eb,#1d4ed8);color:#fff;
      font-weight:800;border-radius:12px;line-height:2.8;cursor:pointer;box-shadow:0 10px 24px rgba(37,99,235,.18)}
    button:hover{filter:brightness(1.02)}
    .hint{margin-top:10px;text-align:center;color:var(--muted);font-size:12px}
  </style>
</head>
<body>
  <div class="box">
    <h1>Acceder al panel</h1>
    <?php if ($login_error): ?><div class="err"><?php echo h($login_error); ?></div><?php endif; ?>
    <form method="post">
      <input type="hidden" name="action" value="login">
      <div class="field">
        <label>Usuario</label>
        <input name="username" autocomplete="username" required>
      </div>
      <div class="field">
        <label>Contraseña</label>
        <input type="password" name="password" autocomplete="current-password" required>
      </div>
      <button type="submit">Entrar</button>
      <div class="hint">Jocarsa · Admin</div>
    </form>
  </div>
</body>
</html>
<?php
exit;
endif;

// =========================
// Main
// =========================
$pdo = pdo();
$cols = table_columns($pdo, DB_TABLE);

// Decide which time column to use
$colDatetime = first_existing($cols, ['datetime', 'created_at', 'timestamp', 'time']);
if ($colDatetime === null) {
    die("Error: la tabla '".h(DB_TABLE)."' no tiene columna de fecha/hora conocida (datetime/created_at/timestamp/time).");
}

// Optional columns
$colIP      = first_existing($cols, ['ip', 'remote_ip']);
$colBrowser = first_existing($cols, ['browser']);
$colOS      = first_existing($cols, ['os']);
$colDevice  = first_existing($cols, ['device']);
$colIsBot   = first_existing($cols, ['is_bot']);
$colIsMob   = first_existing($cols, ['is_mobile']);
$colUA      = first_existing($cols, ['user_agent', 'ua']);
$colReferer = first_existing($cols, ['referer', 'referrer']);
$colURL     = first_existing($cols, ['url', 'uri', 'path', 'request_uri']);
$colMethod  = first_existing($cols, ['method']);

// Optional "event" dimension (if present, we can chart views vs clicks, etc.)
$colEvent   = first_existing($cols, ['event_type', 'event', 'type', 'action']);

// Routing
$action = $_GET['action'] ?? 'analytics';

// Range handling (datetime-based to avoid epoch dependency)
$days = clamp_int($_GET['days'] ?? 30, 1, 365, 30);
$toTs = time();
$fromTs = $toTs - ($days * 86400);

$toDT   = date('Y-m-d H:i:s', $toTs);
$fromDT = date('Y-m-d H:i:s', $fromTs);

$today = date('Y-m-d');

// =========================
// Expressions (no schema changes)
// =========================
$botExpr = "0";
if ($colIsBot) {
    $botExpr = "CASE WHEN {$colIsBot} = 1 THEN 1 ELSE 0 END";
} elseif ($colUA) {
    // Conservative bot heuristics
    $ua = "lower({$colUA})";
    $botExpr = "CASE WHEN {$ua} LIKE '%bot%' OR {$ua} LIKE '%crawl%' OR {$ua} LIKE '%spider%' OR {$ua} LIKE '%slurp%' OR {$ua} LIKE '%facebookexternalhit%' OR {$ua} LIKE '%bingpreview%' THEN 1 ELSE 0 END";
}

$mobExpr = "0";
if ($colIsMob) {
    $mobExpr = "CASE WHEN {$colIsMob} = 1 THEN 1 ELSE 0 END";
} elseif ($colUA) {
    $ua = "lower({$colUA})";
    // Mobile-ish heuristic
    $mobExpr = "CASE WHEN {$ua} LIKE '%mobi%' OR {$ua} LIKE '%android%' OR {$ua} LIKE '%iphone%' OR {$ua} LIKE '%ipad%' OR {$ua} LIKE '%ios%' THEN 1 ELSE 0 END";
}

// =========================
// Queries (only using existing columns)
// =========================
$totalVisits = (int)$pdo->query("SELECT COUNT(*) FROM ".DB_TABLE)->fetchColumn();

$visitsToday = (int)$pdo->query(
    "SELECT COUNT(*) FROM ".DB_TABLE." WHERE {$colDatetime} LIKE ".$pdo->quote($today.'%')
)->fetchColumn();

$uniqueIPsToday = 0;
if ($colIP) {
    $uniqueIPsToday = (int)$pdo->query(
        "SELECT COUNT(DISTINCT {$colIP}) FROM ".DB_TABLE." WHERE {$colDatetime} LIKE ".$pdo->quote($today.'%')
    )->fetchColumn();
}

$visitsRange = (int)$pdo->query(
    "SELECT COUNT(*) FROM ".DB_TABLE." WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)
)->fetchColumn();

$uniqueIPsRange = 0;
if ($colIP) {
    $uniqueIPsRange = (int)$pdo->query(
        "SELECT COUNT(DISTINCT {$colIP}) FROM ".DB_TABLE." WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)." AND {$colIP} IS NOT NULL AND {$colIP} <> ''"
    )->fetchColumn();
}

// Total bot/mobile based on either explicit columns or derived UA expressions
$botTraffic = (int)$pdo->query("SELECT COALESCE(SUM({$botExpr}),0) FROM ".DB_TABLE)->fetchColumn();
$nonBotTraffic = max(0, $totalVisits - $botTraffic);

$mobileTraffic = (int)$pdo->query("SELECT COALESCE(SUM({$mobExpr}),0) FROM ".DB_TABLE)->fetchColumn();
$desktopTraffic = max(0, $totalVisits - $mobileTraffic);

// Range bot/mobile
$botRange = (int)$pdo->query(
    "SELECT COALESCE(SUM({$botExpr}),0) FROM ".DB_TABLE." WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)
)->fetchColumn();
$humRange = max(0, $visitsRange - $botRange);

$mobRange = (int)$pdo->query(
    "SELECT COALESCE(SUM({$mobExpr}),0) FROM ".DB_TABLE." WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)
)->fetchColumn();
$deskRange = max(0, $visitsRange - $mobRange);

// Daily series in range (total + bots + mobile + optional event breakdown)
$stmt = $pdo->query("
    SELECT substr({$colDatetime},1,10) AS day,
           COUNT(*) AS n,
           COALESCE(SUM({$botExpr}),0) AS bots,
           COALESCE(SUM({$mobExpr}),0) AS mobile
    FROM ".DB_TABLE."
    WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)."
    GROUP BY substr({$colDatetime},1,10)
    ORDER BY day ASC
");
$daily = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

$dailyVals  = [];
$dailyBots  = [];
$dailyHuman = [];
$dailyMob   = [];
$dailyDesk  = [];
$dailyDays  = [];
foreach ($daily as $r) {
    $n = (int)($r['n'] ?? 0);
    $b = (int)($r['bots'] ?? 0);
    $m = (int)($r['mobile'] ?? 0);
    $dailyDays[]  = (string)($r['day'] ?? '');
    $dailyVals[]  = $n;
    $dailyBots[]  = $b;
    $dailyHuman[] = max(0, $n - $b);
    $dailyMob[]   = $m;
    $dailyDesk[]  = max(0, $n - $m);
}

// Optional: views/clicks daily if event column exists
$dailyViews = [];
$dailyClicks = [];
$hasEventSeries = false;

if ($colEvent) {
    // Try to infer common event names: view/click (case-insensitive)
    $stmt = $pdo->query("
        SELECT substr({$colDatetime},1,10) AS day,
               SUM(CASE WHEN lower({$colEvent})='view'  THEN 1 ELSE 0 END) AS views,
               SUM(CASE WHEN lower({$colEvent})='click' THEN 1 ELSE 0 END) AS clicks
        FROM ".DB_TABLE."
        WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)."
        GROUP BY substr({$colDatetime},1,10)
        ORDER BY day ASC
    ");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    if ($rows) {
        $hasEventSeries = true;
        // Align to $dailyDays if possible
        $map = [];
        foreach ($rows as $rr) $map[(string)($rr['day'] ?? '')] = $rr;
        foreach ($dailyDays as $d) {
            $dailyViews[]  = (int)($map[$d]['views']  ?? 0);
            $dailyClicks[] = (int)($map[$d]['clicks'] ?? 0);
        }
    }
}

// Hourly distribution
$hourly = array_fill(0, 24, 0);
$stmt = $pdo->query("
    SELECT strftime('%H', {$colDatetime}) AS hh, COUNT(*) AS n
    FROM ".DB_TABLE."
    WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)."
    GROUP BY hh ORDER BY hh ASC
");
foreach (($stmt->fetchAll(PDO::FETCH_ASSOC) ?: []) as $r) {
    $hh = (int)($r['hh'] ?? -1);
    if ($hh >= 0 && $hh <= 23) $hourly[$hh] = (int)($r['n'] ?? 0);
}

// Weekday distribution
$wdLabels = ['D','L','M','X','J','V','S']; // 0..6
$weekday = array_fill(0, 7, 0);
$stmt = $pdo->query("
    SELECT strftime('%w', {$colDatetime}) AS wd, COUNT(*) AS n
    FROM ".DB_TABLE."
    WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)."
    GROUP BY wd ORDER BY wd ASC
");
foreach (($stmt->fetchAll(PDO::FETCH_ASSOC) ?: []) as $r) {
    $wd = (int)($r['wd'] ?? -1);
    if ($wd >= 0 && $wd <= 6) $weekday[$wd] = (int)($r['n'] ?? 0);
}

// Top dimensions
$topBrowsers = [];
if ($colBrowser) {
    $stmt = $pdo->query("
        SELECT COALESCE(NULLIF({$colBrowser},''),'(unknown)') AS k, COUNT(*) AS n
        FROM ".DB_TABLE."
        WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)."
        GROUP BY k ORDER BY n DESC LIMIT 10
    ");
    $topBrowsers = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
}

$topOS = [];
if ($colOS) {
    $stmt = $pdo->query("
        SELECT COALESCE(NULLIF({$colOS},''),'(unknown)') AS k, COUNT(*) AS n
        FROM ".DB_TABLE."
        WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)."
        GROUP BY k ORDER BY n DESC LIMIT 10
    ");
    $topOS = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
}

$topDevices = [];
if ($colDevice) {
    $stmt = $pdo->query("
        SELECT COALESCE(NULLIF({$colDevice},''),'(unknown)') AS k, COUNT(*) AS n
        FROM ".DB_TABLE."
        WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)."
        GROUP BY k ORDER BY n DESC LIMIT 10
    ");
    $topDevices = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
}

$topMethods = [];
if ($colMethod) {
    $stmt = $pdo->query("
        SELECT COALESCE(NULLIF({$colMethod},''),'(unknown)') AS k, COUNT(*) AS n
        FROM ".DB_TABLE."
        WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)."
        GROUP BY k ORDER BY n DESC LIMIT 10
    ");
    $topMethods = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
}

$topURLs = [];
if ($colURL) {
    $stmt = $pdo->query("
        SELECT COALESCE(NULLIF({$colURL},''),'(unknown)') AS k, COUNT(*) AS n
        FROM ".DB_TABLE."
        WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)."
        GROUP BY k ORDER BY n DESC LIMIT 15
    ");
    $topURLs = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
}

$topReferers = [];
if ($colReferer) {
    $stmt = $pdo->query("
        SELECT COALESCE(NULLIF({$colReferer},''),'(directo)') AS k, COUNT(*) AS n
        FROM ".DB_TABLE."
        WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)."
        GROUP BY k ORDER BY n DESC LIMIT 15
    ");
    $topReferers = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
}

$topIPs = [];
if ($colIP) {
    $stmt = $pdo->query("
        SELECT COALESCE(NULLIF({$colIP},''),'(unknown)') AS k, COUNT(*) AS n
        FROM ".DB_TABLE."
        WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)."
        GROUP BY k ORDER BY n DESC LIMIT 10
    ");
    $topIPs = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
}

// Recent visits (dynamic select)
$selectCols = [$colDatetime . " AS datetime"];
if ($colIP) $selectCols[] = "{$colIP} AS ip";
if ($colBrowser) $selectCols[] = "{$colBrowser} AS browser";
if ($colOS) $selectCols[] = "{$colOS} AS os";
if ($colDevice) $selectCols[] = "{$colDevice} AS device";
if ($colIsBot) $selectCols[] = "{$colIsBot} AS is_bot";
if ($colIsMob) $selectCols[] = "{$colIsMob} AS is_mobile";
if ($colUA) $selectCols[] = "{$colUA} AS user_agent";
if ($colReferer) $selectCols[] = "{$colReferer} AS referer";
if ($colURL) $selectCols[] = "{$colURL} AS url";
if ($colMethod) $selectCols[] = "{$colMethod} AS method";
if ($colEvent) $selectCols[] = "{$colEvent} AS event";

$stmt = $pdo->query("
    SELECT ".implode(", ", $selectCols)."
    FROM ".DB_TABLE."
    ORDER BY {$colDatetime} DESC
    LIMIT 20
");
$recent = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

// KPI quick donuts (bot/mobile) use theme color via CSS currentColor
$botA = $botRange;
$botB = $humRange;

$mobA = $mobRange;
$mobB = $deskRange;

// Derived KPIs
$avgPerDay = ($days > 0) ? ($visitsRange / $days) : 0;
$botPctRange = pct($botRange, $humRange);
$mobPctRange = pct($mobRange, $deskRange);
$uniqPctRange = ($visitsRange > 0 && $colIP) ? (($uniqueIPsRange / $visitsRange) * 100.0) : 0.0;

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Jocarsa · Admin</title>
  <style>
    :root{
      --bg-body:#0b1220;
      --bg-app:#0f172a;
      --surface:rgba(255,255,255,.92);
      --border:rgba(15,23,42,.12);
      --shadow:0 12px 34px rgba(2,6,23,.14);
      --text:#0f172a;
      --muted:#64748b;
      --accent:#2563eb;
      --accent2:#1d4ed8;
      --ok:#10b981;
      --radius:16px;
    }
    *{box-sizing:border-box}
    body{
      margin:0;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;color:var(--text);
      background:
        radial-gradient(1000px 600px at 10% 0%, rgba(37,99,235,.30), rgba(37,99,235,0) 55%),
        radial-gradient(900px 650px at 90% 10%, rgba(16,185,129,.18), rgba(16,185,129,0) 55%),
        linear-gradient(180deg, var(--bg-body), var(--bg-app));
    }
    .admin-bar{
      height:48px;position:sticky;top:0;z-index:50;
      background:rgba(2,6,23,.78);backdrop-filter:blur(10px);
      border-bottom:1px solid rgba(148,163,184,.18);
      color:#e5e7eb;display:flex;align-items:center;justify-content:space-between;padding:0 18px;font-size:13px;
    }
    .admin-bar .brand{font-weight:900;letter-spacing:.10em;text-transform:uppercase;font-size:12px}
    .admin-bar a{color:#e5e7eb;text-decoration:none;opacity:.9}
    .admin-bar a:hover{opacity:1}

    .wrap{display:flex;min-height:calc(100vh - 48px)}
    .sidebar{
      width:240px;background:linear-gradient(180deg,#0b1220,#020617);
      border-right:1px solid rgba(148,163,184,.18);padding-top:14px;color:#94a3b8;
    }
    .sidebar h2{margin:0 0 6px;padding:0 16px 10px;color:#e5e7eb;opacity:.85;font-size:11px;letter-spacing:.14em;text-transform:uppercase}
    .sidebar a{
      display:flex;gap:10px;align-items:center;padding:10px 16px;font-size:13px;color:#94a3b8;text-decoration:none;border-left:3px solid transparent;
    }
    .sidebar a:hover{background:rgba(148,163,184,.10);color:#f8fafc}
    .sidebar a.active{background:rgba(37,99,235,.16);color:#f8fafc;border-left-color:#3b82f6}

    .content{flex:1;padding:22px 24px 44px}
    .inner{max-width:1180px;margin:0 auto}
    .inner::before{
      content:"";position:fixed;left:260px;top:48px;right:0;bottom:0;background:rgba(255,255,255,.80);z-index:-1;
    }
    h1{margin:0 0 10px;font-size:22px;font-weight:900}
    .sub{margin:0 0 18px;color:var(--muted);font-size:13px;line-height:1.4}

    .filters{
      display:flex;gap:8px;align-items:center;flex-wrap:wrap;
      background:rgba(255,255,255,.72);border:1px solid var(--border);padding:8px 10px;border-radius:14px;box-shadow:0 2px 10px rgba(2,6,23,.08);
    }
    .filters label{font-size:12px;color:var(--muted);font-weight:800}
    .filters select{padding:8px 10px;border-radius:12px;border:1px solid rgba(15,23,42,.16);background:rgba(255,255,255,.96)}

    .kpis{display:grid;grid-template-columns:repeat(12,1fr);gap:12px;margin:10px 0 16px}
    .kpi{
      grid-column:span 3;background:rgba(255,255,255,.94);border:1px solid var(--border);
      border-radius:var(--radius);padding:14px;box-shadow:var(--shadow);position:relative;overflow:hidden;
    }
    .kpi .label{margin:0 0 6px;color:var(--muted);font-size:12px;font-weight:900}
    .kpi .value{margin:0;font-size:22px;font-weight:950;font-variant-numeric:tabular-nums}
    .kpi .hint{margin:6px 0 0;color:#94a3b8;font-size:11px}
    .cards2{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .card{
      background:rgba(255,255,255,.94);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;
    }
    .card .head{padding:12px 14px;border-bottom:1px solid rgba(15,23,42,.08);display:flex;justify-content:space-between;align-items:center;
      background:linear-gradient(180deg, rgba(15,23,42,.03), rgba(15,23,42,.02));
    }
    .card .head h3{margin:0;font-size:13px;font-weight:950}
    .card .body{padding:12px 14px}
    .pill{display:inline-flex;gap:6px;align-items:center;padding:3px 10px;border-radius:999px;border:1px solid rgba(15,23,42,.14);
      font-size:11px;font-weight:900;color:#0f172a;background:rgba(255,255,255,.92)}
    .mono{font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;font-variant-numeric:tabular-nums}

    table{width:100%;border-collapse:separate;border-spacing:0;font-size:12.5px}
    th,td{padding:8px 9px;border-bottom:1px solid rgba(15,23,42,.08);vertical-align:top}
    th{color:var(--muted);font-size:12px;font-weight:950;text-align:left;background:transparent;position:sticky;top:0}
    tr:hover td{background:rgba(37,99,235,.06)}

    .rowgrid{display:grid;grid-template-columns:1fr 140px;gap:12px;align-items:center}
    .chart{color:var(--accent)}
    .muted{color:#94a3b8}
    .legend{display:flex;gap:10px;flex-wrap:wrap;margin-top:8px}
    .leg{display:flex;gap:6px;align-items:center;font-size:12px;color:var(--muted);font-weight:900}
    .dot{width:10px;height:10px;border-radius:99px;background:var(--accent)}
    .dot2{width:10px;height:10px;border-radius:99px;background:#0f172a;opacity:.9}

    @media (max-width:1100px){
      .kpi{grid-column:span 6}
      .cards2{grid-template-columns:1fr}
      .inner::before{left:0}
      .sidebar{width:210px}
    }
    @media (max-width:780px){
      .wrap{flex-direction:column}
      .sidebar{width:auto;border-right:0;border-bottom:1px solid rgba(148,163,184,.18)}
      .inner::before{top:96px;left:0}
    }
  </style>
</head>
<body>
  <div class="admin-bar">
    <div class="brand">Jocarsa · Admin</div>
    <div>
      <span class="muted">Conectado como <strong>jocarsa</strong> · </span>
      <a href="?action=logout">Cerrar sesión</a>
    </div>
  </div>

  <div class="wrap">
    <div class="sidebar">
      <h2>Menú</h2>
      <a class="active" href="?action=analytics">Analítica</a>
    </div>

    <div class="content">
      <div class="inner">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:12px;flex-wrap:wrap;margin-bottom:14px;">
          <div>
            <h1>Analítica</h1>
            <p class="sub">Rango: <strong><?php echo h(substr($fromDT,0,10)); ?></strong> → <strong><?php echo h(substr($toDT,0,10)); ?></strong> (últimos <?php echo (int)$days; ?> días).<br>
              Tabla: <span class="mono"><?php echo h(DB_TABLE); ?></span> · Fecha: <span class="mono"><?php echo h($colDatetime); ?></span>
            </p>
          </div>
          <form class="filters" method="get">
            <input type="hidden" name="action" value="analytics">
            <label for="days">Días</label>
            <select id="days" name="days">
              <?php foreach ([7,14,30,60,90,180,365] as $opt): ?>
                <option value="<?php echo (int)$opt; ?>" <?php echo ((int)$opt===(int)$days)?'selected':''; ?>><?php echo (int)$opt; ?></option>
              <?php endforeach; ?>
            </select>
            <button type="submit" style="padding:8px 12px;border-radius:12px;border:1px solid rgba(15,23,42,.18);background:rgba(255,255,255,.95);cursor:pointer;font-weight:900;">Actualizar</button>
          </form>
        </div>

        <div class="kpis">
          <div class="kpi">
            <p class="label">Visitas totales</p>
            <p class="value"><?php echo fmt_num($totalVisits); ?></p>
            <p class="hint">COUNT(*)</p>
          </div>
          <div class="kpi">
            <p class="label">Visitas hoy</p>
            <p class="value"><?php echo fmt_num($visitsToday); ?></p>
            <p class="hint"><?php echo h($today); ?></p>
          </div>
          <div class="kpi">
            <p class="label">Visitas en rango</p>
            <p class="value"><?php echo fmt_num($visitsRange); ?></p>
            <p class="hint">BETWEEN</p>
          </div>
          <div class="kpi">
            <p class="label">IPs únicas hoy</p>
            <p class="value"><?php echo $colIP ? fmt_num($uniqueIPsToday) : '—'; ?></p>
            <p class="hint"><?php echo $colIP ? ('Col: '.h($colIP)) : 'No existe columna IP'; ?></p>
          </div>
          <div class="kpi">
            <p class="label">IPs únicas en rango</p>
            <p class="value"><?php echo $colIP ? fmt_num($uniqueIPsRange) : '—'; ?></p>
            <p class="hint"><?php echo $colIP ? 'Aprox. por IP' : 'No existe columna IP'; ?></p>
          </div>
          <div class="kpi">
            <p class="label">Promedio / día</p>
            <p class="value"><?php echo fmt_num((int)round($avgPerDay)); ?></p>
            <p class="hint">visitasRange / días</p>
          </div>
          <div class="kpi">
            <p class="label">Bots (rango)</p>
            <p class="value"><?php echo fmt_num($botRange); ?></p>
            <p class="hint"><?php echo $colIsBot ? 'Col: '.h($colIsBot) : ($colUA ? 'Derivado de UA' : 'No se puede detectar'); ?></p>
          </div>
          <div class="kpi">
            <p class="label">Humanos (rango)</p>
            <p class="value"><?php echo fmt_num($humRange); ?></p>
            <p class="hint">range - bots</p>
          </div>
          <div class="kpi">
            <p class="label">Mobile (rango)</p>
            <p class="value"><?php echo fmt_num($mobRange); ?></p>
            <p class="hint"><?php echo $colIsMob ? 'Col: '.h($colIsMob) : ($colUA ? 'Derivado de UA' : 'No se puede detectar'); ?></p>
          </div>
          <div class="kpi">
            <p class="label">Desktop (rango)</p>
            <p class="value"><?php echo fmt_num($deskRange); ?></p>
            <p class="hint">range - mobile</p>
          </div>
          <div class="kpi">
            <p class="label">Esquema detectado</p>
            <p class="value"><span class="mono"><?php echo fmt_num(count($cols)); ?></span></p>
            <p class="hint">columnas en <?php echo h(DB_TABLE); ?></p>
          </div>
          <div class="kpi">
            <p class="label">Columna UA</p>
            <p class="value"><span class="mono"><?php echo $colUA ? h($colUA) : '—'; ?></span></p>
            <p class="hint"><?php echo $colUA ? 'OK' : 'No existe user_agent/ua'; ?></p>
          </div>
        </div>

        <div class="cards2">
          <div class="card">
            <div class="head">
              <h3>Actividad diaria (rango)</h3>
              <span class="pill">SVG</span>
            </div>
            <div class="body">
              <?php if (!$daily): ?>
                <div class="muted">Sin datos en el rango.</div>
              <?php else: ?>
                <div class="chart"><?php echo svg_barline($dailyVals, 520, 70); ?></div>
                <table>
                  <thead><tr><th style="width:120px;">Día</th><th style="width:90px;">Visitas</th><th style="width:90px;">Bots</th><th style="width:90px;">Humanos</th></tr></thead>
                  <tbody>
                    <?php foreach ($daily as $r): ?>
                      <?php
                        $n = (int)($r['n'] ?? 0);
                        $b = (int)($r['bots'] ?? 0);
                        $hN = max(0, $n - $b);
                      ?>
                      <tr>
                        <td class="mono"><?php echo h($r['day'] ?? ''); ?></td>
                        <td class="mono"><?php echo fmt_num($n); ?></td>
                        <td class="mono"><?php echo fmt_num($b); ?></td>
                        <td class="mono"><?php echo fmt_num($hN); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              <?php endif; ?>
            </div>
          </div>

          <div class="card">
            <div class="head">
              <h3>Gauges (rango)</h3>
              <span class="pill">SVG</span>
            </div>
            <div class="body">
              <div class="muted" style="font-size:12px;font-weight:950;margin-bottom:6px;">% Bots</div>
              <div class="chart"><?php echo svg_gauge($botPctRange, 520, 90); ?></div>

              <div style="height:10px"></div>

              <div class="muted" style="font-size:12px;font-weight:950;margin-bottom:6px;">% Mobile</div>
              <div class="chart"><?php echo svg_gauge($mobPctRange, 520, 90); ?></div>

              <div style="height:10px"></div>

              <div class="muted" style="font-size:12px;font-weight:950;margin-bottom:6px;">% IPs únicas / visitas (aprox.)</div>
              <div class="chart"><?php echo $colIP ? svg_gauge($uniqPctRange, 520, 90) : "<div class='muted'>No existe columna IP.</div>"; ?></div>
            </div>
          </div>
        </div>

        <div style="height:12px"></div>

        <div class="cards2">
          <div class="card">
            <div class="head"><h3>Bot vs Human (serie temporal)</h3><span class="pill">líneas</span></div>
            <div class="body">
              <?php if (!$daily): ?>
                <div class="muted">Sin datos.</div>
              <?php else: ?>
                <div class="chart"><?php echo svg_lines([
                    ['values'=>$dailyHuman, 'opacity'=>0.75, 'width'=>3],
                    ['values'=>$dailyBots,  'opacity'=>0.85, 'width'=>3],
                ], 520, 120); ?></div>
                <div class="legend">
                  <div class="leg"><span class="dot2"></span> Humanos</div>
                  <div class="leg"><span class="dot"></span> Bots</div>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="card">
            <div class="head"><h3>Mobile vs Desktop (serie temporal)</h3><span class="pill">líneas</span></div>
            <div class="body">
              <?php if (!$daily): ?>
                <div class="muted">Sin datos.</div>
              <?php else: ?>
                <div class="chart"><?php echo svg_lines([
                    ['values'=>$dailyDesk, 'opacity'=>0.75, 'width'=>3],
                    ['values'=>$dailyMob,  'opacity'=>0.85, 'width'=>3],
                ], 520, 120); ?></div>
                <div class="legend">
                  <div class="leg"><span class="dot2"></span> Desktop</div>
                  <div class="leg"><span class="dot"></span> Mobile</div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <?php if ($hasEventSeries): ?>
        <div style="height:12px"></div>
        <div class="cards2">
          <div class="card">
            <div class="head"><h3>Views vs Clicks (serie temporal)</h3><span class="pill mono"><?php echo h($colEvent); ?></span></div>
            <div class="body">
              <div class="chart"><?php echo svg_lines([
                  ['values'=>$dailyViews,  'opacity'=>0.75, 'width'=>3],
                  ['values'=>$dailyClicks, 'opacity'=>0.85, 'width'=>3],
              ], 520, 120); ?></div>
              <div class="legend">
                <div class="leg"><span class="dot2"></span> views</div>
                <div class="leg"><span class="dot"></span> clicks</div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="head"><h3>Resumen eventos (rango)</h3><span class="pill">auto</span></div>
            <div class="body">
              <?php
                $stmt = $pdo->query("
                  SELECT COALESCE(NULLIF(lower({$colEvent}),''),'(unknown)') AS k, COUNT(*) AS n
                  FROM ".DB_TABLE."
                  WHERE {$colDatetime} BETWEEN ".$pdo->quote($fromDT)." AND ".$pdo->quote($toDT)."
                  GROUP BY k ORDER BY n DESC LIMIT 12
                ");
                $topEvents = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
              ?>
              <?php if (!$topEvents): ?>
                <div class="muted">Sin datos.</div>
              <?php else: ?>
                <table>
                  <thead><tr><th>Evento</th><th style="width:90px;">#</th></tr></thead>
                  <tbody>
                    <?php foreach ($topEvents as $r): ?>
                      <tr>
                        <td class="mono"><?php echo h($r['k'] ?? ''); ?></td>
                        <td class="mono"><?php echo fmt_num($r['n'] ?? 0); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <div style="height:12px"></div>

        <div class="cards2">
          <div class="card">
            <div class="head"><h3>Distribución por hora</h3><span class="pill mono"><?php echo (int)$days; ?>d</span></div>
            <div class="body">
              <div class="chart"><?php echo svg_barline($hourly, 520, 70); ?></div>
              <table>
                <thead><tr><th style="width:70px;">Hora</th><th style="width:90px;">#</th></tr></thead>
                <tbody>
                  <?php for ($i=0;$i<24;$i++): ?>
                    <tr><td class="mono"><?php echo str_pad((string)$i,2,'0',STR_PAD_LEFT); ?>h</td><td class="mono"><?php echo fmt_num($hourly[$i]); ?></td></tr>
                  <?php endfor; ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="card">
            <div class="head"><h3>Día de la semana</h3><span class="pill mono"><?php echo (int)$days; ?>d</span></div>
            <div class="body">
              <table>
                <thead><tr><th style="width:70px;">Día</th><th style="width:90px;">#</th></tr></thead>
                <tbody>
                  <?php for ($i=0;$i<7;$i++): ?>
                    <tr><td class="mono"><?php echo h($wdLabels[$i]); ?></td><td class="mono"><?php echo fmt_num($weekday[$i]); ?></td></tr>
                  <?php endfor; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div style="height:12px"></div>

        <div class="cards2">
          <div class="card">
            <div class="head"><h3>Bot / Mobile (rango)</h3><span class="pill">donuts</span></div>
            <div class="body">
              <div class="rowgrid">
                <div>
                  <div class="muted" style="font-size:12px;font-weight:900;margin-bottom:6px;">Bot traffic</div>
                  <div class="mono" style="font-size:14px;font-weight:900;margin-bottom:8px;">
                    Bot: <?php echo fmt_num($botA); ?> · Humano: <?php echo fmt_num($botB); ?>
                  </div>
                  <div class="muted" style="font-size:12px;">Fuente: <?php echo $colIsBot ? 'columna is_bot' : ($colUA ? 'derivado de UA' : 'N/A'); ?></div>
                </div>
                <div class="chart" style="display:flex;justify-content:flex-end;">
                  <?php echo svg_donut($botA, $botB, 120, 16); ?>
                </div>
              </div>

              <div style="height:12px"></div>

              <div class="rowgrid">
                <div>
                  <div class="muted" style="font-size:12px;font-weight:900;margin-bottom:6px;">Mobile traffic</div>
                  <div class="mono" style="font-size:14px;font-weight:900;margin-bottom:8px;">
                    Mobile: <?php echo fmt_num($mobA); ?> · Desktop: <?php echo fmt_num($mobB); ?>
                  </div>
                  <div class="muted" style="font-size:12px;">Fuente: <?php echo $colIsMob ? 'columna is_mobile' : ($colUA ? 'derivado de UA' : 'N/A'); ?></div>
                </div>
                <div class="chart" style="display:flex;justify-content:flex-end;">
                  <?php echo svg_donut($mobA, $mobB, 120, 16); ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="head"><h3>Top dimensiones (rango)</h3><span class="pill">auto</span></div>
            <div class="body">
              <?php
                $blocks = [
                  ['Browsers', $colBrowser, $topBrowsers],
                  ['OS',       $colOS,      $topOS],
                  ['Devices',  $colDevice,  $topDevices],
                  ['Methods',  $colMethod,  $topMethods],
                  ['IPs',      $colIP,      $topIPs],
                ];
              ?>
              <?php foreach ($blocks as [$label, $col, $rows]): ?>
                <div style="margin-bottom:12px;">
                  <div class="muted" style="font-size:12px;font-weight:950;margin-bottom:6px;">
                    <?php echo h($label); ?> <?php echo $col ? ('· <span class="mono">'.h($col).'</span>') : '· (no disponible)'; ?>
                  </div>
                  <?php if (!$col): ?>
                    <div class="muted">No se puede calcular (falta columna).</div>
                  <?php elseif (!$rows): ?>
                    <div class="muted">Sin datos.</div>
                  <?php else: ?>
                    <table>
                      <thead><tr><th>Valor</th><th style="width:90px;">#</th></tr></thead>
                      <tbody>
                        <?php foreach ($rows as $r): ?>
                          <tr>
                            <td title="<?php echo h($r['k'] ?? ''); ?>"><?php echo h(safe_str_limit($r['k'] ?? '', 60)); ?></td>
                            <td class="mono"><?php echo fmt_num($r['n'] ?? 0); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <div style="height:12px"></div>

        <div class="cards2">
          <div class="card">
            <div class="head"><h3>Top URLs / Referers (rango)</h3><span class="pill">auto</span></div>
            <div class="body">
              <div style="margin-bottom:12px;">
                <div class="muted" style="font-size:12px;font-weight:950;margin-bottom:6px;">
                  URL/URI <?php echo $colURL ? ('· <span class="mono">'.h($colURL).'</span>') : '· (no disponible)'; ?>
                </div>
                <?php if (!$colURL): ?>
                  <div class="muted">No existe columna url/uri/path/request_uri.</div>
                <?php elseif (!$topURLs): ?>
                  <div class="muted">Sin datos.</div>
                <?php else: ?>
                  <table>
                    <thead><tr><th>URL</th><th style="width:90px;">#</th></tr></thead>
                    <tbody>
                      <?php foreach ($topURLs as $r): ?>
                        <tr>
                          <td title="<?php echo h($r['k'] ?? ''); ?>"><?php echo h(safe_str_limit($r['k'] ?? '', 60)); ?></td>
                          <td class="mono"><?php echo fmt_num($r['n'] ?? 0); ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                <?php endif; ?>
              </div>

              <div>
                <div class="muted" style="font-size:12px;font-weight:950;margin-bottom:6px;">
                  Referer <?php echo $colReferer ? ('· <span class="mono">'.h($colReferer).'</span>') : '· (no disponible)'; ?>
                </div>
                <?php if (!$colReferer): ?>
                  <div class="muted">No existe columna referer/referrer.</div>
                <?php elseif (!$topReferers): ?>
                  <div class="muted">Sin datos.</div>
                <?php else: ?>
                  <table>
                    <thead><tr><th>Referer</th><th style="width:90px;">#</th></tr></thead>
                    <tbody>
                      <?php foreach ($topReferers as $r): ?>
                        <tr>
                          <td title="<?php echo h($r['k'] ?? ''); ?>"><?php echo h(safe_str_limit($r['k'] ?? '', 60)); ?></td>
                          <td class="mono"><?php echo fmt_num($r['n'] ?? 0); ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="head"><h3>Visitas recientes</h3><span class="pill mono">últimas <?php echo fmt_num(count($recent)); ?></span></div>
            <div class="body">
              <?php if (!$recent): ?>
                <div class="muted">Sin datos.</div>
              <?php else: ?>
                <table>
                  <thead>
                    <tr>
                      <th style="width:170px;">Datetime</th>
                      <?php if ($colIP): ?><th style="width:140px;">IP</th><?php endif; ?>
                      <?php if ($colMethod): ?><th style="width:70px;">M</th><?php endif; ?>
                      <?php if ($colEvent): ?><th style="width:90px;">Event</th><?php endif; ?>
                      <?php if ($colBrowser): ?><th style="width:120px;">Browser</th><?php endif; ?>
                      <?php if ($colOS): ?><th style="width:120px;">OS</th><?php endif; ?>
                      <?php if ($colDevice): ?><th style="width:120px;">Device</th><?php endif; ?>
                      <?php if ($colIsBot || $colUA): ?><th style="width:70px;">Bot</th><?php endif; ?>
                      <?php if ($colIsMob || $colUA): ?><th style="width:70px;">Mobile</th><?php endif; ?>
                      <?php if ($colReferer): ?><th>Referer</th><?php endif; ?>
                      <?php if ($colURL): ?><th>URL</th><?php endif; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($recent as $r): ?>
                      <?php
                        $uaStr = (string)($r['user_agent'] ?? '');
                        $isBotDerived = false;
                        $isMobDerived = false;
                        if (!$colIsBot && $colUA && $uaStr !== '') {
                            $lua = strtolower($uaStr);
                            $isBotDerived = (strpos($lua,'bot')!==false || strpos($lua,'crawl')!==false || strpos($lua,'spider')!==false || strpos($lua,'slurp')!==false);
                        }
                        if (!$colIsMob && $colUA && $uaStr !== '') {
                            $lua = strtolower($uaStr);
                            $isMobDerived = (strpos($lua,'mobi')!==false || strpos($lua,'android')!==false || strpos($lua,'iphone')!==false || strpos($lua,'ipad')!==false);
                        }
                      ?>
                      <tr>
                        <td class="mono"><?php echo h($r['datetime'] ?? ''); ?></td>
                        <?php if ($colIP): ?><td class="mono"><?php echo h($r['ip'] ?? ''); ?></td><?php endif; ?>
                        <?php if ($colMethod): ?><td class="mono"><?php echo h($r['method'] ?? ''); ?></td><?php endif; ?>
                        <?php if ($colEvent): ?><td class="mono"><?php echo h($r['event'] ?? ''); ?></td><?php endif; ?>
                        <?php if ($colBrowser): ?><td><?php echo h($r['browser'] ?? ''); ?></td><?php endif; ?>
                        <?php if ($colOS): ?><td><?php echo h($r['os'] ?? ''); ?></td><?php endif; ?>
                        <?php if ($colDevice): ?><td><?php echo h($r['device'] ?? ''); ?></td><?php endif; ?>
                        <?php if ($colIsBot || $colUA): ?>
                          <td><?php echo $colIsBot ? (!empty($r['is_bot']) ? 'Sí' : 'No') : ($isBotDerived ? 'Sí' : 'No'); ?></td>
                        <?php endif; ?>
                        <?php if ($colIsMob || $colUA): ?>
                          <td><?php echo $colIsMob ? (!empty($r['is_mobile']) ? 'Sí' : 'No') : ($isMobDerived ? 'Sí' : 'No'); ?></td>
                        <?php endif; ?>
                        <?php if ($colReferer): ?><td title="<?php echo h($r['referer'] ?? ''); ?>"><?php echo h(safe_str_limit($r['referer'] ?? '(directo)', 70)); ?></td><?php endif; ?>
                        <?php if ($colURL): ?><td title="<?php echo h($r['url'] ?? ''); ?>"><?php echo h(safe_str_limit($r['url'] ?? '', 70)); ?></td><?php endif; ?>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              <?php endif; ?>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</body>
</html>

