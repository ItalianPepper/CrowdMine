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


//il nome dipende dalla barra di ricerca
$input = $_POST['input'];

$arrayInput = explode(" ", $input);;

if(count($arrayInput)==1){
    $listResultFindUser = $manager->findUserOneInput($arrayInput[0]);

    $_SESSION['listResultFindUser'] = serialize($listResultFindUser);

    header("location: " . DOMINIO_SITO.DIRECTORY_SEPARATOR."risultatoRicercaUtente");
}
elseif (count($arrayInput)>1){

    $listResultFindUser = $manager->findUserTwoInput($arrayInput[0],$arrayInput[1]);

    $_SESSION['listResultFindUser'] = serialize($listResultFindUser);

    header("location: " . DOMINIO_SITO.DIRECTORY_SEPARATOR."risultatoRicercaUtente");
}
else{
    header("location: " . DOMINIO_SITO);
}