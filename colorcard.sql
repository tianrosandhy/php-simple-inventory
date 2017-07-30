-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2017 at 07:30 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `colorcard`
--

-- --------------------------------------------------------

--
-- Table structure for table `cc_divisi`
--

CREATE TABLE `cc_divisi` (
  `id` int(11) NOT NULL,
  `nama_divisi` varchar(50) DEFAULT NULL,
  `stat` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cc_divisi`
--

INSERT INTO `cc_divisi` (`id`, `nama_divisi`, `stat`) VALUES
(1, 'Citra Warna 01', 1),
(2, 'Citra Warna 02', 1),
(3, 'Citra Warna 03', 1),
(4, 'Citra Warna 04', 1),
(5, 'Citra Warna 05', 1),
(6, 'Citra Warna 06', 1),
(7, 'Citra Warna 07', 1),
(8, 'Citra Warna 08', 1),
(9, 'Citra Warna 9', 9),
(10, 'Citra Warna 10', 1),
(11, 'Citra Warna 11', 9),
(12, 'Citra Warna 09', 1),
(13, 'Citra Warna 11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cc_kirim`
--

CREATE TABLE `cc_kirim` (
  `id` int(11) NOT NULL,
  `id_master` int(11) DEFAULT NULL,
  `id_divisi` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `ket` varchar(300) DEFAULT NULL,
  `stat` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cc_master`
--

CREATE TABLE `cc_master` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `stat` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cc_project`
--

CREATE TABLE `cc_project` (
  `id` int(11) NOT NULL,
  `nama_project` varchar(100) NOT NULL,
  `tgl` datetime NOT NULL,
  `stat` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cc_temp`
--

CREATE TABLE `cc_temp` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `tb` varchar(30) NOT NULL,
  `id_master` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `jml` int(11) NOT NULL,
  `ket` varchar(300) NOT NULL,
  `stat` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cc_terima`
--

CREATE TABLE `cc_terima` (
  `id` int(11) NOT NULL,
  `id_master` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `ket` varchar(300) DEFAULT NULL,
  `stat` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cc_terjual`
--

CREATE TABLE `cc_terjual` (
  `id` int(11) NOT NULL,
  `id_master` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `jml` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `ket` varchar(300) NOT NULL,
  `stat` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cms_admin`
--

CREATE TABLE `cms_admin` (
  `username` varchar(32) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  `priviledge` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_admin`
--

INSERT INTO `cms_admin` (`username`, `name`, `email`, `password`, `token`, `priviledge`) VALUES
('admin', 'Administrator', 'tianrosandhy@gmail.com', '$2y$10$NtVX2YLOV3nbuL8H5yYcJ.o3Q3VBKuBV3rfHg2NovHMUEDgM6o8aS', 'd8ed7457a3464c783a4485c5173c8adce2210c1a', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_admin_fail`
--

CREATE TABLE `cms_admin_fail` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `useragent` varchar(500) DEFAULT NULL,
  `stat` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cms_admin_log`
--

CREATE TABLE `cms_admin_log` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tgl` datetime DEFAULT NULL,
  `expired` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_admin_log`
--

INSERT INTO `cms_admin_log` (`id`, `username`, `tgl`, `expired`, `token`, `ip`, `user_agent`) VALUES
(1, 'admin', '2017-06-30 05:02:19', '2017-06-30 17:02:19', 'c42b3d41b4d6a3895cf2b80e7a08dcb1be9a83c1', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'),
(2, 'admin', '2017-07-01 02:50:18', '2017-07-01 14:50:18', 'a2f9392bf91dc705be0c92d0f3458a6a52b697d2', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(3, 'admin', '2017-07-03 02:01:15', '2017-07-03 14:01:15', '0ca31bee87d86235bc193dcd8ec46414c452a647', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(4, 'admin', '2017-07-04 03:19:15', '2017-07-04 15:19:15', '15fc59bcb23e52ab0ec6a76a41d66ed28a8aedee', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(5, 'admin', '2017-07-04 05:25:47', '2017-07-04 17:25:47', '26173cfafee8cb96a218ebe97df3ebb185c1fbe2', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(6, 'admin', '2017-07-04 05:25:53', '2017-07-04 17:25:53', '7380ae29990cb723955ce30f7a2ba822fd479669', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(7, 'admin', '2017-07-04 09:51:28', '2017-07-04 21:51:28', '98c1f89c3c6849332601c4bf6cc0d158607ad783', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(8, 'admin', '2017-07-05 03:24:25', '2017-07-05 15:24:25', 'ed3e08a5348fe61c41e7c9d7a9a5219f4041f04f', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'),
(9, 'admin', '2017-07-05 05:12:36', '2017-07-05 17:12:36', '6fbcdf8202f29748e95572958f9f832dbe34eda6', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `cms_option`
--

CREATE TABLE `cms_option` (
  `id` int(4) NOT NULL,
  `param` varchar(30) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `content` text,
  `type` varchar(20) DEFAULT NULL,
  `def` text,
  `stat` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_option`
--

INSERT INTO `cms_option` (`id`, `param`, `label`, `content`, `type`, `def`, `stat`) VALUES
(1, 'session_key', 'Session Key', 'tianrosandhy_sess_key', 'text', 'tianrosandhy_sess_key', 9),
(2, 'backend_paging', 'Data Per Page (Admin)', '20', 'number', '20', 1),
(3, 'frontend_paging', 'Data Per Page (Front)', '10', 'number', '10', 1),
(4, 'webname', 'Website Name', 'Aplikasi Monitoring Color Card CWA', 'text', 'Website Name', 1),
(5, 'websubtitle', 'Website Sub Title', 'Another TianRosandhy''s CMS Site', 'text', 'Another TianRosandhy''s CMS Site', 1),
(6, 'max_login_try', 'Login Failed Max Try', '5', 'number', '5', 1),
(7, 'header_image', 'Header Image', NULL, 'text', NULL, 1),
(8, 'favicon', 'Favicon', NULL, 'text', NULL, 1),
(9, 'mail_system', 'Website Mail', 'me@tianrosandhy.com', 'text', 'me@tianrosandhy.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cc_divisi`
--
ALTER TABLE `cc_divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_kirim`
--
ALTER TABLE `cc_kirim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_master`
--
ALTER TABLE `cc_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_project`
--
ALTER TABLE `cc_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_temp`
--
ALTER TABLE `cc_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_terima`
--
ALTER TABLE `cc_terima`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_terjual`
--
ALTER TABLE `cc_terjual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_admin`
--
ALTER TABLE `cms_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `cms_admin_fail`
--
ALTER TABLE `cms_admin_fail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_admin_log`
--
ALTER TABLE `cms_admin_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_option`
--
ALTER TABLE `cms_option`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cc_divisi`
--
ALTER TABLE `cc_divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `cc_kirim`
--
ALTER TABLE `cc_kirim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cc_master`
--
ALTER TABLE `cc_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cc_project`
--
ALTER TABLE `cc_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cc_temp`
--
ALTER TABLE `cc_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cc_terima`
--
ALTER TABLE `cc_terima`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cc_terjual`
--
ALTER TABLE `cc_terjual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms_admin_fail`
--
ALTER TABLE `cms_admin_fail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cms_admin_log`
--
ALTER TABLE `cms_admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `cms_option`
--
ALTER TABLE `cms_option`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
