<?php
include_once MANAGER_DIR . "/AnnuncioManager.php";
include_once MANAGER_DIR . "/MessaggioManager.php";

$idUtente = $user->getID();
$messaggio = null;
$x = null;

if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_POST['messaggio'])) {
        $messaggio = $_POST["messaggio"];
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "campo messaggio non settato";
        include_once CONTROL_DIR . "visualizzaHome.php";
    }

    $manager = new AnnuncioManager(); /* Declaration and initialization a manager variable */
    $manager_msg = new MessaggioManager(); /* Declaration and initialization a manager variable */

    $idUtente = $_POST["idUtente"];
    $databean = new DateTime();
    $data = $databean->format("Y-m-d H:i:s");
 
    if ($x == null) {
        try {
            //$manager->addCandidatura($idUtente, $idUtente, $messaggio, $data);
            $manager_msg->sendMessaggio(null, $messaggio, "", 0, $user->getID(), $idUtente);
            //$manager_msg->sendMessaggio(null, $messaggio, "", 0, $idUtente,    );
            $_SESSION['toast-type'] = "success";
            $_SESSION['toast-message'] = "Messaggio Inviato";
            include_once CONTROL_DIR . "visualizzaHome.php";
        } catch (ApplicationException $a) {
            $_SESSION['toast-type'] = "error";
            $_SESSION['toast-message'] = "Problemi con l'invio del messaggio";
            include_once CONTROL_DIR . "visualizzaHome.php";
        }
    }
}
?>