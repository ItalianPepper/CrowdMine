<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once CONTROL_DIR . 'Controller.php';
include_once MODEL_DIR . 'Annuncio.php';
include_once MODEL_DIR . 'Utente.php';
include_once EXCEPTION_DIR . "IllegalArgumentException.php";

$utente = unserialize($_SESSION['user']); //QUI DA RIVEDERE!!!
$tipoUtente = $utente->getTipologia();
$Annuncio = inserisciAnnuncio(strip_tags(htmlspecialchars(addslashes($_POST['titolo']))), $_POST['data'], strip_tags(htmlspecialchars(addslashes($_POST['descrizione']))), $_POST['citta'], $utente->getEmail(), $tipoUtente);

function inserisciAnnuncio($titolo, $data, $descrizione, $luogo, $email, $tipoUtente) {
    /*     * if (!preg_match(Patterns::$MATRICOLA, $titolo)) {
      throw new IllegalArgumentException("Titolo assente oppure errato");
      } */
    if (!preg_match(Patterns::$GENERIC_DATE, $data)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Data non valida";
        header("Location:" . DOMINIO_SITO . "/inserisciAnnuncio");
        throw new IllegalArgumentException("Data non valida");
    }
    if (!preg_match(Patterns::$NAME_GENERIC, $luogo)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Luogo assente oppure errato";
        header("Location:" . DOMINIO_SITO . "/inserisciAnnuncio");
        throw new IllegalArgumentException("Luogo assente oppure errato");
    }
    if (!preg_match(Patterns::$EMAIL, $email)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Email non valida";
                header("Location: " . $_SERVER['HTTP_REFERER']);
        throw new IllegalArgumentException("Email non valida");
    }
    //CONVERT TO DATETIME
    if ($tipoUtente == "Cliente") {
        $tipologia = "Richiesta";
    } else {
        $tipologia = "Offerta";
    }
    $data = str_replace('/', '-', $data);
    $TheDate = date("Y-m-d H:i:s", strtotime($data));
    $dataPubblicazione = new DateTime();
    $dataPub = $dataPubblicazione->format("Y-m-d H:i:s");
    return createAnnuncio(new Annuncio(null, $titolo, $TheDate, $descrizione, $luogo, $dataPub, $tipologia, $email));
}

function createAnnuncio($Annuncio) {

    $INSERT_ANNUNCIO = "INSERT INTO `annuncio` (`titolo`, `data`, `descrizione`, `luogo`, `data_pubblicazione`, `tipologia`, `email_utente`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');";

    $query = sprintf($INSERT_ANNUNCIO, $Annuncio->getTitolo(), $Annuncio->getData(), $Annuncio->getDescrizione(), $Annuncio->getLuogo(), $Annuncio->getDataPubblicazione(), $Annuncio->getTipologia(), $Annuncio->getEmail());
    if (!Controller::getDB()->query($query)) {
        if (Controller::getDB()->errno == 1062) {
            throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
        } else
            throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
    }
    return $Annuncio;
}

$_SESSION['toast-type'] = "success";
$_SESSION['toast-message'] = "Annuncio inserito con successo";
header("Location:" . DOMINIO_SITO . "/");
