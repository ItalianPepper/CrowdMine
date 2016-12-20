<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 02/12/16
 * Time: 11:21
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["option"])) {

        if ($_POST["option"] == "selectMicro2") {
            $result = stubMicroCategorie2();

            header("Content-Type: application/json");
            echo json_encode($result);
        }

        if ($_POST["option"] == "selectMicro3") {
            $result = stubMicroCategorie3();

            header("Content-Type: application/json");
            echo json_encode($result);
        }

        if ($_POST["option"] == "selectMacro") {
            //$macroCategoriaManager = new AnnuncioManager();

            // $result = $macroCategoriaManager->getListMacroCategorie();

            $result = stubMacroCategorie();

            header("Content-Type: application/json");
            echo json_encode($result);

        } else if ($_POST["option"] == "selectMicro") {
            //$macroCategoriaManager = new AnnuncioManager();

            // $result = $macroCategoriaManager->getListMacroCategorie();

            $result = stubMicroCategorie();

            header("Content-Type: application/json");
            echo json_encode($result);
        }

    } else if (isset($_POST["selectMacro"]) && isset($_POST["selectMicro"])) {
        if ($_POST["selectMicro"] == 0) {
            $result = arrayUtentiMacro();

            header("Content-Type: application/json");
            echo json_encode($result);
        } else {
            $result = arrayUtentiMicro();

            header("Content-Type: application/json");
            echo json_encode($result);

        }
    }

}

function arrayUtentiMacro()
{
    $arrayUtentiMacro = array("Nome" => "Giorgio", "Pasquale", "Giggino");
    return $arrayUtentiMacro;
}

function arrayUtentiMicro()
{
    $arrayUtentiMicro = array("Lorenzo", "Leonardo", "Massimo");
    return $arrayUtentiMicro;
}

function stubMacroCategorie()
{
    $arrayTest = array("Informatica", "Ristorazione", "Bancario");
    return $arrayTest;
}

function stubMicroCategorie()
{
    $microsName = array("PHP", "C", "JAVA", "C++");
    return $microsName;
}

function stubMicroCategorie2()
{
    $microsName = array("Cameriere", "Caposala", "Cuoco");
    return $microsName;
}

function stubMicroCategorie3()
{
    $microsName = array("Direttore", "Dipendente");
    return $microsName;
}