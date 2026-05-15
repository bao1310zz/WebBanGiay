<!DOCTYPE html>
<html>
<head>
    <title>Thêm sản phẩm mới</title>
    <link rel="stylesheet" href="/project1/public/css/style.css">
    <script>
        function validateForm() {
            let name = document.getElementById('name').value;
            let price = document.getElementById('price').value;
            let errors = [];
            if (name.length < 10 || name.length > 100) {
                errors.push('Tên sản phẩm phải có từ 10 đến 100 ký tự.');
            }
            if (price <= 0 || isNaN(price)) {
                errors.push('Giá phải là một số dương lớn hơn 0.');
            }
            if (errors.length > 0) {
                alert(errors.join('\n'));
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Thêm sản phẩm mới</h1>
    
    <?php if (!empty($errors)): ?>
        <div class="error-message">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="/project1/Product/add" enctype="multipart/form-data" onsubmit="return validateForm();">
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        
        <div class="form-group">
            <label for="image">Hình ảnh sản phẩm:</label>
            <input type="file" id="image" name="image" accept="image/*" style="background: none; border: none; padding: 0; box-shadow: none;">
        </div>
        
        <button type="submit" class="btn-submit">Thêm sản phẩm</button>
    </form>
    
    <div class="back-link">
        <a href="/project1/Product/list">Quay lại danh sách sản phẩm</a>
    </div>
</body>
</html>