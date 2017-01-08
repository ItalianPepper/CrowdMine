<?php

/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 04/01/2017
 * Time: 17:22
 */

require_once(__DIR__  .  '/../../../index.php');
require_once(__DIR__ .  '/../../manager/UtenteManager.php');
require_once(__DIR__ .  '/../../model/Utente.php');


class UtenteManagerTest extends PHPUnit_Framework_TestCase
{
    protected $utenteManager;
    protected $connection;

    protected function setUp(){
        $this->utenteManager = new UtenteManager();
        $this->connection = UtenteManager::getDB();
    }

    public function test_Register_FindUserOneInput(){
        $users = $this->initialize();

        $this->utenteManager->register(array_values($users)[0]);
        $this->utenteManager->register(array_values($users)[1]);

        $found = $this->utenteManager->findUserOneInput("cognome1");

        $match=false;
        foreach ($found as $utente) {
            if($utente->getCognome()=="cognome1")
                $match=true;
        }

        self::assertTrue($match);
    }

    public function test_Register_FindUserTwoInput(){
        $users = $this->initialize();

        $this->utenteManager->register(array_values($users)[0]);
        $this->utenteManager->register(array_values($users)[1]);

        $found = $this->utenteManager->findUserTwoInput("nome2", "congome2");

        $match=false;
        foreach ($found as $utente) {
            if($utente->getNome() == "nome2" && $utente->getCognome() == "cognome2")
                $match=true;
        }

        self::assertTrue($match);
    }

    public function testUpdateUtente(){
        $users = $this->initialize();

        $this->utenteManager->register(array_values($users)[0]);
        $this->utenteManager->register(array_values($users)[1]);

        $found = $this->utenteManager->findUserOneInput("email1");
        array_values($found)[0]->setCitta("citta11");
        $this->utenteManager->updateUtente(array_values($found)[0]);

        $found = $this->utenteManager->findUserOneInput("email1");

        self::assertEquals("citta11", array_values($found)[0]->getCitta());
    }

    public function test_BlockUser_FindAll(){
        $users = $this->initialize();

        $this->utenteManager->register(array_values($users)[0]);
        $this->utenteManager->register(array_values($users)[1]);

        $found = $this->utenteManager->findAll();
        foreach ($found as $utente){
            if($utente->getEmail() == "email1")
                $user_1 = $utente;
            if($utente->getEmail() == "email2")
                $user_2 = $utente;
        }

        $this->utenteManager->blockUser($user_2->getId(), $user_1->getId());
        $blockedUsers = $this->utenteManager->getBlockedForUser($user_1->getId());

        self::assertEquals("email2", array_values($blockedUsers)[0]->getEmail());

        $this->utenteManager->removeBlockedUser($user_2->getId(), $user_1->getId());

        $blockedUsers = $this->utenteManager->getBlockedForUser($user_1->getId());
        self::assertEmpty($blockedUsers);
    }

    public function testFindUtenteById(){
        $users = $this->initialize();

        $this->utenteManager->register(array_values($users)[0]);
        $this->utenteManager->register(array_values($users)[1]);

        $found = $this->utenteManager->findAll();
        foreach ($found as $utente){
            if($utente->getEmail() == "email1")
                $user_1 = $utente;
            if($utente->getEmail() == "email2")
                $user_2 = $utente;
        }

        $found = $this->utenteManager->findUtenteById($user_2->getId());

        self::assertEquals("email2", $found->getEmail());
    }

    public function testGetReportedUser(){
        $users = $this->initialize();

        $userReported = new Utente(null, "nome", "cognome", "telefono", "1994-11-11", "citta",
            "email", "password", StatoUtente::SEGNALATO, RuoloUtente::UTENTE);

        $this->utenteManager->register(array_values($users)[0]);
        $this->utenteManager->register(array_values($users)[1]);
        $this->utenteManager->register($userReported);

        $found = $this->utenteManager->getReportedUtente();

        self::assertEquals(StatoUtente::SEGNALATO, array_values($found)[0]->getStato());
    }

    public function testGetAdminStateUtente(){
        
    }

    private function initialize(){
        if(mysqli_query($this->connection, 'delete from bloccato;'))
            echo "database initialized successfully\n";
        else
            echo "error deleting records\n";

        if(mysqli_query($this->connection, 'delete from utente;'))
            echo "database initialized successfully\n";
        else
            echo "error deleting records\n";

        $user_1 = new Utente(null, "nome1", "cognome1", "telefono1", "1994-11-11", "citta1",
            "email1", "password1", StatoUtente::ATTIVO, RuoloUtente::UTENTE);
        $user_2 = new Utente(null, "nome2", "cognome2", "telefono2", "1994-11-11", "citta2",
            "email2", "password2", StatoUtente::BANNATO, RuoloUtente::AMMINISTRATORE);

        $users=array();
        array_push($users, $user_1);
        array_push($users, $user_2);
        return $users;
    }
}