<?php include 'app/views/shares/header.php'; ?>

<style>
    .product-card-hover {
        transition: all 0.3s ease;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #cccccc !important; 
        background-color: #fff;
    }
    .product-card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.12) !important;
        border-color: #111 !important; 
    }
    .desc-clamp {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<div class="hero-banner">
    <div class="hero-content">
        <h1 class="hero-title">GENTLEMAN'S CHOICE</h1>
        <p class="hero-subtitle">BỘ SƯU TẬP GIÀY DA THỦ CÔNG</p>
    </div>
</div>

<div class="container my-5" style="min-height: 60vh;">
    <div class="d-flex justify-content-between align-items-end mb-5 border-bottom pb-3">
        <div>
            <h3 class="font-weight-bold text-uppercase" style="letter-spacing: 1px; margin:0;">Quản Lý Sản Phẩm</h3>
            <div style="height: 3px; width: 60px; background-color: #c89b3c; margin-top: 10px;"></div>
        </div>
        <a href="/WebBanGiay/Product/add" class="btn btn-gold rounded" style="border-radius: 6px !important;">
            <i class="fas fa-plus mr-1"></i> Thêm Sản Phẩm
        </a>
    </div>

    <div class="row">
        <?php if (empty($products)): ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h5 class="text-muted text-uppercase">Kho giày đang trống</h5>
            </div>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                    
                    <div class="card h-100 product-card-hover">
                        
                        <div class="position-relative" style="background-color: #f8f9fa; padding: 20px; border-bottom: 1px solid #eee;">
                            <?php if (!empty($product->image)): ?>
                                <img src="/WebBanGiay/public/uploads/<?= htmlspecialchars($product->image) ?>" class="card-img-top" style="height: 220px; object-fit: cover; border-radius: 4px;" alt="<?= htmlspecialchars($product->name) ?>">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/300x300?text=NO+IMAGE" class="card-img-top" style="height: 220px; object-fit: cover; border-radius: 4px;" alt="No image">
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-body text-left p-4">
                            <div class="mb-2">
                                <span class="small font-weight-bold" style="color: #c89b3c; letter-spacing: 1px; text-transform: uppercase;">
                                    <?= htmlspecialchars($product->category_name) ?>
                                </span>
                            </div>

                            <h5 class="card-title font-weight-bold text-uppercase mb-2" style="color: #111; font-size: 1.1rem; line-height: 1.4;">
                                <?= htmlspecialchars($product->name) ?>
                            </h5>
                            
                            <p class="text-muted small mb-3 desc-clamp">
                                <?= htmlspecialchars($product->description) ?>
                            </p>

                            <h4 class="font-weight-bold mb-0" style="color: #111;">
                                <?= number_format($product->price, 0, ',', '.') ?> <span style="font-size: 0.9rem; text-decoration: underline;">đ</span>
                            </h4>
                        </div>
                        
                        <div class="card-footer bg-white p-3 d-flex justify-content-between align-items-center" style="border-top: 1px solid #eee;">
                            <a href="/WebBanGiay/Product/show/<?= $product->id ?>" class="btn btn-outline-dark btn-sm flex-grow-1 mr-1 py-2" style="font-weight: 600; letter-spacing: 1px; border-radius: 4px;">
                                <i class="fas fa-eye mr-1"></i> XEM
                            </a>
                            <a href="/WebBanGiay/Product/edit/<?= $product->id ?>" class="btn btn-dark btn-sm flex-grow-1 mx-1 py-2" style="font-weight: 600; letter-spacing: 1px; border-radius: 4px;">
                                <i class="fas fa-edit mr-1"></i> SỬA
                            </a>
                            <a href="/WebBanGiay/Product/delete/<?= $product->id ?>" class="btn btn-outline-danger btn-sm py-2 px-2 ml-1" style="border-radius: 4px;" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>