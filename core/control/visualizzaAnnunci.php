<?php
include_once MANAGER_DIR ."/AnnuncioManager.php";
include_once MODEL_DIR . "/Candidatura.php";
include_once MODEL_DIR . "/Commento.php";

$manager = new AnnuncioManager();
$idUtente = 1; // si deve prendere dalla sessione
$lista = $manager->searchAnnunciUtente($idUtente);

//carico le candidature per ogni annuncio e le mando alla view
/*for($i=0;$i<count($lista);$i++){
    $arrayCandidature = array();
    $ris = $manager->getAnnuncioWithCandidati($lista[$i]->getId());
    array_push($arrayCandidature, $ris);
}*/

$arrayCandidature = array();
$arr = array();
$arr1 = array();
array_push($arr,  new Candidatura(5,1,15,"ciao mi voglio candidare","0000-00-00 00:00:00","2016-12-12 00:00:00","inviata","non_valutato"));
array_push($arr1,  new Candidatura(5,1,17,"ciao mammaaa","0000-00-00 00:00:00","2016-12-12 00:00:00","inviata","non_valutato"));
array_push($arrayCandidature, $arr);
array_push($arrayCandidature, $arr1);

//carico i commenti per ogni annuncio e li mando alla view
$arrayCommenti = array();
$arrComm = array();
$arrComm1 = array();
array_push($arrComm,  new Commento(1,15,1,"Sei buono","2016-12-12 00:00:00"));
array_push($arrComm1,  new Commento(2,17,1,"Sei cattivo","2016-12-12 00:00:00"));
array_push($arrayCommenti, $arrComm);
array_push($arrayCommenti, $arrComm1);

$_SESSION["listaCandidature"] = serialize($arrayCandidature);
$_SESSION["listaCommenti"] = serialize($arrayCommenti);
$_SESSION["lista"] = serialize($lista);
header("Location:" . DOMINIO_SITO . "/visualizzaAnnunciProprietari");

?>