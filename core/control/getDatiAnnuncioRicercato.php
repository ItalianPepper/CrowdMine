<?php

include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once MANAGER_DIR . 'UtenteManager.php';
include_once CONTROL_DIR . "ControlUtils.php";
include_once FILTER_DIR . 'SearchByTitleFilter.php';
include_once EXCEPTION_DIR . "IllegalArgumentException.php";

if($_SERVER["REQUEST_METHOD"]=="POST") {

    if(isset($_POST['titolo'])){
        $titolo = $_POST['titolo'];
        echo $titolo;
    } else {
        $titolo = null;
    }

    if(isset($_POST['data'])) {
        $data = $_POST['data'];
    } else {
        $data = null;
    }

    if (isset($_POST['utente'])) {
        $utenteName =  $_POST['utente'];
        echo $utenteName;
        $utenteManager = new UtenteManager();
        $utenteManager->getUtenteByName($utenteName);


    }







    try {
        $managerAnnuncio = new AnnuncioManager();
        $filters = array();
        $titoloObj = new SearchByTitleFilter($titolo);
        array_push($filters, $titoloObj);
        $annunci = $managerAnnuncio->searchAnnuncio($filters); //fino a qui la ricerca funziona
        $_SESSION['annunciRicercati'] = serialize($annunci);
        //header("Location:" . DOMINIO_SITO . "/visualizzaAnnunciRicercati");
    } catch (ApplicationException $e) {

    }



}

?>