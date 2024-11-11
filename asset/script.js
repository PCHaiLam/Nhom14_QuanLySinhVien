function loadLopByKhoa() {
    var maKhoa = document.getElementById("khoaOption").value;

    // Gửi yêu cầu AJAX tới server
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "QuanLyThongTinSinhVien.php?maKhoa=" + maKhoa, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("lopOption").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
