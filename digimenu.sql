-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 05, 2017 at 08:06 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digimenu`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `allocateWaiter`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `allocateWaiter` ()  BEGIN
SELECT staff_id FROM staff WHERE role LIKE "%Waiter";
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `category` varchar(20) NOT NULL,
  `img_src` varchar(300) NOT NULL,
  `cost` int(11) DEFAULT '80',
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`item_id`, `Name`, `description`, `category`, `img_src`, `cost`) VALUES
(4, 'Plain Dosa', 'Yummy plain dosa served with coconut chutney, pudina chutney and sambar.', 'Veg Dosa', 'images/dosa_plain.jpg', 60),
(5, 'Masala Dosa', 'Masala Dosa served with coconut chutney and sambar.', 'Veg Dosa', 'images/dosa_masala.jpg', 70),
(6, 'Rava Dosa', 'Rava dosa spiced up with chopped onions, curry leaves and herbs served with ginger pickle or coconut chutney.', 'Veg Dosa', 'images/dosa_rava.jpg', 60),
(7, 'Schezwan Dosa', 'Dosa prepared using special chinese spices and vegetables.', 'Veg Dosa', 'images/dosa3.jpeg', 80),
(8, 'Chicken Dosa', 'Masala dosa served with chicken curry.', 'Non Veg Dosa', 'images/dosa2.jpg', 100),
(9, 'Paneer Dosa', 'Dosa stuffed with paneer and special green masala served with tomato pickle.', 'Veg Dosa', 'images/dosa1.jpg', 80),
(10, 'Veg Burger', 'Veg and cheese burger served with fries.', 'Veg Burger', 'images/burger7.jpg', 100),
(11, 'Sizzling Burger', 'A Chicken burger prepared with Dalston chillies. Dangerously spicy.', 'Non Veg Burger', 'images/burger5.jfif', 120),
(12, 'Mega Mutton', 'Delicious Burger stuffed with onions, lettuce and copious amounts of mutton.', 'Non Veg Burger', 'images/main_background.png', 140),
(13, 'Glazed Bun', 'Chicken Burger made using glazed buns. Tastes as good as it sounds.', 'Non Veg Burger', 'images/main4.jpg', 160),
(14, 'Cookie Milkshake', 'Choco chip cookie milkshake with vanilla ice cream topping.', 'Beverage', 'images/Milkshake-6.jpg', 150),
(15, 'Chocolate', 'The best and original chocolate milkshake.', 'Beverage', 'images/chocolate-milk.jpg', 120),
(16, 'Strawberry', 'Best and Original strawberry milkshake.', 'Beverage', 'images/straws-milkshake.jpeg', 120),
(17, 'Nuggets & Fries', 'Chicken Nuggets and french fries.', 'Sides', 'images/sides1.jpg', 80),
(18, 'Spring rolls', 'Vegetarian spring rolls.', 'Sides', 'images/sides2.jpg', 80),
(19, 'Cutlet', 'Crunchy Veg cutlet.', 'Sides', 'images/sides3.jpg', 80),
(20, 'Beetroot & Chicken', 'Burger stuffed with beetroot, chicken and special onion sauce with melted cheese.', 'Non Veg Burger', 'images/main3_edit.jpg', 180),
(21, 'Fish & chips', 'Burger stuffed with fried fish and chips served on the side.', 'Non Veg Burger', 'images/burger8.jpg', 160),
(22, 'Roasted Chicken', 'Burger stuffed with roasted chicken and melted cheese. Served with fries.', 'Non Veg Burger', 'images/burger1.jpg', 160),
(23, 'Supreme Veg', 'Vegetarian burger with Aloo patty, onion sauce and melted cheese.', 'Veg Burger', 'images/burger3.jpg', 170);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_no` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `table_no` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `Preference` varchar(3000) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`order_no`,`item_id`) USING BTREE,
  KEY `OFK` (`table_no`),
  KEY `ORFK` (`item_id`),
  KEY `ORFK2` (`staff_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Triggers `orders`
--
DROP TRIGGER IF EXISTS `ord_update`;
DELIMITER $$
CREATE TRIGGER `ord_update` AFTER INSERT ON `orders` FOR EACH ROW UPDATE tables SET order_no = NEW.order_no WHERE table_no = NEW.table_no
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `phone` varchar(11) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `role`, `phone`) VALUES
(1, 'Kartik', 'Head Chef', '8971855354'),
(2, 'Shruti', 'Sous Chef', '891821314'),
(3, 'Samuel', 'Waiter', '9918212111'),
(4, 'Ronald', 'Waiter', '928282112'),
(5, 'Uma Shankari', 'Head Chef', '78112217113'),
(6, 'Nithin', 'Manager', '98121234646'),
(7, 'Sharanya', 'Reservation Manager', '8973236134'),
(8, 'Nikhil', 'Waiter', '8744742321'),
(9, 'Andrew', 'Waiter', '7858232116');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `table_no` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `order_no` int(11) DEFAULT NULL,
  `preferences` varchar(3000) DEFAULT NULL,
  `waiter_name` varchar(30) DEFAULT NULL,
  `table_code` varchar(10) NOT NULL,
  PRIMARY KEY (`table_no`),
  KEY `TFK` (`order_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_no`, `name`, `order_no`, `preferences`, `waiter_name`, `table_code`) VALUES
(1, NULL, NULL, NULL, NULL, '01ABC'),
(2, NULL, NULL, NULL, NULL, '02SUP'),
(3, NULL, NULL, NULL, NULL, '03UMA'),
(4, NULL, NULL, NULL, NULL, '04HEL'),
(5, NULL, NULL, NULL, NULL, '05YOY'),
(6, NULL, NULL, NULL, NULL, '06LOL'),
(7, NULL, NULL, NULL, NULL, '07MEG'),
(8, NULL, NULL, NULL, NULL, '08WWW'),
(9, NULL, NULL, NULL, NULL, '09DNS'),
(10, NULL, NULL, NULL, NULL, '10CER'),
(11, NULL, NULL, NULL, NULL, '11AWE'),
(12, NULL, NULL, NULL, NULL, '12CND');

-- --------------------------------------------------------

--
-- Table structure for table `waitlist`
--

DROP TABLE IF EXISTS `waitlist`;
CREATE TABLE IF NOT EXISTS `waitlist` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
