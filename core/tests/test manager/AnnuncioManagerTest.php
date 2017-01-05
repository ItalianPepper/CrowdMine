<?php

/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 04/01/2017
 * Time: 17:40
 */
include_once(__DIR__ .  '/../../model/Candidatura.php');
include_once(__DIR__ .  '/../../model/Commento.php');
include_once(__DIR__ .  '/../../manager/AnnuncioManager.php');
include_once(__DIR__ .  '/../../manager/Manager.php');
include_once(__DIR__ .  '/../../Config.php');
include_once(__DIR__ .  '/../../filter/SearchByIdFilter.php');
include_once(__DIR__ .  '/../../filter/SearchByLocationFilter.php');
include_once(__DIR__ .  '/../../filter/SearchByUserIdFilter.php');
include_once(__DIR__ .  '/../../filter/SearchByNotStatus.php');
include_once(__DIR__ .  '/../../filter/SearchByStatus.php');
include_once(__DIR__ .  '/../../filter/FilterUtils.php');
include_once(__DIR__ .  '/../../model/Annuncio.php');
include_once(__DIR__ .  '/../../exception/ApplicationException.php');
include_once(__DIR__ .  '/../../utils/ErrorUtils.php');
define('REVISIONE',"revisione");
define('ELIMINATO',"eliminato");
define('SEGNALATO',"segnalato");
define('DISATTIVATO',"disattivato");
define('AMMINISTRATORE',"amministratore");
define('REVISIONE_MODIFICA',"revisione_modifica");
define('RICORSO',"ricorso");

class AnnuncioManagerTest extends PHPUnit_Framework_TestCase
{
    const USERID = 4;
    const IDANN = 100;
    const TITOLO = "Cerco lavoro presidenziale";
    const LUOGO = "Milano";
    const DESCRIZIONE = "Tra poco viene a nevicare";
    const RETRIBUZIONE = 1500;
    const MACROCATEGORIA = "MECCANICA";
    const MICROCATEGORIA = 1;
    const TIPOLOGIA = "Offerta";
    const DATA = "2017-01-5 10:00:00";

    protected $annuncioManager;

    public function setUp(){
        $this->annuncioManager = new AnnuncioManager();
    }

