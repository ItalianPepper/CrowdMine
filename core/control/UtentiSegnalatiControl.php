<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 04/12/2016
 * Time: 16:13
 */


include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';

include_once VIEW_DIR."ViewUtils.php";

$userManager = new UtenteManager();

$usersReported = $userManager->getReportedUtente();

if($user->getRuolo()==RuoloUtente::AMMINISTRATORE)
$usersAdmin = $userManager->getAdminStateUtente();

include VIEW_DIR."/visualizzaUtentiSegnalati.php";
