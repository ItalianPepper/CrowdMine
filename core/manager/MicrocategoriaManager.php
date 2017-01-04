<?php

include_once MODEL_DIR . 'Macrocategoria.php';
include_once MODEL_DIR . 'Microcategoria.php';
include_once MODEL_DIR . 'MicroListObject.php';
include_once MANAGER_DIR  .  'Manager.php';
/**
 * Created by PhpStorm.
 * User: Andrea Sarto
 * Date: 29/11/2016
 * Time: 00.15
 */
class MicrocategoriaManager extends Manager
{

    /**
     * MicrocategoriaManager constructor.
     */
    public function __construct()
    {

    }

    /**
     * Add a new persistent Microcategoria
     *
     * @param Double $id
     * @param String $nome
     * @return Microcategoria
     */
    public function createMicrocategoria($id, $nomeMicro, $idMacro){
        return new Microcategoria($idMacro,$nomeMicro,$id);
    }

    /**
     * Add the Microcategoria into the dataBase
     *
     * @param Microcategoria $microcategoria
     * @param Macrocategoria $macrocategoria
     */
    public function addMicrocategoria($microcategoria){
        $AGGIUNGI_MICRO = "INSERT INTO microcategoria(nome,id_macrocategoria) VALUES('%s', '%s')";
        $query = sprintf($AGGIUNGI_MICRO, $microcategoria->getNome(), $microcategoria->getIdMacrocategoria());

        if (!Manager::getDB()->query($query)) {
            return 0;
        }

        /*auto generated id of the micro previously created*/
        return Manager::getDB()->insert_id;
    }

    /**
     * Delete a Microcategoria from dataBase
     *
     * @param Microcategoria $microcategoria
     */
    public function deleteMicrocategoria($microcategoria){
        $RIMUOVI_MICROCATEGORIA = "DELETE FROM microcategoria WHERE id = '%s'";
        $query = sprintf($RIMUOVI_MICROCATEGORIA, $microcategoria->getId());
        self::getDB()->query($query);
    }

    /**
     * Edit an exist Microcategoria
     *
     * @param Microcategoria $microcategoria
     */
    public function editMicrocategoria($microcategoria){
        $CHANGE_NOME_MICRO = "UPDATE microcategoria SET nome='%s', id_macrocategoria='%s' WHERE id='%s'";
        $query = sprintf($CHANGE_NOME_MICRO, $microcategoria->getNome(), $microcategoria->getIdMacrocategoria());
        self::getDB()->query($query);
    }

    /**
     * @param $nome
     * @return bool
     */
    public function checkMicrocategoria($nome){
        $SEARCH_MICRO = "SELECT * FROM 'microcategoria' WHERE nome='%s'";
        $query = sprintf($SEARCH_MICRO, $nome);
        $result = self::getDB()->query($query);
        if($result->num_rows == 1){
            return true;
        }else
            return false;
    }

    /**
     * total size of micros excluding special micros
     * @return int
     */
    public function getMicroCount(){
        $GET_MICRO_COUNT = "SELECT COUNT(microcategoria.id) as num
                            FROM microcategoria JOIN macrocategoria
                                ON microcategoria.id_macrocategoria = macrocategoria.id
                            WHERE macrocategoria.nome != microcategoria.nome";
        $rs = Manager::getDB()->query($GET_MICRO_COUNT);
        if($rs){
            $obj = mysqli_fetch_assoc($rs);
            return $obj['num'];
        }
        return 0;
    }

    /**
     * get all micros, splitted in pages
     *
     * @param $page
     * @param $pageSize
     * @return array
     */
    public function getMicrosPage($page, $pageSize)
    {
        $GET_MICRO_PAGE = "SELECT microcategoria.*,macrocategoria.nome as macroNome 
                            FROM microcategoria JOIN macrocategoria
                                ON microcategoria.id_macrocategoria = macrocategoria.id
                            WHERE macrocategoria.nome != microcategoria.nome LIMIT %s,%s";
        $query = sprintf($GET_MICRO_PAGE,$page*$pageSize,$pageSize);

        $rs = Manager::getDB()->query($query);
        $listaMicro = array();
        while($m=$rs->fetch_assoc()){
            $micro = new MicroListObject($this->createMicrocategoria($m['id'], $m['nome'], $m['id_macrocategoria']),
                new MacroCategoria($m['id_macrocategoria'], $m['macroNome']));
            array_push($listaMicro,$micro);
        }
        return $listaMicro;
    }


    /**
     * get all micros for a certain userid
     * @param $microCategoria
     */
    public function getUserMicros($userid)
    {
        $GET_MICROS_BY_USERID = "SELECT microcategoria.id,microcategoria.nome,microcategoria.id_macrocategoria,macrocategoria.nome as macroNome 
                              FROM microcategoria JOIN competente
                                   ON microcategoria.id = competente.id_microcategoria
                                    JOIN macrocategoria
                                   ON macrocategoria.id = microcategoria.id_macrocategoria
                              WHERE competente.id_utente = '%s' AND macrocategoria.nome!= microcategoria.nome
                              GROUP BY microcategoria.id";

        $query = sprintf($GET_MICROS_BY_USERID,$userid);
        $result = self::getDB()->query($query);

        if (!$result) {
            throw new ApplicationException(ErrorUtils::$ARGOMENTO_NON_TROVATO, Manager::getDB()->error, Manager::getDB()->errno);
        }

        $listaMicro = array();
        while($m=$result->fetch_assoc()){
            $micro = new MicroListObject($this->createMicrocategoria($m['id'], $m['nome'], $m['id_macrocategoria']),
                                        new MacroCategoria($m['id_macrocategoria'], $m['macroNome']));
            array_push($listaMicro,$micro);
        }
        return $listaMicro;
    }

