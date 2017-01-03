<?php

/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 03/01/2017
 * Time: 17:08
 */

require_once(_DIR_ .  '/../../model/Utente.php');

class UtenteTest extends PHPUnit_Framework_TestCase
{
    protected $utente;

    protected function setUp(){
        $this->utente = new Utente("id", "nome", "cognome", "111", "11/11/1994", "Napoli",
            "pippo@dominio.com", "pass", "Italia", RuoloUtente::UTENTE, "descrizione", "path_immagine", 123456);
    }

    public function testGetId(){
        $Id = $this->utente->getId();
        $this->assertEquals("id", $Id);
    }

    public function testGetNome(){
        $nome = $this->utente->getNome();
        $this->assertEquals("nome", $nome);
    }

    public function testGetCognome(){
        $cognome = $this->utente->getCognome();
        $this->assertEquals("cognome", $cognome);
    }

    public function testGetTelefono(){
        $telefono = $this->utente->getTelefono();
        $this->assertEquals("111", $telefono);
    }

    public function testGetDataNascita(){
        $data = $this->utente->getDataNascita();
        $this->assertEquals("11/11/1994", $data);
    }

    public function testGetCitta(){
        $citta = $this->utente->getCitta();
        $this->assertEquals("Napoli", $citta);
    }

    public function testGetEmail(){
        $email = $this->utente->getEmail();
        $this->assertEquals("pippo@dominio.com", $email);
    }

    public function testGetPassword(){
        $password = $this->utente->getPassword();
        $this->assertEquals("pass", $password);
    }

    public function testGetStato(){
        $stato = $this->utente->getStato();
        $this->assertEquals("Italia", $stato);
    }

    public function testGetRuolo(){
        $ruolo = $this->utente->getRuolo();
        $this->assertEquals(RuoloUtente::UTENTE, $ruolo);
    }

    public function testGetDescrizione(){
        $descrizione = $this->utente->getDescrizione();
        $this->assertEquals("descrizione", $descrizione);
    }

    public function testGetImmagineProfilo(){
        $immagineProfilo = $this->utente->getImmagineProfilo();
        $this->assertEquals("path_immagine", $immagineProfilo);
    }

    public function testGetPartitaIva(){
        $partitaIva = $this->utente->getPartitaIva();
        $this->assertEquals(123456, $partitaIva);
    }


    public function testSetNome(){
        $this->utente->setNome("nome1");
        $nome = $this->utente->getNome();
        $this->assertEquals("nome1", $nome);
    }

    public function testSetCognome(){
        $this->utente->setCognome("cognome1");
        $cognome = $this->utente->getCognome();
        $this->assertEquals("cognome1", $cognome);
    }

    public function testSetTelefono(){
        $this->utente->setTelefono(222);
        $telefono = $this->utente->getTelefono();
        $this->assertEquals("222", $telefono);
    }

    public function testSetDataNascita(){
        $this->utente->setDataNascita("10/10/1994");
        $data = $this->utente->getDataNascita();
        $this->assertEquals("10/10/1994", $data);
    }

    public function testSetCitta(){
        $this->utente->setCitta("Milano");
        $citta = $this->utente->getCitta();
        $this->assertEquals("Milano", $citta);
    }

    public function testSetEmail(){
        $this->utente->setEmail("pluto@dominio.com");
        $email = $this->utente->getEmail();
        $this->assertEquals("pluto@dominio.com", $email);
    }

    public function testSetPassword(){
        $this->utente->setPassword("password");
        $password = $this->utente->getPassword();
        $this->assertEquals("password", $password);
    }

    public function testSetStato(){
        $this->utente->setStato("Italia1");
        $stato = $this->utente->getStato();
        $this->assertEquals("Italia1", $stato);
    }

    public function testSetRuolo(){
        $this->utente->setRuolo(RuoloUtente::AMMINISTRATORE);
        $ruolo = $this->utente->getRuolo();
        $this->assertEquals(RuoloUtente::AMMINISTRATORE, $ruolo);
    }

    public function testSetDescrizione(){
        $this->utente->setDescrizione("descrizione1");
        $descrizione = $this->utente->getDescrizione();
        $this->assertEquals("descrizione1", $descrizione);
    }

    public function testSetImmagineProfilo(){
        $this->utente->setImmagineProfilo("path_immagine1");
        $immagineProfilo = $this->utente->getImmagineProfilo();
        $this->assertEquals("path_immagine1", $immagineProfilo);
    }

    public function testSetPartitaIva(){
        $this->utente->setPartitaIva(111111);
        $partitaIva = $this->utente->getPartitaIva();
        $this->assertEquals(111111, $partitaIva);
    }

}