<?php

/**
 * Created by PhpStorm.
 * User: Fabricio Nicolas Madaio
 * Date: 28/11/2016
 * Time: 18:36
 */

include_once MODEL_DIR . 'Annuncio.php';
include_once MODEL_DIR . 'Candidatura.php';
include_once MODEL_DIR . 'Utente.php';
include_once MODEL_DIR . 'MicroCategoria.php';
include_once MANAGER_DIR . 'Manager.php';

include_once FILTER_DIR . "FilterUtils.php";
include_once FILTER_DIR ."SearchByIdFilter.php";
include_once FILTER_DIR . "SearchByUserIdFilter.php";
include_once FILTER_DIR . "SearchByMicroFilter.php";
include_once FILTER_DIR . "OrderByDateFilter.php";
include_once FILTER_DIR . "SearchByNotStatus.php";
include_once FILTER_DIR . "SearchByStatus.php";


/**
 * Class AnnuncioManager
 * This Class provides the business logic for the Annuncio Management and methods for database access.
 */
class AnnuncioManager
{

    private static $GET_ALL_ANNUNCI = "SELECT * FROM `annuncio`";

    /**
     * AnnuncioManager constructor.
     */
    public function __construct()
    {

    }

    /**
     * create a new persistent Annuncio and its categories
     *
     * @param string $userid
     * @param string $data
     * @param String $title Title
     * @param String $location Location
     * @param string[] $microcat An array of microcategory IDs
     * @param String $remuneration Indicative remuneration.
     * @param String $type Type (domanda,offerta).
     * @param String $description description
     * @return Annuncio A model instance of the created Annuncio.
     */
    public function createAnnuncio($userid, $date, $title, $location, $microcat, $remuneration, $type, $description)
    {
        $INSERT_ANNUNCIO = "INSERT INTO `annuncio` (`id_utente`, `data`, `titolo`, `luogo`, `stato`, `retribuzione`, `tipo`, `descrizione`) VALUES ( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');";

        $query = sprintf($INSERT_ANNUNCIO, $userid, $date, $title, $location, StatoAnnuncio::REVISIONE, $remuneration, $type, $description);

        if (!Manager::getDB()->query($query)) {
            throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }

        /*auto generated id of the annuncio previously created*/
        $insertID = Manager::getDB()->insert_id;
        $Annuncio = new Annuncio($insertID, $userid, $date, $title, $description, $location, StatoAnnuncio::REVISIONE, $remuneration, $type);


        /* adding couples (insertId, microcatId) to RIFERITO */
        $this->addMicrosToAnnuncio($insertID, $microcat);

        return $Annuncio;
    }


