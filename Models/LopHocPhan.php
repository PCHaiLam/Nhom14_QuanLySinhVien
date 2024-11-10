<?php 
class LopHocPhan {
    protected $MaLopHocPhan;
    protected $MaMonHoc;
    protected $DiaDiem;
    protected $MaGiaovien;

    // Hàm dựng
    public function __construct($maLopHocPhan, $maMonHoc, $diaDiem, $maGiaovien) {
        $this->MaLopHocPhan = $maLopHocPhan;
        $this->MaMonHoc = $maMonHoc;
        $this->DiaDiem = $diaDiem;
        $this->MaGiaovien = $maGiaovien;
    }

    // Vùng các phương thức getter
    public function getMaLopHocPhan() {
        return $this->MaLopHocPhan;
    }

    public function getMaMonHoc($conn) {
        $sql = "SELECT * FROM monhoc WHERE id = '$this->MaMonHoc'";
        $result = $conn->query($sql);
        $monhoc = $result->fetch_assoc();
        return $monhoc['TenHP'];
    }

    public function getDiaDiem() {
        return $this->DiaDiem;
    }

    public function getMaGiaovien($conn) {
        $sql = "SELECT * FROM giaovien WHERE id = '$this->MaGiaovien'";
        $result = $conn->query($sql);
        $giaovien = $result->fetch_assoc();
        return $giaovien['HoTen'];
    }

    // Vùng các phương thức setter
    public function setMaLopHocPhan($maLopHocPhan) {
        $this->MaLopHocPhan = $maLopHocPhan;
    }

    public function setMaMonHoc($maMonHoc) {
        $this->MaMonHoc = $maMonHoc;
    }

    public function setDiaDiem($diaDiem) {
        $this->DiaDiem = $diaDiem;
    }

    public function setMaGiaovien($maGiaovien) {
        $this->MaGiaovien = $maGiaovien;
    }
}
?>
