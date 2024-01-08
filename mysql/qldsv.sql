-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 08, 2024 lúc 03:40 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qldsv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dkmon`
--

CREATE TABLE `dkmon` (
  `id` int(11) NOT NULL,
  `MSV` int(11) NOT NULL,
  `MaMon` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dkmon`
--

INSERT INTO `dkmon` (`id`, `MSV`, `MaMon`) VALUES
(41, 20212504, 'php3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangvien`
--

CREATE TABLE `giangvien` (
  `MaGV` int(10) NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `NgaySinh` date NOT NULL,
  `GioiTinh` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `DiaChi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giangvien`
--

INSERT INTO `giangvien` (`MaGV`, `HoTen`, `NgaySinh`, `GioiTinh`, `Email`, `DiaChi`) VALUES
(1, 'Nguyễn Văn A', '1972-01-15', 'nam', 'nguyenvana@gmail.com', 'Hà Nội'),
(2, 'Nguyễn Thị B', '1980-02-15', 'nữ', 'nguyenthib@gmail.com', 'Hồ Chí Minh'),
(3, 'Nguyễn Văn C', '1990-04-04', 'nam', 'nguyenvanc@gmail.com', 'Hải Phòng'),
(4, 'Nguyễn Thị D', '2000-01-04', 'nữ', 'nguyenthid@gmail.com', 'Lạng Sơn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `MaLop` varchar(20) NOT NULL,
  `TenLop` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`MaLop`, `TenLop`) VALUES
('L01', 'DCCNTT12.10.9'),
('L02', 'DCCNTT12.10.1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhoc`
--

CREATE TABLE `monhoc` (
  `MaMon` varchar(50) NOT NULL,
  `TenMon` varchar(100) NOT NULL,
  `SoTinChi` int(5) NOT NULL,
  `MaGV` int(50) NOT NULL,
  `Lich` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `monhoc`
--

INSERT INTO `monhoc` (`MaMon`, `TenMon`, `SoTinChi`, `MaGV`, `Lich`) VALUES
('php', 'PHP nâng cao', 4, 2, '11/10-15/12/2023'),
('php1', 'PHP', 4, 3, ''),
('php2', 'TMDT', 4, 4, ''),
('php3', 'Quản lý mySQL', 3, 1, '1/10-15/12/2023');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `qldiem`
--

CREATE TABLE `qldiem` (
  `id` int(11) NOT NULL,
  `MSV` int(15) NOT NULL,
  `MaMon` varchar(50) NOT NULL,
  `ChuyenCan` float NOT NULL,
  `GiuaKy` float NOT NULL,
  `CuoiKy` float NOT NULL,
  `DiemTB` float NOT NULL,
  `MaGV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `qldiem`
--

INSERT INTO `qldiem` (`id`, `MSV`, `MaMon`, `ChuyenCan`, `GiuaKy`, `CuoiKy`, `DiemTB`, `MaGV`) VALUES
(1, 20212504, 'php', 9, 8, 9, 8.8, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MSV` int(10) NOT NULL,
  `HoTen` text NOT NULL,
  `NgaySinh` date NOT NULL,
  `GioiTinh` varchar(20) NOT NULL,
  `MaLop` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `DiaChi` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`MSV`, `HoTen`, `NgaySinh`, `GioiTinh`, `MaLop`, `Email`, `DiaChi`) VALUES
(20212501, 'Vũ Hoài Nam', '2003-01-24', 'nam', 'L01', '20212501@eaut.edu.vn', 'Vĩnh Phúc'),
(20212504, 'Lê Minh Quân', '2003-03-27', 'nam', 'L01', '20212504@eaut.edu.vn', 'Hà Nội'),
(20212612, 'Bùi Văn Tuấn', '2003-02-01', 'nam', 'L01', '20212612@eaut.edu.vn', 'Quảng Ninh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `ChucVu` varchar(50) NOT NULL,
  `TaiKhoan` varchar(50) NOT NULL,
  `MatKhau` varchar(50) NOT NULL,
  `Code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `HoTen`, `Email`, `ChucVu`, `TaiKhoan`, `MatKhau`, `Code`) VALUES
(1, 'Admin', 'admin123@admin.admin', 'Quản trị viên', 'admin', 'admin', ''),
(2, 'Lê Minh Quân', '20212504@eaut.edu.vn', 'Sinh viên', '20212504', '123', ''),
(10, 'Nguyễn Văn A', 'nguyenvana@gmail.com', 'Giảng viên', 'nam', '123', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dkmon`
--
ALTER TABLE `dkmon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_dkMon_monhoc` (`MaMon`),
  ADD KEY `FK_dkMon_sinhvien` (`MSV`);

--
-- Chỉ mục cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`MaGV`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`MaLop`);

--
-- Chỉ mục cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`MaMon`),
  ADD KEY `fk_monhoc_giangvien` (`MaGV`);

--
-- Chỉ mục cho bảng `qldiem`
--
ALTER TABLE `qldiem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_qldiem_giangvien` (`MaGV`),
  ADD KEY `FK_qldiem_monhoc` (`MaMon`),
  ADD KEY `FK_qldiem_sinhvien` (`MSV`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MSV`),
  ADD KEY `FK_sinhvien_lop` (`MaLop`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dkmon`
--
ALTER TABLE `dkmon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `qldiem`
--
ALTER TABLE `qldiem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `dkmon`
--
ALTER TABLE `dkmon`
  ADD CONSTRAINT `FK_dkMon_monhoc` FOREIGN KEY (`MaMon`) REFERENCES `monhoc` (`MaMon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_dkMon_sinhvien` FOREIGN KEY (`MSV`) REFERENCES `sinhvien` (`MSV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD CONSTRAINT `fk_monhoc_giangvien` FOREIGN KEY (`MaGV`) REFERENCES `giangvien` (`MaGV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `qldiem`
--
ALTER TABLE `qldiem`
  ADD CONSTRAINT `FK_qldiem_giangvien` FOREIGN KEY (`MaGV`) REFERENCES `giangvien` (`MaGV`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_qldiem_monhoc` FOREIGN KEY (`MaMon`) REFERENCES `monhoc` (`MaMon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_qldiem_sinhvien` FOREIGN KEY (`MSV`) REFERENCES `sinhvien` (`MSV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `FK_sinhvien_lop` FOREIGN KEY (`MaLop`) REFERENCES `lop` (`MaLop`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
