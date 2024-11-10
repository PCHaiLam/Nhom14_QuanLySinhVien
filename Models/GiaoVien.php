<?php 
class GiaoVien {
    protected $MaGV;
    protected $HoTen;
    protected $Email;

    // Hàm dựng
    public function __construct($maGV, $hoTen, $email) {
        $this->MaGV = $maGV;
        $this->HoTen = $hoTen;
        $this->Email = $email;
    }

    // Vùng các phương thức getter
    public function getMaGV() {
        return $this->MaGV;
    }

    public function getHoTen() {
        return $this->HoTen;
    }

    public function getEmail() {
        return $this->Email;
    }
}
?>
