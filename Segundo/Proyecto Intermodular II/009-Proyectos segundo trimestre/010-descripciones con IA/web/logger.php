<?php
// Database configuration
$dbFile = 'jocarsa.db';
$dbTable = 'access_logs';

// Create or open the SQLite database
$db = new SQLite3($dbFile);

// Create the table if it doesn't exist
$db->exec("
    CREATE TABLE IF NOT EXISTS $dbTable (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        epoch INTEGER NOT NULL,
        datetime TEXT NOT NULL,
        ip TEXT NOT NULL,
        user_agent TEXT,
        browser TEXT,
        os TEXT,
        device TEXT,
        language TEXT,
        referer TEXT,
        request_uri TEXT,
        http_method TEXT,
        query_string TEXT,
        cookies TEXT,
        is_mobile INTEGER,
        is_bot INTEGER
    )
");

// Function to detect browser, OS, and device
function getBrowserInfo($userAgent) {
    $browser = 'Unknown';
    $os = 'Unknown';
    $device = 'Unknown';

    // Detect browser
    if (strpos($userAgent, 'Firefox') !== false) {
        $browser = 'Firefox';
    } elseif (strpos($userAgent, 'Chrome') !== false) {
        $browser = 'Chrome';
    } elseif (strpos($userAgent, 'Safari') !== false) {
        $browser = 'Safari';
    } elseif (strpos($userAgent, 'Edge') !== false) {
        $browser = 'Edge';
    } elseif (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident') !== false) {
        $browser = 'Internet Explorer';
    }

    // Detect OS
    if (strpos($userAgent, 'Windows') !== false) {
        $os = 'Windows';
    } elseif (strpos($userAgent, 'Macintosh') !== false) {
        $os = 'Mac OS';
    } elseif (strpos($userAgent, 'Linux') !== false) {
        $os = 'Linux';
    } elseif (strpos($userAgent, 'Android') !== false) {
        $os = 'Android';
    } elseif (strpos($userAgent, 'iOS') !== false) {
        $os = 'iOS';
    }

    // Detect device type
    if (preg_match('/Mobile|Android|iPhone|iPad|iPod/i', $userAgent)) {
        $device = 'Mobile';
    } elseif (preg_match('/Tablet|iPad/i', $userAgent)) {
        $device = 'Tablet';
    } else {
        $device = 'Desktop';
    }

    return [$browser, $os, $device];
}

// Function to check if the user agent is a bot
function isBot($userAgent) {
    $botKeywords = [
        'bot', 'crawl', 'spider', 'slurp', 'googlebot', 'bingbot', 'yandex', 'duckduckbot'
    ];
    foreach ($botKeywords as $keyword) {
        if (stripos($userAgent, $keyword) !== false) {
            return true;
        }
    }
    return false;
}

// Get all possible information
$epoch = time();
$datetime = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Direct';
$requestUri = $_SERVER['REQUEST_URI'];
$httpMethod = $_SERVER['REQUEST_METHOD'];
$queryString = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
$cookies = json_encode($_COOKIE);
$language = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5) : 'Unknown';

// Detect browser, OS, and device
[$browser, $os, $device] = getBrowserInfo($userAgent);
$isMobile = ($device === 'Mobile' || $device === 'Tablet') ? 1 : 0;
$isBot = isBot($userAgent) ? 1 : 0;

// Prepare and execute the SQL query
$stmt = $db->prepare("
    INSERT INTO $dbTable (
        epoch, datetime, ip, user_agent, browser, os, device, language,
        referer, request_uri, http_method, query_string, cookies, is_mobile, is_bot
    )
    VALUES (
        :epoch, :datetime, :ip, :user_agent, :browser, :os, :device, :language,
        :referer, :request_uri, :http_method, :query_string, :cookies, :is_mobile, :is_bot
    )
");

$stmt->bindValue(':epoch', $epoch, SQLITE3_INTEGER);
$stmt->bindValue(':datetime', $datetime, SQLITE3_TEXT);
$stmt->bindValue(':ip', $ip, SQLITE3_TEXT);
$stmt->bindValue(':user_agent', $userAgent, SQLITE3_TEXT);
$stmt->bindValue(':browser', $browser, SQLITE3_TEXT);
$stmt->bindValue(':os', $os, SQLITE3_TEXT);
$stmt->bindValue(':device', $device, SQLITE3_TEXT);
$stmt->bindValue(':language', $language, SQLITE3_TEXT);
$stmt->bindValue(':referer', $referer, SQLITE3_TEXT);
$stmt->bindValue(':request_uri', $requestUri, SQLITE3_TEXT);
$stmt->bindValue(':http_method', $httpMethod, SQLITE3_TEXT);
$stmt->bindValue(':query_string', $queryString, SQLITE3_TEXT);
$stmt->bindValue(':cookies', $cookies, SQLITE3_TEXT);
$stmt->bindValue(':is_mobile', $isMobile, SQLITE3_INTEGER);
$stmt->bindValue(':is_bot', $isBot, SQLITE3_INTEGER);

$stmt->execute();

// Close the database connection
$db->close();
?>

