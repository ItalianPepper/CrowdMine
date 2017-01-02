<?php
/**
 * Created by PhpStorm.
 * User: Utente
 * Date: 02/01/2017
 * Time: 20:39
 */
include_once MANAGER_DIR . "MicrocategoriaManager.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["macroId"])){

        $idMacro =$_POST["macroId"];

        $microCategoriaManager = new MicrocategoriaManager();
        $microArray = $microCategoriaManager->getMicrosByMacroSerialized($idMacro);
        echo json_encode($microArray);
    }
  else
    {
        $return =array(
            'toastType' => "error",
            'toastMessage' => "Errore inaspettato durante l'ordinamento"
        );
        echo json_encode($return);
    }

}