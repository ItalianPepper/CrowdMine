<?php

include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once CONTROL_DIR . "ControlUtils.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once FILTER_DIR . 'SearchByDateInterval.php';
include_once MODEL_DIR . "/Commento.php";

$idUtente = "1";
$managerAnnunci = new AnnuncioManager();
$filters = array();
$commenti = array();
$arrayCommenti = array();

$utenteObj = new SearchByUserIdFilter($idUtente);

if($idUtente == null) {//in futuro sarà di sessione
    $annunci = $managerAnnunci->getAnnunciHomePageUtenteLoggato();
    echo "x";
} else {
    $dataObj = new OrderByDateFilter(date("Y-m-d"));
    array_push($filters, $dataObj);

try {
    $annunci = $managerAnnunci->searchAnnuncio($filters);
    for ($i=0; $i<count($annunci); $i++) {
        array_push($arrayCommenti, $managerAnnunci->getCommentsbyId($annunci[$i]->getId()));
    }




    $_SESSION['listaCommenti'] = serialize($arrayCommenti);
    $_SESSION['annunciHome'] = serialize($annunci);
    header("Location:" . DOMINIO_SITO . "/home");
} catch (ApplicationException $e) {

}

}

?>

