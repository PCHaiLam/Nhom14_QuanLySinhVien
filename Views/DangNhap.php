<?php 
@session_start();
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Controllers/QuanTriController.php';

$quantriController = new QuanTriController($conn);
$mess = "";
// Kiểm tra nếu đã gửi thông tin đăng nhập
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['taikhoan'];
    $password = $_POST['password'];
    
    if($quantriController->login($username, $password) == 0) {
        header("Location: AdminPage.php");
        exit();
    }else if ($quantriController->login($username, $password) == 1) {
        header("Location: GiaoVienPage.php");
        exit();
    }else if ($quantriController->login($username, $password) == 2) {
        header("Location: SinhVienPage.php");
        exit();
    }
    else {
        $mess = "Tên đăng nhập hoặc mật khẩu không đúng!!!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 flex justify-center items-center h-screen font-sans">

<div class="bg-white p-8 rounded-lg shadow-lg w-96 text-center">
    <img src="../asset/Images/NTU.jpg" alt="NTU Logo" class="w-20 mx-auto mb-6">
    <h1 class="text-2xl font-bold text-blue-800 mb-2">TRƯỜNG ĐẠI HỌC NHA TRANG</h1>
    <h2 class="text-lg text-blue-600 mb-6">HỆ THỐNG TÍCH HỢP THÔNG TIN</h2>
    
    <form action="" method="POST">
        <div class="mb-4">
            <input type="text" name="taikhoan" placeholder="Nhập tài khoản" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="mb-6">
            <input type="password" name="password" placeholder="Nhập mật khẩu" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        
        <a href="forgot_password.php" class="text-sm text-blue-500 hover:underline block mb-4">Quên mật khẩu?</a>
        <button type="submit" class="w-full p-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">ĐĂNG NHẬP</button>
    </form>
</div>

</body>
</html>
