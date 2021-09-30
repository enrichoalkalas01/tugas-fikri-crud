<?php
    include 'connection.php';

    $sql = "DELETE FROM product WHERE id=" . $_GET['id'];
    if ( $conn->query($sql) ) {
        header("Location: index.php?text=success to delete data");
        die();
    } else {
        header("Location: index.php?text=failed to delete data");
        die();
    }
?>