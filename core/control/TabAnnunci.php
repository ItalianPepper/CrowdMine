<?php

include_once MANAGER_DIR . "AnnuncioManager.php";
include_once MANAGER_DIR . "MacroCategoriaManager.php";
include_once MANAGER_DIR . "MicrocategoriaManager.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["microcategoria"]) && isset($_POST["fromdatemicro"]) && isset($_POST["todatemicro"])) {

            $fromdatemicro = new DateTime($_POST["fromdatemicro"]);
            $todatemicro = new DateTime($_POST["todatemicro"]);

            if ($fromdatemicro < $todatemicro) {
                $now = new DateTime();

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
                    $todatemacro = $now;
                }

                if ($fromdatemacro > $now) {
                    $fromdatemacro = $now;
                }

                $macro = $_POST["macrocategoria"];

                $annuncioManager = new AnnuncioManager();
                $resultMacro = $annuncioManager->getNumberAnnunciByMacrocategoriaBetweenDates($macro, $fromdatemacro, $todatemacro);

                header("Content-Type : application/json");
                echo json_encode($resultMacro);
            }

        } else if (isset($_POST["option"])) {

            if ($_POST["option"] == "selectMacro") {

                $macroCategoriaManager = new MacroCategoriaManager();
                $listMacroOptions = $macroCategoriaManager->getListaMacrocategorie();


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