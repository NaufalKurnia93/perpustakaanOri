-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 08, 2024 at 02:09 AM
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
-- Database: `perpustakaan-naufal`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(100) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telpon` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_anggota`, `alamat`, `no_telpon`) VALUES
(13, 'ZAKI ARDIAN ABRORa', 'LUBAH HULU', 2147483647),
(14, 'YOZA ANDIKA PUTRA', 'SIMP KHALID BIN WALID', 2323),
(15, 'YUDI KURNIAWAN', 'PESAGANG', 232123),
(16, 'MUHAMMAD FEBRIAN', 'JAWA', 1322),
(17, 'RAFIQ ALHAFIDZ', 'LANGKITIN', 23223),
(18, 'MUHAMMAD FADLI TAFADZUL', 'TULANG GAJAH', 242334234),
(19, 'ANITA BUDIARTI', 'TAMBUSAI', 3532434),
(20, 'RADIT KIBOY', 'LUBAH HILIR', 24323432),
(21, 'MUHAMMAD IKRAM', 'KAMPUNG BARU ', 39444),
(22, 'NAUFAL KURNIA', 'TANJUNG BELIT', 3432),
(23, 'JULIA SAFITRI', 'SIMPANG D', 2147483647),
(24, 'MUHAMMAD IDRIS', 'TULANG GAJAH', 13242323),
(25, 'ANISA RAMADHANI', 'KAMPUNG PADANG', 13243232),
(26, 'SUPRIADI', 'NOGORI', 23343223),
(27, 'DWI INDRIAYANI', 'SOSA', 234334),
(28, 'PAJRI WIJAYA', 'SUNGAI PINANG', 2342323),
(29, 'pak pauziii', 'kampar', 123),
(30, 'naura kurnia', 'jalan pendidikan ', 234424);

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` varchar(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `id_kategori` varchar(100) NOT NULL,
  `id_penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `id_kategori`, `id_penulis`, `penerbit`, `tahun_terbit`) VALUES
('BOk_004', 'seni itu abadi', '8', '3', 'genora indonesia', 2020),
('BOk_005', 'Adminisrtrasi Sistem Jaringan', '13', '8', 'erlangga', 2024),
('BOk_006', 'sejarah evolusi manusia', '9', '6', 'mayatama', 2020),
('BOk_007', 'budaya melayu riau', '14', '7', 'erlangga', 2021),
('BOk_008', 'Simulasi Digital', '13', '10', 'mayatama', 2022),
('BOk_009', 'madilog', '9', '6', 'kebumen', 2023);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(100) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(9, 'Sejarah'),
(10, 'Kuliner'),
(11, 'Novel'),
(12, 'perhitungan'),
(13, 'KEJURUAN'),
(14, 'MUATAN LOKAL'),
(15, 'OLAHRAGA'),
(16, 'UMUM');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` varchar(100) NOT NULL,
  `id_anggota` varchar(100) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `id_petugas` varchar(100) NOT NULL,
  `status` enum('berlangsung','selesai','terlambat') DEFAULT 'berlangsung'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_anggota`, `tanggal_pinjam`, `tanggal_kembali`, `id_petugas`, `status`) VALUES
