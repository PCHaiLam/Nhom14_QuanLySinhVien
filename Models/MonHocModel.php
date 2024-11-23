<?php 
class MonHocModel {
    protected $MaMon;
    protected $TenMon;
    protected $SoTinChi;
    protected $DonGia;

    public function __construct($maMon, $tenMon, $soTinChi, $donGia) {
        $this->MaMon = $maMon;
        $this->TenMon = $tenMon;
        $this->SoTinChi = $soTinChi;
        $this->DonGia = $donGia;
    }

    // Vùng các phương thức getter
    public function getMaMon() {
        return $this->MaMon;
    }

    public function getTenMon() {
        return $this->TenMon;
    }

    public function getSoTinChi() {
        return $this->SoTinChi;
    }

    public function getDonGia() {
        return $this->DonGia;
    }

    // Vùng các phương thức setter
    public function setMaMon($maMon) {
        $this->MaMon = $maMon;
    }

    public function setTenMon($tenMon) {
        $this->TenMon = $tenMon;
    }

    public function setSoTinChi($soTinChi) {
        $this->SoTinChi = $soTinChi;
    }

    public function setDonGia($donGia) {
        $this->DonGia = $donGia;
    }
}
?>
