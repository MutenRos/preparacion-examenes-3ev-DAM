# Reporte de proyecto

## Estructura del proyecto

```
/var/www/html/jocarsa-darksalmon
├── .gitignore
├── README.md
├── admin
│   ├── aplicaciones
│   │   ├── calendario_semanal
│   │   │   └── index.php
│   │   ├── horario_semanal
│   │   │   └── index.php
│   │   └── resumen_sesiones
│   │       ├── conexion.php
│   │       └── index.php
│   ├── config.php
│   ├── darksalmon.png
│   ├── estilo.php
│   ├── index.php
│   ├── mobile
│   ├── partes
│   │   └── login.php
│   └── supercontrolador
│       ├── acciones
│       │   ├── componenteslistar
│       │   │   ├── cabezatabla.php
│       │   │   ├── calendariomensual.php
│       │   │   ├── calendariosemanal.php
│       │   │   └── cuerpotabla.php
│       │   ├── crear.php
│       │   ├── crearapp.php
│       │   ├── editar.php
│       │   ├── eliminar.php
│       │   ├── foreign.php
│       │   └── listar.php
│       ├── estilo
│       │   └── estilo.css
│       ├── funciones
│       │   └── getInputAttributes.php
│       └── supercontrolador.php
├── api
├── app.html
├── config.php
├── front
│   ├── ayuda
│   │   ├── darksalmon.md
│   │   ├── img
│   │   │   ├── Captura desde 2025-08-24 16-50-47.png
│   │   │   ├── Captura desde 2025-08-24 16-55-04.png
│   │   │   ├── Captura desde 2025-08-24 16-55-10.png
│   │   │   └── Captura desde 2025-08-24 16-55-13.png
│   │   └── index.php
│   ├── config.json
│   ├── darksalmon.png
│   ├── dashboard.css
│   ├── dashboard.html
│   ├── dashboard.js
│   ├── index.html
│   ├── login.css
│   ├── login.js
│   ├── mobile_api.php
│   ├── script.js
│   └── styles.css
└── sections.json
```

## Código (intercalado)

