<?php
    include 'connection.php';

    $id = (int)($_GET['id'] ?? 0);

    if ($id <= 0) {
        header("Location: index.php?text=Invalid product ID");
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM product WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        header("Location: index.php?text=success: product deleted");
    } else {
        header("Location: index.php?text=failed: product not found or could not be deleted");
    }
    exit;
?>
