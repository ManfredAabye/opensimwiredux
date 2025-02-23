-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 23. Feb 2025 um 18:31
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

--
-- Daten für Tabelle `wi_admin`
--

INSERT INTO `wi_admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '84e78b596fa8e391c49f3c4df7b9c57f');

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

--
-- Daten für Tabelle `wi_adminsetting`
--

INSERT INTO `wi_adminsetting` (`id`, `startregion`, `userdir`, `griddir`, `assetdir`, `lastnames`, `adress`, `region`) VALUES
(1, '', '', '', '', '0', '0', '0');

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

--
-- Daten für Tabelle `wi_country`
--

INSERT INTO `wi_country` (`name`) VALUES
('Albania'),
('Belgium'),
('Bosnia'),
('Bulgaria'),
('Germany'),
('Denmark'),
('Estonia'),
('Finland'),
('France'),
('Georgia'),
('Greece'),
('United Kingdom'),
('Ireland'),
('Iceland'),
('Italy'),
('Croatia'),
('Latvia'),
('Lithuania'),
('Luxembourg'),
('Malta'),
('Macedonia'),
('Moldova'),
('Netherlands'),
('Norway'),
('Poland'),
('Portugal'),
('Romania'),
('Russia'),
('Sweden'),
('Switzerland'),
('Serbia & Montenegro'),
('Slovakia'),
('Slovenia'),
('Espana'),
('Czech Rep.'),
('Turkey'),
('Ukraine'),
('Hungary'),
('Belarus'),
('Cyprus'),
('Austria'),
('Afghanistan'),
('Armenia'),
('Azerbaijan'),
('Bangladesh'),
('Bhutan'),
('Brunei'),
('India'),
('Indonesia'),
('Japan'),
('Cambodia'),
('Kazakhstan'),
('Kyrgyzstan'),
('Laos'),
('Malaysia'),
('Maldives'),
('Mongolia'),
('Myanmar'),
('Nepal'),
('North Korea'),
('Pakistan'),
('Philippines'),
('Singapore'),
('Sri Lanka'),
('South Korea'),
('Tajikistan'),
('Taiwan'),
('Thailand'),
('Turkmenistan'),
('Uzbekistan'),
('Viet Nam'),
('Canada'),
('Mexico'),
('USA'),
('Antigua und Barbuda'),
('Aruba'),
('Bahamas'),
('Barbados'),
('Belize'),
('Bermuda'),
('Cayman Islands'),
('Costa Rica'),
('Curacao'),
('Dominica'),
('Dominican Rep.'),
('El Salvador'),
('Grenada'),
('Guadeloupe'),
('Guatemala'),
('Haiti'),
('Honduras'),
('Jamaica'),
('Virgin Islands'),
('Cuba'),
('Martinique'),
('Nicaragua'),
('Panama'),
('Puerto Rico'),
('St. Kitts und Nevis'),
('St. Lucia'),
('St. Maarten'),
('St. Vincent & Grenadin'),
('Trinidad & Tobago'),
('Argentina'),
('Bolivia'),
('Brazil'),
('Chile'),
('Ecuador'),
('Guyana'),
('Colombia'),
('Paraguay'),
('Peru'),
('Suriname'),
('Uruguay'),
('Venezuela'),
('Australia'),
('Fiji'),
('Marshall Islands'),
('Micronesia'),
('Nauru'),
('New Zealand'),
('Palau'),
('Papua New Guinea'),
('Samoa'),
('Tonga'),
('Tuvalu'),
('Vanuatu'),
('Bahrain'),
('Iraq'),
('Iran'),
('Israel'),
('Yemen'),
('Jordan'),
('Quatar'),
('Kuwait'),
('Lebanon'),
('Oman'),
('Palestinian authority'),
('Saudi Arabia'),
('Syria'),
('U.A.E.'),
('Algeria'),
('Angola'),
('Benin'),
('Botswana'),
('Burkina Faso'),
('Burundi'),
('Dem. Rep. of the Congo'),
('Djibouti'),
('Céte d\'Ivoire'),
('Eritrea'),
('Gabun'),
('Gambia'),
('Ghana'),
('Guinea'),
('Guinea-Bissau'),
('Cameroon'),
('Cape Verde'),
('Kenya'),
('Lesotho'),
('Liberia'),
('Libya'),
('Madagascar'),
('Malawi'),
('Mali'),
('Morocco'),
('Mauritania'),
('Mauritius'),
('Mozambique'),
('Namibia'),
('Niger'),
('Nigeria'),
('Dem. Rep. of the Congo'),
('Zambia'),
('Sao Tomé and Principe'),
('Senegal'),
('Seychelles'),
('Sierra Leone'),
('Simbabwe'),
('Somalia'),
('Sudan'),
('Swaziland'),
('South Africa'),
('Tanzania'),
('Togo'),
('Chad'),
('Tunisia'),
('Uganda'),
('Central African Rep.'),
('Egypt'),
('Guinea Equatorial'),
('Ethiopia'),
('La Réunion'),
('Solomon Islands'),
('French Guiana');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wi_economy_money`
--

