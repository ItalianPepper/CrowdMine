<?php

/**
 * Created by PhpStorm.
 * User: Giovanni Leo
 * Date: 06/12/2016
 * Time: 22:29
 */

    include_once MANAGER_DIR . "FeedbackManager.php";
    include_once MANAGER_DIR . "UtenteManager.php";
    include_once MODEL_DIR . "Utente.php";
    include_once EXCEPTION_DIR . "IllegalArgumentException.php";
    include_once CONTROL_DIR."FeedbackListObject.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $feedbackManger = new FeedbackManager();
        $userManager = new UtenteManager();

        if (isset($_POST["username"])) {
            $user = $userManager->getUtente($_POST["username"]);
            $feedbackListObj = new FeedbackListObject(1,"ciao","ciao","ciao","ciao","ciao",5);
            echo json_encode($feedbackListObj);
          //  echo "ok";

        } else {
            $_SESSION['toast-type'] = "error";
            $_SESSION['toast-message'] = "Errore nel caricamento della lista dei feedback ci scusiamo per il disagio";
            header("Location:" . DOMINIO_SITO . "/visitaProfiloUtente");
            throw new IllegalArgumentException("Errore nel caricamento della lista dei feedback ci scusiamo per il disagio");
        }

       //$feedbackList = $feedbackManger->getListaFeedback($user->getId());*/


    }