-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2026 at 10:55 PM
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
-- Database: `online_exam_registration_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `academic_year_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `status` enum('current','closed') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `full_name`, `created_at`) VALUES
(1, 'admin', '$2y$10$xi0FDWH/bGSwG0WlNXwRselTnTBeeRRlfOfpGVNOWtzQneX/Uy6Qe', 'System Administrator', '2026-08-03 19:15:58');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(150) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `department_id`, `created_at`) VALUES
(1, 'Computer Networks', 1, '2026-08-02 17:59:53'),
(2, 'Information Technology', 1, '2026-08-02 18:00:27'),
(3, 'Hospitality', 5, '2026-08-02 18:00:59'),
(4, 'Civil Engineering', 2, '2026-08-02 18:01:27'),
(5, 'Education', 4, '2026-08-02 18:01:52'),
(6, 'Accounting', 3, '2026-08-02 18:02:20'),
(7, 'Computer Technology', 1, '2026-08-02 18:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `created at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `created at`) VALUES
(1, 'computing and information technology', '2026-08-02 17:53:38'),
(2, 'Engineering', '2026-08-02 17:55:59'),
(3, 'business\r\n', '2026-08-02 17:56:31'),
(4, 'Education\r\n', '2026-08-02 17:56:53'),
(5, 'Social Sciences\r\n', '2026-08-02 17:57:47'),
(6, 'International Relations', '2026-08-02 17:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `course_id` int(11) NOT NULL,
  `exam_date` date NOT NULL,
  `exam_time` time NOT NULL,
  `venue` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `exam_name`, `course_id`, `exam_date`, `exam_time`, `venue`, `created_at`) VALUES
(1, 'calculus', 1, '2026-08-05', '09:00:00', 'lecture theature', '2026-08-03 20:08:08'),
(2, 'Analogue Electronics', 1, '2026-08-07', '10:00:00', 'D31', '2026-08-04 15:57:47'),
(3, 'Geotechnical', 4, '2026-08-07', '11:00:00', 'Lecture Hall', '2026-08-04 16:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `exam_registration`
--

CREATE TABLE `exam_registration` (
  `registration_id` int(11) NOT NULL,
  `reg_no` varchar(30) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `registration_status` enum('pending','approved','rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_registration`
--

INSERT INTO `exam_registration` (`registration_id`, `reg_no`, `exam_id`, `registration_status`) VALUES
(1, 'SCNI/02241/2024', 1, 'approved'),
(2, 'SCNI/02240/2024', 2, 'pending'),
(3, 'EBMN/12345/2022', 3, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `reg_no` varchar(30) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('mpesa','bank','cash') NOT NULL,
  `transaction_reference` varchar(50) NOT NULL,
  `checkout_request_id` varchar(100) DEFAULT NULL,
  `merchant_request_id` varchar(100) DEFAULT NULL,
  `result_code` int(11) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `payment_status` enum('pending','verified','rejected') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `reg_no`, `amount`, `payment_method`, `transaction_reference`, `checkout_request_id`, `merchant_request_id`, `result_code`, `payment_date`, `payment_status`, `created_at`) VALUES
(2, 'SCNI/02240/2024', 1000.00, 'mpesa', '', 'ws_CO_050820262107565791565764', '5464-4d99-b97f-32b4ae869fb955648', NULL, '2026-08-05', 'pending', '2026-08-05 18:07:58'),
(3, 'SCNI/02240/2024', 1000.00, 'mpesa', '', 'ws_CO_050820262116431791565764', '5402-499b-b4c2-6e3ebadad32b207531', NULL, '2026-08-05', 'pending', '2026-08-05 18:16:44');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `reg_id` int(11) NOT NULL,
  `reg_no` varchar(30) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `registration_date` date NOT NULL,
  `status` enum('pending','registered','cancelled') NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(50) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `reg_no` varchar(30) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `year_of_study` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`reg_no`, `first_name`, `last_name`, `gender`, `email`, `phone`, `password`, `course_id`, `department_id`, `year_of_study`, `created_at`) VALUES
('EBMN/12345/2022', 'kevin', 'otieno', 'female', 'kevin@gmail.com', '0798787654', '$2y$10$Uku9A6w1alS.NAgnbWhq0uHexKBDTPx8NcETwN1pHigNM7NWGVqF.', 4, 2, 4, '2026-08-04 16:23:55'),
('SCNI/02240/2024', 'Gift', 'Sheila', 'female', 'sheilagift25@gmail.com', '0791565764', '$2y$10$xXuZNr57jYf1RD5lSQir8uTo7NqIQx97IkXJAjx8E8Q6H71SNPJde', 1, 1, 2, '2026-08-03 15:50:45'),
('SCNI/02241/2024', 'val', 'awuor', 'female', 'val@gmail.com', '0712341234', '$2y$10$ZQlBtl160foQri/KPcxQF.N3ZNYtvJyJIU6WLSHisT9FduJcAHzcK', 1, 1, 2, '2026-08-04 10:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL,
  `unit_code` int(11) NOT NULL,
  `unit_name` varchar(30) NOT NULL,
  `course_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `credit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`academic_year_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `exam_registration`
--
ALTER TABLE `exam_registration`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`reg_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `academic_year_id` (`academic_year_id`),
  ADD KEY `reg_no` (`reg_no`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `academic_year_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam_registration`
--
ALTER TABLE `exam_registration`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`),
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`academic_year_id`),
  ADD CONSTRAINT `registrations_ibfk_3` FOREIGN KEY (`reg_no`) REFERENCES `students` (`reg_no`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `units_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`semester_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
