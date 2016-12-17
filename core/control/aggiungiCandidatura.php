<?php
include_once MANAGER_DIR . "/AnnuncioManager.php";
$descrizione = null;
$idAnnuncio = null;
$idUtente = null;
$data = null;
if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_POST['descrizione'])) {
        $descrizione = $_POST["descrizione"];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "campo descrizione non settato";
        header("Location: " . DOMINIO_SITO . "/annunciPreferiti");
    }
    if (empty($descrizione) || !preg_match(Patterns::$NAME_GENERIC, $descrizione)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "campo descrizione contiene caratteri speciali o è vuoto";
        header("Location:" . DOMINIO_SITO . "/annunciPreferiti");
    }

    $manager = new AnnuncioManager(); /* Declaration and initialization a manager variable */

//$utente = unserialize($_SESSION['utente']); /* Declaration and initialization a user variable contain an unserialized version of a parameter who reference to user's info, given from session*/
//$idUtente = $utente->getId(); /* Declaration and initialization a user variable contain the user id */
    //utente = unserialize($_SESSION["user"]);
    //$idUtente = utente->getId();
    $idUtente = 1;
    $idAnnuncio = $_POST["idAnnuncio"];
    $databean = new DateTime();
    $data = $databean->format("Y-m-d H:i:s");
    try {
        $manager->addCandidatura($idAnnuncio, $idUtente, $descrizione, $data);
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "Candidatura inviata";
        header("Location: " . DOMINIO_SITO . "/annunciPreferiti");
    } catch (ApplicationException $a){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Candidatura già inviata";
        header("Location: " . DOMINIO_SITO . "/annunciPreferiti");
    }


}
?>