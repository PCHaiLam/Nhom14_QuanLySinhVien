<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management Interface</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f0f8ff;
        }

        .header {
            text-align: center;
            background: #003366;
            color: white;
            padding: 20px;
        }

        .header .logo {
            width: 60px;
            height: auto;
            display: inline-block;
        }

        .header h1, .header h2 {
            margin: 10px 0;
        }

        .user-info {
            display: flex;
            justify-content: space-between;
            background: #e8e8e8;
            padding: 10px;
            color: #333;
            font-size: 16px;
        }

        .menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px;
            gap: 20px;
        }

        .menu-item {
            width: 150px;
            height: 150px;
            background: #0066cc;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-weight: bold;
            border-radius: 8px;
            transition: background 0.3s;
            cursor: pointer;
        }

        .menu-item:hover {
            background: #004b8d;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background: #e8e8e8;
            color: #333;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="NTU.jpg" alt="NTU Logo" class="logo">
        <h1>TRƯỜNG ĐẠI HỌC NHA TRANG</h1>
        <h2>HỆ THỐNG TÍCH HỢP THÔNG TIN</h2>
    </div>
    <div class="content">
        <div class="user-info">
            <p>Tài khoản: <b>Huỳnh Gia Kiệt</b></p>
            <div class="icons">
                <span>&#128276;</span> <!-- Settings Icon -->
                <span>&#128276;</span> <!-- Logout Icon -->
            </div>
        </div>
        <div class="menu">
            <div class="menu-item">Thời khóa biểu</div>
            <div class="menu-item">Đánh giá rèn luyện</div>
            <div class="menu-item">Thông tin sinh viên</div>
            <div class="menu-item">Kế hoạch học tập</div>
            <div class="menu-item">Đăng ký học phần</div>
            <div class="menu-item">Xem lịch thi</div>
            <div class="menu-item">Nhận xét học phần</div>
            <div class="menu-item">Kết quả học tập</div>
            <div class="menu-item">Ký túc xá</div>
            <div class="menu-item">Học phí</div>
            <div class="menu-item">Xét tốt nghiệp</div>
            <div class="menu-item">Sinh viên - Đề tài luận văn</div>
        </div>
    </div>
    <div class="footer">
        <p>Thiết kế 2016-2024 bởi CUSC</p>
    </div>
</body>
</html>