# jocarsa-darksalmon
**README.md**
```markdown
# jocarsa-darksalmon
```
**app.html**
```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>jocarsa | darksalmon · App</title>
  <link rel="icon" type="image/png" href="darksalmon.png" />
  <link rel="stylesheet" href="styles.css" />

  <!-- If your original uses Leaflet & Font Awesome, keep them: -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>
<body class="bg-pattern">
  <!-- 1) Auth helpers first -->
  <script src="auth.js"></script>

  <!-- 2) Gatekeeper: if not logged, it will send to index.html -->
  <script src="gate.js"></script>

  <!-- 3) Actual dashboard DOM (keeps your original structure/IDs) -->
  <div id="appContainer" class="screen">
    <header id="appHeader">
      <h1>jocarsa | darksalmon</h1>
      <button id="logoutButton" title="Pulsa este botón para cerrar activamente tu sesión">Cerrar</button>
    </header>

    <main>
      <!-- Home Screen (start/end shift + map) -->
      <section id="homeScreen" class="appScreen">
        <h2>Home</h2>
        <p>En esta sección, puedes registrar el inicio y el final de tu jornada laboral. Para ello, pulsa los botones que se presentan a continuación</p>

        <div class="buttonContainer">
          <h3>Inicio de jornada</h3>
          <p>Pulsa este botón al inicio de tu jornada. Si es jornada partida, púlsalo al inicio del bloque de la mañana y al inicio del bloque de la tarde</p>
          <button id="btnStartShift" title="Pulsa este botón al iniciar tu jornada">Iniciar Jornada</button>

          <h3>Final de jornada</h3>
          <p>Pulsa este botón al final de tu jornada. Si es jornada partida, púlsalo al final del bloque de la mañana y al final del bloque de la tarde</p>
          <button id="btnEndShift" title="Pulsa este botón al finalizar tu jornada">Finalizar Jornada</button>
        </div>

        <div id="shiftInfo" class="infoContainer"></div>
        <div id="map" style="height: 300px; margin-top: 10px;"></div>
      </section>

      <!-- Jornadas -->
      <section id="newsScreen" class="appScreen hidden">
        <h2>Jornadas Registradas</h2>
        <br />
        <p>En esta sección puedes obtener un listado de tus registros de inicio y finalización de jornada laboral. Si algo no es correcto, por favor ponte en contacto con los administradores de la aplicación.</p>
        <br />
        <div id="jornadasContainer"></div>
      </section>

      <!-- Perfil -->
      <section id="profileScreen" class="appScreen hidden">
        <h2>Perfil</h2>
        <p>En esta sección puedes ver tus datos personales, tal y como están registrados en el sistema. Si algo no es correcto, por favor ponte en contacto con los administradores de la aplicación.</p>
        <div id="profileContainer"></div>
      </section>

      <!-- Ausencias -->
      <section id="ausenciasScreen" class="appScreen hidden">
        <h2>Ausencias</h2>
        <p>En esta sección puedes informar o solicitar una ausencia rellenando y enviando el formulario que se presenta a continuación. Igualmente puedes ver el listado de ausencias solicitadas con anterioridad.</p>
        <div id="ausenciasFormContainer"></div>
        <div id="ausenciasListContainer"></div>
      </section>
    </main>

    <!-- Bottom Navigation (same selectors your JS expects) -->
    <nav id="bottomNav">
      <ul>
        <li data-screen="homeScreen" class="navItem active" title="Registrar entradas y salidas">Home</li>
        <li data-screen="newsScreen" class="navItem" title="Listado de jornadas registradas">Jornadas</li>
        <li data-screen="profileScreen" class="navItem" title="Datos de tu perfil en el sistema">Perfil</li>
        <li data-screen="ausenciasScreen" class="navItem" title="Registrar o solicitar ausencias">Ausencias</li>
      </ul>
    </nav>
  </div>

  <!-- 4) Your existing app logic (unchanged) -->
  <script src="script.js"></script>

  <!-- 5) Safe overrides (no navigation here; only guards & DOM-safe bindings) -->
  <script src="fixes.js"></script>

  <!-- (Keep your original extra assets/scripts if any) -->
  <link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-pink/jocarsa%20%7C%20pink.css">
  <script src="https://jocarsa.github.io/jocarsa-pink/jocarsa%20%7C%20pink.js"></script>
  <script src="https://ghostwhite.jocarsa.com/analytics.js?user=darksalmon.jocarsa.com"></script>
</body>
</html>


```
**config.php**
```php
<?php
// /var/www/jocarsa-darksalmon/config.php
declare(strict_types=1);

date_default_timezone_set('Europe/Madrid');

define('DS_BASE_PATH', __DIR__);
define('DS_API_PATH',  DS_BASE_PATH . '/api');
define('DS_ADMIN_PATH',DS_BASE_PATH . '/admin');
define('DS_FRONT_PATH',DS_BASE_PATH . '/front');

define('DS_DB_HOST','localhost');
define('DS_DB_NAME','darksalmon');
define('DS_DB_USER','darksalmon');
define('DS_DB_PASS','******');
define('DS_DB_CHAR','utf8mb4');

function ds_pdo(): PDO {
  static $pdo=null;
  if ($pdo) return $pdo;
  $dsn = 'mysql:host='.DS_DB_HOST.';dbname='.DS_DB_NAME.';charset='.DS_DB_CHAR;
  $pdo = new PDO($dsn, DS_DB_USER, DS_DB_PASS, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
  $pdo->exec("SET time_zone = '".date('P')."'");
  return $pdo;
}


```
**sections.json**
```json
{
  "sections": [
    {
      "id": "jornadas",
      "title": "Jornadas",
      "icon": "📅",
      "content": "Listado de jornadas registradas."
    },
    {
      "id": "userData",
      "title": "Mis Datos",
      "icon": "👤",
      "content": "Información personal del usuario."
    },
    {
      "id": "ausencias",
      "title": "Ausencias",
      "icon": "📝",
      "content": "Crear y ver peticiones de ausencia."
    }
  ]
}

```
## admin
**config.php**
```php
<?php
	$host = 'localhost';
	$user = 'darksalmon';
	$pass = '******';
	$dbName = 'darksalmon1';
	$nombre = "darksalmon";
	$color = "darksalmon";

?>

```
**estilo.php**
```php
<?php
// estilo.php
?>
/* ----------------------------------------------------------------------------
   General Styles
---------------------------------------------------------------------------- */
@import url('https://static.jocarsa.com/fuentes/ubuntu-font-family-0.83/ubuntu.css');

html, body {
    padding: 0;
    margin: 0;
    font-family: Ubuntu, sans-serif;
    height: 100%;
    transition: all 1s;
}

body {
    display: flex;
    flex-direction: column;
    background: <?php echo $color ?>;
    font-size: 1em;
    height: 100%;
}

/* ----------------------------------------------------------------------------
   Header, Navigation and Footer
---------------------------------------------------------------------------- */
header, footer {
    color: white;
}

nav h1 {
    margin: 0;
}

nav h1 a {
    padding: 10px;
    font-size: 20px;
    display: flex;
    align-items: center;
    text-decoration: none;
    color: white;
    text-shadow:0px 2px 1px rgba(0,0,0,0.3);
}

nav h1 img {
    width: 35px;
    margin-right: 16px;
}

/* Icon style for nav elements */
.icono {
    display: inline-block;
    font-size: 20px;
    font-weight: bold;
    margin-right: 8px;
    background: white !important;
    width: 30px;
    height: 30px;
    color: black;
    line-height: 30px;
    text-align: center;
    border-radius: 30px;
    color:darksalmon;
    position: relative;
}

/* “Relieve” effect for icons/buttons */
.relieve {
    background-color: rgba(0,0,0,0.1);
    border-radius: 34px;
    padding: 5px;
}

header nav {
    display: flex;
    justify-content: center;
    align-items: center;
   
}

header .boton {
    border: none;
    background: white;
    width: 30px;
    height: 30px;
}

nav .enlaces {
    padding: 0;
}

nav .nav-section {
    margin-bottom: 10px;
}

nav .nav-section h3 {
    margin: 10px 0 5px;
    font-size: 16px;
    color: white;
}

nav .nav-section div {
    padding: 10px;
    transition: all 1s;
}

nav .nav-section div a {
    text-decoration: none;
    color: white;
}

nav .nav-section div.activo {
    background: white;
    color: <?php echo $color ?>;
    border-radius: 50px 0 0 50px;
    position:relative;
    z-index:1000000;
    box-shadow:-5px 0px 10px rgba(0,0,0,0.3);
}

nav .nav-section div.activo a {
    color: black !important;
}

.logout a {
    padding: 10px;
    text-decoration: none;
    color: white;
}

.applications {
    margin-top: 20px;
}

.applications h3 {
    padding: 10px 0;
    color: white;
}

/* ----------------------------------------------------------------------------
   Main Layout
---------------------------------------------------------------------------- */
main {
    display: flex;
    flex: 1;          /* Fill the vertical available space */
    min-height: 0;    /* Allow children to shrink properly and scroll independently */
}

/* Left Navigation styling */
main nav {
    background: <?php echo $color ?>;
    width: 300px;
    padding: 10px;
    transition: all 1s;
    margin-left: 10px;
    overflow-y: auto;            /* Enables vertical scrolling */
    -webkit-overflow-scrolling: touch;
    box-sizing: border-box;
    height: 100%;
    padding-right:0px;
     margin-left:0px;
     
}
nav div div div a{
	text-shadow:0px 2px 1px rgba(0,0,0,0.3);
}

/* Main Content Section styling */
section {
    background: white;
    flex: 1;
    border-radius: 10px 0 0 10px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.4);
    padding: 30px;
    position: relative;
    z-index: 10000;
    overflow-y: auto;            /* Enables independent vertical scrolling */
    -webkit-overflow-scrolling: touch;
    box-sizing: border-box;
    height: 100%;
}

/* ----------------------------------------------------------------------------
   Table Styles (for CRUD displays)
---------------------------------------------------------------------------- */
table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 20px;
    overflow: hidden;
}

table thead {
    background: <?php echo $color ?>;
    color: white;
    border-radius: 50px;
    overflow: hidden;
   
}

table th, table td {
    padding: 10px;
    width:1000px;
    
}
table td {
/*height:100px;*/
}

table tbody tr {
    border-bottom: 1px solid lightgrey;
}

/* ----------------------------------------------------------------------------
   CRUD Form Styles
---------------------------------------------------------------------------- */
form.crud-form {
    gap: 1rem;
    margin: 2rem auto;
    padding: 1.5rem;
    background: #f7f7f7;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.crud-form label {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.crud-form input,
.crud-form textarea,
.crud-form select,
.crud-form button {
    padding: 0.6rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 0.5rem;
}

.crud-form button {
    background: <?php echo $color ?>;
    color: #fff;
    border: none;
    cursor: pointer;
    font-size: 1.1rem;
    transition: background 0.3s ease;
}

.crud-form button:hover {
    background: #285a7b;
}

/* Fieldset Styles */
fieldset {
    border: none;
    display: flex;
}

fieldset label {
    flex: 1;
}

fieldset input,
fieldset textarea,
fieldset select {
    flex: 1;
}

/* ----------------------------------------------------------------------------
   Footer Styles
---------------------------------------------------------------------------- */
footer {
    display: flex;
    justify-content: center;
    color: white;
}

/* ----------------------------------------------------------------------------
   Dashboard Grid and Cards (Enhanced Layout)
---------------------------------------------------------------------------- */
.dashboard-grid {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 20px;
    margin-top: 20px;
}

.dashboard-section {
    display: grid;
    grid-template-columns: repeat(9, 1fr);
    gap: 20px;
    background: #f3f3f3;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.dashboard-section h2 {
    font-size: 1.5em;
    margin-bottom: 15px;
    color: #333;
    border-bottom: 2px solid #ccc;
    padding-bottom: 5px;
}

.card {
    background: darksalmon !important;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    color: #333;
    margin-bottom: 15px;
    color:white;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.card a {
    display: block;
    text-decoration: none;
    color: inherit;
}

/* Big icon style used in dashboard cards */
.iconoletra {
    font-size: 50px;
    font-weight: bold;
    margin-bottom: 10px;
    display: block;
}

/* Card title style */
.card-title {
    font-size: 1.2em;
    font-weight: bold;
}

/* ----------------------------------------------------------------------------
   Additional Custom Styles
---------------------------------------------------------------------------- */
.cabecerasupercontrolador {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-between;
    align-items: stretch;
    align-content: stretch;
}

.cabecerasupercontrolador h2,
.cabecerasupercontrolador p {
    margin: 0px;
    margin-bottom:20px;
}

section a {
    background: <?php echo $color ?> !important;
    color: white;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 55px;
    
}
.card a{
	background:none;
}
.scroll-left {
  direction: rtl;         /* This moves the scrollbar to the left */
  unicode-bidi: bidi-override; /* Ensures text still flows left-to-right */
  overflow-y: scroll;     /* Enables vertical scrolling */

}

.scroll-left > * {
  direction: ltr;         /* Keep content direction normal inside */
}
.view-type-options{
	margin-top:20px;
}
/* Reset inner content direction */
.scroll-left > * {
  direction: ltr;
}

/* Scrollbar styling for WebKit (Chrome, Edge, Safari) */
.scroll-left::-webkit-scrollbar {
  width: 12px;
  background-color: darksalmon;   /* Scrollbar track (background) */
}

.scroll-left::-webkit-scrollbar-thumb {
  background-color: lightsalmon;  /* Scrollbar thumb (draggable part) */
  border-radius: 6px;
}

.scroll-left::-webkit-scrollbar-thumb:hover {
  background-color: salmon;       /* Optional: hover color */
}

.scroll-left::-webkit-scrollbar-track {
  background-color: darksalmon;   /* Explicitly set track color again */
}

/* Firefox styling */
.scroll-left {
  scrollbar-color: lightsalmon darksalmon;
  scrollbar-width: thin;
}
.activo .icono{
	background:darksalmon !important;
	color:white;
	position: relative;
}
th input,th select{
	border:none;
	border-radius:40px;
	padding:10px;
}

.cabecerasupercontrolador a{
	border-radius:0px;
}
.cabecerasupercontrolador a:first-child{
	border-radius:40px 0px 0px 40px;
}
.cabecerasupercontrolador a:last-child{
	border-radius:0px 40px 40px 0px;
}

@media print {
  nav{
  	display:none;
  }
  body{
  	background:none;
  	
  }
  html,body,section{
  	height:100%;
  }
  
}

.progress-container {
  position: relative;
  background: #eee;
  border-radius: 10px;
  overflow: hidden;
  height: 12px;
  width: 100%;
}
.progress-completed {
  background: darksalmon;
  height: 100%;
  transition: width 0.3s ease;
}
.progress-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 0.75rem;
  color: #333;
  white-space: nowrap;
  pointer-events: none;
}


```
**index.php**
```php
<?php
session_start();
//include "../../jocarsa-red/jocarsa | red.php";
include "config.php";

// Create MySQL connection.
$mysqli = new mysqli($host, $user, $pass, $dbName);
if ($mysqli->connect_errno) {
    die("MySQL Connection Error: " . $mysqli->connect_error);
}

// Check if there are any tables.
$tempResult = $mysqli->query("SHOW TABLES");
if ($tempResult && $tempResult->num_rows == 0) {
    header("Location: instalacion/index.php");
    exit;
}

// Process logout.
if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
    exit;
}

// LOGIN CHECK: If not logged in, process login.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario']) && isset($_POST['contrasena'])) {
        $usuario    = $mysqli->real_escape_string($_POST['usuario']);
        $contrasena = $mysqli->real_escape_string($_POST['contrasena']);
        $query = "SELECT * FROM admin WHERE username = '$usuario' LIMIT 1";
        $loginResult = $mysqli->query($query);
        if ($loginResult && $loginResult->num_rows == 1) {
            $userRow = $loginResult->fetch_assoc();
            // In production, use password_verify for hashed passwords.
            if ($userRow['password'] === $contrasena) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $userRow;
                header("Location: index.php");
                exit;
            } else {
                $login_error = "Usuario o contraseña incorrectos.";
            }
        } else {
            $login_error = "Usuario o contraseña incorrectos.";
        }
    }
    include "partes/login.php";
    exit;
}

/* =============================================================================
   Re-run Queries to store results in arrays so they can be used in both the left
   navigation and the dashboard later.
============================================================================= */
$tablesData = [];
$resultTables = $mysqli->query("SHOW FULL TABLES FROM `$dbName` WHERE TABLE_TYPE='BASE TABLE'");
if ($resultTables) {
    while ($row = $resultTables->fetch_row()) {
        $tablesData[] = $row[0];
    }
}

$viewsData = [];
$resultViews = $mysqli->query("SHOW FULL TABLES FROM `$dbName` WHERE TABLE_TYPE='VIEW'");
if ($resultViews) {
    while ($row = $resultViews->fetch_row()) {
        $viewsData[] = $row[0];
    }
}

$proceduresData = [];
$resultProcedures = $mysqli->query("SELECT ROUTINE_NAME FROM INFORMATION_SCHEMA.ROUTINES WHERE ROUTINE_SCHEMA='$dbName' AND ROUTINE_TYPE='PROCEDURE'");
if ($resultProcedures) {
    while ($row = $resultProcedures->fetch_assoc()) {
        $proceduresData[] = $row['ROUTINE_NAME'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>jocarsa | <?php echo $nombre ?></title>
    <style>
        <?php include "estilo.php" ?>

        /* --- Additional CSS for unified dashboard grid --- */
        .dashboard-grid.single-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .dashboard-grid.single-grid .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dashboard-grid.single-grid .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .dashboard-grid.single-grid .card a {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .dashboard-grid.single-grid .iconoletra {
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .dashboard-grid.single-grid .card-title {
            font-size: 1.2em;
            font-weight: bold;
        }
        .dashboard-grid.single-grid .card-title small {
            display: block;
            font-weight: normal;
            color: #666;
            margin-top: 5px;
            font-size: 0.9em;
        }
    </style>
    <link rel="icon" type="image/svg+xml" href="../<?php echo $color ?>.png" />
</head>
<body>
    <main>
        <!-- Left Navigation -->
        <nav class="scroll-left">
            <h1>
                <a href="index.php" title="Haz click aquí para volver a la pantalla de inicio">
                    <img src="<?php echo $nombre ?>.png" alt="Logo">
                    <?php echo $nombre ?>
                </a>
            </h1>
            <div class="enlaces">
            	<div class="applications nav-section">
                    <hr>
                    <h3 title="Desarrollos a medida">Aplicaciones</h3>
                    
                    <?php
                    // Dynamically scan the "aplicaciones" folder for subdirectories
                    $appDir = __DIR__ . '/aplicaciones';
                    $appFolders = array_filter(scandir($appDir), function($item) use ($appDir) {
                        return is_dir($appDir . '/' . $item) && $item !== '.' && $item !== '..';
                    });
                    foreach ($appFolders as $appName) {
                        echo '<div>';
                        echo '<span class="icono relieve">' . htmlspecialchars(substr($appName, 0, 1)) . '</span>';
                        echo '<a href="index.php?app=' . urlencode($appName) . '">' . htmlspecialchars($appName) . '</a>';
                        echo '</div>';
                    }
                    ?>
                </div>
                <hr>
                <!-- Views Section -->
                <div class="nav-section">
                    <h3 title="Informes del sistema">Vistas</h3>
                    <?php
                    foreach ($viewsData as $viewName) {
                        echo "<div" . ((isset($_GET['table']) && $viewName == $_GET['table']) ? " class='activo'" : "") . ">";
                        echo '<span class="icono relieve">' . htmlspecialchars($viewName[0]) . '</span>';
                        echo '<a href="index.php?table=' . urlencode($viewName) . '&accion=listar">' . htmlspecialchars($viewName) . '</a>';
                        echo "</div>";
                    }
                    ?>
                </div>
                <hr>
                <!-- Procedures Section -->
                <div class="nav-section">
                    <h3 title="Operaciones de inserción, listados, actualizaciones y eliminaciones">Procedimientos</h3>

                    <?php
                    foreach ($proceduresData as $procName) {
                        echo "<div>";
                        echo '<span class="icono relieve">' . htmlspecialchars($procName[0]) . '</span>';
                        echo '<a href="index.php?accion=crear_app&sp=' . urlencode($procName) . '">' . htmlspecialchars($procName) . '</a>';
                        echo "</div>";
                    }
                    ?>
                </div>
                <hr>
                <!-- Base Tables Section -->
                <div class="nav-section">
                    <h3 title="Tablas donde se encuentra la información original">Tablas</h3>
                    <?php
                    foreach ($tablesData as $tableName) {
                        echo "<div" . ((isset($_GET['table']) && $tableName == $_GET['table']) ? " class='activo'" : "") . ">";
                        echo '<span class="icono relieve">' . htmlspecialchars($tableName[0]) . '</span>';
                        echo '<a href="index.php?table=' . urlencode($tableName) . '&accion=listar">' . htmlspecialchars($tableName) . '</a>';
                        echo "</div>";
                    }
                    ?>
                </div>
                
                
                <hr>
                <!-- Logout link -->
                
                 <div class="nav-section">
                 <h3 title="Tablas donde se encuentra la información original">Ayuda y salir</h3>
                <div>
                <span class="icono relieve">A</span>
                    <a href="https://brown.jocarsa.com/pdf/publication_10.pdf" target="_blank">Ayuda</a>
                    </div>
                <div class="logout">
                		<span class="icono relieve">S</span>
                    <a href="index.php?logout=true">Cerrar Sesión</a>
                </div>
                </div>
            </div>
        </nav>

        <!-- Main Content Section -->
        <section>
            <?php
            // If an application parameter is provided, include that application's index.php
            if (isset($_GET['app'])) {
                $app = basename($_GET['app']); // sanitize input
                $appPath = __DIR__ . '/aplicaciones/' . $app . '/index.php';
                if (file_exists($appPath)) {
                    include $appPath;
                    exit;
                } else {
                    echo "<h2>Aplicación no encontrada.</h2>";
                }
            }
            // If a table is specified or procedure app mode is activated, include the controller.
            elseif (isset($_GET['table']) || (isset($_GET['accion']) && $_GET['accion'] === 'crear_app')) {
                include "supercontrolador/supercontrolador.php";
            }
            // Otherwise, show the unified dashboard grid.
            else {
                // Merge items from tables, views, procedures and applications into one unified array.
                $allItems = [];
                foreach ($tablesData as $item) {
                    $allItems[] = [
                        'type'  => 'Tabla',
                        'name'  => $item,
                        'link'  => "index.php?table=" . urlencode($item) . "&accion=listar",
                        'icon'  => htmlspecialchars($item[0])
                    ];
                }
                foreach ($viewsData as $item) {
                    $allItems[] = [
                        'type'  => 'Vista',
                        'name'  => $item,
                        'link'  => "index.php?table=" . urlencode($item) . "&accion=listar",
                        'icon'  => htmlspecialchars($item[0])
                    ];
                }
                foreach ($proceduresData as $item) {
                    $allItems[] = [
                        'type'  => 'Procedimiento',
                        'name'  => $item,
                        'link'  => "index.php?accion=crear_app&sp=" . urlencode($item),
                        'icon'  => htmlspecialchars($item[0])
                    ];
                }
                foreach ($appFolders as $item) {
                    $allItems[] = [
                        'type'  => 'Aplicación',
                        'name'  => $item,
                        'link'  => "index.php?app=" . urlencode($item),
                        'icon'  => htmlspecialchars(substr($item, 0, 1))
                    ];
                }
                ?>
                <div class="dashboard-grid single-grid">
                    <?php foreach ($allItems as $item): ?>
                        <div class="card">
                            <a href="<?php echo $item['link']; ?>">
                                <span class="iconoletra"><?php echo $item['icon']; ?></span>
                                <div class="card-title">
                                    <?php echo htmlspecialchars($item['name']); ?>
                                    <small>(<?php echo $item['type']; ?>)</small>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php
            }
            ?>
        </section>
    </main>
    <script src="https://ghostwhite.jocarsa.com/analytics.js?user=darksalmon.jocarsa.com"></script>
    <script src="https://jocarsa.github.io/jocarsa-silver/jocarsa-silver.js"></script>
     <link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-silver/jocarsa-silver.css" />
     <link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-white/jocarsawhite.css">
     <link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-seashell/jocarsa%20%7C%20seashell.css">
<script src="https://jocarsa.github.io/jocarsa-seashell/jocarsa%20%7C%20seashell.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.icono.relieve').forEach(icon => {
      const original = icon.textContent.trim();
      icon.addEventListener('mouseenter', () => {
        icon.textContent = '⭐';
      });
      icon.addEventListener('mouseleave', () => {
        icon.textContent = original;
      });
    });
  });
</script>
<link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-pink/jocarsa%20%7C%20pink.css">
<script src="https://jocarsa.github.io/jocarsa-pink/jocarsa%20%7C%20pink.js"></script>
</body>
</html>


```
### aplicaciones
#### calendario_semanal
**index.php**
```php
<?php
// aplicaciones/calendario_semanal/index.php
// Semanal: reales, teóricos, festivos + resumen semanal

include __DIR__ . '/../../config.php';
$mysqli = new mysqli($host, $user, $pass, $dbName);
if ($mysqli->connect_errno) {
    die("MySQL Connection Error: " . $mysqli->connect_error);
}

// 1. Empleados
$empleados = [];
$resE = $mysqli->query("SELECT id, nombre, apellido FROM empleados ORDER BY nombre, apellido");
while ($r = $resE->fetch_assoc()) {
    $empleados[$r['id']] = $r['nombre'] . ' ' . $r['apellido'];
}

// 2. Semana (lunes–domingo)
$weekStartTs = isset($_GET['week']) ? strtotime($_GET['week']) : strtotime('monday this week');
$weekStart   = date('Y-m-d', $weekStartTs);
$weekEnd     = date('Y-m-d', strtotime('+6 days', $weekStartTs));
$prevWeek    = date('Y-m-d', strtotime('-7 days', $weekStartTs));
$nextWeek    = date('Y-m-d', strtotime('+7 days', $weekStartTs));

// 3. Empleado
$selectedEmp  = intval($_GET['employee_id'] ?? 0);
$employeeName = $empleados[$selectedEmp] ?? '';

// 4. Festivos
$holidays = [];
$hf = $mysqli->prepare("SELECT fecha, nombre, descripcion FROM Festivos WHERE fecha BETWEEN ? AND ?");
$hf->bind_param('ss', $weekStart, $weekEnd);
$hf->execute();
$rf = $hf->get_result();
while ($r = $rf->fetch_assoc()) {
    $idx = (int)((strtotime($r['fecha']) - $weekStartTs) / 86400);
    $holidays[$idx] = ['name' => $r['nombre'], 'desc' => $r['descripcion']];
}
$hf->close();

// 5. Sesiones reales
$events = [];
$workedMinutes = 0;
if ($selectedEmp) {
    $stmt = $mysqli->prepare("
        SELECT fecha, hora_entrada, hora_salida
        FROM Asistencia
        WHERE empleado_id = ? AND fecha BETWEEN ? AND ?
        ORDER BY fecha, hora_entrada
    ");
    $stmt->bind_param('iss', $selectedEmp, $weekStart, $weekEnd);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($r = $res->fetch_assoc()) {
        if ($r['hora_entrada'] && $r['hora_salida']) {
            list($h1, $m1) = explode(':', $r['hora_entrada']);
            list($h2, $m2) = explode(':', $r['hora_salida']);
            $start    = intval($h1) * 60 + intval($m1);
            $duration = (intval($h2) * 60 + intval($m2)) - $start;
            $workedMinutes += $duration;
            $events[] = [
                'day'      => date('N', strtotime($r['fecha'])) - 1,
                'start'    => $start,
                'duration' => $duration
            ];
        }
    }
    $stmt->close();
}

// 6. Sesiones teóricas (excluyendo festivos)
$theoretical = [];
$dueMinutes   = 0;
if ($selectedEmp) {
    $qt = $mysqli->prepare("
        SELECT dia_de_la_semana, hora_de_entrada, hora_de_salida
        FROM horarios
        WHERE empleado = ?
    ");
    $qt->bind_param('i', $selectedEmp);
    $qt->execute();
    $rt = $qt->get_result();
    while ($r = $rt->fetch_assoc()) {
        $dayIdx = $r['dia_de_la_semana'] - 1;
        if (isset($holidays[$dayIdx])) {
            continue;
        }
        list($h1, $m1) = explode(':', $r['hora_de_entrada']);
        list($h2, $m2) = explode(':', $r['hora_de_salida']);
        $start    = intval($h1) * 60 + intval($m1);
        $duration = (intval($h2) * 60 + intval($m2)) - $start;
        if ($duration > 0) {
            $dueMinutes    += $duration;
            $theoretical[] = [
                'day'      => $dayIdx,
                'start'    => $start,
                'duration' => $duration
            ];
        }
    }
    $qt->close();
}

// 7. Calcular porcentaje
$percent = $dueMinutes > 0 ? round($workedMinutes / $dueMinutes * 100, 1) : 0;

// Formatear minutos a HhMM
function fmtH($mins) {
    return floor($mins / 60) . 'h' . sprintf('%02d', $mins % 60);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Calendario Semanal – <?= htmlspecialchars($employeeName) ?></title>
  <style>
    :root {
      --time-col-width: 60px;
      --header-height: 40px;
      --slot-height: 30px;
      --bar-bg: #eee;
      --bar-fill: darksalmon;
    }
    body { font-family: Ubuntu, sans-serif; margin: 1rem; }
    h2 { margin-bottom: .5rem; }
    form { margin-bottom: 1rem; }
    select, button { padding: .5rem 1rem; margin-right: .5rem; font-size: 1rem; }
    .summary {
      margin: 1rem 0; font-size: 1rem;
    }
    .progress-container {
      background: var(--bar-bg);
      border-radius: 10px;
      overflow: hidden;
      height: 20px;
      width: 100%;
      max-width: 400px;
      box-shadow: inset 0 1px 3px rgba(0,0,0,0.2);
    }
    .progress-fill {
      background: var(--bar-fill);
      height: 100%; width: <?= $percent ?>%;
      transition: width .5s ease;
    }
    .calendar {
      display: grid;
      grid-template-columns: var(--time-col-width) repeat(7, 1fr);
      grid-template-rows: var(--header-height) repeat(48, var(--slot-height));
      border: 1px solid #ccc;
      position: relative;
    }
    .day-label, .time-label, .slot { box-sizing: border-box; }
    .day-label {
      background: #f5f5f5;
      border-bottom: 1px solid #ddd;
      display: flex; align-items: center; justify-content: center;
      font-weight: bold;
    }
    .time-label {
      background: #fafafa;
      border-right: 1px solid #ddd;
      font-size: .75rem; text-align: right; padding-right: 4px;
    }
    .slot {
      border-bottom: 1px solid #eee;
      border-right: 1px solid #eee;
    }
    .holiday-event {
      background: white; color: black;
      border: 2px dashed #888;
      padding: 4px; font-size: .8rem; line-height: 1.2;
      z-index: 2; position: relative;
    }
    .theoretical-event {
      background: lightgrey; z-index: 0; position: relative;
    }
    .event {
      background: darksalmon; color: #fff;
      border-radius: 4px; padding: 4px;
      font-size: .75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.2);
      z-index: 1; position: relative;
      width: 50%;
    }
  </style>
</head>
<body>
  <!-- Selección de empleado -->
  <form method="get" action="index.php">
    <input type="hidden" name="app" value="calendario_semanal">
    <label>Empleado:
      <select name="employee_id" required>
        <option value="">-- selecciona --</option>
        <?php foreach ($empleados as $id => $n): ?>
          <option value="<?= $id ?>" <?= $id === $selectedEmp ? 'selected' : '' ?>>
            <?= htmlspecialchars($n) ?>
          </option>
        <?php endforeach ?>
      </select>
    </label>
    <button type="submit">Seleccionar</button>
  </form>

  <?php if ($selectedEmp): ?>
    <h2>Calendario semanal de <?= htmlspecialchars($employeeName) ?></h2>
    <form method="get" action="index.php" style="display: inline-block;">
      <input type="hidden" name="app" value="calendario_semanal">
      <input type="hidden" name="employee_id" value="<?= $selectedEmp ?>">
      <button name="week" value="<?= $prevWeek ?>">« Semana anterior</button>
      <button name="week" value="<?= $nextWeek ?>">Semana siguiente »</button>
    </form>
    <span style="margin-left: 1rem; font-weight: bold;">
      Semana de <?= $weekStart ?> a <?= $weekEnd ?>
    </span>

    <!-- Resumen semanal -->
    <div class="summary">
      <strong>Horas requeridas:</strong> <?= fmtH($dueMinutes) ?> &nbsp;
      <strong>Horas trabajadas:</strong> <?= fmtH($workedMinutes) ?> &nbsp;
      <strong>Avance:</strong> <?= $percent ?>%
      <div class="progress-container">
        <div class="progress-fill"></div>
      </div>
    </div>

    <!-- Calendario -->
    <div class="calendar">
      <?php
      $days = ['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'];
      foreach ($days as $i => $d) {
        echo "<div class='day-label' style='grid-column:" . ($i+2) . ";grid-row:1;'>$d</div>";
      }
      for ($i = 0; $i < 48; $i++) {
        $hour = floor($i/2);
        $min  = $i%2===0 ? '00' : '30';
        $row  = $i+2;
        if ($min==='00') {
          echo "<div class='time-label' style='grid-column:1;grid-row:$row;'>$hour:$min</div>";
        }
        for ($d = 0; $d < 7; $d++) {
          echo "<div class='slot' style='grid-column:" . ($d+2) . ";grid-row:$row;'></div>";
        }
      }
      // Festivos
      foreach ($holidays as $di => $info) {
        $label = htmlspecialchars($info['name']) . "<br>" . htmlspecialchars($info['desc']);
        echo "<div class='holiday-event' style='grid-column:" . ($di+2) . ";grid-row:2/span48;'>$label</div>";
      }
      // Sesiones teóricas
      foreach ($theoretical as $tev) {
        $c  = $tev['day'] + 2;
        $sr = floor($tev['start']/30) + 2;
        $sp = max(1, floor($tev['duration']/30));
        echo "<div class='theoretical-event' style='grid-column:$c;grid-row:$sr/span $sp;'></div>";
      }
      // Sesiones reales
      foreach ($events as $ev) {
        $c   = $ev['day'] + 2;
        $sr  = floor($ev['start']/30) + 2;
        $sp  = max(1, floor($ev['duration']/30));
        $sh  = floor($ev['start']/60); $sm = $ev['start'] % 60;
        $et  = $ev['start'] + $ev['duration'];
        $eh  = floor($et/60); $em = $et % 60;
        $lab = sprintf("%02d:%02d – %02d:%02d", $sh, $sm, $eh, $em);
        echo "<div class='event' style='grid-column:$c;grid-row:$sr/span $sp;' title='$lab'>$lab</div>";
      }
      ?>
    </div>
  <?php else: ?>
    <p>Por favor, selecciona un empleado para ver su calendario.</p>
  <?php endif; ?>
</body>
</html>


```
#### horario_semanal
**index.php**
```php
<?php
// aplicaciones/horario_semanal/index.php
// Weekly schedule editor para empleados con soporte para dos franjas de horario

include __DIR__ . '/../../config.php';
$mysqli = new mysqli($host, $user, $pass, $dbName);
if ($mysqli->connect_errno) {
    die("MySQL Connection Error: " . $mysqli->connect_error);
}

// Cargar empleados y días de la semana
$empleados = [];
$resEmp = $mysqli->query("SELECT id, nombre, apellido FROM empleados ORDER BY nombre, apellido");
while ($r = $resEmp->fetch_assoc()) $empleados[] = $r;
$dias = [];
$resDias = $mysqli->query("SELECT id, nombre FROM dias_de_la_semana ORDER BY id");
while ($r = $resDias->fetch_assoc()) $dias[] = $r;

$message = '';

// Procesar POST: guardar bloques de horario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empleado_id = intval($_POST['employee_id']);
    foreach ($_POST['slots'] ?? [] as $dia => $times) {
        $d = intval($dia);
        if (empty($times)) {
            $mysqli->query("DELETE FROM horarios WHERE empleado=$empleado_id AND dia_de_la_semana=$d");
            continue;
        }
        sort($times);
        // Agrupar en bloques por brecha >30 min
        $blocks = [];
        $block = [$times[0]];
        for ($i = 1; $i < count($times); $i++) {
            $prev = DateTime::createFromFormat('H:i', $times[$i - 1]);
            $curr = DateTime::createFromFormat('H:i', $times[$i]);
            $diff = ($curr->getTimestamp() - $prev->getTimestamp()) / 60;
            if ($diff <= 30) {
                $block[] = $times[$i];
            } else {
                $blocks[] = $block;
                $block = [$times[$i]];
            }
        }
        $blocks[] = $block;
        // Eliminar registros previos y crear nuevos bloques
        $mysqli->query("DELETE FROM horarios WHERE empleado=$empleado_id AND dia_de_la_semana=$d");
        foreach ($blocks as $blk) {
            $start = reset($blk);
            $end   = end($blk);
            $in_dt  = DateTime::createFromFormat('H:i', $start);
            $out_dt = DateTime::createFromFormat('H:i', $end);
            $out_dt->add(new DateInterval('PT30M'));
            $in_time  = $in_dt->format('H:i:s');
            $out_time = $out_dt->format('H:i:s');
            $mysqli->query(
                "INSERT INTO horarios(dia_de_la_semana, empleado, hora_de_entrada, hora_de_salida) " .
                "VALUES($d, $empleado_id, '$in_time', '$out_time')"
            );
        }
    }
    $message = "Horarios actualizados correctamente.";
}

// Empleado seleccionado y carga de franjas existentes
$selectedEmp = intval($_REQUEST['employee_id'] ?? 0);
$existingSlots = [];
if ($selectedEmp) {
    $resH = $mysqli->query(
        "SELECT dia_de_la_semana, hora_de_entrada, hora_de_salida " .
        "FROM horarios WHERE empleado=$selectedEmp"
    );
    while ($h = $resH->fetch_assoc()) {
        $dia = $h['dia_de_la_semana'];
        $start = DateTime::createFromFormat('H:i:s', $h['hora_de_entrada']);
        $end   = DateTime::createFromFormat('H:i:s', $h['hora_de_salida']);
        while ($start < $end) {
            $existingSlots[$dia][] = $start->format('H:i');
            $start->add(new DateInterval('PT30M'));
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editor de Horario Semanal</title>
  <style>
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ccc; padding: 6px; text-align: center; }
    td.slot { cursor: pointer; transition:all 1s;}
    td.selected { background: #1db954; color: #fff; border-radius:50px;}
    #total { margin: 10px 0; font-weight: bold; }
    form { margin-bottom: 20px; }
    td{height:10px !important;padding:0px !important;}
  </style>
</head>
<body>
  <h2>Aplicación: Definir Horario Semanal</h2>
  <?php if ($message): ?><p style="color: green;"><?php echo htmlspecialchars($message); ?></p><?php endif; ?>

  <form method="get" action="index.php">
    <input type="hidden" name="app" value="horario_semanal">
    <label>Empleado:
      <select name="employee_id">
        <option value="0">-- seleccione --</option>
        <?php foreach ($empleados as $e): ?>
          <option value="<?php echo $e['id']; ?>" <?php if ($e['id']==$selectedEmp) echo 'selected'; ?>>
            <?php echo htmlspecialchars($e['nombre'].' '.$e['apellido']); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </label>
    <button type="submit">Seleccionar</button>
  </form>

  <?php if ($selectedEmp): ?>
  <form id="slotsForm" method="post" action="index.php?app=horario_semanal&employee_id=<?php echo $selectedEmp; ?>">
    <input type="hidden" name="employee_id" value="<?php echo $selectedEmp; ?>">
    <table>
      <thead>
        <tr>
          <th>Hora \ Día</th>
          <?php foreach ($dias as $d): ?>
            <th><?php echo htmlspecialchars($d['nombre']); ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php for ($h = 0; $h < 24; $h++): foreach (['00','30'] as $m): ?>
          <tr>
            <td><?php printf('%02dh%s', $h, $m); ?></td>
            <?php foreach ($dias as $d):
              $time = sprintf('%02d:%s', $h, $m);
              $sel = (!empty($existingSlots[$d['id']]) && in_array($time, $existingSlots[$d['id']])) ? 'selected' : '';
            ?>
            <td class="slot <?php echo $sel; ?>" data-dia="<?php echo $d['id']; ?>" data-time="<?php echo $time; ?>"></td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; endfor; ?>
      </tbody>
    </table>
    <div id="total"><?php echo array_sum(array_map('count', $existingSlots)) * 0.5; ?> horas seleccionadas</div>
    <button type="submit">Guardar Horario</button>
  </form>
  <script>
    document.querySelectorAll('td.slot').forEach(cell => {
      cell.addEventListener('click', () => {
        cell.classList.toggle('selected'); updateTotal();
      });
    });
    function updateTotal() {
      const cnt = document.querySelectorAll('td.selected').length;
      document.getElementById('total').textContent = (cnt*0.5) + ' horas seleccionadas';
    }
    document.getElementById('slotsForm').addEventListener('submit', function() {
      document.querySelectorAll('.hiddenSlot').forEach(el => el.remove());
      document.querySelectorAll('td.selected').forEach(c => {
        const dia = c.dataset.dia, time = c.dataset.time;
        const inp = document.createElement('input');
        inp.type = 'hidden'; inp.name = `slots[${dia}][]`; inp.value = time;
        inp.className = 'hiddenSlot'; this.appendChild(inp);
      });
    });
  </script>
  <?php endif; ?>
</body>
</html>

```
#### resumen_sesiones
**conexion.php**
```php
<?php
$host   = 'localhost';
$user   = 'aulacampus';
$pass   = 'AulaCampus123$';
$dbName = 'aulacampus';
?>

```
**index.php**
```php
<?php
// resumen_sesiones/index.php

// Database connection
include "conexion.php";

$mysqli = new mysqli($host, $user, $pass, $dbName);
if ($mysqli->connect_errno) {
    die("Connection Error: " . $mysqli->connect_error);
}

// Determine the current week and year
$currentWeek = isset($_GET['week']) ? intval($_GET['week']) : date('W');
$currentYear = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

// Calculate the ISO‐week start (Monday) and build the dates for the whole week
$dtWeek    = new DateTime();
$dtWeek->setISODate($currentYear, $currentWeek);
$weekDates = [];
for ($i = 0; $i < 7; $i++) {
    $weekDates[] = $dtWeek->format('Y-m-d');
    $dtWeek->modify('+1 day');
}

// Spanish names for weekdays
$dayNames = [
    'Mon' => 'Lunes',
    'Tue' => 'Martes',
    'Wed' => 'Miércoles',
    'Thu' => 'Jueves',
    'Fri' => 'Viernes',
    'Sat' => 'Sábado',
    'Sun' => 'Domingo'
];

// Calculate previous and next week for navigation
$prevDt   = (new DateTime())->setISODate($currentYear, $currentWeek)->modify('-1 week');
$nextDt   = (new DateTime())->setISODate($currentYear, $currentWeek)->modify('+1 week');
$prevWeek = $prevDt->format('W');
$prevYear = $prevDt->format('Y');
$nextWeek = $nextDt->format('W');
$nextYear = $nextDt->format('Y');

// Fetch all employees
$employees = [];
$resEmp = $mysqli->query("SELECT id, CONCAT(nombre, ' ', apellido) AS empleado FROM empleados ORDER BY nombre, apellido");
while ($r = $resEmp->fetch_assoc()) {
    $employees[$r['id']] = $r['empleado'];
}
$resEmp->free();

// Fetch attendance records for the week
$weekStart = reset($weekDates);
$weekEnd   = end($weekDates);
$attendance = [];
$resAs = $mysqli->query("
    SELECT empleado_id, fecha, hora_entrada, hora_salida
    FROM Asistencia
    WHERE fecha BETWEEN '$weekStart' AND '$weekEnd'
");
while ($r = $resAs->fetch_assoc()) {
    $attendance[$r['empleado_id']][$r['fecha']] = [
        'entrada' => $r['hora_entrada'],
        'salida'  => $r['hora_salida']
    ];
}
$resAs->free();

// Build per‐employee, per‐day status
$today = date('Y-m-d');
$employeeData = [];
foreach ($employees as $empId => $empName) {
    $employeeData[$empId] = [
        'empleado' => $empName,
        'days'     => []  // will be an array of 7 statuses
    ];
    foreach ($weekDates as $date) {
        if (isset($attendance[$empId][$date])) {
            $ent = $attendance[$empId][$date]['entrada'];
            $sal = $attendance[$empId][$date]['salida'];
            if ($ent && $sal) {
                $status = 'green';
            } elseif ($ent && !$sal) {
                if ($date === $today) {
                    $status = 'yellow';
                } else {
                    $status = 'red';
                }
            } else {
                $status = 'grey';
            }
        } else {
            $status = 'grey';
        }
        $employeeData[$empId]['days'][] = $status;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Sesiones – Semana <?= $currentYear ?>-W<?= str_pad($currentWeek,2,'0',STR_PAD_LEFT) ?></title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f9f9f9; }
        .green  { background-color: #4CAF50; }
        .yellow { background-color: #FFEB3B; }
        .red    { background-color: #F44336; }
        .grey   { background-color: #9E9E9E; }
        .nav { margin-bottom: 1rem; font-weight: bold; }
        .nav a { text-decoration: none; margin: 0 1rem; }
    </style>
</head>
<body>
    <h1>Resumen de Sesiones</h1>
    <div class="nav">
        <a href="?app=resumen_sesiones&week=<?= $prevWeek ?>&year=<?= $prevYear ?>">« Semana anterior</a>
        Semana <?= $currentYear ?>-W<?= str_pad($currentWeek,2,'0',STR_PAD_LEFT) ?>
        <a href="?app=resumen_sesiones&week=<?= $nextWeek ?>&year=<?= $nextYear ?>">Semana siguiente »</a>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <?php foreach ($weekDates as $date): 
                $w = date('D', strtotime($date));
                $name = $dayNames[$w] ?? $w;
            ?>
                <th>
                    <?= $name ?><br>
                    <?= $date ?>
                </th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($employeeData as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['empleado']) ?></td>
                <?php foreach ($row['days'] as $status): ?>
                    <td class="<?= $status ?>"></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>


```
### mobile
### partes
**login.php**
```php
   <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>jocarsa | darksalmon</title>
    <link rel="icon" href="../darksalmon.png" type="image/x-icon">
    <!-- PNG Favicon for Browsers -->
    <link rel="icon" type="image/png" sizes="32x32" href="../darksalmon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../darksalmon.png">
    <!-- Apple Touch Icon (iOS) -->
    <link rel="apple-touch-icon" sizes="180x180" href="../darksalmon.png">
    <style>
        @import url('https://static.jocarsa.com/fuentes/ubuntu-font-family-0.83/ubuntu.css');
        * {
          font-family: Ubuntu, sans-serif;
        }
        html, body {
            padding: 0; 
            margin: 0;
            height: 100%;
            background: DarkSalmon;
            background: linear-gradient(0deg, rgba(124,80,65,1) 0%, rgba(233,150,122,1) 100%);
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            width: 250px;
            border: 1px solid lightgrey;
            border-radius: 150px 150px 5px 5px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.3);
            background: white;
            padding: 20px;
            font-size: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        form img {
            width: 100%;
            border-radius: 300px;
            box-sizing: content-box;
        }
        form h2 {
            margin-top: 0;
            color: DarkSalmon;
        }
        label {
            width: 100%;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid lightgrey;
            border-radius: 5px;
            box-shadow: inset 0px 4px 8px rgba(0,0,0,0.1);
            margin-top: 5px;
            box-sizing: border-box;
        }
        .relieve {
            background-color: rgba(0,0,0,0.3);
            box-shadow: 0 4px 0 rgba(255,255,255,0.7),
                        0 6px 6px rgba(0,0,0,0.2);
            transition: all 0.2s ease;
            border: none;
        }
        .relieve:active {
            box-shadow: 0 0 0 #357ab7,
                        0 2px 4px rgba(0,0,0,0.2);
        }
        .login-btn {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
            cursor: pointer;
            color: white;
            background: darksalmon;
        }
        .login-btn:hover {
            filter: brightness(110%);
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form method="POST" action="index.php">
        <img src="darksalmon.png" alt="Logo">
        <h2>jocarsa | darksalmon</h2>
        <?php
          if (!empty($login_error)) {
              echo '<div class="error">' . htmlspecialchars($login_error) . '</div>';
          }
        ?>
        <label for="username">Usuario:</label>
        <input type="text" name="usuario" id="username" required>
        <label for="password">Contraseña:</label>
        <input type="password" name="contrasena" id="password" required>
        <input class="relieve login-btn" type="submit" value="Iniciar sesión">
    </form>
</body>
</html>

```
### supercontrolador
**supercontrolador.php**
```php
<?php
// super_controller.php
// This controller handles dynamic CRUD operations for base tables and also supports stored procedure “applications”.
// It has been modified so that when the target is a VIEW (or has no primary key), it works in read‑only mode.
// It also allows procedure actions (accion=crear_app) without requiring a "table" parameter.

include "config.php";

$mysqli = new mysqli($host, $user, $pass, $dbName);
if ($mysqli->connect_errno) {
    die("Connection Error: " . $mysqli->connect_error);
}

// Determine action: listar, crear, editar, eliminar, crear_foreign, or crear_app (stored procedure)
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'listar';

// For a stored procedure call, we do not require a "table" parameter.
if ($accion !== 'crear_app') {
    $table = isset($_GET['table']) ? $mysqli->real_escape_string($_GET['table']) : '';
    if (empty($table)) {
        die("No table specified.");
    }
}

// If we are not handling a stored procedure, do the following:
if ($accion !== 'crear_app') {
    // Determine if the target object is a BASE TABLE or a VIEW.
    $tableTypeQuery = "SELECT TABLE_TYPE FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$table'";
    $resultTableType = $mysqli->query($tableTypeQuery);
    if ($resultTableType && $rowTableType = $resultTableType->fetch_assoc()) {
        $tableType = $rowTableType['TABLE_TYPE']; // "BASE TABLE" or "VIEW"
    } else {
        $tableType = "BASE TABLE";
    }
    // Create a flag: isView
    $isView = ($tableType !== "BASE TABLE");

    // Fetch optional table comment (for display)
    $tableComment = "";
    $tableCommentQuery = "SELECT TABLE_COMMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$table'";
    $resultTableComment = $mysqli->query($tableCommentQuery);
    if ($resultTableComment && $rowTable = $resultTableComment->fetch_assoc()) {
        $tableComment = $rowTable['TABLE_COMMENT'];
    }

    // Fetch column metadata for the table (or view)
    $columns = [];
    // Added COLUMN_TYPE to detect ENUM definitions
    $columnsQuery = "SELECT COLUMN_NAME, DATA_TYPE, COLUMN_TYPE, IS_NULLABLE, COLUMN_DEFAULT, EXTRA, COLUMN_KEY, COLUMN_COMMENT 
                     FROM INFORMATION_SCHEMA.COLUMNS 
                     WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$table'";
    $result = $mysqli->query($columnsQuery);
    if (!$result || $result->num_rows == 0) {
        die("Table not found or no columns available.");
    }
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row;
    }

    // Build foreign keys mapping from metadata (if available)
    $foreignKeys = [];
    $fkQuery = "SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME 
                FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$table' AND REFERENCED_TABLE_NAME IS NOT NULL";
    $resultFK = $mysqli->query($fkQuery);
    if ($resultFK) {
        while ($fk = $resultFK->fetch_assoc()) {
            $foreignKeys[$fk['COLUMN_NAME']] = [
                'referenced_table' => $fk['REFERENCED_TABLE_NAME'],
                'referenced_column' => $fk['REFERENCED_COLUMN_NAME']
            ];
        }
    }

    // For base tables, determine the primary key (assumes one primary key)
    if (!$isView) {
        $primaryKey = null;
        foreach ($columns as $col) {
            if ($col['COLUMN_KEY'] === 'PRI') {
                $primaryKey = $col['COLUMN_NAME'];
                break;
            }
        }
        if (!$primaryKey) {
            die("No primary key found for table '$table'.");
        }
    }
}

 include "funciones/getInputAttributes.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>
    <?php
      if ($accion === 'crear_app' && isset($_GET['sp'])) {
          echo "Dynamic CRUD: Procedure " . htmlspecialchars($_GET['sp']);
      } else {
          echo "Dynamic CRUD: " . htmlspecialchars($table);
      }
    ?>
  </title>
  <style>
   <?php include "estilo/estilo.css";?>
  </style>
</head>
<body>
<div class="cabecerasupercontrolador">
<?php if ($accion !== 'crear_app'): ?>
    <?php if (!$isView): ?>
      <p>
        <a href="?table=<?php echo urlencode($table); ?>&accion=crear" title="Pulsa aquí para crear un nuevo elemento">➕</a>
        <a href="?table=<?php echo urlencode($table); ?>&accion=listar" title="Pulsa aquí para volver al listado de elementos">📋</a>
        <a href="" title="Imprimir vista">🖨</a>
        <?php
			switch ($accion) {
			case 'listar':
				$hasDate = false;
				$hasDateTime = false;
				foreach ($columns as $col) {
					 $attrs = getInputAttributes($col['DATA_TYPE']);
					 if ($attrs['type'] === 'date') {
						  $hasDate = true;
					 }
					 if ($attrs['type'] === 'datetime-local') {
						  $hasDateTime = true;
					 }
				}
				?>
				<!-- VIEW SWITCH BUTTONS -->
			
				 <?php
					// Preserve current GET parameters in the URL:
					$params = $_GET;
					$params['view'] = 'table';
					echo '<a href="' . htmlspecialchars($_SERVER['PHP_SELF'] . '?' . http_build_query($params)) . 
						  '"" title="Ver la información como tabla">📅</a>';
					
					if ($hasDate || $hasDateTime) {
						 $params['view'] = 'calendar';
						 echo '<a href="' . htmlspecialchars($_SERVER['PHP_SELF'] . '?' . http_build_query($params)) .
						      '" title="Ver la información como calendario mensual">📅</a>';
					}
					if ($hasDateTime) {
						 $params['view'] = 'weekly';
						 echo '<a href="' . htmlspecialchars($_SERVER['PHP_SELF'] . '?' . http_build_query($params)) .
						      '" title="Ver la información como calendario semanal">🗓</a>';
					}
				 ?>
			 
				<?php
				break;
			}
			?>
      </p>
      
    <?php else: ?>
      <p><strong>Vista de solo lectura</strong></p>
    <?php endif; ?>
    
  <?php endif; ?>
  
  <?php
    // Display header
    if ($accion === 'crear_app' && isset($_GET['sp'])) {
        echo "<h2>Stored Procedure Application: " . htmlspecialchars($_GET['sp']) . "</h2>";
    } else {
        
        if (!empty($tableComment)) {
            echo "<p><em><strong>" . htmlspecialchars($table)."</strong>: ".htmlspecialchars($tableComment) . "</em></p>";
        }
    }
  ?>
  
  
</div>

<?php
switch ($accion) {

  // ----------------------------
  // List all records
  case 'listar':
      include "acciones/listar.php";
      break;
  // ----------------------------
  // Create new record (Form A)
  case 'crear':
     include "acciones/crear.php";
      break;

  // ----------------------------
  // Edit existing record (Form B)
  case 'editar':
      include "acciones/editar.php";
      break;

  // ----------------------------
  // Delete record
  case 'eliminar':
      include "acciones/eliminar.php";
      break;

  // ----------------------------
  // Create new foreign record (crear_foreign)
  case 'crear_foreign':
        include "acciones/foreign.php";
        break;

  // ----------------------------
  // Stored Procedure Application (crear_app)
  case 'crear_app':
      include "acciones/crearapp.php";
      break;

  default:
      echo "<p>Acción no reconocida.</p>";
      break;
}
$mysqli->close();
?>

```
#### acciones
**crear.php**
```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Store posted data to repopulate form on error
    $_SESSION['formA_data'] = $_POST;

    $fields = [];
    $placeholders = [];
    $types = "";
    $values = [];

    foreach ($columns as $col) {
        if (strpos($col['EXTRA'], "auto_increment") !== false) continue;
        $colName = $col['COLUMN_NAME'];
        $fields[] = "`$colName`";
        $placeholders[] = "?";
        $attrs = getInputAttributes($col['DATA_TYPE']);
        $types .= $attrs['bind'];

        if ($attrs['type'] === 'file' && isset($_FILES[$colName]) && $_FILES[$colName]['size'] > 0) {
            $fileContent = file_get_contents($_FILES[$colName]['tmp_name']);
            $values[] = $fileContent;
        } else {
            $values[] = $_POST[$colName] ?? '';
        }
    }

    if (count($fields) > 0) {
        $sql = "INSERT INTO `$table` (" . implode(", ", $fields) . ") VALUES (" . implode(", ", $placeholders) . ")";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $mysqli->error);
        }
        // bind params dynamically
        $bind_names = [$types];
        foreach ($values as &$v) {
            $bind_names[] = &$v;
        }
        call_user_func_array([$stmt, 'bind_param'], $bind_names);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        $stmt->close();
    }

    unset($_SESSION['formA_data']);
    echo '<script>window.location="?table=' . urlencode($table) . '&accion=listar"</script>';
    exit;
} else {
    $savedData = $_SESSION['formA_data'] ?? [];

    echo "<h3>Crear Nuevo Registro</h3>";
    echo "<form method='post' action='?table=" . urlencode($table) . "&accion=crear' class='crud-form' enctype='multipart/form-data'>";

    foreach ($columns as $col) {
        if (strpos($col['EXTRA'], "auto_increment") !== false) continue;
        $colName = $col['COLUMN_NAME'];
        $comment = $col['COLUMN_COMMENT'] ? "<br><span class='column-comment'>{$col['COLUMN_COMMENT']}</span>" : '';
        $defaultValue = $savedData[$colName] ?? ($_GET[$colName] ?? '');
        $attrs = getInputAttributes($col['DATA_TYPE']);

        echo "<fieldset>";
        echo "<label>" . htmlspecialchars($colName) . ":{$comment}</label>";

        if ($attrs['type'] === 'file') {
            echo "<input type='file' name='" . htmlspecialchars($colName) . "'>";
        } elseif (isset($foreignKeys[$colName])) {
            // Existing foreign key handling
            $ref = $foreignKeys[$colName];
            $fkRes = $mysqli->query("SELECT * FROM `{$ref['referenced_table']}`");
            echo "<select name='" . htmlspecialchars($colName) . "'>";
            while ($fkRow = $fkRes->fetch_assoc()) {
                $val = $fkRow[$ref['referenced_column']];
                $disp = htmlspecialchars(implode(" - ", $fkRow));
                $sel = ($defaultValue == $val) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($val) . "' $sel>$disp</option>";
            }
            echo "</select>";
            // link to create new foreign
            $cur = urlencode($_SERVER['REQUEST_URI']);
            echo " <a href='?table=" . urlencode($table) . "&accion=crear_foreign&foreign_field=" . urlencode($colName)
                 . "&foreign_table=" . urlencode($ref['referenced_table'])
                 . "&return_url=$cur'>+</a>";
        } elseif ($col['DATA_TYPE'] === 'tinyint') {
            echo "<input type='hidden' name='$colName' value='0'>";
            $chk = ($defaultValue == 1) ? 'checked' : '';
            echo "<label><input type='checkbox' name='$colName' value='1' $chk> "
                 . htmlspecialchars($colName) . "</label>";
        } elseif ($col['DATA_TYPE'] === 'enum') {
            preg_match_all("/'([^']+)'/", $col['COLUMN_TYPE'], $m);
            echo "<select name='" . htmlspecialchars($colName) . "'>";
            foreach ($m[1] as $opt) {
                $sel = ($defaultValue === $opt) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($opt) . "' $sel>" . htmlspecialchars($opt) . "</option>";
            }
            echo "</select>";
        } else {
            if ($attrs['type'] === 'textarea') {
                echo "<textarea name='" . htmlspecialchars($colName) . "'>" . htmlspecialchars($defaultValue) . "</textarea>";
            } else {
                echo "<input type='" . htmlspecialchars($attrs['type']) . "'"
                     . " name='" . htmlspecialchars($colName) . "'"
                     . " value='" . htmlspecialchars($defaultValue) . "'";
                if (isset($attrs['step'])) echo " step='" . htmlspecialchars($attrs['step']) . "'";
                echo ">";
            }
        }

        echo "</fieldset>";
    }

    echo "<br><button type='submit'>Crear</button>";
    echo "</form>";
}
?>


```
**crearapp.php**
```php
<?php
if (!isset($_GET['sp'])) {
    die("No stored procedure specified.");
}
$spName = $mysqli->real_escape_string($_GET['sp']);

// Obtain IN parameters for the stored procedure.
$spParamsQuery = "SELECT PARAMETER_NAME, DATA_TYPE
                  FROM INFORMATION_SCHEMA.PARAMETERS
                  WHERE SPECIFIC_SCHEMA='$dbName'
                    AND SPECIFIC_NAME='$spName'
                    AND PARAMETER_MODE='IN'
                  ORDER BY ORDINAL_POSITION";
$spParamsResult = $mysqli->query($spParamsQuery);
if (!$spParamsResult || $spParamsResult->num_rows == 0) {
    echo "No parameters found for stored procedure '$spName'.";
    exit;
}
$spParams = [];
while ($paramRow = $spParamsResult->fetch_assoc()) {
    $paramName = ltrim($paramRow['PARAMETER_NAME'], '@');
    $spParams[] = [
        'name' => $paramName,
        'data_type' => $paramRow['DATA_TYPE']
    ];
}

// Build a global foreign-key mapping for the current database.
$fkGlobalQuery = "SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
                  FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                  WHERE TABLE_SCHEMA='$dbName' AND REFERENCED_TABLE_NAME IS NOT NULL";
$globalFKResult = $mysqli->query($fkGlobalQuery);
$globalFK = [];
if ($globalFKResult) {
    while ($fk = $globalFKResult->fetch_assoc()) {
        // If multiple tables define the same column name as a foreign key, mark as ambiguous.
        $col = $fk['COLUMN_NAME'];
        if (isset($globalFK[$col])) {
            $globalFK[$col] = null;
        } else {
            $globalFK[$col] = [
                'referenced_table' => $fk['REFERENCED_TABLE_NAME'],
                'referenced_column' => $fk['REFERENCED_COLUMN_NAME']
            ];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paramPlaceholders = [];
    $paramTypes = "";
    $paramValues = [];
    foreach ($spParams as $param) {
        $pname = $param['name'];
        $paramPlaceholders[] = "?";
        // For simplicity, bind all values as strings.
        $paramTypes .= "s";
        $paramValues[] = isset($_POST[$pname]) ? $_POST[$pname] : '';
    }
    $stmt = $mysqli->prepare("CALL $spName(" . implode(",", $paramPlaceholders) . ")");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }
    $bind_names = [];
    $bind_names[] = $paramTypes;
    for ($i = 0; $i < count($paramValues); $i++) {
        $bind_names[] = &$paramValues[$i];
    }
    call_user_func_array(array($stmt, 'bind_param'), $bind_names);
    if (!$stmt->execute()) {
        die("Stored procedure execution failed: " . $stmt->error);
    }

    // Check if the procedure returns a result set
    $result = $stmt->get_result();
    if ($result) {
        // Display results in a table
        echo "<h3>Resultados de la llamada al procedimiento almacenado '$spName':</h3>";
        echo "<table border='1'>";
        echo "<thead><tr>";
        $fields = $result->fetch_fields();
        foreach ($fields as $field) {
            echo "<th>" . htmlspecialchars($field->name) . "</th>";
        }
        echo "</tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
        $result->free();
    } else {
        echo "<p>Procedimiento ejecutado correctamente.</p>";
    }
    $stmt->close();
    exit;
} else {
    echo "<h3>Ejecutar Procedimiento Almacenado: $spName</h3>";
    echo "<form method='post' action='?accion=crear_app&sp=" . urlencode($spName) . "' class='crud-form'>";
    foreach ($spParams as $param) {
        echo "<fieldset>";
        $paramName = $param['name'];
        $paramDataType = strtolower($param['data_type']);
        $inputAttrs = getInputAttributes($paramDataType);
        echo "<label>" . htmlspecialchars($paramName) . " (" . htmlspecialchars($paramDataType) . "):</label>";
        // Use foreign key mapping if available and unambiguous.
        if (isset($globalFK[$paramName]) && $globalFK[$paramName] !== null) {
            $refTable = $globalFK[$paramName]['referenced_table'];
            $refColumn = $globalFK[$paramName]['referenced_column'];
            $fkQuery = "SELECT * FROM `$refTable`";
            $fkResult = $mysqli->query($fkQuery);
            if ($fkResult) {
                echo "<select name='" . htmlspecialchars($paramName) . "' required>";
                while ($fkRow = $fkResult->fetch_assoc()) {
                    $optionValue = $fkRow[$refColumn];
                    $optionDisplay = implode(" - ", array_map('htmlspecialchars', $fkRow));
                    echo "<option value=\"" . htmlspecialchars($optionValue) . "\">" . htmlspecialchars($optionDisplay) . "</option>";
                }
                echo "</select>";
            } else {
                // If the select fails, fall back to input using data type mapping.
                if ($inputAttrs['type'] === 'textarea') {
                    echo "<textarea name='" . htmlspecialchars($paramName) . "' required></textarea>";
                } else {
                    echo "<input type='" . htmlspecialchars($inputAttrs['type']) . "' name='" . htmlspecialchars($paramName) . "' required";
                    if (isset($inputAttrs['step'])) {
                        echo " step='" . htmlspecialchars($inputAttrs['step']) . "'";
                    }
                    echo ">";
                }
            }
        } else {
            // Render an appropriate input control based on the parameter's data type.
            if ($inputAttrs['type'] === 'textarea') {
                echo "<textarea name='" . htmlspecialchars($paramName) . "' required></textarea>";
            } else {
                echo "<input type='" . htmlspecialchars($inputAttrs['type']) . "' name='" . htmlspecialchars($paramName) . "' required";
                if (isset($inputAttrs['step'])) {
                    echo " step='" . htmlspecialchars($inputAttrs['step']) . "'";
                }
                echo ">";
            }
        }
        echo "</fieldset>";
    }
    echo "<br><button type='submit'>Ejecutar Procedimiento</button>";
    echo "</form>";
}
?>


```
**editar.php**
```php
<?php
if (!isset($_GET['id'])) {
    die("No ID provided for edit.");
}
$id = $mysqli->real_escape_string($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $setClauses = [];
    $types = "";
    $values = [];
    foreach ($columns as $col) {
        if ($col['COLUMN_NAME'] === $primaryKey && strpos($col['EXTRA'], "auto_increment") !== false) continue;
        $colName = $col['COLUMN_NAME'];
        if (isset($_POST[$colName])) {
            $setClauses[] = "`$colName` = ?";
            $attrs = getInputAttributes($col['DATA_TYPE']);
            $types .= $attrs['bind'];
            if ($attrs['type'] === 'file' && isset($_FILES[$colName]) && $_FILES[$colName]['size'] > 0) {
                $fileContent = file_get_contents($_FILES[$colName]['tmp_name']);
                $values[] = $fileContent;
            } else {
                $values[] = $_POST[$colName];
            }
        }
    }
    $types .= "i";
    $values[] = $id;
    $sql = "UPDATE `$table` SET " . implode(", ", $setClauses) . " WHERE `$primaryKey` = ?";
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }
    $bind_names = [];
    $bind_names[] = $types;
    foreach ($values as &$v) {
        $bind_names[] = &$v;
    }
    call_user_func_array(array($stmt, 'bind_param'), $bind_names);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
    $stmt->close();
    echo '<script>window.location = "?table=' . urlencode($table) . '&accion=listar"</script>';
    exit;
} else {
    $query = "SELECT * FROM `$table` WHERE `$primaryKey` = '$id' LIMIT 1";
    $result = $mysqli->query($query);
    if (!$result || $result->num_rows == 0) {
        die("Record not found.");
    }
    $record = $result->fetch_assoc();
    echo "<h3>Editar Registro (ID: " . htmlspecialchars($id) . ")</h3>";
    echo "<form method='post' action='?table=" . urlencode($table) . "&accion=editar&id=" . urlencode($id) . "' class='crud-form' enctype='multipart/form-data'>";
    foreach ($columns as $col) {
        if ($col['COLUMN_NAME'] === $primaryKey && strpos($col['EXTRA'], "auto_increment") !== false) {
            echo "<fieldset>";
            echo "<p><strong>" . htmlspecialchars($col['COLUMN_NAME']) . "</strong>: " . htmlspecialchars($record[$col['COLUMN_NAME']]) . "</p>";
            echo "</fieldset>";
            continue;
        }
        echo "<fieldset>";
        $colName = $col['COLUMN_NAME'];
        $attrs = getInputAttributes($col['DATA_TYPE']);
        $value = isset($record[$colName]) ? $record[$colName] : "";
        if ($attrs['type'] === 'datetime-local') {
            $value = str_replace(' ', 'T', $value);
        }
        echo "<label>" . htmlspecialchars($colName) . ":";
        if (!empty($col['COLUMN_COMMENT'])) {
            echo "<br><span class='column-comment'>" . htmlspecialchars($col['COLUMN_COMMENT']) . "</span>";
        }
        echo "</label>";

        if ($attrs['type'] === 'file') {
            if (empty($value)) {
                // Handle empty file value
                echo "<p>No file</p>";
            } else {
                // Save BLOB data to a temporary file
                $tempFilePath = tempnam(sys_get_temp_dir(), 'blob') . '.bin';
                file_put_contents($tempFilePath, $value);

                // Determine the file type
                $fileType = mime_content_type($tempFilePath);

                // Delete the temporary file
                unlink($tempFilePath);

                if ($fileType === false) {
                    // Handle invalid file type
                    echo "<p>Invalid file</p>";
                } else {
                    // Check if the file is an image
                    if (strpos($fileType, 'image/') === 0) {
                        echo "<img src='data:$fileType;base64," . base64_encode($value) . "' style='max-width:100px; max-height:100px;'><br>";
                    } else {
                        echo "<a href='data:$fileType;base64," . base64_encode($value) . "' download='file'>Download current file</a><br>";
                    }
                }
            }
            echo "<input type='file' name='" . htmlspecialchars($colName) . "'>";
        } elseif ($col['DATA_TYPE'] === 'tinyint') {
            echo "<input type='hidden' name='" . $colName . "' value='0'>";
            $checked = ($value == 1) ? "checked" : "";
            echo "<label><input type='checkbox' name='" . $colName . "' value='1' " . $checked . "> " . htmlspecialchars($colName) . "</label>";
        } elseif ($col['DATA_TYPE'] === 'enum') {
            preg_match_all("/'([^']+)'/", $col['COLUMN_TYPE'], $m);
            $opts = $m[1] ?? [];
            echo "<select name='" . $colName . "'>";
            foreach ($opts as $o) {
                $sel = ($value === $o) ? "selected" : "";
                echo "<option value=\"" . htmlspecialchars($o) . "\" " . $sel . ">" . htmlspecialchars($o) . "</option>";
            }
            echo "</select>";
        } elseif (isset($foreignKeys[$colName])) {
            $ref = $foreignKeys[$colName];
            $refTable = $ref['referenced_table'];
            $refColumn = $ref['referenced_column'];
            $dispQuery = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$refTable' AND COLUMN_KEY <> 'PRI' ORDER BY ORDINAL_POSITION LIMIT 1";
            $dispRes = $mysqli->query($dispQuery);
            $displayColumn = ($dispRes && $r = $dispRes->fetch_assoc()) ? $r['COLUMN_NAME'] : $refColumn;
            $fkQuery = "SELECT `$refColumn` as ref_val, `$displayColumn` as ref_disp FROM `$refTable`";
            $fkResult = $mysqli->query($fkQuery);
            echo "<select name='" . htmlspecialchars($colName) . "'>";
            while ($fkRow = $fkResult->fetch_assoc()) {
                $sel = ($fkRow['ref_val'] == $value) ? "selected" : "";
                echo "<option value=\"" . htmlspecialchars($fkRow['ref_val']) . "\" " . $sel . ">" . htmlspecialchars($fkRow['ref_disp']) . "</option>";
            }
            echo "</select>";
        } elseif ($attrs['type'] === 'textarea') {
            echo "<textarea name='" . htmlspecialchars($colName) . "'>" . htmlspecialchars($value) . "</textarea>";
        } else {
            echo "<input type='" . htmlspecialchars($attrs['type']) . "' name='" . htmlspecialchars($colName) . "' value=\"" . htmlspecialchars($value) . "\"";
            if (isset($attrs['step'])) echo " step='" . htmlspecialchars($attrs['step']) . "'";
            echo ">";
        }

        echo "</fieldset>";
    }
    echo "<br><button type='submit'>Guardar Cambios</button>";
    echo "</form>";
}
?>


```
**eliminar.php**
```php
<?php
if (!isset($_GET['id'])) {
          die("No ID provided for deletion.");
      }
      $id = $mysqli->real_escape_string($_GET['id']);
      $sql = "DELETE FROM `$table` WHERE `$primaryKey` = ?";
      $stmt = $mysqli->prepare($sql);
      if (!$stmt) {
          die("Prepare failed: " . $mysqli->error);
      }
      $stmt->bind_param("i", $id);
      if (!$stmt->execute()) {
          die("Deletion failed: " . $stmt->error);
      }
      $stmt->close();
      echo '<script>window.location = "?table=' . urlencode($table) . '&accion=listar"</script>';
      exit;
?>

```
**foreign.php**
```php
<?php
$foreign_field = isset($_GET['foreign_field']) ? $mysqli->real_escape_string($_GET['foreign_field']) : '';
        $foreign_table = isset($_GET['foreign_table']) ? $mysqli->real_escape_string($_GET['foreign_table']) : '';
        $return_url    = isset($_GET['return_url']) ? urldecode($_GET['return_url']) : '';
        
        if (empty($foreign_field) || empty($foreign_table) || empty($return_url)) {
            die("Faltan parámetros necesarios para crear el registro foráneo.");
        }
        
        // Retrieve column metadata for the foreign table.
        $fkColumns = [];
        $columnsQuery = "SELECT COLUMN_NAME, DATA_TYPE, EXTRA, COLUMN_COMMENT 
                         FROM INFORMATION_SCHEMA.COLUMNS 
                         WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$foreign_table'";
        $resultFkCols = $mysqli->query($columnsQuery);
        if (!$resultFkCols || $resultFkCols->num_rows == 0) {
            die("Tabla foránea no encontrada o sin columnas.");
        }
        while ($row = $resultFkCols->fetch_assoc()) {
            $fkColumns[] = $row;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fields = [];
            $placeholders = [];
            $types = "";
            $values = [];
            foreach ($fkColumns as $col) {
                if (strpos($col['EXTRA'], "auto_increment") !== false) continue;
                $colName = $col['COLUMN_NAME'];
                // Allow URL parameters to pre-fill foreign form as well.
                $fkDefault = "";
                if (isset($_GET[$colName])) {
                    $fkDefault = $_GET[$colName];
                }
                if (isset($_POST[$colName])) {
                    $fkDefault = $_POST[$colName];
                }
                $fields[] = "$colName";
                $placeholders[] = "?";
                $attrs = getInputAttributes($col['DATA_TYPE']);
                $types .= $attrs['bind'];
                $values[] = $fkDefault;
            }
            if (count($fields) > 0) {
                $sql = "INSERT INTO $foreign_table (" . implode(", ", $fields) . ") VALUES (" . implode(", ", $placeholders) . ")";
                $stmt = $mysqli->prepare($sql);
                if (!$stmt) {
                    die("Prepare failed: " . $mysqli->error);
                }
                $bind_names = [];
                $bind_names[] = $types;
                for ($i = 0; $i < count($values); $i++) {
                    $bind_names[] = &$values[$i];
                }
                call_user_func_array(array($stmt, 'bind_param'), $bind_names);
                if (!$stmt->execute()) {
                    die("Execute failed: " . $stmt->error);
                }
                $newId = $stmt->insert_id;
                $stmt->close();
                
                // Append the new foreign record id as a parameter (e.g. new_<foreign_field>=<newId>) to the return URL.
                $param = "new_" . urlencode($foreign_field) . "=" . urlencode($newId);
                if (strpos($return_url, '?') !== false) {
                    $return_url .= "&" . $param;
                } else {
                    $return_url .= "?" . $param;
                }
                echo '<script>window.location = "'.$return_url.'"</script>';
                echo $return_url;
                //header("Location: " . $return_url);
                exit;
            }
        } else {
            // Display form for creating a new record in the foreign table (Form B).
            echo "<h2>Crear nuevo registro en " . htmlspecialchars($foreign_table) . "</h2>";
            echo "<form method='post' action='?table=" . urlencode($table) 
                 . "&accion=crear_foreign"
                 . "&foreign_field=" . urlencode($foreign_field)
                 . "&foreign_table=" . urlencode($foreign_table)
                 . "&return_url=" . urlencode($return_url)
                 . "' class='crud-form'>";
            foreach ($fkColumns as $col) {
                if (strpos($col['EXTRA'], "auto_increment") !== false) continue;
                echo "<fieldset>";
                $colName = $col['COLUMN_NAME'];
                $attrs = getInputAttributes($col['DATA_TYPE']);
                // Pre-fill using GET if available.
                $fkDefault = "";
                if (isset($_GET[$colName])) {
                    $fkDefault = $_GET[$colName];
                }
                echo "<label>" . htmlspecialchars($colName) . ":";
                if (!empty($col['COLUMN_COMMENT'])) {
                    echo "<br><span class='column-comment'>" . htmlspecialchars($col['COLUMN_COMMENT']) . "</span>";
                }
                echo "</label>";
                if ($attrs['type'] === 'textarea') {
                    echo "<textarea name='" . htmlspecialchars($colName) . "'>" . htmlspecialchars($fkDefault) . "</textarea>";
                } else {
                    echo "<input type='" . htmlspecialchars($attrs['type']) . "' name='" . htmlspecialchars($colName) . "' value='" . htmlspecialchars($fkDefault) . "'";
                    if (isset($attrs['step'])) {
                        echo " step='" . htmlspecialchars($attrs['step']) . "'";
                    }
                    echo " required>";
                }
                echo "</fieldset>";
            }
            echo "<button type='submit'>Crear registro</button>";
            echo "</form>";
            echo '<p><a href="' . htmlspecialchars($return_url) . '">Cancelar y volver</a></p>';
        }
?>

```
**listar.php**
```php
<?php
// ======================================================
// Modified acciones/listar.php
// This file displays records from the selected table ($table)
// with:
//   1. A search filter row (inputs for text columns and select
//      dropdowns for FK columns populated from the referenced table).
//   2. Clickable column headings for sorting (toggling ASC/DESC).
//   3. Three view types:
//         a. "table" view (standard view with search and sorting)
//         b. "calendar" view (a monthly calendar rendered in its own table)
//         c. "weekly" view (a weekly calendar rendered in its own table)
//   4. In all views, FK fields are shown as friendly concatenated text.
//
// It assumes that the supercontrolador has defined:
//    $table: the table (or view) name.
//    $columns: an array of column metadata.
//    $isView: boolean flag (true if target is a VIEW).
//    $primaryKey: primary key column name (for BASE TABLEs).
//    $foreignKeys: an associative array for FK columns (e.g.,
//           'cliente_id' => ['referenced_table' => 'clientes', 'referenced_column' => 'id']).
//    $mysqli: an open MySQLi connection.
//    getInputAttributes($dataType): helper that maps SQL types to HTML input attributes.
// ======================================================

// ------------------------------
// 1. Process search filters (for table view only)
// ------------------------------
$searchFilters = [];
foreach ($columns as $col) {
    $colName = $col['COLUMN_NAME'];
    if (!empty($_GET["f_$colName"])) {
        $value = $mysqli->real_escape_string($_GET["f_$colName"]);
        $searchFilters[$colName] = $value;
    }
}
$whereClause = "";
if (!empty($searchFilters)) {
    $conditions = [];
    foreach ($searchFilters as $colName => $value) {
        $conditions[] = "`$colName` LIKE '%$value%'";
    }
    $whereClause = " WHERE " . implode(" OR ", $conditions);
}

// ------------------------------
// 2. Process ordering (for table view only)
// ------------------------------
$order = isset($_GET['order']) ? $_GET['order'] : "";
$dir = (isset($_GET['dir']) && strtoupper($_GET['dir']) === 'DESC') ? 'DESC' : 'ASC';
$validColumns = array_map(function($col){ return $col['COLUMN_NAME']; }, $columns);
if ($order && in_array($order, $validColumns)) {
    $orderClause = " ORDER BY `$order` $dir";
} else {
    if (!$isView) {
        $orderClause = " ORDER BY `$primaryKey` DESC";
    } else {
        $orderClause = " ORDER BY `" . $columns[0]['COLUMN_NAME'] . "` DESC";
    }
}

// ------------------------------
// 3. Build and execute the main query (for all views)
// ------------------------------
$query = "SELECT * FROM `$table`" . $whereClause . $orderClause;
$result = $mysqli->query($query);
if (!$result) {
    die("Error in query: " . $mysqli->error);
}

// ------------------------------
// 4. Initialize a cache for friendly FK display
// ------------------------------
$fkDisplayCache = [];

// ------------------------------
// 5. Detect if any column is of type date/datetime (for calendar views)
// ------------------------------
$hasDate = false;
$hasDateTime = false;
foreach ($columns as $col) {
    $attrs = getInputAttributes($col['DATA_TYPE']);
    if ($attrs['type'] === 'date') {
        $hasDate = true;
    }
    if ($attrs['type'] === 'datetime-local') {
        $hasDateTime = true;
    }
}

// ------------------------------
// 6. Determine requested view type; default is "table"
// ------------------------------
$viewType = isset($_GET['view']) ? $_GET['view'] : 'table';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($table); ?> - List View</title>
  <!-- You may include your CSS here -->
</head>
<body>
  <!-- VIEW SWITCH BUTTONS -->
  <div class="view-type-options" style="margin-bottom:10px;">
    <?php
    /*
      // Preserve current GET parameters in the URL:
      $params = $_GET;
      $params['view'] = 'table';
      echo '<a href="' . htmlspecialchars($_SERVER['PHP_SELF'] . '?' . http_build_query($params)) .
           '" style="margin-right:10px; padding:5px 10px; background:#eee; text-decoration:none;">Ver como Tabla</a>';

      if ($hasDate || $hasDateTime) {
          $params['view'] = 'calendar';
          echo '<a href="' . htmlspecialchars($_SERVER['PHP_SELF'] . '?' . http_build_query($params)) .
               '" style="margin-right:10px; padding:5px 10px; background:#eee; text-decoration:none;">Ver como Calendario (Mensual)</a>';
      }
      if ($hasDateTime) {
          $params['view'] = 'weekly';
          echo '<a href="' . htmlspecialchars($_SERVER['PHP_SELF'] . '?' . http_build_query($params)) .
               '" style="padding:5px 10px; background:#eee; text-decoration:none;">Ver como Calendario (Semanal)</a>';
      }
      */
    ?>
  </div>

  <?php if($viewType === 'table'): ?>
    <!-- A. Standard Table View -->
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <!-- Preserve required GET parameters -->
      <input type="hidden" name="table" value="<?php echo htmlspecialchars($table); ?>">
      <input type="hidden" name="accion" value="listar">
      <?php
      if (!empty($order)) echo '<input type="hidden" name="order" value="' . htmlspecialchars($order) . '">';
      if (!empty($dir)) echo '<input type="hidden" name="dir" value="' . htmlspecialchars($dir) . '">';
      if (isset($_GET['view'])) echo '<input type="hidden" name="view" value="' . htmlspecialchars($_GET['view']) . '">';
      ?>
      <table border="1" style="width:100%; text-align:center;">
        <?php
       	 include "componenteslistar/cabezatabla.php";
        ?>
        <?php
        	include "componenteslistar/cuerpotabla.php";
        ?>
      </table>
    </form>

  <?php elseif($viewType === 'calendar' && ($hasDate || $hasDateTime)): ?>
    <!-- B. Monthly Calendar View (renders a separate table) -->
    <?php
    	include "componenteslistar/calendariomensual.php";
    ?>

  <?php elseif($viewType === 'weekly' && $hasDateTime): ?>
    <!-- C. Weekly Calendar View (separate table) -->
    <?php
    	include "componenteslistar/calendariosemanal.php";
    ?>
  <?php endif; ?>

</body>
</html>



```
##### componenteslistar
**cabezatabla.php**
```php

<thead>
          <!-- Row 1: Search Filter Row -->
          <tr>
            <?php foreach ($columns as $col):
              $colName = $col['COLUMN_NAME']; ?>
              <th>
                <?php
                if (isset($foreignKeys[$colName])):
                  $refTable = $foreignKeys[$colName]['referenced_table'];
                  $refColumn = $foreignKeys[$colName]['referenced_column'];
                  $fkOptionsQuery = "SELECT * FROM `$refTable`";
                  $fkOptionsResult = $mysqli->query($fkOptionsQuery);
                  if ($fkOptionsResult):
                  ?>
                    <select name="f_<?php echo htmlspecialchars($colName); ?>" style="width:100%;">
                      <option value="">-- All --</option>
                      <?php while($fkRow = $fkOptionsResult->fetch_assoc()):
                        $optionValue = $fkRow[$refColumn];
                        $optionText = implode(" - ", $fkRow);
                        $selected = (isset($_GET["f_$colName"]) && $_GET["f_$colName"] == $optionValue) ? "selected" : "";
                      ?>
                        <option value="<?php echo htmlspecialchars($optionValue); ?>" <?php echo $selected; ?>>
                          <?php echo htmlspecialchars($optionText); ?>
                        </option>
                      <?php endwhile; ?>
                    </select>
                  <?php else:
                      $filterValue = isset($_GET["f_$colName"]) ? $_GET["f_$colName"] : "";
                      echo '<input type="text" name="f_' . htmlspecialchars($colName) .
                           '" value="' . htmlspecialchars($filterValue) .
                           '" placeholder="Search ' . htmlspecialchars($colName) . '" style="width:95%;">';
                  endif;
                else:
                  $filterValue = isset($_GET["f_$colName"]) ? $_GET["f_$colName"] : "";
                  echo '<input type="text" name="f_' . htmlspecialchars($colName) .
                       '" value="' . htmlspecialchars($filterValue) .
                       '" placeholder="Buscar por ' . htmlspecialchars($colName) . '" style="width:95%;" title="Busca por el criterio: ' . htmlspecialchars($colName) . '">';
                endif;
                ?>
              </th>
            <?php endforeach;
            if (!$isView): ?>
              <th>
                <button type="submit" title="Comienza la búsqueda" style="width:100%; font-size:16px;">&#128269;</button>
              </th>
            <?php endif; ?>
          </tr>
          <!-- Row 2: Column Headers with Sorting Links -->
          <tr>
            <?php foreach ($columns as $col):
              $colName = $col['COLUMN_NAME'];
              $newDir = 'ASC'; $orderIcon = "";
              if ($order === $colName):
                if ($dir === 'ASC'):
                  $newDir = 'DESC';
                  $orderIcon = " &#9650;";
                else:
                  $newDir = 'ASC';
                  $orderIcon = " &#9660;";
                endif;
              endif;
              $queryParams = [
                  'table' => $table,
                  'accion' => 'listar',
                  'order' => $colName,
                  'dir' => $newDir
              ];
              foreach ($columns as $filterCol):
                $fName = $filterCol['COLUMN_NAME'];
                if (!empty($_GET["f_$fName"])):
                  $queryParams["f_$fName"] = $_GET["f_$fName"];
                endif;
              endforeach;
              if (isset($_GET['view'])):
                $queryParams['view'] = $_GET['view'];
              endif;
              $sortUrl = $_SERVER['PHP_SELF'] . "?" . http_build_query($queryParams);
            ?>
              <th><a href="<?php echo htmlspecialchars($sortUrl); ?>" style="text-decoration:none; color:inherit;">
                <?php echo htmlspecialchars($colName) . $orderIcon; ?>
              </a></th>
            <?php endforeach;
            if (!$isView): ?>
              <th>Acciones</th>
            <?php endif; ?>
          </tr>
        </thead>


```
**calendariomensual.php**
```php
<?php
      // Reload all rows into an array.
      $rows = [];
      while($row = $result->fetch_assoc()):
        $rows[] = $row;
      endwhile;
      // Choose the event field: the first column that is date or datetime.
      $eventColumn = "";
      foreach($columns as $col):
        $attrs = getInputAttributes($col['DATA_TYPE']);
        if($attrs['type'] === 'date' || $attrs['type'] === 'datetime-local'):
          $eventColumn = $col['COLUMN_NAME'];
          break;
        endif;
      endforeach;
      if ($eventColumn === ""):
        echo "<p>No se encontró un campo de tipo date o datetime.</p>";
      else:
        // Group rows by date key (Y-m-d).
        $events = [];
        foreach($rows as $row):
          if(!empty($row[$eventColumn])):
            $dateKey = date("Y-m-d", strtotime($row[$eventColumn]));
            if (!isset($events[$dateKey])):
              $events[$dateKey] = [];
            endif;
            $events[$dateKey][] = $row;
          endif;
        endforeach;
        $month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
        $year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
        $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
        $daysInMonth = date('t', $firstDayOfMonth);
        $startDay = date('w', $firstDayOfMonth);

        $prevMonth = $month - 1; $prevYear = $year; if($prevMonth < 1){$prevMonth = 12; $prevYear--; }
        $nextMonth = $month + 1; $nextYear = $year; if($nextMonth > 12){$nextMonth = 1; $nextYear++; }
    ?>
    <table border="1" style="width:100%; text-align:center;">
      <tr>
        <td colspan="7">
          <div style="margin-bottom:10px;">
            <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . http_build_query(array_merge($_GET, ['view'=>'calendar','month'=>$prevMonth,'year'=>$prevYear]))); ?>">Anterior</a>
            | Mes: <?php echo "$month / $year"; ?> |
            <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . http_build_query(array_merge($_GET, ['view'=>'calendar','month'=>$nextMonth,'year'=>$nextYear]))); ?>">Siguiente</a>
          </div>
        </td>
      </tr>
      <tr>
        <?php
          $daysOfWeek = ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'];
          foreach($daysOfWeek as $day):
            echo "<th>$day</th>";
          endforeach;
        ?>
      </tr>
      <?php
        echo "<tr>";
        for($i = 0; $i < $startDay; $i++): echo "<td></td>"; endfor;
        $dayCounter = 1;
        for($i = $startDay; $i < 7; $i++):
          $currentDate = sprintf("%04d-%02d-%02d", $year, $month, $dayCounter);
          echo "<td valign='top'><strong>$dayCounter</strong><br>";
          if(isset($events[$currentDate])):
            foreach($events[$currentDate] as $event):
              $eventDisplay = [];
              foreach($columns as $col):
                $colName = $col['COLUMN_NAME'];
                $value = isset($event[$colName]) ? $event[$colName] : "";
                if(isset($foreignKeys[$colName])):
                  if(!isset($fkDisplayCache[$colName])):
                    $fkDisplayCache[$colName] = [];
                  endif;
                  if(!isset($fkDisplayCache[$colName][$value])):
                    $refTable = $foreignKeys[$colName]['referenced_table'];
                    $refColumn = $foreignKeys[$colName]['referenced_column'];
                    $fkQuery = "SELECT * FROM `$refTable` WHERE `$refColumn` = '" . $mysqli->real_escape_string($value) . "' LIMIT 1";
                    $fkResult = $mysqli->query($fkQuery);
                    if($fkResult && $fkResult->num_rows > 0):
                      $fkRow = $fkResult->fetch_assoc();
                      $friendly = implode(" - ", $fkRow);
                    else:
                      $friendly = $value;
                    endif;
                    $fkDisplayCache[$colName][$value] = $friendly;
                  else:
                    $friendly = $fkDisplayCache[$colName][$value];
                  endif;
                  $eventDisplay[] = $friendly;
                else:
                  $eventDisplay[] = $value;
                endif;
              endforeach;
              echo "<div style='margin-top:3px; font-size:0.8em; background:#e0e0e0; padding:8px;'>";
              echo htmlspecialchars(implode(" | ", $eventDisplay));
              echo "</div>";
            endforeach;
          endif;
          echo "</td>";
          $dayCounter++;
        endfor;
        while($dayCounter <= $daysInMonth):
          echo "</tr><tr>";
          for($i = 0; $i < 7 && $dayCounter <= $daysInMonth; $i++):
            $currentDate = sprintf("%04d-%02d-%02d", $year, $month, $dayCounter);
            echo "<td valign='top'><strong>$dayCounter</strong><br>";
            if(isset($events[$currentDate])):
              foreach($events[$currentDate] as $event):
                $eventDisplay = [];
                foreach($columns as $col):
                  $colName = $col['COLUMN_NAME'];
                  $value = isset($event[$colName]) ? $event[$colName] : "";
                  if(isset($foreignKeys[$colName])):
                    if(!isset($fkDisplayCache[$colName])):
                      $fkDisplayCache[$colName] = [];
                    endif;
                    if(!isset($fkDisplayCache[$colName][$value])):
                      $refTable = $foreignKeys[$colName]['referenced_table'];
                      $refColumn = $foreignKeys[$colName]['referenced_column'];
                      $fkQuery = "SELECT * FROM `$refTable` WHERE `$refColumn` = '" . $mysqli->real_escape_string($value) . "' LIMIT 1";
                      $fkResult = $mysqli->query($fkQuery);
                      if($fkResult && $fkResult->num_rows > 0):
                        $fkRow = $fkResult->fetch_assoc();
                        $friendly = implode(" - ", $fkRow);
                      else:
                        $friendly = $value;
                      endif;
                      $fkDisplayCache[$colName][$value] = $friendly;
                    else:
                      $friendly = $fkDisplayCache[$colName][$value];
                    endif;
                    $eventDisplay[] = $friendly;
                  else:
                    $eventDisplay[] = $value;
                  endif;
                endforeach;
                echo "<div style='margin-top:3px; font-size:0.8em; background:#e0e0e0; padding:8px;'>";
                echo htmlspecialchars(implode(" | ", $eventDisplay));
                echo "</div>";
              endforeach;
            endif;
            echo "</td>";
            $dayCounter++;
          endfor;
        endwhile;
        $totalCells = $startDay + $daysInMonth;
        $remaining = (7 - ($totalCells % 7)) % 7;
        if ($remaining > 0):
          for ($i = 0; $i < $remaining; $i++):
            echo "<td></td>";
          endfor;
        endif;
        echo "</tr>";
      endif;
    ?>
    </table>

```
**calendariosemanal.php**
```php
<?php
      $rows = [];
      while($row = $result->fetch_assoc()):
        $rows[] = $row;
      endwhile;
      $eventColumn = "";
      foreach($columns as $col):
        $attrs = getInputAttributes($col['DATA_TYPE']);
        if($attrs['type'] === 'datetime-local'):
          $eventColumn = $col['COLUMN_NAME'];
          break;
        endif;
      endforeach;
      if($eventColumn === ""):
        echo "<p>No se encontró un campo de tipo datetime para vista semanal.</p>";
      else:
        $events = [];
        foreach($rows as $row):
          if(!empty($row[$eventColumn])):
            $dateKey = date("Y-m-d", strtotime($row[$eventColumn]));
            if(!isset($events[$dateKey])):
              $events[$dateKey] = [];
            endif;
            $events[$dateKey][] = $row;
          endif;
        endforeach;
        $weekStart = isset($_GET['week']) ? strtotime($_GET['week']) : strtotime("monday this week");
        $weekDates = [];
        for($i = 0; $i < 7; $i++):
          $weekDates[] = date("Y-m-d", strtotime("+$i days", $weekStart));
        endfor;
        $prevWeek = date("Y-m-d", strtotime("-7 days", $weekStart));
        $nextWeek = date("Y-m-d", strtotime("+7 days", $weekStart));
    ?>
    <table border="1" style="width:100%; text-align:center;">
      <tr>
        <td colspan="8">
          <div style="margin-bottom:20px;">
            <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . http_build_query(array_merge($_GET, ['view'=>'weekly','week'=>$prevWeek]))); ?>">Semana anterior</a>
            | Semana: <?php echo date("d/m/Y", $weekStart) . " - " . date("d/m/Y", strtotime("+6 days", $weekStart)); ?> |
            <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?' . http_build_query(array_merge($_GET, ['view'=>'weekly','week'=>$nextWeek]))); ?>">Semana siguiente</a>
          </div>
        </td>
      </tr>
      <tr>
        <th>Hora</th>
        <?php foreach($weekDates as $wd): ?>
          <th><?php echo date("D<br>d/m", strtotime($wd)); ?></th>
        <?php endforeach; ?>
      </tr>
      <?php for($hour = 0; $hour < 24; $hour++): ?>
        <tr>
          <td style="width:50px;"><?php echo sprintf("%02d:00", $hour); ?></td>
          <?php foreach($weekDates as $wd): ?>
            <td valign="top" style="height:60px;">
              <?php
                if(isset($events[$wd])):
                  foreach($events[$wd] as $event):
                    $eventHour = date("G", strtotime($event[$eventColumn]));
                    if($eventHour == $hour):
                      $eventDisplay = [];
                      foreach($columns as $col):
                        $colName = $col['COLUMN_NAME'];
                        $value = isset($event[$colName]) ? $event[$colName] : "";
                        if(isset($foreignKeys[$colName])):
                          if(!isset($fkDisplayCache[$colName])):
                            $fkDisplayCache[$colName] = [];
                          endif;
                          if(!isset($fkDisplayCache[$colName][$value])):
                            $refTable = $foreignKeys[$colName]['referenced_table'];
                            $refColumn = $foreignKeys[$colName]['referenced_column'];
                            $fkQuery = "SELECT * FROM `$refTable` WHERE `$refColumn` = '" . $mysqli->real_escape_string($value) . "' LIMIT 1";
                            $fkResult = $mysqli->query($fkQuery);
                            if($fkResult && $fkResult->num_rows > 0):
                              $fkRow = $fkResult->fetch_assoc();
                              $friendly = implode(" - ", $fkRow);
                            else:
                              $friendly = $value;
                            endif;
                            $fkDisplayCache[$colName][$value] = $friendly;
                          else:
                            $friendly = $fkDisplayCache[$colName][$value];
                          endif;
                          $eventDisplay[] = $friendly;
                        else:
                          $eventDisplay[] = $value;
                        endif;
                      endforeach;
                      ?>
                      <div style="margin:2px; font-size:0.8em; padding:2px; background:#e0e0e0;">
                        <?php echo htmlspecialchars(implode(" | ", $eventDisplay)); ?>
                      </div>
                    <?php endif;
                  endforeach;
                endif;
              ?>
            </td>
          <?php endforeach; ?>
        </tr>
      <?php endfor; ?>
    </table>

```
**cuerpotabla.php**
```php
<tbody>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <?php foreach ($columns as $col):
        $colName = $col['COLUMN_NAME'];
        $valRaw  = $row[$colName] ?? '';
        // 1) Detectar columnas de porcentaje
        if (stripos($colName, 'porcentaje') !== false):
          $pct = floatval($valRaw);
        ?>
          <td>
            <div class="progress-container" title="<?php echo $pct; ?>%">
              <div class="progress-completed" style="width: <?php echo $pct; ?>%;"></div>
              <span class="progress-text"><?php echo $pct; ?>%</span>
            </div>
          </td>
        <?php
        // 2) Campo color (muestra un círculo de color)
        elseif ($colName === 'color'):
        ?>
          <td>
            <div style="
              width: 20px;
              height: 20px;
              border-radius: 50%;
              background-color: <?php echo htmlspecialchars($valRaw); ?>;
            "></div>
          </td>
        <?php
        // 3) Campos foráneos
        elseif (isset($foreignKeys[$colName])):
          if (!isset($fkDisplayCache[$colName])):
            $fkDisplayCache[$colName] = [];
          endif;
          if (!isset($fkDisplayCache[$colName][$valRaw])):
            $refTable  = $foreignKeys[$colName]['referenced_table'];
            $refColumn = $foreignKeys[$colName]['referenced_column'];
            $fkQuery   = "SELECT * FROM `$refTable` WHERE `$refColumn` = '"
                         . $mysqli->real_escape_string($valRaw) . "' LIMIT 1";
            $fkResult  = $mysqli->query($fkQuery);
            if ($fkResult && $fkResult->num_rows > 0):
              $fkRow       = $fkResult->fetch_assoc();
              $displayText = implode(" - ", $fkRow);
            else:
              $displayText = $valRaw;
            endif;
            $fkDisplayCache[$colName][$valRaw] = $displayText;
          else:
            $displayText = $fkDisplayCache[$colName][$valRaw];
          endif;
        ?>
          <td><?php echo htmlspecialchars($displayText); ?></td>
        <?php else: // Valor normal ?>
          <td><?php echo htmlspecialchars($valRaw); ?></td>
        <?php endif;
      endforeach;

      // Acciones (editar / eliminar) si no es vista de solo lectura
      if (!$isView): ?>
        <td class="actions">
          <a href="?table=<?php echo urlencode($table); ?>&accion=editar&id=<?php echo urlencode($row[$primaryKey]); ?>">✏</a>
          <a href="?table=<?php echo urlencode($table); ?>&accion=eliminar&id=<?php echo urlencode($row[$primaryKey]); ?>"
             onclick="return confirm('¿Eliminar este registro?');">❌</a>
        </td>
      <?php endif; ?>
    </tr>
  <?php endwhile; ?>
</tbody>


```
#### estilo
**estilo.css**
```css
 /* Basic styling for forms and tables */
    table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
    th, td { border: 0px solid #ccc; padding: 8px; text-align: left; }
    form { margin-bottom: 20px; }
    label { display: block; margin: 5px 0; }
    input, textarea, select { width: 100%; padding: 5px; box-sizing: border-box; }
    .actions a { margin-right: 5px; text-decoration: none;display: inline-block;
    width: 19px;
    text-align: center; }
    .column-comment { font-size: 0.85em; color: #666; }
    .crud-form fieldset { margin-bottom: 10px; }


```
#### funciones
**getInputAttributes.php**
```php
<?php
function getInputAttributes($dataType) {
    $dataType = strtolower($dataType);
    if (in_array($dataType, ['int', 'bigint', 'smallint', 'mediumint', 'tinyint'])) {
        return ['type' => 'number', 'bind' => 'i'];
    } elseif (in_array($dataType, ['decimal', 'numeric', 'float', 'double'])) {
        return ['type' => 'number', 'bind' => 'd', 'step' => '0.00000000001'];
    } elseif (in_array($dataType, ['date'])) {
        return ['type' => 'date', 'bind' => 's'];
    } elseif (in_array($dataType, ['time'])) {
        return ['type' => 'time', 'bind' => 's'];
    } elseif (in_array($dataType, ['datetime', 'timestamp'])) {
        return ['type' => 'datetime-local', 'bind' => 's'];
    } elseif (in_array($dataType, ['text', 'mediumtext', 'longtext'])) {
        return ['type' => 'textarea', 'bind' => 's'];
    } elseif (in_array($dataType, ['blob', 'mediumblob', 'longblob'])) {
        return ['type' => 'file', 'bind' => 's'];
    } else {
        return ['type' => 'text', 'bind' => 's'];
    }
}
?>


```
## api
## front
**config.json**
```json
{
  "headerTitle":    "jocarsa | darksalmon",
  "welcomeMessage": "Welcome to the Work Shift management system.",
  "useGeolocation": false,
  "rememberSession": false
}

```
**dashboard.css**
```css
@import url('https://static.jocarsa.com/fuentes/ubuntu-font-family-0.83/ubuntu.css');

:root {
  --color-primary: darksalmon;
  --color-secondary: lightsalmon;
  --color-accent: sienna;
  --color-bg: #ffffff;
  --color-bg-alt: #fff5f2;
  --color-text: #333;
  --color-error: #cd5c5c;
}

*{box-sizing:border-box}
html,body{ margin:0; padding:0; font-family: Ubuntu, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; color:var(--color-text); background: var(--color-bg) }
header img{
  width:50px;
  }
#appContainer{ min-height:100dvh; }

/* Header */
#appHeader{
  background: var(--color-bg-alt);
  border-bottom: 1px solid rgba(233,150,122,.45);
  padding: 0.2rem 1.25rem;
  display:flex; align-items:center; justify-content:space-between;
}
#appHeader h1{
  margin:0; font-size: clamp(1.1rem, .9rem + 1.2vw, 1.6rem);
  color: var(--color-primary);
  letter-spacing:.2px
}
#logoutButton{
  background: var(--color-error);
  color:#fff; border:none; border-radius: 999px;
  padding:.5rem 1rem; cursor:pointer; font-weight:700;
}
#logoutButton:hover{ filter: brightness(1.05) }

/* Main content */
main{ padding: 1rem; }

.appScreen h2{ margin:.25rem 0  .5rem; color: var(--color-accent) }
.infoContainer{ margin: 1rem 0; font-size: 1rem; color:#1db954 }

.buttonContainer{
  display: grid; gap: 1rem;
  grid-template-columns: 1fr;
  margin: 1rem 0;
}
.block{
  background: var(--color-bg-alt);
  border: 1px solid rgba(233,150,122,.35);
  border-radius: 16px;
  padding: 1rem 1.1rem;
  box-shadow: 0 8px 20px rgba(0,0,0,.04);
      display: flex
;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-between;
    align-items: stretch;
    align-content: stretch;
}
.btn{
  background: var(--color-primary);
  color: #fff;
  border: none;
  border-radius: 999px;
  padding: .8rem 1.2rem;
  font-weight: 700;
  cursor: pointer;
  box-shadow: 0 6px 16px rgba(233,150,122,.35);
  width: 200px;
}
.btn:hover{ filter: brightness(1.05) }
.tick{ background:#1db954 !important; color:#fff !important; position:relative }
.tick::after{ content:'✓'; position:absolute; right:1rem; top:50%; transform:translateY(-50%); font-size:1.1em }

.map{ height: 320px; margin-top: 10px; border-radius: 14px; overflow:hidden; border:1px solid rgba(233,150,122,.35) }

.jornadaCard, #profileContainer, .ausenciaCard{
  background: var(--color-bg-alt);
  padding: 1rem;
  border-radius: 12px;
  color: var(--color-text);
  border: 1px solid rgba(233,150,122,.35);
  margin-bottom: 12px;
}

/* === 4-column grid for jornada === */
.jornadaCard{
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: .75rem;
  align-items: center;
}
.jornadaCard > div{ min-width: 0; }
.jornadaHeader{
  font-weight: 700;
  background: #fff;
  border-style: dashed;
}

/* Weekly summary */
.week-summary{
  background: var(--color-bg-alt);
  border: 1px solid rgba(233,150,122,.35);
  border-radius: 12px;
  padding:.85rem 1rem; margin-top:1rem;
  font-size:.95rem;
}
.week-summary .progress-container{
  position: relative; background:#eee; border-radius:10px; overflow:hidden; height:12px; margin-top:.5rem;
}
.week-summary .progress-completed{
  background: var(--color-primary);
  position:absolute; left:0; top:0; bottom:0; transition: width .3s ease; z-index:1;
}
.week-summary .progress-inprogress{
  background: lightsalmon;
  position:absolute; top:0; bottom:0; transition: width .3s ease, left .3s ease; z-index:2;
}
.week-summary .progress-text{
  font-size:.85rem; margin-top:.45rem; display:flex; justify-content:space-between; gap: .75rem;
}

/* =========== Desktop / Tablet base layout (≥ 860px) =========== */
@media (min-width: 860px){
  #appContainer{
    display:grid;
    grid-template-areas:
      "header header"
      "sidebar main";
    grid-template-columns: 260px 1fr;
    grid-template-rows: auto 1fr;
    min-height: 100dvh;
  }

  #appHeader{ grid-area: header; z-index: 1; }

  /* Sidebar on the left */
  #bottomNav{
    grid-area: sidebar;
    position: sticky; /* stays visible while scrolling main */
    top: 0;
    align-self: start;
    height: calc(100dvh - 0px);
    overflow: auto;
    background: var(--color-bg-alt);
    border-right: 1px solid rgba(233,150,122,.35);
  }
  #bottomNav ul{ 
    margin:0; padding:0; list-style:none; 
    display:flex; flex-direction: column; 
  }
  #bottomNav li{
    padding:.9rem 1rem; cursor:pointer; border-bottom: 1px solid rgba(233,150,122,.25);
  }
  #bottomNav li.active, #bottomNav li:hover{ background: #fff }

  main{ grid-area: main; overflow:auto; padding: 1.5rem 2rem }
}

/* =========== Mobile layout (≤ 859px): bottom fixed nav =========== */
@media (max-width: 859px){
.block{
  background: var(--color-bg-alt);
  border: 1px solid rgba(233,150,122,.35);
  border-radius: 16px;
  padding: 1rem 1.1rem;
  box-shadow: 0 8px 20px rgba(0,0,0,.04);
      display: flex
;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: space-between;
    align-items: stretch;
    align-content: stretch;
}
  /* Bottom nav only on small screens */
  #bottomNav{
    position: fixed; left:0; right:0; bottom:0; z-index:20;
    background: var(--color-bg-alt);
    border-top: 1px solid rgba(233,150,122,.35);
  }
  #bottomNav ul{ margin:0; padding:0; list-style:none; display:flex }
  #bottomNav li{
    flex:1; text-align:center; padding:.8rem 0; cursor:pointer;
  }
  #bottomNav li.active, #bottomNav li:hover{ background: #fff }

  /* Prevent bottom bar from covering content */
  main{ padding-bottom: 64px; }
  /* On very small screens, make jornada rows 2 columns */
  .jornadaCard{ grid-template-columns: repeat(2, 1fr); }
}

.hidden{ display:none !important }
/* ==== Home clock styles ==== */
.home-clock-wrap{
  display:flex; align-items:center; justify-content:center;
  min-height: 320px;
}
.home-clock-svg{
  width: 100%; max-width: 360px; height: auto; display:block;
}
.home-clock-legend{
  display:flex; gap:12px; align-items:center; margin-top:.75rem; flex-wrap:wrap;
  font-size:.95rem;
}
.chip{
  display:inline-block; width:18px; height:8px; border-radius:999px; margin-right:6px;
  vertical-align:middle;
}
.chip-green{ background:#1db954 }
.chip-gradient{
  background: linear-gradient(90deg, #1db954 0%, #ffd60a 100%);
}

/* Optional: crisper ticks/text on light backgrounds */
.home-clock-tick { stroke:#555; stroke-width:1 }
.home-clock-face { fill:#fff; stroke:rgba(0,0,0,.08); stroke-width:1 }
.home-clock-hour-label { font-size:12px; fill:#666; text-anchor:middle; dominant-baseline:middle; font-family: Ubuntu, system-ui, Arial, sans-serif; }
/* ==== Ausencias (form + list) ==== */
#ausenciasScreen form{
  background: var(--color-bg-alt);
  border: 1px solid rgba(233,150,122,.35);
  border-radius: 14px;
  padding: 1rem 1.1rem;
  margin: 1rem 0;
}

#ausenciasScreen form label{
  display: flex;
  flex-direction: column;
  gap: .35rem;
  margin-bottom: .85rem;
  font-weight: 600;
  color: var(--color-accent);
}

#ausenciasScreen input[type="date"],
#ausenciasScreen select,
#ausenciasScreen textarea{
  width: 100%;
  font: inherit;
  padding: .7rem .9rem;
  border: 1px solid rgba(233,150,122,.55);
  background: #fff;
  border-radius: 12px;
  outline: none;
  transition: box-shadow .2s, border-color .2s;
}

#ausenciasScreen textarea{ min-height: 90px; resize: vertical; }

#ausenciasScreen input:focus,
#ausenciasScreen select:focus,
#ausenciasScreen textarea:focus{
  border-color: var(--color-primary);
  box-shadow: 0 0 0 4px rgba(233,150,122,.15);
}

#ausenciasScreen form button[type="submit"]{
  align-self: start;
  background: var(--color-primary);
  color:#fff;
  border: none;
  border-radius: 999px;
  padding: .75rem 1.1rem;
  font-weight: 700;
  cursor: pointer;
  box-shadow: 0 6px 16px rgba(233,150,122,.35);
}
#ausenciasScreen form button[type="submit"]:hover{ filter: brightness(1.05) }

/* Cards for each ausencia */
.ausenciaCard{
  background: var(--color-bg-alt);
  padding: 1rem;
  border-radius: 12px;
  color: var(--color-text);
  border: 1px solid rgba(233,150,122,.35);
  margin-bottom: 12px;
}
.ausenciaCard p{ margin: .2rem 0; }
header img{
  width:50px;
 } 

```
**dashboard.html**
```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>jocarsa | darksalmon — Dashboard</title>
  <link rel="icon" type="image/png" href="darksalmon.png" />
  <link rel="stylesheet" href="dashboard.css" />
  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <!-- Tema opcional “pink” como en tu original -->
  <link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-pink/jocarsa%20%7C%20pink.css">
</head>
<body>
  <div id="appContainer">
    <header id="appHeader">
    <img src="darksalmon.png">
      <h1>jocarsa | darksalmon</h1>
      
      <button id="logoutButton" title="Cerrar sesión">Cerrar</button>
    </header>

    <main>
      <!-- Home -->
      <section id="homeScreen" class="appScreen">
        <h2>Inicio y fin de jornada</h2>
        <p>Registra tus entradas y salidas. Si tu jornada es partida, registra cada tramo.</p>
        

        <div class="buttonContainer">
          <div class="block">
            <h3>Inicio de jornada</h3>
            <p>Pulsa al comenzar (mañana y tarde si es partida).</p>
            <button id="btnStartShift" class="btn">Iniciar jornada</button>
          </div>
          <div class="block">
            <h3>Fin de jornada</h3>
            <p>Pulsa al terminar (mañana y tarde si es partida).</p>
            <button id="btnEndShift" class="btn">Finalizar jornada</button>
          </div>
        </div>
      <div class="block">
          <h2>Jornada de hoy</h2>
          <div id="homeClockMount" class="home-clock-wrap"></div>
          <div class="home-clock-legend">
            <span class="chip chip-green"></span> Sesiones cerradas
            <span class="chip chip-gradient"></span> Sesión en curso
          </div>
        </div>
        <div id="shiftInfo" class="infoContainer"></div>
        <!--<div id="map" class="map"></div>-->
      </section>

      <!-- Jornadas -->
      <section id="newsScreen" class="appScreen hidden">
        <h2>Jornadas registradas</h2>
        <p>Consulta tus registros. Si detectas errores, contacta con administración.</p>
        <div id="jornadasContainer"></div>
      </section>

      <!-- Perfil -->
      <section id="profileScreen" class="appScreen hidden">
        <h2>Perfil</h2>
        <p>Datos personales tal como están en el sistema.</p>
        <div id="profileContainer"></div>
      </section>

      <!-- Ausencias -->
      <section id="ausenciasScreen" class="appScreen hidden">
        <h2>Ausencias</h2>
        <p>Solicita o informa ausencias y revisa tu histórico.</p>
        <div id="ausenciasFormContainer"></div>
        <div id="ausenciasListContainer"></div>
      </section>
    </main>

    <!-- Navegación inferior/escritorio -->
    <nav id="bottomNav">
      <ul>
        <li data-screen="homeScreen" class="navItem active" title="Entradas y salidas">Inicio</li>
        <li data-screen="newsScreen" class="navItem" title="Listado de jornadas">Jornadas</li>
        <li data-screen="profileScreen" class="navItem" title="Tu perfil">Perfil</li>
        <li data-screen="ausenciasScreen" class="navItem" title="Ausencias">Ausencias</li>
      </ul>
    </nav>
  </div>

  <script src="dashboard.js"></script>
  <script src="https://ghostwhite.jocarsa.com/analytics.js?user=darksalmon.jocarsa.com"></script>
</body>
</html>


```
**dashboard.js**
```js
// ===================== dashboard.js (Front) — versión sin lat/lon =====================
'use strict';

// Estado de sesión
let currentUser     = null;
let rememberSession = true;
let storage         = localStorage;

// -------------------- Boot --------------------
document.addEventListener('DOMContentLoaded', () => {
  // Cargar config.json por coherencia (solo usamos rememberSession)
  fetch('config.json')
    .then(res => res.ok ? res.json() : {})
    .then(cfg => {
      if (typeof cfg.rememberSession === 'boolean') rememberSession = cfg.rememberSession;
    })
    .catch(() => {})
    .finally(() => {
      storage = rememberSession ? localStorage : sessionStorage;
      (rememberSession ? sessionStorage : localStorage).removeItem('user');
      initApp();
    });
});

function initApp(){
  const s = storage.getItem('user');
  if (!s) { window.location.href = 'index.html'; return; }
  try { currentUser = JSON.parse(s); } catch { window.location.href = 'index.html'; return; }

  // Top actions
  document.getElementById('logoutButton')?.addEventListener('click', logout);
  document.getElementById('btnStartShift')?.addEventListener('click', handleStartShift);
  document.getElementById('btnEndShift')?.addEventListener('click', handleEndShift);

  // Nav
  document.querySelectorAll('.navItem').forEach(item => {
    item.addEventListener('click', () => {
      const target = item.dataset.screen;
      switchScreen(target);
      setActiveNavItem(item);
      if (target === 'newsScreen')    loadJornadas();
      if (target === 'profileScreen') loadUserProfile();
      if (target === 'ausenciasScreen') { showAusenciasForm(); loadAusenciasList(); }
      if (target === 'homeScreen')    loadHomeClock();
    });
  });

  // Default screen
  switchScreen('homeScreen');
  setActiveNavItem(document.querySelector('.navItem[data-screen="homeScreen"]'));
  updateShiftButtons();
  loadHomeClock();
}

function logout(){
  storage.removeItem('user');
  currentUser = null;
  window.location.href = 'index.html';
}

function switchScreen(id){
  document.querySelectorAll('.appScreen').forEach(s => {
    s.id === id ? s.classList.remove('hidden') : s.classList.add('hidden');
  });
}
function setActiveNavItem(item){
  document.querySelectorAll('.navItem').forEach(i => i.classList.remove('active'));
  item.classList.add('active');
}

// -------------------- Shift actions (sin coords) --------------------
function updateShiftButtons(){
  fetch(`mobile_api.php?endpoint=jornadas&user_id=${currentUser.id}`)
    .then(r=>r.json())
    .then(data=>{
      const today = new Date().toISOString().slice(0,10);
      const open = data.success ? data.jornadas.find(j => j.fecha === today && j.hora_salida === null) : null;
      const btnStart = document.getElementById('btnStartShift');
      const btnEnd   = document.getElementById('btnEndShift');

      if (btnStart) {
        btnStart.disabled = !!open;
        btnStart.classList.toggle('tick', !!open);
      }
      if (btnEnd)   btnEnd.disabled   = !open;
    })
    .catch(console.error);
}

function handleStartShift(){
  fetch('mobile_api.php?endpoint=logShift',{
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({
      user_id: currentUser.id,
      action: 'start'
    })
  })
  .then(r=>r.json())
  .then(d=>{
    if (d.success) {
      displayShiftInfo(`Jornada iniciada a las ${d.time}.`);
      updateShiftButtons();
      loadHomeClock();
    } else {
      displayShiftInfo(`Error: ${d.error}`, true);
    }
  })
  .catch(()=>displayShiftInfo('No se pudo iniciar la jornada.', true));
}

function handleEndShift(){
  fetch('mobile_api.php?endpoint=logShift',{
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({
      user_id: currentUser.id,
      action: 'end'
    })
  })
  .then(r=>r.json())
  .then(d=>{
    if (d.success) {
      displayShiftInfo(`Jornada finalizada a las ${d.time}.`);
      updateShiftButtons();
      loadHomeClock();
    } else {
      displayShiftInfo(`Error: ${d.error}`, true);
    }
  })
  .catch(()=>displayShiftInfo('No se pudo finalizar la jornada.', true));
}

function displayShiftInfo(msg, isError=false){
  const el = document.getElementById('shiftInfo');
  if (!el) return;
  el.textContent = '';
  el.innerHTML = msg;
  el.style.color = isError ? '#e74c3c' : '#1db954';
}

// -------------------- Utilidades de fecha (ES) --------------------
function getISOWeekAndYear(d){
  const date = new Date(d);
  date.setHours(0,0,0,0);
  date.setDate(date.getDate() + 3 - ((date.getDay()+6)%7));
  const yearStart = new Date(date.getFullYear(),0,4);
  const weekNo = 1 + Math.round((((date - yearStart)/86400000) - 3 + ((yearStart.getDay()+6)%7)) / 7);
  return { week: weekNo, year: date.getFullYear() };
}
function getMondaySundayFromWeek(week, year){
  const simple = new Date(year, 0, 4);
  const dayOfWeek = (simple.getDay() + 6) % 7;
  const mondayWeek1 = new Date(simple);
  mondayWeek1.setDate(simple.getDate() - dayOfWeek);
  const monday = new Date(mondayWeek1);
  monday.setDate(mondayWeek1.getDate() + (week-1)*7);
  const sunday = new Date(monday);
  sunday.setDate(monday.getDate() + 6);
  const fmt = (d)=>`${d.getFullYear()}-${String(d.getMonth()+1).padStart(2,'0')}-${String(d.getDate()).padStart(2,'0')}`;
  return { monday: fmt(monday), sunday: fmt(sunday) };
}
function formatSpanishLongDate(ymd){
  const d = new Date(ymd + 'T00:00:00');
  const s = new Intl.DateTimeFormat('es-ES', { weekday:'long', day:'2-digit', month:'long', year:'numeric' }).format(d);
  return s.replace(/\b\p{Lu}/gu, m => m.toLowerCase());
}
function formatDDMMYYYY(ymd){
  const [Y,M,D] = ymd.split('-');
  return `${D}-${M}-${Y}`;
}

// -------------------- Jornadas (weekly list) --------------------
function loadJornadas(){
  fetch(`mobile_api.php?endpoint=jornadas&user_id=${currentUser.id}`)
    .then(r=>r.json())
    .then(data=>{
      const c = document.getElementById('jornadasContainer');
      if (!c) return;
      if (!data.success) { c.innerHTML = `<p>Error: ${data.error}</p>`; return; }

      const jorns = data.jornadas.slice().sort((a,b)=>{
        if (a.fecha!==b.fecha) return b.fecha.localeCompare(a.fecha);
        return (b.hora_entrada||'').localeCompare(a.hora_entrada||'');
      });

      const sumMap = {};
      (data.weeklySummary||[]).forEach(s=>{ sumMap[`${s.year}-W${s.week}`] = s; });

      let html='', prevKey=null;
      jorns.forEach(j=>{
        const {week,year} = getISOWeekAndYear(j.fecha);
        const key = `${year}-W${week}`;

        if (key !== prevKey) {
          const s = sumMap[key];
          const { monday, sunday } = getMondaySundayFromWeek(week, year);
          const rango = `Semana ${week}, ${year} — desde lunes ${formatDDMMYYYY(monday)} hasta domingo ${formatDDMMYYYY(sunday)}`;

          if (s) {
            const today       = new Date().toISOString().slice(0,10);
            const openShift   = data.jornadas.find(j2=>j2.fecha===today && j2.hora_salida===null);
            let inProgMins    = 0;
            if (openShift && openShift.hora_entrada) {
              const [h1,m1] = openShift.hora_entrada.split(':').map(Number);
              const startTs  = new Date().setHours(h1,m1,0,0);
              inProgMins = Math.max(0, Math.floor((Date.now() - startTs)/60000));
            }
            const doneMins = s.workedMinutes;
            const progMins = inProgMins;
            const dueMins  = s.dueMinutes;
            const remMins  = Math.max(0, dueMins - doneMins - progMins);

            const pctDone = dueMins>0 ? doneMins / dueMins * 100 : 0;
            const pctProg = dueMins>0 ? progMins / dueMins * 100 : 0;
            const fmtH = m => { const h = Math.floor(m/60), mm = m%60; return `${h}h${String(mm).padStart(2,'0')}`; };

            html += `
              <div class="week-summary">
                <strong>${rango}</strong>
                <div>Horas requeridas: ${(dueMins/60).toFixed(2)} h</div>
                <div class="progress-container">
                  <div class="progress-completed" style="width:${pctDone}%"></div>
                  <div class="progress-inprogress" style="width:${pctProg}%; left:${pctDone}%"></div>
                </div>
                <div class="progress-text">
                  <span>Hecho: ${fmtH(doneMins)}</span>
                  <span>En curso: ${fmtH(progMins)}</span>
                  <span>Restantes: ${fmtH(remMins)}</span>
                </div>
              </div>`;
          }
          html += `<div class="week-separator">Semana ${week}, ${year}</div>`;
          // Cabecera de la tabla de la semana
          html += `
            <div class="jornadaCard jornadaHeader">
              <div>Fecha</div>
              <div>Inicio</div>
              <div>Fin</div>
              <div>Duración</div>
            </div>`;
          prevKey = key;
        }

        // Duración de la jornada
        let dur = 'En curso';
        if (j.hora_entrada && j.hora_salida) {
          const [h1,m1] = j.hora_entrada.split(':').map(Number);
          const [h2,m2] = j.hora_salida.split(':').map(Number);
          const diff = Math.max(0, (h2*3600+m2*60) - (h1*3600+m1*60));
          dur = (diff/3600).toFixed(2) + ' h';
        }
        const fechaLarga = formatSpanishLongDate(j.fecha);
        html += `
          <div class="jornadaCard">
            <div><strong>Fecha:</strong> ${fechaLarga}</div>
            <div><strong>Inicio:</strong> ${j.hora_entrada || '-'}</div>
            <div><strong>Fin:</strong> ${j.hora_salida || '-'}</div>
            <div><strong>Duración:</strong> ${dur}</div>
          </div>`;
      });

      c.innerHTML = html || '<p>No hay jornadas.</p>';
    })
    .catch(()=>{
      const c = document.getElementById('jornadasContainer');
      if (c) c.innerHTML = '<p>Error al cargar jornadas.</p>';
    });
}

// ==================== HOME: Reloj SVG 12h con arcos y manecillas ====================
let homeClockTimer = null;

function loadHomeClock(){
  const mount = document.getElementById('homeClockMount');
  if (!mount) return;

  fetch(`mobile_api.php?endpoint=jornadas&user_id=${currentUser.id}`)
    .then(r=>r.json())
    .then(data=>{
      if (!data.success) { mount.innerHTML = '<p>Error al cargar jornada de hoy.</p>'; return; }
      const today = new Date().toISOString().slice(0,10);
      const todays = data.jornadas.filter(j => j.fecha === today);

      // Normalizar sesiones de hoy
      const sessions = todays.map(j => ({
        start: j.hora_entrada || null,
        end:   j.hora_salida  || null
      })).filter(s => s.start);

      renderHomeClockSVG(mount, sessions);

      if (homeClockTimer) clearInterval(homeClockTimer);
      homeClockTimer = setInterval(()=>{ renderHomeClockSVG(mount, sessions); }, 1000);
    })
    .catch(()=>{ mount.innerHTML = '<p>Error al cargar jornada de hoy.</p>'; });
}

function timeToMinutes(hhmm){ const [h,m] = hhmm.split(':').map(Number); return h*60 + (m||0); }
function nowMinutesFloat(){
  const d = new Date();
  return d.getHours()*60 + d.getMinutes() + d.getSeconds()/60;
}
function minutesToDegrees12h(m){ return (m / 720) * 360 - 90; }
function polarToCartesian(cx, cy, r, deg){
  const rad = deg * Math.PI/180;
  return { x: cx + r * Math.cos(rad), y: cy + r * Math.sin(rad) };
}
function describeArc(cx, cy, r, startDeg, endDeg){
  let sweep = 1;
  let largeArc = (endDeg - startDeg) % 360;
  if (largeArc < 0) largeArc += 360;
  largeArc = largeArc > 180 ? 1 : 0;
  const start = polarToCartesian(cx, cy, r, startDeg);
  const end   = polarToCartesian(cx, cy, r, endDeg);
  return `M ${start.x} ${start.y} A ${r} ${r} 0 ${largeArc} ${sweep} ${end.x} ${end.y}`;
}

function renderHomeClockSVG(mount, sessions){
  const W = 360, H = 360, CX = 180, CY = 180, R = 140;
  const svgParts = [`<svg viewBox="0 0 ${W} ${H}" width="${W}" height="${H}" role="img" aria-label="Reloj de jornada">`];

  // Circunferencia base
  svgParts.push(`<circle cx="${CX}" cy="${CY}" r="${R}" fill="none" stroke="#eee" stroke-width="10"/>`);

  // Arcos de sesiones: verde para cerradas; degradado verde→amarillo para sesión abierta
  let defs = '';
  const arcElems = [];
  const now = new Date();
  const nowMin24 = nowMinutesFloat();     // 0..1440
  const now12    = nowMin24 % 720;

  sessions.forEach((s, idx) => {
    const aMin = timeToMinutes(s.start) % 720;
    const bMin = s.end ? (timeToMinutes(s.end) % 720) : now12;
    const startDeg = minutesToDegrees12h(aMin);
    const endDeg   = minutesToDegrees12h(bMin);

    let title = s.end ? `De ${s.start} a ${s.end}` : `De ${s.start} a ahora`;
    if (s.end) {
      // Cerrada: color fijo
      const pathD = describeArc(CX, CY, R, startDeg, endDeg);
      arcElems.push(`<path d="${pathD}" fill="none" stroke="#1db954" stroke-width="12" stroke-linecap="round"><title>${title}</title></path>`);
    } else {
      // Abierta: gradiente
      const pathD = describeArc(CX, CY, R, startDeg, endDeg);
      const pStart = polarToCartesian(CX,CY,R, startDeg);
      const pEnd   = polarToCartesian(CX,CY,R, endDeg);
      const gid = `grad_${idx}_${Math.round(aMin)}_${Math.round(bMin)}`;
      defs += `
        <linearGradient id="${gid}" gradientUnits="userSpaceOnUse"
          x1="${pStart.x}" y1="${pStart.y}" x2="${pEnd.x}" y2="${pEnd.y}">
          <stop offset="0%" stop-color="#1db954"/>
          <stop offset="100%" stop-color="#ffd60a"/>
        </linearGradient>`;
      arcElems.push(`<path d="${pathD}" fill="none" stroke="url(#${gid})" stroke-width="12" stroke-linecap="round"><title>${title}</title></path>`);
    }
  });

  // Manecillas reales
  const h  = now.getHours() % 12;
  const m  = now.getMinutes();
  const s  = now.getSeconds();

  const hourDeg   = ((h*3600 + m*60 + s) / (12*3600)) * 360 - 90;
  const minuteDeg = ((m*60 + s) / 3600) * 360 - 90;
  const secondDeg = (s / 60) * 360 - 90;

  const hourLen   = R * 0.60;
  const minuteLen = R * 0.86;
  const secondLen = R * 0.93;

  const hourTip   = polarToCartesian(CX,CY, hourLen,   hourDeg);
  const minuteTip = polarToCartesian(CX,CY, minuteLen, minuteDeg);
  const secondTip = polarToCartesian(CX,CY, secondLen, secondDeg);

  svgParts.push(`<defs>${defs}</defs>`);
  svgParts.push(arcElems.join(''));

  svgParts.push(`<line x1="${CX}" y1="${CY}" x2="${hourTip.x}"   y2="${hourTip.y}"   stroke="#222" stroke-width="4" stroke-linecap="round" opacity="0.9"/>`);
  svgParts.push(`<line x1="${CX}" y1="${CY}" x2="${minuteTip.x}" y2="${minuteTip.y}" stroke="#444" stroke-width="3" stroke-linecap="round" opacity="0.85"/>`);
  svgParts.push(`<line x1="${CX}" y1="${CY}" x2="${secondTip.x}" y2="${secondTip.y}" stroke="#cd5c5c" stroke-width="1.6" stroke-linecap="round" opacity="0.9"/>`);
  svgParts.push(`<circle cx="${CX}" cy="${CY}" r="3.5" fill="#222" opacity="0.95"/>`);
  svgParts.push(`</svg>`);

  mount.innerHTML = svgParts.join('');
}

// -------------------- Perfil / Ausencias (front) --------------------
function loadUserProfile(){
  fetch(`mobile_api.php?endpoint=userData&user_id=${currentUser.id}`)
    .then(r=>r.json())
    .then(data=>{
      const c = document.getElementById('profileContainer');
      if (!c) return;
      if(data.success){
        const u=data.user;
        c.innerHTML = `
          <p><strong>Usuario:</strong> ${u.username}</p>
          <p><strong>Nombre:</strong> ${u.emp_nombre||u.nombre||'-'}</p>
          <p><strong>Apellido:</strong> ${u.emp_apellido||'-'}</p>
          <p><strong>Departamento:</strong> ${u.departamento||'-'}</p>
          <p><strong>Rol:</strong> ${u.rol||'-'}</p>
        `;
      } else {
        c.innerHTML = `<p>Error: ${data.error}</p>`;
      }
    })
    .catch(()=>{
      const c = document.getElementById('profileContainer');
      if (c) c.innerHTML = '<p>Error al obtener el perfil.</p>';
    });
}

// Los siguientes dos son placeholders si ya los tenías implementados en tu backend:
function showAusenciasForm(){
  const container = document.getElementById('ausenciasFormContainer');
  if (!container) return;
  container.innerHTML = `
    <form id="ausenciasForm">
      <label>Fecha inicio <input type="date" name="fecha_inicio" required></label>
      <label>Fecha fin <input type="date" name="fecha_fin" required></label>
      <label>Tipo
        <select name="tipo_ausencia" required>
          <option value="enfermedad">Enfermedad</option>
          <option value="médico">Médico</option>
          <option value="asuntos propios">Asuntos propios</option>
          <option value="vacaciones">Vacaciones</option>
          <option value="otro">Otro</option>
        </select>
      </label>
      <label>Motivo
        <textarea name="motivo" rows="3" required></textarea>
      </label>
      <button type="submit">Enviar petición</button>
    </form>
  `;
  document.getElementById('ausenciasForm').addEventListener('submit', handleNewAusencia);
}
function handleNewAusencia(e){
  e.preventDefault();
  const fd = new FormData(e.target);
  // Implementa tu endpoint real de ausencias si lo usas
  alert('Petición de ausencia enviada (placeholder).');
}
function loadAusenciasList(){
  const c = document.getElementById('ausenciasListContainer');
  if (c) c.innerHTML = '<p>(Listado de ausencias — placeholder)</p>';
}


```
**index.html**
```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>jocarsa | darksalmon — Acceso</title>
  <link rel="icon" type="image/png" href="darksalmon.png" />
  <link rel="stylesheet" href="login.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <!-- Estilo opcional del tema “pink” (como en tu original) -->
  <link rel="stylesheet" href="https://jocarsa.github.io/jocarsa-pink/jocarsa%20%7C%20pink.css">
</head>
<body>
  <main id="loginScreen">
    <form id="loginForm" autocomplete="on">
      <img src="darksalmon.png" alt="Logo" class="logo" />
      <h1 class="titulo">Iniciar sesión</h1>

      <label class="campo">
        <span>Usuario</span>
        <input type="text" id="username" name="username" placeholder="tu.usuario" required />
      </label>

      <label class="campo">
        <span>Contraseña</span>
        <div class="password-wrap">
          <input type="password" id="password" name="password" placeholder="••••••••" required />
          <button type="button" id="togglePassword" class="toggle-password" aria-label="Mostrar/ocultar contraseña">
            <i class="fa-regular fa-eye"></i>
          </button>
        </div>
      </label>

      <button type="submit" class="btn-acceder">Acceder</button>
      <p id="loginMessage" class="mensaje" role="status" aria-live="polite"></p>
    </form>
  </main>

  <script src="login.js"></script>
  <!-- Script opcional de tu analítica -->
  <script src="https://ghostwhite.jocarsa.com/analytics.js?user=darksalmon.jocarsa.com"></script>
</body>
</html>


```
**login.css**
```css
/* Login (pantalla independiente) */
@import url('https://static.jocarsa.com/fuentes/ubuntu-font-family-0.83/ubuntu.css');

:root{
  --color-primary: darksalmon;
  --color-secondary: lightsalmon;
  --color-accent: sienna;
  --color-bg: #ffffff;
  --color-bg-alt: #fff5f2;
  --color-text: #333;
  --color-error: #cd5c5c;
}

*{box-sizing:border-box}
html,body{
  margin:0; padding:0;
  font-family: Ubuntu, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
  color: var(--color-text);
  background: radial-gradient(1200px 800px at 20% -10%, #ffe9e3 0%, transparent 60%) no-repeat,
              radial-gradient(1000px 700px at 120% 110%, #ffe0d8 0%, transparent 60%) no-repeat,
              var(--color-bg);
  min-height:100dvh;
}

#loginScreen{
  min-height:100dvh;
  display:grid;
  place-items:center;
  padding:2rem;
}

form{
  width:min(440px, 100%);
  background: var(--color-bg);
  border-radius: 28px;
  padding: 2.25rem;
  box-shadow: 0 10px 30px rgba(0,0,0,.08);
  border: 1px solid rgba(233, 150, 122, 0.25);
  animation: rise .4s ease-out;
}

@keyframes rise { from { transform: translateY(8px); opacity:.0 } to { transform:none; opacity:1 } }

.logo{
  width: 188px; height: 188px; object-fit: contain; display:block; margin:0 auto .75rem;
  filter: drop-shadow(0 2px 6px rgba(0,0,0,.12));
}

.titulo{
  text-align:center;
  color: var(--color-accent);
  font-size: clamp(1.25rem, 1.1rem + 1vw, 1.6rem);
  margin: 0 0 1.25rem;
}

.campo{display:block; margin: 0 0 1rem}
.campo span{
  display:block; font-weight:700; font-size:.95rem; margin:0 0 .35rem;
}

input{
  width:100%;
  font-size:1rem;
  padding:.85rem 1rem;
  border:1px solid rgba(233, 150, 122, .55);
  background: var(--color-bg-alt);
  border-radius: 14px;
  outline:none;
  transition: box-shadow .2s, border-color .2s, background .2s;
}
input:focus{
  border-color: var(--color-primary);
  background: #fff;
  box-shadow: 0 0 0 4px rgba(233,150,122,.15);
}

.password-wrap{ position:relative }
.toggle-password{
  position:absolute; right:.65rem; top:50%; translate: 0 -50%;
  width: 42px; height: 42px; display:grid; place-items:center;
  border:none; background: transparent; cursor: pointer; color:#7a5a4b;
  border-radius: 10px;
}
.toggle-password:hover{ background: rgba(233,150,122,.12) }

.btn-acceder{
  width:100%;
  margin-top:.25rem;
  padding:.95rem 1rem;
  border:none; border-radius:999px;
  font-weight:700;
  background: linear-gradient(180deg, var(--color-primary), #e58f79);
  color:#fff;
  cursor:pointer;
  box-shadow: 0 6px 16px rgba(233,150,122,.35);
  transition: transform .06s ease, filter .2s ease;
}
.btn-acceder:hover{ filter: brightness(1.02) }
.btn-acceder:active{ transform: translateY(1px) }

.mensaje{
  margin:.9rem 0 0;
  min-height:1.25rem;
  text-align:center;
  font-size:.95rem;
}
.mensaje.error{ color: var(--color-error) }
.mensaje.info{ color: var(--color-secondary) }


```
**login.js**
```js
// Manejo de login y redirección al dashboard
let useGeolocation = true;     // Se respetará config.json por coherencia con tu app
let rememberSession = true;
let storage = localStorage;

document.addEventListener('DOMContentLoaded', () => {
  // Cargar config.json (opcional pero coherente con tu arquitectura)
  fetch('config.json')
    .then(r => r.ok ? r.json() : {})
    .then(cfg => {
      if (typeof cfg.useGeolocation === 'boolean') useGeolocation = cfg.useGeolocation;
      if (typeof cfg.rememberSession === 'boolean') rememberSession = cfg.rememberSession;
    })
    .catch(() => {})
    .finally(() => {
      storage = rememberSession ? localStorage : sessionStorage;
      (rememberSession ? sessionStorage : localStorage).removeItem('user');
      initLogin();
    });
});

function initLogin(){
  const form = document.getElementById('loginForm');
  const msg  = document.getElementById('loginMessage');
  const pw   = document.getElementById('password');
  const tog  = document.getElementById('togglePassword');

  // Si ya hay sesión, enviamos directo al dashboard
  const s = storage.getItem('user');
  if (s) {
    safeGoToDashboard();
    return;
  }

  tog.addEventListener('click', () => {
    const asText = pw.type === 'password';
    pw.type = asText ? 'text' : 'password';
    tog.innerHTML = asText
      ? '<i class="fa-regular fa-eye-slash"></i>'
      : '<i class="fa-regular fa-eye"></i>';
  });

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const u = document.getElementById('username').value.trim();
    const p = pw.value;

    if (!u || !p) {
      setMsg('Por favor, introduce usuario y contraseña.', 'error');
      return;
    }
    setMsg('Accediendo…', 'info');

    fetch('mobile_api.php?endpoint=login', {
      method: 'POST',
      headers: { 'Content-Type':'application/json' },
      body: JSON.stringify({ username: u, password: p })
    })
      .then(r => r.json())
      .then(data => {
        if (data && data.success && data.user) {
          storage.setItem('user', JSON.stringify(data.user));
          safeGoToDashboard();
        } else {
          setMsg(data.error || 'Credenciales inválidas.', 'error');
        }
      })
      .catch(() => setMsg('Error de servidor.', 'error'));
  });

  function setMsg(text, cls){
    msg.textContent = text || '';
    msg.className = 'mensaje ' + (cls || '');
  }
}

function safeGoToDashboard(){
  // Evitar bucles si se abre directo dashboard.html
  window.location.href = 'dashboard.html';
}


```
**mobile_api.php**
```php
<?php
// front/mobile_api.php
// Registrar jornadas con zona horaria local (Europe/Madrid) — versión sin lat/lon
declare(strict_types=1);

require_once __DIR__ . '/../config.php';
date_default_timezone_set('Europe/Madrid');

header('Content-Type: application/json; charset=utf-8');

$pdo = ds_pdo();

// Leer JSON si viene por POST
$raw    = file_get_contents('php://input');
$parsed = json_decode($raw ?: '[]', true);
if (json_last_error() !== JSON_ERROR_NONE) { $parsed = []; }

$endpoint = $_GET['endpoint'] ?? '';
$method   = $_SERVER['REQUEST_METHOD'] ?? 'GET';

function json_out($arr, int $code = 200){
  http_response_code($code);
  echo json_encode($arr, JSON_UNESCAPED_UNICODE);
  exit;
}

switch ($endpoint) {

  // ---------------------------------------------------------------------------
  // 1) LOGIN (POST)  body: { username, password }
  // ---------------------------------------------------------------------------
  case 'login':
    if ($method !== 'POST') json_out(['error'=>'Use POST'], 405);

    $u = trim($parsed['username'] ?? '');
    $p = trim($parsed['password'] ?? '');

    if ($u === '' || $p === '') json_out(['success'=>false, 'error'=>'Credenciales requeridas']);

    // Nota: en producción, usa contraseñas con hash + password_verify
    $st = $pdo->prepare("SELECT * FROM usuarios WHERE username=:u LIMIT 1");
    $st->execute([':u'=>$u]);
    $usr = $st->fetch();

    if (!$usr || !hash_equals((string)$usr['password'], (string)$p)) {
      json_out(['success'=>false, 'error'=>'Credenciales inválidas']);
    }

    // Adjuntar algunos datos del empleado si existen
    if (!empty($usr['empleado_id'])) {
      $e = $pdo->prepare("SELECT nombre, apellido, departamento, rol FROM empleados WHERE id=:id LIMIT 1");
      $e->execute([':id'=>$usr['empleado_id']]);
      $emp = $e->fetch();
      if ($emp) {
        $usr['emp_nombre']   = $emp['nombre']   ?? null;
        $usr['emp_apellido'] = $emp['apellido'] ?? null;
        $usr['departamento'] = $emp['departamento'] ?? null;
        $usr['rol']          = $emp['rol'] ?? null;
      }
    }

    // Sanitizar salida
    unset($usr['password']);
    json_out(['success'=>true, 'user'=>$usr]);
    break;

  // ---------------------------------------------------------------------------
  // 2) LOG SHIFT (POST) body: { user_id, action: 'start'|'end' }  (sin lat/lon)
  // ---------------------------------------------------------------------------
  case 'logShift':
    if ($method !== 'POST') json_out(['error'=>'Use POST'], 405);

    $uid = (int)($parsed['user_id'] ?? 0);
    $act = (string)($parsed['action'] ?? '');

    if (!$uid || !in_array($act, ['start','end'], true)) {
      json_out(['error'=>'Parámetros inválidos'], 400);
    }

    // Encontrar empleado_id del usuario
    $eSt = $pdo->prepare("SELECT empleado_id FROM usuarios WHERE id=:uid LIMIT 1");
    $eSt->execute([':uid'=>$uid]);
    $ur = $eSt->fetch();
    if (!$ur || empty($ur['empleado_id'])) {
      json_out(['error'=>'Usuario sin empleado asociado'], 400);
    }
    $emp = (int)$ur['empleado_id'];

    if ($act === 'start') {
      // SIN lat_entrada / lon_entrada
      $iSql = "INSERT INTO Asistencia (empleado_id, fecha, hora_entrada)
               VALUES (:e, CURDATE(), CURTIME())";
      try {
        $iSt = $pdo->prepare($iSql);
        $iSt->execute([':e'=>$emp]);
        json_out(['success'=>true, 'message'=>'Jornada iniciada', 'time'=>date('H:i:s')]);
      } catch (PDOException $ex) {
        json_out(['error'=>'DB error: '.$ex->getMessage()], 500);
      }
    }

    if ($act === 'end') {
      try {
        $pdo->beginTransaction();
        // Buscar última asistencia abierta hoy
        $sSql = "SELECT id FROM Asistencia
                 WHERE empleado_id=:e AND fecha=CURDATE() AND hora_salida IS NULL
                 ORDER BY id DESC LIMIT 1";
        $sSt = $pdo->prepare($sSql);
        $sSt->execute([':e'=>$emp]);
        $as = $sSt->fetch();
        if (!$as) {
          $pdo->rollBack();
          json_out(['error'=>'No hay jornada abierta para cerrar'], 400);
        }

        // Cerrar SIN lat_salida / lon_salida
        $uSql = "UPDATE Asistencia SET hora_salida=CURTIME() WHERE id=:id";
        $uSt  = $pdo->prepare($uSql);
        $uSt->execute([':id'=>$as['id']]);

        $pdo->commit();
        json_out(['success'=>true, 'message'=>'Jornada finalizada', 'time'=>date('H:i:s')]);
      } catch (PDOException $ex) {
        $pdo->rollBack();
        json_out(['error'=>'DB error: '.$ex->getMessage()], 500);
      }
    }

    json_out(['error'=>'Acción inválida'], 400);
    break;

  // ---------------------------------------------------------------------------
  // 3) JORNADAS (GET) → { success, jornadas, weeklySummary }
  // ---------------------------------------------------------------------------
  case 'jornadas':
    if ($method !== 'GET') json_out(['error'=>'Use GET'], 405);

    $uid = (int)($_GET['user_id'] ?? 0);
    if (!$uid) json_out(['error'=>'Missing user_id'], 400);

    // empleado_id
    $eSt = $pdo->prepare("SELECT empleado_id FROM usuarios WHERE id=:uid LIMIT 1");
    $eSt->execute([':uid'=>$uid]);
    $ur = $eSt->fetch();
    if (!$ur || empty($ur['empleado_id'])) json_out(['error'=>'No associated employee'], 400);

    $emp = (int)$ur['empleado_id'];

    // Asistencia del usuario
    $jSql = "SELECT * FROM Asistencia WHERE empleado_id=:e ORDER BY fecha DESC, hora_entrada DESC";
    $jSt  = $pdo->prepare($jSql);
    $jSt->execute([':e'=>$emp]);
    $rows = $jSt->fetchAll();

    // Horario teórico
    $sSql = "SELECT dia_de_la_semana, hora_de_entrada, hora_de_salida
             FROM horarios WHERE empleado=:e";
    $sSt  = $pdo->prepare($sSql);
    $sSt->execute([':e'=>$emp]);
    $sched = $sSt->fetchAll();

    // Festivos (entre la min y max fecha registrada)
    $dates = array_column($rows, 'fecha');
    if (!empty($dates)) {
      $mn = min($dates);
      $mx = max($dates);
      $hSql = "SELECT fecha FROM Festivos WHERE fecha BETWEEN :mn AND :mx";
      $hSt  = $pdo->prepare($hSql);
      $hSt->execute([':mn'=>$mn, ':mx'=>$mx]);
      $hols = array_column($hSt->fetchAll(), 'fecha');
    } else {
      $hols = [];
    }

    // Agrupar por semana ISO: worked (cerradas) y due (teóricas)
    $wk = [];
    foreach ($rows as $r) {
      $ts = strtotime($r['fecha']);
      $iy = date('o', $ts);
      $iw = (int)date('W', $ts);
      $key = $iy.'-W'.$iw;
      if (!isset($wk[$key])) $wk[$key] = ['worked'=>0,'due'=>0];
      if ($r['hora_entrada'] && $r['hora_salida']) {
        [$h1,$m1] = array_map('intval', explode(':', $r['hora_entrada']));
        [$h2,$m2] = array_map('intval', explode(':', $r['hora_salida']));
        $wk[$key]['worked'] += (($h2*60+$m2) - ($h1*60+$m1));
      }
    }

    // Calcular due por semana (excluyendo festivos)
    foreach ($wk as $key => &$val) {
      [$yr, $wno] = array_map('intval', explode('-W', $key));
      $dt = new DateTime();
      $dt->setISODate($yr, $wno);
      for ($d = 1; $d <= 7; $d++) {
        $fd = $dt->format('Y-m-d');
        if (!in_array($fd, $hols, true)) {
          foreach ($sched as $s) {
            if ((int)$s['dia_de_la_semana'] === $d) {
              [$h1,$m1] = array_map('intval', explode(':', $s['hora_de_entrada']));
              [$h2,$m2] = array_map('intval', explode(':', $s['hora_de_salida']));
              $val['due'] += max(0, ($h2*60+$m2) - ($h1*60+$m1));
            }
          }
        }
        $dt->modify('+1 day');
      }
    }
    unset($val);

    $summary = [];
    foreach ($wk as $key=>$val) {
      [$yr, $wno] = array_map('intval', explode('-W', $key));
      $summary[] = [
        'year'          => $yr,
        'week'          => $wno,
        'workedMinutes' => $val['worked'],
        'dueMinutes'    => $val['due'],
      ];
    }

    json_out(['success'=>true, 'jornadas'=>$rows, 'weeklySummary'=>$summary]);
    break;

  // ---------------------------------------------------------------------------
  // 4) USER DATA (GET) → { success, user }
  // ---------------------------------------------------------------------------
  case 'userData':
    if ($method !== 'GET') json_out(['error'=>'Use GET'], 405);

    $uid = (int)($_GET['user_id'] ?? 0);
    if (!$uid) json_out(['error'=>'Missing user_id'], 400);

    $st = $pdo->prepare("SELECT * FROM usuarios WHERE id=:id LIMIT 1");
    $st->execute([':id'=>$uid]);
    $u = $st->fetch();
    if (!$u) json_out(['error'=>'Usuario no encontrado'], 404);

    if (!empty($u['empleado_id'])) {
      $e = $pdo->prepare("SELECT nombre, apellido, departamento, rol FROM empleados WHERE id=:id LIMIT 1");
      $e->execute([':id'=>$u['empleado_id']]);
      $emp = $e->fetch();
      if ($emp) {
        $u['emp_nombre']   = $emp['nombre']   ?? null;
        $u['emp_apellido'] = $emp['apellido'] ?? null;
        $u['departamento'] = $emp['departamento'] ?? null;
        $u['rol']          = $emp['rol'] ?? null;
      }
    }
    unset($u['password']);

    json_out(['success'=>true, 'user'=>$u]);
    break;

  // ---------------------------------------------------------------------------
  default:
    json_out(['error'=>'Endpoint no reconocido'], 404);
}


```
**script.js**
```js
// script.js
// Application logic for the DarkSalmon work shift management mobile app.

let currentUser     = null;
let useGeolocation  = true;
let rememberSession = true;
let storage         = localStorage;  // Falls back to sessionStorage if rememberSession=false

document.addEventListener('DOMContentLoaded', () => {
  // Load config.json
  fetch('config.json')
    .then(res => res.json())
    .then(cfg => {
      if (cfg && typeof cfg.useGeolocation === 'boolean') useGeolocation = cfg.useGeolocation;
      if (cfg && typeof cfg.rememberSession === 'boolean') rememberSession = cfg.rememberSession;
    })
    .catch(() => console.warn('Could not load config.json; using defaults.'))
    .finally(() => {
      if (rememberSession) {
        storage = localStorage;
        sessionStorage.removeItem('user');
      } else {
        storage = sessionStorage;
        localStorage.removeItem('user');
      }
      initApp();
    });
});

function initApp() {
  checkLoginStatus();

  const loginForm   = document.getElementById('loginForm');
  const startBtn    = document.getElementById('btnStartShift');
  const endBtn      = document.getElementById('btnEndShift');
  const logoutBtn   = document.getElementById('logoutButton');

  if (loginForm) loginForm.addEventListener('submit', handleLogin);
  if (startBtn)  startBtn.addEventListener('click', handleStartShift);
  if (endBtn)    endBtn.addEventListener('click', handleEndShift);
  if (logoutBtn) logoutBtn.addEventListener('click', logout);

  document.querySelectorAll('.navItem').forEach(item => {
    item.addEventListener('click', () => {
      switchScreen(item.dataset.screen);
      setActiveNavItem(item);
      if (item.dataset.screen === 'newsScreen')    loadJornadas?.();
      if (item.dataset.screen === 'profileScreen') loadUserProfile?.();
      if (item.dataset.screen === 'ausenciasScreen') {
        showAusenciasForm?.();
        loadAusenciasList?.();
      }
    });
  });
}

function checkLoginStatus() {
  const s = storage.getItem('user');
  if (s) {
    try {
      currentUser = JSON.parse(s);
      showAppScreen();
    } catch {
      showLoginScreen();
    }
  } else {
    showLoginScreen();
  }
}

function handleLogin(e) {
  e.preventDefault();
  const u = document.getElementById('username').value.trim();
  const p = document.getElementById('password').value;
  if (!u || !p) {
    showLoginMessage('Enter both username & password','error');
    return;
  }
  showLoginMessage('Logging in…','info');
  fetch('mobile_api.php?endpoint=login', {
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({username:u,password:p})
  })
  .then(r=>r.json())
  .then(data=>{
    if (data.success) {
      currentUser = data.user;
      storage.setItem('user', JSON.stringify(currentUser));
      showAppScreen();
    } else {
      showLoginMessage(data.error||'Login failed','error');
    }
  })
  .catch(err=>{
    console.error(err);
    showLoginMessage('Server error','error');
  });
}

function showLoginMessage(msg, type) {
  const el = document.getElementById('loginMessage');
  el.textContent = msg;
  el.className = 'message ' + type;
}


function showLoginScreen() {
  const login = document.getElementById('loginScreen');
  const app   = document.getElementById('appContainer');
  if (login && app) {
    login.classList.remove('hidden');
    app.classList.add('hidden');
  } else {
    // We're on app.html (no login DOM) → send to login page
    if (!window.location.pathname.endsWith('index.html')) {
      window.location.replace('index.html');
    }
  }
}

function showAppScreen() {
  const login = document.getElementById('loginScreen');
  const app   = document.getElementById('appContainer');
  if (login && app) {
    login.classList.add('hidden');
    app.classList.remove('hidden');
    switchScreen('homeScreen');
    const home = document.querySelector('.navItem[data-screen="homeScreen"]');
    if (home) setActiveNavItem(home);
    updateShiftButtons?.();
  } else {
    // We're on index.html (no app DOM) → send to app page
    if (!window.location.pathname.endsWith('app.html')) {
      window.location.replace('app.html');
    }
  }
}

function logout() {
  storage.removeItem('user');
  currentUser = null;
  showLoginScreen();
}

function switchScreen(id) {
  document.querySelectorAll('.appScreen').forEach(s => {
    s.id === id ? s.classList.remove('hidden') : s.classList.add('hidden');
  });
}

function setActiveNavItem(item) {
  document.querySelectorAll('.navItem').forEach(i => i.classList.remove('active'));
  item.classList.add('active');
}

function getGeolocation() {
  return new Promise((res, rej)=>{
    if (!navigator.geolocation) rej(new Error('No geolocation'));
    else navigator.geolocation.getCurrentPosition(
      pos => res({latitude:pos.coords.latitude, longitude:pos.coords.longitude}),
      err => rej(err)
    );
  });
}

function displayLocationOnMap(lat, lon) {
  if (window.mapInstance) {
    mapInstance.off(); mapInstance.remove();
  }
  window.mapInstance = L.map('map').setView([lat, lon], 15);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
    attribution: '© OpenStreetMap'
  }).addTo(mapInstance);
  L.marker([lat, lon]).addTo(mapInstance).bindPopup('Tú estás aquí.').openPopup();
}

function getISOWeekAndYear(d) {
  const date = new Date(d);
  date.setHours(0,0,0,0);
  date.setDate(date.getDate() + 3 - ((date.getDay()+6)%7));
  const yearStart = new Date(date.getFullYear(),0,4);
  const weekNo = 1 + Math.round((((date - yearStart)/86400000) - 3 + ((yearStart.getDay()+6)%7)) / 7);
  return { week: weekNo, year: date.getFullYear() };
}

function updateShiftButtons() {
  fetch(`mobile_api.php?endpoint=jornadas&user_id=${currentUser.id}`)
    .then(r => r.json())
    .then(data => {
      const today = new Date().toISOString().slice(0, 10);
      const open = data.success
        ? data.jornadas.find(j => j.fecha === today && j.hora_salida === null)
        : null;
      document.getElementById('btnStartShift').disabled = !!open;
      document.getElementById('btnEndShift').disabled = !open;
      document.getElementById('btnStartShift').classList.toggle('tick', !!open);
      // Remove the following line to prevent the "End Shift" button from being painted green
      // document.getElementById('btnEndShift').classList.toggle('tick', !open);
    })
    .catch(console.error);
}

function handleStartShift(){
  const doLog = coords => {
    fetch('mobile_api.php?endpoint=logShift', {
      method:'POST',
      headers:{'Content-Type':'application/json'},
      body: JSON.stringify({
        user_id: currentUser.id,
        action: 'start',
        latitude: useGeolocation? coords.latitude : null,
        longitude: useGeolocation? coords.longitude: null
      })
    })
    .then(r=>r.json())
    .then(d=>{
      if (d.success) {
        let msg = `Jornada iniciada at ${d.time}.`;
        if (useGeolocation) msg += `<br>Lat: ${coords.latitude.toFixed(6)}<br>Lon: ${coords.longitude.toFixed(6)}`;
        displayShiftInfo(msg);
        if (useGeolocation) displayLocationOnMap(coords.latitude, coords.longitude);
        updateShiftButtons();
      } else {
        displayShiftInfo(`Error: ${d.error}`, true);
      }
    })
    .catch(()=>displayShiftInfo('Failed to start shift.', true));
  };
  if (useGeolocation) {
    getGeolocation().then(doLog).catch(()=>doLog({latitude:null,longitude:null}));
  } else {
    doLog({latitude:null,longitude:null});
  }
}

function handleEndShift(){
  const doLog = coords => {
    fetch('mobile_api.php?endpoint=logShift', {
      method:'POST',
      headers:{'Content-Type':'application/json'},
      body: JSON.stringify({
        user_id: currentUser.id,
        action: 'end',
        latitude: useGeolocation? coords.latitude : null,
        longitude: useGeolocation? coords.longitude: null
      })
    })
    .then(r=>r.json())
    .then(d=>{
      if (d.success) {
        let msg = `Jornada finalizada at ${d.time}.`;
        if (useGeolocation) msg += `<br>Lat: ${coords.latitude.toFixed(6)}<br>Lon: ${coords.longitude.toFixed(6)}`;
        displayShiftInfo(msg);
        if (useGeolocation) displayLocationOnMap(coords.latitude, coords.longitude);
        updateShiftButtons();
      } else {
        displayShiftInfo(`Error: ${d.error}`, true);
      }
    })
    .catch(()=>displayShiftInfo('Failed to end shift.', true));
  };
  if (useGeolocation) {
    getGeolocation().then(doLog).catch(()=>doLog({latitude:null,longitude:null}));
  } else {
    doLog({latitude:null,longitude:null});
  }
}

function displayShiftInfo(msg, isError=false){
  const el = document.getElementById('shiftInfo');
  el.innerHTML = msg;
  el.style.color = isError ? '#e74c3c' : '#1db954';
}

function loadJornadas(){
  fetch(`mobile_api.php?endpoint=jornadas&user_id=${currentUser.id}`)
    .then(r=>r.json())
    .then(data=>{
      const c = document.getElementById('jornadasContainer');
      if (!data.success) {
        c.innerHTML = `<p>Error: ${data.error}</p>`;
        return;
      }

      // sort by date then entry time desc
      const jorns = data.jornadas.slice().sort((a,b)=>{
        if (a.fecha!==b.fecha) return b.fecha.localeCompare(a.fecha);
        return (b.hora_entrada||'').localeCompare(a.hora_entrada||'');
      });

      // build map of weekly summaries
      const sumMap = {};
      (data.weeklySummary||[]).forEach(s=>{
        sumMap[`${s.year}-W${s.week}`] = s;
      });

      let html='', prevKey=null;
      jorns.forEach(j=>{
        const {week,year} = getISOWeekAndYear(j.fecha);
        const key = `${year}-W${week}`;

        if (key !== prevKey) {
          // weekly summary if it exists
          const s = sumMap[key];
          if (s) {
            // --- inside the loop over weekly summaries ---
// ... dentro de jorns.forEach(j => { … }) justo donde renderizas el resumen:
const today       = new Date().toISOString().slice(0,10);
const openShift   = data.jornadas.find(j=>j.fecha===today&&j.hora_salida===null);
let inProgMins    = 0;
if (openShift) {
  const [h1,m1]    = openShift.hora_entrada.split(':').map(Number);
  const startTs    = new Date().setHours(h1,m1,0,0);
  inProgMins       = Math.floor((Date.now() - startTs) / 60000);
}

const doneMins   = s.workedMinutes;          // sólo sesiones cerradas
const progMins   = inProgMins;               // tu sesión abierta
const dueMins    = s.dueMinutes;             // tu total teórico
const remMins    = Math.max(0, dueMins - doneMins - progMins);

const pctDone = dueMins>0 ? doneMins / dueMins * 100 : 0;
const pctProg = dueMins>0 ? progMins / dueMins * 100 : 0;

// formatear h y m: e.g. 2h05
function fmtH(m) {
  const h = Math.floor(m/60), mm = m % 60;
  return `${h}h${mm.toString().padStart(2,'0')}`;
}

html += `
  <div class="week-summary">
    <strong>Semana ${week}, ${year}</strong>
    <div>Horas requeridas: ${(dueMins/60).toFixed(2)} h</div>
    <div class="progress-container">
      <div class="progress-completed" 
           style="width:${pctDone}%;"></div>
      <div class="progress-inprogress" 
           style="width:${pctProg}%; left:${pctDone}%;"></div>
    </div>
    <div class="progress-text">
      <span>Hecho: ${fmtH(doneMins)}</span>
      <span>En curso: ${fmtH(progMins)}</span>
      <span>Restantes: ${fmtH(remMins)}</span>
    </div>
  </div>`;
          }
          html += `<div class="week-separator">Semana ${week}, ${year}</div>`;
          prevKey = key;
        }

        // single jornada duration
        let dur = 'En curso';
        if (j.hora_entrada && j.hora_salida) {
          const [h1,m1] = j.hora_entrada.split(':').map(Number);
          const [h2,m2] = j.hora_salida.split(':').map(Number);
          const diff = Math.max(0, (h2*3600 + m2*60) - (h1*3600 + m1*60));
          dur = (diff/3600).toFixed(2) + ' h';
        }
        html += `
          <div class="jornadaCard" style="display:flex; justify-content:space-between; align-items:center;">
            <div>
              <p><strong>Fecha:</strong> ${j.fecha}</p>
              <p><strong>Inicio:</strong> ${j.hora_entrada||'-'}</p>
              <p><strong>Fin:</strong> ${j.hora_salida||'-'}</p>
            </div>
            <p><strong>Duración:</strong> ${dur}</p>
          </div>`;
      });

      c.innerHTML = html;
    })
    .catch(err=>{
      console.error(err);
      document.getElementById('jornadasContainer').innerHTML = '<p>Error fetching jornadas.</p>';
    });
}

// ... rest of your functions (loadUserProfile, showAusenciasForm, etc.) remain unchanged ...


function loadUserProfile(){
  fetch(`mobile_api.php?endpoint=userData&user_id=${currentUser.id}`)
    .then(r=>r.json())
    .then(data=>{
      const c = document.getElementById('profileContainer');
      if(data.success){
        const u=data.user;
        c.innerHTML=`
          <p><strong>Username:</strong> ${u.username}</p>
          <p><strong>Nombre:</strong> ${u.emp_nombre||u.nombre}</p>
          <p><strong>Apellido:</strong> ${u.emp_apellido||'-'}</p>
          <p><strong>Departamento:</strong> ${u.departamento||'-'}</p>
          <p><strong>Rol:</strong> ${u.rol}</p>
        `;
      } else {
        c.innerHTML=`<p>Error: ${data.error}</p>`;
      }
    })
    .catch(err=>{
      console.error(err);
      document.getElementById('profileContainer').innerHTML=`<p>Error fetching profile.</p>`;
    });
}

function showAusenciasForm(){
  const container = document.getElementById('ausenciasFormContainer');
  container.innerHTML=`
    <form id="ausenciasForm">
      <label>Fecha inicio: <input type="date" name="fecha_inicio" required></label>
      <label>Fecha fin:    <input type="date" name="fecha_fin"    required></label>
      <label>Tipo:
        <select name="tipo_ausencia" required>
          <option value="enfermedad">Enfermedad</option>
          <option value="médico">Médico</option>
          <option value="asuntos propios">Asuntos propios</option>
          <option value="vacaciones">Vacaciones</option>
          <option value="otro">Otro</option>
        </select>
      </label>
      <label>Motivo:<textarea name="motivo" rows="3" required></textarea></label>
      <button type="submit">Enviar petición</button>
    </form>
  `;
  document.getElementById('ausenciasForm')
    .addEventListener('submit', handleNewAusencia);
}

function handleNewAusencia(e){
  e.preventDefault();
  const f=new FormData(e.target);
  const payload={
    user_id: currentUser.id,
    fecha_inicio:  f.get('fecha_inicio'),
    fecha_fin:     f.get('fecha_fin'),
    tipo_ausencia: f.get('tipo_ausencia'),
    motivo:        f.get('motivo')
  };
  fetch('mobile_api.php?endpoint=ausencias',{
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify(payload)
  })
  .then(r=>r.json())
  .then(res=>{
    if(res.success){
      alert('Petición enviada correctamente');
      e.target.reset();
      loadAusenciasList();
    } else {
      alert('Error: '+res.error);
    }
  })
  .catch(err=>{
    console.error(err);
    alert('Error al enviar la petición');
  });
}

function loadAusenciasList(){
  fetch(`mobile_api.php?endpoint=ausencias&user_id=${currentUser.id}`)
    .then(r=>r.json())
    .then(res=>{
      const c = document.getElementById('ausenciasListContainer');
      if(res.success && res.ausencias.length){
        c.innerHTML = res.ausencias.map(a=>`
          <div class="ausenciaCard">
            <p><strong>Inicio:</strong> ${a.fecha_inicio}</p>
            <p><strong>Fin:</strong> ${a.fecha_fin}</p>
            <p><strong>Tipo:</strong> ${a.tipo_ausencia}</p>
            <p><strong>Motivo:</strong> ${a.motivo}</p>
            <p><strong>Estado:</strong> ${a.estado||'pendiente'}</p>
          </div>
        `).join('');
      } else {
        c.innerHTML = '<p>No hay peticiones de ausencia.</p>';
      }
    })
    .catch(err=>{
      console.error(err);
      document.getElementById('ausenciasListContainer').innerHTML=`<p>Error fetching ausencias.</p>`;
    });
}


```
**styles.css**
```css
/* ===============================
   darksalmon · base & layout
   Safe, readable, responsive CSS
   =============================== */

/* Color system (accessible contrast) */
:root {
  --bg-0: #0f1115;         /* page background */
  --bg-1: #151823;         /* panels / cards */
  --bg-2: #1b2030;         /* inputs / tiles */
  --stroke: #23283a;       /* borders */
  --text: #e6e8ee;         /* main text */
  --muted: #a7adbb;        /* secondary text */

  --brand: #ec4899;        /* primary brand (pink) */
  --brand-strong: #db2777; /* primary hover */
  --danger: #ef4444;
  --ok: #22c55e;
  --info: #60a5fa;

  --radius-s: 10px;
  --radius-m: 14px;
  --radius-l: 18px;

  --shadow-1: 0 8px 22px rgba(0, 0, 0, 0.20);
  --shadow-2: 0 12px 30px rgba(0, 0, 0, 0.28);

  --sp-1: 6px;
  --sp-2: 10px;
  --sp-3: 14px;
  --sp-4: 18px;
  --sp-5: 22px;
  --sp-6: 28px;
  --sp-7: 34px;

  --font: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Inter, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
}

/* Reset, base */
* { box-sizing: border-box; }
html, body { height: 100%; }
html { -webkit-text-size-adjust: 100%; }
body {
  margin: 0;
  font-family: var(--font);
  color: var(--text);
  background: var(--bg-0);
  line-height: 1.45;
}

/* Utility */
.muted { color: var(--muted); }
.mt-auto { margin-top: auto; }

/* ==============
   Global layout
   ============== */
.bg-gradient,
.bg-pattern {
  /* Keep subtle background; avoid heavy effects that break on some GPUs */
  background: radial-gradient(900px circle at 15% 10%, rgba(236,72,153,0.10), transparent 40%),
              radial-gradient(900px circle at 85% 20%, rgba(96,165,250,0.10), transparent 40%),
              linear-gradient(180deg, #0d1016, #0f1219 60%, #0d1016);
  min-height: 100vh;
}

/* Centered container for login */
.centered {
  min-height: 100vh;
  display: grid;
  place-items: center;
  padding: var(--sp-5);
}

/* Card */
.card {
  width: 100%;
  max-width: 440px;
  background: var(--bg-1);
  border: 1px solid var(--stroke);
  border-radius: var(--radius-l);
  box-shadow: var(--shadow-1);
  padding: var(--sp-6);
}
.card-header { text-align: center; margin-bottom: var(--sp-4); }
.card-header .logo {
  width: 72px; height: 72px; object-fit: contain; margin-bottom: var(--sp-2);
}
.card-header h1 {
  margin: 0 0 var(--sp-1) 0;
  font-size: 26px; font-weight: 800;
}
.card-footer { margin-top: var(--sp-2); text-align: center; }

/* Simple appear animation (not fragile) */
.animate-pop { animation: pop .25s ease-out; }
@keyframes pop {
  from { transform: translateY(6px); opacity: 0; }
  to   { transform: none; opacity: 1; }
}

/* =====================
   Forms (login, filters)
   ===================== */
.form-grid { display: grid; gap: var(--sp-2); }

label {
  font-size: 12px; color: var(--muted); letter-spacing: 0.2px;
}

.input {
  display: flex; align-items: center; gap: var(--sp-2);
  background: var(--bg-2);
  border: 1px solid var(--stroke);
  border-radius: var(--radius-m);
  padding: 12px 14px;
}
.input:focus-within {
  outline: 2px solid rgba(236,72,153,0.35);
  outline-offset: 0;
}
.input i { opacity: 0.9; }
.input input {
  all: unset;
  flex: 1;
  color: var(--text);
  font-size: 15px;
}

/* Password eye button */
.input.password .icon {
  all: unset;
  cursor: pointer;
  padding: 6px 8px;
  border-radius: 8px;
}
.input.password .icon:hover { background: rgba(255,255,255,0.06); }

/* Buttons */
.btn {
  display: inline-flex; align-items: center; justify-content: center; gap: 8px;
  width: 100%;
  padding: 12px 14px;
  border-radius: var(--radius-m);
  border: 1px solid transparent;
  cursor: pointer; user-select: none;
  font-weight: 700;
  transition: filter .15s ease, transform .04s ease;
}
.btn:active { transform: translateY(1px); }

.btn.primary {
  background: linear-gradient(135deg, var(--brand), var(--brand-strong));
  color: #fff;
  box-shadow: var(--shadow-1);
}
.btn.primary:hover { filter: brightness(1.04); }

.btn.ghost {
  background: transparent;
  color: var(--text);
  border: 1px solid var(--stroke);
}
.btn.ghost.danger { border-color: rgba(239,68,68,0.45); }

/* Messages */
.message { min-height: 22px; font-size: 13px; margin-top: 6px; }
.message.info  { color: var(--info); }
.message.error { color: var(--danger); }

/* ==========================
   Dashboard shell & sidebar
   ========================== */
.layout {
  display: grid;
  grid-template-columns: 260px 1fr;
  min-height: 100vh;
}

.sidebar {
  display: flex; flex-direction: column; gap: var(--sp-2);
  background: var(--bg-1);
  border-right: 1px solid var(--stroke);
  padding: var(--sp-4);
}

.brand {
  display: flex; align-items: center; gap: var(--sp-2);
  margin-bottom: var(--sp-2);
  color: var(--text);
}
.logo.small { width: 28px; height: 28px; object-fit: contain; }

.menu { display: flex; flex-direction: column; gap: 6px; }

.menu-item {
  display: flex; align-items: center; gap: 10px;
  padding: 10px 12px;
  color: #d7d9e0;
  text-decoration: none;
  border: 1px solid transparent;
  border-radius: var(--radius-m);
}
.menu-item:hover {
  background: var(--bg-2);
  border-color: var(--stroke);
}
.menu-item.active {
  background: linear-gradient(135deg, rgba(236,72,153,0.25), rgba(219,39,119,0.25));
  color: #fff;
}

.btn.mt-auto { margin-top: auto; }

/* =====================
   Content & components
   ===================== */
.content { padding: var(--sp-5); }

.topbar {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: var(--sp-4);
}
.breadcrumbs { color: var(--muted); }
.userbox {
  display: inline-flex; align-items: center; gap: 8px;
  background: var(--bg-2);
  border: 1px solid var(--stroke);
  padding: 8px 12px;
  border-radius: var(--radius-m);
  color: var(--text);
}

.grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--sp-4);
}

.tile {
  background: var(--bg-1);
  border: 1px solid var(--stroke);
  border-radius: var(--radius-l);
  padding: var(--sp-4);
  box-shadow: var(--shadow-1);
}
.tile h3 {
  margin: 0 0 var(--sp-2) 0;
  color: #ffffff;
  font-weight: 800;
}

/* KPI group */
.kpis {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--sp-3);
  margin-top: var(--sp-2);
}
.kpi {
  background: var(--bg-2);
  border: 1px solid var(--stroke);
  border-radius: var(--radius-m);
  padding: var(--sp-3);
  display: grid;
  gap: 6px;
}
.kpi-number { font-size: 28px; font-weight: 800; color: #fff; }
.kpi-label  { font-size: 12px; color: var(--muted); }

/* Lists */
.list {
  list-style: none; margin: 0; padding: 0;
  display: grid; gap: var(--sp-2);
}
.list li {
  background: var(--bg-2);
  border: 1px solid var(--stroke);
  border-radius: var(--radius-m);
  padding: 10px 12px;
  color: #dfe2ea;
}
.list li i { font-size: 8px; margin-right: 6px; opacity: .7; }

/* Skeleton shimmer (lightweight) */
.skeleton {
  height: 42px;
  background: linear-gradient(90deg, rgba(255,255,255,.06), rgba(255,255,255,.12), rgba(255,255,255,.06));
  background-size: 200% 100%;
  border-radius: var(--radius-m);
  animation: shine 1.1s linear infinite;
}
@keyframes shine {
  0% { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}

/* ==========
   Responsive
   ========== */
@media (max-width: 1100px) {
  .grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 820px) {
  .layout { grid-template-columns: 1fr; }
  .sidebar { position: sticky; top: 0; z-index: 2; }
  .grid { grid-template-columns: 1fr; }
  .content { padding: var(--sp-4); }
}


```
### ayuda
**darksalmon.md**
```markdown
# Manual de Usuario · jocarsa | darksalmon 

Este manual está dirigido a los trabajadores que utilizan la aplicación **darksalmon** en su versión **Front**.  
Aquí aprenderás a iniciar sesión, registrar tu jornada laboral, gestionar tus datos, ausencias y resolver dudas frecuentes.

---

## 1. Inicio de sesión

Para acceder a la aplicación:

![Captura de pantalla](img/Captura desde 2025-08-24 16-50-47.png)

1. Abre la URL proporcionada por tu empresa en tu navegador.
2. Introduce tu **usuario** y **contraseña** en el formulario de acceso.
3. Pulsa el botón **"Iniciar sesión"**.

🔒 Si introduces datos incorrectos, aparecerá un mensaje de error: *Usuario o contraseña incorrectos*. Intenta de nuevo o contacta con el administrador si el problema persiste.

---

## 2. Inicio

En la sección **Inicio** (Home) podrás registrar el comienzo y el final de tu jornada laboral.

![Captura de pantalla](img/Captura desde 2025-08-24 16-55-04.png)

- **Iniciar jornada**: pulsa este botón al empezar tu trabajo.  
  - Si tu jornada es partida, púlsalo tanto en el inicio de la mañana como en el inicio de la tarde.
- **Finalizar jornada**: pulsa este botón al terminar tu jornada.  
  - Si tu jornada es partida, púlsalo al final de la mañana y al final de la tarde.

En esta pantalla también se muestra:
- Información de tus registros del día.
- Un mapa con tu ubicación de fichaje (si está habilitado por la empresa).

---

## 3. Jornadas

En la sección **Jornadas** podrás ver el listado de tus registros de fichaje (entradas y salidas).

![Captura de pantalla](img/Captura desde 2025-08-24 16-55-10.png)

- Se muestran todas las jornadas registradas.
- Si detectas algún error, comunícalo a los administradores.

ℹ️ Esta sección es solo de consulta; no se pueden modificar registros.

---

## 4. Perfil

En la sección **Perfil** podrás visualizar tus datos personales tal y como están registrados en el sistema.

![Captura de pantalla](img/Captura desde 2025-08-24 16-55-13.png)

- Nombre y apellidos.
- Datos de contacto.
- Otra información relevante cargada por administración.

Si detectas algún dato incorrecto, informa al administrador.

---

## 5. Ausencias

En la sección **Ausencias** podrás:

1. **Solicitar una ausencia** rellenando el formulario correspondiente (vacaciones, bajas, permisos, etc.).
2. **Consultar el listado** de ausencias ya solicitadas y su estado (pendiente, aprobada o denegada).

---

## 6. FAQs

**❓ No puedo iniciar sesión**  
- Revisa que el usuario y la contraseña sean correctos.  
- Comprueba que no tengas activadas mayúsculas en el teclado.  
- Si el problema continúa, contacta con el administrador.

**❓ No aparece mi jornada en el listado**  
- Espera unos minutos, puede tardar en sincronizarse.  
- Si no aparece después de un día, informa a tu responsable.

**❓ Mi ausencia aparece como "pendiente"**  
- Significa que aún no ha sido revisada por el responsable.  
- Una vez aprobada o denegada, el estado cambiará automáticamente.

---

## 7. Troubleshooting

**Problema:** No carga la aplicación.  
**Solución:**  
- Revisa tu conexión a internet.  
- Prueba a actualizar la página (Ctrl+R o F5).  
- Si persiste, contacta con soporte.

**Problema:** El botón de inicio o fin de jornada no funciona.  
**Solución:**  
- Cierra sesión y vuelve a entrar.  
- Asegúrate de permitir el acceso a la ubicación si la empresa lo requiere.  
- Contacta con administración si no se soluciona.

**Problema:** No se guardan mis ausencias.  
**Solución:**  
- Revisa que todos los campos del formulario estén completos.  
- Intenta de nuevo.  
- Si sigue fallando, informa a soporte.

---

📌 **Recuerda:**  
El uso correcto de la aplicación garantiza el registro fiable de tus jornadas y ausencias. Usa siempre la aplicación al inicio y final de tu jornada laboral.


```
**index.php**
```php
<?php
/**
 * Pure PHP Markdown to HTML Converter with Hierarchical Index
 */

class SimpleMarkdownParser {
    public static function parse($markdown, &$index) {
        // Horizontal Rule: ---
        $markdown = preg_replace('/^\-\-\-$/m', '<hr>', $markdown);

        // Images: ![Alt text](img/path.png)
        $markdown = preg_replace('/\!\[(.*?)\]\((.*?)\)/', '<img src="$2" alt="$1" style="max-width: 100%;">', $markdown);

        // Headers (with ID for linking)
        $markdown = preg_replace_callback('/^(#) (.*$)/m', function($matches) use (&$index) {
            $level = strlen($matches[1]);
            $id = preg_replace('/[^a-z0-9]/i', '-', strtolower($matches[2]));
            $index[] = ['level' => $level, 'id' => $id, 'title' => $matches[2]];
            return '<h' . $level . ' id="' . $id . '">' . $matches[2] . '</h' . $level . '>';
        }, $markdown);

        $markdown = preg_replace_callback('/^(##) (.*$)/m', function($matches) use (&$index) {
            $level = strlen($matches[1]);
            $id = preg_replace('/[^a-z0-9]/i', '-', strtolower($matches[2]));
            $index[] = ['level' => $level, 'id' => $id, 'title' => $matches[2]];
            return '<h' . $level . ' id="' . $id . '">' . $matches[2] . '</h' . $level . '>';
        }, $markdown);

        // Bold and Italic
        $markdown = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $markdown);
        $markdown = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $markdown);

        // Links
        $markdown = preg_replace('/\[(.*?)\]\((.*?)\)/', '<a href="$2">$1</a>', $markdown);

        // Lists
        $markdown = preg_replace('/^\* (.*$)/m', '<li>$1</li>', $markdown);
        $markdown = str_replace('<li>', '<ul><li>', str_replace('</li>', '</li></ul>', $markdown));

        // Code blocks
        $markdown = preg_replace('/```(.*?)\n(.*?)```/s', '<pre><code>$2</code></pre>', $markdown);
        $markdown = preg_replace('/`(.*?)`/', '<code>$1</code>', $markdown);

        // Tables (simple support)
        $markdown = preg_replace('/^\|(.+)\|$/', '<table><tr>$1</tr>', $markdown);
        $markdown = preg_replace('/^\|(.+)\|$/', '<tr>$1</tr>', $markdown);
        $markdown = preg_replace('/\|(.+?)\|/', '<td>$1</td>', $markdown);
        $markdown = str_replace('<tr>', '<tr>', str_replace('</tr>', '</tr></table>', $markdown));

        // Paragraphs
        $markdown = '<p>' . str_replace("\n", '</p><p>', $markdown) . '</p>';
        $markdown = str_replace('<p></p>', '', $markdown);

        return $markdown;
    }
}

function buildHierarchicalIndex($index) {
    $result = '<div class="index"><p>Índice</p><ul>';
    $prevLevel = 1;
    foreach ($index as $item) {
        if ($item['level'] == 1) {
            if ($prevLevel == 2) {
                $result .= '</ul></li>';
            }
            $result .= '<li><a href="#' . $item['id'] . '">' . $item['title'] . '</a>';
            $prevLevel = 1;
        } else if ($item['level'] == 2) {
            if ($prevLevel == 1) {
                $result .= '<ul>';
            }
            $result .= '<li><a href="#' . $item['id'] . '">' . $item['title'] . '</a></li>';
            $prevLevel = 2;
        }
    }
    if ($prevLevel == 2) {
        $result .= '</ul></li>';
    }
    $result .= '</ul></div>';
    return $result;
}

function markdownToHtml($markdownFilePath) {
    if (!file_exists($markdownFilePath)) {
        die("Markdown file not found: $markdownFilePath");
    }
    $markdown = file_get_contents($markdownFilePath);
    $index = [];
    $html = SimpleMarkdownParser::parse($markdown, $index);

    // Generate hierarchical index
    $indexHtml = buildHierarchicalIndex($index);

    $htmlOutput = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help System</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0 auto; max-width: 800px; padding: 20px; color: #333; }
        h1, h2, h3 { color: #2c3e50; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        code { background: #f4f4f4; padding: 2px 5px; border-radius: 3px; font-family: monospace; }
        pre { background: #f4f4f4; padding: 10px; border-radius: 5px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
        ul { margin: 10px 0; padding-left: 20px; }
        hr { border: 0; height: 1px; background: #ddd; margin: 20px 0; }
        img { max-width: 100%; height: auto; margin: 10px 0; }
        .index { background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .index ul { padding-left: 20px; list-style-type: none; }
        .index li { margin: 5px 0; }
        .index a { text-decoration: none; color: #3498db; }
        .index a:hover { text-decoration: underline; }
        .index ul ul { padding-left: 20px; }
        .index ul ul li { font-size: 0.9em; }
        @media print {
      .page-break,h2 { 
        page-break-before: always; /* legacy */
        break-before: page;        /* modern */
      }
    }
    </style>
</head>
<body>
  <img src="../darksalmon.png" style="width: 50%;
    margin: auto;
    text-align: center;
    left: 50%;
    position: relative;
    margin-left: -25%;">
    $indexHtml
    <div class="page-break"></div>
    $html
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
HTML;
    return $htmlOutput;
}

// Example usage
$markdownFile = 'darksalmon.md'; // Change to your Markdown file path
echo markdownToHtml($markdownFile);
?>


```
#### img