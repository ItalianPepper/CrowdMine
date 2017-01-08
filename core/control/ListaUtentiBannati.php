<?php
/**
 * Created by PhpStorm.
 * User: Hacca
 * Date: 19/12/2016
 * Time: 15:22
 */

include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';

include_once VIEW_DIR."ViewUtils.php";

$manager = new UtenteManager();
$utentiBannati = $manager->getAppealUtente();

include_once VIEW_DIR . "visualizzaUtentiBannati.php";
