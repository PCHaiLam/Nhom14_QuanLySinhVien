<?php
@session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/LopHocPhanController.php';

$lopHocPhanController = new LopHocPhanController($conn);

//hiển thị danh sách lớp học phần
$dsLHP = $lopHocPhanController->DanhSach();

//tìm kiếm lớp học phần
if (isset($_POST['TimKiemLHP'])) {
    $search = $_POST['TimKiemLHP'];
    $dsLHP = $lopHocPhanController->TimKiem($search);
}

?>

<?php include_once __DIR__ . "/../layout/header.php"; ?>

<body>
    <div class="h-[535px] my-6 mx-2 px-4 mt-2">
        <div class="w-full flex justify-between">
            <button onclick="window.history.back()" class="px-3 py-2 mb-2 bg-gray-400 rounded-xl">Quay lại</button>
            <form action="" method="post">
                <input name="TimKiemLHP" type="text" class="px-3 py-2 border rounded-md" placeholder="Tìm kiếm">
                <button class="px-3 py-2 bg-blue-400 rounded-xl cursor-pointer hover:bg-blue-500">Tìm kiếm</button>
            </form>
            <a href="LHP_ThemMoi.php"
                class="px-3 py-2 mb-2 bg-blue-400 rounded-xl cursor-pointer hover:bg-blue-500">Thêm mới</a>
        </div>
        <div class="py-4 h-[490px] overflow-scroll overflow-x-hidden border-t-2">
            <table class="w-3/4 mx-auto bg-white border-2 rounded">
                <thead>
                    <tr>
                        <th class="py-3 px-4 border-b text-left">STT</th>
                        <th class="py-3 px-4 border-b text-left">Mã Lớp Học Phần</th>
                        <th class="py-3 px-4 border-b text-left">Tên Lớp Học Phần</th>
                        <th class="py-3 px-4 border-b text-left">Địa điểm</th>
                        <th class="py-3 px-4 border-b text-left">Giáo viên</th>
                        <th class="py-3 px-4 border-b text-left">Mã Lớp</th>
                        <th class="py-3 px-4 border-b text-left"></th>
                    </tr>
                </thead>
                <tbody class="overflow-scroll overflow-x-hidden">
                    <?php
                    if ($dsLHP->num_rows > 0) {
                        $stt = 1;
                        while ($lhp = $dsLHP->fetch_assoc()) { ?>
                            <tr>
                                <td class="py-3 px-4 border-b"><?php echo $stt; ?></td>
                                <td class="py-3 px-4 border-b"><?php echo htmlspecialchars($lhp['MaLopHocPhan']); ?></td>
                                <td class="py-3 px-4 border-b"><?php echo htmlspecialchars($lhp['TenHP']); ?></td>
                                <td class="py-3 px-4 border-b"><?php echo htmlspecialchars($lhp['DiaDiem']); ?></td>
                                <td class="py-3 px-4 border-b"><?php echo htmlspecialchars($lhp['HoTen']); ?></td>
                                <td class="py-3 px-4 border-b"><?php echo htmlspecialchars($lhp['MaLop']); ?></td>
                                <td class="py-3 px-4 border-b">
                                    <a href="LHP_ChinhSua.php?MaLHP=<?php echo $lhp['MaLopHocPhan']?>"><img src='../asset/Images/edit.png' class='h-12'/></a>
                                </td>
                            </tr>
                            <?php
                            $stt++;
                        }
                    } else {
                        echo "<tr><td colspan='6' class='py-3 px-4 text-center'>Không có môn học nào</td></tr>";
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>
    </div>
</body>
<?php include_once __DIR__ . "/../layout/footer.php"; ?>