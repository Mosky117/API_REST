-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 18, 2023 alle 19:46
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `owly`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `corsi`
--

CREATE TABLE `corsi` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `posti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `corsi`
--

INSERT INTO `corsi` (`id`, `nome`, `posti`) VALUES
(1, 'Ingegneria', 15),
(2, 'Letteratura', 26),
(3, 'Robotica', 10),
(4, 'Lingue', 50),
(5, 'Architettura', 20),
(6, 'Microbiologia', 16);

-- --------------------------------------------------------

--
-- Struttura della tabella `corsi_materie`
--

CREATE TABLE `corsi_materie` (
  `corso_id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `corsi_materie`
--

INSERT INTO `corsi_materie` (`corso_id`, `materia_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(3, 8),
(4, 3),
(4, 4),
(4, 9),
(4, 10),
(5, 1),
(5, 2),
(5, 7),
(6, 1),
(6, 6),
(6, 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `materie`
--

CREATE TABLE `materie` (
  `id` int(11) NOT NULL,
  `nome` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `materie`
--

INSERT INTO `materie` (`id`, `nome`) VALUES
(1, 'Matematica'),
(2, 'Fisica'),
(3, 'Greco'),
(4, 'Latino'),
(6, 'Chimica'),
(7, 'Arte'),
(8, 'Biologia'),
(9, 'Letteratura Italiana'),
(10, 'Letteratura Inglese');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `corsi`
--
ALTER TABLE `corsi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `corsi_materie`
--
ALTER TABLE `corsi_materie`
  ADD PRIMARY KEY (`corso_id`,`materia_id`),
  ADD KEY `materia_id` (`materia_id`);

--
-- Indici per le tabelle `materie`
--
ALTER TABLE `materie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `corsi`
--
ALTER TABLE `corsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `materie`
--
ALTER TABLE `materie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `corsi_materie`
--
ALTER TABLE `corsi_materie`
  ADD CONSTRAINT `corsi_materie_ibfk_1` FOREIGN KEY (`corso_id`) REFERENCES `corsi` (`id`),
  ADD CONSTRAINT `corsi_materie_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
