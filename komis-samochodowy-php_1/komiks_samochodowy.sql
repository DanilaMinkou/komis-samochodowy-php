-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 13, 2024 at 10:25 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komiks_samochodowy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id_klienta` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `liczba_logowan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klienci`
--

INSERT INTO `klienci` (`id_klienta`, `login`, `haslo`, `email`, `liczba_logowan`) VALUES
(3, '1', '1', '', 41),
(4, '2', '2', '', 3),
(8, '3', '3', '', 3),
(9, '4', '4', '', 2),
(10, '5', '5', 'mikael.@gmail.com', 1),
(11, 'admin', 'admin', 'adade@gamil.com', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `magazyn`
--

CREATE TABLE `magazyn` (
  `id` int(11) NOT NULL,
  `id_modelu` int(11) NOT NULL,
  `ilosc_dostepna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sprzedawcy`
--

CREATE TABLE `sprzedawcy` (
  `id_sprzedawcy` int(11) NOT NULL,
  `nazwisko_sprzedawcy` varchar(50) DEFAULT NULL,
  `imie_sprzedawcy` varchar(50) DEFAULT NULL,
  `wiek_sprzedawcy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sprzedawcy`
--

INSERT INTO `sprzedawcy` (`id_sprzedawcy`, `nazwisko_sprzedawcy`, `imie_sprzedawcy`, `wiek_sprzedawcy`) VALUES
(1, 'Kowalski', 'Jan', 35),
(2, 'Nowak', 'Anna', 28),
(3, 'Wiśniewski', 'Piotr', 42),
(4, 'Dąbrowski', 'Maria', 39),
(5, 'Lewandowski', 'Tomasz', 45);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tranzakcje`
--

