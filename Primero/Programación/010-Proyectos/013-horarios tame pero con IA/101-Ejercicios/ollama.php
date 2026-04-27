<?php
// =====================================================
// ollama.php - Generar horario con IA (Ollama) y rellenar asignaturas_slots
// Hardened: bloquea columnas inventadas (curso_id) y IDs fuera de lista.
// Log: __DIR__/log.txt
// =====================================================

session_start();

// ---------- DB CONFIG (KEEP IN SYNC WITH dashboard.php) ----------
$db_host = "localhost";
$db_user = "horariostame";
$db_pass = "Horariostame123$";
$db_name = "horariostame";
// ---------------------------------------------------------------

function redirect($url){ header("Location: ".$url); exit; }

// --- session guard ---
if(!isset($_SESSION["usuario_id"])){
	redirect("index.php");
}

// --- inputs ---
$course_id = (int)($_GET["course_id"] ?? 0);
$model     = (string)($_GET["model"] ?? "qwen2.5:3b-instruct");
$return    = (string)($_GET["return"] ?? "dashboard.php?a=cal");

function add_query_param($url, $key, $value){
	$sep = (strpos($url, "?") === false) ? "?" : "&";
	return $url.$sep.rawurlencode($key)."=".rawurlencode((string)$value);
}
function fail_back($return, $err){
	$u = add_query_param($return, "err", $err);
	redirect($u);
}
function ok_back($return, $msg){
	$u = add_query_param($return, "msg", $msg);
	redirect($u);
}

if($course_id <= 0){
	fail_back($return, "Curso inválido.");
}

// =====================================================
// LOG helpers
// =====================================================
function log_path(){
	return __DIR__ . DIRECTORY_SEPARATOR . "log.txt";
}
function log_line($msg){
	$ts = date("Y-m-d H:i:s");
	@file_put_contents(log_path(), "[".$ts."] ".$msg."\n", FILE_APPEND);
}
function log_block($title, $content, $maxChars = 25000){
	$ts = date("Y-m-d H:i:s");
	@file_put_contents(log_path(), "\n==================== ".$title." @ ".$ts." ====================\n", FILE_APPEND);
	$s = (string)$content;
	if(mb_strlen($s, "UTF-8") > $maxChars){
		$s = mb_substr($s, 0, $maxChars, "UTF-8") . "\n...[TRUNCADO a ".$maxChars." chars]...\n";
	}
	@file_put_contents(log_path(), $s."\n", FILE_APPEND);
}

// start
log_line("---- START ----");
log_line("request: course_id={$course_id} model={$model} return={$return}");
log_line("user: ".((string)($_SESSION["usuario"] ?? "")));
log_line("ip: ".((string)($_SERVER["REMOTE_ADDR"] ?? "")));
log_line("ua: ".((string)($_SERVER["HTTP_USER_AGENT"] ?? "")));

// =====================================================
// OLLAMA helpers
// =====================================================
function ollama_allowed_models(){
	return [
		"qwen2.5-coder:7b",
		"llama3.1:8b",
		"ministral-3:3b",
		"deepseek-r1:1.5b",
		"qwen2.5:3b-instruct",
	];
}

function ollama_generate($model, $prompt, $timeoutSeconds = 180){
	$url = "http://localhost:11434/api/generate";

	$payloadArr = [
		"model"  => $model,
		"prompt" => $prompt,
		"stream" => false,
	];
	$payload = json_encode($payloadArr, JSON_UNESCAPED_UNICODE);
	log_block("OLLAMA payload.json", $payload);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeoutSeconds);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

	$raw = curl_exec($ch);
	$err = curl_error($ch);
	$http = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	log_line("ollama http=".$http." curl_err=".(string)$err);
	log_block("OLLAMA raw response", (string)$raw);

	if($raw === false){
		return [false, "Error llamando a Ollama: ".$err, ""];
	}
	if($http < 200 || $http >= 300){
		return [false, "Ollama respondió HTTP ".$http, ""];
	}

	$j = json_decode($raw, true);
	if(!is_array($j)){
		return [false, "Respuesta JSON inválida de Ollama.", ""];
	}
	if(isset($j["error"]) && trim((string)$j["error"]) !== ""){
		return [false, "Ollama error: ".(string)$j["error"], ""];
	}
	$out = (string)($j["response"] ?? "");
	if(trim($out) === ""){
		return [false, "Ollama no devolvió contenido.", ""];
	}
	return [true, "", $out];
}

