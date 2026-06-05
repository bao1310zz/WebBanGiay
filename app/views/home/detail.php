<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5" style="min-height: 70vh;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item"><a href="/WebBanGiay/Home" class="text-dark">Cửa Hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($product->name) ?></li>
        </ol>
    </nav>

    <div class="row custom-card">
        <div class="col-md-6 text-center border-right">
            <?php if (!empty($product->image)): ?>
                <img src="/WebBanGiay/public/uploads/<?= htmlspecialchars($product->image) ?>" class="img-fluid rounded"
                    style="max-height: 450px;" alt="<?= htmlspecialchars($product->name) ?>">
            <?php else: ?>
                <img src="https://via.placeholder.com/400" class="img-fluid rounded" alt="No image">
            <?php endif; ?>
        </div>

        <div class="col-md-6 pl-md-5 mt-4 mt-md-0 d-flex flex-column justify-content-center">
            <h2 class="font-weight-bold text-uppercase mb-3"><?= htmlspecialchars($product->name) ?></h2>
            <h3 class="font-weight-bold mb-4" style="color: #c89b3c;"><?= number_format($product->price, 0, ',', '.') ?>
                VNĐ</h3>

            <p class="text-muted mb-4" style="line-height: 1.8;">
                <?= nl2br(htmlspecialchars($product->description)) ?>
            </p>

            <ul class="list-unstyled mb-5">
                <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Giao hàng toàn quốc</li>
                <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Bảo hành da 12 tháng</li>
                <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Đổi trả miễn phí 7 ngày</li>
            </ul>

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
                    <h6 class="text-uppercase text-warning font-weight-bold mb-3" style="font-size: 0.8rem;">
                        <i class="fas fa-crown mr-1"></i> Đặc quyền Quản trị viên
                    </h6>
                    <div class="d-flex justify-content-between">
                        <a href="/WebBanGiay/Product/edit/<?= $product->id ?>" class="btn btn-dark flex-grow-1 mr-2"
                            style="border-radius: 6px;">
                            <i class="fas fa-edit mr-1"></i> Sửa
                        </a>
                        <a href="/WebBanGiay/Product/delete/<?= $product->id ?>"
                            class="btn btn-outline-danger flex-grow-1 ml-2" style="border-radius: 6px;"
                            onclick="return confirm('Xóa siêu phẩm này?');">
                            <i class="fas fa-trash-alt mr-1"></i> Xóa
                        </a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>