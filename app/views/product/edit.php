<!DOCTYPE html>
<html>
<head>
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="/project1/public/css/style.css">
</head>
<body>
    <h1>Sửa sản phẩm</h1>
    
    <form method="POST" action="/project1/Product/edit/<?php echo $product->getID(); ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($product->getDescription(), ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product->getPrice(), ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="image">Thay đổi hình ảnh mới (Bỏ trống nếu muốn giữ ảnh cũ):</label>
            <input type="file" id="image" name="image" accept="image/*" style="background: none; border: none; padding: 0; box-shadow: none;">
        </div>
        
        <button type="submit" class="btn-submit">Lưu thay đổi</button>
    </form>
    
    <div class="back-link">
        <a href="/project1/Product/list">Quay lại danh sách sản phẩm</a>
    </div>
</body>
</html>