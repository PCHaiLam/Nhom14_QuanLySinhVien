<?php
session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/MonHocController.php';

$monhocController = new MonHocController($conn);

if (isset($_GET['MaHP'])) {
    $maHP = $_GET['MaHP'];
}

$monhoc = $monhocController->ChiTietMonHoc($maHP);

if (isset($_POST['SuaMH'])) {
    $tenMonHoc = $_POST['tenMonHoc'];
    $soTC = $_POST['soTC'];
    $donGia = $_POST['donGia'];

    $message = $monhocController->SuaMonHoc($maHP, $tenMonHoc, $soTC, $donGia);
}

//Xóa môn học
if (isset($_POST['XoaMonHoc'])) {
    $maHP = $_POST['MaHP'];
    $message = $monhocController->XoaMonHoc($maHP);
}

?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<body>
    <div class="m-4 mx-2 min-h-[535px] ">
        <button onclick="window.history.back()" class="px-3 py-2 bg-gray-400">Quay lại</button>
        <div id="" class="flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-max shadow-lg border-2 relative">

                <button onclick="openModal()" class="absolute top-2 right-2 text-5xl text-red-500 hover:text-red-600"><i
                        class="fa-solid fa-trash"></i></button>

                <div id="confirmModal"
                    class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white p-6 rounded-lg">
                        <h2 class="text-xl font-bold mb-4">Xác nhận xóa</h2>
                        <p class="mb-6">Bạn có chắc chắn muốn xóa môn học này không?</p>
                        <div class="flex justify-end space-x-4">
                            <button class="bg-gray-300 px-4 py-2 rounded" onclick="closeModal()">Hủy</button>
                            <form method="POST" action="">
                                <input type="hidden" name="MaHP" value="<?php echo $maHP ?>">
                                <button name="XoaMonHoc" class='bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600'>Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>

                <h2 class="text-xl font-bold mb-4 text-center">Sửa môn học</h2>

                <form method="POST" action="" class="grid grid-cols-2 gap-4 mt-4">

                    <div class="">
                        <label class="block font-medium">Mã Môn Học</label>
                        <input type="text" name="maMonHoc" value="<?php echo $monhoc['MaHP'] ?>"
                            class="bg-gray-200 w-full px-3 py-2 border rounded-md" disabled>
                    </div>
                    <div class="">
                        <label class="block font-medium">Tên Môn Học</label>
                        <input type="text" name="tenMonHoc" value="<?php echo $monhoc['TenHP'] ?>"
                            class="w-full px-3 py-2 border rounded-md">
                    </div>
                    <div class="">
                        <label class="block font-medium">Số Tín Chỉ</label>
                        <input type="number" min="1" step="1" name="soTC" value="<?php echo $monhoc['SoTinChi'] ?>"
                            class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">Đơn Giá</label>
                        <input type="number" min="220000" step="10000" name="donGia"
                            value="<?php echo $monhoc['DonGia'] ?>" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="col-span-2 text-center">
                        <button type="submit" name="SuaMH" value="SuaMH"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Xác nhận</button>
                    </div>
                    <div class="col-span-2 text-center">
                        <?php
                        // Hiển thị thông báo kết quả thêm môn học mới
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

<script>
    function openModal() {
        document.getElementById('confirmModal').classList.remove('hidden'); // Hiện modal
    }

    function closeModal() {
        document.getElementById('confirmModal').classList.add('hidden'); // Ẩn modal
    }
</script>
<?php include_once __DIR__ . "/../layout/footer.php"; ?>