<?php
/**
 * Created by PhpStorm.
 * User: Giovanni Leo
 * Date: 30/11/2016
 * Time: 17:26
 */
include_once MANAGER_DIR . "FeedbackManager.php";
include_once CONTROL_DIR . "ControlUtils.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $feedbackManager = new FeedbackManager();
    $feedbackName = null;
    $feedbackDescription = null;
    $feedbackRating = null;

    /**
     * Checking if the POST variable are septate
     */
    if (isset($_POST['feedback-name'])) {
        $feedbackName = $_POST["feedback-name"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo nome feedback non settato";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloUtente");
        throw new IllegalArgumentException("Campo titolo feedback non settato");
    }

    if (isset($_POST['feedback-textArea'])) {
        $feedbackDescription = $_POST["feedback-textArea"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo descrizione feedback non settato";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloUtente");
        throw new IllegalArgumentException("Campo descrizione feedback non settato");
    }
    if (isset($_POST['rating'])) {
        $feedbackRating = $_POST["rating"];

    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo rating non settato";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloUtente");
        throw new IllegalArgumentException("Campo rating non settato");
    }

    if (empty($feedbackName) || !preg_match(Patterns::$NAME_GENERIC, $feedbackName)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo  nome feedback contiene caratteri speciali o è vuoto";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloUtente");
        throw new IllegalArgumentException("Campo name non corretto");
    }

    if (empty($feedbackDescription) || !preg_match(Patterns::$NAME_GENERIC, $feedbackDescription) || strlen($feedbackDescription) > 300) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo descrizione feedback contine carratteri spaciali o è vuoto o ha una lunghezza di più di 300 caratteri";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloUtente");
        throw new IllegalArgumentException("Campo descrizione non corretto");
    }

    if (empty($feedbackRating)) {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Campo rating non corretto";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloUtente");
        throw new IllegalArgumentException("Campo rating non corretto");
    }

    //TODO method for check the collaboration between two user->Notifiche e Messaggi

    $data =  date("Y-m-d H:i:s");
    var_dump($data);


    $feedbackManager->createFeedback($id, $idAnnuncio, $idUtente, $feedbackDescription, $data, $feedbackRating);

}