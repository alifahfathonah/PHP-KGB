-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25 Apr 2018 pada 16.59
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yuli`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `Kd_gaji` varchar(15) NOT NULL,
  `TanggalGaji` date NOT NULL,
  `Kd_guru` varchar(15) NOT NULL,
  `Kd_jabatan` varchar(15) NOT NULL,
  `Kd_golongan` varchar(15) NOT NULL,
  `Kd_transport` varchar(15) NOT NULL,
  `Kd_Tanak` varchar(15) NOT NULL,
  `Kd_fungsional` varchar(5) NOT NULL,
  `TotalGaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`Kd_gaji`, `TanggalGaji`, `Kd_guru`, `Kd_jabatan`, `Kd_golongan`, `Kd_transport`, `Kd_Tanak`, `Kd_fungsional`, `TotalGaji`) VALUES
('G00001', '2018-04-13', 'G01', '0001', 'IA', '1', 'A01', '001', 426000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan`
--

CREATE TABLE `golongan` (
  `Kd_golongan` varchar(15) NOT NULL,
  `Nm_golongan` varchar(50) NOT NULL,
  `gapok` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `golongan`
--

INSERT INTO `golongan` (`Kd_golongan`, `Nm_golongan`, `gapok`) VALUES
('IA', 'Juru Muda', 120000),
('IB', 'Juru Muda Tingkat 1', 140000),
('IC', 'Juru', 160000),
('ID', 'Juru Tingkat 1', 180000),
('IIA', 'Pengatur Muda', 200000),
('IIB', 'Pengatur Muda Tingkat 1', 240000),
('IIC', 'Pengatur', 260000),
('IID', 'Pengatur Tingkat 1', 280000),
('IIIA', 'Penata Muda', 300000),
('IIIB', 'Penata Muda Tingkat 1', 320000),
('IIIC', 'Penata', 340000),
('IIID', 'Penata Tingkat 1', 360000),
('IVA', 'Pembina', 380000),
('IVB', 'Pembina Tingkat 1', 400000),
('IVC', 'Pembina Utama Muda', 420000),
('IVD', 'Pembina Utama Madya', 440000),
('IVE', 'Pembina Utama', 460000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `Kd_guru` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` enum('admin','guru','pimpinan','') NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `TempatLahir` varchar(20) NOT NULL,
  `TanggalLahir` date NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `JenisKelamin` enum('laki','perempuan','','') NOT NULL,
  `Handphone` varchar(13) NOT NULL,
  `JarakRumah` int(11) NOT NULL,
  `JumlahAnak` int(11) NOT NULL,
  `Tanggal_masuk` date NOT NULL,
  `Kd_jabatan` varchar(15) NOT NULL,
  `Kd_golongan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`Kd_guru`, `username`, `password`, `level`, `Nama`, `TempatLahir`, `TanggalLahir`, `Alamat`, `JenisKelamin`, `Handphone`, `JarakRumah`, `JumlahAnak`, `Tanggal_masuk`, `Kd_jabatan`, `Kd_golongan`) VALUES
('1', 'admin', 'admin', 'admin', 'Super User', '-', '2016-04-01', '-', 'laki', '-', 0, 0, '2018-04-13', '', ''),
('G01', 'admin', 'admin', 'admin', 'admin', 'admin', '2018-04-13', 'admin', 'laki', '-', 1, 0, '2018-04-13', '0001', 'IA'),
('G02', 'guru', 'guru', 'guru', 'guru', 'solo', '2018-04-13', 'solo', 'laki', '-', 2, 2, '2018-04-13', '0002', 'IB'),
('G03', 'pimpinan', 'pimpinan', 'pimpinan', 'pimpinan', 'solo', '2018-04-13', 'Solo', 'laki', '-', 1, 1, '2018-04-13', '0003', 'IC');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `Kd_jabatan` varchar(15) NOT NULL,
  `Nm_jabatan` varchar(50) NOT NULL,
  `TunjanganStruktural` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`Kd_jabatan`, `Nm_jabatan`, `TunjanganStruktural`) VALUES
('0001', 'Kepala Sekolah', 250000),
('0002', 'Kepala TU', 150000),
('0003', 'Kepala UPT', 150000),
('0004', 'Kepala UR', 150000),
('0005', 'Wali Kelas', 125000),
('0006', 'Guru', 125000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kenaikan_kgb`
--

CREATE TABLE `kenaikan_kgb` (
  `Kd_kenaikan` varchar(15) NOT NULL,
  `Kenaikan` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kenaikan_kgb`
--

INSERT INTO `kenaikan_kgb` (`Kd_kenaikan`, `Kenaikan`) VALUES
('0001', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kgb`
--

CREATE TABLE `kgb` (
  `Kd_kgb` varchar(15) NOT NULL,
  `Kd_guru` varchar(15) NOT NULL,
  `Kd_golongan` varchar(15) NOT NULL,
  `Kd_kenaikan` varchar(15) NOT NULL,
  `TotalKenaikan` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_anak`
--

CREATE TABLE `t_anak` (
  `Kd_Tanak` varchar(15) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `Tanak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_anak`
--

INSERT INTO `t_anak` (`Kd_Tanak`, `jumlah`, `Tanak`) VALUES
('A01', 1, 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_fungsional`
--

CREATE TABLE `t_fungsional` (
  `Kd_fungsional` varchar(5) NOT NULL,
  `Jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_fungsional`
--

INSERT INTO `t_fungsional` (`Kd_fungsional`, `Jumlah`) VALUES
('001', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_transportrasi`
--

CREATE TABLE `t_transportrasi` (
  `Kd_transport` varchar(15) NOT NULL,
  `NamaJarak` varchar(15) NOT NULL,
  `Jarak` varchar(15) NOT NULL,
  `Tjarak` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `t_transportrasi`
--

INSERT INTO `t_transportrasi` (`Kd_transport`, `NamaJarak`, `Jarak`, `Tjarak`) VALUES
('1', 'Dekat', '. .>5', 50000),
('2', 'Sedang', '5-10', 75000),
('3', 'Jauh', '10<. .', 100000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`Kd_gaji`),
  ADD KEY `FK_gaji2` (`Kd_jabatan`),
  ADD KEY `FK_gaji3` (`Kd_golongan`),
  ADD KEY `FK_tunjangananak` (`Kd_Tanak`),
  ADD KEY `FK_tunjangtransport` (`Kd_transport`),
  ADD KEY `FK_tunjanganfungsional` (`Kd_fungsional`),
  ADD KEY `FK_guru` (`Kd_guru`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`Kd_golongan`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`Kd_guru`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`Kd_jabatan`);

--
-- Indexes for table `kenaikan_kgb`
--
ALTER TABLE `kenaikan_kgb`
  ADD PRIMARY KEY (`Kd_kenaikan`);

--
-- Indexes for table `kgb`
--
ALTER TABLE `kgb`
  ADD PRIMARY KEY (`Kd_kgb`),
  ADD KEY `FK_kgbguru` (`Kd_guru`),
  ADD KEY `FK_kgbgolongan` (`Kd_golongan`),
  ADD KEY `FK_kgbkenaikan` (`Kd_kenaikan`);

--
-- Indexes for table `t_anak`
--
ALTER TABLE `t_anak`
  ADD PRIMARY KEY (`Kd_Tanak`);

--
-- Indexes for table `t_fungsional`
--
ALTER TABLE `t_fungsional`
  ADD PRIMARY KEY (`Kd_fungsional`);

--
-- Indexes for table `t_transportrasi`
--
ALTER TABLE `t_transportrasi`
  ADD PRIMARY KEY (`Kd_transport`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `FK_gaji2` FOREIGN KEY (`Kd_jabatan`) REFERENCES `jabatan` (`Kd_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_gaji3` FOREIGN KEY (`Kd_golongan`) REFERENCES `golongan` (`Kd_golongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_guru` FOREIGN KEY (`Kd_guru`) REFERENCES `guru` (`Kd_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tunjangananak` FOREIGN KEY (`Kd_Tanak`) REFERENCES `t_anak` (`Kd_Tanak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tunjanganfungsional` FOREIGN KEY (`Kd_fungsional`) REFERENCES `t_fungsional` (`Kd_fungsional`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tunjangtransport` FOREIGN KEY (`Kd_transport`) REFERENCES `t_transportrasi` (`Kd_transport`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kgb`
--
ALTER TABLE `kgb`
  ADD CONSTRAINT `FK_kgbgolongan` FOREIGN KEY (`Kd_golongan`) REFERENCES `golongan` (`Kd_golongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_kgbguru` FOREIGN KEY (`Kd_guru`) REFERENCES `guru` (`Kd_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_kgbkenaikan` FOREIGN KEY (`Kd_kenaikan`) REFERENCES `kenaikan_kgb` (`Kd_kenaikan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
