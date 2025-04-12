-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2025 at 04:53 AM
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
-- Database: `giuaky`
--

-- --------------------------------------------------------

--
-- Table structure for table `duan`
--

CREATE TABLE `duan` (
  `ID` int(11) NOT NULL,
  `Ten` varchar(50) NOT NULL,
  `MoTa` text NOT NULL,
  `TrangThai` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `duan`
--

INSERT INTO `duan` (`ID`, `Ten`, `MoTa`, `TrangThai`) VALUES
(1, 'Hệ thống quản lý sinh viên', 'Quản lý hệ thống qua đa nền tảng, sử dụng chủ yếu java, python, c++', 'Đã hoàn thánh'),
(2, 'Ứng dụng chat nội bộ', 'Ứng dụng dùng để giao tiếp với các thành viên trong nhóm nhầm tránh việc leak tin nhắn hay làm lộ ra các data hay các hợp đồng quan trọng cho đối thủ.', 'Chưa hoàn thành'),
(3, 'Trang web tuyển dụng ', 'Trang giúp doanh nghiệp và người lao động giảm bớt thời gian, quá trình ứng tuyển công việc.', 'Đã hoàn thánh'),
(4, 'App kiểm soát nông trại', 'Sử dụng giúp doanh nghiệp trong các ngành chăn nuôi giải quyết các vấn đề liên quan đến quan sát sức khỏe của đàn gia súc hay giảm sát số lượng cá thể loài', 'Chưa hoàn thành'),
(5, 'Người máy hỗ trợ người khuyết tật', 'Người máy hướng dẫn và chăm sóc những người bị khuyết tật', 'Đã hoàn thành');

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `id` int(11) NOT NULL,
  `ten_lop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`id`, `ten_lop`) VALUES
(1, 'TDTU1'),
(2, 'TDTU2'),
(3, 'TDTU3'),
(4, 'TDTU4');

-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE `monhoc` (
  `id` int(11) NOT NULL,
  `ten_monhoc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `monhoc`
--

INSERT INTO `monhoc` (`id`, `ten_monhoc`) VALUES
(1, 'Lập trình C'),
(2, 'Cơ sở dữ liệu'),
(3, 'Cấu trúc dữ liệu & Giải thuật'),
(4, 'Thiết kế Web'),
(5, 'Mạng máy tính'),
(6, 'Kỹ thuật lập trình'),
(7, 'Hệ điều hành'),
(8, 'Lập trình hướng đối tượng');

-- --------------------------------------------------------

--
-- Table structure for table `tailieu`
--

CREATE TABLE `tailieu` (
  `ID` int(11) NOT NULL,
  `Ten` varchar(100) NOT NULL,
  `NgayDang` date NOT NULL,
  `TacGia` varchar(100) NOT NULL,
  `MoTa` text NOT NULL,
  `Link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `tailieu`
--

INSERT INTO `tailieu` (`ID`, `Ten`, `NgayDang`, `TacGia`, `MoTa`, `Link`) VALUES
(1, 'Computer security : principles and practice\r\n', '2015-04-16', 'William Stallings', '4th ed. - global ed., New York, : Pearson, 2018. ; 503059 ;Giáo trình ;504088 ;Giáo trình ;503049 ;Giáo trình ; ISBN 9781292220611\r\nCOURSE', 'http://idiscovery.tdtu.edu.vn/primo-explore/fulldisplay?docid=TDT01000077268&context=L&vid=tdtu&lang=en_US&search_scope=default_scope&adaptor=Local%20Search%20Engine&tab=default_tab&query=any,contains,504088&offset=0'),
(2, 'Populism in Europe and the Americas: Threat or Corrective for Democracy?', '2014-12-09', 'Cas Mudde', 'Cambridge University Press 2012 ; ISBN: 110769986X ;ISBN: 1107023858 ;ISBN: 9781107023857 ;ISBN: 9781107699861 ;EISBN: 9781139152365 ;EISBN: 113915236X ;EISBN: 9781139420143 ;EISBN: 1139420143 ;EISBN: 1107231914 ;EISBN: 9781107231917 ;EISBN: 9781139411769 ;EISBN: 1139411764 ;DOI: 10.1017/CBO9781139152365 ;OCLC: 795125118', 'http://idiscovery.tdtu.edu.vn/primo-explore/fulldisplay?docid=TN_cdi_askewsholts_vlebooks_9781139411769&context=PC&vid=tdtu&lang=en_US&search_scope=default_scope&adaptor=primo_central_multiple_fe&tab=default_tab&query=any,contains,504088&offset=0'),
(3, '\r\nMaking Journalists: Diverse Models, Global Issues', '2017-08-10', 'de Burgh, Hugo', '\r\nAt a time when the media’s relation to power is at the forefront of political discussion, this book considers how journalists can affect public discourse on politics, economy and society at large. From well-known and respected authors providing all new material, Making Journalists considers journalism education, training, practice and professionalism across a wide range of countries, including Saudi Arabia, Africa, India, USA and the UK.', 'http://idiscovery.tdtu.edu.vn/primo-explore/fulldisplay?docid=TN_cdi_proquest_miscellaneous_37035654&context=PC&vid=tdtu&lang=en_US&search_scope=default_scope&adaptor=primo_central_multiple_fe&tab=default_tab&query=any,contains,502061&offset=0'),
(4, '\r\nGiải tích cho kỹ thuật : Bài giảng điện tử. ', '2020-04-09', 'Thành Nam Trần', 'Intructor: Trần Thanh Phương\r\nDepartment: Faculty of Electrical and Electronics Engineering', 'http://idiscovery.tdtu.edu.vn/primo-explore/fulldisplay?docid=COURSE000027642&context=L&vid=tdtu&lang=en_US&search_scope=default_scope&adaptor=Local%20Search%20Engine&tab=default_tab&query=any,contains,tr%E1%BA%A7n%20thanh%20nam&offset=0');

-- --------------------------------------------------------

--
-- Table structure for table `thoikhoabieu`
--

CREATE TABLE `thoikhoabieu` (
  `id` int(11) NOT NULL,
  `tuan_id` int(11) NOT NULL,
  `monhoc_id` int(11) NOT NULL,
  `lop_id` int(11) NOT NULL,
  `thu` varchar(10) NOT NULL,
  `gio_batdau` time NOT NULL,
  `gio_ketthuc` time NOT NULL,
  `phong` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `thoikhoabieu`
--

INSERT INTO `thoikhoabieu` (`id`, `tuan_id`, `monhoc_id`, `lop_id`, `thu`, `gio_batdau`, `gio_ketthuc`, `phong`) VALUES
(1, 1, 1, 1, 'Thứ Hai', '07:30:00', '09:00:00', 'A101'),
(2, 1, 2, 1, 'Thứ Ba', '09:10:00', '10:40:00', 'A101'),
(3, 1, 3, 2, 'Thứ Tư', '07:30:00', '09:00:00', 'B201'),
(4, 1, 4, 2, 'Thứ Năm', '09:10:00', '10:40:00', 'B201'),
(5, 1, 5, 3, 'Thứ Sáu', '07:30:00', '09:00:00', 'C301'),
(6, 1, 1, 3, 'Thứ Hai', '09:10:00', '10:40:00', 'C301'),
(7, 1, 2, 4, 'Thứ Ba', '07:30:00', '09:00:00', 'D401'),
(8, 1, 3, 4, 'Thứ Tư', '09:10:00', '10:40:00', 'D401'),
(9, 1, 4, 1, 'Thứ Năm', '07:30:00', '09:00:00', 'E501'),
(10, 1, 5, 1, 'Thứ Sáu', '09:10:00', '10:40:00', 'E501'),
(11, 2, 2, 1, 'Thứ Hai', '07:30:00', '09:00:00', 'A101'),
(12, 2, 3, 1, 'Thứ Tư', '09:10:00', '10:40:00', 'A101'),
(13, 2, 1, 2, 'Thứ Hai', '07:30:00', '09:00:00', 'B201'),
(14, 2, 4, 2, 'Thứ Năm', '09:10:00', '10:40:00', 'B201'),
(15, 2, 5, 3, 'Thứ Sáu', '07:30:00', '09:00:00', 'C301'),
(16, 2, 2, 3, 'Thứ Hai', '09:10:00', '10:40:00', 'C301'),
(17, 2, 3, 4, 'Thứ Ba', '07:30:00', '09:00:00', 'D401'),
(18, 2, 1, 4, 'Thứ Tư', '09:10:00', '10:40:00', 'D401'),
(19, 2, 4, 1, 'Thứ Năm', '07:30:00', '09:00:00', 'E501'),
(20, 2, 5, 1, 'Thứ Hai', '09:10:00', '10:40:00', 'E501'),
(21, 3, 3, 1, 'Thứ Tư', '07:30:00', '09:00:00', 'A101'),
(22, 3, 4, 1, 'Thứ Ba', '09:10:00', '10:40:00', 'A101'),
(23, 3, 5, 2, 'Thứ Năm', '07:30:00', '09:00:00', 'B201'),
(24, 3, 1, 2, 'Thứ Hai', '09:10:00', '10:40:00', 'B201'),
(25, 3, 2, 3, 'Thứ Ba', '07:30:00', '09:00:00', 'C301'),
(26, 3, 3, 3, 'Thứ Năm', '09:10:00', '10:40:00', 'C301'),
(28, 3, 5, 4, 'Thứ Hai', '09:10:00', '10:40:00', 'D401'),
(29, 3, 1, 1, 'Thứ Ba', '07:30:00', '09:00:00', 'E501'),
(30, 3, 2, 1, 'Thứ Tư', '09:10:00', '10:40:00', 'E501'),
(31, 4, 4, 1, 'Thứ Năm', '07:30:00', '09:00:00', 'A101'),
(32, 4, 5, 1, 'Thứ Sáu', '09:10:00', '10:40:00', 'A101'),
(33, 4, 1, 2, 'Thứ Bảy', '07:30:00', '09:00:00', 'B201'),
(34, 4, 2, 2, 'Thứ Hai', '09:10:00', '10:40:00', 'B201'),
(35, 4, 3, 3, 'Thứ Ba', '07:30:00', '09:00:00', 'C301'),
(36, 4, 4, 3, 'Thứ Tư', '09:10:00', '10:40:00', 'C301'),
(37, 4, 5, 4, 'Thứ Năm', '07:30:00', '09:00:00', 'D401'),
(38, 4, 1, 4, 'Thứ Sáu', '09:10:00', '10:40:00', 'D401'),
(39, 4, 2, 1, 'Thứ Bảy', '07:30:00', '09:00:00', 'E501'),
(40, 4, 3, 1, 'Thứ Ba', '09:10:00', '10:40:00', 'E501');

-- --------------------------------------------------------

--
-- Table structure for table `tuan`
--

CREATE TABLE `tuan` (
  `id` int(11) NOT NULL,
  `ten_tuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `tuan`
--

INSERT INTO `tuan` (`id`, `ten_tuan`) VALUES
(1, 'Tuần 1'),
(2, 'Tuần 2'),
(3, 'Tuần 3'),
(4, 'Tuần 4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `duan`
--
ALTER TABLE `duan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tailieu`
--
ALTER TABLE `tailieu`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tuan_id` (`tuan_id`),
  ADD KEY `monhoc_id` (`monhoc_id`),
  ADD KEY `lop_id` (`lop_id`);

--
-- Indexes for table `tuan`
--
ALTER TABLE `tuan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `duan`
--
ALTER TABLE `duan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lop`
--
ALTER TABLE `lop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `monhoc`
--
ALTER TABLE `monhoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tailieu`
--
ALTER TABLE `tailieu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tuan`
--
ALTER TABLE `tuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD CONSTRAINT `thoikhoabieu_ibfk_1` FOREIGN KEY (`tuan_id`) REFERENCES `tuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thoikhoabieu_ibfk_2` FOREIGN KEY (`monhoc_id`) REFERENCES `monhoc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thoikhoabieu_ibfk_3` FOREIGN KEY (`lop_id`) REFERENCES `lop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
