-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 28, 2021 at 05:54 AM
-- Server version: 10.6.5-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mineko_map`
--

-- --------------------------------------------------------

--
-- Table structure for table `raions`
--

CREATE TABLE `raions` (
  `id_raion` bigint(20) UNSIGNED NOT NULL,
  `raion` varchar(50) NOT NULL,
  `lnk` text NOT NULL,
  `city_mo_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `raions`
--

INSERT INTO `raions` (`id_raion`, `raion`, `lnk`, `city_mo_id`) VALUES
(1, 'Абдулинский городской округ', 'abdulino.php', NULL),
(2, 'Адамовский район', 'adamov.php', NULL),
(3, 'Акбулакский район', 'akbulak.php', NULL),
(4, 'Александровский район', 'aleksandrov.php', NULL),
(5, 'Асекеевский район', 'asekeev.php', NULL),
(6, 'Беляевский район', 'belyaev.php', NULL),
(7, 'Бугурусланский район', 'buguruslan.php', NULL),
(8, 'Бузулукский район', 'buzuluk.php', NULL),
(9, 'Гайский городской округ', 'gai.php', NULL),
(10, 'Грачёвский район', 'grachev.php', NULL),
(11, 'Домбаровский район', 'dombarov.php', NULL),
(12, 'Илекский район', 'ilek.php', NULL),
(13, 'Кваркенский район', 'kvarken.php', NULL),
(14, 'Красногвардейский район', 'krasnogvard.php', NULL),
(15, 'Кувандыкский городской округ', 'kuvandik.php', NULL),
(16, 'Курманаевский район', 'kurmanaev.php', NULL),
(17, 'Матвеевский район', 'matveevsk.php', NULL),
(18, 'Новоорский район', 'novoorsk.php', NULL),
(19, 'Новосергиевский район', 'novosergiev.php', NULL),
(20, 'Октябрьский район', 'oktyabr.php', NULL),
(21, 'Оренбургский район', 'orenburg.php', NULL),
(22, 'Первомайский район', 'pervomaysk.php', NULL),
(23, 'Переволоцкий район', 'perevolozk.php', NULL),
(24, 'Пономарёвский район', 'ponomarev.php', NULL),
(25, 'Сакмарский район', 'sakmar.php', NULL),
(26, 'Саракташский район', 'saraktash.php', NULL),
(27, 'Светлинский район', 'svetlinsk.php', NULL),
(28, 'Северный район', 'severnii.php', NULL),
(29, 'Соль-Илецкий городской округ', 'solilezk.php', NULL),
(30, 'Сорочинский городской округ', 'sorochinsk.php', NULL),
(31, 'Ташлинский район', 'tashlinsk.php', NULL),
(32, 'Тоцкий район', 'tozk', NULL),
(33, 'Тюльганский район', 'tulgansk.php', NULL),
(34, 'Шарлыкский район', 'sharliksk.php', NULL),
(35, 'Ясненский городской округ', 'yasnensk.php', NULL),
(36, 'город Орск', 'orsk.php', NULL),
(37, 'город Новотроицк', 'novotroizk.php', NULL),
(38, 'город Оренбург', 'orenburg.php', NULL),
(39, 'город Бугуруслан', 'buguruslan.php', 7),
(40, 'город Бузулук', 'buzuluk.php', 8),
(41, 'город Медногорск', 'mednogorsk.php', 15),
(42, 'ЗАТО п. \'Комаровский\'', 'zato.php', 35);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `raions`
--
ALTER TABLE `raions`
  ADD UNIQUE KEY `id_raion` (`id_raion`),
  ADD KEY `city_mo_id` (`city_mo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `raions`
--
ALTER TABLE `raions`
  MODIFY `id_raion` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `raions`
--
ALTER TABLE `raions`
  ADD CONSTRAINT `raions_ibfk_1` FOREIGN KEY (`city_mo_id`) REFERENCES `raions` (`id_raion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
