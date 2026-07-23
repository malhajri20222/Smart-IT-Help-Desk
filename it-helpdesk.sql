-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- مضيف: localhost:8889
-- وقت الجيل: 21 يوليو 2026 الساعة 16:40
-- إصدار الخادم: 8.0.44
-- نسخة PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- قاعدة بيانات: `it-helpdesk`
--

-- --------------------------------------------------------

--
-- بنية الجدول `departments`
--

CREATE TABLE `departments` (
  `id` int NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- إرجاع أو استيراد بيانات الجدول `departments`
--

INSERT INTO `departments` (`id`, `department_name`) VALUES
(1, 'IT'),
(2, 'HR'),
(3, 'Finance'),
(4, 'Sales'),
(5, 'Administration');

-- --------------------------------------------------------

--
-- بنية الجدول `issue_types`
--

CREATE TABLE `issue_types` (
  `id` int NOT NULL,
  `issue_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- إرجاع أو استيراد بيانات الجدول `issue_types`
--

INSERT INTO `issue_types` (`id`, `issue_name`) VALUES
(1, 'Hardware'),
(2, 'Software'),
(3, 'Network'),
(4, 'Printer'),
(5, 'Email'),
(6, 'Password Reset'),
(7, 'Internet'),
(8, 'VPN'),
(9, 'Microsoft Office'),
(10, 'Shared Folder'),
(11, 'New User Account');

-- --------------------------------------------------------

--
-- بنية الجدول `tickets`
--

CREATE TABLE `tickets` (
  `id` int NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `department` varchar(100) NOT NULL,
  `issue_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `priority` varchar(20) NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- إرجاع أو استيراد بيانات الجدول `tickets`
--

INSERT INTO `tickets` (`id`, `employee_id`, `department`, `issue_type`, `description`, `priority`, `status`, `created_at`) VALUES
(43, 'EMP1001', 'HR', 'Email', 'Unable to send or receive Outlook emails since this morning.', 'High', 'Open', '2026-07-20 11:13:20'),
(44, 'EMP1002', 'Finance', 'Software', 'SAP application crashes immediately after login.\r\n', 'Medium', 'In Progress', '2026-07-20 11:13:56'),
(45, 'EMP1003', 'Marketing', 'Network', 'Internet connection is very slow, affecting online meetings.\r\n', 'Low', 'In Progress', '2026-07-20 11:14:27'),
(46, 'EMP1004', 'Operations', 'Printer', 'Office printer displays \"Paper Jam\" even after clearing the tray.\r\n', 'Low', 'Open', '2026-07-20 11:14:59'),
(47, 'EMP1005', 'IT', 'Hardware', 'Laptop does not power on after Windows update.\r\n', 'High', 'In Progress', '2026-07-20 11:15:52'),
(48, 'EMP1006', 'Finance', 'Other', 'Shared network folder is inaccessible. Access denied message appears.\r\n', 'Medium', 'Closed', '2026-07-20 11:16:29'),
(49, 'EMP1007', 'HR', 'Email', 'Employee cannot reset Microsoft 365 password.\r\n', 'Medium', 'Closed', '2026-07-20 11:17:02'),
(50, 'EMP1010', 'IT', 'Hardware', 'External monitor is not detected after docking the laptop.', 'High', 'In Progress', '2026-07-20 11:17:45'),
(51, 'EMP1011', 'Finance', 'Other', ' Employee reported a suspected phishing email requesting bank account information.\r\n', 'High', 'Closed', '2026-07-20 11:25:32');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee') NOT NULL DEFAULT 'employee',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Monerah Khalid', 'admin', '$2y$10$6ez2BIwjBmNJpjPKHNpdT.sPa0Oot39Y2u1ohsN38EZWBS24wwiAC', 'admin', '2026-07-18 12:28:11'),
(2, 'Employee User', '', '', 'employee', '2026-07-20 12:06:51'),
(3, '', 'employee', '', 'employee', '2026-07-20 12:07:18'),
(4, 'Sara', 'Sara', '$2y$10$.H./Ub5YE9lD/IFFCsTTGuaLggsAuxlh41Z/IrcKCNk33j/cUTNJu', 'employee', '2026-07-21 10:32:08');

--
-- Indexes for dumped tables
--

--
-- فهارس للجدول `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `issue_types`
--
ALTER TABLE `issue_types`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- فهارس للجدول `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `issue_types`
--
ALTER TABLE `issue_types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
