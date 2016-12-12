<?php

/** a) Controllo sugli accessi con un oggetto session (da discutere)
 *  b) metodi dei manager (da discutere)
 */
/*
$utente = unserialize($_SESSION["user"]); //da rivedere
$permission = $utente->getTipologia();*/

//if ($permission == "admin") {}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["option"])) {

        if ($_POST["option"] == "graphics") {

            //  $adsManager = new AnnuncioManager();

            $adsOfMonth = getListAnnunciOfMonth();

            header("Content-Type : application/json");
            echo json_encode($adsOfMonth);

        } else if ($_POST["option"] == "adsNumber") {

            //  $adsManager = new AnnuncioManager();

            $adsOfToday = getAnnunciOfToday();

            header("Content-Type : application/json");
            echo json_encode($adsOfToday);
        }
    }
}

function getListAnnunciOfMonth()
{
    $arrayTest = array("09/12/2016" => 10, "10/12/2016" => 62, "20/12/2016"=> 45);
    return $arrayTest;
}

function getAnnunciOfToday()
{
    $testerToday = 220;
    return $testerToday;
}