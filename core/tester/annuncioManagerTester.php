<?php
/**
 * Created by PhpStorm.
 * User: Fabri
 * Date: 08/12/2016
 * Time: 16:32
 */

include_once MANAGER_DIR . 'AnnuncioManager.php';

include_once CORE_DIR. '/filter/FilterUtils.php';
include_once CORE_DIR. '/filter/SearchByIdFilter.php';
include_once CORE_DIR. '/filter/SearchByDateInterval.php';
include_once CORE_DIR. '/filter/SearchByStatus.php';
include_once CORE_DIR. '/filter/SearchByTitleFilter.php';
include_once CORE_DIR. '/filter/SearchByUserIdFilter.php';
include_once CORE_DIR . "/filter/SearchByMacroFilter.php";
include_once CORE_DIR. '/filter/OrderByDateFilter.php';

    $m = new AnnuncioManager();

    $dataS = new DateTime();
    $dataE = new DateTime();
    $dataS->setDate(2010,1,12);
    //test insert
    //$annuncio = $m->createAnnuncio(1,$data->format("Y-m-d H:i:s"),"annuncio1","aquara",[1,2],57,TipoAnnuncio::DOMANDA,"domanda di capre");
    //var_dump($annuncio);

    //test update
    //$annuncio = $m->updateAnnuncio(15,1,$data->format("Y-m-d H:i:s"),"annuncio1","aquara",[1,2],57,TipoAnnuncio::DOMANDA,"domanda di mucche");
    //var_dump($annuncio);

    //test update con micro
    //annuncio = $m->updateAnnuncio(15,1,$data->format("Y-m-d H:i:s"),"annuncio1","aquara",[1,3],57,TipoAnnuncio::DOMANDA,"domanda di mucche");
    //var_dump($annuncio);

    //test delete (ABILITARE CASCADE)
    //$m->deleteAnnuncio(15);

    //search test
    var_dump($m->searchAnnuncio(
        Array(
                new SearchByMacroFilter(1),
                new OrderByDateFilter(OrderType::DESC))
    ));

    //search by id
    //var_dump($m->searchAnnunciUtente("3"));

    //search by user
    //var_dump($m->searchAnnunciUtente("1"));

    //add candidatura
    //$m->addCandidatura(2,1,"voglio farmi assumere",$data->format("Y-m-d H:i:s"));

    //addToFavorites
    //$m->addToFavorites(2,1,$data->format("Y-m-d H:i:s"))

    //remove from favorites
    //$m->removeFromFavorites(2,1);

    //get annunci home page
    //var_dump($m->getAnnunciHomePage());

    //report annuncio
    //$m->reportAnnuncio(5);

    //get reported annunci
    //var_dump($m->getReportedAnnunci());

    //get annunci with candidati
    //var_dump($m->getAnnuncioWithCandidati(2));

    //comment annuncio
    //$m->commentAnnuncio(2,1,"commento molto corto",$data->format("Y-m-d H:i:s"));

    // STATUS METHODS
    //update status (tested inside other methods)

    //validate annuncio
    //$m->validateAnnuncio(2);
    //confirm validation
    //$m->confirmValidationAnnuncio(2);

    //send claim
    //$m->sendClaim(2,"reclamo");

    //send suspension
    //$m->sendSuspension(2);

    //send to admin
    //$m->sendToAdmin(2);

    //send confirmation
    //$m->sendConfirmation(2);

    //get claimed annunci list
    //var_dump($m->getClaimedAnnunciList());

    //STATS METHODS

    //getAnnunciCount
    //var_dump($m->getAnnunciCount(null));

    //get best annunci
    //var_dump($m->getAnnunciRanking());

?>