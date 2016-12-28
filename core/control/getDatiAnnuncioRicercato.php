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

    if(isset($_POST['tipologia'])) {
        if (($_POST['tipologia']) != null) {
            $tipologia = $_POST['tipologia'];
            $tipologiaObj = new SearchByTypeFilter($tipologia);
            array_push($filters, $tipologiaObj);
        } else {
            $tipologia = null;
        }
    }


    if (isset($_POST['utente'])) {
        $idUtente = $_POST["utente"];
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

    if (isset($_POST['macrocategorie'])) {
        echo $_POST['macrocategorie'];
    } else {
        echo "unset";
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
            $annunci = $managerAnnuncio->searchAnnuncio($filters);
            if (count($annunci) != 0) {
                for ($i = 0; $i < count($annunci); $i++) {
                    array_push($arrayCommenti, $managerAnnuncio->getCommentsbyId($annunci[$i]->getId()));
                }
                $_SESSION['listaCommenti'] = serialize($arrayCommenti);
                $_SESSION['annunciRicercati'] = serialize($annunci);
                $_SESSION['provenienza'] = serialize("ricerca");
                //include_once VIEW_DIR . "visualizzaAnnunciRicercati.php";
            } else {
                $_SESSION['toast-type'] = "error";
                $_SESSION['toast-message'] = "Nessun annuncio trovato";
                //include_once VIEW_DIR . "ricercaAnnuncio.php";
            }

        } catch (ApplicationException $e) {

        }

    }
?>