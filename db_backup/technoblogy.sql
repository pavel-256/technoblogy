-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2019 at 07:08 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `technoblogy`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `category` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `article`, `category`, `date`) VALUES
(19, 3, 'Lenovo ThinkPad Leptop 2019', 'X1 Carbon Gen 7\r\n\r\nStyled for premium performance\r\nA sleeker and lighter version of itself, the ThinkPad X1 Carbon Gen 7 laptop kicks up the style quotient with an optional Carbon-Fiber Weave top cover. Weâ€™ve also amped up protection with our built-in suite of ThinkShield security features to safeguard your data. Powered by IntelÂ® Coreâ„¢ technology, this device delivers high performanceâ€”while the 18.3-hour battery life enables easy productivity on the fly.', 'Computers', '2019-10-09 10:24:18'),
(36, 15, 'Adult freestyle folding  electric e kick scooter ', 'Place of Origin: \r\nZhejiang, China\r\nBrand Name: \r\nUKAYE\r\nModel Number: \r\nU1\r\nPower: \r\n300W\r\nVoltage: \r\n36v\r\nCertification: \r\nCE,FCC,ROHS,EMC\r\nCharging Time: \r\n3-5h\r\nFoldable: \r\nYes\r\nRange Per Charge: \r\n25-30km\r\nTire Size: \r\n8 inches\r\nName: \r\nAdult freestyle folding elektrik electric e kick scooter\r\nVehicle Body Material: \r\nAluminium alloy\r\nUnfolding size: \r\n103.5*41.5*97.6cm\r\nFolding size: \r\n32.8*41.5*97.6cm\r\nNet Weight: \r\n13.5Kg\r\nBattery Capacity: \r\n36v 7.8ah lithium battery\r\nMaximum Load: \r\n150KG\r\nMax.Speed: \r\n25Km/h\r\nMotor Rated Power: \r\n300w brushless hub moter\r\nOther: \r\nUSB charging port', 'Electric Scooters', '2019-10-14 10:24:02'),
(37, 17, 'Samsung Galaxy A50 64GB', 'Wireless Carrier\r\nUnlocked\r\nBluetooth\r\nv5.0\r\nMemory - Built-in\r\n64 GB\r\nRAM Size\r\n4GB\r\nPhone Operating System\r\nAndroid 9.0 (Pie)\r\nSIM Card\r\nNano SIM\r\nBattery Type\r\n4000 mAH Lithium Ion\r\nConnectivity\r\nWi-Fi\r\nWi-Fi a/b/g/n/ac 2.4G+5GHz; WiFi Direct\r\nNFC\r\nYes\r\nMobile Pay\r\nYes\r\nWireless Charging\r\nNo\r\nCable Connection Type\r\nUSB Type C\r\nCamera\r\nFront-Facing Camera Resolution\r\n25 MP(F2.0)\r\nRear Camera Resolution\r\n25MP(F1.7) + 5MP(F2.2) + 8MP Ultra Wide (F2.2)\r\nRear Video Capture Resolution\r\nup to 1080p @ 30fps\r\nCamera Flash\r\nYes\r\nDisplay\r\nDisplay Resolution\r\n1080 x 2340\r\nDisplay Size\r\n6.4 in\r\nSensors\r\nFingerprint Scanning\r\nYes\r\nWarranty\r\nManufacturer&#39;s Warranty - Parts\r\n1 Year\r\nManufacturer&#39;s Warranty - Labour\r\n1 Year', 'Cell Phones', '2019-10-14 11:08:38'),
(38, 18, 'Apple - MacBook Air 13.3 inc Laptop with Touch ID', 'Stunning 13.3 inc Retina display with True Tone technology³\r\nTouch ID\r\nDual-core 8th-generation Intel Core i5 processor\r\nIntel UHD Graphics 617\r\nFast SSD storage\r\n8GB memory\r\nStereo speakers with wider stereo sound\r\nTwo Thunderbolt 3 (USB Type-C) ports\r\nUp to 12 hours of battery life¹\r\nLatest Apple-designed keyboard\r\nForce Touch trackpad\r\n802.11ac Wi-Fi\r\nAvailable in gold, space gray, and silver\r\nmacOS Mojave, inspired by pros but designed for everyone, with Dark Mode, Stacks, easier screenshots, useful built-in apps and more\r\nConfigurable processor, memory, and storage options are available\r\n¹ Battery life varies by use and configuration. See www.apple.com/batteries for more information.\r\n² Recycled material claim applies to the enclosure and is based on auditing done by UL LLC.\r\n³ The display size is measured diagonally.', 'Computers', '2019-10-14 19:07:47'),
(39, 3, 'INOKIM OX', 'Weight:\r\n25 kg I 27.8 lb\r\nTop Speed:\r\n27 km/h I 15.5 mph\r\nBattery:\r\nLithium Ion, 60V, 13 A/h\r\nMotor:\r\n(Rated power) 1000W brushless gearless motor \r\n(Peak power) 1300W brushless gearless motor \r\nCharge Time:\r\n7 hrs for full charge\r\nTop Range:\r\n(Eco mode) 110 km I 68 miles \r\n(Full speed mode) 60 km I 37 miles \r\nRoad Lights:\r\nIntegral led lights\r\nBrakes:\r\nFront drum brake I Rear disc brake\r\nTires:\r\n10 inch pneumatic tires\r\nMax Load:\r\n120 kg I 220 lb\r\nMaterial:\r\nAviation Aluminum-Alloy\r\nLCD Display:\r\nWith funstion & illumination', 'Computers', '2019-10-15 10:45:35'),
(40, 19, 'Vertical Socket Towers', 'Just 15cm in diameter and 17 and 22 cm tall, these cleverly designed power socket towers will fit neatly into a corner of your office, entertainment area or kitchen. You can plug in up to six (ten for 3 level model) 2- or 3-pin appliances and there are also four USB sockets to charge your mobile devices. It has built-in overload protection for safety – and you’ll appreciate its attractive, contemporary style.', 'Other', '2019-10-15 18:14:10'),
(48, 21, 'INOKIM QUICK SUPER 3fdf', 'Specifications and properties\r\nBattery LG Lithium Ion 48V with 13A power\r\nMaximum range of up to 40 km\r\nA reliable and easy-to-maintain BRUSHLESS engine\r\nCharge time for full battery from household socket - 4-6 hours only\r\nTelescopic rod height between 97 and 62 cm\r\nTEKTRO braking system with rear disc brake\r\n10 \"wide pneumatic rubber tires\r\nDimensions in open condition 118x115x48 cm\r\nDimensions in folded condition 110x26x24 cm\r\nMaximum carrying capacity up to 120 kg\r\nSelf-weight: 16.5 kgBuilt from lightweight and strong T6-6061 aluminum\r\n* The driving range is measured in 1 lbs of 80 kg in a plane without increases', 'Electric Scooters', '2019-10-24 23:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(15, 'T-1000', 'Arnold@gmail.com', '$2y$10$rSOULHBES0uRysFAgPrEW.Ss9AdZQoWDuOlcaxKQNa.WmtUDtZB7y'),
(17, 'Will Smith', 'Will@gmail.com', '$2y$10$puWjaq/5bO8APLVStx./DuTAo8gBpHIA7VksPO6tNt3TwmwSgYrV.'),
(18, 'Sylvester Stallone', 'sylvester@gmail.com', '$2y$10$KQ7vBd3n36emd3woSM8.L.cT1fhKAKAOoOkLCie3r.jUDLvZvHyVa'),
(19, 'Van Dam', 'van@gmail.com', '$2y$10$HlGCEwuxvmb4/0gvevEvGeSMEwYQca16E0kYhgvxuxYrgfpxf.STS'),
(21, 'Pavel Lutcenko', 'pavel@gmail.com', '$2y$10$agjHmQZFzHBXEQ6TVKmyCOhEvjDpo0SZ13es2Tw2O4QsCrZMOWgRe');

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE `users_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`id`, `user_id`, `profile_image`) VALUES
(13, 15, '2019.11.05.18.56.24-2019.11.05.18.39.12-2019.11.05.18.23.46-t1000_optimized.jpg'),
(15, 17, '2019.10.14.10.04.20-will.jpg'),
(16, 18, '2019.11.03.20.29.55-stalone.jpg'),
(17, 19, 'default_profile.png'),
(19, 21, '2019.11.05.22.59.59-me.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users_profile`
--
ALTER TABLE `users_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
