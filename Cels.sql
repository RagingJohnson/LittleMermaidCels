-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2021 at 06:09 AM
-- Server version: 10.3.29-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mitchel8_littlemermaidcels`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cels`
--

CREATE TABLE `Cels` (
  `ID` int(11) NOT NULL,
  `TimeInFilm` time NOT NULL DEFAULT current_timestamp(),
  `Frame` int(11) NOT NULL,
  `Characters` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ImagesDir` text NOT NULL,
  `PrimaryImg` text NOT NULL,
  `SalesHistory` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `HasSeal` enum('Yes','No','Unknown','') NOT NULL,
  `HasCert` enum('Yes','No','Unknown','') NOT NULL,
  `IsFramed` enum('Yes','No','Unknown','') NOT NULL,
  `DateAdded` date NOT NULL,
  `LastUpdated` date NOT NULL,
  `Comments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cels`
--

INSERT INTO `Cels` (`ID`, `TimeInFilm`, `Frame`, `Characters`, `ImagesDir`, `PrimaryImg`, `SalesHistory`, `HasSeal`, `HasCert`, `IsFramed`, `DateAdded`, `LastUpdated`, `Comments`) VALUES
(1, '00:20:32', 11, '[\"Ariel\"]', '1', 'primary.jpg', '[[\"eBay\", 2010-12-14, \"$2000\", \"Seller: Wayne Luttrel\"]]', 'Yes', 'Yes', 'Yes', '2021-05-31', '2021-05-31', '[\"Framed By: ArtInsights\"]'),
(2, '00:49:54', 1, '[\"Ariel\", \"Eric\"]', '\"2\"', '\"primary.jpg\"', '[[\"ArtInsights\", 2010-06-11, \"$1800\", \"Disney Archives\"]]', 'Yes', 'Yes', 'No', '2021-05-31', '2021-05-31', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cels`
--
ALTER TABLE `Cels`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `TimeInFilm` (`TimeInFilm`,`Frame`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cels`
--
ALTER TABLE `Cels`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
