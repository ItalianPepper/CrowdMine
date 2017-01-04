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

$user = unserialize($_SESSION['user']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
     * Checking if the POST variable are septate
     */
    if (isset($_POST['currPass'])) {
        $currPass = strip_tags(htmlspecialchars(addslashes($_POST['currPass'])));
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Password corrente non settata";
        throw new IllegalArgumentException("Password corrente non settata");
    }
    if (isset($_POST['newPass'])) {
        $newPass = strip_tags(htmlspecialchars(addslashes($_POST['newPass'])));
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = ErrorUtils::$PASS_CORTA;
        throw new IllegalArgumentException(ErrorUtils::$PASS_CORTA);
    }

    if (empty($currPass)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Password corrente non inserita";
        throw new IllegalArgumentException("Password corrente malformata");
    }

    if (empty($newPass) || !preg_match(Patterns::$PASSWORD, $newPass)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = ErrorUtils::$PASS_MALFORMATA;
        throw new IllegalArgumentException(ErrorUtils::$PASS_MALFORMATA);
    }

    $userManager = new UtenteManager();
    $res = $userManager->changePassword($currPass, $newPass);

}



