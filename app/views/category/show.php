<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5 mb-5" style="min-height: 50vh;">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h3 class="font-weight-bold text-uppercase">Chi Tiết Danh Mục</h3>
        <a href="/WebBanGiay/Category" class="btn btn-outline-dark">Quay lại</a>
    </div>

    <div class="card p-4" style="border: 1px solid #eee; border-radius: 8px;">
        <div class="form-group">
            <label class="font-weight-bold text-muted">ID Danh Mục</label>
            <p class="form-control bg-light"><?= $category->id ?></p>
        </div>
        <div class="form-group">
            <label class="font-weight-bold text-muted">Tên Danh Mục</label>
            <p class="form-control"><?= htmlspecialchars($category->name) ?></p>
        </div>
        
        <div class="mt-4">
            <a href="/WebBanGiay/Category/edit/<?= $category->id ?>" class="btn btn-dark">Sửa</a>
            <a href="/WebBanGiay/Category/delete/<?= $category->id ?>" class="btn btn-danger" onclick="return confirm('Xóa danh mục này?');">Xóa</a>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>