<?php
    include 'connection.php';

    $id          = (int)($_POST['id']          ?? 0);
    $title       = trim($_POST['title']        ?? '');
    $excerpt     = trim($_POST['excerpt']      ?? '');
    $description = trim($_POST['description']  ?? '');

    if ($id <= 0 || $title === '' || $excerpt === '') {
        header("Location: index.php?text=Invalid form data");
        exit;
    }

    $stmt = $conn->prepare("UPDATE product SET title=?, excerpt=?, description=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $excerpt, $description, $id);

    if ($stmt->execute()) {
        header("Location: index.php?text=success: product updated");
    } else {
        header("Location: edit.php?id=" . $id . "&text=failed: could not update product");
    }
    exit;
?>
