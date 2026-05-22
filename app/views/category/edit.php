<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5 mb-5" style="min-height: 50vh;">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="custom-card">
                <div class="text-center mb-5">
                    <h3 class="font-weight-bold text-uppercase" style="letter-spacing: 2px;">Sửa Danh Mục</h3>
                    <div style="height: 2px; width: 50px; background-color: #c89b3c; margin: 15px auto 0;"></div>
                </div>

                <form method="POST" action="/WebBanGiay/Category/update">
                    <input type="hidden" name="id" value="<?= $category->id ?>">
                    
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-uppercase small text-muted">Tên danh mục</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($category->name) ?>" required>
                    </div>
                    
                    <div class="form-group mb-5">
                        <label class="font-weight-bold text-uppercase small text-muted">Mô tả</label>
                        <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($category->description) ?></textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between border-top pt-4">
                        <a href="/WebBanGiay/Category" class="btn btn-outline-dark px-4 py-2">Quay lại</a>
                        <button type="submit" class="btn btn-gold px-5 py-2">Cập Nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>