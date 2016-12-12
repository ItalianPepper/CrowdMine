<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 10/12/2016
 * Time: 05:25
 */
//include_once MANAGER_DIR . "MacroCategoriaManager.php";
//include_once MANAGER_DIR . "MicrocategoriaManager.php";
include_once MODEL_DIR . "MacroCategoria.php"; // questo model va tolto, serve solo per provare lo stub
include_once MANAGER_DIR ."AnnuncioManager.php";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["nome"])){
        if($_GET["nome"]=="macro"){
  //          $managerMacro = new MacroCategoriaManager();
            //qui ci va il metodo del manager che mi restituisce l'array delle macrocategorie. io faccio uno stub x provare
            $array[0] = new MacroCategoria(1,"Informatica");
            $array[1] = new MacroCategoria(2,"Economia");
            $array[2] = new MacroCategoria(3,"Finanza");

            $toReturn = "<option value=0 selected>Seleziona la macro categoria</option>";
            foreach ($array as $a){
                $toReturn = $toReturn . "<option value=".$a->getId().">" . $a->getNome()."</option>";
            }
            echo $toReturn;
        }

        if($_GET["nome"]=="micro"){
            $idMacro = $_GET["idMacro"];
            //qui ci va il metodo che dato l'id della macrocategoria, mi restituisce un array di micro associate!

            /*$toReturn="";
            foreach ($array as $a){
                $toReturn = $toReturn . "<option value=".$a->getId().">" . $a->getNome()."</option>";
            }*/
            $toReturn = $toReturn . "<option value=1>css</option>";
            echo $toReturn;
        }

        if($_GET["nome"]=="idUtente"){
            $idUtente = $_GET["idUtente"];
            $managerAnnunci = new AnnuncioManager();
            $listaAnnunciUtente = $managerAnnunci->searchAnnunciUtente($idUtente);
            echo count($listaAnnunciUtente);
            $_SESSION["lista"] = serialize($listaAnnunciUtente);
        }

        if($_GET["nome"]=="modificaAnnuncio"){
            $idAnnuncio = $_GET["idAnnuncio"];
            $managerAnnunci = new AnnuncioManager();
            $annuncio = $managerAnnunci->getAnnuncio($idAnnuncio);
            $_SESSION["annuncio"] = serialize($annuncio);
            echo $annuncio->getDescrizione(); //non funzionano le cose. mi fermo, aspettando chiarimenti dai manager.
        }
    }
}














?>