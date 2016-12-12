<?php


include MANAGER_DIR . 'AnnuncioManager.php';

$manager = new AnnuncioManager(); /* Declaration and initialization a manager variable */

//qui mancano le implementazioni dei manager utente per la registrazione e la login
//$utente = unserialize($_SESSION['utente']); /* Declaration and initialization a user variable contain an unserialized version of a parameter who reference to user's info, given from session*/
//$idUtente = $utente->getId(); /* Declaration and initialization a user variable contain the user id */
$dataAggiuntaAiPreferiti = new DateTime();
$data = $dataAggiuntaAiPreferiti->format("Y-m-d H:i:s");
try{
    $manager->addToFavorites(15,1, $data);
    $_SESSION['toast-type'] = "success";
    $_SESSION['toast-message'] = "L'annuncio è stato aggiunto ai preferiti";
    header("Location:" . DOMINIO_SITO . "/annuncioUtenteLoggato");
} catch (ApplicationException $a){
    $_SESSION['toast-type'] = "error";
    $_SESSION['toast-message'] = "Errore nell'aggiungere l'annuncio ai preferiti";
    header("Location:" . DOMINIO_SITO . "/annuncioUtenteLoggato");
}




?>