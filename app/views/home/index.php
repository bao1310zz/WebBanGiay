<?php include 'app/views/shares/header.php'; ?>

<div class="hero-banner" data-aos="fade-in" data-aos-duration="1500">
    <div class="hero-content">
        <h1 class="hero-title" data-aos="fade-down" data-aos-delay="300">GENTLEMAN'S CHOICE</h1>
        <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="600">KHÁM PHÁ BỘ SƯU TẬP MỚI NHẤT</p>
    </div>
</div>

<div class="container my-5" style="min-height: 60vh;">
    <div class="text-center mb-5" data-aos="fade-up">
        <h3 class="font-weight-bold text-uppercase" style="letter-spacing: 2px;">Sản Phẩm Nổi Bật</h3>
        <div style="height: 3px; width: 60px; background-color: #c89b3c; margin: 15px auto;"></div>
    </div>

    <div class="row">
        <?php 
        $delay = 0; // Biến tạo độ trễ xếp tầng cho hiệu ứng
        foreach ($products as $product): 
            $delay += 100;
        ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-5" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                <div class="card product-card h-100">
                    <a href="/WebBanGiay/Home/detail/<?= $product->id ?>" class="text-decoration-none">
                        <div class="img-wrapper border-bottom position-relative">
                            <div class="position-absolute d-flex align-items-center justify-content-center w-100 h-100" style="top:0; left:0; background:rgba(255,255,255,0.4); opacity:0; transition:0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0">
                                <span class="bg-dark text-white px-3 py-2 rounded-pill small font-weight-bold"><i class="fas fa-search mr-1"></i> Xem chi tiết</span>
                            </div>

                            <?php if (!empty($product->image)): ?>
                                <img src="/WebBanGiay/public/uploads/<?= htmlspecialchars($product->image) ?>" class="img-fluid" alt="<?= htmlspecialchars($product->name) ?>">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/300" class="img-fluid" alt="No image">
                            <?php endif; ?>
                        </div>
                        <div class="card-body text-center pb-2">
                            <p class="small text-uppercase mb-2" style="color: #c89b3c; font-weight: 600; letter-spacing: 1px;"><?= htmlspecialchars($product->category_name) ?></p>
                            <h6 class="font-weight-bold text-dark text-uppercase mb-3 text-truncate"><?= htmlspecialchars($product->name) ?></h6>
                            <h5 class="font-weight-bold" style="color: #111;"><?= number_format($product->price, 0, ',', '.') ?> đ</h5>
                        </div>
                    </a>
                    <div class="card-footer bg-white border-0 p-3 pt-0 text-center">
                        <a href="/WebBanGiay/Cart/add/<?= $product->id ?>" class="btn btn-gold btn-block">
                            <i class="fas fa-shopping-bag mr-2"></i> THÊM VÀO GIỎ
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>