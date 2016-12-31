<?php

/**
 * Created by PhpStorm.
 * User: Andrea Sarto
 * Date: 12/12/2016
 * Time: 22.42
 */
include_once MANAGER_DIR ."/AnnuncioManager.php";
include_once MANAGER_DIR . "UtenteManager.php";

$filter = array();
$manager = new AnnuncioManager();
$utenteManager = new UtenteManager();

array_push($filter, new SearchByStatus(RICORSO));
$lista = $manager->searchAnnuncio($filter);
$listaUtenti = $utenteManager->getUserAssociatedWithAnnuncio($filter);


$_SESSION["listaUtentiAssociati"] = serialize($listaUtenti);
$_SESSION["annunciReclamati"] = serialize($lista);

include_once VIEW_DIR ."visualizzaAnnunciReclamati.php";

?>