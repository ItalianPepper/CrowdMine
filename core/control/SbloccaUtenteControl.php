<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 14/12/2016
 * Time: 19:02
 */
include_once MANAGER_DIR.'UtenteManager.php';
include_once CONTROL_DIR . "ControlUtils.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    /**
     * Checking if the POST variable are septate
     */
    if (isset($_GET['idUtente'])) {
        $userId = testInput($_GET['idUtente']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id Utente non settato";
        header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
        throw new IllegalArgumentException("Id Utente non settato");
    }
    $userManager = new UtenteManager();
    $userManager->removeBlockedUser($userId,$user->getId());
    $_SESSION['toast-type'] = "success";
    $_SESSION['toast-message'] = "Utente Sbloccato";

}

header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
