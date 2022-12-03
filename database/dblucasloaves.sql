-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2022 at 03:59 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dblucasloaves`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteApplicant` ()   BEGIN
DELETE from APPLICANT;
ALTER TABLE APPLICANT AUTO_INCREMENT = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteApplicationLine` ()   BEGIN
DELETE from APPLICATIONLINE;
ALTER TABLE APPLICATIONLINE AUTO_INCREMENT = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteJobApplications` ()   BEGIN
CALL deleteApplicationLine();
CALL deleteApplicant();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteOrderLine` ()   BEGIN
DELETE from ORDERLINE;
ALTER TABLE ORDERLINE AUTO_INCREMENT = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteOrders` ()   BEGIN
   CALL deleteOrderLine();
   CALL deleteSalesOrder();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteSalesOrder` ()   BEGIN
DELETE from SALESORDER;
ALTER TABLE SALESORDER AUTO_INCREMENT = 1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `ApplicantNumber` int(11) NOT NULL,
  `ApplicantFirstname` varchar(50) NOT NULL,
  `ApplicantLastname` varchar(50) NOT NULL,
  `ApplicantEmail` varchar(100) NOT NULL,
  `ApplicantPhone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`ApplicantNumber`, `ApplicantFirstname`, `ApplicantLastname`, `ApplicantEmail`, `ApplicantPhone`) VALUES
(1, 'John', 'Doe', 'JohnDoe@gmail.com', '042012345'),
(2, 'John', 'Doe', 'johndoe@gmail.com', '042012345'),
(3, 'John', 'Doe', 'johndoe@gmail.com', '042012345');

-- --------------------------------------------------------

--
-- Table structure for table `applicationline`
--

