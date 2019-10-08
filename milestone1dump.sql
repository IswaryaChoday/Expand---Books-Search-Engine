-- phpMyAdmin SQL Dump
-- version 5.0.0-alpha1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 08, 2019 at 04:30 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinebooks`
--
CREATE DATABASE IF NOT EXISTS `onlinebooks` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `onlinebooks`;

-- --------------------------------------------------------

--
-- Table structure for table `forgotpassword`
--

CREATE TABLE `forgotpassword` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rkey` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `time` int(11) NOT NULL,
  `status` varchar(7) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `forgotpassword`
--

INSERT INTO `forgotpassword` (`id`, `user_id`, `rkey`, `time`, `status`) VALUES
(15, 15, '7cc45d0fec495041fe08c554f71c692d', 1570501722, 'pending'),
(16, 15, '15ded5da6ef300fb0cedb0ae654ae29e', 1570501777, 'pending'),
(17, 15, '9d4a820ef96a545b768cefd97e488e85', 1570501780, 'pending'),
(18, 15, '92cbe602a3a0dba1ccdf26f01da9f359', 1570501784, 'pending'),
(19, 15, '8e444b55be6e296c19bb21cde0f2c09b', 1570501795, 'pending'),
(20, 15, 'a71cc15098c071ed0e14f8ef8cc08fdd', 1570501827, 'pending'),
(21, 15, 'b481dcf7b3a160a7e7c5a69ccde6ed15', 1570501862, 'pending'),
(22, 16, '347382124b1b2ab33f69e94bdede9257', 1570501894, 'pending'),
(23, 15, '07da0bb345cdb469dc7fbeee473a71dc', 1570501943, 'pending'),
(24, 15, '3f1cc3d9f9bdceca3fc08bd52aedbeae', 1570501998, 'pending'),
(25, 15, 'c87e44590179b3e9aa771a60a89e41c2', 1570502625, 'pending'),
(26, 15, '677dca7ef5bfbfdbc74c870cff9b4479', 1570502632, 'pending'),
(27, 15, '0aca57c8a1f11f8695fc980c8ac6169f', 1570502751, 'pending'),
(28, 15, '66677a30c1a6f01a0ff7e3de8131312a', 1570502886, 'pending'),
(29, 15, '38b6c86aa2aedbbf38443e630887b02e', 1570502993, 'pending'),
(30, 15, 'e355578f999a0d80e64bbe39992dd3f3', 1570502998, 'pending'),
(31, 15, '65eed7228d9fe95dd1c8e5b36355156e', 1570503022, 'pending'),
(32, 15, '721f488f9a59269e867d83c565307716', 1570503031, 'pending'),
(33, 15, '5d99ee0810dfdf5f5757aa6694f58468', 1570503217, 'pending'),
(34, 15, 'b674e4a78a33d8c2afd10303b6c1807b', 1570503508, 'pending'),
(35, 15, '2944e6a15213e50b77f491d135bba5e1', 1570503524, 'pending'),
(36, 15, 'da2e3f19f93330a84dde97ad3c38979f', 1570503732, 'pending'),
(37, 15, 'd72e3f8e893fb21016c9fc6ef69edbd5', 1570503741, 'pending'),
(38, 15, '4bb72c1d74994757be0cf427e535aa8c', 1570503907, 'pending'),
(39, 15, '78d1522172c0636d432a076c96b62657', 1570503998, 'pending'),
(40, 15, 'dd66682e28f2e421d13e4a7714789ecf', 1570504038, 'pending'),
(41, 15, 'a74f88230684c79249bd44ee2d0451fd', 1570504248, 'pending'),
(42, 15, '1ab6b72f6a5b1e2d0267945d029ac963', 1570504256, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `rememberme`
--

CREATE TABLE `rememberme` (
  `id` int(11) NOT NULL,
  `authentificator1` char(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `f2authentificator2` char(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `rememberme`
--

INSERT INTO `rememberme` (`id`, `authentificator1`, `f2authentificator2`, `user_id`, `expires`) VALUES
(1, '78eb5dbf9a946355bf0e', '0cd1ad0a97c0f12814539331b6540a767eb79dd7dfc433918021699eea88ef87', 15, '2019-10-22 02:12:35'),
(2, '1060ead65d787726cd42', '235e11f733d00634e3da7694e3a7cc44bfbcbe3467e139b55a6623a2706fcd4d', 15, '2019-10-22 02:12:37'),
(3, 'a53a9add08fe8f37dc3f', 'e73e0be5642721b66bec9f18485fd22a3637a05daeed818d68e42ed6e3482489', 15, '2019-10-22 02:13:14'),
(4, 'b9ef22367b6248a2162b', 'e1dfa3f5a0abbfe7e3ef08eff114561fe24aff90c235d13188c3e4a9a97d586e', 15, '2019-10-22 02:37:38'),
(5, '70b22248907daf29066d', '423ff0d1d4fa5eacc93f345453dff439f8410cb833df36cceb0529cbdba63891', 15, '2019-10-22 13:24:02'),
(6, '2a0a750c74aeacfea454', '4057d1b1f20b61c035ad2e741d790c9b11296a2a9984646df18e0b90629e44a4', 15, '2019-10-23 03:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `activation` char(32) COLLATE utf8_bin NOT NULL,
  `activation2` char(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `activation`, `activation2`) VALUES
(15, 'ishwaryaaaa', 'ishwarya.bolla96@gmail.com', '6b806ab23d527b3473f81062395dda3341a014d742e1c98ddb8e3645c59a46bd', 'activated', '0'),
(16, 'rahul', 'rdump001@odu.edu', '6b806ab23d527b3473f81062395dda3341a014d742e1c98ddb8e3645c59a46bd', 'bad10d28d38f3809ca86e413d012f879', ''),
(24, 'dinesh', 'dinesh.paladhi@gmail.com', '134563d4e440f0e418b0f382f23a2cf301af6d7f648ccfae9895018345d779a3', 'cd3ddf9bfcd8b42bda8a8392403623cf', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rememberme`
--
ALTER TABLE `rememberme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `rememberme`
--
ALTER TABLE `rememberme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

