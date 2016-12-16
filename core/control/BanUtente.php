<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 05/12/2016
 * Time: 10:33
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
    //controllo se esiste l'utente
    if (isset($userEsterno) && ($userEsterno->getId()==null) ) {
        if (($user->getRuolo() == "moderatore") || ($user->getRuolo() == "amministratore")) {
            $userEsterno->setStato("bannato");

            if($urlDellaChiamata == ""){
                //permette di essere reindirizzato dalla pagina da cui viene chiamato il control
                header("location: " . DOMINIO_SITO.DIRECTORY_SEPARATOR.$urlDellaChiamata);
            }
            else {
                //significa che è stato manomessa la form, modificato il campo url da dove chiama
                header("location: " . DOMINIO_SITO);
            }

        } else {
            header("location: " . DOMINIO_SITO);
        }
    }
} else {
    header("location: " . DOMINIO_SITO);
}
