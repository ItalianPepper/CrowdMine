<?php

include_once MANAGER_DIR . "AnnuncioManager.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["option"])) {

        if ($_POST["option"] == "graphics") {

            $adsManager = new AnnuncioManager();

            $adsOfMonth = $adsManager->getNumberAnnunciPublishedInAMounth();

            header("Content-Type : application/json");
            echo json_encode($adsOfMonth);

        } else if ($_POST["option"] == "adsNumber") {

            $adsManager = new AnnuncioManager();

            $adsOfToday = $adsManager->getNumberAnnunciPubblishedToday();

            header("Content-Type : application/json");
            echo json_encode($adsOfToday);
        }
    }
}