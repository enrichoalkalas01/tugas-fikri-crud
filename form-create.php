<?php
    include 'connection.php';

    $title       = trim($_POST['title']       ?? '');
    $excerpt     = trim($_POST['excerpt']     ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title === '' || $excerpt === '') {
        header("Location: form.php?text=Title and excerpt are required");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO product (title, excerpt, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $excerpt, $description);

    if ($stmt->execute()) {
        header("Location: index.php?text=success: product created");
    } else {
        header("Location: form.php?text=failed: could not create product");
    }
    exit;
?>
