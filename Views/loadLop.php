<?php
require_once __DIR__ . '/../config/db.php';

$maKhoa = isset($_GET['maKhoa']) ? $_GET['maKhoa'] : 'allKhoa';

if ($maKhoa != 'allKhoa') {
    $sql = "SELECT * FROM lop WHERE MaKhoa = '$maKhoa'";
} else {
    $sql = "SELECT * FROM lop";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($lop = $result->fetch_assoc()) {
        echo "<option value=\"" . $lop['MaLop'] . "\">" . htmlspecialchars($lop['TenLop']) . "</option>";
    }
} else {
    echo "<option value=\"\">Không có lớp nào</option>";
}
?>
