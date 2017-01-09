<?php
/**
 * Created by PhpStorm.
 * User: Giovanni Leo
 * Date: 14/12/2016
 * Time: 10:26
 */

include_once MANAGER_DIR . "FeedbackManager.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedbackManager = new FeedbackManager();
    $userValID = null;
    $optionValue = null;

    if(isset($_POST["id"]) && isset($_POST["optionValue"]))
    {
        $userValID =$_POST["id"];
        $optionValue = $_POST["optionValue"];
        if (intval($userValID)!=0 &&(strcmp($optionValue,"data")==0 ||strcmp($optionValue,"nome")==0 ||
                strcmp($optionValue,"valutazione")==0))
        {
            $feedbackList = $feedbackManager->sortListaFeedback($userValID,$optionValue);
            echo json_encode($feedbackList);
        }
        else
        {
            header("Status: 404 Not Found");
        }
    }
    else
    {
        $return =array(
            'toastType' => "error",
            'toastMessage' => "Errore inaspettato durante l'ordinamento"
        );
        echo json_encode($return);
    }
}