<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 18/12/2016
 * Time: 23:44
 */
include_once MANAGER_DIR.'UtenteManager.php';
include_once MODEL_DIR.'MicroCategoria.php';
include_once MANAGER_DIR.'MicrocategoriaManager.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$user = unserialize($_SESSION["utente"]);
    $userManager = new UtenteManager();
    $microManager = new MicrocategoriaManager();
    /**
     * Checking if the POST variable are septate
     */
    if (isset($_POST['idMicro']) && !isset($_POST['newMicro'])) {
        $microId = strip_tags(htmlspecialchars(addslashes($_POST['idMicro'])));
    } else if (isset($_POST['newMicro'])){
        if(!isset($_POST['idMacro'])){
            $_SESSION['toast-type'] = "error";
            $_SESSION['toast-message'] = "Macro non settata";
            header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
            throw new IllegalArgumentException("Macro non settata");
        } else if(empty($_POST['idMacro'])){
            $_SESSION['toast-type'] = "error";
            $_SESSION['toast-message'] = "Macro id empty";
            header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
            throw new IllegalArgumentException("Macro id empty");
        } else if(empty($_POST['newMicro'])) {
            $_SESSION['toast-type'] = "error";
            $_SESSION['toast-message'] = "Nome nuova Micro empty";
            header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
            throw new IllegalArgumentException("Nome nuova Micro empty");
        } else {
            $micro = new MicroCategoria(strip_tags(htmlspecialchars(addslashes($_POST['idMacro']))),
                strip_tags(htmlspecialchars(addslashes($_POST['mewMicro']))));
        }
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id aggiungi Micro non settata";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("Id aggiungi Micro non settata");
    }

    if (empty($microId) && empty($micro)){
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id aggiungi micro empty";
        header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
        throw new IllegalArgumentException("Id aggiungi micro empty");
    } else if(empty($micro)) {
       // $micro = $microManager->findMicrocategoriaById($microId);
    }

    //$userManager->addMicroCategoria($user, $microId);

    header("Location:" . DOMINIO_SITO . "/visitaProfiloPersonale");
}