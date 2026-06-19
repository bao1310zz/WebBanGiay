<?php
class AccountModel {
    private $conn;
    private $table_name = "account"; // CHUẨN RỒI! BẢNG CỦA CHÚNG TA TÊN LÀ ACCOUNT

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAccountByUsername($username) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function save($username, $fullName, $password, $email, $phone, $address, $role = 'user') {
        if ($this->getAccountByUsername($username)) {
            return false; // User đã tồn tại
        }

        $query = "INSERT INTO " . $this->table_name . " 
                  SET username=:username, fullname=:fullname, password=:password, 
                      email=:email, phone=:phone, address=:address, role=:role";
        $stmt = $this->conn->prepare($query);

        // Chống XSS và SQL Injection
        $username = htmlspecialchars(strip_tags($username));
        $fullName = htmlspecialchars(strip_tags($fullName));
        $email = htmlspecialchars(strip_tags($email));
        $phone = htmlspecialchars(strip_tags($phone));
        $address = htmlspecialchars(strip_tags($address));
        $role = htmlspecialchars(strip_tags($role));
        
        // ĐÃ BỎ DÒNG PASSWORD_HASH Ở ĐÂY VÌ CONTROLLER ĐÃ MÃ HÓA RỒI

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":fullname", $fullName);
        $stmt->bindParam(":password", $password); // Nhận trực tiếp password đã mã hóa từ Controller
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":role", $role);

        return $stmt->execute();
    }
}
?>