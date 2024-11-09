-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 09:11 PM
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
-- Database: `quanlysinhvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `dangnhap`
--

CREATE TABLE `dangnhap` (
  `Id` int(5) NOT NULL,
  `HoTen` varchar(100) DEFAULT NULL,
  `TaiKhoan` varchar(20) NOT NULL,
  `MatKhau` varchar(20) NOT NULL,
  `Role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dangnhap`
--

INSERT INTO `dangnhap` (`Id`, `HoTen`, `TaiKhoan`, `MatKhau`, `Role`) VALUES
(1, 'KIỆT', 'admin', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `diemhp`
--

CREATE TABLE `diemhp` (
  `MaSV` varchar(10) NOT NULL,
  `MaHP` varchar(10) NOT NULL,
  `DiemHP` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `diemhp`
--

INSERT INTO `diemhp` (`MaSV`, `MaHP`, `DiemHP`) VALUES
('SV001', 'HP001', 8.2),
('SV002', 'HP002', 7.8),
('SV003', 'HP003', 7),
('SV004', 'HP004', 6.5),
('SV005', 'HP005', 8.9),
('SV006', 'HP006', 7.7),
('SV007', 'HP007', 8.1),
('SV008', 'HP008', 6.8),
('SV009', 'HP009', 8.3),
('SV010', 'HP010', 7.6);

-- --------------------------------------------------------

--
-- Table structure for table `hocphan`
--

CREATE TABLE `hocphan` (
  `MaHP` varchar(10) NOT NULL,
  `TenHP` varchar(100) NOT NULL,
  `Sodvht` int(11) DEFAULT NULL,
  `MaNganh` varchar(10) DEFAULT NULL,
  `HocKy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hocphan`
--

INSERT INTO `hocphan` (`MaHP`, `TenHP`, `Sodvht`, `MaNganh`, `HocKy`) VALUES
('HP001', 'Giải phẫu học', 3, 'YH01', 1),
('HP002', 'Hóa dược', 3, 'DH01', 2),
('HP003', 'Kinh tế vĩ mô', 2, 'KT01', 2),
('HP004', 'Môi trường và con người', 2, 'KHMT01', 1),
('HP005', 'Toán cao cấp', 3, 'SP01', 1),
('HP006', 'Nghệ thuật thị giác', 3, 'MT01', 1),
('HP007', 'Quản Lý Thủy Sản', 2, 'TS01', 2),
('HP008', 'Phát Triển Mã Nguồn Mở', 3, 'CNTT01', 2),
('HP009', 'Quản Lý Xây Dựng', 3, 'XD01', 3),
('HP010', 'Pháp Luật Đại Cương', 2, 'L01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `MaKhoa` varchar(10) NOT NULL,
  `TenKhoa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`MaKhoa`, `TenKhoa`) VALUES
('CNTT', 'Công Nghệ Thông Tin'),
('DH', 'Dược học'),
('KHMT', 'Khoa học môi trường'),
('KT', 'Kinh tế'),
('L', 'Luật'),
('MT', 'Mỹ thuật'),
('SP', 'Sư phạm'),
('TS', 'Thủy Sản'),
('XD', 'Xây Dựng'),
('YH', 'Y học');

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `MaLop` varchar(10) NOT NULL,
  `TenLop` varchar(100) NOT NULL,
  `MaNganh` varchar(10) DEFAULT NULL,
  `KhoaHoc` varchar(50) DEFAULT NULL,
  `HeDT` varchar(50) DEFAULT NULL,
  `NamNhapHoc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`MaLop`, `TenLop`, `MaNganh`, `KhoaHoc`, `HeDT`, `NamNhapHoc`) VALUES
('CNTT01A', 'Kỹ Thuật Lập Trình A', 'CNTT01', '2021-2025', 'Chính quy', 2021),
('DH01A', 'Dược học A', 'DH01', '2020-2025', 'Chính quy', 2020),
('KHMT01A', 'Khoa học môi trường A', 'KHMT01', '2021-2025', 'Chính quy', 2021),
('KT01A', 'Kinh tế quốc tế A', 'KT01', '2019-2023', 'Chính quy', 2019),
('L01A', 'Luật Kinh Tế A', 'L01', '2020-2024', 'Chính quy', 2020),
('MT01A', 'Thiết kế đồ họa A', 'MT01', '2020-2024', 'Chính quy', 2020),
('SP01A', 'Sư phạm Toán A', 'SP01', '2022-2026', 'Chính quy', 2022),
('TS01A', 'Khai Thác Thủy Sản A', 'TS01', '2021-2025', 'Chính quy', 2021),
('XD01A', 'Kỹ Thuật Xây Dựng A', 'XD01', '2021-2025', 'Chính quy', 2021),
('YH01A', 'Y khoa A', 'YH01', '2021-2027', 'Chính quy', 2021);

-- --------------------------------------------------------

--
-- Table structure for table `nganh`
--

CREATE TABLE `nganh` (
  `MaNganh` varchar(10) NOT NULL,
  `TenNganh` varchar(100) NOT NULL,
  `MaKhoa` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nganh`
