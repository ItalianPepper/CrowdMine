<?php
/**
 * Created by PhpStorm.
 * User: Rea
 * Date: 03/01/2017
 * Time: 17.48
 */
require_once(__DIR__ . '/../../model/Notifica.php');

class NotificaTest extends PHPUnit_Framework_TestCase {

    private $id;
    private $data;
    private $tipo;
    private $info;
    private $letto;

    protected $_notifica;

    protected function setUp(){
        $this->_notifica = new Notifica(1, "12/10/2017", 'decisione', "carlo conti", 0);
    }

    public function testGetId(){
        $this->assertEquals(1, $this->_notifica->getId());
    }

    public function testGetData(){
        $this->assertEquals("12/10/2017", $this->_notifica->getData());
    }

    public function testGetTipo(){
        $this->assertEquals('decisione', $this->_notifica->getTipo());
    }

    public function testGetInfo(){
        $this->assertEquals("carlo conti", $this->_notifica->getInfo());
    }

    public function testGetLetto(){
        $this->assertEquals(0, $this->_notifica->getLetto());
    }

    public function testSetData(){
        $dataT=date("d/m/y");
        $this->_notifica->setData($dataT);
        $this->assertEquals($dataT, $this->_notifica->getData());
    }

    public function testSetTipo(){
        $tipo = 'risoluzione';
        $this->_notifica->setTipo($tipo);
        $this->assertEquals($tipo, $this->_notifica->getTipo());
    }

    public function testSetInfo(){
        $info = "Pippo Baudo";
        $this->_notifica->setInfo($info);
        $this->assertEquals($info, $this->_notifica->getInfo());
    }

    public function testSetLetto(){
        $letto = 1;
        $this->_notifica->setLetto($letto);
        $this->assertEquals($letto, $this->_notifica->getLetto());
    }

}