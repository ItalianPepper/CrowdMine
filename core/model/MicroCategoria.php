<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 26/11/16
 * Time: 18:44
 */
class MicroCategoria implements JsonSerializable
{
    private $id;
    private $idMacrocategoria;
    private $nome;
    /**
     * MicroCategoria constructor.
     * @param $idMacrocategoria
     * @param $nome
     * @param $id
     */
    public function __construct($idMacrocategoria, $nome, $id = null)
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

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
            'microId'=>    $this->getId(),
            'microName' => $this->getNome(),
            'idMacro' => $this->getIdMacrocategoria()
        ];
    }
}