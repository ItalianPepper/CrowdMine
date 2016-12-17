<?php

include_once MANAGER_DIR ."/AnnuncioManager.php";
include_once MODEL_DIR . "/Commento.php";


if($_SERVER["REQUEST_METHOD"]=="POST") {

    $manager = new AnnuncioManager();
    $idAnnuncio = $_POST['idAnnuncio'];
    $commento = $_POST['commento'];
    $idUtente = 1;
    $dataPubblicazione = new DateTime();
    $data = $dataPubblicazione->format("Y-m-d H:i:s");
    try{
        $manager->commentAnnuncio($idAnnuncio,$idUtente,$commento,$data);
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "Commento aggiunto";
        header("Location:" . DOMINIO_SITO . "/annunciProprietari");
    } catch (ApplicationException $a){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Commento rifiutato";
        header("Location:" . DOMINIO_SITO . "/annunciProprietari");

    }
}





?>