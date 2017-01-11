<?php
/**
 * Created by PhpStorm.
 * User: Rea
 * Date: 05/01/2017
 * Time: 17.11
 */


require_once(__DIR__ .  '/../../model/Messaggio.php');
require_once(__DIR__ .  '/../../model/Utente.php');
require_once(__DIR__ .  '/../../model/Candidatura.php');
require_once(__DIR__ .  '/../../manager/Manager.php');
require_once(__DIR__ .  '/../../Config.php');
require_once(__DIR__ .  '/../../manager/MessaggioManager.php');
require_once(__DIR__ .  '/../../exception/ConnectionException.php');
require_once(__DIR__ .  '/../../exception/IllegalArgumentException.php');
require_once(__DIR__ .  '/../../exception/IllegalArgumentException.php');
require_once(__DIR__ .  '/../../exception/ApplicationException.php');
require_once(__DIR__ .  '/../../utils/ErrorUtils.php');
require_once(__DIR__ .  '/../../control/control_old/Controller.php');


class MessaggioManagerTest extends PHPUnit_Framework_TestCase{

    const id = 1;
    const idUtenteMittente = 4;
    const idUtenteDestinatario = 5;
    const corpo = "ciao ciao";
    const letto = 0;

    protected $messaggioManager;

    public function setUp(){
        $this->messaggioManager = new MessaggioManager();
    }


    public function testSvuotaMessaggio(){
        $SVUOTA = "DELETE FROM `Messaggio`";
        Manager::getDB()->query($SVUOTA);
        return true;
    }

    public function testSvuotaCandidatura(){
        $SVUOTA = "DELETE FROM `Candidatura`";
        Manager::getDB()->query($SVUOTA);
        return true;
    }


    //test di sendMessaggio() e loadMessaggi()
    public function testSendMessaggio(){
        //sendMessaggio()
        $this->messaggioManager->sendMessaggio(self::id, self::corpo, 0, self::letto, self::idUtenteMittente, self::idUtenteDestinatario);
        //loadMessaggi()
        $this->verificaParametriMessaggio($this->messaggioManager->loadMessaggi(self::idUtenteMittente), self::idUtenteMittente,
                                            self::idUtenteDestinatario, self::corpo, self::letto, 0);
    }


    //listaDestinatari()
    public function testListaDestinatari(){
        $this->verificaParametriUtente( $this->messaggioManager->listaDestinatari(self::idUtenteMittente), 5, "utente2", "utente2", 0);
    }


    //loadConversation() e deleteConversation()
    public function testLoadConversation(){
        //loadConversation()
        $this->messaggioManager->sendMessaggio(self::id, self::corpo, 0, self::letto, self::idUtenteDestinatario, self::idUtenteMittente);
        $this->verificaParametriMessaggio($this->messaggioManager->loadConversation(self::idUtenteMittente, self::idUtenteDestinatario),
                                            self::idUtenteMittente,  self::idUtenteDestinatario, self::corpo, self::letto, 0);
        $this->verificaParametriMessaggio($this->messaggioManager->loadConversation(self::idUtenteMittente, self::idUtenteDestinatario),
                                              self::idUtenteDestinatario, self::idUtenteMittente, self::corpo, self::letto, 1);
        //deleteConversation()
        $this->messaggioManager->deleteConversation(self::idUtenteDestinatario, self::idUtenteMittente);
    }


    //messaggiNonLetti()
    public function testMessaggiNonLetti(){
        $this->messaggioManager->sendMessaggio(self::id, self::corpo, 0, self::letto, self::idUtenteMittente, self::idUtenteDestinatario);
        $this->verificaParametriMessaggio($this->messaggioManager->messaggiNonLetti(self::idUtenteMittente, self::idUtenteDestinatario),
                                            self::idUtenteMittente, self::idUtenteDestinatario, self::corpo, self::letto, 0);
    }


