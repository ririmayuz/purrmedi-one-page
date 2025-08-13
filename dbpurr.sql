-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-08-13 19:54:37
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `dbpurr`
--

-- --------------------------------------------------------

--
-- 資料表結構 `purr_about`
--

CREATE TABLE `purr_about` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `subtitle` text NOT NULL,
  `section1_title` text NOT NULL COMMENT '段落標題',
  `section1_content` text NOT NULL COMMENT '段落文字',
  `section2_title` text NOT NULL,
  `section2_content` text NOT NULL,
  `section3_title` text NOT NULL,
  `section3_content` text NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `purr_booking`
--

CREATE TABLE `purr_booking` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(100) NOT NULL COMMENT '會員帳號',
  `name` varchar(100) NOT NULL COMMENT '會員姓名',
  `email` varchar(150) NOT NULL COMMENT '聯絡信箱',
  `tel` varchar(50) NOT NULL COMMENT '聯絡電話',
  `line_id` varchar(100) NOT NULL COMMENT 'LINE ID',
  `city` varchar(100) NOT NULL COMMENT '居住地',
  `pet_count` int(11) NOT NULL,
  `available_time` text NOT NULL COMMENT '方便視訊的時間',
  `img` varchar(255) NOT NULL,
  `issue` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=待處理, 1=已確認, 2=完成, 3=取消',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '預約建立時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `purr_images`
--

CREATE TABLE `purr_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `img` varchar(255) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `sh` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `purr_users`
--

CREATE TABLE `purr_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc` varchar(100) NOT NULL COMMENT '會員帳號',
  `pw` varchar(100) NOT NULL COMMENT '會員密碼',
  `name` varchar(100) NOT NULL COMMENT '會員姓名',
  `email` varchar(150) NOT NULL COMMENT '聯絡信箱',
  `tel` varchar(50) NOT NULL COMMENT '聯絡電話',
  `line_id` varchar(100) NOT NULL COMMENT 'LINE ID',
  `city` varchar(100) NOT NULL COMMENT '居住地',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '註冊時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `purr_about`
--
ALTER TABLE `purr_about`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `purr_booking`
--
ALTER TABLE `purr_booking`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `purr_images`
--
ALTER TABLE `purr_images`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `purr_users`
--
ALTER TABLE `purr_users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purr_about`
--
ALTER TABLE `purr_about`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purr_booking`
--
ALTER TABLE `purr_booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purr_images`
--
ALTER TABLE `purr_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purr_users`
--
ALTER TABLE `purr_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
