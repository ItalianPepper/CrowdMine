<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["option"])){

        if($_POST["option"]=="graphicsUser") {

            $result = stubPercentFeedback();
            header("Content-Type:application/json");
            echo json_encode($result);
        }
    }
}

function stubPercentFeedback(){
    $result = array(30,20);
    return $result;
}

