-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 dec 2017 om 10:07
-- Serverversie: 10.1.21-MariaDB
-- PHP-versie: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Tabelstructuur voor tabel `beginvoorraad-jaartal`
--

CREATE TABLE `beginvoorraad-jaartal` (
  `id` int(11) NOT NULL,
  `tabelnaam` varchar(255) NOT NULL,
  `jaartal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `id` int(11) NOT NULL,
  `klantid` int(11) NOT NULL,
  `datum` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`id`, `klantid`, `datum`, `status`) VALUES
(1, 1, '10-11-2017', 3);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `bestellingoverzicht`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `bestellingoverzicht` (
`Bestellingsnummer` int(11)
,`Klantnaam` varchar(255)
,`Email` varchar(255)
,`Adres` varchar(255)
,`Postcode` varchar(255)
,`Woonplaats` varchar(255)
,`Besteldatum` varchar(255)
,`Bestellingstatus` varchar(255)
,`Artikelcode` varchar(255)
,`Productnaam` varchar(255)
,`Maat` varchar(255)
,`Hoeveelheid` int(11)
,`Gereseveerd` int(11)
,`Verkoopprijs` double
);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingproduct`
--

CREATE TABLE `bestellingproduct` (
  `bestellingid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `hoeveelheid` int(11) NOT NULL,
  `gereseveerd` int(11) NOT NULL,
  `maat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingproduct`
--

INSERT INTO `bestellingproduct` (`bestellingid`, `productid`, `hoeveelheid`, `gereseveerd`, `maat`) VALUES
(1, 4, 1, 0, 8);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `bundeloverzicht`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `bundeloverzicht` (
`bundelid` int(11)
,`Bundelcode` varchar(255)
,`Bundelnaam` varchar(255)
,`Bundelprijs` double
,`productid` int(11)
,`Productcode` varchar(255)
,`Productnaam` varchar(255)
);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bundelproduct`
--

CREATE TABLE `bundelproduct` (
  `bundelid` int(11) NOT NULL,
  `productid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bundelproduct`
--

INSERT INTO `bundelproduct` (`bundelid`, `productid`) VALUES
(4, 10),
(4, 13);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `categorie` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `categorie`
--

INSERT INTO `categorie` (`id`, `categorie`) VALUES
(1, 'Shirt Korte Mouw Beide'),
(2, 'Shirt Lange Mouw Zomer'),
(3, 'Shirt Lange Mouw Winter'),
(4, 'Jassen Beide');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `fotos`
--

CREATE TABLE `fotos` (
  `productid` int(11) NOT NULL,
  `foto` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `plaats` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `saltcode` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `naam`, `email`, `adres`, `postcode`, `plaats`, `wachtwoord`, `saltcode`) VALUES
(1, 'Marten Meijboom', 'marten1998@hotmail.com', 'Schumannstraat 1', '3906CD', 'Veenendaal', 'qDqTmPpvgqM=', NULL),
(2, 'Beheerder', 'gerardvdpol@casema.nl', 'Waardgelder 3', '3905', 'Veenendaal', '1Ai6OvCXihEO+pcUWoMJyA==', NULL),
(6, 'Erik van IJzendoorn', 'erik.vanijzendoorn@hotmail.com', 'nijenheim 6317', '3704BL', 'Zeist', 'efc3613974c1ca1290c43d7ad24538ece1da854b445856e1cd91b10f22c9d1f228138769597213acfe0a9769677deaa51b2e979f9fbf899076d27759d93d6317', 'IdTdIMAADR7fxLOHXAfrH8l9aDJvV0TWmEy71JVHPLXCX3ocsCruuUBdGzYrOO4j');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `type` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gender`
--

INSERT INTO `gender` (`id`, `type`) VALUES
(1, 'Mannen'),
(2, 'Vrouwen'),
(3, 'Beide');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inboekregister`
--

CREATE TABLE `inboekregister` (
  `productid` int(11) NOT NULL,
  `8jr` int(11) NOT NULL,
  `10jr` int(11) NOT NULL,
  `12jr` int(11) NOT NULL,
  `14jr` int(11) NOT NULL,
  `3XS` int(11) NOT NULL,
  `XXS` int(11) NOT NULL,
  `XS` int(11) NOT NULL,
  `S` int(11) NOT NULL,
  `M` int(11) NOT NULL,
  `L` int(11) NOT NULL,
  `XL` int(11) NOT NULL,
  `XXL` int(11) NOT NULL,
  `3XL` int(11) NOT NULL,
  `inkoopprijs` double NOT NULL,
  `inkoopdatum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `maten`
--

CREATE TABLE `maten` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `maten`
--

INSERT INTO `maten` (`id`, `naam`) VALUES
(2, '10jr'),
(3, '12jr'),
(12, '3XL'),
(4, '3XS'),
(1, '8jr'),
(9, 'L'),
(8, 'M'),
(7, 'S'),
(10, 'XL'),
(6, 'XS'),
(11, 'XXL'),
(5, 'XXS');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `id` int(11) NOT NULL,
  `artikelcode` varchar(255) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `omschrijving` text NOT NULL,
  `verkoopprijs` double NOT NULL,
  `categorie` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `isbundel` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`id`, `artikelcode`, `naam`, `omschrijving`, `verkoopprijs`, `categorie`, `gender`, `isbundel`) VALUES
(19, 'SKM(h)', 'Shirt korte mouw (heren)', '', 40, 1, 1, 0),
(20, 'SKM(d)', 'Shirt korte mouw (dames)', '', 40, 1, 2, 0),
(21, 'SLMZ', 'Shirt lange mouw zomer', '', 43, 2, 3, 0),
(22, 'SLM(2e)', 'Shirt lange mouw (2e layer)', '', 47, 3, 3, 0),
(23, 'BWMR', 'Bodywarmer', 'Dit is een lekkere warme bodywarmer', 50, 4, 3, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `status`
--

INSERT INTO `status` (`id`, `naam`) VALUES
(1, 'Wachten op goedkeuring'),
(2, 'Nog niet betaald'),
(3, 'Wachten op producten'),
(4, 'Betaald - nog niet opgehaald'),
(5, 'Afgehandeld'),
(6, 'Afgekeurd');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `voorraad`
--

CREATE TABLE `voorraad` (
  `productid` int(11) NOT NULL,
  `maat` int(11) NOT NULL,
  `hoeveelheid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `voorraad`
--

INSERT INTO `voorraad` (`productid`, `maat`, `hoeveelheid`) VALUES
(19, 1, 3),
(19, 2, 1),
(19, 3, 5),
(19, 4, 0),
(19, 5, 1),
(19, 6, 2),
(19, 7, 5),
(19, 8, 4),
(19, 9, 6),
(19, 10, 4),
(19, 11, 3),
(19, 12, 2),
(20, 1, 0),
(20, 2, 1),
(20, 3, 0),
(20, 4, 0),
(20, 5, 0),
(20, 6, 3),
(20, 7, 4),
(20, 8, 3),
(20, 9, 0),
(20, 10, 6),
(20, 11, 5),
(20, 12, 2),
(21, 1, 3),
(21, 2, 0),
(21, 3, 0),
(21, 4, 5),
(21, 5, 4),
(21, 6, 5),
(21, 7, 2),
(21, 8, 1),
(21, 9, 4),
(21, 10, 6),
(21, 11, 3),
(21, 12, 2),
(22, 1, 1),
(22, 2, 5),
(22, 3, 2),
(22, 4, 8),
(22, 5, 2),
(22, 6, 1),
(22, 7, 2),
(22, 8, 2),
(22, 9, 1),
(22, 10, 4),
(22, 11, 1),
(22, 12, 2),
(23, 1, 4),
(23, 2, 1),
(23, 3, 7),
(23, 4, 1),
(23, 5, 1),
(23, 6, 2),
(23, 7, 5),
(23, 8, 2),
(23, 9, 2),
(23, 10, 1),
(23, 11, 11),
(23, 12, 4);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `voorraadoverzicht`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `voorraadoverzicht` (
`id` int(11)
,`Artikelcode` varchar(255)
,`Productnaam` varchar(255)
,`MaatID` int(11)
,`Maat` varchar(255)
,`Hoeveelheid` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `voorraadoverzicht_sheetnotatie`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `voorraadoverzicht_sheetnotatie` (
`id` int(11)
,`Productnaam` varchar(255)
,`8jr` bigint(11)
,`10jr` bigint(11)
,`12jr` bigint(11)
,`3XS` bigint(11)
,`XXS` bigint(11)
,`XS` bigint(11)
,`S` bigint(11)
,`M` bigint(11)
,`L` bigint(11)
,`XL` bigint(11)
,`3XL` bigint(11)
);

-- --------------------------------------------------------

--
-- Structuur voor de view `bestellingoverzicht`
--
DROP TABLE IF EXISTS `bestellingoverzicht`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u297542_beheer`@`%` SQL SECURITY INVOKER VIEW `bestellingoverzicht`  AS  select `best`.`id` AS `Bestellingsnummer`,`gebr`.`naam` AS `Klantnaam`,`gebr`.`email` AS `Email`,`gebr`.`adres` AS `Adres`,`gebr`.`postcode` AS `Postcode`,`gebr`.`plaats` AS `Woonplaats`,`best`.`datum` AS `Besteldatum`,`stat`.`naam` AS `Bestellingstatus`,`pro`.`artikelcode` AS `Artikelcode`,`pro`.`naam` AS `Productnaam`,`maat`.`naam` AS `Maat`,`bpr`.`hoeveelheid` AS `Hoeveelheid`,`bpr`.`gereseveerd` AS `Gereseveerd`,`pro`.`verkoopprijs` AS `Verkoopprijs` from (((((`bestellingen` `best` join `bestellingproduct` `bpr` on((`best`.`id` = `bpr`.`bestellingid`))) join `producten` `pro` on((`bpr`.`productid` = `pro`.`id`))) join `status` `stat` on((`best`.`status` = `stat`.`id`))) join `gebruikers` `gebr` on((`best`.`klantid` = `gebr`.`id`))) join `maten` `maat` on((`bpr`.`maat` = `maat`.`id`))) ;

-- --------------------------------------------------------

--
-- Structuur voor de view `bundeloverzicht`
--
DROP TABLE IF EXISTS `bundeloverzicht`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u297542_beheer`@`%` SQL SECURITY INVOKER VIEW `bundeloverzicht`  AS  select `bund`.`id` AS `bundelid`,`bund`.`artikelcode` AS `Bundelcode`,`bund`.`naam` AS `Bundelnaam`,`bund`.`verkoopprijs` AS `Bundelprijs`,`pro`.`id` AS `productid`,`pro`.`artikelcode` AS `Productcode`,`pro`.`naam` AS `Productnaam` from ((`producten` `bund` join `bundelproduct` `bpr` on((`bund`.`id` = `bpr`.`bundelid`))) join `producten` `pro` on((`bpr`.`productid` = `pro`.`id`))) ;

-- --------------------------------------------------------

--
-- Structuur voor de view `voorraadoverzicht`
--
DROP TABLE IF EXISTS `voorraadoverzicht`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u297542_beheer`@`%` SQL SECURITY INVOKER VIEW `voorraadoverzicht`  AS  select `pro`.`id` AS `id`,`pro`.`artikelcode` AS `Artikelcode`,`pro`.`naam` AS `Productnaam`,`maat`.`id` AS `MaatID`,`maat`.`naam` AS `Maat`,`voor`.`hoeveelheid` AS `Hoeveelheid` from ((`producten` `pro` join `voorraad` `voor` on((`pro`.`id` = `voor`.`productid`))) join `maten` `maat` on((`maat`.`id` = `voor`.`maat`))) ;

-- --------------------------------------------------------

--
-- Structuur voor de view `voorraadoverzicht_sheetnotatie`
--
DROP TABLE IF EXISTS `voorraadoverzicht_sheetnotatie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u297542_beheer`@`%` SQL SECURITY INVOKER VIEW `voorraadoverzicht_sheetnotatie`  AS  select `voorraadoverzicht`.`id` AS `id`,`voorraadoverzicht`.`Productnaam` AS `Productnaam`,max(if((`voorraadoverzicht`.`Maat` = '8jr'),`voorraadoverzicht`.`Hoeveelheid`,NULL)) AS `8jr`,max(if((`voorraadoverzicht`.`Maat` = '10jr'),`voorraadoverzicht`.`Hoeveelheid`,NULL)) AS `10jr`,max(if((`voorraadoverzicht`.`Maat` = '12jr'),`voorraadoverzicht`.`Hoeveelheid`,NULL)) AS `12jr`,max(if((`voorraadoverzicht`.`Maat` = '3XS'),`voorraadoverzicht`.`Hoeveelheid`,NULL)) AS `3XS`,max(if((`voorraadoverzicht`.`Maat` = 'XXS'),`voorraadoverzicht`.`Hoeveelheid`,NULL)) AS `XXS`,max(if((`voorraadoverzicht`.`Maat` = 'XS'),`voorraadoverzicht`.`Hoeveelheid`,NULL)) AS `XS`,max(if((`voorraadoverzicht`.`Maat` = 'S'),`voorraadoverzicht`.`Hoeveelheid`,NULL)) AS `S`,max(if((`voorraadoverzicht`.`Maat` = 'M'),`voorraadoverzicht`.`Hoeveelheid`,NULL)) AS `M`,max(if((`voorraadoverzicht`.`Maat` = 'L'),`voorraadoverzicht`.`Hoeveelheid`,NULL)) AS `L`,max(if((`voorraadoverzicht`.`Maat` = 'XL'),`voorraadoverzicht`.`Hoeveelheid`,NULL)) AS `XL`,max(if((`voorraadoverzicht`.`Maat` = '3XL'),`voorraadoverzicht`.`Hoeveelheid`,NULL)) AS `3XL` from `voorraadoverzicht` group by `voorraadoverzicht`.`Productnaam` ;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `beginvoorraad-jaartal`
--
ALTER TABLE `beginvoorraad-jaartal`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `bestellingproduct`
--
ALTER TABLE `bestellingproduct`
  ADD UNIQUE KEY `bestellingid` (`bestellingid`,`productid`);

--
-- Indexen voor tabel `bundelproduct`
--
ALTER TABLE `bundelproduct`
  ADD UNIQUE KEY `bundelid` (`bundelid`,`productid`);

--
-- Indexen voor tabel `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `inboekregister`
--
ALTER TABLE `inboekregister`
  ADD PRIMARY KEY (`productid`);

--
-- Indexen voor tabel `maten`
--
ALTER TABLE `maten`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naam` (`naam`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `naam` (`naam`),
  ADD UNIQUE KEY `artikelcode` (`artikelcode`);

--
-- Indexen voor tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `voorraad`
--
ALTER TABLE `voorraad`
  ADD UNIQUE KEY `productid` (`productid`,`maat`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `beginvoorraad-jaartal`
--
ALTER TABLE `beginvoorraad-jaartal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `maten`
--
ALTER TABLE `maten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT voor een tabel `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
