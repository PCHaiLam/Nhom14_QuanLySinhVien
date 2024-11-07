<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 flex justify-center items-center h-screen font-sans">

<div class="bg-white p-8 rounded-lg shadow-lg w-96 text-center">
    <img src="NTU.jpg" alt="NTU Logo" class="w-20 mx-auto mb-6">
    <h1 class="text-2xl font-bold text-blue-800 mb-2">TRƯỜNG ĐẠI HỌC NHA TRANG</h1>
    <h2 class="text-lg text-blue-600 mb-6">HỆ THỐNG TÍCH HỢP THÔNG TIN</h2>
    
    <form action="student_management.php" method="POST">
        <div class="mb-4">
            <input type="text" name="username" placeholder="Nhập mã số sinh viên" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="mb-6">
            <input type="password" name="password" placeholder="Nhập mật khẩu" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <a href="forgot_password.php" class="text-sm text-blue-500 hover:underline block mb-4">Quên mật khẩu?</a>
        <button type="submit" class="w-full p-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">ĐĂNG NHẬP</button>
        <a href="userLogin.php" class="text-sm text-blue-500 hover:underline block mt-4">Đăng nhập với sinh viên</a>
    </form>
</div>

</body>
</html>
