-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2023 at 05:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`) VALUES
(2, 'Produkt 2', '20.99', 'Opis produktu 2', 'prod/prod2.jpg'),
(3, 'Produkt 3', '30.99', 'Opis produktu 3', 'prod/prod3.jpg'),
(4, 'Produkt 4', '40.99', 'Opis produktu 4', 'prod/prod4.jpg'),
(5, 'Produkt 5', '50.99', 'Opis produktu 5', 'prod/prod5.jpg'),
(8, 'Produkt 6', '52.99', 'Opis produkt 6', 'prod/prod6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `użytkownicy`
--

CREATE TABLE `użytkownicy` (
  `id` int(11) NOT NULL,
  `nazwa_użytkownika` varchar(50) NOT NULL,
  `adres_email` varchar(100) NOT NULL,
  `hasło` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `użytkownicy`
--

INSERT INTO `użytkownicy` (`id`, `nazwa_użytkownika`, `adres_email`, `hasło`, `admin`) VALUES
(4, 'Jakub2', 'Jakub6@gmail.com', '$2y$10$H3noI.oapQnHHaX4EjgHneLxp20FDQO.jyTSGdaf0PbwMfzeycZ7e', 1),
(7, 'qweasdasd', 'asdasdadas@gmail.com', '$2y$10$6ba7NJ3qpF77j.23ruevIOF1hcTC9fRrJ7bmJk2slfBeFVU9GOpXq', 0),
(8, 'Jakub3', 'Jakub34@gmail.com', '$2y$10$HUJeF7rIgNFwHaF8E2wOy.J0Zu3jJRqyrkwJYZCgtKj0zlHS82MmC', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zamowienie`
--

CREATE TABLE `zamowienie` (
  `id` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zamowienie`
--

INSERT INTO `zamowienie` (`id`, `id_uzytkownika`, `id_produktu`, `ilosc`) VALUES
(2, 4, 1, 1),
(4, 4, 2, 1),
(5, 4, 3, 1),
(6, 4, 4, 1),
(7, 4, 5, 1),
(8, 4, 4, 1),
(9, 0, 1, 1),
(10, 4, 1, 1),
(11, 4, 2, 1),
(12, 4, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `użytkownicy`
--
ALTER TABLE `użytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nazwa_użytkownika` (`nazwa_użytkownika`),
  ADD UNIQUE KEY `adres_email` (`adres_email`);

--
-- Indexes for table `zamowienie`
--
ALTER TABLE `zamowienie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `użytkownicy`
--
ALTER TABLE `użytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `zamowienie`
--
ALTER TABLE `zamowienie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
