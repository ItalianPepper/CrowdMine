<?php
/**
 * Created by PhpStorm.
 * User: Giovanni Leo
 * Date: 28/12/2016
 * Time: 21:58
 */
    include_once CONTROL_DIR."ControlUtils.php";
    include_once MANAGER_DIR . "MicroCategoriaManager.php";
    include_once MODEL_DIR . "MicroCategoria.php";
    include_once EXCEPTION_DIR . "IllegalArgumentException.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $microId = null;
        if (isset($_POST["id-micro"])) {
            $microId = testInput($_POST["id-micro"]);

            $micro = new MicroCategoria("","",$microId);
            $microCategoriaManager = new MicroCategoriaManager();
            $microCategoriaManager->deleteMicrocategoria($micro);

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
        header("Location:" . getReferer(DOMINIO_SITO));
        throw new IllegalArgumentException("");
    }