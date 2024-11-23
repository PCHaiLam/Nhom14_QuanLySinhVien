<?php
session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/KhoaController.php';
include_once __DIR__ . '/../Controllers/LopController.php';
include_once __DIR__ . '/../Controllers/SinhVienController.php';
$svController = new SinhVienController($conn);
$khoaController = new KhoaController($conn);
$lopController = new LopController($conn);


if (isset($_GET['MaSV'])) {
    $maSV = $_GET['MaSV'];
}

// Xử lý thêm hoặc cập nhật sinh viên
if (isset($_POST['LuuSV'])) {
    $maSV = $_POST['maSV'];
    $hoTen = $_POST['hoTen'];
    $ngaySinh = $_POST['ngaySinh'];
    $gioiTinh = $_POST['gioiTinh'];
    $diaChi = $_POST['diaChi'];
    $email = $_POST['email'];
    $sdt = $_POST['Sdt'];
    $anhSV = $_FILES['AnhSV'];
    //$maLop = $_POST['lopOption'];

    if ($anhSV['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($anhSV['type'], $allowedTypes)) {
            echo "Chỉ chấp nhận file ảnh với định dạng JPG, JPEG, PNG.";
            exit();
        }
        $maxSize = 2 * 1024 * 1024;
        if ($anhSV['size'] > $maxSize) {
            echo "Kích thước ảnh vượt quá 2MB.";
            exit();
        }
        $fileName = strtolower(basename($anhSV['name']));
        $fileName = preg_replace("/[^a-z0-9\.]/", "_", $fileName);

        $message = $svController->SuaSinhVien($maSV, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $sdt, $fileName);
    }
}

// Lấy danh sách khoa, lớp
$khoaList = $khoaController->DanhSach();
$lopList = $lopController->DanhSach();

$sinhvien = $svController->ChiTietSinhVien($maSV);


?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<body>
    <div class="m-4 w-full mx-2 min-h-[520px] ">
        <button onclick="window.history.back()" class="px-3 py-2 bg-gray-400">Quay lại</button>
        <div id="" class="flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-max shadow-lg border-2">
                <h2 class="text-xl font-bold mb-4 text-center">
                    <?php echo 'Chỉnh sửa thông tin sinh viên'; ?>
                </h2>

                <form method="POST" action="" class="grid grid-cols-3 gap-4 mt-4" enctype="multipart/form-data">
                    <div class="">
                        <label class="block font-medium">Mã SV</label>
                        <input type="text" name="maSV" class="w-full px-3 py-2 border rounded-md bg-gray-200"
                               value="<?php echo $maSV; ?>" readonly>
                    </div>
                    <div class="">
                        <label class="block font-medium">Họ Tên</label>
                        <input type="text" name="hoTen" class="w-full px-3 py-2 border rounded-md"
                               value="<?php echo $sinhvien['HoTen']; ?>" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">Ngày Sinh</label>
                        <input type="date" name="ngaySinh" class="w-full px-3 py-2 border rounded-md"
                               value="<?php echo $sinhvien['NgaySinh']; ?>" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">Giới Tính</label>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="radio" name="gioiTinh" value="Nam" class="mr-2" required
                                    <?php echo ($sinhvien["GioiTinh"] === 'Nam') ? 'checked' : ''; ?>>
                                Nam
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="gioiTinh" value="Nữ" class="mr-2" 
                                    <?php echo ($sinhvien["GioiTinh"] === 'Nữ') ? 'checked' : ''; ?>>
                                Nữ
                            </label>
                        </div>
                    </div>

                    <div class="">
                        <label class="block font-medium">Địa Chỉ</label>
                        <input type="text" name="diaChi" class="w-full px-3 py-2 border rounded-md"
                               value="<?php echo $sinhvien['DiaChi']; ?>" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">Email</label>
                        <input type="email" name="email" class="w-full px-3 py-2 border rounded-md"
                               value="<?php echo $sinhvien['Email']; ?>" disabled>
                    </div>
                    <div class="">
                        <label class="block font-medium">SĐT</label>
                        <input type="text" name="Sdt" class="w-full px-3 py-2 border rounded-md"
                               value="<?php echo $sinhvien['SDT']; ?>" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">Ảnh</label>
                        <img src="" alt="Ảnh SV">
                        <input type="file" accept="image/*" name="AnhSV" class="w-full px-3 py-2 border rounded-md "
                            required>
                        
                    </div>
                    <div class="col-span-3 text-center">
                        <button type="submit" name="LuuSV" value="LuuSV"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            <?php echo 'Lưu '; ?>
                        </button>
                    </div>
                    <div class="col-span-3 text-center">
                        <?php
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

<?php include_once __DIR__ . "/../layout/footer.php"; ?>
