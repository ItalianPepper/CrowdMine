<?php

/**
 * Created by PhpStorm.
 * User: LongSky
 * Date: 01/12/2016
 * Time: 16:35
 */

include_once MODEL_DIR . 'MacroCategoria.php';
include_once MANAGER_DIR . 'Manager.php';
include_once CONTROL_DIR."ControlUtils.php";

/**
 * Class MacroCategoriaManager
 * This Class provides the business logic for the MacroCategoria Management and methods for database access.
 */

class MacroCategoriaManager extends Manager
{

    public function __construct()
    {
    }

    /**
     * create a new persistent macroCategoria
     * @param $id
     * @param $nome
     * @return MacroCategoria
     */
    public function addMacrocategoria($nome){
        $AGGIUNGI_MACRO = "INSERT INTO macrocategoria(nome) VALUES('%s')";
        $query = sprintf($AGGIUNGI_MACRO, $nome);

        if (!Manager::getDB()->query($query)) {
            return 0;
        }

        /*auto generated id of the micro previously created*/
        return Manager::getDB()->insert_id;
    }

    public function deleteMacrocategoria($macrocategoria){
        $id = $macrocategoria->getId();
        $RIMUOVI_MACROCATEGORIA = "DELETE FROM macrocategoria WHERE id =$id";
        Manager::getDB()->query($RIMUOVI_MACROCATEGORIA);
    }
    private function insertMacroCategoria($nome)
    {
        $INSERT_MACRO_CATEGORIA = "INSERT INTO `macrocategoria`(`nome`) VALUES ('%s')";
        $query = sprintf($INSERT_MACRO_CATEGORIA,$nome);
        if (!Manager::getDB()->query($query)) {
            header("Location: ". DOMINIO_SITO ); //add tosat notification
            throw new ApplicationException(ErrorUtils::$INSERIMENTO_FALLITO, Manager::getDB()->error, Manager::getDB()->errno);
        }
    }

    /**
     * verify if the MacroCategoria already exists
     * @param $macroCategoria
     */
    private function verifyMacroCategoria($macroCategoria)
    {
        $GET_MACRO_BY_NAME = "SELECT * FROM macrocategoria WHERE nome='".$macroCategoria->getNome()."'";
        echo $GET_MACRO_BY_NAME . "\n";
        $rs = Manager::getDB()->query($GET_MACRO_BY_NAME);
        if(count($this->macroToArray($rs)) >= 1) {
            return false;
        }
        else{
            return true;
        }
    }

    private function macroToArray($resSet)
    {
        $macro = array();
        if ($resSet) {
            while ($obj = $resSet->fetch_assoc()) {
                $macroCategoria = new MacroCategoria($obj['id'], $obj['nome']);
                $macro[] = $macroCategoria;
            }
        }
        return $macro;
    }

    private function macroToArraySerialize($resSet)
    {
        $macro = array();
        if ($resSet) {
            while ($obj = $resSet->fetch_assoc()) {
                $macroCategoria = new MacroCategoria($obj['id'], $obj['nome']);
                $macro[] = $macroCategoria->jsonSerialize();
            }
        }
        return $macro;
    }

    public function getMacroByName($nome){
        $GET_MACRO_BY_NAME = "SELECT * FROM macrocategoria WHERE nome='$nome'";
        $rs = Manager::getDB()->query($GET_MACRO_BY_NAME);
        if($rs){
            $obj = mysqli_fetch_assoc($rs);
            $macro = new MacroCategoria($obj["id"],$obj['nome']);
        }
        return $macro;
    }

    /**
     * return the total count of macros inside the system
     * @return int
     */
    public function getMacroCount(){
        $GET_MACRO_COUNT = "SELECT COUNT(*) as num FROM macrocategoria WHERE 1 ";
        $rs = Manager::getDB()->query($GET_MACRO_COUNT);
        if($rs){
            $obj = mysqli_fetch_assoc($rs);
            return $obj['num'];
        }
        return 0;
    }


    /**
     * get all macros, splitted in pages
     *
     * @param $page
     * @param $pageSize
     * @return array
     */
    public function getMacrosPage($page, $pageSize)
    {
        $GET_MACRO_BY_NAME = "SELECT * FROM macrocategoria WHERE 1 LIMIT %s,%s";
        $query = sprintf($GET_MACRO_BY_NAME,$page*$pageSize,$pageSize);
        $rs = Manager::getDB()->query($query);
        return $this->macroToArray($rs);
    }

    /**
     * get all macros inside the sistem
     * @param $macroCategoria
     */
    public function getAllMacros()
    {
        $GET_MACRO_BY_NAME = "SELECT * FROM macrocategoria WHERE 1";
        $query = sprintf($GET_MACRO_BY_NAME);
        $rs = Manager::getDB()->query($query);
        return $this->macroToArray($rs);
    }
    /**
     * get all macros inside the sistem and serialize them
     * @param $macroCategoria
     */
    public function getAllMacrosSerialized()
    {
        $GET_MACRO_BY_NAME = "SELECT * FROM macrocategoria WHERE 1";
        $query = sprintf($GET_MACRO_BY_NAME);
        $rs = Manager::getDB()->query($query);
        return $this->macroToArraySerialize($rs);
    }

