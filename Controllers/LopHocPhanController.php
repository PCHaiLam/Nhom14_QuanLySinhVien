<?php
class LopHocPhanController {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Hàm hiển thị danh sách sinh viên
    public function DanhSach() {
        $sql = "SELECT * FROM khoa";
        $result = $this->conn->query($sql);
    
        return $result;
    }
}
?>
