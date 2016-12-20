<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 18/12/2016
 * Time: 13:14
 */

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';

$manager = new UtenteManager();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $idUtenteEsterno = $_POST['idUser'];
    $userEsterno = $manager->findUtenteById($idUtenteEsterno);
    if (isset($userEsterno) && ($userEsterno->getId()!=null) ) {
        if ($user->getRuolo() == "amministratore"){
            $userEsterno->setRuolo("moderatore");
            $manager->updateUtente($userEsterno);

            header("location: " . DOMINIO_SITO.DIRECTORY_SEPARATOR."ProfiloUtente?user=".$userEsterno->getId());

        }else{
            //L'utente non è un amministratore
            header("location: " . DOMINIO_SITO);
        }
    }
    else{
        //L'utente esterno non esiste la form è stata modificata
        header("location: " . DOMINIO_SITO);
    }

}
else {
    //L'utente non è settato nella sessione
    header("location: " . DOMINIO_SITO);
}
