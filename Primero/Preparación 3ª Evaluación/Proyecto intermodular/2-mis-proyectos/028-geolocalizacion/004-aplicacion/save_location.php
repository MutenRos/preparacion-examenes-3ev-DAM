<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/db.php';

$input = json_decode(file_get_contents('php://input'), true);

$name = trim((string)($input['name'] ?? ''));
$latitude = $input['latitude'] ?? null;
$longitude = $input['longitude'] ?? null;

if ($name === '' || !is_numeric($latitude) || !is_numeric($longitude)) {
    http_response_code(400);
    echo json_encode([
        'ok' => false,
        'error' => 'Datos inválidos'
    ]);
    exit;
}

$latitude = (float)$latitude;
$longitude = (float)$longitude;
$updatedAt = date('Y-m-d H:i:s');

try {
    $stmt = $db->prepare('
        INSERT INTO locations (name, latitude, longitude, updated_at)
        VALUES (:name, :latitude, :longitude, :updated_at)
        ON CONFLICT(name) DO UPDATE SET
            latitude = excluded.latitude,
            longitude = excluded.longitude,
            updated_at = excluded.updated_at
    ');

    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':latitude', $latitude, SQLITE3_FLOAT);
    $stmt->bindValue(':longitude', $longitude, SQLITE3_FLOAT);
    $stmt->bindValue(':updated_at', $updatedAt, SQLITE3_TEXT);

    $result = $stmt->execute();

    if (!$result) {
        throw new Exception('No se pudo guardar la ubicación');
    }

    echo json_encode([
        'ok' => true,
        'message' => 'Ubicación guardada'
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'ok' => false,
        'error' => $e->getMessage()
    ]);
}
?>