function extract_insert_sql_asignaturas_slots($text){
	$s = (string)$text;
	$s = preg_replace('/```sql\s*/i', "", $s);
	$s = str_replace("```", "", $s);
	$s = str_replace(["\r\n","\r"], "\n", $s);

	$pattern = '/INSERT\s+INTO\s+`?asignaturas_slots`?.*?;/is';
	if(!preg_match_all($pattern, $s, $m)){
		return [false, "No se encontró ningún INSERT INTO asignaturas_slots en la respuesta.", ""];
	}
	$parts = array_map("trim", $m[0]);
	$clean = implode("\n", $parts)."\n";
	return [true, "", $clean];
}

function validate_only_inserts_asignaturas_slots($sql){
	$s = trim(str_replace(["\r\n","\r"], "\n", (string)$sql));

	$forbidden = ["DROP ", "TRUNCATE ", "ALTER ", "CREATE ", "GRANT ", "REVOKE ", "DELETE ", "UPDATE "];
	foreach($forbidden as $f){
		if(stripos($s, $f) !== false){
			return [false, "SQL rechazado: contiene '".$f."'.", ""];
		}
	}

	$parts = array_filter(array_map("trim", explode(";", $s)), function($x){ return $x !== ""; });
	if(count($parts) === 0){
		return [false, "SQL vacío.", ""];
	}

	foreach($parts as $p){
		if(preg_match('/^\s*--/m', $p) || preg_match('/\/\*/', $p)){
			return [false, "SQL rechazado: contiene comentarios.", ""];
		}
		if(!preg_match('/^\s*INSERT\s+INTO\s+`?asignaturas_slots`?\s*/i', $p)){
			return [false, "SQL rechazado: solo se permiten INSERTs en asignaturas_slots.", ""];
		}
	}

	$clean = implode(";\n", $parts).";\n";
	return [true, "", $clean];
}

// Parse columns list from INSERT INTO asignaturas_slots (`a`,`b`,...) VALUES ...
function parse_insert_columns($sql){
	// capture first INSERT columns
	if(!preg_match('/INSERT\s+INTO\s+`?asignaturas_slots`?\s*\((.*?)\)\s*VALUES/is', $sql, $m)){
		return [false, "No se pudo leer la lista de columnas del INSERT.", []];
	}
	$rawCols = $m[1];
	$parts = array_filter(array_map("trim", explode(",", $rawCols)), fn($x)=>$x!=="");
	$cols = [];
	foreach($parts as $p){
		$p = trim($p);
		$p = trim($p, "` \t\n\r\0\x0B");
		$cols[] = $p;
	}
	return [true, "", $cols];
}

// Extract all tuples ( ... ), ( ... ), ... from VALUES part (simple but enough for integers)
function parse_values_tuples($sql){
	// take substring after VALUES
	$pos = stripos($sql, "VALUES");
	if($pos === false) return [false, "No se encontró VALUES.", []];
	$after = substr($sql, $pos + 6);

	// find all (...) groups
	if(!preg_match_all('/\(([^()]*)\)/', $after, $m)){
		return [false, "No se encontraron tuplas ( ... ).", []];
	}

	$tuples = [];
	foreach($m[1] as $inside){
		$vals = array_map("trim", explode(",", $inside));
		$tuples[] = $vals;
	}
	return [true, "", $tuples];
}

