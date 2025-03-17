-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 17, 2025 at 05:37 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `care_compass_hospitals`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` int NOT NULL,
  `appointment_No` int NOT NULL,
  `date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `nic` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `charges` decimal(10,2) NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctorID` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `session_id`, `appointment_No`, `date`, `time`, `mobile_number`, `age`, `nic`, `email`, `location`, `name`, `charges`, `status`, `doctor_name`, `doctorID`) VALUES
(9, 5, 2, '2025-02-27', '7:00 PM - 8:00 PM', '+94789362722', 21, '200401500019', '', 'Kurunagala', 'Amandi', 3000.00, 'Approved', 'Dr. sampath perera', 4),
(10, 6, 1, '2025-02-28', '6:00 AM - 8:00 AM', '+94789362721', 25, '20040150011', '', 'Kandy', 'kavindu', 4000.00, 'Pending', 'Dr. kavindu', 13),
(11, 5, 2, '2025-03-13', '7:00 PM - 8:00 PM', '+94789362885', 22, '20040150011', '', 'Kurunagala', 'kavindu', 3000.00, 'Approved', 'Dr. sampath perera', 4);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `regNo` int NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialist` int NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `experience` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificates` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` int DEFAULT NULL,
  `availability` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regNo` (`regNo`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `regNo`, `name`, `number`, `specialist`, `image`, `description`, `experience`, `certificates`, `language`, `userId`, `availability`) VALUES
(1, 1001, 'chathura kavindu', '+94789362885', 1, 'doctor2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vulputate turpis ornare mi nulla quis. Id rhoncus nunc ultricies diam. Nisi varius libero bibendum elementum ipsum, odio elementum. Sit aenean donec mi mi. Urna, est elementum id amet, ut lectus quis egestas. Enim ut id fermentum, pellentesque auctor. Nec ut eu pharetra quis turpis leo ante hac.\r\n\r\nMi odio accumsan fames interdum nulla vulputate in sed amet. Urna tortor id arcu, at natoque nunc neque dui enim. Eleifend porttitor.', '03 Years', 'MBBS, MD', 'Sinhala, English', 0, 1),
(4, 1003, 'sampath perera', '+94789362719', 1, 'doctor3.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vulputate turpis ornare mi nulla quis. Id rhoncus nunc ultricies diam. Nisi varius libero bibendum elementum ipsum, odio elementum. Sit aenean donec mi mi. Urna, est elementum id amet, ut lectus quis egestas. Enim ut id fermentum, pellentesque auctor. Nec ut eu pharetra quis turpis leo ante hac.\r\n\r\nMi odio accumsan fames interdum nulla vulputate in sed amet. Urna tortor id arcu, at natoque nunc neque dui enim. Eleifend porttitor.', '02 Years', 'MBBS, MD', 'Sinhala, English', 2, 0),
(15, 1011, 'Thamodya', '+94709362885', 2, 'thamodya.jpg', 'Dr. Thamodya Jayaweera is a dedicated cardiologist with expertise in diagnosing and treating heart conditions. With an MBBS degree and specialized knowledge in cardiology, he is committed to providing the best cardiac care and improving patients heart health.', '3 Years', 'MBBS', 'Sinhala', 0, 1),
(16, 1015, 'Hashini Nimesha', '+94789362721', 3, '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vulputate turpis ornare mi nulla quis. Id rhoncus nunc ultricies diam. Nisi varius libero bibendum elementum ipsum, odio elementum. Sit aenean donec mi mi. Urna, est elementum id amet, ut lectus quis egestas. Enim ut id fermentum, pellentesque auctor. Nec ut eu pharetra quis turpis leo ante hac.', '1 Years', 'MBBS', 'English, Sinhala', 0, 0),
(20, 1016, 'Santh Perea', '+9478936241', 5, 'Mask group (2).png', 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '5 Years', 'MBBS', 'English, Sinhala', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors_speciality`
--

