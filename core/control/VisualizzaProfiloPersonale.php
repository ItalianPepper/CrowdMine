<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 08/12/2016
 * Time: 11:29
 */

include_once MODEL_DIR.'Utente.php';
$manager = new UtenteManager();

if(isset($_SESSSION['user'])){
    header("/visitaProfiloPersonale.php");
}
else{
    header("/home.php");
}