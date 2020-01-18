-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 18, 2020 at 05:33 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `iit_patna_hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(100) NOT NULL,
  `access_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `name`, `position`, `access_token`) VALUES
(1, 'me@atm1504.in', 'f181c50384d8adc56a0ff990d33568f686059c87', 'Amartya Mondal', 'Super Admin', '103c814ff5b1aeba2187cddf0cb52ed1a0c089e8');

-- --------------------------------------------------------

--
-- Table structure for table `complains`
--

CREATE TABLE `complains` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `complain` text NOT NULL,
  `is_resolved` tinyint(1) NOT NULL DEFAULT '0',
  `unique_id` varchar(255) DEFAULT NULL,
  `status` text,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rollno` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complains`
--

INSERT INTO `complains` (`id`, `name`, `email`, `phone`, `complain`, `is_resolved`, `unique_id`, `status`, `date_time`, `rollno`) VALUES
(13, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', 'sjre uier uiuertiuyy', 1, '5e0386b76bd5b', 'testing', '2019-12-25 16:03:01', '1801me07'),
(14, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', 'iurewu oiureuio eroiuiteur', 0, '5e0389db39399', 'ddcd', '2019-12-25 16:10:09', '1801me07'),
(15, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', 'iurewu oiureuio eroiuiteur', 0, '5e0389fa43539', 'Filed status. Testing it.', '2019-12-25 16:10:40', '1801me07'),
(16, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', '3564563 uydws', 1, '5e09a690e7569', 'Resolved', '2019-12-30 07:26:18', '1801me07');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `rollno` varchar(10) DEFAULT NULL,
  `stream` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `verified` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `name`, `email`, `rollno`, `stream`, `phone`, `bank_name`, `account_no`, `ifsc_code`, `amount`, `verified`) VALUES
(1, 'Amartya Mondal', 'atm1504.in@gmail.com', '1801me07', 'BTECH', '8967570983', 'SBi', '2367846433443', '3467344326SBI', 3000, 0),
(2, 'Annway', 'a1504.in@gmail.com', '1801me14', 'BTECH', '8967570983', 'SBi', '2367846433443', '3467344326SBI', 3000, 0),
(3, 'Testing', 'dsfdsf@tes.com', '1801me09', 'BTECH', '8967570983', 'SBi', '2367846433443', '3467344326SBI', 3000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `rollno` varchar(8) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `stream` varchar(20) NOT NULL,
  `mess` varchar(100) NOT NULL DEFAULT 'Mess1',
  `access_token` varchar(255) DEFAULT NULL,
  `complain_ids` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `rollno`, `password`, `email`, `name`, `stream`, `mess`, `access_token`, `complain_ids`) VALUES
(1, '1801me07', 'a03a4a1ebcd9d95c4a049c45fbf0145adc5329b9', 'atm1504.in@gmail.com', 'Amartya Mondal', 'BTech', 'Mess1', '3820a4d0aef9e863fe8f34ec9d7a222d07d93163', '[\"5e0389db39399\", \"5e0389fa43539\", \"5e09a690e7569\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complains`
--
ALTER TABLE `complains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rollno` (`rollno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rollno` (`rollno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
