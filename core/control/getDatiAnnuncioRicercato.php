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
include_once FILTER_DIR . 'SearchByMicrosFilter.php';
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once MODEL_DIR . "/Commento.php";

    $managerAnnuncio = new AnnuncioManager();
    $managerUtente = new UtenteManager();
    $filters = array();
    $commenti = array();
    $arrayCommenti = array();

    if (isset($_POST['titolo']) && ($_POST['titolo']) != null) {
        $titolo = testInput($_POST['titolo']);
        $titoloObj = new SearchByTitleFilter($titolo);
        array_push($filters, $titoloObj);

    } else {
        $titolo = null;
    }

    if (isset($_POST['luogo']) && ($_POST['luogo']) != null) {
        $luogo = testInput($_POST['luogo']);
        $luogoObj = new SearchByLocationFilter($luogo);
        array_push($filters, $luogoObj);

    } else {
        $luogo = null;
    }


    if(isset($_POST['tipologia']) && ($_POST['tipologia']) != null) {
            $tipologia = testInput($_POST['tipologia']);
            $tipologiaObj = new SearchByTypeFilter($tipologia);
            array_push($filters, $tipologiaObj);
        } else {
            $tipologia = null;
    }

    if (isset($_POST['utente']) && ($_POST['utente']) != null) {
        $utenteInput = testInput($_POST["utente"]);
        $utente = $managerUtente->findUserOneInput($utenteInput);
        for ($i = 0; $i < count($utente); $i++) {
            $utenteObj = new SearchByUserIdFilter($utente[$i]->getId());
            array_push($filters, $utenteObj);
        }
    } else {
        $idUtente = null;
    }

    if (isset($_POST['data']) && ($_POST['data']) != null) {
        $dataPost = testInput($_POST['data']);
        $dataObj = new SearchByDateInterval($dataPost, date("Y-m-d"));
        array_push($filters, $dataObj);
    } else {
        $data = null;
    }

    if (isset($_POST['lista-Micro'])) {

        $listaMicrocategorie = json_decode($_POST["lista-Micro"], true);

        $arrayMicro = array();

        for ($i = 0; $i < count($listaMicrocategorie); $i++) {
            array_push($arrayMicro, testInput($listaMicrocategorie[$i]["idMicro"]));
        }

        if(count($arrayMicro)>0)
        array_push($filters, new SearchByMicrosFilter($arrayMicro));
    }

if(count($filters)==0){
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "Tutti gli annunci";
        header("Location:" . DOMINIO_SITO);
        exit();
    } else {
        try {
            //aggiungo altri filtri per non mostrare gli annunci eliminati e disattivati
            array_push($filters,new SearchByNotStatus(StatoAnnuncio::ELIMINATO));
            array_push($filters,new SearchByNotStatus(StatoAnnuncio::DISATTIVATO));
            array_push($filters,new SearchByNotStatus(StatoAnnuncio::REVISIONE));
            array_push($filters,new SearchByNotStatus(StatoAnnuncio::REVISIONE_MODIFICA));
            array_push($filters,new SearchByNotStatus(StatoAnnuncio::RICORSO));
            array_push($filters,new SearchByNotStatus(StatoAnnuncio::AMMINISTRATORE));

            $base = new annuncioBaseControl($managerAnnuncio,$filters,false,true,true);

            $annunci = $base->getAnnunci();
            $listaUtenti = $base->getListaUtenti();
            $listaCommenti = $base->getListaCommenti();
            $listaCandidature = $base->getListaCandidature();
            $listaMicro = $base->getListaMicro();
            $AnnunciMicroRef = $base->getAnnunciMicroRef();

            if (count($annunci) != 0) {
                include_once VIEW_DIR . "home.php";
                exit();
            } else {
                $_SESSION['toast-type'] = "error";
                $_SESSION['toast-message'] = "Nessun annuncio trovato";
                include_once VIEW_DIR . "ricercaAnnuncio.php";
                exit();
            }

        } catch (ApplicationException $e) {

        }

    }

include_once VIEW_DIR . "ricercaAnnuncio.php";

?>