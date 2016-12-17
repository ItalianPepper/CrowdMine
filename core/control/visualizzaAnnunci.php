<?php
include_once MANAGER_DIR ."/AnnuncioManager.php";
include_once MANAGER_DIR . "UtenteManager.php";
include_once MODEL_DIR . "/Candidatura.php";
include_once MODEL_DIR . "/Commento.php";
include_once MODEL_DIR . "/Utente.php";

$managerAnnuncio = new AnnuncioManager();
$managerUtente = new UtenteManager();
$idUtente = 1; // si deve prendere dalla sessione
$listaAnnunci = $managerAnnuncio->searchAnnunciUtente($idUtente);

//carico le candidature per ogni annuncio e li mando alla view
$arrayCandidature = array();
for($i=0;$i<count($listaAnnunci);$i++){
    $ris = $managerAnnuncio->getAnnuncioWithCandidati($listaAnnunci[$i]->getId());
    array_push($arrayCandidature, $ris);
}


//carico i commenti per ogni annuncio e li mando alla view
$arrayCommenti = array();
for ($i=0;$i<count($listaAnnunci);$i++){
    $arr = $managerAnnuncio->getCommentsbyId($listaAnnunci[$i]->getId());
    array_push($arrayCommenti,$arr);
}

//carico la lista degli utenti che si sono candidati agli annunci
$arrayUtentiCandidati = array();
for($i=0;$i<count($arrayCandidature);$i++){
    $utente = array();
    for($j=0;$j<count($arrayCandidature[$i]);$j++) {
        array_push($utente,$managerUtente->findUtenteById($arrayCandidature[$i][$j]->getIdUtente()));
    }
    array_push($arrayUtentiCandidati, $utente);
}



$_SESSION["listaCandidature"] = serialize($arrayCandidature);
$_SESSION["listaUtentiCandidati"] = serialize($arrayUtentiCandidati);
$_SESSION["listaCommenti"] = serialize($arrayCommenti);
$_SESSION["lista"] = serialize($listaAnnunci);
include_once VIEW_DIR. "annuncioProprietario.php";

?>