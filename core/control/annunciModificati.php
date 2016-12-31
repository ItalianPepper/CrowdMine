<?php

/**
 * Created by PhpStorm.
 * User: Andrea Sarto

 */
include_once MANAGER_DIR ."/AnnuncioManager.php";
include_once MANAGER_DIR . "UtenteManager.php";

$filter = array();
$manager = new AnnuncioManager();
$utenteManager = new UtenteManager();

array_push($filter, new SearchByStatus(REVISIONE_MODIFICA));
$lista = $manager->searchAnnuncio($filter);
$listaUtenti = $utenteManager->getUserAssociatedWithAnnuncio($filter);

$_SESSION["annunciModificati"] = serialize($lista);
$_SESSION["listaUtentiAssociati"] = serialize($listaUtenti);

include_once VIEW_DIR ."visualizzaAnnunciModificati.php";

?>