<?php

/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 03/01/2017
 * Time: 19:51
 */

require_once(_DIR_ .  '/../../model/MicroCategoria.php');

class MicroCategoriaTest extends PHPUnit_Framework_TestCase
{
    protected $micro;
    
    protected function setUp(){
        $this->micro = new MicroCategoria("id", "nome", "idMacro");
    }
    
    public function testGetId(){
        $this->assertEquals("id", $this->micro->getId());
    }

    public function testGetNome(){
        $this->assertEquals("nome", $this->micro->getNome());
    }

    public function testGetIdMacrocategoria(){
        $this->assertEquals("idMacro", $this->micro->getidMacrocategoria());
    }

    public function testSetNome(){
        $this->micro->setNome("nome1");
        $this->assertEquals("nome1", $this->micro->getNome());
    }

    public function testSetIdMacrocategoria(){
        $this->micro->setIdMacrocategoria("idMacro1");
        $this->assertEquals("idMacro1", $this->micro->getIdMacrocategoria());
    }
}