<?php
include_once MANAGER_DIR ."/AnnuncioManager.php";

$manager = new AnnuncioManager();
$idUtente = 1; // si deve prendere dalla sessione
$lista = $manager->searchAnnunciUtente($idUtente);

$_SESSION["lista"] = serialize($lista);
header("Location:" . DOMINIO_SITO . "/visualizzaAnnunciProprietari");

?>