DROP TABLE IF EXISTS `doctors_speciality`;
CREATE TABLE IF NOT EXISTS `doctors_speciality` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors_speciality`
--

INSERT INTO `doctors_speciality` (`id`, `name`) VALUES
(1, 'Cardiology'),
(2, 'Dermatology'),
(3, 'Nephrology'),
(4, 'Oncology'),
(5, 'Pulmonology');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `name`, `email`, `image`, `message`, `status`, `date`, `location`) VALUES
(3, 'Amandi', '', 'p.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at amet eu, non vel netus duis enim quis. Arcu nibh nam eget lectus lacus mauris. Tellus in ut aliquam neque mi enim. Accumsan eget adipiscing lacinia lacus viverra tortor, feugiat. In amet, morbi tincidunt bibendum. In urna consectetur elementum id malesuada molestie.', 'Approved', '2025-02-24', 'Kurunegala'),
(4, 'Weerakoon', '', 'doctor2.jpg', 'ජීවිතය ගැන වෛද්යවරුන් පවා අවිශ්වාස තැබූ මොහොතක, මාගේ සැමියාගේ ජීවිතයේ වගකීම භාරගෙන මාගේ සැමියාට ජීවිතය දුන් ආසිරි සෙන්ට්රල් රෝහලේ ස්නායු ඒකකයේ වෛද්යවරුන්ට සහ කාර්යමණ්ඩලයට මාගේ ගෞරවණිය ස්තුතිය පුද කරනවා..', 'Approved', '2025-02-24', 'Kurunegala'),
(5, 'Amandi', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce at amet eu, non vel netus duis enim quis. Arcu nibh nam eget lectus lacus mauris. Tellus in ut aliquam neque mi enim. Accumsan eget adipiscing lacinia lacus viverra tortor, feugiat. In amet, morbi tincidunt bibendum. In urna consectetur elementum id malesuada molestie.', 'Approved', '2025-02-24', 'Kurunegala'),
(6, 'Thamodya', '', '', 'aaaaaaaaaa', 'Approved', '2025-02-26', 'Colombo');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
CREATE TABLE IF NOT EXISTS `inquiries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `name`, `number`, `email`, `message`, `status`, `date`) VALUES
(1, 'chathura', '+94789362885', '', 'aaaaaaaaaaaaaaa', 'Reject', '2025-02-21'),
(2, 'chathura', '+94789362885', '', 'Hello,\nI recently had a [test name] on [date] at your hospital. I would like to check the status of my test results and how I can receive them. Can you please update me on the process?\nThank you for your assistance.', 'Not Response', '2025-02-21'),
(3, 'kavindu', '+94789362721', '', 'I need urgent information regarding the availability of emergency care services at your hospital. Do you have 24/7 emergency response? Also, what are the procedures for admitting a patient in critical condition?\nPlease provide details as soon as possible.', 'Pending', '2025-02-21'),
(4, 'chathura', '+94789362885', '', 'I am inquiring about the availability of private/semi-private rooms for a patient who requires [type of treatment/surgery]. Could you please provide information about room types, charges, and booking procedures?\nLooking forward to your response.', 'Pending', '2025-02-21'),
(5, 'chathura', '+94789362885', 'chathura@gmail.com', 'I would like to schedule an appointment with Dr. [Doctor\'s Name] for a consultation regarding [health concern]. Could you please let me know the available dates and times? Also, do I need to bring any medical records?', 'Pending', '2025-02-21'),
(6, 'chathura', '+94789362885', '', 'sss', 'Pending', '2025-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

DROP TABLE IF EXISTS `payment_info`;
CREATE TABLE IF NOT EXISTS `payment_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `appointmentId` int NOT NULL,
  `cardNo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expDate` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cvv` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`id`, `appointmentId`, `cardNo`, `expDate`, `cvv`) VALUES
(5, 9, '12345678912345', '123', '10/12'),
(6, 10, '123456789123456', '123', '10/12'),
(7, 11, '123345678', '379', '12/10');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `doctorID` int NOT NULL,
  `date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timePeriod` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SpecialtyID` int NOT NULL,
  `count` int NOT NULL,
  `appointmentCount` int NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charges` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `doctorID`, `date`, `timePeriod`, `location`, `SpecialtyID`, `count`, `appointmentCount`, `status`, `charges`) VALUES
(1, 1, '2025-02-25', '4:00 PM - 6:00 PM', 'Kandy', 1, 25, 0, 'Expired', 2500.00),
(4, 4, '2025-03-08', '4:00 PM - 6:00 PM', 'Kurunagala', 1, 21, 21, 'Expired', 3000.00),
(5, 4, '2025-03-13', '7:00 PM - 8:00 PM', 'Kurunagala', 1, 25, 2, 'Expired', 3000.00),
(6, 13, '2025-02-28', '6:00 AM - 8:00 AM', 'Kandy', 0, 20, 1, 'Expired', 4000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `username`, `role`) VALUES
(1, 'chathura', 'kavindu', 'chathura@gmail.com', '$2y$10$I5qpP4XL6XTlYsdb6h3P5.CLe/2VdrRKFyw7/eAtj1cugH/9P6wMi', 'chathura15', 1),
(2, 'Sampath', 'Perera', 'sampath@gmail.com', '$2y$10$I5qpP4XL6XTlYsdb6h3P5.CLe/2VdrRKFyw7/eAtj1cugH/9P6wMi', 'sampath', 2),
(5, 'chathura', 'kavindu', 'kavindau@l.lk', '$2y$10$YoZsrjI8FyzBV57Y3clN4ebPHi3sWFJAdRDjqF2/Vq6vEzTkFqqaW', 'kavindaau', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