    //numberMessaggiNotVisualized()
    //setMessaggiNonLetti()
    public function testNumberMessaggiNotVisualized(){
        //numberMessaggiNotVisualized() expected 1
        $this->assertEquals(1, $this->messaggioManager->numberMessaggiNotVisualized(self::idUtenteDestinatario));
        //setMessaggiNonLetti()
        $this->messaggioManager->setMessaggiNonLetti(self::idUtenteMittente, self::idUtenteDestinatario);
        //numberMessaggiNotVisualized() expected 0
        $this->assertEquals(0, $this->messaggioManager->numberMessaggiNotVisualized(self::idUtenteDestinatario));
    }

    //parametri candidatura
    const richiestaInviata = 'inviata';
    const richiesta_accettata = 'non_valutato';
    const dataRisposta = 0;
    const dataInviata = 0;

    //createCandidatura()
    public function testCreateCandidatura(){
        $data = date("Y-m-d H:i:s");
        $idAnnuncio = $this->getAnnuncio();
        $this->messaggioManager->createCandidatura(self::id, self::idUtenteMittente, $idAnnuncio, self::corpo, self::dataRisposta, self::dataInviata,
                                                    self::richiesta_accettata, self::richiestaInviata);
        $dataCandidatura = $this->getDataInviataCandidatura();
        $data2 = date("Y-m-d H:i:s");
        if($dataCandidatura >=$data && $dataCandidatura <=$data2){
            $flag=1;
            $this->assertEquals(1, $flag);
        }else{
            $flag=0;
            $this->assertEquals(1, $flag);
        }
    }

    //setInviaCollaborazione() e getCandidatura()
    public function testSetInviaCollaborazione(){
        //setInviaCollaborazione()
        $this->messaggioManager->setInviaCollaborazione($this->getIdCandidatura());
        //getCandidatura()
        $idAnnuncio = $this->getAnnuncio();
        $candidature[]=$this->messaggioManager->getCandidatura($this->getIdCandidatura());
        $this->verificaParametriCandidatura($candidature, self::idUtenteMittente,
                                              $idAnnuncio, self::corpo, self::dataRisposta, self::dataInviata,
                                                self::richiestaInviata, self::richiesta_accettata, 0);
    }


    const richiestaInviata2 = 'non_inviata';
    const richiesta_accettata2 = 'non_valutato';
    //setRifiutaCandidato()
    public function testSetRifiutaCandidato(){
        $this->messaggioManager->setRifiutaCandidato($this->getIdCandidatura());
        $idAnnuncio = $this->getAnnuncio();
        $candidature[]=$this->messaggioManager->getCandidatura($this->getIdCandidatura());
        $this->verificaParametriCandidatura($candidature, self::idUtenteMittente,
            $idAnnuncio, self::corpo, self::dataRisposta, self::dataInviata,
            self::richiestaInviata2, self::richiesta_accettata2, 0);
    }



    const richiestaInviata3 = 'inviata';
    const richiesta_accettata3 = 'accettato';
    //setRifiutaCandidato()
    public function testSetAccettaCollaborazione(){
        $this->messaggioManager->setAccettaCollaborazione($this->getIdCandidatura());
        $idAnnuncio = $this->getAnnuncio();
        $candidature[]=$this->messaggioManager->getCandidatura($this->getIdCandidatura());
        $this->verificaParametriCandidatura($candidature, self::idUtenteMittente,
            $idAnnuncio, self::corpo, self::dataRisposta, self::dataInviata,
            self::richiestaInviata3, self::richiesta_accettata3, 0);
    }



    const richiestaInviata4 = 'inviata';
    const richiesta_accettata4 = 'rifiutato';
    //setRifiutaCandidato()
    public function testSetRifiutaCollaborazione(){
        $this->messaggioManager->setRifiutaCollaborazione($this->getIdCandidatura());
        $idAnnuncio = $this->getAnnuncio();
        $candidature[]=$this->messaggioManager->getCandidatura($this->getIdCandidatura());
        $this->verificaParametriCandidatura($candidature, self::idUtenteMittente,
            $idAnnuncio, self::corpo, self::dataRisposta, self::dataInviata,
            self::richiestaInviata4, self::richiesta_accettata4, 0);
    }


