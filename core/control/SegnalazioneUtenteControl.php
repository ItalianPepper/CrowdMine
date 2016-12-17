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
    if (!isset($_POST['idUtenteAdmin']) && !isset($_POST['idUtenteElimina'])){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "ID Utente Non settato";
        header("Location:" . DOMINIO_SITO . "/visualizzaUtentiSegnalati");
        throw new IllegalArgumentException("ID Utente Non settato");
    }
    else if (isset($_POST['idUtenteAdmin'])) {
        $admin = true;
        $idUtente = strip_tags(htmlspecialchars(addslashes($_POST['idUtenteAdmin'])));
    }
    else {
        $admin = false;
        $idUtente = strip_tags(htmlspecialchars(addslashes($_POST['idUtenteElimina'])));
    }

    if (empty($idUtente)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id Utente empty";
        header("Location:" . DOMINIO_SITO . "/visualizzaUtentiSegnalati");
        throw new IllegalArgumentException("Id Utente empty");
    }

    if($admin){
        echo "Admin";
        //$userManager = new UtenteManager();
        //$user = $userManager->findUtenteById(idUtente);
        //$user.setStato(StatoUtente::AMMINISTRATORE);
        //$userManager->updateUtente($user);
    }
    else {
        echo "Elimina";
        //$userManager = new UtenteManager();
        //$user = $userManager->findUtenteById(idUtente);
        //$user.setStato(StatoUtente::ATTIVO);
        //$userManager->updateUtente($user);
    }

   //header("Location:" . DOMINIO_SITO . "/visualizzaUtentiSegnalati");

}

