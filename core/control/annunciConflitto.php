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
array_push($filter, new SearchByStatus(AMMINISTRATORE));
$lista = $manager->searchAnnuncio($filter);

$_SESSION["annunciConflitto"] = serialize($lista);

include_once VIEW_DIR ."visualizzaAnnunciConflittoAdmin.php";

?>