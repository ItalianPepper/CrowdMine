<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 05/12/2016
 * Time: 10:15
 */


include_once MODEL_DIR.'Utente.php';
include_once MANAGER_DIR."UtenteManager.php";
include_once MANAGER_DIR."Manager.php";

$utente = new Utente("id", "nome", "cognome", "telefono", "dataNascita", "citta", "email", "password", "stato", "ruolo", "immagineProfilo");



$_SESSION['user'] = $utente;

$manager = new UtenteManager();



if(isset($_SESSION['user'])){

   $user = $_SESSION['user'];
    $manager->deleteUserData();
    header("/home.php");
}
else{
    header("/home.php");
}




