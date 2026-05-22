<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5 mb-5" style="min-height: 60vh;">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h3 class="font-weight-bold text-uppercase" style="letter-spacing: 1px;">CHI TIẾT SẢN PHẨM</h3>
        <a href="/WebBanGiay/Product" class="btn btn-outline-dark" style="border-radius: 4px; font-weight: 600;">
            <i class="fas fa-arrow-left mr-1"></i> Quay lại
        </a>
    </div>

    <div class="row bg-white p-4" style="border: 1px solid #eee; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
        <div class="col-md-5 text-center mb-4 mb-md-0" style="background-color: #f9f9f9; padding: 20px; border-radius: 8px;">
            <?php if (!empty($product->image)): ?>
                <img src="/WebBanGiay/public/uploads/<?= htmlspecialchars($product->image) ?>" class="img-fluid" style="border-radius: 4px; max-height: 400px; object-fit: contain;" alt="<?= htmlspecialchars($product->name) ?>">
            <?php else: ?>
                <img src="https://via.placeholder.com/400x400?text=No+Image" class="img-fluid" style="border-radius: 4px;" alt="No image">
            <?php endif; ?>
        </div>

        <div class="col-md-7 pl-md-5 d-flex flex-column justify-content-center">
            <div class="mb-2">
                <span class="badge badge-dark p-2 text-uppercase" style="letter-spacing: 1px; font-weight: 500;">
                    <?= htmlspecialchars($product->category_name ?? 'Chưa phân loại') ?>
                </span>
            </div>
            
            <h2 class="font-weight-bold text-uppercase mb-3" style="color: #111;"><?= htmlspecialchars($product->name) ?></h2>
            <h3 class="font-weight-bold mb-4" style="color: #c89b3c;"><?= number_format($product->price, 0, ',', '.') ?> VNĐ</h3>
            
            <h6 class="font-weight-bold text-uppercase text-muted" style="letter-spacing: 1px;">Mô tả sản phẩm:</h6>
            <p class="text-muted" style="line-height: 1.8; font-size: 0.95rem;">
                <?= nl2br(htmlspecialchars($product->description)) ?>
            </p>

            <div class="mt-auto pt-4 border-top">
                <a href="/WebBanGiay/Product/edit/<?= $product->id ?>" class="btn px-4 py-2 mr-2" style="background-color: #111; color: #fff; border-radius: 4px; font-weight: 600; letter-spacing: 1px;">
                    <i class="fas fa-edit mr-1"></i> Sửa Thông Tin
                </a>
                <a href="/WebBanGiay/Product/delete/<?= $product->id ?>" class="btn btn-outline-danger px-4 py-2" style="border-radius: 4px; font-weight: 600; letter-spacing: 1px;" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                    <i class="fas fa-trash-alt mr-1"></i> Xóa
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>