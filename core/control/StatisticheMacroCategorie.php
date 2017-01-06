<?php

include_once MANAGER_DIR . "MacroCategoriaManager.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $macroCategoriaManager = new MacroCategoriaManager();

    $result = $macroCategoriaManager->findBestMacrocategoriaRiferitoGraphics();

    header("Content-Type: application/json");
    echo json_encode($result);

}