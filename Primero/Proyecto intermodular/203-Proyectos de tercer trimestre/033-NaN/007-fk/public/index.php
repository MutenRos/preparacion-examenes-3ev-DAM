<?php
require_once __DIR__ . '/../app/auth.php';

function h($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function redirect(string $url): never { header('Location: ' . $url); exit; }

function table_meta(): array {
    return [
        'usuarios' => ['title'=>'Usuarios','fields'=>['nombre','apellidos','email','password_hash','perfil_id','activo'],'labels'=>['perfil_id'=>'Perfil','password_hash'=>'Contraseña / Hash']],
        'alumnos' => ['title'=>'Alumnos','fields'=>['usuario_id','fecha_nacimiento','telefono','direccion']],
        'profesores' => ['title'=>'Profesores','fields'=>['usuario_id','especialidad','telefono']],
        'cursos' => ['title'=>'Cursos','fields'=>['nombre','descripcion','activo']],
        'asignaturas' => ['title'=>'Asignaturas','fields'=>['curso_id','nombre','descripcion','orden','activo']],
        'curso_ediciones' => ['title'=>'Ediciones de curso','fields'=>['curso_id','nombre','fecha_inicio','fecha_fin','activo']],
        'asignatura_ediciones' => ['title'=>'Ediciones de asignatura','fields'=>['asignatura_id','curso_edicion_id','profesor_id','fecha_inicio','fecha_fin','activo']],
        'matriculas' => ['title'=>'Matrículas','fields'=>['usuario_id','asignatura_edicion_id','tipo','activo']],
        'unidades' => ['title'=>'Unidades','fields'=>['asignatura_id','titulo','descripcion','orden']],
        'subunidades' => ['title'=>'Subunidades','fields'=>['unidad_id','titulo','descripcion','orden']],
        'lecciones' => ['title'=>'Lecciones','fields'=>['subunidad_id','titulo','descripcion','orden']],
        'sesiones' => ['title'=>'Sesiones','fields'=>['leccion_id','titulo','fecha','hora_inicio','hora_fin','descripcion']],
        'recursos' => ['title'=>'Recursos','fields'=>['leccion_id','titulo','descripcion','orden']],
        'actividades' => ['title'=>'Actividades','fields'=>['leccion_id','titulo','descripcion','fecha_entrega','puntuacion_maxima','orden']],
    ];
}

function fk_meta(): array {
    return [
        'usuarios.perfil_id' => ['table'=>'perfiles','label'=>"nombre",'order'=>"nombre"],
        'alumnos.usuario_id' => ['table'=>'usuarios','label'=>"nombre || ' ' || COALESCE(apellidos,'') || ' · ' || email",'order'=>"nombre, apellidos"],
        'profesores.usuario_id' => ['table'=>'usuarios','label'=>"nombre || ' ' || COALESCE(apellidos,'') || ' · ' || email",'order'=>"nombre, apellidos"],
        'asignaturas.curso_id' => ['table'=>'cursos','label'=>"nombre",'order'=>"nombre"],
        'curso_ediciones.curso_id' => ['table'=>'cursos','label'=>"nombre",'order'=>"nombre"],
        'asignatura_ediciones.asignatura_id' => ['table'=>'asignaturas','label'=>"nombre",'order'=>"nombre"],
        'asignatura_ediciones.curso_edicion_id' => ['table'=>'curso_ediciones','label'=>"nombre",'order'=>"nombre"],
        'asignatura_ediciones.profesor_id' => ['table'=>'profesores','label'=>"(SELECT usuarios.nombre || ' ' || COALESCE(usuarios.apellidos,'') || ' · ' || usuarios.email FROM usuarios WHERE usuarios.id = profesores.usuario_id)",'order'=>"id"],
        'matriculas.usuario_id' => ['table'=>'usuarios','label'=>"nombre || ' ' || COALESCE(apellidos,'') || ' · ' || email",'order'=>"nombre, apellidos"],
        'matriculas.asignatura_edicion_id' => ['table'=>'asignatura_ediciones','label'=>"(SELECT asignaturas.nombre FROM asignaturas WHERE asignaturas.id = asignatura_ediciones.asignatura_id) || ' · ' || (SELECT curso_ediciones.nombre FROM curso_ediciones WHERE curso_ediciones.id = asignatura_ediciones.curso_edicion_id)",'order'=>"id"],
        'unidades.asignatura_id' => ['table'=>'asignaturas','label'=>"nombre",'order'=>"nombre"],
        'subunidades.unidad_id' => ['table'=>'unidades','label'=>"titulo",'order'=>"orden, titulo"],
        'lecciones.subunidad_id' => ['table'=>'subunidades','label'=>"titulo",'order'=>"orden, titulo"],
        'sesiones.leccion_id' => ['table'=>'lecciones','label'=>"titulo",'order'=>"orden, titulo"],
        'recursos.leccion_id' => ['table'=>'lecciones','label'=>"titulo",'order'=>"orden, titulo"],
        'actividades.leccion_id' => ['table'=>'lecciones','label'=>"titulo",'order'=>"orden, titulo"],
    ];
}

function fk_for(string $table, string $field): ?array {
    return fk_meta()["{$table}.{$field}"] ?? null;
}

function fk_options(string $table, string $field): array {
    $fk = fk_for($table, $field);
    if (!$fk) return [];
    return all_rows("SELECT id, {$fk['label']} AS label FROM {$fk['table']} ORDER BY {$fk['order']}");
}

function fk_display(string $table, string $field, $value): string {
    if ($value === null || $value === '') return '';
    $fk = fk_for($table, $field);
    if (!$fk) return (string)$value;

    $row = one("SELECT id, {$fk['label']} AS label FROM {$fk['table']} WHERE id = ?", [$value]);
    if (!$row) return "ID {$value} · no encontrado";

    return "#" . $row['id'] . " · " . $row['label'];
}

function layout_start(?array $user, string $title = ''): void { ?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= h(APP_NAME . ($title ? ' · ' . $title : '')) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="topbar">
    <a class="brand" href="index.php">Centro LMS</a>
    <?php if ($user): ?>
        <div class="userbox">
            <span><?= h($user['nombre'] . ' · ' . $user['perfil']) ?></span>
            <a href="index.php?page=logout">Salir</a>
        </div>
    <?php endif; ?>
</header>
<main class="shell">
<?php }

function layout_end(): void {
    echo "</main><script src='assets/app.js'></script></body></html>";
}

function login_page(): void {
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (login_attempt(trim($_POST['email'] ?? ''), $_POST['password'] ?? '')) {
            redirect('index.php');
        }
        $error = 'Correo o contraseña incorrectos.';
    }

    layout_start(null, 'Login'); ?>
    <section class="login-card">
        <h1>Acceso al campus</h1>
        <p>Introduce correo y contraseña.</p>

        <?php if ($error): ?>
            <div class="alert"><?= h($error) ?></div>
        <?php endif; ?>

        <form method="post" class="form">
            <label>Correo <input type="email" name="email" required autofocus></label>
            <label>Contraseña <input type="password" name="password" required></label>
            <button>Entrar</button>
        </form>

        <div class="demo">
            <strong>Usuarios demo:</strong><br>
            alumno@demo.local / 1234<br>
            profesor@demo.local / 1234<br>
            gestor@demo.local / 1234<br>
            admin@demo.local / 1234
        </div>
    </section>
    <?php layout_end();
}

