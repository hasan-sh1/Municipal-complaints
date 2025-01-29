-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 08:49 PM
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
-- Database: `complaints`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `area_id` varchar(20) NOT NULL,
  `area_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`area_id`, `area_name`) VALUES
('1', 'شمال المدينة'),
('2', 'شرق المدينة'),
('3', 'غرب المدينة'),
('4', 'جنوب المدينة');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` varchar(20) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
('8', 'اخرى'),
('3', 'خدمات الصحية'),
('2', 'خدمات الصرف الصحي'),
('5', 'خدمات الطرق'),
('7', 'خدمات الكهرباء'),
('6', 'خدمات المواصلات'),
('4', 'خدمات المياه'),
('1', 'خدمات النظافة');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` varchar(20) NOT NULL,
  `complaint_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `comment_text` text NOT NULL,
  `commentdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending' COMMENT 'حالة الشكوى ',
  `submission_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'تاريخ تقديم الشكوى',
  `resolution_date` date NOT NULL COMMENT 'تاريخ حل الشكوى بحالة حلها',
  `type` varchar(10) NOT NULL COMMENT 'عامة أو خاصة',
  `area_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `user_id`, `description`, `category_id`, `status`, `submission_date`, `resolution_date`, `type`, `area_id`) VALUES
('5joUSqGiHtGmRbtZb4pp', 'SU23Ad8jmMaBIFa7o0qt', 'لدي بعض المشاكل في فناء المنزل و هناك بعض الجيران المزعجين', '8', 'Done', '2025-01-10', '2025-01-10', 'خاصة', '3'),
('lQivWdUQncYXD38SamFO', 'oW0AiXqzbVbHtrtAFDq4', 'هناك قمامة جانب الحاويات , و الاهالي يقومون بحرق النفايات و اصبح الجو ملوث ', '1', 'Done', '2025-01-10', '2025-01-10', 'خاصة', '4'),
('N9DGTGLiCVeUo69TJxGn', 'oW0AiXqzbVbHtrtAFDq4', 'المواصلات تستهلك وقت كبير جدا للوصول الى الحارات الشرقية الشمالية المتفرعة من شارع محمود عبد العزيز', '6', 'Pending', '2025-01-10', '0000-00-00', 'عامة', '1'),
('RMhDfqhY7g6BZndw3HIs', 'SU23Ad8jmMaBIFa7o0qt', 'الطاقة لا تفنى و لا تستحدث من العدم,بل تتحول من شكل للآخر دون زيادة أو نقصان.', '5', 'Closed', '2025-01-10', '2025-01-10', 'عامة', '4');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` varchar(20) NOT NULL,
  `message_content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `sender_id` varchar(20) NOT NULL,
  `receiver_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message_content`, `created_at`, `sender_id`, `receiver_id`) VALUES
('3YyAvobafdjC1mhknRip', 'شكراً,على سرعة الاستجابة.', '2025-01-10 20:33:25', 'SU23Ad8jmMaBIFa7o0qt', 'fquHXorTWB5kpaIEsGFQ'),
('qTEcCNtrs566mpbB7Y4v', 'شكرا , لانك سريع في الرد', '2025-01-10 20:34:21', 'oW0AiXqzbVbHtrtAFDq4', '37LxeyHsczcMGLxBYZKd'),
('rPuLz0sQc5ZB3bUTW7Lj', 'يرجى الرد على مشكلتي في اسرع وقت ممكن , شاكرين تعاونكم', '2025-01-10 20:33:05', 'SU23Ad8jmMaBIFa7o0qt', '37LxeyHsczcMGLxBYZKd'),
('T0jq4KHQLJ2m8vqTdwbh', 'لماذا لم يتم الرد على رسائلي حتى الان', '2025-01-10 20:34:35', 'oW0AiXqzbVbHtrtAFDq4', 'fquHXorTWB5kpaIEsGFQ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'user',
  `fullname` varchar(30) NOT NULL,
  `national_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `type`, `fullname`, `national_id`) VALUES
('37LxeyHsczcMGLxBYZKd', 'karam@gmail.com', '$2y$10$LtQA87VYVT1pQ5nRdikR8uQFcuMioNhghV591axhYlQw57H9nnrZ6', 'admin', 'karam maarouf', '998877'),
('fquHXorTWB5kpaIEsGFQ', 'hasan@gmail.com', '$2y$10$PLu4uar685LpLcKX4iZ2ne1UXjl2GJKqdumbb7STcaKYMGx6/9.2u', 'admin', 'hasan shhade', '885522'),
('oW0AiXqzbVbHtrtAFDq4', 'saleh@gmail.com', '$2y$10$X49wSGqECvOtCX7U7JEBA.CVaCIozCLIF.n.U/ZoVx3ma0/E2XC0e', 'user', 'saleh haron', '446611'),
('SU23Ad8jmMaBIFa7o0qt', 'qusay@gmail.com', '$2y$10$aSZPn2bZOUyQmrk.JtbDleo2QM5jgiMz2m5Vg/acuaeryCWGPwRPu', 'user', 'qusay fanoos', '447799');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
