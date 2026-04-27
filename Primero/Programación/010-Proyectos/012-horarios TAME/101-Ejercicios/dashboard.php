<?php
// =====================================================
// dashboard.php - CRUD genérico para todas las tablas
// + soporte FK (listados con etiquetas + selects en forms)
// + vista HORARIO semanal por curso (a=cal)
// + vista HORARIO semanal por profesor (a=profcal)
// =====================================================

session_start();

// ---------- DB CONFIG (EDIT THIS) ----------
$db_host = "localhost";
$db_user = "horariostame";
$db_pass = "Horariostame123$";
$db_name = "horariostame";
// ------------------------------------------

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function redirect($url){ header("Location: ".$url); exit; }

if(isset($_GET["logout"])){
	session_destroy();
	redirect("index.php");
}

if(!isset($_SESSION["usuario_id"])){
	redirect("index.php");
}

$mysqli = @new mysqli($db_host, $db_user, $db_pass, $db_name);
if($mysqli->connect_errno){
	die("Error de conexión a BD.");
}
$mysqli->set_charset("utf8mb4");

// ---------- helpers schema ----------
function get_tables($mysqli){
	$out = [];
	$res = $mysqli->query("SHOW TABLES");
	if($res){
		while($r = $res->fetch_row()){
			$out[] = $r[0];
		}
		$res->free();
	}
	sort($out);
	return $out;
}

function get_columns($mysqli, $table){
	$cols = [];
	$stmt = $mysqli->prepare("SHOW COLUMNS FROM `$table`");
	$stmt->execute();
	$res = $stmt->get_result();
	while($row = $res->fetch_assoc()){
		$cols[] = $row; // Field, Type, Null, Key, Default, Extra
	}
	$stmt->close();
	return $cols;
}

function get_primary_key_cols($mysqli, $table){
	$pk = [];
	$res = $mysqli->query("SHOW KEYS FROM `$table` WHERE Key_name = 'PRIMARY'");
	if($res){
		while($r = $res->fetch_assoc()){
			$pk[(int)$r["Seq_in_index"]] = $r["Column_name"];
		}
		$res->free();
	}
	ksort($pk);
	return array_values($pk);
}

function is_auto_increment($colRow){
	return isset($colRow["Extra"]) && stripos($colRow["Extra"], "auto_increment") !== false;
}

function allowed_table($table, $tables){
	return in_array($table, $tables, true);
}

function build_where_from_pk($pk_cols, $pk_values, &$types, &$params){
	$parts = [];
	$types = "";
	$params = [];

	foreach($pk_cols as $c){
		if(!array_key_exists($c, $pk_values)){
			return [false, ""];
		}
		$parts[] = "`$c` = ?";
		$types .= "s";
		$params[] = (string)$pk_values[$c];
	}
	return [true, implode(" AND ", $parts)];
}

function bind_params($stmt, $types, $params){
	$refs = [];
	$refs[] = &$types;
	foreach($params as $k => $v){
		$refs[] = &$params[$k];
	}
	call_user_func_array([$stmt, "bind_param"], $refs);
}

/**
 * FK detection:
 * returns mapping: column_name => ['ref_table'=>..., 'ref_col'=>...]
 */
function get_foreign_keys($mysqli, $db_name, $table){
	$out = [];
	$sql = "
		SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
		FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
		WHERE TABLE_SCHEMA = ?
		  AND TABLE_NAME = ?
		  AND REFERENCED_TABLE_NAME IS NOT NULL
	";
	$stmt = $mysqli->prepare($sql);
	if(!$stmt) return $out;
	$stmt->bind_param("ss", $db_name, $table);
	$stmt->execute();
	$res = $stmt->get_result();
	if($res){
		while($r = $res->fetch_assoc()){
			$out[$r["COLUMN_NAME"]] = [
				"ref_table" => $r["REFERENCED_TABLE_NAME"],
				"ref_col"   => $r["REFERENCED_COLUMN_NAME"],
			];
		}
	}
	$stmt->close();
	return $out;
}

/**
 * Heurística para "label" de tablas referenciadas.
 */
function guess_label_expr_from_columns($ref_cols){
	$names = [];
	foreach($ref_cols as $c){ $names[] = $c["Field"]; }
	$has = function($col) use ($names){ return in_array($col, $names, true); };

	if($has("apellidos") && $has("nombre")){
		return "CONCAT(`apellidos`, ', ', `nombre`)";
	}
	if($has("codigo") && $has("nombre")){
		return "CONCAT(`codigo`, ' - ', `nombre`)";
	}
	if($has("numero") && $has("nombre")){
		return "CONCAT(`numero`, ' - ', `nombre`)";
	}
	if($has("nombre")) return "`nombre`";
	if($has("titulo")) return "`titulo`";
	if($has("descripcion")) return "`descripcion`";

	foreach($ref_cols as $c){
		$type = strtolower($c["Type"]);
		if(strpos($type, "varchar") !== false || strpos($type, "text") !== false){
			return "`".$c["Field"]."`";
		}
	}
	return "''";
}

/**
 * Carga opciones (id,label) para un FK.
 */
