<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5" style="min-height: 70vh;">
    <div class="row bg-white shadow-sm" style="border-radius: 12px; overflow: hidden; border: 1px solid #eee;">

        <div class="col-md-6 p-0 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
            <?php if (!empty($product->image)): ?>
                <img src="/WebBanGiay/public/uploads/<?= htmlspecialchars($product->image) ?>" class="img-fluid p-5"
                    alt="<?= htmlspecialchars($product->name) ?>" style="max-height: 500px; object-fit: contain;">
            <?php else: ?>
                <img src="https://via.placeholder.com/500x500?text=NO+IMAGE" class="img-fluid p-5" alt="No image">
            <?php endif; ?>
        </div>

        <div class="col-md-6 p-5">
            <span class="badge badge-dark mb-2 px-3 py-2 text-uppercase" style="letter-spacing: 1px; color: #c89b3c;">
                <?= htmlspecialchars($product->category_name ?? 'Giày Da') ?>
            </span>

            <h1 class="font-weight-bold text-uppercase mb-3" style="color: #111; font-size: 2.2rem;">
                <?= htmlspecialchars($product->name) ?>
            </h1>

            <h2 class="font-weight-bold mb-4" style="color: #c89b3c;">
                <?= number_format($product->price, 0, ',', '.') ?> <span
                    style="font-size: 1.2rem; text-decoration: underline;">đ</span>
            </h2>

            <div class="mb-5">
                <h6 class="text-uppercase font-weight-bold text-muted mb-2">Mô tả sản phẩm:</h6>
                <p class="text-secondary" style="line-height: 1.8;">
                    <?= nl2br(htmlspecialchars($product->description)) ?>
                </p>
            </div>

            <form action="/WebBanGiay/Product/addToCart/<?= $product->id ?>" method="POST" class="ajax-cart-form">
                <input type="hidden" name="is_ajax" value="1">

                <div class="form-group">
                    <label>Số lượng:</label>
                    <div class="input-group" style="width: 150px;">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button"
                                onclick="document.getElementById('qty').stepDown()">-</button>
                        </div>
                        <input type="number" id="qty" name="quantity" class="form-control text-center" value="1"
                            min="1">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button"
                                onclick="document.getElementById('qty').stepUp()">+</button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-gold btn-lg w-100">
                    <i class="fas fa-shopping-bag mr-2"></i> THÊM VÀO GIỎ HÀNG
                </button>
            </form>

            <?php if (SessionHelper::isAdmin()): ?>
                <div class="p-3 bg-light rounded border border-warning">
                    <h6 class="text-uppercase text-warning font-weight-bold mb-3" style="font-size: 0.8rem;"><i
                            class="fas fa-crown mr-1"></i> Đặc quyền Quản trị viên</h6>
                    <div class="d-flex justify-content-between">
                        <a href="/WebBanGiay/Product/edit/<?= $product->id ?>" class="btn btn-dark flex-grow-1 mr-2"
                            style="border-radius: 6px;">
                            <i class="fas fa-edit mr-1"></i> Sửa thông tin
                        </a>
                        <a href="/WebBanGiay/Product/delete/<?= $product->id ?>"
                            class="btn btn-outline-danger flex-grow-1 ml-2" style="border-radius: 6px;"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa siêu phẩm này?');">
                            <i class="fas fa-trash-alt mr-1"></i> Xóa
                        </a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>