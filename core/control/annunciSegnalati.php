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

$managerAnnuncio = new AnnuncioManager();
$utenteManager = new UtenteManager();

$filterSegnalato = Array(new SearchByStatus(StatoAnnuncio::SEGNALATO));
$baseSegnalato = new annuncioBaseControl($managerAnnuncio,$filterSegnalato,false,false,true);

$annunci = $baseSegnalato->getAnnunci();
$listaUtenti = $baseSegnalato->getListaUtenti();

$listaMicro = $baseSegnalato->getListaMicro();
$AnnunciMicroRef = $baseSegnalato->getAnnunciMicroRef();

if($user->getRuolo() == RuoloUtente::AMMINISTRATORE) {

    $filterAdmin = Array(new SearchByStatus(StatoAnnuncio::AMMINISTRATORE));
    $baseAdmin = new annuncioBaseControl($managerAnnuncio, $filterAdmin, false, false, true);

    $annunciAdmin = $baseAdmin->getAnnunci();
    $listaUtentiAdmin = $baseAdmin->getListaUtenti();

    $listaMicroAdmin = $baseAdmin->getListaMicro();
    $AnnunciMicroRefAdmin = $baseAdmin->getAnnunciMicroRef();
}

include_once VIEW_DIR ."visualizzaAnnunciSegnalati.php";

?>
