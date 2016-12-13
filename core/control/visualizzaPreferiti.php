<?php
//include_once MANAGER_DIR . "/UtenteManager.php";
include_once MANAGER_DIR . "/AnnuncioManager.php"; //poi questa linea va cancellata. sto facendo lo stub x far funzionare le cose
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 13/12/2016
 * Time: 16:54
 */

//le prossime righe vanno cancellate è solo lo stub
$managerAnnuncio = new AnnuncioManager();
$ann = $managerAnnuncio->getAnnuncio(15);
$listaAnnunciPreferiti = array();
//$utente = unserialize($_SESSION["utente"]);
//$idUtente = $utente->getId();
$idUtente = "1";
//$managerUtente = new UtenteManager();
//$listaAnnunciPreferiti = $managerUtente->getFavorite($idUtente);
array_push($listaAnnunciPreferiti,$ann);
$_SESSION["listaAnnunciPreferiti"] = serialize($listaAnnunciPreferiti);
header("Location: ". DOMINIO_SITO . "/visualizzaAnnunciPreferiti");
