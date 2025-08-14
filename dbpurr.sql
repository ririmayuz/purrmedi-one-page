-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-08-14 23:25:51
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
  `h1` text NOT NULL COMMENT '段落標題',
  `p1` text NOT NULL COMMENT '段落文字',
  `h2` text NOT NULL,
  `p2` text NOT NULL,
  `h3` text NOT NULL,
  `p3` text NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `purr_about`
--

INSERT INTO `purr_about` (`id`, `title`, `subtitle`, `h1`, `p1`, `h2`, `p2`, `h3`, `p3`, `img`) VALUES
(1, 'PurrMedi 毛孩遠距照護平台', '全台首創毛孩遠距視訊初診整合系統', '為什麼創立這個平台？', '很多飼主面對毛孩突發狀況時，會因為時間、交通或地點受限，無法即時就醫。我們成立 PurrMedi，是希望提供一個由獸醫師親自評估的遠距初診服務，讓飼主能在第一時間了解毛孩的健康狀況與建議處置方式，減少等待與焦慮，為毛孩爭取黃金處置時間。', '我們的獸醫顧問群', '本平台邀集來自不同領域的獸醫師與寵物照護顧問，共同設計問診流程與照護內容。我們相信，每隻毛孩的健康都值得被理解與尊重，因此診療方式不應只限於實體就診。我們致力於建立一個線上與線下互補的照護模式，讓更多毛孩與家庭受惠。', '誰適合使用這項服務？', '我們的服務特別適合：➤ 剛接回家的幼貓幼犬需要健康初步篩檢 ➤ 後續回診不便的術後毛孩 ➤ 無法外出就醫的老齡毛孩 ➤ 臨時狀況不明的毛孩家長需要評估與建議。我們提供的不是取代面診的服務，而是幫助飼主「判斷是否需要立即就醫」，讓照護更有效率、更人性化。', '003.jpg'),
(2, 'PurrMedi 毛孩遠距照護平台', '全台首創毛孩視訊診療整合系統', '🐾 為什麼創立這個平台？', '為了解決飼主外出不便、毛孩緊急狀況無法即時就診的問題，PurrMedi 提供遠端初步評估服務，快速掌握毛孩狀況。', '🐾 我們的專業團隊', '平台聚集多位獸醫師、寵物護理師與行為諮詢師，提供跨領域整合諮詢，給你與毛孩最安心的照護。', '🐾 適合什麼樣的毛孩？', '怕生、不喜歡出門、交通不便、術後復原中的毛孩皆適用。讓毛孩在熟悉環境中完成初步診療。', '003.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `purr_admin`
--

CREATE TABLE `purr_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc` varchar(100) NOT NULL COMMENT '會員帳號',
  `pw` varchar(100) NOT NULL COMMENT '會員密碼',
  `email` varchar(150) NOT NULL COMMENT '聯絡信箱',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '註冊時間'
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

--
-- 傾印資料表的資料 `purr_booking`
--

INSERT INTO `purr_booking` (`id`, `user_id`, `name`, `email`, `tel`, `line_id`, `city`, `pet_count`, `available_time`, `img`, `issue`, `status`, `created_at`) VALUES
(12, '1', 'dw', 'dwd@dwedw', 'dwdw', 'dw', 'dwdw', 2, '晚上', '', 'd', 0, '2025-08-15 04:21:53'),
(14, '1', 'dede', 'dedde@deded', 'deded', 'dede', 'eedede', 1, '早上', '', 'de', 0, '2025-08-15 04:26:59'),
(15, '1', 'd', 'd@d', 'd', 'd', 'd', 1, '早上', '', '', 0, '2025-08-15 05:06:24');

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

--
-- 傾印資料表的資料 `purr_images`
--

INSERT INTO `purr_images` (`id`, `img`, `text`, `sh`) VALUES
(9, '001.jpg', '', 1),
(10, '002.jpg', '', 1),
(11, '003.jpg', '', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `purr_users`
--

CREATE TABLE `purr_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc` varchar(100) NOT NULL COMMENT '會員帳號',
  `pw` varchar(100) NOT NULL COMMENT '會員密碼',
  `email` varchar(150) NOT NULL COMMENT '聯絡信箱',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '註冊時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `purr_users`
--

INSERT INTO `purr_users` (`id`, `acc`, `pw`, `email`, `created_at`) VALUES
(1, 'test', 'test', 'test', '2025-08-15 03:35:09');

-- --------------------------------------------------------

--
-- 資料表結構 `purr_user_profile`
--

CREATE TABLE `purr_user_profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(100) NOT NULL COMMENT '對應 purr_users.acc',
  `name` varchar(100) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `line_id` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `purr_user_profile`
--

INSERT INTO `purr_user_profile` (`id`, `user_id`, `name`, `tel`, `line_id`, `city`, `updated_at`) VALUES
(1, '1', 'd', 'd', 'd', 'd', '2025-08-15 05:06:24');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `purr_about`
--
ALTER TABLE `purr_about`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `purr_admin`
--
ALTER TABLE `purr_admin`
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
-- 資料表索引 `purr_user_profile`
--
ALTER TABLE `purr_user_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purr_about`
--
ALTER TABLE `purr_about`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purr_admin`
--
ALTER TABLE `purr_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purr_booking`
--
ALTER TABLE `purr_booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purr_images`
--
ALTER TABLE `purr_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purr_users`
--
ALTER TABLE `purr_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purr_user_profile`
--
ALTER TABLE `purr_user_profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
