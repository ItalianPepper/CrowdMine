-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Dic 16, 2016 alle 21:41
-- Versione del server: 10.1.9-MariaDB
-- Versione PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_crowdmine`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `annuncio`
--

CREATE TABLE IF NOT EXISTS `annuncio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_utente` bigint(20) NOT NULL,
  `data` datetime NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `luogo` varchar(255) NOT NULL,
  `stato` enum('revisione','attivo','segnalato','disattivato','ricorso','eliminato','amministratore','revisione_modifica') NOT NULL,
  `retribuzione` int(11) DEFAULT NULL,
  `tipo` enum('domanda','offerta') NOT NULL,
  `descrizione` text NOT NULL,
  PRIMARY KEY (`id`,`id_utente`),
  KEY `id_utente` (`id_utente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `bloccato`
--

CREATE TABLE IF NOT EXISTS `bloccato` (
  `id_utente` bigint(20) NOT NULL,
  `id_utente_bloccato` bigint(20) NOT NULL,
  PRIMARY KEY (`id_utente`,`id_utente_bloccato`),
  KEY `id_utente_bloccato` (`id_utente_bloccato`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `candidatura`
--

CREATE TABLE IF NOT EXISTS `candidatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utente` bigint(20) NOT NULL,
  `id_annuncio` bigint(20) NOT NULL,
  `corpo` text NOT NULL,
  `data_risposta` datetime DEFAULT NULL,
  `data_inviata` datetime DEFAULT NULL,
  `richiesta_inviata` enum('inviata','non_inviata','non_valutata') NOT NULL,
  `richiesta_accettata` enum('non_valutato','accettato','rifiutato') NOT NULL,
  PRIMARY KEY (`id`,`id_utente`,`id_annuncio`),
  KEY `id_utente` (`id_utente`),
  KEY `id_annuncio` (`id_annuncio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE IF NOT EXISTS `commento` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_annuncio` bigint(20) NOT NULL,
  `id_utente` bigint(20) NOT NULL,
  `corpo` text NOT NULL,
  `data` datetime NOT NULL,
  `stato` enum('attivato','segnalato','eliminato','amministratore') NOT NULL,
  PRIMARY KEY (`id`,`id_annuncio`,`id_utente`),
  KEY `id_utente` (`id_utente`),
  KEY `commento_ibfk_1` (`id_annuncio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `competente`
--

CREATE TABLE IF NOT EXISTS `competente` (
  `id_utente` bigint(20) NOT NULL,
  `id_microcategoria` bigint(20) NOT NULL,
  PRIMARY KEY (`id_utente`,`id_microcategoria`),
  KEY `competente_ibfk_2` (`id_microcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `dispatcher_notifica`
--

CREATE TABLE IF NOT EXISTS `dispatcher_notifica` (
  `id_utente` bigint(11) NOT NULL,
  `id_notifica` bigint(20) NOT NULL,
  PRIMARY KEY (`id_utente`,`id_notifica`),
  KEY `dispatcher_notifica_ibfk_2` (`id_notifica`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_utente` bigint(20) NOT NULL,
  `id_annuncio` bigint(20) NOT NULL,
  `id_valutato` bigint(20) NOT NULL,
  `valutazione` float NOT NULL,
  `corpo` text,
  `data` datetime NOT NULL,
  `stato` enum('attivato','segnalato','eliminato','amministratore') NOT NULL,
  `titolo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`id_utente`,`id_annuncio`,`id_valutato`),
  KEY `id_utente` (`id_utente`),
  KEY `id_annuncio` (`id_annuncio`),
  KEY `feedback_ibfk_3` (`id_valutato`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `interesse`
--

CREATE TABLE IF NOT EXISTS `interesse` (
  `id_utente` bigint(20) NOT NULL,
  `id_microcategoria` bigint(20) NOT NULL,
  PRIMARY KEY (`id_utente`,`id_microcategoria`),
  KEY `interesse_ibfk_2` (`id_microcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `macrocategoria`
--

CREATE TABLE IF NOT EXISTS `macrocategoria` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggio`
--

CREATE TABLE IF NOT EXISTS `messaggio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `corpo` text NOT NULL,
  `data` date NOT NULL,
  `letto` tinyint(1) NOT NULL,
  `id_utente_mittente` bigint(20) NOT NULL,
  `id_utente_destinatario` bigint(20) NOT NULL,
  `stato` enum('attivato','segnalato','eliminato','amministratore') NOT NULL,
  PRIMARY KEY (`id`,`id_utente_mittente`,`id_utente_destinatario`),
  KEY `id_utente_mittente` (`id_utente_mittente`),
  KEY `id_utente_destinatario` (`id_utente_destinatario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `microcategoria`
--

CREATE TABLE IF NOT EXISTS `microcategoria` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `id_macrocategoria` bigint(20) NOT NULL,
  PRIMARY KEY (`id`,`id_macrocategoria`),
  UNIQUE KEY `nome` (`nome`),
  KEY `microcategoria_ibfk_1` (`id_macrocategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE IF NOT EXISTS `notifica` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `tipo` enum('decisione','risoluzione','inserimento') NOT NULL,
  `letto` tinyint(1) NOT NULL,
  `info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `preferito`
--

CREATE TABLE IF NOT EXISTS `preferito` (
  `id_utente` bigint(20) NOT NULL,
  `id_annuncio` bigint(20) NOT NULL,
  `data_aggiunta` datetime NOT NULL,
  PRIMARY KEY (`id_utente`,`id_annuncio`),
  KEY `preferito_ibfk_2` (`id_annuncio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `riferito`
--

CREATE TABLE IF NOT EXISTS `riferito` (
  `id_annuncio` bigint(20) NOT NULL,
  `id_microcategoria` bigint(20) NOT NULL,
  PRIMARY KEY (`id_annuncio`,`id_microcategoria`),
  KEY `riferito_ibfk_2` (`id_microcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `data_nascita` date NOT NULL,
  `citta` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ruolo` enum('utente','moderatore','amministratore') NOT NULL,
  `stato` enum('revisione','attivo','segnalato','disattivato','ricorso','bannato','amministratore','revisione_modifica') NOT NULL,
  `immagine_profilo` varchar(255) NOT NULL,
  `partita_iva` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `partita_iva` (`partita_iva`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `annuncio`
--
ALTER TABLE `annuncio`
  ADD CONSTRAINT `annuncio_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `bloccato`
--
ALTER TABLE `bloccato`
  ADD CONSTRAINT `bloccato_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bloccato_ibfk_2` FOREIGN KEY (`id_utente_bloccato`) REFERENCES `utente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `candidatura`
--
ALTER TABLE `candidatura`
  ADD CONSTRAINT `candidatura_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `candidatura_ibfk_2` FOREIGN KEY (`id_annuncio`) REFERENCES `annuncio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`id_annuncio`) REFERENCES `annuncio` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `competente`
--
ALTER TABLE `competente`
  ADD CONSTRAINT `competente_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `competente_ibfk_2` FOREIGN KEY (`id_microcategoria`) REFERENCES `microcategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `dispatcher_notifica`
--
ALTER TABLE `dispatcher_notifica`
  ADD CONSTRAINT `dispatcher_notifica_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `dispatcher_notifica_ibfk_2` FOREIGN KEY (`id_notifica`) REFERENCES `notifica` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limiti per la tabella `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id_annuncio`) REFERENCES `annuncio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`id_valutato`) REFERENCES `utente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `interesse`
--
ALTER TABLE `interesse`
  ADD CONSTRAINT `interesse_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `interesse_ibfk_2` FOREIGN KEY (`id_microcategoria`) REFERENCES `microcategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  ADD CONSTRAINT `messaggio_ibfk_1` FOREIGN KEY (`id_utente_mittente`) REFERENCES `utente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `messaggio_ibfk_2` FOREIGN KEY (`id_utente_destinatario`) REFERENCES `utente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `microcategoria`
--
ALTER TABLE `microcategoria`
  ADD CONSTRAINT `microcategoria_ibfk_1` FOREIGN KEY (`id_macrocategoria`) REFERENCES `macrocategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `preferito`
--
ALTER TABLE `preferito`
  ADD CONSTRAINT `preferito_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preferito_ibfk_2` FOREIGN KEY (`id_annuncio`) REFERENCES `annuncio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `riferito`
--
ALTER TABLE `riferito`
  ADD CONSTRAINT `riferito_ibfk_2` FOREIGN KEY (`id_microcategoria`) REFERENCES `microcategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `riferito_ibfk_3` FOREIGN KEY (`id_annuncio`) REFERENCES `annuncio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
