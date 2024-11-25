<?php
session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/MonHocController.php';

$monhocController = new MonHocController($conn);

$monhocDS = $monhocController->DanhSach();

// Kiểm tra và xử lý yêu cầu tìm kiếm POST
if (isset($_POST['TimKiemMH'])) {
    $search = $_POST['TimKiemMH'];
    $monhocDS = $monhocController->TimKiem($search);
}

?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>


<body>
    <div class="h-[535px] my-6 px-4 mt-2">
        <div class="w-full flex justify-between">
            <button onclick="window.history.back()" class="px-3 py-2 mb-2 bg-gray-400 rounded-xl">Quay lại</button>
            <form action="" method="post">
                <input name="TimKiemMH" type="text" class="px-3 py-2 border rounded-md" placeholder="Tìm kiếm">
                <button class="px-3 py-2 bg-blue-400 rounded-xl cursor-pointer hover:bg-blue-500">Tìm kiếm</button>
            </form>
            <a href="MH_ThemMoi.php" class="px-3 py-2 mb-2 bg-blue-400 rounded-xl cursor-pointer hover:bg-blue-500">Thêm mới</a>
        </div>
        <div class="py-4 h-[490px] overflow-scroll overflow-x-hidden border-t-2">
            <table class="w-3/4 mx-auto bg-white  border-2 rounded">
                <tr>
                    <th class="py-3 px-4 border-b text-left">STT</th>
                    <th class="py-3 px-4 border-b text-left">Mã Môn Học</th>
                    <th class="py-3 px-4 border-b text-left w-[370px]">Tên Môn Học</th>
                    <th class="py-3 px-4 border-b text-left">Số Tín Chỉ</th>
                    <th class="py-3 px-4 border-b text-left">Đơn Giá</th>
                    <th class="py-3 px-4 border-b text-left w-32"></th>
                </tr>
                <?php
                // Kiểm tra nếu có dữ liệu
                if ($monhocDS->num_rows > 0) {
                    // Lặp qua danh sách môn học
                    $stt = 1;
                    while ($monhoc = $monhocDS->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='py-3 px-4 border-b'>" . $stt . "</td>";
                        echo "<td class='py-3 px-4 border-b'>" . htmlspecialchars($monhoc['MaHP']) . "</td>";
                        echo "<td class='py-3 px-4 border-b'>" . htmlspecialchars($monhoc['TenHP']) . "</td>";
                        echo "<td class='py-3 px-4 border-b'>" . htmlspecialchars($monhoc['SoTinChi']) . "</td>";
                        echo "<td class='py-3 px-4 border-b'>" . htmlspecialchars($monhoc['DonGia']) . "</td>";
                        echo "<td class='py-3 px-4 border-b flex'>
                                <a href='MH_ChinhSua.php?MaHP=".$monhoc['MaHP'] ."' title='Chỉnh sửa'><img src='../asset/Images/edit.png' class='h-12'/></a>
                                </td>";
                        echo "</tr>";
                        $stt++;
                    }
                } else {
                    echo "<tr><td colspan='4' class='py-3 px-4 text-center'>Không có môn học nào</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
<?php include_once __DIR__ . "/../layout/footer.php"; ?>