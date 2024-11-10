<?php
session_start(); // Khởi tạo session
include_once './config/db.php';
include_once './Controllers/QuanTriController.php';

    if(isset($_SESSION['User']) == -1) {
        header("Location: ./Views/loginPage.php");
        exit();
    }else if (isset($_SESSION['User']) == 0) {
        header("Location: ./Views/AdminPage.php");
        exit();
    }else if (isset($_SESSION['User']) == 1) {
        header("Location: ./Views/GiaoVienPage.php");
        exit();
    }else if (isset($_SESSION['User']) == 2) {
        header("Location: ./Views/SinhVienPage.php");
        exit();
    }
?>
