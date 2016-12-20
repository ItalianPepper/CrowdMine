<?php

/**
 * Created by PhpStorm.
 * User: Andrea Sarto

 */
include_once MANAGER_DIR ."/AnnuncioManager.php";
include_once MANAGER_DIR . "UtenteManager.php";

$filter = array();
$manager = new AnnuncioManager();
array_push($filter, new SearchByStatus(REVISIONE_MODIFICA));
$lista = $manager->searchAnnuncio($filter);

$_SESSION["annunciModificati"] = serialize($lista);

include_once VIEW_DIR ."visualizzaAnnunciModificati.php";

?>