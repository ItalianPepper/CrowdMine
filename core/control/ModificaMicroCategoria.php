<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 08/12/2016
 * Time: 12:14
 */

include_once MODEL_DIR.'Utente.php';
include_once MODEL_DIR."MicroCategoria.php";
$manager = new MicrocategoriaManager();

if(isset($_SESSSION['user'])){
    $microCategoria = $_SESSSION['microCategoria'];
    $manager->editMicrocategoria($microCategoria);
    //Lo reindirizzo al control per visualizzare la pagina del profilo personale in modo che viene aggiornapa perchè ricaricata.
    header("/VisualizzaProfiloPersonale.php");
}
else{
    header("/home.php");
}