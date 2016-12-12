<?php
/**
 *  a) Controllo sugli accessi con un oggetto session (da discutere)
 *  b) metodi dei manager (da discutere)
 */
/*include_once MANAGER_DIR ."AnnuncioManager.php";
include_once MANAGER_DIR ."MacroCategoriaManager.php";
include_once MANAGER_DIR ."MicroCategoriaManager.php";*/

/*$utente = unserialize($_SESSION["user"]); //da rivedere
$permission = $utente->getTipologia();

if ($permission == "admin") {}*/

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["fromdatemicro"]) && isset($_POST["atdatemicro"])) {

        //$fromdatemicro = new DateTime($_POST["fromdatemicro"]);
        //$atdatemicro = new DateTime($_POST["atdatemicro"]);

        //$annuncioManager = new AnnuncioManager();
        //$resultMicro = $annuncioManager->getListAnnunci("MICRO_CATEGORIA", $fromdatemicro, $atdatemicro); //da rivedere

        $resultMicro = stubMicroDate();
        header("Content-Type : application/json");
        echo json_encode($resultMicro);

    } else if (isset($_POST["fromdatemacro"]) && isset($_POST["atdatemacro"])) {

        //$fromdatemacro = new DateTime($_POST["fromdatemacro"]);
        //$atdatemacro = new DateTime($_POST["atdatemacro"]);

        //$annuncioManager = new AnnuncioManager();
        //$resultMacro = $annuncioManager->getListAnnunci("MACRO_CATEOGORIA", $fromdatemicro, $atdatemicro);

        $resultMacro = stubMacroDate();
        header("Content-Type : application/json");
        echo json_encode($resultMacro);

    } else if (isset($_POST["option"])) {

        if ($_POST["option"] == "selectMacro") {

            // $macroCategoriaManager = new MacroCategoriaManager();
            //$listMacroOptions = $macroCategoriaManager->getListMacroCategoria();

            $listMacroOptions = stubMacroCategoria();
            header("Content-Type : application/json");
            echo json_encode($listMacroOptions);

        } else if ($_POST["option"] == "selectMicro") {

            //$microCategoriaManager = new MicrocategoriaManager();
            //$listMicroOptions = $microCategoriaManager->getListaMicrocategoria();

            $listMicroOptions = stubMicroCategoria();
            header("Content-Type : application/json");
            echo json_encode($listMicroOptions);
        }
    }
}

function stubMicroCategoria(){
    $microsName = array("PHP", "C", "JAVA", "C++");
    return $microsName;
}

function stubMacroCategoria(){
    $macrosName = array("Informatica", "Matematica", "Ristorazione");
    return $macrosName;
}

function stubMacroDate(){
    $macroValues = array("21/12/2016" => 22, "22/12/2016" => 54, "23/12/2016" => 37);
    return $macroValues;
}

function stubMicroDate(){
    $microValues = array("21/12/2016" => 10, "22/12/2016" =>27, "23/12/2016" =>45);
    return $microValues;
}