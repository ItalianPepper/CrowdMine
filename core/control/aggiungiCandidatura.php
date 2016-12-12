<?php
include_once MANAGER_DIR . "/AnnuncioManager.php";

if(isset($_POST['descrizione']) && !empty($_POST['descrizione'])){
    $message = $_POST['descrizione'];
} else {
    $_SESSION['toast-type'] = "error";
    $_SESSION['toast-message'] = "Errore nella candidatura";
    header ("Location: " . DOMINIO_SITO. "/annuncioUtenteLoggato");
}
$manager = new AnnuncioManager(); /* Declaration and initialization a manager variable */

//$utente = unserialize($_SESSION['utente']); /* Declaration and initialization a user variable contain an unserialized version of a parameter who reference to user's info, given from session*/
//$idUtente = $utente->getId(); /* Declaration and initialization a user variable contain the user id */
$idUtente = 1;
$idAnnuncio = unserialize($_SESSION['idAnnuncio']); /* Declaration and initialization a user variable contain an unserialized version of a parameter who reference to annuncio's info, given from session */
$databean = new DateTime();
$data = $databean->format("Y-m-d");
$manager->addCandidatura($idAnnuncio, $idUtente, $message, $data);
$_SESSION['toast-type'] = "success";
$_SESSION['toast-message'] = "Candidatura inviata";
header("Location: " . DOMINIO_SITO . "/annuncioUtenteLoggato");

?>