<?php
/**
 * Created by PhpStorm.
 * User: Giovanni Leo
 * Date: 24/12/2016
 * Time: 12:38
 */
include_once MANAGER_DIR . 'FeedbackManager.php';
include_once MODEL_DIR .'FeedbackListObject.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["feedbackID"]))
    {
        $feedbackID=$_GET["feedbackID"];
        $feddbackManager = new FeedbackManager();
        $feedbackListObject = $feddbackManager->getFeedbackByIdLO($feedbackID,1);
        $encodedFeedbackListObject = json_encode($feedbackListObject);
        include VIEW_DIR."viewSingleFeedback.php";

    }
}