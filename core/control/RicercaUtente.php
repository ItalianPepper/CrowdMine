<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 26/12/2016
 * Time: 18:48
 */

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';

$manager = new UtenteManager();


if($_SERVER["REQUEST_METHOD"]=="POST") {

    if(isset($_POST["inputSearch"])) {

        $input = $_POST["inputSearch"];

        $arrayInput = explode(" ", $input);

        if (count($arrayInput) == 1) {

            $listaUtenti = $manager->findUserOneInput($arrayInput[0]);


        } else if (count($arrayInput) > 1) {

            $listaUtenti = $manager->findUserTwoInput($arrayInput[0], $arrayInput[1]);

        }
    }
}

include_once VIEW_DIR ."RisultatiRicercaUtente.php";