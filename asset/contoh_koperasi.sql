-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 27, 2013 at 03:57 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `contoh_koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `noanggota` char(10) NOT NULL,
  `namaanggota` varchar(50) NOT NULL,
  `jk` char(2) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `hp` char(30) NOT NULL,
  `noidentitas` char(30) NOT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`noanggota`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`noanggota`, `namaanggota`, `jk`, `tempat_lahir`, `tgl_lahir`, `alamat`, `hp`, `noidentitas`, `pwd`) VALUES
('A001', 'Deddy Rusdiansyah,S.Kom', 'L', 'Pandeglang', '1979-08-05', 'Cimuncang Sidomuncul No.9', '087774846856', '123456', '4b2770de9b8e1d12df1be94c096cfc29'),
('A002', 'Ugih Sugiarti', 'P', 'Cianjur', '1978-03-01', 'Cimuncang Sidomuncul', '087774846856', '654321', '4b2770de9b8e1d12df1be94c096cfc29'),
('A003', 'Jihan Salsabila', 'P', 'Serang', '2002-06-15', 'Cimuncang Sidomuncul', '087774846856', '987654', '4b2770de9b8e1d12df1be94c096cfc29'),
('A004', 'Danis Putra Pramudia', 'L', 'Serang', '2013-01-26', 'cimuncang sidomuncul', '0877748', '4321', '4b2770de9b8e1d12df1be94c096cfc29');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('9b9550cefa602b515202bac0ddabb781', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.65 Safari/537.31', 1369663048, 'a:4:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"yesGetMeLogin";s:8:"username";s:5:"admin";s:13:"nama_pengguna";s:13:"Administrator";}');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_simpan`
--

