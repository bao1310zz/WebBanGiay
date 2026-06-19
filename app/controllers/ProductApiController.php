<?php
require_once 'app/config/database.php';
require_once 'app/models/ProductModel.php';
require_once 'app/models/CategoryModel.php';
// 1. Nhúng file xử lý JWT vào hệ thống
require_once 'app/utils/JWTHandler.php'; 

class ProductApiController
{
    private $productModel;
    private $db;
    private $jwtHandler; // 2. Khai báo biến xử lý Token

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        $this->jwtHandler = new JWTHandler(); // 3. Khởi tạo đối tượng JWT
    }

    // =========================================================
    // HÀM KIỂM TRA BẢO MẬT (Máy quét thẻ từ)
    // =========================================================
    private function authenticate()
    {
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            $arr = explode(" ", $authHeader);
            $jwt = $arr[1] ?? null;
            if ($jwt) {
                // Giải mã token, nếu đúng sẽ trả về true
                $decoded = $this->jwtHandler->decode($jwt);
                return $decoded ? true : false;
            }
        }
        return false;
    }

    // =========================================================
    // CÁC HÀM XỬ LÝ (Đã được bọc lớp bảo vệ)
    // =========================================================

    // Lấy danh sách sản phẩm (GET /api/product)
    public function index()
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $products = $this->productModel->getProducts();
            echo json_encode($products);
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    // Lấy thông tin 1 sản phẩm theo ID (GET /api/product/id)
    public function show($id)
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $product = $this->productModel->getProductById($id);
            if ($product) {
                echo json_encode($product);
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'Product not found']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    // Thêm sản phẩm mới (POST /api/product)
    public function store()
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents("php://input"), true);

            $name = $data['name'] ?? '';
            $description = $data['description'] ?? '';
            $price = $data['price'] ?? 0;
            $category_id = $data['category_id'] ?? null;

            // Lưu ý: API thường xử lý ảnh qua Base64 hoặc form-data riêng, ở đây ta để null tạm theo slide
            $result = $this->productModel->addProduct($name, $description, $price, $category_id, null);

            if (is_array($result)) {
                http_response_code(400);
                echo json_encode(['errors' => $result]);
            } else {
                http_response_code(201);
                echo json_encode(['message' => 'Product created successfully']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    // Cập nhật sản phẩm (PUT /api/product/id)
    public function update($id)
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents("php://input"), true);

            $name = $data['name'] ?? '';
            $description = $data['description'] ?? '';
            $price = $data['price'] ?? 0;
            $category_id = $data['category_id'] ?? null;

            $result = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, null);

            if ($result) {
                echo json_encode(['message' => 'Product updated successfully']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Product update failed']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    // Xóa sản phẩm (DELETE /api/product/id)
    public function destroy($id)
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $result = $this->productModel->deleteProduct($id);

            if ($result) {
                echo json_encode(['message' => 'Product deleted successfully']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Product deletion failed']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }
}
?>