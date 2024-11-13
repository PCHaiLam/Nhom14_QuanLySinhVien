-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 01:06 PM
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
('2023-2024_HE', 'Học Kì hè', NULL, NULL),
('2023-2024_HK1', 'Học Kì 1', NULL, NULL),
('2023-2024_HK2', 'Học Kì 2', NULL, NULL);

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
('03-DL', 'Du lịch');

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
  `DiaDiem` varchar(100) DEFAULT NULL,
  `MaGV` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lophocphan`
--

INSERT INTO `lophocphan` (`MaLopHocPhan`, `MaMonHoc`, `DiaDiem`, `MaGV`) VALUES
('Android_63.CNTT-1', 'Android', 'G6-101', 'GV04'),
('Android_63.CNTT-2', 'Android', 'G6-103', 'GV04'),
('CTDL-GT_63.CNTT-1', 'CTDL-GT', 'G6-203', 'GV03'),
('CTDL-GT_63.CNTT-2', 'CTDL-GT', 'G6-201', 'GV02'),
('HDH_63.CNTT-1', 'HDH', 'G6-303', 'GV05'),
('HDH_63.CNTT-2', 'HDH', 'G6-103', 'GV05'),
('QLDAPM_63.CNTT-2', 'QL_DAPM', 'G6-102', 'GV02');

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
('Android', 'Lập trình Android', 3, 450000),
('CTDL-GT', 'Cấu trúc dữ liệu và giải thuật', 4, 450000),
('HDH', 'Hệ điều hành', 3, 450000),
('QL_DAPM', 'Quản lý dự án phần mềm', 3, 450000);

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
('63020003', 'Bùi Minh G', '2000-07-07', 'Nam', '404 Đường STU', 'g@example.com', '0123456789', 'student.jpg', '63.KT-2'),
('63020004', 'Võ Thị H', '2000-08-08', 'Nữ', '505 Đường VWX', 'h@example.com', '0987654321', 'student.jpg', '63.KT-2'),
('63030001', 'Lê Minh I', '2000-09-09', 'Nam', '606 Đường YZ', 'i@example.com', '0123456789', 'student.jpg', '63.DL-1'),
('63030002', 'Trần Minh J', '2000-10-10', 'Nam', '707 Đường ABC', 'j@example.com', '0987654321', 'student.jpg', '63.DL-1'),
('63030003', 'Nguyễn Minh K', '2000-11-11', 'Nam', '808 Đường DEF', 'k@example.com', '0123456789', 'student.jpg', '63.DL-2'),
('63030004', 'Lê Thị L', '2000-12-12', 'Nữ', '909 Đường GHI', 'l@example.com', '0987654321', 'student.jpg', '63.DL-2');

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
('63010001', 'Android_63.CNTT-1', NULL, '2023-2024_HK1', NULL),
('63010001', 'CTDL-GT_63.CNTT-1', NULL, '2023-2024_HK1', NULL),
('63010001', 'HDH_63.CNTT-1', NULL, '2023-2024_HK1', NULL),
('63010001', 'QLDAPM_63.CNTT-2', NULL, '2023-2024_HK1', NULL);

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
  ADD KEY `MaGV` (`MaGV`);

--
-- Indexes for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`MaHP`);

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
  ADD CONSTRAINT `lophocphan_ibfk_1` FOREIGN KEY (`MaGV`) REFERENCES `giaovien` (`MaGV`);

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
