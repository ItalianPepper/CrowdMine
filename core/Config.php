<?php

/**
 * Created by Netbeans.
 * User: Fabiano
 * Date: 30/05/16
 * Time: 09:09
 */

/**
 * Classe che contiene tutte configurazioni necessarie per il funzionamento del sistema
 */
class Config {

    public static $DB_URL = "localhost";
    public static $DB_NAME = "my_crowdmine";
    public static $DB_USER = "root";
    public static $DB_PASS = "";

    public static $PERMA_COOKIE = "permaCookie";

    /**
     *  Varie configurazioni
     */
    public static $MIN_PASSWORD_LEN = 8;    //minima lunghezza della password
    public static $TIPI_UTENTE = array('Cliente', 'Offerente');
    public static $LOG_LEVEL = 0; //0 Debug, 1 Info, 2 Warning, 3 Error
}