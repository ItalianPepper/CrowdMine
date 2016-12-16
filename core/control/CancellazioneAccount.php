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


$manager = new UtenteManager();


if(isset($_SESSION['user'])){

    $user = $_SESSION['user'];
    $password = $_POST['inputPassword'];
    if($user->getPassword()==$password){
        $manager->deleteUserData($user);
        session_destroy();
        header ("location: ".DOMINIO_SITO);
    }
    else{
        header ("location: ".DOMINIO_SITO.DIRECTORY_SEPARATOR."visitaProfiloPersonale");
    }
}
else{
    header ("location: ".DOMINIO_SITO);
}




