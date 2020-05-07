-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2019 at 07:22 PM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kfupm_activities`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `place` varchar(150) NOT NULL,
  `place_desc` varchar(200) NOT NULL,
  `type` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title`, `description`, `date`, `time`, `place`, `place_desc`, `type`, `rating`, `user_id`, `status`, `creation_date`) VALUES
(3, 'dsfsdfdsf', 'sdflsdkfjksdflkhsdfhsdkflsd', '2019-02-01', '14:03:00', '24', '', 1, 0, 1, 1, '0000-00-00'),
(4, 'Good Activity', 'Footaball activity near building 39', '2019-12-15', '02:02:00', '0', 'srgljelsdg', 4, 0, 1, 1, '0000-00-00'),
(5, 'The best activity  ', 'Footaball activity ', '2019-12-15', '05:02:00', '0', '', 4, 0, 1, 2, '0000-00-00'),
(6, 'dfgesdgsdgs', 'fdfgsdfsdgesgwedgrg', '2019-12-24', '03:02:00', '0', '', 5, 0, 2, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `activity_types`
--

CREATE TABLE `activity_types` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activity_types`
--

INSERT INTO `activity_types` (`id`, `name`) VALUES
(1, '0'),
(2, '0'),
(3, '0'),
(4, 'dsfgdfsg'),
(5, 'fgfdg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `commenter_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `review` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `commenter_id`, `activity_id`, `content`, `review`) VALUES
(1, 7, 1, 'dsljflsdkf', 5),
(2, 1, 3, 'sl;dkl;skdl;', 3),
(3, 1, 3, 'TRUNCATE TABLE users;', 4),
(4, 1, 3, 'TRUNCATE TABLE users;', 4),
(5, 2, 3, 'good', 4);

-- --------------------------------------------------------

--
-- Table structure for table `offering_requests`
--

CREATE TABLE `offering_requests` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offering_requests`
--

INSERT INTO `offering_requests` (`id`, `activity_id`, `description`) VALUES
(1, 1, 'You should write ver clear description about the activity .\nClearly specify the location and what is gonna be happened in the activity.'),
(3, 2, 'You should clarify the description'),
(4, 5, 'Not Good description , improve it'),
(5, 4, 'Clearify more'),
(6, 4, 'Clarify more');

-- --------------------------------------------------------

--
-- Table structure for table `participation_requests`
--

CREATE TABLE `participation_requests` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participation_requests`
--

INSERT INTO `participation_requests` (`id`, `activity_id`, `requester_id`, `status`) VALUES
(1, 4, 2, '0'),
(4, 4, 2, '2'),
(6, 4, 6, '1'),
(7, 3, 2, 'pending'),
(8, 9, 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `phone_number` int(50) NOT NULL,
  `student_id` int(50) NOT NULL,
  `profile_image` varchar(200) NOT NULL,
  `user_type` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone_number`, `student_id`, `profile_image`, `user_type`, `date`) VALUES
(1, 'Alosaimi', 'admin@admin.com', 'admin', 0, 0, '', 1, '2019-12-08'),
(2, 'Musaed', 'm@m.com', '1234512345', 533333333, 200000000, '', 0, '2019-12-08'),
(3, 'dsfdsf', 'root@f.ocm', 'msaad12345', 53343454, 200000000, '', 0, '0000-00-00'),
(4, 'dsfds', 'root@df.com', 'msaad12345', 23432432, 234324324, '', 0, '0000-00-00'),
(5, 'dsgsd', 'root@sdf.com', '123123123', 34234234, 200000000, '', 0, '0000-00-00'),
(6, 'Musaed', 'msaad@hotmail.com', 'msaad12345', 5553424, 201685040, '', 0, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_types`
--
ALTER TABLE `activity_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offering_requests`
--
ALTER TABLE `offering_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participation_requests`
--
ALTER TABLE `participation_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `activity_types`
--
ALTER TABLE `activity_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `offering_requests`
--
ALTER TABLE `offering_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `participation_requests`
--
ALTER TABLE `participation_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
