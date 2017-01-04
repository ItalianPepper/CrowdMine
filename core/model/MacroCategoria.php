<?php

/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 26/11/16
 * Time: 18:51
 */
class MacroCategoria implements JsonSerializable
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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
          'macroId'=>    $this->getId(),
          'macroName' => $this->getNome(),
        ];
    }
}