<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CandidaturaTest
 *
 * @author Mbre
 */

 include_once(__DIR__ .  '/../../model/Candidatura.php');

class CandidaturaTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \candidatura
     */
    protected $candidatura;

    public function setUp() {
        $this->candidatura = new Candidatura(1,2,3,"Sono un tecnico adatto a questo lavoro",date("01/01/2016:15:15:30"),date("31/12/2016:19:15:30"),"inviata","accettata");
    }
    
    public function testGetId()
    {
        self::assertEquals(1,$this->candidatura->getId());
    }

    /**
     * @return mixed
     */
    public function testGetIdUtente()
    {
        self::asssertEquals(2,$this->candidatura->getIdUtente());
    }

    /**
     * @return mixed
     */
    public function testGetIdAnnuncio()
    {
        self::asssertEquals(3, $this->candidatura->testGetIdAnnuncio());
    }

    /**
     * @return mixed
     */
    public function testGetCorpo()
    {
        self::asssertEquals("Sono un tecnico adatto a questo lavoro",$this->candidatura->getCorpo());
    }

    /**
     * @return mixed
     */
    public function testGetDataRisposta()
    {
        self::asssertEquals(date("01/01/2016:15:15:30"),$this->candidatura->getDataRisposta());
    }

    /**
     * @return mixed
     */
    public function getDataInviata()
    {
        self::asssertEquals(date("31/12/2016:19:15:30"),$this->candidatura->getDataInviata());
    }

    /**
     * @return mixed
     */
    public function getRichiestaInviata()
    {
        self::asssertEquals("inviata",$this->candidatura->getDataInviata());
    }

    /**
     * @return mixed
     */
    public function getRichiestaAccettata()
    {
        self::asssertEquals("accettata",$this->candidatura->getRichiestaAccettata());
    }

    /**
     * @param mixed $corpo
     */
    public function setCorpo()
    {
        $this->candidatura->setCorpo("Sono laureato!");
        self::asssertEquals("Sono laureato!",$this->candidatura->getCorpo());
    }

    /**
     * @param mixed $dataRisposta
     */
    public function setDataRisposta()
    {
        $this->candidatura->setData(date("19/01/2016:15:15:30"));
        self::asssertEquals(date("19/01/2016:15:15:30"),$this->candidatura->getDataRisposta());
    }

    /**
     * @param mixed $dataInviata
     */
    public function setDataInviata()
    {
        $this->candidatura->setData(date("28/01/2016:15:15:30"));
        self::asssertEquals(date("28/01/2016:15:15:30"),$this->candidatura->getDataInviata());
    }

    /**
     * @param mixed $richiestaInviata
     */
    public function setRichiestaInviata()
    {
        $this->candidatura->setRichiestaInviata("inviata2");
        self::asssertEquals("inviata2",$this->candidatura->getRichiestaInviata());
    }

    /**
     * @param mixed $richiestaAccettata
     */
    public function setRichiestaAccettata()
    {
        $this->candidatura->setRichiestaAccettata("accettata2");
        self::asssertEquals("accettata2",$this->candidatura->getRichiestaAccettata());
    }
}
