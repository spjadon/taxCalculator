-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2019 at 09:26 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tax`
--

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `password`) VALUES
('admin', 'b96917c00e7d5a2d21e1f95f735d7122');

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`returnID`, `transID`, `date`, `PAN`, `catagory`, `residence`, `ifs`, `ifhp`, `stcga`, `ifb`, `ifos`, `ifa`, `deductions`, `gross`, `tax1`, `tax2`, `tax3`, `tax4`, `tax5`, `tax6`, `tax7`, `tax8`, `tax9`, `tax10`, `tax11`, `tax12`, `tax13`, `tax14`, `tax15`) VALUES
(1, 'NA', '2019-02-07 20:06:16', 'BBVPJ8633B', 'Male', 'Resident', '02500', '0', '0', '0', '0', '0', '0', '2500', '2500', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`PAN`, `dob`, `otp`, `email`, `mobile`, `address`) VALUES
('BBVPJ8633B', '1997-04-16', 236500, 'sandeepjadonk97@gmail.com', 2147483647, '');

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`PAN`, `sex`, `name`, `surname`, `fname`, `fsurname`, `dob`, `email`, `mobile`, `address`, `password`, `image`) VALUES
('BBVPJ8633B', 'Male', 'Sandeep', 'Jadon', 'Omprakash', 'Singh', '1997-04-16', 'sandeepjadonk97@gmail.com', '8394931340', 'Shikohabad', 'b96917c00e7d5a2d21e1f95f735d7122', 'img/profile/IMG_20180107_164413.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
