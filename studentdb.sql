-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 02:28 PM
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
-- Database: `studentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `password`, `user_type`, `student_id`) VALUES
(1, 'Page Admin', 'admin@gmail.com', '$2y$10$w6lMhfEU980ki3HrTfvPS.dKy5aM63z5oQ0wLcZ6KPowLnNt.YrCi', 'admin', 1),
(2, 'Jerome Villamor', 'jerome@gmail.com', '$2y$10$iplQLRFnJXdgjEY2hQi9EeSabBukbmCLzt4myFNrTlCqiokqQK19S', 'admin', 2),
(3, 'Liane Tomas', 'liane@gmail.com', '$2y$10$qexbCIH2ro9auA9QCPbH3OP94KMc2372TA4LCTO4gVGxchu/UKkza', 'student', 3),
(5, 'Guts Dela Cruz', 'guts@gmail.com', '$2y$10$Vn8UoLBmbu82JZpGxLHp..0ULCpHx6305Pfw8T9E.KyF4DlQ80lha', 'student', 5),
(7, 'Runel Baldobi', 'ronnel@gmail.com', '$2y$10$HZy3lj22Jd3HEPnsKiEs4u9m92fP6xuZSMQwigf.hQkWNsnbch.xq', 'student', 7),
(9, 'Christian Castaneda', 'christian@gmail.com', '$2y$10$FxfwPQm6/xG4oofEwRKsleNQxLVOBEZjuaiRexydq.boG7cm6It/G', 'student', 9),
(10, 'Ariana Grande', 'ariana@gmail.com', '$2y$10$7k9vAQ4fHiJ3WmRByyPbYeqq4hVQ57l5TVgPzvqTD.5Qc5pJrOSgK', 'student', 10),
(13, 'Maria Juan', 'maria@gmail.com', '$2y$10$Hu4eiYijYJtmi5Cutmjlyu6lqKBCGOS.AW/D0KRvh1OrOhF6fl..K', 'student', 13),
(14, 'Jozen Agustin', 'jozen@gmail.com', '$2y$10$.5YjT.2JcOngX6ztsQSH1.FC4uDlu035ocqz7.8t7BEEX6mYwfe5W', 'student', 14);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(2) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gpa` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `age`, `email`, `gpa`) VALUES
(1, 'Page Admin', 19, 'admin@gmail.com', 1),
(2, 'Jerome Villamor', 19, 'jerome@gmail.com', 1),
(3, 'Liane Tomas', 20, 'liane@gmail.com', 1.5),
(5, 'Jeric Dela Cruz', 25, 'jeric@gmail.com', 1),
(7, 'Ronnel Baldovino', 30, 'ronnel@gmail.com', 1.25),
(9, 'Christian Castaneda', 24, 'christian@gmail.com', 1),
(10, 'Ariana Grande', 31, 'ariana@gmail.com', 2.5),
(13, 'Maria Juan', 21, 'maria@gmail.com', 2.25),
(14, 'Jozen Agustin', 20, 'jozen@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
