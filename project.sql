-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2020 at 09:00 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `actual_energy_data`
--

CREATE TABLE `actual_energy_data` (
  `aEnergy_id` int(11) NOT NULL,
  `energy_source` text NOT NULL,
  `energy_con_per_hour` float NOT NULL,
  `annual_operation_per_hour` float NOT NULL,
  `annual_production` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `actual_energy_data`
--

INSERT INTO `actual_energy_data` (`aEnergy_id`, `energy_source`, `energy_con_per_hour`, `annual_operation_per_hour`, `annual_production`) VALUES
(1, 'Electricity(kWh)', 350.83, 2500, 1000000),
(2, 'Electricity(kWh)', 350.83, 2500, 11600000),
(3, 'Electricity(kWh)', 110, 1500, 7000000),
(4, 'Electricity(kWh)', 250.5, 1950, 10000),
(5, 'Electricity(kWh)', 210.5, 5500, 9000000);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_list`
--

CREATE TABLE `equipment_list` (
  `equip_id` int(11) NOT NULL,
  `equipment_name` varchar(250) NOT NULL,
  `equip_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment_list`
--

INSERT INTO `equipment_list` (`equip_id`, `equipment_name`, `equip_amount`) VALUES
(1, 'BEMS', 6.8),
(2, 'Exhaust gas boiler', 10.9),
(3, 'Heat Exchanger', 20.1),
(4, 'Lift', 24.3),
(5, 'De-inking Plant', 223.7),
(6, 'Absorption Chiller', 277.3);

-- --------------------------------------------------------

--
-- Table structure for table `estimated_energy_data`
--

CREATE TABLE `estimated_energy_data` (
  `esEnergy_id` int(11) NOT NULL,
  `energy_source` text NOT NULL,
  `energy_con_per_hour` float NOT NULL,
  `annual_operation_per_hour` float NOT NULL,
  `annual_production` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estimated_energy_data`
--

INSERT INTO `estimated_energy_data` (`esEnergy_id`, `energy_source`, `energy_con_per_hour`, `annual_operation_per_hour`, `annual_production`) VALUES
(1, 'Electricity(kWh)', 285.83, 2000, 96000000),
(2, 'Electricity(kWh)', 250.83, 2000, 296000000),
(3, 'Electricity(kWh)', 85, 1000, 30000000),
(4, 'Electricity(kWh)', 150.5, 2000, 960000),
(5, 'Electricity(kWh)', 100.5, 1500, 83000000);

-- --------------------------------------------------------

--
-- Table structure for table `existing_energy`
--

CREATE TABLE `existing_energy` (
  `eEnergy_id` int(11) NOT NULL,
  `energy_source` text NOT NULL,
  `energy_con_per_hour` float NOT NULL,
  `annual_operation_per_hour` float NOT NULL,
  `annual_production` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `existing_energy`
--

INSERT INTO `existing_energy` (`eEnergy_id`, `energy_source`, `energy_con_per_hour`, `annual_operation_per_hour`, `annual_production`) VALUES
(1, 'Electricity(kWh)', 323.83, 2496, 9600000),
(2, 'Electricity(kWh)', 300.83, 3496, 19600000),
(3, 'Electricity(kWh)', 100, 1496, 5000000),
(4, 'Electricity(kWh)', 200.5, 2000, 96000),
(5, 'Electricity(kWh)', 200.5, 5496, 8300000),
(6, 'Electricity(kWh)', 300.5, 2496, 19600000);

-- --------------------------------------------------------

--
-- Table structure for table `gdp`
--

CREATE TABLE `gdp` (
  `gdp_id` int(11) NOT NULL,
  `fin_year` varchar(250) NOT NULL,
  `fin_month` varchar(250) NOT NULL,
  `gdp_amount` float NOT NULL,
  `gdp_source` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gdp`
--

INSERT INTO `gdp` (`gdp_id`, `fin_year`, `fin_month`, `gdp_amount`, `gdp_source`) VALUES
(1, '2014', 'January', 210, 'BBS'),
(2, '2015', 'January', 280, 'BBS'),
(3, '2016', 'January', 300, 'BBS'),
(4, '2017', 'January', 250, 'BBS'),
(5, '2018', 'January', 274, 'BBS');

-- --------------------------------------------------------

--
-- Table structure for table `project_data`
--

CREATE TABLE `project_data` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(250) NOT NULL,
  `pro_sector` varchar(250) NOT NULL,
  `pro_amount` float NOT NULL,
  `existing_energy` float NOT NULL,
  `estimated_energy` float NOT NULL,
  `actual_energy` float NOT NULL,
  `equipment` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_data`
--

INSERT INTO `project_data` (`pro_id`, `pro_name`, `pro_sector`, `pro_amount`, `existing_energy`, `estimated_energy`, `actual_energy`, `equipment`) VALUES
(1, 'Cement', 'Industry', 200, 8600000, 9600000, 1000000, ''),
(2, 'Garments', 'Industry', 300, 19600000, 296000000, 11600000, '');

-- --------------------------------------------------------

--
-- Table structure for table `sector_wise_data`
--

CREATE TABLE `sector_wise_data` (
  `pid` int(11) NOT NULL,
  `project_name` varchar(250) NOT NULL,
  `no_of_projects` int(11) NOT NULL,
  `avg_amount_per_project` float NOT NULL,
  `total_loan_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sector_wise_data`
--

INSERT INTO `sector_wise_data` (`pid`, `project_name`, `no_of_projects`, `avg_amount_per_project`, `total_loan_amount`) VALUES
(1, 'Cement', 3, 1001.33, 3003.99),
(2, 'Garments', 7, 465.93, 3261.5),
(3, 'Spinning', 8, 446.71, 3573.68),
(4, 'Electronics', 1, 10.5, 10.5),
(5, 'Paper', 1, 223.7, 223.7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actual_energy_data`
--
ALTER TABLE `actual_energy_data`
  ADD PRIMARY KEY (`aEnergy_id`);

--
-- Indexes for table `equipment_list`
--
ALTER TABLE `equipment_list`
  ADD PRIMARY KEY (`equip_id`);

--
-- Indexes for table `estimated_energy_data`
--
ALTER TABLE `estimated_energy_data`
  ADD PRIMARY KEY (`esEnergy_id`);

--
-- Indexes for table `existing_energy`
--
ALTER TABLE `existing_energy`
  ADD PRIMARY KEY (`eEnergy_id`);

--
-- Indexes for table `gdp`
--
ALTER TABLE `gdp`
  ADD PRIMARY KEY (`gdp_id`);

--
-- Indexes for table `project_data`
--
ALTER TABLE `project_data`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `sector_wise_data`
--
ALTER TABLE `sector_wise_data`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actual_energy_data`
--
ALTER TABLE `actual_energy_data`
  MODIFY `aEnergy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `equipment_list`
--
ALTER TABLE `equipment_list`
  MODIFY `equip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `estimated_energy_data`
--
ALTER TABLE `estimated_energy_data`
  MODIFY `esEnergy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `existing_energy`
--
ALTER TABLE `existing_energy`
  MODIFY `eEnergy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gdp`
--
ALTER TABLE `gdp`
  MODIFY `gdp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_data`
--
ALTER TABLE `project_data`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sector_wise_data`
--
ALTER TABLE `sector_wise_data`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
