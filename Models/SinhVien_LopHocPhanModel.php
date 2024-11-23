<?php
class SinhVien_LopHocPhanModel {
    protected $MaSinhVien;
    protected $MaLopHocPhan;
    protected $MaHocKi;
    protected $Diem;
    protected $NgayDongHocPhi;

    public function __construct($maSinhVien, $maLopHocPhan, $maHocKi, $diem, $ngayDongHocPhi) {
        $this->MaSinhVien = $maSinhVien;
        $this->MaLopHocPhan = $maLopHocPhan;
        $this->MaHocKi = $maHocKi;
        $this->Diem = $diem;
        $this->NgayDongHocPhi = $ngayDongHocPhi;
    }

    // Vùng các phương thức getter
    public function getMaSinhVien($conn) {
        $sql = "SELECT * FROM sinhvien WHERE id = '$this->MaSinhVien'";
        $result = $conn->query($sql);
        $sinhvien = $result->fetch_assoc();
        return $sinhvien['HoTen'];
    }

    public function getMaLopHocPhan($conn) {
        $sql = "SELECT * FROM lophocphan WHERE id = '$this->MaLopHocPhan'";
        $result = $conn->query($sql);
        $lophocphan = $result->fetch_assoc();
        return $lophocphan['MaLopHocPhan'];
    }

    public function getMaHocKi($conn) {
        $sql = "SELECT * FROM hocki WHERE id = '$this->MaHocKi'";
        $result = $conn->query($sql);
        $hocki = $result->fetch_assoc();
        return $hocki['TenHocKi'];
    }

    public function getDiem() {
        return $this->Diem;
    }

    public function getNgayDongHocPhi() {
        return $this->NgayDongHocPhi;
    }

    // Vùng các phương thức setter
    public function setMaSinhVien($maSinhVien) {
        $this->MaSinhVien = $maSinhVien;
    }

    public function setMaLopHocPhan($maLopHocPhan) {
        $this->MaLopHocPhan = $maLopHocPhan;
    }

    public function setMaHocKi($maHocKi) {
        $this->MaHocKi = $maHocKi;
    }

    public function setDiem($diem) {
        $this->Diem = $diem;
    }

    public function setNgayDongHocPhi($ngayDongHocPhi) {
        $this->NgayDongHocPhi = $ngayDongHocPhi;
    }
}
?>
