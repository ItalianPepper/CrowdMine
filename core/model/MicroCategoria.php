<?php

/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 26/11/16
 * Time: 18:44
 */
class MicroCategoria
{
    private $id;
    private $idMacrocategoria;
    private $nome;

    /**
     * MicroCategoria constructor.
     * @param $id
     * @param $nome
     * @param $idMacrocategoria
     */
    public function __construct($id = null, $idMacrocategoria, $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->idMacrocategoria = $idMacrocategoria;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getIdMacrocategoria()
    {
        return $this->idMacrocategoria;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

}