function asignaturas_usuario(array $user): array {
    if (is_manager($user)) {
        return all_rows("SELECT ae.id, a.nombre AS asignatura, ce.nombre AS edicion, c.nombre AS curso, u.nombre || ' ' || COALESCE(u.apellidos,'') AS profesor
            FROM asignatura_ediciones ae
            JOIN asignaturas a ON a.id = ae.asignatura_id
            JOIN curso_ediciones ce ON ce.id = ae.curso_edicion_id
            JOIN cursos c ON c.id = a.curso_id
            LEFT JOIN profesores p ON p.id = ae.profesor_id
            LEFT JOIN usuarios u ON u.id = p.usuario_id
            WHERE ae.activo = 1
            ORDER BY c.nombre, a.orden, a.nombre");
    }

    return all_rows("SELECT ae.id, a.nombre AS asignatura, ce.nombre AS edicion, c.nombre AS curso, u.nombre || ' ' || COALESCE(u.apellidos,'') AS profesor
        FROM matriculas m
        JOIN asignatura_ediciones ae ON ae.id = m.asignatura_edicion_id
        JOIN asignaturas a ON a.id = ae.asignatura_id
        JOIN curso_ediciones ce ON ce.id = ae.curso_edicion_id
        JOIN cursos c ON c.id = a.curso_id
        LEFT JOIN profesores p ON p.id = ae.profesor_id
        LEFT JOIN usuarios u ON u.id = p.usuario_id
        WHERE m.usuario_id = ? AND m.activo = 1 AND m.tipo = ?
        ORDER BY c.nombre, a.orden, a.nombre", [
            $user['id'],
            $user['perfil'] === 'profesor' ? 'profesor' : 'alumno'
        ]);
}

