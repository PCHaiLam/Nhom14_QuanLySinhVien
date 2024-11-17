<?php
session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/KhoaController.php';
include_once __DIR__ . '/../Controllers/LopController.php';
include_once __DIR__ . '/../Controllers/SinhVienController.php';
$svController = new SinhVienController($conn);
$khoaController = new KhoaController($conn);
$lopController = new LopController($conn);


if (isset($_GET['Confirm'])) {
    $maLop = isset($_GET['lopOption']) ? $_GET['lopOption'] : '';
    $maSV = $svController->TaoMaSoSinhVien($maLop);
}

if (isset($_POST['ThemSV'])) {
    $maSV = $_POST['maSV'];
    $hoTen = $_POST['hoTen'];
    $ngaySinh = $_POST['ngaySinh'];
    $gioiTinh = $_POST['gioiTinh'];
    $diaChi = $_POST['diaChi'];
    $email = $_POST['email'];
    $sdt = $_POST['Sdt'];
    $anhSV = $_FILES['AnhSV'];
    $maLop = isset($_GET['lopOption']) ? $_GET['lopOption'] : null;

    // Kiểm tra nếu có ảnh được tải lên
    if ($anhSV['error'] == 0) {
        // Kiểm tra định dạng ảnh (chỉ chấp nhận jpg, jpeg, png)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($anhSV['type'], $allowedTypes)) {
            echo "Chỉ chấp nhận file ảnh với định dạng JPG, JPEG, PNG.";
            exit();
        }

        // Kiểm tra kích thước ảnh (giới hạn 2MB)
        $maxSize = 2 * 1024 * 1024;  // 2MB
        if ($anhSV['size'] > $maxSize) {
            echo "Kích thước ảnh vượt quá 2MB.";
            exit();
        }

        // Lấy tên gốc của ảnh
        $fileName = strtolower(basename($anhSV['name']));
        $fileName = preg_replace("/[^a-z0-9\.]/", "_", $fileName);  // Chỉ giữ lại chữ cái, số và dấu chấm (.)
        
        $message = $svController->ThemSinhVien($maSV, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $sdt, $fileName , $maLop);
    } else {
        $message = $svController->ThemSinhVien($maSV, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $sdt, '', $maLop); // Truyền giá trị ảnh là rỗng
    }
}
// Kiểm tra và xử lý yêu cầu tìm kiếm POST
$maKhoa = isset($_GET['khoaOption']) ? $_GET['khoaOption'] : '';
$maLop = isset($_GET['lopOption']) ? $_GET['lopOption'] : '';

// Lấy danh sách sinh viên, khoa, lớp
$khoaList = $khoaController->DanhSach();
$lopList = $lopController->DanhSach();
$sinhvienList = $svController->DanhSach();


?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<body>
    <div class="m-4 w-full mx-2 min-h-[520px] ">
        <button onclick="window.history.back()" class="px-3 py-2 bg-gray-400">Quay lại</button>
        <div id="" class="flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-max shadow-lg border-2">
                <h2 class="text-xl font-bold mb-4 text-center">Thêm sinh viên mới</h2>
                <!-- xác nhận lớp trước để hiển thị đúng MaSV -->
                <form method="GET" action="" class="grid grid-cols-3 gap-4">
                    <div class="grid grid-cols-2">
                        <label class="block font-medium">Khoa</label>
                        <select id="khoaOption" name="khoaOption" class="col-span-2 p-2 border rounded-md"
                            onchange="loadLopByKhoa()">
                            <option value=""></option>
                            <?php
                            // Lấy giá trị `khoaOption` đã chọn nếu có
                            $selectedKhoa = isset($_GET['khoaOption']) ? $_GET['khoaOption'] : '';

                            // Kiểm tra nếu có dữ liệu khoa
                            if ($khoaList->num_rows > 0) {
                                // Lặp qua từng khoa và tạo các <option>
                                while ($khoa = $khoaList->fetch_assoc()) {
                                    $selected = $selectedKhoa === $khoa['MaKhoa'] ? 'selected' : '';
                                    echo "<option value=\"" . $khoa['MaKhoa'] . "\" $selected>" . htmlspecialchars($khoa['TenKhoa']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="grid grid-cols-2">
                        <label class="block font-medium">Lớp</label>
                        <select id="lopOption" name="lopOption" class="col-span-2 p-2 border rounded-md">
                            <?php
                            // Lấy giá trị `lopOption` đã chọn nếu có
                            $selectedLop = isset($_GET['lopOption']) ? $_GET['lopOption'] : '';

                            // Kiểm tra nếu có dữ liệu lớp
                            if ($lopList->num_rows > 0) {
                                // Lặp qua từng lớp và tạo các <option>
                                while ($lop = $lopList->fetch_assoc()) {
                                    $selected = $selectedLop === $lop['MaLop'] ? 'selected' : '';
                                    echo "<option value=\"" . $lop['MaLop'] . "\" $selected>" . htmlspecialchars($lop['TenLop']) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="">
                        <button type="submit" name="Confirm" value="Confirm"
                            class="mt-6 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Xác nhận</button>
                    </div>
                </form>

                <form method="POST" action="" class="grid grid-cols-3 gap-4 mt-4" enctype="multipart/form-data">
                    <div class="">
                        <label class="block font-medium">Mã SV</label>
                        <!-- Hiển thị mã SV đã tự động tạo -->
                        <input type="text" name="maSV" class="w-full px-3 py-2 border rounded-md bg-gray-200" value="<?php if (isset($_GET['Confirm'])) {
                            echo $maSV;
                        } ?>" readonly>
                    </div>
                    <div class="">
                        <label class="block font-medium">Họ Tên</label>
                        <input type="text" name="hoTen" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">Ngày Sinh</label>
                        <input type="date" name="ngaySinh" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">Giới Tính</label>
                        <select name="gioiTinh" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="">
                        <label class="block font-medium">Địa Chỉ</label>
                        <input type="text" name="diaChi" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">Email</label>
                        <input type="email" name="email" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">SĐT</label>
                        <input type="text" name="Sdt" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">Ảnh</label>
                        <input type="file" accept="image/*" name="AnhSV" class="w-full px-3 py-2 border rounded-md"
                            required>
                    </div>
                    <div class="col-span-3 text-center">
                        <button type="submit" name="ThemSV" value="ThemSV"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Thêm</button>
                    </div>
                    <div class="col-span-3 text-center">
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
    </div>

</body>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>