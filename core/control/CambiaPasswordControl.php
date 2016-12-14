<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 04/12/2016
 * Time: 17:17
 */

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';
include_once UTILS_DIR . 'ErrorUtils.php';
include_once UTILS_DIR . 'Patterns.php';
include_once EXCEPTION_DIR . "IllegalArgumentException.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
     * Checking if the POST variable are septate
     */
    if (isset($_POST['PasswordAttuale'])) {
        $currPass = strip_tags(htmlspecialchars(addslashes($_POST['PasswordAttuale'])));
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Password corrente non settata";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("Password corrente non settata");
    }
    if (isset($_POST['NuovaPassword'])) {
        $newPass = strip_tags(htmlspecialchars(addslashes($_POST['NuovaPassword'])));
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = ErrorUtils::$PASS_CORTA;
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException(ErrorUtils::$PASS_CORTA);
    }

    if (isset($_POST['ConfermaNuovaPassword'])) {
        $confPass = strip_tags(htmlspecialchars(addslashes($_POST['ConfermaNuovaPassword'])));
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo Conferma Password non settato";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("Campo Conferma Password non settato");
    }

    if (empty($currPass)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Password corrente non inserita";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("Password corrente malformata");
    }

    if (empty($newPass) || !preg_match_all(Patterns::$PASSWORD, $newPass)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Password malformata";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException(ErrorUtils::$PASS_MALFORMATA);
    }

    if (empty($confPass) || $newPass!=$confPass){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Nuova password non corretta";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("Nuova password non corretta");
    }

    header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
    // $userManager = new UtenteManager();
    //$res = $userManager->changePassword($currPass, $newPass);

}



