-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 06:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlsv`
--

-- --------------------------------------------------------

--
-- Table structure for table `giaovien`
--

CREATE TABLE `giaovien` (
  `MaGV` varchar(20) NOT NULL,
  `HoTen` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `giaovien`
--

INSERT INTO `giaovien` (`MaGV`, `HoTen`, `Email`) VALUES
('GV01', 'Bùi Thị Hồng Minh', 'minh.bth@ntu.edu.vn'),
('GV02', 'Nguyễn Khắc Cường', 'cuong.nk@ntu.edu.vn'),
('GV03', 'Nguyễn Đức Thuần', 'thuan.nd@ntu.edu.vn'),
('GV04', 'Mai Cường Thọ', 'tho.mc@ntu.edu.vn'),
('GV05', 'Bùi Chí Thành', 'thanh.bc@ntu.edu.vn'),
('GV06', 'Huỳnh Huy', 'huy@ntu.edu.vn');

-- --------------------------------------------------------

--
-- Table structure for table `hocki`
--

CREATE TABLE `hocki` (
  `MaHocKi` varchar(15) NOT NULL,
  `TenHocKi` varchar(50) NOT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `NgayKetThuc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `hocki`
--

INSERT INTO `hocki` (`MaHocKi`, `TenHocKi`, `NgayBatDau`, `NgayKetThuc`) VALUES
('2021-2022_HE', 'Học Kỳ hè', '2022-06-01', '2022-08-31'),
('2021-2022_HK1', 'Học Kỳ 1', '2021-09-01', '2022-01-15'),
('2021-2022_HK2', 'Học Kỳ 2', '2022-01-16', '2022-05-31'),
('2022-2023_HE', 'Học Kỳ hè', '2023-06-01', '2023-08-31'),
('2022-2023_HK1', 'Học Kỳ 1', '2022-09-01', '2023-01-15'),
('2022-2023_HK2', 'Học Kỳ 2', '2023-01-16', '2023-05-31'),
('2023-2024_HE', 'Học Kỳ hè', '2024-06-01', '2024-08-31'),
('2023-2024_HK1', 'Học Kì 1', '2023-09-01', '2024-01-15'),
('2023-2024_HK2', 'Học Kỳ 2', '2024-01-16', '2024-05-31'),
('2024-2025_HE', 'Học Kỳ hè', '2025-06-01', '2025-08-31'),
('2024-2025_HK1', 'Học Kỳ 1', '2024-09-01', '2025-01-15'),
('2024-2025_HK2', 'Học Kỳ 2', '2025-01-16', '2025-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `MaKhoa` varchar(10) NOT NULL,
  `TenKhoa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`MaKhoa`, `TenKhoa`) VALUES
('01-CNTT', 'Công nghệ thông tin'),
('02-KT', 'Kinh tế'),
('03-DL', 'Du lịch'),
('04-HTTT', 'Hệ thống thông tin');

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `MaLop` varchar(10) NOT NULL,
  `TenLop` varchar(100) NOT NULL,
  `MaKhoa` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`MaLop`, `TenLop`, `MaKhoa`) VALUES
('63.CNTT-1', 'Công Nghệ Thông Tin 1', '01-CNTT'),
('63.CNTT-2', 'Công Nghệ Thông Tin 2', '01-CNTT'),
('63.DL-1', 'Du Lịch 1', '03-DL'),
('63.DL-2', 'Du lịch 2', '03-DL'),
('63.KT-1', 'Kinh Tế 1', '02-KT'),
('63.KT-2', 'Kinh Tế 2', '02-KT');

-- --------------------------------------------------------

--
-- Table structure for table `lophocphan`
--

CREATE TABLE `lophocphan` (
  `MaLopHocPhan` varchar(20) NOT NULL,
  `MaMonHoc` varchar(10) DEFAULT NULL,
  `DiaDiem` varchar(20) DEFAULT NULL,
  `MaGV` varchar(20) DEFAULT NULL,
  `MaLop` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lophocphan`
--

INSERT INTO `lophocphan` (`MaLopHocPhan`, `MaMonHoc`, `DiaDiem`, `MaGV`, `MaLop`) VALUES
('Android_63.CNTT-1', 'Android', 'G6-101', 'GV04', '63.CNTT-1'),
('Android_63.CNTT-2', 'Android', 'G6-201', 'GV04', '63.CNTT-2'),
('CTDL-GT_63.CNTT-1', 'CTDL-GT', 'G6-103', 'GV03', '63.CNTT-1'),
('CTDL-GT_63.CNTT-2', 'CTDL-GT', 'G6-202', 'GV02', '63.CNTT-2'),
('HDH_63.CNTT-1', 'HDH', 'G6-101', 'GV05', '63.CNTT-1'),
('HDH_63.CNTT-2', 'HDH', 'G6-104', 'GV05', '63.CNTT-2'),
('QLDAPM_63.CNTT-2', 'QL_DAPM', 'G6-103', 'GV02', '63.CNTT-2');

-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE `monhoc` (
  `MaHP` varchar(10) NOT NULL,
  `TenHP` varchar(100) NOT NULL,
  `SoTinChi` int(11) NOT NULL,
  `DonGia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `monhoc`
--

INSERT INTO `monhoc` (`MaHP`, `TenHP`, `SoTinChi`, `DonGia`) VALUES
('Android', 'Lập trình Android', 2, 460000),
('CNPM', 'Công nghệ phần mềm', 3, 450000),
('CSDL', 'Cơ sở dữ liệu', 3, 450000),
('CTDL-GT', 'Cấu trúc dữ liệu và giải thuật', 4, 450000),
('GDQPNN', 'Giáo dục Quốc phòng - An ninh', 12, 220000),
('GDTC', 'Giáo dục thể chất', 2, 220000),
('HDH', 'Hệ điều hành', 3, 450000),
('HQT_CSDL', 'Hệ quản trị cơ sở dữ liệu', 3, 450000),
('KT-TDPM', 'Kiến trúc và thiết kế phần mềm', 3, 450000),
('KTLT', 'Kỹ thuật lập trình', 3, 450000),
('KTM', 'Kiến trúc máy tính', 3, 450000),
('LT-HDT', 'Lập trình hướng đối tượng', 3, 450000),
('LT-Nhung', 'Lập trình nhúng', 3, 450000),
('MMT', 'Mạng máy tính', 3, 450000),
('NMCNTT', 'Nhập môn ngành CNTT', 3, 450000),
('NMLP', 'Nhập môn lập trình', 3, 450000),
('PT-TKHTTT', 'Phân tích hệ thống thông tin', 3, 450000),
('PT-UDWeb', 'Phát triển ứng dụng Web', 3, 450000),
('QL_DAPM', 'Quản lý dự án phần mềm', 3, 450000),
('TACN', 'Tiếng Anh chuyên ngành', 3, 450000),
('TiengAnh', 'Tiếng Anh', 3, 450000),
('TinHocDC', 'Tin học đại cương A', 3, 450000),
('TKMT', 'Thống kê máy tính', 3, 450000),
('TKWeb', 'Thiết kế Web', 3, 450000),
('Toan1', 'Toán 1', 3, 450000),
('ToanRR', 'Toán rời rạc', 3, 450000),
('TTCS', 'Thực tập cơ sở', 3, 450000),
('VLDC', 'Vật lí đại cương', 2, 220000),
('XS-TK', 'Xác suất- Thống kê', 3, 450000);

-- --------------------------------------------------------

--
-- Table structure for table `phonghoc`
--

CREATE TABLE `phonghoc` (
  `DiaDiem` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `phonghoc`
--

INSERT INTO `phonghoc` (`DiaDiem`) VALUES
('G6-101'),
('G6-102'),
('G6-103'),
('G6-104'),
('G6-201'),
('G6-202'),
('G6-203'),
('G6-204'),
('G6-301'),
('G6-302'),
('G6-303'),
('G6-304');

-- --------------------------------------------------------

--
-- Table structure for table `quantri`
--

CREATE TABLE `quantri` (
  `TaiKhoan` varchar(20) NOT NULL,
  `MatKhau` varchar(20) NOT NULL,
  `Quyen` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quantri`
--

INSERT INTO `quantri` (`TaiKhoan`, `MatKhau`, `Quyen`) VALUES
('63010002', '123', 2),
('63010003', '123', 2),
('63010004', '123', 2),
('admin', 'admin', 0),
('GV01', '123', 1),
('GV02', '123', 1),
('GV03', '123', 1),
('GV04', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MaSV` varchar(20) NOT NULL,
  `HoTen` varchar(100) NOT NULL,
  `NgaySinh` date DEFAULT NULL,
  `GioiTinh` varchar(10) NOT NULL,
  `DiaChi` varchar(200) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `SDT` varchar(15) DEFAULT NULL,
  `AnhSV` varchar(100) NOT NULL,
  `MaLop` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`MaSV`, `HoTen`, `NgaySinh`, `GioiTinh`, `DiaChi`, `Email`, `SDT`, `AnhSV`, `MaLop`) VALUES
('63010001', 'Nguyễn Văn A', '2000-01-01', 'Nam', '123 Đường ABC', 'a@example.com', '0123456789', 'student.jpg', '63.CNTT-1'),
('63010002', 'Trần Thị B', '2000-02-02', 'Nữ', '456 Đường DEF', 'b@example.com', '0987654321', 'student.jpg', '63.CNTT-1'),
('63010003', 'Lê Thị C', '2000-03-03', 'Nữ', '789 Đường GHI', 'c@example.com', '0123456789', 'student.jpg', '63.CNTT-2'),
('63010004', 'Nguyễn Thị D', '2000-04-04', 'Nữ', '101 Đường JKL', 'd@example.com', '0987654321', 'student.jpg', '63.CNTT-2'),
('63020001', 'Trần Văn E', '2000-05-05', 'Nam', '202 Đường MNO', 'e@example.com', '0123456789', 'student.jpg', '63.KT-1'),
('63020002', 'Phạm Minh F', '2000-06-06', 'Nam', '303 Đường PQR', 'f@example.com', '0987654321', 'student.jpg', '63.KT-1'),
('65010002', 'Phan Châu Hải Lâm', '2000-11-11', 'Nam', 'Khánh Hòa', 'lam@gmail.com', '0123123123', 'admin.png', '63.CNTT-2'),
('65010003', 'Thanh Mỹ', '2011-11-11', 'Nữ', 'Khánh Hòa', 'myx@gmail.com', '0123123123', 'image.png', '63.CNTT-1'),
('65010004', 'Năm Cự', '2002-11-21', 'Nữ', 'Khánh Hòa', 'cu.n.651@ntu.edu.vn', '0198287221', 'image.png', '63.CNTT-1'),
('65010005', 'Khá Bảnh', '2002-11-11', 'Nam', 'Khánh Hòa', 'banh.k.651@ntu.edu.vn', '02827222222', 'gitiocn.png', '63.CNTT-1'),
('65010006', 'Hải Quay Xe', '2002-11-11', 'Nam', 'Khánh Hòa', 'xe.hq.65CNTT@ntu.edu.vn', '0198287221', 'gitiocn.png', '63.CNTT-1'),
('65010007', 'Hương Ngoài Đèo', '2021-11-11', 'Nữ', 'Khánh Hòa', 'deo.hn.65cntt@ntu.edu.vn', '0198287221', 'gitiocn.png', '63.CNTT-1'),
('65010008', 'Lê Sang Húc', '2011-11-22', 'Nam', 'World', 'huc.ls.65cntt@ntu.edu.vn', '0123123123', 'gitiocn.png', '63.CNTT-1'),
('65010009', 'Chô Ke Vy', '2000-11-11', 'Nam', 'Eo Ci Cây', 'vy.ck.65cntt@ntu.edu.vn', '0123123123', 'gitiocn.png', '63.CNTT-1');

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien_lophocphan`
--

CREATE TABLE `sinhvien_lophocphan` (
  `MaSV` varchar(10) NOT NULL,
  `MaLopHocPhan` varchar(20) NOT NULL,
  `Diem` float DEFAULT NULL,
  `MaHocKi` varchar(15) NOT NULL,
  `NgayDongHocPhi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sinhvien_lophocphan`
--

INSERT INTO `sinhvien_lophocphan` (`MaSV`, `MaLopHocPhan`, `Diem`, `MaHocKi`, `NgayDongHocPhi`) VALUES
('63010001', 'Android_63.CNTT-1', 7.5, '2023-2024_HK1', '2023-09-01 00:00:00'),
('63010001', 'CTDL-GT_63.CNTT-1', 8, '2023-2024_HK1', '2023-09-05 00:00:00'),
('63010001', 'HDH_63.CNTT-1', 6.5, '2023-2024_HK1', '2023-09-10 00:00:00'),
('63010001', 'QLDAPM_63.CNTT-2', 7, '2023-2024_HK1', '2023-09-15 00:00:00'),
('63010001', 'Android_63.CNTT-2', 8.2, '2023-2024_HK1', '2023-09-20 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD PRIMARY KEY (`MaGV`);

--
-- Indexes for table `hocki`
--
ALTER TABLE `hocki`
  ADD PRIMARY KEY (`MaHocKi`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`MaKhoa`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`MaLop`),
  ADD KEY `MaKhoa` (`MaKhoa`);

--
-- Indexes for table `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD PRIMARY KEY (`MaLopHocPhan`),
  ADD KEY `FK_LopHocPhan_MonHoc` (`MaMonHoc`),
  ADD KEY `MaGV` (`MaGV`),
  ADD KEY `MaLop` (`MaLop`),
  ADD KEY `DiaDiem` (`DiaDiem`);

--
-- Indexes for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`MaHP`);

--
-- Indexes for table `phonghoc`
--
ALTER TABLE `phonghoc`
  ADD PRIMARY KEY (`DiaDiem`);

--
-- Indexes for table `quantri`
--
ALTER TABLE `quantri`
  ADD PRIMARY KEY (`TaiKhoan`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MaSV`),
  ADD KEY `FK_SinhVien_Lop` (`MaLop`);

--
-- Indexes for table `sinhvien_lophocphan`
--
ALTER TABLE `sinhvien_lophocphan`
  ADD KEY `FK_SinhVien_LopHocPhan_SinhVien` (`MaSV`),
  ADD KEY `FK_SinhVien_LopHocPhan_LopHocPhan` (`MaLopHocPhan`),
  ADD KEY `FK_SinhVien_LopHocPhan_HocKi` (`MaHocKi`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`);

--
-- Constraints for table `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD CONSTRAINT `FK_LopHocPhan_MonHoc` FOREIGN KEY (`MaMonHoc`) REFERENCES `monhoc` (`MaHP`),
  ADD CONSTRAINT `lophocphan_ibfk_1` FOREIGN KEY (`MaGV`) REFERENCES `giaovien` (`MaGV`),
  ADD CONSTRAINT `lophocphan_ibfk_2` FOREIGN KEY (`MaLop`) REFERENCES `lop` (`MaLop`),
  ADD CONSTRAINT `lophocphan_ibfk_3` FOREIGN KEY (`DiaDiem`) REFERENCES `phonghoc` (`DiaDiem`);

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `FK_SinhVien_Lop` FOREIGN KEY (`MaLop`) REFERENCES `lop` (`MaLop`);

--
-- Constraints for table `sinhvien_lophocphan`
--
ALTER TABLE `sinhvien_lophocphan`
  ADD CONSTRAINT `FK_SinhVien_LopHocPhan_HocKi` FOREIGN KEY (`MaHocKi`) REFERENCES `hocki` (`MaHocKi`),
  ADD CONSTRAINT `FK_SinhVien_LopHocPhan_LopHocPhan` FOREIGN KEY (`MaLopHocPhan`) REFERENCES `lophocphan` (`MaLopHocPhan`),
  ADD CONSTRAINT `FK_SinhVien_LopHocPhan_SinhVien` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
