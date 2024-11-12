<?php
class SinhVien
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
    // Hàm thêm sinh viên
    public function ThemSinhVien($maSV, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $sdt, $anhSV, $maLop)
    {
        $sql = "INSERT INTO sinhvien (MaSV, HoTen, NgaySinh, GioiTinh, DiaChi, Email, Sdt, AnhSV, MaLop) VALUES ('$maSV', '$hoTen', '$ngaySinh', '$gioiTinh', '$diaChi', '$email', '$sdt', '$anhSV', '$maLop')";

        if ($this->conn->query($sql) === TRUE) {
            echo "Thêm sinh viên thành công.";
        } else {
            echo "Lỗi khi thêm sinh viên: " . $this->conn->error;
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
    public function SuaSinhVien($maSV, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $sdt, $maLop)
    {
        $sql = "UPDATE sinhvien SET HoTen='$hoTen', NgaySinh='$ngaySinh', GioiTinh='$gioiTinh', DiaChi='$diaChi', Email='$email', Sdt='$sdt', MaLop='$maLop' WHERE MaSV='$maSV'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Sửa sinh viên thành công.";
        } else {
            echo "Lỗi khi sửa sinh viên: " . $this->conn->error;
        }
    }
    // Hàm xóa sinh viên
    public function XoaSinhVien($maSV)
    {
        $sql = "DELETE FROM sinhvien WHERE MaSV='$maSV'";

        if ($this->conn->query($sql) === TRUE) {
            echo "Xóa sinh viên thành công.";
        } else {
            echo "Lỗi khi xóa sinh viên: " . $this->conn->error;
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