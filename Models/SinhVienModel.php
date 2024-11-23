<?php 
class SinhVienModel {
    protected $MaSV;
    protected $HoTen;
    protected $NgaySinh;
    protected $GioiTinh;
    protected $DiaChi;
    protected $Email;
    protected $Sdt;
    protected $AnhSV;
    protected $MaLop;

    public function __construct($maSV, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $sdt, $anhSV, $maLop) {
        $this->MaSV = $maSV;
        $this->HoTen = $hoTen;
        $this->NgaySinh = $ngaySinh;
        $this->GioiTinh = $gioiTinh;
        $this->DiaChi = $diaChi;
        $this->Email = $email;
        $this->Sdt = $sdt;
        $this->AnhSV = $anhSV;
        $this->MaLop = $maLop;
    }

    // Phương thức get
    public function getMaSV() {
        return $this->MaSV;
    }

    public function getHoTen() {
        return $this->HoTen;
    }

    public function getNgaySinh() {
        return $this->NgaySinh;
    }

    public function getGioiTinh() {
        return $this->GioiTinh;
    }

    public function getDiaChi() {
        return $this->DiaChi;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getSdt() {
        return $this->Sdt;
    }
    public function getAnhSV() {
        return $this->AnhSV;
    }

    public function getLop($conn) {
        $sql = "SELECT * FROM lop WHERE id = '$this->MaLop'";
        $result = $conn->query($sql);
        $Lop = $result->fetch_assoc();
        return $Lop['TenLop'];
    }

    // Phương thức set
    public function setMaSV($maSV) {
        $this->MaSV = $maSV;
    }

    public function setHoTen($hoTen) {
        $this->HoTen = $hoTen;
    }

    public function setNgaySinh($ngaySinh) {
        $this->NgaySinh = $ngaySinh;
    }

    public function setGioiTinh($gioiTinh) {
        $this->GioiTinh = $gioiTinh;
    }

    public function setDiaChi($diaChi) {
        $this->DiaChi = $diaChi;
    }

    public function setEmail($email) {
        $this->Email = $email;
    }

    public function setSdt($sdt) {
        $this->Sdt = $sdt;
    }
    public function setAnhSV($anhSV) {
        $this->AnhSV = $anhSV;
    }
    public function setMaLop($maLop) {
        $this->MaLop = $maLop;
    }
}
?>
