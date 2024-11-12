<?php 
session_start();
require_once __DIR__ . '/../config/db.php';
?>
<?php include_once __DIR__ . "/../layout/header.php"; ?>
<body>
    <div class="m-4 w-full mx-2 min-h-[520px] ">
    <button onclick="window.history.back()" class="px-3 py-2 bg-gray-400">Quay lại</button>
    <div id="" class="flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg w-[500px] shadow-lg border-2">
                    <h2 class="text-xl font-bold mb-4 text-center">Thêm sinh viên mới</h2>
                    <form method="POST" action="add_student.php">
                        <div class="mb-2">
                            <label class="block font-medium">Mã SV</label>
                            <input type="text" name="MaSV" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">Họ Tên</label>
                            <input type="text" name="HoTen" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">Ngày Sinh</label>
                            <input type="date" name="NgaySinh" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">Giới Tính</label>
                            <select name="GioiTinh" class="w-full px-3 py-2 border rounded-md" required>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">Địa Chỉ</label>
                            <input type="text" name="DiaChi" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">Email</label>
                            <input type="email" name="Email" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">SĐT</label>
                            <input type="tel" name="SDT" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium">Mã Lớp</label>
                            <input type="text" name="MaLop" class="w-full px-3 py-2 border rounded-md" required>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Hủy</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</body>
<?php include_once __DIR__ . "/../layout/footer.php"; ?>
