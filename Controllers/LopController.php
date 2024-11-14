<?php
class LopController {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function DanhSach() {
        $sql = "SELECT * FROM lop";
        $result = $this->conn->query($sql);
    
        return $result;
    }
    public function DanhSachId($maKhoa) { 
            $sql = "SELECT * FROM lop WHERE MaKhoa = '$maKhoa'"; 
        return $this->conn->query($sql); 
    }
}
?>
