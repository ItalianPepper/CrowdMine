<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 02/01/2017
 * Time: 19:44
 */
include_once MANAGER_DIR . "MacroCategoriaManager.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $macroCategoriaManager = new MacroCategoriaManager();
    $macroArray = $macroCategoriaManager->getAllMacrosSerialized();
    echo json_encode($macroArray);
}