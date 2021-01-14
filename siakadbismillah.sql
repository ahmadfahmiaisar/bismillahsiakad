-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2021 pada 18.20
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakadbismillah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dhs`
--

CREATE TABLE `dhs` (
  `id_dhs` int(25) NOT NULL,
  `fk_krs` int(25) NOT NULL,
  `bobot_nilai` float NOT NULL,
  `huruf` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dhs`
--

INSERT INTO `dhs` (`id_dhs`, `fk_krs`, `bobot_nilai`, `huruf`) VALUES
(32, 654, 4, 'A'),
(35, 476, 0, ''),
(37, 583, 0, ''),
(38, 661, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(25) NOT NULL,
  `namadosen` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `namadosen`, `prodi`) VALUES
(1, 'Prof. Dr. Ahmad Fahmi Aisar, S.Pd, M.Sc', 'Pendidikan Teknik Informatika'),
(2, 'Prof. Dr. Sholikhah Indah Widiyanti, S.Pd, M.Si', 'Pendidikan Teknik Informatika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(25) NOT NULL,
  `rombel` varchar(5) NOT NULL,
  `ruang` varchar(25) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `rombel`, `ruang`, `hari`, `jam`) VALUES
(1, 'E', 'LPTK 5', 'Senin', '09.00'),
(2, 'E', 'Lab Komputer', 'Selasa', '09.00'),
(3, 'E', 'AVA B', 'Rabu', '09.00'),
(4, 'E', 'Lab Pemrograman', 'Kamis', '09.00'),
(5, 'E', 'LPTK 4', 'Jum\'at', '09.00'),
(6, 'E', 'LPTK 5', 'Senin', '13.00'),
(7, 'E', 'Lab Komputer', 'Selasa', '13.00'),
(8, 'E', 'AVA B', 'Rabu', '13.00'),
(9, 'E', 'Lab Pemrograman', 'Kamis', '13.00'),
(10, 'E', 'LPTK 4', 'Jum\'at', '13.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `krs`
--

CREATE TABLE `krs` (
  `id_krs` int(25) NOT NULL,
  `fk_user` int(25) NOT NULL,
  `fk_matkul` int(25) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `krs`
--

INSERT INTO `krs` (`id_krs`, `fk_user`, `fk_matkul`, `tahun`, `status`) VALUES
(476, 1, 4, '2021', 'Accepted'),
(583, 3, 5, '2021', 'Accepted'),
(654, 3, 4, '2020', 'Rejected'),
(661, 3, 3, '2021', 'Accepted');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` int(25) NOT NULL,
  `fk_dosen` int(25) NOT NULL,
  `fk_kelas` int(25) NOT NULL,
  `kode_matkul` varchar(25) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL,
  `total_sks` varchar(5) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `matkul`
--

INSERT INTO `matkul` (`id_matkul`, `fk_dosen`, `fk_kelas`, `kode_matkul`, `nama_matkul`, `total_sks`, `semester`, `keterangan`) VALUES
(1, 2, 1, 'MKP6602', 'Pengembangan Aplikasi Mobile', '2', '1', 'Praktek'),
(2, 2, 2, 'PTI6264', 'Scripting Language', '2', '2', 'Praktek'),
(3, 2, 3, 'PTI6270', 'Artificial Intelligence', '2', '3', 'Praktek'),
(4, 2, 4, 'PTI6136', 'Mobile and Cloud Computing Arch', '1', '4', 'Praktek'),
(5, 2, 5, 'PTI6270', 'Sistem Pendukung Keputusan', '1', '5', 'Praktek'),
(6, 1, 10, 'PTI6270', 'Pendidikan Agama Islam', '3', '5', 'Teori'),
(7, 1, 6, 'PTI6217', 'Matematika Diskrit', '2', '1', 'Teori'),
(8, 1, 7, 'PTI6264', 'Algoritma Pemrograman', '2', '2', 'Teori'),
(9, 1, 8, 'PTI6242', 'Interaksi Manusia dan Komputer', '2', '3', 'Teori'),
(10, 1, 9, 'PTI6241', 'Bahasa Inggris Teknik', '2', '4', 'Teori');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `roles` varchar(20) NOT NULL,
  `prodi` varchar(35) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `password`, `roles`, `prodi`, `picture`) VALUES
(1, 'Ahmad Fahmi Aisar', '16520241006', 'ahmad.fahmi2016@student.uny.ac.id', '@ahmad', 'mahasiswa', 'Pendidikan Teknik Informatika', 'https://i.ibb.co/KbzJNSz/IMG-2992.jpg'),
(2, 'Prof. Dr. Fuad Reza Pahlevi, S.Pd, M.Sc', '16520244004', 'fuad.reza2016@student.uny.ac.id', '@sifu', 'dosen', 'Pendidikan Teknik Informatika', 'https://i.ibb.co/Mg70VL7/IMG-20191126-062109.jpg'),
(3, 'Sholikhah Indah Widiyanti', '16520241015', 'sholikhah.indah2016@student.uny.ac.id', '@indah', 'mahasiswa', 'Pendidikan Teknik Informatika', 'https://i.ibb.co/CW5ZDw5/IMG-20190725-WA0001.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dhs`
--
ALTER TABLE `dhs`
  ADD PRIMARY KEY (`id_dhs`),
  ADD KEY `fk_krs` (`fk_krs`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id_krs`),
  ADD KEY `fk_user` (`fk_user`),
  ADD KEY `fk_matkul` (`fk_matkul`);

--
-- Indeks untuk tabel `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`),
  ADD KEY `fk_dosen` (`fk_dosen`),
  ADD KEY `fk_kelas` (`fk_kelas`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dhs`
--
ALTER TABLE `dhs`
  MODIFY `id_dhs` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `krs`
--
ALTER TABLE `krs`
  MODIFY `id_krs` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=871;

--
-- AUTO_INCREMENT untuk tabel `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id_matkul` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dhs`
--
ALTER TABLE `dhs`
  ADD CONSTRAINT `dhs_ibfk_1` FOREIGN KEY (`fk_krs`) REFERENCES `krs` (`id_krs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krs_ibfk_5` FOREIGN KEY (`fk_matkul`) REFERENCES `matkul` (`id_matkul`);

--
-- Ketidakleluasaan untuk tabel `matkul`
--
ALTER TABLE `matkul`
  ADD CONSTRAINT `matkul_ibfk_1` FOREIGN KEY (`fk_dosen`) REFERENCES `dosen` (`id_dosen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matkul_ibfk_2` FOREIGN KEY (`fk_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
