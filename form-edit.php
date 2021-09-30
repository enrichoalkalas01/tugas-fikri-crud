<?php
    include 'connection.php';
    $sql = "UPDATE product SET title='". $_POST['title'] ."', excerpt='". $_POST['excerpt'] ."', description='". $_POST['description'] ."' WHERE id=". $_POST['id'];

    if ( $conn->query($sql) ) {
        header("Location: index.php?text=success to edit data");
        die();
    } else {
        header("Location: edit.php?id=". $_POST['id'] ."text=failed to edit data");
        die();
    }
?>