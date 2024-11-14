<?php 
class SinhVien_LopHocPhanController{
    protected $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    // Hàm hiển thị danh sách sinh viên
    public function DanhSachDiem($maSV)
    {
        $sql = "SELECT MaHocKi, MaLopHocPhan, Diem
                FROM sinhvien_lophocphan 
                WHERE MaSV = $maSV
                ORDER BY MaHocKi";
        $result = $this->conn->query($sql);

        return $result;
    }
}
?>