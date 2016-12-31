<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 16/12/2016
 * Time: 00:30
 */
include_once CONTROL_DIR.'ControlUtils.php';
include_once MANAGER_DIR.'UtenteManager.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
     * Checking if the POST variable are septate
     */
    if (isset($_POST['blockUserid'])) {
        $blockUserId = testInput($_POST['blockUserid']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id utente non settato";
        header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
        throw new IllegalArgumentException("Id utente non settato");
    }

    if($blockUserId==$user->getId()){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Non puoi bloccare te stesso";
        header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
        throw new IllegalArgumentException("Non puoi bloccare te stesso");
    }

    $userManager = new UtenteManager();

    $userManager->blockUser($blockUserId,$user->getId());
    $_SESSION['toast-type'] = "success";
    $_SESSION['toast-message'] = "Utente bloccato";

    header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
}