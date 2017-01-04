<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 10/12/2016
 * Time: 05:25
 */
include_once MANAGER_DIR . "MacroCategoriaManager.php";
include_once MANAGER_DIR . "MicrocategoriaManager.php";
include_once MODEL_DIR . "MacroCategoria.php"; // questo model va tolto, serve solo per provare lo stub
include_once MANAGER_DIR ."AnnuncioManager.php";
include_once MANAGER_DIR ."UtenteManager.php";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["nome"])){
        if($_GET["nome"]=="macro"){
            $managerMacro = new MacroCategoriaManager();
            $array = $managerMacro->getListaMacrocategorie();
            $toReturn = "<option value=0 selected>Seleziona la macro categoria</option>";
            foreach ($array as $a){
                $toReturn = $toReturn . "<option value=".$a->getId().">" . $a->getNome()."</option>";
            }
            echo $toReturn;
        }

        if($_GET["nome"]=="micro"){
            $idMacro = $_GET["idMacro"];
            $microManager = new MicrocategoriaManager();
            $array = $microManager->getListaMicrocategorieByIdMacroCategoria($idMacro);
            if(count($array)>0) {
                $toReturn = "<option value=0 selected>Seleziona la micro categoria</option>";
                foreach ($array as $a) {
                    $toReturn = $toReturn . "<option value=" . $a->getId() . ">" . $a->getNome() . "</option>";
                }
                echo $toReturn;
            } else {
               echo $toReturn = "<option value=0 selected>Seleziona prima la macro</option>";
            }
        }

        if($_GET["nome"]=="utenti"){
            $utenteManager = new UtenteManager();
            $listaUtenti = $utenteManager->findAll();
            $toReturn = "<option value=0>Seleziona l'utente</option>";
            if(count($listaUtenti)>0) {
                foreach ($listaUtenti as $a) {
                    $toReturn = $toReturn . "<option value=" . $a->getId() . ">" . $a->getNome()." ".$a->getCognome() . "</option>";
                }
                echo $toReturn;
            } else {
                echo $toReturn = "<option value=0 selected>Non ci sono utenti nel sistema</option>";
            }
        }
    }
}














?>