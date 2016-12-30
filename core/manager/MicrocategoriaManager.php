<?php

include_once MODEL_DIR . 'Macrocategoria.php';
include_once MODEL_DIR . 'Microcategoria.php';
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
        return new Microcategoria($id, $nomeMicro, $idMacro);
    }

    /**
     * Add the Microcategoria into the dataBase
     *
     * @param Microcategoria $microcategoria
     * @param Macrocategoria $macrocategoria
     */
    public function addMicrocategoria($microcategoria){
        $AGGIUNGI_MICRO = "INSERT INTO 'microcategoria' (nome, id_macrocategoria) VALUES('%s', '%s')";
        $query = sprintf($AGGIUNGI_MICRO, $microcategoria->getNome(), $microcategoria->getIdMacrocategoria());
        self::getDB()->query($query);
    }

    /**
     * Delete a Microcategoria from dataBase
     *
     * @param Microcategoria $microcategoria
     */
    public function deleteMicrocategoria($microcategoria){
        $RIMUOVI_MICROCATEGORIA = "DELETE FROM 'microcategoria' WHERE id = '%s'";
        $query = sprintf($RIMUOVI_MICROCATEGORIA, $microcategoria->getId());
        self::getDB()->query($query);
    }

    /**
     * Edit an exist Microcategoria
     *
     * @param Microcategoria $microcategoria
     */
    public function editMicrocategoria($microcategoria){
        $CHANGE_NOME_MICRO = "UPDATE 'microcategoria' SET nome='%s', id_macrocategoria='%s' WHERE id='%s'";
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

    public function findMicrocategoriaById($idMicro){
        $FIND_MICRO_BY_ID = "SELECT * FROM microcategoria WHERE id=%s;";

    }

    public function findMicrocategoriaByNome($nome){
        $GET_MICRO_BY_NOME = "SELECT * FROM 'microcategoria' WHERE nome  ='%s'";
        $query = sprintf($GET_MICRO_BY_NOME, $nome);
        $result = self::getDB()->query($query);
        $row = $result->fetch_assoc();
        return $this->createMicrocategoria($row['id'], $row['nome'], $row['id_macrocategoria']);
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
        foreach($result->fetch_assoc() as $m){
            $micro = $this->createMicrocategoria($m['id'], $m['nome'], $m['id_macrocategoria']);
            array_push($micro);
        }
        return $listaMicro;
    }

    /**
     * Return array formed by two values: the name of microcategoria associated with macorcategoria param
     * and the count of this microcategoria
     *
     * @return array $lista
     */
    public function findBestMicrocategoriaCompetente($macrocategoria, $numPagina){
        $lista = array();
        $FIND_BEST_USER_BY_MICROCATEGORIA =
            "SELECT microcategoria.nome AS nome, COUNT(competente.id_microcategoria) AS conto
             FROM microcategoria, competente
             WHERE competente.id_microcategoria = microcategoria.id AND microcategoria.id_macrocategoria = '%s'
             LIMIT 10 OFFSET %d
             GROUP BY competente.id_microcategoria;";
        $query = sprintf($FIND_BEST_USER_BY_MICROCATEGORIA, $macrocategoria, $numPagina*10-10+1);
        $result = self::getDB()->query($query);
        if(result != 0){
            foreach($result->fetch_assoc() as $l){
                array_push($lista, $l);
            }return $lista;
        }return false;
    }

    public function findBestMicrocategoriaRiferito($macrocategoria, $numPagina){
        $lista = array();
        $FIND_BEST_USER_BY_MICROCATEGORIA =
            "SELECT microcategoria.nome AS nome, COUNT(riferito.id_microcategoria) AS conto
             FROM microcategoria, riferito
             WHERE riferito.id_microcategoria = microcategoria.id AND microcategoria.id_macrocategoria = '%s'
             LIMIT 10 OFFSET %d
             GROUP BY riferito.id_microcategoria;";
        $query = sprintf($FIND_BEST_USER_BY_MICROCATEGORIA, $macrocategoria, $numPagina*10-10+1);
        $result = self::getDB()->query($query);
        if(result != 0){
            foreach($result->fetch_assoc() as $l){
                array_push($lista, $l);
            }return $lista;
        }return false;
    }

    public function getMaxPageCompetente($macrocategoria){
        $row = null;
        $GET_NUMBER = "SELECT COUNT(microcategoria.id) as conteggio FROM microcategoria, competente WHERE competente.id_microcategoria = microcategoria.id AND microcategoria.id_macrocategoria = '%s'";
        $query = sprintf($GET_NUMBER, $macrocategoria->getId());
        $result = Manager::getDB()->query($query);
        if(!$result){

        }else{
            $row = $result->fetch_row();
        }return $row;
    }

    public function getMaxPageRiferito($macrocategoria){
        $row = null;
        $GET_NUMBER = "SELECT COUNT(microcategoria.id) as conteggio FROM microcategoria, riferito WHERE riferito.id_microcategoria = microcategoria.id AND microcategoria.id_macrocategoria = '%s'";
        $query = sprintf($GET_NUMBER, $macrocategoria->getId());
        $result = Manager::getDB()->query($query);
        if(!$result){

        }else{
            $row = $result->fetch_row();
        }return $row;
    }

}