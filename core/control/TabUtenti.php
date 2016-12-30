<?php
/*include_once MANAGER_DIR ."UtenteManager.php";

$utente = unserialize($_SESSION["user"]); //da rivedere
$permission = $utente->getTipologia();

if ($permission == "admin") {}*/
//mancano i metodo in annuncio manager
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["macrocategorie"])) {

        if ($_POST["macrocategorie"] == "utenti") {

            $macroCategoriaManager = new MacroCategoriaManager();
            $resultMacroUtenti = $macroCategoriaManager->findBestMacrocategoria();

            header("Content-Type:application/json");
            echo json_encode($resultMacroUtenti);

        } else if ($_POST["macrocategorie"] == "annunci") {
            $annuncioManager = new AnnuncioManager();

            $resultMacroAnnunci = stubMacroAnnunci();
            header("Content-Type:application/json");
            echo json_encode($resultMacroAnnunci);
        }

    } else if (isset($_POST["macroCategoriaUtenti"]) && isset($_POST["initpage"])) {

        $macro = $_POST["macroCategoriaUtenti"];
        $microCategoriaManager = new MicrocategoriaManager();
        $resultMicroUtenti = $microCategoriaManager->findBestMicrocategoriaComptente($macro);

        header("Content-Type:application/json");
        echo json_encode($resultMicroUtenti);

    } else if (isset($_POST["macroCategoriaAnnunci"]) && isset($_POST["initpage"])) {
        $macro = $_POST["macroCategoriaAnnunci"];

        $microCategoriaManager = new MicrocategoriaManager();
        $resultMicroAnnunci = $microCategoriaManager->findBestMicrocategoriaRiferito($macro);
        
        header("Content-Type:application/json");
        echo json_encode($resultMicroAnnunci);

    }  else if (isset($_POST["type"]) && isset($_POST["macrocategoria"]) && isset($_POST["pagination"])) {

        if ($_POST["type"] == "Utenti") {

            $numberPage = $_POST["pagination"];
            $macroCategoriaUtenti = $_POST["macrocategoria"];

            $resultUtenti = stubMicroPagingUtenti();
            header("Content-Type:application/json");
            echo json_encode($resultUtenti);

        } else if ($_POST["type"] == "Annunci") {

            $numberPage = $_POST["pagination"];
            $macroCategoriaAnnunci = $_POST["macrocategoria"];


            $resultAnnunci = stubMacroPagingAnnunci();
            header("Content-Type:application/json");
            echo json_encode($resultAnnunci);

        }

    } else if (isset($_POST["pagination"])) {

        if ($_POST["pagination"] == "maxPage") {

            $resultMaxPage = stubMaxPage();
            header("Content-Type:application/json");
            echo json_encode($resultMaxPage);
        }

    }
}

function stubMacroAnnunci()
{
    $arrayTest = array("Informatica", "Ristorazione", "Sanitario", "Servizi", "Turismo", "Matematica");
    return $arrayTest;
}

function stubMacroUtenti()
{
    $arrayTest = array("Bancario", "Servizi", "Informatica", "Farmaceutica", "Chimica", "Turismo");
    return $arrayTest;
}

function stubMicroUtenti()
{
    $arrayTestMicroUtenti = array("PHP", "C", "JAVA", "SQL");
    return $arrayTestMicroUtenti;
}

function stubMicroAnnunci()
{
    $arrayTestUtenti = array("Agricoltura", "Edilizia", "Monachesimo", "Ascetismo");
    return $arrayTestUtenti;
}

function stubMaxPage()
{
    $testMaxPage = 7;
    return $testMaxPage;
}

function stubMicroPagingUtenti()
{
    $arrayUser = array("MicroUtenti", "MicroUtenti", "MicroUtenti", "MicroUtenti", "MicroUtenti", "MicroUtenti");
    return $arrayUser;
}

function stubMacroPagingAnnunci()
{
    $arrayAnnunci = array("MicroAnnunci", "MicroAnnunci", "MicroAnnunci", "MicroAnnunci", "MicroAnnunci", "MicroAnnunci");
    return $arrayAnnunci;
}