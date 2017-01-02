<?php
/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 14/12/2016
 * Time: 17:26
 */

include_once MODEL_DIR . "Candidatura.php";
include_once MODEL_DIR . "Commento.php";
include_once MODEL_DIR . "Utente.php";
include_once MODEL_DIR.'MacroCategoria.php';
include_once MODEL_DIR.'MicroCategoria.php';

include_once VIEW_DIR . "ViewUtils.php";
include_once CONTROL_DIR . "ControlUtils.php";

include_once MANAGER_DIR . "UtenteManager.php";
include_once MANAGER_DIR . "AnnuncioManager.php";
include_once MANAGER_DIR  .  'MacroCategoriaManager.php';
include_once MANAGER_DIR  .  'MicroCategoriaManager.php';

include_once CONTROL_DIR . "annuncioBaseControl.php";


$utenteManager = new UtenteManager();
$managerAnnuncio = new AnnuncioManager();
$macroManager = new MacroCategoriaManager();
$microManager = new MicroCategoriaManager();


$macroListUtente = $macroManager->getUserMacros($user->getId());
$macroList = $macroManager->getAllMacros();

$microListUtente = $microManager->getUserMicros($user->getId());

$blockedUsers = $utenteManager->getBlockedForUser($user->getId());

$filters= Array(new SearchByUserIdFilter($user->getId()), new SearchByNotStatus(REVISIONE), new SearchByNotStatus(ELIMINATO));

$base = new annuncioBaseControl($managerAnnuncio,$filters,true,true,true);

$annunci = $base->getAnnunci();
$listaUtenti = $base->getListaUtenti();
$listaCommenti = $base->getListaCommenti();
$listaCandidature = $base->getListaCandidature();
$listaMicro = $base->getListaMicro();
$AnnunciMicroRef = $base->getAnnunciMicroRef();

include_once VIEW_DIR . "visitaProfiloPersonale.php";

?>