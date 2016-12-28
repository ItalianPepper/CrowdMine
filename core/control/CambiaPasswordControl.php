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
include_once CONTROL_DIR . 'ControlUtils.php';
include_once EXCEPTION_DIR . 'IllegalArgumentException.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
     * Checking if the POST variable are septate
     */
    if (isset($_POST['PasswordAttuale'])) {
        $currPass = testInput($_POST['PasswordAttuale']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Password corrente non settata";
        header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
        throw new IllegalArgumentException("Password corrente non settata");
    }
    if (isset($_POST['NuovaPassword'])) {
        $newPass = testInput($_POST['NuovaPassword']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = ErrorUtils::$PASS_CORTA;
        header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
        throw new IllegalArgumentException(ErrorUtils::$PASS_CORTA);
    }

    if (isset($_POST['ConfermaNuovaPassword'])) {
        $confPass = testInput($_POST['ConfermaNuovaPassword']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo Conferma Password non settato";
        header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
        throw new IllegalArgumentException("Campo Conferma Password non settato");
    }

    if (empty($newPass) || !preg_match_all(Patterns::$PASSWORD, $newPass)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Password malformata";
        header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
        throw new IllegalArgumentException(ErrorUtils::$PASS_MALFORMATA);
    }

    if (empty($confPass) || $newPass!=$confPass){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Nuova password non corretta";
        header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
        throw new IllegalArgumentException("Nuova password non corretta");
    }

    $userManager = new UtenteManager();
    $res = $userManager->checkPassword($user->getId(), $currPass);

    if($res===TRUE) {
        $user->setPassword($newPass);
        $userManager->updateUtente($user);
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "L'operazione del cambio della password è stata eseguita con successo";
    }
    else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "La password inserita non è corretta";
    }

    header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");

}



