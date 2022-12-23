-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-12-23 16:47:28
-- 伺服器版本： 10.4.25-MariaDB
-- PHP 版本： 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `專案測試用資料庫`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admins`
--

CREATE TABLE `admins` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(50) NOT NULL,
  `member_phone` varchar(50) DEFAULT NULL,
  `member_birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `admins`
--

INSERT INTO `admins` (`member_id`, `member_name`, `member_phone`, `member_birthday`) VALUES
(1, '陳小小', '', '0000-00-00'),
(2, '王大大', '', '0000-00-00');

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `recipient_name` varchar(50) NOT NULL,
  `recipient_address` varchar(100) NOT NULL,
  `recipient_phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `products_quantiry` int(3) NOT NULL,
  `products_price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `products_id` int(11) NOT NULL,
  `products_name` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL,
  `products_decripttion` varchar(1000) NOT NULL,
  `products_price` int(5) NOT NULL,
  `products_unit` varchar(20) NOT NULL,
  `products_img_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`products_id`, `products_name`, `type_id`, `products_decripttion`, `products_price`, `products_unit`, `products_img_name`) VALUES
(1, '狗飼料', 1, '11111111111111111111111111111111', 100, '800g/包', '0d10974fed68639d91b865814294eb27ef9f9b37.png'),
(2, '狗飼料', 1, '11111111111111111111111111111111', 100, '800g/包', '04366144ba597f7fb31e5e06d077de0b26476f4e.png'),
(3, '狗飼料', 3, '1111111111111111111', 111, '11111', '5005241b8171be864a94791374146c8647f54f6d.png'),
(4, '狗飼料', 3, '1111111111111111111', 111, '11111', 'a862296a5bf142164541f970746e7433d37c0bae.png'),
(5, '123', 1, '0000000000000000000', 100, '800g/包', '2187c1a483b6420e4ba29a4043dc60491befbdf8.png'),
(6, '狗飼料', 1, '1111111111111111111111111111', 299, '1', 'edf558066975a2b2d6634ba2adc8005d6b9f9ee4.png'),
(7, 'K123456', 1, '1111111111111111111', 100, '800g/包', '7b3f47abf94765cb00c03d687be1c6d54aba9601.png');

-- --------------------------------------------------------

--
-- 資料表結構 `products_type`
--

CREATE TABLE `products_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `products_type`
--

INSERT INTO `products_type` (`type_id`, `type_name`) VALUES
(1, '飼料'),
(2, '罐頭'),
(3, '外出繩'),
(4, '耐磨玩具');

-- --------------------------------------------------------

--
-- 資料表結構 `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `member_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `products_quantiry` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`member_id`);

--
-- 資料表索引 `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `member_id` (`member_id`);

--
-- 資料表索引 `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`products_id`),
  ADD KEY `products_id` (`products_id`),
  ADD KEY `type_id` (`type_id`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`products_id`);

--
-- 資料表索引 `products_type`
--
ALTER TABLE `products_type`
  ADD PRIMARY KEY (`type_id`,`type_name`);

--
-- 資料表索引 `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`member_id`,`products_id`),
  ADD KEY `products_id` (`products_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admins`
--
ALTER TABLE `admins`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products_type`
--
ALTER TABLE `products_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `admins` (`member_id`);

--
-- 資料表的限制式 `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`products_id`) REFERENCES `products` (`products_id`),
  ADD CONSTRAINT `order_detail_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `products_type` (`type_id`);

--
-- 資料表的限制式 `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `admins` (`member_id`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`products_id`) REFERENCES `products` (`products_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
