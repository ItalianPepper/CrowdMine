<?php

include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once CONTROL_DIR . "ControlUtils.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once FILTER_DIR . 'SearchByDateInterval.php';
include_once MODEL_DIR . "/Commento.php";
include_once CONTROL_DIR . "annuncioBaseControl.php";
include_once VIEW_DIR . "ViewUtils.php";
include_once CONTROL_DIR . "ControlUtils.php";
include_once FILTER_DIR . 'SearchByTitleFilter.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = "";
    if (isset($_POST["form-text"]))
    {
        $title = $_POST["form-text"];
    }
    else
    {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo ricerca non settato";
        header("Location:" . DOMINIO_SITO);
    }
    $managerAnnuncio = new AnnuncioManager();


    $filters = Array(new SearchByStatus(StatoAnnuncio::ATTIVO), new SearchByTitleFilter($title));

    $base = new annuncioBaseControl($managerAnnuncio, $filters, false, true, true);

    $annunci = $base->getAnnunci();
    $listaUtenti = $base->getListaUtenti();
    $listaCommenti = $base->getListaCommenti();
    $listaCandidature = $base->getListaCandidature();
    $listaMicro = $base->getListaMicro();
    $AnnunciMicroRef = $base->getAnnunciMicroRef();

    $sideBarIconName = "ricercaAnnuncio";

    include_once VIEW_DIR . "home.php";
}


?>