function strict_validate_columns_and_ids($cleanSql, $days_mode, $allowedAsignaturaIds, $allowedSlotIds, $allowedDayKeys){
	// columns
	list($ok, $err, $cols) = parse_insert_columns($cleanSql);
	if(!$ok) return [false, $err];

	$expected = ($days_mode === "fk")
		? ["asignatura_id","slot_id","dia_id"]
		: ["asignatura_id","slot_id","dia"];

	// exact match (same set and same order)
	if($cols !== $expected){
		return [false, "Columnas inválidas. Esperadas: (".implode(", ", $expected)."). Recibidas: (".implode(", ", $cols).")."];
	}

	// tuples
	list($ok2, $err2, $tuples) = parse_values_tuples($cleanSql);
	if(!$ok2) return [false, $err2];

	// validate each tuple length and values
	foreach($tuples as $i => $vals){
		if(count($vals) !== 3){
			return [false, "Tupla #".($i+1)." inválida: se esperaban 3 valores y hay ".count($vals)."."];
		}
		$a = trim($vals[0], " \t\n\r\0\x0B`'");
		$s = trim($vals[1], " \t\n\r\0\x0B`'");
		$d = trim($vals[2], " \t\n\r\0\x0B`'");

		if(!ctype_digit((string)$a)) return [false, "Tupla #".($i+1).": asignatura_id no es entero (".$vals[0].")."];
		if(!ctype_digit((string)$s)) return [false, "Tupla #".($i+1).": slot_id no es entero (".$vals[1].")."];

		if($days_mode === "fk"){
			if(!ctype_digit((string)$d)) return [false, "Tupla #".($i+1).": dia_id no es entero (".$vals[2].")."];
		}else{
			// days_mode=col: allow exact strings from allowedDayKeys
			// here we expect day strings, but your current mode is fk; left for completeness
		}

		$ai = (int)$a;
		$si = (int)$s;

		if(!isset($allowedAsignaturaIds[$ai])){
			return [false, "Tupla #".($i+1).": asignatura_id fuera de lista: ".$ai];
		}
		if(!isset($allowedSlotIds[$si])){
			return [false, "Tupla #".($i+1).": slot_id fuera de lista: ".$si];
		}

		if($days_mode === "fk"){
			$di = (int)$d;
			if(!isset($allowedDayKeys[$di])){
				return [false, "Tupla #".($i+1).": dia_id fuera de lista: ".$di];
			}
		}else{
			if(!isset($allowedDayKeys[$d])){
				return [false, "Tupla #".($i+1).": dia fuera de lista: ".$d];
			}
		}
	}

	return [true, ""];
}

// =====================================================
// DB helpers
// =====================================================
$mysqli = @new mysqli($db_host, $db_user, $db_pass, $db_name);
if($mysqli->connect_errno){
	log_line("DB connect error: ".$mysqli->connect_error);
	fail_back($return, "Error de conexión a BD.");
}
$mysqli->set_charset("utf8mb4");
log_line("DB connected OK. server_info=".$mysqli->server_info);

function table_exists($mysqli, $db_name, $table){
	$sql = "SELECT 1 FROM INFORMATION_SCHEMA.TABLES
	        WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? LIMIT 1";
	$stmt = $mysqli->prepare($sql);
	if(!$stmt) return false;
	$stmt->bind_param("ss", $db_name, $table);
	$stmt->execute();
	$res = $stmt->get_result();
	$ok = ($res && $res->num_rows > 0);
	$stmt->close();
	return $ok;
}

