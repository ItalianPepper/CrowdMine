<?php

/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 26/11/16
 * Time: 18:51
 */
class MacroCategoria
{
    private $id;
    private $nome;

    /**
     * MacroCategoria constructor.
     * @param $id
     * @param $nome
     */
    public function __construct($id=NULL,$nome)
    {
        $this->id = $id;
        $this->nome = $nome;
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
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

}