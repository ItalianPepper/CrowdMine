<?php
/**
 * Created by PhpStorm.
 * User: Giovanni Leo
 * Date: 28/12/2016
 * Time: 21:58
 */
    include_once CONTROL_DIR."ControlUtils.php";
    include_once MANAGER_DIR . "MacroCategoriaManager.php";
    include_once MODEL_DIR . "MacroCategoria.php";
    include_once EXCEPTION_DIR . "IllegalArgumentException.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $macroName = null;
        $macroId = null;
        if (isset($_POST["id-macro"]) && isset($_POST["nome-macro"])) {
            if (!empty($_POST["id-macro"]) && !empty($_POST["nome-macro"])) {
                $macroName = $_POST["nome-macro"];
                $macroId = $_POST["id-macro"];

                $macroCategoria = new MacroCategoria($macroId, $macroName);
                $macroCategoriaManager = new MacroCategoriaManager();
                $macroCategoriaManager->deleteMacrocategoria($macroCategoria);

                $_SESSION['toast-type'] = "success";
                $_SESSION['toast-message'] = "MacroCategoria cancellata con successo";
                header("Location:" . getReferer(DOMINIO_SITO));
            } else {
                $_SESSION['toast-type'] = "error";
                $_SESSION['toast-message'] = "Errore inaspettato ci scusiamo per il disagio";
                header("Location:" . getReferer(DOMINIO_SITO));
                throw new IllegalArgumentException("Errore inaspettato ci scusiamo per il disagio");
            }

        } else {
            $_SESSION['toast-type'] = "error";
            $_SESSION['toast-message'] = "Errore inaspettato ci scusiamo per il disagio";
            header("Location:" . getReferer(DOMINIO_SITO));
            throw new IllegalArgumentException("Errore inaspettato ci scusiamo per il disagio");
        }

    } else {
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("");
    }