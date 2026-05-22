<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5" style="min-height: 60vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="custom-card">
                <div class="text-center mb-5">
                    <h3 class="font-weight-bold text-uppercase" style="letter-spacing: 2px;">Thêm Sản Phẩm Mới</h3>
                    <div style="height: 2px; width: 50px; background-color: #c89b3c; margin: 15px auto 0;"></div>
                </div>

                <form method="POST" action="/WebBanGiay/Product/save" enctype="multipart/form-data">
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-uppercase small text-muted">Tên giày</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-uppercase small text-muted">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            <label class="font-weight-bold text-uppercase small text-muted">Giá bán (VNĐ)</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label class="font-weight-bold text-uppercase small text-muted">Danh mục</label>
                            <select name="category_id" class="form-control custom-select" style="height: auto;" required>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-5">
                        <label class="font-weight-bold text-uppercase small text-muted d-block">Hình ảnh</label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="imageFile" required>
                            <label class="custom-file-label rounded-0" for="imageFile">Chọn tệp ảnh...</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between border-top pt-4">
                        <a href="/WebBanGiay/Product" class="btn btn-outline-dark px-4 py-2 rounded-0">Quay lại</a>
                        <button type="submit" class="btn btn-gold px-5 py-2">Lưu Sản Phẩm</button>
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
})
</script>

<?php include 'app/views/shares/footer.php'; ?>