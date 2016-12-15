<?php

/**
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 30/05/16
 */
class Patterns {
    public static $EMAIL = "/^[a-zA-Z0-9+&*-]+(?:\.[a-zA-Z0-9_+&*-]+)*@(?:[a-zA-Z0-9-]+\.)+[a-zA-Z]{2,7}$/";
    public static $MATRICOLA = "/^[0-9]{2,12}$/";
    public static $NAME_GENERIC = "/^[a-zA-Z0-9_ èàòù]+$/";
    public static $TELEPHONE = "/^[0-9]{5,10}$/";
    public static $GENERIC_DATE = "/([0-9]{2}\/[0-9]{2}\/[0-9]{4})/";
    public static $MD5_SLASH = "/^[a-f0-9]{32}\|[a-f0-9]{32}$/";
    //^: anchored to beginning of string
    //\S*: any set of characters
    //(?=\S{8,}): of at least length 8
    //(?=\S*[a-z]): containing at least one lowercase letter
    //(?=\S*[A-Z]): and at least one uppercase letter
    //(?=\S*[\d]): and at least one number
    //$: anchored to the end of the string
    public static $PASSWORD1 = '/[^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[‌​\d])\S*$]/';
    /*Between Start -> ^
    And End -> $
    of the string there has to be at least one number -> (?=.*\d)
    and at least one letter -> (?=.*[A-Za-z])
    and it has to be a number, a letter or one of the following: !@#$% -> [0-9A-Za-z!@#$%]
    and there have to be at least 8 characters -> {8,}*/
    public static $PASSWORD = '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,}$/';

}