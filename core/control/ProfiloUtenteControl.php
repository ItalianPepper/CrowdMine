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

$visitedUserId = 1;  //default page

$utenteManager = new UtenteManager();

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["user"])) {

        $visitedUserId = (int)testInput($_GET["user"]);

        $user = $utenteManager->findUtenteById($visitedUserId);
        if($user!=null) {
            include_once VIEW_DIR . "visitaProfiloUtente.php";
            exit(0);
        }
    }
}

$_SESSION['toast-type'] = "error";
$_SESSION['toast-message'] = "Utente inesistente o non trovato";
header('Location: ' . DOMINIO_SITO . '/');


?>