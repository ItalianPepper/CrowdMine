<?php

include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once CONTROL_DIR . "ControlUtils.php";
include_once FILTER_DIR . 'SearchByTitleFilter.php';
include_once FILTER_DIR . 'SearchByUserIdFilter.php';
include_once FILTER_DIR . 'SearchByLocationFilter.php';
include_once FILTER_DIR . 'SearchByDateInterval.php';
include_once EXCEPTION_DIR . "IllegalArgumentException.php";

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $managerAnnuncio = new AnnuncioManager();
    $filters = array();

    if(($_POST['titolo']) != null){
        $titolo = $_POST['titolo'];
        $titoloObj = new SearchByTitleFilter($titolo);
        array_push($filters, $titoloObj);

    } else {
        $titolo = null;
    }

    if(($_POST['luogo']) != null){
        $luogo = $_POST['luogo'];
        $luogoObj = new SearchByLocationFilter($luogo);
        array_push($filters, $luogoObj);

    } else {
        $luogo = null;
    }


    if (isset($_POST['utente'])) {
        $utenteName =  $_POST['utente'];
        $idUtente = "1";
        $utenteObj = new SearchByUserIdFilter($idUtente);
        array_push($filters, $utenteObj);
    } else {
        $idUtente = null;
    }

    if(($_POST['data']) != null) {
        $dataPost = $_POST['data'];
        $currentDate = new DateTime();
        $currentDate->format('Y-m-d H:i:s');
        $dataObj = new SearchByDateInterval($dataPost, $currentDate->getTimestamp());
        array_push($filters, $dataObj);
    } else {
        $data = null;
    }


    try {
        $annunci = $managerAnnuncio->searchAnnuncio($filters); //fino a qui la ricerca funziona
        $_SESSION['annunciRicercati'] = serialize($annunci);
        header("Location:" . DOMINIO_SITO . "/visualizzaAnnunciRicercati");
    } catch (ApplicationException $e) {

    }
}

?>