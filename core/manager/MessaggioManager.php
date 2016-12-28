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
     * @param $id_candidatura
     * @return bool
     * @throws ApplicationException
     */
    public function setInviaCandidatura($id_candidatura){
        $SET_CANDIDATURA = "UPDATE `Candidatura` SET richiesta_inviata = 'inviata' WHERE `id` = $id_candidatura ;";
        if (!Manager::getDB()->query($SET_CANDIDATURA)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
        }
        return true;
    }


    /**
     * @param $id_candidatura
     * @return bool
     * @throws ApplicationException
     */
    public function setRifiutaCollaborazione($id_candidatura){
        $SET_CANDIDATURA = "UPDATE `Candidatura` SET richiesta_inviata = 'rifiutato' WHERE `id` = $id_candidatura ;";
        if (!Manager::getDB()->query($SET_CANDIDATURA)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
        }
        return true;
    }


    /**
     * @param $id_candidatura
     * @return bool
     * @throws ApplicationException
     */

    public function isInviaCollaborazione($id_candidatura){
        $SET_CANDIDATURA = "SELECT COUNT(DISTINCT id) FROM candidatura  WHERE id = $id_candidatura AND richiesta_inviata = 'inviata';";
        $result = Manager::getDB()->query($SET_CANDIDATURA);
        if ($result) {
            $obj = $result->fetch_assoc();
            if ($obj['COUNT(DISTINCT id)'] > 0){
                return true;
             }else
                return false;
        }
    }

    /**
     * @param $id_candidatura
     * @return bool
     */
    public function isAccettaCollaborazione($id_candidatura){
        $SET_CANDIDATURA = "SELECT COUNT(DISTINCT id) FROM candidatura  WHERE id = $id_candidatura AND richiesta_accettata = 'accettato';";
        $result = Manager::getDB()->query($SET_CANDIDATURA);
        if ($result) {
            $obj = $result->fetch_assoc();
            if ($obj['COUNT(DISTINCT id)'] > 0){
                return true;
            }else
                return false;
        }
    }

    /**
     * @param $id_candidatura
     * @return bool
     */
    public function isRifiutaCollaborazione($id_candidatura){
        $SET_CANDIDATURA = "SELECT COUNT(DISTINCT id) FROM candidatura  WHERE id = $id_candidatura AND richiesta_accettata = 'rifiutato';";
        $result = Manager::getDB()->query($SET_CANDIDATURA);
        if ($result) {
            $obj = $result->fetch_assoc();
            if ($obj['COUNT(DISTINCT id)'] > 0){
                return true;
            }else
                return false;
        }
    }


    /**
     * @param $id_candidatura
     * @return bool
     * @throws ApplicationException
     */
    public function setRifiutaCandidato($id_candidatura){
        $SET_CANDIDATURA = "UPDATE `Candidatura` SET  richiesta_inviata = 'non_inviata' WHERE `id` = $id_candidatura ;";
        if (!Manager::getDB()->query($SET_CANDIDATURA)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
        }
        return true;
    }


    /**
     * @param $id_candidatura
     * @return bool
     */
    public function isRifiutaCandidato($id_candidatura){
        $SET_CANDIDATURA = "SELECT COUNT(DISTINCT id) FROM candidatura  WHERE id = $id_candidatura AND richiesta_inviata = 'non_inviata';";
        $result = Manager::getDB()->query($SET_CANDIDATURA);
        if ($result) {
            $obj = $result->fetch_assoc();
            if ($obj['COUNT(DISTINCT id)'] > 0){
                return true;
            }else
                return false;
        }
    }

    /**
     * @param $id_candidatura
     * @return bool
     * @throws ApplicationException
     */
    public function setAccettaCollaborazione($id_candidatura){
        $SET_CANDIDATURA = "UPDATE `Candidatura` SET richiesta_accettata = 'accettato' WHERE `id` = $id_candidatura ;";
        if (!Manager::getDB()->query($SET_CANDIDATURA)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$EMAIL_ESISTE, Controller::getDB()->error, Controller::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Controller::getDB()->error, Controller::getDB()->errno);
        }
        return true;
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
        return true;
    }

    /**
     * @param $id_utente
     * @param $id_destinatario
     * @return array
     */
    public function isCandidato ($id_utente, $id_destinatario){
        $LOAD_CANDIDATURE = "SELECT c.* FROM candidatura c, annuncio a WHERE c.id_utente = $id_destinatario AND a.id = c.id_annuncio AND a.id_utente = $id_utente";
        $result = Manager::getDB()->query($LOAD_CANDIDATURE);
        $candidature = array();
        if ($result) {
            while ($obj = $result->fetch_assoc()) {
                $candidatura = new Candidatura($obj['id'], $obj['id_utente'], $obj['id_annuncio'], $obj['corpo'], $obj['data_risposta'], $obj['data_inviata'], $obj['richiesta_inviata'], $obj['richiesta_accettata']);
                $candidature[] = $candidatura;
            }
        }
        return $candidature;
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