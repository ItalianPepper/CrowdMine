<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 05/12/2016
 * Time: 10:33
 */

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';
include_once CONTROL_DIR . 'ControlUtils.php';

$manager = new UtenteManager();

$referer = DOMINIO_SITO;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($user)) {

    $referer = getReferer($referer,"referer");

    if(isset($_POST['idUser'])){

        $idVisitedUser = $_POST['idUser'];
        $visitedUser = $manager->findUtenteById($idVisitedUser);
        //controllo se esiste l'utente
        if (isset($visitedUser) && ($visitedUser->getId()!=null) ) {

            $manager->updateStatusUtente($visitedUser,StatoUtente::SEGNALATO);

        }
    }
}

header("location: " . $referer);
