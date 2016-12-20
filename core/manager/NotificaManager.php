<?php

include_once MODEL_DIR . "Notifica.php";

/**
 * Created by PhpStorm.
 * User: Andrea Sarto
 * Date: 30/11/2016
 * Time: 11.16
 */
class NotificaManager extends Manager
{
    /**
     * NotificaManager constructor.
     */
    public function __construct()
    {

    }

    /**
     * Forword a Notifica object
     *
     * @param Notifica $notifica
     * @param Double $idDestinatario
     */

    public function insertNotifica($id, $data, $tipo, $info, $letto){
        $INSERT_NOTIFICA = "INSERT INTO `Notifica` (`id`, `date`, `tipo`, `letto`, `info`) VALUES ('%s', '%s', '%s', '%s', '%s');";
        $query = sprintf($INSERT_NOTIFICA, $id, $data, $tipo, $info, $letto);
        if (!Manager::getDB()->query($query)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
        }
    }


    /**
     *Send to Dispatcher the list of users to whom refers the notification with id as $idNotifica
     *
     * @param $listaUtenti
     * @param $idNotifica
     * @throws ApplicationException
     */
    public function sendToDispatcher($listaUtenti, $idNotifica){
        $size = count($listaUtenti);
        for($i=0; $i<$size; $i++){
            $idDestinatario = $listaUtenti[$i];
            $INSERT_IN_DISPATCHER = "INSERT INTO `Dispatcher_notifica` (`id_utente`, `id_notifica`) VALUES ('%s', '%s');";
            $query = sprintf($INSERT_IN_DISPATCHER, $idDestinatario, $idNotifica);
            if (!Manager::getDB()->query($query)) {
                if (Manager::getDB()->errno == 1062) {
                    throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
                } else
                    throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
            }
        }
    }
    /**
     *Return a  Notifiche object with 'id' as $idNotifica
     *
     * @param Double $idNotifica
     *
     * @return  A Notifica object
     */
    public function getNotifica($idNotifica){
        $LOAD_NOTIFICHE= "SELECT * FROM `Notifica` WHERE `id` = $idNotifica;";
        $resultNotifica = Manager::getDB()->query($LOAD_NOTIFICHE);
        if ($resultNotifica) {
            while ($obj = $resultNotifica->fetch_assoc()) {
                $notifica = new Notifica($obj['id'], $obj['date'], $obj['tipo'], $obj['letto'], $obj['info']);
            }
        }
        return $notifica;
    }

    /**
     * Return a list of notifications id where 'id_utente' in dispatcher is $idUtente
     *
     * @param $idUtente
     * @return array
     */
    public function loadFromDispatcher($idUtente){
        $LOAD_DISPATCHER = "SELECT * FROM `Dispatcher_notifica` WHERE `id_utente` = $idUtente;";
        $result = Manager::getDB()->query($LOAD_DISPATCHER);
        $listIdNotifica = array();
        if ($result) {
            while ($obj = $result->fetch_assoc()) {
                $IdNotifica = $obj['id_notifica'];
                $listIdNotifica[] = $IdNotifica;
            }
        }
        return $listIdNotifica;
    }

}