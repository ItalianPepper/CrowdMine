<?php
include_once MANAGER_DIR . "/AnnuncioManager.php";
include_once MANAGER_DIR . "/MessaggioManager.php";

$idUtente = $user->getID();
$descrizione = null;
$x = null;

if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_POST['descrizione'])) {
        $descrizione = $_POST["descrizione"];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "campo descrizione non settato";
        include_once CONTROL_DIR . "visualizzaHome.php";
    }


    $manager = new AnnuncioManager(); /* Declaration and initialization a manager variable */
    $manager_msg = new MessaggioManager(); /* Declaration and initialization a manager variable */

    $idAnnuncio = $_POST["idAnnuncio"];
    $databean = new DateTime();
    $data = $databean->format("Y-m-d H:i:s");
    $candidature = $manager->getAnnuncioWithCandidati($idAnnuncio);

    for ($i = 0; $i <count($candidature); $i++) {
        if ($candidature[$i]->getIdUtente() == $idUtente) {
            $_SESSION['toast-type'] = "error";
            $_SESSION['toast-message'] = "Candidatura gi‡ inviata";
            $x = 1;
            include_once CONTROL_DIR . "visualizzaHome.php";
        }
    }

    if ($x == null) {
        try {
            //$manager->addCandidatura($idAnnuncio, $idUtente, $descrizione, $data);
            $manager_msg->createCandidatura(null, $idUtente, $idAnnuncio, $descrizione, "", "");
            $manager_msg->sendMessaggio(null, $descrizione, "", 0, $user->getID(), $manager->getAnnuncio($idAnnuncio)->getIdUtente());
            //$manager_msg->sendMessaggio(null, $descrizione, "", 0, $idUtente,    );
            $_SESSION['toast-type'] = "success";
            $_SESSION['toast-message'] = "Candidatura inviata";
            include_once CONTROL_DIR . "visualizzaHome.php";
        } catch (ApplicationException $a) {
            $_SESSION['toast-type'] = "error";
            $_SESSION['toast-message'] = "Problemi con l'invio della candidatura";
            include_once CONTROL_DIR . "visualizzaHome.php";
        }
    }
}
?>