<?php
/**
 * Created by PhpStorm.
 * User: Dario Galiani
 * Date: 14/01/2017
 * Time: 12:57
 */

include_once MANAGER_DIR ."/AnnuncioManager.php";
include_once CONTROL_DIR."ControlUtils.php";

if($_SERVER["REQUEST_METHOD"]=="POST") {

    $manager = new AnnuncioManager();
    echo $idCommento = $_POST['idCommento'];
    $oldStatus=null;
    $stato='eliminato';
    $manager->updateStatusCommento($idCommento, $stato, $oldStatus);
    header("Location: " .getReferer(DOMINIO_SITO));
}