-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 mrt 2020 om 19:52
-- Serverversie: 10.4.6-MariaDB
-- PHP-versie: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(14, 'daphne.slshc@gmail.com', '$2y$10$xNcnl1hPD1L8miNUQbVyKOY7Iu9L0hhRXAnTqr3e5B/wROQMRPq4u'),
(15, 'aaa@aaa.aaa', '$2y$10$Bt6nPEi.o3iM7Dv3C5KLF.GT11mZrohw.5iblRi2B8aqYtgb1qPg.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `id` int(5) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `active`) VALUES
(1, 'Heren schoenen', 'Schoenen voor heren.', 3),
(2, 'Dames schoenen', 'Schoenen voor dames', 3),
(3, 'Kinder schoenen', 'Schoenen voor kinderen', 2),
(4, 'Baby schoenen', 'Schoenen voor baby\'s', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `middleName` varchar(10) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `houseNumber` int(5) NOT NULL,
  `houseNumber_addon` varchar(5) NOT NULL,
  `zipCode` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone` int(20) NOT NULL,
  `e-mailadres` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `newsletter_subscription` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `customer`
--

INSERT INTO `customer` (`id`, `gender`, `firstName`, `middleName`, `lastName`, `street`, `houseNumber`, `houseNumber_addon`, `zipCode`, `city`, `phone`, `e-mailadres`, `password`, `newsletter_subscription`) VALUES
(1, 'Vrouw', 'Wiepke', '', 'Versloot', 'Kerkweg', 47, '', '3628AM', 'Kockengen', 637281065, 'wiepke2002@icloud.com', 'bc55ca39be64e40b3c84d79ad3e33ef1', 1),
(2, 'Man', 'Pieter', '', 'Panda', 'Pandalaan', 36, '', '3636BP', 'Pandacity', 636363636, 'panda@gmail.com', 'ce61649168c4550c2f7acab92354dc6e', 0),
(3, 'Man', 'Pascal', 'van', 'Bergen', 'Bergenstraat', 103, '', '8372PW', 'Bergenstad', 672819124, 'PascalB@gmail.com', '57c2877c1d84c4b49f3289657deca65c', 1),
(4, 'Vrouw', 'Nikkie', 'den', 'Ouden', 'Steynlaan', 92, '', '3672DB', 'Breukelen', 683625417, 'nikkiedodo@gmail.com', '4b11e0223ffd42b77ddfd629692889ad', 1),
(5, 'Man', 'Patrick', '', 'Mol', 'G. van Doornikstraat', 109, '', '3621HX', 'Breukelen', 627391739, 'patrickmol@gmail.com', '6c84cbd30cf9350a990bad2bcc1bec5f', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `street` varchar(100) NOT NULL,
  `houseNumber` int(10) NOT NULL,
  `houseNumber_addon` varchar(5) NOT NULL,
  `zipCode` varchar(10) NOT NULL,
  `city` varchar(20) NOT NULL,
  `payment` varchar(10) NOT NULL,
  `paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `orderDate`, `street`, `houseNumber`, `houseNumber_addon`, `zipCode`, `city`, `payment`, `paid`) VALUES
(1, 1, '2020-03-24 13:38:25', 'Kerkweg\r\n', 47, '', '3628AM', 'Kockengen', 'paypal', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `amount`) VALUES
(1, 1, 4, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(10) NOT NULL,
  `weight` int(10) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `category_id`, `price`, `color`, `weight`, `active`) VALUES
(1, 'Jordan 1 Mid', 'Mooie groene schoenen', 1, '119.99', 'green', 500, 1),
(16, 'Nike Am 97 Celebration Of The Swoosh Cos', 'Mooie witte schoenen', 1, '99.99', 'white', 600, 1),
(17, 'Vans Authentic', 'Mooie witte schoenen', 1, '79.99', 'gray', 650, 1),
(18, 'Buffalo Crevis', 'Mooie roze schoenen', 2, '99.99', 'pink', 800, 1),
(19, 'Nike Air Max 2090', 'Mooie witte schoenen', 2, '149.99', 'white', 600, 1),
(20, 'Nike Air Max 270', 'Mooie zwarte schoenen', 2, '149.99', 'black', 850, 1),
(21, 'adidas Ozweego Suede', 'Mooie grijze schoenen', 3, '64.99', 'gray', 400, 1),
(22, 'Nike Air Force 1', 'Mooie roze schoenen', 3, '84.99', 'pink', 450, 1),
(23, 'Nike Tuned 1', 'Mooie grijze schoenen', 4, '59.99', 'gray', 150, 1),
(24, ' Nike Air Force 1 Highness', 'Mooie paarse schoenen', 4, '54.99', 'paars', 150, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_image`
--

CREATE TABLE `product_image` (
  `id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `image` varchar(15) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image`, `active`) VALUES
(12, 1, 'j1.png', 1),
(13, 1, 'j2.png', 1),
(14, 1, 'j3.png', 1),
(15, 16, 'am1.png', 1),
(16, 16, 'am2.png', 1),
(17, 16, 'am3.png', 1),
(18, 17, 'v1.png', 1),
(19, 17, 'v2.png', 1),
(20, 17, 'v3.png', 1),
(21, 18, 'b1.png', 1),
(22, 18, 'b2.png', 1),
(23, 18, 'b3.png', 1),
(24, 19, 'n1.png', 1),
(25, 19, 'n2.png', 1),
(26, 19, 'n3.png', 1),
(27, 20, 'air1.png', 1),
(28, 20, 'air2.png', 1),
(29, 20, 'air3.png', 1),
(30, 21, 'oz1.png', 1),
(31, 21, 'oz2.png', 1),
(32, 21, 'oz3.png', 1),
(33, 22, 'cair1.png', 1),
(34, 22, 'cair2.png', 1),
(35, 22, 'cair3.png', 1),
(36, 23, 'bn1.png', 1),
(37, 23, 'bn2.png', 1),
(38, 23, 'bn3.png', 1),
(39, 24, 'bair1.png', 1),
(40, 24, 'bair2.png', 1),
(41, 24, 'bair3.png', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `firstName` varchar(15) NOT NULL,
  `middleName` varchar(10) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `birthDate` date NOT NULL,
  `e-mailadres` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `firstName`, `middleName`, `lastName`, `birthDate`, `e-mailadres`, `password`) VALUES
(1, 'Daphne', '', 'Mol', '2002-02-16', 'daphne.slshc@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Jan', 'van', 'Os', '1946-05-05', 'jos@glu.nl', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `e-mailadres` (`e-mailadres`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`,`customer_id`);

--
-- Indexen voor tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `e-mailadres` (`e-mailadres`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT voor een tabel `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
