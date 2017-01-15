<?php

/**
 * Classe di supporto per la gestione delle stringhe
 *
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 30/05/16
 */
include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . "UtenteManager.php";

class Permissions extends RuoloUtente{
    const BANNED_ONLY = "banned_only";
    const NOT_LOGGED_ONLY = "not_logged_only";
    const ALL = "all";
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
     * @param String $level Required role for access, ex. MODERATORE
     * @param string $redirect if user does not match role, redirect to this URL
     * @param string $notUpdate boolean flag, if true do not retrieve userdata from DB
     * @return mixed instance of Utente, if user is logged
     */
    public static function checkPermission($level, $redirect=null, $notUpdate = null)
    {

        /*default value for redirect, authentication page*/
        $redirect = ($redirect == null) ? DOMINIO_SITO . "/auth" : $redirect;
        $bannedRedirect = DOMINIO_SITO . "/banned";

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

            //redirect to home page, user is already logged*/
            $redirect = DOMINIO_SITO . "/";
            $user = unserialize($_SESSION['user']);

            if($notUpdate!=null) {
                //update logged user data from db
                $utenteManager = new UtenteManager();
                $user = $utenteManager->findUtenteById($user->getId());
            }
            $stato = $user->getStato();

            /*if user is not enabled, redirect to ban page*/
            if($stato != StatoUtente::ATTIVO && $stato != StatoUtente::SEGNALATO && $stato != StatoUtente::AMMINISTRATORE && $stato != StatoUtente::REVISIONE){

                if($level == Permissions::BANNED_ONLY ){
                    return $user;
                }else {
                    header('Location: ' . $bannedRedirect);
                    exit();
                }
            }

            /*here user is not banned, so launch redirect if ban is required*/
            if($level == Permissions::BANNED_ONLY ){
                header('Location: ' . $redirect);
                exit();
            }

            /*matching between user role and required role*/
            if ($user->getRuolo() == $level || $level == Permissions::ALL) {
                return $user;
            }

            /*extra permissions for each role*/
            switch ($user->getRuolo()) {
                /*admin has access to all pages*/
                case RuoloUtente::AMMINISTRATORE:
                    return $user;
                    break;
                /*moderator can access to logged user's pages*/
                case RuoloUtente::MODERATORE:
                    if ($level == Permissions::UTENTE)
                        return $user;
                    break;
            }

            /*no matchings, access denied*/
            header('Location: ' . $redirect);
            exit();

        }

        /*here user is not logged*/
        if($level!=Permissions::NOT_LOGGED_ONLY && $level!=Permissions::ALL)
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