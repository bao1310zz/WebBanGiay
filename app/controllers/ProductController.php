<?php
class ProductController {
    private $productModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function index() {
        $products = $this->productModel->getProducts();
        include 'app/views/product/list.php';
    }

    public function add() {
        $categories = (new CategoryModel($this->db))->getCategories();
        include 'app/views/product/add.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $category_id = $_POST['category_id'] ?? null;
            
            $image = "";
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "public/uploads/";
                $image = time() . "_" . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image);
            }

            if ($this->productModel->addProduct($name, $description, $price, $category_id, $image)) {
                header('Location: /WebBanGiay/Product');
            } else {
                echo "Lỗi khi thêm sản phẩm!";
            }
        }
    }

    public function edit($id) {
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();
        if ($product) {
            include 'app/views/product/edit.php';
        } else {
            echo "Không tìm thấy sản phẩm.";
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            
            $image = "";
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "public/uploads/";
                $image = time() . "_" . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image);
            }

            if ($this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image)) {
                header('Location: /WebBanGiay/Product');
            } else {
                echo "Lỗi khi cập nhật sản phẩm.";
            }
        }
    }

    public function show($id) {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include 'app/views/product/show.php';
        } else {
            echo "Không tìm thấy sản phẩm.";
        }
    }

    public function delete($id) {
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /WebBanGiay/Product');
        } else {
            echo "Lỗi khi xóa.";
        }
    }

    // ==========================================
    // PHẦN CHỨC NĂNG GIỎ HÀNG VÀ THANH TOÁN (MỚI)
    // ==========================================
    public function cart() {
        // Tự động dọn rác nếu session bị kẹt định dạng số cũ
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $item) {
                if (!is_array($item)) { unset($_SESSION['cart']); break; }
            }
        }
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        include 'app/views/product/cart.php';
    }

    public function addToCart($id) {
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy sản phẩm']);
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id]) && !is_array($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }

        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        if ($quantity < 1) $quantity = 1; 

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image
            ];
        }

        // ĐẾM SỐ LƯỢNG MÓN HÀNG TRONG GIỎ
        $cart_count = count($_SESSION['cart']);

        // NẾU CÓ CỜ 'AJAX' GỬI LÊN THÌ TRẢ VỀ JSON KHÔNG RELOAD TRANG
        if (isset($_POST['is_ajax'])) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success', 
                'cart_count' => $cart_count
            ]);
            exit; // Dừng luôn tại đây, không chạy hàm header Location ở dưới nữa
        }

        // Dự phòng cho trường hợp không dùng AJAX (chạy bình thường)
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/WebBanGiay/Home';
        header('Location: ' . $referer);
    }

    public function checkout() {
        include 'app/views/product/checkout.php';
    }

    public function processCheckout() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo "Giỏ hàng trống.";
                return;
            }

            $this->db->beginTransaction();

            try {
                // 1. Lưu vào bảng orders
                $query = "INSERT INTO orders (name, phone, address) VALUES (:name, :phone, :address)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $address);
                $stmt->execute();
                
                $order_id = $this->db->lastInsertId();

                // 2. Lưu chi tiết vào bảng order_details
                $cart = $_SESSION['cart'];
                foreach ($cart as $product_id => $item) {
                    $query_detail = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
                    $stmt_detail = $this->db->prepare($query_detail);
                    $stmt_detail->bindParam(':order_id', $order_id);
                    $stmt_detail->bindParam(':product_id', $product_id);
                    $stmt_detail->bindParam(':quantity', $item['quantity']);
                    $stmt_detail->bindParam(':price', $item['price']);
                    $stmt_detail->execute();
                }

                // Xóa giỏ hàng và Commit
                unset($_SESSION['cart']);
                $this->db->commit();

                header('Location: /WebBanGiay/Product/orderConfirmation');

            } catch (Exception $e) {
                $this->db->rollBack();
                echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
            }
        }
    }
    public function updateCart() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantities'])) {
            foreach ($_POST['quantities'] as $id => $qty) {
                $qty = (int)$qty;
                if ($qty > 0) {
                    $_SESSION['cart'][$id]['quantity'] = $qty;
                } else {
                    // Nếu số lượng = 0 (do khách bấm nút Xóa), thì xóa luôn khỏi Session
                    unset($_SESSION['cart'][$id]);
                }
            }
        }
        // Xử lý xong thì tự động load lại trang Giỏ hàng
        header('Location: /WebBanGiay/Product/cart');
        exit();
    }

    public function orderConfirmation() {
        include 'app/views/product/orderConfirmation.php';
    }
}
?>