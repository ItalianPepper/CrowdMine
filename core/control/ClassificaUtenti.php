<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 02/12/16
 * Time: 11:21
 */

include_once MANAGER_DIR . "MacroCategoriaManager.php";
include_once MANAGER_DIR . "MicroCategoriaManager.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["option"])) {


        if ($_POST["option"] == "selectMacro") {
            $macroCategoriaManager = new MacroCategoriaManager();

            $result = $macroCategoriaManager->findAll();

            header("Content-Type: application/json");
            echo json_encode($result);

        } else if ($_POST["option"] == "selectMicro") {
            $microCategoriaManager = new MicrocategoriaManager();

            $result = $microCategoriaManager->findAll();

            header("Content-Type: application/json");
            echo json_encode($result);
        }

    }else if(isset($_POST["macro"])&&isset($_POST["micro"])){

        $microCategoriaManager = new MicrocategoriaManager();

        $result = $microCategoriaManager->findAll();

        header("Content-Type: application/json");
        echo json_encode($result);

    }else if(isset($_POST["macro"])){

        $macroCategoriaManager = new MacroCategoriaManager();

        $result = $macroCategoriaManager->findAll();

        header("Content-Type: application/json");
        echo json_encode($result);
    }

}