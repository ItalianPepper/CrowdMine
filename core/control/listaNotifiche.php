<?php
/**
 * Created by PhpStorm.
 * User: Dario Galiani
 * Date: 13/12/2016
 * Time: 10:44
 */

include_once MANAGER_DIR . "UtenteManager.php";
include_once MANAGER_DIR . "NotificaManager.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once MODEL_DIR . "Notifica.php";
include_once UTILS_DIR . "ErrorUtils.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $utenteManager = new UtenteManager();
    $notificaManager = new NotificaManager();

    $res = $utenteManager->findUtenteByName($user->getId());
    $listaNotifiche = $notificaManager->loadFromDispatcher($res->getId());
    echo $listaNotifiche;

    header("Content/application: json");
    echo json_encode($listaNotifiche);

}else{
    $_SESSION['toast-type'] = "error";
    $_SESSION['toast-message'] = ErrorUtils::$LISTA_NOTIFICHE_VUOTA;
    header("location:" . DOMINIO_SITO . "/listaNotificheUtente");
    throw new IllegalArgumentException(ErrorUtils::$LISTA_NOTIFICHE_VUOTA);
}