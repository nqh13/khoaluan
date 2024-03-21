-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 07:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_khoaluan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chuyennganh`
--

CREATE TABLE `tbl_chuyennganh` (
  `ma_nganh` int(5) NOT NULL,
  `ten_nganh` varchar(150) NOT NULL,
  `khoavien` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_chuyennganh`
--

INSERT INTO `tbl_chuyennganh` (`ma_nganh`, `ten_nganh`, `khoavien`) VALUES
(1, 'Kỹ thuật phần mềm', 1),
(2, 'Hệ thống thông tin', 1),
(3, 'Công nghệ thông tin', 1),
(4, 'Khoa học máy tính', 1),
(5, 'Kinh doanh quốc tế', 3),
(6, 'Quản trị nhà hàng khách sạn', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dangkydetai`
--

CREATE TABLE `tbl_dangkydetai` (
  `ma_dangky` int(5) NOT NULL,
  `ma_SV` int(8) NOT NULL,
  `ma_detai` int(5) NOT NULL,
  `trangthaidangky` int(5) NOT NULL DEFAULT 1,
  `ngaydangky` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_dangkydetai`
--

INSERT INTO `tbl_dangkydetai` (`ma_dangky`, `ma_SV`, `ma_detai`, `trangthaidangky`, `ngaydangky`) VALUES
(21, 19508462, 14, 1, '2024-03-20 22:19:37'),
(24, 19508461, 14, 1, '2024-03-20 23:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detai`
--

CREATE TABLE `tbl_detai` (
  `ma_detai` int(11) NOT NULL,
  `tendetai` varchar(255) NOT NULL,
  `loaidetai` int(5) NOT NULL,
  `ma_GV` int(8) NOT NULL,
  `mota` text NOT NULL,
  `yeucau` text DEFAULT NULL,
  `kienthuc` text DEFAULT NULL,
  `soluong_SV` int(5) NOT NULL,
  `nganh` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_detai`
--

INSERT INTO `tbl_detai` (`ma_detai`, `tendetai`, `loaidetai`, `ma_GV`, `mota`, `yeucau`, `kienthuc`, `soluong_SV`, `nganh`) VALUES
(13, '14', 1, 12345678, 'qưeqweqw', 'qưeqweqw', 'qưeqeeeee', 2, 1),
(14, 'Đề tài 14', 1, 12345678, 'Xây dựng HTTT KHo', 'App - Web App', 'React Js - React Native - Node Js', 2, 1),
(22, 'Đề tài 15', 1, 11111111, 'Xây dựng ứng dụng chat trong  tổ chức', 'Xây dựng ứng dụng chat', 'React Js, RealTime', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_khoavien`
--

CREATE TABLE `tbl_khoavien` (
  `ma_khoavien` int(5) NOT NULL,
  `ten_khoavien` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_khoavien`
--

INSERT INTO `tbl_khoavien` (`ma_khoavien`, `ten_khoavien`) VALUES
(1, 'Khoa Công Nghệ Thông Tin'),
(2, 'Khoa Du Lịch'),
(3, 'Khoa Quản Trị Kinh Doanh');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loaidetai`
--

CREATE TABLE `tbl_loaidetai` (
  `id_loai` int(5) NOT NULL,
  `tenloai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_loaidetai`
--

INSERT INTO `tbl_loaidetai` (`id_loai`, `tenloai`) VALUES
(1, 'KLTN Hệ ĐH'),
(2, 'KLTN Hệ Cao Đẳng');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nhom`
--

CREATE TABLE `tbl_nhom` (
  `ma_nhom` int(5) NOT NULL,
  `ma_detai` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_replies`
--

CREATE TABLE `tbl_replies` (
  `ma_reply` int(8) DEFAULT NULL,
  `mathaoluan` int(5) NOT NULL,
  `ma_nguoitraloi` int(8) NOT NULL,
  `vaitro` int(5) NOT NULL,
  `thoigian` datetime NOT NULL DEFAULT current_timestamp(),
  `noidung` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thanhviennhom`
--

CREATE TABLE `tbl_thanhviennhom` (
  `ma_thanhvien` int(5) NOT NULL,
  `ma_SV` int(5) NOT NULL,
  `ma_nhom` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thaoluan`
--

CREATE TABLE `tbl_thaoluan` (
  `ma_cuocthaoluan` int(5) NOT NULL,
  `ma_detai` int(5) NOT NULL,
  `ma_nguoitao` int(8) NOT NULL,
  `vaitro` int(5) NOT NULL,
  `tieude` varchar(150) NOT NULL,
  `noidung` text NOT NULL,
  `ngaytao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trangthaidangky`
--

CREATE TABLE `tbl_trangthaidangky` (
  `ma_TTDK` int(5) NOT NULL,
  `tentrangthai` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_trangthaidangky`
--

INSERT INTO `tbl_trangthaidangky` (`ma_TTDK`, `tentrangthai`) VALUES
(1, 'Đã đăng ký'),
(2, 'Đã khóa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trangthaitk`
--

CREATE TABLE `tbl_trangthaitk` (
  `id_trangthaitk` int(5) NOT NULL,
  `trangthaitaikhoan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_trangthaitk`
--

INSERT INTO `tbl_trangthaitk` (`id_trangthaitk`, `trangthaitaikhoan`) VALUES
(1, 'đang hoạt động'),
(2, 'ngừng hoạt động');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `ma_nguoidung` int(8) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `sodienthoai` varchar(10) NOT NULL,
  `diachi` text DEFAULT NULL,
  `hinhanh` text NOT NULL,
  `matkhau` text NOT NULL,
  `khoavien` int(5) NOT NULL,
  `ma_nganh` int(5) NOT NULL,
  `vaitro` int(5) NOT NULL DEFAULT 1,
  `trangthai` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`ma_nguoidung`, `hoten`, `email`, `sodienthoai`, `diachi`, `hinhanh`, `matkhau`, `khoavien`, `ma_nganh`, `vaitro`, `trangthai`) VALUES
(11111111, 'Nguyễn Văn Phong', 'nguyenvanphong@gmail.com', '0987654555', '123 Nguyễn Văn Bảo, P5, Q.Gò Vấp, Tp.HCM', 'user.png', '3799a40af02d431cff1d35f38d84f95c', 1, 2, 2, 1),
(12345678, 'Trần Minh Long', 'gvminhlong@gmail.com', '012379456', 'Q.12,TP.HCM', 'user.png\r\n', '0985251f3d13076beec69aca778ea31f', 1, 1, 2, 1),
(19508461, 'Nguyễn Quang Hà ', '', '', NULL, 'avt.jpg', '29b4ab6f7dc5e913860da606f730bd7c', 1, 1, 1, 1),
(19508462, 'Bùi Văn An', 'vanan1301@gmail.com', '0914550898', 'Nhà ở tiên sơn, gần CF ông qoại', 'user.png', '0985251f3d13076beec69aca778ea31f', 1, 1, 1, 1),
(19508463, 'Trần Văn Bình', 'vanbinh@gmail.com', '0789123465', 'Pleiku, Gia Lai', 'user.png', '0985251f3d13076beec69aca778ea31f', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vaitro`
--

CREATE TABLE `tbl_vaitro` (
  `ma_vaitro` int(5) NOT NULL,
  `tenvaitro` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_vaitro`
--

INSERT INTO `tbl_vaitro` (`ma_vaitro`, `tenvaitro`) VALUES
(1, 'Sinh viên'),
(2, 'Giảng viên'),
(3, 'Quản trị viên');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_chuyennganh`
--
ALTER TABLE `tbl_chuyennganh`
  ADD PRIMARY KEY (`ma_nganh`),
  ADD KEY `khoavien` (`khoavien`);

--
-- Indexes for table `tbl_dangkydetai`
--
ALTER TABLE `tbl_dangkydetai`
  ADD PRIMARY KEY (`ma_dangky`),
  ADD KEY `trangthaidangky` (`trangthaidangky`),
  ADD KEY `ma_detai` (`ma_detai`),
  ADD KEY `ma_SV` (`ma_SV`);

--
-- Indexes for table `tbl_detai`
--
ALTER TABLE `tbl_detai`
  ADD PRIMARY KEY (`ma_detai`),
  ADD KEY `ma_GV` (`ma_GV`),
  ADD KEY `loaidetai` (`loaidetai`),
  ADD KEY `frk_manganh` (`nganh`);

--
-- Indexes for table `tbl_khoavien`
--
ALTER TABLE `tbl_khoavien`
  ADD PRIMARY KEY (`ma_khoavien`);

--
-- Indexes for table `tbl_loaidetai`
--
ALTER TABLE `tbl_loaidetai`
  ADD PRIMARY KEY (`id_loai`);

--
-- Indexes for table `tbl_nhom`
--
ALTER TABLE `tbl_nhom`
  ADD PRIMARY KEY (`ma_nhom`),
  ADD KEY `ma_detai` (`ma_detai`);

--
-- Indexes for table `tbl_replies`
--
ALTER TABLE `tbl_replies`
  ADD KEY `mathaoluan` (`mathaoluan`);

--
-- Indexes for table `tbl_thanhviennhom`
--
ALTER TABLE `tbl_thanhviennhom`
  ADD PRIMARY KEY (`ma_thanhvien`),
  ADD KEY `ma_nhom` (`ma_nhom`),
  ADD KEY `ma_SV` (`ma_SV`);

--
-- Indexes for table `tbl_thaoluan`
--
ALTER TABLE `tbl_thaoluan`
  ADD PRIMARY KEY (`ma_cuocthaoluan`),
  ADD KEY `ma_detai` (`ma_detai`);

--
-- Indexes for table `tbl_trangthaidangky`
--
ALTER TABLE `tbl_trangthaidangky`
  ADD PRIMARY KEY (`ma_TTDK`);

--
-- Indexes for table `tbl_trangthaitk`
--
ALTER TABLE `tbl_trangthaitk`
  ADD PRIMARY KEY (`id_trangthaitk`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`ma_nguoidung`),
  ADD KEY `bomon` (`ma_nganh`),
  ADD KEY `khoavien` (`khoavien`),
  ADD KEY `vaitro` (`vaitro`),
  ADD KEY `trangthai` (`trangthai`);

--
-- Indexes for table `tbl_vaitro`
--
ALTER TABLE `tbl_vaitro`
  ADD PRIMARY KEY (`ma_vaitro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_chuyennganh`
--
ALTER TABLE `tbl_chuyennganh`
  MODIFY `ma_nganh` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_dangkydetai`
--
ALTER TABLE `tbl_dangkydetai`
  MODIFY `ma_dangky` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_detai`
--
ALTER TABLE `tbl_detai`
  MODIFY `ma_detai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_khoavien`
--
ALTER TABLE `tbl_khoavien`
  MODIFY `ma_khoavien` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_loaidetai`
--
ALTER TABLE `tbl_loaidetai`
  MODIFY `id_loai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_nhom`
--
ALTER TABLE `tbl_nhom`
  MODIFY `ma_nhom` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_thanhviennhom`
--
ALTER TABLE `tbl_thanhviennhom`
  MODIFY `ma_thanhvien` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_thaoluan`
--
ALTER TABLE `tbl_thaoluan`
  MODIFY `ma_cuocthaoluan` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trangthaidangky`
--
ALTER TABLE `tbl_trangthaidangky`
  MODIFY `ma_TTDK` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_trangthaitk`
--
ALTER TABLE `tbl_trangthaitk`
  MODIFY `id_trangthaitk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `ma_nguoidung` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19508464;

--
-- AUTO_INCREMENT for table `tbl_vaitro`
--
ALTER TABLE `tbl_vaitro`
  MODIFY `ma_vaitro` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_chuyennganh`
--
ALTER TABLE `tbl_chuyennganh`
  ADD CONSTRAINT `tbl_chuyennganh_ibfk_1` FOREIGN KEY (`khoavien`) REFERENCES `tbl_khoavien` (`ma_khoavien`);

--
-- Constraints for table `tbl_dangkydetai`
--
ALTER TABLE `tbl_dangkydetai`
  ADD CONSTRAINT `tbl_dangkydetai_ibfk_1` FOREIGN KEY (`trangthaidangky`) REFERENCES `tbl_trangthaidangky` (`ma_TTDK`),
  ADD CONSTRAINT `tbl_dangkydetai_ibfk_2` FOREIGN KEY (`ma_detai`) REFERENCES `tbl_detai` (`ma_detai`),
  ADD CONSTRAINT `tbl_dangkydetai_ibfk_3` FOREIGN KEY (`ma_SV`) REFERENCES `tbl_users` (`ma_nguoidung`);

--
-- Constraints for table `tbl_detai`
--
ALTER TABLE `tbl_detai`
  ADD CONSTRAINT `frk_manganh` FOREIGN KEY (`nganh`) REFERENCES `tbl_chuyennganh` (`ma_nganh`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detai_ibfk_1` FOREIGN KEY (`ma_GV`) REFERENCES `tbl_users` (`ma_nguoidung`),
  ADD CONSTRAINT `tbl_detai_ibfk_2` FOREIGN KEY (`loaidetai`) REFERENCES `tbl_loaidetai` (`id_loai`);

--
-- Constraints for table `tbl_nhom`
--
ALTER TABLE `tbl_nhom`
  ADD CONSTRAINT `tbl_nhom_ibfk_1` FOREIGN KEY (`ma_detai`) REFERENCES `tbl_detai` (`ma_detai`);

--
-- Constraints for table `tbl_replies`
--
ALTER TABLE `tbl_replies`
  ADD CONSTRAINT `tbl_replies_ibfk_1` FOREIGN KEY (`mathaoluan`) REFERENCES `tbl_thaoluan` (`ma_cuocthaoluan`);

--
-- Constraints for table `tbl_thanhviennhom`
--
ALTER TABLE `tbl_thanhviennhom`
  ADD CONSTRAINT `tbl_thanhviennhom_ibfk_2` FOREIGN KEY (`ma_nhom`) REFERENCES `tbl_nhom` (`ma_nhom`),
  ADD CONSTRAINT `tbl_thanhviennhom_ibfk_3` FOREIGN KEY (`ma_SV`) REFERENCES `tbl_users` (`ma_nguoidung`);

--
-- Constraints for table `tbl_thaoluan`
--
ALTER TABLE `tbl_thaoluan`
  ADD CONSTRAINT `tbl_thaoluan_ibfk_1` FOREIGN KEY (`ma_detai`) REFERENCES `tbl_detai` (`ma_detai`);

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`ma_nganh`) REFERENCES `tbl_chuyennganh` (`ma_nganh`),
  ADD CONSTRAINT `tbl_users_ibfk_3` FOREIGN KEY (`khoavien`) REFERENCES `tbl_khoavien` (`ma_khoavien`),
  ADD CONSTRAINT `tbl_users_ibfk_4` FOREIGN KEY (`vaitro`) REFERENCES `tbl_vaitro` (`ma_vaitro`),
  ADD CONSTRAINT `tbl_users_ibfk_5` FOREIGN KEY (`trangthai`) REFERENCES `tbl_trangthaitk` (`id_trangthaitk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
