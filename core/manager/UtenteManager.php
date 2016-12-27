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
     * @param $descrizione
     * @param $telefono
     * @param $dataNascita
     * @param $citta
     * @param $email
     * @param $password
     * @param $stato
     * @param $ruolo
     * @param $immagineProfilo
     */
    public function createUser($id, $nome, $cognome,$descrizione, $telefono, $dataNascita, $citta, $email, $password, $stato, $ruolo, $immagineProfilo){
        return new Utente($id, $nome, $cognome,$descrizione, $telefono, $dataNascita, $citta, $email, $password, $stato, $ruolo, $immagineProfilo);
    }


    /**
     * creates user model by SQL query result row
     * @param $row
     */
    private function createUserFromRow($row){
        if($row==null) return null;
        return $this->createUser($row['id'], $row['nome'], $row['cognome'], $row['telefono'], $row['data_nascita'], $row['citta'], $row['email'], $row['password'], $row['stato'], $row['ruolo'],$row['descrizione'], $row['immagine_profilo'],$row['partita_iva']);
    }

    /**
     * Create a new persistent Utente
     *
     * @param $user
     */
    private function insertUtente($user){
        $INSERT_UTENTE = "INSERT INTO `utente`( `nome`, `cognome`, `descrizione`, `telefono`, `data_nascita`, `citta`, `email`, `password`, `ruolo`, `stato`, `immagine_profilo`, `partita_iva`) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');";
        $query = sprintf($INSERT_UTENTE, $user->getNome(), $user->getCognome(),$user->getDescrizione(),$user->getTelefono(), $user->getDataNascita(), $user->getCitta(), $user->getEmail(), $user->getPassword(), $user->getRuolo(),$user->getStato(), $user->getImmagineProfilo(), $user->getPartitaIva());
        echo $query;
        if (!Manager::getDB()->query($query)) {
            throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    /**
     * Update some param of a existing Utente
     *
     * @param $user
     */
    public function updateUtente($user){
        $UPDATE_UTENTE = "UPDATE utente SET descrizione='%s', telefono='%s', data_nascita='%s', citta='%s', email='%s', password='%s', stato='%s', ruolo='%s', immagine_profilo='%s' WHERE id='%s';";
        $query = sprintf($UPDATE_UTENTE, $user->getDescrizione(),$user->getTelefono(), $user->getDataNascita(), $user->getCitta(), $user->getEmail(), $user->getPassword(), $user->getStato(), $user->getRuolo(), $user->getImmagineProfilo(), $user->getId());
        self::getDB()->query($query);
    }

    /**
     * Set an Utente as DISATTIVATO
     *
     * @param $user
     */
    public function disableUtente($user){
        self::updateStatusUtente($user,StatoUtente::DISATTIVATO);
    }

    /**
     * Update status of Utente
     *
     * @param $user
     * @param $status
     * @throws ApplicationException
     */
    public function updateStatusUtente($user, $status){

        $UPDATE_UTENTE = "UPDATE utente SET stato='%s' WHERE id='%s';";
        $query = sprintf($UPDATE_UTENTE, $status, $user->getId());

        self::getDB()->query($query);

        if (Manager::getDB()->error) {
            throw new ApplicationException(ErrorUtils::$AGGIORNAMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }

        $user->setStato($status);
    }

    /**
     * Update role of Utente
     *
     * @param $user
     * @param $role
     * @throws ApplicationException
     */
    public function updateRoleUtente($user, $role){

        $UPDATE_UTENTE = "UPDATE utente SET ruolo='%s' WHERE id='%s';";
        $query = sprintf($UPDATE_UTENTE, $role, $user->getId());

        self::getDB()->query($query);

        if (Manager::getDB()->error) {
            throw new ApplicationException(ErrorUtils::$AGGIORNAMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }

        $user->setRuolo($role);
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
        return $this->createUserFromRow($row);
    }


    /**
     * Find a List of Utente
     *
     * @param $input
     * @return array
     */
    public function findUserOneInput ($input){
        $users = array();
        $getListUsers = "SELECT * FROM utente WHERE  nome LIKE %'%s'% OR cognome LIKE %'%s'% OR email LIKE %'%s'% ;";
        $query = sprintf($getListUsers,$input,$input,$input);
        $result = self::getDB()->query($query);
        foreach ($result->fetch_assoc() as $row) {
            $user = $this->createUserFromRow($row);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * Find a List of Utente
     *
     * @param $inputOne
     * @param $inputTwo
     * @return array
     */
    public function findUserTwoInput ($inputOne,$inputTwo){
        $users = array();
        $getListUsers = "SELECT * FROM utente WHERE (nome LIKE %'%s'% AND cognome LIKE %'%s'%) OR ( nome LIKE %'%s'% AND cognome LIKE %'%s'%) ;";
        $query = sprintf($getListUsers,$inputOne,$inputTwo,$inputTwo,$inputOne);
        $result = self::getDB()->query($query);
        foreach ($result->fetch_assoc() as $row) {
            $user = $this->createUserFromRow($row);
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
        $result=Manager::getDB()->query($query);

        if (!$result) {
            throw new ApplicationException(ErrorUtils::$LOGIN_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }

        $row = $result->fetch_assoc();
        if (!$row || mysqli_num_rows($result) <= 0) {
            return false;
        } else {
            return $user = $this->createUserFromRow($row);
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
                $user = $this->createUserFromRow($u);
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
            $user = $this->createUserFromRow($u);
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
            $user = $this->createUserFromRow($u);
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
            $user = $this->createUserFromRow($u);
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
            $user = $this->createUserFromRow($u);
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
        $CHECK_PSWD = "SELECT * FROM utente WHERE id='%d' AND password='%s';";
        $query = sprintf($CHECK_PSWD, $userId, $password);
        $result = self::getDB()->query($query);
        if(($result->num_rows) < 1){
            return FALSE;
        }else{
            return TRUE;
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

    /**
     * Get a list of User that follow a microcategory
     *
     * @param Microcategoria $microcategoria A Microcategoria object
     *
     * @return Utente[] A list of User that follows a microcategoria
     */
    public function microcategoryUtente($microcategoria){
        $users = array();
        $FIND_USERS_BY_MACRO = "SELECT utente.id, utente.nome, utente.cognome, utente.descrizione, utente.telefono, utente.data_nascita, utente.citta, utente.email, utente.password, utente.ruolo, utente.stato, utente.immagine_profilo FROM utente, annuncio, riferito WHERE riferito.id_annuncio = annuncio.id and annuncio.id_utente=utente.id and riferito.id_microcategoria = %s;";
        $query = sprintf($FIND_USERS_BY_MACRO, $microcategoria->getId());
        $result = self::getDB()->query($query);
        foreach($result->fetch_assoc() as $r){
            $user = $this->createUserFromRow($r);
            array_push($users, $user);
        }return $users;
    }



}
