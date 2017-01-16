<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 16/12/2016
 * Time: 16:10
 */
include_once MANAGER_DIR . "AnnuncioManager.php";
if(isset($_GET["id"])){
    $idCommento = $_GET["id"];
    $managerAnnuncio = new AnnuncioManager();
    try{
        $managerAnnuncio->reportCommento($idCommento);
        $_SESSION['toast-type'] = "success";
        $_SESSION['toast-message'] = "Segnalazione inviata";
        header("Location:" . DOMINIO_SITO );
    } catch (ApplicationException $a){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Segnalazione non inviata";
        header("Location:" . DOMINIO_SITO);
    }
} else {
    echo "qui ci va la pagina 404 di errore";
}

?>