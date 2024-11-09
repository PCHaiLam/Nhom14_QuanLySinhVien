<?php
// Kết nối CSDL
$conn = mysqli_connect('localhost', 'root', '', 'quanlysinhvien') 
        OR die ('Không thể kết nối tới MySQL: ' . mysqli_connect_error());

// Kiểm tra nếu người dùng đã gửi biểu mẫu đăng nhập
$login_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = mysqli_real_escape_string($conn, $_POST['TaiKhoan']);
    $pass = mysqli_real_escape_string($conn, $_POST['MatKhau']);

    // Truy vấn để kiểm tra thông tin đăng nhập
    $sql = "SELECT HoTen FROM dangnhap WHERE TaiKhoan='$user' AND MatKhau='$pass'";
    //$sql = 'select HoTen,TaiKhoan,MatKhau from dangnhap';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Đăng nhập thành công
        $row = mysqli_fetch_assoc($result);
        $login_message = "Đăng nhập thành công! Chào mừng " . $row['HoTen'] . ".";
        $message_class = 'success';
        
        // Chuyển hướng đến trang quản lý sau 2 giây
        header("refresh:2;url=index.php");
    } else {
        // Đăng nhập thất bại
        $login_message = "Tên đăng nhập hoặc mật khẩu không chính xác.";
        $message_class = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
        }
        .login-container {
            width: 350px;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container img {
            width: 80px;
            margin-bottom: 20px;
        }
        .login-container h1 {
            font-size: 20px;
            color: #003366;
            margin-bottom: 10px;
        }
        .login-container h2 {
            font-size: 16px;
            color: #003366;
            margin-bottom: 20px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .login-container a {
            color: #004b8d;
            font-size: 14px;
            text-decoration: none;
            display: block;
            margin-top: 10px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #004b8d;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        .login-container button:hover {
            background-color: #003366;
        }
        /* CSS cho thông báo */
        .message {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<div class="login-container">
    <img src="NTU.jpg" alt="NTU Logo">
    <h1>TRƯỜNG ĐẠI HỌC NHA TRANG</h1>
    <h2>HỆ THỐNG TÍCH HỢP THÔNG TIN</h2>
    <form action="" method="POST">
        <input type="text" name="TaiKhoan" placeholder="Nhập mã số sinh viên" required>
        <input type="password" name="MatKhau" placeholder="Nhập mật khẩu" required>
        <!--<a href="forgot_password.php">Quên mật khẩu</a>-->
        <button type="submit">ĐĂNG NHẬP</button>
    </form>

    <!-- Hiển thị thông báo đăng nhập -->
    <?php if ($login_message != ''): ?>
        <div class="message <?= $message_class ?>">
            <?= $login_message ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
