-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2025 at 06:06 AM
-- Server version: 5.7.33
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logic-service`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_u_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `user_wallet` decimal(10,2) NOT NULL DEFAULT '0.00',
  `introducer_id` varchar(100) DEFAULT NULL,
  `introducer_phone` varchar(100) DEFAULT NULL,
  `introducer_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `app_u_address` text,
  `pin_code` varchar(10) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(50) DEFAULT NULL,
  `bank_account_no` varchar(50) DEFAULT NULL,
  `upi_id` varchar(100) DEFAULT NULL,
  `upi_qr_code` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `user_pic_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `app_u_name`, `phone_number`, `user_wallet`, `introducer_id`, `introducer_phone`, `introducer_name`, `user_email`, `password`, `app_u_address`, `pin_code`, `bank_name`, `ifsc_code`, `bank_account_no`, `upi_id`, `upi_qr_code`, `status`, `user_pic_img`, `created_at`, `updated_at`) VALUES
(1, 'Company', '0001112223', 0.00, NULL, NULL, NULL, 'company@gmail.com', '$2y$10$YuKsIcitYtjxXcbwya7dIOaZx6YmiwOrqRMiL.vsKeG7mEJd1KK22', 'panchanantala, berhampore, murshidabad, west bengal, 742102', '742102', 'BOB', 'jjj', 'jjhj', 'jhj', 'uploads/qr_user/1753281881_qrcodepe.jpg', 1, 'uploads/qr_user/0861739808988_qr_image_380x226_6863c80ad91d2.jpg', '2025-07-23 03:44:41', '2025-07-24 22:52:33'),
(2, 'Sayan', '986532659', 0.00, '1', '0001112223', 'Company', 'mail2pritamsau@gmail.com', '$2y$10$uaO3KwYuQtPtmH7v4lOw8.UeshVFO78IwxT/BaWoJDPWAFZrgUm0K', 'panchanantala, berhampore, murshidabad, west bengal, 742102', '742102', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-07-28 09:00:13', '2025-07-29 09:08:21'),
(3, 'Rakesh', '85296385', 1350.00, '2', '986532659', 'Sayan', 'mail2pritamsau@gmail.com', '$2y$10$Dt9dneEYVS5dL19TESdc7ODJe9MHLZVVh6wGmoB.uETnKAo.9vKv6', 'panchanantala, berhampore, murshidabad, west bengal, 742102', '742102', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-07-28 09:00:44', '2025-07-28 09:58:00'),
(4, 'Pritam1', '08617398081', 0.00, '3', '85296385', 'Rakesh', 'dukeputu@gmail.com', '$2y$10$xvBySWl85qzob91z5ijuOOmVqeJlv5Vc7XEZ5Jf.6WOI4VhphLrL2', 'panchanantala, berhampore, murshidabad, west bengal, 742102', '742102', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-07-28 09:36:28', '2025-07-28 09:36:28'),
(5, 'Pritam2', '08617398082', 0.00, '3', '85296385', 'Rakesh', 'mail2pritamsau@gmail.com', '$2y$10$Tj9a9DK/vl9szKHK9jHCFeO1faxEUu61ZCrJEJuuCUSNtTYzP/8Nq', 'panchanantala, berhampore, murshidabad, west bengal, 742102', '742102', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-07-28 09:45:49', '2025-07-28 09:45:49'),
(6, 'Pritam3', '08617398083', 1330.00, '5', '08617398082', 'Pritam2', 'dukepritamsau@gmail.com', '$2y$10$0sKkpRCOt8./uJRqDMulBulvJoMvdV/Il23LnGrrD5KDGDRgJpFOm', 'Puratan Para, PANCHANANTALA, Karbalaroad, berhampore, murshidabad,', '742102', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-07-28 09:46:47', '2025-07-29 08:50:34'),
(7, 'Sumon 22', '986532526', 1000.00, '5', '08617398082', 'Pritam2', 'mail2pritamsau@gmail.com', '$2y$10$TwhjVdZKBNMV7XJkueoQ9uXoWZn3tTZVfS.hfhHiaqeNqXwrQnmZm', 'panchanantala, berhampore, murshidabad, west bengal, 742102', '742102', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-07-28 11:21:59', '2025-07-28 11:24:08'),
(8, 'Rakesh1', '9865236585', 1350.00, '7', '986532526', 'Sumon 22', 'dukeputu@gmail.com', '$2y$10$D707CWDk6HL7rSwKoBu0ieOauEnEndCiZduki8U90F2s893Pn7e0m', 'panchanantala, berhampore, murshidabad, west bengal, 742102', '742102', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-07-28 11:30:45', '2025-07-28 11:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_wallet` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin_no` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BankName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BankACNo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BankIFSC` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upiId` text COLLATE utf8mb4_unicode_ci,
  `qrCodeUpload` longtext COLLATE utf8mb4_unicode_ci,
  `join_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Active= 1,\r\nDeactive =2,\r\nPending = 3',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_id`, `name`, `phone`, `password`, `company_wallet`, `email`, `address`, `pincode`, `state`, `cin_no`, `BankName`, `BankACNo`, `BankIFSC`, `upiId`, `qrCodeUpload`, `join_date`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(1, '0000001', 'Rakesh Sharma', '9876543210', '$2y$10$MptL.kuU4kbzR0llljxPOerCqTN.d7BFbzWqGOr/.BaxEtE6x.CFm', NULL, 'rakesh@example.com', '22 Park Street, Kolkata', '700016', 'West Bengal', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2, NULL, '2025-07-17 19:49:01'),
