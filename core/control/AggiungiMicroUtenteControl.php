<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 18/12/2016
 * Time: 23:44
 */
include_once MANAGER_DIR.'UtenteManager.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userManager = new UtenteManager();
    /**
     * Checking if the POST variable are septate
     */
    if (isset($_POST['idMicro']) && !isset($_POST['newMicro'])) {
        $microId = strip_tags(htmlspecialchars(addslashes($_POST['idMicro'])));
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id aggiungi Micro non settata";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("Id aggiungi Micro non settata");
    }

    if (empty($microId)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id aggiungi micro empty";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("Id aggiungi micro empty");
    }


    // $userManager->addMicro($microId);

    header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
}