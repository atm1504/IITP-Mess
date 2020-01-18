-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 30, 2019 at 05:16 PM
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
(1, 'me@atm1504.in', 'f181c50384d8adc56a0ff990d33568f686059c87', 'Amartya Mondal', 'Super Admin', 'e56b60fe7590a82d00efcdce91d31ae41216ae27');

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
(1, '1801me07', 'a03a4a1ebcd9d95c4a049c45fbf0145adc5329b9', 'atm1504.in@gmail.com', 'Amartya Mondal', 'BTech', 'Mess1', '77170a0a52df40ddfe26366acdf33fe0f22fe2a6', '[\"5e0389db39399\", \"5e0389fa43539\", \"5e09a690e7569\"]');

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
