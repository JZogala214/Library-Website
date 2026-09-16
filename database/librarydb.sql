-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2025 at 09:57 AM
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
-- Database: `librarydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ISBN` varchar(20) NOT NULL,
  `BookTitle` varchar(40) NOT NULL,
  `Author` varchar(40) NOT NULL,
  `Edition` int(2) NOT NULL,
  `Year` year(4) NOT NULL,
  `CategoryID` int(3) NOT NULL,
  `Reserved` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `BookTitle`, `Author`, `Edition`, `Year`, `CategoryID`, `Reserved`) VALUES
('093-403992', 'Computers in Business', 'Alicia Oneil', 3, '1997', 3, 'N'),
('23472-8729', 'Exploring Peru', 'Stephanie Birching', 4, '2005', 5, 'N'),
('237-34823', 'Business Strategy', 'Joe Peppard', 2, '2002', 2, 'N'),
('23u8-923849', 'A guide to nutrition', 'John Thorpe', 2, '1997', 1, 'Y'),
('2983-3494', 'Cooking for children', 'Anabelle Sharpe', 1, '2003', 7, 'N'),
('82n8-308', 'computers for idiots', 'Susan' 'O''Neil', 5, '1998', 4, 'N'),
('9823-08345', 'How to cook Italian food', 'Jamie Oliver', 2, '2005', 7, 'Y'),
('9823-23984', 'My life in picture', 'Kevin Graham', 8, '2004', 1, 'N'),
('9823-2403-0', 'DaVinci Code', 'Dan Brown', 1, '2003', 8, 'N'),
('9823-98487', 'Optimising your business', 'Cleo Blair', 1, '2001', 2, 'N'),
('98234-029384', 'My ranch in Texas', 'George Bush', 1, '2005', 1, 'Y'),
('988745-234', 'Tara Road', 'Maeve Binchy', 4, '2002', 8, 'N'),
('993-004-00', 'My life in bits', 'John Smith', 1, '2001', 1, 'N'),
('9987-0039882', 'Shooting History', 'Jon Snow', 1, '2003', 1, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(3) NOT NULL,
  `CategoryDescription` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryDescription`) VALUES
(1, 'Health'),
(2, 'Business'),
(3, 'Biography'),
(4, 'Technology'),
(5, 'Travel'),
(6, 'Self-Help'),
(7, 'Cookery'),
(8, 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `ISBN` varchar(20) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `ReservedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ISBN`, `Username`, `ReservedDate`) VALUES
('23u8-923849', 'JakubZo', '2025-12-05'),
('9823-98345', 'tommy100', '2008-10-11'),
('98234-029384', 'joecrotty', '2008-10-11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(40) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `AddressLine1` varchar(40) NOT NULL,
  `AddressLine2` varchar(40) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Telephone` int(10) NOT NULL,
  `Mobile` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`, `FirstName`, `Surname`, `AddressLine1`, `AddressLine2`, `City`, `Telephone`, `Mobile`) VALUES
('alanjmckenna', '$2y$10$BIhmWBTwyIl2M2ErKfNqNODy2IjhIQT/gx26jAncVDI8skIIQ57AC', 'Alan', 'McKenna', '38 Cranley Road', 'Fairview', 'Dublin', 9998377, 856625567),
('joecrotty', '$2y$10$WjT9p/nEJH3SOSNjXeOaK.gp9GPg3rogk02Kvx4Qx/YHWGtTMz34W', 'Joseph', 'Crotty', 'Apt 5 Clyde Road', 'Donnybrook', 'Dublin', 8887889, 876654456),
('tommy100', '$2y$10$PAe1Oqx7RgTEU1mxqV4DSuygkBP/QkvKn6INWtIFx4dc7w6rZYImG', 'tom', 'behan', '14 hyde road', 'dalkey', 'dublin', 9983747, 876738782);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ISBN`,`Username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
