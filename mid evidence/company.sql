-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2024 at 11:37 AM
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
-- Database: `company`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_manufacturer` (IN `m_name` VARCHAR(50), IN `m_address` VARCHAR(100), IN `m_contact_no` VARCHAR(50))   BEGIN
    INSERT INTO manufacturer(name, address, contact_no) VALUES (m_name, m_address, m_contact_no);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_product` (IN `p_name` VARCHAR(50), IN `p_price` INT, IN `p_manufacturer_id` INT)   BEGIN
    INSERT INTO Product (name, price, manufacturer_id) VALUES (p_name, p_price, p_manufacturer_id);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `high_price_products`
-- (See below for the actual view)
--
CREATE TABLE `high_price_products` (
`id` int(11)
,`name` varchar(50)
,`price` int(5)
,`manufacturer_id` int(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `address`, `contact_no`) VALUES
(1, 'walton', 'mirpur,dhaka', '017796123874'),
(2, 'lg', 'WEST-SHEWRAPARA,MIRPUR,DHAKA', '01779612381'),
(5, 'SAMSUNG', 'shewrapara', '017796123874'),
(6, 'oppo', 'savar', '56555555'),
(7, 'walton 3', 'WEST-SHEWRAPARA,MIRPUR,DHAKA', '017796123874'),
(8, 'hpp', 'WEST-SHEWRAPARA,MIRPUR,DHAKA', '017796123874');

--
-- Triggers `manufacturer`
--
DELIMITER $$
CREATE TRIGGER `add_trigger` AFTER DELETE ON `manufacturer` FOR EACH ROW BEGIN
DELETE FROM product WHERE manufacturer_id = old.id;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` int(5) DEFAULT NULL,
  `manufacturer_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `manufacturer_id`) VALUES
(1, 'kamal', 70000, 1),
(2, 'JAMAL', 8000, 2),
(3, 'kamal', 70000, 1),
(4, 'JAMAL', 80000, 5),
(5, 'JAMAL', 80000, 5),
(6, 'ipad', 17000, 6),
(7, 'ipad', 17000, 6),
(8, 'ram', 70000, 8),
(9, 'ram', 70000, 8);

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewcompanydata`
-- (See below for the actual view)
--
CREATE TABLE `viewcompanydata` (
`id` int(11)
,`name` varchar(50)
,`address` varchar(100)
,`contact_no` varchar(50)
,`pid` int(11)
,`pname` varchar(50)
,`price` int(5)
,`manufacturer_id` int(10)
);

-- --------------------------------------------------------

--
-- Structure for view `high_price_products`
--
DROP TABLE IF EXISTS `high_price_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `high_price_products`  AS SELECT `product`.`id` AS `id`, `product`.`name` AS `name`, `product`.`price` AS `price`, `product`.`manufacturer_id` AS `manufacturer_id` FROM `product` WHERE `product`.`price` > 5000 ;

-- --------------------------------------------------------

--
-- Structure for view `viewcompanydata`
--
DROP TABLE IF EXISTS `viewcompanydata`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewcompanydata`  AS SELECT `manufacturer`.`id` AS `id`, `manufacturer`.`name` AS `name`, `manufacturer`.`address` AS `address`, `manufacturer`.`contact_no` AS `contact_no`, `product`.`id` AS `pid`, `product`.`name` AS `pname`, `product`.`price` AS `price`, `product`.`manufacturer_id` AS `manufacturer_id` FROM (`manufacturer` join `product`) WHERE `manufacturer`.`id` = `product`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manufacturer_id` (`manufacturer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
