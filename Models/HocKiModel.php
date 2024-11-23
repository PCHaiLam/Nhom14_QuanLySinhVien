<?php 
class HocKiModel {
    protected $MaHocKi;
    protected $TenHocKi;
    protected $NgayBatDau;
    protected $NgayKetThuc;

    // Hàm dựng
    public function __construct($maHocKi, $tenHocKi, $ngayBatDau, $ngayKetThuc) {
        $this->MaHocKi = $maHocKi;
        $this->TenHocKi = $tenHocKi;
        $this->NgayBatDau = $ngayBatDau;
        $this->NgayKetThuc = $ngayKetThuc;
    }

    // Vùng các phương thức getter
    public function getMaHocKi() {
        return $this->MaHocKi;
    }

    public function getTenHocKi() {
        return $this->TenHocKi;
    }

    public function getNgayBatDau() {
        return $this->NgayBatDau;
    }

    public function getNgayKetThuc() {
        return $this->NgayKetThuc;
    }
}
?>
