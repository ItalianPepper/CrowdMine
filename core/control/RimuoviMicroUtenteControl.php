<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 16/12/2016
 * Time: 02:24
 */
include_once MANAGER_DIR.'UtenteManager.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    /**
     * Checking if the POST variable are septate
     */
    if (isset($_GET['idMicro'])) {
        $microId = strip_tags(htmlspecialchars(addslashes($_GET['idMicro'])));
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id Micro non settata";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("ID Micro non settata");
    }

    if (empty($microId)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "ID micro empty";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("ID micro empty");
    }

    $userManager = new UtenteManager();
    // $userManager->removeMicrocategoria($microId);

    header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
}