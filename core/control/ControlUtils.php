<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 02/12/2016
 * Time: 13:32
 */

    /**
    * @param $data
    * @return string
     *
     *This function delete the white space, the "\" and html special character.
    */
    function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * @param $string
     * @return int
     * This function check if a string is alphanumeric
     * return -1 if the regular expression not is satisfied
     * else return 1
     */
    function isAlphanumeric($string)
    {
        return preg_match("/^[A-Za-z0-9_. ]*$/", $string);
    }

    /**
     * @param $string
     * @return int
     * This function check if a string is composed of only character
     * and return -1 if the regular expression not is satisfied else
     * return 1.
     *
     */
    function isAlpha($string)
    {
        return preg_match("/^[A-Za-z_. ]*$/", $string);
    }


    /**
     * get previous page reference
     *
     * @param $defaultURL
     * @param null $postField
     * @return string
     */
    function getReferer($defaultURL, $postField=null){

        $referer = isset($defaultURL)?$defaultURL:DOMINIO_SITO;

        if (isset($_SERVER['HTTP_REFERER']) AND trim($_SERVER['HTTP_REFERER']) != '') {
            $referer = htmlspecialchars($_SERVER['HTTP_REFERER']);
        } else {
            if (isset($_POST[$postField]))
                $referer = htmlspecialchars($_POST[$postField]);
        }

        return $referer;
    }

?>