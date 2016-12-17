<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 13/12/2016
 * Time: 16:03
 */

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';

$manager = new UtenteManager();

// prendo in input da dove chiamo questa pagina
$urlDellaChiamata = $_POST_['urlDellaChiamata'];

if (isset($_SESSSION['user'])) {
    $user = $_SESSION['user'];
    $idUtenteEsterno = $_POST['idUser'];
    $userEsterno = $manager->findUtenteById($idUtenteEsterno);
    if(isset($userEsterno) && ($userEsterno->getId()==null) ) {
        if ($userEsterno->getRuolo() == "utente") {
            $userEsterno->setStato("segnalato");
            $manager->updateUtente($userEsterno);



        } elseif (($userEsterno->getRuolo() == "moderatore") && ($user->getRuolo() == "moderatore")) {
            $userEsterno->setStato("segnalato");
            $manager->updateUtente($userEsterno);

            //da modificare e reindirizzarlo al control;
            header("location: " . DOMINIO_SITO.DIRECTORY_SEPARATOR."visitaProfiloUtente");
        }
    }
    else{
        header("location: " . DOMINIO_SITO);
    }

} else {
    header("location: " . DOMINIO_SITO);
}
