<?php
// 1. Nhúng vệ sĩ quản lý Session và khởi động ngay lập tức
require_once 'app/helpers/SessionHelper.php';
SessionHelper::start();

// 2. Nhúng các Model cần thiết cho hệ thống
require_once 'app/models/ProductModel.php';

// 3. Xử lý tách chuỗi URL để định tuyến (Routing)
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Kiểm tra phần đầu tiên của URL để xác định Controller
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'HomeController';

// Kiểm tra phần thứ hai của URL để xác định Action (hàm xử lý)
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

// Kiểm tra xem file Controller có tồn tại trong thư mục không
if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    die('Controller không tồn tại (404 Not Found)');
}

// Nhúng file Controller tương ứng vào hệ thống
require_once 'app/controllers/' . $controllerName . '.php';
$controllerObject = new $controllerName();

// Kiểm tra xem hàm (Action) có tồn tại trong class đó không
if (!method_exists($controllerObject, $action)) {
    die('Action không tồn tại (404 Not Found)');
}

// Gọi action và truyền các tham số còn lại trên URL (ví dụ ID sản phẩm) nếu có
call_user_func_array([$controllerObject, $action], array_slice($url, 2));
?>