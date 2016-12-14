<?php

/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/11/2016
 * Time: 20:15
 */
class Commento
{

    private $id;
    private $idAnnuncio;
    private $idUtente;
    private $corpo;
    private $data;
    private $stato;

    /**
     * Commento constructor.
     * @param $id
     * @param $idAnnuncio
     * @param $idUtente
     * @param $corpo
     * @param $data
     */
    public function __construct($id="", $idAnnuncio, $idUtente, $corpo, $data, $stato)
    {
        $this->id = $id;
        $this->idAnnuncio = $idAnnuncio;
        $this->idUtente = $idUtente;
        $this->corpo = $corpo;
        $this->data = $data;
        $this->stato = $stato;
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
    public function getIdAnnuncio()
    {
        return $this->idAnnuncio;
    }

    /**
     * @return mixed
     */
    public function getIdUtente()
    {
        return $this->idUtente;
    }

    /**
     * @return mixed
     */
    public function getCorpo()
    {
        return $this->corpo;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $corpo
     */
    public function setCorpo($corpo)
    {
        $this->corpo = $corpo;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getStato()
    {
        return $this->stato;
    }

    /**
     * @param mixed $stato
     */
    public function setStato($stato)
    {
        $this->stato = $stato;
    }


}