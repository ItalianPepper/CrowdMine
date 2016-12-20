<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 15/12/2016
 * Time: 12:19
 */

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';

$manager = new UtenteManager();
$urlDellaChiamata = $_POST_['urlDellaChiamata'];



if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $idUtenteEsterno = $_POST['idUser'];
    $userEsterno = $manager->findUtenteById($idUtenteEsterno);

    if (isset($userEsterno) && ($userEsterno->getId()!=null) ) {
        if (($user->getRuolo() == "moderatore") || ($user->getRuolo() == "amministratore")) {
            $userEsterno->setStato("attivo");
            $manager->updateUtente($userEsterno);

            if($urlDellaChiamata == "ProfiloUtente"){
                //permette di essere reindirizzato dalla pagina da cui viene chiamato il control
                header("location: " . DOMINIO_SITO.DIRECTORY_SEPARATOR.$urlDellaChiamata."?user=".$userEsterno->getId());
            }
            elseif ($urlDellaChiamata == "visualizzaUtentiBannati"){
                header("location: " . DOMINIO_SITO.DIRECTORY_SEPARATOR.$urlDellaChiamata);
            }
            else {
                //significa che è stato manomessa la form, modificato il campo url da dove chiama
                header("location: " . DOMINIO_SITO);
            }

        }else {
            header("location: " . DOMINIO_SITO);
        }

    } else {
        header("location: " . DOMINIO_SITO);
    }


} else {
    header("location: " . DOMINIO_SITO);
}