<?php

/**
 * Classe di supporto per la gestione delle stringhe
 *
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 30/05/16
 */
include_once MODEL_DIR . 'Utente.php';

class Permissions extends RuoloUtente{
    const NOT_LOGGED_ONLY = "not_logged_only";
}

class StringUtils {

    private static $IV = "3562567812345678";
    private static $ENC_PASS = "7463847812345678";

    public static function encrypt($string) {
        return openssl_encrypt($string, "aes128", self::$ENC_PASS, false, self::$IV);
    }

    public static function decrypt($string) {
        return openssl_decrypt($string, "aes128", self::$ENC_PASS, false, self::$IV);
    }

    /**
     * @param Permissions $level Required role for access, ex. MODERATORE
     * @param string $redirect if user does not match role, redirect to this URL
     * @return mixed instance of Utente, if user is logged
     */
    public static function checkPermission($level, $redirect=null) {

        /*default value for redirect, authentication page*/
        $redirect = ($redirect==null)? DOMINIO_SITO . "/auth":$redirect;
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

            //redirect to home page, user is already logged*/
            $redirect = DOMINIO_SITO . "/";
            $user = unserialize($_SESSION['user']);
            /*matching between user role and required role*/
            if ($user->getRuolo() == $level) {
                return $user;
            }

            /*extra permissions for each role*/
            switch($user->getRuolo()){
                /*admin has access to all pages*/
                case RuoloUtente::AMMINISTRATORE:
                    return $user;
                    break;
                /*moderator can access to logged user's pages*/
                case RuoloUtente::MODERATORE:
                    if($level == Permissions::UTENTE)
                        return $user;
                break;
            }

            header('Location: ' . $redirect);
        }


        if($level!=Permissions::NOT_LOGGED_ONLY)
            header('Location: ' . $redirect);

    }

    /**
     * Funzione verifica se l'ip appartiene alla maschera
     * @param $ip String es. 192.168.1.22
     * @param $maschera String es. 192.168.*.*
     * @return bool
     */
    public static function compareIP($ip, $maschera) {
        if (!preg_match("/^([\d]{1,3}|\*)\.([\d]{1,3}|\*)\.([\d]{1,3}|\*)\.([\d]{1,3}|\*)$/i", $maschera)) {
            return false;
        }
        $pies = explode("*", $maschera);
        $prefix = $pies[0];
        return substr($ip, 0, strlen($prefix)) === $prefix;
    }
}