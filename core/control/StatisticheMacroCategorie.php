<?php

//include_once MANAGER_DIR . "AnnuncioManager.php";


/*$utente = unserialize($_SESSION["user"]); //da rivedere
$permission = $utente->getTipologia();

if ($permission == "admin") {}*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //$macroCategoriaManager = new AnnuncioManager();

    // $result = $macroCategoriaManager->getListMacroCategorie();

    $result = stubMacroCategorie();

    header("Content-Type: application/json");
    echo json_encode($result);

}

function stubMacroCategorie()
{
    $arrayTest = array("Informatica" => 120, "Ristorazione" => 87, "Bancario" => 113);
    return $arrayTest;
}