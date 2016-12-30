<?php

//include_once MANAGER_DIR . "AnnuncioManager.php";


/*$utente = unserialize($_SESSION["user"]); //da rivedere
$permission = $utente->getTipologia();

if ($permission == "admin") {}*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $macroCategoriaManager = new MacroCategoriaManager();

    $result = $macroCategoriaManager->findListMacrocategoria();

    header("Content-Type: application/json");
    echo json_encode($result);

}