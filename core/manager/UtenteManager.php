<?php

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'MicrocategoriaManager.php';
include_once MODEL_DIR . 'Annuncio.php';

/**
 * Created by PhpStorm.
 * User: Dario Galiani
 * Date: 28/11/2016
 * Time: 23.25
 */

class UtenteManager extends Manager{
    /**
     * UtenteManager constructor.
     */
    public function __construct()
    {

    }

    /**
     * Create a new Utente
     *
     * @param $nome
     * @param $cognome
     * @param $telefono
     * @param $dataNascita
     * @param $citta
     * @param $email
     * @param $password
     * @param $stato
     * @param $ruolo
     * @param $immagineProfilo
     */
    public function createUser($id, $nome, $cognome, $telefono, $dataNascita, $citta, $email, $password, $stato, $ruolo, $immagineProfilo){
        return new Utente($id, $nome, $cognome, $telefono, $dataNascita, $citta, $email, $password, $stato, $ruolo, $immagineProfilo);
    }

    /**
     * Create a new persistent Utente
     *
     * @param $user
     */
    private function insertUtente($user){
        $INSERT_UTENTE = "INSERT INTO 'utente' (nome, cognome, telefono, dataNascita, citta, email, password, stato, ruolo, immagineProfilo) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');";
        $query = sprintf($INSERT_UTENTE, $user->getNome(), $user->getCognome(), $user->getTelefono(), $user->getDataNascita(), $user->getCitta(), $user->getEmail(), $user->getPassword(), $user->getStato(), $user->getRuolo(), $user->getImmagineProfilo());
        self::getDB()->query($query);
    }

    /**
     * Update some param of a existing Utente
     *
     * @param $user
     */
    public function updateUtente($user){
        $UPDATE_UTENTE = "UPDATE utente SET telefono='%s', dataNascita='%s', citta='%s', email='%s', password='%s', stato='%s', ruolo='%s', immagineProfilo='%s';";
        $query = sprintf($UPDATE_UTENTE, $user->getTelefono(), $user->getDataNascita(), $user->getCitta(), $user->getEmail(), $user->getPassword(), $user->getStato(), $user->getRuolo(), $user->getImmagineProfilo());
        self::getDB($query);
    }

    /**
     * Find Utente by is key value
     *
     * @param $userId
     * @return Utente
     */
    public function findUtenteById($userId){
        $connection = self::getDB();
        $CERCA_UTENTE = "SELECT * FROM utente WHERE id='%s';";
        $query = sprintf($CERCA_UTENTE, $userId);
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        return $this->createUser($row['id'], $row['nome'], $row['cognome'], $row['telefono'], $row['dataNascita'], $row['citta'], $row['email'], $row['password'], $row['stato'], $row['ruolo'], $row['immagineProfilo']);
    }

