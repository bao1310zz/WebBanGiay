<?php
require_once 'app/config/database.php';
require_once 'app/models/ProductModel.php';
require_once 'app/models/CategoryModel.php';
class HomeController {
    private $productModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function index() {
        // Lấy toàn bộ sản phẩm để hiển thị cho khách
        $products = $this->productModel->getProducts();
        include 'app/views/home/index.php';
    }

    public function detail($id) {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include 'app/views/home/detail.php';
        } else {
            echo "<script>alert('Sản phẩm không tồn tại!'); window.location.href='/WebBanGiay/Home';</script>";
        }
    }
}
?>