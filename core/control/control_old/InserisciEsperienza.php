<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once CONTROL_DIR . 'Controller.php';
include_once MODEL_DIR . 'Feedback.php';
include_once MODEL_DIR . 'Utente.php';
include_once EXCEPTION_DIR . "IllegalArgumentException.php";


$utente = unserialize($_SESSION['user']);
$esperienza = inserisciEsperienza(strip_tags(htmlspecialchars(addslashes($_POST['titolo']))), strip_tags(htmlspecialchars(addslashes($_POST['descrizione']))), $_GET['voto'], $utente->getEmail(), $_GET['email_utente']);

function inserisciEsperienza($titolo, $descrizione, $voto, $recensore, $email) {
    if (!preg_match(Patterns::$NAME_GENERIC, $titolo)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Titolo assente oppure errato";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        throw new IllegalArgumentException("Titolo assente oppure errato");
    }
    if (!preg_match(Patterns::$NAME_GENERIC, $descrizione)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Descrizione assente oppure errato";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        throw new IllegalArgumentException("Descrizione assente oppure errato");
    }
    if (!preg_match(Patterns::$EMAIL, $email)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Email non valida";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        throw new IllegalArgumentException("Email non valida");
    }
    //CONVERT TO DATETIME
    $dataPubblicazione = new DateTime();
    $dataPub = $dataPubblicazione->format("Y-m-d H:i:s");
    return createEsperienza(new Esperienza(null, $titolo, $dataPub, $descrizione, $recensore, $email, $voto));
}

function createEsperienza($esperienza) {

    $INSERT_ESPERIENZA = "INSERT INTO `esperienza`(`titolo`, `data`, `descrizione`, `recensore`, `voto`, `email_utente`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s');";

    $query = sprintf($INSERT_ESPERIENZA, $esperienza->getTitolo(), $esperienza->getData(), $esperienza->getDescrizione(), $esperienza->getRecensore(), $esperienza->getVoto(), $esperienza->getEmailUtente());
    if (!Controller::getDB()->query($query)) {
        if (Controller::getDB()->errno == 1062) {
            throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
        } else
            throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
    }
    return $esperienza;
}

function getUtenteByEmail($email) {
    $GET_UTENTE_EMAIL = "SELECT * FROM `utente` WHERE `e-mail` = '%s'";
    $query = sprintf($GET_UTENTE_EMAIL, $email);

    $res = Controller::getDB()->query($query);
    return parseUtente($res);
}

function parseUtente($res) {
    if ($obj = $res->fetch_assoc()) {
        return new Utente($obj['nome'], $obj['cognome'], $obj['telefono'], $obj['e-mail'], $obj['citta'], $obj['password'], $obj['descrizione'], $obj['immagine'], $obj['tipologia'], $obj['data'], $obj['id'], $obj['professione']);
    } else {
        throw new ApplicationException(ErrorUtils::$UTENTE_NON_TROVATO);
    }
}
$user = getUtenteByEmail($esperienza->getEmailUtente());
$profileId = $user->getId();
$_SESSION['toast-type'] = "success";
$_SESSION['toast-message'] = "Esperienza inserita con successo";
header("Location:" . DOMINIO_SITO . "/profilo/".$profileId);