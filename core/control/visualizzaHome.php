<?php

include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once CONTROL_DIR . "ControlUtils.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";

$idUtente = "1";
$managerAnnunci = new AnnuncioManager();
$filters = array();
$utenteObj = new SearchByUserIdFilter($idUtente);
array_push($filters, $utenteObj);

if($idUtente == null) {//in futuro sarà di sessione
    $annunci = $managerAnnunci->getAnnunciHomePageUtenteLoggato();
    echo "x";
} else {
    $annunci = $managerAnnunci->getAnnunciHomePageUtenteVisitatore($filters);

}

?>

