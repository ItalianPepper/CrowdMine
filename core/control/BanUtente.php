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
        //check if user exists
        if (isset($visitedUser) && ($visitedUser->getId()!=null)) {

            /*
             * if the visitedUser is an admin, it cannot be banned.
             * Same if visitedUser is a moderator and the current user is not an admin.
            */
            if($visitedUser->getRuolo() == RuoloUtente::AMMINISTRATORE ||
                ($visitedUser->getRuolo() == RuoloUtente::MODERATORE && $user->getRuolo() != RuoloUtente::AMMINISTRATORE) ){
                $_SESSION['toast-type'] = "error";
                $_SESSION['toast-message'] = "Accesso Negato";
                header("Location:" . $referer);
                throw new IllegalArgumentException("Accesso Negato");
            }

            $manager->updateStatusUtente($visitedUser,StatoUtente::BANNATO);

        }
    }
}

header("location: " . $referer);
