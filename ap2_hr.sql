-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2019 at 05:18 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ap2_hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fungsi`
--

CREATE TABLE `tbl_fungsi` (
  `ID` int(11) NOT NULL,
  `nama_fungsi` varchar(50) NOT NULL,
  `jml_butuh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `ID` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `syarat_didik` tinytext NOT NULL,
  `syarat_latih` tinytext NOT NULL,
  `syarat_pengalaman` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `ID` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `tgl_lahir` datetime NOT NULL,
  `id_kj` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_status1` int(11) NOT NULL,
  `id_status2` int(11) NOT NULL,
  `id_unitkerja` int(11) NOT NULL,
  `rencana_mpp` datetime NOT NULL,
  `rencana_pensiun` datetime NOT NULL,
  `pend_diakui` varchar(50) NOT NULL,
  `id_org` int(11) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `id_tipe_kar` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kls_jabatan`
--

CREATE TABLE `tbl_kls_jabatan` (
  `ID` int(11) NOT NULL,
  `nama_kj` varchar(50) NOT NULL,
  `jml_butuh` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_os_doc`
--

CREATE TABLE `tbl_os_doc` (
  `ID` int(11) NOT NULL,
  `ID_kar` int(11) NOT NULL,
  `doc_bpsj` tinytext NOT NULL,
  `doc_bpjsk` tinytext NOT NULL,
  `doc_lisensi` tinytext NOT NULL,
  `doc_nomlisensi` tinytext NOT NULL,
  `jangkawaktu` tinytext NOT NULL,
  `kontrakkerja` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status_kar`
--

CREATE TABLE `tbl_status_kar` (
  `ID` int(11) NOT NULL,
  `nama_stat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tipe_kar`
--

CREATE TABLE `tbl_tipe_kar` (
  `ID` int(11) NOT NULL,
  `nama_tipekar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `ID` int(11) NOT NULL,
  `nama_unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit_kerja`
--

CREATE TABLE `tbl_unit_kerja` (
  `ID` int(11) NOT NULL,
  `nama_uk` varchar(50) NOT NULL,
  `jml_formasi` int(11) NOT NULL,
  `jml_existing` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_fungsi`
--
ALTER TABLE `tbl_fungsi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_kls_jabatan`
--
ALTER TABLE `tbl_kls_jabatan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_status_kar`
--
ALTER TABLE `tbl_status_kar`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_tipe_kar`
--
ALTER TABLE `tbl_tipe_kar`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_unit_kerja`
--
ALTER TABLE `tbl_unit_kerja`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_fungsi`
--
ALTER TABLE `tbl_fungsi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_kls_jabatan`
--
ALTER TABLE `tbl_kls_jabatan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_status_kar`
--
ALTER TABLE `tbl_status_kar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tipe_kar`
--
ALTER TABLE `tbl_tipe_kar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_unit_kerja`
--
ALTER TABLE `tbl_unit_kerja`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