CREATE TABLE `tranzakcje` (
  `id_tranzakcji` int(11) NOT NULL,
  `id_sprzedawcy` int(11) DEFAULT NULL,
  `marka_samochodu` varchar(50) DEFAULT NULL,
  `model_samochodu` varchar(50) DEFAULT NULL,
  `rok_produkcji` int(11) DEFAULT NULL,
  `cena_samochodu` decimal(10,2) DEFAULT NULL,
  `dostepna_ilosc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tranzakcje`
--

INSERT INTO `tranzakcje` (`id_tranzakcji`, `id_sprzedawcy`, `marka_samochodu`, `model_samochodu`, `rok_produkcji`, `cena_samochodu`, `dostepna_ilosc`) VALUES
(1, 1, 'Toyota', 'Corolla', 2018, 25000.00, 0),
(2, 1, 'Volkswagen', 'Golf', 2019, 27000.00, 70),
(3, 1, 'Renault', 'Clio', 2015, 15000.00, 80),
(4, 1, 'Skoda', 'Octavia', 2019, 23000.00, 80),
(5, 1, 'Honda', 'Civic', 2017, 20000.00, 80),
(6, 1, 'Audi', 'A3', 2020, 32000.00, 80),
(7, 1, 'Ford', 'Fiesta', 2016, 14000.00, 80),
(8, 1, 'Mercedes-Benz', 'A-Class', 2018, 28000.00, 80),
(9, 1, 'BMW', '3 Series', 2019, 35000.00, 80),
(10, 1, 'Hyundai', 'i30', 2017, 18000.00, 80),
(11, 1, 'Opel', 'Astra', 2018, 21000.00, 80),
(12, 1, 'Lexus', 'IS', 2021, 42000.00, 70),
(13, 1, 'Volvo', 'S60', 2016, 30000.00, 48),
(14, 1, 'Mazda', '3', 2020, 26000.00, 80),
(15, 1, 'Kia', 'Rio', 2017, 17000.00, 80),
(16, 1, 'Peugeot', '208', 2019, 19000.00, 74),
(17, 1, 'Citroen', 'C3', 2018, 18000.00, 80),
(18, 1, 'Subaru', 'Impreza', 2016, 22000.00, 80),
(19, 1, 'Fiat', 'Punto', 2020, 15000.00, 80),
(20, 1, 'Seat', 'Leon', 2017, 20000.00, 80),
(21, 1, 'Nissan', 'Micra', 2018, 14000.00, 80),
(22, 1, 'Renault', 'Captur', 2019, 18000.00, 80),
(23, 1, 'Peugeot', '308', 2017, 22000.00, 74),
(24, 1, 'Volkswagen', 'Polo', 2016, 16000.00, 70),
(25, 1, 'Skoda', 'Fabia', 2021, 19000.00, 80),
(26, 1, 'Toyota', 'Yaris', 2017, 15000.00, 0),
(27, 1, 'BMW', '1 Series', 2018, 28000.00, 80),
(28, 1, 'Audi', 'A1', 2019, 25000.00, 80),
(29, 1, 'Mercedes-Benz', 'CLA', 2020, 32000.00, 80),
(30, 1, 'Hyundai', 'Kona', 2018, 20000.00, 80),
(31, 1, 'Opel', 'Corsa', 2017, 17000.00, 80),
(32, 2, 'BMW', 'X5', 2020, 60000.00, 79),
(33, 2, 'Hyundai', 'Tucson', 2018, 22000.00, 80),
(34, 2, 'Seat', 'Ibiza', 2016, 16000.00, 80),
(35, 2, 'Subaru', 'Forester', 2019, 32000.00, 80),
(36, 2, 'Renault', 'Megane', 2016, 17000.00, 80),
(37, 2, 'Volkswagen', 'Tiguan', 2021, 38000.00, 70),
(38, 2, 'Audi', 'Q3', 2017, 28000.00, 80),
(39, 2, 'Peugeot', '3008', 2018, 25000.00, 74),
(40, 2, 'Toyota', 'Rav4', 2019, 34000.00, 0),
(41, 2, 'Ford', 'Kuga', 2017, 26000.00, 80),
(42, 2, 'Kia', 'Ceed', 2020, 23000.00, 80),
(43, 2, 'Citroen', 'C5 Aircross', 2019, 27000.00, 80),
(44, 2, 'Mercedes-Benz', 'GLA', 2018, 30000.00, 80),
(45, 2, 'Mazda', 'CX-30', 2021, 31000.00, 80),
(46, 2, 'Nissan', 'Juke', 2016, 19000.00, 80),
(47, 2, 'Honda', 'HR-V', 2017, 22000.00, 80),
(48, 2, 'Skoda', 'Kodiaq', 2018, 32000.00, 80),
(49, 2, 'BMW', 'X1', 2019, 36000.00, 80),
(50, 2, 'Volkswagen', 'Arteon', 2018, 33000.00, 70),
(51, 2, 'Toyota', 'C-HR', 2020, 28000.00, 0),
(52, 2, 'Audi', 'A5', 2016, 38000.00, 80),
(53, 2, 'Hyundai', 'Santa Fe', 2017, 29000.00, 80),
(54, 2, 'Seat', 'Ateca', 2018, 25000.00, 80),
(55, 2, 'Subaru', 'XV', 2019, 27000.00, 80),
(56, 2, 'Renault', 'Kadjar', 2020, 22000.00, 80),
(57, 2, 'Peugeot', '5008', 2018, 28000.00, 74),
(58, 2, 'Ford', 'EcoSport', 2017, 20000.00, 80),
(59, 2, 'Kia', 'Sportage', 2016, 24000.00, 80),
(60, 2, 'Citroen', 'C4 Cactus', 2019, 21000.00, 80),
(61, 2, 'Mercedes-Benz', 'GLB', 2020, 32000.00, 80),
(62, 3, 'Volvo', 'XC60', 2021, 65000.00, 38),
(63, 3, 'Renault', 'Captur', 2019, 28000.00, 80),
(64, 3, 'Peugeot', '308', 2017, 22000.00, 74),
(65, 3, 'Opel', 'Astra', 2018, 21000.00, 80),
(66, 3, 'Hyundai', 'i30', 2017, 18000.00, 80),
(67, 3, 'BMW', '3 Series', 2019, 35000.00, 80),
(68, 3, 'Mazda', '3', 2020, 26000.00, 80),
(69, 3, 'Kia', 'Rio', 2017, 17000.00, 80),
(70, 3, 'Audi', 'A3', 2020, 32000.00, 80),
(71, 3, 'Toyota', 'Yaris', 2017, 15000.00, 0),
(72, 3, 'Ford', 'Fiesta', 2016, 14000.00, 80),
(73, 3, 'Mercedes-Benz', 'A-Class', 2018, 28000.00, 80),
(74, 3, 'Skoda', 'Octavia', 2019, 23000.00, 80),
(75, 3, 'Honda', 'Civic', 2017, 20000.00, 80),
(76, 3, 'Volkswagen', 'Golf', 2019, 27000.00, 70),
(77, 3, 'Renault', 'Clio', 2015, 15000.00, 80),
(78, 3, 'Toyota', 'Corolla', 2018, 25000.00, 0),
(79, 3, 'Audi', 'A1', 2019, 25000.00, 80),
(80, 3, 'Ford', 'Focus', 2016, 20000.00, 80),
(81, 3, 'Mercedes-Benz', 'CLA', 2020, 32000.00, 80),
(82, 3, 'BMW', '1 Series', 2018, 28000.00, 80),
(83, 3, 'Volkswagen', 'Polo', 2016, 16000.00, 70),
(84, 3, 'Seat', 'Leon', 2017, 20000.00, 80),
(85, 3, 'Renault', 'Megane', 2016, 17000.00, 80),
(86, 3, 'Peugeot', '208', 2019, 19000.00, 74),
(87, 3, 'Citroen', 'C3', 2018, 18000.00, 80),
(88, 3, 'Subaru', 'Impreza', 2016, 22000.00, 80),
(89, 3, 'Fiat', 'Punto', 2020, 15000.00, 80),
(90, 3, 'Opel', 'Corsa', 2017, 17000.00, 80),
(91, 3, 'Lexus', 'IS', 2021, 42000.00, 70),
(92, 3, 'Volvo', 'S60', 2016, 30000.00, 48),
(93, 4, 'Peugeot', '308', 2017, 18000.00, 74),
(94, 4, 'Mazda', 'CX-5', 2020, 30000.00, 80),
(95, 4, 'Fiat', '500', 2015, 12000.00, 80),
(96, 4, 'Citroen', 'C4', 2018, 19000.00, 80),
(97, 4, 'Ford', 'Focus', 2016, 20000.00, 80),
(98, 4, 'Seat', 'Ibiza', 2016, 16000.00, 80),
(99, 4, 'Nissan', 'Qashqai', 2018, 25000.00, 80),
(100, 4, 'Hyundai', 'Tucson', 2018, 22000.00, 80),
(101, 4, 'Renault', 'Megane', 2016, 17000.00, 80),
(102, 4, 'Subaru', 'Forester', 2019, 32000.00, 80),
(103, 4, 'Volkswagen', 'Golf', 2019, 27000.00, 70),
(104, 4, 'Skoda', 'Octavia', 2019, 23000.00, 80),
(105, 4, 'Honda', 'Civic', 2017, 20000.00, 80),
(106, 4, 'Audi', 'A3', 2020, 32000.00, 80),
(107, 4, 'Mercedes-Benz', 'A-Class', 2018, 28000.00, 80),
(108, 4, 'BMW', '3 Series', 2019, 35000.00, 80),
(109, 4, 'Opel', 'Astra', 2018, 21000.00, 80),
(110, 4, 'Toyota', 'Corolla', 2018, 25000.00, 0),
(111, 4, 'Renault', 'Clio', 2015, 15000.00, 80),
(112, 4, 'Ford', 'Fiesta', 2016, 14000.00, 80),
(113, 4, 'Volkswagen', 'Polo', 2016, 16000.00, 70),
(114, 4, 'Audi', 'A1', 2019, 25000.00, 80),
(115, 4, 'Seat', 'Leon', 2017, 20000.00, 80),
(116, 4, 'Lexus', 'IS', 2021, 42000.00, 70),
(117, 4, 'Volvo', 'S60', 2016, 30000.00, 48),
(118, 4, 'Mazda', '3', 2020, 26000.00, 80),
(119, 4, 'Kia', 'Rio', 2017, 17000.00, 80),
(120, 4, 'Peugeot', '208', 2019, 19000.00, 74),
(121, 4, 'Citroen', 'C3', 2018, 18000.00, 80),
(122, 4, 'Subaru', 'Impreza', 2016, 22000.00, 80),
(123, 5, 'Mercedes-Benz', 'C-Class', 2019, 45000.00, 80),
(124, 5, 'Kia', 'Sportage', 2020, 27000.00, 80),
(125, 5, 'Renault', 'Captur', 2019, 28000.00, 80),
(126, 5, 'Fiat', '500', 2015, 12000.00, 80),
(127, 5, 'Subaru', 'XV', 2019, 27000.00, 80),
(128, 5, 'Seat', 'Arona', 2020, 22000.00, 80),
(129, 5, 'Ford', 'EcoSport', 2017, 20000.00, 80),
(130, 5, 'Volkswagen', 'T-Cross', 2018, 25000.00, 70),
(131, 5, 'Peugeot', '2008', 2017, 18000.00, 74),
(132, 5, 'Mazda', 'CX-3', 2020, 24000.00, 80),
(133, 5, 'Citroen', 'C4 Cactus', 2019, 21000.00, 80),
(134, 5, 'Toyota', 'CHR', 2018, 23000.00, 0),
(135, 5, 'Nissan', 'Juke', 2016, 19000.00, 80),
(136, 5, 'Hyundai', 'Kona', 2018, 20000.00, 80),
(137, 5, 'Audi', 'Q2', 2021, 31000.00, 80),
(138, 5, 'BMW', 'X2', 2020, 34000.00, 80),
(139, 5, 'Mercedes-Benz', 'GLA', 2018, 30000.00, 80),
(140, 5, 'Renault', 'Kadjar', 2020, 22000.00, 80),
(141, 5, 'Fiat', '500X', 2017, 19000.00, 80),
(142, 5, 'Kia', 'Ceed', 2020, 23000.00, 80),
(143, 5, 'Volkswagen', 'T-Roc', 2019, 27000.00, 70),
(144, 5, 'Skoda', 'Kamiq', 2018, 24000.00, 80),
(145, 5, 'Seat', 'Ateca', 2018, 25000.00, 80),
(146, 5, 'Ford', 'Puma', 2020, 26000.00, 80),
(147, 5, 'Peugeot', '3008', 2018, 25000.00, 74),
(148, 5, 'Mazda', 'CX-30', 2021, 31000.00, 80),
(149, 5, 'Citroen', 'C5 Aircross', 2019, 27000.00, 80),
(150, 5, 'Toyota', 'Rav4', 2019, 34000.00, 0),
(151, 5, 'Nissan', 'Qashqai', 2018, 25000.00, 80),
(152, 5, 'Hyundai', 'Tucson', 2018, 22000.00, 80),
(160, 4, 'Skoda', 'Fabia', 2004, 12.00, 12),
(161, 1, 'Skoda', 'Fabia', 2004, 12.00, 13),
(162, 1, 'Skoda', 'Fabia', 2004, 12.00, 13),
(163, 1, 'Skoda', 'Fabia', 2004, 12.00, 13),
(164, 1, 'Skoda', 'Fabia', 2004, 12.00, 13),
(166, 3, 'nowa', 'nowy', NULL, 200202.00, 19),
(167, 3, 'nowa', 'nowy', NULL, 200202.00, 19),
(168, 3, 'Skoda', 'Fabia', 2004, 2007.00, 20),
(169, 1, 'nowy', 'stary', NULL, 210210.00, 30);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_klienta`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- Indeksy dla tabeli `magazyn`
--
ALTER TABLE `magazyn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_modelu` (`id_modelu`);

--
-- Indeksy dla tabeli `sprzedawcy`
--
ALTER TABLE `sprzedawcy`
  ADD PRIMARY KEY (`id_sprzedawcy`);

--
-- Indeksy dla tabeli `tranzakcje`
--
ALTER TABLE `tranzakcje`
  ADD PRIMARY KEY (`id_tranzakcji`),
  ADD KEY `id_sprzedawcy` (`id_sprzedawcy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `magazyn`
--
ALTER TABLE `magazyn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sprzedawcy`
--
ALTER TABLE `sprzedawcy`
  MODIFY `id_sprzedawcy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tranzakcje`
--
ALTER TABLE `tranzakcje`
  MODIFY `id_tranzakcji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `magazyn`
--
ALTER TABLE `magazyn`
  ADD CONSTRAINT `magazyn_ibfk_1` FOREIGN KEY (`id_modelu`) REFERENCES `tranzakcje` (`id_tranzakcji`);

--
-- Constraints for table `tranzakcje`
--
ALTER TABLE `tranzakcje`
  ADD CONSTRAINT `tranzakcje_ibfk_1` FOREIGN KEY (`id_sprzedawcy`) REFERENCES `sprzedawcy` (`id_sprzedawcy`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
