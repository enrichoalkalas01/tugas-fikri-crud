<?php

$server   = getenv('DB_HOST')     ?: '192.168.20.4';
$username = getenv('DB_USER')     ?: 'root';
$password = getenv('DB_PASSWORD') ?: '1S4mp4i10!e@123!';
$database = getenv('DB_NAME')     ?: 'tugas_fikri_data';
$port     = (int)(getenv('DB_PORT') ?: 3308);

$conn = new mysqli($server, $username, $password, $database, $port);

if ($conn->connect_error) {
    http_response_code(503);
    die(json_encode(['error' => 'Database connection failed']));
}

$conn->set_charset('utf8mb4');

?>
