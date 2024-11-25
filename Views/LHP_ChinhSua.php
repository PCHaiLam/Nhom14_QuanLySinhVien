<?php
session_start();
require_once __DIR__ . '/../config/db.php';

include_once __DIR__ . '/../Controllers/LopHocPhanController.php';
include_once __DIR__ . '/../Controllers/LopController.php';
include_once __DIR__ . '/../Controllers/MonHocController.php';
include_once __DIR__ . '/../Controllers/GiaoVienController.php';
include_once __DIR__ . '/../Controllers/PhongController.php';

$lopController = new LopController($conn);
$monhocController = new MonHocController($conn);
$giaovienController = new GiaoVienController($conn);
$phongController = new PhongController($conn);
$lophocphanController = new LopHocPhanController($conn);

$lopDS = $lopController->DanhSach();
$monhocDS = $monhocController->DanhSach();
$giaovienDS = $giaovienController->DanhSach();
$phongHocDS = $phongController->DanhSach();

if (isset($_GET['MaLHP'])) {
    $maLHP = $_GET['MaLHP'];
}

$lhp = $lophocphanController->ChiTietLHP($maLHP);

//hàm sửa lớp học phần
if (isset($_POST['SuaLHP'])) {
    $maMonHoc = $_POST['maMonHoc'];
    $maPhongHoc = $_POST['maPhongHoc'];
    $maGiaoVien = $_POST['maGiaoVien'];
    $maLop = $_POST['maLop'];

    $message = $lophocphanController->SuaLHP($maLHP, $maPhongHoc, $maGiaoVien);
}

//xóa LHP
if (isset($_POST['XoaLHP'])) {
    $maLHP = $_POST['maLHP'];
    $message = $lophocphanController->XoaLHP($maLHP);
}

?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<body>
    <div class="m-4 mx-2 min-h-[535px] ">
        <button onclick="window.history.back()" class="px-3 py-2 bg-gray-400">Quay lại</button>
        <div id="" class="flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-2/3 shadow-lg border-2 relative">

                <button onclick="openModal()" class="absolute top-2 right-2 text-5xl text-red-500 hover:text-red-600"><i
                        class="fa-solid fa-trash"></i></button>

                <div id="confirmModal"
                    class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white p-6 rounded-lg">
                        <h2 class="text-xl font-bold mb-4">Xác nhận xóa</h2>
                        <p class="mb-6">Bạn có chắc chắn muốn xóa môn học này không?</p>
                        <div class="flex justify-end space-x-4">
                            <button class="bg-gray-300 px-4 py-2 rounded" onclick="closeModal()">Hủy</button>
                            <form method="POST" action="">
                                <input type="hidden" name="maLHP" value="<?php echo $maLHP ?>">
                                <button name="XoaLHP" class='bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600'>Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>

                <h2 class="text-xl font-bold mb-4 text-center">Sửa lớp học phần</h2>

                <form method="POST" action="" class="grid grid-cols-2 gap-4 mt-4">

                    <div class="">
                        <label class="block font-medium">Mã LHP</label>
                        <input type="text" name="maLHP" value="<?php echo $lhp['MaLopHocPhan'] ?>"
                            class="bg-gray-200 w-full px-3 py-2 border rounded-md" disabled>
                    </div>

                    <div></div>
                    
                    <!-- hiển thị môn học -->
                    <div class="">
                        <label class="font-medium">Môn học</label>
                        <input type="text" name="maMonHoc" class="bg-gray-200 w-full px-3 py-2 border rounded-md" disabled
                            value="<?php 
                                // Kiểm tra nếu có dữ liệu môn học thì hiển thị tên môn
                                if ($monhocDS->num_rows > 0) {
                                    while ($monhoc = $monhocDS->fetch_assoc()) {
                                        if ($monhoc['MaHP'] == $lhp['MaMonHoc']) {
                                            echo $monhoc['TenHP'];
                                        }
                                    }
                                }
                            ?>"
                        >
                    </div>   
                    
                    <!-- hiển thị lớp -->
                    <div class="">
                        <label class="block font-medium">Lớp</label>
                        <input type="text" name="maLop" class="bg-gray-200 w-full px-3 py-2 border rounded-md" disabled
                            value="<?php 
                                // Kiểm tra nếu có dữ liệu môn học thì hiển thị tên môn
                                if ($lopDS->num_rows > 0) {
                                    while ($lop = $lopDS->fetch_assoc()) {
                                        if ($lop['MaLop'] == $lhp['MaLop']) {
                                            echo $lop['TenLop'] . " - " . $lop['MaLop'];
                                        }
                                    }
                                }
                            ?>">
                    </div>
                    
                    <!-- hiển thị phòng học -->
                    <div class="">
                        <label class="block font-medium">Phòng học</label>
                        <select name="maPhongHoc" class="w-full px-3 py-2 border rounded-md">
                            <option value=""></option>
                            <?php
                            // Kiểm tra nếu có dữ liệu phòng học
                            if ($phongHocDS->num_rows > 0) {
                                // Lặp qua từng phòng và tạo các <option>
                                while ($phong = $phongHocDS->fetch_assoc()) {
                                    echo "<option value=\"" . $phong['DiaDiem'] . "\"";
                                    if ($phong['DiaDiem'] == $lhp['DiaDiem']) {
                                        echo " selected";
                                    }
                                    echo ">" . htmlspecialchars($phong['DiaDiem']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                    <!-- hiển thị giáo viên -->
                    <div class="">
                        <label class="block font-medium">Giáo viên</label>
                        <select name="maGiaoVien" class="w-full px-3 py-2 border rounded-md">
                            <option value=""></option>
                            <?php
                            // Kiểm tra nếu có dữ liệu gv
                            if ($giaovienDS->num_rows > 0) {
                                // Lặp qua từng gv và tạo các <option>
                                while ($giaovien = $giaovienDS->fetch_assoc()) {
                                    echo "<option value=\"" . $giaovien['MaGV'] . "\"";
                                    if ($giaovien['MaGV'] == $lhp['MaGV']) {
                                        echo " selected";
                                    }
                                    echo ">" . htmlspecialchars($giaovien['HoTen']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-span-2 text-center">
                        <button type="submit" name="SuaLHP" value="SuaLHP" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Xác nhận</button>
                    </div>
                    <div class="col-span-2 text-center">
                        <?php
                        // Hiển thị thông báo kết quả thêm môn học mới
                        if (isset($message)) {
                            echo "<p class='text-black text-xl'>$message</p>";
                        }
                        ?>
                    </div>
                </form>
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