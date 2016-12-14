<?php
include_once MANAGER_DIR ."/AnnuncioManager.php";
include_once MANAGER_DIR . "UtenteManager.php";
include_once MODEL_DIR . "/Candidatura.php";
include_once MODEL_DIR . "/Commento.php";

$managerAnnuncio = new AnnuncioManager();
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


$_SESSION["listaCandidature"] = serialize($arrayCandidature);
$_SESSION["listaCommenti"] = serialize($arrayCommenti);
$_SESSION["lista"] = serialize($listaAnnunci);
header("Location:" . DOMINIO_SITO . "/visualizzaAnnunciProprietari");

?>