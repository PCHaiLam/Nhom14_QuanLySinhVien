<?php
class SinhVienController
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    // Hàm hiển thị danh sách sinh viên
    public function DanhSach($page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM sinhvien LIMIT $offset, $limit";
        $result = $this->conn->query($sql);

        return $result;
    }
    // Hàm tìm kiếm sinh viên theo MaKhoa và MaLop 
    public function timKiem($maKhoa = null, $maLop = null)
    {
        $sql = "SELECT sinhvien.* FROM sinhvien 
                INNER JOIN lop ON sinhvien.MaLop = lop.MaLop
                INNER JOIN khoa ON lop.MaKhoa = khoa.MaKhoa";
        
        $dieukien = array();
        if (!empty($maKhoa) && $maKhoa !== "allKhoa") {
            $dieukien[] = "khoa.MaKhoa = '$maKhoa'";
        }
        if (!empty($maLop)) {
            $dieukien[] = "sinhvien.MaLop = '$maLop'";
        }
        
        if (count($dieukien) > 0) {
            $sql .= " WHERE " . implode(' AND ', $dieukien);
        }

        $result = $this->conn->query($sql);
        return $result;
    }
     public function TaoMaSoSinhVien($maLop) {
        $sqlMaKhoa = "SELECT MaKhoa FROM lop WHERE MaLop = '$maLop'";
        $resultMaKhoa = $this->conn->query($sqlMaKhoa);
        $rowKhoa = $resultMaKhoa->fetch_assoc();
        $maKhoa = $rowKhoa['MaKhoa'];

        // Lấy 2 ký tự đầu (năm hiện tại - năm thành lập trường)
        $namHienTai = date("Y");
        $namThanhLap = 1959;
        $prefixNam = str_pad($namHienTai - $namThanhLap, 2, "0", STR_PAD_LEFT); // VD: 65

        // Lấy 2 ký tự đầu của mã khoa
        $prefixKhoa = explode('-', $maKhoa)[0]; // VD: 01,02,...

        // Lấy 4 ký tự cuối (mã SV cao nhất hiện tại + 1)
        $sql = "SELECT MaSV FROM sinhvien WHERE MaSV LIKE '$prefixNam$prefixKhoa%' ORDER BY MaSV DESC LIMIT 1";
        $result = $this->conn->query($sql);
        $nextId = "0001"; // Mặc định mã mới bắt đầu từ 0001
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastMaSV = $row['MaSV']; // VD: 65010001
            $currentId = substr($lastMaSV, -4); // Lấy 4 ký tự cuối
            $nextId = str_pad($currentId + 1, 4, "0", STR_PAD_LEFT); // Tăng 1, bổ sung thêm 0 nếu cần
        }

        return $prefixNam . $prefixKhoa . $nextId; // 
    }


    // Hàm thêm sinh viên
    public function ThemSinhVien($maSV, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $sdt, $anhSV, $maLop)
    {
        $sql = "INSERT INTO sinhvien (MaSV, HoTen, NgaySinh, GioiTinh, DiaChi, Email, Sdt, AnhSV, MaLop) VALUES ('$maSV', '$hoTen', '$ngaySinh', '$gioiTinh', '$diaChi', '$email', '$sdt', '$anhSV', '$maLop')";

        if ($this->conn->query($sql) === TRUE) {
            header("Location: QuanLyThongTinSinhVien.php");
            exit;
        } else {
            return "Thêm sinh viên thất bại: " . $this->conn->error;
        }
    }
    // Hàm xóa sinh viên
    public function ChiTietSinhVien($maSV)
    {
        $sql = "SELECT * FROM sinhvien WHERE MaSV='$maSV'";
        $result =  $this->conn->query($sql);
        return $result->fetch_assoc();
    }
    // Hàm sửa sinh viên
    public function SuaSinhVien($maSV, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $sdt, $fileName)
    {
        $sql = "UPDATE sinhvien SET HoTen='$hoTen', NgaySinh='$ngaySinh', GioiTinh='$gioiTinh', DiaChi='$diaChi', Email='$email', Sdt='$sdt', AnhSV='$fileName' WHERE MaSV='$maSV'";

        if ($this->conn->query($sql) === TRUE) {
            return "Sửa sinh viên thành công.";
        } else {
            return "Lỗi khi sửa sinh viên: " . $this->conn->error;
        }
    }
    // Hàm xóa sinh viên
    public function XoaSinhVien($maSV)
    {
        $sql = "DELETE FROM sinhvien WHERE MaSV='$maSV'";

        if ($this->conn->query($sql) === TRUE) {
            return "Xóa sinh viên thành công.";
        } else {
            return "Lỗi khi xóa sinh viên: " . $this->conn->error;
        }
    }
    //Tính tổng sinh viên để phân trang
    public function countSinhVien()
    {
        $sql = "SELECT COUNT(*) as total FROM sinhvien";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();

        return $row['total'];
    }
    //Phân trang và thanh điều hướng trang
    function PhanTrang($tongBanGhi, $currentPage, $limit)
    {
        $totalPages = ceil($tongBanGhi / $limit);
        $pagination = "";

        if ($totalPages > 1) {
            $pagination .= '<div class="pagination">';
            // Trang trước
            if ($currentPage > 1) {
                $pagination .= '<a href="?page=' . ($currentPage - 1) . '">&laquo;</a>';
            }
            // Liên kết trang
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $currentPage) {
                    $pagination .= '<span class="current-page">' . $i . '</span>';
                } else {
                    $pagination .= '<a href="?page=' . $i . '">' . $i . '</a>';
                }
            }
            // Trang sau
            if ($currentPage < $totalPages) {
                $pagination .= '<a href="?page=' . ($currentPage + 1) . '">&raquo;</a>';
            }

            $pagination .= '</div>';
        }
        return $pagination;
    }
}
?>