<?php
include_once MANAGER_DIR . "/AnnuncioManager.php";
if(isset($_GET["id"])){
    $idAnn = $_GET["id"];
    $managerAnnunci = new AnnuncioManager();
    $ris = $managerAnnunci->getAnnuncio($idAnn);
    $_SESSION["annuncio"] = serialize($ris);
    header("Location: ". DOMINIO_SITO . "/visualizzaModificaAnnuncio");
} else {
    header("Location: " . DOMINIO_SITO ."/annunciProprietari");
}
?>