CREATE TABLE `applicationline` (
  `ReferenceNumber` int(11) NOT NULL,
  `PostNumber` int(11) NOT NULL,
  `ApplicantNumber` int(11) NOT NULL,
  `Resume` varchar(100) NOT NULL,
  `CoverLetter` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicationline`
--

INSERT INTO `applicationline` (`ReferenceNumber`, `PostNumber`, `ApplicantNumber`, `Resume`, `CoverLetter`) VALUES
(1, 3, 1, '', ''),
(2, 2, 2, '', ''),
(3, 2, 3, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jobpost`
--

CREATE TABLE `jobpost` (
  `PostNumber` int(11) NOT NULL,
  `JobName` varchar(50) NOT NULL,
  `JobDescription` text NOT NULL,
  `Salary` double NOT NULL,
  `Negotiable` enum('yes','no') DEFAULT NULL,
  `JobStatus` enum('Full-time','Part-time') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobpost`
--

INSERT INTO `jobpost` (`PostNumber`, `JobName`, `JobDescription`, `Salary`, `Negotiable`, `JobStatus`) VALUES
(1, 'Baker', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem assumenda asperiores ut ', 65000, 'yes', 'Full-time'),
(2, 'Bakery assistant', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem assumenda asperiores ut ', 65000, 'yes', 'Full-time'),
(3, 'Pastry cook', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem assumenda asperiores ut ', 65000, 'yes', 'Full-time');

-- --------------------------------------------------------

--
-- Table structure for table `orderline`
--

CREATE TABLE `orderline` (
  `ProductNumber` int(11) NOT NULL,
  `OrderNumber` int(11) NOT NULL,
  `QuantityOrdered` int(11) NOT NULL,
  `PickUpDate` datetime DEFAULT NULL,
  `TotalAmount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderline`
--

INSERT INTO `orderline` (`ProductNumber`, `OrderNumber`, `QuantityOrdered`, `PickUpDate`, `TotalAmount`) VALUES
(1, 1, 1, '2022-11-08 12:30:00', '45'),
(2, 1, 1, '2022-11-29 23:27:00', '8'),
(2, 3, 5, '2022-11-30 17:24:00', '40'),
(3, 1, 1, '2022-11-08 12:31:00', '70'),
(3, 2, 2, '2022-11-30 17:23:00', '18');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductNumber` int(11) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductDescription` text NOT NULL,
  `UnitPrice` double NOT NULL,
  `ProductImage` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductNumber`, `ProductName`, `ProductDescription`, `UnitPrice`, `ProductImage`) VALUES
(1, 'Sourdough White', 'Our standard sourdough.', 7, 'sourdoughWhite.jpg'),
(2, 'Sourdough Rye', 'Sourdough created with 50% rye flour.', 8, 'sourdoughRye.jpg'),
(3, 'Sourdough Spelt', 'Sourdough created with 100% spelt flour.', 9, 'sourdoughSpelt.jpg'),
(4, 'Sourdough Seeded', 'Sourdough including a mixture of yummy seeds.', 9.5, 'sourdoughSeeded.jpeg'),
(5, 'Sourdough breadmaking classes', 'First Saturday of every month. 9 am to 5 pm with lunch provided. Learn to make your own bread $350 plus GST.', 350, 'sourdoughTest.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `salesorder`
--

CREATE TABLE `salesorder` (
  `OrderNumber` int(11) NOT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `CustomerFirstname` varchar(50) NOT NULL,
  `CustomerLastname` varchar(50) NOT NULL,
  `CustomerEmail` varchar(100) NOT NULL,
  `CustomerPhone` varchar(20) NOT NULL,
  `CreditCardNumber` varchar(16) NOT NULL,
  `CardExpiryDate` varchar(5) NOT NULL,
  `SecurityCode` varchar(10) NOT NULL,
  `PaymentAmount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesorder`
--

INSERT INTO `salesorder` (`OrderNumber`, `OrderDate`, `CustomerFirstname`, `CustomerLastname`, `CustomerEmail`, `CustomerPhone`, `CreditCardNumber`, `CardExpiryDate`, `SecurityCode`, `PaymentAmount`) VALUES
(1, '2022-11-29 22:28:28', 'John', 'Doe', 'johnDoe@email.com', '0412345678', '123', '08/26', '123', '123'),
(2, '2022-11-30 16:23:58', 'John', 'Doe', 'johnDoe@email.com', '0412345678', '123', '08/26', '123', '18'),
(3, '2022-11-30 16:24:24', 'John', 'Doe', 'johnDoe@email.com', '0412345678', '123', '08/26', '123', '40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`ApplicantNumber`);

--
-- Indexes for table `applicationline`
--
ALTER TABLE `applicationline`
  ADD PRIMARY KEY (`ReferenceNumber`),
  ADD KEY `PostNumber` (`PostNumber`),
  ADD KEY `ApplicantNumber` (`ApplicantNumber`);

--
-- Indexes for table `jobpost`
--
ALTER TABLE `jobpost`
  ADD PRIMARY KEY (`PostNumber`);

--
-- Indexes for table `orderline`
--
ALTER TABLE `orderline`
  ADD PRIMARY KEY (`ProductNumber`,`OrderNumber`),
  ADD KEY `OrderNumber` (`OrderNumber`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductNumber`);

--
-- Indexes for table `salesorder`
--
ALTER TABLE `salesorder`
  ADD PRIMARY KEY (`OrderNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `ApplicantNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `applicationline`
--
ALTER TABLE `applicationline`
  MODIFY `ReferenceNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobpost`
--
ALTER TABLE `jobpost`
  MODIFY `PostNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salesorder`
--
ALTER TABLE `salesorder`
  MODIFY `OrderNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicationline`
--
ALTER TABLE `applicationline`
  ADD CONSTRAINT `applicationline_ibfk_1` FOREIGN KEY (`PostNumber`) REFERENCES `jobpost` (`PostNumber`),
  ADD CONSTRAINT `applicationline_ibfk_2` FOREIGN KEY (`ApplicantNumber`) REFERENCES `applicant` (`ApplicantNumber`);

--
-- Constraints for table `orderline`
--
ALTER TABLE `orderline`
  ADD CONSTRAINT `orderline_ibfk_1` FOREIGN KEY (`ProductNumber`) REFERENCES `product` (`ProductNumber`),
  ADD CONSTRAINT `orderline_ibfk_2` FOREIGN KEY (`OrderNumber`) REFERENCES `salesorder` (`OrderNumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
