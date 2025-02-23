-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 23. Feb 2025 um 17:00
-- Server-Version: 10.11.8-MariaDB-0ubuntu0.24.04.1
-- PHP-Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `wi`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_admin`
--

CREATE TABLE `wi_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_adminsetting`
--

CREATE TABLE `wi_adminsetting` (
  `id` int(11) NOT NULL,
  `startregion` varchar(255) NOT NULL,
  `userdir` varchar(255) NOT NULL,
  `griddir` varchar(255) NOT NULL,
  `assetdir` varchar(255) NOT NULL,
  `lastnames` varchar(10) NOT NULL,
  `adress` varchar(32) NOT NULL,
  `region` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_banned`
--

CREATE TABLE `wi_banned` (
  `UUID` varchar(36) NOT NULL,
  `agentIP` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_codetable`
--

CREATE TABLE `wi_codetable` (
  `UUID` varchar(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_country`
--

CREATE TABLE `wi_country` (
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_economy_money`
--

CREATE TABLE `wi_economy_money` (
  `id` int(11) NOT NULL,
  `CentsPerMoneyUnit` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_economy_transactions`
--

CREATE TABLE `wi_economy_transactions` (
  `id` int(11) NOT NULL,
  `sourceId` varchar(36) NOT NULL,
  `destId` varchar(36) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `flags` int(11) NOT NULL DEFAULT 0,
  `aggregatePermInventory` int(11) NOT NULL DEFAULT 0,
  `aggregatePermNextOwner` int(11) NOT NULL DEFAULT 0,
  `description` varchar(256) DEFAULT NULL,
  `transactionType` int(11) NOT NULL DEFAULT 0,
  `timeOccurred` int(11) NOT NULL,
  `RegionGenerated` varchar(36) NOT NULL,
  `IPGenerated` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_lastnames`
--

CREATE TABLE `wi_lastnames` (
  `name` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_pagemanager`
--

CREATE TABLE `wi_pagemanager` (
  `id` int(15) NOT NULL,
  `code` varchar(255) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `rank` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `active` varchar(30) NOT NULL,
  `url` text NOT NULL,
  `target` varchar(255) NOT NULL,
  `display` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_startscreen_infowindow`
--

CREATE TABLE `wi_startscreen_infowindow` (
  `gridstatus` varchar(255) NOT NULL,
  `active` varchar(30) NOT NULL,
  `color` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_startscreen_news`
--

CREATE TABLE `wi_startscreen_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `time` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_users`
--

CREATE TABLE `wi_users` (
  `UUID` varchar(36) NOT NULL DEFAULT '',
  `username` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `passwordHash` varchar(32) NOT NULL,
  `passwordSalt` varchar(32) NOT NULL,
  `realname1` varchar(255) NOT NULL,
  `realname2` varchar(255) NOT NULL,
  `adress1` varchar(255) NOT NULL,
  `zip1` varchar(255) NOT NULL,
  `city1` varchar(255) NOT NULL,
  `country1` varchar(255) NOT NULL,
  `emailadress` varchar(255) NOT NULL,
  `agentIP` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `wi_admin`
--
ALTER TABLE `wi_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `wi_adminsetting`
--
ALTER TABLE `wi_adminsetting`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `wi_economy_money`
--
ALTER TABLE `wi_economy_money`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `wi_economy_transactions`
--
ALTER TABLE `wi_economy_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `wi_pagemanager`
--
ALTER TABLE `wi_pagemanager`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `wi_startscreen_news`
--
ALTER TABLE `wi_startscreen_news`
  ADD KEY `id` (`id`);

--
-- Indizes für die Tabelle `wi_users`
--
ALTER TABLE `wi_users`
  ADD PRIMARY KEY (`UUID`),
  ADD UNIQUE KEY `usernames` (`username`,`lastname`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `wi_admin`
--
ALTER TABLE `wi_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `wi_adminsetting`
--
ALTER TABLE `wi_adminsetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `wi_economy_money`
--
ALTER TABLE `wi_economy_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `wi_economy_transactions`
--
ALTER TABLE `wi_economy_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `wi_pagemanager`
--
ALTER TABLE `wi_pagemanager`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `wi_startscreen_news`
--
ALTER TABLE `wi_startscreen_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
