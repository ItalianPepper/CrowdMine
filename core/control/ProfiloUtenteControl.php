<?php
/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 14/12/2016
 * Time: 17:26
 */

include_once MODEL_DIR.'MacroCategoria.php';
include_once MODEL_DIR.'MicroCategoria.php';

include_once VIEW_DIR . "ViewUtils.php";
include_once CONTROL_DIR . "ControlUtils.php";
include_once FILTER_DIR . "SearchByNotStatus.php";
include_once MANAGER_DIR . "AnnuncioManager.php";
include_once MANAGER_DIR . "UtenteManager.php";
include_once MANAGER_DIR  .  'MacroCategoriaManager.php';
include_once MANAGER_DIR  .  'MicroCategoriaManager.php';

include_once CONTROL_DIR . "annuncioBaseControl.php";

$utenteManager = new UtenteManager();
$managerAnnuncio = new AnnuncioManager();
$macroManager = new MacroCategoriaManager();
$microManager = new MicroCategoriaManager();
$utente = $user;

if (isset($_URL) && isset($_URL[1])) {

    $visitedUserId = (int)testInput($_URL[1]);

    $visitedUser = $utenteManager->findUtenteById($visitedUserId);

    if(isset($visitedUser)) {

        $macroListUtente = $macroManager->getUserMacros($visitedUser->getId());
        $microListUtente = $microManager->getUserMicros($visitedUser->getId());

        $filters= Array(
                new SearchByUserIdFilter($visitedUserId),
                new SearchByNotStatus(StatoAnnuncio::ELIMINATO),
                new SearchByNotStatus(StatoAnnuncio::DISATTIVATO),
                new SearchByNotStatus(StatoAnnuncio::AMMINISTRATORE),
                new SearchByNotStatus(StatoAnnuncio::REVISIONE),
                new SearchByNotStatus(StatoAnnuncio::REVISIONE_MODIFICA),
                new SearchByNotStatus(StatoAnnuncio::RICORSO),
        );

        $base = new annuncioBaseControl($managerAnnuncio,$filters,false,true,true);

        $annunci = $base->getAnnunci();
        $listaUtenti = $base->getListaUtenti();
        $listaCommenti = $base->getListaCommenti();
        $listaCandidature = $base->getListaCandidature();
        $listaMicro = $base->getListaMicro();
        $AnnunciMicroRef = $base->getAnnunciMicroRef();

        include_once VIEW_DIR . "visitaProfiloUtente.php";
        exit(0);
    }
}

$_SESSION['toast-type'] = "error";
$_SESSION['toast-message'] = "Utente inesistente o non trovato";
header('Location: ' . DOMINIO_SITO . '/');


?>