    /**
     * Find a List of Utente by yours username
     *
     * @param $nome
     * @param $cognome
     * @return array
     */
    private function findUtenteByUserName($nome, $cognome){
        $users = array();
        $GET_UTENTE_BY_USERNAME = "SELECT * FROM utente WHERE nome='%s' cognome='%s';";
        $query = sprintf($GET_UTENTE_BY_USERNAME, $nome, $cognome);
        $result = self::getDB()->query($query);
        foreach ($result->fetch_assoc() as $row) {
            $user = $this->createUser($row['id'], $row['nome'], $row['cognome'], $row['telefono'], $row['data_nascita'], row['citta'], $row['email'], $row['password'], $row['stato'], $row['ruolo'], $row['immagine_profilo']);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * Find a user
     *
     * @param $email
     * @param $password
     * @return bool|Utente
     */
    private function findUtenteByLogin($email, $password){
        $connection = self::getDB();
        $GET_UTENTE_BY_LOGIN = "SELECT * FROM utente WHERE email='%s' AND password='%s';";
        $query = sprintf($GET_UTENTE_BY_LOGIN, $email, $password);
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        if (!$row || mysqli_num_rows($row) <= 0) {
            return false;
        } else {
            return $this->createUser($row['id'], $row['nome'], $row['cognome'], $row['telefono'], $row['dataNascita'], $row['citta'], $row['email'], $row['password'], $row['stato'], $row['ruolo'], $row['immagineProfilo']);
        }
    }

    /**
     * @param $microCategoria
     * @param $numStelle
     * @return array
     */
    public function findUserByMicroAvgOverRatio($microCategoria, $numStelle){
        $mc = $microCategoria->getId();
        $GET_USER_BY_RATIO = "SELECT utente.id, AVG(feedback.valutazione) AS Media
            FROM utente,feedback,annuncio, riferito
            WHERE utente.id = annuncio.id_utente AND riferito.id_annuncio = annuncio.id AND annuncio.id = feedback.id_annuncio AND riferito.id_microcategoria = %s
            GROUP BY utente.id
            HAVING AVG(feedback.valutazione) > = %s
            ORDER BY AVG(feedback.valutazione);
        ";
        $query = sprintf($GET_USER_BY_RATIO, $mc, $numStelle);
        $resSet = self::getDB()->query($query);
        $users = array();
        if ($resSet){
            foreach($resSet->fetch_assoc() as $u){
                $user = $this->createUser($u['id'], $u['nome'], $u['cognome'], $u['telefono'], $u['dataNascita'], $u['citta'], $u['email'], $u['password'], $u['stato'], $u['ruolo'], $u['immagineProfilo']);
                array_push($users, $user);
            }
        }
        return $users;
    }

    /**
     * @return array
     */
    public function findAll(){
        $users = array();
        $FIND_ALL = "SELECT * FROM utente;";
        $result = self::getDB()->query($FIND_ALL);
        foreach($result->fetch_assoc() as $u){
            $user = $this->createUser($u['id'], $u['nome'], $u['cognome'], $u['telefono'], $u['dataNascita'], $u['citta'], $u['email'], $u['password'], $u['stato'], $u['ruolo'], $u['immagineProfilo']);
            array_push($users, $user);
        }return $users;
    }

    /**
     * @return array
     */
    public function getReportedUtente(){
        $connection = self::getDB();
        $GET_UTENTI_SEGNALATI = "SELECT * FROM utente WHERE stato='%s'";
        $query = sprintf($GET_UTENTI_SEGNALATI, StatoUtente::SEGNALATO);
        $result = $connection->query($query);
        $users = array();
        foreach($result->fetch_assoc() as $u){
            $user = $this->createUser($u['id'], $u['nome'], $u['cognome'], $u['telefono'], $u['dataNascita'], $u['citta'], $u['email'], $u['password'], $u['stato'], $u['ruolo'], $u['immagineProfilo']);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * @return array
     */
    public function getBannedUtente(){
        $connection = self::getDB();
        $GET_UTENTI_BANNATI = "SELECT * FROM utente WHERE stato='%s'";
        $query = sprintf($GET_UTENTI_BANNATI, StatoUtente::BANNATO);
        $result = $connection->query($query);
        $users = array();
        foreach($result->fetch_assoc() as $u){
            $user = $this->createUser($u['id'], $u['nome'], $u['cognome'], $u['telefono'], $u['dataNascita'], $u['citta'], $u['email'], $u['password'], $u['stato'], $u['ruolo'], $u['immagineProfilo']);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * @return array
     */
    public function getAppealUtente(){
        $users = array();
        $GET_APPEAL_USERS = "SELECT * FROM 'utente' WHERE stato='%s'";
        $query = sprintf($GET_APPEAL_USERS, StatoUtente::RICORSO);
        $result = self::getDB()->query($query);
        foreach($result->fetch_assoc() as $u){
            $user = $this->createUser($u['id'], $u['nome'], $u['cognome'], $u['telefono'], $u['dataNascita'], $u['citta'], $u['email'], $u['password'], $u['stato'], $u['ruolo'], $u['immagineProfilo']);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * @param $email
     * @return bool
     */
    public function checkEmail($email){
        $CHECK_EMAIL = "SELECT * FROM utente WHERE email='%s';";
        $query = sprintf($CHECK_EMAIL, $email);
        $result = self::getDB()->query($query);
        if($result->num_rows < 1){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @param $userId
     * @param $password
     * @return bool
     */
    public function checkPassword($userId, $password){
        $CHECK_PSWD = "SELECT * FROM utente WHERE id='%s' AND password='%s';";
        $query = sprintf($CHECK_PSWD, $userId, $password);
        $result = self::getDB()->query($query);
        if($result->num_rows < 1){
            return false;
        }else{
            return true;
        }
    }

    /**
     * @param $user
     * @param $microcategoria
     */
    public function addMicroCategoria($user,$microcategoria){
        $ADD_MICROCATEGORIA = "INSERT INTO competente (id_microcategoria, id_utente) VALUES('%s', '%s');";
        $query = sprintf($ADD_MICROCATEGORIA, $microcategoria->getId(), $user->getId());
        self::getDB()->query($query);
    }

    /**
     * @param $user
     * @param $microcategoria
     */
    public function removeMicroCategoria($user, $microcategoria){
        $REMOVE_MICROCATEGORIA = "DELETE FROM competente WHERE id_microcategoria='%s' AND id_utente='%s'";
        $query = sprintf($REMOVE_MICROCATEGORIA, $user, $microcategoria);
        self::getDB()->query($query);
    }

    /**
     * @param $email
     * @param $password
     * @return bool|Utente
     */
    public function login($email, $password){
        if(!($user = $this->findUtenteByLogin($email, $password))){
            return false;
        }else{
            return $user;
        }
    }

    /**
     * @param $user
     */
    public function register($user){
        $this->insertUtente($user);
    }

    /**
     * @param $nome
     * @param $cognome
     * @return array|bool
     */
    public function searchUtente($nome, $cognome){
        if(!$users = $this->findUtenteByUserName($nome, $cognome)){
            return false;
        }else{
            return $users;
        }
    }


}
