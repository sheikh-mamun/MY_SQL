-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2024 at 12:30 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_manufacture` (`mname` VARCHAR(20), `mcontact` VARCHAR(20))   begin 
insert into manufacturer(name,contact)values(mname,mcontact);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_product` (`pname` VARCHAR(20), `price` DOUBLE(10,2), `m_id` INT(10))   begin 
insert into product(name,price,manufac_id)values(pname,price,m_id);
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `highest_price_view`
-- (See below for the actual view)
--
CREATE TABLE `highest_price_view` (
`id` int(10)
,`name` varchar(20)
,`price` double(10,2)
,`manufac_id` int(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `contact`) VALUES
(1, 'Samsung', '01874874587'),
(2, 'LG', '01974874584'),
(3, 'Redmi', '01574874874'),
(5, 'Toshiba', '0167845874');

--
-- Triggers `manufacturer`
--
DELIMITER $$
CREATE TRIGGER `ad_manufacturer` AFTER DELETE ON `manufacturer` FOR EACH ROW begin 
delete from product where manufac_id = old.id ;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `manufac_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `manufac_id`) VALUES
(1, 'Monitor', 8000.00, 1),
(2, 'Mobile', 28000.00, 3),
(3, 'USB Drive', 720.00, 5);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_product`
-- (See below for the actual view)
--
CREATE TABLE `view_product` (
`id` int(10)
,`name` varchar(20)
,`price` double(10,2)
,`manme` varchar(20)
,`contact` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `highest_price_view`
--
DROP TABLE IF EXISTS `highest_price_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `highest_price_view`  AS SELECT `product`.`id` AS `id`, `product`.`name` AS `name`, `product`.`price` AS `price`, `product`.`manufac_id` AS `manufac_id` FROM `product` WHERE `product`.`price` > 5000 ;

-- --------------------------------------------------------

--
-- Structure for view `view_product`
--
DROP TABLE IF EXISTS `view_product`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_product`  AS SELECT `p`.`id` AS `id`, `p`.`name` AS `name`, `p`.`price` AS `price`, `m`.`name` AS `manme`, `m`.`contact` AS `contact` FROM (`product` `p` join `manufacturer` `m`) WHERE `m`.`id` = `p`.`manufac_id` ;

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
