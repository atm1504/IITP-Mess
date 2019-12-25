-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 25, 2019 at 04:57 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `iit_patna_hostel`
--

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
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complains`
--

INSERT INTO `complains` (`id`, `name`, `email`, `phone`, `complain`, `is_resolved`, `unique_id`, `status`, `date_time`) VALUES
(1, 'sffef', 'er@gmail.com', '34234243', 'ertre ert ter te ', 0, NULL, NULL, '2019-12-25 16:03:01'),
(2, 'sffef', 'er@gmail.com', '34234243', 'ertre ert ter te ', 0, NULL, NULL, '2019-12-25 16:03:01'),
(3, 'sffef', 'er@gmail.com', '34234243', 'ertre ert ter te ', 0, NULL, NULL, '2019-12-25 16:03:01'),
(4, 'sffef', 'er@gmail.com', '34234243', 'ertre ert ter te ', 0, NULL, NULL, '2019-12-25 16:03:01'),
(5, 'sffef', 'er@gmail.com', '34234243', 'ertre ert ter te ', 0, NULL, NULL, '2019-12-25 16:03:01'),
(6, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', '12323234 2444', 0, NULL, NULL, '2019-12-25 16:03:01'),
(7, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', '12323234 2444', 0, NULL, NULL, '2019-12-25 16:03:01'),
(8, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', '12323234 2444', 0, NULL, NULL, '2019-12-25 16:03:01'),
(9, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', '12323234 2444', 0, NULL, NULL, '2019-12-25 16:03:01'),
(10, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', 'This is a sample complain', 0, NULL, NULL, '2019-12-25 16:03:01'),
(11, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', 'This is a sample complain', 0, NULL, NULL, '2019-12-25 16:03:01'),
(12, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', 'reuyty uyeryer wr iyuyuwer', 0, NULL, NULL, '2019-12-25 16:03:01'),
(13, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', 'sjre uier uiuertiuyy', 0, '5e0386b76bd5b', NULL, '2019-12-25 16:03:01'),
(14, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', 'iurewu oiureuio eroiuiteur', 0, '5e0389db39399', 'ddcd', '2019-12-25 16:10:09'),
(15, 'Amartya Mondal', 'hayyoulistentome@gmail.com', '08967570983', 'iurewu oiureuio eroiuiteur', 0, '5e0389fa43539', NULL, '2019-12-25 16:10:40');

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
(1, '1801me07', 'a03a4a1ebcd9d95c4a049c45fbf0145adc5329b9', 'atm1504.in@gmail.com', 'Amartya Mondal', 'BTech', 'Mess1', '250170d3179eedde60388e8bff4a75813a968ad3', '[\"5e0389db39399\", \"5e0389fa43539\"]');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `complains`
--
ALTER TABLE `complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
