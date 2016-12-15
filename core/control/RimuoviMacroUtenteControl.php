<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 14/12/2016
 * Time: 19:02
 */
include_once MANAGER_DIR.'UtenteManager.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    /**
     * Checking if the POST variable are septate
     */
    if (isset($_GET['idMacro'])) {
        $macroId = strip_tags(htmlspecialchars(addslashes($_GET['idMacro'])));
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id Macro non settata";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("ID Macro non settata");
    }

    if (empty($macroId)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "ID macro empty";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("ID macro empty");
    }

    $userManager = new UtenteManager();
   // $userManager->removeMacrocategoria($macroId);

    header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
}