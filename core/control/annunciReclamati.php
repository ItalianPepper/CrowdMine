<?php

/**
 * Created by PhpStorm.
 * User: Andrea Sarto
 * Date: 12/12/2016
 * Time: 22.42
 */
include_once MANAGER_DIR ."AnnuncioManager.php";
include_once MANAGER_DIR . "UtenteManager.php";

include_once VIEW_DIR . "ViewUtils.php";
include_once CONTROL_DIR . "ControlUtils.php";

include_once CONTROL_DIR . "annuncioBaseControl.php";

$filter = array();
$managerAnnuncio = new AnnuncioManager();
$utenteManager = new UtenteManager();

array_push($filter, new SearchByStatus(StatoAnnuncio::RICORSO));
$base = new annuncioBaseControl($managerAnnuncio,$filter,false,false,true);

$annunci = $base->getAnnunci();
$listaUtenti = $base->getListaUtenti();

$listaMicro = $base->getListaMicro();
$AnnunciMicroRef = $base->getAnnunciMicroRef();

include_once VIEW_DIR ."visualizzaAnnunciReclamati.php";

?>