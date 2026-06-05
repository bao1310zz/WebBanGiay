<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');
require_once('app/helpers/SessionHelper.php');

class AccountController {
    private $accountModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
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
                $result = $this->accountModel->save($username, $fullName, $password, $email, $phone, $address, $role);
                if ($result) {
                    header('Location: /WebBanGiay/Account/login');
                    exit;
                }
            }
        }
    }

    public function checkLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    public function logout() {
        SessionHelper::start();
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: /WebBanGiay/Product');
        exit;
    }
}
?>