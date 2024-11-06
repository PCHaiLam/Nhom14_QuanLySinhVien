-- Tạo cơ sở dữ liệu và sử dụng nó
CREATE DATABASE qlsv;
USE qlsv;

-- Tạo bg SinhVien_LopHocPhan
CREATE TABLE SinhVien_LopHocPhan (
    MaSV VARCHAR(10) NOT NULL,
    MaLopHocPhan VARCHAR(20) NOT NULL,
    Diem FLOAT NULL,
    MaHocKi VARCHAR(15) NOT NULL,
    NgayDongHocPhi DATETIME NULL
);

-- Tạo bảng GiaoVien
CREATE TABLE GiaoVien (
    MaGV VARCHAR(5) NOT NULL ,
    HoTen VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NULL,
    PRIMARY KEY (MaGV)
);

-- Tạo bảng HocKi
CREATE TABLE HocKi (
    MaHocKi VARCHAR(15) NOT NULL ,
    TenHocKi VARCHAR(50) NOT NULL,
	NgayBatDau DATE,
	NgayKetThuc DATE,
    PRIMARY KEY (MaHocKi)
);

-- Tạo bảng Lop
CREATE TABLE Lop (
    MaLop VARCHAR(10) NOT NULL,
    TenLop VARCHAR(100) NOT NULL,
    MaNganh VARCHAR(10) NULL,
    PRIMARY KEY (MaLop)
);

-- Tạo bảng LopHocPhan
CREATE TABLE LopHocPhan (
    MaLopHocPhan VARCHAR(20) NOT NULL,
    MaMonHoc VARCHAR(10) NULL,
    DiaDiem VARCHAR(100) NULL,
    MaGV VARCHAR(5) NULL,
    PRIMARY KEY (MaLopHocPhan)
);

-- Tạo bảng MonHoc
CREATE TABLE MonHoc (
    MaHP VARCHAR(10) NOT NULL,
    TenHP VARCHAR(100) NOT NULL,
    SoTinChi INT NOT NULL,
    DonGia INT NOT NULL,
    PRIMARY KEY (MaHP)
);

-- Tạo bảng Nganh
CREATE TABLE Nganh (
    MaNganh VARCHAR(10) NOT NULL,
    TenNganh VARCHAR(100) NOT NULL,
    PRIMARY KEY (MaNganh)
);

-- Tạo bảng SinhVien
CREATE TABLE SinhVien (
    MaSV VARCHAR(20) NOT NULL,
    HoTen VARCHAR(100) NOT NULL,
    NgaySinh DATE NULL,
    GioiTinh VARCHAR(10) NOT NULL,
    DiaChi VARCHAR(200) NULL,
    Email VARCHAR(100) NULL,
	MatKhau VARCHAR(20) NULL,
    SDT VARCHAR(15) NULL,
    MaLop VARCHAR(10) NOT NULL,
    PRIMARY KEY (MaSV)
);

-- Thêm khóa ngoại FK_SinhVien_LopHocPhan_SinhVien
ALTER TABLE SinhVien_LopHocPhan
ADD CONSTRAINT FK_SinhVien_LopHocPhan_SinhVien FOREIGN KEY (MaSV) REFERENCES SinhVien(MaSV);

-- Thêm khóa ngoại FK_SinhVien_LopHocPhan_LopHocPhan
ALTER TABLE SinhVien_LopHocPhan
ADD CONSTRAINT FK_SinhVien_LopHocPhan_LopHocPhan FOREIGN KEY (MaLopHocPhan) REFERENCES LopHocPhan(MaLopHocPhan);

-- Thêm khóa ngoại FK_SinhVien_LopHocPhan_HocKi
ALTER TABLE SinhVien_LopHocPhan
ADD CONSTRAINT FK_SinhVien_LopHocPhan_HocKi FOREIGN KEY (MaHocKi) REFERENCES HocKi(MaHocKi);


-- Kết nối SinhVien với Lop
ALTER TABLE SinhVien
ADD CONSTRAINT FK_SinhVien_Lop FOREIGN KEY (MaLop) REFERENCES Lop(MaLop);

-- Kết nối Lop với Nganh
ALTER TABLE Lop
ADD CONSTRAINT FK_Lop_Nganh FOREIGN KEY (MaNganh) REFERENCES Nganh(MaNganh);

-- Thêm khóa ngoại FK_LopHocPhan_MonHoc
ALTER TABLE LopHocPhan
ADD CONSTRAINT FK_LopHocPhan_MonHoc FOREIGN KEY (MaMonHoc) REFERENCES MonHoc(MaHP);

-- Thêm khóa ngoại FK_LopHocPhan_GiaoVien
ALTER TABLE LopHocPhan
ADD CONSTRAINT FK_LopHocPhan_GiaoVien FOREIGN KEY (MaGV) REFERENCES GiaoVien(MaGV);

-- Thêm dữ liệu mẫu vào bảng MonHoc
INSERT INTO MonHoc (MaHP, TenHP, SoTinChi, DonGia) VALUES
('Android', 'Lập trình Android', 3, 450000),
('CTDL-GT', 'Cấu trúc dữ liệu và giải thuật', 4, 450000),
('HDH', 'Hệ điều hành', 3, 450000),
('QL_DAPM', 'Quản lý dự án phần mềm', 3, 450000);

