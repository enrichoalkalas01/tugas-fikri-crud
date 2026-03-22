<?php include 'headers.php' ?>

<?php include 'navbar-mini.php' ?>

<div class="page-container">

    <div class="breadcrumb-s">
        <a href="index.php">Products</a>
        <span>&#8250;</span>
        <span>Add New</span>
    </div>

    <div class="card-box">
        <div class="card-head">
            <h1>Add New Product</h1>
        </div>
        <div class="card-body">
            <div class="form-wrap">
                <form action="form-create.php" method="POST" id="createForm">
                    <div class="form-group">
                        <label for="title" class="form-label-s">Title <span style="color:var(--danger)">*</span></label>
                        <input name="title" type="text" id="title" class="form-control-s"
                               placeholder="Product title" required maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="excerpt" class="form-label-s">Excerpt <span style="color:var(--danger)">*</span></label>
                        <input name="excerpt" type="text" id="excerpt" class="form-control-s"
                               placeholder="Short description" required maxlength="255">
                        <div class="form-hint">A brief summary shown in the product list.</div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label-s">Description</label>
                        <textarea name="description" id="description" class="form-control-s"
                                  rows="4" placeholder="Full product description..."></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary-main">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            Save Product
                        </button>
                        <a href="index.php" class="btn-secondary-main">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php include 'footers.php' ?>
