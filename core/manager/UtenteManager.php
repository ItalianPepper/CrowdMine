<?php

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'Manager.php';

/**
 * Created by PhpStorm.
 * User: Dario Galiani
 * Date: 28/11/2016
 * Time: 23.25
 */
class UtenteManager extends Manager
{

    /**
     * UtenteManager constructor.
     */
    public function __construct()
    {

    }
     /**
      * Create a new persistent User and its categories
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
     public function createUser($nome, $cognome, $telefono, $dataNascita, $citta, $email, $password, $stato, $ruolo, $immagineProfilo){
         return new Utente($nome, $cognome, $telefono, $dataNascita, $citta, $email, $password, $stato, $ruolo, $immagineProfilo);
     }

    /**
     * Get an Utente by Id
     *
     * @param Double %utenteId
     * @return Utente $user
     */
    public function getUtenteById($utenteId){
        $connection = self::getDB();
        $CERCA_UTENTE = "SELECT * FROM 'utente' WHERE id='%s'";
        $query = sprintf($CERCA_UTENTE, $utenteId);
        $result = $connection->query($query);
        $row = $result->fetch_array();
        $user = new Utente($row['nome'], $row['cognome'], $row['telefono'], $row['dataNascita'], $row['citta'], $row['email'], $row['password'], $row['stato'], $row['ruolo'], $row['immagineProfilo']);
        return $user;
    }

     /**
      * Authenticate an Utente by his login informations
      *
      * @param String $mail e-mail
      * @param String $password password
      * @return bool
      */
     public function Login($mail, $password){
        session_start();
        if(!($user = $this->getUtenteByLogin($mail, $password))){
            $_SESSION['login'] = false;
            header("Location:".DOMINIO_SITO."/");
        }else{
            $_SESSION['login'] = true;
            $_SESSION['user'] = serialize($user);
        }
     }

    /**
     * Get an Utente by Login
     *
     * @param $mail
     * @param $password
     * @return bool | Utente $user
     */
    private function getUtenteByLogin($mail, $password){
        $connection = self::getDB();
        $query = "SELECT * FROM 'utente' WHERE email='$mail' AND password='$password'";
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        if(!$row || mysqli_num_rows($row) <= 0)
            return false;
        else{
            $user = new Utente($row['nome'], $row['cognome'], $row['telefono'], $row['dataNascita'], $row['citta'], $row['email'], $row['password'], $row['stato'], $row['ruolo'], $row['immagineProfilo']);
            return $user;
        }
    }

    /**
     * Logout
     *
     */
    public function logout(){
        session_start();
        $_SESSION[] = array();
        session_destroy();
    }

    /**
     * Delete data user.
     *
     * @param String $password
     * @return bool
     */
    public function deleteUserData($password){
        $user = unserialize($_SESSION['user']);
        if($user->getPassword() != $password){
            return false;
        }else{
            $connection = self::getDB();
            $AGGIORNA_UTENTE = "UPDATE 'utente' SET ciita='%s', data_nascita='%s', immagine_profilo='%s', telefono='%s' WHERE id='%s'";
            $query = sprintf($AGGIORNA_UTENTE, "", "", "", "", $user->getId());
            $connection->query($query);
            $this->logout();
        }
    }

    /**
     * Ban an user
     *
     * @param double $userId
     * @param String $password
     *
     * @return bool
     */
    public function banUser($userId, $password){
        $mod = unserialize($_SESSION['user']);
        if($password != $mod->getPassword()){
            return false;
        }else{
            $connection = self::getDB();
            $BANNA_UTENTE = "UPDATE 'utente' SET stato='%s' WHERE id='%s'";
            $query = sprintf($BANNA_UTENTE, $BANNATO, $userId); //va definito un file con le macro delle Enum.
            $connection->query($query);
            return true;
        }
    }

    /**
     * Change password
     *
     * @param String $currentPassword
     * @param String $newPassword
     */
    public function changePassword($userId, $currentPassword, $newPassword){
        $user = $this->getUtenteById($userId);
        if($currentPassword === $user->getPassword()){
            $user->setPassword($newPassword);
            $connection = self::getDB();
            $CAMBIA_PASSWORD = "UPDATE 'utente' SET password='%s' WHERE id='%s'";
            $query = sprintf($CAMBIA_PASSWORD, $newPassword, $userId);
            $connection->query($query);
            $connection->close();
        }else{
            //errore password sbagliata;
        }
    }

