<?php
include_once MANAGER_DIR ."/AnnuncioManager.php";

if (isset($_GET["id"])) {
    $idAnnuncio = $_GET["id"];
    $managerAnnuncio = new AnnuncioManager(); /* Declaration and initialization a manager variable */
    try{
        $managerAnnuncio->reportAnnuncio($idAnnuncio);
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "L'annuncio è stato segnalato";
        include_once CONTROL_DIR . "visualizzaHome.php";

    } catch (ApplicationException $a){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Problemi con la segnalazione";
        include_once CONTROL_DIR . "visualizzaHome.php";
    }

} else {
    echo "qui ci va la pagina 404 di errore";
}

?>