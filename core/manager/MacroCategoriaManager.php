<?php

/**
 * Created by PhpStorm.
 * User: LongSky
 * Date: 01/12/2016
 * Time: 16:35
 */

include_once MODEL_DIR . 'MacroCategoria.php';
include_once MANAGER_DIR . 'Manager.php';

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
    public function createMacrocategoria($nome)
    {
        $macroCategoria = new MacroCategoria($nome);
        if ($this->verifyMacroCategoria($macroCategoria)) {
            $this->insertMacroCategoria($nome);
        } else {
            header("Location: ". DOMINIO_SITO ); // ADD TOAST NOTIFICATION
            throw new IllegalArgumentException(ErrorUtils::$VALORE_DUPLICATO);
        }
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
        if(result != 0){
            foreach($result->fetch_assoc() as $l){
                array_push($lista, $l);
            }return $lista;
        }return false;
    }
}
