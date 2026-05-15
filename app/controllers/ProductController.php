<?php
require_once 'app/models/ProductModel.php';
class ProductController
{
    private $products = [];
    public function __construct()
    {
        // Giả sử chúng ta lưu trữ sản phẩm trong session để giữ lại khi làm mới trang
        session_start();
        if (isset($_SESSION['products'])) {
            $this->products = $_SESSION['products'];
        }
    }
    public function index()
    {
        $this->list();
    }
    public function list()
    {
        // Hiển thị danh sách sản phẩm
        $products = $this->products;
        include 'app/views/product/list.php';
    }
    public function add()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            
            // Xử lý upload ảnh
            $imagePath = 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80'; // Ảnh mặc định nếu không chọn
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $uploadDir = 'public/images/';
                if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); } // Tự tạo thư mục nếu chưa có
                
                // Đổi tên file để không bị trùng
                $fileName = time() . '_' . basename($_FILES["image"]["name"]);
                $targetFilePath = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    $imagePath = '/' . $targetFilePath;
                }
            }

            if (empty($name)) { $errors[] = 'Tên sản phẩm là bắt buộc.'; } 
            elseif (strlen($name) < 5 || strlen($name) > 100) { $errors[] = 'Tên sản phẩm phải từ 5-100 ký tự.'; }
            if (!is_numeric($price) || $price <= 0) { $errors[] = 'Giá phải là số dương.'; }

            if (empty($errors)) {
                $id = count($this->products) + 1;
                // Truyền thêm biến $imagePath vào đây
                $product = new ProductModel($id, $name, $description, $price, $imagePath);
                $this->products[] = $product;
                $_SESSION['products'] = $this->products;
                header('Location: /project1/Product/list');
                exit();
            }
        }
        include 'app/views/product/add.php';
    }
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($this->products as $key => $product) {
                if ($product->getID() == $id) {
                    $this->products[$key]->setName($_POST['name']);
                    $this->products[$key]->setDescription($_POST['description']);
                    $this->products[$key]->setPrice($_POST['price']);

                    // Kiểm tra xem có upload ảnh mới không
                    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                        $uploadDir = 'public/images/';
                        if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }
                        $fileName = time() . '_' . basename($_FILES["image"]["name"]);
                        $targetFilePath = $uploadDir . $fileName;
                        
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                            $this->products[$key]->setImage('/' . $targetFilePath);
                        }
                    }
                    break;
                }
            }
            $_SESSION['products'] = $this->products;
            header('Location: /project1/Product/list');
            exit();
        }
        foreach ($this->products as $product) {
            if ($product->getID() == $id) {
                include 'app/views/product/edit.php';
                return;
            }
        }
        die('Product not found');
    }
    public function delete($id)
    {
        foreach ($this->products as $key => $product) {
            if ($product->getID() == $id) {
                unset($this->products[$key]);
                break;
            }
        }
        $this->products = array_values($this->products);
        $_SESSION['products'] = $this->products;
        header('Location: /project1/Product/list');
        exit();
    }
}
