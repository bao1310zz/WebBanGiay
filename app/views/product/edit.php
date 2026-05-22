<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="custom-card">
                <div class="text-center mb-5">
                    <h3 class="font-weight-bold text-uppercase" style="letter-spacing: 2px;">Sửa Thông Tin Giày</h3>
                    <div style="height: 2px; width: 50px; background-color: #c89b3c; margin: 15px auto 0;"></div>
                </div>

                <form method="POST" action="/WebBanGiay/Product/update" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $product->id ?>">
                    
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-uppercase small text-muted">Tên giày</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product->name) ?>" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-uppercase small text-muted">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($product->description) ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            <label class="font-weight-bold text-uppercase small text-muted">Giá bán (VNĐ)</label>
                            <input type="number" name="price" class="form-control" value="<?= $product->price ?>" required>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label class="font-weight-bold text-uppercase small text-muted">Danh mục</label>
                            <select name="category_id" class="form-control custom-select" required>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat->id ?>" <?= $cat->id == $product->category_id ? 'selected' : '' ?>><?= $cat->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-5">
                        <label class="font-weight-bold text-uppercase small text-muted d-block">Hình ảnh hiện tại</label>
                        <?php if (!empty($product->image)): ?>
                            <div class="mb-3 p-3 text-center" style="background: #f9f9f9; border: 1px solid #eee;">
                                <img src="/WebBanGiay/public/uploads/<?= htmlspecialchars($product->image) ?>" style="height: 150px; object-fit: contain;">
                            </div>
                        <?php endif; ?>
                        
                        <label class="font-weight-bold text-uppercase small text-muted d-block mt-3">Chọn ảnh mới (nếu muốn thay đổi)</label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="imageFile">
                            <label class="custom-file-label rounded-0" for="imageFile">Chọn tệp ảnh...</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4 border-top pt-4">
                        <a href="/WebBanGiay/Product" class="btn btn-outline-dark px-4 py-2">Quay lại</a>
                        <button type="submit" class="btn btn-gold px-5 py-2">Cập Nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('.custom-file-input').addEventListener('change',function(e){
  var fileName = document.getElementById("imageFile").files[0].name;
  var nextSibling = e.target.nextElementSibling;
  nextSibling.innerText = fileName;
});
</script>

<?php include 'app/views/shares/footer.php'; ?>