<?php 
session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/QuanTriController.php';
$quantriController = new QuanTriController($conn);
?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<body>
<div class="max-w-4xl mx-auto my-8 space-y-6 h-[505px]">
        <div class="menu grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="SV_DS.php" class="menu-item bg-blue-600 text-white flex justify-center items-center h-36 rounded-lg font-bold text-center hover:bg-blue-800 transition-colors">
                Thông tin sinh viên
            </a>
            <a href="MH_DS.php" class="menu-item bg-blue-600 text-white flex justify-center items-center h-36 rounded-lg font-bold text-center hover:bg-blue-800 transition-colors">
                Môn học
            </a>
            <a href="LHP_DS.php" class="menu-item bg-blue-600 text-white flex justify-center items-center h-36 rounded-lg font-bold text-center hover:bg-blue-800 transition-colors">
                Lớp học phần
            </a>
            <a href="DiemLHP.php" class="menu-item bg-blue-600 text-white flex justify-center items-center h-36 rounded-lg font-bold text-center hover:bg-blue-800 transition-colors">
                Điểm
            </a>
        </div>
    </div>
<?php include_once __DIR__ . "/../layout/footer.php"; ?>
</body>