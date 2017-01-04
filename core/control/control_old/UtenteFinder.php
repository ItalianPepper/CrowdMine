<?php

include_once CONTROL_DIR . "Controller.php";
include_once MODEL_DIR . "Utente.php";

$nome = $_GET['nome'];
$cognome = $_GET['cognome'];
echo getUtente($nome,$cognome);

//if ($hint != ""){
//    echo $hint;
//}
//else echo $q;

function getUtente($nome,$cognome) {
    $GET_UTENTE = "SELECT * FROM `utente` WHERE `nome`='%s' AND `cognome`='%s'";
    $query = sprintf($GET_UTENTE,$nome,$cognome);
    $res = Controller::getDB()->query($query);
    $utenti = array();
    if ($res) {
        while ($obj = $res->fetch_assoc()) {
            $utente = new Utente($obj['nome'], $obj['cognome'], $obj['telefono'], $obj['e-mail'], $obj['citta'], $obj['password'], $obj['descrizione'], $obj['immagine'], $obj['tipologia'], $obj['data'], $obj['id'],$obj['professione']);
            $utenti[] = $utente;
        }
    }
    if (count($utenti) > 1)
        return "piu utenti";
    else if (count($utenti) == 0)
        return "non trovato";
    return $utenti[0]->getId();
}
