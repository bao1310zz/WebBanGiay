<?php include 'app/views/shares/header.php'; ?>
<div class="container my-5" style="min-height: 60vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white p-3">
                    <h5 class="mb-0 text-uppercase font-weight-bold" style="letter-spacing: 1px;">Thông tin giao hàng</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="/WebBanGiay/Product/processCheckout">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-muted small text-uppercase">Họ tên người nhận:</label>
                            <input type="text" name="name" class="form-control" style="border-radius:0;" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-muted small text-uppercase">Số điện thoại:</label>
                            <input type="text" name="phone" class="form-control" style="border-radius:0;" required>
                        </div>
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-muted small text-uppercase">Địa chỉ giao hàng:</label>
                            <textarea name="address" class="form-control" rows="3" style="border-radius:0;" required></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="/WebBanGiay/Product/cart" class="btn btn-outline-dark rounded-0 px-4">Quay lại Giỏ hàng</a>
                            <button type="submit" class="btn px-5 rounded-0" style="background-color: #c89b3c; color:#fff; font-weight:bold;">Xác Nhận Đặt Hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>