function manager_sidebar(array $user): void {
    if (!is_manager($user)) return;

    echo '<aside class="admin-sidebar"><h3>Gestión</h3><nav>';
    foreach (table_meta() as $table => $meta) {
        echo '<a href="index.php?page=crud&table=' . h($table) . '">' . h($meta['title']) . '</a>';
    }
    echo '</nav></aside>';
}

function dashboard(array $user): void {
    $items = asignaturas_usuario($user);

    layout_start($user, 'Panel'); ?>
    <div class="workspace <?= is_manager($user) ? 'with-admin' : '' ?>">
        <?php manager_sidebar($user); ?>

        <section class="content-main">
            <h1>Mis asignaturas</h1>
            <p class="muted">Selecciona una edición de asignatura para ver sus contenidos.</p>

            <div class="grid-cards">
                <?php foreach ($items as $it): ?>
                    <a class="subject-card" href="index.php?page=subject&id=<?= (int)$it['id'] ?>">
                        <span><?= h($it['curso']) ?></span>
                        <h2><?= h($it['asignatura']) ?></h2>
                        <p><?= h($it['edicion']) ?></p>
                        <small>Profesor: <?= h($it['profesor'] ?: 'Sin asignar') ?></small>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
    <?php layout_end();
}

function subject_allowed(array $user, int $ae_id): bool {
    if (is_manager($user)) return true;

    return (bool)one(
        "SELECT 1 FROM matriculas WHERE usuario_id = ? AND asignatura_edicion_id = ? AND tipo = ? AND activo = 1",
        [$user['id'], $ae_id, $user['perfil'] === 'profesor' ? 'profesor' : 'alumno']
    );
}

