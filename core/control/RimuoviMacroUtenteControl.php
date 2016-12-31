<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 14/12/2016
 * Time: 19:02
 */
include_once MANAGER_DIR.'UtenteManager.php';
include_once CONTROL_DIR . "ControlUtils.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    /**
     * Checking if the POST variable are septate
     */
    if (isset($_GET['idMacro'])) {
        $macroId = testInput($_GET['idMacro']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id Macro non settata";
        header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
        throw new IllegalArgumentException("ID Macro non settata");
    }
    $userManager = new UtenteManager();
    $userManager->removeMacroCategoria($user->getId(),$macroId);

    $_SESSION['toast-type'] = "success";
    $_SESSION['toast-message'] = "Macrocategoria rimossa";

}

header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");