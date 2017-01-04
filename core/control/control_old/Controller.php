<?php
/**
 * 
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 30/05/16
 */

include_once CORE_DIR . "Config.php";
include_once EXCEPTION_DIR . "ConnectionException.php";

class Controller {

    /** @var  mysqli */
    private static $c;

    /**
     * @return mysqli
     * @throws ConnectionException
     */
    public static function getDB() {
        if (self::$c == NULL) {
            self::$c = new mysqli(Config::$DB_URL, Config::$DB_USER, Config::$DB_PASS, Config::$DB_NAME);
            if (self::$c->connect_error) {
                throw new ConnectionException("Connection failed: " . self::$c->connect_error);
            }
        }
        return self::$c;
    }
}

?>