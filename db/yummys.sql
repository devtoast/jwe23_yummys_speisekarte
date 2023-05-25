-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 25. Mai 2023 um 15:42
-- Server-Version: 10.4.27-MariaDB
-- PHP-Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `yummys`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(10) UNSIGNED NOT NULL,
  `vorname` varchar(200) DEFAULT NULL,
  `nachname` varchar(200) DEFAULT NULL,
  `benutzername` varchar(200) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `login_last` datetime DEFAULT NULL,
  `login_count` int(10) UNSIGNED DEFAULT 0,
  `boss` tinyint(1) NOT NULL DEFAULT 0,
  `mini_boss` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `vorname`, `nachname`, `benutzername`, `passwort`, `email`, `login_last`, `login_count`, `boss`, `mini_boss`) VALUES
(1, 'Thomas', 'Astleithner', 'toast', '$2y$10$1/9.VmD6UtfXAjSObNKXi.QqQYiQhtNOeN3Dsoal6OKxtGX/LZ9Q6', 'toast@sol.at', '2023-05-25 15:08:27', 110, 0, 0),
(2, 'Manuel', 'Obermoser', 'maniobi', '$2y$10$C4PpGYHtEzfRibxJg5aWzOiNThIcbItrY2onSSWd/XSDO.gvRKmc2', NULL, '2023-04-11 16:17:29', 1, 0, 0),
(3, 'Christian', 'Rainer', 'rainchr', '$2y$10$YFzd73Q2BQXnfELdHfSVZOh9r1cuZuKj6q2r9qveCA0HxSiA1OEMq', NULL, '2023-04-11 16:11:06', 2, 0, 0),
(4, 'Markus', 'Hauser', 'markhaus', '$2y$10$3Wo.16v2PZQT3cqSSEe6l.9qOmsmbEqf67G3Rwr4qXcdKyAdpdpiW', NULL, '2023-04-11 16:05:43', 1, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorien`
--

CREATE TABLE `kategorien` (
  `id` int(10) UNSIGNED NOT NULL,
  `bezeichnung` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `kategorien`
--

INSERT INTO `kategorien` (`id`, `bezeichnung`) VALUES
(1, 'Vorspeisen'),
(2, 'Hauptspeisen'),
(3, 'Nachspeisen'),
(4, 'Getraenke');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkte`
--

CREATE TABLE `produkte` (
  `id` int(10) UNSIGNED NOT NULL,
  `titel` varchar(200) NOT NULL,
  `beschreibung` text NOT NULL,
  `waehrung` varchar(10) NOT NULL,
  `preis` float UNSIGNED NOT NULL,
  `menge` float UNSIGNED NOT NULL,
  `einheit` varchar(50) NOT NULL,
  `anlagedatum` date NOT NULL,
  `aenderungsdatum` date DEFAULT NULL,
  `aktiv` tinyint(1) DEFAULT 0,
  `kategorie_id` int(10) UNSIGNED NOT NULL,
  `restaurant_id` int(10) UNSIGNED DEFAULT NULL,
  `benutzer_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `produkte`
--

INSERT INTO `produkte` (`id`, `titel`, `beschreibung`, `waehrung`, `preis`, `menge`, `einheit`, `anlagedatum`, `aenderungsdatum`, `aktiv`, `kategorie_id`, `restaurant_id`, `benutzer_id`) VALUES
(3, 'Kaisersmarren', 'mit Zwetschkenröster', '€', 10.2, 300, 'Gramm', '2023-05-12', NULL, 1, 3, NULL, NULL),
(4, 'Bier', 'Pils', '€', 5.5, 0.5, 'Liter', '2023-05-05', NULL, 0, 4, NULL, NULL),
(7, 'Saibling', 'in hauseigener Marinade mit Gemüse der Saison mit würziger Sauce', '€', 15, 200, 'Gramm', '2023-05-10', NULL, 1, 1, NULL, NULL),
(12, 'Gemischter Salat', 'mit Gemüse der Saison und Putenstreifen', '€', 10.5, 100, 'Gramm', '2023-05-06', NULL, 1, 1, NULL, NULL),
(14, 'Apfelsaft', '100% Fruchtanteil', '€', 5.3, 0.5, 'Liter', '2023-05-04', NULL, 1, 4, NULL, NULL),
(15, 'Nudelsuppe', 'Rindsuppe mit hausgemachten Nudeln', '€', 10, 100, 'Gramm', '2023-05-04', NULL, 1, 1, NULL, NULL),
(18, 'Sachertorte', 'mit Schokoüberzug und Marmeladenfüllung', '€', 10, 100, 'Gramm', '2023-05-09', NULL, 1, 3, NULL, NULL),
(20, 'Fruchtsalat', 'mit Äpfel und Birnen', '€', 5, 20.5, 'Gramm', '2023-05-09', NULL, 1, 3, NULL, NULL),
(21, 'Zwiebelrostbraten', 'vom Rind mit Semmelknödel', '€', 25, 300, 'Gramm', '2023-05-10', '2023-05-22', 1, 2, NULL, NULL),
(23, 'Spargelcremesuppe', 'mit frischem Spargel ', '€', 12, 250, 'ml', '2023-05-16', NULL, 1, 1, NULL, NULL),
(28, 'Gebeizter Saibling', 'Bio-Saibling in Marinade  mit Zwiebel', '€', 12.5, 250, 'Gramm', '2023-05-17', '2023-05-22', 0, 1, NULL, NULL),
(29, 'Kasnocken', 'mit Bergkäse und Schnittlauch', '€', 12.5, 500, 'Gramm', '2023-05-18', NULL, 1, 2, NULL, NULL),
(30, 'Wiener Schnitzel', 'vom Schwein mit Petersilienkartoffel', '€', 18.9, 350, 'Gramm', '2023-05-18', NULL, 1, 2, NULL, NULL),
(31, 'Spaghetti Bolognese', 'mit Fleischsauce und Parmesan', '€', 17.5, 350, 'Gramm', '2023-05-18', NULL, 1, 2, NULL, NULL),
(32, 'Chicken Curry', 'Indische Art mit Huhn und Gemüse', '€', 18.5, 400, 'Gramm', '2023-05-18', NULL, 1, 2, NULL, NULL),
(33, 'Gemischtes Eis', 'Vanille, Erdbeer und Schokoladeneis', '€', 12.3, 200, 'Gramm', '2023-05-18', NULL, 1, 3, NULL, NULL),
(34, 'Salzburger Nockerl', 'Fluffige Spezialität mit Staubzucker', '€', 9.9, 100, 'Gramm', '2023-05-18', NULL, 1, 3, NULL, NULL),
(35, 'Bier', 'Märzen', '€', 6.5, 0.5, 'Liter', '2023-05-18', NULL, 1, 4, NULL, NULL),
(36, 'Bier', 'Pils', '€', 5, 0.33, 'Liter', '2023-05-18', NULL, 1, 4, NULL, NULL),
(37, 'Mojito', 'mit Rum, Limettensaft und Minzblätter', '€', 12.3, 250, 'ml', '2023-05-18', NULL, 0, 4, NULL, NULL),
(38, 'Schnaps', 'Bio-Marillenbrand\r\n40 Vol%', '€', 5.6, 4, 'cl', '2023-05-18', '2023-05-24', 0, 4, NULL, NULL),
(40, 'test', 'test', '€', 5, 2, 'g', '2023-05-24', '2023-05-24', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(10) UNSIGNED NOT NULL,
  `bezeichnung` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `restaurants`
--

INSERT INTO `restaurants` (`id`, `bezeichnung`) VALUES
(1, 'Restaurant_1'),
(2, 'Restaurant_2');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `benutzername` (`benutzername`);

--
-- Indizes für die Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `kategorie_id` (`kategorie_id`),
  ADD KEY `benutzer_id` (`benutzer_id`);

--
-- Indizes für die Tabelle `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `produkte`
--
ALTER TABLE `produkte`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT für Tabelle `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
