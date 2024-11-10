<?php 
class Nganh {
    protected $MaNganh;
    protected $TenNganh;

    public function __construct($maNganh, $tenNganh) {
        $this->MaNganh = $maNganh;
        $this->TenNganh = $tenNganh;
    }
    
    public function setMaNganh($maNganh) {
        $this->MaNganh = $maNganh;
    }

    public function getTenNganh() {
        return $this->TenNganh;
    }
}
?>
