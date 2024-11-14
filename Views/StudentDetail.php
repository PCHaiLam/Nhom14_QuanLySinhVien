<?php 
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../Controllers/SinhVienController.php';

$svController = new SinhVienController($conn);

//lấy mã sinh viên
$maSV = isset($_GET['MaSV']) ? $_GET['MaSV'] : null;
$sinhvien = $svController->ChiTietSinhVien($maSV);

?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>
<body>
    <div class="mx-4 mx-2 min-h-[565px]">
        <button onclick="window.history.back()" class="px-3 bg-gray-400 mt-2">Quay lại</button>
        <div class="w-1/2 h-[500px] mx-auto p-3 border-2 rounded-xl shadow">
            <h1>Chi tiết sinh viên</h1>
            <ul>
                <li><strong>Mã SV:</strong> <?php echo $sinhvien['MaSV']; ?></li>
                <li><strong>Họ tên:</strong> <?php echo $sinhvien['HoTen']; ?></li>
                <li><strong>Ngày sinh:</strong> <?php echo $sinhvien['NgaySinh']; ?></li>
                <li><strong>Giới tính:</strong> <?php echo $sinhvien['GioiTinh']; ?></li>
                <li><strong>Địa chỉ:</strong> <?php echo $sinhvien['DiaChi']; ?></li>
                <li><strong>Email:</strong> <?php echo $sinhvien['Email']; ?></li>
                <li><strong>Số điện thoại:</strong> <?php echo $sinhvien['SDT']; ?></li>
                <li><strong>Lớp:</strong> <?php echo $sinhvien['MaLop']; ?></li>
                <li><strong>Ảnh:</strong> <img src="<?php echo '../asset/Images/' . $sinhvien['AnhSV']; ?>" alt="Student Image" width="100" height="100"></li>
            </ul>
            <div class="flex justify-around items-center p-2">
                <a href="EditStudent.php?MaSV=<?php echo $sinhvien['MaSV']; ?>" title="Chỉnh sửa">
                    <img src="../asset/Images/edit.png" class="h-12"/>
                </a>
                <a href="DeleteStudent.php" title="Xóa">
                    <img src="../asset/Images/delete.png" class="h-12"/>
                </a>
            </div>
        </div>
    </div>
</body>
<?php include_once __DIR__ . "/../layout/footer.php"; ?>
