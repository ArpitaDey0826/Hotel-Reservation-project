-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2025 at 01:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `billingsummery`
--

CREATE TABLE `billingsummery` (
  `bill_id` int(20) NOT NULL,
  `booking_id` int(20) NOT NULL,
  `email_receipt` varchar(20) NOT NULL,
  `split_number` int(20) NOT NULL,
  `split_amount` int(20) NOT NULL,
  `split_method` int(20) NOT NULL,
  `payer_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookroom`
--

CREATE TABLE `bookroom` (
  `booking_id` int(20) NOT NULL,
  `guest_name` varchar(20) NOT NULL,
  `room_type` varchar(20) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `rate_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conciergerequest`
--

CREATE TABLE `conciergerequest` (
  `c_request_id` int(20) NOT NULL,
  `service_experience` varchar(20) NOT NULL,
  `additional_details` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groupbookroom`
--

CREATE TABLE `groupbookroom` (
  `group_booking_id` int(20) NOT NULL,
  `group_name` varchar(20) NOT NULL,
  `group_booking_email` varchar(20) NOT NULL,
  `group_room_type` varchar(20) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `payment_term` varchar(20) NOT NULL,
  `event_space` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `u_id` int(11) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviewsystem`
--

CREATE TABLE `reviewsystem` (
  `r_system_id` int(20) NOT NULL,
  `star_rating` int(20) NOT NULL,
  `r_comment` varchar(100) NOT NULL,
  `traveler_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `s_id` int(11) NOT NULL,
  `s_email` varchar(100) NOT NULL,
  `s_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`s_id`, `s_email`, `s_password`) VALUES
(0, 'moinulacps@gmail.com', '123456'),
(0, 'moinulacps15697@gmail.com', '147852');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billingsummery`
--
ALTER TABLE `billingsummery`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `bookroom`
--
ALTER TABLE `bookroom`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `conciergerequest`
--
ALTER TABLE `conciergerequest`
  ADD PRIMARY KEY (`c_request_id`);

--
-- Indexes for table `groupbookroom`
--
ALTER TABLE `groupbookroom`
  ADD PRIMARY KEY (`group_booking_id`);

--
-- Indexes for table `reviewsystem`
--
ALTER TABLE `reviewsystem`
  ADD PRIMARY KEY (`r_system_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billingsummery`
--
ALTER TABLE `billingsummery`
  MODIFY `bill_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookroom`
--
ALTER TABLE `bookroom`
  MODIFY `booking_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conciergerequest`
--
ALTER TABLE `conciergerequest`
  MODIFY `c_request_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupbookroom`
--
ALTER TABLE `groupbookroom`
  MODIFY `group_booking_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviewsystem`
--
ALTER TABLE `reviewsystem`
  MODIFY `r_system_id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
