<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5" style="min-height: 60vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="custom-card">
                <div class="text-center mb-5">
                    <h3 class="font-weight-bold text-uppercase" style="letter-spacing: 2px;">Thêm Sản Phẩm (API)</h3>
                    <div style="height: 2px; width: 50px; background-color: #c89b3c; margin: 15px auto 0;"></div>
                </div>

                <form id="add-product-form">
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
                            <label class="font-weight-bold text-uppercase small text-muted">Giá bán</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label class="font-weight-bold text-uppercase small text-muted">Danh mục</label>
                            <select id="category_id" name="category_id" class="form-control custom-select" style="height: auto;" required>
                                <option value="">-- Đang tải danh mục --</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between border-top pt-4 mt-5">
                        <a href="/WebBanGiay/Product" class="btn btn-outline-dark px-4 py-2 rounded-0">Quay lại</a>
                        <button type="submit" class="btn btn-gold px-5 py-2">Lưu bằng API</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Lấy danh mục từ API
    fetch('/WebBanGiay/api/category')
        .then(response => response.json())
        .then(data => {
            const catSelect = document.getElementById('category_id');
            catSelect.innerHTML = ''; 
            data.forEach(cat => {
                const option = document.createElement('option');
                option.value = cat.id;
                option.textContent = cat.name;
                catSelect.appendChild(option);
            });
        });

    // Xử lý gửi Form bằng Fetch POST
    document.getElementById('add-product-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const jsonData = {};
        formData.forEach((value, key) => { jsonData[key] = value; });

        fetch('/WebBanGiay/api/product', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(jsonData)
        })
        .then(res => res.json())
        .then(data => {
            if (data.message === 'Product created successfully') {
                alert('Thêm thành công!');
                window.location.href = '/WebBanGiay/Product';
            } else {
                alert('Lỗi: ' + JSON.stringify(data.errors));
            }
        });
    });
});
</script>