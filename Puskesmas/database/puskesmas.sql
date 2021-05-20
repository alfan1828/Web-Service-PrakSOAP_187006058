-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 10:52 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puskesmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `keluhan` varchar(500) NOT NULL,
  `poli` varchar(500) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `obat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `alamat`, `keluhan`, `poli`, `nama_pasien`, `obat`) VALUES
(0, 'Singaparna', 'Sakit gigi berlubang', 'Gigi', 'Amira', 'Acetaminophen'),
(0, 'Kawalu', 'Pusing tekanan darah tinggi', 'Laboratorium(cek darah)', 'Puji', 'Angiotensin converting enzyme (ACE)'),
(0, 'Indihiang', 'Pemasangan Ayudi', 'KB', 'Susi', 'Ayudi'),
(0, 'Asrama nyantong', 'Anak demam tidak mau menyusui', 'KIA', 'Kharisma', 'Paracetamol dan Vitamin'),
(0, 'Tawang', 'Jadwal Imunisasi Hepatitis B', 'Imunisasi', 'Ainun', 'Vaksin Hepatitis B'),
(0, 'Cihideng', 'Artritis radang sendi', 'Lansia', 'Bu Yumna', 'IbuProfen, naproxen'),
(0, 'Tamansari Gobras', 'Demam dan Migrain', 'Umum', 'Riska', 'Biogesic'),
(0, 'Sindanggalih', 'Diare BAB 5x sehari', 'Umum', 'Alfan', 'Diardis'),
(0, 'Indihiang', 'Pusing disertai mual', 'Umum', 'Hilma', 'Dramamine');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
