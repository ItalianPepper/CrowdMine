-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Gen 03, 2017 alle 15:15
-- Versione del server: 10.1.13-MariaDB
-- Versione PHP: 7.0.8

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

CREATE TABLE `annuncio` (
  `id` bigint(20) NOT NULL,
  `id_utente` bigint(20) NOT NULL,
  `data` datetime NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `luogo` varchar(255) NOT NULL,
  `stato` enum('revisione','attivo','segnalato','disattivato','ricorso','eliminato','amministratore','revisione_modifica') NOT NULL,
  `retribuzione` int(11) DEFAULT NULL,
  `tipo` enum('domanda','offerta') NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `annuncio`
--

INSERT INTO `annuncio` (`id`, `id_utente`, `data`, `titolo`, `luogo`, `stato`, `retribuzione`, `tipo`, `descrizione`) VALUES
(1, 4, '2016-12-04 00:00:00', 'Annuncio1', 'Luogo1', 'attivo', 1000, 'domanda', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu'),
(2, 5, '2016-12-04 00:00:00', 'Annuncio2', 'Luogo1', 'ricorso', 1000, 'domanda', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu'),
(3, 6, '2016-12-04 00:00:00', 'Annuncio3', 'Luogo1', 'attivo', 1000, 'domanda', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu'),
(3, 8, '2016-12-04 00:00:00', 'Annuncio4', 'Luogo1', 'segnalato', 1000, 'domanda', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu'),
(4, 13, '2016-12-04 00:00:00', 'Annuncio5', 'Luogo1', 'revisione_modifica', 1000, 'domanda', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu'),
(5, 15, '2016-12-04 00:00:00', 'Annuncio6', 'Luogo1', 'attivo', 1000, 'domanda', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu'),
(6, 15, '2017-01-03 11:37:42', 'a', 'a', 'revisione', 12, 'domanda', 'a'),
(7, 15, '2017-01-03 11:45:20', 'a', 'a', 'revisione', 12, 'domanda', 'a'),
(8, 15, '2017-01-03 11:46:17', 'a2232', 'a222', 'revisione', 123456, 'domanda', 'a23232'),
(9, 15, '2017-01-03 11:47:53', 'qwert', 'were', 'revisione', 123456, 'domanda', 'ewqew');

-- --------------------------------------------------------

--
-- Struttura della tabella `bloccato`
--

CREATE TABLE `bloccato` (
  `id_utente` bigint(20) NOT NULL,
  `id_utente_bloccato` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `bloccato`
--

INSERT INTO `bloccato` (`id_utente`, `id_utente_bloccato`) VALUES
(4, 5),
(4, 8),
(5, 13),
(6, 4),
(15, 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `candidatura`
--

CREATE TABLE `candidatura` (
  `id` int(11) NOT NULL,
  `id_utente` bigint(20) NOT NULL,
  `id_annuncio` bigint(20) NOT NULL,
  `corpo` text NOT NULL,
  `data_risposta` datetime DEFAULT NULL,
  `data_inviata` datetime DEFAULT NULL,
  `richiesta_inviata` enum('inviata','non_inviata','non_valutata') NOT NULL,
  `richiesta_accettata` enum('non_valutato','accettato','rifiutato') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `candidatura`
--

INSERT INTO `candidatura` (`id`, `id_utente`, `id_annuncio`, `corpo`, `data_risposta`, `data_inviata`, `richiesta_inviata`, `richiesta_accettata`) VALUES
(1, 4, 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-08 00:00:00', '2016-12-07 00:00:00', 'inviata', 'accettato'),
(2, 5, 3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-08 00:00:00', '2016-12-07 00:00:00', 'inviata', 'accettato'),
(2, 6, 3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-08 00:00:00', '2016-12-07 00:00:00', 'inviata', 'accettato'),
(4, 5, 4, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-08 00:00:00', '2016-12-07 00:00:00', 'inviata', 'accettato'),
(5, 15, 5, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-08 00:00:00', '2016-12-07 00:00:00', 'inviata', 'non_valutato'),
(6, 4, 5, 'ssss', '0000-00-00 00:00:00', '2016-12-30 17:26:00', 'inviata', 'non_valutato'),
(7, 4, 1, 'aaa', '0000-00-00 00:00:00', '2017-01-03 14:26:58', 'inviata', 'non_valutato'),
(8, 4, 3, 'sasasaaasa', '0000-00-00 00:00:00', '2017-01-03 14:27:15', 'inviata', 'non_valutato');

-- --------------------------------------------------------

--
-- Struttura della tabella `commento`
--

CREATE TABLE `commento` (
  `id` bigint(20) NOT NULL,
  `id_annuncio` bigint(20) NOT NULL,
  `id_utente` bigint(20) NOT NULL,
  `corpo` text NOT NULL,
  `data` datetime NOT NULL,
  `stato` enum('attivato','segnalato','eliminato','amministratore') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `commento`
--

INSERT INTO `commento` (`id`, `id_annuncio`, `id_utente`, `corpo`, `data`, `stato`) VALUES
(1, 1, 4, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-06 00:00:00', 'attivato'),
(2, 2, 6, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-13 00:00:00', 'segnalato'),
(3, 3, 13, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-13 00:00:00', 'attivato'),
(4, 4, 5, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-13 00:00:00', 'attivato'),
(5, 5, 15, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-14 00:04:44', 'attivato'),
(6, 3, 4, '', '2017-01-03 14:47:41', 'attivato'),
(7, 3, 4, 'as', '2017-01-03 14:49:26', 'attivato');

-- --------------------------------------------------------

--
-- Struttura della tabella `competente`
--

CREATE TABLE `competente` (
  `id_utente` bigint(20) NOT NULL,
  `id_microcategoria` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `competente`
--

INSERT INTO `competente` (`id_utente`, `id_microcategoria`) VALUES
(15, 1),
(15, 2),
(15, 3),
(15, 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `dispatcher_notifica`
--

CREATE TABLE `dispatcher_notifica` (
  `id_utente` bigint(11) NOT NULL,
  `id_notifica` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) NOT NULL,
  `id_utente` bigint(20) NOT NULL,
  `id_annuncio` bigint(20) NOT NULL,
  `id_valutato` bigint(20) NOT NULL,
  `valutazione` float NOT NULL,
  `corpo` text,
  `data` datetime NOT NULL,
  `stato` enum('attivato','segnalato','eliminato','amministratore') NOT NULL,
  `titolo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `feedback`
--

INSERT INTO `feedback` (`id`, `id_utente`, `id_annuncio`, `id_valutato`, `valutazione`, `corpo`, `data`, `stato`, `titolo`) VALUES
(1, 4, 1, 15, 5, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-07 00:00:00', 'attivato', 'Title'),
(2, 5, 2, 4, 4, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-07 00:00:00', 'attivato', 'Titla'),
(3, 6, 3, 5, 3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-13 00:00:00', 'attivato', 'Title'),
(4, 4, 3, 8, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-13 00:00:00', 'attivato', 'Title'),
(5, 4, 5, 15, 3.5, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu', '2016-12-14 00:04:44', 'segnalato', 'Title');

-- --------------------------------------------------------

--
-- Struttura della tabella `interesse`
--

CREATE TABLE `interesse` (
  `id_utente` bigint(20) NOT NULL,
  `id_microcategoria` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `interesse`
--

INSERT INTO `interesse` (`id_utente`, `id_microcategoria`) VALUES
(4, 2),
(4, 3),
(4, 8),
(5, 1),
(6, 8);

-- --------------------------------------------------------

--
-- Struttura della tabella `macrocategoria`
--

CREATE TABLE `macrocategoria` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `macrocategoria`
--

INSERT INTO `macrocategoria` (`id`, `nome`) VALUES
(6, 'Informatica'),
(7, 'Prova1'),
(8, 'Prova2'),
(12, 'Prova3'),
(18, 'Prova4');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggio`
--

CREATE TABLE `messaggio` (
  `id` bigint(20) NOT NULL,
  `corpo` text NOT NULL,
  `data` datetime NOT NULL,
  `letto` tinyint(1) NOT NULL,
  `id_utente_mittente` bigint(20) NOT NULL,
  `id_utente_destinatario` bigint(20) NOT NULL,
  `stato` enum('attivato','segnalato','eliminato','amministratore') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `messaggio`
--

INSERT INTO `messaggio` (`id`, `corpo`, `data`, `letto`, `id_utente_mittente`, `id_utente_destinatario`, `stato`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu\r\n\r\n', '2016-12-01 00:00:00', 1, 4, 5, 'attivato'),
(2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu\r\n\r\n', '2016-12-07 00:00:00', 1, 4, 13, 'segnalato'),
(3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu\r\n\r\n', '2016-12-19 00:00:00', 0, 8, 4, 'segnalato'),
(4, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu\r\n\r\n', '2016-12-06 00:00:00', 1, 6, 13, 'attivato'),
(5, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu\r\n\r\n', '2016-12-04 00:00:00', 0, 15, 13, 'attivato');

-- --------------------------------------------------------

--
-- Struttura della tabella `microcategoria`
--

CREATE TABLE `microcategoria` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `id_macrocategoria` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `microcategoria`
--

INSERT INTO `microcategoria` (`id`, `nome`, `id_macrocategoria`) VALUES
(10, 'Angular', 6),
(3, 'Informatica', 6),
(2, 'javascript', 6),
(1, 'php', 6),
(8, 'Prova4', 18),
(9, 'ProvaMicro1', 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `notifica`
--

CREATE TABLE `notifica` (
  `id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `tipo` enum('decisione','risoluzione','inserimento','segnalazione') NOT NULL,
  `letto` tinyint(1) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `preferito`
--

CREATE TABLE `preferito` (
  `id_utente` bigint(20) NOT NULL,
  `id_annuncio` bigint(20) NOT NULL,
  `data_aggiunta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `preferito`
--

INSERT INTO `preferito` (`id_utente`, `id_annuncio`, `data_aggiunta`) VALUES
(4, 1, '2016-12-07 00:00:00'),
(4, 2, '2016-12-07 00:00:00'),
(4, 3, '2016-12-30 19:21:53'),
(6, 3, '2016-12-07 00:00:00'),
(8, 3, '2016-12-07 00:00:00'),
(8, 4, '2016-12-07 00:00:00'),
(15, 1, '2017-01-03 14:45:09'),
(15, 3, '2017-01-03 14:45:22');

-- --------------------------------------------------------

--
-- Struttura della tabella `riferito`
--

CREATE TABLE `riferito` (
  `id_annuncio` bigint(20) NOT NULL,
  `id_microcategoria` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `riferito`
--

INSERT INTO `riferito` (`id_annuncio`, `id_microcategoria`) VALUES
(1, 2),
(1, 3),
(3, 8),
(4, 1),
(5, 3),
(6, 1),
(7, 10),
(8, 9),
(9, 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` bigint(20) NOT NULL,
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
  `partita_iva` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `nome`, `cognome`, `descrizione`, `telefono`, `data_nascita`, `citta`, `email`, `password`, `ruolo`, `stato`, `immagine_profilo`, `partita_iva`) VALUES
(4, 'utente1', 'utente1', NULL, '123123123', '2016-12-02', 'asd', 'asd@asd.com', 'asd', 'utente', 'attivo', 'path.png', NULL),
(5, 'utente2', 'utente2', NULL, '123123123', '2016-12-13', 'ty', 'ty@ty.com', 'ty', 'utente', 'segnalato', 'path.png', NULL),
(6, 'paolo', 'di filippo', NULL, '123123123', '2016-12-01', 'siano', 'siano@siano.com', 'Crowdmine1', 'utente', 'attivo', 'path.png', NULL),
(8, 'Fabricio', 'Madaio', NULL, '3335608690', '2016-12-01', 'Abano Terme', 'fabricio.madaio@gmail.com', 'Crowdmine1', 'moderatore', 'bannato', 'path.png', NULL),
(13, 'Vincenzo', 'Noviello', NULL, '1234567891', '2016-12-08', 'Abbadia Cerreto', 'ok@ok.com', 'Crowdmine1', 'moderatore', 'attivo', 'path.png', '12312312312'),
(15, 'Giovanni', 'Leo', NULL, '1234567891', '2016-05-02', 'Abano Terme', 'juan@juan.com', 'Crowdmine1', 'amministratore', 'attivo', 'path.png', '12312312315');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `annuncio`
--
ALTER TABLE `annuncio`
  ADD PRIMARY KEY (`id`,`id_utente`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `bloccato`
--
ALTER TABLE `bloccato`
  ADD PRIMARY KEY (`id_utente`,`id_utente_bloccato`),
  ADD KEY `id_utente_bloccato` (`id_utente_bloccato`);

--
-- Indici per le tabelle `candidatura`
--
ALTER TABLE `candidatura`
  ADD PRIMARY KEY (`id`,`id_utente`,`id_annuncio`),
  ADD KEY `id_utente` (`id_utente`),
  ADD KEY `id_annuncio` (`id_annuncio`);

--
-- Indici per le tabelle `commento`
--
ALTER TABLE `commento`
  ADD PRIMARY KEY (`id`,`id_annuncio`,`id_utente`),
  ADD KEY `id_utente` (`id_utente`),
  ADD KEY `commento_ibfk_1` (`id_annuncio`);

--
-- Indici per le tabelle `competente`
--
ALTER TABLE `competente`
  ADD PRIMARY KEY (`id_utente`,`id_microcategoria`),
  ADD KEY `competente_ibfk_2` (`id_microcategoria`);

--
-- Indici per le tabelle `dispatcher_notifica`
--
ALTER TABLE `dispatcher_notifica`
  ADD PRIMARY KEY (`id_utente`,`id_notifica`),
  ADD KEY `dispatcher_notifica_ibfk_2` (`id_notifica`);

--
-- Indici per le tabelle `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`,`id_utente`,`id_annuncio`,`id_valutato`),
  ADD KEY `id_utente` (`id_utente`),
  ADD KEY `id_annuncio` (`id_annuncio`),
  ADD KEY `feedback_ibfk_3` (`id_valutato`);

--
-- Indici per le tabelle `interesse`
--
ALTER TABLE `interesse`
  ADD PRIMARY KEY (`id_utente`,`id_microcategoria`),
  ADD KEY `interesse_ibfk_2` (`id_microcategoria`);

--
-- Indici per le tabelle `macrocategoria`
--
ALTER TABLE `macrocategoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indici per le tabelle `messaggio`
--
ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`id`,`id_utente_mittente`,`id_utente_destinatario`),
  ADD KEY `id_utente_mittente` (`id_utente_mittente`),
  ADD KEY `id_utente_destinatario` (`id_utente_destinatario`);

--
-- Indici per le tabelle `microcategoria`
--
ALTER TABLE `microcategoria`
  ADD PRIMARY KEY (`id`,`id_macrocategoria`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `microcategoria_ibfk_1` (`id_macrocategoria`);

--
-- Indici per le tabelle `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `preferito`
--
ALTER TABLE `preferito`
  ADD PRIMARY KEY (`id_utente`,`id_annuncio`),
  ADD KEY `preferito_ibfk_2` (`id_annuncio`);

--
-- Indici per le tabelle `riferito`
--
ALTER TABLE `riferito`
  ADD PRIMARY KEY (`id_annuncio`,`id_microcategoria`),
  ADD KEY `riferito_ibfk_2` (`id_microcategoria`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `partita_iva` (`partita_iva`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `annuncio`
--
ALTER TABLE `annuncio`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT per la tabella `candidatura`
--
ALTER TABLE `candidatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT per la tabella `commento`
--
ALTER TABLE `commento`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT per la tabella `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT per la tabella `macrocategoria`
--
ALTER TABLE `macrocategoria`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT per la tabella `microcategoria`
--
ALTER TABLE `microcategoria`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT per la tabella `notifica`
--
ALTER TABLE `notifica`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
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