    /**
     * Add couples (insertId, microcatId) to RIFERITO table
     *
     * @param int $id id Annuncio
     * @param array $microcat Array of microcategory IDs
     * @throws ApplicationException
     */
    public function addMicrosToAnnuncio($id, $microcat)
    {

        /*multiple insert with foreign key check*/
        $INSERT_RIFERITO = "INSERT INTO riferito SELECT '%s', id FROM microcategoria WHERE id = '%s' ; ";

        $query = "";

        for ($i = 0; $i < count($microcat); $i++) {
            $query .= sprintf($INSERT_RIFERITO, $id, $microcat[$i]);
        }

        if (!Manager::getDB()->multi_query($query)) {
            throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }


    /**
     * Update an existing Annuncio with the provided ID
     *
     * @param $id
     * @param string $userid
     * @param string $data
     * @param String $title Title
     * @param String $location Location
     * @param String $remuneration Indicative remuneration.
     * @param String $type Type (domanda,offerta).
     * @param String $description description
     * @param string[] $microcat An array of microcategory IDs
     * @return Annuncio A model instance of the updated Annuncio.
     */
    public function updateAnnuncio($id, $userid, $date, $title, $location, $remuneration, $type, $description, $microcat = null)
    {

        $UPDATE_ANNUNCIO = "UPDATE `Annuncio` SET `data` = '%s', `titolo` = '%s', `luogo` = '%s', `stato` = '%s', `retribuzione` = '%s', `tipo` = '%s', `descrizione` = '%s', `id_utente` = '%s' WHERE `id` = '%s' ";

        $query = sprintf($UPDATE_ANNUNCIO, $date, $title, $location, StatoAnnuncio::REVISIONE_MODIFICA, $remuneration, $type, $description, $userid, $id);
        if (!Manager::getDB()->query($query)) {
            throw new ApplicationException(ErrorUtils::$AGGIORNAMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }

        $Annuncio = new Annuncio($id, $userid, $date, $title, $description, $location, StatoAnnuncio::REVISIONE_MODIFICA, $remuneration, $type);

        /*
        *   MICROCATEGORIES
        *   Delete all and insert again, update is not coherent
        */
        if ($microcat != null) {

            /*deleting old microcategories*/
            $DELETE_MICROS = "DELETE FROM `riferito` WHERE `id_annuncio` = '%s' ";

            $query = sprintf($DELETE_MICROS, $id);
            if (!Manager::getDB()->query($query)) {
                throw new ApplicationException(ErrorUtils::$CANCELLAZIONE_FALLITA, Manager::getDB()->error, Manager::getDB()->errno);
            }

            /*adding the new ones*/
            $this->addMicrosToAnnuncio($id, $microcat);
        }

        return $Annuncio;
    }

    /**
     * delete an existing Annuncio with the provided ID
     * NOTE: Cascade delete must be enabled on db tables with annuncioid as foreign key
     * @param $idAnnuncio
     */
    public function deleteAnnuncio($idAnnuncio)
    {

        $DELETE_ANNUNCIO = "DELETE FROM `Annuncio` WHERE `id` = '%s' ";

        $query = sprintf($DELETE_ANNUNCIO, $idAnnuncio);
        if (!Manager::getDB()->query($query)) {
            throw new ApplicationException(ErrorUtils::$CANCELLAZIONE_FALLITA, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    public function temporaryTableSearchAnnunci($filters){

        $query = " CREATE OR REPLACE TEMPORARY TABLE searchedAnnunci AS (
                    select * FROM annuncio ";

        FilterUtils::applyFilters($filters, $query);

        $res=Manager::getDB()->query($query.");");

        if ($res==false) {
            throw new ApplicationException(ErrorUtils::$ARGOMENTO_NON_TROVATO, Manager::getDB()->error, Manager::getDB()->errno);
        }

        $query = "SELECT * FROM searchedAnnunci ";
        $res=Manager::getDB()->query($query);

        $annunci = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $annuncio = new Annuncio($obj['id'], $obj['id_utente'], $obj['data'], $obj['titolo'], $obj['descrizione'], $obj['luogo'], $obj['stato'], $obj['retribuzione'], $obj['tipo']);
                $annunci[] = $annuncio;
            }
        }
        return $annunci;
    }

    public function getUsersInSearchedAnnunci($inCandidacies=false,$inComments=false)
    {

        $query = "CREATE OR REPLACE TEMPORARY TABLE A1 AS (SELECT * FROM searchedAnnunci);";
        $res=Manager::getDB()->query($query);
        if ($res==false) {
            throw new ApplicationException(ErrorUtils::$ARGOMENTO_NON_TROVATO, Manager::getDB()->error, Manager::getDB()->errno);
        }
        $query = "CREATE OR REPLACE TEMPORARY TABLE A2 AS (SELECT * FROM searchedAnnunci);";
        $res=Manager::getDB()->query($query);
        if ($res==false) {
            throw new ApplicationException(ErrorUtils::$ARGOMENTO_NON_TROVATO, Manager::getDB()->error, Manager::getDB()->errno);
        }

        $query = "SELECT utente.*
                    FROM searchedAnnunci JOIN utente
                    ON searchedAnnunci.id_utente = utente.id ";

        if($inCandidacies)
            $query.="UNION
                    SELECT utente.*
                    FROM candidatura JOIN A1
                        ON A1.id = candidatura.id_annuncio
                    JOIN utente
                        ON candidatura.id_utente = utente.id ";

        if($inComments)
            $query.="UNION
                    SELECT utente.*
                    FROM commento JOIN A2
                        ON A2.id = commento.id_annuncio
                    JOIN utente
                        ON commento.id_utente = utente.id";

        $res = Manager::getDB()->query($query);

        $users = array();
        if ($res==false) {
            throw new ApplicationException(ErrorUtils::$VALORE_DUPLICATO, Manager::getDB()->error, Manager::getDB()->errno);
        }else{
            while ($obj = $res->fetch_assoc()) {
                $user = new Utente($obj['id'],
                    $obj['nome'],
                    $obj['cognome'],
                    $obj['descrizione'],
                    $obj['telefono'],
                    $obj['data_nascita'],
                    $obj['citta'],
                    $obj['email'],
                    $obj['password'],
                    $obj['ruolo'],
                    $obj['stato'],
                    $obj['immagine_profilo'],
                    $obj['partita_iva']);

                $users[$obj['id']] = $user;
            }
        }
        return $users;
    }

    /**
     * Get all the candidacies for serched Annunci
     *
     * @param $idAnnuncio
     * @return Candidatura[] A list of Candidatura elements.
     */
    public function getCandidatiInSearchedAnnunci()
    {
        $GET_CANDIDACIES = "SELECT candidatura.* 
                              FROM searchedAnnunci JOIN candidatura
                            ON searchedAnnunci.id = candidatura.id_annuncio";

        $query = sprintf($GET_CANDIDACIES);

        $res = Manager::getDB()->query($query);
        $candidacies = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $candidacy = new Candidatura($obj['id'], $obj['id_utente'], $obj['id_annuncio'], $obj['corpo'], $obj['data_risposta'], $obj['data_inviata'], $obj['richiesta_inviata'], $obj['richiesta_accettata']);

                if(!isset($candidacies[$obj['id_annuncio']])){
                    $candidacies[$obj['id_annuncio']] = array();
                }
                $candidacies[$obj['id_annuncio']][] = $candidacy;
            }
        }
        return $candidacies;
    }

    /**
     * Get all the comments for serched Annunci
     *
     * @param $idAnnuncio
     * @return Commento[] A list of Commento elements.
     */
    public function getCommentsInSearchedAnnunci()
    {
        $GET_CANDIDACIES = "SELECT commento.* 
                              FROM searchedAnnunci JOIN commento
                            ON searchedAnnunci.id = commento.id_annuncio";

        $query = sprintf($GET_CANDIDACIES);

        $res = Manager::getDB()->query($query);
        $commenti = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $commento = new Commento($obj['id'], $obj['id_annuncio'], $obj['id_utente'], $obj['corpo'], $obj['data'], $obj['stato']);
                if(!isset($commenti[$obj['id_annuncio']])){
                    $commenti[$obj['id_annuncio']] = array();
                }
                $commenti[$obj['id_annuncio']][] = $commento;
            }
        }
        return $commenti;
    }

    /**
     * return all microcategories involved inside a search
     * @param $filters
     * @return array
     */
    public function getMicrosInSearchedAnnunci(){

        $MICROS_FROM_ANNUNCI = "SELECT microcategoria.* 
                                        FROM riferito JOIN microcategoria ON
	                                          riferito.id_microcategoria = microcategoria.id
                                        WHERE riferito.id_annuncio IN (SELECT searchedAnnunci.id FROM searchedAnnunci WHERE 1) ";
        $query = sprintf($MICROS_FROM_ANNUNCI);

        $res = Manager::getDB()->query($query);
        $micros = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $micro = new MicroCategoria($obj['id_macrocategoria'], $obj['nome'], $obj['id']);
                $micros[$micro->getId()] = $micro;
            }
        }
        return $micros;
    }

    /**
     * return an array indexed by searched annunci ID's
     * each cell contains a list of microcategory ID's
     *
     * @param $filters
     * @return array
     */
    public function getSearchedAnnunciMicrosReference(){

        $RIFERITO = "SELECT * 
                        FROM riferito 
                        WHERE riferito.id_annuncio IN (SELECT searchedAnnunci.id FROM searchedAnnunci WHERE 1) ";
        $query = sprintf($RIFERITO);

        $res = Manager::getDB()->query($query);
        $aM = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                if(!isset($aM[$obj['id_annuncio']])){
                    $aM[$obj['id_annuncio']] = array();
                }
                $aM[$obj['id_annuncio']][]= $obj['id_microcategoria'];
            }
        }
        return $aM;
    }


    /**
     * Search an Annuncio with search filters
     *
     * @param array $filters array of filter objects
     * @return Annuncio[] A list of Annuncio elements.
     */
    public function searchAnnuncio($filters)
    {

        $query = sprintf(self::$GET_ALL_ANNUNCI);
        FilterUtils::applyFilters($filters, $query);
        $res = Manager::getDB()->query($query);
        $annunci = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $annuncio = new Annuncio($obj['id'], $obj['id_utente'], $obj['data'], $obj['titolo'], $obj['descrizione'], $obj['luogo'], $obj['stato'], $obj['retribuzione'], $obj['tipo']);
                $annunci[] = $annuncio;
            }
        }
        return $annunci;
    }

    /**
     * Get the instance of the Annuncio containing this ID.
     *
     * @param $id
     * @return Annuncio A model instance of the Annuncio.
     */
    public function getAnnuncio($id)
    {
        $res = $this->searchAnnuncio(
            Array(new SearchByIdFilter($id))
        );

        if(count($res)>0) return $res[0];

        return null;
    }

    /**
     * Search all the Annuncio elements for user id.
     *
     * @param $idUtente
     * @return Annuncio[] A list of Annuncio elements.
     */
    public function searchAnnunciUtente($idUtente)
    {
        return $this->searchAnnuncio(
            Array(new SearchByUserIdFilter($idUtente), new SearchByNotStatus(REVISIONE), new SearchByNotStatus(ELIMINATO))
        );
    }

    /**
     * Add a new candidacy into the Database.
     *
     * @param $idAnnuncio
     * @param $idUtente
     * @param String $message Candidacy proposal.
     */
    public function addCandidatura($idAnnuncio, $idUtente, $message, $data)
    {

        $INSERT_CANDIDATURA = "INSERT INTO `Candidatura` (`id_utente`, `id_annuncio`, `corpo`, `data_risposta`, `data_inviata`, `richiesta_inviata`, `richiesta_accettata`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');";

        $query = sprintf($INSERT_CANDIDATURA, $idUtente, $idAnnuncio, $message, null, $data, RichiestaInviataCandidatura::INVIATA, RichiestaAccettataCandidatura::NON_VALUTATO);
        if (!Manager::getDB()->query($query)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$VALORE_DUPLICATO, Manager::getDB()->error, Manager::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }

        $insertID = Manager::getDB()->insert_id;

        return new Candidatura($insertID, $idUtente, $idAnnuncio, $message, null, $data, RichiestaInviataCandidatura::INVIATA, RichiestaAccettataCandidatura::NON_VALUTATO);
    }

    /**
     * Add an Annuncio into the user's favorites list.
     *
     * @param $idAnnuncio
     * @param $idUtente
     */
    public function addToFavorites($idAnnuncio, $idUtente, $data)
    {
        $INSERT_FAVORITES = "INSERT INTO `Preferito`(`id_utente`, `id_annuncio`, `data_aggiunta`) VALUES ('%s', '%s', '%s' );";

        $query = sprintf($INSERT_FAVORITES, $idUtente, $idAnnuncio, $data);
        if (!Manager::getDB()->query($query)) {
            if (Manager::getDB()->errno == 1062) {
                throw new ApplicationException(ErrorUtils::$VALORE_DUPLICATO, Manager::getDB()->error, Manager::getDB()->errno);
            } else
                throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    public function getFavorite($UtenteId){
        $LOAD_PREFERITI = "SELECT a.* FROM annuncio a, preferito p, utente u WHERE u.id = $UtenteId AND p.id_utente = u.id AND a.id = p.id_annuncio;";
        $result = Manager::getDB()->query($LOAD_PREFERITI);
        $listPreferiti = array();
        if ($result) {
            while ($obj = $result->fetch_assoc()) {
                if(!$obj["stato"]!=ELIMINATO && !$obj["stato"]!=REVISIONE) {
                    $annuncio = new Annuncio($obj['id'], $obj['id_utente'], $obj['data'], $obj['titolo'], $obj['luogo'], $obj['stato'], $obj['retribuzione'], $obj['tipo'], $obj['descrizione']);
                    $listPreferiti[] = $annuncio;
                }
            }
            return $listPreferiti;
        }
    }

    /**
     * Remove an Annuncio from the user's favorites list.
     *
     * @param $idAnnuncio
     * @param $idUtente
     */
    public function removeFromFavorites($idAnnuncio, $idUtente)
    {
        $DROP_FAVORITES = "DELETE FROM `Preferito` WHERE `id_utente` = '%s' AND `id_annuncio` = '%s';";

        $query = sprintf($DROP_FAVORITES, $idUtente, $idAnnuncio);
        if (!Manager::getDB()->query($query)) {
            throw new ApplicationException(ErrorUtils::$CANCELLAZIONE_FALLITA, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    /**
     * Get the HomePage's list of announcements
     *  (method called by logged User)
     *
     * @return Annuncio[] A list of Annuncio elements.
     */
    public function getAnnunciHomePageUtenteLoggato($microcat=null)
    {
        $filters = array();

        for ($i = 0; $i < count($microcat); $i++) {
            $filters[] = new SearchByMicroFilter($microcat[$i]);
        }

        if(count($microcat)>0)
            $filters[] = new OrderByDateFilter(OrderType::DESC);

        return $this->searchAnnuncio($filters);
    }

    /**
     * Get the HomePage's list of announcements
     * (method called by not logged User)
     *
     * @return Annuncio[] A list of Annuncio elements.
     */
    public function getAnnunciHomePageUtenteVisitatore()
    {
        //aggiunta dei filtri per ricercare effettivamente gli annunci giusti
        $arr = array();
        //array_push($arr,new OrderByDateFilter(OrderType::DESC));
        array_push($arr,new SearchByNotStatus(REVISIONE));
        array_push($arr,new SearchByNotStatus(DISATTIVATO));
        array_push($arr,new SearchByNotStatus(ELIMINATO));
        array_push($arr,new SearchByNotStatus(REVISIONE_MODIFICA));
        array_push($arr,new SearchByNotStatus(AMMINISTRATORE));
        array_push($arr,new SearchByNotStatus(RICORSO));

        return $this->searchAnnuncio($arr);
    }

    /**
     * Sets the Annuncio as Reported on the Database
     *
     * @param $idAnnuncio
     */
    public function reportAnnuncio($idAnnuncio)
    {
        $this->updateStatus($idAnnuncio, StatoAnnuncio::SEGNALATO);
    }

    public function reportCommento($idCommento){
        $this->updateStatusCommento($idCommento,SEGNALATO);
    }

    /**
     * Get the list of annuncements with the Segnalato status
     *
     * @return Annuncio[] A list of Annuncio elements.
     */
    public function getReportedAnnunci()
    {
        return $this->searchAnnuncio(
            Array(new SearchByStatus(StatoAnnuncio::SEGNALATO))
        );
    }


    /**
     * Get all the candidacies for the Annuncio
     *
     * @param $idAnnuncio
     * @return Candidatura[] A list of Candidatura elements.
     */
    public function getAnnuncioWithCandidati($idAnnuncio)
    {
        $GET_CANDIDACIES = "SELECT * FROM `candidatura` WHERE `id_annuncio` = '%s'";

        $query = sprintf($GET_CANDIDACIES, $idAnnuncio);

        $res = Manager::getDB()->query($query);
        $candidacies = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $candidacy = new Candidatura($obj['id'], $obj['id_utente'], $obj['id_annuncio'], $obj['corpo'], $obj['data_risposta'], $obj['data_inviata'], $obj['richiesta_inviata'], $obj['richiesta_accettata']);
                $candidacies[] = $candidacy;
            }
        }
        return $candidacies;
    }

    /**
     *  Add a comment for the Annuncio
     *
     * @param string $idAnnuncio id of Annuncio
     * @param string $idUtente id of Utente
     * @param string $comment content of comment
     * @param string $date
     * @throws ApplicationException
     */
    public function commentAnnuncio($idAnnuncio, $idUtente, $comment, $date, $stato)
    {
        $INSERT_COMMENT = "INSERT INTO `commento` (`id`, `id_annuncio`, `id_utente`, `corpo`, `data`, `stato`) VALUES (NULL, '%s', '%s', '%s', '%s', '%s');";

        $query = sprintf($INSERT_COMMENT, $idAnnuncio, $idUtente, $comment, $date, $stato);
        if (!Manager::getDB()->query($query)) {
            throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    /**
     *  Search a comment by the idAnnuncio
     *
     * @param string $idAnnuncio id of Annuncio
     * return array of commments
     * @throws ApplicationException
     */
    public function getCommentsbyId($idAnnuncio) {

        $SEARCH_COMMENT_BY_ID = "SELECT * FROM `commento` WHERE `id_annuncio` = '$idAnnuncio'";

        $query = sprintf($SEARCH_COMMENT_BY_ID);
        $res = Manager::getDB()->query($query);
        $commenti = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $commento = new Commento($obj['id'], $obj['id_annuncio'], $obj['id_utente'], $obj['corpo'], $obj['data'], $obj['stato']);
                $commenti[] = $commento;
            }
        }
        return $commenti;
    }









    /**
     * @param $idAnnuncio
     * @param $newStatus
     * @param $oldStatus
     * @throws ApplicationException
     */

    public function updateStatusCommento($idCommento, $newStatus, $oldStatus = null){
        $UPDATE_STATUS = "UPDATE `commento` SET `stato` = '%s' WHERE `id` = '%s'";
        $query = sprintf($UPDATE_STATUS, $newStatus, $idCommento);

        /*force old status matching*/
        if ($oldStatus != null)
            $query .= sprintf(" AND `stato` = '%s'", $oldStatus);

        if (!Manager::getDB()->query($query)) {
            throw new ApplicationException(ErrorUtils::$AGGIORNAMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    public function updateStatus($idAnnuncio, $newStatus, $oldStatus = null)
    {

        $UPDATE_STATUS = "UPDATE `Annuncio` SET `stato` = '%s' WHERE `id` = '%s'";

        $query = sprintf($UPDATE_STATUS, $newStatus, $idAnnuncio);

        /*force old status matching*/
        if ($oldStatus != null)
            $query .= sprintf(" AND `stato` = '%s'", $oldStatus);


        if (!Manager::getDB()->query($query)) {
            throw new ApplicationException(ErrorUtils::$AGGIORNAMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    /**
     * Sets the Annuncio as Attivo if it was previously in Revisione, updating the persistence system.
     * NOTE: this method can be called only by moderators
     *
     * @param $idAnnuncio
     */
    public function validateAnnuncio($idAnnuncio)
    {
        $this->updateStatus($idAnnuncio, StatoAnnuncio::ATTIVO, StatoAnnuncio::REVISIONE);
    }

    /**
     * Sets the Annuncio as Attivo if it was previously Segnalato, updating the persistence system.
     *
     * @param $idAnnuncio
     */
    public function confirmValidationAnnuncio($idAnnuncio)
    {
        $this->updateStatus($idAnnuncio, StatoAnnuncio::ATTIVO, StatoAnnuncio::SEGNALATO);
    }

    /**
     * Send a new Claim for the Annuncio, updates the database
     *
     * @param $idAnnuncio
     * @param $message
     */
    public function sendClaim($idAnnuncio, $message)
    {
        /* TODO: tabella Ricorso ???*/
        $this->updateStatus($idAnnuncio, StatoAnnuncio::RICORSO, StatoAnnuncio::DISATTIVATO);
    }

    /**
     *Set the Annuncio as DISATTIVATO, updates the database
     *
     * @param $idAnnuncio
     * @param string $message
     */
    public function sendSuspension($idAnnuncio, $message = "")
    {
        $this->updateStatus($idAnnuncio, StatoAnnuncio::DISATTIVATO);
    }

    /**
     * Sets the Annuncio as Attivo if it was previously Amministratore, then updates the persistence system.
     * NOTE: this method can be called only by admins
     *
     * @param $idAnnuncio
     */
    public function sendConfirmation($idAnnuncio)
    {
        $this->updateStatus($idAnnuncio, StatoAnnuncio::ATTIVO, StatoAnnuncio::AMMINISTRATORE);
    }


    /**
     * @param $idAnnuncio
     */
    public function sendToAdmin($idAnnuncio)
    {
        //TODO: this status doesn't define if the current Annuncio is not visible as in DISATTIVATO
        $this->updateStatus($idAnnuncio, StatoAnnuncio::AMMINISTRATORE);
    }

    /**
     * Get the list of claimed announcements (RICORSO status)
     *
     * @return Annuncio[] A list of Annuncio elements.
     */
    public function getClaimedAnnunciList()
    {
        return $this->searchAnnuncio(
            Array(new SearchByStatus(StatoAnnuncio::RICORSO))
        );
    }

    /**
     * Get the number of announcements that match the specified criteria.
     *
     * @param DateTime $initDate Starting date of the interval.
     * @param DateTime $endDate Ending date of the interval.
     * @param String $macro macrocategory name.
     * @param String $micro microcategory name.
     * @return int
     */
    public function getAnnunciCount($filters)
    {
        $GET_COUNT = "SELECT COUNT(*) as total FROM `Annuncio`";

        $query = sprintf($GET_COUNT);
        FilterUtils::applyFilters($filters, $query);

        $res = Manager::getDB()->query($query);

        $annunci = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                return $obj['total'];
            }
        }
        return 0;
    }

    /**
     * Get the ranking of best announcements
     *
     * @param String $macro macrocategory of interest
     * @param String $micro microcategory of interest
     * @return Annuncio[] A list of Annuncio elements.
     */
    public function getAnnunciRanking($filters = [])
    {

        /*this query get a list of annunci ordered by their average feedback value*/

        $query = "SELECT annuncio.*
                  FROM annuncio JOIN (
                      SELECT annuncio.id, AVG(feedback.valutazione) AS avgFeedback
                      FROM annuncio LEFT JOIN feedback 
	                  ON annuncio.id = feedback.id_annuncio";

        /*here apply extra filters*/
        FilterUtils::applyFilters($filters, $query);

        $query .= "   GROUP BY annuncio.id ) f
                  ON annuncio.id = f.id
                  ORDER BY f.avgFeedback DESC";

        $res = Manager::getDB()->query($query);
        $annunci = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $annuncio = new Annuncio($obj['id'], $obj['id_utente'], $obj['data'], $obj['titolo'], $obj['luogo'], $obj['stato'], $obj['retribuzione'], $obj['tipo'], $obj['descrizione']);
                $annunci[] = $annuncio;
            }
        }
        return $annunci;
    }


    //metodi utili per gestione statistiche

    public function getNumberAnnunciByMicrocategoriaBetweenDates($microcategoria, $fromDate, $toDate){
        $lista = array();
        $FIND_ANNUNCI = "SELECT CAST(annuncio.data AS DATE) AS dateres , COUNT(annuncio.id) AS conto
                          FROM annuncio, riferito 
                          WHERE annuncio.id = riferito.id_annuncio AND riferito.id_microcategoria ='%s' 
                                AND (annuncio.data BETWEEN '%s' AND '%s')
                          GROUP BY dateres
                          ORDER BY dateres ASC";
        $micro = new MicrocategoriaManager();
        $microcategoriaObj = $micro->findMicrocategoriaByNome($microcategoria);
        $query = sprintf($FIND_ANNUNCI, $microcategoriaObj->getId(), date_format($fromDate, 'Y-m-d'), date_format($toDate, 'Y-m-d'));
        $result = Manager::getDB()->query($query);
        if($result){

            while($r = $result->fetch_assoc()){
                $lista[$r['dateres']] = $r['conto'];
            }

        }
        return $lista;;
    }

    public function getNumberAnnunciByMacrocategoriaBetweenDates($macrocategoria, $fromDate, $toDate){
        $lista = array();
        $FIND_ANNUNCI = "SELECT CAST(annuncio.data AS DATE) AS dateres , COUNT(annuncio.id) AS conto
                          FROM annuncio,riferito,macrocategoria,microcategoria
                          WHERE annuncio.id = riferito.id_annuncio
                          AND riferito.id_microcategoria = microcategoria.id 
                          AND microcategoria.id_macrocategoria = '%s'
                          AND (annuncio.data BETWEEN '%s' AND '%s')
                          GROUP BY dateres
                          ORDER BY dateres ASC";
        $macro = new MacroCategoriaManager();
        $macrocategoriaObj = $macro->getMacroByName($macrocategoria);
        $query = sprintf($FIND_ANNUNCI,$macrocategoriaObj->getId(), date_format($fromDate,'Y-m-d'), date_format($toDate,'Y-m-d'));
        $result = Manager::getDB()->query($query);

       if($result){

            while($r = $result->fetch_assoc()) {

                $lista[$r['dateres']] = $r['conto'];

            }
        }
        return $lista;
    }

    public function getNumberAnnunciPublishedInAMounth(){
        $lista = array();
        $toData = date("Y-m-d");
        $fromData = date('-1 month', strtotime($toData));

        $FIND_ANNUNCI = "SELECT CAST(annuncio.data AS DATE) AS dateres, COUNT(annuncio.id) AS conto
                         FROM annuncio
                         WHERE (annuncio.data BETWEEN '%s' AND '%s')
                         GROUP BY dateres";

        $query = sprintf($FIND_ANNUNCI, date('Y-m-d', strtotime(str_replace('-', '/', $fromData))), date('Y-m-d', strtotime(str_replace('-', '/', $toData))));
        $result = Manager::getDB()->query($query);
        if($result){
            while($r = $result->fetch_assoc()){
                $sqlDate = strtotime($r['dateres']);
                $resultDate = date("Y-m-d",$sqlDate);
                $lista[$resultDate] = $r['conto'];
            }
            return $lista;
        }
        return false;
    }

    public function getNumberAnnunciPubblishedToday(){
        $lista = array();
        $data = date("Y-m-d");
        $FIND_ANNUNCI = "SELECT COUNT(annuncio.data) FROM annuncio WHERE annuncio.data = '%s'";
        $query = sprintf($FIND_ANNUNCI, $data);
        $result = Manager::getDB()->query($query);
        if(!$result){

        }else{
            foreach($result->fetch_assoc() as $r){
                array_push($lista, $r);
            }
        }return $lista;
    }

}