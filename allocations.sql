-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 09:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_sibisma`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocations`
--

CREATE TABLE `allocations` (
  `id` bigint(20) NOT NULL,
  `dealer_code` varchar(255) DEFAULT NULL,
  `allocation_date` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `model_name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `frame_no` varchar(255) DEFAULT NULL,
  `engine_no` varchar(255) DEFAULT NULL,
  `faktur_no` varchar(255) DEFAULT NULL,
  `nik_no` varchar(255) DEFAULT NULL,
  `yimm_revise_type` varchar(255) DEFAULT NULL,
  `received` varchar(255) DEFAULT NULL,
  `out_status` enum('no','yes') NOT NULL,
  `allocation_out_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allocations`
--

INSERT INTO `allocations` (`id`, `dealer_code`, `allocation_date`, `model`, `model_name`, `color`, `frame_no`, `engine_no`, `faktur_no`, `nik_no`, `yimm_revise_type`, `received`, `out_status`, `allocation_out_date`, `created_at`, `updated_at`) VALUES
(1, 'AA0107', '2024-11-18', 'BPA200010D', 'NMAX NEO', 'HITAM', 'MH3SG9320RJ072918', 'G3V5E-0111043', '00152/PA/AA0107-2104', 'MH3SG9320RJ072918', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(2, 'AA0107', '2024-11-18', 'BPA200010D', 'NMAX NEO', 'HITAM', 'MH3SG9320RJ072911', 'G3V5E-0111036', '00151/PA/AA0107-2104', 'MH3SG9320RJ072911', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(3, 'AA0107', '2024-11-18', 'BPA200010D', 'NMAX NEO', 'HITAM', 'MH3SG9320RJ072847', 'G3V5E-0110973', '00150/PA/AA0107-2104', 'MH3SG9320RJ072847', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(4, 'AA0107', '2024-11-18', 'BPA200010D', 'NMAX NEO', 'HITAM', 'MH3SG9320RJ072839', 'G3V5E-0110964', '00149/PA/AA0107-2104', 'MH3SG9320RJ072839', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(5, 'AA0107', '2024-11-18', 'BTD100010A', 'NMAX -TURBO-', 'HITAM', 'MH3SG9220RK025860', 'G3V4E-0040084', '00006/BT/AA0107-2104', 'MH3SG9220RK025860', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(6, 'AA0107', '2024-11-18', 'BLS100010A', 'NMAX -TURBO- TECH MAX', 'HITAM', 'MH3SG9210RK015352', 'G3V4E-0040485', '00006/BL/AA0107-2104', 'MH3SG9210RK015352', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(7, 'AA0107', '2024-11-18', 'BPV600010D', 'XMAX C', 'MERAH', 'MH3SG8410RK028518', 'G3H4E-0084101', '00086/BV/AA0107-2104', 'MH3SG8410RK028518', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(8, 'AA0107', '2024-11-18', 'BPV600010D', 'XMAX C', 'MERAH', 'MH3SG8410RK028508', 'G3H4E-0084082', '00085/BV/AA0107-2104', 'MH3SG8410RK028508', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(9, 'AA0107', '2024-11-18', 'BPV600010D', 'XMAX C', 'MERAH', 'MH3SG8410RK028507', 'G3H4E-0084083', '00084/BV/AA0107-2104', 'MH3SG8410RK028507', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(10, 'AA0107', '2024-11-18', 'BPV600010D', 'XMAX C', 'MERAH', 'MH3SG8410RK028503', 'G3H4E-0084074', '00083/BV/AA0107-2104', 'MH3SG8410RK028503', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(11, 'AA0107', '2024-11-18', 'BPV600010D', 'XMAX C', 'MERAH', 'MH3SG8410RK028494', 'G3H4E-0084093', '00082/BV/AA0107-2104', 'MH3SG8410RK028494', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(12, 'AA0107', '2024-11-18', 'BPV600010D', 'XMAX C', 'MERAH', 'MH3SG8410RK028436', 'G3H4E-0084031', '00081/BV/AA0107-2104', 'MH3SG8410RK028436', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(13, 'AA0107', '2024-11-18', 'BJM700010A', 'GRAND FILANO LUX', 'PUTIH', 'MH3SEK610RJ235844', 'E34KE-0235849', '00135/JM/AA0107-2104', 'MH3SEK610RJ235844', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(14, 'AA0107', '2024-11-18', 'BJMC00010A', 'GRAND FILANO NEO HYBRID', 'BIRU', 'MH3SEK610RJ235763', 'E34KE-0235767', '00134/JM/AA0107-2104', 'MH3SEK610RJ235763', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(15, 'AA0107', '2024-11-18', 'BJMC00010A', 'GRAND FILANO NEO HYBRID', 'BIRU', 'MH3SEK610RJ235752', 'E34KE-0235755', '00133/JM/AA0107-2104', 'MH3SEK610RJ235752', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(16, 'AA0107', '2024-11-18', 'BJMC00010A', 'GRAND FILANO NEO HYBRID', 'BIRU', 'MH3SEK610RJ235743', 'E34KE-0235746', '00132/JM/AA0107-2104', 'MH3SEK610RJ235743', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(17, 'AA0107', '2024-11-18', 'BJMC00010A', 'GRAND FILANO NEO HYBRID', 'BIRU', 'MH3SEK610RJ235740', 'E34KE-0235743', '00131/JM/AA0107-2104', 'MH3SEK610RJ235740', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(18, 'AA0107', '2024-11-18', 'BJM700010A', 'GRAND FILANO LUX', 'PUTIH', 'MH3SEK610RJ235365', 'E34KE-0235368', '00130/JM/AA0107-2104', 'MH3SEK610RJ235365', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(19, 'AA0107', '2024-11-18', 'BJM700010A', 'GRAND FILANO LUX', 'PUTIH', 'MH3SEK610RJ235253', 'E34KE-0235257', '00129/JM/AA0107-2104', 'MH3SEK610RJ235253', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(20, 'AA0107', '2024-11-18', 'BJM700010A', 'GRAND FILANO LUX', 'PUTIH', 'MH3SEK610RJ235245', 'E34KE-0235249', '00128/JM/AA0107-2104', 'MH3SEK610RJ235245', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(21, 'AA0107', '2024-11-18', 'BJMC00010E', 'GRAND FILANO NEO HYBRID', 'UNGU MUDA', 'MH3SEK610RJ235015', 'E34KE-0235004', '00127/JM/AA0107-2104', 'MH3SEK610RJ235015', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(22, 'AA0107', '2024-11-18', 'BJMC00010E', 'GRAND FILANO NEO HYBRID', 'UNGU MUDA', 'MH3SEK610RJ235014', 'E34KE-0235018', '00126/JM/AA0107-2104', 'MH3SEK610RJ235014', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(23, 'AA0107', '2024-11-18', 'BEJB00010B', 'FAZZIO HYBRID', 'HITAM', 'MH3SEJ740RJ007094', 'E33WE-0408315', '00030/BE/AA0107-2104', 'MH3SEJ740RJ007094', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40'),
(24, 'AA0107', '2024-11-18', 'BEJB00010B', 'FAZZIO HYBRID', 'HITAM', 'MH3SEJ740RJ007093', 'E33WE-0408314', '00029/BE/AA0107-2104', 'MH3SEJ740RJ007093', '', 'Received', 'no', NULL, '2024-11-18 03:55:40', '2024-11-18 03:55:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocations`
--
ALTER TABLE `allocations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocations`
--
ALTER TABLE `allocations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
