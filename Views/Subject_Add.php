<?php
session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/MonHocController.php';
$monhocController = new MonHocController($conn);

if(isset($_POST['ThemMH'])){
	$maMon = $_POST['maMonHoc'];
	$tenMon = $_POST['tenMonHoc'];
	$soTinChi = $_POST['soTC'];
	$donGia = $_POST['donGia'];
	$message = $monhocController->ThemMonHoc($maMon, $tenMon, $soTinChi, $donGia);
} 
?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<body>
    <div class="m-4 w-full mx-2 min-h-[520px] ">
        <button onclick="window.history.back()" class="px-3 py-2 bg-gray-400">Quay lại</button>
        <div id="" class="flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-max shadow-lg border-2">
                <h2 class="text-xl font-bold mb-4 text-center">Thêm môn học mới</h2>

                <form method="POST" action="" class="grid grid-cols-3 gap-4 mt-4" enctype="multipart/form-data">
                    
                    <div class="">
                        <label class="block font-medium">Mã Môn Học</label>
                        <input type="text" name="maMonHoc" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">Tên Môn Học</label>
                        <input type="text" name="tenMonHoc" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">Số Tín Chỉ</label>
                        <input type="text" name="soTC" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="">
                        <label class="block font-medium">Đơn Giá</label>
                        <input type="text" name="donGia" class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    <div class="col-span-3 text-center">
                        <button type="submit" name="ThemMH" value="ThemMH"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Thêm</button>
                    </div>
                    <div class="col-span-3 text-center">
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

<?php include_once __DIR__ . "/../layout/footer.php"; ?>