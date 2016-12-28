<?php
/**
 * Created by PhpStorm.
 * User: Lino
 */


include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';
include_once CONTROL_DIR .'ControlUtils.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
     * Checking if the POST variable are septate
     */

    if (isset($_POST['idUtenteAdmin'])){
        $status = StatoUtente::AMMINISTRATORE;
        $idUtente = testInput($_POST['idUtenteAdmin']);
    }

    if (isset($_POST['idUtenteElimina'])){
        $status = StatoUtente::ATTIVO;
        $idUtente = testInput($_POST['idUtenteElimina']);
    }

    if (!isset($idUtente)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "ID Utente Non settato";
        header("Location:" . DOMINIO_SITO . "/UtentiSegnalati");
        throw new IllegalArgumentException("ID Utente Non settato");
    }

    $userManager = new UtenteManager();
    $examinedUser = $userManager->findUtenteById($idUtente);
    if(isset($examinedUser)) {
        $userManager->updateStatusUtente($examinedUser, $status);

        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "Utente aggiornato";
    }
}
header("Location:" . DOMINIO_SITO . "/UtentiSegnalati");

