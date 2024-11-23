<?php 
class QuanTriModel {
    protected $Email;
    protected $Admin;
    protected $Ten;
    protected $MatKhau;

    // Hàm dựng
    public function __construct($email, $admin, $ten, $matKhau) {
        $this->Email = $email;
        $this->Admin = $admin;
        $this->Ten = $ten;
        $this->MatKhau = $matKhau;
    }

    // Vùng các phương thức getter
    public function getEmail() {
        return $this->Email;
    }

    public function getAdmin() {
        return $this->Admin;
    }

    public function getTen() {
        return $this->Ten;
    }

    public function getMatKhau() {
        return $this->MatKhau;
    }
}
?>
