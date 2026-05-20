-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 08 mei 2026 om 14:00
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

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
-- Tabelstructuur voor tabel `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_code` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other','Prefer not to say') DEFAULT 'Prefer not to say',
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `house_number` varchar(10) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'Netherlands',
  `registration_date` date NOT NULL,
  `customer_status` enum('Active','Inactive','Blocked') DEFAULT 'Active',
  `loyalty_points` int(11) DEFAULT 0,
  `newsletter_subscribed` tinyint(1) DEFAULT 0,
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_code`, `first_name`, `last_name`, `gender`, `date_of_birth`, `email`, `phone`, `street`, `house_number`, `postal_code`, `city`, `country`, `registration_date`, `customer_status`, `loyalty_points`, `newsletter_subscribed`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'CUST001', 'Jan', 'Jansen', 'Male', '1990-05-12', 'jan@example.com', '0612345678', 'Dorpsstraat', '1', '1234AB', 'Utrecht', 'Netherlands', '2024-01-01', 'Active', 100, 0, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51'),
(2, 'CUST002', 'Lisa', 'de Vries', 'Female', '1995-08-20', 'lisa@example.com', '0623456789', 'Kerkstraat', '10', '2345BC', 'Amsterdam', 'Netherlands', '2024-02-15', 'Active', 50, 0, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51'),
(3, 'CUST003', 'Tom', 'Bakker', 'Male', '1988-11-02', 'tom@example.com', '0634567890', 'Schoolstraat', '22', '3456CD', 'Eindhoven', 'Netherlands', '2024-03-10', 'Active', 200, 0, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51');

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
(1, 'EMP001', 'Anna', 'Meijer', 'anna@example.com', NULL, 'Store Manager', 'Sales', '2022-01-10', 3200.00, NULL, NULL, NULL, NULL, NULL, 'Netherlands', 'Fulltime', 'Active', NULL, NULL, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51'),
(2, 'EMP002', 'Mark', 'Smit', 'mark@example.com', NULL, 'Sales Employee', 'Sales', '2023-06-01', 2400.00, NULL, NULL, NULL, NULL, NULL, 'Netherlands', 'Fulltime', 'Active', NULL, NULL, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51'),
(3, 'EMP003', 'Eva', 'Visser', 'eva@example.com', NULL, 'Purchaser', 'Procurement', '2021-09-15', 3000.00, NULL, NULL, NULL, NULL, NULL, 'Netherlands', 'Fulltime', 'Active', NULL, NULL, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `released_at` date DEFAULT NULL,
  `personal_rating` int(11) DEFAULT NULL,
  `genre_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL,
  `rawg_id` int(11) DEFAULT NULL,
  `rawg_rating` decimal(3,1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `games`
--

INSERT INTO `games` (`game_id`, `title`, `description`, `released_at`, `personal_rating`, `genre_id`, `platform_id`, `rawg_id`, `rawg_rating`, `created_at`, `updated_at`) VALUES
(1, 'Elden ring', 'Open world RPG', '2022-02-25', 9, 2, 1, 12345, 9.5, '2026-04-20 10:09:51', '2026-04-21 12:59:15'),
(2, 'FIFA 24', 'Football simulation', '2023-09-29', 7, 5, 2, 23456, 7.8, '2026-04-20 10:09:51', '2026-04-20 10:09:51'),
(3, 'Zelda: Tears of the Kingdom', 'Adventure game', '2023-05-12', 10, 3, 4, 34567, 9.7, '2026-04-20 10:09:51', '2026-04-20 10:09:51'),
(4, 'Call of Duty: MW3', 'Shooter action game', '2023-11-10', 8, 1, 3, 45678, 8.2, '2026-04-20 10:09:51', '2026-04-20 10:09:51'),
(5, 'The Sims 4', 'Life simulation', '2014-09-02', 6, 4, 1, 56789, 7.0, '2026-04-20 10:09:51', '2026-04-20 10:09:51');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `genres`
--

INSERT INTO `genres` (`genre_id`, `name`) VALUES
(1, 'Action'),
(3, 'Adventure'),
(2, 'RPG'),
(4, 'Simulation'),
(5, 'Sports');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `platforms`
--

CREATE TABLE `platforms` (
  `platform_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `platforms`
--

INSERT INTO `platforms` (`platform_id`, `name`) VALUES
(4, 'Nintendo Switch'),
(1, 'PC'),
(2, 'PlayStation 5'),
(3, 'Xbox Series X');

-- --------------------------------------------------------

CREATE TABLE `game_genres` (
  `game_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`, `genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `game_platforms` (
  `game_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`, `platform_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `game_genres` (`game_id`, `genre_id`)
SELECT game_id, genre_id FROM games;

INSERT INTO `game_platforms` (`game_id`, `platform_id`)
SELECT game_id, platform_id FROM games;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_code` varchar(20) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `chamber_of_commerce_number` varchar(30) DEFAULT NULL,
  `vat_number` varchar(30) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `house_number` varchar(10) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'Netherlands',
  `bank_account` varchar(34) DEFAULT NULL,
  `delivery_time_days` int(11) DEFAULT 7,
  `supplier_rating` decimal(3,2) DEFAULT 5.00,
  `is_active` tinyint(1) DEFAULT 1,
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_code`, `company_name`, `contact_person`, `email`, `phone`, `website`, `chamber_of_commerce_number`, `vat_number`, `street`, `house_number`, `postal_code`, `city`, `country`, `bank_account`, `delivery_time_days`, `supplier_rating`, `is_active`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'SUP001', 'Game Distributors NL', 'Piet Peters', 'supplier1@example.com', '0401234567', NULL, NULL, NULL, NULL, NULL, NULL, 'Rotterdam', 'Netherlands', 'NL91ABNA0417164300', 7, 5.00, 1, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51'),
(2, 'SUP002', 'Global Games BV', 'Klaas de Boer', 'supplier2@example.com', '0502345678', NULL, NULL, NULL, NULL, NULL, NULL, 'Den Haag', 'Netherlands', 'NL92RABO0123456789', 7, 5.00, 1, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `transaction_code` varchar(20) NOT NULL,
  `transaction_type` enum('Sale','Purchase','Return') NOT NULL DEFAULT 'Sale',
  `customer_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `game_id` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL,
  `discount_percent` decimal(5,2) DEFAULT 0.00,
  `tax_percent` decimal(5,2) DEFAULT 21.00,
  `payment_method` enum('Cash','Card','Online','Bank transfer') DEFAULT 'Card',
  `payment_status` enum('Pending','Paid','Cancelled','Refunded') DEFAULT 'Paid',
  `order_status` enum('Open','Completed','Cancelled','Returned') DEFAULT 'Completed',
  `shipping_address` varchar(255) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `reference_note` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_code`, `transaction_type`, `customer_id`, `supplier_id`, `employee_id`, `game_id`, `transaction_date`, `quantity`, `unit_price`, `discount_percent`, `tax_percent`, `payment_method`, `payment_status`, `order_status`, `shipping_address`, `billing_address`, `reference_note`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'TRX001', 'Sale', 1, NULL, 2, 1, '2026-04-20 12:09:51', 1, 59.99, 0.00, 21.00, 'Card', 'Paid', 'Completed', NULL, NULL, NULL, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51'),
(2, 'TRX002', 'Sale', 2, NULL, 2, 3, '2026-04-20 12:09:51', 1, 69.99, 10.00, 21.00, 'Online', 'Paid', 'Completed', NULL, NULL, NULL, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51'),
(3, 'TRX003', 'Purchase', NULL, 1, 3, 2, '2026-04-20 12:09:51', 10, 40.00, 0.00, 21.00, 'Bank transfer', 'Paid', 'Completed', NULL, NULL, NULL, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51'),
(4, 'TRX004', 'Sale', 3, NULL, 1, 4, '2026-04-20 12:09:51', 2, 79.99, 5.00, 21.00, 'Cash', 'Paid', 'Completed', NULL, NULL, NULL, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51'),
(5, 'TRX005', 'Return', 1, NULL, 2, 1, '2026-04-20 12:09:51', 1, 59.99, 0.00, 21.00, 'Card', 'Paid', 'Completed', NULL, NULL, NULL, NULL, '2026-04-20 12:09:51', '2026-04-20 12:09:51');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_code` (`customer_code`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_number` (`employee_number`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `fk_games_genre` (`genre_id`),
  ADD KEY `fk_games_platform` (`platform_id`);

--
-- Indexen voor tabel `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexen voor tabel `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`platform_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexen voor tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supplier_code` (`supplier_code`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD UNIQUE KEY `transaction_code` (`transaction_code`),
  ADD KEY `fk_transactions_customer` (`customer_id`),
  ADD KEY `fk_transactions_supplier` (`supplier_id`),
  ADD KEY `fk_transactions_employee` (`employee_id`),
  ADD KEY `fk_transactions_game` (`game_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `platforms`
--
ALTER TABLE `platforms`
  MODIFY `platform_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `fk_games_genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_games_platform` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`platform_id`) ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transactions_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transactions_employee` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transactions_game` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transactions_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
