<?php
include_once MANAGER_DIR ."UtenteManager.php";
include_once MANAGER_DIR . "MacroCategoriaManager.php";
include_once MANAGER_DIR . "MicrocategoriaManager.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["macrocategorie"])) {

        if ($_POST["macrocategorie"] == "utenti") {

            $macroCategoriaManager = new MacroCategoriaManager();

            $resultMacroUtenti = $macroCategoriaManager->findBestMacrocategoriaCompetente();

            header("Content-Type:application/json");
            echo json_encode($resultMacroUtenti);

        } else if ($_POST["macrocategorie"] == "annunci") {

            $macroCategoriaManager = new MacroCategoriaManager();

            $resultMacroAnnunci = $macroCategoriaManager->findBestMacrocategoriaRiferito();

            header("Content-Type:application/json");
            echo json_encode($resultMacroAnnunci);
        }

    } else if (isset($_POST["macroCategoriaUtenti"]) && isset($_POST["initpage"])) {

        $macro = $_POST["macroCategoriaUtenti"];

        $numPage = $_POST["initpage"];

        $microCategoriaManager = new MicrocategoriaManager();

        $resultMicroUtenti = $microCategoriaManager->findBestMicrocategoriaCompetente($macro,$numPage);

        header("Content-Type:application/json");
        echo json_encode($resultMicroUtenti);

    } else if (isset($_POST["macroCategoriaAnnunci"]) && isset($_POST["initpage"])) {

        $macro = $_POST["macroCategoriaAnnunci"];

        $numPage = $_POST["initpage"];

        $microCategoriaManager = new MicrocategoriaManager();

        $resultMicroAnnunci = $microCategoriaManager->findBestMicrocategoriaRiferito($macro,$numPage);

        header("Content-Type:application/json");
        echo json_encode($resultMicroAnnunci);

    }  else if (isset($_POST["type"]) && isset($_POST["macrocategoria"]) && isset($_POST["pagination"])) {

        if ($_POST["type"] == "Utenti") {

            $numberPage = $_POST["pagination"];

            $macroCategoriaUtenti = $_POST["macrocategoria"];

            $microCategoriaManager = new MicrocategoriaManager();

            $resultMicroUtenti = $microCategoriaManager->findBestMicrocategoriaCompetente($macroCategoriaUtenti,$numberPage);

            header("Content-Type:application/json");
            echo json_encode($resultMicroUtenti);

        } else if ($_POST["type"] == "Annunci") {

            $numberPage = $_POST["pagination"];

            $macroCategoriaAnnunci = $_POST["macrocategoria"];

            $microCategoriaManager = new MicrocategoriaManager();

            $resultMicroAnnunci = $microCategoriaManager->findBestMicrocategoriaRiferito($macroCategoriaAnnunci ,$numberPage);

            header("Content-Type:application/json");
            echo json_encode($resultMicroAnnunci);

        }

    } else if (isset($_POST["type"]) && isset($_POST["macro"]) && isset($_POST["maxPage"])) {

        if ($_POST["maxPage"] == "dimensionPaging") {

            if ($_POST["type"] == "Utenti") {

                $macro = $_POST["macro"];

                $microCategoriaManager = new MicrocategoriaManager();

                $resultMaxPage = $microCategoriaManager->getMaxPageCompetente($macro);

                header("Content-Type:application/json");
                echo json_encode($resultMaxPage);

            }else if($_POST["type"]=="Annunci"){

                $macro = $_POST["macro"];

                $microCategoriaManager = new MicrocategoriaManager();

                $resultMaxPage = $microCategoriaManager->getMaxPageRiferito($macro);

                header("Content-Type:application/json");
                echo json_encode($resultMaxPage);
            }
        }

    }
}