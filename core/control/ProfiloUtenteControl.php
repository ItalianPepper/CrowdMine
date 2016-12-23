<?php
/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 14/12/2016
 * Time: 17:26
 */

include_once VIEW_DIR . "ViewUtils.php";
include_once CONTROL_DIR . "ControlUtils.php";
include_once MANAGER_DIR . "UtenteManager.php";


$utenteManager = new UtenteManager();

if (isset($_URL) && isset($_URL[1])) {

    $visitedUserId = (int)testInput($_URL[1]);

    $visitedUser = $utenteManager->findUtenteById($visitedUserId);

    if(isset($visitedUser)) {
        include_once VIEW_DIR . "visitaProfiloUtente.php";
        exit(0);
    }
}

$_SESSION['toast-type'] = "error";
$_SESSION['toast-message'] = "Utente inesistente o non trovato";
header('Location: ' . DOMINIO_SITO . '/');


?>