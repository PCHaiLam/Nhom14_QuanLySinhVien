<?php
session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/SinhVienController.php';
include_once __DIR__ . '/../Controllers/KhoaController.php';
include_once __DIR__ . '/../Controllers/LopController.php';

$svController = new SinhVien($conn);
$khoaController = new Khoa($conn);
$lopController = new Lop($conn);



// Kiểm tra và xử lý yêu cầu AJAX 
if (isset($_GET['maKhoa'])) { 
    $maKhoa = $_GET['maKhoa']; 
    $result = $lopController->DanhSachId($maKhoa); 
    if ($result->num_rows > 0) { 
        while ($lop = $result->fetch_assoc()) { 
            echo "<option value=\"" . $lop['MaLop'] . "\">" . htmlspecialchars($lop['TenLop']) . "</option>"; 
        } 
    } else { 
        echo "<option value=\"\">Không có lớp nào</option>"; 
    } 
    exit; // Ngừng thực hiện phần còn lại của tệp 
}

// Kiểm tra và xử lý yêu cầu tìm kiếm POST
$maKhoa = isset($_GET['khoaOption']) ? $_GET['khoaOption'] : ''; 
$maLop = isset($_GET['lopOption']) ? $_GET['lopOption'] : '';

// Lấy danh sách sinh viên, khoa, lớp
$khoaList = $khoaController->DanhSach();
$lopList = $lopController->DanhSach();
$sinhvienList = $svController->timKiem($maKhoa, $maLop);

?>

<?php include_once __DIR__ . "/../layout/header.php"; ?>

<body>
    <div class="my-6 w-full mx-2 min-h-[505px] flex justify-around">
        <!-- Wrapper for the button and form -->
        <div class="flex flex-col items-center">
            <!-- Button for adding a student -->
            <button onclick="openModal()" class="mb-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">
                Thêm sinh viên
            </button>

            <!-- Modal thêm sinh viên -->
            <div id="addStudentModal" class="fixed inset-0 hidden bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 ">
                <div class="bg-white p-6 rounded-lg w-[90%] max-w-md shadow-lg transform transition-all scale-95">
                    <h2 class="text-xl font-bold mb-4 text-center">Thêm sinh viên mới</h2>
                    <form method="POST" action="add_student.php">
                        <div class="mb-2">
                            <label class="block font-medium">Mã SV</label>
                            <input type="text" name="MaSV" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">Họ Tên</label>
                            <input type="text" name="HoTen" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">Ngày Sinh</label>
                            <input type="date" name="NgaySinh" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">Giới Tính</label>
                            <select name="GioiTinh" class="w-full px-3 py-2 border rounded-md" required>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">Địa Chỉ</label>
                            <input type="text" name="DiaChi" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">Email</label>
                            <input type="email" name="Email" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">SĐT</label>
                            <input type="tel" name="SDT" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium">Mã Lớp</label>
                            <input type="text" name="MaLop" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- form tìm kiếm -->
            <form method="GET" class="h-max w-max px-5 py-4 flex flex-col bg-white rounded-xl shadow border-2 mt-4">
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
                <h1 class="font-bold text-xl py-2">Tìm kiếm</h1>
                <input type="text" class="px-4 py-2 border rounded-md" placeholder="Tìm kiếm mssv, tên" id="searchInput">
                <div class="text-center text-white">
                    <button type="submit" class="border-2 px-3 mt-2 rounded bg-gray-400 hover:bg-gray-500">Tìm</button>
                </div>
            </form>
        </div>

        <!-- Table displaying student data -->
        <div class="w-full h-[505px] mx-2 bg-white rounded-xl shadow border-2 overflow-scroll overflow-x-hidden">
            <table border="1" cellpadding="10" cellspacing="0" class="w-full text-center border border-collapse">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>MaSV</th>
                        <th>HoTen</th>
                        <th>NgaySinh</th>
                        <th>GioiTinh</th>
                        <th>DiaChi</th>
                        <th>Email</th>
                        <th>Sdt</th>
                        <th>AnhSV</th>
                        <th>MaLop</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($sinhvienList && $sinhvienList->num_rows > 0): ?>
                        
                        <?php $stt=1; foreach ($sinhvienList as $sinhvien): ?>
                            <tr class="border-2">
                                <td class="border"><?php echo $stt; ?></td>
                                <td><?php echo $sinhvien['MaSV']; ?></td>
                                <td><?php echo $sinhvien['HoTen']; ?></td>
                                <td><?php echo $sinhvien['NgaySinh']; ?></td>
                                <td><?php echo $sinhvien['GioiTinh']; ?></td>
                                <td><?php echo $sinhvien['DiaChi']; ?></td>
                                <td><?php echo $sinhvien['Email']; ?></td>
                                <td><?php echo $sinhvien['SDT']; ?></td>
                                <td><img src="<?php echo '../asset/Images/' . $sinhvien['AnhSV']; ?>" alt="Student Image" width="50" height="50"></td>
                                <td><?php echo $sinhvien['MaLop']; $stt++?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">Không có dữ liệu.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("addStudentModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("addStudentModal").classList.add("hidden");
        }
    </script>
</body>


<?php include_once __DIR__ . "/../layout/footer.php"; ?>
