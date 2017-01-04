<?php

include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once MANAGER_DIR . 'UtenteManager.php';
include_once CONTROL_DIR . "ControlUtils.php";
include_once VIEW_DIR . "ViewUtils.php";

include_once CONTROL_DIR . "annuncioBaseControl.php";

include_once FILTER_DIR . 'SearchByTitleFilter.php';
include_once FILTER_DIR . 'SearchByUserIdFilter.php';
include_once FILTER_DIR . 'SearchByLocationFilter.php';
include_once FILTER_DIR . 'SearchByTypeFilter.php';
include_once FILTER_DIR . 'SearchByDateInterval.php';
include_once FILTER_DIR . 'SearchByMacroFilter.php';
include_once FILTER_DIR . 'SearchByMicroFilter.php';
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once MODEL_DIR . "/Commento.php";

    $managerAnnuncio = new AnnuncioManager();
    $managerUtente = new UtenteManager();
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

    if(isset($_POST['tipologia']) && ($_POST['tipologia']) != null) {
            $tipologia = $_POST['tipologia'];
            $tipologiaObj = new SearchByTypeFilter($tipologia);
            array_push($filters, $tipologiaObj);
        } else {
            $tipologia = null;
    }

    if (isset($_POST['utente']) && ($_POST['utente']) != null) {
        $utenteInput = $_POST["utente"];
        $utente = $managerUtente->findUserOneInput($utenteInput);
        for ($i = 0; $i < count($utente); $i++) {
            $utenteObj = new SearchByUserIdFilter($utente[$i]->getId());
            array_push($filters, $utenteObj);
        }
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

    if (isset($_POST['macro'])) {
        $macro = $_POST['macro'];
        $macroObj = new SearchByMacroFilter($macro);
        array_push($filters, $macro);
    } else {
        $macro = null;
    }

    if (isset($_POST['micro'])) {
    $micro = $_POST['micro'];
    $microObj = new SearchByMicroFilter($micro);
    array_push($filters, $micro);
} else {
    $micro = null;
}



if(count($filters)==0){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Nessun filtro settato";
        //include_once VIEW_DIR . "ricercaAnnuncio.php";
    } else {
        try {
            //aggiungo altri filtri per non mostrare gli annunci eliminati e disattivati
            array_push($filters,new SearchByNotStatus(ELIMINATO));
            array_push($filters,new SearchByNotStatus(DISATTIVATO));
            array_push($filters,new SearchByNotStatus(REVISIONE));

            $base = new annuncioBaseControl($managerAnnuncio,$filters,false,true,true);

            $annunci = $base->getAnnunci();
            $listaUtenti = $base->getListaUtenti();
            $listaCommenti = $base->getListaCommenti();
            $listaCandidature = $base->getListaCandidature();
            $listaMicro = $base->getListaMicro();
            $AnnunciMicroRef = $base->getAnnunciMicroRef();

            if (count($annunci) != 0) {
                include_once VIEW_DIR . "home.php";
            } else {
                $_SESSION['toast-type'] = "error";
                $_SESSION['toast-message'] = "Nessun annuncio trovato";
                include_once VIEW_DIR . "ricercaAnnuncio.php";
            }

        } catch (ApplicationException $e) {

        }

    }
?>