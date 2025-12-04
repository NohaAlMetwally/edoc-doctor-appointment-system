<?php
// connection.php - debug-friendly, no browser output

$db_host = getenv('DB_HOST') ?: '127.0.0.1';
$db_user = getenv('DB_USER') ?: 'user';
$db_pass = getenv('DB_PASS') ?: 'password';
$db_name = getenv('DB_NAME') ?: 'edoc';
$db_port = getenv('DB_PORT') ?: 3306;

error_log("[connection.php] Attempting DB connect. host={$db_host} user={$db_user} db={$db_name} port={$db_port}");

// suppressed @ to avoid PHP notice printed to the page
$database = @new mysqli($db_host, $db_user, $db_pass, $db_name, (int)$db_port);

if ($database === null || $database->connect_errno) {
    $err = $database ? $database->connect_error : 'mysqli returned null';
    error_log("[connection.php] DB connection failed: {$err}");
    // Friendly short message for browser, but don't leak creds
    http_response_code(500);
    die('Database connection failed (check logs).');
}

$database->set_charset('utf8mb4');
?>
