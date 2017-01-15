-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Gen 16, 2017 alle 00:23
-- Versione del server: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dump dei dati per la tabella `annuncio`
--

INSERT INTO `annuncio` (`id`, `id_utente`, `data`, `titolo`, `luogo`, `stato`, `retribuzione`, `tipo`, `descrizione`) VALUES
(10, 18, '2017-01-15 18:14:26', 'Cercasi programmatore', 'Salerno ', 'attivo', 100, 'domanda', 'Cercasi programmatore di PHP per creare un sito'),
(11, 19, '2017-01-14 19:00:00', 'Offro lavoro come cassiere', 'Andria', 'attivo', 900, 'offerta', 'Offro lavoro come cassiere in una farmacia'),
(12, 16, '2017-01-14 18:44:35', 'Cercasi Chef', 'Salerno ', 'attivo', 5, 'domanda', 'Ciao a tutti ho un ristorante a Salerno e sto cercando uno Chef'),
(13, 16, '2017-01-15 20:07:22', 'Cercasi Cuoco', 'Salerno ', 'eliminato', 1200, 'offerta', 'Cerco cuoco qualificato nella provincia di Salerno'),
(14, 27, '2017-01-02 16:50:00', 'Cerco lavoro come dentista', 'Roma', 'attivo', 1800, 'domanda', 'Cerco lavoro come dentista in uno studio dentistico'),
(15, 27, '2017-01-14 18:00:00', 'Offro lavoro come farmacista', 'Salerno', 'attivo', 1500, 'offerta', 'Offro lavoro come farmacista'),
(16, 27, '2017-01-03 19:00:00', 'Cerco Aiuto Farmacia', 'Salerno', 'attivo', 1100, 'offerta', 'Cerco aiuto farmacia');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`id`, `id_annuncio`, `id_utente`, `corpo`, `data`, `stato`) VALUES
(17, 12, 18, 'Ciao, quali sono gli orari di lavoro? ', '2017-01-15 18:46:43', 'attivato');

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

--
-- Dump dei dati per la tabella `competente`
--

INSERT INTO `competente` (`id_utente`, `id_microcategoria`) VALUES
(18, 14),
(19, 29),
(19, 30),
(18, 36);

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

--
-- Dump dei dati per la tabella `dispatcher_notifica`
--

INSERT INTO `dispatcher_notifica` (`id_utente`, `id_notifica`) VALUES
(16, 10),
(16, 11),
(16, 12),
(18, 13);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dump dei dati per la tabella `macrocategoria`
--