CREATE TABLE `wi_economy_money` (
  `id` int(11) NOT NULL,
  `CentsPerMoneyUnit` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Daten für Tabelle `wi_economy_money`
--

INSERT INTO `wi_economy_money` (`id`, `CentsPerMoneyUnit`) VALUES
(1, 1);

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

--
-- Daten für Tabelle `wi_lastnames`
--

INSERT INTO `wi_lastnames` (`name`, `active`) VALUES
('Binder', '1'),
('Noel', '1'),
('Young', '1'),
('Roux', '1'),
('Allen', '1'),
('Heron', '1'),
('Mansworld', '1'),
('Babbi', '1'),
('Crazys', '1'),
('Linden', '1'),
('Machlam', '1'),
('Notringham', '1'),
('Opus', '1'),
('Hausermann', '1'),
('McLachlan', '1'),
('McKinsey', '1'),
('Pohl', '1'),
('Schwarzenegger', '1'),
('Mueller', '1'),
('Nosemann', '1'),
('Obolus', '1'),
('Himbaer', '1'),
('Nala', '1'),
('Kandee', '1'),
('Bauer', '1'),
('Simons', '1'),
('Raptor', '1'),
('Maek', '1'),
('Huss', '1'),
('Mondial', '1'),
('Moondancer', '1'),
('Sweetheart', '1'),
('Schnuggy', '1'),
('Swindlehurst', '1'),
('Baumeister', '1'),
('Bloomberg', '1'),
('Dredd', '1'),
('Gridlock', '1'),
('Bohlen', '1'),
('Snapper', '1'),
('Tickle', '1'),
('Ewing', '1'),
('Schwinge', '1'),
('Nonsito', '1');

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

--
-- Daten für Tabelle `wi_pagemanager`
--

INSERT INTO `wi_pagemanager` (`id`, `code`, `sitename`, `content`, `rank`, `type`, `active`, `url`, `target`, `display`) VALUES
(1, '1211831857', 'Home', '<p>&nbsp;</p>\r\n<table height=\"100%\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">\r\n    <tbody>\r\n        <tr>\r\n            <td valign=\"top\" width=\"63%\" height=\"204\">\r\n            <table height=\"195\" cellspacing=\"0\" cellpadding=\"5\" width=\"90%\" align=\"center\" bgcolor=\"#ffffff\" border=\"0\">\r\n                <tbody>\r\n                    <tr>\r\n                        <td valign=\"top\">\r\n                        <p><strong>Welcome to the new Opensimwi Redux !</strong><br />\r\n                        <br />\r\n                        Create an Free Account today and Play in our World.<br />\r\n                        Our World is created by its Residents, you can build everything in here.<br />\r\n                        Meet Peoples, Chat, Play, Everything is possible in our brandnew 3D World.</p>\r\n                        <p>Beside you see the Status of our System -&gt; <br />\r\n                        <br />\r\n                        Enjoy it. :-)</p>\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n            <td valign=\"top\" colspan=\"2\">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td>&nbsp;</td>\r\n            <td width=\"33%\">&nbsp;</td>\r\n            <td width=\"3%\">&nbsp;</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', '1', '1', '1', 'index.php?page=home', '_self', '2'),
(2, '1211831897', 'Change Account', '', '2', '1', '1', 'index.php?page=change', '_self', '1'),
(3, '1211831925', 'Gridstatus', '', '3', '1', '1', 'index.php?page=gridstatus', '_self', '2'),
(4, '1211832121', 'Transaction History', '', '4', '1', '1', 'index.php?page=transactions', '_self', '1'),
(5, '1213729504', 'Region List', '', '5', '1', '1', 'index.php?page=regions', '_self', '2'),
(6, '1213811351', 'World Map', '', '6', '1', '1', 'index.php?page=map', '_self', '2'),
(7, '1211832149', 'Create Account', '', '7', '1', '1', 'index.php?page=create', '_self', '0'),
(8, '1211832173', 'Logout', '', '8', '1', '1', 'index.php?page=logout', '_self', '1');

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

--
-- Daten für Tabelle `wi_startscreen_infowindow`
--

INSERT INTO `wi_startscreen_infowindow` (`gridstatus`, `active`, `color`, `title`, `message`) VALUES
('1', '1', 'yellow', 'Info system Works very well ;-)', 'Today we\'ve built a new loginscreen info system and it works very well. You can now see Info windows on the startup screen.');

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

--
-- Daten für Tabelle `wi_startscreen_news`
--

INSERT INTO `wi_startscreen_news` (`id`, `title`, `message`, `time`) VALUES
(1, '[COMPLETE] The new loginscreen is done and works fine so far', '<P>We built a new loginscreen which will inform you about Grid updates or changes. Also you can now see how many users and regions are online, and more.  Also, you may from time to time see an infowindow, which informs you about important news.  Have Fun !</P>', 1211321439);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `wi_adminsetting`
--
ALTER TABLE `wi_adminsetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `wi_economy_money`
--
ALTER TABLE `wi_economy_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `wi_economy_transactions`
--
ALTER TABLE `wi_economy_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `wi_pagemanager`
--
ALTER TABLE `wi_pagemanager`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `wi_startscreen_news`
--
ALTER TABLE `wi_startscreen_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
