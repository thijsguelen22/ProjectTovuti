-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 feb 2017 om 21:38
-- Serverversie: 10.1.13-MariaDB
-- PHP-versie: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mytest`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `antwoorden`
--

CREATE TABLE `antwoorden` (
  `VraagId` int(11) NOT NULL,
  `Antwoord` varchar(80) NOT NULL,
  `IsCorrect` tinyint(1) NOT NULL,
  `AntwoordId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `antwoorden`
--

INSERT INTO `antwoorden` (`VraagId`, `Antwoord`, `IsCorrect`, `AntwoordId`) VALUES
(1, 'Een boolean', 0, 1),
(1, 'Een variable', 1, 2),
(1, 'Een array', 0, 3),
(1, 'Een integer', 0, 4),
(2, 'Een boolean', 0, 5),
(2, 'Een integer', 1, 6),
(2, 'Een array', 0, 7),
(2, 'Een string', 0, 8),
(3, 'een regel', 0, 9),
(3, 'een lijn', 0, 10),
(3, 'een string', 1, 11),
(3, 'een slipje', 0, 12),
(4, 'een dom blondje', 0, 13),
(4, 'een array', 1, 14),
(4, 'een schoolboek', 0, 15),
(4, 'een mobiele telefoon', 0, 16);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `docentcategorieen`
--

CREATE TABLE `docentcategorieen` (
  `ToetsCategorie` varchar(45) NOT NULL,
  `DocentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `docentcategorieen`
--

INSERT INTO `docentcategorieen` (`ToetsCategorie`, `DocentId`) VALUES
('AO', 1),
('IB', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `docenten`
--

CREATE TABLE `docenten` (
  `DocentId` int(11) NOT NULL,
  `DocentNaam` varchar(45) NOT NULL,
  `Level` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `Password` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `docenten`
--

INSERT INTO `docenten` (`DocentId`, `DocentNaam`, `Level`, `email`, `Password`) VALUES
(1, 'Theo van langeveld', 2, 'theo.langeveld@maaslandcollege.nl', 'theolangeveld'),
(2, 'jaanjaap van der veldt', 2, 'janjaap.veldt@maaslandcollege.nl', 'janjaapisdebest');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `docentleerlingen`
--

CREATE TABLE `docentleerlingen` (
  `UserId` int(11) NOT NULL,
  `DocentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `docentleerlingen`
--

INSERT INTO `docentleerlingen` (`UserId`, `DocentId`) VALUES
(1, 1),
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leerlingen`
--

CREATE TABLE `leerlingen` (
  `UserId` int(11) NOT NULL,
  `Username` text NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Voornaam` varchar(50) NOT NULL,
  `Instelling` varchar(50) NOT NULL,
  `Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `leerlingen`
--

INSERT INTO `leerlingen` (`UserId`, `Username`, `Password`, `Voornaam`, `Instelling`, `Level`) VALUES
(1, 'henk@henk.henk', 'henk', 'henk', 'henk B.V', 1),
(2, 'hermanvanveen@safenet.com', 'HermanVanVeenIsDieShit', 'Herman Van Veen', 'Speciaal basisonderwijs amstelveen', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leerlingtoetsen`
--

CREATE TABLE `leerlingtoetsen` (
  `ToetsId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Resultaat` float NOT NULL,
  `IsGemaakt` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `leerlingtoetsen`
--

INSERT INTO `leerlingtoetsen` (`ToetsId`, `UserId`, `Resultaat`, `IsGemaakt`) VALUES
(1, 1, 8, 1),
(2, 1, 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `toetsen`
--

CREATE TABLE `toetsen` (
  `ToetsId` int(11) NOT NULL,
  `ToetsNaam` varchar(55) NOT NULL,
  `ToetsCategorie` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `toetsen`
--

INSERT INTO `toetsen` (`ToetsId`, `ToetsNaam`, `ToetsCategorie`) VALUES
(1, 'PHP Hoofdstuk 1', 'AO'),
(2, 'PHP Hoofdstuk 2', 'AO'),
(3, 'Linux', 'IB');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vragen`
--

CREATE TABLE `vragen` (
  `VraagId` int(11) NOT NULL,
  `Vraag` varchar(80) NOT NULL,
  `ToetsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `vragen`
--

INSERT INTO `vragen` (`VraagId`, `Vraag`, `ToetsId`) VALUES
(1, 'Wat betekend een dollar teken in PHP?', 1),
(2, 'Wat is een ander woord voor een nummer?', 1),
(3, 'Wat is een ander woord voor een zin of woord?', 1),
(4, 'Hoe noem je een "doos" met data?', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `antwoorden`
--
ALTER TABLE `antwoorden`
  ADD PRIMARY KEY (`AntwoordId`),
  ADD KEY `VraagId` (`VraagId`);

--
-- Indexen voor tabel `docentcategorieen`
--
ALTER TABLE `docentcategorieen`
  ADD PRIMARY KEY (`ToetsCategorie`,`DocentId`),
  ADD KEY `ToetsCategorie` (`ToetsCategorie`,`DocentId`);

--
-- Indexen voor tabel `docenten`
--
ALTER TABLE `docenten`
  ADD PRIMARY KEY (`DocentId`);

--
-- Indexen voor tabel `docentleerlingen`
--
ALTER TABLE `docentleerlingen`
  ADD PRIMARY KEY (`UserId`,`DocentId`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `DocentId` (`DocentId`);

--
-- Indexen voor tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexen voor tabel `leerlingtoetsen`
--
ALTER TABLE `leerlingtoetsen`
  ADD PRIMARY KEY (`UserId`,`ToetsId`),
  ADD KEY `ToetsId` (`ToetsId`,`UserId`),
  ADD KEY `ToetsId_2` (`ToetsId`,`UserId`);

--
-- Indexen voor tabel `toetsen`
--
ALTER TABLE `toetsen`
  ADD PRIMARY KEY (`ToetsId`,`ToetsCategorie`);

--
-- Indexen voor tabel `vragen`
--
ALTER TABLE `vragen`
  ADD PRIMARY KEY (`VraagId`),
  ADD KEY `ToetsId` (`ToetsId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `antwoorden`
--
ALTER TABLE `antwoorden`
  MODIFY `AntwoordId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT voor een tabel `docenten`
--
ALTER TABLE `docenten`
  MODIFY `DocentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `toetsen`
--
ALTER TABLE `toetsen`
  MODIFY `ToetsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `vragen`
--
ALTER TABLE `vragen`
  MODIFY `VraagId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
