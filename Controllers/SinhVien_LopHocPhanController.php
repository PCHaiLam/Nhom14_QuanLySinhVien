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
        $sql = " SELECT svlhp.MaHocKi, mh.MaHP, mh.TenHP, mh.SoTinChi, svlhp.Diem
                FROM sinhvien_lophocphan svlhp
                JOIN lophocphan lhp
                ON svlhp.MaLopHocPhan = lhp.MaLopHocPhan
                JOIN monhoc mh
                ON lhp.MaMonHoc = mh.MaHP
                WHERE svlhp.MaSV = $maSV
                ORDER BY svlhp.MaHocKi";
        $result = $this->conn->query($sql);

        return $result;
    }
}
?>