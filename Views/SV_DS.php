<?php
session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/SinhVienController.php';
include_once __DIR__ . '/../Controllers/KhoaController.php';
include_once __DIR__ . '/../Controllers/LopController.php';

$svController = new SinhVienController($conn);
$khoaController = new KhoaController($conn);
$lopController = new LopController($conn);

// Kiểm tra và xử lý yêu cầu tìm kiếm POST
$maKhoa = isset($_GET['khoaOption']) ? $_GET['khoaOption'] : ''; 
$maLop = isset($_GET['lopOption']) ? $_GET['lopOption'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Lấy danh sách sinh viên, khoa, lớp
$khoaList = $khoaController->DanhSach();
$lopList = $lopController->DanhSach();
$sinhvienList = $svController->timKiem($maKhoa, $maLop, $search);

?>

<?php include_once __DIR__ . "/../layout/header.php"; ?>

<body>
    <div class="my-6 mx-2 min-h-[520px] flex">
        <div class="flex flex-col items-center">
            <!-- thêm button thêm sinh viên -->
            <button onclick="window.location.href='SV_ThemMoi.php'" class="mb-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">
                Thêm sinh viên
            </button>

            <!-- form tìm kiếm -->
            <form method="GET" class="h-max w-max px-5 py-4 flex flex-col bg-white rounded-xl shadow border-2 mt-4">
                <label class="grid grid-cols-2">
                    <span>Khoa</span>
                    <select id="khoaOption" name="khoaOption" class="col-span-2 p-2 border rounded-md">
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
                <input type="text" name="search" class="px-4 py-2 border rounded-md" placeholder="Tìm kiếm mssv, tên" id="searchInput">
                <div class="text-center text-white">
                    <button type="submit" class="border-2 px-3 mt-2 rounded bg-gray-400 hover:bg-gray-500">Tìm</button>
                </div>
            </form>
        </div>
        
        <!-- hiển thị bảng sinh viên -->
        <div class="w-full h-[505px] mx-2 bg-white rounded-xl shadow border-2 overflow-scroll overflow-x-hidden">
            <table border="1" cellpadding="10" cellspacing="0" class="w-full text-center border border-collapse">
                <thead>
                    <tr class="">
                        <th>STT</th>
                        <th>Mã SV</th>
                        <th>Họ Tên</th>
                        <th>Ngày Sinh</th>
                        <th>Giới Tính</th>
                        <th>Địa Chỉ</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Ảnh</th>
                        <th>Lớp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($sinhvienList && $sinhvienList->num_rows > 0): ?>
                        <?php $stt=1; foreach ($sinhvienList as $sinhvien): ?>
                            <tr title="Ấn vào xem chi tiết" class="border-2 cursor-pointer hover:bg-gray-200" onclick="window.location.href='SV_ChiTiet.php?MaSV=<?php echo $sinhvien['MaSV']; ?>'">
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
</body>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>
<!-- <div class="flex justify-center items-center mt-5">
                <!-- Nút đầu -->
                <?php if ($currentPage > 1): ?>
                    <a href="?page=1" class="px-4 py-2 mx-1 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-500 hover:text-white">Đầu</a>
                <?php else: ?>
                    <span class="px-4 py-2 mx-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">Đầu</span>
                <?php endif; ?>
                <!-- Trang trước -->
                <?php if ($currentPage > 1): ?>
                    <a href="?page=<?= $currentPage - 1 ?>" class="px-4 py-2 mx-1 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-500 hover:text-white">&laquo; Trang trước</a>
                <?php else: ?>
                    <span class="px-4 py-2 mx-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">&laquo; Trang trước</span>
                <?php endif; ?>
                <!-- Liên kết các trang -->
                <?php
                    $totalPages = ceil($totalMonHoc / $limit);
                    for ($i = 1; $i <= $totalPages; $i++):
                        ?>
                        <a href="?page=<?= $i ?>"class="px-4 py-2 mx-1 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-500 hover:text-white <?= ($i == $currentPage) ? 'bg-blue-500 text-white font-semibold' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
                <!-- Trang sau -->
                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?= $currentPage + 1 ?>" class="px-4 py-2 mx-1 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-500 hover:text-white">Trang sau &raquo;</a>
                <?php else: ?>
                    <span class="px-4 py-2 mx-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">Trang sau &raquo;</span>
                <?php endif; ?>
                <!-- Nút cuối -->
                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?= $totalPages ?>" class="px-4 py-2 mx-1 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-500 hover:text-white">Cuối</a>
                <?php else: ?>
                    <span class="px-4 py-2 mx-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">Cuối</span>
                <?php endif; ?>
            </div> -->