    //isCandidato()
    public function testIsCandidato(){
        $idAnnuncio = $this->getAnnuncio();
        $candidature=$this->messaggioManager->isCandidato(4,4);
        $this->verificaParametriCandidatura($candidature, self::idUtenteMittente, $idAnnuncio, self::corpo, self::dataRisposta,
                                                self::dataInviata, self::richiestaInviata4, self::richiesta_accettata4, 0);
    }





    //isInviaCollaborazione()
    public function testIsInviaCollaborazione(){
        $this->messaggioManager->setInviaCollaborazione($this->getIdCandidatura());
        $flag= $this->messaggioManager->isInviaCollaborazione($this->getIdCandidatura());
        $this->assertEquals(true, $flag);
    }



    //isAccettaCollaborazione()
    public function testIsAccettaCollaborazione(){
        $this->messaggioManager->setAccettaCollaborazione($this->getIdCandidatura());
        $flag= $this->messaggioManager->isInviaCollaborazione($this->getIdCandidatura());
        $this->assertEquals(true, $flag);
    }


    //isRifiutaCollaborazione()
    public function testIsRifiutaCollaborazione(){
        $this->messaggioManager->setRifiutaCollaborazione($this->getIdCandidatura());
        $flag= $this->messaggioManager->isRifiutaCollaborazione($this->getIdCandidatura());
        $this->assertEquals(true, $flag);
    }


    //isRifiutaCandidato()
    public function testIsRifiutaCandidato(){
        $this->messaggioManager->setRifiutaCandidato($this->getIdCandidatura());
        $flag= $this->messaggioManager->isRifiutaCandidato($this->getIdCandidatura());
        $this->assertEquals(true, $flag);
    }





    public function verificaParametriCandidatura($candidatura, $idUtente, $idAnnuncio, $corpo, $dataRisposta, $dataInviata,
                                                 $richiestaInviata, $richiestaAccettata, $index){
        self::assertEquals($idUtente, $candidatura[$index]->getIdUtente());
        self::assertEquals($idAnnuncio, $candidatura[$index]->getIdAnnuncio());
        self::assertEquals($corpo, $candidatura[$index]->getCorpo());
//      self::assertEquals($dataRisposta, $candidatura[$index]->getDataRisposta());
//      self::assertEquals($dataInviata, $candidatura[$index]->getDataInviata());
        self::assertEquals($richiestaInviata, $candidatura[$index]->getRichiestaInviata());
        self::assertEquals($richiestaAccettata, $candidatura[$index]->getRichiestaAccettata());
    }

    public function verificaParametriMessaggio($messaggio, $idUtenteMittente, $idUtenteDestinatario, $corpo, $letto, $index){
        self::assertEquals($idUtenteMittente, $messaggio[$index]->getIdUtenteMittente());
        self::assertEquals($idUtenteDestinatario, $messaggio[$index]->getIdUtenteDestinatario());
        self::assertEquals($corpo, $messaggio[$index]->getCorpo());
        self::assertEquals($letto, $messaggio[$index]->getLetto());
    }

    public function verificaParametriUtente($utente, $idUtente, $nome, $cognome, $index){
        self::assertEquals($idUtente, $utente[$index]->getId());
        self::assertEquals($nome, $utente[$index]->getNome());
        self::assertEquals($cognome, $utente[$index]->getCognome());
    }


    public function getAnnuncio(){
        $QUERY = "SELECT * FROM `Annuncio`;";
        $result = Manager::getDB()->query($QUERY);
        if ($result) {
            $obj = $result->fetch_assoc();
            return $idAnnuncio = $obj['id'];
        }
    }

    public function getDataInviataCandidatura(){
        $QUERY = "SELECT * FROM `candidatura`;";
        $result = Manager::getDB()->query($QUERY);
        if ($result) {
            $obj = $result->fetch_assoc();
            return $dataInviata = $obj['data_inviata'];
        }
    }

    public function getIdCandidatura(){
        $QUERY = "SELECT * FROM `candidatura`;";
        $result = Manager::getDB()->query($QUERY);
        if ($result) {
            $obj = $result->fetch_assoc();
            return $dataInviata = $obj['id'];
        }
    }
}