(5, '0000005', 'Sumon', '08617398080', '$2y$10$/PbsczeMe.gj4xL/mcNVGeL/S9183Omd62GLx.hdY5woOGvHHsTjK', NULL, 'dukeputu@gmail.com', 'berhampore', '742102', 'West Bengal', 'ddd', 'SBI', '20235630424', 'SBIN0014040', '895623@ybl', 'uploads/qr_company/1753339645_iiinsurance.jpg', '2025-07-23', '2025-07-18', 2, '2025-07-23 02:27:33', '2025-07-25 07:41:54'),
(8, '0000006', 'Pritam Sau', '08617398099', '$2y$10$Zctiek6IZR2z6Nno6Uj37uULaXyDZpmcfqXM27IZdMRC.DbI0jpVm', NULL, 'dukeputu@gmail.com', 'berhampore', '742102', 'West Bengal', 'fff', 'ffff', 'www', 'www', 'www', 'uploads/qr_company/1753265515_WhatsApp Image 2025-07-21 at 19.25.22_67d905a4 (1).jpg', '2025-07-23', '2025-07-18', 1, '2025-07-23 04:41:55', '2025-07-25 07:41:27'),
(10, '0000009', 'Pritam Sau', '08617398999', '$2y$10$zjqDPriQJFxQkfc5cjBMYOnLf1DkfHQiEOzwoD/K8Pu6W34GBAUwK', NULL, 'dukeputu@gmail.com', 'berhampore', '742102', 'West Bengal', 'hkhh', 'hjhkh', 'kjhhkhk', 'hkjhkhkh', 'khkjhkjhkj', 'uploads/qr_company/1753272795_image_380x226_6863c80ad91d2.jpg', '2025-07-23', '2025-07-18', 2, '2025-07-23 06:43:15', '2025-07-23 06:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_master`
--

CREATE TABLE `package_master` (
  `id` int(10) UNSIGNED NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `package_amount` decimal(10,2) NOT NULL,
  `package_payout_per` decimal(5,2) NOT NULL,
  `package_total_amount` decimal(10,2) NOT NULL,
  `package_time_duration` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_master`
--

INSERT INTO `package_master` (`id`, `package_name`, `package_amount`, `package_payout_per`, `package_total_amount`, `package_time_duration`, `created_at`, `updated_at`) VALUES
(1, 'Package 1', 370.00, 35.00, 500.00, 1440, '2025-07-29 07:41:25', '2025-07-29 07:41:25'),
(2, 'Package 2', 2000.00, 4.00, 2080.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(3, 'Package 3', 5000.00, 4.00, 5200.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(4, 'Package 4', 7000.00, 3.00, 7210.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(5, 'Package 5', 10000.00, 3.00, 10300.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(6, 'Package 6', 13000.00, 4.00, 13520.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(7, 'Package 7', 17000.00, 4.00, 17680.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(8, 'Package 8', 20000.00, 3.00, 20600.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(9, 'Package 9', 25000.00, 3.00, 25750.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(10, 'Package 10', 30000.00, 3.00, 30900.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(11, 'Package 11', 37000.00, 4.00, 38480.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(12, 'Package 12', 44000.00, 3.00, 45320.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(13, 'Package 13', 51000.00, 5.00, 53550.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(14, 'Package 14', 60000.00, 5.00, 63000.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(15, 'Package 15', 70000.00, 5.00, 73500.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(16, 'Package 16', 85000.00, 5.00, 89250.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(17, 'Package 17', 99000.00, 6.00, 104940.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(18, 'Package 18', 150000.00, 7.00, 160500.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(19, 'Package 19', 200000.00, 7.00, 214000.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00'),
(20, 'Package 20', 300000.00, 7.00, 321000.00, 1440, '2025-07-29 07:41:00', '2025-07-29 07:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_types`
--

CREATE TABLE `transaction_types` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '(1, ''Add Balance''),\r\n(2, ''Package Buy''),\r\n(3, ''Maturity''),\r\n(4, ''Withdrawal'');'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_types`
--

INSERT INTO `transaction_types` (`id`, `name`) VALUES
(1, 'Add Balance'),
(2, 'Package Buy'),
(3, 'Maturity'),
(4, 'Withdrawal');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_balance_request`
--

CREATE TABLE `user_balance_request` (
  `id` int(11) NOT NULL,
  `app_user_id` int(10) UNSIGNED DEFAULT NULL,
  `app_user_name` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `user_phone` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `req_bal_amount` decimal(10,2) DEFAULT NULL,
  `pay_screenshot` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_package_purchases`
--

CREATE TABLE `user_package_purchases` (
  `id` int(11) NOT NULL,
  `app_user_id` int(10) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `introducer_id` varchar(100) DEFAULT NULL,
  `introducer_phone` varchar(100) DEFAULT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `is_credited` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_package_purchases`
--

INSERT INTO `user_package_purchases` (`id`, `app_user_id`, `package_id`, `introducer_id`, `introducer_phone`, `amount_paid`, `is_credited`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '5', '08617398082', 370.00, 0, '2025-07-29 08:11:49', '2025-07-29 08:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE `user_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Transaction Record ID',
  `app_user_id` int(10) UNSIGNED NOT NULL COMMENT 'FK to app_users.id',
  `type_id` tinyint(3) UNSIGNED NOT NULL COMMENT 'FK to transaction_types.id',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Transaction amount',
  `wallet_before` decimal(10,2) NOT NULL COMMENT 'Wallet balance before transaction',
  `wallet_after` decimal(10,2) NOT NULL COMMENT 'Wallet balance after transaction',
  `status` enum('Pending','Done') NOT NULL DEFAULT 'Pending' COMMENT 'Transaction status',
  `requested_at` datetime DEFAULT NULL COMMENT 'When transaction was requested',
  `done_at` datetime DEFAULT NULL COMMENT 'When transaction was completed',
  `screenshot` varchar(255) DEFAULT NULL COMMENT 'If withdrawal, screenshot path',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='User Transaction History';

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`id`, `app_user_id`, `type_id`, `amount`, `wallet_before`, `wallet_after`, `status`, `requested_at`, `done_at`, `screenshot`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 370.00, 1700.00, 1330.00, 'Done', '2025-07-29 13:41:49', '2025-07-29 13:41:49', NULL, '2025-07-29 13:41:49', '2025-07-29 13:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_withdraw_request`
--

CREATE TABLE `user_withdraw_request` (
  `id` int(11) NOT NULL,
  `app_user_id` int(10) UNSIGNED NOT NULL,
  `app_user_name` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `user_phone` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `req_bal_amount` decimal(10,2) NOT NULL,
  `pay_screenshot` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Approved, 2=Pending, 0=Rejected',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_id` (`member_id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_master`
--
ALTER TABLE `package_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `transaction_types`
--
ALTER TABLE `transaction_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_balance_request`
--
ALTER TABLE `user_balance_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_balance_user` (`app_user_id`);

--
-- Indexes for table `user_package_purchases`
--
ALTER TABLE `user_package_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_purchase_user` (`app_user_id`),
  ADD KEY `fk_purchase_package` (`package_id`);

--
-- Indexes for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_transactions_type` (`type_id`),
  ADD KEY `app_user_id` (`app_user_id`);

--
-- Indexes for table `user_withdraw_request`
--
ALTER TABLE `user_withdraw_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_withdraw_user` (`app_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package_master`
--
ALTER TABLE `package_master`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_types`
--
ALTER TABLE `transaction_types`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_balance_request`
--
ALTER TABLE `user_balance_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_package_purchases`
--
ALTER TABLE `user_package_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Transaction Record ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_withdraw_request`
--
ALTER TABLE `user_withdraw_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_balance_request`
--
ALTER TABLE `user_balance_request`
  ADD CONSTRAINT `fk_balance_user` FOREIGN KEY (`app_user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_package_purchases`
--
ALTER TABLE `user_package_purchases`
  ADD CONSTRAINT `fk_purchase_package` FOREIGN KEY (`package_id`) REFERENCES `package_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_purchase_user` FOREIGN KEY (`app_user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD CONSTRAINT `fk_user_transactions_type` FOREIGN KEY (`type_id`) REFERENCES `transaction_types` (`id`),
  ADD CONSTRAINT `fk_user_transactions_user` FOREIGN KEY (`app_user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_withdraw_request`
--
ALTER TABLE `user_withdraw_request`
  ADD CONSTRAINT `fk_withdraw_user` FOREIGN KEY (`app_user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
