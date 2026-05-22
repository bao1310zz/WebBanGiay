<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5" style="min-height: 60vh;">
    <h3 class="font-weight-bold text-uppercase mb-4" style="letter-spacing: 1px;">Giỏ Hàng Của Bạn</h3>
    
    <?php if (empty($cartItems)): ?>
        <div class="text-center py-5 custom-card">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
            <h4 class="text-muted">Giỏ hàng đang trống</h4>
            <a href="/WebBanGiay/Home" class="btn btn-gold mt-3">Tiếp tục mua sắm</a>
        </div>
    <?php else: ?>
        <div class="table-responsive shadow-sm">
            <table class="table align-middle bg-white border">
                <thead class="bg-dark text-white text-uppercase" style="font-size: 0.85rem;">
                    <tr>
                        <th class="py-3 pl-4">Sản phẩm</th>
                        <th class="py-3 text-center">Đơn giá</th>
                        <th class="py-3 text-center">Số lượng</th>
                        <th class="py-3 text-center">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td class="pl-4">
                                <div class="d-flex align-items-center">
                                    <img src="/WebBanGiay/public/uploads/<?= htmlspecialchars($item->image) ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;" class="mr-3">
                                    <span class="font-weight-bold text-uppercase"><?= htmlspecialchars($item->name) ?></span>
                                </div>
                            </td>
                            <td class="text-center"><?= number_format($item->price, 0, ',', '.') ?> đ</td>
                            <td class="text-center font-weight-bold"><?= $item->quantity ?></td>
                            <td class="text-center font-weight-bold" style="color: #c89b3c;"><?= number_format($item->price * $item->quantity, 0, ',', '.') ?> đ</td>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex flex-column align-items-end mt-4">
            <h4 class="font-weight-bold mb-3">Tổng cộng: <span style="color: #c89b3c;"><?= number_format($totalPrice, 0, ',', '.') ?> VNĐ</span></h4>
            <div>
                <a href="/WebBanGiay/Home" class="btn btn-outline-dark mr-2">Tiếp tục mua</a>
                <a href="/WebBanGiay/Cart/checkout" class="btn btn-gold" onclick="return confirm('Bạn xác nhận đặt hàng chứ?');">Xác Nhận Đặt Hàng</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>