<?php
class MonHocController {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function DanhSach() {
        $sql = "SELECT * FROM monhoc";
        $result = $this->conn->query($sql);
        
        return $result;
    }
    //tìm kiếm môn học
    public function TimKiem($search) {
        $sql = "SELECT * FROM monhoc WHERE MaHP LIKE '%$search%' 
                                        OR TenHP LIKE '%$search%'
                                        OR SoTinChi LIKE '%$search%'
                                        OR DonGia LIKE '%$search%'";
        $result = $this->conn->query($sql);
        
        return $result;
    }

    //lấy môn học với mã môn học
    public function ChiTietMonHoc($maMon)
    {
        $sql = "SELECT * FROM monhoc WHERE MaHP = '$maMon'";
        $result = $this->conn->query($sql);
        
        return $result->fetch_assoc();
    }
    
    // Hàm thêm sinh viên
    public function ThemMonHoc($maMon, $tenMon, $soTinChi, $donGia)
    {
        $sql = "INSERT INTO monhoc (MaHP, TenHP, SoTinChi, DonGia) VALUES ('$maMon', '$tenMon', '$soTinChi', '$donGia')";

        //kiểm tra nếu mã môn học đã tồn tại thì không thực hiện thêm môn học
        $check = "SELECT * FROM monhoc WHERE MaHP = '$maMon'";
        $result = $this->conn->query($check);
        if ($result->num_rows > 0) {
            return "Mã môn học đã tồn tại!";
        }

        //nếu thêm môn học thành công thì chuyển hướng về trang danh sách môn Học
        if ($this->conn->query($sql) === TRUE) {
            header("Location: MH_DS.php");
            exit;
        } else {
            return "Lỗi khi thêm môn học: " . $this->conn->error;
        }
    }
    // Hàm sửa môn học
    public function SuaMonHoc($maMH, $tenMonHoc, $soTC, $donGia)
    {
        $sql = "UPDATE monhoc SET TenHP='$tenMonHoc', SoTinChi='$soTC', DonGia='$donGia' WHERE MaHP='$maMH'";
        //nếu câu truy vấn thành công thì chuyển hướng về trang danh sách môn học
        if ($this->conn->query($sql) === TRUE) {
            header("Location: MH_DS.php");
            exit;
        } else {
            return "Lỗi khi sửa môn học: " . $this->conn->error;
        }
    }
    // Hàm xóa môn học
    public function XoaMonHoc($maMH)
    {
        $sql = "DELETE FROM monhoc WHERE MaHP='$maMH'";
        //nếu câu truy vấn thành công thì chuyển hướng về trang danh sách môn học
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>