-- Thêm dữ liệu mẫu vào bảng GiaoVien
INSERT INTO GiaoVien (MaGV, HoTen, Email) VALUES
('GV01', 'Bùi Thị Hồng Minh', 'minh.bth@ntu.edu.vn'),
('GV02', 'Nguyễn Khắc Cường', 'cuong.nk@ntu.edu.vn'),
('GV03', 'Nguyễn Đức Thuần', 'thuan.nd@ntu.edu.vn'),
('GV04', 'Mai Cường Thọ', 'tho.mc@ntu.edu.vn'),
('GV05', 'Bùi Chí Thành', 'thanh.bc@ntu.edu.vn'),
('GV06', 'Huỳnh Huy', 'huy@ntu.edu.vn');

-- Thêm dữ liệu mẫu vào bảng HocKi
INSERT INTO HocKi (MaHocKi, TenHocKi) VALUES
('2023-2024_HK1', 'Học Kì 1'),
('2023-2024_HK2', 'Học Kì 2'),
('2023-2024_HE', 'Học Kì hè');

-- Thêm dữ liệu mẫu vào bảng Nganh
INSERT INTO Nganh (MaNganh, TenNganh) VALUES
('01-CNTT', 'Công nghệ thông tin'),
('02-KT', 'Kinh tế'),
('03-DL', 'Du lịch');

-- Thêm dữ liệu mẫu vào bảng Lop
INSERT INTO Lop (MaLop, TenLop, MaNganh) VALUES
('63.CNTT-1', 'Công Nghệ Thông Tin 1', '01-CNTT'),
('63.CNTT-2', 'Công Nghệ Thông Tin 2', '01-CNTT'),
('63.KT-1', 'Kinh Tế 1', '02-KT'),
('63.KT-2', 'Kinh Tế 2', '02-KT'),
('63.DL-1', 'Du Lịch 1', '03-DL'),
('63.DL-2', 'Du lịch 2', '03-DL');

-- Thêm dữ liệu mẫu vào bảng SinhVien
INSERT INTO SinhVien (MaSV, HoTen, NgaySinh, GioiTinh, DiaChi, Email, SDT, MaLop, MatKhau) VALUES
('63010001', 'Nguyễn Văn A', '2000-01-01', 'Nam', '123 Đường ABC', 'a@example.com', '0123456789', '63.CNTT-1', '123'),
('63010002', 'Trần Thị B', '2000-02-02', 'Nữ', '456 Đường DEF', 'b@example.com', '0987654321', '63.CNTT-1', '123'),
('63010003', 'Lê Thị C', '2000-03-03', 'Nữ', '789 Đường GHI', 'c@example.com', '0123456789', '63.CNTT-2', '123'),
('63010004', 'Nguyễn Thị D', '2000-04-04', 'Nữ', '101 Đường JKL', 'd@example.com', '0987654321', '63.CNTT-2', '123'),

('63020001', 'Trần Văn E', '2000-05-05', 'Nam', '202 Đường MNO', 'e@example.com', '0123456789', '63.KT-1', '123'),
('63020002', 'Phạm Minh F', '2000-06-06', 'Nam', '303 Đường PQR', 'f@example.com', '0987654321', '63.KT-1', '123'),
('63020003', 'Bùi Minh G', '2000-07-07', 'Nam', '404 Đường STU', 'g@example.com', '0123456789', '63.KT-2', '123'),
('63020004', 'Võ Thị H', '2000-08-08', 'Nữ', '505 Đường VWX', 'h@example.com', '0987654321', '63.KT-2', '123'),

('63030001', 'Lê Minh I', '2000-09-09', 'Nam', '606 Đường YZ', 'i@example.com', '0123456789', '63.DL-1', '123'),
('63030002', 'Trần Minh J', '2000-10-10', 'Nam', '707 Đường ABC', 'j@example.com', '0987654321', '63.DL-1', '123'),
('63030003', 'Nguyễn Minh K', '2000-11-11', 'Nam', '808 Đường DEF', 'k@example.com', '0123456789', '63.DL-2', '123'),
('63030004', 'Lê Thị L', '2000-12-12', 'Nữ', '909 Đường GHI', 'l@example.com', '0987654321', '63.DL-2', '123');


-- Thêm dữ liệu mẫu vào bảng LopHocPhan
INSERT INTO LopHocPhan (MaLopHocPhan, MaMonHoc, DiaDiem, MaGV) VALUES
('Android_63.CNTT-1', 'Android', 'G6-101', 'GV04'),
('Android_63.CNTT-2', 'Android', 'G6-103', 'GV04'),
('CTDL-GT_63.CNTT-1', 'CTDL-GT', 'G6-203', 'GV03'),
('CTDL-GT_63.CNTT-2', 'CTDL-GT', 'G6-201', 'GV02'),
('HDH_63.CNTT-1', 'HDH', 'G6-303', 'GV05'),
('HDH_63.CNTT-2', 'HDH', 'G6-103', 'GV05'),
('QLDAPM_63.CNTT-2', 'QL_DAPM', 'G6-102', 'GV02');

-- Thêm dữ liệu mẫu vào bảng Diem
INSERT INTO SinhVien_LopHocPhan(MaSV, MaLopHocPhan, MaHocKi) VALUES
('63010001', 'Android_63.CNTT-1', '2023-2024_HK1'),
('63010001', 'CTDL-GT_63.CNTT-1', '2023-2024_HK1'),
('63010001', 'HDH_63.CNTT-1', '2023-2024_HK1'),
('63010001', 'QLDAPM_63.CNTT-2', '2023-2024_HK1');
