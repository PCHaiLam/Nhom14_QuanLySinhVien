<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            padding: 10px 10px 10px 0px;
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
    </style>
</head>
<body>

<div class="login-container">
    <img src="NTU.jpg" alt="NTU Logo">
    <h1>TRƯỜNG ĐẠI HỌC NHA TRANG</h1>
    <h2>HỆ THỐNG TÍCH HỢP THÔNG TIN</h2>
    <form action="student_management.php" method="POST">
        <tr>
            <input type="text" name="username" placeholder="Nhập mã số sinh viên" required>
            <input type="password" name="password" placeholder="Nhập mật khẩu" required>
        </tr>
        <a href="forgot_password.php">Quên mật khẩu</a>
        <button type="submit">ĐĂNG NHẬP</button>
    </form>
</div>

</body>
</html>
