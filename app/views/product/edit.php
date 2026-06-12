<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="custom-card">
                <div class="text-center mb-5">
                    <h3 class="font-weight-bold text-uppercase" style="letter-spacing: 2px;">Sửa Thông Tin (API)</h3>
                    <div style="height: 2px; width: 50px; background-color: #c89b3c; margin: 15px auto 0;"></div>
                </div>

                <form id="edit-product-form">
                    <input type="hidden" id="product_id" name="id" value="<?= $product->id ?>">
                    
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-uppercase small text-muted">Tên giày</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-uppercase small text-muted">Mô tả</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            <label class="font-weight-bold text-uppercase small text-muted">Giá</label>
                            <input type="number" id="price" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label class="font-weight-bold text-uppercase small text-muted">Danh mục</label>
                            <select id="category_id" name="category_id" class="form-control custom-select" required></select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4 border-top pt-4">
                        <a href="/WebBanGiay/Product" class="btn btn-outline-dark px-4 py-2">Quay lại</a>
                        <button type="submit" class="btn btn-gold px-5 py-2">Cập Nhật bằng API</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const productId = document.getElementById('product_id').value;

    // Lấy dữ liệu sản phẩm hiện tại
    fetch(`/WebBanGiay/api/product/${productId}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('name').value = data.name;
            document.getElementById('description').value = data.description;
            document.getElementById('price').value = data.price;
            
            // Lấy danh sách danh mục sau khi có data sản phẩm để set selected
            fetch('/WebBanGiay/api/category')
                .then(res => res.json())
                .then(cats => {
                    const catSelect = document.getElementById('category_id');
                    cats.forEach(cat => {
                        const option = document.createElement('option');
                        option.value = cat.id;
                        option.textContent = cat.name;
                        if(cat.id == data.category_id) option.selected = true;
                        catSelect.appendChild(option);
                    });
                });
        });

    // Cập nhật dữ liệu bằng PUT
    document.getElementById('edit-product-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const jsonData = {};
        formData.forEach((value, key) => { jsonData[key] = value; });

        fetch(`/WebBanGiay/api/product/${productId}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(jsonData)
        })
        .then(res => res.json())
        .then(data => {
            if (data.message === 'Product updated successfully') {
                alert('Cập nhật thành công!');
                window.location.href = '/WebBanGiay/Product';
            } else {
                alert('Lỗi cập nhật');
            }
        });
    });
});
</script>