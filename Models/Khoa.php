<?php 
class Khoa {
    protected $MaKhoa;
    protected $TenKhoa;

    public function __construct($maKhoa, $tenKhoa) {
        $this->MaKhoa = $maKhoa;
        $this->TenKhoa = $tenKhoa;
    }
    
    public function setMaKhoa($maKhoa) {
        $this->MaKhoa = $maKhoa;
    }

    public function getTenKhoa() {
        return $this->TenKhoa;
    }
}
?>
