<?php

/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 03/01/2017
 * Time: 17:53
 */
include_once(__DIR__ .  '/../../model/Annuncio.php');

class AnnuncioTest extends PHPUnit_Framework_TestCase
{
    protected $annuncio;

    public function setUp()
    {
        $this->annuncio = new Annuncio(1,2,date("31/12/2016:15:15:30"),"Cerco programmatore","salve a tutti!","Roma","revisione",1800,"domanda");
    }

    public function testGetIdAnnuncio(){
        self::assertEquals(1,$this->annuncio->getId());
    }

    public function testGetIdUtente(){
        self::assertEquals(2,$this->annuncio->getIdUtente());
    }

    public function testGetDate(){
        $this->assertEquals("31/12/2016:15:15:30",$this->annuncio->getData());
    }

    public function testGetTitle(){
        self::assertEquals("Cerco programmatore",$this->annuncio->getTitolo());
    }

    public function testGetDescription(){
        self::assertEquals("salve a tutti!",$this->annuncio->getDescrizione());
    }

    public function testGetPlace(){
        self::assertEquals("Roma",$this->annuncio->getLuogo());
    }

    public function testGetStatus(){
        self::assertEquals("revisione",$this->annuncio->getStato());
    }

    public function testGetRenumeration(){
        self::assertEquals(1800,$this->annuncio->getRetribuzione());
    }

    public function testGetTipology(){
        self::assertEquals("domanda",$this->annuncio->getTipologia());
    }

    public function testSetDate(){
        $this->annuncio->setData("3/1/2017:18:22:10");
        self::assertEquals("3/1/2017:18:22:10",$this->annuncio->getData());
    }

    public function testSetTitle(){
        $this->annuncio->setTitolo("Offro programmatore");
        self::assertEquals("Offro programmatore",$this->annuncio->getTitolo());
    }

    public function testSetDescription(){
        $this->annuncio->setDescrizione("Lavoro perfetto");
        self::assertEquals("Lavoro perfetto", $this->annuncio->getDescrizione());
    }

    public function testSetPlace(){
        $this->annuncio->setLuogo("Milano");
        self::assertEquals("Milano",$this->annuncio->getLuogo());
    }

    public function testSetStatus(){
        $this->annuncio->setStato("attivo");
        self::assertEquals("attivo",$this->annuncio->getStato());
    }

    public function testSetRenumeration(){
        $this->annuncio->setRetribuzione(1500);
        self::assertEquals(1500,$this->annuncio->getRetribuzione());
    }

    public function testSetTipology(){
        $this->annuncio->setTipologia("offerta");
        self::assertEquals("offerta",$this->annuncio->getTipologia());
    }

}
