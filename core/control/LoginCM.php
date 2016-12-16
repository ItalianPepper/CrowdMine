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
    $userMail = null;
    $userPassword = null;
    
    if (isset($_POST['inputEmail'])) {
        $userMail = $_POST["inputEmail"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo email non settato";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Campo email non settato");
    }
    if (isset($_POST['inputPassword'])) {
        $userPassword = $_POST["inputPassword"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo password non settato";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloUtente");
        throw new IllegalArgumentException("Campo password non settato");
    }
    
    if (empty($userMail) || !preg_match(Patterns::$EMAIL, $userMail)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Email non valida";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Email non valida");
    }
    
    if (empty($userPassword) || !preg_match(Patterns::$PASSWORD, $userPassword)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Password non valida";
        header("Location:" . DOMINIO_SITO . "/auth");
        throw new IllegalArgumentException("Password non valida");
    }
    
    $user = $utenteManager->login($userMail, $userPassword);
    
    if($user != false){
        $_SESSION['user'] = serialize($user);
        $_SESSION['loggedin'] = true; 
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "Bentornato ".$user->getNome()." :)";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
