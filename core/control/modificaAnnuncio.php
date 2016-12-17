<?php
include_once MANAGER_DIR . "/AnnuncioManager.php";
if(isset($_GET["id"])){
    $idAnn = $_GET["id"];
    $managerAnnunci = new AnnuncioManager();
    $ris = $managerAnnunci->getAnnuncio($idAnn);
    $_SESSION["annuncio"] = serialize($ris);
    include_once VIEW_DIR . "modificaAnnuncio.php";
} else {
    header("Location: " . DOMINIO_SITO ."/annunciProprietari");
}
?>