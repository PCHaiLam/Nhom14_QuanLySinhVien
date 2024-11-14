function loadLopByKhoa() {
    var khoaId = document.getElementById('khoaOption').value;

    // Gửi yêu cầu AJAX tới chính file PHP hiện tại
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "Student_Create.php?khoaOption=" + khoaId, true); // Sử dụng file hiện tại
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Cập nhật danh sách lớp vào phần tử #lopOption
            document.getElementById('lopOption').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}