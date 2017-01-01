<?php

include_once MANAGER_DIR . "FeedbackManager.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["option"]) && isset($_POST["idUser"])){

        $idUser= $_POST["idUser"];

        if($_POST["option"]=="graphicsUser") {

            $feedbackManager = new FeedbackManager();

            $result = $feedbackManager->getAveragesOfFeedbacks($idUser);

            header("Content-Type:application/json");
            echo json_encode($result);

        }else if($_POST["option"] == "tableUser"){

            $feedbackManager = new FeedbackManager();

            $result = $feedbackManager->getFeedbackMicroCategoriaStats($idUser);

            header("Content-Type:application/json");
            echo json_encode($result);

        }
    }
}
