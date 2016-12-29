<?php

include_once MODEL_DIR . "Notifica.php";

/**
 * Created by PhpStorm.
 * User: Andrea Sarto
 * Date: 30/11/2016
 * Time: 11.16
 */
class NotificaManager extends Manager implements SplObserver
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

    public function createNotifica($data, $tipo, $info, $letto,$id=null)
    {
        $notifica = new Notifica($data, $tipo, $info, $letto,$id);
        return $notifica;
    }

    public function insertNotifica($data, $tipo, $info, $letto)
    {
        $INSERT_NOTIFICA = "INSERT INTO Notifica ( 'date' , 'tipo', 'info' , 'letto' ) VALUES ('%s', '%s', '%s', '%s')";
        $query = sprintf($INSERT_NOTIFICA, $data, $tipo, $info, $letto);
        if (!Manager::getDB()->query($query)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
        }
        $id = mysqli_insert_id();
        return $id;
    }


    /**
     *Send to Dispatcher the list of users to whom refers the notification with id as $idNotifica
     *
     * @param $listaUtenti
     * @param $idNotifica
     * @throws ApplicationException
     */
    public function sendToDispatcher($listaUtenti, $idNotifica)
    {
        $size = count($listaUtenti);
        for ($i = 0; $i < $size; $i++) {
            $idDestinatario = $listaUtenti[$i];
            $INSERT_IN_DISPATCHER = "INSERT INTO Dispatcher_notifica ('id_utente', 'id_notifica') VALUES ('%s', '%s')";
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
    public function getNotificaById($idUtente)
    {
        $listNotifica = array();
        $LOAD_NOTIFICHE = "SELECT n.* FROM notifica n, dispatcher d, WHERE d.id_utente = $idUtente";
        $resultNotifica = Manager::getDB()->query($LOAD_NOTIFICHE);
        if ($resultNotifica) {
            while ($obj = $resultNotifica->fetch_assoc()) {
                $notifica = new Notifica($obj['id'], $obj['date'], $obj['tipo'], $obj['letto'], $obj['info']);
                $listNotifica[] = $notifica;
            }
        }
        return $listNotifica;
    }

    /**
     * @param $idNotifica
     * @return Notifica
     */
    public function getNotificaNotVisualized($idUtente)
    {
        $listNotifica = array();
        $LOAD_NOTIFICHE = "SELECT n.* FROM notifica n, dispatcher d, WHERE d.id_utente = $idUtente AND n.letto=0 AND d.id_notifica = n.id";
        $resultNotifica = Manager::getDB()->query($LOAD_NOTIFICHE);
        if ($resultNotifica) {
            while ($obj = $resultNotifica->fetch_assoc()) {
                $notifica = new Notifica($obj['id'], $obj['date'], $obj['tipo'], $obj['letto'], $obj['info']);
                $listNotifica[] = $notifica;
            }
        }
        return $listNotifica;
    }

    /**
     * Return a list of notifications id where 'id_utente' in dispatcher is $idUtente
     *
     * @param $idUtente
     * @return array
     */
    public function loadFromDispatcher($idUtente)
    {
        $LOAD_DISPATCHER = "SELECT * FROM Dispatcher_notifica WHERE id_utente= $idUtente;";
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
    /**
     * Receive update from subject
     * @link http://php.net/manual/en/splobserver.update.php
     * @param SplSubject $subject <p>
     * The <b>SplSubject</b> notifying the observer of an update.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function update(SplSubject $subject)
    {
        $wrapperNotifica = $subject->getWrapperNotifica();

        $tipoNotifica = $wrapperNotifica["tipo_notifica"];
        $destinatari = $wrapperNotifica["lista_utenti"];

        if ($tipoNotifica == tipoNotifica::INSERIMENTO) {

            $tipoOggetto = $wrapperNotifica[ElementiInfoNotifica::TIPO_OGGETTO];
            $idOggetto = $wrapperNotifica[ElementiInfoNotifica::ID_OGGETTO];
            $nomeOggetto = $wrapperNotifica[ElementiInfoNotifica::NOME_OGGETTO];
            $data = new DateTime();

            $this->notifyInserimento($tipoNotifica, $idOggetto, $tipoOggetto, $nomeOggetto, $data,$destinatari);

        } else if ($tipoNotifica == tipoNotifica::RISOLUZIONE) {
            $tipoOggetto = $wrapperNotifica[ElementiInfoNotifica::TIPO_OGGETTO];
            $idOggetto = $wrapperNotifica[ElementiInfoNotifica::ID_OGGETTO];
            $nomeOggetto = $wrapperNotifica[ElementiInfoNotifica::NOME_OGGETTO];
            $esito = $wrapperNotifica[ElementiInfoNotifica::ESITO_OGGETTO];
            $data = new DateTime();

            $this->notifyRisoluzione($tipoNotifica, $idOggetto, $tipoOggetto, $nomeOggetto, $esito, $data,$destinatari);

        } else if ($tipoNotifica == tipoNotifica::DECISIONE) {
            $tipoOggetto = $wrapperNotifica[ElementiInfoNotifica::TIPO_OGGETTO];
            $idOggetto = $wrapperNotifica[ElementiInfoNotifica::ID_OGGETTO];
            $nomeOggetto = $wrapperNotifica[ElementiInfoNotifica::NOME_OGGETTO];
            $tipo = $wrapperNotifica[ElementiInfoNotifica::TIPO_PER_DECISIONE];
            $esito = $wrapperNotifica[ElementiInfoNotifica::ESITO_OGGETTO];
            $data = new DateTime();

            $this->notifyDecisione($tipoNotifica, $idOggetto, $tipoOggetto, $nomeOggetto, $tipo, $esito, $data, $destinatari);

        } else if ($tipoNotifica == tipoNotifica::SEGNALAZIONE) {
            $tipoOggetto = $wrapperNotifica[ElementiInfoNotifica::TIPO_OGGETTO];
            $idOggetto = $wrapperNotifica[ElementiInfoNotifica::ID_OGGETTO];
            $nomeOggetto = $wrapperNotifica[ElementiInfoNotifica::NOME_OGGETTO];
            $data = new DateTime();

            $this->notifySegnalazione($tipoNotifica, $idOggetto, $tipoOggetto, $nomeOggetto, $data,$destinatari);
        }

    }
    
    /**
     * This function insert an 'insert-notify' after the observer receive an update from an other manager(subject).
     * @param $tipoNotifica
     * @param $idOggetto
     * @param %tipoOggetto
     * @param $nomeOggetto
     * @param $data
     * @param $destinatari
     */
    public function notifyInserimento($tipoNotifica, $idOggetto,$tipoOggetto,$nomeOggetto,$data,$destinatari){
        $arrayJson = array($idOggetto,$tipoOggetto,$nomeOggetto);
        $info = json_encode($arrayJson);
        $idNotifica = $this->insertNotifica($data,$tipoNotifica,$info,false);
        $this->sendToDispatcher($destinatari, $idNotifica);
    }

    /**
     * This function insert an 'resolution-notify' after the observer receive an update from an other manager(subject).
     * @param $tipoNotifica
     * @param $idOggetto
     * @param $tipoOggetto
     * @param $nomeOggetto
     * @param $esito
     * @param $data
     * @param $destinatari
     */
    public function notifyRisoluzione($tipoNotifica, $idOggetto,$tipoOggetto,$nomeOggetto,$esito,$data,$destinatari){
        $arrayJson = array($idOggetto,$tipoOggetto,$esito,$nomeOggetto);
        $info = json_encode($arrayJson);
        $idNotifica = $this->insertNotifica($data,$tipoNotifica,$info,false);
        $this->sendToDispatcher($destinatari, $idNotifica);
    }

    /**
     * This function insert an 'decision-notify' after the observer receive an update from an other manager(subject).
     * @param $tipoNotifica
     * @param $idOggetto
     * @param $tipoOggetto
     * @param $nomeOggetto
     * @param $tipo
     * @param $esito
     * @param $data
     * @param $destinatari
     */
    public function notifyDecisione($tipoNotifica, $idOggetto,$tipoOggetto,$nomeOggetto,$tipo,$esito,$data,$destinatari){
        $arrayJson = array($idOggetto,$tipoOggetto,$tipo,$esito,$nomeOggetto);
        $info = json_encode($arrayJson);
        $idNotifica = $this->insertNotifica($data,$tipoNotifica,$info,false);
        $this->sendToDispatcher($destinatari, $idNotifica);
    }

    /**
     * This function insert an 'decision-notify' after the observer receive an update from an other manager(subject).
     * @param $tipoNotifica
     * @param $idOggetto
     * @param $tipoOggetto
     * @param $nomeOggetto
     * @param $data
     * @param $destinatari
     */
    public function notifySegnalazione($tipoNotifica, $idOggetto,$tipoOggetto,$nomeOggetto,$data,$destinatari){
        $arrayJson = array($idOggetto,$tipoOggetto,$nomeOggetto);
        $info = json_encode($arrayJson);
        $idNotifica = $this->insertNotifica($data,$tipoNotifica,$info,false);
        $this->sendToDispatcher($destinatari, $idNotifica);
    }

}