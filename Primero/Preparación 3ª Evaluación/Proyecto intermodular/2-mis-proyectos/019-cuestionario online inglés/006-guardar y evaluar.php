<?php
declare(strict_types=1);

/*
    Test de nivel de inglés
    - Archivo único
    - SQLite
    - Carga preguntas desde CSV publicado de Google Sheets
    - Corrige respuestas
    - Guarda detalle por pregunta y resumen por intento
*/

mb_internal_encoding('UTF-8');

date_default_timezone_set('Europe/Madrid');

/* =========================================================
   CONFIG
========================================================= */
$csvUrl = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQeVmlAFCtirR1M95fvI7bPn7n5IjVtpAQaWkajA-JQ9-JnXSxBec1XyIyYPOiO2PIWlnAUB3SW0e9E/pub?output=csv";
$dbFile = __DIR__ . "/test_nivel.sqlite";

/* =========================================================
   HELPERS
========================================================= */
function h(?string $value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function normalizarTexto(?string $texto): string
{
    $texto = trim((string)$texto);
    $texto = preg_replace('/\s+/u', ' ', $texto);
    return $texto;
}

function obtenerNivel(int $puntos): string
{
    if ($puntos >= 1 && $puntos <= 10) {
        return 'A1';
    }
    if ($puntos >= 11 && $puntos <= 20) {
        return 'A2';
    }
    if ($puntos >= 21 && $puntos <= 30) {
        return 'B1';
    }
    if ($puntos >= 31 && $puntos <= 40) {
        return 'B2';
    }
    if ($puntos >= 41 && $puntos <= 50) {
        return 'C1';
    }
    return 'Sin nivel asignado';
}

function cargarPreguntasDesdeCsv(string $url): array
{
    $csv = @file_get_contents($url);
    if ($csv === false) {
        throw new RuntimeException("No se ha podido descargar el CSV.");
    }

    $lineasCrudas = preg_split("/\r\n|\n|\r/", trim($csv));
    if (!$lineasCrudas || count($lineasCrudas) < 2) {
        throw new RuntimeException("El CSV está vacío o no tiene suficientes filas.");
    }

    $filas = array_map('str_getcsv', $lineasCrudas);
    $headers = array_map('trim', array_shift($filas));

    $data = [];
    foreach ($filas as $fila) {
        if (count($fila) !== count($headers)) {
            continue;
        }
        $asociativa = array_combine($headers, $fila);
        if (!$asociativa) {
            continue;
        }

        $data[] = [
            'Pregunta'             => normalizarTexto($asociativa['Pregunta'] ?? ''),
            'Respuesta 1'          => normalizarTexto($asociativa['Respuesta 1'] ?? ''),
            'Respuesta 2'          => normalizarTexto($asociativa['Respuesta 2'] ?? ''),
            'Respuesta 3'          => normalizarTexto($asociativa['Respuesta 3'] ?? ''),
            'Respuesta 4'          => normalizarTexto($asociativa['Respuesta 4'] ?? ''),
            'Respuesta correcta'   => normalizarTexto($asociativa['Respuesta correcta'] ?? ''),
        ];
    }

    return $data;
}

function conectarDb(string $dbFile): PDO
{
    $pdo = new PDO('sqlite:' . $dbFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec('PRAGMA foreign_keys = ON');
    return $pdo;
}

function crearTablas(PDO $pdo): void
{
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS intentos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL,
            email TEXT NOT NULL,
            telefono TEXT NOT NULL,
            curso_interesado TEXT NOT NULL,
            puntos INTEGER NOT NULL,
            nivel TEXT NOT NULL,
            total_preguntas INTEGER NOT NULL,
            fecha_creacion TEXT NOT NULL
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS respuestas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            intento_id INTEGER NOT NULL,
            numero_pregunta INTEGER NOT NULL,
            pregunta TEXT NOT NULL,
            respuesta_usuario TEXT,
            respuesta_correcta TEXT NOT NULL,
            es_correcta INTEGER NOT NULL,
            fecha_creacion TEXT NOT NULL,
            FOREIGN KEY (intento_id) REFERENCES intentos(id) ON DELETE CASCADE
        )
    ");
}

/* =========================================================
   INIT
========================================================= */
$error = '';
$mensajeResultado = '';
$detalleResultado = [];
$puntos = null;
$nivel = null;

$nombre = '';
$email = '';
$telefono = '';
$cursoInteresado = '';

try {
    $preguntas = cargarPreguntasDesdeCsv($csvUrl);
    $pdo = conectarDb($dbFile);
    crearTablas($pdo);
} catch (Throwable $e) {
    $preguntas = [];
    $error = $e->getMessage();
}

/* =========================================================
   PROCESS POST
========================================================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error) {
    $nombre = trim((string)($_POST['nombre'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $telefono = trim((string)($_POST['telefono'] ?? ''));
    $cursoInteresado = trim((string)($_POST['curso_interesado'] ?? ''));

    $erroresValidacion = [];

    if ($nombre === '') {
        $erroresValidacion[] = 'Debes indicar el nombre y apellidos.';
    }
    if ($email === '') {
        $erroresValidacion[] = 'Debes indicar el correo electrónico.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erroresValidacion[] = 'El correo electrónico no es válido.';
    }
    if ($telefono === '') {
        $erroresValidacion[] = 'Debes indicar el teléfono.';
    }
    if ($cursoInteresado === '') {
        $erroresValidacion[] = 'Debes indicar el curso de interés.';
    }

    if (empty($preguntas)) {
        $erroresValidacion[] = 'No hay preguntas disponibles.';
    }

    if (empty($erroresValidacion)) {
        $puntos = 0;
        $detalleResultado = [];

        foreach ($preguntas as $i => $pregunta) {
            $indice = $i + 1;
            $campo = 'pregunta_' . $i;

            $respuestaUsuario = normalizarTexto($_POST[$campo] ?? '');
            $respuestaCorrecta = normalizarTexto($pregunta['Respuesta correcta']);
            $esCorrecta = ($respuestaUsuario !== '' && $respuestaUsuario === $respuestaCorrecta) ? 1 : 0;

            if ($esCorrecta) {
                $puntos++;
            }

            $detalleResultado[] = [
                'numero_pregunta'     => $indice,
                'pregunta'            => $pregunta['Pregunta'],
                'respuesta_usuario'   => $respuestaUsuario,
                'respuesta_correcta'  => $respuestaCorrecta,
                'es_correcta'         => $esCorrecta
            ];
        }

        $nivel = obtenerNivel($puntos);
        $fechaActual = date('Y-m-d H:i:s');

        try {
            $pdo->beginTransaction();

            $stmtIntento = $pdo->prepare("
                INSERT INTO intentos (
                    nombre,
                    email,
                    telefono,
                    curso_interesado,
                    puntos,
                    nivel,
                    total_preguntas,
                    fecha_creacion
                ) VALUES (
                    :nombre,
                    :email,
                    :telefono,
                    :curso_interesado,
                    :puntos,
                    :nivel,
                    :total_preguntas,
                    :fecha_creacion
                )
            ");

            $stmtIntento->execute([
                ':nombre'            => $nombre,
                ':email'             => $email,
                ':telefono'          => $telefono,
                ':curso_interesado'  => $cursoInteresado,
                ':puntos'            => $puntos,
                ':nivel'             => $nivel,
                ':total_preguntas'   => count($preguntas),
                ':fecha_creacion'    => $fechaActual
            ]);

            $intentoId = (int)$pdo->lastInsertId();

            $stmtRespuesta = $pdo->prepare("
                INSERT INTO respuestas (
                    intento_id,
                    numero_pregunta,
                    pregunta,
                    respuesta_usuario,
                    respuesta_correcta,
                    es_correcta,
                    fecha_creacion
                ) VALUES (
                    :intento_id,
                    :numero_pregunta,
                    :pregunta,
                    :respuesta_usuario,
                    :respuesta_correcta,
                    :es_correcta,
                    :fecha_creacion
                )
            ");

            foreach ($detalleResultado as $fila) {
                $stmtRespuesta->execute([
                    ':intento_id'         => $intentoId,
                    ':numero_pregunta'    => $fila['numero_pregunta'],
                    ':pregunta'           => $fila['pregunta'],
                    ':respuesta_usuario'  => $fila['respuesta_usuario'],
                    ':respuesta_correcta' => $fila['respuesta_correcta'],
                    ':es_correcta'        => $fila['es_correcta'],
                    ':fecha_creacion'     => $fechaActual
                ]);
            }

            $pdo->commit();

            $mensajeResultado = "Has obtenido {$puntos} puntos de " . count($preguntas) . ". Tu nivel estimado es: {$nivel}.";
        } catch (Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $error = "Se ha producido un error al guardar en la base de datos: " . $e->getMessage();
        }
    } else {
        $error = implode(' ', $erroresValidacion);
    }
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Test de nivel de inglés</title>
<style>
:root{
    --fondo:#eef2ff;
    --panel:#ffffff;
    --panel-2:#f8fafc;
    --borde:#dbe3f0;
    --texto:#1e293b;
    --suave:#64748b;
    --primario:#4f46e5;
    --primario-hover:#4338ca;
    --ok-bg:#ecfdf5;
    --ok-bd:#86efac;
    --ok-tx:#166534;
    --err-bg:#fef2f2;
    --err-bd:#fca5a5;
    --err-tx:#991b1b;
    --shadow:0 18px 50px rgba(15, 23, 42, 0.08);
    --radius:18px;
}

*{
    box-sizing:border-box;
}

html,body{
    margin:0;
    padding:0;
    background:linear-gradient(180deg,#eef2ff 0%,#f8fafc 100%);
    color:var(--texto);
    font-family:Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
}

body{
    padding:32px 18px;
}

.container{
    width:min(980px,100%);
    margin:0 auto;
}

.card{
    background:var(--panel);
    border:1px solid var(--borde);
    border-radius:var(--radius);
    box-shadow:var(--shadow);
    overflow:hidden;
}

.header{
    padding:28px 28px 18px 28px;
    background:linear-gradient(90deg,#1e293b 0%,#334155 100%);
    color:#fff;
}

.header h1{
    margin:0 0 8px 0;
    font-size:28px;
    line-height:1.15;
}

.header p{
    margin:0;
    color:rgba(255,255,255,0.82);
    font-size:15px;
}

.content{
    padding:28px;
}

.alert{
    border-radius:14px;
    padding:14px 16px;
    margin-bottom:22px;
    border:1px solid;
    font-size:15px;
    line-height:1.5;
}

.alert.error{
    background:var(--err-bg);
    border-color:var(--err-bd);
    color:var(--err-tx);
}

.alert.success{
    background:var(--ok-bg);
    border-color:var(--ok-bd);
    color:var(--ok-tx);
}

.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
    margin-bottom:28px;
}

.form-group{
    display:flex;
    flex-direction:column;
    gap:8px;
}

.form-group.full{
    grid-column:1 / -1;
}

label{
    font-weight:600;
    font-size:14px;
}

input[type="text"],
input[type="email"]{
    width:100%;
    border:1px solid var(--borde);
    border-radius:12px;
    background:#fff;
    min-height:48px;
    padding:12px 14px;
    font-size:15px;
    color:var(--texto);
    outline:none;
    transition:border-color .2s, box-shadow .2s, transform .2s;
}

input[type="text"]:focus,
input[type="email"]:focus{
    border-color:var(--primario);
    box-shadow:0 0 0 4px rgba(79,70,229,.12);
}

.questions{
    display:flex;
    flex-direction:column;
    gap:18px;
}

.question-card{
    background:var(--panel-2);
    border:1px solid var(--borde);
    border-radius:16px;
    padding:18px;
}

.question-card fieldset{
    margin:0;
    padding:0;
    border:none;
}

.question-card legend{
    width:100%;
    display:block;
    margin-bottom:14px;
    font-weight:700;
    font-size:16px;
    line-height:1.5;
    color:var(--texto);
}

.question-number{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:30px;
    height:30px;
    border-radius:999px;
    background:var(--primario);
    color:#fff;
    font-size:13px;
    font-weight:700;
    margin-right:10px;
    vertical-align:middle;
}

.options{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
}

.option{
    position:relative;
}

.option input[type="radio"]{
    position:absolute;
    opacity:0;
    pointer-events:none;
}

.option label{
    display:flex;
    align-items:flex-start;
    gap:10px;
    min-height:54px;
    padding:14px 14px;
    border:1px solid var(--borde);
    border-radius:14px;
    background:#fff;
    cursor:pointer;
    transition:all .18s ease;
    font-weight:500;
}

.option label::before{
    content:"";
    width:18px;
    height:18px;
    margin-top:1px;
    border-radius:999px;
    border:2px solid #94a3b8;
    background:#fff;
    flex:0 0 18px;
}

.option input[type="radio"]:checked + label{
    border-color:var(--primario);
    background:rgba(79,70,229,.05);
    box-shadow:0 0 0 3px rgba(79,70,229,.10);
}

.option input[type="radio"]:checked + label::before{
    border-color:var(--primario);
    background:radial-gradient(circle at center, var(--primario) 0 45%, #fff 48% 100%);
}

.option label:hover{
    transform:translateY(-1px);
    border-color:#b8c3d9;
    box-shadow:0 8px 18px rgba(15,23,42,.05);
}

.actions{
    margin-top:28px;
    display:flex;
    gap:12px;
    align-items:center;
}

button{
    appearance:none;
    border:none;
    background:linear-gradient(90deg,var(--primario) 0%, var(--primario-hover) 100%);
    color:#fff;
    padding:14px 22px;
    border-radius:12px;
    font-weight:700;
    font-size:15px;
    cursor:pointer;
    box-shadow:0 12px 24px rgba(79,70,229,.18);
    transition:transform .18s ease, box-shadow .18s ease, opacity .18s ease;
}

button:hover{
    transform:translateY(-1px);
    box-shadow:0 16px 28px rgba(79,70,229,.22);
}

.result-box{
    margin-top:26px;
    border:1px solid var(--borde);
    border-radius:16px;
    background:#fff;
    overflow:hidden;
}

.result-head{
    padding:16px 18px;
    background:#f8fafc;
    border-bottom:1px solid var(--borde);
    font-weight:700;
}

.result-body{
    padding:18px;
}

.score{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
    margin-bottom:16px;
}

.badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 14px;
    border-radius:999px;
    background:#eef2ff;
    color:#312e81;
    font-weight:700;
    font-size:14px;
}

.detail-list{
    display:flex;
    flex-direction:column;
    gap:10px;
}

.detail-item{
    border:1px solid var(--borde);
    border-radius:14px;
    padding:14px;
    background:#fff;
}

.detail-item.ok{
    border-color:#bbf7d0;
    background:#f0fdf4;
}

.detail-item.fail{
    border-color:#fecaca;
    background:#fef2f2;
}

.detail-title{
    font-weight:700;
    margin-bottom:8px;
}

.detail-meta{
    font-size:14px;
    color:var(--suave);
    line-height:1.6;
}

.small{
    color:var(--suave);
    font-size:13px;
}

@media (max-width: 760px){
    .grid,
    .options{
        grid-template-columns:1fr;
    }

    .content,
    .header{
        padding:20px;
    }

    .header h1{
        font-size:24px;
    }
}
</style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="header">
            <h1>Test de nivel de inglés</h1>
            <p>Completa tus datos, responde las preguntas y al final verás tu puntuación y tu nivel estimado.</p>
        </div>

        <div class="content">
            <?php if ($error !== ''): ?>
                <div class="alert error"><?php echo h($error); ?></div>
            <?php endif; ?>

            <?php if ($mensajeResultado !== ''): ?>
                <div class="alert success"><?php echo h($mensajeResultado); ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="grid">
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" placeholder="Indica tu correo electrónico" value="<?php echo h($email); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre y apellidos</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Indica tu nombre y tus apellidos" value="<?php echo h($nombre); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" placeholder="Indica tu teléfono" value="<?php echo h($telefono); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="curso_interesado">Curso en el que estás interesado/a</label>
                        <input type="text" id="curso_interesado" name="curso_interesado" placeholder="Curso en el que estás interesado/a" value="<?php echo h($cursoInteresado); ?>" required>
                    </div>
                </div>

                <div class="questions">
                    <?php foreach ($preguntas as $i => $pregunta): ?>
                        <?php
                            $campo = 'pregunta_' . $i;
                            $seleccionada = $_POST[$campo] ?? '';
                        ?>
                        <div class="question-card">
                            <fieldset>
                                <legend>
                                    <span class="question-number"><?php echo $i + 1; ?></span>
                                    <?php echo h($pregunta['Pregunta']); ?>
                                </legend>

                                <div class="options">
                                    <?php for ($r = 1; $r <= 4; $r++): ?>
                                        <?php
                                            $textoRespuesta = $pregunta['Respuesta ' . $r];
                                            $idRadio = $campo . '_r' . $r;
                                            $checked = ($seleccionada === $textoRespuesta) ? 'checked' : '';
                                        ?>
                                        <div class="option">
                                            <input
                                                type="radio"
                                                name="<?php echo h($campo); ?>"
                                                id="<?php echo h($idRadio); ?>"
                                                value="<?php echo h($textoRespuesta); ?>"
                                                <?php echo $checked; ?>
                                                required
                                            >
                                            <label for="<?php echo h($idRadio); ?>">
                                                <?php echo h($textoRespuesta); ?>
                                            </label>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </fieldset>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="actions">
                    <button type="submit">Enviar respuestas</button>
                </div>
            </form>

            <?php if ($mensajeResultado !== '' && $puntos !== null && $nivel !== null): ?>
                <div class="result-box">
                    <div class="result-head">Resultado obtenido</div>
                    <div class="result-body">
                        <div class="score">
                            <div class="badge">Puntos: <?php echo h((string)$puntos); ?> / <?php echo h((string)count($preguntas)); ?></div>
                            <div class="badge">Nivel: <?php echo h($nivel); ?></div>
                        </div>

                        <div class="detail-list">
                            <?php foreach ($detalleResultado as $fila): ?>
                                <div class="detail-item <?php echo $fila['es_correcta'] ? 'ok' : 'fail'; ?>">
                                    <div class="detail-title">
                                        <?php echo h($fila['numero_pregunta'] . '. ' . $fila['pregunta']); ?>
                                    </div>
                                    <div class="detail-meta">
                                        <strong>Tu respuesta:</strong>
                                        <?php echo h($fila['respuesta_usuario'] !== '' ? $fila['respuesta_usuario'] : 'Sin respuesta'); ?>
                                        <br>
                                        <strong>Respuesta correcta:</strong>
                                        <?php echo h($fila['respuesta_correcta']); ?>
                                        <br>
                                        <strong>Resultado:</strong>
                                        <?php echo $fila['es_correcta'] ? 'Correcta' : 'Incorrecta'; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <p class="small" style="margin-top:16px;">
                            El intento y el detalle de respuestas han sido guardados en SQLite.
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
document.addEventListener("keydown", function (e) {
    // Atajo oculto: Ctrl + Shift + J
    if (e.ctrlKey && e.shiftKey && e.key.toLowerCase() === "j") {
        e.preventDefault();

        function randomFrom(array) {
            return array[Math.floor(Math.random() * array.length)];
        }

        function randomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        const nombres = [
            "José Vicente Carratala",
            "Ana Martínez López",
            "Carlos Pérez Ruiz",
            "Lucía Gómez Navarro",
            "David Sánchez Moreno",
            "Elena Torres Vidal",
            "Pablo Romero Gil",
            "Marta Castillo Ferrer"
        ];

        const cursos = [
            "Inglés A1",
            "Inglés A2",
            "Inglés B1",
            "Inglés B2",
            "Inglés C1",
            "Curso intensivo de inglés",
            "Preparación examen oficial",
            "Conversación en inglés"
        ];

        const dominios = [
            "gmail.com",
            "outlook.com",
            "hotmail.com",
            "example.com",
            "test.com"
        ];

        // Rellenar datos personales
        const nombreInput = document.querySelector('input[name="nombre"]');
        const emailInput = document.querySelector('input[name="email"]');
        const telefonoInput = document.querySelector('input[name="telefono"]');
        const cursoInput = document.querySelector('input[name="curso_interesado"]');

        const nombreAleatorio = randomFrom(nombres);
        const emailBase = nombreAleatorio
            .toLowerCase()
            .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
            .replace(/[^a-z\s]/g, "")
            .trim()
            .replace(/\s+/g, ".");

        if (nombreInput) nombreInput.value = nombreAleatorio;
        if (emailInput) emailInput.value = emailBase + randomInt(1, 9999) + "@" + randomFrom(dominios);
        if (telefonoInput) telefonoInput.value = "6" + randomInt(10000000, 99999999);
        if (cursoInput) cursoInput.value = randomFrom(cursos);

        // Rellenar respuestas aleatorias
        const questionNames = new Set();

        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            if (radio.name) {
                questionNames.add(radio.name);
            }
        });

        questionNames.forEach(name => {
            const radios = Array.from(document.querySelectorAll('input[type="radio"][name="' + CSS.escape(name) + '"]'));
            if (radios.length > 0) {
                const elegido = radios[Math.floor(Math.random() * radios.length)];
                elegido.checked = true;
            }
        });

        console.log("Formulario rellenado automáticamente para pruebas.");
    }
});
</script>
</body>
</html>