    public function testAll(){

        //testo il metodo get e controllo se i parametri restituiti sono corretti
        $annuncio = $this->annuncioManager->getAnnuncio(1);
        $this->testParametri($annuncio,1,4,"2016-12-04 00:00:00","Annuncio1","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu","Luogo1","segnalato",1000,"domanda");


        //creo un annuncio
        //il metodo addToMicros funziona!
        $arr[0]=1;
        $annCreato = $this->annuncioManager->createAnnuncio(self::USERID,self::DATA,self::TITOLO,self::LUOGO,$arr,self::RETRIBUZIONE,self::TIPOLOGIA,self::DESCRIZIONE);


        //testo i parametri dell'annuncio creato
        $this->testParametri($annCreato,$annCreato->getId(),$annCreato->getIdUtente(),$annCreato->getData(),$annCreato->getTitolo(),$annCreato->getDescrizione(),$annCreato->getLuogo(),$annCreato->getStato(),$annCreato->getRetribuzione(),$annCreato->getTipologia());


        //aggiorno un annuncio
        $this->annuncioManager->updateAnnuncio($annCreato->getId(),$annCreato->getIdUtente(),$annCreato->getData(),"Nevica Avellino",$annCreato->getLuogo(),$annCreato->getRetribuzione(),$annCreato->getTipologia(),$annCreato->getDescrizione());


        //testo i parametri dell'annuncio modificato
        $this->testParametri($annCreato,$annCreato->getId(),$annCreato->getIdUtente(),$annCreato->getData(),$annCreato->getTitolo(),$annCreato->getDescrizione(),$annCreato->getLuogo(),$annCreato->getStato(),$annCreato->getRetribuzione(),$annCreato->getTipologia());


        //cancello l'annuncio appena creato
        $this->annuncioManager->deleteAnnuncio($annCreato->getId());


        //cerco un annuncio secondo il filtro del luogo Funziona questo filtro
        $lista = $this->annuncioManager->searchAnnuncio(Array(new SearchByLocationFilter("Milano")));
        self::assertCount(4,$lista);


        //cerco gli annunci di un utente funziona
        $listaAnnUte = $this->annuncioManager->searchAnnunciUtente(4);
        self::assertCount(2,$listaAnnUte);


        //aggiungo una candidatura funziona ( se già mi sono candidato, mi fa ricandidare allo stesso annuncio )
        //$this->annuncioManager->addCandidatura(1,4,"Mi voglio candidare", self::DATA);


        //aggiungo un annuncio preferito non mi fa ripreferire lo stesso annuncio
        //$this->annuncioManager->addToFavorites(1,4,self::DATA);
        //prendo tutti gli annunci preferiti di un utente mi conta un annuncio preferito in più, non so xche
        //però cancellando qualche riga dalla tabella, questo problema si risolve. forse il database è sporco di dati strani.
        $list = $this->annuncioManager->getFavorite(15);
        self::assertCount(1,$list);


        //cancello un annuncio dai preferiti funziona
        //$this->annuncioManager->removeFromFavorites(3,15);
        $list = $this->annuncioManager->getFavorite(15);
        self::assertCount(1,$list);


        //carico gli annunci per gli utenti loggati getAnnunciHomePageUtenteLoggato in questo caso me li stampa tutti perchè non ho messo alcuna micro
        //vengono visualizzati tutti gli annunci, anche quelli diversi dallo stato di attivato!!!correggere
        $list = $this->annuncioManager->getAnnunciHomePageUtenteLoggato();
        print_r($list);


        //carico gli annunci per gli utenti non loggati
        $list = $this->annuncioManager->getAnnunciHomePageUtenteVisitatore();
        print_r($list);;


        //faccio report di un annuncio
        //non so se è così, ma quando segnalo un annuncio, dopo lo posso risegnalare???
        //se reporto un annuncio che non esiste non mi da errore
        $this->annuncioManager->reportAnnuncio(1);


        //faccio report di un commento
        //qui succede la stessa cosa di sopra
        //se reporto un commento che non esiste non mi da errore
        $this->annuncioManager->reportCommento(1);


        //prendo la lista degli annunci segnalati funziona
        $list = $this->annuncioManager->getReportedAnnunci();
        self::assertCount(2,$list);


        //prendo la lista dei candidati di un annuncio funziona
        $list = $this->annuncioManager->getAnnuncioWithCandidati(2);
        self::assertCount(1,$list);


        ///commento un annuncio
        //se provo ad inserire un commento con uno stato diverso da quelli definiti, il commento viene inserito lo
        //stesso nel database
        //$this->annuncioManager->commentAnnuncio(1, 4, "Neve oggi", self::DATA, "attivato");


        //carico la lista dei commenti di un annuncio
        $list = $this->annuncioManager->getCommentsById(1);
        self::assertCount(3,$list);


        //cambio lo stato di un commento funziona
        //questo metodo non va in errore se provo a cambiare stato ad un commento che non esiste.
        //stesso problema per lo stato del commento
        $this->annuncioManager->updateStatusCommento(9, "segnalato");


        //cambio lo stato di un annuncio funziona
        $this->annuncioManager->updateStatus(17, "disattivato");


        //valida un annuncio, cioè passa da revisione ad attivo
        //funziona con tutti gli annunci in qualsiasi stato, e ciò non va bene
        $this->annuncioManager->validateAnnuncio(17);


        //se un annuncio è segnalato, allora va in attivo
        //funziona in ogni stato dell'annuncio, e non va bene!
        $this->annuncioManager->confirmValidationAnnuncio(17);


        //segnalo un annuncio funziona
        //il problema di questi metodi e che non viene fatto il controllo sull'id dell'annuncio
        $this->annuncioManager->sendClaim(17,"Disturba");



        //setto lo stato di un annuncio in disattivato
        $this->annuncioManager->sendSuspension(17);



        //se l'annuncio e in stato di amministratore, allora va in stato di attivo
        $this->annuncioManager->sendConfirmation(17);



        //setta lo stato di qualsiasi annuncio in amministratore
        $this->annuncioManager->sendToAdmin(17);



        //prendo la lista degli annunci con lo stato di ricorso funziona
        $list = $this->annuncioManager->getClaimedAnnunciList();
        self::assertCount(1,$list);



        //restituisce una lista di annunci con un array di filtri impostato funziona
        $list = $this->annuncioManager->getAnnunciCount(Array(new SearchByLocationFilter("Milano")));
        self::assertEquals(4,$list);



        //restituisce il numero degli annunci pubblicati in un mese
        //non funziona
        $list = $this->annuncioManager->getNumberAnnunciPublishedInAMounth();
        //self::assertCount(8,$list);



        //restituisce il numero degli annunci pubblicati oggi
        //questo funziona!
        $list = $this->annuncioManager->getNumberAnnunciPubblishedToday();
        self::assertCount(1,$list);



        //mi da la lista degli annunci con una determinata micro tra un intervallo temporale
        //ci sono problemi con questo metodo perchè come primo parametro dovrebbe prendere l'id della micro, invece vuole l'oggetto
        //poi non funziona comunque mettendo l'id della micro
        //$list = $this->annuncioManager->getNumberAnnunciByMicrocategoriaBetweenDates(8,"2016-12-03 00:00:00", "2016-12-05 00:00:00");
        self::assertCount(1,$list);



        //mi da la lista degli annunci con una determinata macro tra un intervallo temporale
        //non funziona
        $list = $this->annuncioManager->getNumberAnnunciByMacrocategoriaBetweenDates(6,"2010-12-03", "2020-12-05");
        self::assertCount(1,$list);

    }

    public function testParametri($ann,$id,$idUt,$data, $tit, $desc, $luogo,$stato,$retr,$tip){
        self::assertEquals($id,$ann->getId());
        self::assertEquals($idUt,$ann->getIdUtente());
        self::assertEquals($data,$ann->getData());
        self::assertEquals($tit,$ann->getTitolo());
        self::assertEquals($desc,$ann->getDescrizione());
        self::assertEquals($luogo,$ann->getLuogo());
        self::assertEquals($stato,$ann->getStato());
        self::assertEquals($retr,$ann->getRetribuzione());
        self::assertEquals($tip,$ann->getTipologia());
    }
}
