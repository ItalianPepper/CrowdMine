<?php
/**
 * Created by PhpStorm.
 * User: Andrea Sarto
 * Date: 13/12/2016
 * Time: 10.51
 */

include_once MANAGER_DIR ."/AnnuncioManager.php";
include_once MANAGER_DIR . "UtenteManager.php";
include_once MODEL_DIR . "/Candidatura.php";
include_once MODEL_DIR . "/Commento.php";

$manager = new AnnuncioManager();
$idUtente = 1; // si deve prendere dalla sessione
//$lista = $manager->getCommentiSegnalati();

/**
 * creo commenti
 */

$id=3;
$idAnnuncio=5;
$idUtenteAnnuncio=88;
$corpo='questo commento è offensivo';
$data=date("d/m/Y");
$commento = new Commento($id, $idAnnuncio, $idUtenteAnnuncio, $corpo, $data);

$listaProva= array();
$listaProva[] = $commento;

$_SESSION["commentiSegnalati"] = serialize($listaProva);

include_once VIEW_DIR ."visualizzaCommentiSegnalati.php";

?>
