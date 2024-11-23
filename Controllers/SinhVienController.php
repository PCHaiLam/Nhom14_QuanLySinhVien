<?php
class SinhVienController
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    // Hàm hiển thị danh sách sinh viên
    public function DanhSach($currentPage, $limit)
    {
        $offset = ($currentPage - 1) * $limit;
        $sql = "SELECT * FROM sinhvien LIMIT $limit OFFSET $offset";
        $result = $this->conn->query($sql);

        return $result;
    }
    public function timKiem($maKhoa, $maLop, $search)
    {
        $sql = "SELECT sinhvien.* FROM sinhvien 
                INNER JOIN lop ON sinhvien.MaLop = lop.MaLop
                INNER JOIN khoa ON lop.MaKhoa = khoa.MaKhoa
                WHERE (khoa.MaKhoa = '$maKhoa' OR '$maKhoa' = '')
                    AND (lop.MaLop = '$maLop' OR '$maLop' = '')
                    AND (sinhvien.MaSV LIKE '%$search%'
                        OR sinhvien.HoTen LIKE '%$search%'
                        or sinhvien.Email LIKE '%$search%'
                        OR sinhvien.Sdt LIKE '%$search%'
                        OR sinhvien.DiaChi LIKE '%$search%'
                        OR sinhvien.NgaySinh LIKE '%$search%'
                        OR sinhvien.GioiTinh LIKE '%$search%')";
        $result = $this->conn->query($sql);

        return $result;
    }
    // Hàm thêm sinh viên
    public function ThemSinhVien($maSV, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $sdt, $anhSV, $maLop)
    {
        $sql = "INSERT INTO sinhvien (MaSV, HoTen, NgaySinh, GioiTinh, DiaChi, Email, Sdt, AnhSV, MaLop) VALUES ('$maSV', '$hoTen', '$ngaySinh', '$gioiTinh', '$diaChi', '$email', '$sdt', '$anhSV', '$maLop')";

        if ($this->conn->query($sql) === TRUE) {
            header("Location: SV_DS.php");
            exit;
        } else {
            return "Thêm sinh viên thất bại: " . $this->conn->error;
        }
    }
    // Hàm chi tiết sinh viên
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
            return true;
        } else {
            return false;
        }
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
    public function EmailTuDong($hoTen, $maLop) {
        // Hàm loại bỏ dấu tiếng Việt thủ công
        function removeVietnameseAccents($str) {
            $vietnameseAccents = array(
                'à', 'á', 'ả', 'ã', 'ạ', 'â', 'ầ', 'ấ', 'ẩ', 'ẫ', 'ậ', 'ă', 'ằ', 'ắ', 'ẳ', 'ẵ', 'ặ',
                'è', 'é', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ề', 'ế', 'ể', 'ễ', 'ệ',
                'ì', 'í', 'ỉ', 'ĩ', 'ị',
                'ò', 'ó', 'ỏ', 'õ', 'ọ', 'ô', 'ồ', 'ố', 'ổ', 'ỗ', 'ộ', 'ơ', 'ờ', 'ớ', 'ở', 'ỡ', 'ợ',
                'ù', 'ú', 'ủ', 'ũ', 'ụ', 'ư', 'ừ', 'ứ', 'ử', 'ữ', 'ự',
                'ỳ', 'ý', 'ỷ', 'ỹ', 'ỵ',
                'đ',
                'À', 'Á', 'Ả', 'Ã', 'Ạ', 'Â', 'Ầ', 'Ấ', 'Ẩ', 'Ẫ', 'Ậ', 'Ă', 'Ằ', 'Ắ', 'Ẳ', 'Ẵ', 'Ặ',
                'È', 'É', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ề', 'Ế', 'Ể', 'Ễ', 'Ệ',
                'Ì', 'Í', 'Ỉ', 'Ĩ', 'Ị',
                'Ò', 'Ó', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ồ', 'Ố', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ờ', 'Ớ', 'Ở', 'Ỡ', 'Ợ',
                'Ù', 'Ú', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ừ', 'Ứ', 'Ử', 'Ữ', 'Ự',
                'Ỳ', 'Ý', 'Ỷ', 'Ỹ', 'Ỵ',
                'Đ'
            );
    
            $nonAccented = array(
                'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
                'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
                'i', 'i', 'i', 'i', 'i',
                'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
                'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
                'y', 'y', 'y', 'y', 'y',
                'd',
                'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A',
                'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E',
                'I', 'I', 'I', 'I', 'I',
                'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O',
                'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U',
                'Y', 'Y', 'Y', 'Y', 'Y',
                'D'
            );
    
            return str_replace($vietnameseAccents, $nonAccented, $str);
        }
    
        // Tách họ tên thành các từ và loại bỏ dấu
        $tenPart = explode(" ", trim($hoTen));
        foreach ($tenPart as &$part) {
            $part = strtolower(removeVietnameseAccents($part));
        }
    
        // Lấy phần tên (phần cuối cùng trong họ tên)
        $ten = array_pop($tenPart);
    
        // Lấy ký tự đầu tiên của từng phần còn lại (họ và tên đệm)
        $hoTenDem = "";
        foreach ($tenPart as $part) {
            $hoTenDem .= substr($part, 0, 1);
        }
    
        // Tạo tiền tố năm
        $namHienTai = date("Y");
        $namThanhLap = 1959;
        $prefixNam = str_pad($namHienTai - $namThanhLap, 2, "0", STR_PAD_LEFT);
    
        $sql = "SELECT MaKhoa FROM lop WHERE MaLop = '$maLop'";
        $result = $this->conn->query($sql);

        $nganh="";
        // Kiểm tra nếu kết quả tồn tại và lấy giá trị MaKhoa
        if ($result && $row = $result->fetch_assoc()) {
            $maKhoa = $row['MaKhoa']; // Lấy mã khoa từ kết quả truy vấn
            // Tách mã ngành từ mã khoa dựa trên dấu "-"
            $nganh = strtolower(explode("-", $maKhoa)[1]);
        }
    
        // Tạo email theo định dạng

        $email = "{$ten}.{$hoTenDem}.{$prefixNam}{$nganh}@ntu.edu.vn";
    
        return $email;
    }
    //Tính tổng sinh viên để phân trang
    public function countMonHoc()
    {
        $sql = "SELECT COUNT(*) as total FROM sinhvien";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();

        return $row['total'];
    }
}
?>