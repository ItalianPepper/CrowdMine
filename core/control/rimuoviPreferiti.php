<?php


include_once MANAGER_DIR . 'AnnuncioManager.php';

echo "Annuncio rimosso dai preferiti!";

$manager = new AnnuncioManager(); /* Declaration and initialization a manager variable */

//qui mancano le implementazioni dei manager utente per la registrazione e la login
//$utente = unserialize($_SESSION['utente']); /* Declaration and initialization a user variable contain an unserialized version of a parameter who reference to user's info, given from session*/
//$idUtente = $utente->getId(); /* Declaration and initialization a user variable contain the user id */
try{
    $manager->removeFromFavorites(15,1);
    $_SESSION['toast-type'] = "success";
    $_SESSION['toast-message'] = "L'annuncio è stato rimosso dai preferiti";
    header("Location:" . DOMINIO_SITO . "/annuncioUtenteLoggato");
} catch (ApplicationException $a){
    $_SESSION['toast-type'] = "error";
    $_SESSION['toast-message'] = "Errore nel rimuovere l'annuncio dai preferiti";
    header("Location:" . DOMINIO_SITO . "/annuncioUtenteLoggato");
}


?>