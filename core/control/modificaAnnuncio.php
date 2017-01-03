<?php

include_once MODEL_DIR . "/MicroCategoria.php";

include_once MANAGER_DIR . "/MacrocategoriaManager.php";
include_once MANAGER_DIR . "/MicrocategoriaManager.php";
include_once MANAGER_DIR . "/AnnuncioManager.php";
include_once CONTROL_DIR . "/ControlUtils.php";

include_once CONTROL_DIR . "/annuncioBaseControl.php";

$referer = getReferer(DOMINIO_SITO."/ProfiloPersonale#tab3");

if(isset($_GET["id"])){
    $idAnn = testInput($_GET["id"]);

    $managerAnnuncio = new AnnuncioManager();
    $macroManager = new MacroCategoriaManager();

    $filters= Array(new SearchByIdFilter($idAnn));

    $base = new annuncioBaseControl($managerAnnuncio,$filters,false,false,true);

    $macroList = $macroManager->getAllMacros();

    $annunci = $base->getAnnunci();
    $listaMicro = $base->getListaMicro();
    $AnnunciMicroRef = $base->getAnnunciMicroRef();

    if(!isset($annunci[0])) {

        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Annuncio Inesistente";
        header("Location: " . $referer);
        exit();
    }

    $annuncio = $annunci[0];

    if($user->getRuolo()==RuoloUtente::UTENTE && $annuncio->getIdUtente()!=$user->getId()){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Accesso Negato";
        header("Location: " . $referer);
        exit();
    }

    include_once VIEW_DIR . "modificaAnnuncio.php";
    exit();
}

header("Location: " . $referer);
