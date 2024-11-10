<?php
session_start(); // Khởi tạo session
include_once './config/db.php';
include_once './Controllers/QuanTriController.php';
include_once './Views/QuanTri/loginPage.php';

// Kiểm tra nếu đã gửi thông tin đăng nhập
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['taikhoan'];
    $password = $_POST['password'];
    
    $controller = new QuanTriController($conn);
    $controller->login($username, $password);
}

// $controllerName = ucfirst(strtolower($_REQUEST['controller']??'Welcome').'Controller');

// require "./Controllers/QuanTriController.php"

?>
