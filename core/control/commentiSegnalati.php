<?php
/**
 * Created by PhpStorm.
 * User: Andrea Sarto
 * Date: 13/12/2016
 * Time: 10.51
 */

include_once MANAGER_DIR ."AnnuncioManager.php";
include_once MODEL_DIR . "Commento.php";
include_once CONTROL_DIR . "annuncioBaseControl.php";
include_once MANAGER_DIR . "UtenteManager.php";

$managerAnnuncio = new AnnuncioManager();
$managerUtente = new UtenteManager();

$listaCommentiSegnalati = $managerAnnuncio->getReportedCommento();

$listaUtentiCommenti = array();
$listaAnnunciCommenti = array();

$UtentiCommentiAdmin = array();
$AnnunciCommentiAdmin = array();

foreach ($listaCommentiSegnalati as $c) {
    if ($c->getStato() == statoCommento::AMMINISTRATORE && $user->getRuolo() == RuoloUtente::AMMINISTRATORE) {
        $UtentiCommentiAdmin[$c->getId()]= $managerUtente->findUtenteById($c->getIdUtente());
        $AnnunciCommentiAdmin[$c->getId()]= $managerAnnuncio->getAnnuncio($c->getIdAnnuncio());
    } else {
        $listaUtentiCommenti[$c->getId()]= $managerUtente->findUtenteById($c->getIdUtente());
        $listaAnnunciCommenti[$c->getId()]= $managerAnnuncio->getAnnuncio($c->getIdAnnuncio());
    }
}

include_once VIEW_DIR . "visualizzaCommentiSegnalati.php";
