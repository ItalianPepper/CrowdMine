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
    if (isset($_GET['idMicro'])) {
        $microId = testInput($_GET['idMicro']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id Micro non settata";
        header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
        throw new IllegalArgumentException("ID Micro non settata");
    }
    $userManager = new UtenteManager();
    $userManager->removeMicroCategoria($user->getId(),$microId);
    $_SESSION['toast-type'] = "success";
    $_SESSION['toast-message'] = "Microcategoria rimossa";

}

header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
