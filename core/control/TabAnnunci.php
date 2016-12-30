<?php

/*include_once MANAGER_DIR ."AnnuncioManager.php";
include_once MANAGER_DIR ."MacroCategoriaManager.php";
include_once MANAGER_DIR ."MicroCategoriaManager.php";*/

/*$utente = unserialize($_SESSION["user"]); //da rivedere
$permission = $utente->getRuolo();

if ($permission == Utente::AMMINISTRATORE) {}*/

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["microcategoria"]) && isset($_POST["fromdatemicro"]) && isset($_POST["todatemicro"])) {

            $fromdatemicro = new DateTime($_POST["fromdatemicro"]);
            $todatemicro = new DateTime($_POST["todatemicro"]);

            if ($fromdatemicro < $todatemicro) {

                if ($todatemicro > $now) {
                    $todatemicro = $now;
                }

                if ($fromdatemicro > $now) {
                    $fromdatemicro = $now;
                }
                $micro = $_POST["microcategoria"];

                $annuncioManager = new AnnuncioManager();

                $resultMicro = $annuncioManager->getNumberAnnunciByMicrocategoriaBetweenDates($micro, $fromdatemicro, $todatemicro);

                header("Content-Type : application/json");
                echo json_encode($resultMicro);
            }

        } else if (isset($_POST["macrocategoria"]) && isset($_POST["fromdatemacro"]) && isset($_POST["todatemacro"])) {

            $fromdatemacro = new DateTime($_POST["fromdatemacro"]);
            $todatemacro = new DateTime($_POST["todatemacro"]);

            if ($fromdatemacro < $todatemacro) {
                $now = new DateTime();

                if ($todatemacro > $now) {
                    $atdatemacro = $now;
                }

                if ($fromdatemicro > $now) {
                    $fromdatemicro = $now;
                }

                $macro = $_POST["macrocategoria"];

                $annuncioManager = new AnnuncioManager();
                $resultMacro = $annuncioManager->getNumberAnnunciByMacrocategoriaBetweenDates($macro, $fromdatemacro, $todatemacro);

                header("Content-Type : application/json");
                echo json_encode($resultMacro);
            }

        } else if (isset($_POST["option"])) {

            if ($_POST["option"] == "selectMacro") {

                /*$macroCategoriaManager = new MacroCategoriaManager();
                $listMacroOptions = $macroCategoriaManager->getListMacroCategoria();*/


                header("Content-Type : application/json");
                echo json_encode($listMacroOptions);

            } else if ($_POST["option"] == "selectMicro") {

                $microCategoriaManager = new MicrocategoriaManager();
                $listMicroOptions = $microCategoriaManager->findAll();

                header("Content-Type : application/json");
                echo json_encode($listMicroOptions);
            }
        }
}

function stubMicroCategoria()
{
    $microsName = array("PHP", "C", "JAVA", "C++");
    return $microsName;
}

function stubMacroCategoria()
{
    $macrosName = array("Informatica", "Matematica", "Ristorazione");
    return $macrosName;
}

function stubMacroDate()
{
    $macroValues = array("21/12/2016" => 22, "22/12/2016" => 54, "23/12/2016" => 37);
    return $macroValues;
}

function stubMicroDate()
{
    $microValues = array("21/12/2016" => 10, "22/12/2016" => 27, "23/12/2016" => 45);
    return $microValues;
}