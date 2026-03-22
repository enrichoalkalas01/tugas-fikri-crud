<?php
    include 'headers.php';

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) {
        header("Location: index.php?text=Invalid product ID");
        exit;
    }

    $stmt = $conn->prepare("SELECT id, title, excerpt, description FROM product WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (!$result) {
        header("Location: index.php?text=Product not found");
        exit;
    }
?>

<?php include 'navbar-mini.php' ?>

<div class="page-container">

    <div class="breadcrumb-s">
        <a href="index.php">Products</a>
        <span>&#8250;</span>
        <span>Edit Product</span>
    </div>

    <div class="card-box">
        <div class="card-head">
            <h1>Edit Product</h1>
        </div>
        <div class="card-body">
            <div class="form-wrap">
                <form action="form-edit.php" method="POST">
                    <input type="hidden" name="id" value="<?= $result['id'] ?>">
                    <div class="form-group">
                        <label for="title" class="form-label-s">Title <span style="color:var(--danger)">*</span></label>
                        <input name="title" type="text" id="title" class="form-control-s"
                               placeholder="Product title" required maxlength="255"
                               value="<?= htmlspecialchars($result['title']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="excerpt" class="form-label-s">Excerpt <span style="color:var(--danger)">*</span></label>
                        <input name="excerpt" type="text" id="excerpt" class="form-control-s"
                               placeholder="Short description" required maxlength="255"
                               value="<?= htmlspecialchars($result['excerpt']) ?>">
                        <div class="form-hint">A brief summary shown in the product list.</div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label-s">Description</label>
                        <textarea name="description" id="description" class="form-control-s" rows="4"
                                  placeholder="Full product description..."><?= htmlspecialchars($result['description']) ?></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary-main">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            Save Changes
                        </button>
                        <a href="index.php" class="btn-secondary-main">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php include 'footers.php' ?>
