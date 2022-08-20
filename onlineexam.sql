-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 08:37 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `email`, `comment`, `datetime`) VALUES
(1, '', 'nayeem', 'chelsea.nayeem99@gmail.com', 'sdasd', '2022-04-20 12:23:30'),
(2, '2', 'nayeem', 'chelsea.nayeem99@gmail.com', 'sdasdasd', '2022-04-20 12:43:42'),
(3, '3', 'nayeem', 'chelsea.nayeem99@gmail.com', 'ffffff', '2022-04-20 14:38:28'),
(4, '11', 'nayeem', 'chelsea.nayeem99@gmail.com', 'sdasd', '2022-04-20 14:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `exam_remark`
--

CREATE TABLE `exam_remark` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_answer` text NOT NULL,
  `got_mark` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_tbl`
--

CREATE TABLE `exam_tbl` (
  `exam_id` int(10) NOT NULL,
  `faculty_id` int(10) NOT NULL,
  `exam_title` varchar(100) NOT NULL,
  `exam_datetime` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `exam_duration` float DEFAULT NULL,
  `qsn1` text DEFAULT NULL,
  `exam_status` binary(1) DEFAULT NULL,
  `total_marks` float DEFAULT 0,
  `exam_declaration_datetime` datetime DEFAULT NULL,
  `sol1` text DEFAULT NULL,
  `qsn2` text DEFAULT NULL,
  `qsn3` text DEFAULT NULL,
  `sol2` text DEFAULT NULL,
  `sol3` text DEFAULT NULL,
  `qsn4` text DEFAULT NULL,
  `qsn5` text DEFAULT NULL,
  `sol4` text DEFAULT NULL,
  `sol5` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_tbl_qsn_tbl`
--

CREATE TABLE `exam_tbl_qsn_tbl` (
  `exam_id` int(10) NOT NULL,
  `qsn_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_tbl_std_exam_enrolled`
--

CREATE TABLE `exam_tbl_std_exam_enrolled` (
  `exam_id` int(10) NOT NULL,
  `std_exam_enrolled_id` int(10) NOT NULL,
  `enrollment_datetime` datetime NOT NULL,
  `std_tbl_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_tbl`
--

CREATE TABLE `faculty_tbl` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `uni_name` varchar(255) NOT NULL,
  `img` varchar(500) DEFAULT NULL,
  `exam_counter` int(10) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty_tbl`
--

INSERT INTO `faculty_tbl` (`id`, `name`, `email`, `password`, `uni_name`, `img`, `exam_counter`, `status`) VALUES
(14, 'Nayeem', 'chelsea.nayeem99@gmail.com', 'f505c3122b948bcb68e4f228fa53cf81', 'Ewu', 'faculty_image/download.jfif', 0, 0),
(15, 'MD. HASIBUL ISLAM', 'nayeem.islam.1872@gmail.com', 'f505c3122b948bcb68e4f228fa53cf81', 'Ewu', 'faculty_image/vcvsdf.PNG', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `section` varchar(20) NOT NULL,
  `post` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `faculty_id`, `topic`, `section`, `post`, `datetime`) VALUES
(2, 14, 'sad', 'Buy & Sell', 'asdsdsad', '2022-04-16 09:56:13'),
(3, 14, 'cvcv', 'Games', 'scxcc', '2022-04-16 11:12:24'),
(4, 14, 'sad', 'Buy & Sell', 'cas', '2022-04-17 07:20:27'),
(5, 15, 'Chelsea FC XI vs Crystal Palace', 'Games', 'Chelsea striker Romelu Lukaku is expected to be fit for this afternoon’s FA Cup semi-final meeting with Crystal Palace after returning to training.\r\n\r\nRecord signing Lukaku missed Tuesday’s Champions League quarter-final second leg against Real Madrid due', '2022-04-17 08:28:10'),
(6, 15, 'dddd', 'Action', 'ascccsacadas', '2022-04-17 11:45:52'),
(10, 14, 'sad', 'Anime', '<p>sadsd<strong>sadsdsd<em>sadsdsd</em></strong></p>\r\n', '2022-04-20 05:39:09'),
(11, 14, '', 'Buy & Sell', '<p><strong>s<span style=\"font-size:18px\">dasds<em>sdsdsd<u>sdsadsd</u></em></span></strong><span style=\"font-size:18px\"><u>sdasdsda</u>s<span style=\"font-family:Times New Roman,Times,serif\">dasd<strong>sdsd</strong></span></span></p>\r\n', '2022-04-20 14:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `qsn_tbl`
--

CREATE TABLE `qsn_tbl` (
  `qsn_id` int(10) NOT NULL,
  `qsn_title` varchar(100) NOT NULL,
  `qsn_description` varchar(255) NOT NULL,
  `new_database` varchar(255) NOT NULL,
  `solution_code` varchar(1000) NOT NULL,
  `marks` float NOT NULL,
  `qsn_upload_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `std_exam_enrolled`
--

CREATE TABLE `std_exam_enrolled` (
  `id` int(10) NOT NULL,
  `exam_id` int(10) NOT NULL,
  `faculty_id` int(10) NOT NULL,
  `enrolled_exam_status` int(1) NOT NULL,
  `std_tbl_std_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `std_solution`
--

CREATE TABLE `std_solution` (
  `std_solution` int(10) NOT NULL,
  `std_ans` varchar(1000) NOT NULL,
  `std_id` int(10) NOT NULL,
  `qsn_id` int(10) NOT NULL,
  `got_marks` float NOT NULL,
  `solution_up_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `timeover` int(11) DEFAULT NULL,
  `submitted` int(11) DEFAULT NULL,
  `std_ans2` varchar(1000) NOT NULL,
  `std_ans3` varchar(1000) NOT NULL,
  `std_ans4` varchar(1000) NOT NULL,
  `std_ans5` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `std_tbl`
--

CREATE TABLE `std_tbl` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `uni_roll_no` int(10) NOT NULL,
  `img` varchar(500) DEFAULT NULL,
  `uni_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_remark`
--
ALTER TABLE `exam_remark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_exam_remark_exam_tbl` (`exam_id`),
  ADD KEY `FK_exam_remark_faculty_tbl` (`faculty_id`),
  ADD KEY `FK_exam_remark_std_tbl` (`student_id`);

--
-- Indexes for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `FKexam_tbl343397` (`faculty_id`);

--
-- Indexes for table `exam_tbl_qsn_tbl`
--
ALTER TABLE `exam_tbl_qsn_tbl`
  ADD PRIMARY KEY (`exam_id`,`qsn_id`),
  ADD KEY `FKexam_tbl_q415233` (`exam_id`),
  ADD KEY `FKexam_tbl_q300810` (`qsn_id`);

--
-- Indexes for table `exam_tbl_std_exam_enrolled`
--
ALTER TABLE `exam_tbl_std_exam_enrolled`
  ADD PRIMARY KEY (`exam_id`,`std_exam_enrolled_id`),
  ADD KEY `FKexam_tbl_s624522` (`std_tbl_id`),
  ADD KEY `FKexam_tbl_s796076` (`std_exam_enrolled_id`);

--
-- Indexes for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qsn_tbl`
--
ALTER TABLE `qsn_tbl`
  ADD PRIMARY KEY (`qsn_id`);

--
-- Indexes for table `std_exam_enrolled`
--
ALTER TABLE `std_exam_enrolled`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKstd_exam_e484286` (`std_tbl_std_id`);

--
-- Indexes for table `std_solution`
--
ALTER TABLE `std_solution`
  ADD PRIMARY KEY (`std_solution`),
  ADD KEY `FKstd_soluti244267` (`std_id`);

--
-- Indexes for table `std_tbl`
--
ALTER TABLE `std_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `uni_roll_no` (`uni_roll_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_remark`
--
ALTER TABLE `exam_remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  MODIFY `exam_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `faculty_tbl`
--
ALTER TABLE `faculty_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `qsn_tbl`
--
ALTER TABLE `qsn_tbl`
  MODIFY `qsn_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `std_exam_enrolled`
--
ALTER TABLE `std_exam_enrolled`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `std_solution`
--
ALTER TABLE `std_solution`
  MODIFY `std_solution` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `std_tbl`
--
ALTER TABLE `std_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_remark`
--
ALTER TABLE `exam_remark`
  ADD CONSTRAINT `FK_exam_remark_exam_tbl` FOREIGN KEY (`exam_id`) REFERENCES `exam_tbl` (`exam_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_exam_remark_faculty_tbl` FOREIGN KEY (`faculty_id`) REFERENCES `faculty_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_exam_remark_std_tbl` FOREIGN KEY (`student_id`) REFERENCES `std_tbl` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  ADD CONSTRAINT `FKexam_tbl343397` FOREIGN KEY (`faculty_id`) REFERENCES `faculty_tbl` (`id`);

--
-- Constraints for table `exam_tbl_qsn_tbl`
--
ALTER TABLE `exam_tbl_qsn_tbl`
  ADD CONSTRAINT `FKexam_tbl_q300810` FOREIGN KEY (`qsn_id`) REFERENCES `qsn_tbl` (`qsn_id`),
  ADD CONSTRAINT `FKexam_tbl_q415233` FOREIGN KEY (`exam_id`) REFERENCES `exam_tbl` (`exam_id`);

--
-- Constraints for table `exam_tbl_std_exam_enrolled`
--
ALTER TABLE `exam_tbl_std_exam_enrolled`
  ADD CONSTRAINT `FKexam_tbl_s402395` FOREIGN KEY (`exam_id`) REFERENCES `exam_tbl` (`exam_id`),
  ADD CONSTRAINT `FKexam_tbl_s624522` FOREIGN KEY (`std_tbl_id`) REFERENCES `std_tbl` (`id`),
  ADD CONSTRAINT `FKexam_tbl_s796076` FOREIGN KEY (`std_exam_enrolled_id`) REFERENCES `std_exam_enrolled` (`id`);

--
-- Constraints for table `std_exam_enrolled`
--
ALTER TABLE `std_exam_enrolled`
  ADD CONSTRAINT `FKstd_exam_e484286` FOREIGN KEY (`std_tbl_std_id`) REFERENCES `std_tbl` (`id`);

--
-- Constraints for table `std_solution`
--
ALTER TABLE `std_solution`
  ADD CONSTRAINT `FKstd_soluti244267` FOREIGN KEY (`std_id`) REFERENCES `std_tbl` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