function fetch_fk_options($mysqli, $ref_table, $ref_col){
	$ref_cols = get_columns($mysqli, $ref_table);
	$label_expr = guess_label_expr_from_columns($ref_cols);
	if(trim($label_expr) === "''" || trim($label_expr) === ""){
		$label_expr = "`$ref_col`";
	}
	$sql = "SELECT `$ref_col` AS id, $label_expr AS label FROM `$ref_table` ORDER BY label ASC LIMIT 2000";
	$res = $mysqli->query($sql);

	$out = [];
	if($res){
		while($r = $res->fetch_assoc()){
			$out[] = ["id" => (string)$r["id"], "label" => (string)$r["label"]];
		}
		$res->free();
	}
	return $out;
}

/**
 * Para listados/forms: construir contexto FK (map id=>label + options).
 */
function build_fk_context($mysqli, $db_name, $table){
	$fks = get_foreign_keys($mysqli, $db_name, $table);
	$out = [];
	foreach($fks as $col => $def){
		$opts = fetch_fk_options($mysqli, $def["ref_table"], $def["ref_col"]);
		$map = [];
		foreach($opts as $o){ $map[$o["id"]] = $o["label"]; }
		$out[$col] = [
			"ref_table" => $def["ref_table"],
			"ref_col"   => $def["ref_col"],
			"options"   => $opts,
			"map"       => $map,
		];
	}
	return $out;
}

// =====================================================
// HORARIO (a=cal / a=profcal)
// =====================================================
function current_db_name($mysqli){
	static $cached = null;
	if($cached !== null) return $cached;

	$res = $mysqli->query("SELECT DATABASE() AS db");
	if($res){
		$row = $res->fetch_assoc();
		$cached = (string)($row["db"] ?? "");
		$res->free();
	}
	return $cached ?? "";
}

function table_exists($mysqli, $table){
	$db_name = current_db_name($mysqli);
	if($db_name === "") return false;

	$sql = "SELECT 1
	        FROM INFORMATION_SCHEMA.TABLES
	        WHERE TABLE_SCHEMA = ?
	          AND TABLE_NAME = ?
	        LIMIT 1";
	$stmt = $mysqli->prepare($sql);
	if(!$stmt) return false;

	$stmt->bind_param("ss", $db_name, $table);
	$stmt->execute();
	$res = $stmt->get_result();
	$ok = ($res && $res->num_rows > 0);
	$stmt->close();
	return $ok;
}

function column_exists($mysqli, $table, $col){
	$db_name = current_db_name($mysqli);
	if($db_name === "") return false;

	$sql = "SELECT 1
	        FROM INFORMATION_SCHEMA.COLUMNS
	        WHERE TABLE_SCHEMA = ?
	          AND TABLE_NAME = ?
	          AND COLUMN_NAME = ?
	        LIMIT 1";
	$stmt = $mysqli->prepare($sql);
	if(!$stmt) return false;

	$stmt->bind_param("sss", $db_name, $table, $col);
	$stmt->execute();
	$res = $stmt->get_result();
	$ok = ($res && $res->num_rows > 0);
	$stmt->close();
	return $ok;
}

function get_courses($mysqli){
	$sql = "
		SELECT c.id,
		       c.numero,
		       c.nombre,
		       ci.codigo,
		       ci.nombre AS ciclo_nombre
		FROM cursos c
		LEFT JOIN ciclos ci ON ci.id = c.ciclo_id
		ORDER BY ci.codigo ASC, c.numero ASC, c.nombre ASC
	";
	$res = $mysqli->query($sql);
	$out = [];
	if($res){
		while($r = $res->fetch_assoc()){
			$label = trim((string)$r["codigo"])." · ".trim((string)$r["numero"])." - ".trim((string)$r["nombre"]);
			if(trim((string)$r["codigo"]) === ""){
				$label = trim((string)$r["numero"])." - ".trim((string)$r["nombre"]);
			}
			$out[] = ["id" => (int)$r["id"], "label" => $label];
		}
		$res->free();
	}
	return $out;
}

function get_days_model($mysqli){
	$hasDiaId = column_exists($mysqli, "asignaturas_slots", "dia_id");
	$hasDia   = column_exists($mysqli, "asignaturas_slots", "dia");

	if($hasDiaId && table_exists($mysqli, "dias_semana")){
		$res = $mysqli->query("SELECT id, nombre, COALESCE(orden,id) AS ord FROM dias_semana ORDER BY COALESCE(orden,id) ASC");
		$days = [];
		if($res){
			while($r = $res->fetch_assoc()){
				$days[] = ["key" => (string)$r["id"], "name" => (string)$r["nombre"], "order" => (int)$r["ord"]];
			}
			$res->free();
		}
		if(count($days) === 0){
			$days = [
				["key"=>"1","name"=>"Lunes","order"=>1],
				["key"=>"2","name"=>"Martes","order"=>2],
				["key"=>"3","name"=>"Miércoles","order"=>3],
				["key"=>"4","name"=>"Jueves","order"=>4],
				["key"=>"5","name"=>"Viernes","order"=>5],
			];
		}
		return ["mode"=>"fk", "days"=>$days];
	}

	if($hasDia){
		$days = [
			["key"=>"Lunes","name"=>"Lunes","order"=>1],
			["key"=>"Martes","name"=>"Martes","order"=>2],
			["key"=>"Miércoles","name"=>"Miércoles","order"=>3],
			["key"=>"Jueves","name"=>"Jueves","order"=>4],
			["key"=>"Viernes","name"=>"Viernes","order"=>5],
		];
		return ["mode"=>"col", "days"=>$days];
	}

	return ["mode"=>"none", "days"=>[]];
}

