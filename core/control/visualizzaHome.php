<?php

include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once CONTROL_DIR . "ControlUtils.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once FILTER_DIR . 'SearchByDateInterval.php';
include_once MODEL_DIR . "/Commento.php";

$idUtente = null;
$managerAnnunci = new AnnuncioManager();
$filters = array();
$arrayCommenti = array();

if($idUtente == null) {//in futuro sarà di sessione
    $annunci = $managerAnnunci->getAnnunciHomePageUtenteVisitatore();

} else {
    //qui si devono impostare i filtri a seconda delle microcategorie di interesse dell'utente loggato
    array_push($filters,new SearchByNotStatus(ELIMINATO));
    array_push($filters,new SearchByNotStatus(DISATTIVATO));
    array_push($filters,new SearchByNotStatus(REVISIONE));
    $annunci = $managerAnnunci->searchAnnuncio($filters);
}
    for ($i=0; $i<count($annunci); $i++) {
        array_push($arrayCommenti, $managerAnnunci->getCommentsbyId($annunci[$i]->getId()));
    }
    $_SESSION['commenti'] = serialize($arrayCommenti);
    $_SESSION['annunci'] = serialize($annunci);
    include_once VIEW_DIR . "home.php";
    //include_once VIEW_DIR . "annuncioNew.php";

?>

