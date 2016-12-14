<?php
include_once MANAGER_DIR ."/AnnuncioManager.php";
$managerAnnuncio = new AnnuncioManager(); /* Declaration and initialization a manager variable */
$idAnnuncio = $_POST["idAnnuncio"]; /* Declaration and initialization a user variable contain an unserialized version of a parameter who reference to annuncio's info, given from session */
try{
    $managerAnnuncio->reportAnnuncio($idAnnuncio);
    $_SESSION['toast-type'] = "success";
    $_SESSION['toast-message'] = "L'annuncio è stato segnalato";
    header("Location:" . DOMINIO_SITO . "/visualizzaAnnunciRicercati");

} catch (ApplicationException $a){
    $_SESSION['toast-type'] = "error";
    $_SESSION['toast-message'] = "Problemi con la segnalazione";
    header("Location: " . DOMINIO_SITO ."/visualizzaAnnunciRicercati");
}



?>