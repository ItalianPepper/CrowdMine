<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 15/01/2017
 * Time: 10:23
 */
include_once MANAGER_DIR."UtenteManager.php";
include_once CONTROL_DIR . "ControlUtils.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $utenteManger = new UtenteManager();
    $nuovoNumero = null;
    if(isset($_POST["nuovoNumero"])){
        $nuovoNumero =$_POST["nuovoNumero"];

    }
    else
    {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo nuovo numero non settato";
        header("Location:" .getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Campo nuovo numero non settato");
    }

    if (empty($nuovoNumero) || !preg_match(Patterns::$TELEPHONE, $nuovoNumero))
    {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Il campo è vuoto o non è un numero di telefono.Deve avere 10 cifre.";
        header("Location:" .getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("Il campo è vuoto o non è un numero di telefono.Deve avere 10 cifre.\"");
    }
    else
    {
        $user->setTelefono($nuovoNumero);
        $utenteManger->updateUtente($user);
        $_SESSION['user'] = serialize($user);
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "Il numero è stato cambiato con successo.";
        header("Location:" .getReferer(DOMINIO_SITO));
    }

}