INSERT INTO `macrocategoria` (`id`, `nome`) VALUES
(20, 'Informatica'),
(28, 'Riparazioni'),
(21, 'Ristorazione'),
(24, 'Salute'),
(25, 'Sport');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggio`
--

CREATE TABLE IF NOT EXISTS `messaggio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `corpo` text NOT NULL,
  `data` datetime NOT NULL,
  `letto` tinyint(1) NOT NULL,
  `id_utente_mittente` bigint(20) NOT NULL,
  `id_utente_destinatario` bigint(20) NOT NULL,
  `stato` enum('attivato','segnalato','eliminato','amministratore') NOT NULL,
  PRIMARY KEY (`id`,`id_utente_mittente`,`id_utente_destinatario`),
  KEY `id_utente_mittente` (`id_utente_mittente`),
  KEY `id_utente_destinatario` (`id_utente_destinatario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dump dei dati per la tabella `microcategoria`
--

INSERT INTO `microcategoria` (`id`, `nome`, `id_macrocategoria`) VALUES
(26, 'AngularJS', 20),
(35, 'Bar', 21),
(36, 'Cucina', 21),
(31, 'Dentista', 24),
(37, 'Dolci', 21),
(34, 'Erboristeria', 24),
(30, 'Farmacista', 24),
(27, 'Idraulico', 28),
(13, 'Informatica', 20),
(24, 'Java', 20),
(25, 'Meccanico', 28),
(29, 'PersonalTrainer', 25),
(23, 'PHP', 20),
(28, 'Preparatore Atletico', 25),
(22, 'Riparazioni', 28),
(14, 'Ristorazione', 21),
(21, 'Salute', 24),
(19, 'Sport', 25);

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE IF NOT EXISTS `notifica` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `tipo` enum('decisione','risoluzione','inserimento','segnalazione') NOT NULL,
  `letto` tinyint(1) NOT NULL,
  `info` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `notifica`
--

INSERT INTO `notifica` (`id`, `date`, `tipo`, `letto`, `info`) VALUES
(10, '2017-01-15', 'inserimento', 0, '{"id_oggetto":"12","tipo_oggetto":"commento","nome":"Cercasi Chef"}'),
(11, '2017-01-15', 'inserimento', 0, '{"id_oggetto":"12","tipo_oggetto":"candidatura","nome":"Cercasi Chef"}'),
(12, '2017-01-15', 'inserimento', 0, '{"id_oggetto":"12","tipo_oggetto":"feedback","nome":"Cercasi Chef"}'),
(13, '2017-01-16', 'inserimento', 0, '{"id_oggetto":"10","tipo_oggetto":"candidatura","nome":"Cercasi programmatore"}');

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

--
-- Dump dei dati per la tabella `preferito`
--

INSERT INTO `preferito` (`id_utente`, `id_annuncio`, `data_aggiunta`) VALUES
(16, 12, '2017-01-15 19:10:35'),
(18, 12, '2017-01-15 19:11:04');

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

--
-- Dump dei dati per la tabella `riferito`
--

INSERT INTO `riferito` (`id_annuncio`, `id_microcategoria`) VALUES
(11, 30),
(15, 30),
(16, 30),
(14, 31),
(13, 36),
(12, 37);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `nome`, `cognome`, `descrizione`, `telefono`, `data_nascita`, `citta`, `email`, `password`, `ruolo`, `stato`, `immagine_profilo`, `partita_iva`) VALUES
(16, 'Ilaria ', 'Cilente', 'Studentessa in cerca di lavoro in Campania (SA)', '0894394383', '2017-06-08', 'Felitto ', 'ilaria@crowdmine.it', 'Crowdmine1', 'moderatore', 'attivo', 'ilaria.PNG', NULL),
(17, 'Amministratore', 'admin', 'Admin', NULL, '0000-00-00', '', 'amministratore@crowdmine.it', 'Crowdmine1', 'amministratore', 'attivo', 'amministratore.PNG', NULL),
(18, 'Francesco', 'Di Napoli', NULL, NULL, '1995-12-10', '', 'francesco@crowdmine.it', 'Crowdmine1', 'utente', 'attivo', 'lino.PNG', NULL),
(19, 'Giacomo', 'Di Laurea', 'Pizzaiuolo in cerca di lavoro.', '039484', '2017-01-03', 'Sabaudia ', 'giacomo@crowdmine.it', 'Crowdmine1', 'utente', 'attivo', 'aaa.PNG', '12345678911'),
(27, 'Marco', 'Nerone', 'Ciao a tutti sono un ragazzo alla ricerca di lavoro!', '3331112299', '1986-08-18', 'Casal Cermelli', 'marconerox@gmail.com', 'Crowdmine1', 'utente', 'attivo', 'andrea.PNG', NULL),
(28, 'Cristian', 'Vieri', 'Ciao a tutti!', '3332221100', '1995-08-19', 'Gaeta', 'enricleo@gmail.com', 'Crowdmine1', 'utente', 'attivo', '587bcccb3b1e1.jpeg', NULL);

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
  ADD CONSTRAINT `candidatura_ibfk_2` FOREIGN KEY (`id_annuncio`) REFERENCES `annuncio` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limiti per la tabella `commento`
--
ALTER TABLE `commento`
  ADD CONSTRAINT `commento_ibfk_1` FOREIGN KEY (`id_annuncio`) REFERENCES `annuncio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commento_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id_annuncio`) REFERENCES `annuncio` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
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
