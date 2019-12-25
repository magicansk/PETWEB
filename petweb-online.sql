-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.8-MariaDB
-- PHP 版本： 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `petweb`
--

CREATE DATABASE if not exists `phpmember` CHARACTER SET utf8 COLLATE utf8_unicode_ci; USE `phpmember`;

-- --------------------------------------------------------

--
-- 資料表結構 `arrival`
--

CREATE TABLE `arrival` (
  `id` int(10) NOT NULL,
  `image` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `h1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `h2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `h3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `arrival`
--

INSERT INTO `arrival` (`id`, `image`, `h1`, `h2`, `h3`, `p1`, `p2`) VALUES
(1, 'images/new001.jpg', '沒藥樹', '毛髮蓬鬆無靜電泡泡洗淨露 180ml', '產品說明', 'Made In Taiwan 台灣製造！', '擁有21項SGS無毒認證並堅持遵循古法融合複合式精油之手打洗劑，嚴選天然精油無毒零污染，弱酸中性溫和且不易滋生細菌可以做精油SPA泡澡，或泡沫停留，經過SGS檢驗，無毒無重金屬殘留等，且不汙染環境。'),
(2, 'images/new002.jpg', '好味小姐', '鮮食調味料（三件組含湯匙）', '產品說明', 'Made In Taiwan 台灣製造！', '鮮食調味料用台灣鮪魚肉，加入各種誘貓香料，台灣產木天蓼、台灣產貓薄荷、荷蘭產起司，無鹽、無香料、無添加，不會造成貓咪身體負擔，用最天然的好味道讓貓咪愛上鮮食。');

-- --------------------------------------------------------

--
-- 資料表結構 `levelbutton`
--

CREATE TABLE `levelbutton` (
  `lb_id` int(11) NOT NULL,
  `href` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#',
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_level` enum('admin','member') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `levelbutton`
--

INSERT INTO `levelbutton` (`lb_id`, `href`, `name`, `m_level`) VALUES
(1, '#', '我的收藏', 'member'),
(2, '#', '訂單明細', 'member'),
(3, 'member_update.php', '修改資料', 'member'),
(4, 'paired.php', '配對系統', 'member'),
(98, '?logout=true', '登出', 'member'),
(6, 'member_admin.php', '會員名單管理', 'admin'),
(7, 'pet_admin.php', '毛孩名單管理', 'admin'),
(8, '#', '購物車資料管理', 'admin'),
(99, '?logout=true', '登出', 'admin');

-- --------------------------------------------------------

--
-- 資料表結構 `memberdata`
--

CREATE TABLE `memberdata` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `m_username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `m_passwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `m_sex` enum('男','女') COLLATE utf8_unicode_ci NOT NULL,
  `m_birthday` date DEFAULT NULL,
  `m_level` enum('admin','member') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'member',
  `m_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_login` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `m_logintime` datetime DEFAULT NULL,
  `m_jointime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `memberdata`
--

INSERT INTO `memberdata` (`m_id`, `m_name`, `m_username`, `m_passwd`, `m_sex`, `m_birthday`, `m_level`, `m_email`, `m_url`, `m_phone`, `m_address`, `m_login`, `m_logintime`, `m_jointime`) VALUES
(25, '系統管理員', 'admin', '$2y$10$/P9G24rH10WjZm0NPYcXgO2yuGqEGKNjHDGrTyuNTKUNet5DGDgIS', '男', '2019-11-29', 'admin', 'admin001@adm.com', NULL, '0912345678', '喵星球', 50, '2019-12-24 15:26:48', '2019-11-29 20:55:27'),
(26, '周杰倫', 'user0001', '$2y$10$WLt9nC0.HwZ.uiADP7kz6.JPX446FR7lFtEco.lO1VEZTZxZaYzby', '男', '2019-02-05', 'member', 'user0001@user0001.com', NULL, '0980354741', '喵星球', 48, '2019-12-24 14:45:50', '2019-12-01 21:06:28'),
(27, '蔡依林', 'user0002', '$2y$10$gqJ/F5FRQ52DEQ1n/OOu6O4GMRUNJuYO66fS.4pWyIIc0gwIaVxnW', '女', '2019-12-30', 'member', 'user0002@user0002.com', NULL, '0980354749', '喵星球囉', 45, '2019-12-24 14:47:59', '2019-12-02 18:44:40'),
(28, '金太妍', 'user0003', '$2y$10$S6JwyaW6O4WSsMwiKHPnoe1F16WOkNWNMZnvGXzFcFl31G/.7./we', '男', '2019-12-30', 'member', 'user0003@user0003.com', NULL, '0980354749', '外太空', 35, '2019-12-24 15:34:25', '2019-12-13 15:31:17'),
(29, '李恩恩', 'user0005', '$2y$10$JsqK.HjfZhEnlG6rrXfq5eJGcPfmEnHoag2jz6nv4JfS4tLjEdWPK', '男', '2019-12-20', 'member', 'user0005@user0005.com', NULL, '0912345678', '外太空', 10, '2019-12-24 08:18:24', '2019-12-20 21:00:04'),
(30, '郭維維', 'user0006', '$2y$10$SvUE31Y4SPuBEiSNQBE44O6UZ8vxq5VOUeHAWbv7OyKoRFZbp5z5a', '男', '2019-12-23', 'member', 'user0006@user0006.com', NULL, '0912345678', '外太空', 6, '2019-12-24 13:49:54', '2019-12-23 14:59:35');

-- --------------------------------------------------------

--
-- 資料表結構 `navbutton`
--

CREATE TABLE `navbutton` (
  `id` int(3) NOT NULL,
  `href` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#',
  `icon` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `navbutton`
--

INSERT INTO `navbutton` (`id`, `href`, `icon`, `name`, `parent_id`) VALUES
(1, 'about.php', 'images/pet.png', '關於培茲', 0),
(2, '#', 'images/news.png', '最新消息', 0),
(3, 'uc.php', 'images/top.png', '銷售排行', 0),
(4, '#', 'images/dog.png', '狗狗專區', 0),
(5, '#', 'images/cat.png', '貓咪專區', 0),
(6, '#', 'images/rabbit.png', '鼠兔專區', 0),
(7, 'knowledgehome.html', 'images/knowledge.png', '毛孩知識', 0),
(8, 'paired.php', 'images/friend.png', '交友系統', 0),
(9, 'https://asms.coa.gov.tw/Amlapp/App/Default.aspx', 'images/collar.png', '認養連結', 0),
(10, 'arrival.php', 'images/newarrival.png', '新品上市', 2),
(11, 'promotions.php', 'images/discount.png', '優惠活動', 2),
(12, 'product_AA.php', 'images/dogdryfood.png', '乾糧專區', 4),
(13, 'product_AB.php', 'images/dogcan.png', '罐頭專區', 4),
(14, 'product_AC.php', 'images/dograwfood.png', '生食專區', 4),
(15, 'product_AD.php', 'images/medicine.png', '營養保健', 4),
(16, 'product_AE.php', 'images/snacks.png', '零嘴專區', 4),
(17, 'product_AF.php', 'images/cloth.png', '寶貝服飾', 4),
(18, 'product_AG.php', 'images/something.png', '其他用品', 4),
(19, 'product_BA.php', 'images/catdryfood.png', '乾糧專區', 5),
(20, 'product_BB.php', 'images/catcan.png', '罐頭專區', 5),
(21, 'product_BC.php', 'images/catrawfood.png', '生食專區', 5),
(22, 'product_BD.php', 'images/medicine.png', '營養保健', 5),
(23, 'product_BE.php', 'images/snacks.png', '零嘴專區', 5),
(24, 'product_BF.php', 'images/cloth.png', '寶貝服飾', 5),
(25, 'product_BG.php', 'images/something.png', '其他用品', 5),
(26, 'product_CA.php', 'images/rabbitfood.png', '兔兒飼料', 6),
(27, 'product_CB.php', 'images/mousefood.png', '小鼠飼料', 6),
(28, 'product_CC.php', 'images/snacks.png', '鼠兔零食', 6),
(29, 'product_CD.php', 'images/something.png', '其他用品', 6);

-- --------------------------------------------------------

--
-- 資料表結構 `paired`
--

CREATE TABLE `paired` (
  `pa_n` int(11) NOT NULL,
  `m_id` int(11) DEFAULT NULL,
  `pa_me` enum('T','F','N') COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `pa_time` datetime NOT NULL,
  `pa_you` enum('T','F','N') COLLATE utf8_unicode_ci DEFAULT 'N',
  `look` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `paired`
--

INSERT INTO `paired` (`pa_n`, `m_id`, `pa_me`, `p_id`, `pa_time`, `pa_you`, `look`) VALUES
(55, 26, 'N', 263, '2019-12-24 11:49:27', 'N', 'N'),
(56, 28, 'N', 264, '2019-12-24 14:39:03', 'N', 'N'),
(57, 27, 'N', 273, '2019-12-24 14:48:10', 'N', 'N');

-- --------------------------------------------------------

--
-- 資料表結構 `petdata`
--

CREATE TABLE `petdata` (
  `p_id` int(5) NOT NULL,
  `p_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_class` enum('貓咪','狗狗') COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_breed` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_sex` enum('男生','女生') COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_age` int(11) DEFAULT NULL,
  `p_introduction` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `petdata`
--

INSERT INTO `petdata` (`p_id`, `p_name`, `p_class`, `p_breed`, `p_sex`, `p_age`, `p_introduction`, `m_id`) VALUES
(263, '屋虎', '狗狗', '比熊犬', '男生', 5, '嗨~我是屋虎唷，平時最喜歡撒嬌囉', 27),
(264, '肚臍', '貓咪', '米克斯', '男生', 3, '哈囉！我是可愛的肚臍弟弟，超愛撒嬌的唷~', 27),
(272, 'ZERO', '貓咪', '黑貴賓', '男生', 5, '嗨~我是ZERO唷', 28),
(275, 'ORANGE', '貓咪', '米克斯', '女生', 2, '嗨~我是橘子唷!!!', 28);

-- --------------------------------------------------------

--
-- 資料表結構 `petphoto`
--

CREATE TABLE `petphoto` (
  `pp_id` int(15) NOT NULL,
  `p_id` int(15) DEFAULT NULL,
  `pp_date` datetime DEFAULT NULL,
  `pp_subject` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pp_picurl` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `petphoto`
--

INSERT INTO `petphoto` (`pp_id`, `p_id`, `pp_date`, `pp_subject`, `pp_picurl`) VALUES
(569, 263, '2019-12-24 11:34:52', '', '263user0002-1.jpg'),
(570, 263, '2019-12-24 11:34:52', '', '263user0002-3.jpg'),
(571, 263, '2019-12-24 11:34:52', '', '263user0002-2.jpg'),
(572, 264, '2019-12-24 11:36:34', '', '264user0003-1.jpg'),
(573, 264, '2019-12-24 11:36:34', '', '264user0003-2.jpg'),
(574, 264, '2019-12-24 11:36:34', '', '264user0003-3.jpg'),
(594, 272, '2019-12-24 14:40:49', '', '272user0003-4.jpg'),
(595, 272, '2019-12-24 14:40:49', '', '272user0003-5.jpg'),
(596, 272, '2019-12-24 14:40:49', '', '272user0003-6.jpg'),
(627, 275, '2019-12-24 15:32:48', '', '275310user0001-1.jpeg'),
(628, 275, '2019-12-24 15:32:49', '', '275434user0001-2.jpeg'),
(629, 275, '2019-12-24 15:32:49', '', '275782user0001-3.jpeg');

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `_paired_pets_mem`
-- (請參考以下實際畫面)
--
CREATE TABLE `_paired_pets_mem` (
`pa_n` int(11)
,`m_id` int(11)
,`pa_me` enum('T','F','N')
,`p_id` int(11)
,`p_name` varchar(20)
,`pmid` int(11)
,`pa_you` enum('T','F','N')
,`m_name` varchar(20)
,`m_email` varchar(100)
,`m_phone` varchar(100)
,`look` enum('Y','N')
);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `_pet_mem`
-- (請參考以下實際畫面)
--
CREATE TABLE `_pet_mem` (
`p_id` int(5)
,`p_name` varchar(20)
,`p_class` enum('貓咪','狗狗')
,`p_breed` varchar(20)
,`p_sex` enum('男生','女生')
,`p_age` int(11)
,`p_introduction` varchar(100)
,`m_id` int(11)
,`m_name` varchar(20)
,`m_email` varchar(100)
,`m_phone` varchar(100)
);

-- --------------------------------------------------------

--
-- 檢視表結構 `_paired_pets_mem`
--
DROP TABLE IF EXISTS `_paired_pets_mem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_paired_pets_mem`  AS  select `pa`.`pa_n` AS `pa_n`,`pa`.`m_id` AS `m_id`,`pa`.`pa_me` AS `pa_me`,`pa`.`p_id` AS `p_id`,`pd`.`p_name` AS `p_name`,`pd`.`m_id` AS `pmid`,`pa`.`pa_you` AS `pa_you`,`md`.`m_name` AS `m_name`,`md`.`m_email` AS `m_email`,`md`.`m_phone` AS `m_phone`,`pa`.`look` AS `look` from ((`paired` `pa` join `petdata` `pd`) join `memberdata` `md`) where `pa`.`p_id` = `pd`.`p_id` and `pd`.`m_id` = `md`.`m_id` ;

-- --------------------------------------------------------

--
-- 檢視表結構 `_pet_mem`
--
DROP TABLE IF EXISTS `_pet_mem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `_pet_mem`  AS  select `pd`.`p_id` AS `p_id`,`pd`.`p_name` AS `p_name`,`pd`.`p_class` AS `p_class`,`pd`.`p_breed` AS `p_breed`,`pd`.`p_sex` AS `p_sex`,`pd`.`p_age` AS `p_age`,`pd`.`p_introduction` AS `p_introduction`,`md`.`m_id` AS `m_id`,`md`.`m_name` AS `m_name`,`md`.`m_email` AS `m_email`,`md`.`m_phone` AS `m_phone` from (`petdata` `pd` join `memberdata` `md`) where `pd`.`m_id` = `md`.`m_id` ;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `arrival`
--
ALTER TABLE `arrival`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `memberdata`
--
ALTER TABLE `memberdata`
  ADD PRIMARY KEY (`m_id`),
  ADD UNIQUE KEY `m_username` (`m_username`);

--
-- 資料表索引 `paired`
--
ALTER TABLE `paired`
  ADD PRIMARY KEY (`pa_n`);

--
-- 資料表索引 `petdata`
--
ALTER TABLE `petdata`
  ADD PRIMARY KEY (`p_id`);

--
-- 資料表索引 `petphoto`
--
ALTER TABLE `petphoto`
  ADD PRIMARY KEY (`pp_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `arrival`
--
ALTER TABLE `arrival`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `memberdata`
--
ALTER TABLE `memberdata`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `paired`
--
ALTER TABLE `paired`
  MODIFY `pa_n` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `petdata`
--
ALTER TABLE `petdata`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `petphoto`
--
ALTER TABLE `petphoto`
  MODIFY `pp_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=630;

DELIMITER $$
--
-- 事件
--
CREATE DEFINER=`root`@`localhost` EVENT `sorry` ON SCHEDULE EVERY 24 HOUR STARTS '2019-12-25 00:00:00' ENDS '2020-01-01 00:00:00' ON COMPLETION PRESERVE ENABLE COMMENT '24H' DO DELETE FROM `paired` WHERE `pa_me`='N'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
