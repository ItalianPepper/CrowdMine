<?php

/**
 * Created by PhpStorm.
 * User: Andrea Sarto
 * Date: 12/12/2016
 * Time: 22.42
 */
include_once MANAGER_DIR ."/AnnuncioManager.php";
include_once MANAGER_DIR . "UtenteManager.php";
include_once MODEL_DIR . "/Candidatura.php";
include_once MODEL_DIR . "/Commento.php";

$manager = new AnnuncioManager();
//$lista = $manager->getAnnunciSegnalati();

/**
 * creo annunci come prova da inserire in una lista fittizia
 */

$idUtenteAnnuncio=2;
$data=date("d/m/Y");
$titolo='prova';
$titolo2='prova2';
$luogo='Roma';
$microcat='provola';
$remuneration=3;
$tipo=2;
$desc='ciaociao';
$annuncio1= new Annuncio(1,$idUtenteAnnuncio, $data, $titolo, $luogo, $microcat, $remuneration, $tipo, $desc);
$annuncio2= new Annuncio(1,$idUtenteAnnuncio, $data, $titolo, $luogo, $microcat, $remuneration, $tipo, $desc);

$listaProva= array();
$listaProva[] = $annuncio1;
$listaProva[] = $annuncio2;

$_SESSION["annunciSegnalati"] = serialize($listaProva);

header("Location:" . DOMINIO_SITO . "/visualizzaAnnunciSegnalati");

?>
