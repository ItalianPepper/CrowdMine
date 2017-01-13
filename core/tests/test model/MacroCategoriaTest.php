<?php

/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 03/01/2017
 * Time: 18:29
 */
include_once(__DIR__ .  '/../../model/MacroCategoria.php');

class MacroCategoriaTest extends PHPUnit_Framework_TestCase
{
    protected $macro;

    public function setUp()
    {
        $this->macro = new MacroCategoria(1,"Informatica");
    }

    public function testGetId(){
        self::assertEquals(1,$this->macro->getId());
    }

    public function testGetName(){
        self::assertEquals("Informatica",$this->macro->getNome());
    }

    public function testSetName(){
        $this->macro->setNome("Legge");
        self::assertEquals("Legge",$this->macro->getNome());
    }
}
