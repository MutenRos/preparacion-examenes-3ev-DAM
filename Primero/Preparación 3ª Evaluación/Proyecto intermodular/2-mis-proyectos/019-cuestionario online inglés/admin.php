<?php
declare(strict_types=1);

session_start();
mb_internal_encoding('UTF-8');
date_default_timezone_set('Europe/Madrid');

/* =========================================================
   CONFIG
========================================================= */
$dbFile = __DIR__ . "/test_nivel.sqlite";
$adminUser = "jocarsa";
$adminPass = "jocarsa";

/* =========================================================
   HELPERS
========================================================= */
function h(?string $value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function conectarDb(string $dbFile): PDO
{
    $pdo = new PDO('sqlite:' . $dbFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec('PRAGMA foreign_keys = ON');
    return $pdo;
}

function adminLogueado(): bool
{
    return !empty($_SESSION['admin_logged_in']);
}

function obtenerNivelBadgeClase(string $nivel): string
{
    return match ($nivel) {
        'A1' => 'nivel-a1',
        'A2' => 'nivel-a2',
        'B1' => 'nivel-b1',
        'B2' => 'nivel-b2',
        'C1' => 'nivel-c1',
        default => 'nivel-default',
    };
}

function buildSortLink(string $column, string $currentSort, string $currentDir, array $query): string
{
    $dir = 'asc';
    if ($currentSort === $column && strtolower($currentDir) === 'asc') {
        $dir = 'desc';
    }

    $query['sort'] = $column;
    $query['dir'] = $dir;
    return '?' . http_build_query($query);
}

function sortArrow(string $column, string $currentSort, string $currentDir): string
{
    if ($currentSort !== $column) {
        return '';
    }
    return strtolower($currentDir) === 'asc' ? ' ▲' : ' ▼';
}

/* =========================================================
   INIT
========================================================= */
$error = '';
$pdo = null;

try {
    $pdo = conectarDb($dbFile);
} catch (Throwable $e) {
    $error = "No se ha podido abrir la base de datos: " . $e->getMessage();
}

/* =========================================================
   LOGOUT
========================================================= */
if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
    header("Location: admin.php");
    exit;
}

/* =========================================================
   LOGIN
========================================================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_action'])) {
    $user = trim((string)($_POST['username'] ?? ''));
    $pass = trim((string)($_POST['password'] ?? ''));

    if ($user === $adminUser && $pass === $adminPass) {
        $_SESSION['admin_logged_in'] = 1;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}

/* =========================================================
   PROTECTED AREA
========================================================= */
$view = $_GET['view'] ?? 'list';

$allowedSort = [
    'id' => 'i.id',
    'nombre' => 'i.nombre',
    'email' => 'i.email',
    'telefono' => 'i.telefono',
    'curso_interesado' => 'i.curso_interesado',
    'puntos' => 'i.puntos',
    'nivel' => 'i.nivel',
    'total_preguntas' => 'i.total_preguntas',
    'fecha_creacion' => 'i.fecha_creacion',
];

$sort = $_GET['sort'] ?? 'fecha_creacion';
$dir = strtolower($_GET['dir'] ?? 'desc');
if (!isset($allowedSort[$sort])) {
    $sort = 'fecha_creacion';
}
if (!in_array($dir, ['asc', 'desc'], true)) {
    $dir = 'desc';
}

$filtroId = trim((string)($_GET['f_id'] ?? ''));
$filtroNombre = trim((string)($_GET['f_nombre'] ?? ''));
$filtroEmail = trim((string)($_GET['f_email'] ?? ''));
$filtroTelefono = trim((string)($_GET['f_telefono'] ?? ''));
$filtroCurso = trim((string)($_GET['f_curso'] ?? ''));
$filtroNivel = trim((string)($_GET['f_nivel'] ?? ''));
$filtroPuntosMin = trim((string)($_GET['f_puntos_min'] ?? ''));
$filtroPuntosMax = trim((string)($_GET['f_puntos_max'] ?? ''));
$filtroFechaDesde = trim((string)($_GET['f_fecha_desde'] ?? ''));
$filtroFechaHasta = trim((string)($_GET['f_fecha_hasta'] ?? ''));

$intentos = [];
$detalleIntento = null;
$respuestasIntento = [];
$queryParamsForLinks = $_GET;
unset($queryParamsForLinks['sort'], $queryParamsForLinks['dir']);

if (adminLogueado() && $pdo instanceof PDO && $error === '') {
    if ($view === 'report') {
        $id = (int)($_GET['id'] ?? 0);

        if ($id > 0) {
            $stmt = $pdo->prepare("SELECT * FROM intentos WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $detalleIntento = $stmt->fetch();

            if ($detalleIntento) {
                $stmtRes = $pdo->prepare("
                    SELECT *
                    FROM respuestas
                    WHERE intento_id = :id
                    ORDER BY numero_pregunta ASC
                ");
                $stmtRes->execute([':id' => $id]);
                $respuestasIntento = $stmtRes->fetchAll();
            } else {
                $error = "No se ha encontrado el intento solicitado.";
            }
        } else {
            $error = "Identificador de intento no válido.";
        }
    } else {
        $where = [];
        $params = [];

        if ($filtroId !== '' && ctype_digit($filtroId)) {
            $where[] = 'i.id = :id';
            $params[':id'] = (int)$filtroId;
        }

        if ($filtroNombre !== '') {
            $where[] = 'i.nombre LIKE :nombre';
            $params[':nombre'] = '%' . $filtroNombre . '%';
        }

        if ($filtroEmail !== '') {
            $where[] = 'i.email LIKE :email';
            $params[':email'] = '%' . $filtroEmail . '%';
        }

        if ($filtroTelefono !== '') {
            $where[] = 'i.telefono LIKE :telefono';
            $params[':telefono'] = '%' . $filtroTelefono . '%';
        }

        if ($filtroCurso !== '') {
            $where[] = 'i.curso_interesado LIKE :curso';
            $params[':curso'] = '%' . $filtroCurso . '%';
        }

        if ($filtroNivel !== '') {
            $where[] = 'i.nivel = :nivel';
            $params[':nivel'] = $filtroNivel;
        }

        if ($filtroPuntosMin !== '' && is_numeric($filtroPuntosMin)) {
            $where[] = 'i.puntos >= :puntos_min';
            $params[':puntos_min'] = (int)$filtroPuntosMin;
        }

        if ($filtroPuntosMax !== '' && is_numeric($filtroPuntosMax)) {
            $where[] = 'i.puntos <= :puntos_max';
            $params[':puntos_max'] = (int)$filtroPuntosMax;
        }

        if ($filtroFechaDesde !== '') {
            $where[] = 'date(i.fecha_creacion) >= :fecha_desde';
            $params[':fecha_desde'] = $filtroFechaDesde;
        }

        if ($filtroFechaHasta !== '') {
            $where[] = 'date(i.fecha_creacion) <= :fecha_hasta';
            $params[':fecha_hasta'] = $filtroFechaHasta;
        }

        $sql = "SELECT i.* FROM intentos i";
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }
        $sql .= " ORDER BY " . $allowedSort[$sort] . " " . strtoupper($dir);

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $intentos = $stmt->fetchAll();
    }
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin · Test de nivel</title>
<style>
:root{
    --wp-bg:#f0f0f1;
    --wp-surface:#ffffff;
    --wp-border:#dcdcde;
    --wp-text:#1d2327;
    --wp-muted:#50575e;
    --wp-link:#2271b1;
    --wp-link-hover:#135e96;
    --wp-button:#2271b1;
    --wp-button-hover:#135e96;
    --wp-sidebar:#1d2327;
    --wp-sidebar-2:#2c3338;
    --wp-sidebar-text:#f0f0f1;
    --wp-header:#ffffff;
    --wp-success-bg:#edfaef;
    --wp-success-border:#72aee6;
    --wp-error-bg:#fcf0f1;
    --wp-error-border:#d63638;
    --radius:4px;
}

*{
    box-sizing:border-box;
}

html,body{
    margin:0;
    padding:0;
    font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
    background:var(--wp-bg);
    color:var(--wp-text);
}

body{
    min-height:100vh;
}

a{
    color:var(--wp-link);
    text-decoration:none;
}
a:hover{
    color:var(--wp-link-hover);
}

.header{
    height:56px;
    background:var(--wp-sidebar);
    color:white;
    border-bottom:1px solid var(--wp-border);
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 18px;
    position:sticky;
    top:0;
    z-index:50;
}

.header-left{
    display:flex;
    align-items:center;
    gap:14px;
}

.brand{
    font-size:18px;
    font-weight:600;
  
}

.header-subtitle{
   
    font-size:13px;
}

.header-right{
    display:flex;
    align-items:center;
    gap:10px;
}

.btn,
button,
input[type="submit"]{
    appearance:none;
    border:1px solid var(--wp-button);
    
    
    padding:8px 14px;
    border-radius:var(--radius);
    font-size:13px;
    font-weight:500;
    cursor:pointer;
    line-height:1.6;
}

.btn:hover,
button:hover,
input[type="submit"]:hover{
    background:var(--wp-button-hover);
    border-color:var(--wp-button-hover);
    color:#fff;
}

.btn-secondary{
    background:#f6f7f7;
    color:var(--wp-text);
    border:1px solid #c3c4c7;
}

.btn-secondary:hover{
    background:#f0f0f1;
    border-color:#8c8f94;
    color:var(--wp-text);
}

.btn-danger{
    background:#b32d2e;
    border-color:#b32d2e;
}

.btn-danger:hover{
    background:#8a2424;
    border-color:#8a2424;
}

.layout{
    display:flex;
    min-height:calc(100vh - 56px);
}

.sidebar{
    width:320px;
    background:var(--wp-sidebar);
    color:var(--wp-sidebar-text);
    padding:20px;
    border-right:1px solid #101517;
}

.sidebar h2{
    margin:0 0 18px 0;
    font-size:18px;
    font-weight:600;
    color:#fff;
}

.sidebar .section-title{
    margin:0 0 12px 0;
    font-size:13px;
    text-transform:uppercase;
    letter-spacing:.03em;
    color:#9ea7af;
    font-weight:700;
}

.sidebar .form-group{
    margin-bottom:14px;
}

.sidebar label{
    display:block;
    font-size:12px;
    font-weight:600;
    margin-bottom:6px;
    color:#dcdcde;
}

.sidebar input[type="text"],
.sidebar input[type="date"],
.sidebar select,
.login-card input[type="text"],
.login-card input[type="password"]{
    width:100%;
    min-height:38px;
    border:1px solid #8c8f94;
   background:#3d3d3d;
    color:white;
    border-radius:var(--radius);
    padding:8px 10px;
    font-size:13px;
}

.sidebar input:focus,
.sidebar select:focus,
.login-card input:focus{
    outline:2px solid #72aee6;
    outline-offset:0;
    border-color:#2271b1;
}

.sidebar .actions{
    display:flex;
    flex-wrap:wrap;
    gap:8px;
    margin-top:16px;
}

.main{
    flex:1;
    padding:20px;
    background:var(--wp-bg);
}

.page-title{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:14px;
    margin-bottom:16px;
    flex-wrap:wrap;
}

.page-title h1{
    margin:0;
    font-size:23px;
    font-weight:400;
}

.panel{
    background:var(--wp-surface);
    border:1px solid var(--wp-border);
    border-radius:var(--radius);
}

.panel-header{
    padding:14px 16px;
    border-bottom:1px solid var(--wp-border);
    background:#fff;
    font-size:14px;
    font-weight:600;
}

.panel-body{
    padding:16px;
}

.notice{
    margin-bottom:16px;
    border-left:4px solid;
    background:#fff;
    padding:12px 14px;
    box-shadow:0 1px 1px rgba(0,0,0,.04);
}

.notice-error{
    border-left-color:var(--wp-error-border);
    background:var(--wp-error-bg);
}

.notice-success{
    border-left-color:#00a32a;
    background:var(--wp-success-bg);
}

.table-wrap{
    overflow:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:13px;
}

thead th{
    text-align:left;
    padding:10px 12px;
    border-bottom:1px solid var(--wp-border);
    background:#f6f7f7;
    white-space:nowrap;
    position:sticky;
    top:0;
    z-index:2;
}

tbody td{
    padding:10px 12px;
    border-bottom:1px solid var(--wp-border);
    vertical-align:top;
    background:#fff;
}

tbody tr:nth-child(even) td{
    background:#fcfcfc;
}

tbody tr:hover td{
    background:#f6f7f7;
}

.sort-link{
    color:var(--wp-text);
    font-weight:600;
}

.badge{
    display:inline-block;
    padding:4px 8px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
    border:1px solid transparent;
}

.nivel-a1{ background:#fbeaea; color:#8a2424; border-color:#efc1c1; }
.nivel-a2{ background:#fff1e6; color:#8a4b08; border-color:#f1c79e; }
.nivel-b1{ background:#fff8e1; color:#7a5b00; border-color:#ebd57a; }
.nivel-b2{ background:#edf7ed; color:#0f6b2b; border-color:#abd4b0; }
.nivel-c1{ background:#eef4ff; color:#1d4f91; border-color:#afc7ec; }
.nivel-default{ background:#f0f0f1; color:#50575e; border-color:#dcdcde; }

.small{
    font-size:12px;
    color:var(--wp-muted);
}

.actions-cell{
    display:flex;
    flex-wrap:wrap;
    gap:8px;
}

.report-meta{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:12px;
    margin-bottom:18px;
}

.meta-box{
    border:1px solid var(--wp-border);
    background:#fff;
    padding:12px;
    border-radius:var(--radius);
}

.meta-label{
    font-size:11px;
    text-transform:uppercase;
    letter-spacing:.03em;
    color:var(--wp-muted);
    margin-bottom:6px;
    font-weight:700;
}

.meta-value{
    font-size:14px;
    font-weight:600;
    line-height:1.5;
}

.question-report{
    border:1px solid var(--wp-border);
    background:#fff;
    padding:14px;
    margin-bottom:12px;
    border-radius:var(--radius);
}

.question-report.correct{
    border-left:4px solid #00a32a;
}

.question-report.incorrect{
    border-left:4px solid #d63638;
}

.question-title{
    font-size:15px;
    font-weight:600;
    margin-bottom:10px;
    line-height:1.5;
}

.report-row{
    font-size:13px;
    line-height:1.7;
    color:var(--wp-text);
}

.login-page{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
    background:var(--wp-bg);
}

.login-card{
    width:100%;
    max-width:420px;
    background:#fff;
    border:1px solid var(--wp-border);
    padding:26px;
    border-radius:var(--radius);
    box-shadow:0 1px 3px rgba(0,0,0,.04);
}

.login-card h1{
    margin:0 0 6px 0;
    font-size:24px;
    font-weight:400;
}

.login-card p{
    margin:0 0 18px 0;
    color:var(--wp-muted);
    font-size:14px;
}

.login-card .form-group{
    margin-bottom:14px;
}

.login-card label{
    display:block;
    margin-bottom:6px;
    font-size:13px;
    font-weight:600;
}

.report-tools{
    display:flex;
    gap:8px;
    flex-wrap:wrap;
    margin-bottom:16px;
}

.mobile-sidebar-toggle{
    display:none;
}

@media (max-width: 980px){
    .layout{
        flex-direction:column;
    }

    .sidebar{
        width:100%;
        border-right:none;
        border-bottom:1px solid #101517;
    }

    .report-meta{
        grid-template-columns:1fr;
    }
}

@media (max-width: 640px){
    .header{
        height:auto;
        padding:12px 14px;
        align-items:flex-start;
        flex-direction:column;
    }

    .main,
    .sidebar{
        padding:14px;
    }

    .page-title{
        align-items:flex-start;
        flex-direction:column;
    }
}

/* PRINT */
@media print{
    .header,
    .sidebar,
    .page-title,
    .report-tools,
    .no-print{
        display:none !important;
    }

    html,body{
        background:#fff !important;
    }

    .layout,
    .main{
        display:block !important;
        padding:0 !important;
        margin:0 !important;
        background:#fff !important;
    }

    .panel,
    .panel-body{
        border:none !important;
        padding:0 !important;
        box-shadow:none !important;
    }

    .report-meta{
        grid-template-columns:repeat(2,1fr) !important;
    }

    .meta-box,
    .question-report{
        break-inside:avoid;
        page-break-inside:avoid;
    }

    @page{
        size:A4;
        margin:12mm;
    }
}
</style>
</head>
<body>

<?php if (!adminLogueado()): ?>
    <div class="login-page">
        <div class="login-card">
            <h1>Admin login</h1>
            <p>Accede al panel de administración del test.</p>

            <?php if ($error !== ''): ?>
                <div class="notice notice-error"><?php echo h($error); ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <input type="hidden" name="login_action" value="1">

                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div style="margin-top:16px;">
                    <button type="submit">Entrar</button>
                </div>
            </form>
        </div>
    </div>
<?php else: ?>
    <div class="header">
        <div class="header-left">
            <div class="brand">Test de nivel · Administración</div>
            <div class="header-subtitle">Panel de intentos e informes</div>
        </div>
        <div class="header-right no-print">
            <a class="btn btn-secondary" href="admin.php">Listado</a>
            <a class="btn btn-danger" href="admin.php?logout=1">Salir</a>
        </div>
    </div>

    <div class="layout">
        <?php if ($view !== 'report'): ?>
        <aside class="sidebar no-print">
            <h2>Filtros</h2>
            <div class="section-title">Búsqueda multicriterio</div>

            <form method="get" action="">
                <div class="form-group">
                    <label for="f_id">ID</label>
                    <input type="text" id="f_id" name="f_id" value="<?php echo h($filtroId); ?>">
                </div>

                <div class="form-group">
                    <label for="f_nombre">Nombre</label>
                    <input type="text" id="f_nombre" name="f_nombre" value="<?php echo h($filtroNombre); ?>">
                </div>

                <div class="form-group">
                    <label for="f_email">Email</label>
                    <input type="text" id="f_email" name="f_email" value="<?php echo h($filtroEmail); ?>">
                </div>

                <div class="form-group">
                    <label for="f_telefono">Teléfono</label>
                    <input type="text" id="f_telefono" name="f_telefono" value="<?php echo h($filtroTelefono); ?>">
                </div>

                <div class="form-group">
                    <label for="f_curso">Curso</label>
                    <input type="text" id="f_curso" name="f_curso" value="<?php echo h($filtroCurso); ?>">
                </div>

                <div class="form-group">
                    <label for="f_nivel">Nivel</label>
                    <select id="f_nivel" name="f_nivel">
                        <option value="">Todos</option>
                        <option value="A1" <?php echo $filtroNivel === 'A1' ? 'selected' : ''; ?>>A1</option>
                        <option value="A2" <?php echo $filtroNivel === 'A2' ? 'selected' : ''; ?>>A2</option>
                        <option value="B1" <?php echo $filtroNivel === 'B1' ? 'selected' : ''; ?>>B1</option>
                        <option value="B2" <?php echo $filtroNivel === 'B2' ? 'selected' : ''; ?>>B2</option>
                        <option value="C1" <?php echo $filtroNivel === 'C1' ? 'selected' : ''; ?>>C1</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="f_puntos_min">Puntos mínimos</label>
                    <input type="text" id="f_puntos_min" name="f_puntos_min" value="<?php echo h($filtroPuntosMin); ?>">
                </div>

                <div class="form-group">
                    <label for="f_puntos_max">Puntos máximos</label>
                    <input type="text" id="f_puntos_max" name="f_puntos_max" value="<?php echo h($filtroPuntosMax); ?>">
                </div>

                <div class="form-group">
                    <label for="f_fecha_desde">Fecha desde</label>
                    <input type="date" id="f_fecha_desde" name="f_fecha_desde" value="<?php echo h($filtroFechaDesde); ?>">
                </div>

                <div class="form-group">
                    <label for="f_fecha_hasta">Fecha hasta</label>
                    <input type="date" id="f_fecha_hasta" name="f_fecha_hasta" value="<?php echo h($filtroFechaHasta); ?>">
                </div>

                <div class="actions">
                    <button type="submit">Buscar</button>
                    <a class="btn btn-secondary" href="admin.php">Limpiar</a>
                </div>
            </form>
        </aside>
        <?php endif; ?>

        <main class="main">
            <?php if ($error !== ''): ?>
                <div class="notice notice-error"><?php echo h($error); ?></div>
            <?php endif; ?>

            <?php if ($view === 'report' && $detalleIntento): ?>
                <div class="page-title">
                    <h1>Informe del intento #<?php echo h((string)$detalleIntento['id']); ?></h1>
                </div>

                <div class="report-tools no-print">
                    <a class="btn btn-secondary" href="admin.php">Volver al listado</a>
                    <button type="button" onclick="window.print()">Imprimir informe</button>
                </div>

                <div class="panel">
                    <div class="panel-header">Resumen del intento</div>
                    <div class="panel-body">
                        <div class="report-meta">
                            <div class="meta-box">
                                <div class="meta-label">Nombre</div>
                                <div class="meta-value"><?php echo h($detalleIntento['nombre']); ?></div>
                            </div>
                            <div class="meta-box">
                                <div class="meta-label">Email</div>
                                <div class="meta-value"><?php echo h($detalleIntento['email']); ?></div>
                            </div>
                            <div class="meta-box">
                                <div class="meta-label">Teléfono</div>
                                <div class="meta-value"><?php echo h($detalleIntento['telefono']); ?></div>
                            </div>
                            <div class="meta-box">
                                <div class="meta-label">Curso interesado</div>
                                <div class="meta-value"><?php echo h($detalleIntento['curso_interesado']); ?></div>
                            </div>
                            <div class="meta-box">
                                <div class="meta-label">Puntos</div>
                                <div class="meta-value"><?php echo h((string)$detalleIntento['puntos']); ?> / <?php echo h((string)$detalleIntento['total_preguntas']); ?></div>
                            </div>
                            <div class="meta-box">
                                <div class="meta-label">Nivel</div>
                                <div class="meta-value">
                                    <span class="badge <?php echo h(obtenerNivelBadgeClase($detalleIntento['nivel'])); ?>">
                                        <?php echo h($detalleIntento['nivel']); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="meta-box">
                                <div class="meta-label">Fecha</div>
                                <div class="meta-value"><?php echo h($detalleIntento['fecha_creacion']); ?></div>
                            </div>
                            <div class="meta-box">
                                <div class="meta-label">Intento</div>
                                <div class="meta-value">#<?php echo h((string)$detalleIntento['id']); ?></div>
                            </div>
                        </div>

                        <?php if (empty($respuestasIntento)): ?>
                            <p>No hay respuestas guardadas para este intento.</p>
                        <?php else: ?>
                            <?php foreach ($respuestasIntento as $respuesta): ?>
                                <div class="question-report <?php echo ((int)$respuesta['es_correcta'] === 1) ? 'correct' : 'incorrect'; ?>">
                                    <div class="question-title">
                                        <?php echo h($respuesta['numero_pregunta'] . '. ' . $respuesta['pregunta']); ?>
                                    </div>
                                    <div class="report-row">
                                        <strong>Respuesta dada:</strong>
                                        <?php echo h($respuesta['respuesta_usuario'] !== '' ? $respuesta['respuesta_usuario'] : 'Sin respuesta'); ?>
                                    </div>
                                    <div class="report-row">
                                        <strong>Respuesta correcta:</strong>
                                        <?php echo h($respuesta['respuesta_correcta']); ?>
                                    </div>
                                    <div class="report-row">
                                        <strong>Resultado:</strong>
                                        <?php echo ((int)$respuesta['es_correcta'] === 1) ? 'Correcta' : 'Incorrecta'; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

            <?php else: ?>
                <div class="page-title">
                    <h1>Intentos</h1>
                </div>

                <div class="panel">
                    <div class="panel-header">
                        Listado de resultados
                        <span class="small"> · <?php echo h((string)count($intentos)); ?> registros</span>
                    </div>
                    <div class="panel-body" style="padding:0;">
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th><a class="sort-link" href="<?php echo h(buildSortLink('id', $sort, $dir, $queryParamsForLinks)); ?>">ID<?php echo h(sortArrow('id', $sort, $dir)); ?></a></th>
                                        <th><a class="sort-link" href="<?php echo h(buildSortLink('nombre', $sort, $dir, $queryParamsForLinks)); ?>">Nombre<?php echo h(sortArrow('nombre', $sort, $dir)); ?></a></th>
                                        <th><a class="sort-link" href="<?php echo h(buildSortLink('email', $sort, $dir, $queryParamsForLinks)); ?>">Email<?php echo h(sortArrow('email', $sort, $dir)); ?></a></th>
                                        <th><a class="sort-link" href="<?php echo h(buildSortLink('telefono', $sort, $dir, $queryParamsForLinks)); ?>">Teléfono<?php echo h(sortArrow('telefono', $sort, $dir)); ?></a></th>
                                        <th><a class="sort-link" href="<?php echo h(buildSortLink('curso_interesado', $sort, $dir, $queryParamsForLinks)); ?>">Curso<?php echo h(sortArrow('curso_interesado', $sort, $dir)); ?></a></th>
                                        <th><a class="sort-link" href="<?php echo h(buildSortLink('puntos', $sort, $dir, $queryParamsForLinks)); ?>">Puntos<?php echo h(sortArrow('puntos', $sort, $dir)); ?></a></th>
                                        <th><a class="sort-link" href="<?php echo h(buildSortLink('nivel', $sort, $dir, $queryParamsForLinks)); ?>">Nivel<?php echo h(sortArrow('nivel', $sort, $dir)); ?></a></th>
                                        <th><a class="sort-link" href="<?php echo h(buildSortLink('total_preguntas', $sort, $dir, $queryParamsForLinks)); ?>">Total<?php echo h(sortArrow('total_preguntas', $sort, $dir)); ?></a></th>
                                        <th><a class="sort-link" href="<?php echo h(buildSortLink('fecha_creacion', $sort, $dir, $queryParamsForLinks)); ?>">Fecha<?php echo h(sortArrow('fecha_creacion', $sort, $dir)); ?></a></th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($intentos)): ?>
                                        <tr>
                                            <td colspan="10">No hay resultados para los filtros indicados.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($intentos as $intento): ?>
                                            <tr>
                                                <td><?php echo h((string)$intento['id']); ?></td>
                                                <td><?php echo h($intento['nombre']); ?></td>
                                                <td><?php echo h($intento['email']); ?></td>
                                                <td><?php echo h($intento['telefono']); ?></td>
                                                <td><?php echo h($intento['curso_interesado']); ?></td>
                                                <td>
                                                    <strong><?php echo h((string)$intento['puntos']); ?></strong>
                                                    <div class="small">de <?php echo h((string)$intento['total_preguntas']); ?></div>
                                                </td>
                                                <td>
                                                    <span class="badge <?php echo h(obtenerNivelBadgeClase($intento['nivel'])); ?>">
                                                        <?php echo h($intento['nivel']); ?>
                                                    </span>
                                                </td>
                                                <td><?php echo h((string)$intento['total_preguntas']); ?></td>
                                                <td><?php echo h($intento['fecha_creacion']); ?></td>
                                                <td>
                                                    <div class="actions-cell">
                                                        <a class="btn btn-secondary" href="admin.php?view=report&id=<?php echo h((string)$intento['id']); ?>">Ver informe</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
<?php endif; ?>

</body>
</html>
