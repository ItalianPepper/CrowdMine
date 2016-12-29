<?php

/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 30/11/2016
 * Time: 20:40
 */
class tipoNotifica{
    const INSERIMENTO = "inserimento";
    const RISOLUZIONE = "risoluzione";
    const DECISIONE = "decisione";
    const SEGNALAZIONE = "segnalazione";
}

class ElementiInfoNotifica{
    const TIPO_OGGETTO = "tipo_oggetto";
    const ID_OGGETTO = "id_oggetto";
    const NOME_OGGETTO = "nome_oggetto";
    const ESITO_OGGETTO = "esito_oggetto";
    const TIPO_PER_DECISIONE = "tipo_decisione";
}

class SoggettiNotifiche{

    const ANNUNCIO = "annuncio";
    const COMMENTO = "commento";
    const FEEDBACK = "feedback";
    const UTENTE = "utente";
    const CANDIDATURA = "candidatura";
    const CONTROVERSIA_MOD = "controvesia_mod";
}
class Notifica implements JsonSerializable{
    private $id;
    private $data;
    private $tipo;
    private $info;
    private $letto;

    /**
     * Notifica constructor.
     * @param $id
     * @param $data
     * @param $tipo
     * @param $info
     * @param $letto
     */
    public function __construct($data, $tipo, $info, $letto, $id = null){
        $this->id = $id;
        $this->data = $data;
        $this->tipo = $tipo;
        $this->info = $info;
        $this->letto = $letto;
    }

    /**
     * @return mixed
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getData(){
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getTipo(){
        return $this->tipo;
    }

    /**
     * @return mixed
     */
    public function getInfo(){
        return $this->info;
    }

    /**
     * @return mixed
     */
    public function getLetto(){
        return $this->letto;
    }

    /**
     * @param mixed $data
     */
    public function setData($data){
        $this->data = $data;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    /**
     * @param mixed $info
     */
    public function setInfo($info){
        $this->info = $info;
    }

    /**
     * @param mixed $letto
     */
    public function setLetto($letto){
        $this->letto = $letto;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize(){
        return "{id: $this->getId(), data: $this->getData(), tipo: $this->getTipo(), letto: $this->getLetto(), info: $this->getLetto()}";
    }

}