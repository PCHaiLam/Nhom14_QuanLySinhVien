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

//thêm lớp học phần
if (isset($_POST['ThemLHP'])) {
    $maHP = $_POST['monHoc'];
    $phongHoc = $_POST['phongHoc'];
    $giaoVien = $_POST['giaoVien'];
    $lop = $_POST['lop'];

    $maLHP = $lophocphanController->TaoMaLHP($maHP, $lop);

    $message = $lophocphanController->ThemLHP($maLHP, $maHP, $phongHoc, $giaoVien, $lop);
}


?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<body>
    <div class="m-4 mx-2 min-h-[535px] ">
        <button onclick="window.history.back()" class="px-3 py-2 bg-gray-400">Quay lại</button>
        <div class="w-2/3 mx-auto bg-white p-3 rounded-lg shadow-lg border-2">
            <h2 class="text-xl font-bold mb-4 text-center">Thêm mới LHP</h2>

            <form method="POST" action="" class="grid grid-cols-2 gap-4 mt-4">
                <div class="">
                    <label class="block font-medium">Mã LHP</label>
                    <input type="text" name="maLHP" class="w-full px-3 py-2 border rounded-md bg-gray-200"
                        value="Tạo tự động" readonly>
                </div>
                <div></div>

                <div class="">
                    <label class="block font-medium">Môn học</label>
                    <select name="monHoc" class="w-full px-3 py-2 border rounded-md">
                        <option value=""></option>
                        <?php
                        // Kiểm tra nếu có dữ liệu môn
                        if ($monhocDS->num_rows > 0) {
                            // Lặp qua từng môn và tạo các <option>
                            while ($mon = $monhocDS->fetch_assoc()) {
                                echo "<option value=\"" . $mon['MaHP'] . "\">" . htmlspecialchars($mon['TenHP']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="">
                    <label class="block font-medium">Phòng học</label>
                    <select name="phongHoc" class="w-full px-3 py-2 border rounded-md">
                        <option value=""></option>
                        <?php
                        // Kiểm tra nếu có dữ liệu phòng học
                        if ($phongHocDS->num_rows > 0) {
                            // Lặp qua từng phòng và tạo các <option>
                            while ($phong = $phongHocDS->fetch_assoc()) {
                                echo "<option value=\"" . $phong['DiaDiem'] . "\">" . htmlspecialchars($phong['DiaDiem']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="">
                    <label class="block font-medium">Giáo viên</label>
                    <select name="giaoVien" class="w-full px-3 py-2 border rounded-md">
                        <option value=""></option>
                        <?php
                        // Kiểm tra nếu có dữ liệu gv
                        if ($giaovienDS->num_rows > 0) {
                            // Lặp qua từng gv và tạo các <option>
                            while ($giaovien = $giaovienDS->fetch_assoc()) {
                                echo "<option value=\"" . $giaovien['MaGV'] . "\">" . htmlspecialchars($giaovien['HoTen']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="">
                    <label class="block font-medium">Lớp</label>
                    <select name="lop" class="w-full px-3 py-2 border rounded-md">
                        <option value=""></option>
                        <?php
                        // Kiểm tra nếu có dữ liệu khoa
                        if ($lopDS->num_rows > 0) {
                            // Lặp qua từng khoa và tạo các <option>
                            while ($lop = $lopDS->fetch_assoc()) {
                                echo "<option value=\"" . $lop['MaLop'] . "\">" . htmlspecialchars($lop['TenLop'])." - " .htmlspecialchars($lop['MaLop']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-span-2 text-center">
                    <button type="submit" name="ThemLHP" value="ThemSV"
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Thêm</button>
                </div>
                <div class="col-span-2 text-center">
                    <?php
                    // Hiển thị thông báo kết quả thêm sinh viên
                    if (isset($message)) {
                        echo "<p class='text-black text-xl'>$message</p>";
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>

</body>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>