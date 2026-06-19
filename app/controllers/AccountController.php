<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');
require_once('app/helpers/SessionHelper.php');
// Nhúng bộ xử lý JWT để cấp thẻ từ
require_once('app/utils/JWTHandler.php'); 

class AccountController {
    private $accountModel;
    private $db;
    private $jwtHandler; // Khai báo biến xử lý Token

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
        $this->jwtHandler = new JWTHandler(); // Khởi tạo JWT
    }

    public function register() {
        include_once 'app/views/account/register.php';
    }

    public function login() {
        include_once 'app/views/account/login.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $role = 'user'; // Mặc định đăng ký trên web là user

            $errors = [];
            if (empty($username)) $errors['username'] = "Vui lòng nhập tên đăng nhập!";
            if (empty($password)) $errors['password'] = "Vui lòng nhập mật khẩu!";
            if ($password != $confirmPassword) $errors['confirmPass'] = "Mật khẩu xác nhận chưa khớp!";
            if ($this->accountModel->getAccountByUsername($username)) {
                $errors['account'] = "Tài khoản này đã tồn tại!";
            }

            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
            } else {
                // Mã hóa mật khẩu trước khi lưu
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $result = $this->accountModel->save($username, $fullName, $hashedPassword, $email, $phone, $address, $role);
                if ($result) {
                    header('Location: /WebBanGiay/Account/login');
                    exit;
                }
            }
        }
    }

    public function checkLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // KIỂM TRA XEM REQUEST NÀY TỪ API (POSTMAN/JAVASCRIPT) HAY TỪ WEB
            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

            if (strpos($contentType, 'application/json') !== false) {
                // ==========================================
                // LUỒNG 1: DÀNH CHO API (POSTMAN/FETCH) - CẤP JWT
                // ==========================================
                header('Content-Type: application/json');
                $data = json_decode(file_get_contents("php://input"), true);
                $username = $data['username'] ?? '';
                $password = $data['password'] ?? '';

                $account = $this->accountModel->getAccountByUsername($username);
                if ($account && password_verify($password, $account->password)) {
                    
                    // ---> BẮT ĐẦU ĐOẠN CODE BỔ SUNG: KHỞI TẠO SESSION CHO GIAO DIỆN WEB <---
                    SessionHelper::start();
                    $_SESSION['username'] = $account->username;
                    $_SESSION['role'] = $account->role;
                    // ---> KẾT THÚC ĐOẠN CODE BỔ SUNG <---

                    // Tạo Token chứa id và username
                    $token = $this->jwtHandler->encode([
                        'id' => $account->id, 
                        'username' => $account->username
                    ]);
                    echo json_encode(['token' => $token]);
                } else {
                    http_response_code(401);
                    echo json_encode(['message' => 'Invalid credentials']);
                }
                exit; // Kết thúc luồng API ở đây

            } else {
                // ==========================================
                // LUỒNG 2: DÀNH CHO WEB (FORM HTML THUẦN) - LƯU SESSION
                // ==========================================
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';

                $account = $this->accountModel->getAccountByUsername($username);
                if ($account && password_verify($password, $account->password)) {
                    SessionHelper::start();
                    $_SESSION['username'] = $account->username;
                    $_SESSION['role'] = $account->role;
                    
                    header('Location: /WebBanGiay/Product');
                    exit;
                } else {
                    $error = "Sai tên đăng nhập hoặc mật khẩu!";
                    include_once 'app/views/account/login.php';
                }
            }
        }
    }

    public function logout() {
        SessionHelper::start();
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: /WebBanGiay/Product');
        exit;
    }
}
?>