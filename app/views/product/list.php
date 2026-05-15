<!DOCTYPE html>
<html>
<head>
    <title>SNEAKER ZONE - Cửa hàng giày thể thao</title>
    <link rel="stylesheet" href="/project1/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="store-header">
        <h1><i class="fas fa-fire"></i> SNEAKER ZONE</h1>
        <p>Quản lý kho hàng & Sản phẩm nổi bật</p>
    </div>
    
    <a href="/project1/Product/add" class="btn-add"><i class="fas fa-plus-circle"></i> Nhập mẫu giày mới</a>
    
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <img src="<?php echo htmlspecialchars($product->getImage() ? '/project1' . $product->getImage() : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80', ENT_QUOTES, 'UTF-8'); ?>" alt="Sneaker" class="product-img">
                
                <div class="product-info">
                    <h2><?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <p class="desc"><?php echo nl2br(htmlspecialchars($product->getDescription(), ENT_QUOTES, 'UTF-8')); ?></p>
                    <p class="price"><?php echo number_format($product->getPrice(), 0, ',', '.'); ?> ₫</p>
                    
                    <div class="actions">
                        <a href="/project1/Product/edit/<?php echo $product->getID(); ?>"><i class="fas fa-edit"></i> Sửa</a>
                        <a href="/project1/Product/delete/<?php echo $product->getID(); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa mẫu giày này khỏi kho?');"><i class="fas fa-trash"></i> Xóa</a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>