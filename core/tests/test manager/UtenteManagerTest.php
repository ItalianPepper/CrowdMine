<?php

/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 04/01/2017
 * Time: 17:22
 */

require_once(__DIR__  .  '/../../../index.php');
require_once(__DIR__ .  '/../../manager/UtenteManager.php');
require_once(__DIR__ .  '/../../manager/MicrocategoriaManager.php');
require_once(__DIR__ .  '/../../manager/MacroCategoriaManager.php');
require_once(__DIR__ .  '/../../model/Utente.php');
require_once(__DIR__ .  '/../../model/MicroCategoria.php');


class UtenteManagerTest extends PHPUnit_Framework_TestCase
{
    protected $utenteManager;
    protected $microcategoriaManager;
    protected $macrocategoriaManger;
    protected $connection;

    protected function setUp(){
        $this->utenteManager = new UtenteManager();
        $this->microcategoriaManager = new MicrocategoriaManager();
        $this->macrocategoriaManger = new MacroCategoriaManager();
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
        $users = $this->initialize();

        $admin = new Utente(null, "nome", "cognome", "telefono", "1994-11-11", "citta",
            "email", "password", StatoUtente::AMMINISTRATORE, RuoloUtente::UTENTE);

        $this->utenteManager->register(array_values($users)[0]);
        $this->utenteManager->register(array_values($users)[1]);
        $this->utenteManager->register($admin);

        $found = $this->utenteManager->getAdminStateUtente();

        self::assertEquals(StatoUtente::AMMINISTRATORE, array_values($found)[0]->getStato());
    }

    public function testGetBannedUtente(){
        $users = $this->initialize();

        $banned = new Utente(null, "nome", "cognome", "telefono", "1994-11-11", "citta",
            "email", "password", StatoUtente::BANNATO, RuoloUtente::UTENTE);

        $this->utenteManager->register(array_values($users)[0]);
        $this->utenteManager->register(array_values($users)[1]);
        $this->utenteManager->register($banned);

        $found = $this->utenteManager->getBannedUtente();

        self::assertEquals(StatoUtente::BANNATO, array_values($found)[0]->getStato());
    }

    public function testGetAppealUtente(){
        $users = $this->initialize();

        $banned = new Utente(null, "nome", "cognome", "telefono", "1994-11-11", "citta",
            "emailBanned", "password", StatoUtente::BANNATO, RuoloUtente::UTENTE);
        $ricorso = new Utente(null, "nome", "cognome", "telefono", "1994-11-11", "citta",
            "emailRicorso", "password", StatoUtente::RICORSO, RuoloUtente::UTENTE);

        $this->utenteManager->register(array_values($users)[0]);
        $this->utenteManager->register(array_values($users)[1]);
        $this->utenteManager->register($banned);
        $this->utenteManager->register($ricorso);


        $found = $this->utenteManager->getAppealUtente();

        self::assertEquals(StatoUtente::BANNATO, array_values($found)[0]->getStato());
        self::assertEquals(StatoUtente::RICORSO, array_values($found)[1]->getStato());
    }

    public function testCheckEmail(){
        $users = $this->initialize();

        $this->utenteManager->register(array_values($users)[0]);
        $this->utenteManager->register(array_values($users)[1]);

        self::assertTrue($this->utenteManager->checkEmail("email1"));
        self::assertTrue($this->utenteManager->checkEmail("email2"));
        self::assertFalse($this->utenteManager->checkEmail("email3"));
    }

    public function testCheckPassword(){
        $users = $this->initialize();

        $this->utenteManager->register(array_values($users)[0]);
        $this->utenteManager->register(array_values($users)[1]);

        $found = $this->utenteManager->findAll();

        foreach ($found as $utente){
            self::assertTrue($this->utenteManager->checkPassword($utente->getId(), $utente->getPassword()));
            self::assertFalse($this->utenteManager->checkPassword($utente->getId(), "p"));
        }
    }

    public function testUserMicrocategory(){
        $users = $this->initialize();

        $this->utenteManager->register(array_values($users)[0]);
        $this->utenteManager->register(array_values($users)[1]);

        $idMacro = $this->macrocategoriaManger->addMacrocategoria("nomeMacro");
        $macro = new MacroCategoria($idMacro, "nomeMacro");

        $micro = new MicroCategoria($macro->getId(), "nomeMicro");
        $idMicro = $this->microcategoriaManager->addMicrocategoria($micro);
        $micro = new MicroCategoria($macro->getId(), "nomeMicro", $idMicro);
        $this->utenteManager->addMicroCategoria(array_values($users)[0], $micro);
        $found = $this->utenteManager->getMicrocategoryByUtente(array_values($users)[0]);

        self::assertEquals("nomeMicro", array_values($found)[0]->getNome());

        $this->utenteManager->removeMicroCategoria(array_values($users)[0], $micro);
        $found = $this->utenteManager->getMicrocategoryByUtente(array_values($users)[0]);

        self::assertEmpty($found);
    }

    private function initialize(){
        if(mysqli_query($this->connection, 'delete from competente;'))
            echo "database initialized successfully\n";
        else
            echo "error deleting records\n";

        if(mysqli_query($this->connection, 'delete from bloccato;'))
            echo "database initialized successfully\n";
        else
            echo "error deleting records\n";

        if(mysqli_query($this->connection, 'delete from utente;'))
            echo "database initialized successfully\n";
        else
            echo "error deleting records\n";

        if(mysqli_query($this->connection, 'delete from macrocategoria;'))
            echo "database initialized successfully\n";
        else
            echo "error deleting records\n";

        if(mysqli_query($this->connection, 'delete from microcategoria;'))
            echo "database initialized successfully\n";
        else
            echo "error deleting records\n";

        $user_1 = new Utente(null, "nome1", "cognome1", "telefono1", "1994-11-11", "citta1",
            "email1", "password1", StatoUtente::ATTIVO, RuoloUtente::UTENTE, "descrizione1", "immagine1", "partitaIva1");
        $user_2 = new Utente(null, "nome2", "cognome2", "telefono2", "1994-11-11", "citta2",
            "email2", "password2", StatoUtente::ATTIVO, RuoloUtente::AMMINISTRATORE, "descrizione2", "immagine2", "partitaIva2");

        $users=array();
        array_push($users, $user_1);
        array_push($users, $user_2);
        return $users;
    }
}