function get_subject(int $ae_id): ?array {
    return one("SELECT ae.*, a.nombre AS asignatura, a.descripcion AS asignatura_descripcion, a.id AS asignatura_id, c.nombre AS curso, ce.nombre AS edicion
        FROM asignatura_ediciones ae
        JOIN asignaturas a ON a.id = ae.asignatura_id
        JOIN cursos c ON c.id = a.curso_id
        JOIN curso_ediciones ce ON ce.id = ae.curso_edicion_id
        WHERE ae.id = ?", [$ae_id]);
}

function tree_html(int $asignatura_id, int $ae_id): void {
    $unidades = all_rows("SELECT * FROM unidades WHERE asignatura_id = ? ORDER BY orden, id", [$asignatura_id]);

    echo '<ul class="tree">';

    foreach ($unidades as $u) {
        echo '<li>';
        echo '<a href="index.php?page=subject&id='.(int)$ae_id.'&type=unidad&item='.(int)$u['id'].'">'.h($u['titulo']).'</a>';

        $subs = all_rows("SELECT * FROM subunidades WHERE unidad_id = ? ORDER BY orden, id", [$u['id']]);
        echo '<ul>';

        foreach ($subs as $s) {
            echo '<li>';
            echo '<a href="index.php?page=subject&id='.(int)$ae_id.'&type=subunidad&item='.(int)$s['id'].'">'.h($s['titulo']).'</a>';

            $lessons = all_rows("SELECT * FROM lecciones WHERE subunidad_id = ? ORDER BY orden, id", [$s['id']]);
            echo '<ul>';

            foreach ($lessons as $l) {
                echo '<li>';
                echo '<a href="index.php?page=subject&id='.(int)$ae_id.'&type=leccion&item='.(int)$l['id'].'">'.h($l['titulo']).'</a>';

                $sessions = all_rows("SELECT * FROM sesiones WHERE leccion_id = ? ORDER BY fecha, hora_inicio, id", [$l['id']]);
                echo '<ul>';

                foreach ($sessions as $se) {
                    echo '<li>';
                    echo '<a href="index.php?page=subject&id='.(int)$ae_id.'&type=sesion&item='.(int)$se['id'].'">'.h($se['titulo']).'</a>';
                    echo '</li>';
                }

                echo '</ul>';
                echo '</li>';
            }

            echo '</ul>';
            echo '</li>';
        }

        echo '</ul>';
        echo '</li>';
    }

    echo '</ul>';
}

function selected_content(string $type, int $item): ?array {
    $allowed = [
        'unidad' => 'unidades',
        'subunidad' => 'subunidades',
        'leccion' => 'lecciones',
        'sesion' => 'sesiones',
    ];

    if (!isset($allowed[$type]) || $item <= 0) return null;

    return one("SELECT * FROM {$allowed[$type]} WHERE id = ?", [$item]);
}

function content_context(string $type, int $item, int $asignatura_id): array {
    $ctx = [
        'asignatura_id' => $asignatura_id,
        'unidad_id' => null,
        'subunidad_id' => null,
        'leccion_id' => null,
    ];

    if ($type === 'unidad') {
        $ctx['unidad_id'] = $item;
    }

    if ($type === 'subunidad') {
        $sub = one("SELECT * FROM subunidades WHERE id = ?", [$item]);
        if ($sub) {
            $ctx['subunidad_id'] = $sub['id'];
            $ctx['unidad_id'] = $sub['unidad_id'];
        }
    }

    if ($type === 'leccion') {
        $lec = one("SELECT * FROM lecciones WHERE id = ?", [$item]);
        if ($lec) {
            $ctx['leccion_id'] = $lec['id'];
            $ctx['subunidad_id'] = $lec['subunidad_id'];

            $sub = one("SELECT * FROM subunidades WHERE id = ?", [$lec['subunidad_id']]);
            if ($sub) {
                $ctx['unidad_id'] = $sub['unidad_id'];
            }
        }
    }

    if ($type === 'sesion') {
        $ses = one("SELECT * FROM sesiones WHERE id = ?", [$item]);
        if ($ses) {
            $ctx['leccion_id'] = $ses['leccion_id'];

            $lec = one("SELECT * FROM lecciones WHERE id = ?", [$ses['leccion_id']]);
            if ($lec) {
                $ctx['subunidad_id'] = $lec['subunidad_id'];

                $sub = one("SELECT * FROM subunidades WHERE id = ?", [$lec['subunidad_id']]);
                if ($sub) {
                    $ctx['unidad_id'] = $sub['unidad_id'];
                }
            }
        }
    }

    return $ctx;
}

function shortcut_buttons(array $ctx): void {
    echo '<div class="shortcut-actions">';

    echo '<a class="shortcut-add" href="index.php?page=crud&table=unidades&asignatura_id='.(int)$ctx['asignatura_id'].'">+ Unidad</a>';

    if ($ctx['unidad_id']) {
        echo '<a class="shortcut-add" href="index.php?page=crud&table=subunidades&unidad_id='.(int)$ctx['unidad_id'].'">+ Subunidad</a>';
    } else {
        echo '<span class="shortcut-disabled">+ Subunidad</span>';
    }

    if ($ctx['subunidad_id']) {
        echo '<a class="shortcut-add" href="index.php?page=crud&table=lecciones&subunidad_id='.(int)$ctx['subunidad_id'].'">+ Lección</a>';
    } else {
        echo '<span class="shortcut-disabled">+ Lección</span>';
    }

    if ($ctx['leccion_id']) {
        echo '<a class="shortcut-add" href="index.php?page=crud&table=sesiones&leccion_id='.(int)$ctx['leccion_id'].'">+ Sesión</a>';
        echo '<a class="shortcut-add" href="index.php?page=crud&table=recursos&leccion_id='.(int)$ctx['leccion_id'].'">+ Recurso</a>';
        echo '<a class="shortcut-add" href="index.php?page=crud&table=actividades&leccion_id='.(int)$ctx['leccion_id'].'">+ Actividad</a>';
    } else {
        echo '<span class="shortcut-disabled">+ Sesión</span>';
        echo '<span class="shortcut-disabled">+ Recurso</span>';
        echo '<span class="shortcut-disabled">+ Actividad</span>';
    }

    echo '</div>';
}

function leccion_id_para_extras(string $type, ?array $selected): ?int {
    if (!$selected) return null;

    if ($type === 'leccion') {
        return (int)$selected['id'];
    }

    if ($type === 'sesion') {
        return (int)$selected['leccion_id'];
    }

    return null;
}

function render_recursos_y_actividades(?int $leccion_id): void {
    if (!$leccion_id) return;

    $recursos = all_rows("SELECT * FROM recursos WHERE leccion_id = ? ORDER BY orden, id", [$leccion_id]);
    $actividades = all_rows("SELECT * FROM actividades WHERE leccion_id = ? ORDER BY orden, id", [$leccion_id]);

    if ($recursos) {
        echo '<h2>Recursos</h2>';

        foreach ($recursos as $recurso) {
            echo '<div class="plain-box">';
            echo '<h3>' . h($recurso['titulo']) . '</h3>';
            echo '<p>' . nl2br(h($recurso['descripcion'] ?? '')) . '</p>';
            echo '</div>';
        }
    }

    if ($actividades) {
        echo '<h2>Actividades</h2>';

        foreach ($actividades as $actividad) {
            echo '<div class="plain-box">';
            echo '<h3>' . h($actividad['titulo']) . '</h3>';
            echo '<p>' . nl2br(h($actividad['descripcion'] ?? '')) . '</p>';

            if (!empty($actividad['fecha_entrega'])) {
                echo '<p><strong>Entrega:</strong> ' . h($actividad['fecha_entrega']) . '</p>';
            }

            if ($actividad['puntuacion_maxima'] !== null && $actividad['puntuacion_maxima'] !== '') {
                echo '<p><strong>Puntuación máxima:</strong> ' . h($actividad['puntuacion_maxima']) . '</p>';
            }

            echo '</div>';
        }
    }
}

function subject_page(array $user): void {
    $ae_id = (int)($_GET['id'] ?? 0);

    if (!$ae_id || !subject_allowed($user, $ae_id)) {
        redirect('index.php');
    }

    $subject = get_subject($ae_id);

    if (!$subject) {
        redirect('index.php');
    }

    $type = $_GET['type'] ?? '';
    $item = (int)($_GET['item'] ?? 0);

    $selected = selected_content($type, $item);
    $ctx = content_context($type, $item, (int)$subject['asignatura_id']);
    $leccion_id_extras = leccion_id_para_extras($type, $selected);

    layout_start($user, $subject['asignatura']); ?>
    <div class="workspace <?= is_manager($user) ? 'with-admin' : '' ?>">
        <?php manager_sidebar($user); ?>

        <section class="subject-layout">
            <aside class="content-tree">
                <a class="back" href="index.php">← Asignaturas</a>
                <h3><?= h($subject['asignatura']) ?></h3>
                <p><?= h($subject['edicion']) ?></p>
                <?php tree_html((int)$subject['asignatura_id'], $ae_id); ?>
            </aside>

            <article class="reader">
                <div class="reader-head">
                    <div>
                        <span><?= h($subject['curso']) ?></span>
                        <h1><?= h($selected['titulo'] ?? $subject['asignatura']) ?></h1>
                    </div>

                    <?php if (is_teacher_or_more($user)): ?>
                        <div class="actions-mini">
                            <a href="index.php?page=crud&table=unidades&asignatura_id=<?= (int)$subject['asignatura_id'] ?>">Unidades</a>
                            <a href="index.php?page=crud&table=subunidades">Subunidades</a>
                            <a href="index.php?page=crud&table=lecciones">Lecciones</a>
                            <a href="index.php?page=crud&table=sesiones">Sesiones</a>
                            <a href="index.php?page=crud&table=recursos">Recursos</a>
                            <a href="index.php?page=crud&table=actividades">Actividades</a>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (is_teacher_or_more($user)): ?>
                    <?php shortcut_buttons($ctx); ?>
                <?php endif; ?>

                <div class="prose">
                    <?php if ($selected): ?>
                        <p><?= nl2br(h($selected['descripcion'] ?? '')) ?></p>

                        <?php if ($type === 'sesion'): ?>
                            <p>
                                <strong>Fecha:</strong>
                                <?= h($selected['fecha']) ?>
                                <?php if (!empty($selected['hora_inicio']) || !empty($selected['hora_fin'])): ?>
                                    · <?= h($selected['hora_inicio']) ?> - <?= h($selected['hora_fin']) ?>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>

                        <?php render_recursos_y_actividades($leccion_id_extras); ?>
                    <?php else: ?>
                        <p><?= nl2br(h($subject['asignatura_descripcion'] ?: 'Selecciona un elemento del árbol para ver su contenido.')) ?></p>
                    <?php endif; ?>
                </div>
            </article>
        </section>
    </div>
    <?php layout_end();
}

function crud_allowed(array $user, string $table): bool {
    if (is_manager($user)) {
        return isset(table_meta()[$table]);
    }

    return $user['perfil'] === 'profesor'
        && in_array($table, ['unidades','subunidades','lecciones','sesiones','recursos','actividades'], true);
}

function crud_page(array $user): void {
    $meta_all = table_meta();
    $table = $_GET['table'] ?? 'unidades';

    if (!crud_allowed($user, $table)) {
        redirect('index.php');
    }

    $meta = $meta_all[$table];
    $fields = $meta['fields'];

    $id = (int)($_GET['edit'] ?? 0);
    $edit = $id ? one("SELECT * FROM {$table} WHERE id = ?", [$id]) : null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? 'save';

        if ($action === 'delete') {
            q("DELETE FROM {$table} WHERE id = ?", [(int)$_POST['id']]);
            redirect("index.php?page=crud&table={$table}");
        }

        $data = [];

        foreach ($fields as $f) {
            $data[$f] = $_POST[$f] ?? null;

            if ($data[$f] === '') {
                $data[$f] = null;
            }
        }

        if ($table === 'usuarios' && ($data['password_hash'] ?? '') !== '' && !str_starts_with((string)$data['password_hash'], '$2y$')) {
            $data['password_hash'] = password_hash($data['password_hash'], PASSWORD_DEFAULT);
        }

        if (!empty($_POST['id'])) {
            $sets = implode(', ', array_map(fn($f) => "$f = ?", $fields));
            q("UPDATE {$table} SET {$sets} WHERE id = ?", [...array_values($data), (int)$_POST['id']]);
        } else {
            $cols = implode(', ', $fields);
            $marks = implode(', ', array_fill(0, count($fields), '?'));
            q("INSERT INTO {$table} ({$cols}) VALUES ({$marks})", array_values($data));
        }

        redirect("index.php?page=crud&table={$table}");
    }

    $rows = all_rows("SELECT * FROM {$table} ORDER BY id DESC LIMIT 200");

    layout_start($user, $meta['title']); ?>
    <div class="workspace <?= is_manager($user) ? 'with-admin' : '' ?>">
        <?php manager_sidebar($user); ?>

        <section class="content-main crud">
            <a class="back" href="index.php">← Volver</a>
            <h1><?= h($meta['title']) ?></h1>

            <form method="post" class="crud-form">
                <?php if ($edit): ?>
                    <input type="hidden" name="id" value="<?= (int)$edit['id'] ?>">
                <?php endif; ?>

                <div class="form-grid">
                    <?php foreach ($fields as $f):
                        $label = $meta['labels'][$f] ?? ucfirst(str_replace('_', ' ', $f));
                        $value = $edit[$f] ?? ($_GET[$f] ?? '');

                        $isTextArea = in_array($f, ['descripcion','direccion'], true);
                        $isDate = str_contains($f, 'fecha');
                        $isTime = str_contains($f, 'hora');

                        $fk = fk_for($table, $f);
                    ?>
                        <label>
                            <?= h($label) ?>

                            <?php if ($fk): ?>
                                <select name="<?= h($f) ?>">
                                    <option value="">-- Selecciona --</option>
                                    <?php foreach (fk_options($table, $f) as $opt): ?>
                                        <option value="<?= (int)$opt['id'] ?>" <?= ((string)$value === (string)$opt['id']) ? 'selected' : '' ?>>
                                            #<?= (int)$opt['id'] ?> · <?= h($opt['label']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="field-help">Clave foránea hacia <?= h($fk['table']) ?>.</span>

                            <?php elseif ($isTextArea): ?>
                                <textarea name="<?= h($f) ?>"><?= h($value) ?></textarea>

                            <?php elseif ($isDate): ?>
                                <input type="date" name="<?= h($f) ?>" value="<?= h($value) ?>">

                            <?php elseif ($isTime): ?>
                                <input type="time" name="<?= h($f) ?>" value="<?= h($value) ?>">

                            <?php else: ?>
                                <input name="<?= h($f) ?>" value="<?= h($value) ?>">
                            <?php endif; ?>
                        </label>
                    <?php endforeach; ?>
                </div>

                <button>Guardar</button>

                <?php if ($edit): ?>
                    <a class="button secondary" href="index.php?page=crud&table=<?= h($table) ?>">Cancelar edición</a>
                <?php endif; ?>
            </form>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <?php foreach ($fields as $f): ?>
                                <th><?= h($f) ?></th>
                            <?php endforeach; ?>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($rows as $r): ?>
                            <tr>
                                <td><?= (int)$r['id'] ?></td>

                                <?php foreach ($fields as $f): ?>
                                    <td>
                                        <?php if (fk_for($table, $f)): ?>
                                            <span class="fk-value"><?= h(fk_display($table, $f, $r[$f] ?? '')) ?></span>
                                        <?php else: ?>
                                            <?= h(mb_strimwidth((string)($r[$f] ?? ''), 0, 70, '…')) ?>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>

                                <td class="row-actions">
                                    <a href="index.php?page=crud&table=<?= h($table) ?>&edit=<?= (int)$r['id'] ?>">Editar</a>

                                    <form method="post" onsubmit="return confirm('¿Eliminar registro?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                                        <button class="danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <?php layout_end();
}

$page = $_GET['page'] ?? 'dashboard';

if ($page === 'login') {
    login_page();
    exit;
}

if ($page === 'logout') {
    logout();
    redirect('index.php?page=login');
}

$user = require_login();

if ($page === 'subject') {
    subject_page($user);
} elseif ($page === 'crud') {
    crud_page($user);
} else {
    dashboard($user);
}
