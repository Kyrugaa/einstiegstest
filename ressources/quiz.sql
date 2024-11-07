-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Nov 2024 um 12:29
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `quiz`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `is_correct`, `created_at`) VALUES
(1, 1, 'Serielles Bussystem zur Verbindung eines Computers mit externen Geräten', 1, '2024-11-05 10:05:33'),
(2, 1, 'Paralleles Bussystem zu Verbindung von Druckern', 0, '2024-11-05 10:05:33'),
(3, 1, 'Kabel zur Verbindung von Festplatten', 0, '2024-11-05 10:05:33'),
(4, 1, 'Kabel zur Verbindung von Mobilen Geräten', 0, '2024-11-05 10:05:33'),
(5, 2, 'Tabellenkalkulationsprogramm', 0, '2024-11-05 12:14:52'),
(6, 2, 'Videobearbeitungsprogramm', 0, '2024-11-05 12:14:52'),
(7, 2, 'Textverarbeitungsprogramm', 1, '2024-11-05 12:14:52'),
(8, 2, 'Kundendatenverwaltungsprogramm', 0, '2024-11-05 12:14:52');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `questions`
--

INSERT INTO `questions` (`id`, `question`, `created_at`) VALUES
(1, 'Was bedeutet USB?', '2024-11-05 10:05:33'),
(2, 'Was ist Microsoft Word?', '2024-11-05 12:14:52');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teilnehmer`
--

CREATE TABLE `teilnehmer` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `firstName` varchar(250) NOT NULL,
  `lastName` varchar(250) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `teilnehmer`
--

INSERT INTO `teilnehmer` (`id`, `datum`, `firstName`, `lastName`, `score`) VALUES
(1, '2024-11-05', 'Joel', 'Marti', 1),
(2, '2024-11-05', 'Joel', 'Marti', 1),
(3, '2024-11-05', 'Joel', 'Marti', 1),
(4, '2024-11-05', 'Joel', 'Marti', 1),
(5, '2024-11-05', 'Joel', 'Marti', 1),
(6, '2024-11-05', 'Joel', 'Marti', 1),
(7, '2024-11-06', 'Joel', 'Marti', 1),
(8, '2024-11-06', 'Joel', 'Marti', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indizes für die Tabelle `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `teilnehmer`
--
ALTER TABLE `teilnehmer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `teilnehmer`
--
ALTER TABLE `teilnehmer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