function get_days_model($mysqli, $db_name){
	$hasDiaId = false;
	$hasDia   = false;

	$res = $mysqli->query("SHOW COLUMNS FROM `asignaturas_slots`");
	if($res){
		while($r = $res->fetch_assoc()){
			if(($r["Field"] ?? "") === "dia_id") $hasDiaId = true;
			if(($r["Field"] ?? "") === "dia") $hasDia = true;
		}
		$res->free();
	}

	if($hasDiaId && table_exists($mysqli, $db_name, "dias_semana")){
		$res = $mysqli->query("SELECT id, nombre, COALESCE(orden,id) AS ord
		                       FROM dias_semana
		                       ORDER BY COALESCE(orden,id) ASC");
		$days = [];
		if($res){
			while($r = $res->fetch_assoc()){
				$days[] = ["key" => (string)$r["id"], "name" => (string)$r["nombre"], "order" => (int)$r["ord"]];
			}
			$res->free();
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

	return ["mode"=>"none","days"=>[]];
}

function get_slots_clase($mysqli){
	$res = $mysqli->query("SELECT id, nombre, hora_inicio, hora_fin, tipo, orden
	                       FROM slots
	                       WHERE tipo = 'clase'
	                       ORDER BY orden ASC, id ASC");
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

function get_asignaturas_by_course($mysqli, $course_id){
	$stmt = $mysqli->prepare("SELECT id, nombre, hs, orden FROM asignaturas WHERE curso_id = ? ORDER BY orden ASC, id ASC");
	$stmt->bind_param("i", $course_id);
	$stmt->execute();
	$res = $stmt->get_result();
	$out = [];
	if($res){
		while($r = $res->fetch_assoc()){
			$out[] = [
				"id" => (int)$r["id"],
				"nombre" => (string)$r["nombre"],
				"hs" => (int)$r["hs"],
				"orden" => (int)$r["orden"],
			];
		}
	}
	$stmt->close();
	return $out;
}

// =====================================================
// Main logic
// =====================================================
$required = ["asignaturas", "slots", "asignaturas_slots"];
foreach($required as $t){
	if(!table_exists($mysqli, $db_name, $t)){
		log_line("Missing table: ".$t);
		$mysqli->close();
		fail_back($return, "Falta la tabla requerida: ".$t);
	}
}

$days_model = get_days_model($mysqli, $db_name);
log_block("days_model", json_encode($days_model, JSON_UNESCAPED_UNICODE));
if($days_model["mode"] === "none"){
	$mysqli->close();
	fail_back($return, "La tabla asignaturas_slots no tiene dia_id ni dia.");
}

$slots = get_slots_clase($mysqli);
log_block("slots_clase", json_encode($slots, JSON_UNESCAPED_UNICODE));
if(count($slots) === 0){
	$mysqli->close();
	fail_back($return, "No hay slots de tipo 'clase'.");
}

$asigs = get_asignaturas_by_course($mysqli, $course_id);
log_block("asignaturas", json_encode($asigs, JSON_UNESCAPED_UNICODE));
if(count($asigs) === 0){
	$mysqli->close();
	fail_back($return, "No hay asignaturas para este curso.");
}

$need = 0;
foreach($asigs as $a){
	$need += max(0, (int)$a["hs"]);
}
if($need <= 0){
	$mysqli->close();
	fail_back($return, "Las asignaturas no tienen horas semanales (hs) válidas.");
}

$cap = count($slots) * count($days_model["days"]);
if($need > $cap){
	$mysqli->close();
	fail_back($return, "No caben las horas: se necesitan ".$need." huecos y hay ".$cap." (slots_clase × días).");
}

// Validate model
$allowedModels = ollama_allowed_models();
if(!in_array($model, $allowedModels, true)){
	log_line("model not allowed: ".$model." -> fallback");
	$model = "qwen2.5:3b-instruct";
}

// allowed id sets for strict validation
$allowedAsignaturaIds = [];
foreach($asigs as $a) $allowedAsignaturaIds[(int)$a["id"]] = true;

$allowedSlotIds = [];
foreach($slots as $s) $allowedSlotIds[(int)$s["id"]] = true;

$allowedDayKeys = [];
foreach($days_model["days"] as $d){
	if($days_model["mode"] === "fk"){
		$allowedDayKeys[(int)$d["key"]] = true;
	}else{
		$allowedDayKeys[(string)$d["key"]] = true;
	}
}

// Build prompt
$data = [
	"curso_id"    => $course_id,
	"days_mode"   => $days_model["mode"],
	"dias"        => array_map(function($d) use($days_model){
		return [
			"id" => ($days_model["mode"] === "fk" ? (int)$d["key"] : (string)$d["key"]),
			"nombre" => (string)$d["name"],
			"orden" => (int)$d["order"],
		];
	}, $days_model["days"]),
	"slots_clase" => array_map(function($s){
		return [
			"id" => (int)$s["id"],
			"nombre" => (string)$s["nombre"],
			"hora_inicio" => (string)$s["hora_inicio"],
			"hora_fin" => (string)$s["hora_fin"],
			"orden" => (int)$s["orden"],
		];
	}, $slots),
	"asignaturas" => $asigs,
];

$expectedColsText = ($days_model["mode"] === "fk")
	? "(asignatura_id, slot_id, dia_id)"
	: "(asignatura_id, slot_id, dia)";

$prompt =
"Genera SQL para MySQL 8.\n"
."Devuelve EXCLUSIVAMENTE SQL ejecutable (sin explicaciones, sin markdown).\n\n"
."IMPORTANTE: la tabla `asignaturas_slots` NO tiene columna `curso_id`.\n"
."Por tanto, NO escribas `curso_id` en ninguna parte del INSERT.\n\n"
."Objetivo: llenar tabla `asignaturas_slots` para el curso_id dado (implícito por asignatura_id).\n"
."Usa EXACTAMENTE estas columnas: ".$expectedColsText."\n\n"
."REGLAS OBLIGATORIAS:\n"
."1) SOLO un INSERT INTO `asignaturas_slots` con VALUES multi-row.\n"
."2) Columnas EXACTAS (mismo orden): ".$expectedColsText."\n"
."3) Asignar exactamente ".$need." filas en total.\n"
."4) Cada asignatura aparece exactamente hs veces.\n"
."5) No repetir una celda (slot_id,dia): 1 asignatura por celda.\n"
."6) Usa SOLO IDs proporcionados en el JSON (slots_clase.id y dias.id).\n"
."7) No inventes IDs.\n\n"
."Datos (JSON):\n"
.json_encode($data, JSON_UNESCAPED_UNICODE);

log_block("PROMPT", $prompt);

// Call Ollama
list($ok, $ollErr, $resp) = ollama_generate($model, $prompt, 180);
if(!$ok){
	log_line("Ollama failed: ".$ollErr);
	$mysqli->close();
	fail_back($return, $ollErr);
}
log_block("OLLAMA response (parsed)", $resp);

// Extract + validate base safety
list($eok, $eerr, $extractedSql) = extract_insert_sql_asignaturas_slots($resp);
if(!$eok){
	log_line("Extract failed: ".$eerr);
	$mysqli->close();
	fail_back($return, $eerr);
}
log_block("EXTRACTED SQL", $extractedSql);

list($vok, $verr, $cleanSql) = validate_only_inserts_asignaturas_slots($extractedSql);
if(!$vok){
	log_line("Validate failed: ".$verr);
	$mysqli->close();
	fail_back($return, $verr);
}
log_block("CLEAN SQL", $cleanSql);

// Strict validation: columns + ids
list($sok, $serr) = strict_validate_columns_and_ids(
	$cleanSql,
	$days_model["mode"],
	$allowedAsignaturaIds,
	$allowedSlotIds,
	$allowedDayKeys
);
if(!$sok){
	log_line("Strict validation failed: ".$serr);
	$mysqli->close();
	fail_back($return, "SQL IA inválido: ".$serr." (ver log.txt)");
}
log_line("Strict validation OK");

// Execute transaction
$mysqli->begin_transaction();
try{
	log_line("TX begin");

	$delSql = "
		DELETE asl
		FROM asignaturas_slots asl
		INNER JOIN asignaturas a ON a.id = asl.asignatura_id
		WHERE a.curso_id = ?
	";
	log_block("DELETE SQL (prepared)", $delSql);

	$del = $mysqli->prepare($delSql);
	if(!$del){
		throw new Exception("Error preparando DELETE: ".$mysqli->error);
	}
	$del->bind_param("i", $course_id);
	if(!$del->execute()){
		throw new Exception("Error borrando horario anterior: ".$del->error);
	}
	log_line("DELETE ok, affected_rows=".$del->affected_rows);
	$del->close();

	log_line("Running multi_query INSERT...");
	if(!$mysqli->multi_query($cleanSql)){
		throw new Exception("Error ejecutando INSERT IA: ".$mysqli->error);
	}

	do{
		$err = $mysqli->error;
		if($err){
			log_line("multi_query step error: ".$err);
		}
		$res = $mysqli->store_result();
		if($res instanceof mysqli_result){
			log_line("multi_query result set rows=".$res->num_rows);
			$res->free();
		}
	}while($mysqli->more_results() && $mysqli->next_result());

	if($mysqli->error){
		throw new Exception("Error tras multi_query: ".$mysqli->error);
	}

	$mysqli->commit();
	log_line("TX commit OK");
	$mysqli->close();

	log_line("---- END OK ----");
	ok_back($return, "Horario generado con IA (".$model.").");

}catch(Exception $e){
	log_line("EXCEPTION: ".$e->getMessage());
	log_line("TX rollback");
	$mysqli->rollback();
	$mysqli->close();

	log_line("---- END FAIL ----");
	fail_back($return, $e->getMessage()." (ver log.txt)");
}
