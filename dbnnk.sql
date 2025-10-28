-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 01:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbnnk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `ProductID` int(255) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcart`
--

INSERT INTO `tblcart` (`ProductID`, `Name`, `Image`, `Price`, `Username`) VALUES
(14, 'Tulip', 'image/tulip.jpg', 80, 'loyd');

-- --------------------------------------------------------

--
-- Table structure for table `tblflower`
--

CREATE TABLE `tblflower` (
  `ProductID` int(11) NOT NULL,
  `Item_name` varchar(50) NOT NULL,
  `Item_price` int(100) NOT NULL,
  `Item_image` varchar(100) NOT NULL,
  `Item_description` varchar(200) NOT NULL,
  `Item_category` varchar(50) NOT NULL,
  `Current_quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblflower`
--

INSERT INTO `tblflower` (`ProductID`, `Item_name`, `Item_price`, `Item_image`, `Item_description`, `Item_category`, `Current_quantity`) VALUES
(10, 'Lily', 80, 'image/d.jpg', 'Lilies, with their pristine white petals, symbolize purity and innocence.', 'Flower', 20),
(11, 'Headband', 90, 'image/8.jpg', 'Enhance your style and fashion with these handmade headbands that are perfect for every day!', 'Headband', 45),
(12, 'Minion', 50, 'image/7.jpg', 'Style your bags, wallets, keys, with these cute crochet keychains.', 'Keychain', 21),
(13, 'Bag', 499, 'image/6.jpg', 'Discover the perfect blend of style and functionality with our Handcrafted Crochet Sling Bag', 'Bag', 9),
(14, 'Tulip', 80, 'image/ugyde.jpg', 'Tulips symbolize perfect love and affection.', 'Flower', 33),
(16, 'Rose', 90, 'image/ss.jpg', 'Rose flowers are symbols of love, purity, and devotion.', 'Flower', 23),
(17, 'Lily of the Valley', 100, 'image/sdx.jpg', 'The Lily of the Valley, with its delicate blossoms and subtle fragrance, embodies multiple layers of symbolism.', 'Flower', 23),
(18, 'Kokak ', 120, 'image/djjd.jpg', 'Enhance your style and fashion with these handmade headbands that are perfect for every day!', 'Headband', 64),
(19, 'Plain', 80, 'image/od.jpg', 'Enhance your style and fashion with these handmade headbands that are perfect for every day!', 'Headband', 23),
(20, 'Flower', 90, 'image/1okpcd0.jpg', 'Enhance your style and fashion with these handmade headbands that are perfect for every day!', 'Headband', 23),
(21, 'Cat', 120, 'image/bkit.png', 'Enhance your style and fashion with these handmade headbands that are perfect for every day!', 'Headband', 54),
(22, 'Flower Bandana', 120, 'image/1okpcd0.jpg', 'Enhance your style and fashion with these handmade headbands that are perfect for every day!', 'Headband', 12),
(23, 'Grandma', 90, 'image/iws.jpg', 'Enhance your style and fashion with these handmade headbands that are perfect for every day!', 'Headband', 32),
(24, 'Leaf', 90, 'image/2.jpg', 'Enhance your style and fashion with these handmade headbands that are perfect for every day!', 'Headband', 24),
(25, 'Plain Bandana', 120, 'image/ja.png', 'Enhance your style and fashion with these handmade headbands that are perfect for every day!', 'Headband', 23),
(26, 'Heady', 80, 'image/u.png', 'Enhance your style and fashion with these handmade headbands that are perfect for every day!', 'Headband', 44),
(27, 'Lavander', 50, 'image/ye.png', 'Style your bags, wallets, keys, with these cute crochet keychains.', 'Keychain', 12),
(28, 'Pencil', 50, 'image/5.jpg', 'Style your bags, wallets, keys, with these cute crochet keychains.', 'Keychain', 45),
(29, 'Ms.Duckling', 120, 'image/10.jpg', 'Style your bags, wallets, keys, with these cute crochet keychains.', 'Keychain', 45),
(30, 'Boy Bear', 120, 'image/12.jpg', 'Style your bags, wallets, keys, with these cute crochet keychains.', 'Keychain', 34),
(31, 'Mr.Cow', 120, 'image/13.jpg', 'Style your bags, wallets, keys, with these cute crochet keychains.', 'Keychain', 54),
(32, 'Girl Bear', 120, 'image/9.jpg', 'Style your bags, wallets, keys, with these cute crochet keychains.', 'Keychain', 23),
(33, 'Couple Bears', 220, 'image/cb.png', 'Style your bags, wallets, keys, with these cute crochet keychains.', 'Keychain', 56),
(34, 'Little Bee', 50, 'image/14.jpg', 'Style your bags, wallets, keys, with these cute crochet keychains.', 'Keychain', 77),
(35, 'Grizzly', 50, 'image/1.jpg', 'Style your bags, wallets, keys, with these cute crochet keychains.', 'Keychain', 88),
(36, 'Green Tumbler Bag', 120, 'image/11.jpg', 'Protect your tumbler from getting dents and scratches with this crochet tumbler holder.', 'Bag', 1),
(37, 'Sky', 120, 'image/oo.png', 'Protect your tumbler from getting dents and scratches with this crochet tumbler holder.', 'Bag', 1),
(38, 'Violet Tumbler Bag', 120, 'image/4.jpg', 'Protect your tumbler from getting dents and scratches with this crochet tumbler holder.', 'Bag', 2),
(39, 'Wallet', 100, 'image/3.jpg', 'for your coins', 'Bag', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblreview`
--

