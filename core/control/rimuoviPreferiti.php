<?php


include_once MANAGER_DIR ."/AnnuncioManager.php";

$idUtente = 4;


if (isset($_GET["id"])) {
    $idAnnuncio = $_GET["id"];
    $managerAnnuncio = new AnnuncioManager(); /* Declaration and initialization a manager variable */
    try {
        $preferiti = $managerAnnuncio->removeFromFavorites($idAnnuncio, $idUtente);
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "L'annuncio è stato rimosso dai preferiti";
        include_once CONTROL_DIR . "visualizzaPreferiti.php";
    } catch (ApplicationException $a) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Problemi con la rimozione dai preferiti";
        include_once CONTROL_DIR . "visualizzaPreferiti.php";
    }
}


else {
    echo "qui ci va la pagina 404 di errore";
}

?>
