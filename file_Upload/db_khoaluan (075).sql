-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 03:34 PM
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
-- Table structure for table `tbl_baocao`
--

CREATE TABLE `tbl_baocao` (
  `ma_baocao` int(10) NOT NULL,
  `detai` int(5) NOT NULL,
  `tieude` text NOT NULL,
  `ngaytao` datetime NOT NULL DEFAULT current_timestamp(),
  `ngayhethan` datetime DEFAULT NULL,
  `ghichu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_baocao`
--

INSERT INTO `tbl_baocao` (`ma_baocao`, `detai`, `tieude`, `ngaytao`, `ngayhethan`, `ghichu`) VALUES
(2, 28, 'Nộp báo cáo tuần', '2024-04-22 22:59:00', '2024-04-23 22:59:00', 'Test'),
(4, 13, 'Nộp báo cáo đề tài', '2024-05-05 10:42:00', '2024-04-28 21:35:00', 'Test chức năng thêm + Tính năng cập nhật'),
(5, 14, 'Nộp báo cáo tuần', '2024-04-24 16:53:00', '2024-04-30 22:00:00', 'Tạo báo cáo!');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietbaocao`
--

CREATE TABLE `tbl_chitietbaocao` (
  `ma_ctbaocao` int(10) NOT NULL,
  `ma_baocao` int(10) NOT NULL,
  `ma_sinhvien` int(8) NOT NULL,
  `thoigiannop` datetime NOT NULL DEFAULT current_timestamp(),
  `nhom` int(10) NOT NULL,
  `diemso` float DEFAULT NULL,
  `danhgia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thoigiancapnhat` datetime DEFAULT NULL,
  `tenFile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Url_File` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `nhom` int(5) NOT NULL,
  `trangthaidangky` int(5) NOT NULL DEFAULT 1,
  `ngaydangky` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_dangkydetai`
--

INSERT INTO `tbl_dangkydetai` (`ma_dangky`, `ma_SV`, `ma_detai`, `nhom`, `trangthaidangky`, `ngaydangky`) VALUES
(54, 19508455, 14, 54, 1, '2024-05-04 17:24:24'),
(60, 19508463, 14, 62, 1, '2024-05-04 21:57:57'),
(65, 19508462, 14, 65, 1, '2024-05-04 23:35:11'),
(73, 19508461, 14, 73, 1, '2024-05-07 11:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detai`
--

CREATE TABLE `tbl_detai` (
  `ma_detai` int(5) NOT NULL,
  `tendetai` varchar(255) NOT NULL,
  `loaidetai` int(5) NOT NULL,
  `ma_GV` int(8) NOT NULL,
  `mota` text NOT NULL,
  `yeucau` text DEFAULT NULL,
  `kienthuc` text DEFAULT NULL,
  `soluong_SV` int(5) NOT NULL,
  `nganh` int(5) NOT NULL,
  `hocki` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_detai`
--

INSERT INTO `tbl_detai` (`ma_detai`, `tendetai`, `loaidetai`, `ma_GV`, `mota`, `yeucau`, `kienthuc`, `soluong_SV`, `nganh`, `hocki`) VALUES
(13, 'Xây dựng hệ thống Đăng ký khám bệnh', 1, 12345678, 'Sử dụng PHP thực hiện yêu cầu đề tài', 'xây dựng hệ thống đặt lịch khám bệnh với đầy đủ các chức năng.', 'PHP, MySQL, JS', 2, 2, 1),
(14, 'Xây dựng ứng  dụng web quản lý kho hàng hiệu quả', 1, 12345678, 'Xây dựng HTTT KHo', 'App - Web App', 'React Js - React Native - Node Js', 4, 2, 1),
(22, 'Đề tài 1666', 1, 11111111, 'Xây dựng ứng dụng chat trong  tổ chức', 'Xây dựng ứng dụng chat', 'React Js, RealTime DataBase', 2, 2, 1),
(28, 'Đề tài 123456', 1, 12345678, 'Lập trình PHP', 'xây dựng website TMDT', 'HTMLL CSS PHP', 4, 2, 1),
(46, 'Thực hiện nghiên cứu công nghệ mới Node JS', 1, 12345678, 'Nghiên cứu Node JS xây dựng 1 ứng dụng web', 'sử dụng Node JS ', 'JavaScript, HTML, CSS', 4, 2, 1),
(47, 'Test', 2, 12345678, 'Xây dựng HTTT KHo', 'App - Web App', 'React Js, RealTime', 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hocki`
--

CREATE TABLE `tbl_hocki` (
  `ma_hk` int(5) NOT NULL,
  `tenhocki` varchar(255) NOT NULL,
  `trangthai` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_hocki`
--

INSERT INTO `tbl_hocki` (`ma_hk`, `tenhocki`, `trangthai`) VALUES
(1, 'HK2 2023-2024', 1),
(2, 'HK1 2023-2024', 0),
(3, 'HK2 2022-2023', 1);

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
(3, 'Khoa Quản Trị Kinh Doanh'),
(4, 'Khoa Luật Kinh Doanh');

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
-- Table structure for table `tbl_quantrivien`
--

CREATE TABLE `tbl_quantrivien` (
  `ma_quantrivien` int(8) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `tendangnhap` varchar(255) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `trangthai` int(5) NOT NULL,
  `vaitro` int(5) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_quantrivien`
--

INSERT INTO `tbl_quantrivien` (`ma_quantrivien`, `hoten`, `tendangnhap`, `matkhau`, `trangthai`, `vaitro`, `email`) VALUES
(1, 'Admin2', 'admin2', 'f8c7402e1ebdbc8ad37caae249710bad', 1, 3, 'admin@iuh.com.vn'),
(2, 'Admin', 'Admin', '0192023a7bbd73250516f069df18b500', 1, 3, 'admin@qlkhoaluaniuh.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thaoluan`
--

CREATE TABLE `tbl_thaoluan` (
  `ma_cuocthaoluan` int(5) NOT NULL,
  `ma_detai` int(5) NOT NULL,
  `ma_nguoitao` int(8) NOT NULL,
  `tieude` varchar(150) NOT NULL,
  `noidung` text NOT NULL,
  `ngaytao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_thaoluan`
--

INSERT INTO `tbl_thaoluan` (`ma_cuocthaoluan`, `ma_detai`, `ma_nguoitao`, `tieude`, `noidung`, `ngaytao`) VALUES
(1, 13, 19508461, '121212', '212121', '2024-03-25 23:23:18'),
(4, 13, 19508462, 'Thảo luận đề tài', 'abc', '2024-04-16 00:03:26'),
(8, 14, 19508461, 'Thảo luận về bảo mật Form mới', 'Thảo luận về bảo mật Form, sử dụng token', '2024-05-01 16:22:01'),
(9, 14, 19508463, 'Thảo luận đề tài', 'Chống XSS như thế nào???', '2024-05-01 19:24:32'),
(11, 14, 19508461, '&lt;script&gt;alert(&quot;Heloo&quot;)&lt;/script&gt;', 'Tấn công thử XSS nha', '2024-05-02 17:03:18');

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
(2, 'Đã khóa'),
(3, 'Đang thực hiện'),
(4, 'Đã hoàn thành');

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
  `hinhanh` text DEFAULT NULL,
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
(11111111, 'Nguyễn Văn Phong', 'nguyenvanphong@gmail.com', '0987654444', '123 Nguyễn Văn Bảo, P5, Q.Gò Vấp, Tp.HCM', 'user.png', '6172ac2267e793a6c86dfd7a0a348289', 1, 2, 2, 1),
(12345678, 'Trần Minh Long', 'gvminhlong@gmail.com', '0964852666', 'Trần Văn Đang, Q.12,TP.HCM', 'user.png\r\n', '3799a40af02d431cff1d35f38d84f95c', 1, 2, 2, 1),
(19508455, 'Nguyễn Văn B', 'vanb@gmail.com', '0988996655', '12 Nguyễn Văn Bảo', 'user.png', '3799a40af02d431cff1d35f38d84f95c', 1, 2, 1, 1),
(19508461, 'Nguyễn Quang Hà', 'nguyenquangha130901@gmail.com', '0968896032', '37A Trần Bá Giao, P5, Q.Gò Vấp, HCM', 'user.png', '87fcc999d8ce385a6ed70a91e5cac17b', 1, 2, 1, 1),
(19508462, 'Bùi Văn An', 'vanan1301@gmail.com', '0914550898', '123 Nguyen Van Bao', 'user.png', '3799a40af02d431cff1d35f38d84f95c', 1, 2, 1, 1),
(19508463, 'Trần Văn Bình', 'vanbinh@gmail.com', '0789123465', 'Pleiku, Gia Lai', 'user.png', '3799a40af02d431cff1d35f38d84f95c', 1, 2, 1, 1),
(19508490, 'Nguyễn Văn A', 'thailamtruong2001@gmail.com', '0968896032', '270 NTMK, P6, Quận 3, TPHCM', '', '8a1ff30baf208bb9924936165f3798d7', 1, 1, 2, 1),
(19840432, 'Nguyễn Tấn Minh', 'minhtan@gmail.com', '0914550898', '12 Nguyễn Văn Bảo', 'user.png', 'a06b05c11403a28c2687e549d96abce7', 1, 2, 1, 1),
(30250205, 'Nguyễn Quang Tuấn', 'quangtuan@gmail.com', '0968896033', '123 Nguyen Van Bao', 'user.png', '1dfd42b6dc6ef6f2e4f0186e52d1a3db', 2, 6, 1, 1),
(34680537, 'Quang Hà123', 'rabit1309@gmail.com', '0923789456', 'TP.Thủ Đức', NULL, '3dc90cddc52c6fd2318e29ef2b9aa6fa', 2, 6, 2, 1),
(41613264, 'Nguyễn Văn Phú', 'vanphu12@gmail.com', '0986698022', '123 Nguyen Van Bao', 'user.png', '861beb1659de5d041feadd785f3e39e6', 2, 6, 1, 1),
(42817486, 'Bui Van Long', 'rabit139@gmail.com', '0968896022', '123 Nguyen Van Bao', 'user.png', '16c1e6ed6e8f950c2c77baceb6a239be', 1, 1, 1, 1),
(62133381, 'NewwUser123', 'rabit1309@gmail.com', '0968896033', 'TP.Hồ Chí Minh', NULL, '7b703a8ad1bfdb7fdbcf4edfd54753e2', 1, 1, 1, 1),
(77436413, 'Bùi Văn Hòang', 'vanhoang@gmail.com', '0998752346', '12 Nguyễn Văn Bảo, Gò Vấp, HCM, VN', '', 'e3c247e8c6a04faedb5ecda9da55408d', 3, 5, 1, 1);

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
-- Indexes for table `tbl_baocao`
--
ALTER TABLE `tbl_baocao`
  ADD PRIMARY KEY (`ma_baocao`),
  ADD KEY `detai` (`detai`);

--
-- Indexes for table `tbl_chitietbaocao`
--
ALTER TABLE `tbl_chitietbaocao`
  ADD PRIMARY KEY (`ma_ctbaocao`),
  ADD KEY `ma_baocao` (`ma_baocao`),
  ADD KEY `ma_sinhvien` (`ma_sinhvien`);

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
  ADD KEY `hocki` (`hocki`),
  ADD KEY `frk_manganh` (`nganh`);

--
-- Indexes for table `tbl_hocki`
--
ALTER TABLE `tbl_hocki`
  ADD PRIMARY KEY (`ma_hk`);

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
-- Indexes for table `tbl_quantrivien`
--
ALTER TABLE `tbl_quantrivien`
  ADD PRIMARY KEY (`ma_quantrivien`),
  ADD KEY `trangthai` (`trangthai`),
  ADD KEY `vaitro` (`vaitro`);

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
-- AUTO_INCREMENT for table `tbl_baocao`
--
ALTER TABLE `tbl_baocao`
  MODIFY `ma_baocao` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_chitietbaocao`
--
ALTER TABLE `tbl_chitietbaocao`
  MODIFY `ma_ctbaocao` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_chuyennganh`
--
ALTER TABLE `tbl_chuyennganh`
  MODIFY `ma_nganh` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_dangkydetai`
--
ALTER TABLE `tbl_dangkydetai`
  MODIFY `ma_dangky` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_detai`
--
ALTER TABLE `tbl_detai`
  MODIFY `ma_detai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_hocki`
--
ALTER TABLE `tbl_hocki`
  MODIFY `ma_hk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_khoavien`
--
ALTER TABLE `tbl_khoavien`
  MODIFY `ma_khoavien` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_loaidetai`
--
ALTER TABLE `tbl_loaidetai`
  MODIFY `id_loai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_quantrivien`
--
ALTER TABLE `tbl_quantrivien`
  MODIFY `ma_quantrivien` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_thaoluan`
--
ALTER TABLE `tbl_thaoluan`
  MODIFY `ma_cuocthaoluan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_trangthaidangky`
--
ALTER TABLE `tbl_trangthaidangky`
  MODIFY `ma_TTDK` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_trangthaitk`
--
ALTER TABLE `tbl_trangthaitk`
  MODIFY `id_trangthaitk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `ma_nguoidung` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95548879;

--
-- AUTO_INCREMENT for table `tbl_vaitro`
--
ALTER TABLE `tbl_vaitro`
  MODIFY `ma_vaitro` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_baocao`
--
ALTER TABLE `tbl_baocao`
  ADD CONSTRAINT `tbl_baocao_ibfk_1` FOREIGN KEY (`detai`) REFERENCES `tbl_detai` (`ma_detai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_chitietbaocao`
--
ALTER TABLE `tbl_chitietbaocao`
  ADD CONSTRAINT `tbl_chitietbaocao_ibfk_1` FOREIGN KEY (`ma_baocao`) REFERENCES `tbl_baocao` (`ma_baocao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_chitietbaocao_ibfk_2` FOREIGN KEY (`ma_sinhvien`) REFERENCES `tbl_users` (`ma_nguoidung`);

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
  ADD CONSTRAINT `frk_manganh` FOREIGN KEY (`nganh`) REFERENCES `tbl_chuyennganh` (`ma_nganh`),
  ADD CONSTRAINT `tbl_detai_ibfk_1` FOREIGN KEY (`ma_GV`) REFERENCES `tbl_users` (`ma_nguoidung`),
  ADD CONSTRAINT `tbl_detai_ibfk_2` FOREIGN KEY (`loaidetai`) REFERENCES `tbl_loaidetai` (`id_loai`),
  ADD CONSTRAINT `tbl_detai_ibfk_3` FOREIGN KEY (`hocki`) REFERENCES `tbl_hocki` (`ma_hk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_quantrivien`
--
ALTER TABLE `tbl_quantrivien`
  ADD CONSTRAINT `tbl_quantrivien_ibfk_1` FOREIGN KEY (`trangthai`) REFERENCES `tbl_trangthaitk` (`id_trangthaitk`),
  ADD CONSTRAINT `tbl_quantrivien_ibfk_2` FOREIGN KEY (`vaitro`) REFERENCES `tbl_vaitro` (`ma_vaitro`);

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
