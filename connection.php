<?php

$server = '127.0.0.1';  // atau 'localhost'
$username = 'root';
$password = '';
$database = 'tugas_data';
$port = 3306;

$conn = new mysqli($server, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// HAPUS semua echo atau <script> di sini!
// Jangan ada output apapun!

?>