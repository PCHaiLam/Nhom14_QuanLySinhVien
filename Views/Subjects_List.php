<?php
session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/MonHocController.php';

$monhocController = new MonHocController($conn);

$limit = 5;

// Lấy trang hiện tại từ query string (mặc định là trang 1 nếu không có)
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;

// Tính tổng số môn học
$totalMonHoc = $monhocController->countMonHoc();

// Lấy danh sách môn học cho trang hiện tại
$monhocList = $monhocController->DanhSach($currentPage, $limit);
?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>


<body>
    <div class="min-h-[520px] my-6 mx-2 px-4 mt-2">
        <div class="w-full flex justify-between">
            <button onclick="window.history.back()" class="px-3 py-2 mb-2 bg-gray-400 rounded-xl">Quay lại</button>
            <a href="Subject_Add.php" class="px-3 py-2 mb-2 bg-blue-400 rounded-xl cursor-pointer hover:bg-blue-500">
                Thêm mới
            </a>
        </div>
        <div class="flex flex-col justify-between h-[490px]">
            <table class="w-3/4 mx-auto bg-white border-2 rounded">
                <tr>
                    <th class="py-3 px-4 border-b text-left">STT</th>
                    <th class="py-3 px-4 border-b text-left">Mã Môn Học</th>
                    <th class="py-3 px-4 border-b text-left w-[370px]">Tên Môn Học</th>
                    <th class="py-3 px-4 border-b text-left">Số Tín Chỉ</th>
                    <th class="py-3 px-4 border-b text-left">Đơn Giá</th>
                    <th class="py-3 px-4 border-b text-left w-[170px]"></th>
                </tr>
                <?php
                // Kiểm tra nếu có dữ liệu
                if ($monhocList->num_rows > 0) {
                    // Lặp qua danh sách môn học
                    $stt = 1;
                    while ($monhoc = $monhocList->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='py-3 px-4 border-b'>" . $stt . "</td>";
                        echo "<td class='py-3 px-4 border-b'>" . htmlspecialchars($monhoc['MaHP']) . "</td>";
                        echo "<td class='py-3 px-4 border-b'>" . htmlspecialchars($monhoc['TenHP']) . "</td>";
                        echo "<td class='py-3 px-4 border-b'>" . htmlspecialchars($monhoc['SoTinChi']) . "</td>";
                        echo "<td class='py-3 px-4 border-b'>" . htmlspecialchars($monhoc['DonGia']) . "</td>";
                        echo "<td class='py-3 px-4 border-b flex justify-between'>
                                <a href='Subject_Detail.php?MaHP= ".$monhoc['MaHP'] ."' title='Chỉnh sửa'><img src='../asset/Images/details.png' class='h-12'/></a>
                                <a href='Subject_Edit.php?MaHP= ".$monhoc['MaHP'] ."' title='Chỉnh sửa'><img src='../asset/Images/edit.png' class='h-12'/></a>
                                <a href='Subject_Delete.php?MaHP= ".$monhoc['MaHP'] ."' title='Chỉnh sửa'><img src='../asset/Images/delete.png' class='h-12'/></a>
                                </td>";
                        echo "</tr>";
                        $stt++;
                    }
                } else {
                    echo "<tr><td colspan='4' class='py-3 px-4 text-center'>Không có môn học nào</td></tr>";
                }
                ?>
            </table>
            <div class="flex justify-center items-center mt-5">
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
            </div>

        </div>
    </div>
</body>
<?php include_once __DIR__ . "/../layout/footer.php"; ?>