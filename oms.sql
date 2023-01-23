-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 05, 2020 at 09:44 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oms`
--

-- --------------------------------------------------------

--
-- Table structure for table `academics`
--

DROP TABLE IF EXISTS `academics`;
CREATE TABLE IF NOT EXISTS `academics` (
  `id` int(255) NOT NULL,
  `schoolName` varchar(255) DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL,
  `percentage` int(255) DEFAULT NULL,
  `year` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academics`
--

INSERT INTO `academics` (`id`, `schoolName`, `grade`, `percentage`, `year`) VALUES
(12, NULL, NULL, NULL, NULL),
(14, NULL, NULL, NULL, NULL),
(15, NULL, NULL, NULL, NULL),
(16, 'Gadiminas', 'A', 80, 2019),
(17, 'toba', 'A', 90, 2020),
(18, 'Vilnius', 'A', 90, 2019),
(19, 'Punjab', 'C', 66, 2019),
(20, 'Vilnius', 'Q', 78, 2019),
(21, 'toba', 'B', 78, 2019),
(22, 'Punjab', 'Q', 66, 2019),
(23, 'k', 'a', 90, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

DROP TABLE IF EXISTS `budget`;
CREATE TABLE IF NOT EXISTS `budget` (
  `year` int(11) NOT NULL,
  `food` int(255) NOT NULL DEFAULT '0',
  `eduFee` int(255) NOT NULL DEFAULT '0',
  `clothing` int(255) NOT NULL DEFAULT '0',
  `events` int(255) NOT NULL DEFAULT '0',
  `sponsorshipBudget` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`year`, `food`, `eduFee`, `clothing`, `events`, `sponsorshipBudget`) VALUES
(0, 15, 15, 15, 0, 0),
(2019, 23, 23, 23, 318797, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(255) NOT NULL AUTO_INCREMENT,
  `First_name` varchar(30) NOT NULL,
  `Last_name` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Cnic` varchar(15) NOT NULL,
  `Contact` varchar(12) NOT NULL,
  `Designation` varchar(255) NOT NULL,
  `EVC` int(100) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `First_name`, `Last_name`, `Email`, `Password`, `Cnic`, `Contact`, `Designation`, `EVC`) VALUES
(3, 'Admin', 'Bhai', 'adminbhai@gmail.com', '789', '35200-5250005-5', '0321 7423434', 'Admin', 1),
(4, 'Abdullah', 'Saleem', 'abdullahsaleeem@yahoo.com', 'abd123', '35200-5250005-2', '0321 7423434', 'Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `doe` varchar(30) NOT NULL,
  `capacity` int(50) NOT NULL,
  `event_budget` int(50) NOT NULL,
  `Location` varchar(15) NOT NULL,
  `year` int(255) NOT NULL,
  `filled` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `title`, `doe`, `capacity`, `event_budget`, `Location`, `year`, `filled`) VALUES
(24, 'Raffay ki shadi', '2020-12-31', 2, 1000, 'Lahore', 2019, 2),
(25, 'Abdullah ki shadi', '2020-12-31', 4, 1400, 'Lahore', 2019, 2);

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

DROP TABLE IF EXISTS `expenditure`;
CREATE TABLE IF NOT EXISTS `expenditure` (
  `id` int(255) NOT NULL,
  `clothing` int(255) DEFAULT '0',
  `eduFee` int(255) DEFAULT '0',
  `food` int(255) DEFAULT '0',
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`id`, `clothing`, `eduFee`, `food`, `year`) VALUES
(15, NULL, NULL, NULL, NULL),
(16, 20000, 1000, 1000, 2019),
(17, 1000, 100, 500, 2020),
(18, 10, 120, 20, 2019),
(19, 100, 100, 100, 2019),
(20, 120, 120, 120, 2019),
(21, 10, 10, 10, 2019),
(22, 100, 100, 100, 2019),
(23, 3, 3, 3, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `guardian`
--

DROP TABLE IF EXISTS `guardian`;
CREATE TABLE IF NOT EXISTS `guardian` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `income` int(255) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guardian`
--

INSERT INTO `guardian` (`id`, `firstname`, `lastname`, `email`, `cnic`, `contact`, `income`, `address`, `password`) VALUES
(1, 'Aezaz', 'Ali', '22100070@lums.edu.pk', '35200-5250005-5', '0321 7423434', 1, 'qazi house canal view raod', 'ok123'),
(2, 'Awais', 'Furqan', 'furqanqazi.33@gmail.com', '35200-5250005-5', '0321 7423434', 1, 'qazi house canal view raod', 'awais3344');

-- --------------------------------------------------------

--
-- Table structure for table `guardian_application`
--

DROP TABLE IF EXISTS `guardian_application`;
CREATE TABLE IF NOT EXISTS `guardian_application` (
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `income` int(255) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `prefStID` int(255) NOT NULL,
  `guardAppID` int(255) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`guardAppID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guardian_application`
--

INSERT INTO `guardian_application` (`firstname`, `lastname`, `email`, `cnic`, `contact`, `income`, `address`, `prefStID`, `guardAppID`, `status`) VALUES
('Awais', 'Furqan', 'awaishassan512@yahoo.com', '35200-5250005-5', '0321 7423434', 3, 'qazi house canal view raod', 1, 1, 'Pending'),
('Awais', 'Furqan', 'furqanqazi.33@gmail.com', '35200-5250005-5', '0321 7423434', 1, 'qazi house canal view raod', 2, 2, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `guardian_notifications`
--

DROP TABLE IF EXISTS `guardian_notifications`;
CREATE TABLE IF NOT EXISTS `guardian_notifications` (
  `type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Unread',
  `id` int(255) NOT NULL,
  `notfId` int(255) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`notfId`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guardian_notifications`
--

INSERT INTO `guardian_notifications` (`type`, `message`, `status`, `id`, `notfId`) VALUES
('event', 'Message=New eventRaffay ki shadi is arriving at 2020-12-31 Grab your seat!&eventid=24', 'Unread', 1, 33),
('event', 'Message=New eventRaffay ki shadi is arriving at 2020-12-31 Grab your seat!&eventid=24', 'Read', 2, 34),
('event', 'Message=New event Abdullah ki shadi is arriving at 2020-12-31 Grab your seat!&eventid=25', 'Unread', 1, 35),
('event', 'Message=New event Abdullah ki shadi is arriving at 2020-12-31 Grab your seat!&eventid=25', 'Read', 2, 36);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `capacity` int(255) NOT NULL,
  `filled` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `capacity`, `filled`) VALUES
(22, 2, 2),
(23, 2, 2),
(24, 2, 2),
(25, 2, 2),
(26, 2, 2),
(27, 2, 2),
(28, 2, 2),
(29, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

DROP TABLE IF EXISTS `sponsor`;
CREATE TABLE IF NOT EXISTS `sponsor` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `income` int(255) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`id`, `firstname`, `lastname`, `email`, `cnic`, `contact`, `income`, `address`, `password`) VALUES
(1, 'Furqan', 'Athar ', 'furqanqazi.33@gmail.com', '35200-5250005-5', '0321 7423434', 4, 'qazi house canal view raod', 'furqan3344'),
(2, 'Ali', 'Anwar', 'alianwar@gmail.com', '35200-5250005-6', '0321 7423434', 1, 'qazi house canal view raod', 'ali123'),
(3, 'Spon', 'jee', 'furqanqazi.33@gmail.com', '35200-5250005-0', '0321 7423434', 1, 'qazi house canal view raod', 'ok123'),
(4, 'Abdul', 'Raffay', 'raffay@gmail.com', '35200-5250005-2', '0321 7423434', 1, 'qazi house canal view raod', 'ok123');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_application`
--

DROP TABLE IF EXISTS `sponsor_application`;
CREATE TABLE IF NOT EXISTS `sponsor_application` (
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `income` int(255) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `prefStID` int(255) NOT NULL,
  `sponAppID` int(255) NOT NULL AUTO_INCREMENT,
  `status` varchar(10) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`sponAppID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsor_application`
--

INSERT INTO `sponsor_application` (`firstname`, `lastname`, `email`, `cnic`, `contact`, `income`, `address`, `prefStID`, `sponAppID`, `status`) VALUES
('Furqan', 'Athar ', 'furqanqazi.33@gmail.com', '35200-5250005-5', '0321 7423434', 20, 'qazi house canal view raod', 1, 1, 'Rejected'),
('Furqan', 'Athar ', 'furqanqazi.33@gmail.com', '35200-5250005-5', '0321 7423434', 1, 'qazi house canal view raod', 1, 2, 'Rejected'),
('Spon', 'jee', 'furqanqazi.33@gmail.com', '35200-5250005-0', '0321 7423434', 1, 'qazi house canal view raod', 2, 3, 'Rejected'),
('Spon', 'jee', 'furqanqazi.33@gmail.com', '35200-5250005-0', '0321 7423434', 1, 'qazi house canal view raod', 2, 4, 'Rejected'),
('Abdul', 'Raffay', 'raffay@gmail.com', '35200-5250005-2', '0321 7423434', 1, 'qazi house canal view raod', 2, 5, 'Rejected'),
('Abdul', 'Raffay', 'raffay@gmail.com', '35200-5250005-2', '0321 7423434', 40000, 'qazi house canal view raod', 2, 6, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_notifications`
--

DROP TABLE IF EXISTS `sponsor_notifications`;
CREATE TABLE IF NOT EXISTS `sponsor_notifications` (
  `type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Unread',
  `id` int(255) NOT NULL,
  `notfId` int(255) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`notfId`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsor_notifications`
--

INSERT INTO `sponsor_notifications` (`type`, `message`, `status`, `id`, `notfId`) VALUES
('event', 'Message=New eventRaffay ki shadi is arriving at 2020-12-31 Grab your seat!&eventid=24', 'Unread', 1, 31),
('event', 'Message=New eventRaffay ki shadi is arriving at 2020-12-31 Grab your seat!&eventid=24', 'Unread', 2, 32),
('event', 'Message=New eventRaffay ki shadi is arriving at 2020-12-31 Grab your seat!&eventid=24', 'Unread', 3, 33),
('event', 'Message=New eventRaffay ki shadi is arriving at 2020-12-31 Grab your seat!&eventid=24', 'Read', 4, 34),
('event', 'Message=New event Abdullah ki shadi is arriving at 2020-12-31 Grab your seat!&eventid=25', 'Unread', 1, 35),
('event', 'Message=New event Abdullah ki shadi is arriving at 2020-12-31 Grab your seat!&eventid=25', 'Unread', 2, 36),
('event', 'Message=New event Abdullah ki shadi is arriving at 2020-12-31 Grab your seat!&eventid=25', 'Unread', 3, 37),
('event', 'Message=New event Abdullah ki shadi is arriving at 2020-12-31 Grab your seat!&eventid=25', 'Read', 4, 38);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(255) NOT NULL AUTO_INCREMENT,
  `First_name` varchar(90) NOT NULL,
  `Last_name` varchar(90) NOT NULL,
  `DOB` varchar(30) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `CNIC` varchar(15) NOT NULL,
  `Place_birth` varchar(15) NOT NULL,
  `age` int(11) NOT NULL,
  `roomId` int(11) NOT NULL,
  `enrollmentYear` int(11) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `First_name`, `Last_name`, `DOB`, `Gender`, `CNIC`, `Place_birth`, `age`, `roomId`, `enrollmentYear`) VALUES
(8, 'Raffay', 'Ali', '2020-12-31', 'Male', '35200-5250005-5', 'Lahore', 1, 22, 0),
(9, 'Furqan', 'Athar ', '2020-12-31', 'Male', '35200-5250005-5', 'Lahore', 1, 22, 0),
(10, 'h', 'jee', '2020-12-31', 'Male', '35200-5250005-1', 'Lahore', 3, 23, 0),
(11, 'Furqan', 'Athar ', '2020-12-31', 'Male', '35200-5250005-2', 'Lahore', 1, 23, 0),
(12, 'Furqan', 'Athar ', '2020-12-31', 'Male', '35200-5250005-3', 'Lahore', 1, 24, 0),
(14, 'Furqan', 'Athar ', '2020-01-01', 'Male', '35200-5250005-4', 'Lahore', 1, 24, 0),
(15, 'Inara', 'Kaneez', '2020-12-31', 'Male', '35200-5250005-6', 'Lahore', 1, 25, 0),
(16, 'bacha', 'na ker', '2020-12-30', 'Male', '35200-5250005-7', 'Lahore', 1, 25, 2019),
(17, 'sadquain', 'arif', '2020-01-01', 'Male', '35200-5250005-8', 'Lahore', 24, 26, 2020),
(18, 'kia ', 'baat', '2020-01-01', 'female', '35200-5250005-9', 'Lahore', 20, 26, 2019),
(19, 'Furqan', 'ka', '2020-12-31', 'Male', '35200-5250001-5', 'Lahore', 20, 27, 2019),
(20, 'h', 'Bhai', '2020-12-31', 'Male', '35200-5251005-5', 'Lahore', 20, 27, 2019),
(21, 'new', 'one', '2020-01-01', 'female', '35200-5250025-5', 'Lahore', 10, 28, 2019),
(22, 'h', 'Athar ', '2020-12-31', 'Male', '35200-5250015-5', 'Lahore', 4, 28, 2019),
(23, 'Admin', 'Athar ', '2020-12-31', 'Male', '35200-5250045-5', 'Lahore', 6, 29, 2019);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