function get_slots($mysqli){
	$sql = "SELECT id, nombre, hora_inicio, hora_fin, tipo, orden FROM slots ORDER BY orden ASC, id ASC";
	$res = $mysqli->query($sql);
	$out = [];
	if($res){
		while($r = $res->fetch_assoc()){
			$out[] = [
				"id" => (int)$r["id"],
				"nombre" => (string)$r["nombre"],
				"hora_inicio" => (string)$r["hora_inicio"],
				"hora_fin" => (string)$r["hora_fin"],
				"tipo" => (string)$r["tipo"],
				"orden" => (int)$r["orden"],
			];
		}
		$res->free();
	}
	return $out;
}

function get_calendar_map($mysqli, $course_id, $days_model){
	$map = []; // map[slot_id][day_key] = ['asig'=>..., 'prof'=>...]
	if((int)$course_id <= 0) return $map;
	if($days_model["mode"] === "none") return $map;

	if($days_model["mode"] === "fk"){
		$sql = "
			SELECT
				s.id AS slot_id,
				CAST(asl.dia_id AS CHAR) AS day_key,
				a.nombre AS asignatura_nombre,
				GROUP_CONCAT(DISTINCT CONCAT(p.apellidos, ', ', p.nombre) ORDER BY p.apellidos SEPARATOR ' | ') AS profes
			FROM asignaturas_slots asl
			INNER JOIN asignaturas a ON a.id = asl.asignatura_id
			INNER JOIN slots s ON s.id = asl.slot_id
			LEFT JOIN profesores_asignaturas pa ON pa.asignatura_id = a.id
			LEFT JOIN profesores p ON p.id = pa.profesor_id
			WHERE a.curso_id = ?
			GROUP BY s.id, asl.dia_id, a.nombre
		";
	}else{
		$sql = "
			SELECT
				s.id AS slot_id,
				CAST(asl.dia AS CHAR) AS day_key,
				a.nombre AS asignatura_nombre,
				GROUP_CONCAT(DISTINCT CONCAT(p.apellidos, ', ', p.nombre) ORDER BY p.apellidos SEPARATOR ' | ') AS profes
			FROM asignaturas_slots asl
			INNER JOIN asignaturas a ON a.id = asl.asignatura_id
			INNER JOIN slots s ON s.id = asl.slot_id
			LEFT JOIN profesores_asignaturas pa ON pa.asignatura_id = a.id
			LEFT JOIN profesores p ON p.id = pa.profesor_id
			WHERE a.curso_id = ?
			GROUP BY s.id, asl.dia, a.nombre
		";
	}

	$stmt = $mysqli->prepare($sql);
	if(!$stmt) return $map;
	$cid = (int)$course_id;
	$stmt->bind_param("i", $cid);
	$stmt->execute();
	$res = $stmt->get_result();
	if($res){
		while($r = $res->fetch_assoc()){
			$slot_id = (int)$r["slot_id"];
			$day_key = (string)$r["day_key"];
			$asig = (string)$r["asignatura_nombre"];
			$prof = (string)($r["profes"] ?? "");
			if(!isset($map[$slot_id])) $map[$slot_id] = [];
			$map[$slot_id][$day_key] = ["asig"=>$asig, "prof"=>$prof];
		}
	}
	$stmt->close();
	return $map;
}

