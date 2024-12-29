-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 09:19 PM
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
-- Database: `car_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `car_model` varchar(50) NOT NULL,
  `car_year` int(11) NOT NULL,
  `car_color` varchar(20) NOT NULL,
  `image_url` text NOT NULL,
  `status` enum('available','rented','out of service') DEFAULT 'available',
  `price_per_day` int(11) NOT NULL,
  `plate_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `car_model`, `car_year`, `car_color`, `image_url`, `status`, `price_per_day`, `plate_id`) VALUES
(1, 'Ferrari', 2021, 'Red', 'ferrari-f8-tributo-review-12-1567758373.jpg', 'rented', 300, ''),
(4, 'Ferrari 911 Turbo S', 2018, 'Silver', 'Image 2024-12-20 at 22.58.18_e3170eda.jpg', 'rented', 200, 'ANU-1'),
(5, 'Dodge SVJ', 2018, 'Black', 'OIP.jpeg', 'available', 400, 'ANU-2'),
(6, 'Batman', 2024, 'black', 'uploads/784f7a74-a71b-425b-aeea-7e8ba80eb0de.webp', 'available', 450, '');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `Office_Name` varchar(100) NOT NULL,
  `Office_ID` int(11) NOT NULL,
  `Office_Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`Office_Name`, `Office_ID`, `Office_Location`) VALUES
('Smouha Office', 1, 'Alex'),
('Smouha Office', 2, 'Alex'),
('Smouha Office', 3, 'Alex');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(11) NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `Payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `cardnumber` varchar(16) NOT NULL,
  `exdate` date NOT NULL,
  `cvv` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `no_of_days`, `Payment_date`, `cardnumber`, `exdate`, `cvv`, `email`) VALUES
(1, 89, '2023-12-31 00:56:38', '55555555', '2023-11-29', 333, 'hema@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `location` varchar(225) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `Office_ID` int(11) NOT NULL,
  `reservation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `user_type` varchar(225) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `address`, `phone`) VALUES
(123123, 'bebo', 'beboorabi7@gmail.com', '43b1ae1ec22a60e03de8932232483b07', 'admin', 'abohommos eldawal', '01093843899'),
(2147483647, 'oraby', 'oraby@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user', 'Abo hommos', '01118438473'),
(2147483647, 'zayed', 'zayed@hacking.com', 'e7d3685715939842749cc27b38d0ccb9706d4d14a5304ef9eee093780eab5df9', 'admin', 'EL darawya', '01277409494');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`Office_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`) USING BTREE,
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `Office_ID` (`Office_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `Office_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`),
  ADD CONSTRAINT `reservations_ibfk_4` FOREIGN KEY (`Office_ID`) REFERENCES `office` (`Office_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
