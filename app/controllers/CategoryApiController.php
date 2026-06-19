<?php
require_once 'app/config/database.php';
require_once 'app/models/CategoryModel.php';
// 1. Nhúng file xử lý JWT
require_once 'app/utils/JWTHandler.php'; 

class CategoryApiController
{
    private $categoryModel;
    private $db;
    private $jwtHandler; // Khai báo biến xử lý Token

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
        $this->jwtHandler = new JWTHandler(); // Khởi tạo
    }

    // =========================================================
    // HÀM KIỂM TRA BẢO MẬT BẰNG TOKEN
    // =========================================================
    private function authenticate()
    {
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            $arr = explode(" ", $authHeader);
            $jwt = $arr[1] ?? null;
            
            if ($jwt) {
                $decoded = $this->jwtHandler->decode($jwt);
                return $decoded ? true : false;
            }
        }
        return false;
    }

    // =========================================================
    // CÁC HÀM XỬ LÝ DANH MỤC (CRUD) ĐÃ BẢO MẬT
    // =========================================================

    // 1. Lấy danh sách danh mục (GET /api/category)
    public function index()
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $categories = $this->categoryModel->getCategories();
            echo json_encode($categories);
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    // 2. Lấy thông tin 1 danh mục theo ID (GET /api/category/id)
    public function show($id)
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            // Đảm bảo trong CategoryModel của Sếp có hàm getCategoryById() nhé
            $category = $this->categoryModel->getCategoryById($id); 
            if ($category) {
                echo json_encode($category);
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'Category not found']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    // 3. Thêm danh mục mới (POST /api/category)
    public function store()
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents("php://input"), true);
            
            $name = $data['name'] ?? '';
            $description = $data['description'] ?? '';

            // Đảm bảo trong CategoryModel của Sếp có hàm addCategory()
            $result = $this->categoryModel->addCategory($name, $description); 

            if ($result) {
                http_response_code(201);
                echo json_encode(['message' => 'Category created successfully']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Category creation failed']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    // 4. Cập nhật danh mục (PUT /api/category/id)
    public function update($id)
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents("php://input"), true);
            
            $name = $data['name'] ?? '';
            $description = $data['description'] ?? '';

            // Đảm bảo trong CategoryModel của Sếp có hàm updateCategory()
            $result = $this->categoryModel->updateCategory($id, $name, $description);

            if ($result) {
                echo json_encode(['message' => 'Category updated successfully']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Category update failed']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    // 5. Xóa danh mục (DELETE /api/category/id)
    public function destroy($id)
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            // Đảm bảo trong CategoryModel của Sếp có hàm deleteCategory()
            $result = $this->categoryModel->deleteCategory($id);

            if ($result) {
                echo json_encode(['message' => 'Category deleted successfully']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Category deletion failed']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }
}
?>