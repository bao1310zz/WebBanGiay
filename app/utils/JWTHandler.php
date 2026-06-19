<?php
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class JWTHandler
{
    private $secret_key;

    public function __construct()
    {
        $this->secret_key = "CONGAHONGOCBAOQUAGAQUANONVABAODONGDOI"; 
    }

    // Tạo mã Token khi đăng nhập thành công
    public function encode($data)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // Token có hạn 1 tiếng

        $payload = array(
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'data' => $data
        );

        return JWT::encode($payload, $this->secret_key, 'HS256');
    }

    // Giải mã và kiểm tra Token khi có người gọi API
    public function decode($jwt)
    {
        try {
            $decoded = JWT::decode($jwt, new Key($this->secret_key, 'HS256'));
            return (array) $decoded->data;
        } catch (Exception $e) {
            return null; // Token sai hoặc hết hạn
        }
    }
}
?>
    