<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'tugas_data';

$conn = new mysqli($server, $username, $password, $database);

if ( !$conn ) {
    echo '
        <script type="text/javascript">
            console.log("connection php error")
        </script>
    ';
    die();
} else {
    echo '
        <script type="text/javascript">
            console.log("successfull to connect php database")
        </script>
    ';
}


?>