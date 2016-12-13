<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 05/12/2016
 * Time: 10:33
 */

include_once MODEL_DIR.'Utente.php';
include_once MANAGER_DIR.'UtenteManager.php';

$manager = new UtenteManager();

$utente = new Utente();

$_SESSION['user'] = $utente;

if(isset($_SESSSION['user'])){
    // Con userEsterno intendo il profilo dell' utente che viene visitato dal moderatore
    $userEsterno = $_SESSSION['userEsterno'];
    //prendo in input la password dell'moderatore/Amministratore
    $password = "cap e cazz"; // $_POST['password'];
    echo "$manager->banUser($userEsterno,$password)";
    //header("/home.php");
}
else{
    header("/home.php");
}