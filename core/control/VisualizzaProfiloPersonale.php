<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 08/12/2016
 * Time: 11:29
 */


if(isset($_SESSSION['user'])){
    header ("location: ".DOMINIO_SITO.DIRECTORY_SEPARATOR."visitaProfiloPersonale");
}
else{
    header ("location: ".DOMINIO_SITO);
}