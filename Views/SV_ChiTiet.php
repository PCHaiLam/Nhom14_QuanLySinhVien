<?php 
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../Controllers/SinhVienController.php';

$svController = new SinhVienController($conn);

//lấy mã sinh viên
$maSV = isset($_GET['MaSV']) ? $_GET['MaSV'] : null;
$sinhvien = $svController->ChiTietSinhVien($maSV);

//xóa sinh viên
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy mã sinh viên từ dữ liệu POST
    $maSVxoa = $_POST['MaSV'];

    // Gọi phương thức xóa sinh viên từ controller
    if ($svController->XoaSinhVien($maSVxoa)) {
        // Xóa thành công, điều hướng quay lại list sinh viên
        header("Location: SV_DS.php");
        exit;
    } else {
        $message = "Xóa không thành công";
    }
}


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
                <a href="SV_Diem.php?MaSV=<?php echo $sinhvien['MaSV']; ?>"  title="Điểm">
                    <i class="fa-solid fa-square-poll-horizontal text-5xl text-green-500 hover:text-green-600"></i>
                </a>
                <a href="SV_ChinhSua.php?MaSV=<?php echo $sinhvien['MaSV']; ?>" title="Chỉnh sửa">
                    <i class="fa-solid fa-circle-info text-5xl text-blue-500 hover:text-blue-600"></i>
                </a>
                <!-- Nút mở modal -->
                <button 
                    class="text-5xl text-red-500 hover:text-red-600" 
                    onclick="openModal()">
                    <i class="fa-solid fa-trash"></i>
                </button>

            </div>
            <!-- Modal -->
            <div id="confirmModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg">
                    <h2 class="text-xl font-bold mb-4">Xác nhận xóa</h2>
                    <p class="mb-6">Bạn có chắc chắn muốn xóa sinh viên này không?</p>
                    <div class="flex justify-end space-x-4">
                        <button class="bg-gray-300 px-4 py-2 rounded" onclick="closeModal()">Hủy</button>
                        <form method="POST" action="">
                            <input type="hidden" name="MaSV" value="<?php echo $maSV; ?>">
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
<script>
    function openModal() {
        document.getElementById('confirmModal').classList.remove('hidden'); // Hiện modal
    }

    function closeModal() {
        document.getElementById('confirmModal').classList.add('hidden'); // Ẩn modal
    }
</script>
<?php include_once __DIR__ . "/../layout/footer.php"; ?>
