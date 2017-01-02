<?php


include_once MANAGER_DIR ."/AnnuncioManager.php";

$user = unserialize($_SESSION['user']);
$idUtente = $user->getId();
$dataPubblicazione = new DateTime();
$data = $dataPubblicazione->format("Y-m-d H:i:s");

if (isset($_GET["id"])) {
    $idAnnuncio = $_GET["id"];
    $managerAnnuncio = new AnnuncioManager(); /* Declaration and initialization a manager variable */
    $preferiti = $managerAnnuncio->getFavorite($idUtente);
    for ($i = 0; $i < count($preferiti); $i++) {
        if ($preferiti[$i]->getId() == $idAnnuncio) {
            $_SESSION['toast-type'] = "error";
            $_SESSION['toast-message'] = "L'annuncio è già stato aggiunto ai preferiti";
            include_once CONTROL_DIR . "visualizzaHome.php";
        }
    }

    try {
        $managerAnnuncio->addToFavorites($idAnnuncio, $idUtente, $data);
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "L'annuncio è stato aggiunto ai preferiti";
        include_once CONTROL_DIR . "visualizzaHome.php";
    } catch (ApplicationException $a) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Problemi con l'aggiunta ai preferiti";
        include_once CONTROL_DIR . "visualizzaHome.php";
    }
}


else {
        echo "qui ci va la pagina 404 di errore";
    }

?>



