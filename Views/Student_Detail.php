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
        <div class="w-1/2 h-[500px] flex flex-col justify-between mx-auto p-4 border-2 rounded-xl shadow">
            <ul class="grid grid-cols-4 items-center">
                <li><img src="<?php echo '../asset/Images/' . $sinhvien['AnhSV']; ?>" alt="Student Image" class="h-[150px]"></li>
                <div class="col-span-3 grid grid-cols-2 gap-4 min-h-[350px] items-center">
                    <li class="font-bold text-right">Mã sinh viên</li><li class="text-left"><?php echo $sinhvien['MaSV']; ?></li>
                    <li class="font-bold text-right">Họ tên</li><li class="text-left"><?php echo $sinhvien['HoTen']; ?></li>
                    <li class="font-bold text-right">Ngày sinh</li><li class="text-left"><?php echo $sinhvien['NgaySinh']; ?></li>
                    <li class="font-bold text-right">Giới tính</li><li class="text-left"><?php echo $sinhvien['GioiTinh']; ?></li>
                    <li class="font-bold text-right">Địa chỉ</li><li class="text-left"><?php echo $sinhvien['DiaChi']; ?></li>
                    <li class="font-bold text-right">Email</li><li class="text-left"><?php echo $sinhvien['Email']; ?></li>
                    <li class="font-bold text-right">Số điện thoại</li><li class="text-left"><?php echo $sinhvien['SDT']; ?></li>
                    <li class="font-bold text-right">Lớp</li><li class="text-left"><?php echo $sinhvien['MaLop']; ?></li>
                </div>
            </ul>
            <div class="flex justify-around items-center p-2">
                <a href="Mark_OfStudent.php?MaSV=<?php echo $sinhvien['MaSV']; ?>"  title="Điểm">
                    <i class="fa-solid fa-square-poll-horizontal text-5xl text-green-500 hover:text-green-600"></i>
                </a>
                <a href="Student_Edit.php?MaSV=<?php echo $sinhvien['MaSV']; ?>" title="Chỉnh sửa">
                    <i class="fa-solid fa-circle-info text-5xl text-blue-500 hover:text-blue-600"></i>
                </a>
                <a href="Student_Delete.php" title="Xóa">
                    <i class="fa-solid fa-trash text-5xl text-red-500 hover:text-red-600"></i>
                </a>
            </div>
        </div>
    </div>
</body>
<?php include_once __DIR__ . "/../layout/footer.php"; ?>
