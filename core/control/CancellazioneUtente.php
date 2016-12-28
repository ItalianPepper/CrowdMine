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


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($user)){

    $password = $_POST['inputPassword'];
    if($user->getPassword()==$password){
        $manager->disableUtente($user);
        session_destroy();
        header ("location: ".DOMINIO_SITO."/auth");
    }
    else{
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Password errata";
        header ("location: ".DOMINIO_SITO.DIRECTORY_SEPARATOR."ProfiloPersonale");
    }
}
else{
    header ("location: ".DOMINIO_SITO);
}




