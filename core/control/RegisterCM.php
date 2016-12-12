<?php

/**
 * User: Andrea Buonaguro   
 * Date: 7/12/2016
 * Time: 19:07
 */
include_once MANAGER_DIR . "UtenteManager.php";
include_once CONTROL_DIR . "ControlUtils.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";

if ($_SERVER["REQUEST_METHOD"]== "POST"){
    
    $utenteManager = new UtenteManager();
    $userName = NULL;
    $userSurname = NULL;
    $userPhone = NULL;
    $userDateOfBirth = NULL;
    $userCity = NULL;
    $userMail = NULL;
    $userPassword = NULL;
    $userPasswordRetyped = NULL;
    $userPI = NULL;
    $userType = NULL;
    $userDescription = NULL;
    $userImage = NULL;
    
    if (isset($_POST['nome'])) {
        $userName = $_POST["nome"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo nome non settato";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Campo nome non settato");
    }

    if (isset($_POST['cognome'])) {
        $userSurname = $_POST["cognome"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo cognome non settato";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Campo cognome non settato");
    }
    if (isset($_POST['telefono'])) {
        $userPhone = $_POST["telefono"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo telefono non settato";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Campo telefono non settato");
    }
     
    if (isset($_POST['datanascita'])) {
        $userDateOfBirth = $_POST["datanascita"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo data di nascita non settato";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Campo data di nascita non settato");
    }
    
    if (isset($_POST['citta'])) {
        $userCity = $_POST["citta"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo citta' non settato";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Campo citta' non settato");
    }
    
    if (isset($_POST['email'])) {
        $userMail = $_POST["email"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo email non settato";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Campo email non settato");
    }
    
    if (isset($_POST['password'])) {
        $userPassword = $_POST["password"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo password non settato";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Campo password non settato");
    }
    
    if (isset($_POST['passwordretyped'])) {
        $userPasswordRetyped = $_POST["passwordretyped"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Reinserire la password";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Reinserire la password");
    }
    
    if (isset($_POST['partitaIva'])) {
        $userPI = $_POST["partitaIva"];
    }
    
    if (isset($_POST['tipologia'])) {
        $userType = $_POST["tipologia"];
    }
    
    if (isset($_POST['descrizione'])) {
        $userDescription = $_POST["descrizione"];
    }
    
    if (isset($_POST['immagine'])) {
        $userImage = $_POST["immagine"];
    }
    
    if (empty($userName) || !preg_match(Patterns::$NAME_GENERIC, $userName)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Nome non valido";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Nome non valido");
    }
    
    if (empty($userSurname) || !preg_match(Patterns::$NAME_GENERIC, $userSurname)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Cognome non valido";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Cognome non valido");
    }
    
    if (empty($userPhone) || !preg_match(Patterns::$TELEPHONE, $userPhone)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Recapito telefonico non valido";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Recapito telefonico non valido");
    }
    
    if (empty($userDateOfBirth) || !preg_match(Patterns::$GENERIC_DATE, $userDateOfBirth)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Data di nascita non valida";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Data di nascita non valida");
    }
    
    if (empty($userCity) || !preg_match(Patterns::$NAME_GENERIC, $userCity)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Nome citta' non valido";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Nome citta' non valido");
    }
    
    if (empty($userMail) || !preg_match(Patterns::$EMAIL, $userMail)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Email non valida";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Email non valida");
    }
    
    if (empty($userPassword) || !(isAlphanumeric($userPassword))) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Password non inserita";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Password non inserita");
    }
    
    if (empty($userPasswordRetyped) || ($userPasswordRetyped != $userPassword)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Le password devono essere uguali";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Le password devono essere uguali");
    }
    
    $utenteManager->createUser($userName, $userSurname, $userPhone, $userDateOfBirth, $userCity, $userMail, $userPassword);
}
