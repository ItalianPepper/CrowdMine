<?php

include_once MANAGER_DIR ."/AnnuncioManager.php";
include_once MODEL_DIR . "/Commento.php";


if($_SERVER["REQUEST_METHOD"]=="POST") {

    $manager = new AnnuncioManager();
    echo $idAnnuncio = $_POST['idAnnuncio'];
    echo $message = $_POST['commento'];


    if (isset($_SESSION["listaCommenti"])) {
        $commenti = unserialize($_SESSION["listaCommenti"]);
        unset($_SESSION["listaCommenti"]);
        for ($i = 0; $i < count($commenti); $i++) {
            for ($j = 0; $j < count($commenti[$i]); $j++){
                if ($idAnnuncio == $commenti[$i][$j]->getIdAnnuncio()) {
                    $manager->commentAnnuncio($idAnnuncio, "1", $message, date("Y-m-d"));
                    header("Location: " . DOMINIO_SITO . "/getHome");
                    exit();
                } else {
                    $manager->commentAnnuncio($idAnnuncio, "1", $message, date("Y-m-d"));
                    header("Location: " . DOMINIO_SITO . "/getHome");
                    exit();
                }
            }
        }
    }
}





?>