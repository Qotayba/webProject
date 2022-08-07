-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2022 at 12:59 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `orderId` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`orderId`, `barcode`, `quantity`) VALUES
(19, '3', 1),
(19, '32', 1),
(21, '26', 1),
(23, '12', 3),
(23, '19', 2),
(23, '32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `mobNum` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `aFromUser` text NOT NULL,
  `aFromAdmin` text NOT NULL,
  `tPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderId`, `userName`, `mobNum`, `location`, `aFromUser`, `aFromAdmin`, `tPrice`) VALUES
(12, 'qotayba', '0505050505', '1515151', '1', '1', 5588),
(13, 'qotayba', '0555', '5555', '1', '1', 5588),
(14, '123', '059505950', '123', '1', '1', 11444),
(15, '1', '0595059', 'فعلاشس', '1', '1', 5588),
(18, 'qotayba', '0505050505', 'nablus', '1', '1', 6344),
(19, 'qotayba', '0', '0', '0', '0', 0),
(21, 'newnew', '05050505', '15', '1', '1', 90),
(23, 'newnew', '0598520816', 'nablus', '1', '1', 507);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `barcode` varchar(50) NOT NULL,
  `pName` varchar(50) NOT NULL,
  `pFor` varchar(50) NOT NULL,
  `pType` varchar(50) NOT NULL,
  `pCost` varchar(50) NOT NULL,
  `pPrice` varchar(50) NOT NULL,
  `pQuantity` int(11) NOT NULL,
  `QunSold` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `pImg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`barcode`, `pName`, `pFor`, `pType`, `pCost`, `pPrice`, `pQuantity`, `QunSold`, `profit`, `pImg`) VALUES
('1', 'andri suits', 'men', 'Suits', '12', '100', 12123, 0, 0, '1.jpg'),
('11', 'ww', 'women', 'Jeans', '33', '55', 50, 0, 0, '11.jpg'),
('12', 'slim jeans', 'women', 'Jeans', '55', '89', 76, 9, 306, '12.jpg'),
('13', 'selvet slim fit', 'women', 'Jeans', '12', '112', 85, 0, 0, '13.jpg'),
('17', 'Raya shoes', 'women', 'Shoes', '12', '13', 80, 0, 0, '17.jpg'),
('19', 'G shoes', 'women', 'Shoes', '50', '80', 471, 6, 180, '19.jpg'),
('20', 'Verity', 'men', 'Shoes', '13', '20', 50, 0, 0, '20.jpg'),
('21', 'luis', 'women', 'Shoes', '12', '90', 80, 0, 0, '21.jpg'),
('25', 'yarn shirt', 'women', 'Shirts', '50', '90', 80, 0, 0, '25.jpg'),
('26', 'ch shirt', 'women', 'Shirts', '50', '90', 51, 1, 40, '26.jpg'),
('29', 'awsoem', 'men', 'Shirts', '12', '31', 50, 0, 0, '29.jpg'),
('3', 'Denim Jeans.jpg', 'women', 'Jeans', '95', '656', 65, 0, 0, '3.jpg'),
('30', 'Nike s', 'men', 'Shirts', '20', '50', 23, 0, 0, '30.jpg'),
('31', 'Black black', 'men', 'Shirts', '50', '80', 50, 0, 0, '31.jpg'),
('32', 'tay', 'men', 'Shirts', '55', '80', 55, 3, 75, '32.jpg'),
('33', 'helllo shirt', 'men', 'Shirts', '22', '65', 50, 0, 0, '33.jpg'),
('4', 'high Rise', 'women', 'Jeans', '65', '88', 65, 0, 0, '4.webp'),
('46', 'amy suits', 'women', 'Suits', '12', '41', 12, 0, 0, '46.jpg'),
('47', 'Qadri suit', 'men', 'Suits', '65', '100', 65, 0, 0, '47.jpg'),
('48', 'wake up suits', 'men', 'Suits', '312', '444', 65, 0, 0, '48.jpg'),
('65', 'gray suit', 'men', 'Suits', '60', '80', 1212, 0, 0, '65.jpg'),
('7', 'levil\'s', 'women', 'Jeans', '11', '11', 12, 0, 0, '7.jpg'),
('9', 'Loose Jeans', 'women', 'Jeans', '22', '33', 55, 0, 0, '9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userName` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `userLevel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userName`, `email`, `password`, `userLevel`) VALUES
('09383', 'qotayba.darawshi@gmail.com', '123', '0'),
('1', '', '1', '1'),
('12', 'qotayba.darawshi@gmail.com', '323', '1'),
('121', 'qotayba.darawshi@gmail.com', '12', '1'),
('123', 'qotayba.darawshi@gmail.com', '444', '0'),
('1238889898', 'qotayba.darawshi@gmail.com', '312123', '0'),
('13123123', 'qotayba.darawshi@gmail.com', '123', '0'),
('131321', 'qotayba.darawshi@gmail.com', '1132', '0'),
('2134', 'qotayba.darawshi@gmail.com', '41231234', '0'),
('23', '3', '356a192b7913b04c54574d18c28d46e6395428ab', '1'),
('8494', 'qotayba.darawshi@hotmail.com', '1234321', '0'),
('89', 'qotayba.darawshi@gmail.com', '89', '0'),
('haithm ', 'qotayba.darawshi@hotmail.com', '12', '1'),
('j', 'qotayba.darawshi@hotmail.com', '23', '0'),
('new admin', 'qotayba.darawshi@hotmail.com', '23', '1'),
('newnew', 'qotayba.darawshi@gmail.com', '8585', '0'),
('qotayba', 'qotayba.darawshi@gmail.com', '312321', '0'),
('qotayba1', 'qotayba.darawshi@gmail.com', '312', '0'),
('qotqtqotq', 'qotayba.darawshi@gmail.com', '1515', '0'),
('qwe12', 'qotayba.darawshi@gmail.com', '123', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`orderId`,`barcode`),
  ADD KEY `cart_ibfk_2` (`barcode`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `userName` (`userName`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`barcode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`barcode`) REFERENCES `products` (`barcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `users` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
