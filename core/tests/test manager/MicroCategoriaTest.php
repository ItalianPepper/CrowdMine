<?php

/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 08/01/2017
 * Time: 16:12
 */
include_once(__DIR__ .  '/../../manager/Manager.php');
include_once(__DIR__ .  '/../../manager/MicrocategoriaManager.php');
include_once(__DIR__ .  '/../../model/MicroCategoria.php');
include_once(__DIR__ .  '/../../Config.php');




class MicroCategoriaTestTest extends PHPUnit_Framework_TestCase
{

    protected $microManager;

    public function setUp()
    {
        $this->microManager = new MicrocategoriaManager();
    }

    public function testAll(){

        //inserimento di una nuova micro
        //non funziona il controllo se inserisco un id macro che non esiste, non mi ritorna alcun errore
        $micro = new MicroCategoria(6,"Lavoratore");
        //$this->microManager->addMicrocategoria($micro);


        //cancello una microcategoria esistente
        //non ci sono controlli se i parametri passati al metodo sono corretti o meno
        //$this->microManager->deleteMicrocategoria($micro);


        //modifico una microcategoria
        //il metodo non funziona. E' sbagliato il metodo del manager
        //$micro = new MicroCategoria(6,"Marte",13);
        //$this->microManager->editMicrocategoria($micro);


        //controllo se esiste una micro con un determinato nome
        //non funziona. ecco l'errore : Trying to get property of non-object
        //$this->microManager->checkMicrocategoria("Informatica");


        //conta il numero di micro totale che hanno il nome diverso dalle macrocategorie
        self::assertEquals(5,$this->microManager->getMicroCount());


        //ritorna la lista delle microcategoria associate ad un utente
        //non funziona
        //self::assertCount(3,$this->microManager->getUserMicros(4));


        //ritorna la lista delle micro associate ad una macro
        //funziona
        self::assertCount(4,$this->microManager->getMicrosByMacro(6));


        //ritorna la micro dato l'id
        //funziona
        print_r($this->microManager->findMicrocategoriaById(10));


        //ritorna la micro dato il nome
        //non funziona
        //print_r($this->microManager->findMicrocategoriaByNome("Informatica"));


        //ritorna la lista completa delle microcategorie
        //non funziona
        //self::assertEquals(8,$this->microManager->findAll());

    }
}
