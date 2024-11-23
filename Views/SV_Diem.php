<?php 
@session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../Controllers/SinhVien_LopHocPhanController.php';

$sv_lhpController = new SinhVien_LopHocPhanController($conn);

$maSV = isset($_GET['MaSV']) ? $_GET['MaSV'] : null;

$markList = $sv_lhpController->DanhSachDiem($maSV);
?>

<?php include_once __DIR__ . "/../layout/header.php"; ?>
<body>
    <div class="mx-4 mx-2 min-h-[565px]">
    <button onclick="window.history.back()" class="px-3 bg-gray-400 mt-2">Quay lại</button>
        
    <?php if ($markList && $markList->num_rows > 0): ?>
            <h1 class="text-2xl font-bold text-gray-800 mb-4 text-center">Quá trình học tập</h1>
            <?php 
            $currentYearSemester = ''; // Học kỳ hiện tại
            $stt=1;
            while ($row = $markList->fetch_assoc()): 
                $yearSemester = $row['MaHocKi'];

                // Bắt đầu bảng mới khi gặp học kỳ mới
                if ($yearSemester != $currentYearSemester): 
                    if ($currentYearSemester != ''): ?>
                        </table><br>
                    <?php endif; ?>

                    <!-- Tiêu đề học kỳ -->
                    <h2 class="text-xl font-semibold text-blue-600 mb-2"><?= $yearSemester ?>:</h2>
                    <table class="table-auto border-collapse border border-gray-400 w-1/2 mx-auto mb-4">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-400 px-4 py-2 text-left">STT</th>
                                <th class="border border-gray-400 px-4 py-2 text-left">Mã môn học</th>
                                <th class="border border-gray-400 px-4 py-2 text-left">Tên môn học</th>
                                <th class="border border-gray-400 px-4 py-2 text-left">Số tín chỉ</th>
                                <th class="border border-gray-400 px-4 py-2 text-left">Điểm</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php 
                    $currentYearSemester = $yearSemester; 
                endif;

                // Hiển thị từng môn học và điểm
                ?>
                <tr>
                    <td class="border border-gray-400 px-4 py-2"><?= $stt; ?></td>
                    <td class="border border-gray-400 px-4 py-2"><?= $row['MaHP'] ?></td>
                    <td class="border border-gray-400 px-4 py-2"><?= $row['TenHP'] ?></td>
                    <td class="border border-gray-400 px-4 py-2"><?= $row['SoTinChi'] ?></td>
                    <td class="border border-gray-400 px-4 py-2">
                        <?= is_null($row['Diem']) ? "N/A" : $row['Diem'] ?>
                    </td>
                </tr>
            <?php $stt++; endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h1 class="text-xl font-semibold text-red-500 text-center">Sinh viên chưa có điểm thành phần.</h1>
        <?php endif; ?>
    </div>
</body>
<?php include_once __DIR__ . "/../layout/footer.php"; ?>