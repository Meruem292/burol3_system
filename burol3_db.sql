-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 05:17 PM
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
-- Database: `burol3_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`) VALUES
(1, 'admin', '1234', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_archive` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `body`, `picture`, `created_at`, `is_archive`) VALUES
(5, 'title23', 'body2', '2.jpg', '2024-10-20 03:42:08', 0),
(6, 'title23', 'body2', '3.jpg', '2024-10-20 03:43:08', 0),
(7, 'title', 'hello', '4.jpg', '2024-10-20 03:43:30', 0),
(8, 'title', 'body', '5.jpg', '2024-10-20 03:43:53', 0),
(9, 'title', 'body', '6.jpg', '2024-10-20 03:44:04', 0),
(10, 'red', 'green', '7.jpg', '2024-10-20 03:44:25', 0),
(11, 'green', 'green', '8.jpg', '2024-10-20 03:44:35', 0),
(12, 'Paalala', 'paalala', '9.jpg', '2024-10-20 03:44:50', 0),
(13, 'Paalala2', 'Paalala2', '10.jpg', '2024-10-20 03:45:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `blotter`
--

CREATE TABLE `blotter` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `incident_type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `reporter_name` varchar(255) NOT NULL,
  `accused_name` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_archive` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blotter`
--

INSERT INTO `blotter` (`id`, `date`, `time`, `incident_type`, `description`, `reporter_name`, `accused_name`, `status`, `created_at`, `is_archive`) VALUES
(1, '2024-10-08', '16:03:00', 'Harrasment', 'The reporting individual was harassed by the accused at the front of reporter house.', 'Juan Dela Cruz', 'Pedro Matapang', 'Pending', '2024-10-20 08:03:31', 0),
(2, '2024-10-20', '22:13:00', 'Stafa', 'Trying to dodge the collector.', 'Abdul Jhabar', 'Linda Luzvi', 'Pending', '2024-10-20 14:14:35', 0),
(3, '2024-10-24', '23:13:00', 'Harrasment', 'Keep trying to call him Pogi.', 'Mherwen Wiel Romero', 'Jemie Mantillas', 'Pending', '2024-10-24 15:14:47', 0),
(4, '2024-10-24', '23:18:00', 'Stafa', 'Barrowed money worth 1000 pesos, and keep dodging to pay.', 'WENNYL CALUMBA ROMERO', 'Jennalyn Malvar', 'Dismissed', '2024-10-24 15:20:04', 1),
(5, '2024-10-24', '23:21:00', 'Harrasment', 'Posting defamation on social media.', 'WENNYL CALUMBA ROMERO', 'Jennalyn Malvar', 'Resolved', '2024-10-24 15:22:03', 0),
(6, '2024-10-25', '11:30:00', 'Harrasment', 'Harassment Description...', 'WENNYL CALUMBA ROMERO', 'Linda Luzvi', 'Pending', '2024-10-25 03:32:09', 0),
(7, '2024-11-14', '11:11:00', 'Harrasmentt', 'qweqwe', 'WENNYL CALUMBA ROMERO', 'Jennalyn Malvar', 'Dismissed', '2024-11-14 03:11:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `pickup_date` varchar(255) NOT NULL,
  `pickup_time` varchar(255) NOT NULL,
  `year_residency` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `control_number` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery_mode` enum('pick-up','delivery') NOT NULL,
  `amount_to_prepare` decimal(10,2) DEFAULT NULL,
  `is_archive` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `tracking_number`, `full_name`, `address`, `age`, `pickup_date`, `pickup_time`, `year_residency`, `purpose`, `category`, `note`, `type`, `status`, `control_number`, `date_added`, `delivery_mode`, `amount_to_prepare`, `is_archive`) VALUES
(20, 'BRGYB3-8WL-9OT-TEA-M57K', 'Mherwen Wiel Romero', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '24', '', '', '2024', 'Job seeking', 'for delivery', 'Sample Request', 'Barangay Clearance', 'Pending', '479867', '2024-10-23 05:09:26', 'delivery', NULL, 0),
(21, 'BRGYB3-U1W-CDM-XZ9-N5X8', 'Mherwen Wiel Romero', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '24', '', '', '2024', 'Job seeking', 'brgy clearance', 'Sample Request', 'Barangay Clearance', 'Approved', '820391', '2024-10-23 05:14:51', 'delivery', NULL, 0),
(22, 'BRGYB3-MYW-11M-1DD-6YQP', 'Mherwen Wiel Romero', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '24', '', '', '2024', 'Job seeking', 'brgy clearance', 'Sample Request', 'Barangay Clearance', 'Approved', '997499', '2024-10-23 05:20:23', 'delivery', NULL, 0),
(24, 'BRGYB3-0AX-VKR-PC4-71NZ', 'Mherwen Wiel Romero', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '24', '', '', '2024', 'Job seeking', 'brgy clearance', 'Sample Request', 'Barangay Clearance', 'Approved', '588579', '2024-10-23 07:02:23', 'delivery', NULL, 0),
(25, 'BRGYB3-OGI-H4G-J2S-QDY9', 'Mherwen Wiel Romero', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '25', '', '', '2024', 'Job seeking', 'brgy clearance', '', 'Barangay Clearance', 'Approved', '118559', '2024-10-24 08:00:14', 'delivery', NULL, 0),
(26, 'BRGYB3-ZRT-D8D-XRZ-X0OH', 'WENNYL CALUMBA ROMERO', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '45', '', '', '2024', 'Job seeking', 'for delivery', 'Sample Request', 'Barangay Clearance', 'Pending', '379402', '2024-10-24 09:23:21', 'delivery', NULL, 0),
(27, 'BRGYB3-E6M-MF2-45H-464R', 'WENNYL CALUMBA ROMERO', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '0', '2024-10-24', '18:40', '2024', 'Job seeking', 'on request', 'Sample Request', 'Barangay Clearance', 'Disapproved', '453950', '2024-10-24 09:40:16', 'pick-up', 25.00, 0),
(28, 'BRGYB3-AFC-91R-KB8-G292', 'WENNYL CALUMBA ROMERO', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '42', '2024-10-24', '20:19', '2024', 'Meds', 'for pick-up', 'Sample Request', 'Barangay Clearance', 'Approved', '743824', '2024-10-24 12:19:15', 'pick-up', NULL, 0),
(29, 'BRGYB3-TIQ-FFV-WRS-67DG', 'WENNYL CALUMBA ROMERO', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '43', '2024-10-24', '20:21', '2024', 'Meds', 'on request', '', 'Barangay Clearance', 'Disapproved', '266076', '2024-10-24 12:21:48', 'pick-up', 25.00, 0),
(30, 'BRGYB3-1U6-RO7-QIG-CVC0', 'WENNYL CALUMBA ROMERO', 'JP RIZAL', '43', '2024-10-24', '20:23', '2024', 'meds', 'for pick-up', '', 'Barangay Clearance', 'Pending', '120661', '2024-10-24 12:24:09', 'pick-up', 25.00, 0),
(31, 'BRGYB3-ZI8-HGG-0RV-VGUZ', 'WENNYL CALUMBA ROMERO', 'Blk D8 lot 20', '43', '2024-10-24', '20:38', '2024', 'Meds', 'for pick-up', 'Sample Request', 'Certificate of Indigency', 'Approved', '729905', '2024-10-24 12:38:33', 'pick-up', 100.00, 0),
(32, 'BRGYB3-O2Z-PRS-0F8-K7J8', 'WENNYL CALUMBA ROMERO', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '43', '', '', '2024', 'Loan', 'for delivery', '', 'Certificate of Residency', 'Approved', '276874', '2024-10-24 13:46:19', 'delivery', NULL, 0),
(33, 'BRGYB3-8LP-RKI-B0W-ACRE', 'WENNYL CALUMBA ROMERO', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '45', '2024-11-14', '11:59', '2024', 'job seeking', 'on request', 'Sample Request', 'Barangay Clearance', 'Pending', '782526', '2024-11-14 03:58:11', 'pick-up', 25.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `indigents`
--

CREATE TABLE `indigents` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL CHECK (`age` >= 0),
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_archive` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indigents`
--

INSERT INTO `indigents` (`id`, `full_name`, `age`, `address`, `contact_number`, `created_at`, `updated_at`, `is_archive`) VALUES
(5, 'Mherwen Wiel Calumba Romero', 24, 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '09553471926', '2024-11-14 07:29:20', '2024-11-19 14:31:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `date_log` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `details` mediumtext NOT NULL,
  `is_archive` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user`, `date_log`, `action`, `details`, `is_archive`) VALUES
(27, 'administrator', '2024-05-26 18:29:01', 'Update 8 to Approved', '', 0),
(28, 'administrator', '2024-05-26 18:29:08', 'Update 8 to Declined', '', 0),
(29, 'administrator', '2024-05-26 18:31:08', 'Update 8 to Pending', '', 0),
(30, 'administrator', '2024-05-26 18:31:12', 'Update 8 to Approved', '', 0),
(31, 'administrator', '2024-05-28 07:52:40', 'Update 9 to Approved', '', 0),
(32, 'administrator', '2024-10-19 18:50:40', 'Update 10 to Approved', '', 0),
(33, 'administrator', '2024-10-19 18:59:59', 'Update 11 to Approved', '', 0),
(34, 'administrator', '2024-10-20 22:04:27', 'Update Official named Alma M. Lapnos', '', 0),
(35, 'administrator', '2024-10-20 22:04:33', 'Update Official named Alma M. Lapno', '', 0),
(36, 'administrator', '2024-10-20 22:14:35', 'Added a new blotter entry by Abdul Jhabar', '', 0),
(37, 'administrator', '2024-10-20 22:15:55', 'Edited blotter entry ID: 2', '', 0),
(38, 'administrator', '2024-10-20 23:54:51', 'Added indigent: WENNYL CALUMBA ROMERO', '', 0),
(39, 'administrator', '2024-10-20 23:55:57', 'Edited indigent ID: 1', '', 0),
(40, 'administrator', '2024-10-20 23:57:30', 'Edited indigent ID: ', '', 0),
(41, 'administrator', '2024-10-20 23:58:07', 'Edited indigent ID: 1', '', 0),
(42, 'administrator', '2024-10-20 23:58:13', 'Deleted indigent ID: 1', '', 0),
(43, 'administrator', '2024-10-23 09:45:36', 'Edited blotter entry ID: 1', '', 0),
(44, 'administrator', '2024-10-23 09:45:48', 'Edited blotter entry ID: 2', '', 0),
(45, 'administrator', '2024-10-23 09:46:03', 'Edited blotter entry ID: 1', '', 0),
(46, 'administrator', '2024-10-23 09:46:07', 'Edited blotter entry ID: 2', '', 0),
(47, 'administrator', '2024-10-24 23:14:47', 'Added a new blotter entry by Mherwen Wiel Romero', '', 0),
(48, 'administrator', '2024-10-24 23:20:04', 'Added a new blotter entry by WENNYL CALUMBA ROMERO', '', 0),
(49, 'administrator', '2024-10-24 23:22:03', 'Added a new blotter entry by WENNYL CALUMBA ROMERO', '', 0),
(50, 'administrator', '2024-10-25 00:02:40', 'Edited blotter entry ID: 4', '', 0),
(51, 'administrator', '2024-10-25 00:02:46', 'Edited blotter entry ID: 3', '', 0),
(52, 'administrator', '2024-10-25 00:02:50', 'Edited blotter entry ID: 2', '', 0),
(53, 'administrator', '2024-10-25 00:02:54', 'Edited blotter entry ID: 1', '', 0),
(54, 'administrator', '2024-10-25 00:08:16', 'Edited Blotter Entry', 'Edited Blotter Entry ID: 5. Date from \"2024-10-24\" to \"2024-10-24\", Time from \"23:21:00\" to \"23:21:00\", Incident Type from \"Harrasment\" to \"Harrasment\", Description from \"Posting defamation on social media.\" to \"Posting defamation on social media.\", Repor', 0),
(55, 'administrator', '2024-10-25 00:08:35', 'Edited Blotter Entry', 'Edited Blotter Entry ID: 5. Date from \"2024-10-24\" to \"2024-10-24\", Time from \"23:21:00\" to \"23:21:00\", Incident Type from \"Harrasment\" to \"Harrasment\", Description from \"Posting defamation on social media.\" to \"Posting defamation on social media.\", Repor', 0),
(56, 'administrator', '2024-10-25 00:10:53', 'Edited Blotter Entry', 'Edited Blotter Entry ID: 5. Date from \"2024-10-24\" to \"2024-10-24\", Time from \"23:21:00\" to \"23:21:00\", Incident Type from \"Harrasment\" to \"Harrasment\", Description from \"Posting defamation on social media.\" to \"Posting defamation on social media.\", Reporter from \"WENNYL CALUMBA ROMERO\" to \"WENNYL CALUMBA ROMERO\", Accused from \"Jennalyn Malvar\" to \"Jennalyn Malvar\", Status from \"Resolved\" to \"Resolved\"', 0),
(57, 'administrator', '2024-10-25 00:37:45', 'Edited Blotter Entry', 'Edited Blotter Entry ID: 4. Changes: Status: \"Pending\" to \"Dismissed\"', 0),
(58, 'administrator', '2024-10-25 11:14:06', 'Added Official named Councilor Name', '', 0),
(59, 'administrator', '2024-10-25 11:14:13', 'Updated Official named Councilor Name', '', 0),
(60, 'administrator', '2024-10-25 11:32:09', 'Added a new blotter entry by WENNYL CALUMBA ROMERO', '', 0),
(61, 'administrator', '2024-11-11 20:43:11', 'Added voter named WENNYL CALUMBA ROMERO', '', 0),
(62, 'administrator', '2024-11-11 21:12:27', 'Edited blotter entry ID: 6', '', 0),
(63, 'administrator', '2024-11-11 22:04:16', 'Edited voter ID: WENNYL CALUMBA ROMERO', '', 0),
(64, 'administrator', '2024-11-11 22:05:07', 'Edited voter ID: WENNYL CALUMBA ROMERO', '', 0),
(65, 'administrator', '2024-11-11 22:06:01', 'Edited voter ID: WENNYL CALUMBA ROMERO', '', 0),
(66, 'administrator', '2024-11-11 22:06:08', 'Edited voter ID: WENNYL CALUMBA ROMERO', '', 0),
(67, 'administrator', '2024-11-11 22:30:07', 'Added Official named Gina P. Camerino', '', 0),
(68, 'administrator', '2024-11-11 22:30:20', 'Updated Official named Gina P. Camerino', '', 0),
(69, 'administrator', '2024-11-11 23:04:14', 'Edited announcement ID: Title', '', 0),
(70, 'administrator', '2024-11-11 23:04:21', 'Deleted announcement ID: 17', '', 0),
(71, 'administrator', '2024-11-11 23:04:29', 'Edited announcement ID: Katanugann', '', 0),
(72, 'administrator', '2024-11-12 16:20:28', 'Edited announcement ID: Katanugan', '', 1),
(73, 'administrator', '2024-11-12 16:20:31', 'Deleted announcement ID: 14', '', 1),
(74, 'administrator', '2024-11-12 22:25:36', 'Added voter named adds', '', 1),
(75, 'administrator', '2024-11-12 22:25:45', 'Edited voter ID: adds', '', 1),
(76, 'administrator', '2024-11-12 22:30:33', 'Deleted voter ID: ', '', 1),
(77, 'administrator', '2024-11-14 10:19:44', 'Edited blotter entry ID: 1', '', 1),
(78, 'administrator', '2024-11-14 10:19:49', 'Edited blotter entry ID: 1', '', 1),
(79, 'administrator', '2024-11-14 11:09:16', 'Archived a record from logs', '', 0),
(80, 'administrator', '2024-11-14 11:11:54', 'Added a new blotter entry by WENNYL CALUMBA ROMERO', '', 0),
(81, 'administrator', '2024-11-14 11:12:03', 'Edited blotter entry ID: 7', '', 0),
(82, 'administrator', '2024-11-14 11:12:14', 'Edited blotter entry ID: 7', '', 0),
(83, 'administrator', '2024-11-14 11:13:27', 'Archived a record from blotter', '', 0),
(84, 'administrator', '2024-11-14 11:13:35', 'Edited blotter entry ID: 6', '', 0),
(85, 'administrator', '2024-11-14 11:17:23', 'Archived a record from user', '', 0),
(86, 'administrator', '2024-11-14 11:17:49', 'Archived a record from user', '', 0),
(87, 'administrator', '2024-11-14 11:18:31', 'Archived a record from user', '', 0),
(88, 'administrator', '2024-11-14 11:20:18', 'Archived a record from user', '', 0),
(89, 'administrator', '2024-11-14 11:21:56', 'Archived a record from user', '', 0),
(90, 'administrator', '2024-11-14 11:22:24', 'Archived a record from user', '', 0),
(91, 'administrator', '2024-11-14 11:23:24', 'Archived a record from user', '', 0),
(92, 'administrator', '2024-11-14 11:23:41', 'Archived a record from user', '', 0),
(93, 'administrator', '2024-11-14 11:24:26', 'Archived a record from logs', '', 0),
(94, 'administrator', '2024-11-14 11:24:49', 'Archived a record from logs', '', 0),
(95, 'administrator', '2024-11-14 11:28:01', 'Archived a record from logs', '', 0),
(96, 'administrator', '2024-11-14 11:28:37', 'Archived a record from logs', '', 0),
(97, 'administrator', '2024-11-14 11:29:10', 'Archived a record from logs', '', 0),
(98, 'administrator', '2024-11-14 11:36:06', 'Archived a record from logs', '', 0),
(99, 'administrator', '2024-11-14 11:39:04', 'Archived a record from logs', '', 0),
(100, 'administrator', '2024-11-14 11:41:05', 'Archived a record from user', '', 0),
(101, 'administrator', '2024-11-14 11:47:32', 'Archived a record from payment_receipts', '', 0),
(102, 'administrator', '2024-11-14 12:08:35', 'Added indigent: WENNYL CALUMBA ROMERO', '', 0),
(103, 'administrator', '2024-11-14 12:14:52', 'Archived a record from blotter', '', 0),
(104, 'administrator', '2024-11-14 12:15:11', 'Archived a record from voters', '', 0),
(105, 'administrator', '2024-11-14 12:15:12', 'Archived a record from voters', '', 0),
(106, 'administrator', '2024-11-14 12:15:23', 'Archived a record from voters', '', 0),
(107, 'administrator', '2024-11-14 12:15:39', 'Archived a record from voters', '', 0),
(108, 'administrator', '2024-11-14 12:16:28', 'Archived a record from voters', '', 0),
(109, 'administrator', '2024-11-14 12:16:51', 'Archived a record from voters', '', 0),
(110, 'administrator', '2024-11-14 12:22:14', 'Deleted indigent ID: ', '', 0),
(111, 'administrator', '2024-11-14 12:23:00', 'Added voter named WENNYL CALUMBA ROMERO', '', 0),
(112, 'administrator', '2024-11-14 12:23:02', 'Archived a record from voters', '', 0),
(113, 'administrator', '2024-11-14 12:23:48', 'Archived a record from user', '', 0),
(114, 'administrator', '2024-11-14 12:59:26', 'Archived a record from documents', '', 0),
(115, 'administrator', '2024-11-14 12:59:54', 'Archived a record from documents', '', 0),
(116, 'administrator', '2024-11-14 13:48:10', 'Added voter named Mherwen Wiel Calumba Romero', '', 0),
(117, 'administrator', '2024-11-14 13:50:10', 'Added indigent: WENNYL CALUMBA ROMERO', '', 0),
(118, 'administrator', '2024-11-14 13:55:56', 'Archived a record from user', '', 0),
(119, 'administrator', '2024-11-14 14:10:24', 'Deleted indigent ID: ', '', 0),
(120, 'administrator', '2024-11-14 14:10:41', 'Added indigent: WENNYL CALUMBA ROMERO', '', 0),
(121, 'administrator', '2024-11-14 14:10:45', 'Edited indigent ID: WENNYL CALUMBA ROMERO', '', 0),
(122, 'administrator', '2024-11-14 14:16:01', 'Edited voter ID: Mherwen Wiel Calumba Romero', '', 0),
(123, 'administrator', '2024-11-14 15:00:08', 'Archived a record from user', '', 0),
(124, 'administrator', '2024-11-14 15:02:28', 'Archived a record from user', '', 0),
(125, 'administrator', '2024-11-14 15:02:29', 'Archived a record from user', '', 0),
(126, 'administrator', '2024-11-14 15:02:32', 'Archived a record from user', '', 0),
(127, 'administrator', '2024-11-14 15:03:32', 'Unarchived a record from user', '', 0),
(128, 'administrator', '2024-11-14 15:06:46', 'Archived a record from documents', '', 0),
(129, 'administrator', '2024-11-14 15:12:16', 'Archived a record from documents', '', 0),
(130, 'administrator', '2024-11-14 15:12:19', 'Archived a record from documents', '', 0),
(131, 'administrator', '2024-11-14 15:12:21', 'Archived a record from documents', '', 0),
(132, 'administrator', '2024-11-14 15:12:24', 'Archived a record from documents', '', 0),
(133, 'administrator', '2024-11-14 15:12:26', 'Archived a record from documents', '', 0),
(134, 'administrator', '2024-11-14 15:27:34', 'Archived a record from voters', '', 0),
(135, 'administrator', '2024-11-14 15:27:45', 'Delete a record from voters', '', 0),
(136, 'administrator', '2024-11-14 15:27:57', 'Archived a record from indigents', '', 0),
(137, 'administrator', '2024-11-14 15:28:00', 'Archived a record from indigents', '', 0),
(138, 'administrator', '2024-11-14 15:29:00', 'Archived a record from indigents', '', 0),
(139, 'administrator', '2024-11-14 15:29:15', 'Deleted indigent ID: ', '', 0),
(140, 'administrator', '2024-11-14 15:29:20', 'Added indigent: Mherwen Wiel Calumba Romero', '', 0),
(141, 'administrator', '2024-11-14 15:29:25', 'Edited indigent ID: Mherwen Wiel Calumba Romero', '', 0),
(142, 'administrator', '2024-11-14 15:29:28', 'Edited indigent ID: Mherwen Wiel Calumba Romero', '', 0),
(143, 'administrator', '2024-11-14 15:29:32', 'Archived a record from indigents', '', 0),
(144, 'administrator', '2024-11-14 15:31:00', 'Archived a record from voters', '', 0),
(145, 'administrator', '2024-11-14 15:31:09', 'Unarchived a record from documents', '', 0),
(146, 'administrator', '2024-11-14 15:31:15', 'Unarchived a record from documents', '', 0),
(147, 'administrator', '2024-11-14 15:31:18', 'Unarchived a record from documents', '', 0),
(148, 'administrator', '2024-11-14 15:31:21', 'Unarchived a record from documents', '', 0),
(149, 'administrator', '2024-11-14 15:31:23', 'Unarchived a record from documents', '', 0),
(150, 'administrator', '2024-11-14 15:31:25', 'Unarchived a record from documents', '', 0),
(151, 'administrator', '2024-11-14 15:31:26', 'Unarchived a record from documents', '', 0),
(152, 'administrator', '2024-11-19 22:27:40', 'Archived a record from payment_receipts', '', 0),
(153, 'administrator', '2024-11-19 22:27:41', 'Archived a record from payment_receipts', '', 0),
(154, 'administrator', '2024-11-19 22:27:43', 'Archived a record from payment_receipts', '', 0),
(155, 'administrator', '2024-11-19 22:28:54', 'Archived a record from payment_receipts', '', 0),
(156, 'administrator', '2024-11-19 22:30:32', 'Archived a record from payment_receipts', '', 0),
(157, 'administrator', '2024-11-19 22:31:11', 'Unarchived a record from payment_methods', '', 0),
(158, 'administrator', '2024-11-19 22:31:20', 'Unarchived a record from payment_methods', '', 0),
(159, 'administrator', '2024-11-19 22:31:23', 'Unarchived a record from payment_methods', '', 0),
(160, 'administrator', '2024-11-19 22:31:27', 'Unarchived a record from blotter', '', 0),
(161, 'administrator', '2024-11-19 22:31:33', 'Unarchived a record from indigents', '', 0),
(162, 'administrator', '2024-11-19 22:37:11', 'Unarchived a record from payment_receipts', '', 0),
(163, 'administrator', '2024-11-19 22:47:13', 'Archived a record from user', '', 0),
(164, 'administrator', '2024-11-19 22:50:55', 'Unarchived a record from user', '', 0),
(165, 'administrator', '2024-11-19 23:02:13', 'Added voter named firstname middlename lastname', '', 0),
(166, 'administrator', '2024-11-19 23:02:20', 'Edited voter ID: firstname middlename lastname', '', 0),
(167, 'administrator', '2024-11-19 23:03:34', 'Edited voter ID: firstname middlename lastname', '', 0),
(168, 'administrator', '2024-11-19 23:04:25', 'Archived a record from voters', '', 0),
(169, 'administrator', '2024-11-19 23:07:00', 'Edited voter ID: WENNYL CALUMBA ROMERO', '', 0),
(170, 'administrator', '2024-11-19 23:07:04', 'Edited voter ID: firstname middlename lastname', '', 0),
(171, 'administrator', '2024-11-19 23:07:11', 'Edited voter ID: WENNYL CALUMBA ROMERO', '', 0),
(172, 'administrator', '2024-11-19 23:08:31', 'Edited voter ID: WENNYL CALUMBA ROMERO', '', 0),
(173, 'administrator', '2024-11-19 23:09:52', 'Edited voter ID: firstname middlename lastname', '', 0),
(174, 'administrator', '2024-11-19 23:10:39', 'Edited voter ID: firstname middlename lastname', '', 0),
(175, 'administrator', '2024-11-19 23:10:43', 'Edited voter ID: firstname middlename lastname', '', 0),
(176, 'administrator', '2024-11-19 23:21:42', 'Archived a record from user', '', 0),
(177, 'administrator', '2024-11-19 23:49:57', 'Added voter named jessable', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `start_term` varchar(255) NOT NULL,
  `end_term` varchar(255) NOT NULL,
  `is_archive` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`id`, `full_name`, `image`, `contact_number`, `position`, `address`, `start_term`, `end_term`, `is_archive`) VALUES
(5, 'Alma M. Lapno', 'kapitan.png', '095342434', 'Barangay Captain', 'Barangay Burol III', '2024-05-08', '2026-10-08', 0),
(6, 'Helen S. Bacanto', 'konsi-3.png', '094235645', 'Barangay Councilor', 'Barangay Burol III', '2024-05-08', '2024-05-27', 0),
(14, 'Gina P. Camerino', '', '0954243234', 'Barangay Councilor', 'Barangay Burol III', '2024-11-11', '2024-11-11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `method_name` varchar(50) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_archive` tinyint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method_name`, `image_path`, `updated_at`, `is_archive`) VALUES
(1, 'GCASH', 'path_to_gcash_image.png', '2024-10-23 02:07:05', 0),
(2, 'GCASH - MHERWEN WIEL ROMERO', 'Screenshot 2024-03-28 135809.png', '2024-10-23 03:18:29', 0),
(3, 'GCASH - MHERWEN WIEL ROMERO', '462544282_279161631958968_652607444519471471_n.jpg', '2024-10-23 03:30:58', 0),
(4, 'GCASH', 'gcash.jpg', '2024-10-23 04:03:48', 0),
(5, 'GCASH', 'Adobe_Photoshop_CC_icon.svg.png', '2024-10-25 03:28:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_receipts`
--

CREATE TABLE `payment_receipts` (
  `id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `payment_receipt_path` varchar(255) NOT NULL,
  `is_archive` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_receipts`
--

INSERT INTO `payment_receipts` (`id`, `document_id`, `payment_receipt_path`, `is_archive`) VALUES
(3, 24, 'uploaded_img/receipts/1729666943_gcash.jpg', 0),
(5, 25, 'uploaded_img/receipts/1729756814_gcash.jpg', 1),
(6, 26, 'uploaded_img/receipts/1729761801_gcash.jpg', 1),
(7, 32, 'uploaded_img/receipts/1729777579_gcash.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(255) NOT NULL,
  `doc_type` varchar(255) NOT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `doc_type`, `price`) VALUES
(1, 'barangay clearance', 25),
(2, 'certificate of indigency', 100),
(3, 'certificate of residency', 100),
(4, 'delivery', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `age` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `phase` varchar(255) NOT NULL,
  `blk` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `id_type` varchar(255) NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `issued_authority` varchar(255) NOT NULL,
  `issued_state` varchar(255) NOT NULL,
  `issued_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `address_type` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `block_number` int(11) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `grandfather` varchar(255) NOT NULL,
  `spouse_name` varchar(255) NOT NULL,
  `father_in_law` varchar(255) NOT NULL,
  `mother_in_law` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `profile_img` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `is_archive` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `date_of_birth`, `age`, `email`, `password`, `mobile_number`, `gender`, `village`, `phase`, `blk`, `street`, `id_type`, `id_number`, `issued_authority`, `issued_state`, `issued_date`, `expiry_date`, `address_type`, `nationality`, `state`, `district`, `block_number`, `father_name`, `mother_name`, `grandfather`, `spouse_name`, `father_in_law`, `mother_in_law`, `status`, `profile_img`, `category`, `is_archive`) VALUES
(13, 'WENNYL CALUMBA ROMERO', '2023-02-25', '0', 'newroskoto@gmail.com', '$2y$10$0IySnvw9l405JjPbB77Q5u2.OY1v4o0lSZnW5VZWL0rz347t4uCwO', '09553471921', 'Female', 'Accacia Homes', '1', 'Blk D 8 Lot 16', 'JP RIZAL', 'Philhealth', '533', 'None', 'CAVITE', '2024-10-25', '2024-10-25', 'Permanent', 'Filipino', 'CAVITE', 'District', 3216, 'Ariel Romero', 'Wennyl Romero', 'Patricio Romero', 'Nancy Momoland', 'Father of Nancy', 'Mother of Nancy', 'Approved', 'gcash.jpg', 'Adult', 0),
(14, 'FIRSTNAME Romero', '2024-11-19', '0', 'romeroqmherwen@gmail.com', '$2y$10$F0Z8Mz2L5Tb4i3feF9/oveelZdQKD5ybl2zfL8dkNvKgQci1cLKem', '09553471926', 'Male', 'Accacia Homes', '1', 'Blk D 8 Lot 16', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', 'Philhealth', '123123', 'qweqwewqe', 'CAVITE', '2024-11-19', '2024-11-19', 'Permanent', 'Filipino', 'qweqweqeqe', 'qweqwe', -2, 'qweqeqweq', 'Wennyl Romero', 'Patricio Romero', 'Nancy Momoland', 'Father of Nancy', 'Mother of Nancy', 'Approved', 'Gaming_5000x3125.jpg', 'PWD', 0),
(15, 'jem', '2024-11-19', '0', 'jem@gmail.con', '$2y$10$9fSCjq7zjwlqYY2Vu6pmbOpmLMsuQICap4ELh6a1cc/7Hy8zLmdUG', '09181', 'Female', 'Sitio Parang', '1', 'blkd', 'JP RIZAL', 'Philhealth', '2', 'NONE', 'CAVITE', '2024-11-28', '2024-12-12', 'Permanent', 'Filipino', 'CAVITE', 'District', 1, 'Ariel Romero', 'Wennyl Romero', 'Patricio Romero', 'Nancy Momoland', 'Father of Nancy', 'Mother of Nancy', 'Pending', 'Gaming_5000x3125.jpg', 'Adult', 0),
(16, 'angelo romero', '2024-11-19', '0', 'angelo@gmail.com', '$2y$10$uerWFfC6FjHzxlkzKsHFLe/RWtMAFwMEeF0eQg2aZqMUOgpBPTNg6', '09553471921', 'Male', 'Accacia Homes', '1', 'Blk D 8 Lot 16', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', 'Philhealth', '-1', 'None', 'CAVITE', '2024-11-19', '2024-11-19', 'Permanent', 'Filipino', 'CAVITE', 'District', 1, 'Ariel Romero', 'Wennyl Romero', 'Patricio Romero', 'Nancy Momoland', 'Father of Nancy', 'Mother of Nancy', 'Pending', 'Gaming_5000x3125.jpg', 'PWD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `precint_no` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_archive` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `precint_no`, `full_name`, `age`, `address`, `contact_number`, `status`, `created_at`, `is_archive`) VALUES
(4, '', 'WENNYL CALUMBA ROMERO', 2, 'JP RIZAL1', '23', 'Active', '2024-11-11 12:43:11', 0),
(8, '', 'firstname middlename lastname', 2, 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '2', 'Inactive', '2024-11-19 15:02:13', 0),
(9, '24A-1', 'jessable', 2147483647, 'qwewqe', '25', 'Active', '2024-11-19 15:49:57', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blotter`
--
ALTER TABLE `blotter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indigents`
--
ALTER TABLE `indigents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_receipts`
--
ALTER TABLE `payment_receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_id` (`document_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
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
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `blotter`
--
ALTER TABLE `blotter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `indigents`
--
ALTER TABLE `indigents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_receipts`
--
ALTER TABLE `payment_receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_receipts`
--
ALTER TABLE `payment_receipts`
  ADD CONSTRAINT `payment_receipts_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
