<?php
class CartController {
    public function add($id) {
        // Tăng số lượng nếu đã có trong giỏ, nếu chưa thì gán = 1
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;
        } else {
            $_SESSION['cart'][$id] = 1;
        }
        
        // --- THÊM DÒNG NÀY ĐỂ BẬT HIỆU ỨNG THÔNG BÁO ---
        $_SESSION['toast'] = 'Đã thêm sản phẩm vào giỏ xách!';
        
        // Trở lại trang chủ
        header('Location: /WebBanGiay/Home');
        exit();
    }

    public function index() {
        $db = (new Database())->getConnection();
        $productModel = new ProductModel($db);
        
        $cartItems = [];
        $totalPrice = 0;

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $quantity) {
                $product = $productModel->getProductById($id);
                if ($product) {
                    $product->quantity = $quantity;
                    $cartItems[] = $product;
                    $totalPrice += ($product->price * $quantity);
                }
            }
        }
        include 'app/views/cart/index.php';
    }

    public function checkout() {
        // Xóa giỏ hàng
        unset($_SESSION['cart']);
        
        // Hiện popup chúc mừng cực xịn thay vì alert()
        echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head><body style='background:#fdfdfd;'>
        <script>
            Swal.fire({
                title: 'Thành công!',
                text: 'Cảm ơn bạn! Đơn hàng đã được đặt thành công.',
                icon: 'success',
                confirmButtonColor: '#111',
                confirmButtonText: 'Tuyệt vời!'
            }).then(() => {
                window.location.href = '/WebBanGiay/Home';
            });
        </script>
        </body></html>";
    }
}
?>  