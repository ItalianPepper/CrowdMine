<?php
/**
 * Created by PhpStorm.
 * User: LongSky
 * Date: 13/12/2016
 * Time: 14:56
 */
include_once MANAGER_DIR . 'FeedbackManager.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $feedback_manager = new FeedbackManager();
    if (isset($_POST["id"]) && isset($_POST["stato"])) {
        $feedback = $feedback_manager->getFeedbackById($_POST["id"]);
        if ($feedback->getStato() == ELIMINATO || $feedback->getStato() == AMMINISTRATORE ) {
            $return = array(
                'toastType' => "error",
                'toastMessage' => "Il feedback non è più disponibile o lo sta analizzando un amministratore"
            );
        } else {
            $feedback_manager->setStatus($_POST["id"], $_POST["stato"]);
            $return = array(
                'toastType' => "success",
                'toastMessage' => "Feedback risolto con successo"
            );
        }
        echo json_encode($return);

    } else {
        $return = array(
            'toastType' => "error",
            'toastMessage' => "Problema con la risoluzione del Feedback"
        );
        echo json_encode($return);
    }
}
?>