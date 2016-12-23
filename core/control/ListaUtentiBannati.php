<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 19/12/2016
 * Time: 15:22
 */

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';

$manager = new UtenteManager();

if(isset($_SESSION['user'])){
    $user = unserialize($_SESSION['user']);
    if(($user->getRuolo() == "moderatore") || ($user->getRuolo() == "amministratore")){
        $userList = $manager->getBannedUtente();
        $_SESSION['utentiBannati'] = serialize($userList);
        header("location: " . DOMINIO_SITO.DIRECTORY_SEPARATOR."utentiBannati");
    }else{
        header("location: " . DOMINIO_SITO);
    }
}else{
    header("location: " . DOMINIO_SITO);
}
