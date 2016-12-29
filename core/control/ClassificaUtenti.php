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

        } else if ($_POST["option"] == "selectMicro") {
            //$macroCategoriaManager = new AnnuncioManager();

            // $result = $macroCategoriaManager->getListMacroCategorie();

            $result = stubMicroCategorie();

            header("Content-Type: application/json");
            echo json_encode($result);
        }

    }else if(isset($_POST["macro"])&&isset($_POST["micro"])){

        $result = stubUtentiMicroCategorie();
        header("Content-Type: application/json");
        echo json_encode($result);

    }else if(isset($_POST["macro"])){

        $result = stubUtentiMacroCategorie();
        header("Content-Type: application/json");
        echo json_encode($result);
    }

}

function arrayUtenti(){
    $arrayUtentiFunc = array("lol");
    return $arrayUtentiFunc;
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

function stubUtentiMicroCategorie(){

}

function stubUtentiMacroCategorie(){


}