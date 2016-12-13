<?php
/**
 * Created by PhpStorm.
 * User: Lino
 */


include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';

//$user = unserialize($_SESSION['user']);

//$user.setStato(StatoUtente::AMMINISTRATORE);

//$userManager = new UtenteManager();
//$userManager->updateUtente($user);


header("Location:" . DOMINIO_SITO . "/visualizzaUtentiSegnalati");
