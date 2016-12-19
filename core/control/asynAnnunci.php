<?php
/**
 * Created by PhpStorm.
 * User: Lino
 * Date: 17/12/2016
 * Time: 18:50
 */

include_once MANAGER_DIR . "MacroCategoriaManager.php";
include_once MANAGER_DIR . "MicrocategoriaManager.php";
include_once MODEL_DIR . "MacroCategoria.php"; // questo model va tolto, serve solo per provare lo stub
include_once MANAGER_DIR ."AnnuncioManager.php";
include_once MANAGER_DIR ."UtenteManager.php";

if($_SERVER["REQUEST_METHOD"] == "GET") {
   // $user = unserialize($_SESSION['user']);

    if($_GET["nome"]=="micro"){
        $idMacro = $_GET["idMacro"];
        $microManager = new MicrocategoriaManager();
       //$microList = $microManager->getListaMicrocategorieByIdMacroCategoria($idMacro);

        //INIZIO STUB
        $microUtenteList = array();
        $microList = array();

        switch ($idMacro) {
            case 'idMacro0':
                $microUtente = new MicroCategoria($idMacro, "nomeMicro0", "idMicro0");
                break;
            case 'idMacro1':
                $microUtente = new MicroCategoria($idMacro, "nomeMicro1", "idMicro1");
                break;
            case 'idMacro2':
                $microUtente = new MicroCategoria($idMacro, "nomeMicro2", "idMicro2");
                break;
            case 'idMacro3':
                $microUtente = new MicroCategoria($idMacro, "nomeMicro3", "idMicro3");
                break;
            case 'idMacro4':
                $microUtente = new MicroCategoria($idMacro, "nomeMicro4", "idMicro4");
                break;
            default:
                ;
        }
        array_push($microUtenteList, $microUtente);

        for ($i=0; $i<10; $i++){
            $micro = new MicroCategoria("idMacro".$i, "nomeMicro".$i, "idMicro".$i);
            array_push($microList, $micro);
        }
        // FINE STUB


        $utenteManager = new UtenteManager();
       //$microUtenteList = $utenteManager->findMicroUtente($user->getId());
        if(count($microList)>0 && count($microUtenteList)>0) {
            $toReturn = "<option value='' selected>Seleziona la Microcategoria</option>";
            foreach ($microList as $micro) {
                if(array_search($micro, $microUtenteList)!==FALSE)
                    $toReturn = $toReturn . "<option value=" . $micro->getId() . ">" . $micro->getNome() . "</option>";
            }
            echo $toReturn;
        } else {
            echo $toReturn = "<option value='' selected>Non ci sono micro per questa macro.</option>";
        }
    }

}
?>