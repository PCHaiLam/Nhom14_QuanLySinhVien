<?php
class LopHocPhanController {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Hàm hiển thị danh sách LHP cụ thể là tên môn học, tên giáo viên, tên lớp
    public function DanhSach() {
        //hãy lấy dữ liệu trong các bảng kết nối với lophocphan 

        $sql = "SELECT lhp.MaLopHocPhan, mh.TenHP, ph.DiaDiem, gv.HoTen, l.MaLop FROM lophocphan lhp
                JOIN monhoc mh ON lhp.MaMonHoc = mh.MaHP
                JOIN giaovien gv ON lhp.MaGV = gv.MaGV
                JOIN lop l ON lhp.MaLop = l.MaLop
                JOIN phonghoc ph ON lhp.DiaDiem = ph.DiaDiem
                
                ";
        $result = $this->conn->query($sql);
    
        return $result;
    }
    // Hàm tìm kiếm LHP
    public function TimKiem($search) {
        $sql = "SELECT lhp.MaLopHocPhan, mh.TenHP, ph.DiaDiem, gv.HoTen, l.MaLop FROM lophocphan lhp
                JOIN monhoc mh ON lhp.MaMonHoc = mh.MaHP
                JOIN giaovien gv ON lhp.MaGV = gv.MaGV
                JOIN lop l ON lhp.MaLop = l.MaLop
                JOIN phonghoc ph ON lhp.DiaDiem = ph.DiaDiem
                WHERE mh.TenHP LIKE '%$search%' OR gv.HoTen LIKE '%$search%' OR l.MaLop LIKE '%$search%'
                ";
        $result = $this->conn->query($sql);
    
        return $result;
    }
    //Hàm thêm mới LHP
    public function ThemLHP($maHP, $maMH, $diaDiem, $giaoVien, $maLop) {
        $sql = "INSERT INTO lophocphan (MaLopHocPhan, MaMonHoc, DiaDiem, MaGV, MaLop) VALUES ('$maHP', '$maMH', '$diaDiem', '$giaoVien', '$maLop')";

        $check = "SELECT * FROM monhoc WHERE MaHP = '$maHP'";
        $result = $this->conn->query($check);
        if ($result->num_rows > 0) {
            return "Mã LHP đã tồn tại!";
        }

        if ($this->conn->query($sql) === TRUE) {
            header("Location: LHP_DS.php");
            exit;
        } else {
            return "Thêm lớp học phần thất bại";
        }
    }
    //Hàm tạo mã LHP tự động: ghép mã môn học + mã lớp bằng dấu _
    public function TaoMaLHP($maHP, $maLop) {
        return $maHP . "_" . $maLop;
    }
}
?>
