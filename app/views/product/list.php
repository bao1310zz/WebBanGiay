<?php include 'app/views/shares/header.php'; ?>

<style>
    .product-card-hover { transition: all 0.3s ease; border-radius: 8px; overflow: hidden; border: 1px solid #cccccc !important; background-color: #fff; }
    .product-card-hover:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12) !important; border-color: #111 !important; }
    .desc-clamp { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
</style>

<div class="container my-5" style="min-height: 60vh;">
    <div class="d-flex justify-content-between align-items-end mb-5 border-bottom pb-3">
        <div>
            <h3 class="font-weight-bold text-uppercase" style="letter-spacing: 1px; margin:0;">Quản Lý Sản Phẩm (API)</h3>
            <div style="height: 3px; width: 60px; background-color: #c89b3c; margin-top: 10px;"></div>
        </div>
        <?php if (SessionHelper::isAdmin()): ?>
            <a href="/WebBanGiay/Product/add" class="btn btn-gold rounded" style="border-radius: 6px !important; background: #c89b3c; color: #111; font-weight: bold;">
                <i class="fas fa-plus mr-1"></i> Thêm Sản Phẩm
            </a>
        <?php endif; ?>
    </div>

    <div class="row" id="product-list-container">
        <div class="col-12 text-center py-5" id="loading-spinner">
            <i class="fas fa-spinner fa-spin fa-3x text-muted mb-3"></i>
            <h5 class="text-muted text-uppercase">Đang tải dữ liệu...</h5>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Móc cái thẻ Token từ trong bộ nhớ trình duyệt ra
    const token = localStorage.getItem('jwtToken');

    // 2. Nếu không có thẻ Token, báo lỗi và đuổi về trang Đăng nhập
    if (!token) {
        alert('Phiên làm việc đã hết hạn hoặc bạn chưa đăng nhập. Vui lòng đăng nhập lại!');
        location.href = '/WebBanGiay/Account/login'; 
        return; // Dừng chạy code bên dưới
    }

    // 3. Nếu có thẻ, gọi API lấy danh sách và KÈM THẺ VÀO HEADER
    fetch('/WebBanGiay/api/product', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token // ĐÂY LÀ CHÌA KHÓA BẢO MẬT
        }
    })
    .then(response => {
        // Kiểm tra xem Token có bị sai hoặc hết hạn không (API trả về 401)
        if (response.status === 401) {
            alert('Mã bảo mật (Token) không hợp lệ. Vui lòng đăng nhập lại!');
            localStorage.removeItem('jwtToken'); // Xóa thẻ lỗi đi
            location.href = '/WebBanGiay/Account/login';
            throw new Error("Unauthorized"); 
        }
        return response.json();
    })
    .then(data => {
        const container = document.getElementById('product-list-container');
        container.innerHTML = ''; // Xóa chữ loading

        if (data.length === 0 || data.message) {
            container.innerHTML = `<div class="col-12 text-center py-5"><i class="fas fa-box-open fa-3x text-muted mb-3"></i><h5 class="text-muted text-uppercase">Kho giày đang trống</h5></div>`;
            return;
        }

        // Lấy quyền Admin từ PHP gán vào biến JS để hiển thị nút Sửa/Xóa
        const isAdmin = <?= SessionHelper::isAdmin() ? 'true' : 'false' ?>;

        data.forEach(product => {
            // Tạo thẻ Div cho mỗi sản phẩm giống y hệt HTML cũ
            const col = document.createElement('div');
            col.className = 'col-lg-3 col-md-4 col-sm-6 mb-5';
            
            let imageSrc = product.image ? `/WebBanGiay/public/uploads/${product.image}` : `https://via.placeholder.com/300x300?text=NO+IMAGE`;
            let priceFormatted = new Intl.NumberFormat('vi-VN').format(product.price);
            let catName = product.category_name ? product.category_name : 'GIÀY DA';

            let htmlContent = `
                <div class="card h-100 product-card-hover">
                    <div class="position-relative" style="background-color: #f8f9fa; padding: 20px; border-bottom: 1px solid #eee;">
                        <img src="${imageSrc}" class="card-img-top" style="height: 220px; object-fit: cover; border-radius: 4px;">
                    </div>
                    <div class="card-body text-left p-4">
                        <div class="mb-2"><span class="small font-weight-bold" style="color: #c89b3c; letter-spacing: 1px; text-transform: uppercase;">${catName}</span></div>
                        <h5 class="card-title font-weight-bold text-uppercase mb-2" style="color: #111; font-size: 1.1rem; line-height: 1.4;">${product.name}</h5>
                        <p class="text-muted small mb-3 desc-clamp">${product.description}</p>
                        <h4 class="font-weight-bold mb-0" style="color: #111;">${priceFormatted} <span style="font-size: 0.9rem; text-decoration: underline;">đ</span></h4>
                    </div>
                    <div class="card-footer bg-white p-3" style="border-top: 1px solid #eee;">
                        <form action="/WebBanGiay/Product/addToCart/${product.id}" method="POST" class="ajax-cart-form">
                            <input type="hidden" name="is_ajax" value="1">
                            <div class="input-group mb-2" style="width: 120px; margin: 0 auto;">
                                <div class="input-group-prepend"><button class="btn btn-outline-secondary" type="button" onclick="this.parentNode.parentNode.querySelector('input[type=number]').stepDown()">-</button></div>
                                <input type="number" name="quantity" class="form-control text-center" value="1" min="1" max="99">
                                <div class="input-group-append"><button class="btn btn-outline-secondary" type="button" onclick="this.parentNode.parentNode.querySelector('input[type=number]').stepUp()">+</button></div>
                            </div>
                            <button type="submit" class="btn btn-block py-2 font-weight-bold" style="background: #c89b3c; color: #111; border-radius: 4px;"><i class="fas fa-cart-plus mr-2"></i> THÊM VÀO GIỎ</button>
                        </form>
            `;

            if (isAdmin) {
                htmlContent += `
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <a href="/WebBanGiay/Product/show/${product.id}" class="btn btn-outline-dark btn-sm flex-grow-1 mr-1 py-1" style="font-weight: 600; border-radius: 4px;"><i class="fas fa-eye"></i> XEM</a>
                        <a href="/WebBanGiay/Product/edit/${product.id}" class="btn btn-dark btn-sm flex-grow-1 mx-1 py-1" style="font-weight: 600; border-radius: 4px;"><i class="fas fa-edit"></i> SỬA</a>
                        <button class="btn btn-outline-danger btn-sm ml-1 py-1 px-2" style="border-radius: 4px;" onclick="deleteProduct(${product.id})"><i class="fas fa-trash-alt"></i></button>
                    </div>
                `;
            } else {
                htmlContent += `
                    <a href="/WebBanGiay/Product/show/${product.id}" class="btn btn-outline-dark btn-block btn-sm py-2 mt-2" style="font-weight: 600; border-radius: 4px; letter-spacing: 1px;"><i class="fas fa-eye mr-1"></i> XEM CHI TIẾT</a>
                `;
            }

            htmlContent += `</div></div>`;
            col.innerHTML = htmlContent;
            container.appendChild(col);
        });
    })
    .catch(error => console.error("Lỗi lấy dữ liệu:", error));
});

// Hàm xóa sản phẩm qua API DELETE cũng phải kèm Token
function deleteProduct(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
        const token = localStorage.getItem('jwtToken');
        fetch(`/WebBanGiay/api/product/${id}`, { 
            method: 'DELETE',
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Product deleted successfully') {
                location.reload();
            } else {
                alert('Xóa thất bại: ' + data.message);
            }
        });
    }
}
</script>