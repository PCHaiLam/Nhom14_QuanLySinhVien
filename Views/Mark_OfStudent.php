<?php 
@session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../Controllers/SinhVien_LopHocPhanController.php';

$sv_lhpController = new SinhVien_LopHocPhanController($conn);

$maSV = isset($_GET['MaSV']) ? $_GET['MaSV'] : null;

$markList = $sv_lhpController->DanhSachDiem($maSV);

if ($markList && $markList->num_rows > 0): 
    $currentYearSemester = '';

    while($row = $markList->fetch_assoc()):
        $yearSemester = $row['MaHocKi'];

        // Bắt đầu một bảng mới khi gặp một học kỳ mới
        if ($yearSemester != $currentYearSemester) {
            // Đóng bảng trước đó nếu không phải lần đầu
            if ($currentYearSemester != '') echo "</table><br>";
            
            // Bắt đầu bảng mới cho học kỳ hiện tại
            echo "<strong>$yearSemester:</strong>";
            echo "<table border='1' cellpadding='8' cellspacing='0'>";
            echo "<tr><th>Môn học</th><th>Điểm</th></tr>";
            
            // Cập nhật học kỳ hiện tại
            $currentYearSemester = $yearSemester;
        }

        // Hiển thị tên môn và điểm
        echo "<tr>";
        echo "<td>" . $row['MaLopHocPhan'] . "</td>";
        echo "<td>" . (is_null($row['Diem']) ? "N/A" : $row['Diem']) . "</td>";
        echo "</tr>";
    endwhile;

    // Đóng bảng cuối cùng
    echo "</table>";
else:
    echo "<p>Không có kết quả nào.</p>";
endif;
?>