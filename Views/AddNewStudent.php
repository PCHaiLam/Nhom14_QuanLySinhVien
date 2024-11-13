<?php 
session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/KhoaController.php';
include_once __DIR__ . '/../Controllers/LopController.php';
include_once __DIR__ . '/../Controllers/SinhVienController.php';
$svController = new SinhVien($conn);
$khoaController = new Khoa($conn);
$lopController = new Lop($conn);


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $maKhoa = isset($_GET['khoaOption']) ? $_GET['khoaOption'] : ''; // Lấy mã khoa từ GET
    $maSV = $svController->TaoMaSoSinhVien($maKhoa); // Gọi hàm tạo MSSV
}

//// Kiểm tra xem mã sinh viên đã tồn tại chưa
if (isset($_POST['ThemSV'])) {
    $maSV = $_POST['maSV'];
    $hoTen = $_POST['hoTen'];
    $ngaySinh = $_POST['ngaySinh'];
    $gioiTinh = $_POST['gioiTinh'];
    $diaChi = $_POST['diaChi'];
    $email = $_POST['email'];
    $sdt = $_POST['Sdt'];
    $maLop = $_POST['lopOption'];

    // Kiểm tra xem mã sinh viên đã tồn tại chưa
    $checkSql = "SELECT * FROM sinhvien WHERE MaSV = '$maSV'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "<p style='color: red; text-align: center;'>Mã sinh viên đã tồn tại. Vui lòng nhập mã sinh viên khác.</p>";
    } else {
        // Gọi hàm ThemSinhVien từ SinhVienController
        $svController->ThemSinhVien($maSV, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $sdt, '', $maLop); // Truyền giá trị AnhSV là rỗng
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
                <div class="bg-white p-6 rounded-lg w-[500px] shadow-lg border-2">
                    <h2 class="text-xl font-bold mb-4 text-center">Thêm sinh viên mới</h2>
                    <form method="POST" action="">
    <div class="mb-2">
        <label class="block font-medium">Mã SV</label>
        <!-- Hiển thị mã SV đã tự động tạo -->
        <input type="text" name="maSV" class="w-full px-3 py-2 border rounded-md" value="<?php echo $maSV; ?>" readonly>
    </div>
    <div class="mb-2">
        <label class="block font-medium">Họ Tên</label>
        <input type="text" name="hoTen" class="w-full px-3 py-2 border rounded-md" required>
    </div>
    <div class="mb-2">
        <label class="block font-medium">Ngày Sinh</label>
        <input type="date" name="ngaySinh" class="w-full px-3 py-2 border rounded-md" required>
    </div>
    <div class="mb-2">
        <label class="block font-medium">Giới Tính</label>
        <select name="gioiTinh" class="w-full px-3 py-2 border rounded-md" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
    </div>
    <div class="mb-2">
        <label class="block font-medium">Địa Chỉ</label>
        <input type="text" name="diaChi" class="w-full px-3 py-2 border rounded-md" required>
    </div>
    <div class="mb-2">
        <label class="block font-medium">Email</label>
        <input type="email" name="email" class="w-full px-3 py-2 border rounded-md" required>
    </div>
    <div class="mb-2">
        <label class="block font-medium">SĐT</label>
        <input type="tel" name="Sdt" class="w-full px-3 py-2 border rounded-md" required>
    </div>
    <div class="mb-2">
        <label class="grid grid-cols-2">
                    <span>Khoa</span>
                    <select id="khoaOption" name="option" class="col-span-2 p-2 border rounded-md" onchange="loadLopByKhoa()">
                        <option value=""></option>
                    <?php
                        // Kiểm tra nếu có dữ liệu khoa
                        if ($khoaList->num_rows > 0) {
                            // Lặp qua từng khoa và tạo các <option>
                            while ($khoa = $khoaList->fetch_assoc()) {
                                echo "<option value=\"" . $khoa['MaKhoa'] . "\">" . htmlspecialchars($khoa['TenKhoa']) . "</option>";
                            }
                        }
                    ?>
                    </select>
                </label>
                <label class="grid grid-cols-2 mt-2">
                    <span>Lớp</span>
                    <select id="lopOption" name="lopOption" class="col-span-2 p-2 border rounded-md">
                    <option value=""></option>

                    <?php
                        // Kiểm tra nếu có dữ liệu lớp
                        if ($lopList->num_rows > 0) {
                            // Lặp qua từng lớp và tạo các <option>
                            while ($lop = $lopList->fetch_assoc()) {
                                echo "<option value=\"" . $lop['MaLop'] . "\">" . htmlspecialchars($lop['TenLop']) . "</option>";
                            }
                        }
                    ?>
                    </select>
                </label>
        
    </div>
    <div class="flex justify-end space-x-2">
        <button type="submit" name="ThemSV" value="ThemSV" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Thêm</button>
    </div>
</form>
                </div>
            </div>
    </div>

</body>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>
