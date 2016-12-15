<?php

include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once CONTROL_DIR . "ControlUtils.php";
include_once FILTER_DIR . 'SearchByTitleFilter.php';
include_once FILTER_DIR . 'SearchByUserIdFilter.php';
include_once FILTER_DIR . 'SearchByLocationFilter.php';
include_once FILTER_DIR . 'SearchByTypeFilter.php';
include_once FILTER_DIR . 'SearchByDateInterval.php';
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once MODEL_DIR . "/Commento.php";

    $managerAnnuncio = new AnnuncioManager();
    $filters = array();
    $commenti = array();
    $arrayCommenti = array();

    if (($_POST['titolo']) != null) {
        $titolo = $_POST['titolo'];
        $titoloObj = new SearchByTitleFilter($titolo);
        array_push($filters, $titoloObj);

    } else {
        $titolo = null;
    }

    if (($_POST['luogo']) != null) {
        $luogo = $_POST['luogo'];
        $luogoObj = new SearchByLocationFilter($luogo);
        array_push($filters, $luogoObj);

    } else {
        $luogo = null;
    }

    if (($_POST['tipologia']) != null) {
        $tipologia = $_POST['tipologia'];
        $tipologiaObj = new SearchByTypeFilter($tipologia);
        array_push($filters, $tipologiaObj);
    } else {
        $tipologia = null;
    }


    if (!isset($_POST['utente'])) {                      //attendiamo il manager Utente
        $utenteName = $_POST['utente'];
        $idUtente = "1";
        $utenteObj = new SearchByUserIdFilter($idUtente);
        array_push($filters, $utenteObj);
    } else {
        $idUtente = null;
    }


    if (($_POST['data']) != null) {
        $dataPost = $_POST['data'];
        $dataObj = new SearchByDateInterval($dataPost, date("Y-m-d"));
        array_push($filters, $dataObj);
    } else {
        $data = null;
    }


    try {
        $annunci = $managerAnnuncio->searchAnnuncio($filters);
        if (count($annunci) != 0) {
            for ($i = 0; $i < count($annunci); $i++) {
                array_push($arrayCommenti, $managerAnnuncio->getCommentsbyId($annunci[$i]->getId()));
            }
            $_SESSION['listaCommenti'] = serialize($arrayCommenti);
            $_SESSION['annunciRicercati'] = serialize($annunci);
            $_SESSION['provenienza'] = serialize("ricerca");
            //header("Location:" . DOMINIO_SITO . "/visualizzaAnnunciRicercati");
            include_once VIEW_DIR . "visualizzaAnnunciRicercati.php";
        } else {
            header("Location:" . DOMINIO_SITO . "/nothingFound");
        }

    } catch (ApplicationException $e) {

    }


?>