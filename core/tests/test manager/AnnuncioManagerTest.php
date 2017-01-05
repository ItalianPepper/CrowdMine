<?php

/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 04/01/2017
 * Time: 17:40
 */
include_once(__DIR__ .  '/../../manager/AnnuncioManager.php');
include_once(__DIR__ .  '/../../manager/Manager.php');
include_once(__DIR__ .  '/../../Config.php');
include_once(__DIR__ .  '/../../filter/SearchByIdFilter.php');
include_once(__DIR__ .  '/../../filter/FilterUtils.php');
include_once(__DIR__ .  '/../../model/Annuncio.php');


class AnnuncioManagerTest extends PHPUnit_Framework_TestCase
{
    protected $annuncioManager;

    public function setUp(){
        $this->annuncioManager = new AnnuncioManager();
    }

    public function testGetAnnuncio(){
        $annuncio = $this->annuncioManager->getAnnuncio(1);
        self::assertEquals("Annuncio1",$annuncio->getTitolo());
    }
}
