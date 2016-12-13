<?php

include_once MODEL_DIR . 'Annuncio.php';
include_once MODEL_DIR . 'Microcategoria.php';
include_once MANAGER_DIR."Manager.php";
include_once MODEL_DIR . 'Macrocategoria.php';
/**
 * Created by PhpStorm.
 * User: Andrea Sarto
 * Date: 28/11/2016
 * Time: 23.25
 */
class UtenteManager extends Manager
{

    /**
     * UtenteManager constructor.
     */
    public function __construct(){

    }
     /**
      * Create a new persistent User and its categories
      *
      * @param String $name name
      * @param String $surname surname
      * @param String $phone number phone
      * @param Date $dateOfBirth date of birth
      * @param String $city city
      * @param String $mail e-mail
      * @param String $password password
      * @return User A model instance of the updated User.
      */
     public function createUser($name, $surname, $phone, $dateOfBirth, $city, $mail, $password){
         return new User($name, $surname, $phone, $dateOfBirth, $city, $mail, $password);
     }

     /**
      * Send login
      *
      * @param String $mail e-mail
      * @param String $password password
      */
     public function forwardsLogin($mail, $password){

     }

    /**
     * Send logout request
     *
     * @param String $mail e-mail
     * @param String $password password
     */
    public function forwardsLogout($mail, $password){

    }

    /**
     * Delete data user
     */
    public function deleteUserData(){
        return "ELIMINATO";
    }

    /**
     * Ban an user
     *
     * @param double $UserId
     * @param String $password
     */
    public function banUser($UserId, $password){
        if($password=="cap e cazz"){
            return "UTENTE BANNATO";
        }

    }

    /**
     * Get a list of reported user
     * return User[] A list og reported user
     */
    public function reportedUser(){
        return [];
    }

    /**
     * Change password
     *
     * @param String $currentPassword
     * @param String $newPassword
     */
    public function changePassword($currentPassword, $newPassword){

    }

    /**
     * Get list of User
     *
     * @param String $UserName
     * @return Utente[] A list of User by User name
     */
    public function getUtente($UserName){
        return [];
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
     * @param Double $UtenteId
     */
    public function reactivateUtente($UtenteId){

    }

    /**
     * Get a list of banned User
     *
     * @return bannedUtente[] A list of banned user
     */
    public function getBannedUtente(){
        return [];
    }

    /**
     * Promote an user as moderator
     *
     * @param Double $UtenteId
     * @param String $password
     */
    public function promoteMod($UtenteId, $password){

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
     * Search an User
     *
     * @param Double %UtenteId
     */
    public function searchUtente($UtenteId){

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