    /**
     * get all micros for a certain Macro
     * @param $microCategoria
     */
    public function getMicrosByMacro($macroid)
    {
        //join with macro, to avoid special micros
        $GET_MICROS_BY_MACROID = "SELECT microcategoria.id,microcategoria.nome,microcategoria.id_macrocategoria 
                              FROM microcategoria JOIN macrocategoria
                                ON microcategoria.id_macrocategoria = macrocategoria.id
                              WHERE microcategoria.id_macrocategoria = '%s' AND macrocategoria.nome!= microcategoria.nome
                              GROUP BY microcategoria.id";

        $query = sprintf($GET_MICROS_BY_MACROID,$macroid);
        $result = self::getDB()->query($query);
        $listaMicro = array();
        while($m=$result->fetch_assoc()){
            $micro = $this->createMicrocategoria($m['id'], $m['nome'], $m['id_macrocategoria']);
            array_push($listaMicro,$micro);
        }
        return $listaMicro;
    }

    public function getMicrosByMacroSerialized($macroid)
    {
        //join with macro, to avoid special micros
        $GET_MICROS_BY_MACROID = "SELECT microcategoria.id,microcategoria.nome,microcategoria.id_macrocategoria 
                              FROM microcategoria JOIN macrocategoria
                                ON microcategoria.id_macrocategoria = macrocategoria.id
                              WHERE microcategoria.id_macrocategoria = '%s' AND macrocategoria.nome!= microcategoria.nome
                              GROUP BY microcategoria.id";

        $query = sprintf($GET_MICROS_BY_MACROID,$macroid);
        $result = self::getDB()->query($query);
        $listaMicro = array();
        while($m=$result->fetch_assoc()){
            $micro = $this->createMicrocategoria($m['id'], $m['nome'], $m['id_macrocategoria']);
            array_push($listaMicro,$micro->jsonSerialize());
        }
        return $listaMicro;
    }
    /**
     * @param $idMicro
     */
    public function getSpecialMicro($idMicro){
        $GET_SPECIAL_MICRO = "SELECT microcategoria.* 
                                FROM microcategoria,macrocategoria
                                WHERE microcategoria.nome = macrocategoria.nome AND macrocategoria.id='%s'";
        $query = sprintf($GET_SPECIAL_MICRO, $idMicro);
        $result = self::getDB()->query($query);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            return $this->createMicrocategoria($row['id'], $row['nome'], $row['id_macrocategoria']);
        }else
            return false;
    }

    public function findMicrocategoriaById($idMicro){
        $FIND_MICRO_BY_ID = "SELECT * FROM microcategoria WHERE id='%s';";
        $query = sprintf($FIND_MICRO_BY_ID, $idMicro);
        $result = self::getDB()->query($query);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            return $this->createMicrocategoria($row['id'], $row['nome'], $row['id_macrocategoria']);
        }else
            return false;
    }

    public function findMicrocategoriaByNome($nome){
        $GET_MICRO_BY_NOME = "SELECT * FROM 'microcategoria' WHERE nome  ='%s'";
        $query = sprintf($GET_MICRO_BY_NOME, $nome);
        $result = self::getDB()->query($query);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            return $this->createMicrocategoria($row['id'], $row['nome'], $row['id_macrocategoria']);
        }else
            return false;
    }

    /**
     * Get the list of all Microcategoria into the dataBase
     *
     * @return array $listaMicro
     */
    public function findAll(){
        $FIND_ALL = "SELECT * FROM 'microcategoria'";
        $result = self::getDB()->query($FIND_ALL);
        $listaMicro = array();
        while($m = $result->fetch_assoc()){
            $micro = $this->createMicrocategoria($m['id'], $m['nome'], $m['id_macrocategoria']);
            array_push($listaMicro,$micro);
        }
        return $listaMicro;
    }

    /**
     * Return array formed by two values: the name of microcategoria associated with macorcategoria param
     * and the count of this microcategoria
     *
     * @return array $lista
     */
    public function findBestMicrocategoria($macrocategoria){
        $lista = array();
        $FIND_BEST_USER_BY_MICROCATEGORIA =
            "SELECT microcategoria.nome AS nome, COUNT(competente.id_microcategoria) AS conto
             FROM microcategoria, competente
             WHERE competente.id_microcategoria = microcategoria.id AND microcategoria.id_macrocategoria = '%s'
             GROUP BY competente.id_microcategoria;";
        $query = sprintf($FIND_BEST_USER_BY_MICROCATEGORIA, $macrocategoria);
        $result = self::getDB()->query($query);
        if(result != 0){
            foreach($result->fetch_assoc() as $l){
                array_push($lista, $l);
            }return $lista;
        }return false;
    }


}