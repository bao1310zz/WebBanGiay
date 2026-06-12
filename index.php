<?php
// 1. Nhúng vệ sĩ quản lý Session và khởi động ngay lập tức
require_once 'app/helpers/SessionHelper.php';
SessionHelper::start();

// 2. Nhúng các Model cần thiết cho hệ thống
require_once 'app/models/ProductModel.php';
require_once 'app/models/CategoryModel.php'; // Bổ sung thêm Model này cho API

// 3. Xử lý tách chuỗi URL để định tuyến (Routing)
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Xác định Controller cơ bản (Nếu là api thì $url[0] = 'api' => $controllerName = 'ApiController')
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'HomeController';

// =========================================================
// PHÂN NHÁNH 1: ĐỊNH TUYẾN DÀNH RIÊNG CHO RESTful API
// =========================================================
if ($controllerName === 'ApiController' && isset($url[1])) {
    // Gọi đúng tên Controller, ví dụ: ProductApiController
    $apiControllerName = ucfirst($url[1]) . 'ApiController';

    if (file_exists('app/controllers/' . $apiControllerName . '.php')) {
        require_once 'app/controllers/' . $apiControllerName . '.php';
        $controllerObject = new $apiControllerName();

        $method = $_SERVER['REQUEST_METHOD']; // Lấy phương thức GET, POST, PUT, DELETE
        $id = $url[2] ?? null;
        $action = '';

        // Dùng Switch case giống trong slide để gọi đúng hàm (index, show, store, update, destroy)
        switch ($method) {
            case 'GET':
                $action = $id ? 'show' : 'index';
                break;
            case 'POST':
                $action = 'store';
                break;
            case 'PUT':
                if ($id) $action = 'update';
                break;
            case 'DELETE':
                if ($id) $action = 'destroy';
                break;
            default:
                http_response_code(405);
                echo json_encode(['message' => 'Method Not Allowed']);
                exit;
        }

        // Thực thi hàm API
        if ($action && method_exists($controllerObject, $action)) {
            if ($id) {
                call_user_func_array([$controllerObject, $action], [$id]);
            } else {
                call_user_func_array([$controllerObject, $action], []);
            }
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Action not found']);
        }
        exit; // KẾT THÚC LUỒNG API Ở ĐÂY, không chạy xuống phần Web bên dưới
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Controller not found']);
        exit;
    }
}

// =========================================================
// PHÂN NHÁNH 2: ĐỊNH TUYẾN CHO WEBSITE BÌNH THƯỜNG CỦA SẾP
// =========================================================

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