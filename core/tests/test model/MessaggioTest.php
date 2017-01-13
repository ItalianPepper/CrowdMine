<?php
/**
 * Created by PhpStorm.
 * User: Rea
 * Date: 03/01/2017
 * Time: 13.57
 */
require_once(__DIR__ .  '/../../model/Messaggio.php');

class MessaggioTest extends PHPUnit_Framework_TestCase {

    private $id;
    private $idUtenteMittente;
    private $idUtenteDestinatario;
    private $corpo;
    private $data;
    private $letto;


    protected $_messaggio;

    protected function setUp(){
        $this->_messaggio = new Messaggio(1, 2, 3, "ciao", "24/2/2015", false);
    }

    //
    public function testGetId()
    {
        $this->assertEquals(1, $this->_messaggio->getId());
    }


    public function testGetIdUtenteMittente()
    {
        $this->assertEquals(2, $this->_messaggio->getIdUtenteMittente());
    }


    public function testGetIdUtenteDestinatario()
    {
        $this->assertEquals(3, $this->_messaggio->getIdUtenteDestinatario());
    }

    //
    public function testGetCorpo()
    {
        $this->assertEquals("ciao", $this->_messaggio->getCorpo());
    }

    //
    public function testGetData()
    {
        $this->assertEquals("24/2/2015", $this->_messaggio->getData());
    }

    //
    public function testGetLetto()
    {
        $this->assertEquals(false, $this->_messaggio->getLetto());
    }


    //
    public function testSetCorpo()
    {
        $this->_messaggio->setCorpo("alba");
        $this->assertEquals("alba", $this->_messaggio->getCorpo());
    }



    //
    public function testSetData()
    {
        $dataT=date("d/m/y");
        $this->_messaggio->setData($dataT);
        $this->assertEquals($dataT, $this->_messaggio->getData());
    }


    //
    public function testSetLetto()
    {
        $letto = true;
        $this->_messaggio->setLetto(true);
        $this->assertEquals($letto, $this->_messaggio->getLetto());
    }

}