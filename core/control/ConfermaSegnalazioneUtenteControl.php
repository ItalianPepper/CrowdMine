<?php
/**
 * Created by PhpStorm.
 * User: Lino
 */


include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
     * Checking if the POST variable are septate
     */
    if (!isset($_POST['idUtenteConferma']) && !isset($_POST['idUtenteElimina'])){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "ID Utente Non settato";
        header("Location:" . DOMINIO_SITO . "/visualizzaUtentiSegnalati");
        throw new IllegalArgumentException("ID Utente Non settato");
    }
    else if (isset($_POST['idUtenteConferma'])) {
        $conferma = true;
        $idUtente = strip_tags(htmlspecialchars(addslashes($_POST['idUtenteConferma'])));
    }
    else {
        $conferma = false;
        $idUtente = strip_tags(htmlspecialchars(addslashes($_POST['idUtenteElimina'])));
    }

    if (empty($idUtente)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id Utente empty";
        header("Location:" . DOMINIO_SITO . "/visualizzaUtentiSegnalati");
        throw new IllegalArgumentException("Id Utente empty");
    }

    if(conferma){
        //$userManager = new UtenteManager();
        //$user = $userManager->findUtenteById(idUtente);
        //$user.setStato(StatoUtente::AMMINISTRATORE);
        //$userManager->updateUtente($user);
    }
    else {
        //$userManager = new UtenteManager();
        //$user = $userManager->findUtenteById(idUtente);
        //$user.setStato(StatoUtente::ATTIVO);
        //$userManager->updateUtente($user);
    }

   header("Location:" . DOMINIO_SITO . "/visualizzaUtentiSegnalati");

}