// ---- NUEVO: profesores + mapa horario profesor ----
function get_teachers($mysqli){
	$res = $mysqli->query("
		SELECT id,
		       CONCAT(apellidos, ', ', nombre) AS label
		FROM profesores
		ORDER BY apellidos, nombre
	");
	$out = [];
	if($res){
		while($r = $res->fetch_assoc()){
			$out[] = ["id" => (int)$r["id"], "label" => (string)$r["label"]];
		}
		$res->free();
	}
	return $out;
}

function get_teacher_calendar_map($mysqli, $profesor_id, $days_model){
	$map = []; // map[slot_id][day_key] = ['asig'=>..., 'curso'=>...]
	if((int)$profesor_id <= 0) return $map;
	if($days_model["mode"] === "none") return $map;

	if($days_model["mode"] === "fk"){
		$sql = "
			SELECT
				s.id AS slot_id,
				CAST(asl.dia_id AS CHAR) AS day_key,
				a.nombre AS asignatura,
				CONCAT(ci.codigo,' ',c.numero) AS curso
			FROM profesores_asignaturas pa
			INNER JOIN asignaturas a ON a.id = pa.asignatura_id
			INNER JOIN cursos c ON c.id = a.curso_id
			INNER JOIN ciclos ci ON ci.id = c.ciclo_id
			INNER JOIN asignaturas_slots asl ON asl.asignatura_id = a.id
			INNER JOIN slots s ON s.id = asl.slot_id
			WHERE pa.profesor_id = ?
			GROUP BY s.id, asl.dia_id, a.id
		";
	}else{
		$sql = "
			SELECT
				s.id AS slot_id,
				CAST(asl.dia AS CHAR) AS day_key,
				a.nombre AS asignatura,
				CONCAT(ci.codigo,' ',c.numero) AS curso
			FROM profesores_asignaturas pa
			INNER JOIN asignaturas a ON a.id = pa.asignatura_id
			INNER JOIN cursos c ON c.id = a.curso_id
			INNER JOIN ciclos ci ON ci.id = c.ciclo_id
			INNER JOIN asignaturas_slots asl ON asl.asignatura_id = a.id
			INNER JOIN slots s ON s.id = asl.slot_id
			WHERE pa.profesor_id = ?
			GROUP BY s.id, asl.dia, a.id
		";
	}

	$stmt = $mysqli->prepare($sql);
	if(!$stmt) return $map;

	$pid = (int)$profesor_id;
	$stmt->bind_param("i", $pid);
	$stmt->execute();
	$res = $stmt->get_result();
	if($res){
		while($r = $res->fetch_assoc()){
			$slot_id = (int)$r["slot_id"];
			$day_key = (string)$r["day_key"];
			if(!isset($map[$slot_id])) $map[$slot_id] = [];
			$map[$slot_id][$day_key] = [
				"asig"  => (string)$r["asignatura"],
				"curso" => (string)$r["curso"],
			];
		}
	}
	$stmt->close();
	return $map;
}

// ---------- routing ----------
$tables = get_tables($mysqli);
if(count($tables) === 0){
	die("No hay tablas en la base de datos.");
}

$action = $_GET["a"] ?? "list"; // list|add|edit|delete|cal|profcal

// Para el CRUD:
$table = $_GET["t"] ?? $tables[0];
if(!allowed_table($table, $tables)){
	$table = $tables[0];
}

// =====================================================
// SI a=cal => vista horario por curso
// SI a=profcal => vista horario por profesor
// =====================================================
$courses = [];
$course_id = (int)($_GET["course_id"] ?? 0);
$days_model = ["mode"=>"none","days"=>[]];
$slots = [];
$calmap = [];

$teachers = [];
$teacher_id = (int)($_GET["teacher_id"] ?? 0);
$teachermap = [];

if($action === "cal" || $action === "profcal"){
	// Requisitos mínimos
	if(!table_exists($mysqli, "cursos") || !table_exists($mysqli, "asignaturas") || !table_exists($mysqli, "slots") || !table_exists($mysqli, "asignaturas_slots")){
		die("Faltan tablas necesarias para el horario (cursos, asignaturas, slots, asignaturas_slots).");
	}

	$days_model = get_days_model($mysqli);
	$slots = get_slots($mysqli);

	if($action === "cal"){
		$courses = get_courses($mysqli);
		if($course_id === 0 && count($courses) > 0){
			$course_id = (int)$courses[0]["id"];
		}
		$calmap = get_calendar_map($mysqli, $course_id, $days_model);
	}

	if($action === "profcal"){
		if(!table_exists($mysqli, "profesores") || !table_exists($mysqli, "profesores_asignaturas")){
			die("Faltan tablas necesarias para el horario del profesor (profesores, profesores_asignaturas).");
		}
		$teachers = get_teachers($mysqli);
		if($teacher_id === 0 && count($teachers) > 0){
			$teacher_id = (int)$teachers[0]["id"];
		}
		$teachermap = get_teacher_calendar_map($mysqli, $teacher_id, $days_model);
	}
}

// =====================================================
// CRUD normal (si no es cal ni profcal)
// =====================================================
$cols = [];
$pk_cols = [];
$fkctx = [];
$msg = "";
$err = "";
$pk = $_GET["pk"] ?? [];
if(!is_array($pk)){ $pk = []; }

if($action !== "cal" && $action !== "profcal"){
	$cols = get_columns($mysqli, $table);
	$pk_cols = get_primary_key_cols($mysqli, $table);
	$fkctx = build_fk_context($mysqli, $db_name, $table);

	// ---------- handle POST for add/edit ----------
	if($_SERVER["REQUEST_METHOD"] === "POST"){
		$post_action = $_POST["_action"] ?? "";
		$post_table  = $_POST["_table"] ?? "";

		if($post_table !== $table){
			$err = "Tabla inválida.";
		}else{
			if($post_action === "add"){
				$writable = [];
				foreach($cols as $c){
					if(is_auto_increment($c)) continue;
					$writable[] = $c["Field"];
				}

				$fields = [];
				$placeholders = [];
				$types = "";
				$params = [];

				foreach($writable as $f){
					$fields[] = "`$f`";
					$placeholders[] = "?";
					$types .= "s";
					$params[] = (string)($_POST[$f] ?? "");
				}

				if(count($fields) === 0){
					$err = "No hay campos insertables.";
				}else{
					$sql = "INSERT INTO `$table` (".implode(",", $fields).") VALUES (".implode(",", $placeholders).")";
					$stmt = $mysqli->prepare($sql);
					if(!$stmt){
						$err = "Error preparando INSERT.";
					}else{
						bind_params($stmt, $types, $params);
						if($stmt->execute()){
							$msg = "Registro creado.";
							redirect("dashboard.php?t=".urlencode($table)."&a=list&msg=".urlencode($msg));
						}else{
							$err = "Error creando: ".$stmt->error;
						}
						$stmt->close();
					}
				}
			}

			if($post_action === "edit"){
				$pk_post = $_POST["pk"] ?? [];
				if(!is_array($pk_post)) $pk_post = [];

				$setParts = [];
				$types = "";
				$params = [];

				foreach($cols as $c){
					$f = $c["Field"];
					if(in_array($f, $pk_cols, true)) continue;
					$setParts[] = "`$f` = ?";
					$types .= "s";
					$params[] = (string)($_POST[$f] ?? "");
				}

				if(count($setParts) === 0){
					$err = "No hay campos editables (sin contar la PK).";
				}else{
					$wtypes = "";
					$wparams = [];
					$ok = false;
					list($ok, $where) = build_where_from_pk($pk_cols, $pk_post, $wtypes, $wparams);

					if(!$ok){
						$err = "Faltan datos de clave primaria.";
					}else{
						$sql = "UPDATE `$table` SET ".implode(", ", $setParts)." WHERE ".$where." LIMIT 1";
						$stmt = $mysqli->prepare($sql);
						if(!$stmt){
							$err = "Error preparando UPDATE.";
						}else{
							$types2 = $types.$wtypes;
							$params2 = array_merge($params, $wparams);
							bind_params($stmt, $types2, $params2);

							if($stmt->execute()){
								$msg = "Registro actualizado.";
								redirect("dashboard.php?t=".urlencode($table)."&a=list&msg=".urlencode($msg));
							}else{
								$err = "Error actualizando: ".$stmt->error;
							}
							$stmt->close();
						}
					}
				}
			}
		}
	}

	// ---------- handle delete ----------
	if($action === "delete"){
		$wtypes = "";
		$wparams = [];
		$ok = false;
		list($ok, $where) = build_where_from_pk($pk_cols, $pk, $wtypes, $wparams);

		if(!$ok){
			$err = "Faltan datos de clave primaria.";
			$action = "list";
		}else{
			$sql = "DELETE FROM `$table` WHERE ".$where." LIMIT 1";
			$stmt = $mysqli->prepare($sql);
			if($stmt){
				bind_params($stmt, $wtypes, $wparams);
				if($stmt->execute()){
					$msg = "Registro eliminado.";
					redirect("dashboard.php?t=".urlencode($table)."&a=list&msg=".urlencode($msg));
				}else{
					$err = "Error eliminando: ".$stmt->error;
				}
				$stmt->close();
			}else{
				$err = "Error preparando DELETE.";
			}
		}
	}
}

// ---------- fetch row for edit ----------
$edit_row = null;
if($action === "edit" && $action !== "cal" && $action !== "profcal"){
	$wtypes = "";
	$wparams = [];
	$ok = false;
	list($ok, $where) = build_where_from_pk($pk_cols, $pk, $wtypes, $wparams);

	if($ok){
		$sql = "SELECT * FROM `$table` WHERE ".$where." LIMIT 1";
		$stmt = $mysqli->prepare($sql);
		if($stmt){
			bind_params($stmt, $wtypes, $wparams);
			$stmt->execute();
			$res = $stmt->get_result();
			$edit_row = $res ? $res->fetch_assoc() : null;
			$stmt->close();
		}
	}
	if(!$edit_row){
		$err = "No se encontró el registro a editar.";
		$action = "list";
	}
}

// ---------- messages ----------
if(isset($_GET["msg"]) && $msg === ""){
	$msg = (string)$_GET["msg"];
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="estilo.css">
		<title>Dashboard</title>
	</head>
	<body id="bodydashboard">
		<nav>
			<div class="brand">
				<div class="brandTitle">horariostame</div>
				<div class="brandUser"><?php echo h($_SESSION["nombre_completo"] ?? $_SESSION["usuario"] ?? ""); ?></div>
				<a class="logout" href="dashboard.php?logout=1">Salir</a>
			</div>

			<div class="navSectionTitle">Vistas</div>
			<a class="<?php echo ($action === "cal" ? "active" : ""); ?>" href="dashboard.php?a=cal">Horario semanal</a>
			<a class="<?php echo ($action === "profcal" ? "active" : ""); ?>" href="dashboard.php?a=profcal">Horario profesor</a>

			<div class="navSectionTitle">Entidades</div>
			<?php foreach($tables as $t): ?>
				<a class="<?php echo ($t === $table && $action !== "cal" && $action !== "profcal" ? "active" : ""); ?>" href="dashboard.php?t=<?php echo urlencode($t); ?>&a=list">
					<?php echo h($t); ?>
				</a>
			<?php endforeach; ?>
		</nav>

		<main>
			<?php if($action === "cal"): ?>
				<header class="topbar">
					<div>
						<h1>Horario semanal</h1>
						<div class="meta">
							<?php if($days_model["mode"] === "fk"): ?>
								Modelo día: <b>dia_id</b> (FK)
							<?php elseif($days_model["mode"] === "col"): ?>
								Modelo día: <b>dia</b> (texto/ENUM)
							<?php else: ?>
								Modelo día: <b>no definido</b>
							<?php endif; ?>
						</div>
					</div>

					<div class="actions">
						<a class="btn" href="dashboard.php?a=cal">Actualizar</a>
					</div>
				</header>

				<?php if($days_model["mode"] === "none"): ?>
					<div class="msg error">
						La tabla <b>asignaturas_slots</b> no tiene <b>dia_id</b> ni <b>dia</b>.
						Añade una columna de día (recomendado: <b>dia_id</b> con FK a <b>dias_semana</b>) y recarga.
					</div>
				<?php endif; ?>

				<section class="panel">
					<form method="get" class="calControls">
						<input type="hidden" name="a" value="cal">
						<label class="calSelect">
							<span>Curso</span>
							<select name="course_id" onchange="this.form.submit()">
								<?php foreach($courses as $c): ?>
									<option value="<?php echo (int)$c["id"]; ?>" <?php echo ((int)$c["id"] === (int)$course_id ? "selected" : ""); ?>>
										<?php echo h($c["label"]); ?>
									</option>
								<?php endforeach; ?>
							</select>
							<small>Selecciona el curso para ver su semana.</small>
						</label>
						<noscript><input type="submit" value="Ver"></noscript>
					</form>

					<?php if(count($slots) === 0): ?>
						<p class="empty">No hay slots definidos.</p>
					<?php elseif($days_model["mode"] === "none"): ?>
						<p class="empty">Define el día en asignaturas_slots para poder mostrar la cuadrícula.</p>
					<?php else: ?>
						<div class="calWrap">
							<table class="calTable">
								<thead>
									<tr>
										<th class="calThSlot">Tramo</th>
										<?php foreach($days_model["days"] as $d): ?>
											<th><?php echo h($d["name"]); ?></th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach($slots as $s): ?>
										<tr>
											<td class="calSlot">
												<div class="calSlotTitle"><?php echo h($s["nombre"]); ?></div>
												<div class="calSlotTime"><?php echo h($s["hora_inicio"]); ?> - <?php echo h($s["hora_fin"]); ?></div>
												<?php if(trim($s["tipo"]) !== ""): ?>
													<div class="calSlotType"><?php echo h($s["tipo"]); ?></div>
												<?php endif; ?>
											</td>

											<?php foreach($days_model["days"] as $d): ?>
												<?php
													$dayKey = (string)$d["key"];
													$slotId = (int)$s["id"];
													$cell = $calmap[$slotId][$dayKey] ?? null;
												?>
												<td class="calCell">
													<?php if($cell): ?>
														<div class="calAsig"><?php echo h($cell["asig"]); ?></div>
														<?php if(trim($cell["prof"]) !== ""): ?>
															<div class="calProf"><?php echo h($cell["prof"]); ?></div>
														<?php endif; ?>
													<?php else: ?>
														<div class="calEmpty">—</div>
													<?php endif; ?>
												</td>
											<?php endforeach; ?>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>

						<p class="hint">
							Para editar las asignaciones, usa las tablas <b>asignaturas_slots</b>, <b>asignaturas</b> y <b>profesores_asignaturas</b>.
						</p>
					<?php endif; ?>
				</section>

			<?php elseif($action === "profcal"): ?>
				<header class="topbar">
					<div>
						<h1>Horario del profesor</h1>
						<div class="meta">
							<?php if($days_model["mode"] === "fk"): ?>
								Modelo día: <b>dia_id</b> (FK)
							<?php elseif($days_model["mode"] === "col"): ?>
								Modelo día: <b>dia</b> (texto/ENUM)
							<?php else: ?>
								Modelo día: <b>no definido</b>
							<?php endif; ?>
						</div>
					</div>
					<div class="actions">
						<a class="btn" href="dashboard.php?a=profcal">Actualizar</a>
					</div>
				</header>

				<?php if($days_model["mode"] === "none"): ?>
					<div class="msg error">
						La tabla <b>asignaturas_slots</b> no tiene <b>dia_id</b> ni <b>dia</b>.
						Añade una columna de día (recomendado: <b>dia_id</b> con FK a <b>dias_semana</b>) y recarga.
					</div>
				<?php endif; ?>

				<section class="panel">
					<form method="get" class="calControls">
						<input type="hidden" name="a" value="profcal">

						<label class="calSelect">
							<span>Profesor</span>
							<select name="teacher_id" onchange="this.form.submit()">
								<?php foreach($teachers as $t): ?>
									<option value="<?php echo (int)$t["id"]; ?>" <?php echo ((int)$t["id"] === (int)$teacher_id ? "selected" : ""); ?>>
										<?php echo h($t["label"]); ?>
									</option>
								<?php endforeach; ?>
							</select>
							<small>Selecciona el profesor para ver su semana.</small>
						</label>

						<noscript><input type="submit" value="Ver"></noscript>
					</form>

					<?php if(count($slots) === 0): ?>
						<p class="empty">No hay slots definidos.</p>
					<?php elseif($days_model["mode"] === "none"): ?>
						<p class="empty">Define el día en asignaturas_slots para poder mostrar la cuadrícula.</p>
					<?php else: ?>
						<div class="calWrap">
							<table class="calTable">
								<thead>
									<tr>
										<th class="calThSlot">Tramo</th>
										<?php foreach($days_model["days"] as $d): ?>
											<th><?php echo h($d["name"]); ?></th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach($slots as $s): ?>
										<tr>
											<td class="calSlot">
												<div class="calSlotTitle"><?php echo h($s["nombre"]); ?></div>
												<div class="calSlotTime"><?php echo h($s["hora_inicio"]); ?> - <?php echo h($s["hora_fin"]); ?></div>
												<?php if(trim($s["tipo"]) !== ""): ?>
													<div class="calSlotType"><?php echo h($s["tipo"]); ?></div>
												<?php endif; ?>
											</td>

											<?php foreach($days_model["days"] as $d): ?>
												<?php
													$dayKey = (string)$d["key"];
													$slotId = (int)$s["id"];
													$cell = $teachermap[$slotId][$dayKey] ?? null;
												?>
												<td class="calCell">
													<?php if($cell): ?>
														<div class="calAsig"><?php echo h($cell["asig"]); ?></div>
														<?php if(trim($cell["curso"]) !== ""): ?>
															<div class="calProf"><?php echo h($cell["curso"]); ?></div>
														<?php endif; ?>
													<?php else: ?>
														<div class="calEmpty">—</div>
													<?php endif; ?>
												</td>
											<?php endforeach; ?>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>

						<p class="hint">
							Se calcula a partir de <b>profesores_asignaturas</b> + <b>asignaturas_slots</b> (y el curso de cada asignatura).
						</p>
					<?php endif; ?>
				</section>

			<?php else: ?>
				<header class="topbar">
					<div>
						<h1><?php echo h($table); ?></h1>
						<div class="meta">
							PK: <?php echo h(implode(", ", $pk_cols)); ?>
						</div>
					</div>

					<div class="actions">
						<a class="btn" href="dashboard.php?t=<?php echo urlencode($table); ?>&a=list">Listado</a>
						<a class="btn primary" href="dashboard.php?t=<?php echo urlencode($table); ?>&a=add">Nuevo</a>
					</div>
				</header>

				<?php if($msg !== ""): ?>
					<div class="msg ok"><?php echo h($msg); ?></div>
				<?php endif; ?>
				<?php if($err !== ""): ?>
					<div class="msg error"><?php echo h($err); ?></div>
				<?php endif; ?>

				<?php if($action === "add"): ?>
					<section class="panel">
						<h2>Nuevo registro</h2>
						<form method="post" class="form">
							<input type="hidden" name="_action" value="add">
							<input type="hidden" name="_table" value="<?php echo h($table); ?>">

							<?php foreach($cols as $c): ?>
								<?php if(is_auto_increment($c)) continue; ?>
								<label>
									<span><?php echo h($c["Field"]); ?></span>
									<?php
										$type = strtolower($c["Type"]);
										$field = $c["Field"];
										$value = $_POST[$field] ?? ($c["Default"] ?? "");
										$isFk = isset($fkctx[$field]);
										$isRequired = ($c["Null"] === "NO");
									?>

									<?php if($isFk): ?>
										<?php $opts = $fkctx[$field]["options"]; $cur = (string)$value; ?>
										<select name="<?php echo h($field); ?>">
											<?php if(!$isRequired): ?>
												<option value="">-- (vacío) --</option>
											<?php else: ?>
												<option value="" disabled <?php echo ($cur==="" ? "selected" : ""); ?>>-- seleccionar --</option>
											<?php endif; ?>
											<?php foreach($opts as $o): ?>
												<option value="<?php echo h($o["id"]); ?>" <?php echo ($cur !== "" && $cur === (string)$o["id"] ? "selected" : ""); ?>>
													<?php echo h($o["label"]); ?>
												</option>
											<?php endforeach; ?>
										</select>
										<small>
											FK → <?php echo h($fkctx[$field]["ref_table"]); ?>.<?php echo h($fkctx[$field]["ref_col"]); ?>
											<?php echo ($isRequired ? " · requerido" : ""); ?>
										</small>

									<?php elseif(strpos($type, "text") !== false): ?>
										<textarea name="<?php echo h($field); ?>"><?php echo h($value); ?></textarea>
										<small><?php echo h($c["Type"]); ?><?php echo ($isRequired ? " · requerido" : ""); ?></small>
									<?php else: ?>
										<input type="text" name="<?php echo h($field); ?>" value="<?php echo h($value); ?>">
										<small><?php echo h($c["Type"]); ?><?php echo ($isRequired ? " · requerido" : ""); ?></small>
									<?php endif; ?>
								</label>
							<?php endforeach; ?>

							<div class="formActions">
								<input type="submit" value="Guardar">
								<a class="btn" href="dashboard.php?t=<?php echo urlencode($table); ?>&a=list">Cancelar</a>
							</div>
						</form>
					</section>
				<?php endif; ?>

				<?php if($action === "edit" && $edit_row): ?>
					<section class="panel">
						<h2>Editar registro</h2>
						<form method="post" class="form">
							<input type="hidden" name="_action" value="edit">
							<input type="hidden" name="_table" value="<?php echo h($table); ?>">

							<?php foreach($pk_cols as $pkc): ?>
								<input type="hidden" name="pk[<?php echo h($pkc); ?>]" value="<?php echo h($edit_row[$pkc]); ?>">
							<?php endforeach; ?>

							<?php foreach($cols as $c): ?>
								<?php
									$field = $c["Field"];
									$type = strtolower($c["Type"]);
									$isPk = in_array($field, $pk_cols, true);
									$value = $edit_row[$field] ?? "";
									$isFk = isset($fkctx[$field]);
									$isRequired = ($c["Null"] === "NO");
								?>
								<label>
									<span><?php echo h($field); ?><?php echo ($isPk ? " (PK)" : ""); ?></span>

									<?php if($isPk): ?>
										<input type="text" value="<?php echo h($value); ?>" disabled>
										<small><?php echo h($c["Type"]); ?></small>

									<?php elseif($isFk): ?>
										<?php $opts = $fkctx[$field]["options"]; $cur = (string)$value; ?>
										<select name="<?php echo h($field); ?>">
											<?php if(!$isRequired): ?>
												<option value="">-- (vacío) --</option>
											<?php else: ?>
												<option value="" disabled <?php echo ($cur==="" ? "selected" : ""); ?>>-- seleccionar --</option>
											<?php endif; ?>
											<?php foreach($opts as $o): ?>
												<option value="<?php echo h($o["id"]); ?>" <?php echo ($cur !== "" && $cur === (string)$o["id"] ? "selected" : ""); ?>>
													<?php echo h($o["label"]); ?>
												</option>
											<?php endforeach; ?>
										</select>
										<small>FK → <?php echo h($fkctx[$field]["ref_table"]); ?>.<?php echo h($fkctx[$field]["ref_col"]); ?></small>

									<?php else: ?>
										<?php if(strpos($type, "text") !== false): ?>
											<textarea name="<?php echo h($field); ?>"><?php echo h($value); ?></textarea>
										<?php else: ?>
											<input type="text" name="<?php echo h($field); ?>" value="<?php echo h($value); ?>">
										<?php endif; ?>
										<small><?php echo h($c["Type"]); ?></small>
									<?php endif; ?>

								</label>
							<?php endforeach; ?>

							<div class="formActions">
								<input type="submit" value="Actualizar">
								<a class="btn" href="dashboard.php?t=<?php echo urlencode($table); ?>&a=list">Cancelar</a>
							</div>
						</form>
					</section>
				<?php endif; ?>

				<?php if($action === "list"): ?>
					<section class="panel">
						<h2>Listado</h2>
						<?php
							$orderCol = $pk_cols[0] ?? null;
							$sqlList = "SELECT * FROM `$table`".($orderCol ? " ORDER BY `$orderCol` DESC" : "")." LIMIT 200";
							$res = $mysqli->query($sqlList);
							$rows = [];
							if($res){
								while($r = $res->fetch_assoc()){ $rows[] = $r; }
								$res->free();
							}
						?>

						<?php if(count($rows) === 0): ?>
							<p class="empty">No hay registros.</p>
						<?php else: ?>
							<div class="tableWrap">
								<table>
									<thead>
										<tr>
											<?php foreach($cols as $c): ?>
												<th><?php echo h($c["Field"]); ?></th>
											<?php endforeach; ?>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($rows as $r): ?>
											<tr>
												<?php foreach($cols as $c): ?>
													<?php
														$f = $c["Field"];
														$val = (string)($r[$f] ?? "");
														$isFk = isset($fkctx[$f]);
													?>
													<td>
														<?php if($isFk && $val !== ""): ?>
															<?php $label = $fkctx[$f]["map"][$val] ?? ""; ?>
															<?php if($label !== ""): ?>
																<span class="fkLabel"><?php echo h($label); ?></span>
																<span class="fkId">#<?php echo h($val); ?></span>
															<?php else: ?>
																<?php echo h($val); ?>
															<?php endif; ?>
														<?php else: ?>
															<?php echo h($val); ?>
														<?php endif; ?>
													</td>
												<?php endforeach; ?>

												<td class="tdActions">
													<?php
														$pkqs = [];
														foreach($pk_cols as $pkc){
															$pkqs[] = "pk[".rawurlencode($pkc)."]=" . rawurlencode((string)$r[$pkc]);
														}
														$pkqs = implode("&", $pkqs);
													?>
													<a class="btn" href="dashboard.php?t=<?php echo urlencode($table); ?>&a=edit&<?php echo $pkqs; ?>">Editar</a>
													<a class="btn danger" href="dashboard.php?t=<?php echo urlencode($table); ?>&a=delete&<?php echo $pkqs; ?>"
														onclick="return confirm('¿Eliminar este registro?');">Eliminar</a>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<p class="hint">Mostrando máximo 200 registros.</p>
						<?php endif; ?>
					</section>
				<?php endif; ?>
			<?php endif; ?>
		</main>
	</body>
</html>
<?php $mysqli->close(); ?>
