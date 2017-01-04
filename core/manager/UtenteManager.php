<?php

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'MicrocategoriaManager.php';

/**
 * Created by PhpStorm.
 * User: Dario Galiani
 * Date: 28/11/2016
 * Time: 23.25
 */
class UtenteManager extends Manager implements SplSubject
{

    private $_observers;
    private $wrapperNotifica;

    /**
     * UtenteManager constructor.
     */
    public function __construct()
    {
        $this->_observers = new SplObjectStorage();
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
    public function createUser($id, $nome, $cognome, $descrizione, $telefono, $dataNascita, $citta, $email, $password, $stato, $ruolo, $immagineProfilo)
    {
        return new Utente($id, $nome, $cognome, $descrizione, $telefono, $dataNascita, $citta, $email, $password, $stato, $ruolo, $immagineProfilo);
    }


    /**
     * creates user model by SQL query result row
     * @param $row
     */
    private function createUserFromRow($row)
    {
        if ($row == null) return null;
        return $this->createUser($row['id'], $row['nome'], $row['cognome'], $row['telefono'], $row['data_nascita'], $row['citta'], $row['email'], $row['password'], $row['stato'], $row['ruolo'], $row['descrizione'], $row['immagine_profilo'], $row['partita_iva']);
    }

    /**
     * Create a new persistent Utente
     *
     * @param $user
     */
    private function insertUtente($user)
    {
        $INSERT_UTENTE = "INSERT INTO `utente`( `nome`, `cognome`, `descrizione`, `telefono`, `data_nascita`, `citta`, `email`, `password`, `ruolo`, `stato`, `immagine_profilo`, `partita_iva`) VALUES('%s', '%s', %s, %s, '%s', '%s', '%s', '%s', '%s', '%s', '%s', %s);";
        $query = sprintf($INSERT_UTENTE, $user->getNome(), $user->getCognome(), Manager::formatNullString($user->getDescrizione()), Manager::formatNullString($user->getTelefono()), $user->getDataNascita(), $user->getCitta(), $user->getEmail(), $user->getPassword(), $user->getRuolo(), $user->getStato(), $user->getImmagineProfilo(), Manager::formatNullString($user->getPartitaIva()));
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
    public function updateUtente($user)
    {
        if ($user->getStato() == StatoUtente::SEGNALATO) {
            $username = $user->getNome() . " " . $user->getCognome();
            $this->inviaNotificaDiSegnalazione($user->getId(), $username);
        }
        $UPDATE_UTENTE = "UPDATE utente SET nome='%s', cognome='%s', descrizione='%s', telefono='%s', data_nascita='%s', citta='%s', email='%s', password='%s', ruolo='%s', stato='%s', immagine_profilo='%s', partita_iva='%s' WHERE id='%s';";
        $query = sprintf($UPDATE_UTENTE, $user->getNome(), $user->getCognome(), $user->getDescrizione(), $user->getTelefono(), $user->getDataNascita(), $user->getCitta(), $user->getEmail(), $user->getPassword(), $user->getRuolo(), $user->getStato(), $user->getImmagineProfilo(), $user->getPartitaIva(), $user->getId());
        self::getDB()->query($query);
    }

    /**
     * let a user block another one
     * @param $userWhoID
     * @param $userByID
     * @throws ApplicationException
     */
    public function blockUser($userWhoID, $userByID)
    {

        $BLOCCA_UTENTE = "INSERT INTO `bloccato` (`id_utente`, `id_utente_bloccato`) VALUES ('%s', '%s')";
        $query = sprintf($BLOCCA_UTENTE, $userByID, $userWhoID);

        if (!Manager::getDB()->query($query)) {
            throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    /**
     * remove blocked user
     * @param $userWhoID
     * @param $userByID
     * @throws ApplicationException
     */
    public function removeBlockedUser($userWhoID, $userByID)
    {
        $REMOVE_BLOCK = "DELETE FROM bloccato WHERE id_utente_bloccato='%s' AND id_utente='%s'";
        $query = sprintf($REMOVE_BLOCK, $userWhoID, $userByID);
        $result = self::getDB()->query($query);
        if (!$result) {
            throw new ApplicationException(ErrorUtils::$AGGIORNAMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    /**
     * Set an Utente as DISATTIVATO
     *
     * @param $user
     */
    public function disableUtente($user)
    {
        self::updateStatusUtente($user, StatoUtente::DISATTIVATO);
    }

    /**
     * Update status of Utente
     *
     * @param $user
     * @param $status
     * @throws ApplicationException
     */
    public function updateStatusUtente($user, $status)
    {

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
    public function updateRoleUtente($user, $role)
    {

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
    public function findUtenteById($userId)
    {
        $connection = self::getDB();
        $CERCA_UTENTE = "SELECT * FROM utente WHERE id='%s';";
        $query = sprintf($CERCA_UTENTE, $userId);
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        return $this->createUserFromRow($row);
    }


    /**
     * get a list of blocked users for a certain user
     *
     * @param $userId
     * @return array
     */
    public function getBlockedForUser($userId)
    {
        $users = array();
        $getListUsers = "SELECT * 
                            FROM bloccato JOIN utente
                              ON bloccato.id_utente_bloccato = utente.id
                            WHERE bloccato.id_utente = %s";
        $query = sprintf($getListUsers, $userId);

        $result = self::getDB()->query($query);
        while ($row = $result->fetch_assoc()) {
            $user = $this->createUserFromRow($row);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * Find a List of Utente
     *
     * @param $input
     * @return array
     */
    public function findUserOneInput($input)
    {
        $users = array();
        if (!empty($input)) {
            $getListUsers = "SELECT * FROM utente WHERE  nome LIKE '%s' OR cognome LIKE '%s' OR email LIKE '%s' ;";
            $in = "%" . $input . "%";
            $query = sprintf($getListUsers, $in, $in, $in);
        } else {
            $query = "SELECT * FROM utente WHERE 1;";
        }
        $result = self::getDB()->query($query);
        while ($row = $result->fetch_assoc()) {
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
    public function findUserTwoInput($inputOne, $inputTwo)
    {
        $users = array();
        $getListUsers = "SELECT * FROM utente WHERE (nome LIKE %'%s'% AND cognome LIKE %'%s'%) OR ( nome LIKE %'%s'% AND cognome LIKE %'%s'%) ;";
        $query = sprintf($getListUsers, $inputOne, $inputTwo, $inputTwo, $inputOne);
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
    private function findUtenteByLogin($email, $password)
    {
        $GET_UTENTE_BY_LOGIN = "SELECT * FROM utente WHERE email='%s' AND password='%s';";
        $query = sprintf($GET_UTENTE_BY_LOGIN, $email, $password);
        $result = Manager::getDB()->query($query);

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
    public function findUserByMicroAvgOverRatio($microCategoria, $numStelle)
    {
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
        if ($resSet) {
            foreach ($resSet->fetch_assoc() as $u) {
                $user = $this->createUserFromRow($u);
                array_push($users, $user);
            }
        }
        return $users;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $users = array();
        $FIND_ALL = "SELECT * FROM utente;";
        $result = self::getDB()->query($FIND_ALL);
        foreach ($result->fetch_assoc() as $u) {
            $user = $this->createUserFromRow($u);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * @return array
     */
    public function getReportedUtente()
    {
        $connection = self::getDB();
        $GET_UTENTI_SEGNALATI = "SELECT * FROM utente WHERE stato='%s'";
        $query = sprintf($GET_UTENTI_SEGNALATI, StatoUtente::SEGNALATO);
        $result = $connection->query($query);
        $users = array();

        if (!$result) {
            throw new ApplicationException(ErrorUtils::$LOGIN_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }

        while ($u = $result->fetch_assoc()) {
            $user = $this->createUserFromRow($u);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * @return array
     */
    public function getAdminStateUtente()
    {
        $connection = self::getDB();
        $GET_UTENTI_SEGNALATI_IN_ADMIN = "SELECT * FROM utente WHERE stato='%s'";
        $query = sprintf($GET_UTENTI_SEGNALATI_IN_ADMIN, StatoUtente::AMMINISTRATORE);
        $result = $connection->query($query);
        $users = array();

        if (!$result) {
            throw new ApplicationException(ErrorUtils::$ARGOMENTO_NON_TROVATO, Manager::getDB()->error, Manager::getDB()->errno);
        }

        while ($u = $result->fetch_assoc()) {
            $user = $this->createUserFromRow($u);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * @return array
     */
    public function getBannedUtente()
    {
        $connection = self::getDB();
        $GET_UTENTI_BANNATI = "SELECT * FROM utente WHERE stato='%s'";
        $query = sprintf($GET_UTENTI_BANNATI, StatoUtente::BANNATO);
        $result = $connection->query($query);
        $users = array();
        while ($u = $result->fetch_assoc()) {
            $user = $this->createUserFromRow($u);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * @return array
     */
    public function getAppealUtente()
    {
        $users = array();
        $GET_APPEAL_USERS = "SELECT * FROM utente WHERE stato='%s' OR stato='%s' ";
        $query = sprintf($GET_APPEAL_USERS, StatoUtente::RICORSO, StatoUtente::BANNATO);
        $result = self::getDB()->query($query);
        $users = array();
        while ($u = $result->fetch_assoc()) {
            $user = $this->createUserFromRow($u);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * @param $email
     * @return bool
     */
    public function checkEmail($email)
    {
        $CHECK_EMAIL = "SELECT * FROM utente WHERE email='%s';";
        $query = sprintf($CHECK_EMAIL, $email);
        $result = self::getDB()->query($query);
        if ($result->num_rows < 1) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $userId
     * @param $password
     * @return bool
     */
    public function checkPassword($userId, $password)
    {
        $CHECK_PSWD = "SELECT * FROM utente WHERE id='%d' AND password='%s';";
        $query = sprintf($CHECK_PSWD, $userId, $password);
        $result = self::getDB()->query($query);
        if (($result->num_rows) < 1) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * @param $user
     * @param $microcategoria
     */
    public function addMicroCategoria($user, $microcategoria)
    {
        $ADD_MICROCATEGORIA = "INSERT INTO competente (id_microcategoria, id_utente) VALUES('%s', '%s');";
        $query = sprintf($ADD_MICROCATEGORIA, $microcategoria->getId(), $user->getId());
        $result = self::getDB()->query($query);
        if (!$result) {
            throw new ApplicationException(ErrorUtils::$AGGIORNAMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    /**
     * @param $user
     * @param $microcategoria
     */
    public function removeMicroCategoria($user, $microcategoria)
    {
        $REMOVE_MICROCATEGORIA = "DELETE FROM competente WHERE id_microcategoria='%s' AND id_utente='%s'";
        $query = sprintf($REMOVE_MICROCATEGORIA, $microcategoria, $user);
        $result = self::getDB()->query($query);
        if (!$result) {
            throw new ApplicationException(ErrorUtils::$AGGIORNAMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    /**
     * @param $userId
     * @param $macroId
     */
    public function removeMacroCategoria($userid, $macroId)
    {
        $REMOVE_MACROCATEGORIA = "DELETE FROM competente WHERE EXISTS
                                        (	SELECT 1
	                                        FROM microcategoria JOIN macrocategoria
		                                          ON microcategoria.id_macrocategoria = macrocategoria.id
	                                        WHERE macrocategoria.id='%s' AND microcategoria.id = competente.id_microcategoria
	                                        AND competente.id_utente='%s')";
        $query = sprintf($REMOVE_MACROCATEGORIA, $macroId, $userid);

        $result = self::getDB()->query($query);
        if (!$result) {
            throw new ApplicationException(ErrorUtils::$AGGIORNAMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    /**
     * @param $email
     * @param $password
     * @return bool|Utente
     */
    public function login($email, $password)
    {
        if (!($user = $this->findUtenteByLogin($email, $password))) {
            return false;
        } else {
            return $user;
        }
    }

    /**
     * @param $user
     */
    public function register($user)
    {
        $this->insertUtente($user);
    }

    /**
     * @param $nome
     * @param $cognome
     * @return array|bool
     */
    public function searchUtente($nome, $cognome)
    {
        if (!$users = $this->findUtenteByUserName($nome, $cognome)) {
            return false;
        } else {
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
    public function getListUtentiByMicrocategoria($microcategoria)
    {
        $users = array();
        $FIND_USERS_BY_MICRO = "SELECT utente.id, utente.nome, utente.cognome, utente.descrizione, utente.telefono, utente.data_nascita, utente.citta, utente.email, utente.password, utente.ruolo, utente.stato, utente.immagine_profilo FROM utente, annuncio, riferito WHERE riferito.id_annuncio = annuncio.id and annuncio.id_utente=utente.id and riferito.id_microcategoria = %s;";
        $query = sprintf($FIND_USERS_BY_MICRO, $microcategoria->getId());
        $result = self::getDB()->query($query);
        foreach ($result->fetch_assoc() as $r) {
            $user = $this->createUserFromRow($r);
            array_push($users, $user);
        }
        return $users;
    }

    public function getListUtentiByMacrocategoria($macrocategoria)
    {
        $users = array();
        $FIND_USERS_BY_MACRO = "SELECT utente.id, utente.nome, utente.cognome, utente.descrizione, utente.telefono, utente.data_nascita, utente.citta, utente.email, utente.password, utente.ruolo, utente.stato, utente.immagine_profilo FROM utente, annuncio, riferito, microcategoria WHERE riferito.id_annuncio = annuncio.id and annuncio.id_utente=utente.id and riferito.id_microcategoria = microcategoria.id AND microcategoria.id_macrocategoria = '%s';";
        $query = sprintf($FIND_USERS_BY_MACRO, $macrocategoria->getId());
        $result = self::getDB()->query($query);
        foreach ($result->fetch_assoc() as $r) {
            $user = $this->createUserFromRow($r);
            array_push($users, $user);
        }
        return $users;
    }

    public function getMicroCategoryByUtente($user)
    {
        $list = array();
        $idUtente = $user->getId();
        $GET_CATEGORY_BY_ID = "SELECT microcategoria.id, microcategoria.nome, microcategoria.id_macrocategoria FROM microcategoria, competente WHERE competente.id_utente = '%s' AND microcategoria.id = competente.id_microcategoria";
        $query = sprintf($GET_CATEGORY_BY_ID, $idUtente);
        $result = self::getDB()->query($query);
        foreach ($result->fetch_assoc() as $m) {
            $microManager = new MicrocategoriaManager();
            $micro = $microManager->createMicrocategoria($m['id'], $m['nome'], $m['id_macrocategoria']);
            array_push($list, $micro);
        }
        return $list;
    }

    public function inviaNotificaDiSegnalazione($idOggetto, $nome)
    {
        $tipo = "segnalazione";
        $listaDestinatari = $this->findUserOneInput(RuoloUtente::MODERATORE);
        $this->setWrapperNotifica($idOggetto, $tipo, $nome, $listaDestinatari);
        $this->notify();
    }

    public function attach(SplObserver $observer)
    {
        $this->_observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->_observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->_observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * @return mixed
     */
    public function getWrapperNotifica()
    {
        return $this->wrapperNotifica;
    }

    /**
     * @param $idOggetto
     * @param $tipo
     * @param $nome
     * @param null $listaMittenti
     */
    public function setWrapperNotifica($idOggetto, $tipo, $nome, $listaDestinatari = null)
    {
        $this->wrapperNotifica = array(
            "id_oggetto" => $idOggetto,
            "tipo_oggetto" => $tipo,
            "nome" => $nome,
            "lista_mittenti" => $listaDestinatari
        );
    }
}