CREATE TABLE `tblreview` (
  `ReviewID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Comment` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblreview`
--

INSERT INTO `tblreview` (`ReviewID`, `Username`, `Email`, `Comment`) VALUES
(1, 'Jan Lloyd', 'itsmejanloydcagoco@gmail.com', 'kinana nga comprog'),
(4, 'Mylene Lumanit', '', 'I love itttt');

-- --------------------------------------------------------

--
-- Table structure for table `tblship`
--

CREATE TABLE `tblship` (
  `ShipID` int(11) NOT NULL,
  `Costumer` varchar(100) NOT NULL,
  `item` varchar(255) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `PaymentOption` varchar(50) NOT NULL,
  `ShipCost` int(20) NOT NULL,
  `TotalCost` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblship`
--

INSERT INTO `tblship` (`ShipID`, `Costumer`, `item`, `Address`, `PaymentOption`, `ShipCost`, `TotalCost`) VALUES
(7, 'loyd', 'Lily', 'Tallang, Baggao, Cagayan', 'Cash on delivery', 30, 529),
(8, 'loyd', 'Headband', 'J. Pallagao, Baggao, Cagayan', 'Cash on delivery', 40, 539),
(9, 'loyd', 'Headband', 'Remus, Baggao, Cagayan', 'Cash on delivery', 50, 549),
(11, 'loyd', 'Tulip ', 'Tallang, Baggao, Cagayan', 'Online payment', 30, 110),
(12, 'loyd', 'Tulip ', 'Tallang, Baggao, Cagayan', 'Cash on delivery', 30, 110),
(13, 'loyd', 'Tulip', '', 'payment', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `AccessLevel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`UserID`, `Username`, `Password`, `AccessLevel`) VALUES
(4, 'loyd', '12345', 'User'),
(5, 'rakel', '12345678', 'User'),
(6, 'loydie', '12345678', 'Admin'),
(7, 'Jan Lloyd', '12345', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblflower`
--
ALTER TABLE `tblflower`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `tblreview`
--
ALTER TABLE `tblreview`
  ADD PRIMARY KEY (`ReviewID`);

--
-- Indexes for table `tblship`
--
ALTER TABLE `tblship`
  ADD PRIMARY KEY (`ShipID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblflower`
--
ALTER TABLE `tblflower`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tblreview`
--
ALTER TABLE `tblreview`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblship`
--
ALTER TABLE `tblship`
  MODIFY `ShipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
