<?php
class MonHocController {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function DanhSach($currentPage, $limit) {
        // Tính toán offset
        $offset = ($currentPage - 1) * $limit;
    
        // Truy vấn lấy dữ liệu môn học với phân trang
        $sql = "SELECT * FROM monhoc LIMIT $limit OFFSET $offset";
        $result = $this->conn->query($sql);
        
        return $result;
    }
    

    //Tính tổng sinh viên để phân trang
    public function countMonHoc()
    {
        $sql = "SELECT COUNT(*) as total FROM monhoc";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();

        return $row['total'];
    }
}
?>
