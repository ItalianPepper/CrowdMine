<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentoTest
 *
 * @author Mbre
 */
 include_once(__DIR__ .  '/../../model/Commento.php');
 
class CommentoTest extends PHPUnit_Framework_TestCase {
   

    /**
     * @var \commento
     */
    protected $commento;

    public function setUp() {
        $this->commento = new Commento(1,2,3,"la 13° e la 14° sono incluse nel contratto ?",date("31/12/2016:15:15:30"),"domanda");
    }


    public function testGetId()
    {
        self::assertEquals(1,$this->commento->getId());
    }


    public function testGetIdAnnuncio()
    {
        self::asssertEquals(2, $this->commento->testGetIdAnnuncio());
    }

    /**
     * @return mixed
     */
    public function testGetIdUtente()
    {
        self::asssertEquals(3,$this->commento->getIdUtente());
    }

    /**
     * @return mixed
     */
    public function testGetCorpo()
    {
        self::asssertEquals("la 13° e la 14° sono incluse nel contratto ?",$this->commento->getCorpo());
    }

    /**
     * @return mixed
     */
    public function testGetData()
    {
        self::asssertEquals(date("31/12/2016:15:15:30"),$this->commento->getData());
    }

    /**
     * @param mixed $corpo
     */
    public function testSetCorpo()
    {
        $this->commento->setCorpo("questo lavoro è stupendo!");
        self::asssertEquals("questo lavoro è stupendo!",$this->commento->getCorpo());
    }

    /**
     * @param mixed $data
     */
    public function testSetData()
    {
        $this->commento->setData(date("17/01/2016:15:15:30"));
        self::asssertEquals(date("17/01/2016:15:15:30"),$this->commento->getData());
    }

    /**
     * @return mixed
     */
    public function testGetStato()
    {
       self::asssertEquals("domanda",$this->commento->getStato());
    }

    /**
     * @param mixed $stato
     */
    public function testSetStato()
    {
        $this->commento->setStato("affermazione");
        self::asssertEquals("affermazione",$this->commento->getData());

    }



}
