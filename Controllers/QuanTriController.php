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
            $quyen = $row['Quyen'];

            $_SESSION['session_time'] = time();
            // $_SESSION['limit_session_time'] = time() + 20*60;
            $_SESSION['limit_session_time'] = time() + 5;
            
            // Tùy vào quyền của người dùng, gọi hàm lấy thông tin tương ứng
            if ($quyen == '0') {
                $userInfo = $this->getQuanTriInfo($taikhoan);
                $_SESSION['User'] = $userInfo;
                return 0;
            } else if ($quyen == '1') {
                $userInfo = $this->getGiaoVienInfo($taikhoan);
                $_SESSION['User'] = $userInfo;
                return 1;
            } else if ($quyen == '2') {
                $userInfo = $this->getSinhVienInfo($taikhoan);
                $_SESSION['User'] = $userInfo;
                return 2;
            }
        } else {
            return -1;
        }
    }
    public function CheckSession() {
        // Kiểm tra nếu session chưa được khởi tạo hoặc session đã hết hạn
        if (!isset($_SESSION['session_time']) || time() > $_SESSION['limit_session_time']) {
            // Gọi hàm logout nếu session đã hết hạn
            $this->logout();
        }
    }
    
    // Hàm lấy thông tin cho quản trị viên
    private function getQuanTriInfo($taikhoan) {
        $sql = "SELECT TaiKhoan as HoTen FROM quantri WHERE TaiKhoan = '$taikhoan'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
    
    // Hàm lấy thông tin cho giáo viên
    private function getGiaoVienInfo($taikhoan) {
        $sql = "SELECT HoTen FROM giaovien WHERE MaGV = '$taikhoan'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
    
    // Hàm lấy thông tin cho sinh viên
    private function getSinhVienInfo($taikhoan) {
        $sql = "SELECT HoTen FROM sinhvien WHERE MaSV = '$taikhoan'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
    
    public function logout() {
        session_unset();
        session_destroy();
        return true;
    }
}
?>
