<?php
class Lop {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Hàm hiển thị danh sách sinh viên
    public function DanhSach() {
        $sql = "SELECT * FROM lop";
        $result = $this->conn->query($sql);
    
        return $result;
    }
    public function DanhSachId($maKhoa) { 
        if ($maKhoa != 'allKhoa') { 
            $sql = "SELECT * FROM lop WHERE MaKhoa = '$maKhoa'"; 
        } else { 
            $sql = "SELECT * FROM lop"; 
        } 
        return $this->conn->query($sql); 
    }
}
?>
