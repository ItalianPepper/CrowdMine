<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 02/12/16
 * Time: 11:21
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["option"])) {

        if ($_POST["option"] == "selectMacro") {
            //$macroCategoriaManager = new AnnuncioManager();

            // $result = $macroCategoriaManager->getListMacroCategorie();

            $result = stubMacroCategorie();

            header("Content-Type: application/json");
            echo json_encode($result);
        }
    }


    if (isset($_POST["option"])) {

        if ($_POST["option"] == "selectMicro") {
            //$macroCategoriaManager = new AnnuncioManager();

            // $result = $macroCategoriaManager->getListMacroCategorie();

            $result = stubMicroCategorie();

            header("Content-Type: application/json");
            echo json_encode($result);
        }

    }

}

function arrayUtenti(){
    $arrayUtentiFunc = array ( array("Nome" => "Giuseppe", "FeedBack" => "84", "MicroCategoria" => "PHP", "MacroCategoria" => "Informatica"),
                            array("Nome" => "Giorgio", "FeedBack" => "48", "MicroCategoria" => "PHP", "MacroCategoria" => "Informatica"),
                            array("Nome" => "Gigi", "FeedBack" => "8", "MicroCategoria" => "JAVA", "MacroCategoria" => "Informatica"),
                        );
    return $arrayUtentiFunc;
}

function stubMacroCategorie()
{
    $arrayTest = array("Informatica", "Ristorazione", "Bancario" );
    return $arrayTest;
}

function stubMicroCategorie()
{
    $microsName = array("PHP", "C", "JAVA", "C++");
    return $microsName;
}