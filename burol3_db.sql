-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 03:16 PM
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `body`, `picture`, `created_at`) VALUES
(5, 'title23', 'body2', '2.jpg', '2024-10-20 03:42:08'),
(6, 'title23', 'body2', '3.jpg', '2024-10-20 03:43:08'),
(7, 'title', 'hello', '4.jpg', '2024-10-20 03:43:30'),
(8, 'title', 'body', '5.jpg', '2024-10-20 03:43:53'),
(9, 'title', 'body', '6.jpg', '2024-10-20 03:44:04'),
(10, 'red', 'green', '7.jpg', '2024-10-20 03:44:25'),
(11, 'green', 'green', '8.jpg', '2024-10-20 03:44:35'),
(12, 'Paalala', 'paalala', '9.jpg', '2024-10-20 03:44:50'),
(13, 'Paalala2', 'Paalala2', '10.jpg', '2024-10-20 03:45:08'),
(14, 'Katanugan', 'Katanugan', '11.jpg', '2024-10-20 03:45:26'),
(17, 'Tittle', 'Body', '11.jpg', '2024-10-25 04:05:43');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blotter`
--

INSERT INTO `blotter` (`id`, `date`, `time`, `incident_type`, `description`, `reporter_name`, `accused_name`, `status`, `created_at`) VALUES
(1, '2024-10-08', '16:03:00', 'Harrasment', 'The reporting individual was harassed by the accused at the front of reporter house.', 'Juan Dela Cruz', 'Pedro Matapang', 'Pending', '2024-10-20 08:03:31'),
(2, '2024-10-20', '22:13:00', 'Stafa', 'Trying to dodge the collector.', 'Abdul Jhabar', 'Linda Luzvi', 'Pending', '2024-10-20 14:14:35'),
(3, '2024-10-24', '23:13:00', 'Harrasment', 'Keep trying to call him Pogi.', 'Mherwen Wiel Romero', 'Jemie Mantillas', 'Pending', '2024-10-24 15:14:47'),
(4, '2024-10-24', '23:18:00', 'Stafa', 'Barrowed money worth 1000 pesos, and keep dodging to pay.', 'WENNYL CALUMBA ROMERO', 'Jennalyn Malvar', 'Dismissed', '2024-10-24 15:20:04'),
(5, '2024-10-24', '23:21:00', 'Harrasment', 'Posting defamation on social media.', 'WENNYL CALUMBA ROMERO', 'Jennalyn Malvar', 'Resolved', '2024-10-24 15:22:03'),
(6, '2024-10-25', '11:30:00', 'Harrasment', 'Harassment Description.', 'WENNYL CALUMBA ROMERO', 'Linda Luzvi', 'Pending', '2024-10-25 03:32:09');

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
  `amount_to_prepare` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `tracking_number`, `full_name`, `address`, `age`, `pickup_date`, `pickup_time`, `year_residency`, `purpose`, `category`, `note`, `type`, `status`, `control_number`, `date_added`, `delivery_mode`, `amount_to_prepare`) VALUES
(20, 'BRGYB3-8WL-9OT-TEA-M57K', 'Mherwen Wiel Romero', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '24', '', '', '2024', 'Job seeking', 'for delivery', 'Sample Request', 'Barangay Clearance', 'Approved', '479867', '2024-10-23 05:09:26', 'delivery', NULL),
(21, 'BRGYB3-U1W-CDM-XZ9-N5X8', 'Mherwen Wiel Romero', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '24', '', '', '2024', 'Job seeking', 'brgy clearance', 'Sample Request', 'Barangay Clearance', 'Approved', '820391', '2024-10-23 05:14:51', 'delivery', NULL),
(22, 'BRGYB3-MYW-11M-1DD-6YQP', 'Mherwen Wiel Romero', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '24', '', '', '2024', 'Job seeking', 'brgy clearance', 'Sample Request', 'Barangay Clearance', 'Approved', '997499', '2024-10-23 05:20:23', 'delivery', NULL),
(24, 'BRGYB3-0AX-VKR-PC4-71NZ', 'Mherwen Wiel Romero', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '24', '', '', '2024', 'Job seeking', 'brgy clearance', 'Sample Request', 'Barangay Clearance', 'Approved', '588579', '2024-10-23 07:02:23', 'delivery', NULL),
(25, 'BRGYB3-OGI-H4G-J2S-QDY9', 'Mherwen Wiel Romero', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '25', '', '', '2024', 'Job seeking', 'brgy clearance', '', 'Barangay Clearance', 'Approved', '118559', '2024-10-24 08:00:14', 'delivery', NULL),
(26, 'BRGYB3-ZRT-D8D-XRZ-X0OH', 'WENNYL CALUMBA ROMERO', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '0', '', '', '2024', 'Job seeking', 'on request', 'Sample Request', 'Barangay Clearance', 'Approved', '379402', '2024-10-24 09:23:21', 'delivery', NULL),
(27, 'BRGYB3-E6M-MF2-45H-464R', 'WENNYL CALUMBA ROMERO', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '0', '2024-10-24', '18:40', '2024', 'Job seeking', 'on request', 'Sample Request', 'Barangay Clearance', 'Disapproved', '453950', '2024-10-24 09:40:16', 'pick-up', 25.00),
(28, 'BRGYB3-AFC-91R-KB8-G292', 'WENNYL CALUMBA ROMERO', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '43', '2024-10-24', '20:19', '2024', 'Meds', 'on request', 'Sample Request', 'Barangay Clearance', 'Approved', '743824', '2024-10-24 12:19:15', 'pick-up', NULL),
(29, 'BRGYB3-TIQ-FFV-WRS-67DG', 'WENNYL CALUMBA ROMERO', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '43', '2024-10-24', '20:21', '2024', 'Meds', 'on request', '', 'Barangay Clearance', 'Disapproved', '266076', '2024-10-24 12:21:48', 'pick-up', 25.00),
(30, 'BRGYB3-1U6-RO7-QIG-CVC0', 'WENNYL CALUMBA ROMERO', 'JP RIZAL', '43', '2024-10-24', '20:23', '2024', 'meds', 'on request', '', 'Barangay Clearance', 'Pending', '120661', '2024-10-24 12:24:09', 'pick-up', 25.00),
(31, 'BRGYB3-ZI8-HGG-0RV-VGUZ', 'WENNYL CALUMBA ROMERO', 'Blk D8 lot 20', '43', '2024-10-24', '20:38', '2024', 'Meds', 'for pick-up', 'Sample Request', 'Certificate of Indigency', 'Approved', '729905', '2024-10-24 12:38:33', 'pick-up', 100.00),
(32, 'BRGYB3-O2Z-PRS-0F8-K7J8', 'WENNYL CALUMBA ROMERO', 'BLK D 8 LOT 16 SAN LUIS 1 DASMARIÑAS CAV', '43', '', '', '2024', 'Loan', 'for delivery', '', 'Certificate of Residency', 'Approved', '276874', '2024-10-24 13:46:19', 'delivery', NULL);

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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `date_log` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `details` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user`, `date_log`, `action`, `details`) VALUES
(27, 'administrator', '2024-05-26 18:29:01', 'Update 8 to Approved', ''),
(28, 'administrator', '2024-05-26 18:29:08', 'Update 8 to Declined', ''),
(29, 'administrator', '2024-05-26 18:31:08', 'Update 8 to Pending', ''),
(30, 'administrator', '2024-05-26 18:31:12', 'Update 8 to Approved', ''),
(31, 'administrator', '2024-05-28 07:52:40', 'Update 9 to Approved', ''),
(32, 'administrator', '2024-10-19 18:50:40', 'Update 10 to Approved', ''),
(33, 'administrator', '2024-10-19 18:59:59', 'Update 11 to Approved', ''),
(34, 'administrator', '2024-10-20 22:04:27', 'Update Official named Alma M. Lapnos', ''),
(35, 'administrator', '2024-10-20 22:04:33', 'Update Official named Alma M. Lapno', ''),
(36, 'administrator', '2024-10-20 22:14:35', 'Added a new blotter entry by Abdul Jhabar', ''),
(37, 'administrator', '2024-10-20 22:15:55', 'Edited blotter entry ID: 2', ''),
(38, 'administrator', '2024-10-20 23:54:51', 'Added indigent: WENNYL CALUMBA ROMERO', ''),
(39, 'administrator', '2024-10-20 23:55:57', 'Edited indigent ID: 1', ''),
(40, 'administrator', '2024-10-20 23:57:30', 'Edited indigent ID: ', ''),
(41, 'administrator', '2024-10-20 23:58:07', 'Edited indigent ID: 1', ''),
(42, 'administrator', '2024-10-20 23:58:13', 'Deleted indigent ID: 1', ''),
(43, 'administrator', '2024-10-23 09:45:36', 'Edited blotter entry ID: 1', ''),
(44, 'administrator', '2024-10-23 09:45:48', 'Edited blotter entry ID: 2', ''),
(45, 'administrator', '2024-10-23 09:46:03', 'Edited blotter entry ID: 1', ''),
(46, 'administrator', '2024-10-23 09:46:07', 'Edited blotter entry ID: 2', ''),
(47, 'administrator', '2024-10-24 23:14:47', 'Added a new blotter entry by Mherwen Wiel Romero', ''),
(48, 'administrator', '2024-10-24 23:20:04', 'Added a new blotter entry by WENNYL CALUMBA ROMERO', ''),
(49, 'administrator', '2024-10-24 23:22:03', 'Added a new blotter entry by WENNYL CALUMBA ROMERO', ''),
(50, 'administrator', '2024-10-25 00:02:40', 'Edited blotter entry ID: 4', ''),
(51, 'administrator', '2024-10-25 00:02:46', 'Edited blotter entry ID: 3', ''),
(52, 'administrator', '2024-10-25 00:02:50', 'Edited blotter entry ID: 2', ''),
(53, 'administrator', '2024-10-25 00:02:54', 'Edited blotter entry ID: 1', ''),
(54, 'administrator', '2024-10-25 00:08:16', 'Edited Blotter Entry', 'Edited Blotter Entry ID: 5. Date from \"2024-10-24\" to \"2024-10-24\", Time from \"23:21:00\" to \"23:21:00\", Incident Type from \"Harrasment\" to \"Harrasment\", Description from \"Posting defamation on social media.\" to \"Posting defamation on social media.\", Repor'),
(55, 'administrator', '2024-10-25 00:08:35', 'Edited Blotter Entry', 'Edited Blotter Entry ID: 5. Date from \"2024-10-24\" to \"2024-10-24\", Time from \"23:21:00\" to \"23:21:00\", Incident Type from \"Harrasment\" to \"Harrasment\", Description from \"Posting defamation on social media.\" to \"Posting defamation on social media.\", Repor'),
(56, 'administrator', '2024-10-25 00:10:53', 'Edited Blotter Entry', 'Edited Blotter Entry ID: 5. Date from \"2024-10-24\" to \"2024-10-24\", Time from \"23:21:00\" to \"23:21:00\", Incident Type from \"Harrasment\" to \"Harrasment\", Description from \"Posting defamation on social media.\" to \"Posting defamation on social media.\", Reporter from \"WENNYL CALUMBA ROMERO\" to \"WENNYL CALUMBA ROMERO\", Accused from \"Jennalyn Malvar\" to \"Jennalyn Malvar\", Status from \"Resolved\" to \"Resolved\"'),
(57, 'administrator', '2024-10-25 00:37:45', 'Edited Blotter Entry', 'Edited Blotter Entry ID: 4. Changes: Status: \"Pending\" to \"Dismissed\"'),
(58, 'administrator', '2024-10-25 11:14:06', 'Added Official named Councilor Name', ''),
(59, 'administrator', '2024-10-25 11:14:13', 'Updated Official named Councilor Name', ''),
(60, 'administrator', '2024-10-25 11:32:09', 'Added a new blotter entry by WENNYL CALUMBA ROMERO', ''),
(61, 'administrator', '2024-11-11 20:43:11', 'Added voter named WENNYL CALUMBA ROMERO', ''),
(62, 'administrator', '2024-11-11 21:12:27', 'Edited blotter entry ID: 6', ''),
(63, 'administrator', '2024-11-11 22:04:16', 'Edited voter ID: WENNYL CALUMBA ROMERO', ''),
(64, 'administrator', '2024-11-11 22:05:07', 'Edited voter ID: WENNYL CALUMBA ROMERO', ''),
(65, 'administrator', '2024-11-11 22:06:01', 'Edited voter ID: WENNYL CALUMBA ROMERO', ''),
(66, 'administrator', '2024-11-11 22:06:08', 'Edited voter ID: WENNYL CALUMBA ROMERO', '');

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
(7, 'Gina P. Camerino', 'konsi-2.png', '0954243234', 'Barangay Councilor', 'Barangay Burol III', '2024-05-08', '2024-05-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `method_name` varchar(50) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method_name`, `image_path`, `updated_at`) VALUES
(1, 'GCASH', 'path_to_gcash_image.png', '2024-10-23 02:07:05'),
(2, 'GCASH - MHERWEN WIEL ROMERO', 'Screenshot 2024-03-28 135809.png', '2024-10-23 03:18:29'),
(3, 'GCASH - MHERWEN WIEL ROMERO', '462544282_279161631958968_652607444519471471_n.jpg', '2024-10-23 03:30:58'),
(4, 'GCASH', 'gcash.jpg', '2024-10-23 04:03:48'),
(5, 'GCASH', 'Adobe_Photoshop_CC_icon.svg.png', '2024-10-25 03:28:02');

-- --------------------------------------------------------

--
-- Table structure for table `payment_receipts`
--

CREATE TABLE `payment_receipts` (
  `id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `payment_receipt_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_receipts`
--

INSERT INTO `payment_receipts` (`id`, `document_id`, `payment_receipt_path`) VALUES
(3, 24, 'uploaded_img/receipts/1729666943_gcash.jpg'),
(5, 25, 'uploaded_img/receipts/1729756814_gcash.jpg'),
(6, 26, 'uploaded_img/receipts/1729761801_gcash.jpg'),
(7, 32, 'uploaded_img/receipts/1729777579_gcash.jpg');

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
  `user_id` int(11) NOT NULL,
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
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `full_name`, `date_of_birth`, `age`, `email`, `password`, `mobile_number`, `gender`, `village`, `phase`, `blk`, `street`, `id_type`, `id_number`, `issued_authority`, `issued_state`, `issued_date`, `expiry_date`, `address_type`, `nationality`, `state`, `district`, `block_number`, `father_name`, `mother_name`, `grandfather`, `spouse_name`, `father_in_law`, `mother_in_law`, `status`, `profile_img`, `category`) VALUES
(13, 'WENNYL CALUMBA ROMERO', '2024-10-25', '0', 'newroskoto@gmail.com', '$2y$10$0IySnvw9l405JjPbB77Q5u2.OY1v4o0lSZnW5VZWL0rz347t4uCwO', '09553471926', 'Female', 'Accacia Homes', '1', 'Blk D 8 Lot 16', 'JP RIZAL', 'Philhealth', '533', 'None', 'CAVITE', '2024-10-25', '2024-10-25', 'Permanent', 'Filipino', 'CAVITE', 'District', 3216, 'Ariel Romero', 'Wennyl Romero', 'Patricio Romero', 'Nancy Momoland', 'Father of Nancy', 'Mother of Nancy', 'Approved', 'gcash.jpg', 'Adult');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `full_name`, `age`, `address`, `contact_number`, `status`, `created_at`) VALUES
(4, 'WENNYL CALUMBA ROMERO', 2, 'JP RIZAL1', '23', 'Active', '2024-11-11 12:43:11');

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
  ADD PRIMARY KEY (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `indigents`
--
ALTER TABLE `indigents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
