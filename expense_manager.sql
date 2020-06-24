-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2020 at 01:32 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_data`
--

CREATE TABLE `form_data` (
  `data_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `field_data` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_on` int(11) DEFAULT NULL,
  `is_deleted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `form_fields`
--

CREATE TABLE `form_fields` (
  `field_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `field_name` varchar(50) NOT NULL,
  `field_type` enum('Text','Number','Date','Select') NOT NULL,
  `min_length` int(11) NOT NULL,
  `max_length` int(11) NOT NULL,
  `is_required` tinytext NOT NULL DEFAULT '1',
  `is_active` datetime DEFAULT current_timestamp(),
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `form_master`
--

CREATE TABLE `form_master` (
  `form_id` int(11) NOT NULL,
  `form_name` varchar(255) NOT NULL,
  `form_description` text DEFAULT NULL,
  `form_instructions` text DEFAULT NULL,
  `form_logo` varchar(255) DEFAULT NULL,
  `grid_size` int(11) NOT NULL DEFAULT 3,
  `is_edit` tinyint(4) NOT NULL DEFAULT 1,
  `is_delete` tinyint(4) NOT NULL DEFAULT 1,
  `is_active` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `form_values`
--

CREATE TABLE `form_values` (
  `value_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `is_active` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_data`
--
ALTER TABLE `form_data`
  ADD KEY `form_id` (`form_id`),
  ADD KEY `field_id` (`field_id`);

--
-- Indexes for table `form_fields`
--
ALTER TABLE `form_fields`
  ADD KEY `field_id` (`field_id`);

--
-- Indexes for table `form_master`
--
ALTER TABLE `form_master`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `form_values`
--
ALTER TABLE `form_values`
  ADD KEY `field_id` (`field_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_master`
--
ALTER TABLE `form_master`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `form_data`
--
ALTER TABLE `form_data`
  ADD CONSTRAINT `form_data_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `form_master` (`form_id`),
  ADD CONSTRAINT `form_data_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `form_fields` (`field_id`);

--
-- Constraints for table `form_fields`
--
ALTER TABLE `form_fields`
  ADD CONSTRAINT `form_fields_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `form_master` (`form_id`);

--
-- Constraints for table `form_values`
--
ALTER TABLE `form_values`
  ADD CONSTRAINT `form_values_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `form_fields` (`field_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
