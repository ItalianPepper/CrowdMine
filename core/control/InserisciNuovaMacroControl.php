<?php
/**
 * Created by PhpStorm.
 * User: Giovanni Leo
 * Date: 28/12/2016
 * Time: 23:00
 */
include_once CONTROL_DIR . "ControlUtils.php";
include_once MANAGER_DIR . "MacroCategoriaManager.php";
include_once MANAGER_DIR . "MicrocategoriaManager.php";
include_once MODEL_DIR . "MacroCategoria.php";
include_once MODEL_DIR . "MicroCategoria.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $macroName = null;

    if (isset($_POST["nuova-macro-nome"])) {
        if (!empty($_POST["nuova-macro-nome"])) {
            $macroName = $_POST["nuova-macro-nome"];
            if (preg_match(Patterns::$NAME_GENERIC, $macroName)) {
                $macroCategoriaManager = new MacroCategoriaManager();
                $microManager = new MicrocategoriaManager();
                $idNewMacro = $macroCategoriaManager->addMacrocategoria($macroName);
                $micro = new Microcategoria( $idNewMacro,$macroName);
                $microManager->addMicrocategoria($micro);

                $_SESSION['toast-type'] = "success";
                $_SESSION['toast-message'] = "MacroCategoria inserita con successo";
                header("Location:" . getReferer(DOMINIO_SITO));
            } else {
                $_SESSION['toast-type'] = "error";
                $_SESSION['toast-message'] = "Sono Presenti caratteri speciali";
                header("Location:" . getReferer(DOMINIO_SITO));
                throw new IllegalArgumentException("Campo non settato correttamente");
            }
        } else {
            $_SESSION['toast-type'] = "error";
            $_SESSION['toast-message'] = "Campo non settato correttamente";
            header("Location:" . getReferer(DOMINIO_SITO));
            throw new IllegalArgumentException("Campo non settato correttamente");
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