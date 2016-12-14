<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 01/12/2016
 * Time: 21:47
 */
include_once MANAGER_DIR ."AnnuncioManager.php";
if(isset($_GET['id'])){
    $idAnnuncio = $_GET['id'];
    $managerAnnuncio = new AnnuncioManager();
    try {
        $managerAnnuncio->updateStatus($idAnnuncio,ELIMINATO);
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "Annuncio correttamente eliminato";
        header("Location:" . DOMINIO_SITO . "/annunciProprietari");
    } catch (ApplicationException $a){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Errore nel cancellare l'annuncio selezionato";
        header("Location:" . DOMINIO_SITO . "/annunciProprietari");
    }
}





?>