    /**
     * get all macros for a certain userid
     * @param $macroCategoria
     */
    public function getUserMacros($userid)
    {
        $GET_MACROS_BY_USERID = "SELECT macrocategoria.id,macrocategoria.nome 
                              FROM macrocategoria JOIN microcategoria
                                   ON macrocategoria.id = microcategoria.id_macrocategoria
                                   JOIN competente
                                   ON microcategoria.id = competente.id_microcategoria
                              WHERE competente.id_utente = '%s'
                              GROUP BY macrocategoria.id";
        $query = sprintf($GET_MACROS_BY_USERID,$userid);
        $rs = Manager::getDB()->query($query);
        return $this->macroToArray($rs);
    }

    /**
     * get a macro for a certain userid
     * @param $macroCategoria
     */
    public function getUserMacro($userid,$macroid)
    {
        $GET_MACRO_BY_USERID = "SELECT macrocategoria.id,macrocategoria.nome 
                              FROM macrocategoria JOIN microcategoria
                                   ON macrocategoria.id = microcategoria.id_macrocategoria
                                   JOIN competente
                                   ON microcategoria.id = competente.id_microcategoria
                              WHERE competente.id_utente = '%s' AND macrocategoria.id = '%s'
                              GROUP BY macrocategoria.id";
        $query = sprintf($GET_MACRO_BY_USERID,$userid,$macroid);
        $rs = Manager::getDB()->query($query);

        if (!$rs) {
            throw new ApplicationException(ErrorUtils::$ARGOMENTO_NON_TROVATO, Manager::getDB()->error, Manager::getDB()->errno);
        }

        if($rs->num_rows < 1){
            return false;
        }else{
            $obj = $rs->fetch_assoc();
            return new MacroCategoria($obj['id'], $obj['nome']);
        }
    }

    /**
     * @param $id
     * @return MacroCategoria
     */
    public function getMacroById($id){
        $GET_MACRO_BY_ID = "SELECT * FROM macrocategoria WHERE nome='$id'";
        $rs = Manager::getDB()->query($GET_MACRO_BY_ID);
        if($rs){
            $obj = mysqli_fetch_assoc($rs);
            $macro = new MacroCategoria($obj["id"],$obj['nome']);
        }
        return $macro;

    }

    public function getListaMacrocategorie(){
        $GET_ALL_MACRO = "SELECT * FROM macrocategoria";
        $rs = Manager::getDB()->query($GET_ALL_MACRO);
        if($rs){
            $toReturn = array();
            while($row = $rs->fetch_assoc()){
                $macro = new MacroCategoria($row["id"],$row["nome"]);
                array_push($toReturn,$macro);
            }
            return $toReturn;
        } else {
            return false;
        }
    }

    //metodi per le statistiche
    /**
     * @return array|bool
     */
    public function findListMacorocategoria(){
        $lista = array();
        $FIND_LIST_MACROCATEGORIA =
            "SELECT macrocategoria.nome AS nome, COUNT(competente.id_microcategoria) AS conto 
             FROM macrocategoria, competente, microcategoria 
             WHERE microcategoria.id = competente.id_microcategoria AND macrocategoria.id IN (SELECT microcategoria.id_macrocategoria FROM macrocategoria) 
             GROUP BY macrocategoria.nome;";
        $result = self::getDB()->query($FIND_LIST_MACROCATEGORIA);
        if($result != 0){
            foreach($result->fetch_assoc() as $l){
                array_push($lista, $l);
            }return $lista;
        }return false;
    }

    public function findBestMacrocategoriaCompetente(){
        $lista = array();
        $FIND_BEST_USER_BY_MACROCATEGORIA =
            "SELECT macrocategoria.nome AS nome, COUNT(competente.id_microcategoria) AS conto
             FROM microcategoria, macrocategoria, competente
             WHERE competente.id_microcategoria = microcategoria.id AND microcategoria.id_macrocategoria = macrocategoria.id
             GROUP BY competente.id_microcategoria
             ;";
        $result = self::getDB()->query($FIND_BEST_USER_BY_MACROCATEGORIA);
        if($result){
            foreach($result->fetch_assoc() as $l){
                array_push($lista, $l);
            }return $lista;
        }return false;
    }

    public function findBestMacrocategoriaRiferito(){
        $lista = array();
        $FIND_BEST_USER_BY_MACROCATEGORIA =
            "SELECT macrocategoria.nome AS nome, COUNT(riferito.id_microcategoria) AS conto
             FROM microcategoria, macrocategoria, riferito
             WHERE riferito.id_microcategoria = microcategoria.id AND microcategoria.id_macrocategoria = macrocategoria.id
             GROUP BY riferito.id_microcategoria
             ;";
        $result = self::getDB()->query($FIND_BEST_USER_BY_MACROCATEGORIA);
        if(result != 0){
            foreach($result->fetch_assoc() as $l){
                array_push($lista, $l);
            }return $lista;
        }return false;
    }
}