    /**
     * Get a list of User by name
     *
     * @param String $userName
     * @return array $users A list of User by User name
     */
    public function getUtenteByName($userName){
        $users = array();
        $connection = self::getDB();
        $query= "SELECT * FROM 'utente' WHERE name='$userName'";
        $result = $connection->query($query);
        while($row = mysqli_fetch_array($result)){
            $user = new Utente($row['id'], $row['nome'], $row['cognome'], $row['telefono'], $row['data_nascita'], row['citta'], $row['email'], $row['password'], $row['stato'], $row['ruolo'], $row['immagine_profilo']);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * Add a new macrocategory
     * @param Macrocategoria $macrocategoria
     */
    public function addMacrocategoria($macrocategoria){

    }

    /**
     * Add a new microcategory
     * @param Microcategoria $microcategoria
     */
    public function addMicrocategoria($microcategoria){

    }

    /**
     * Reactivate an User
     *
     * @param Double $utenteId
     */
    public function reactivateUtente($utenteId){
        $connection = self::getDB();
        $ATTIVA_UTENTE = "UPDATE 'utente' SET stato='%s' WHERE id='%s'";
        $query = sprintf($ATTIVA_UTENTE, $RIATTIVATO, $utenteId); //definire macro per enum.
        $connection->query($query);

    }

    /**
     * Get a list of banned User
     *
     * @return array $users
     */
    public function getBannedUtente(){
        $connection = self::getDB();
        $GET_UTENTI_BANNATI = "SELECT * FROM 'utente' WHERE stato='%s'";
        $query = sprintf($GET_UTENTI_BANNATI, $BANNATO);
        $result = $connection->query($query);
        $users = array();
        foreach($result->fetch_assoc() as $u){
            $user = new Utente($u['nome'], $u['cognome'], $u['telefono'], $u['dataNascita'], $u['citta'], $u['email'], $u['password'], $u['stato'], $u['ruolo'], $u['immagineProfilo']);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     *
     */
    public function getReportedUtente(){
        $connection = self::getDB();
        $GET_UTENTI_BANNATI = "SELECT * FROM 'utente' WHERE stato='%s'";
        $query = sprintf($GET_UTENTI_BANNATI, $SEGNALATO);
        $result = $connection->query($query);
        $users = array();
        foreach($result->fetch_assoc() as $u){
            $user = new Utente($u['nome'], $u['cognome'], $u['telefono'], $u['dataNascita'], $u['citta'], $u['email'], $u['password'], $u['stato'], $u['ruolo'], $u['immagineProfilo']);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * Promote an user as moderator
     *
     * @param Double $utenteId
     * @param String $password
     */
    public function setUserAsMod($utenteId, $password){

    }

    public function setModAsUser($utenteId, $password){

    }

    /**
     * Get a list of appeal User ban
     *
     * @return appealUtente[] A list of appeal User ban
     */
    public function appealUtente(){
        return [];
    }

    /**
     * Change User data
     *
     * @param Double $UserId
     */
    public function changeDataUtente($UserId){

    }

    /**
     * Redeem a banned user
     *
     */
    public function redeemUtente(){

    }

    /**
     * Report an User
     *
     */
    public function reportUtente(){

    }

    /**
     * Block an User
     *
     * @param Double $UtenteId
     */
    public function blockUser($UtenteId){

    }

    /**
     * Unblock an user
     *
     * @param Double $UtenteId
     */
    public function unblockUser($UtenteId){

    }

    /**
     * Get a list of favorite announcement
     *
     * @param Double $UtenteId
     *
     * @return favoriteAnnuncio[] A list of favourite annuncment for User
     */
    public function getFavorite($UtenteId){
        return [];
    }

    /**
     * Get a list of User that follow a macrocategory
     *
     * @param Macrocategoria $macrocategoria A Macrocategoria object
     *
     * @return Utente[] A list of User that follows a macrocategoria
     */
    public function macrocategoryUtente($macrocategoria){
        return [];
    }

    /**
     * Get a list of User that follow a microcategory
     *
     * @param Microcategoria $microcategoria A Microcategoria object
     *
     * @return Utente[] A list of Utente that follows a microcategory
     */
    public function microcategoryUtente($microcategoria){
        return [];
    }

    /**
     * Return the ranking of macrocategory
     *
     * @param Macrocategoria $macrocategory
     *
     * @return ranking[]
     */
    public function rankingMacrocategoria($macrocategoria){
        return [];
    }

    /**
     * Return the ranking of microcategory
     *
     * @param Microcategoria $microcategoria
     *
     * @return ranking[]
     */
    public function rankingMicrocategoria($microcategoria){
        return [];
    }
}
