<?php 
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/QuanTriController.php';
$quantriController = new QuanTriController($conn);

if (!isset($_SESSION['User'])) {
    header('Location: loginPage.php');
    exit;
}

// Kiểm tra nếu action là logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    // Gọi hàm logout và kiểm tra nếu logout thành công
    if ($quantriController->logout()) {
        // Nếu logout thành công, chuyển hướng đến trang đăng nhập
        header('Location: loginPage.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí sinh viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../asset/script.js"></script>
</head>
<header class="flex justify-between items-center text-center bg-gradient-to-b from-blue-900 via-blue-900 to-blue-700 text-white px-10 h-24">
        <img src="../asset/Images/NTU.jpg" alt="NTU Logo" class="h-20 rounded-full">
        <div>
            <h1 class="text-2xl font-bold">TRƯỜNG ĐẠI HỌC NHA TRANG</h1>
            <h2 class="text-lg font-medium">HỆ THỐNG TÍCH HỢP THÔNG TIN</h2>
        </div>
        <div class="flex">
            <p>Tài khoản: <?php echo "<span class='underline'>" . $_SESSION['User']['HoTen'] . "</span>";?></p>
            <a title="Đăng xuất" href="?action=logout" class="text-white font-bold text-xl ml-4"><i class="fa-solid fa-power-off hover:text-red-500"></i></a>
        </div>
</header>