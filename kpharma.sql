-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2023 at 02:23 PM
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
-- Database: `kpharma`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_quantity` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `c_id` int(11) NOT NULL,
  `c_title` varchar(399) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`c_id`, `c_title`) VALUES
(1, 'Toys'),
(2, 'Clothes'),
(4, 'Shoes'),
(5, 'Nutrients'),
(6, 'Body Care');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `order_quantity` int(11) NOT NULL,
  `Order_Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `users_id`, `order_quantity`, `Order_Date`) VALUES
(87, 54, 40, 1, '2023-09-29 13:18:49'),
(88, 54, 41, 1, '2023-09-29 15:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `categories` varchar(227) NOT NULL,
  `product_name` varchar(225) DEFAULT NULL,
  `product_price` varchar(225) DEFAULT NULL,
  `product_img` varchar(225) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `descriptions` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categories`, `product_name`, `product_price`, `product_img`, `c_id`, `descriptions`) VALUES
(54, '', 'Doll', '15', 'Doll.jpg', 1, 'A small model of a human figure that is used as a child’s toy.'),
(55, '', 'Toy-car', '5', 'Toy-Car.jpg', 1, 'A miniature, non-functioning replica of a car.'),
(56, '', 'Aeroplane', '10', 'Toy-Aeroplane.jpg', 1, 'A miniature, non-functioning replica of an aeroplane.'),
(57, '', 'Cotton Caps', '5', 'Cotton-Caps.jpg', 2, 'For Age: 4-5 yrs , Unisex , Pure sheep cotton used. '),
(58, '', 'Trench Coat', '12', 'Trench-Coat.jpg', 2, 'For: 4-5 yrs , Female , Made of Cotton , Premium Quality.'),
(59, '', 'SweatShirt', '11', 'Sweatshirt.jpg', 2, 'For: 6-7yrs , Size: medium , Mickey Mouse printed.'),
(60, '', 'Velcro Sandal', '14', 'Velcro Sandal.jpg', 4, 'For Age: 4-5 yrs , Female , Stylish Premium Sandals.'),
(61, '', 'Sports Shoe', '17', 'Sports-Shoes.jpg', 4, 'For Age: 4-5 yrs , Unisex , Perfect Pair For Your Child. '),
(62, '', 'Star Shoe', '8', 'Star-Shoes.jpg', 4, 'For: 6-7yrs , Unisex, Star printed and dark pink.'),
(63, '', 'Nestum', '5', 'Nestum.jpg', 5, 'For: 2-5 yrs, Nestle Nestum Serve with milk .'),
(64, '', 'Lactogen', '6', 'lactogen.jpg', 5, 'For: 2-5 yrs, Nestle Lactogen Serve with milk .'),
(65, '', 'Cerelac', '5', 'Cerelac.jpg', 5, 'For: 1-5 yrs, Nestle Cerelac Serve with milk .'),
(66, '', 'Coffee Scrub', '12', 'Coffee Coconut Scrub.jpg', 6, 'Pure Coffee Coconut Scrub for your kid to good skin.'),
(68, '', 'Lotion', '10', 'Cetaphil_lotion.jpg', 6, 'Cetaphil lotion for mosturizing and soft skin.'),
(69, '', 'RoseGold Oil', '10', 'Rose Gold Oil.jpg', 6, 'Oil for good smell and soft skin for your child.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `UserRole` varchar(10) NOT NULL,
  `Phone_No` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Email`, `Password`, `Age`, `UserRole`, `Phone_No`) VALUES
(3, 'Bisham Thapa', 'bishamthapa@gmail.com', 'bisham12', 20, 'Admin', '9840203991'),
(4, 'Anish Gurung', 'Anishgurung@gmail.com', 'anish12', 20, 'Admin', '9812654788'),
(40, 'ram thapa', 'ramthapa@gmail.com', 'ramthapa@123', 21, 'user', '9855662233'),
(41, 'chiran thapa', 'chiranthapa@gmail.com', 'chiran@123', 22, 'user', '9842532568'),
(42, 'Naresh Khatri', 'nareshkhatri@gmail.com', 'naresh@123', 20, 'user', '9852361458');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`ID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `categories` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
