<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 28/12/2016
 * Time: 17:23
 */

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . "UtenteManager.php";
include_once MANAGER_DIR . "Manager.php";
include_once CONTROL_DIR . "ControlUtils.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";


$manager = new UtenteManager();
$fieldName = "";

if (isset($_POST['formName'])) {
    $formName = $_POST['formName'];
    switch ($formName) {
        case "name" :
            if ($_POST['name']) {
                $name = $_POST['name'];
                if ($name != "" && !empty($name) && preg_match(Patterns::$NAME_GENERIC, $name) && strlen($name) < 255
                    && strlen($name) >= 2) {
                    $user->setNome($name);
                    $manager->updateUtente($user);
                    $fieldName = "Nome";
                }
                else
                {
                    $_SESSION['toast-type'] = "error";
                    $_SESSION['toast-message'] = "Campo nome  non settato correttamente";
                    header("Location:" .getReferer(DOMINIO_SITO));
                    throw new IllegalArgumentException("Campo nuovo numero non settato");
                }
            }
            break;
        case "surname" :
            if ($_POST['surname']) {
                $surname = $_POST['surname'];
                if ($surname != "" && !empty($surname) && preg_match(Patterns::$NAME_GENERIC, $surname) && strlen($surname) < 255
                    && strlen($surname) >= 2) {
                    $user->setCognome($surname);
                    $manager->updateUtente($user);
                    $fieldName = "Cognome";
                }
                else
                {
                    $_SESSION['toast-type'] = "error";
                    $_SESSION['toast-message'] = "Campo cognome  non settato correttamente";
                    header("Location:" .getReferer(DOMINIO_SITO));
                    throw new IllegalArgumentException("Campo nuovo numero non settato");
                }
            }
            break;
        case "birthdate" :
            if ($_POST['birthdate']) {
                $birthdate = $_POST['birthdate'];
                if ($birthdate != "" && !empty($birthdate) && preg_match(Patterns::$GENERIC_DATE, $birthdate) ) {
                    $user->setDataNascita($birthdate);
                    $manager->updateUtente($user);
                    $fieldName = "Data di nascita";
                }
                else
                {
                    $_SESSION['toast-type'] = "error";
                    $_SESSION['toast-message'] = "Campo data  non settato correttamente";
                    header("Location:" .getReferer(DOMINIO_SITO));
                    throw new IllegalArgumentException("Campo nuovo numero non settato");
                }
            }
            break;
        case "location" :
            if ($_POST['location']) {
                $location = $_POST['location'];
                if ($location != "") {
                    $user->setCitta($location);
                    $manager->updateUtente($user);
                    $fieldName = "Luogo";
                }
            }
            break;
        case "description" :
            if ($_POST['description'] ) {
                $description = $_POST['description'];
                if ($description != "" && preg_match(Patterns::$NAME_GENERIC, $description) && strlen($description) < 255 && !empty($description)
                    && strlen($description) >= 2) {
                    $user->setDescrizione($description);
                    $manager->updateUtente($user);
                    $fieldName = "Descrizione";
                }
                else
                {
                    $_SESSION['toast-type'] = "error";
                    $_SESSION['toast-message'] = "Campo descrizione  non settato correttamente";
                    header("Location:" .getReferer(DOMINIO_SITO));
                    throw new IllegalArgumentException("Campo nuovo numero non settato");
                }
            }
            break;
        case "partitaIva" :
            if ($_POST['partitaIva']) {
                $partitaIva = $_POST['partitaIva'];
                if ($partitaIva != "" && preg_match(Patterns::$PI_GENERIC, $partitaIva) && !empty($partitaIva)) {
                    $user->setPartitaIva($partitaIva);
                    $manager->updateUtente($user);
                    $fieldName = "Partita iva";
                }
                else
                {
                    $_SESSION['toast-type'] = "error";
                    $_SESSION['toast-message'] = "Campo partita iva  non settato correttamente";
                    header("Location:" .getReferer(DOMINIO_SITO));
                    throw new IllegalArgumentException("Campo nuovo numero non settato");
                }
            }
            break;
        default :
            break;

    }

    $_SESSION['user'] = serialize($user);
    $_SESSION['toast-type'] = "success";
    $_SESSION['toast-message'] = "Il campo ".$fieldName." è stato cambiato con successo.";
    header("Location:" .getReferer(DOMINIO_SITO));

}
