<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 16/12/2016
 * Time: 00:30
 */
include_once MANAGER_DIR.'UtenteManager.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
     * Checking if the POST variable are septate
     */
    if (isset($_POST['getIdMacro'])) {
        $macroId = strip_tags(htmlspecialchars(addslashes($_POST['getIdMacro'])));
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id aggiungi Macro non settata";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("Id aggiungi Macro non settata");
    }

    if (empty($macroId)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id aggiungi macro empty";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("Id aggiungi macro empty");
    }

    $userManager = new UtenteManager();
    // $userManager->addMacro($macroId);

    header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
}