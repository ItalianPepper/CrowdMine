<?php
include_once MANAGER_DIR . "/AnnuncioManager.php";
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 13/12/2016
 * Time: 16:54
 */
//$utente = unserialize($_SESSION["utente"]);
//$idUtente = $utente->getId();
$idUtente = "1";
$managerAnnuncio = new AnnuncioManager();
$ann = $managerAnnuncio->getFavorite($idUtente);
$_SESSION["listaAnnunciPreferiti"] = serialize($ann);
include_once VIEW_DIR. "annunciPreferiti.php";
?>
