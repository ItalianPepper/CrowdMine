<?php

include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once CONTROL_DIR . "ControlUtils.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once FILTER_DIR . 'SearchByDateInterval.php';
include_once FILTER_DIR . 'SearchByStatusOR.php';
include_once MODEL_DIR . "/Commento.php";
include_once CONTROL_DIR . "annuncioBaseControl.php";
include_once VIEW_DIR . "ViewUtils.php";
include_once CONTROL_DIR . "ControlUtils.php";


$managerAnnuncio = new AnnuncioManager();

$filters= Array(

    new SearchByStatusOR(StatoAnnuncio::ATTIVO),
    new SearchByStatusOR(StatoAnnuncio::SEGNALATO),
    new OrderByDateFilter(OrderType::DESC)
);

$base = new annuncioBaseControl($managerAnnuncio,$filters,false,true,true);

$annunci = $base->getAnnunci();
$listaUtenti = $base->getListaUtenti();
$listaCommenti = $base->getListaCommenti();
$listaCandidature = $base->getListaCandidature();
$listaMicro = $base->getListaMicro();
$AnnunciMicroRef = $base->getAnnunciMicroRef();

include_once VIEW_DIR . "home.php";



?>

