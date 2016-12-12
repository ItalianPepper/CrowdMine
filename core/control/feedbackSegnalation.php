<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 12/12/2016
 * Time: 15:26
 */
include_once MANAGER_DIR . "FeedbackManager.php";
include_once MANAGER_DIR . "UtenteManager.php";
include_once MODEL_DIR . "Feedback.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once MODEL_DIR . "FeedbackListObject.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $feedbackManger = new FeedbackManager();

    if (isset($_POST["feedbackID"])) {
        $feedbackID = 0;//intval($_POST["feedbackID"]);
        if ($feedbackID == 0) {
            $return =array(
                'toastType' => "error",
                'toastMessage' => "Errore nella segnalazione ci scusimo per il disagio"
            );
            echo json_encode($return);
        }
        else {
            // $feedback = $feedbackManger->getFeedbackById($feedbackID);
            //$feedback->setStato(SEGNALATO);
            $return =array(
                'toastType' => "success",
                'toastMessage' => "Feedback Segnalato con successo"
            );
            echo json_encode($return);
        }
    }
    else {
        $return =array(
            'toastType' => "error",
            'toastMessage' => "Errore nella segnalazione ci scusimo per il disagio"
        );
        echo json_encode($return);
    }
}