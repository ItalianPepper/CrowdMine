<?php
/**
 * Created by PhpStorm.
 * User: Rea
 * Date: 09/01/2017
 * Time: 19.37
 */
require_once(__DIR__ .  '/../../model/Notifica.php');
require_once(__DIR__ .  '/../../model/Utente.php');
require_once(__DIR__ .  '/../../model/Candidatura.php');
require_once(__DIR__ .  '/../../manager/Manager.php');
require_once(__DIR__ .  '/../../Config.php');
require_once(__DIR__ .  '/../../manager/MessaggioManager.php');
require_once(__DIR__ .  '/../../manager/NotificaManager.php');
require_once(__DIR__ .  '/../../exception/ConnectionException.php');
require_once(__DIR__ .  '/../../exception/IllegalArgumentException.php');
require_once(__DIR__ .  '/../../exception/IllegalArgumentException.php');
require_once(__DIR__ .  '/../../exception/ApplicationException.php');
require_once(__DIR__ .  '/../../utils/ErrorUtils.php');
require_once(__DIR__ .  '/../../control/control_old/Controller.php');


class NotificaManagerTest extends PHPUnit_Framework_TestCase{

    const tipo = "decisione";
    const info = "ciaociao";
    const letto = true;


    protected $notificaManager;


    public function setUp(){
        $this->notificaManager = new NotificaManager();
    }


    public function testSvuotaNotifica(){
        $SVUOTA = "DELETE FROM `Notifica`";
        Manager::getDB()->query($SVUOTA);
        return true;
    }

    //createNotifica()
    public function testCreateNotifica(){
        $data = date("Y-m-d");
        $id = null;
        $n = $this->notificaManager->createNotifica($data, self::tipo, self::info, self::letto, $id);
        $notifica[] = $n;
        $this->verificaParametriNotifica($notifica, $data, self::tipo, self::letto, self::info, 0);
        return $n;
    }


    //insertNotifica()
    //updateNotifica()
    //getNotificaById()
    public function testNotifica(){
        $data = date("Y-m-d");
        $n = $this->testCreateNotifica();
        //insertNotifica()
        $this->notificaManager->insertNotifica($data, $n->getTipo(), $n->getLetto(), $n->getInfo());
        //print_r($n);
        //$n = $this->getNotifica();
        $notifiche[]= $n;
        $this->verificaParametriNotifica($notifiche, $data, self::tipo, self::letto,  self::info, 0);
        //updateNotifica()
        $n->setLetto(true);
        $this->notificaManager->updateNotifica($n);
        //getNotifica()
        $notifica1 = $this->getNotifica();
        $notifi[] = $notifica1;
        $this->verificaParametriNotifica($notifi, $data, self::tipo, self::letto,  self::info, 0);
    }


 



    public function verificaParametriNotifica($notifica, $data, $tipo, $letto, $info, $index){
        self::assertEquals($data, $notifica[$index]->getData());
        self::assertEquals($tipo, $notifica[$index]->getTipo());
        self::assertEquals($info, $notifica[$index]->getInfo());
        self::assertEquals($letto, $notifica[$index]->getLetto());
    }


    public function getNotifica()
    {
        $QUERY = "SELECT * FROM `Notifica`;";
        $result = Manager::getDB()->query($QUERY);
        if ($result) {
            $obj = $result->fetch_assoc();
            $notifica = new Notifica($obj['date'], $obj['tipo'], $obj['info'], $obj['letto'], $obj['id']);
        }return $notifica;
    }
}