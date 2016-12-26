<?php

include_once MODEL_DIR . "Messaggio.php";
include_once MANAGER_DIR . "Manager.php"; 
/**
 * Created by PhpStorm.
 * User: Andrea Sarto
 * Date: 30/11/2016
 * Time: 11.24
 */
class MessaggioManager extends Manager
{

    /**
     * MessaggioManager constructor.
     */
    public function __construct()
    {

    }

    /**
     * Send an object Messaggio
     *
     * @param Double $idMittente
     * @param Double $idDestinatario
     * @param Messaggio $messaggio
     */
    public function sendMessaggio($id, $corpo, $letto, $data, $idMittente, $idDestinatario){
        $INSERT_MESSAGGIO = "INSERT INTO `Messaggio` (`id`, `corpo`, `data`, `letto`, `id_utente_mittente`, `id_utente_destinatario`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s');";
        $query = sprintf($INSERT_MESSAGGIO, $id, $corpo, $letto, $data, $idMittente, $idDestinatario);
        if (!Manager::getDB()->query($query)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
        }
        return true;
    }

    /**
     * Load the message refeer to an Utente
     *
     * @param $idUtente
     */
    public function loadMessaggi($idUtente){
        $LOAD_MESSAGGIO = "SELECT * FROM `Messaggio` WHERE `id_utente_mittente` = $idUtente;";
        $result = Manager::getDB()->query($LOAD_MESSAGGIO);
        $messaggi = array();
        if ($result) {
            while ($obj = $result->fetch_assoc()) {
                $messaggio = new Messaggio($obj['id'], $obj['id_utente_mittente'], $obj['id_utente_destinatario'], $obj['corpo'], $obj['data'], $obj['letto']);
                $messaggi[] = $messaggio;
            }
        }
        return $messaggi;
    }


    /**
     * @param $idUtente
     * @return array
     */
    public function listaDestinatari($idUtente){
        $LOAD_MESSAGGIO = "SELECT DISTINCT u.* FROM utente u, messaggio m WHERE 
                            (m.id_utente_mittente = u.id OR m.id_utente_destinatario = u.id) 
                            AND (m.id_utente_mittente = $idUtente OR m.id_utente_destinatario = $idUtente) 
                            AND u.id <> $idUtente";
        $result = Manager::getDB()->query($LOAD_MESSAGGIO);
        $utenti = array();
        if ($result) {
            while ($obj = $result->fetch_assoc()) {
                $utente = new Utente($obj['id'], $obj['nome'], $obj['cognome'], $obj['telefono'], $obj['dataNascita'],
                    $obj['citta'], $obj['email'], $obj['password'], $obj['ruolo'], $obj['stato'], $obj['immagine_profilo'],
                    $obj['partita_iva']);
                $utenti[] = $utente;
            }
        }
        return $utenti;
    }

    /**
     *Load the conversation created by the twosome of Utente
     *
     * @param $idMittente
     * @param $idDestinatario
     */
    public function loadConversation($idMittente, $idDestinatario){
        $LOAD_MESSAGGIO = "SELECT * FROM `Messaggio` WHERE `id_utente_mittente` = $idMittente AND `id_utente_destinatario` = $idDestinatario
                            OR `id_utente_mittente` = $idDestinatario AND `id_utente_destinatario` = $idMittente ORDER BY 'data' ASC;";
        $result = Manager::getDB()->query($LOAD_MESSAGGIO);
        $messaggi = array();
        if ($result) {
            while ($obj = $result->fetch_assoc()) {
                $messaggio = new Messaggio($obj['id'], $obj['id_utente_mittente'], $obj['id_utente_destinatario'], $obj['corpo'], $obj['data'], $obj['letto']);
                $messaggi[] = $messaggio;
            }
        }
        return $messaggi;
    }


    public function deleteConversation($idMittente, $idDestinatario){
        $LOAD_MESSAGGIO = "DELETE FROM `Messaggio` WHERE `id_utente_mittente` = $idMittente AND `id_utente_destinatario` = $idDestinatario
                            OR `id_utente_mittente` = $idDestinatario AND `id_utente_destinatario` = $idMittente;";
        if (!Manager::getDB()->query($LOAD_MESSAGGIO)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
        }
        return true;
    }

    /**
     * @param $idMittente
     * @param $idDestinatario
     * @return array
     */
    public function messaggiNonLetti($idMittente, $idDestinatario){
        $LOAD_MESSAGGIO = "SELECT * FROM `Messaggio` WHERE `id_utente_mittente` = $idMittente AND `id_utente_destinatario` = $idDestinatario
                            AND letto=0 ORDER BY 'data' ASC;";
        $result = Manager::getDB()->query($LOAD_MESSAGGIO);
        $messaggi = array();
        if ($result) {
            while ($obj = $result->fetch_assoc()) {
                $messaggio = new Messaggio($obj['id'], $obj['id_utente_mittente'], $obj['id_utente_destinatario'], $obj['corpo'], $obj['data'], $obj['letto']);
                $messaggi[] = $messaggio;
            }
        }
        return $messaggi;
    }

    /**
     * @param $idMittente
     * @param $idDestinatario
     * @return array
     */
    public function numberMessaggiNotVisualized($idUtente){
        $LOAD_MESSAGGIO = "SELECT COUNT(DISTINCT id) FROM messaggio  WHERE  id_utente_destinatario = $idUtente AND letto=0;";
        $result = Manager::getDB()->query($LOAD_MESSAGGIO);
        if ($result) {
            $obj = $result->fetch_assoc();
            return $obj['COUNT(DISTINCT id)'];
            }
    }


    /**
     * @param $idMittente
     * @param $idDestinatario
     * @return array
     */
    public function setMessaggiNonLetti($idMittente, $idDestinatario){
        $LOAD_MESSAGGIO = "UPDATE `Messaggio` SET letto = 1 WHERE `id_utente_mittente` = $idMittente 
                            AND `id_utente_destinatario` = $idDestinatario;";
        if (!Manager::getDB()->query($LOAD_MESSAGGIO)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
        }
    }

    /**
     *
     * @param $idMittente
     * @param $idDestinatario
     */
    public function sendRichiestaCollaborazione($id, $idMittente, $idAnnuncio, $corpo, $data_risposta, $data_inviata, $richiesta_inviata, $richiesta_accettata){
        $INSERT_COLLABORAZIONE = "INSERT INTO `candidatura` (`id`, `id_utente`, `id_annuncio`, `corpo`, `data_risposta`, `data_inviata`, `richiesta_inviata`, , `richiesta_accettata`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');";
        $query = sprintf($INSERT_COLLABORAZIONE, $id, $idMittente, $idAnnuncio, $corpo, $data_risposta, $data_inviata, $richiesta_inviata, $richiesta_accettata);
        if (!Manager::getDB()->query($query)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
        }
    }




    /**
     * @param $idAnnuncio
     */
    public function agreeCollaborazione($idAnnuncio){
        $COLLABORAZIONE = "UPDATE `candidatura` SET richiesta_accettata = `accettato` WHERE `id_annuncio` = $idAnnuncio;";
        if (!Manager::getDB()->query($COLLABORAZIONE)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
        }
    }


}