--

INSERT INTO `nganh` (`MaNganh`, `TenNganh`, `MaKhoa`) VALUES
('CNTT01', 'Kỹ Thuật Lập Trình', 'CNTT'),
('DH01', 'Dược học', 'DH'),
('KHMT01', 'Khoa học môi trường', 'KHMT'),
('KT01', 'Kinh tế quốc tế', 'KT'),
('L01', 'Luật Kinh Tế', 'L'),
('MT01', 'Thiết kế đồ họa', 'MT'),
('SP01', 'Sư phạm Toán', 'SP'),
('TS01', 'Khai Thác Thủy Sản', 'TS'),
('XD01', 'Kỹ Thuật Xây Dựng', 'XD'),
('YH01', 'Y khoa', 'YH');

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MaSV` varchar(10) NOT NULL,
  `HoTen` varchar(100) NOT NULL,
  `MaLop` varchar(10) DEFAULT NULL,
  `GioiTinh` varchar(10) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `DiaChi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`MaSV`, `HoTen`, `MaLop`, `GioiTinh`, `NgaySinh`, `DiaChi`) VALUES
('SV001', 'Nguyễn Thị Hà', 'YH01A', 'Nữ', '2002-07-01', 'Quảng Nam'),
('SV002', 'Hoàng Văn Giang', 'DH01A', 'Nam', '2002-08-02', 'Ninh Bình'),
('SV003', 'Trần Thị Hiền', 'KT01A', 'Nữ', '2002-09-03', 'Đồng Nai'),
('SV004', 'Lê Văn Tiền', 'KHMT01A', 'Nam', '2002-10-04', 'Nghệ An'),
('SV005', 'Dương Thị Thanh Mỹ', 'CNTT01A', 'Nữ', '2003-08-15', 'Ninh Hòa'),
('SV006', 'Phan Châu Hải Lâm', 'CNTT01A', 'Nam', '2003-08-15', 'Ninh Hòa'),
('SV007', 'Huỳnh Gia Kiệt', 'CNTT01A', 'Nam', '2003-08-15', 'Cam Ranh'),
('SV008', 'Phan Thị Linh', 'SP01A', 'Nữ', '2001-11-05', 'Lâm Đồng'),
('SV009', 'Nguyễn Văn Quang', 'MT01A', 'Nam', '2002-12-06', 'Hà Giang'),
('SV010', 'Lý Hải', 'XD01A', 'Nam', '2002-06-07', 'Tây Ninh'),
('SV011', 'Phan Thị Nở', 'TS01A', 'Nữ', '2001-05-08', 'Lâm Đồng'),
('SV012', 'Nguyễn Văn Tèo', 'L01A', 'Nam', '2002-04-09', 'Hà Giang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dangnhap`
--
ALTER TABLE `dangnhap`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `diemhp`
--
ALTER TABLE `diemhp`
  ADD PRIMARY KEY (`MaSV`,`MaHP`),
  ADD KEY `MaHP` (`MaHP`);

--
-- Indexes for table `hocphan`
--
ALTER TABLE `hocphan`
  ADD PRIMARY KEY (`MaHP`),
  ADD KEY `MaNganh` (`MaNganh`);

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
  ADD KEY `MaNganh` (`MaNganh`);

--
-- Indexes for table `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`MaNganh`),
  ADD KEY `MaKhoa` (`MaKhoa`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MaSV`),
  ADD KEY `MaLop` (`MaLop`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diemhp`
--
ALTER TABLE `diemhp`
  ADD CONSTRAINT `diemhp_ibfk_1` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`),
  ADD CONSTRAINT `diemhp_ibfk_2` FOREIGN KEY (`MaHP`) REFERENCES `hocphan` (`MaHP`);

--
-- Constraints for table `hocphan`
--
ALTER TABLE `hocphan`
  ADD CONSTRAINT `hocphan_ibfk_1` FOREIGN KEY (`MaNganh`) REFERENCES `nganh` (`MaNganh`);

--
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`MaNganh`) REFERENCES `nganh` (`MaNganh`);

--
-- Constraints for table `nganh`
--
ALTER TABLE `nganh`
  ADD CONSTRAINT `nganh_ibfk_1` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`);

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`MaLop`) REFERENCES `lop` (`MaLop`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
