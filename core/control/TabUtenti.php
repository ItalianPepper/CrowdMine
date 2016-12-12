<?php
/** a) Controllo sugli accessi con un oggetto session (da discutere)
 *  b) metodi dei manager (da discutere)
 */
/*include_once MANAGER_DIR ."UtenteManager.php";

$utente = unserialize($_SESSION["user"]); //da rivedere
$permission = $utente->getTipologia();

if ($permission == "admin") {}*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["macrocategorie"])) {

        if ($_POST["macrocategorie"] == "utenti") {

            // $utenteManager = new UtenteManager();
            //$resultMacro = $utenteManager->getTopRatedMacroCategorieUtenti();

            $resultMacroUtenti = stubMacroUtenti();

            header("Content-Type:application/json");
            echo json_encode($resultMacroUtenti);


        }else if($_POST["macrocategorie"] == "annunci"){

            $resultMacroAnnunci = stubMacroAnnunci();
            header("Content-Type:application/json");
            echo json_encode($resultMacroAnnunci);
        }
    } else if (isset($_POST["macroCategoriaUtenti"])) {

        //$utenteManager = new UtenteManager();

        //$resultMicro = array();

        //$resultMicro = $utenteManager->getListTopRatedMicroCategorie($macroCategoriaSelected);
        $resultMicroUtenti = stubMicroUtenti();

        header("Content-Type:application/json");
        echo json_encode($resultMicroUtenti);

    } else if (isset($_POST["macroCategoriaAnnunci"])) {

        $resultMicroAnnunci = stubMicroAnnunci();
        header("Content-Type:application/json");
        echo json_encode($resultMicroAnnunci);
    }
}

function stubMacroAnnunci(){
    $arrayTest = array("Informatica", "Ristorazione", "Sanitario", "Servizi", "Turismo", "Matematica");
    return $arrayTest;
}
function stubMacroUtenti(){
    $arrayTest = array("Bancario", "Servizi", "Informatica", "Farmaceutica", "Chimica", "Turismo");
    return $arrayTest;
}

function stubMicroUtenti(){
    $arrayTestMicroUtenti = array("PHP", "C", "JAVA", "SQL");
    return $arrayTestMicroUtenti;
}

function stubMicroAnnunci(){
    $arrayTestUtenti = array("Agricoltura", "Edilizia", "Monachesimo", "Ascetismo");
    return $arrayTestUtenti;

}