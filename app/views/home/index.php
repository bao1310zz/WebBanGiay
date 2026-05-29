<?php include 'app/views/shares/header.php'; ?>

<div id="homeCarousel" class="carousel slide" data-ride="carousel" data-interval="4000" data-aos="fade-in" data-aos-duration="1500" style="margin-bottom: 60px;">
    <ol class="carousel-indicators">
        <?php 
        $slide_count = min(count($products), 4); // Giới hạn lấy tối đa 3 đôi giày lên slider cho đẹp thanh menu
        for($i = 0; $i < $slide_count; $i++): 
        ?>
            <li data-target="#homeCarousel" data-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>"></li>
        <?php endfor; ?>
    </ol>

    <div class="carousel-inner">
        <?php if (empty($products)): ?>
            <div class="carousel-item active">
                <div style="background: #111; height: 480px; display: flex; align-items: center; justify-content: center;">
                    <h3 class="text-white-50 text-uppercase">Chưa có sản phẩm nào trong cửa hàng</h3>
                </div>
            </div>
        <?php else: ?>
            <?php 
            $index = 0;
            foreach ($products as $product): 
                if ($index >= 4) break; // Chỉ lấy 3 sản phẩm đầu tiên lên banner
                $imgUrl = !empty($product->image) ? "/WebBanGiay/public/uploads/" . htmlspecialchars($product->image) : "https://via.placeholder.com/500?text=No+Image";
            ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    
                    <a href="/WebBanGiay/Home/detail/<?= $product->id ?>" class="text-decoration-none">
                        <div style="background: #161616; height: 480px; position: relative; overflow: hidden;">
                            
                            <div style="position: absolute; inset: 0; background: url('<?= $imgUrl ?>') center center no-repeat; background-size: cover; filter: blur(25px); opacity: 0.2;"></div>
                            
                            <div class="container h-100 position-relative" style="z-index: 2;">
                                <div class="row h-100 align-items-center">
                                    
                                    <div class="col-md-6 text-white text-md-left text-center pl-md-5">
                                        <span class="badge badge-warning text-dark text-uppercase font-weight-bold px-3 py-2 mb-3" style="letter-spacing: 1px; font-size: 0.75rem; border-radius: 4px;">
                                            <?= htmlspecialchars($product->category_name) ?>
                                        </span>
                                        <h1 class="font-weight-bold text-uppercase mb-2" style="color: #c89b3c; letter-spacing: 2px; font-size: 2.6rem; line-height: 1.2;">
                                            <?= htmlspecialchars($product->name) ?>
                                        </h1>
                                        <h3 class="font-weight-bold mb-4" style="color: #fff; letter-spacing: 1px;">
                                            <?= number_format($product->price, 0, ',', '.') ?> VNĐ
                                        </h3>
                                        <span class="btn btn-gold px-5 py-3" style="border-radius: 50px; font-size: 0.8rem; letter-spacing: 1.5px;">
                                            XEM CHI TIẾT SẢN PHẨM <i class="fas fa-arrow-right ml-2"></i>
                                        </span>
                                    </div>
                                    
                                    <div class="col-md-6 d-none d-md-flex justify-content-center align-items-center h-100">
                                        <img src="<?= $imgUrl ?>" style="max-height: 360px; object-fit: contain; filter: drop-shadow(0px 20px 30px rgba(0,0,0,0.7));" class="img-fluid pr-md-5">
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </a>
                    
                </div>
            <?php 
                $index++;
            endforeach; ?>
        <?php endif; ?>
    </div>

    <a class="carousel-control-prev" href="#homeCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 2.5rem; height: 2.5rem;"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#homeCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true" style="width: 2.5rem; height: 2.5rem;"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div id="featured-products" class="container my-5" style="min-height: 60vh;">
    <div class="text-center mb-5" data-aos="fade-up">
        <h3 class="font-weight-bold text-uppercase" style="letter-spacing: 2px;">Sản Phẩm Nổi Bật</h3>
        <div style="height: 3px; width: 60px; background-color: #c89b3c; margin: 15px auto;"></div>
    </div>

    <div class="row">
        <?php 
        $delay = 0; 
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
                    <div class="card-footer bg-white border-0 p-3 pt-0">
                            <form action="/WebBanGiay/Product/addToCart/<?= $product->id ?>" method="POST" class="ajax-cart-form">
                                <input type="hidden" name="is_ajax" value="1">
                                
                                <div class="d-flex justify-content-between align-items-center mb-2 px-3">
                                    <button type="button" class="btn btn-sm btn-outline-dark" style="width: 30px;" onclick="var el = document.getElementById('qty_home_<?= $product->id ?>'); if(el.value > 1) el.value--;">-</button>
                                    <input type="number" name="quantity" id="qty_home_<?= $product->id ?>" class="form-control text-center border-0 font-weight-bold" value="1" min="1" readonly style="width: 50px; background: transparent;">
                                    <button type="button" class="btn btn-sm btn-outline-dark" style="width: 30px;" onclick="document.getElementById('qty_home_<?= $product->id ?>').value++;">+</button>
                                </div>
                                <button type="submit" class="btn btn-gold btn-block">
                                    <i class="fas fa-shopping-bag mr-2"></i> THÊM VÀO GIỎ
                                </button>
                            </form>
                        </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>