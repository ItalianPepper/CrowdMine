<?php

include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once CONTROL_DIR . "ControlUtils.php";
include_once FILTER_DIR . 'SearchByTitleFilter.php';
include_once FILTER_DIR . 'SearchByUserIdFilter.php';
include_once FILTER_DIR . 'SearchByLocationFilter.php';
include_once FILTER_DIR . 'SearchByTypeFilter.php';
include_once FILTER_DIR . 'SearchByDateInterval.php';
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once MODEL_DIR . "/Commento.php";
include_once MODEL_DIR . "/Candidatura.php";
include_once MODEL_DIR . "/Annuncio.php";

echo $_POST['idAnnuncio'];

$managerAnnuncio = new AnnuncioManager();

$listaAnnunci = array();

$listaCommenti = array();

$listaAnnunci = $managerAnnuncio->getAnnunciHomePageUtenteVisitatore();

for ($i = 0; $i<count($listaAnnunci); $i++) {
    $listaCommenti[$i] = $managerAnnuncio->getCommentsbyId($listaAnnunci[$i]->getId());
}

$_SESSION['annunci'] = serialize($listaAnnunci);
$_SESSION['commenti'] = serialize($listaCommenti);







?>