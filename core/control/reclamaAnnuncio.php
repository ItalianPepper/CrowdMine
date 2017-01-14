<?php
include_once MANAGER_DIR . 'AnnuncioManager.php';
include_once MODEL_DIR . "/Annuncio.php";
include_once CONTROL_DIR . "ControlUtils.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(isset($_POST["idAnnuncio"])){

        $id = $_POST["idAnnuncio"];
        $annuncioManager = new AnnuncioManager();
        $annuncioManager->sendClaim($id,null);

        header("Location:" .getReferer(DOMINIO_SITO));
    }

}