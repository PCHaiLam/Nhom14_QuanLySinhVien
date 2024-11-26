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

//phân trang
$limit = 5;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $limit;

// Lấy danh sách sinh viên
$sinhvienList = $svController->DanhSach($maKhoa, $maLop, $search, $currentPage, $limit);

$tongSV = $svController->TongSV();

?>

<?php include_once __DIR__ . "/../layout/header.php"; ?>

<body>
    <div class="min-h-[540px] my-4 px-4 mt-2">
        <div class="flex items-center justify-between">
            <button onclick="window.history.back()" class="px-3 py-2 mb-2 bg-gray-400 rounded-xl">Quay lại</button>

            <!-- form tìm kiếm -->
            <form method="GET" class="grid grid-cols-3 items-center">
                <div class="">
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
                </div>
                <label class="">
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
                <div class="flex">
                    <input type="text" name="search" class="px-4 py-2 border rounded-md" placeholder="Tìm kiếm mssv, tên" id="searchInput">
                    <div class="text-center text-white">
                        <button type="submit" class="border-2 px-3 mt-2 rounded bg-gray-400 hover:bg-gray-500">Tìm</button>
                    </div>
                </div>
            </form>

            <!-- thêm button thêm sinh viên -->
            <button onclick="window.location.href='SV_ThemMoi.php'" class="mb-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">Thêm sinh viên</button>

        </div>
        
        <!-- hiển thị bảng sinh viên -->
        <div class="flex flex-col justify-between w-full mx-2 bg-white rounded-xl shadow border-2">
            <div class=" h-[430px]">
                <table border="1" cellpadding="10" cellspacing="0" class="w-full text-left border border-collapse">
                    <thead>
                        <tr class="text-left">
                            <th class="w-[30px]">STT</th>
                            <th class="w-[100px]">Mã SV</th>
                            <th class="w-[260px]">Họ Tên</th>
                            <th class="w-[110px]">Ngày Sinh</th>
                            <th class="w-[90px]">Giới Tính</th>
                            <th class="w-[250px]">Địa Chỉ</th>
                            <th class="w-[220px]">Email</th>
                            <th class="w-[110px]">SĐT</th>
                            <th class="w-[200px] text-center">Ảnh</th>
                            <th class="w-[110px]">Lớp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($sinhvienList && $sinhvienList->num_rows > 0): ?>
                            <?php $stt=1; foreach ($sinhvienList as $sinhvien): ?>
                                <tr title="Ấn vào xem chi tiết" class="h-[70px] border-2 cursor-pointer hover:bg-gray-200" onclick="window.location.href='SV_ChiTiet.php?MaSV=<?php echo $sinhvien['MaSV']; ?>'">
                                    <td class="border"><?php echo $stt; ?></td>
                                    <td><?php echo $sinhvien['MaSV']; ?></td>
                                    <td><?php echo $sinhvien['HoTen']; ?></td>
                                    <td><?php echo $sinhvien['NgaySinh']; ?></td>
                                    <td><?php echo $sinhvien['GioiTinh']; ?></td>
                                    <td><?php echo $sinhvien['DiaChi']; ?></td>
                                    <td><?php echo $sinhvien['Email']; ?></td>
                                    <td><?php echo $sinhvien['SDT']; ?></td>
                                    <td><img src="<?php echo '../asset/Images/' . $sinhvien['AnhSV']; ?>" class="h-[56px] w-[56px] object-cover mx-auto" alt="Student Image"></td>
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
            <!-- Hiển thị thanh điều hướng -->
            <div class="flex justify-center items-center mt-5">
                <!-- Nút đầu -->
                <?php if ($currentPage > 1): ?>
                    <a href="?page=1" class="px-4 py-1 mx-1 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-500 hover:text-white">Đầu</a>
                <?php else: ?>
                    <span class="px-4 py-1 mx-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">Đầu</span>
                <?php endif; ?>
                <!-- Trang trước -->
                <?php if ($currentPage > 1): ?>
                    <a href="?page=<?= $currentPage - 1 ?>" class="px-4 py-1 mx-1 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-500 hover:text-white">&laquo; Trang trước</a>
                <?php else: ?>
                    <span class="px-4 py-1 mx-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">&laquo; Trang trước</span>
                <?php endif; ?>
                <!-- Liên kết các trang -->
                <?php
                    $totalPages = ceil($tongSV / $limit);
                    for ($i = 1; $i <= $totalPages; $i++):
                        ?>
                        <a href="?page=<?= $i ?>"class="px-4 py-1 mx-1 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-500 hover:text-white <?= ($i == $currentPage) ? 'bg-blue-500 text-white font-semibold' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
                <!-- Trang sau -->
                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?= $currentPage + 1 ?>" class="px-4 py-1 mx-1 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-500 hover:text-white">Trang sau &raquo;</a>
                <?php else: ?>
                    <span class="px-4 py-1 mx-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">Trang sau &raquo;</span>
                <?php endif; ?>
                <!-- Nút cuối -->
                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?= $totalPages ?>" class="px-4 py-1 mx-1 border border-gray-300 rounded-lg text-blue-600 hover:bg-blue-500 hover:text-white">Cuối</a>
                <?php else: ?>
                    <span class="px-4 py-1 mx-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed">Cuối</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>
