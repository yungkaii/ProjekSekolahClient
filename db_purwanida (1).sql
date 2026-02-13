-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2026 at 11:45 PM
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
-- Database: `db_purwanida`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `gambar`, `tanggal`) VALUES
(3, 'tsdfgsdfg', 'aakjlsdfhjkaljs   djhkljfhjlkashdjfhajsdhf  askdjfhaskjdfjjfjfjf jfjjjjjjj  jjjjjjjjjjjjjjjjjjfjkashdfjkash dfjkahkjdfhakjls   dhfkajsdhfkja  wsHDFKJASHDKJFHASJDFHASS\r\nskedfjgkjsdfkgl skedfjgkjsdfkgl skedfjgkjsdfkgl skedfjgkjsdfkgl skedfjgkjsdfkgl\r\nskedfjgkjsdfkgl\r\nskedfjgkjsdfkglskedfjgkjsdfkgl\r\nskedfjgkjsdfkglskedfjgkjsdfkgl skedfjgkjsdfkgl\r\nskedfjgkjsdfkglskedfjgkjsdfkglskedfjgkjsdfkgl\r\nskedfjgkjsdfkgl', '08022026064735_Screenshot_4.png', '2026-01-31'),
(5, '12312', '1241241', '08022026064807_melihat-lebih-dekat-sekolah-rakyat-di-sentra-handayani-jaktim-1751179722558_169.jpeg', '2026-02-01'),
(6, 'tessss', 'tessss', 'berita-1770529337.jpg', '2026-02-08');

-- --------------------------------------------------------

--
-- Table structure for table `ekstrakurikuler`
--

CREATE TABLE `ekstrakurikuler` (
  `id` int(11) NOT NULL,
  `nama_ekskul` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ekstrakurikuler`
--

INSERT INTO `ekstrakurikuler` (`id`, `nama_ekskul`, `gambar`) VALUES
(2, 'karate', '08022026063311_karate-vs-taekwondo.jpg'),
(3, 'basket nba', '08022026063354_images.jpg'),
(4, 'sdfgsdf', '08022026063426_Screenshot_1.png'),
(5, 'sdfgsdfg', '08022026073435_Screenshot_8.png');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `gambar`, `tanggal`) VALUES
(3, 'ksjahdfjashd', 'galeri-1770529184.jpg', '2026-02-01 12:28:58'),
(4, 'dfgdfgd', 'galeri-1769949376.jpg', '2026-02-01 12:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `deskripsi_banner` text DEFAULT NULL,
  `banner_img` varchar(255) DEFAULT NULL,
  `sambutan` text DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `poin1` varchar(100) DEFAULT NULL,
  `poin2` varchar(100) DEFAULT NULL,
  `poin3` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id`, `nama`, `email`, `telp`, `alamat`, `deskripsi_banner`, `banner_img`, `sambutan`, `foto_profil`, `poin1`, `poin2`, `poin3`) VALUES
(1, 'Sekolah Purwanida', 'info@purwanida.sch.id', '08123456789', 'Jl. Pendidikan No. 1', 'asdfasdfas', 'Screenshot_16.png', 'asdfasdfas', NULL, 'asdfasdf', 'asdfasdf', 'asdfasdf');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `nama`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `profil_sekolah`
--

CREATE TABLE `profil_sekolah` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(100) DEFAULT NULL,
  `deskripsi_hero` text DEFAULT NULL,
  `gambar_hero` varchar(255) DEFAULT NULL,
  `sambutan_kepsek` text DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `isi_profil` text DEFAULT NULL,
  `gambar_profil` varchar(255) DEFAULT NULL,
  `keunggulan_1` varchar(255) DEFAULT NULL,
  `keunggulan_2` varchar(255) DEFAULT NULL,
  `keunggulan_3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_sekolah`
--

INSERT INTO `profil_sekolah` (`id`, `nama_sekolah`, `deskripsi_hero`, `gambar_hero`, `sambutan_kepsek`, `alamat`, `email`, `telepon`, `facebook`, `instagram`, `isi_profil`, `gambar_profil`, `keunggulan_1`, `keunggulan_2`, `keunggulan_3`) VALUES
(1, 'SMP BINA KARYA KREATIF', 'SEKOLAH YANG MENJADIKAN SISWA/I KREATIF MANDIRI KEREN SERTA AKTIF', 'hero-1770525767.jpg', '', '', 'info@purwanida.sch.id', '', 'facebook.com', 'instagram.com', 'INI SAMBUTAN', 'profil_1769945881_jefri-nichol-1_43.jpeg', 'tes11', 'tess22', 'tess33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ekstrakurikuler`
--
ALTER TABLE `ekstrakurikuler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
