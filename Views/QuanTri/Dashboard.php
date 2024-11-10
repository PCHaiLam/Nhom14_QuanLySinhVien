<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí sinh viên</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col">
<?php include_once __DIR__ . "/../../layout/header.php"; ?>
<div class="max-w-4xl mx-auto my-8 space-y-6">
        <div class="flex justify-between items-center bg-gray-200 p-4 text-gray-800 rounded-lg shadow">
            <p class="text-lg font-semibold">Tài khoản:
            <?php require_once __DIR__ . '/../../config/db.php';
                session_start();

                if (!isset($_SESSION['user'])) {
                    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
                    header('Location: index.php');
                    exit;
                }
                echo "<h1 class='uppercase'>" . $_SESSION['HoTen'] . "</h1>";

                $conn->close();  // Đóng kết nối khi xong
            ?>
            </p>
            <div class="icons">
                <a href="loginPage.php" class="text-blue-600 hover:underline">Đăng xuất</a>
            </div>
        </div>

        <div class="menu grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="QuanLyThongTinSinhVien.php" class="menu-item bg-blue-600 text-white flex justify-center items-center h-36 rounded-lg font-bold text-center hover:bg-blue-800 transition-colors">
                Thông tin sinh viên
            </a>
            <div class="menu-item bg-blue-600 text-white flex justify-center items-center h-36 rounded-lg font-bold text-center hover:bg-blue-800 transition-colors">
                Kế hoạch học tập
            </div>
            <div class="menu-item bg-blue-600 text-white flex justify-center items-center h-36 rounded-lg font-bold text-center hover:bg-blue-800 transition-colors">
                Đăng ký học phần
            </div>
            <div class="menu-item bg-blue-600 text-white flex justify-center items-center h-36 rounded-lg font-bold text-center hover:bg-blue-800 transition-colors">
                Kết quả học tập
            </div>
        </div>
    </div>

<?php include_once __DIR__ . "/../../layout/footer.php"; ?>

</body>
</html>