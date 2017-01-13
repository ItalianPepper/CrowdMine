<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FeedbackTest
 *
 * @author Mbre
 */

include_once(__DIR__ .  '/../../model/Feedback.php');

class FeedbackTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \Feedback
     */
    protected $feedback;

    public function setUp() {
        $this->feedback = new Feedback(1,2,3,4,"Questo datore di lavoro soffre di attacchi di follia",date("31/12/2016:15:15:30"),"attesa","cattiva","Scarta fruscie e prendi primera");
    }

     public function testGetValutazione()
    {
       self::assertEquals("cattiva",$this->feedback->getValutazione());
    }

    /**
     * @param mixed $valutazione
     */
    public function testSetValutazione()
    {
        $this->feedback->setValutazione("buono");
        self::assertEquals("buono",$this->feedback->getValutazione());
    }

    public function testGetIdValutato()
    {
        self::assertEquals(4,$this->feedback->getIdValutato());
    }

    public function testGetTitolo()
    {
        self::assertEquals("Scarta fruscie e prendi primera",$this->feedback->getTitolo());
    }

    public function testSetTitolo()
    {
        $this->feedback->setTitolo("Otttimo datore di lavoro!");
        self::assertEquals("Otttimo datore di lavoro!",$this->feedback->getTitolo());
    }

}
