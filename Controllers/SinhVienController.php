<?php
class SinhVien{
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function logout() {
        session_destroy();
        header('Location: index.php'); // Chuyển hướng về trang login sau khi đăng xuất
        exit;
    }
}
?>
