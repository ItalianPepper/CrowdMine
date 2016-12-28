<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 16/12/2016
 * Time: 00:30
 */
include_once CONTROL_DIR.'ControlUtils.php';
include_once MANAGER_DIR.'UtenteManager.php';
include_once MANAGER_DIR.'MacroCategoriaManager.php';
include_once MANAGER_DIR.'MicroCategoriaManager.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
     * Checking if the POST variable are septate
     */
    if (isset($_POST['getIdMacro'])) {
        $macroId = testInput($_POST['getIdMacro']);
    } else {
        $_SESSION['toast-type'] = "error";
        $_SESSION['toast-message'] = "Id aggiungi Macro non settata";
        header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
        throw new IllegalArgumentException("Id aggiungi Macro non settata");
    }

    $userManager = new UtenteManager();
    $macroManager = new MacroCategoriaManager();
    $microManager = new MicrocategoriaManager();

    //search if macro is already setted for the user
    $macro = $macroManager->getUserMacro($user->getId(),$macroId);

    if($macro == false) {
        //insert special micro (same name as macro)
        $micro = $microManager->getSpecialMicro($macroId);

        if($micro != false){
            $userManager->addMicroCategoria($user,$micro);
            $_SESSION['toast-type'] = "success";
            $_SESSION['toast-message'] = "Macrocategoria aggiunta";
        }

    }

    header("Location:" . DOMINIO_SITO . "/ProfiloPersonale");
}