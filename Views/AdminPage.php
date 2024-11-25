<?php 
session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/QuanTriController.php';
$quantriController = new QuanTriController($conn);
?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<body>
<div class="min-h-[568px] w-full">
        <div class="grid grid-cols-3 gap-5 w-1/2 mx-auto h-[400px] items-center">
            <a href="SV_DS.php" class="text-white flex items-center justify-around h-36 w-40 rounded-lg font-bold text-center bg-blue-600 bg-blue-600 hover:bg-blue-800 transition-colors">
                Thông tin sinh viên
            </a>
            <a href="MH_DS.php" class="text-white flex items-center justify-around h-36 w-40 rounded-lg font-bold text-center bg-blue-600 hover:bg-blue-800 transition-colors">
                Môn học
            </a>
            <a href="LHP_DS.php" class="text-white flex items-center justify-around h-36 w-40 rounded-lg font-bold text-center bg-blue-600 hover:bg-blue-800 transition-colors">
                Lớp học phần
            </a>
            <!-- <a href="DiemLHP.php" class="text-white h-36 rounded-lg font-bold text-center hover:bg-blue-800 transition-colors">
                Điểm
            </a> -->
        </div>
    </div>
<?php include_once __DIR__ . "/../layout/footer.php"; ?>
</body>