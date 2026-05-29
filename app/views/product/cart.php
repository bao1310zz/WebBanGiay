<?php include 'app/views/shares/header.php'; ?>
<div class="container my-5" style="min-height: 60vh;">
    <h3 class="font-weight-bold text-uppercase mb-4" style="letter-spacing: 1px;">Giỏ Hàng Của Bạn</h3>
    
    <?php if (!empty($cart)): ?>
        <form id="cartForm" action="/WebBanGiay/Product/updateCart" method="POST">
            <div class="table-responsive shadow-sm mb-4">
                <table class="table align-middle bg-white border mb-0">
                    <thead class="bg-dark text-white text-uppercase" style="font-size: 0.85rem;">
                        <tr>
                            <th class="py-3 pl-4">Sản phẩm</th>
                            <th class="py-3 text-center">Đơn giá</th>
                            <th class="py-3 text-center" style="width: 150px;">Số lượng</th>
                            <th class="py-3 text-center">Thành tiền</th>
                            <th class="py-3 text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;
                        foreach ($cart as $id => $item): 
                            $thanh_tien = $item['price'] * $item['quantity'];
                            $total += $thanh_tien;
                        ?>
                            <tr>
                                <td class="pl-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <?php if($item['image']): ?>
                                            <img src="/WebBanGiay/public/uploads/<?= $item['image'] ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;" class="mr-3 border">
                                        <?php endif; ?>
                                        <span class="font-weight-bold text-uppercase"><?= htmlspecialchars($item['name']) ?></span>
                                    </div>
                                </td>
                                <td class="text-center align-middle"><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                                <td class="text-center align-middle">
                                    <!-- NÚT TĂNG GIẢM SỐ LƯỢNG -->
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateQty('qty_cart_<?= $id ?>', -1)">-</button>
                                        <input type="number" name="quantities[<?= $id ?>]" id="qty_cart_<?= $id ?>" class="form-control text-center mx-1 font-weight-bold" value="<?= $item['quantity'] ?>" readonly style="width: 50px; padding: 0.375rem 0; background: white;">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateQty('qty_cart_<?= $id ?>', 1)">+</button>
                                    </div>
                                </td>
                                <td class="text-center align-middle font-weight-bold" style="color: #c89b3c;"><?= number_format($thanh_tien, 0, ',', '.') ?> đ</td>
                                <td class="text-center align-middle">
                                    <!-- NÚT XÓA SẢN PHẨM -->
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeCartItem('qty_cart_<?= $id ?>')" title="Xóa sản phẩm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center bg-light p-4 border rounded">
                <h4 class="font-weight-bold mb-0">Tổng cộng: <span style="color: #c89b3c;"><?= number_format($total, 0, ',', '.') ?> VNĐ</span></h4>
                <div>
                    <a href="/WebBanGiay/Home" class="btn btn-outline-dark px-4 py-2 mr-2">Tiếp tục mua</a>
                    <a href="/WebBanGiay/Product/checkout" class="btn btn-gold px-4 py-2" style="background-color: #111; color:#fff;">Thanh Toán Ngay</a>
                </div>
            </div>
        </form>
    <?php else: ?>
        <div class="text-center py-5 border bg-light rounded">
            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
            <p class="text-muted text-uppercase">Giỏ hàng của bạn đang trống.</p>
            <a href="/WebBanGiay/Home" class="btn btn-dark mt-2 px-4">Quay lại Cửa Hàng</a>
        </div>
    <?php endif; ?>
</div>

<script>
    // Hàm xử lý tăng/giảm và tự động submit
    function updateQty(inputId, change) {
        var el = document.getElementById(inputId);
        var currentVal = parseInt(el.value);
        if (currentVal + change >= 1) {
            el.value = currentVal + change;
            document.getElementById('cartForm').submit(); 
        }
    }

    // Hàm xử lý nút Xóa (Đưa số lượng về 0 và submit)
    function removeCartItem(inputId) {
        if(confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
            document.getElementById(inputId).value = 0;
            document.getElementById('cartForm').submit();
        }
    }
</script>
<?php include 'app/views/shares/footer.php'; ?>