CREATE TABLE IF NOT EXISTS `jenis_simpan` (
  `id_jenis` char(2) NOT NULL,
  `jenis_simpanan` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_simpan`
--

INSERT INTO `jenis_simpan` (`id_jenis`, `jenis_simpanan`, `jumlah`) VALUES
('01', 'Simpanan Pokok', 50000),
('02', 'Simpanan Wajib', 30000),
('03', 'Simpanan Sukarela', 0),
('04', 'Simpanan Apa Saja', 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `pengambilan`
--

CREATE TABLE IF NOT EXISTS `pengambilan` (
  `id_ambil` int(10) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `noanggota` char(10) NOT NULL,
  `id_jenis` char(2) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `tglinsert` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ambil`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `pengambilan`
--

INSERT INTO `pengambilan` (`id_ambil`, `tgl`, `noanggota`, `id_jenis`, `jumlah`, `user_id`, `tglinsert`) VALUES
(3, '2012-11-08', 'A003', '03', 5000, 'admin', '2012-11-08 10:38:50'),
(4, '2012-11-08', 'A001', '03', 20000, 'admin', '2012-11-08 10:58:58'),
(8, '2012-11-08', 'A001', '03', 210000, 'admin', '2012-11-08 13:39:27'),
(9, '2013-01-30', 'A003', '03', 50000, 'admin', '2013-01-30 02:12:12'),
(10, '2013-01-30', 'A003', '03', 100000, 'admin', '2013-01-30 02:12:50'),
(11, '2013-01-30', 'A003', '04', 50000, 'admin', '2013-01-30 02:13:16'),
(12, '2013-01-30', 'A003', '04', 200000, 'admin', '2013-01-30 02:26:29'),
(13, '2013-01-30', 'A002', '03', 50000, 'admin', '2013-01-30 02:32:45'),
(14, '2013-02-15', 'A001', '03', 50000, 'admin', '2013-02-15 09:53:59'),
(15, '2013-03-01', 'A003', '03', 100000, 'admin', '2013-02-15 10:03:12'),
(16, '2013-05-20', 'A001', '03', 50000, 'admin', '2013-05-20 07:33:40'),
(17, '2013-05-27', 'A001', '03', 20000, 'admin', '2013-05-27 15:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman_detail`
--

CREATE TABLE IF NOT EXISTS `pinjaman_detail` (
  `id_pinjam` char(10) NOT NULL,
  `cicilan` smallint(6) NOT NULL,
  `angsuran` int(11) NOT NULL,
  `bunga` int(11) NOT NULL,
  `tgl_jatuh_tempo` date DEFAULT NULL,
  `tgl_bayar` date NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `ket` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pinjam`,`cicilan`),
  KEY `id_pinjam` (`id_pinjam`,`cicilan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman_detail`
--

INSERT INTO `pinjaman_detail` (`id_pinjam`, `cicilan`, `angsuran`, `bunga`, `tgl_jatuh_tempo`, `tgl_bayar`, `jumlah_bayar`, `ket`) VALUES
('P0001', 1, 1666667, 1000000, '2013-05-27', '2013-05-27', 2666667, NULL),
('P0001', 2, 1666667, 1000000, '2013-06-27', '2013-05-27', 2666667, NULL),
('P0001', 3, 1666667, 1000000, '2013-07-27', '2013-05-27', 2666667, NULL),
('P0001', 4, 1666667, 1000000, '2013-08-27', '2013-05-27', 2666667, NULL),
('P0001', 5, 1666667, 1000000, '2013-09-27', '2013-05-27', 2666667, NULL),
('P0001', 6, 1666667, 1000000, '2013-10-27', '0000-00-00', 0, NULL),
('P0002', 6, 1666667, 1000000, '2013-10-27', '0000-00-00', 0, NULL),
('P0002', 5, 1666667, 1000000, '2013-09-27', '0000-00-00', 0, NULL),
('P0002', 4, 1666667, 1000000, '2013-08-27', '0000-00-00', 0, NULL),
('P0002', 3, 1666667, 1000000, '2013-07-27', '0000-00-00', 0, NULL),
('P0002', 2, 1666667, 1000000, '2013-06-27', '0000-00-00', 0, NULL),
('P0002', 1, 1666667, 1000000, '2013-05-27', '0000-00-00', 0, NULL),
('P0003', 6, 3333333, 2000000, '2013-10-27', '0000-00-00', 0, NULL),
('P0003', 5, 3333333, 2000000, '2013-09-27', '0000-00-00', 0, NULL),
('P0003', 4, 3333333, 2000000, '2013-08-27', '0000-00-00', 0, NULL),
('P0003', 3, 3333333, 2000000, '2013-07-27', '0000-00-00', 0, NULL),
('P0003', 2, 3333333, 2000000, '2013-06-27', '0000-00-00', 0, NULL),
('P0003', 1, 3333333, 2000000, '2013-05-27', '0000-00-00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman_header`
--

CREATE TABLE IF NOT EXISTS `pinjaman_header` (
  `id_pinjam` char(10) NOT NULL,
  `tgl` date NOT NULL,
  `noanggota` char(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `lama` smallint(6) NOT NULL,
  `bunga` smallint(6) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pinjam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman_header`
--

INSERT INTO `pinjaman_header` (`id_pinjam`, `tgl`, `noanggota`, `jumlah`, `lama`, `bunga`, `user_id`) VALUES
('P0001', '2013-05-27', 'A001', 10000000, 6, 10, 'admin'),
('P0002', '2013-05-27', 'A002', 10000000, 6, 10, 'admin'),
('P0003', '2013-05-27', 'A003', 20000000, 6, 10, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `koperasi` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `hp` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `koperasi`, `alamat`, `kota`, `hp`, `fax`, `email`, `logo`) VALUES
(1, 'KOPERASI DEDDY RUSDIANSYAH', 'cimuncang Sidomuncul No.9 Rt.03 Rw.20', 'Kota Serang', '087774846856', '0', 'deddy_rusdiansyah@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE IF NOT EXISTS `simpanan` (
  `id_simpanan` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `noanggota` char(10) NOT NULL,
  `id_jenis` char(2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `tglinsert` datetime DEFAULT NULL,
  PRIMARY KEY (`id_simpanan`),
  KEY `noanggota` (`noanggota`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id_simpanan`, `tgl`, `noanggota`, `id_jenis`, `jumlah`, `user_id`, `tglinsert`) VALUES
(22, '2012-11-08', 'A001', '01', 50000, 'admin', '2012-11-08 10:37:56'),
(23, '2012-11-08', 'A001', '02', 30000, 'admin', '2012-11-08 10:37:57'),
(24, '2012-11-08', 'A001', '03', 100000, 'admin', '2012-11-08 10:38:04'),
(25, '2012-11-08', 'A002', '01', 50000, 'admin', '2012-11-08 10:38:11'),
(26, '2012-11-08', 'A002', '02', 30000, 'admin', '2012-11-08 10:38:13'),
(27, '2012-11-08', 'A002', '03', 50000, 'admin', '2012-11-08 10:38:17'),
(28, '2012-11-08', 'A003', '01', 50000, 'admin', '2012-11-08 10:38:25'),
(29, '2012-11-08', 'A003', '02', 30000, 'admin', '2012-11-08 10:38:27'),
(30, '2012-11-08', 'A003', '03', 10000, 'admin', '2012-11-08 10:38:31'),
(31, '2012-11-08', 'A001', '03', 50000, 'admin', '2012-11-08 10:57:36'),
(32, '2013-01-17', 'A001', '02', 30000, 'admin', '2013-01-17 20:44:29'),
(34, '2013-01-29', 'A003', '03', 30000, 'admin', '2013-01-28 19:17:12'),
(49, '2013-04-01', 'A001', '01', 50000, 'admin', '2013-04-01 19:54:10'),
(45, '2013-02-15', 'A002', '03', 500000, 'admin', '2013-02-15 09:13:24'),
(43, '2013-01-29', 'A003', '03', 30000, 'admin', '2013-01-29 04:40:53'),
(42, '2013-01-29', 'A003', '03', 400000, 'admin', '2013-01-29 04:39:33'),
(44, '2013-01-29', 'A003', '03', 30000, 'admin', '2013-01-29 04:57:04'),
(40, '2013-01-29', 'A001', '03', 40000, 'admin', '2013-01-28 19:17:30'),
(46, '2013-02-15', 'A003', '02', 30000, 'admin', '2013-02-15 11:10:40'),
(47, '2013-03-01', 'A001', '03', 500000, 'admin', '2013-02-15 11:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `namalengkap` varchar(100) DEFAULT NULL,
  `level` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `namalengkap`, `level`, `foto`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'super admin', 'ayah_profile.jpg'),
('deddy', 'd41d8cd98f00b204e9800998ecf8427e', 'Deddy Rusdiansyah', 'super admin', 'ayah_profile.jpg'),
('a', '0cc175b9c0f1b6a831c399e269772661', 'aa', 'admin', 'soal.jpg'),
('tes', '28b662d883b6d76fd96e4ddc5e9ba780', 'tes', 'super admin', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
