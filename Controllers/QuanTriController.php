<?php
class QuanTriController {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function login($taikhoan, $password) {
        $sql = "SELECT * FROM quantri WHERE TaiKhoan = '$taikhoan' AND MatKhau = '$password'";
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            // Đăng nhập thành công
            $row = $result->fetch_assoc();
            
            $_SESSION['user'] = $row;
            $_SESSION['HoTen'] = $row['HoTen'];
            
            // Kiểm tra quyền và chuyển hướng phù hợp
            if ($row['Quyen'] == '1') {
                header('Location: Views/QuanTri/Dashboard.php');
            } else if ($row['Quyen'] == '0') {
                header('Location: Views/SinhVien/Dashboard.php');
            }
            exit;
        } else {
            // Đăng nhập thất bại
            $_SESSION['login_error'] = "Đăng nhập thất bại!";
            header('Location: index.php'); // Quay lại trang đăng nhập
            exit;
        }
    }
    

    public function logout() {
        session_destroy();
        header('Location: index.php'); // Chuyển hướng về trang login sau khi đăng xuất
        exit;
    }
}
?>
