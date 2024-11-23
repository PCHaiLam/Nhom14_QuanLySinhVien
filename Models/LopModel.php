<?php
class LopModel {
    protected $MaLop;
    protected $TenLop;
    protected $MaNganh;

    // Hàm dựng
    public function __construct($maLop, $tenLop, $maNganh) {
        $this->MaLop = $maLop;
        $this->TenLop = $tenLop;
        $this->MaNganh = $maNganh;
    }

    // Vùng các phương thức getter
    public function getMaLop() {
        return $this->MaLop;
    }

    public function getTenLop() {
        return $this->TenLop;
    }

    public function getMaNganh($conn) {
        $sql = "SELECT * FROM nganh WHERE id = '$this->MaNganh'";
        $result = $conn->query($sql);
        $nganh = $result->fetch_assoc();
        return $nganh['TenNganh'];
    }
}
?>
