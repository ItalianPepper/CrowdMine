<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 28/12/2016
 * Time: 17:23
 */

include_once MODEL_DIR.'Utente.php';
include_once MANAGER_DIR."UtenteManager.php";
include_once MANAGER_DIR."Manager.php";


$manager = new UtenteManager();


if (isset($_POST['formName'])) {
    $formName = $_POST['formName'];
    switch ($formName) {
        case "name" :
            if($_POST['name']) {
                $name = $_POST['name'];
                if($name != "" ) {
                    $user->setNome($name);
                    $manager->updateUtente($user);
                }
            }
            break;
        case "surname" :
            if($_POST['surname']) {
                $surname = $_POST['surname'];
                if($surname != "" ) {
                    $user->setCognome($surname);
                    $manager->updateUtente($user);
                }
            }
            break;
        case "birthdate" :
            if($_POST['birthdate']) {
                $birthdate = $_POST['birthdate'];
                if($birthdate != "" ) {
                    $user->setDataNascita($birthdate);
                    $manager->updateUtente($user);
                }
            }
            break;
        case "location" :
            if($_POST['location']) {
                $location = $_POST['location'];
                if($location != "" ) {
                    $user->setCitta($location);
                    $manager->updateUtente($user);
                }
            }
            break;
        case "description" :
            if($_POST['description']) {
                $description = $_POST['description'];
                if($description != "" ) {
                    $user->setDescrizione($description);
                    $manager->updateUtente($user);
                }
            }
            break;
        case "partitaIva" :
            if($_POST['partitaIva']) {
                $partitaIva = $_POST['partitaIva'];
                if($partitaIva != "" ) {
                    $user->setPartitaIva($partitaIva);
                    $manager->updateUtente($user);
                }
            }
            break;
        default :
            break;

    }

    $_SESSION['user'] = serialize($user);

}
header ("location: ".DOMINIO_SITO.DIRECTORY_SEPARATOR."ProfiloPersonale");