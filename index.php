<?php
    include 'headers.php';
    $stmt = $conn->prepare("SELECT id, title, excerpt, description FROM product ORDER BY id ASC");
    $stmt->execute();
    $result = $stmt->get_result();
    $total  = $result->num_rows;
?>

<?php include 'navbar-mini.php' ?>

<div class="page-container">

    <div class="card-box">
        <div class="card-head">
            <h1>
                All Products
                <span class="badge-count"><?= $total ?></span>
            </h1>
            <a href="form.php" class="btn-primary-main">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Add Product
            </a>
        </div>

        <?php if ($total === 0): ?>
            <div class="empty-state">
                <div class="empty-icon">&#128230;</div>
                <h3>No products yet</h3>
                <p>Get started by adding your first product.</p>
                <a href="form.php" class="btn-primary-main">Add Product</a>
            </div>
        <?php else: ?>
            <div style="overflow-x:auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="td-no">#</th>
                            <th>Title</th>
                            <th>Excerpt</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="td-no"><?= $i++ ?></td>
                            <td class="td-title"><?= htmlspecialchars($row['title']) ?></td>
                            <td class="td-clip" title="<?= htmlspecialchars($row['excerpt']) ?>"><?= htmlspecialchars($row['excerpt']) ?></td>
                            <td class="td-clip" title="<?= htmlspecialchars($row['description']) ?>"><?= htmlspecialchars($row['description']) ?></td>
                            <td>
                                <div class="action-col">
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Edit
                                    </a>
                                    <button class="btn-delete" onclick="confirmDelete(<?= $row['id'] ?>, '<?= htmlspecialchars(addslashes($row['title'])) ?>')">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal-box">
        <div class="modal-icon-wrap">&#128465;</div>
        <h3>Delete Product?</h3>
        <p id="deleteModalText">This action cannot be undone.</p>
        <div class="modal-actions">
            <button class="btn-secondary-main" onclick="closeModal()">Cancel</button>
            <a href="#" id="deleteConfirmBtn" class="btn-danger-main">Delete</a>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, title) {
    document.getElementById('deleteModalText').textContent = 'Are you sure you want to delete "' + title + '"?';
    document.getElementById('deleteConfirmBtn').href = 'delete.php?id=' + id;
    document.getElementById('deleteModal').classList.add('open');
}
function closeModal() {
    document.getElementById('deleteModal').classList.remove('open');
}
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
});
</script>

<?php include 'footers.php' ?>
