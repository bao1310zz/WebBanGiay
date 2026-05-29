<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5" style="min-height: 60vh;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent px-0">
            <li class="breadcrumb-item"><a href="/WebBanGiay/Home" class="text-dark">Cửa Hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($product->name) ?></li>
        </ol>
    </nav>

    <div class="row custom-card">
        <div class="col-md-6 text-center border-right">
            <?php if (!empty($product->image)): ?>
                <img src="/WebBanGiay/public/uploads/<?= htmlspecialchars($product->image) ?>" class="img-fluid rounded" style="max-height: 450px;" alt="<?= htmlspecialchars($product->name) ?>">
            <?php else: ?>
                <img src="https://via.placeholder.com/400" class="img-fluid rounded" alt="No image">
            <?php endif; ?>
        </div>
        <div class="col-md-6 pl-md-5 mt-4 mt-md-0 d-flex flex-column justify-content-center">
            <h2 class="font-weight-bold text-uppercase mb-3"><?= htmlspecialchars($product->name) ?></h2>
            <h3 class="font-weight-bold mb-4" style="color: #c89b3c;"><?= number_format($product->price, 0, ',', '.') ?> VNĐ</h3>
            
            <p class="text-muted mb-4" style="line-height: 1.8;">
                <?= nl2br(htmlspecialchars($product->description)) ?>
            </p>

            <ul class="list-unstyled mb-5">
                <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Giao hàng toàn quốc</li>
                <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Bảo hành da 12 tháng</li>
                <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Đổi trả miễn phí 7 ngày</li>
            </ul>

            <a href="/WebBanGiay/Product/addToCart/<?= $product->id ?>" class="btn btn-gold btn-lg text-uppercase" style="letter-spacing: 2px;">
                <i class="fas fa-shopping-bag mr-2"></i> Thêm Vào Giỏ Hàng
            </a>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>