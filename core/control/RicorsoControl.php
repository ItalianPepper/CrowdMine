<?php

/**
 * User: Andrea Buonaguro   
 * Date: 7/12/2016
 * Time: 19:07
 */
include_once MANAGER_DIR . "UtenteManager.php";
include_once CONTROL_DIR . "ControlUtils.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";

if ($_SERVER["REQUEST_METHOD"]== "POST"){
    
    $utenteManager = new UtenteManager();
    $messRicorso = NULL;
    
    if (isset($_POST['text']) && !empty($_POST['text'])) {
        $messRicorso = $_POST["text"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Messaggio di ricorso vuoto";
        header("Location:" . DOMINIO_SITO . "/banned");
        throw new IllegalArgumentException("messaggio vuoto");
    }

    /*clean from special characters*/
    $messRicorso = testInput($messRicorso);

    //here call utente manager to send claim

    //updating session
    $user->setStato(StatoUtente::RICORSO);
    $utenteManager->updateStatusUtente($user,StatoUtente::RICORSO);
    $_SESSION["user"] = serialize($user);

    $_SESSION['toast-type'] = "success";
    $_SESSION['toast-message'] = "Messaggio inviato";
    header("Location:" . DOMINIO_SITO . "/banned");

}else {
    $_SESSION['toast-type'] = "error";
    $_SESSION['toast-message'] = "Messaggio di ricorso vuoto";
    header("Location:" . DOMINIO_SITO . "/banned");
    throw new IllegalArgumentException("messaggio vuoto");
}
