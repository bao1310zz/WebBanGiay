<?php
require_once 'app/config/database.php';
require_once 'app/models/ProductModel.php';
require_once 'app/models/CategoryModel.php';
require_once 'app/helpers/SessionHelper.php';
class CartController {
    // Chuyển hướng mọi request cũ sang hệ thống mới trong ProductController
    public function add($id) {
        header('Location: /WebBanGiay/Product/addToCart/' . $id);
        exit();
    }

    public function index() {
        header('Location: /WebBanGiay/Product/cart');
        exit();
    }

    public function checkout() {
        header('Location: /WebBanGiay/Product/checkout');
        exit();
    }
}
?>