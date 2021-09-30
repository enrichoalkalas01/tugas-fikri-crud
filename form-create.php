<?php
    include 'connection.php';
    $sql = " INSERT INTO product (title, excerpt, description) VALUES ('". $_POST['title'] ."', '". $_POST['excerpt'] ."', '". $_POST['description'] ."')";

    if ( $conn->query($sql) ) {
        header("Location: index.php?text=success to create data");
        die();
    } else {
        header("Location: form.php?text=failed to create data");
        die();
    }
?>