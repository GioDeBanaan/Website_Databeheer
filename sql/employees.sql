-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 mei 2026 om 09:37
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamevault`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `employee_number` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `hire_date` date NOT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `house_number` varchar(10) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'Netherlands',
  `contract_type` enum('Fulltime','Parttime','Intern','Temporary') DEFAULT 'Fulltime',
  `employment_status` enum('Active','On leave','Inactive') DEFAULT 'Active',
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_phone` varchar(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_number`, `first_name`, `last_name`, `email`, `phone`, `job_title`, `department`, `hire_date`, `salary`, `birth_date`, `street`, `house_number`, `postal_code`, `city`, `country`, `contract_type`, `employment_status`, `emergency_contact_name`, `emergency_contact_phone`, `notes`, `created_at`, `updated_at`) VALUES
(4, 'EMP1001', 'Sanne', 'de Vries', 'sanne.devries@email.nl', '+31 6 12345678', 'Software Developer', 'IT', '2021-03-15', 4200.00, '1994-07-21', 'Kerkstraat', '12', '5611 GH', 'Eindhoven', 'Nederland', '', 'Active', 'Jan de Vries', '+31 6 87654321', 'Werkt voornamelijk aan backend-systemen.', '2026-05-19 09:15:00', '2026-05-19 09:15:00'),
(5, 'EMP1002', 'Tom', 'Bakker', 'tom.bakker@email.nl', '+31 6 23456789', 'HR Specialist', 'Human Resources', '2019-08-01', 3650.00, '1989-11-03', 'Stationsplein', '44', '3511 ED', 'Utrecht', 'Nederland', '', 'Active', NULL, NULL, NULL, '2026-05-19 09:16:00', '2026-05-19 09:16:00'),
(6, 'EMP1003', 'Fatima', 'El Amrani', 'fatima.elamrani@email.nl', '+31 6 34567890', 'Financial Analyst', 'Finance', '2020-01-20', 5100.00, '1991-04-17', 'Markt', '8', '6211 CK', 'Maastricht', 'Nederland', 'Temporary', 'Active', 'Youssef El Amrani', '+31 6 99887766', 'Tijdelijk contract tot eind 2026.', '2026-05-19 09:17:00', '2026-05-19 09:17:00'),
(7, 'EMP1004', 'Daan', 'Jansen', 'daan.jansen@email.nl', '+31 6 45678901', 'Marketing Coordinator', 'Marketing', '2018-06-11', 3890.00, '1987-09-12', 'Lindelaan', '102', '9723 AB', 'Groningen', 'Nederland', '', 'On leave', NULL, NULL, 'Met ouderschapsverlof sinds april 2026.', '2026-05-19 09:18:00', '2026-05-19 09:18:00'),
(8, 'EMP1005', 'Lisa', 'van der Meer', 'lisa.vandermeer@email.nl', '+31 6 56789012', 'Customer Support Agent', 'Customer Service', '2022-11-07', 2950.00, '1998-02-25', 'Havenstraat', '5', '3011 TA', 'Rotterdam', 'Nederland', '', 'Active', 'Eva van der Meer', '+31 6 11223344', NULL, '2026-05-19 09:19:00', '2026-05-19 09:19:00');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_number` (`employee_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