('PJM001', '3', '0000-00-00', '0000-00-00', '10', 'berlangsung'),
('PJM002', '5', '2024-11-07', '2024-11-13', '10', 'selesai'),
('PJM003', '12', '2024-11-07', '2024-11-08', '10', 'berlangsung'),
('PJM004', '22', '2024-11-07', '2024-11-08', '12', 'berlangsung'),
('PJM005', '13', '2024-11-07', '2024-11-21', '8', 'selesai'),
('PJM006', '16', '2024-11-07', '2024-11-25', '11', 'selesai'),
('PJM007', '22', '2024-11-07', '2024-11-20', '12', 'berlangsung'),
('PJM008', '21', '2024-11-07', '2024-11-06', '8', 'berlangsung'),
('PJM009', '20', '2024-11-07', '2024-11-22', '12', 'berlangsung'),
('PJM010', '23', '2024-11-07', '2024-11-14', '11', 'berlangsung'),
('PJM011', '22', '2024-11-27', '2024-11-27', '11', 'berlangsung'),
('PJM012', '28', '2024-11-07', '2024-11-25', '12', 'berlangsung'),
('PJM013', '26', '2024-12-02', '2024-11-28', '12', 'berlangsung'),
('PJM014', '19', '2024-11-07', '2024-11-09', '12', 'berlangsung'),
('PJM015', '25', '2024-11-07', '2024-11-01', '11', 'berlangsung'),
('PJM016', '15', '2024-11-19', '2024-12-05', '8', 'berlangsung'),
('PJM017', '18', '2024-11-18', '2024-11-25', '11', 'berlangsung'),
('PJM018', '24', '2024-11-25', '2024-11-16', '12', 'berlangsung'),
('PJM019', '17', '2024-11-28', '2024-11-07', '8', 'berlangsung'),
('PJM020', '23', '2024-11-07', '2024-11-19', '11', 'berlangsung'),
('PJM021', '22', '2024-11-27', '2024-11-06', '8', 'berlangsung'),
('PJM022', '13', '2024-11-07', '2024-11-13', '11', 'berlangsung'),
('PJM023', '14', '2024-11-07', '2024-11-13', '11', 'berlangsung'),
('PJM024', '20', '2024-11-07', '2024-11-19', '12', 'berlangsung'),
('PJM025', '16', '2024-11-07', '2024-11-21', '11', 'berlangsung'),
('PJM026', '23', '2024-11-07', '2024-11-04', '11', 'berlangsung'),
('PJM027', '28', '2024-11-07', '2024-11-19', '12', 'berlangsung'),
('PJM028', '23', '2024-11-07', '2024-11-21', '12', 'berlangsung'),
('PJM029', '15', '2024-11-07', '2024-11-21', '11', 'berlangsung'),
('PJM030', '15', '2024-11-07', '2024-11-16', '11', 'berlangsung'),
('PJM031', '18', '2024-11-07', '2024-11-07', '11', 'berlangsung'),
('PJM032', '25', '2024-11-07', '2024-11-12', '12', 'berlangsung'),
('PJM033', '22', '2024-11-07', '2024-11-06', '8', 'berlangsung'),
('PJM034', '23', '2024-11-07', '2024-11-16', '8', 'berlangsung'),
('PJM035', '25', '2024-11-07', '2024-11-05', '8', 'berlangsung'),
('PJM036', '25', '2024-11-07', '2024-11-16', '', 'berlangsung'),
('PJM037', '20', '2024-11-18', '2024-01-01', '8', 'selesai'),
('PJM038', '30', '2024-12-07', '2024-12-10', '8', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_detail`
--

CREATE TABLE `peminjaman_detail` (
  `id_peminjaman_detail` int(11) NOT NULL,
  `id_peminjaman` varchar(100) NOT NULL,
  `id_buku` varchar(100) NOT NULL,
  `denda` int(11) NOT NULL,
  `status` enum('Belum Dikonfirmasi','Dikonfirmasi') DEFAULT 'Belum Dikonfirmasi'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `peminjaman_detail`
--

INSERT INTO `peminjaman_detail` (`id_peminjaman_detail`, `id_peminjaman`, `id_buku`, `denda`, `status`) VALUES
(1, 'PJM003', 'BOk_005', 0, 'Belum Dikonfirmasi'),
(7, 'PJM008', 'BOk_004', 1000, 'Dikonfirmasi'),
(8, 'PJM008', 'BOk_005', 1000, 'Dikonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(10) NOT NULL,
  `nama_penulis` varchar(190) NOT NULL,
  `asal_negara` varchar(100) NOT NULL,
  `jumlah_karya` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama_penulis`, `asal_negara`, `jumlah_karya`) VALUES
(6, 'ROCKY GERUNG', 'INDONESIA', 204),
(7, 'NAJWA SIHAB', 'INDONESIA', 33),
(8, 'BPK. YULIA FAUZI', 'INDONESIA', 33),
(9, 'BPK IDRIS LIKA', 'INDONESIA', 33),
(10, 'BPK ADEK PERNANDES', 'INDONESIA', 33);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(100) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `shift` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `jenis_kelamin`, `alamat`, `jabatan`, `shift`) VALUES
(8, 'gibran', 'Laki-laki', 'jalan solo ll;', 'Teknisi Perpustakaan', 'pagi'),
(11, 'agus gumiwangan', 'Laki-laki', 'jalan golkar v', 'Pelayanan Pengguna', 'pagi'),
(12, 'susanti', 'Perempuan', 'hurung', 'Teknisi Perpustakaan', 'sore');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` int(255) NOT NULL,
  `password` varchar(244) NOT NULL,
  `role` enum('super_admin','admin','petugas','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `no_telp`, `password`, `role`) VALUES
(27, 'juan', 'go', 'go@gmail.com', 221, '$2y$10$fIPoPCcRoGz4aFX.Cyo/Qe.ceXlm.h4lWbh.OO34sXpa4MImsP57u', 'admin'),
(28, 'naufal kurnia', 'root', 'noufalkurnia1@gmail.com', 2147483647, '$2y$10$vWU07A3EEvMPz7a0ISc00.W1RxfHCrf6srISbEMJnZMxT59REh.ue', 'super_admin'),
(29, 'naufal', 'naufal', 'a@gmail.com', 123, '$2y$10$dFaz17mKuWu8EcRalTwePOqejiGG6JWQ2CG2s3yMaXzUWcQd7/O3W', 'super_admin'),
(31, 'JULIAA', 'juli', 'nou0@gmail.com', 99999, '$2y$10$WesYqqo7GV8/PgZJYa0.QeEo1xP.cZz/R/.LuCesvo5V/P3dx/p8e', 'super_admin'),
(34, 'naura kurnia', 'naura', 'nora@gmail.com', 999, '$2y$10$Bg4i4INBiBTB5nSeHWlF/.ZEZf/XoYoVeXt88sW/J2A1D.m8Zz4Pq', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  ADD PRIMARY KEY (`id_peminjaman_detail`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`nama`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  MODIFY `id_peminjaman_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
