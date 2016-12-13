<?php
include_once MANAGER_DIR . "/AnnuncioManager.php";

if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_POST['descrizione']) && !empty($_POST['descrizione'])) {
        echo $message = $_POST['descrizione'];
        echo $idAnnuncio = $_POST["idAnnuncio"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Errore nella candidatura";
        header("Location: " . DOMINIO_SITO . "/annuncioUtenteLoggato");
    }
    $manager = new AnnuncioManager(); /* Declaration and initialization a manager variable */

//$utente = unserialize($_SESSION['utente']); /* Declaration and initialization a user variable contain an unserialized version of a parameter who reference to user's info, given from session*/
//$idUtente = $utente->getId(); /* Declaration and initialization a user variable contain the user id */
    $idUtente = 1;
    $databean = new DateTime();
    $data = $databean->format("Y-m-d");
    //$manager->addCandidatura($idAnnuncio, $idUtente, $message, $data);
    $arrayCandidature = array();
    $arr = array();
    array_push($arr,  new Candidatura(5,1,$idAnnuncio,$message,"0000-00-00 00:00:00","2016-12-12 00:00:00","inviata","non_valutato"));
    array_push($arrayCandidature, $arr);


    $_SESSION['toast-type'] = "success";
    $_SESSION['toast-message'] = "Candidatura inviata";


    header("Location: " . DOMINIO_SITO . "/inserisciCandidatura");



}
?>