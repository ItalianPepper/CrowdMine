<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 04/12/2016
 * Time: 16:13
 */


include_once MODEL_DIR . 'Utente.php';
include_once MANAGER_DIR . 'UtenteManager.php';

//$user = unserialize($_SESSION['user']);

$userManager = new UtenteManager();
//$usersReported = $userManager->getReportedUtente();

$user1 = new Utente("id1", "nome1", "cognome1", "telefono1", "datanascita1", "citta1", "email1", "password1", "stato1", "ruolo1", "immagineProfilo1");
$user2 = new Utente("id2", "nome2", "cognome2", "telefono2", "datanascita2", "citta2", "email2", "password2", "stato2", "ruolo2", "immagineProfilo2");
$user3 = new Utente("id2", "nome2", "cognome2", "telefono2", "datanascita2", "citta2", "email2", "password2", "stato2", "ruolo2", "immagineProfilo2");
$user4 = new Utente("id2", "nome2", "cognome2", "telefono2", "datanascita2", "citta2", "email2", "password2", "stato2", "ruolo2", "immagineProfilo2");
$user5 = new Utente("id2", "nome2", "cognome2", "telefono2", "datanascita2", "citta2", "email2", "password2", "stato2", "ruolo2", "immagineProfilo2");
$user6 = new Utente("id2", "nome2", "cognome2", "telefono2", "datanascita2", "citta2", "email2", "password2", "stato2", "ruolo2", "immagineProfilo2");


$usersReported = array($user1, $user2, $user3, $user4, $user5, $user6);

$serUserReported = serialize($usersReported);
$_SESSION['utentiSegnalati'] = $serUserReported;

//header("Location:" . DOMINIO_SITO . "/visualizzaUtentiSegnalati");
